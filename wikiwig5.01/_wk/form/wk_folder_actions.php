<?php
  error_reporting(E_ALL);
  require_once '../wk_config.php';
  require_once '../lib/Wiki.php';

  $results = '';
  $errors = '';
  $page_list_url = Wiki::getConfig('wkHTTPPath').Wiki::getConfig('systemDir').'/wk_liste.php';
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


  // CREATE : special case coming from GET
  if (isset($_GET['folder'])) {
    $_POST['process'] = 'create';
    $_POST['folder'] = $_GET['folder'];
  }

  // Process Actions
  if (isset($_POST['process'])) {
    switch($_POST['process']) {
      // CREATE a folder
      case 'create' :
        if ($user->rights('createFolders')) {
          if (isset($_POST['folder']) && !empty($_POST['folder'])) {
            $head_title = WK_CREATE_DIR_HEAD_TITLE;
            $body_title = sprintf(WK_CREATE_DIR_BODY_TITLE,$_POST['folder']);
            if (isset($_POST['new_folder'])) {
              $res_create = Wiki::createFolder($_POST['folder'],$_POST['new_folder']);
              if (is_array($res_create)){
                $errors = implode('<br/>',$res_create);
              }
            }
            if (!empty($errors) || !isset($res_create)) {
              $folder = $_POST['folder'];
              $process = 'create';
              $form_action = $_SERVER['PHP_SELF'];
              $display_form = 'wk_folder_form_create.php';
            } else { // create ok
              $redirect_folder = '/'.trim($_POST['folder'],'/').'/'.$res_create;
              $results = sprintf(WK_CREATE_DIR_SUCCESS,$res_create);
              $back_url = $page_list_url.'?folder='.$redirect_folder;
            }
          }
        }
        //}
        break;
      // DELETE a folder
      case 'delete' :
        if ($user->rights('deleteFolders')) { // allowed to delete
          if (isset($_POST['folder']) && !empty($_POST['folder'])) {
            $head_title = WK_DELETE_DIR_HEAD_TITLE;
            $body_title = sprintf(WK_DELETE_DIR_BODY_TITLE,$_POST['folder']);
            if (isset($_POST['confirm']) && isset($_POST['confirm'])=='1') {
              $res_delete = Wiki::deleteFolder($_POST['folder']);
              if ($res_delete !== true) {
                if (is_array($res_delete)) {
                  $errors = implode('<br/>',$res_delete);
                } else {
                  $errors = $res_delete;
                }
              } else {
                $results = sprintf(WK_DELETE_DIR_SUCCESS,$_POST['folder']);
              }
            } else {
              $folder = $_POST['folder'];
              $process = 'delete';
              $form_action = $_SERVER['PHP_SELF'];
              $display_form = 'wk_folder_form_delete.php';
            }
          }

        } else {
          $errors = WK_ERR_DIR_DELETE_NOT_ALLOWED;
        }
        break;

      // MOVE a folder
      case 'move' :
        //echo 'ask to move';
        if ($user->rights('moveFolders')) { // allowed to move
          //echo 'allowed to move';
          if (isset($_POST['folder']) && !empty($_POST['folder'])) { //echo 'a folder to move';
            $head_title = WK_MOVE_DIR_HEAD_TITLE;
            $body_title = sprintf(WK_MOVE_DIR_BODY_TITLE,$_POST['folder']);
                  
            if (isset($_POST['target_folder']) && !empty($_POST['target_folder'])) { // all parameters sent
              //echo $_POST['folder'].' => '.$_POST['target_folder'].'<br />';
              $res_moved = Wiki::moveFolder($_POST['folder'],$_POST['target_folder']);
              if ($res_moved !== true) {
                if (is_array($res_moved)) {
                  $errors = implode('<br/>',$res_moved);
                } else {
                  $errors = $res_moved;
                }
              }
            }
            if (!empty($errors) || !isset($res_moved)) { // display a form to choose target
              $folder = $_POST['folder'];
              $process = 'move';
              $form_action = $_SERVER['PHP_SELF'];
              $display_form = 'wk_folder_form_move.php';
            } else { // move ok and set the redirection to list the new folder
              $redirect_folder = '/'.trim($_POST['target_folder'],'/').'/'.basename($_POST['folder']);
              $results = sprintf(WK_MOVE_DIR_SUCCESS,$_POST['folder'],$_POST['target_folder']);
              $back_url = $page_list_url.'?folder='.$redirect_folder;
            }
          }
        } else {
          $errors = WK_ERR_DIR_MOVE_NOT_ALLOWED;
        }
        break;
      default :
        // No defined process asked => no action => redirection
        if (!isset($_POST['process'])) {
          header('Location: '.$page_list_url);
          exit();
        }
        break;
    } // switch
  }

// Forms or Results

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
