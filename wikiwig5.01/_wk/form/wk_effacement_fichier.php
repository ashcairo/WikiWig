<?php
  require_once '../wk_config.php';
  require_once '../lib/Wiki.php';
  require_once '../wk_protect.php';
  if (!isset($_SESSION)) {
    session_start();
  }

  $results = '';
  $errors = '';
  $folder = "/";
  $page_list_url = Wiki::getConfig('wkHTTPPath').Wiki::getConfig('systemDir').'/wk_liste.php';

  if(isset($_GET['rep'])) {
    $folder = $_GET['rep'];
    $page_list_url .= "?folder=". $_GET['rep'];
  } elseif(isset($_POST['rep'])) {
    $folder = $_POST['rep'];
    $page_list_url .= "?folder=". $_POST['rep'];
  }

  $display_form = false;
  $head_title = '';
  $body_title = '';

  // default back url
  $back_url = $page_list_url;

  // No process asked => no action => redirection
  if (!isset($_POST['process']) && !isset($_GET['folder'])) {
    header('Location: '.$page_list_url);
    exit();
  }

  // Get current user
  $user = Wiki_User::currentUser();

  if(isset($_POST['process'])){
    // error_log("eff: " . $_POST['process']);
    switch($_POST['process']) {

      case 'delete' :

        if(isset($_POST['DEL'])) {
          if(!empty($_POST['Mid'])) {
            foreach($_POST['Mid'] as $a){
              Wiki::deletePage($a);
              //supression ds la base de la Protection
              $db=Wiki_DB::getInstance();
              $requete="DELETE FROM ".Wiki::getConfig('table_pages')." WHERE pages_nom LIKE 'PROTECT-/{$a}'";
              $res=$db->query($requete);
            }
            $results = WK_DELETE_SUCCESS;
          }
        }
        break;

      case 'move' :
        // NYI
        if(isset($_POST['DEL'])) {
          if(!empty($_POST['Mid'])) {
            $display_form = 'wk_file_form_move.php';
            $process = $_POST['process'];
            $form_action = $_SERVER['PHP_SELF'];
            $files = $_POST['Mid'];
            // $results = "Files moved";
          }
        } else {
          $back_url = $page_list_url . "?folder=" . $_POST['folder'];
          if (isset($_POST['target_folder']) && isset($_POST['folder'])) {
            $target = $_POST['target_folder'];
            $folder = $_POST['folder'];

            if (isset($_POST['old_name']) && isset($_POST['new_name'])) {
              $old_name = $_POST['old_name'];
              $new_name = $_POST['new_name'];
              // error_log("DO MOVE NEW");
              $old_wiki_path = $folder . $old_name . ".html";
              $new_wiki_path = $target . $new_name . ".html";
              // error_log("MV: $old_wiki_path -> $new_wiki_path");
              $res = Wiki::movePage($old_wiki_path, $new_wiki_path);
              if ($res !== true) {
                $errors = $res;
              } else {
                $results = sprintf(WK_MOVE_FILE_SUCCESS, $target);
              }
            } else if (isset($_POST['files'])) {
              $results = array();
              $err = array();
              $files = explode(";", $_POST['files']);
              // Verify each file
              foreach ($files as $file) {
                $file = "/" . $file;
                $fn = basename($file);
                $new_wiki_path = "/" . $target . $fn;
                $res = Wiki::movePage($file, $new_wiki_path);
                if ($res !== true) {
                  $err[] = $res;
                } else {
                  $results[] = sprintf(WK_MOVE_FILE_SUCCESS, $target);
                }
                // error_log("MV: $file -> $new_wiki_path");
              }
              $results = implode('<br/>', $results);
              if (count($err) > 0) {
                $errors = implode('<br/>', $err);
              }
            } else {
              $errors = WK_MOVE_BAD;
            }
          } else {
            $errsors = WK_MOVE_BAD;
          }
        }
        break;

//DROIT

      case 'don':

        if (!empty($_POST['Prot'])){//enregistre les modifs (records the modifs?)
          $db=Wiki_DB::getInstance();
          $reqDeleteTot="DELETE FROM ".Wiki::getConfig('table_pages')." WHERE  pages_temps='1' ||  pages_temps='2'";
          $resDeleteToT=$db->query($reqDeleteTot);

          $protect_pages = array();
          foreach($_POST['Prot'] as $a){

            list($nom, $droit) = split("_/", $a);
            if (!isset($protect_pages[$nom]) || $protect_pages[$nom] != '2') {
              $protect_pages[$nom] = $droit;
            }
          }
          foreach ($protect_pages as $nom => $droit) {

            $requeteTest ="SELECT * FROM ".Wiki::getConfig('table_pages').
                          "  WHERE pages_nom='{$nom}' && pages_temps='{$droit}' && pages_utilisateur='{$_SESSION['user_name']}'";
            $resTest=$db->query($requeteTest);

            if (empty($resTest)){//si une valeur n'est pas entrée dans ce cas on l'insert
              $requete1 = "INSERT INTO ".Wiki::getConfig('table_pages').
                          " SET pages_nom='{$nom}' , pages_temps='{$droit}' , pages_utilisateur='{$_SESSION['user_name']}'";
              // error_log("mt: " . $requete1);
              $res1=$db->query($requete1);
            }


            $requeteSELECT = "SELECT * FROM ".Wiki::getConfig('table_pages').
                             "  WHERE pages_nom='{$nom}' && (pages_temps='1' || pages_temps='2') && pages_utilisateur='{$_SESSION['user_name']}'";
            $resSELECT=$db->query($requeteSELECT);

            if ((count($resSELECT))=="2"){
              $reqSup="DELETE FROM ".Wiki::getConfig('table_pages')." WHERE pages_nom='{$nom}' &&  pages_temps='1'";
              $resSup=$db->query($reqSup);
            }
          }
        } else { //efface TOUS les droits (erase ALL the rights)

          foreach($_POST['page'] as $key => $value ){

            $db=Wiki_DB::getInstance();
            $requeteTestNeg ="SELECT * FROM ".Wiki::getConfig('table_pages').
                             "  WHERE pages_nom='PROTECT-/{$value}' && (pages_temps='1' || pages_temps='2')";
            $resTest=$db->query($requeteTestNeg);

            if ($resTest){
              $requeteDelete= "DELETE FROM ".Wiki::getConfig('table_pages')." WHERE pages_nom='{$resTest[0]['pages_nom']}'";
              $resDelete=$db->query($requeteDelete);
            }
          }
        }
        header("Location: $page_list_url");
        exit();
        break;

      default :

         header("Location: $page_list_url");
         exit();
         break;
    }
  }

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo $head_title; ?></title>
    <link href="<?php echo Wiki::getConfig('wkHTTPPath').Wiki::getConfig('systemDir'); ?>/wk_style.css?no_cache=<?php echo rand(10000,9999999);?>" rel="stylesheet" type="text/css">
  </head>
    
  <body class="actions">
    <div id="header"><?php echo $body_title; ?></div>
    <div id="content" class="actions">
<?php
      if (!empty($errors)) echo '<span class="errors">'.$errors.'</span><br />';
      if (!empty($results)) echo $results.'<br />';
      if (($display_form !== false) && @is_file($display_form)) {
        include($display_form);
      } else {
?> 
        <form>
          <input type="button" class="btn" value="<?php echo WK_LABEL_BACK;?>" onclick="document.location='<?php echo $back_url;?>';" />
        </form>
<?php
      }
?> 
    </div>
  </body>
</html>
