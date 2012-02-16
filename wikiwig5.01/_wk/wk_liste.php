<?php
  // require_once 'wk_identification.php';
  require_once 'wk_config.php';
  require_once 'wk_protect.php';

  require_once 'lib/Wiki.php';
  require_once 'lib/Wiki_User.php';

  if (!isset($_SESSION)) {
    session_start();
  }
  if (isset($WK['wkHTTPSPath'])) {
    $changer = $WK['wkHTTPSPath'];
  } else {
    $changer = $WK['wkHTTPPath'];
  }
  $changer .= $WK['systemDir'] . '/form/wk_changer_profil.php' ;

  // This either gets us a registered user or a guest
  $user = Wiki_User::currentUser();
  $name = $user->user_name();

  // Retrieves the current folder from the GET
  // compat with the name dossier
  if (isset($_GET['dossier']) && !isset($_GET['folder'])) {
    $_GET['folder'] = $_GET['dossier'];
  } elseif(!isset($_GET['folder'])) {
    $_GET['folder'] = '/';
  }
  // Format the given folder
  $folder = urldecode($_GET['folder']);
  if ($folder!='/') {
    $folder = '/'.trim($folder,'/').'/';
  }
  // No filesystem traversal!
  while (strpos($folder, "..") !== false) {
    $filename = str_replace('..', '', $filename);
  }

  // Retrieves the sort variable from GET
  if (isset($_GET['order_by'])) {
    switch ($_GET['order_by']) {
      case 'name':
      case 'size':
      case 'date':
        $order_by = $_GET['order_by'];
        break;
      default:
        $order_by = 'name';
    }
  } else {
    $order_by = 'name';
  }
  if (isset($_GET['order_way'])) {
    switch ($_GET['order_way']) {
      case 0:
      case 1:
        $order_way = $_GET['order_way'];
        break;
      default:
        $order_way = 0;
    }
  } else {
    $order_way = 0;
  }

  // retrieves the current sort
  $order_way = (isset($_GET['order_way'])) ? $_GET['order_way'] : 0;

  // Sort Images
  $tpl_image_order  = '<img src="images/fleche-%s.gif" />';
  $img_order  = sprintf($tpl_image_order,($order_way == 1) ? 'haut' : 'bas');

  $ar_pages = Wiki::listPages($folder,$order_by,$order_way);
  // $user_rights = Wiki::getUserRights();

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title><?php echo WK_LABEL_WIKI_MAP; ?> : <?php echo $folder; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <script language="JavaScript" src="js/ajaxChat.js"></script>
    <script language="JavaScript" src="js/domUtils.js"></script>
    <script language="JavaScript" src="js/tooltip.js"></script>
    <script language="JavaScript" src="js/dreamweaver.js"></script>
    <script language="JavaScript" src="js/liste.js"></script>

    <script language="JavaScript">
        window.onload = init("<?php echo $WK['wkHTTPPath'] . $WK['systemDir']?>");

        function popupcentre( page,largeur,hauteur,options) {
          var top=(screen.height-hauteur)/2;
          var left=(screen.width-largeur)/2;
          window.open(page,"","top="+top+",left="+left+",width="+largeur+",height="+hauteur+","+options);
        }
    </script>
    <link href="wk_style.css?refresh=<?php echo rand(5,4545464); ?>" rel="stylesheet" type="text/css">
  </head>
  <body>
    <!-- CONNECTION INDICATOR -->
    <div id="header">
      <!--<a href="#" title="WK">WKW</a> |-->
      <!--<div id="message"></div>      -->
      <a href='<?php echo $changer ?>'>
<?php
        // We always have a user

        if ($user->is_guest()) {
          echo "&nbsp;<img src='images/perso_gris.gif'>";
          $cookieNom = Wiki_User::nameFromCookie();
          if ($cookieNom != '') {
            $are_you = "<a href='$changer' alt='".
                         WK_ETIQUETTE_GUEST.
                         "' title='".
                         WK_ETIQUETTE_GUEST.
                         "'>" .
                         WK_LABEL_GUEST .
                         "</a>&nbsp;(<a href='$changer?fillform=1'>" . WK_LABEL_AREYOU . "&nbsp;";

            echo $are_you . "&nbsp;" . $cookieNom . "?</a>)";
          } else {
            echo "<span alt='".WK_ETIQUETTE_GUEST."' title='".WK_ETIQUETTE_GUEST."'>".WK_LABEL_GUEST."</span>";
          }
        } else {
          if ($user->privileged()) {
            echo "&nbsp;<img src='images/perso_jaune.gif'>" . $name;
          } else {
            echo "&nbsp;<img src='images/perso_bleu.gif'>" . $name;
          }
        }

?>
      </a>
      <!--chat <span onclick='verifMesRep(this.value)'>Message lu ou pas</span>;-->
<?php
      if (isset($_GET['error_code'])) {
        echo '<span class="errors">'.(defined($_GET['error_code']) ? constant($_GET['error_code']) : WK_ERR_STANDARD).'</span>';
      }
?>
    </div>

    <!-- SideBar Folders Menu -->
    <div id="menu">
      <form name="foldersform" action="form/wk_folder_actions.php" method="POST" >
<?php
        if ($user->rights('deleteFolders') || $user->rights('moveFolders')) {
?>
          <input type="hidden" name="process" value="">
          <input type="hidden" name="warnondelete" value="1">
          <input type="hidden" name="deletemessage" value="<?php echo WK_LIST_WARN_ON_DELETE_FOLDER; ?>">
<?php
        }
?>
        <!-- Root of the wiki -->
        <div id="wikiroot" <?php if ($folder =='/') echo  'class="dirsel"'; ?>>
          <a href="wk_liste.php"><?php echo Wiki::getConfig('wkName'); ?></a>
        </div>

        <!-- Folders -->
<?php
        // images
        $img_default    = 'images/closed.gif';
        $img_expandable = 'images/dossier_plus.gif';
        $img_expanded   = 'images/open.gif';
        $img_selected   = 'images/closed.gif';

        if ($folder == '/') {
          $folder_elems = array();
        } else {
          $folder_elems = explode('/',trim($folder,'/'));
        }
        $max_display_level = count($folder_elems);

        //echo 'Dossier de la page : '.print_r($folder_elems,true).'<br/>';
        //echo 'Niveau max : '.$max_display_level.'<br/>';

        $folders_list = Wiki::listSubFolders('/');

        if ((count($folders_list) >= 5) && ($user->rights('deleteFolders') || $user->rights('moveFolders'))) {
?>
          <div class="toolsbar right">
<?php
            if ($user->rights('deleteFolders')) {
?>
              <button type="button" name="delete"
                      title="<?php echo WK_LIST_DELETE_FOLDER_TOOLTIP; ?>"
                      onclick="this.form.process.value='delete';this.form.submit();">
                <?php echo WK_LIST_DELETE_FOLDER; ?>
              </button>
<?php
            }
            if ($user->rights('moveFolders')) {
?>
              &nbsp;
              <button type="button"
                      name="move"
                      title="<?php echo WK_LIST_MOVE_FOLDER_TOOLTIP; ?>"
                      onclick="this.form.process.value='move';this.form.submit();">
                      <?php echo WK_LIST_MOVE_FOLDER; ?>
              </button>
<?php
            }
?>
          </div>
<?php
        } // if folder count >= 5

        $root = $WK['wkHTTPPath'] . $WK['systemDir'];
        $old="";
        $old_l=0;
        $nb=0;

        $menu = "";
        $sel_branch = false;

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
            if (isset($folder_elems[0]) && ($folder_elems[0] == $c_folder_elems[0]) ) {
              $sel_branch = true;
            }
          } elseif ($l > 0 && $l <= $max_display_level) { // child levels
            $ar_tmp_folder = array_slice ($folder_elems, 0, $l-1);
            $ar_tmp_current= array_slice ($c_folder_elems, 0, $l-1);
            if ($ar_tmp_folder == $ar_tmp_current) {
              $sel_branch = true;
            }
          }
          // UL Items management
          //////////////////////
          if ($l > $old_l) {
            for ($a=1; $a<=($l - $old_l); $a++) {
              if ($numero==0) { // first list
                $menu.='<ul id="s'.($numero-1).'">'."\n";
              } else { // sublists
                if ($sel_branch) {
                  $menu.='<ul style="display:block;" id="s'.($numero-1).'">'."\n";
                } else {
                  $menu.='<ul style="display:none;" id="s'.($numero-1).'">'."\n";
                }
              }
            } // for
            $nb = $nb + ($l - $old_l);
          } elseif ($l == $old_l) {

          } else {
            for ($a=1; $a<=($old_l - $l); $a++) {
              $menu.="</ul>\n";
            }
            $nb = $nb - ($old_l - $l);
          }

          // LI Items Management
          //////////////////////
          if ($folder == '/'.ltrim($current_folder,'/')) {
            $menu.= '<li class="dirsel">';
          } else {
            $menu.= '<li>';
          }

          if ($user->rights('deleteFolders') || $user->rights('moveFolders')) {
            $menu.= '<input type="radio" name="folder" value="'.$current_folder.'" class="check" />';
          }
          $menu.="&nbsp;";
          if (count(explode('/',trim(@$folders_list[$numero+1],'/'))) > $l) {
            if ($sel_branch && $l<$max_display_level) {
              $menu.= '<span onclick="Montrer(\''.$numero.'\', \'' . $root . '\')" id="m'.$numero.'">' .
                        '<a href="#" onclick="return false;">' .
                          '<img id="i'.$numero.'" src="'.$img_expanded.'"/>' .
                        '</a>';
            } else {
              $menu.= '<span onclick="Montrer(\''. $numero . '\', \'' . $root . '\')" id="m'.$numero.'">' .
                        '<a href="#" onclick="return false;">' .
                          '<img id="i'.$numero.'" src="'.$img_expandable.'"/>' .
                        '</a>';
            }
          } else {
            $menu.= '<span><img src="'.$img_default.'">';
          }
          $menu.= '</span>' .
                   '&nbsp;&nbsp;' .
                   '<a href="'.$_SERVER['PHP_SELF'].'?folder='.urlencode($current_folder).'">' .
                     htmlentities($c_folder_elems[$l-1]) .
                   '</a></li>'."\n";
          $old_l = $l;
        } // foreach folder

        for($a=1; $a<=$old_l; $a++) {
          $menu.="</ul>\n";
        }
        echo $menu;

        // Display the toolbar

        if ((count($folders_list) > 0) && ($user->rights('deleteFolders') || $user->rights('moveFolders'))) {
?>
          <div class="toolsbar right">
<?php
            if ($user->rights('deleteFolders')) {
?>
              <button type="button"
                      name="delete"
                      title="<?php echo WK_LIST_DELETE_FOLDER_TOOLTIP; ?>"
                      onclick="this.form.process.value='delete';this.form.submit();">
                <?php echo WK_LIST_DELETE_FOLDER; ?>
              </button>
<?php
            } // delete folders

            if ($user->rights('moveFolders')) {
?>
              &nbsp;
              <button type="button"
                      name="move"
                      title="<?php echo WK_LIST_MOVE_FOLDER_TOOLTIP; ?>"
                      onclick="this.form.process.value='move';this.form.submit();">
                <?php echo WK_LIST_MOVE_FOLDER; ?>
              </button>
<?php
            } // move folders
?>
            <br><br>
          </div> <!-- toolbars right -->
<?php
        }
?>
      </form> <!-- name="foldersform" -->
    </div>

    <!-- End of SideBar Menu -->

    <!-- Content -->
    <div id="content">
      <h1>
        <?php if ($folder == "/") echo Wiki::getConfig('wkName'); else echo basename($folder); ?>
      </h1>
      <form name="filelist" method="POST" action="form/wk_effacement_fichier.php">
        <input type="hidden" name="process" value="">
        <div class="toolsbar">
<?php
          if ($user->rights('deleteFiles') || $user->rights('moveFiles')) {
?>
            <div><h3><?php echo WK_LIST_SELECTALL; ?></h3></div>
            <input type="hidden" name="DEL" value="">
            <input type="hidden" name="FLG" value="">
            <input type="hidden" name="rep" value="<?php echo $folder; ?>">
            <input type="hidden" name="flags" value="">
<?php
            if ($user->rights('deleteFiles')) {
?>
              <!--<input type="hidden" name="process" value="">-->
              <input type="hidden" name="warnondelete" value="1">
              <input type="hidden" name="deletemessage" value="<?php echo WK_LIST_WARN_ON_DELETE_ALL_PAGES; ?>">
<?php
            }
          } // delete or move
?>

        </div> <!-- toolsbar -->

        <!-- Files Table -->
        <table id="datatable" cellspacing="0">
          <!-- Header -->
          <thead>
            <tr class="ligne">
              <th class="cel3" width=10>
<?php
                if ($user->rights('deleteFiles') || $user->rights('moveFiles')) {
?>
                  <input type="checkbox" id="selectallrows" name="toggleAll" title="<?php echo WK_LIST_SELECT_ALL_FILES; ?>">
<?php
                }
?>
              </th>
              <th>
              </th>
              <th class="cel3"><?php echo WK_LIST_READPROTECT; ?></th>

              <th class="cel3"><?php echo WK_LIST_WRITEPROTECT; ?></th>
              <th class="cel2">
                <img src="images/blank.gif" />
              </th>
              <th class="col<?php echo ($order_by == 'name')? 'Sort':''; ?>" >
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order_by=name&order_way=<?php if ($order_by == 'name') echo (!$order_way); ?>&folder=<?php echo $folder; ?>"><?php echo WK_LIST_TABLE_HEAD_FILE; ?>&nbsp;&nbsp;<?php if($order_by == 'name') echo $img_order; ?>
                </a>
              </th>

              <th class="col<?php echo ($order_by == 'size')? 'Sort':''; ?>" >
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order_by=size&order_way=<?php if ($order_by == 'size') echo (!$order_way); ?>&folder=<?php echo $folder; ?>"><?php echo WK_LIST_TABLE_HEAD_SIZE; ?>&nbsp;&nbsp;<?php if($order_by == 'size') echo $img_order; ?>
                </a>
              </th>

              <th class="col<?php echo ($order_by == 'date')? 'Sort':''; ?>" >
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order_by=date&order_way=<?php if ($order_by == 'date') echo (!$order_way); ?>&folder=<?php echo $folder; ?>"><?php echo WK_LIST_TABLE_HEAD_DATE; ?>&nbsp;&nbsp;<?php if($order_by == 'date') echo $img_order; ?>
                </a>
              </th>
            </tr> <!-- ligne -->
          </thead>

          <!-- Tbody -->
          <tbody>
<?php
            // Files Display
            //////////////////
            if (!empty($ar_pages)) {
              $index_page = 0;
              foreach($ar_pages as $k => $page) {
                $is_index = false;
                // Default properties
                $tr_class = '';
                $display_name = preg_replace('/\.html$/','',$page['name']); // delete html extension
                $delete_allowed = true;

                // Index special case
                if ($page['name']=='index.html') {
                  $is_index = true;
                  $tr_class = 'index';
                  $display_name = WK_LIST_INDEX_ALIAS;
                  $delete_allowed = false; // dont allow delete on this page
                }

                // Locks on pages
                if ( $page['locked'] ) { // page is locked
                  $db=Wiki_DB::getInstance();
                  $requete="SELECT * FROM ".Wiki::getConfig('table_pages').
                           " WHERE pages_nom LIKE '/{$page['encoded_url']}' OR pages_nom LIKE '%/{$page['encoded_url']}//-//%'";
                  $res=$db->query($requete);
                  if (isset($res[0]['pages_utilisateur'])) {
                    $nom =$res[0]['pages_utilisateur'];
                  } else {
                    $nom =WK_LABEL_GUEST;
                  }
                  if (isset($_SESSION['user_name'])) {
                    $img = '<img src="images/mod.gif"
                                 alt="'.WK_CHAT_TEASING.'"
                                 title="'.WK_CHAT_TEASING.'"
                                 onclick=\'javascript:popupcentre("wk_chat.php?a=form' .
                                                                              '&name='.$nom .
                                                                              '&page='.$page['url'] .
                                                                              '&emetteur='.$_SESSION['user_name'] . '",' .
                                                                  '500,'            .
                                                                  '300,'            .
                                                                  '"menubar=no,'    .
                                                                  'statusbar=no,'   .
                                                                  'scrollbars=no,'  .
                                                                  'toolbar=no,'     .
                                                                  'directories=no,' .
                                                                  'location=no")\' '.
                           '/>';
                  } else {
                    $img = '<img src="images/mod.gif" alt="'.WK_ETIQUETTE_TEASING.'" title="'.WK_ETIQUETTE_TEASING.'" />';
                  }

                  $mod = 'onmouseover="doTooltip(\''.WK_LIST_LOCKED_FILE.'\', \''.addslashes($nom).'\', event);" onmouseout="hideTip();"';
                  $delete_allowed = false; // dont allow delete on this page
                } else {
                  $img = '<img src="images/blank.gif" />';
                  $mod = '';
                  // check for write/read protection
                  $db=Wiki_DB::getInstance();
                  $requete ="SELECT * FROM ".Wiki::getConfig('table_pages').
                            "  WHERE pages_nom='PROTECT-/{$page['encoded_url']}' && (pages_temps='1' || pages_temps='2')";
                  $res=$db->query($requete);
                  if ($res) {
                    $delete_allowed = false; // dont allow delete on this page
                  }
                }
?>
                <tr class="<?php echo $tr_class; ?>">
                  <td class="cel3">
<?php
                    if (($user->rights('deleteFiles') || $user->rights('moveFiles') ) && $delete_allowed) {
?>

                      <input type="checkbox"
                              id="Mid[<?php echo $index_page ;?>]"
                              name="Mid[<?php echo $index_page ;?>]"
                              value="<?php echo $page['url']; ?>"
                              class="check"
                              title="<?php echo WK_LIST_SELECT_FILE; ?>">
<?php
                    } else {
                      echo '&nbsp;';
                    }
?>
                  <td>
                  </td>
                  </td>

<?php //lien actif or inactif
                  $db=Wiki_DB::getInstance();
                  $requete="SELECT * FROM ".Wiki::getConfig('table_pages')." WHERE pages_nom LIKE 'PROTECT-/{$page['encoded_url']}'";
                  $res=$db->query($requete);

                  $pre="PROTECT-/";
                  if (!empty($res[0]) ) {
                    $nomPage=split('-/',$res[0]['pages_nom']);
                  } else {
                    $nomPage="@@@@@@@@@@@@@@@@@";
                  }

                  if (is_object($user) && $user->privileged()) {
                    $v=& new Protect($page['url']);
                    $content = $v->affichage($page['encoded_url'], $index_page);
                    // $content .= "<form action='{$v->action}' method='POST'>";
                    $content .= "<td class='cel2' {$mod}> {$img}</td>";
                    $content .= "<td class='cel{($order_by == 'name')? 'Sort':''}' {$mod} >";
                    $content .= "<a href='../{$page['encoded_url']}'>{$display_name}</a>";
                    $content .= "</td>";
                    $content .= "<td class='cel{($order_by == 'size')? 'Sort':''}'>".Wiki_Strings::returnFileSize($page['size'])."</td>";
                    $content .= "<td class='cel{($order_by == 'date')? 'Sort':''}'>".date("d/m/Y@H:i:s",$page['date'])."</td>";
//                  $content .= "</tr>";
                    echo $content;
                  } else {
                    // Ordinary user
                    if ($nomPage[1]== $page['encoded_url']) {
                      if ($res[0]['pages_temps'] ==1) {
                        //echo " 1 ";
?>
                        <td>&nbsp;</td>
                        <td> <img src='images/cadenas.gif' alt='Verrouiller en ecriture' title='Verrouiller en ecriture'/></td>
                        <td class="cel2" <?php echo $mod; ?> > <?php echo $img; ?></td>
                        <td class="cel<?php echo ($order_by == 'name')? 'Sort':''; ?>" <?php echo $mod; ?> >
                          <a href="../<?php echo $page['encoded_url']; ?>"><?php echo $display_name; ?></a>
                        </td>
                        <td class="cel<?php echo ($order_by == 'size')? 'Sort':''; ?>"><?php echo Wiki_Strings::returnFileSize($page['size']); ?></td>
                        <td class="cel<?php echo ($order_by == 'date')? 'Sort':''; ?>"><?php echo date("d/m/Y@H:i:s",$page['date']); ?></td>
<?php
                      } else if ($res[0]['pages_temps'] ==2) {
                        //      echo " 2 " ;
?>
                        <td><img src='images/cadenas.gif' alt='Verrouiller en lecture' title='Verrouiller en lecture'/></td>
                        <td><img src='images/cadenas.gif' alt='Verrouiller en ecriture' title='Verrouiller en ecriture'/></td>
                        <td class="cel2" <?php echo $mod; ?> ><?php echo $img; ?></td>
                        <td class="cel<?php echo ($order_by == 'name')? 'Sort':''; ?>" <?php echo $mod; ?> >
                          <?php echo $display_name; ?>
                        </td>
                        <td class="cel<?php echo ($order_by == 'size')? 'Sort':''; ?>"><?php echo Wiki_Strings::returnFileSize($page['size']); ?></td>
                        <td class="cel<?php echo ($order_by == 'date')? 'Sort':''; ?>"><?php echo date("d/m/Y@H:i:s",$page['date']); ?></td>
<?php
                      } else {
                        // echo "0";
?>

                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="cel2" <?php echo $mod; ?> ><?php echo $img; ?></td>
                        <td class="cel<?php echo ($order_by == 'name')? 'Sort':''; ?>" <?php echo $mod; ?> >
                          <a href="../<?php echo $page['encoded_url']; ?>"><?php echo $display_name; ?></a>
                        </td>
                        <td class="cel<?php echo ($order_by == 'size')? 'Sort':''; ?>"><?php echo Wiki_Strings::returnFileSize($page['size']); ?></td>
                        <td class="cel<?php echo ($order_by == 'date')? 'Sort':''; ?>"><?php echo date("d/m/Y@H:i:s",$page['date']); ?></td>
<?php
                      }
                    } else {
                      // echo " 5 ";
?>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td class="cel2" <?php echo $mod; ?> ><?php echo $img; ?></td>
                      <td class="cel<?php echo ($order_by == 'name')? 'Sort':''; ?>" <?php echo $mod; ?> >
                        <a href="../<?php echo $page['encoded_url']; ?>"><?php echo $display_name; ?></a>
                      </td>
                      <td class="cel<?php echo ($order_by == 'size')? 'Sort':''; ?>"><?php echo Wiki_Strings::returnFileSize($page['size']); ?></td>
                      <td class="cel<?php echo ($order_by == 'date')? 'Sort':''; ?>"><?php echo date("d/m/Y@H:i:s",$page['date']); ?></td>
<?php
                    }
                  }
                  $index_page++;
?>
                </tr> <!-- class= $tr_class -->
<?php
              }
            } // $ar_pages not empty
?>
          </tbody>
        </table>

        <div class="toolsbar">
<?php
            if ($user->rights('deleteFiles')) {
?>
              <button type="button" name="delete"
                      title="<?php echo WK_LIST_DELETE_FILE_TOOLTIP; ?>"
                      onclick="this.form.process.value='delete';this.form.submit();">
                <?php echo WK_LIST_DELETE_FILE; ?>
              </button>
<?php
            }
?>
<?php
            // Change Read/Write access
            if (is_object($user) && $user->privileged()) {
?>
              &nbsp;
              &nbsp;
              &nbsp;
              <button type="button"
                      name="don "
                      title="<?php echo WK_LIST_RIGHT_TOOLTIP; ?>"
                      onclick="this.form.process.value='don';this.form.submit();">
                <?php echo WK_LIST_RIGHT; ?>
              </button>
<?php
            }
?>
            <div>
<?php
            if ($user->rights('moveFiles')) {
?>
              <button type="button"
                      name="move"
                      title="<?php echo WK_LIST_MOVE_FILE_TOOLTIP; ?>"
                      onclick="this.form.process.value='move';this.form.submit();">
                <?php echo WK_LIST_MOVE_FILE; ?>
              </button>
<?php
              }
?>
            </div>
            <div>
              <br />
<?php
              if ($user->rights('createFolders')) {
?>
                <a href="form/wk_folder_actions.php?folder=<?php echo $folder ?>"><?php echo WK_LIST_ADD_DIR; ?></a>
                &nbsp;|&nbsp;
<?php
              }
              if ($user->rights('createFiles')) {
?>
                <a href="form/wk_creation_fichier.php?folder=<?php echo $folder ?>"><?php echo WK_LIST_ADD_FILE; ?></a>
<?php
              }
?>
            </div>
        </div> <!-- toolbar -->
      </form> <!-- filelist -->
    </div> <!-- content -->

    <div id="vote">
      <!--HOTSCRIPTS-vote script !-->
      <form action="http://www.hotscripts.com/cgi-bin/rate.cgi" method="POST" target="_blank" name="hotscript">
        <table border="0" cellspacing="0" bgcolor="#999999" width="150" align="right">
          <tr>
            <td>
              <table border="0" cellspacing="0" width="100%" bgcolor="#EFEFEF" cellpadding="3">
                <tr>
                  <td align="center" bgcolor="#FFFFFF">
                    <strong><font size="1">promote WIKIWIG!</font></strong>
                    <font size="1">
                      <a href="http://www.hotscripts.com/Detailed/39026.html" target="_blank"><br> @ HotScripts.com</a>
                    </font>
                    <table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td align="center">
                          <input type="hidden" name="ID" value="39026">
                            <select name="ex_rate" size="1" style="font-size:10px; height:17px;" >
                              <option selected value="">[Select vote]</option>
                              <option value="5">Excellent!</option>
                              <option value="4">Very Good</option>
                              <option value="3">Good</option>
                              <option value="2">Fair</option>
                              <option value="1">Poor</option>
                            </select>
                          <input type="submit" value="Vote" style="font-size:11px; height:18px; " name="submit">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </form>
      <!--//end of HOTSCRIPTS-vote script !-->
    </div>
    <!-- End of Content -->
    <!-- Absolute Design Layers -->
    <!-- global nav menu -->
    <div id="adminlink">
<?php
      if (is_object($user) && $user->privileged()) {
 ?>
         <a href='wk_admin.php'><?php echo WK_LABEL_LINK_ADMIN; ?></a>
 <?php
      }
?>
    </div>
    <!-- logo -->
    <div id="logo">
      <img src="images/logo-petit.gif" onclick="window.open('<?php echo Wiki::getConfig('wikiwig_project_url'); ?>','_blank');return false;" />
    </div>
    <!-- tooltip -->
    <div id="tipDiv">
    </div>
  </body>
</html>
