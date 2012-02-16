<?php
  if (!isset($_SESSION)) {
    session_start();
  }
  require_once dirname(__FILE__).'/wk_config.php';
  require_once dirname(__FILE__).'/lib/Wiki.php';
  require_once dirname(__FILE__).'/lib/Wiki_User.php';
  require_once dirname(__FILE__).'/lib/Wiki_History.php';

  // Get the HTTP root of the wiki from config, if not defined before
  if(!isset($wkHTTPPath)){
    $wkHTTPPath = Wiki::getConfig('wkHTTPPath');
  }
  if(!isset($wkHTTPSPath)){
    $wkHTTPSPath = Wiki::getConfig('wkHTTPSPath');
    if ($wkHTTPSPath == false ) {
      $wkHTTPSPath = $wkHTTPPath;
    }
  }

  global $WK;

  $changer = $wkHTTPSPath . $WK['systemDir'] . '/form/wk_changer_profil.php' ;

  // retrieve the current page
  // better is the HTTP_REFERER
  // otherwise the $_GET should be hard-coded in the page (to avoid),
  // so not very good, if page has been moved by hand to another folder
  if (isset($_SERVER['HTTP_REFERER'])) {
    if (strrpos($_SERVER['HTTP_REFERER'],'/')==(strlen($_SERVER['HTTP_REFERER'])-1)) {
      $_SERVER['HTTP_REFERER'].= 'index.html';
    }
    $filepath = str_replace($wkHTTPPath,'',$_SERVER['HTTP_REFERER']);
    $filepath = str_replace($wkHTTPSPath,'',$filepath);
    $filepath = urldecode($filepath);
  } elseif (isset($_GET['fichier'])) { // deprecated
    $filepath = urldecode($_GET['fichier']);
    $filepath = str_replace($wkHTTPPath,'',$filepath);
    $filepath = str_replace($wkHTTPSPath,'',$filepath);
  } else  { // no page available
    error_log("EXIT no refering page");
    exit();
  }
  // QQQ filepath should be validated to be legal wiki page...

  // This either gets us a registered user or a guest
  $user = Wiki_User::currentUser();

  // Make some cleanup
  $filepath = preg_replace('/\?.*/','',$filepath); // query strings deleted
  $filepath = '/'.ltrim($filepath,'/');
  $folder_path  = dirname($filepath);
  //WIN32 : strange behaviour on win32, dirname transform / to \ when just /
  if($folder_path == "\\" || $folder_path == "%5F")
    $folder_path = '/';

  // Find the most recent modifier
  $newest = "";
  $entry = Wiki_PageDir::findByPath($filepath);
  if (!is_object($entry)) {
    $entry = Wiki_PageDir::createEntry($filepath);
    if (is_object($entry)) {
      $res = Wiki_History::record_entry_by_seq($entry->seq(), "INITIAL VIEW", "");
    }
  }
  if (is_object($entry)) {
    // History is sorted by newest to oldest
    $history = Wiki_History::findBySeq($entry->seq());
    if ($history !== false) {
      $newest = array_shift($history);
      $newest = WK_MODIFIED . strftime("%c", $newest->when()) . WK_BY . $newest->who();
      $newest = "<a href='"  . $wkHTTPPath . "_wk/wk_history.php?seq=" . $entry->seq() . "'>" . $newest . "</a>";
    // $header_content = str_replace('{MAP_LINK}',$wkHTTPPath.'_wk/wk_liste.php?folder='.$folder_path,$header_content);
    }
  }
  $filename = basename($filepath);

  // Make the railroad of links from Wiki home to parent folders of the file
  $html_folders_link = '<a href="'.$wkHTTPPath.'">'.WK_LABEL_HOME_WIKI.'</a> &gt; ';

  if (strlen($folder_path)>1) { // more than the root folder
    $folders = explode('/',ltrim($folder_path,'/'));
    // add link to parent folders
    $concat_folders = $wkHTTPPath;
    foreach($folders as $folder){
      $liste_1[] = Wiki_Strings::url_encode($folder.'/');
      $concat_folders.= Wiki_Strings::url_encode($folder.'/');
      $liste_2[] = '<a href="'.$concat_folders.'">'.$folder.'</a>&nbsp;&gt;&nbsp;';
    }

    //posting of the last two bonds if the way is higher than 2
    if (sizeof($liste_1)>2) {
      $concat_folders .= $liste_1[sizeof($liste_1)-2];
      $concat_folders .= $liste_1[sizeof($liste_2)-1];
      $html_folders_link.=" ... > ";
      $html_folders_link.= $liste_2[sizeof($liste_1)-2];
      $html_folders_link.= $liste_2[sizeof($liste_2)-1];
    } else {
      $concat_folder.= $liste_1[0];
      $html_folders_link.= $liste_2[0];
      if (sizeof($liste_1)== 2) {
        $concat_folder.= $liste_1[1];
        $html_folders_link.= $liste_2[1];
      }
    }
  }

  // Folder Pages listing
  $ar_pages = Wiki::listPages($folder_path);
  // make a select list
  $html_select = '<select class="selectHeight" name="menu1" onChange="MM_jumpMenu(\'parent\',this,0)">';
  foreach($ar_pages as $page) {
    // current page Locked ?
    // by another user ?
    $pagename = '/'.ltrim($page['name'],'/');
    if (($folder_path.$pagename == $filepath) && ($page['locked'] == true) && ($_COOKIE['nom']!= $page['user']) ) {
      $modified_by = WK_LABEL_FILE_MODIFIED_BY;
      $modified_by.= $page['user'];
    }
    // html for current page
    $display_name = preg_replace('/\.html$/','',$page['name']); // delete html extension
    if ($display_name == 'index') {
      $display_name = WK_LABEL_DIR_INDEX_ALIAS;
    }
    $selected = ($page['wk_url']==$filepath) ? 'selected="selected"' : '';

    $db=Wiki_DB::getInstance();
    $requeteBis="SELECT pages_nom FROM ".Wiki::getConfig('table_pages').
                " WHERE pages_nom LIKE 'PROTECT-{$page['wk_url']}' && pages_temps='2'";
    $resBis=$db->query($requeteBis);

    if ( $user->privileged()) {
      if ($resBis) {
        $html_select.= '<option value="'.$wkHTTPPath.$page['encoded_url'].'" '.$selected.' class="grey">'.$display_name.'</option>';
      } else {
        $html_select.= '<option value="'.$wkHTTPPath.$page['encoded_url'].'" '.$selected.'>'.$display_name.'</option>';
      }
    } else {
      if (!$resBis) {
        $html_select.= '<option value="'.$wkHTTPPath.$page['encoded_url'].'" '.$selected.'>'.$display_name.'</option>';
      }
    }
  }

  $html_select.= '</select>';

  // Content of header template
  $header_content = implode('',file(Wiki::getConfig('wkPath').Wiki::getConfig('templatesSystemDir').'/page_body_header.tpl'));
  // Parse the content
  $header_content = str_replace('{MAP_LINK}',$wkHTTPPath.'_wk/wk_liste.php?folder='.$folder_path,$header_content);
  $header_content = str_replace('{MAP}',WK_LABEL_FOLDER_MAP,$header_content);
  if(isset($modified_by)) {
    $header_content = str_replace('{EDIT_LINK}','#',$header_content);
    $header_content = str_replace('{EDIT}',$modified_by,$header_content);
  } else {
    $requete="SELECT * FROM ".Wiki::getConfig('table_pages')." WHERE pages_nom LIKE 'PROTECT-{$filepath}' ";
    $res=$db->query($requete);

    $NOMpage="PROTECT-".$filepath;

    if ($user->privileged()) {
      if (!$user->rights('editFiles') || ($res[0]['pages_nom']==$NOMpage &&  ($res[0]['pages_temps']=="1"))) {
        $header_content = str_replace('{EDIT_LINK}',$wkHTTPPath.'_wk/wk_edition.php?page='.Wiki_Strings::url_encode($filepath),$header_content);
        $header_content = str_replace('{EDIT}', WK_LABEL_EDIT_PAGE_NO_WRITE_ADMIN, $header_content);

      } else if (($res[0]['pages_nom']==$NOMpage) && ($res[0]['pages_temps']=="2")) {
        $header_content = str_replace('{EDIT_LINK}',
                                      $wkHTTPPath.'_wk/wk_edition.php?page='.Wiki_Strings::url_encode($filepath),
                                      $header_content);
        $header_content = str_replace('{EDIT}',
                                      WK_LABEL_EDIT_PAGE . "&nbsp;&nbsp;<img src='$wkHTTPPath" .
                                                           "_wk/images/deuxCadenas.png' alt='".
                                                           WK_LABEL_EDIT_PAGE_IMG .
                                                           "' title='" .
                                                           WK_LABEL_EDIT_PAGE_IMG."'>",
                                      $header_content);

      } else {
        $header_content = str_replace('{EDIT_LINK}',
                                       $wkHTTPPath.'_wk/wk_edition.php?page='.Wiki_Strings::url_encode($filepath),
                                       $header_content);
        $header_content = str_replace('{EDIT}',
                                      WK_LABEL_EDIT_PAGE,
                                      $header_content);

      }
    } else { //if not admin
      if (!$user->rights('editFiles') || ($res[0]['pages_nom'] &&  ($res[0]['pages_temps']=="1"))) {
        $header_content = str_replace('{EDIT_LINK}','',$header_content);
        $header_content = str_replace('{EDIT}',"<span id='notLink'>".WK_LABEL_EDIT_PAGE_NO_WRITE."</span>",$header_content);
      } else {//read and write
        $header_content = str_replace('{EDIT_LINK}',$wkHTTPPath.'_wk/wk_edition.php?page='.Wiki_Strings::url_encode($filepath),$header_content);
        $header_content = str_replace('{EDIT}',WK_LABEL_EDIT_PAGE,$header_content);
      }
    }
  }

  $header_content = str_replace('{RAILROAD}',
                                $html_folders_link.$html_select,
                                $header_content);
  // avoid javascript errors, with line breaks
  $header_content = str_replace("\n","",$header_content);
  $header_content = str_replace("\r","",$header_content);

  if (!$user->is_guest()) {

    $name = $user->user_name();

    if ($user->privileged()) {
      $header_content = str_replace('{CONNECT_INDIC}',
                                    "<a href='$changer'>" .
                                          "<img src='$wkHTTPPath" .
                                          "_wk/images/perso_jaune.gif'>" .
                                          $name .
                                          "</a>",
                                      $header_content);
      } else {
        $header_content = str_replace('{CONNECT_INDIC}',
                                      "<a href='$changer'>" .
                                          "<img src='$wkHTTPPath" .
                                          "_wk/images/perso_bleu.gif'>" .
                                          $name .
                                          "</a>",
                                      $header_content);
      }

      if (!isset($WK['email']) || $WK['email'] == 'smtp') {
        // do the user monitors this page already ?
        $db = Wiki_DB::getInstance();
        $sql_get_monitordedPages = "SELECT * FROM `".Wiki::getConfig('table_pages')."` ".
                                   "WHERE pages_nom='" . $db->escape_string('MONITOR-' . $filepath) . "'" .
                                   " AND pages_utilisateur='" . $db->escape_string($_SESSION['user_name']) . "' ;";

        //if($db->query($sql_get_monitordedPages)) $header_content = str_replace('{MONITORING_SUBSCRIPTION}', "OUI" ,$header_content); else $header_content = str_replace('{MONITORING_SUBSCRIPTION}', "NON",$header_content);
        if ($db->query($sql_get_monitordedPages)) {
          $header_content = str_replace('{MONITORING_SUBSCRIPTION}',
                                        "<a href='$wkHTTPPath" .
                                            "_wk/form/wk_monitor.php?stopmonitoring=1&page=" .
                                            Wiki_Strings::url_encode($filepath) .
                                            "'><img src='$wkHTTPPath" .
                                            "_wk/images/eyes_open2.gif'  alt='" .
                                            WK_MONITORING_MONITOR_STOP_ALT .
                                            "' title='" .
                                            WK_MONITORING_MONITOR_STOP_ALT . "'></a>",
                                        $header_content);
        } else { // he do not monitor the page
          $header_content = str_replace('{MONITORING_SUBSCRIPTION}',
                                        "<a href='$wkHTTPPath" .
                                            "_wk/form/wk_monitor.php?monitor=1&page=" .
                                            Wiki_Strings::url_encode($filepath) .
                                            "'><img src='$wkHTTPPath" . "_wk/images/eyes_closed.gif' alt='" .
                                            WK_MONITORING_MONITOR_START_ALT .
                                            "' title='" .
                                            WK_MONITORING_MONITOR_START_ALT .
                                            "' ></a>",
                                        $header_content);

        }
       // he can warn other users that he made some changes on the page
       $header_content = str_replace('{MONITORING_WARN}',
                                     "<a href='$wkHTTPPath" .
                                         "_wk/form/wk_monitor.php?warn=1&page=" .
                                         Wiki_Strings::url_encode($filepath) .
                                         "'><img src='$wkHTTPPath" .
                                         "_wk/images/warn.gif' alt='" .
                                         WK_MONITORING_MONITOR_WARN_ALT .
                                         "' title='" .
                                         WK_MONITORING_MONITOR_WARN_ALT .
                                         "' ></a>",
                                     $header_content);

      } else {
        $header_content = str_replace('{MONITORING_SUBSCRIPTION}', '', $header_content);
        $header_content = str_replace('{MONITORING_WARN}', '', $header_content);
      }

  } else {

    $href_guest = "<a href='$changer'" .
                      " alt='".
                      WK_ETIQUETTE_GUEST.
                      "' title='".
                      WK_ETIQUETTE_GUEST.
                      "'><img src='$wkHTTPPath" .
                        "_wk/images/perso_gris.gif'>" .
                      WK_LABEL_GUEST .
                      "</a>" ;
    $href_are_you = $href_guest .
                      "&nbsp;(<a href='$changer?fillform=1'>" .
                      WK_LABEL_AREYOU .
                      "&nbsp;" ;
    $cookieNom = Wiki_User::nameFromCookie();
    if ($cookieNom != '') {

      $header_content = str_replace('{CONNECT_INDIC}',
                                    $href_are_you .  $cookieNom .  "?</a>)",
                                    $header_content);
    } else {
      //only display "guest"
      $header_content = str_replace('{CONNECT_INDIC}',
                                    $href_guest,
                                    $header_content);
    }

    //monitoring and warning feature is not available to guests but he can login
    // Assuming warning feature is enabled.

    if (!isset($WK['email']) || $WK['email'] == 'smtp') {
      $header_content = str_replace('{MONITORING_SUBSCRIPTION}',
                                    "<a href='$changer'>" .
                                        "<img src='$wkHTTPPath" .
                                        "_wk/images/eyes_grey2.gif' alt='" .
                                        WK_MONITORING_MONITOR_START_GUESTALT .
                                        "' title='".
                                        WK_MONITORING_MONITOR_START_GUESTALT .
                                        "'></a>",
                                    $header_content);
      $header_content = str_replace('{MONITORING_WARN}',
                                    "<a href='$changer'>" .
                                        "<img src='$wkHTTPPath" .
                                        "_wk/images/warn_grey.gif' alt='" .
                                        WK_MONITORING_MONITOR_WARN_GUESTALT .
                                        "' title='" .
                                        WK_MONITORING_MONITOR_WARN_GUESTALT .
                                        "'></a>",
                                    $header_content);
    } else {
      $header_content = str_replace('{MONITORING_SUBSCRIPTION}', '', $header_content);
      $header_content = str_replace('{MONITORING_WARN}', '', $header_content);
    }
  }
  $header_content = str_replace('{HISTORY}', $newest, $header_content);
?>
//<script>

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function buildHeader() {
  var header_id = 'entete';
  header = (document.all) ? document.all(header_id) : (document.getElementById) ? document.getElementById(header_id) : '';
  if(header != null && header != '') {
    header.innerHTML = '<?php echo str_replace("'","\\'",$header_content); ?>';
  } else {
    if(header != ''){ // DOM methods available
      // retry until div 'header' is available (page loaded)
      setTimeout("buildHeader()",100);
    } else {
      // browser too old
    }
  }
}
buildHeader();
