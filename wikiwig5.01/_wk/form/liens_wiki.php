<?php
  require_once '../wk_config.php';
  require_once '../lib/Wiki.php';
  require_once '../lib/Wiki_PageDir.php';


  if(!empty($_GET['folder']) && $_GET['folder'] != "\\" && $_GET['folder'] != "/") {
    $folder = urldecode($_GET['folder']);
    // error_log("fld $folder");
  } else {
    $folder = '';
    // error_log("NULL fld");
  }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html style="width: 630px; height: 500px;">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Document sans titre</title>

    <script language="JavaScript" src="../js/domUtils.js"></script>
    <script language="JavaScript" src="../js/tooltip.js"></script>
    <script language="JavaScript" src="../js/dreamweaver.js"></script>
    <script language="JavaScript" src="../js/liste.js"></script>

    <script language="JavaScript"> window.onload = init("<?php echo $WK['wkHTTPPath'] . $WK['systemDir']?>"); </script>

    <link href="../wk_style.css?refresh=<?php echo rand(5,4545464); ?>" rel="stylesheet" type="text/css">

    <!--<script type="text/javascript" src="../Xinha/popups/popup.js"></script>-->
    <!--<script type="text/javascript" src="../Xinha/dialog.js"></script>-->

    <script language="javascript">
      // closes the dialog and passes the return info upper.
      function __dlg_close(val) {
        opener.Dialog._return(val);
        window.close();
      };
      window.resizeTo(700, 600);
      // QQQ this gets an error
      // netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserWrite");
      window.menubar.visible=!window.menubar.visible;

      function __dlg_init() {
        // nothing to do
      }


      function Init() {
        __dlg_init();
      }

      function onOk() {
        var fields = ["f_href"];
        var param = new Object();
        for (var i in fields) {
          var id = fields[i];
          var el = document.getElementById(id);
          param[id] = el.value;
        }
        __dlg_close(param);
        return false;
      } // onOk


      function set(liens) {
        document.getElementById('f_href').value = liens;
      }

      function onCancel() {
        __dlg_close(null);
        return false;
      }
    </script>
  </head>

  <!--<body onload="Init()">-->
  <body  onload="Init()" style="overflow-x:hidden; overflow-y:auto;" scroll="yes">
    <table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><div class="title"><?php echo WK_ADD_INTERNAL; ?></div></td>
      </tr>
      <tr>
        <td valign="top">
          <div>

          <div id="rep">
<?php

            // images

            //$img_default    = '../images/closed.gif';
            $img_expandable = $WK['wkHTTPPath'] . $WK['systemDir'].'/images/dossier_plus.gif';
            $img_expanded   = $WK['wkHTTPPath'] . $WK['systemDir'].'/images/open.gif';
            $img_selected   = $WK['wkHTTPPath'] . $WK['systemDir'].'/images/closed.gif';


            if($folder == '/') {
              $folder_elems = array();
            } else {
              $folder_elems = explode('/',trim($folder,'/'));
            }
            $max_display_level = count($folder_elems);

            //echo 'Dossier de la page : '.print_r($folder_elems,true).'<br/>';
            //echo 'Niveau max : '.$max_display_level.'<br/>';

            $folders_list = Wiki::listSubFolders('/');
            $old="";
            $old_l=0;
            $nb=0;

            $menu = "";
            $sel_branch = false;

            // listing pages from the selected folder - starcrouz may2005
            $ar_pages = Wiki::listPages($folder);
            $listePages = '<div id="file"><ul>';
            if (!empty($ar_pages)) {
              foreach ($ar_pages as $page) {
                $path = $page['wk_url'];
                $entry = Wiki_PageDir::findByPath($path);
                if ($entry === false) {
                  // old page with no sequence id, add it to dir
                  $entry =  new Wiki_PageDir();
                  $entry->set_active(true);
                  $entry->set_path($path);
                  $res = $entry->insert();
                  if ($res === false) {
                    // Failed to insert use old style?
                    $listePages .= '<li><a href="#url" onclick="set(\''.Wiki::getConfig('wkHTTPPath').$page['url'].'\');">'.$page['name'].'</a></li>';
                    continue;
                  }
                }
                $seq = $entry->seq();
                $url = Wiki::getConfig('wkHTTPPath') . Wiki::getConfig('systemDir') . "/wk_lookup.php?seq=$seq" ;
                $listePages .= '<li><a href="#url" onclick="set(\''. $url . '\');">'.$page['name'].'</a></li>';
              }
            }
            $listePages .= "</ul></div>";
            echo $listePages;
?>
            <form method="GET" action="wk_creation_fichier.php">
              &nbsp;<?php echo WK_LIST_ADD_FILE . " : " . "/" . $folder; ?> &nbsp;
              <input name="folder" type="hidden" value="/<?php echo $folder; ?>">
              <input name="caller" type="hidden" value="liens_wiki.php">
              <input class="btn" type="submit" name="Submit" value="<?php echo WK_LABEL_CREATE ; ?>">
            </form>
<?php

            $root = $WK['wkHTTPPath'] . $WK['systemDir'];

            // Menu generation
            //////////////////////
            foreach($folders_list as $numero=>$current_folder) {
              $c_folder_elems = explode('/',trim($current_folder,'/'));
              $l = count($c_folder_elems); //level
              $sel_branch = false;
              // detection
              // to know if the dir is the selected dir
              // or is parent of the selected dir => $sel_branch=true
              if ($l==1) { // first level elems
                if (isset($folder_elems[0]) && ($folder_elems[0] == $c_folder_elems[0]) ){
                  $sel_branch = true;
                }
              } elseif ($l > 0 && $l <= $max_display_level){ // child levels
                $ar_tmp_folder = array_slice ($folder_elems, 0, $l-1);
                $ar_tmp_current= array_slice ($c_folder_elems, 0, $l-1);
                if ($ar_tmp_folder == $ar_tmp_current) {
                  $sel_branch = true;
                }
              }
              //echo 'Dans la branche : '.print_r($sel_branch,true).'<br/>';
              // UL Items management
              //////////////////////
              if ($l > $old_l) {
                for ($a=1;$a<=($l - $old_l);$a++) {
                  if($numero==0) { // first list
                    $menu.="<ul id=\"s".($numero-1)."\">\n";
                  } else { // sublists
                    if ($sel_branch) {
                      $menu.="<ul style ='display:block;' id=\"s".($numero-1)."\">\n";
                    } else {
                      $menu.="<ul style ='display:none;' id=\"s".($numero-1)."\">\n";
                    }
                  }
                } // for
                $nb = $nb + ($l - $old_l);
              } elseif($l == $old_l) {
                // xxxx
              } else {
                for ($a=1;$a<=($old_l - $l);$a++) {
                  $menu.="</ul>\n";
                }
                $nb = $nb - ($old_l - $l);
              }

              // LI Items Management
              //////////////////////

              if ($folder == $current_folder) {
                $menu .= "<li class='dirsel'>";
                $menu .= "<a name='selection'>";
              } else {
                //$menu.= "<li>";
                $menu.= "<li>";
              }

              //$menu.= "<input type='checkbox' name='checkbox' value='checkbox' class='check'/>";

              //$menu.="&nbsp;";
              $menu.="&nbsp;";

              if (count(explode('/',trim(@$folders_list[$numero+1],'/'))) > $l) {

                if ($sel_branch && $l<$max_display_level){

                  $menu.= "<span onclick=\"Montrer('" . $numero . "', '" . $root . "')\" id='m".$numero."'><a href='javascript:void(0);'><img id='i".$numero."' src='".$img_expanded."'/></a>";
                  //$menu.= "<span onclick=\"Montrer('".$numero."')\" id='m".$numero."'><a href='javascript:void(0);'><img id='i".$numero."' src='".$img_expanded."'/></a>";
                } else {
                  $menu.= "<span onclick=\"Montrer('" . $numero . "', '" . $root . "')\" id='m".$numero."'><a href='javascript:void(0);'><img id='i".$numero."' src='".$img_expandable."'/></a>";
                  //$menu.= "<span onclick=\"Montrer('".$numero."')\" id='m".$numero."'><a href='javascript:void(0);'><img id='i".$numero."' src='".$img_expandable."'/></a>";
                }
              } else {
                //$menu.= "<span>debspan3<img src='".$img_default."'>";
                $menu.= "<span><img src='../images/closed.gif'>";
                //$menu.= "<span>";
              }

              $menu.= "</span>&nbsp;&nbsp;<a href='".$_SERVER['PHP_SELF']."?folder=".urlencode($current_folder)."#selection'>".htmlentities($c_folder_elems[$l-1])."</a>\n";

              // page list when the folder is selected
              if ($folder == $current_folder) {
                $menu .= $listePages;
              }


              $menu.= "</li>";

              $old_l = $l;
            } // foreach
            echo $menu;
?>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="label"><a name="url">URL:</a></td>
    </tr>
    <tr>
      <td><input type="text" id="f_href" style="width: 100%" /></td>
    </tr>
    <tr>
      <td valign="top">
        <div style="text-align: right;">
          <button type="button" name="ok" onclick="return onOk();">OK</button>
          <button type="button" name="cancel" onclick="return onCancel();">Cancel</button>
        </div>
        <!--<hr style="clear:left;"/>-->
      </td>
    </tr>

    <tr><td ></td></tr>
    </table>
  </body>
</html>
