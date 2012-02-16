<?php
  if (!class_exists('Dir'))
    require_once dirname(__FILE__).'/filesystem/Dir.php';
  if (!class_exists('File'))
    require_once dirname(__FILE__).'/filesystem/File.php';
  if (!class_exists('Wiki_Locker'))
    require_once dirname(__FILE__).'/Wiki_Locker.php';
  if (!class_exists('Wiki_User'))
    require_once dirname(__FILE__).'/Wiki_User.php';
  if (!class_exists('Wiki_Strings'))
    require_once dirname(__FILE__).'/Wiki_Strings.php';
  if (!class_exists('Wiki_Parser'))
    require_once dirname(__FILE__).'/Wiki_Parser.php';
  if (!class_exists('Wiki_PageDir'))
    require_once dirname(__FILE__).'/Wiki_PageDir.php';
  if (!class_exists('Wiki_History'))
    require_once dirname(__FILE__).'/Wiki_History.php';


  @define('WK_DIR_RIGHTS',0755);
  @define('WK_FILE_RIGHTS',0755);
  @define('WK_TPL_BASIC_PAGE','wk_basic_page.tpl');

  /**
   * Classe Globale du Wiki
   * Elle définit une interface de méthodes appelées par les différentes pages de
   * WikiWig. Toutes les actions du Wiki sont définies dans cette classe.
   *
   */
  class Wiki {
    var $errors   = array();

    /**
     * Constructor PHP 4
     * Call the <code>__construct</code> method.
     * View <code>__construct</code> method for details.
     */
    function Wiki(){$this->__construct();}
    /**
     * Constructor PHP 5
     */
    function __construct(){}

    // Configuration
    ////////////////
    function getConfig($var_name=false) {
      // defined vars
      global $WK;
      if ((isset($WK)) && (isset($WK[$var_name]))) {
        return $WK[$var_name];
      } else if (isset($WK)) {
        if ($var_name == 'reserved_dirnames') {
          $reserved_dirnames = array(Wiki::getConfig('systemDir'),
                                     Wiki::getConfig('trashDir'),
                                     Wiki::getConfig('efm_images_dir'),
                                     Wiki::getConfig('efm_files_dir'),
                                     Wiki::getConfig('backupDir'));
          // adding user defined dirs to hide
          $reserved_dirnames = array_merge($reserved_dirnames, Wiki::getConfig('hiddenDirs'));
          // make a strtolower on each element, to prepare further testing
          $reserved_dirnames = array_map('strtolower',$reserved_dirnames);
          return $reserved_dirnames;
        }
      } else {
        return false;
      }
    } //getConfig

    function getConfigVars() {
      global $WK;
      if (isset($WK)) {
        $ar_res = $WK;
        $ar_res[] = Wiki::getConfig('reserved_dirnames');
        return $ar_res;
      } else {
        $ar_empty = array();
        return $ar_empty;
      }
    }

    // Listings Files & Folders
    ////////////////////////////
      /**
       *
       */
      function listPages($folder,$order_by='name',$order_way=0) {
        $wkPath = Wiki::getConfig('wkPath');
        $folder = trim($folder,'/');
        $reserved_dirnames = array(); // empty, cos we are just listing files
        $folder_full_path = $wkPath.$folder;
        $ar_tmp = Dir::listDir($folder_full_path,2,1,$reserved_dirnames,'html');
        if (empty($ar_tmp))
            return $ar_tmp;

        // Lock System Infos
        // updates the current locks
        Wiki_Locker::updateLocks();
        // get the current locks
        $ar_locked_pages = Wiki_Locker::getLocks();

        $ar_pages = array();
        $ar_multisort_index = array();
        $index_page = array();
        $index_key = 0;
        // make the array of pages
        // with infos from each file
        // index page 'index.html' is a special case, and must not be included in array pages before ordering
        // because it is always put on top of the list, so should be treated as special case
        foreach($ar_tmp as $file){
          $file_wiki_name = '/'.ltrim(str_replace($wkPath,'',$file),'/');
          $page_locked = isset($ar_locked_pages[$file_wiki_name]);
          $user = ($page_locked) ? $ar_locked_pages[$file_wiki_name]['pages_utilisateur'] : '';
          $page = array( 'name'   => basename($file),
                         'url'    => ltrim($file_wiki_name,'/'),
                         'encoded_url' => Wiki_Strings::url_encode(ltrim($file_wiki_name,'/')),
                         'wk_url' => $file_wiki_name,
                         'size'   => filesize($file),
                         'date'   => filemtime($file),
                         'locked' => $page_locked,
                         'user'   => $user
                        );
          // special case: be nice with index.html
          if ($page['name'] == 'index.html'){
            $index_page = $page;
          } else {
            $ar_pages[$index_key++] = $page;
            // prepare the multisort array
            $ar_multisort_index[] = $page[$order_by];
          }
        } // foreach

        // Multisort
        if (!empty($ar_pages)) { // could be empty if only the index page
          // verification of order options
          if ($order_way == 1)
            $order_way = SORT_DESC;
          else
            $order_way = SORT_ASC;

          $allowed_orders = array('name','size','date');
          if (empty($order_by) && !in_array($order_by,$allowed_orders))
            $order_by = 'name';
          // order the array
          array_multisort($ar_multisort_index,$order_way,$ar_pages);
        }
        // Add index page properties
        if (!empty($index_page)){
          array_unshift($ar_pages,$index_page); // add index to top of pages
        }
        return $ar_pages;
      } // listPages

      /**
       * function
       */
      function listAllFolders($hidden_path=false, $hidden_folders=false) {
        $ar_folders = Wiki::listSubFolders('/',$hidden_path);
        array_unshift($ar_folders,'/');
        if (is_array($hidden_folders)) {
          $ar_folders = array_diff($ar_folders,$hidden_folders);
        }
        return $ar_folders;
      }
      /**
       *
       */
      function listSubFolders($folder,$hidden_path=false) {
        $wkPath = Wiki::getConfig('wkPath');
        $folder = trim($folder,'/');
        if (empty($folder)) { // in the root, special system and hidden folders should not be included
          $reserved_dirnames = Wiki::getConfig('reserved_dirnames');
        } else {
          $reserved_dirnames = array();
        }

        $folder_full_path = $wkPath.$folder;
        // get the list
        $ar_tmp = Dir::listDir($folder_full_path,1,0,$reserved_dirnames);
        if (empty($ar_tmp))
            return $ar_tmp;

        $ar_folders = array();
        // clean folder names and extract hidden path
        foreach($ar_tmp as $folder){
          $clean_folder_name = str_replace($wkPath,'',$folder).'/';
          if (($hidden_path !== false) && (strpos($clean_folder_name,$hidden_path) === 0)) {
            continue;
          }
          $ar_folders[] = $clean_folder_name;
        }
        sort($ar_folders);
        return $ar_folders;
      } // listSubFolders

      function &getTplContent($tpl_content_file_name=false) {
        $content = '';
          if (!empty($tpl_content_file_name) && $tpl_content_file_name!==false){
            $tpl_content_file_path = Wiki::getConfig('wkPath').Wiki::getConfig('templatesDir').'/'.$tpl_content_file_name;
            $content = File::read($tpl_content_file_path);
          }
        return $content;
      }

      // Pages
      /////////////////////
      function createPage($path, $filename, $content, $title=false, $overwrite=false) {
        $err = array();
        if ($path!='' && $path!='/')
          $full_path = Wiki::getConfig('wkPath').trim($path,'/').'/';
        else
          $full_path = Wiki::getConfig('wkPath');
        $clean_filename = Wiki_Strings::transliterate($filename);
        $clean_filename = Dir::cleanName($clean_filename);
        $file_path = $full_path.$clean_filename.'.html';

        // verify conditions to create file
        if (!@is_dir($full_path)) // dir not exists
          $err[] = sprintf(WK_ERR_DIR_NOT_EXISTS,$path);
        elseif(!Dir::isWritable($full_path)) // dir not writable
          $err[] = sprintf(WK_ERR_DIR_NOT_WRITABLE,$path);
        elseif(@is_file($file_path) && $overwrite === false) // file already exists
          $err[] = sprintf(WK_ERR_FILE_EXISTS,$clean_filename);
        elseif(empty($clean_filename))
          $err[] = sprintf(WK_ERR_FILE_BADNAME,$clean_filename);

        if (!empty($err))
          return $err;

        $entry = Wiki_PageDir::findByPath($file_path);
        if ($entry == false) {
          // new page
          $entry = new Wiki_PageDir();
          $entry->set_path($file_path);
          $entry->set_active(true);
          $res = $entry->insert();
        } else {
          if ($entry->active()) {
            // ACK DB is screwed up. File exists in DB and not in dir!
            // QQQ say something better
            $err[] = sprintf(WK_ERR_FILE_BADNAME,$clean_filename);
            return $err;
          }
          // A deleted file coming back to life
          $entry->set_active(true);
          $res = $entry->update();
        }
        // Did DB action succeed?
        if ($res !== true) {
          $err[] = $res;
          return $err;
        }
        $seq =  $entry->seq();
        $salt = 'giwikiw';
        // Be able to detect corruption of the sequence id.
        $seq = $seq . ":" . md5($salt . md5($seq . $salt));

        $tpl_file = Wiki::getConfig('wkPath').Wiki::getConfig('templatesSystemDir').'/'.WK_TPL_BASIC_PAGE;
        $tpl_content = File::read($tpl_file);
        if ($title===false)
          $title = $clean_filename;
        if ($tpl_content !== false){ // no pb to read template file

          $tpl_content = str_replace('{head_title}',$title,$tpl_content);
          $tpl_content = str_replace('{content_title}',$title,$tpl_content);
          $systemDirHTTPPath = Wiki::getConfig('wkHTTPPath').Wiki::getConfig('systemDir').'/';
          $tpl_content = str_replace('{CSS_HTTP_PATH}',$systemDirHTTPPath.'wk_dyn_pages.php?css',$tpl_content);
          $tpl_content = str_replace('{JS_HTTP_PATH}',$systemDirHTTPPath.'wk_dyn_pages.php?js',$tpl_content);
          $tpl_content = str_replace('{MAP}',WK_LABEL_FOLDER_MAP,$tpl_content);
          $tpl_content = str_replace('{MAP_LINK}',$systemDirHTTPPath.'wk_liste.php',$tpl_content);


          $tpl_content = str_replace('{SEQUENCE_ID}', "SEQ($seq)", $tpl_content);

          $tpl_content = str_replace('{content}',$content,$tpl_content);

        } else {
          $err[] = sprintf(WK_ERR_READ_TPL_FILE,$tpl_file_name);
        }
        $res = File::write($file_path,$tpl_content,WK_FILE_RIGHTS);
        if ($res === true) {
          // record_entry_by_path($path = '', $action = '', $comment = '', $user = false)
          $res = Wiki_History::record_entry_by_seq($entry->seq(), "CREATED", "");
        }
        return $res;
      } // createPage

      function updatePage($page_wiki_path,$new_content, $comment='') {
        $page_full_path    = Wiki::getConfig('wkPath').ltrim($page_wiki_path,'/');
        $page_full_content = File::read($page_full_path);
        $err =array();
        if ($page_full_content===false) {
          $err[] = sprintf(WK_ERR_FILE_READ,$page_wiki_path);
          return $err;
        }
        $new_full_content = Wiki_Parser::replaceContent($page_full_content,$new_content);
        // Make a backup
        Wiki::backupPage($page_wiki_path, "[ UPDATED: " . $comment . "]");

        // Writes the file
        //$err[] = $page_full_path . "debug (lign 261, lib/wiki.php)";
        //return $err;
        // error_log("UPD path: $page_wiki_path");
        if (!File::write($page_full_path,$new_full_content,WK_FILE_RIGHTS)) {
          $err[] = sprintf(WK_ERR_FILE_WRITE,$page_wiki_path);
          return $err;
        }
        // $res = Wiki_History::record_entry_by_path($page_wiki_path, "UPDATED", $comment);
        // if ($res !== true) {
          // return $res;
        // }
        return true;
      } // updatePage

      function readPage($page_wiki_path) {
        $page_full_path    = Wiki::getConfig('wkPath').ltrim($page_wiki_path,'/');
        $page_full_content = File::read($page_full_path);
        $err =array();
        if ($page_full_content===false) {
          $err[] = sprintf(WK_ERR_FILE_READ,$page_wiki_path);
          return $err;
        }
        return Wiki_Parser::getContent($page_full_content);
      } // readPage

      function deletePage($page_wiki_path, $comment='') {
        $wiki_dir = dirname($page_wiki_path);
        if ($wiki_dir == '\\' || $wiki_dir=='.' ) $wiki_dir = '';
        $page_full_path = Wiki::getConfig('wkPath').ltrim($page_wiki_path,'/');
        // verify page exists
        if (!@is_file($page_full_path)) {
          $err[] = sprintf(WK_ERR_FILE_NOT_EXISTS,$page_wiki_path);
          return $err;
        }

        $entry = Wiki_PageDir::findByPath($page_full_path);
        if ($entry === false) {
          // Bad error message
          $err[] = sprintf(WK_ERR_FILE_NOT_EXISTS,$page_wiki_path);
          return $err;
        }

        //FIXME: no verification on locked pages are made !!!!!!!!!!!
        // a fix have been set in the interface, locked pages not selectable for deletion,
        // but a POST Request to the delete page by a user with bad intentions can force the
        // deletion
        ///
        // $trash_dir_wiki_path = Wiki::getConfig('trashDir').'/'.ltrim($wiki_dir,'/');
        // $trash_dir_full_path = Wiki::getConfig('wkPath').$trash_dir_wiki_path.'/';
        // $trash_page_full_path = $trash_dir_full_path.basename($page_wiki_path);
        $trash_dir_full_path = Wiki::getConfig('wkPath') . Wiki::getConfig('trashDir') . "/";
        $fn = $entry->seq() . "_" . time();
        $trash_page_full_path = $trash_dir_full_path . $fn;
        error_log("trash $trash_page_full_path $fn");


        // create tree of directories in the trash dir
        // Dir::mkdirs($trash_dir_full_path,WK_DIR_RIGHTS);

        // copy to trash
        // backup
        @copy($page_full_path,$trash_page_full_path);
        // deletes File
        if (!@unlink($page_full_path)){
          $err[] = sprintf(WK_ERR_FILE_DELETE,$page_wiki_path);
          return $err;
        }
        $entry->set_active(false);
        $res = $entry->update();
        if ($res !== true) {
          // Bad error message
          $err[] = sprintf(WK_ERR_FILE_DELETE,$page_wiki_path);
          return $err;
        }
        $res = Wiki_History::record_entry_by_seq($entry->seq(), "DELETED", $comment);
        return true;
      } // deletePage

      function restoreFile($seq=false, $time=0, $num=0) {
        $entry = Wiki_PageDir::findBySeq($seq);
        if (!is_object($entry) || !ctype_digit($time) || !ctype_digit($num)) {
          return WK_RESTORE_BAD1;
        }
        $wiki_path = $entry->path();
        $res = Wiki::lockPage($wiki_path);
        if ($res !== true) {
          return $res;
        }
        $fn = $entry->seq() . "_" . $num;
        $backup_full_path = Wiki::getConfig('wkPath') . Wiki::getConfig('backupDir') . "/" . $fn;
        // error_log("RESTORE $backup_full_path");

        $page_full_content = File::read($backup_full_path);
        $err =array();
        if ($page_full_content===false) {
          $err[] = sprintf(WK_ERR_FILE_READ,$backup_full_path);
          return $err;
        }
        $page_full_content =  Wiki_Parser::getContent($page_full_content);
        $res = Wiki::updatePage($wiki_path, $page_full_content, "RESTORE $fn");
        if (is_array($res)) {
          $res = implode("<br>", $res);
        }
        if ($res === true) {
          $res = Wiki::unlockPage($wiki_path);
        }

        return $res;

      }

      function undeleteFile($seq=false, $time=0) {
        $entry = Wiki_PageDir::findBySeq($seq);
        if (!is_object($entry) || $entry->active()) {
          return WK_UNDELETE_BAD1;
        }
        $page_full_path    = Wiki::getConfig('wkPath').ltrim($entry->path(),'/');
        // error_log("UNDEL $page_full_path");

        $trash_dir_full_path = Wiki::getConfig('wkPath') . Wiki::getConfig('trashDir') . "/";
        $fn = $entry->seq() . "_" . $time;
        $trash_page_full_path = $trash_dir_full_path . $fn;
        // error_log("UNDEL $trash_page_full_path");

        if (@is_file($trash_page_full_path)) {
          @copy($trash_page_full_path, $page_full_path);
          if (!@unlink($trash_page_full_path)){
            $err[] = sprintf(WK_ERR_FILE_DELETE, $trash_page_full_path);
            return $err;
          }
          $entry->set_active(true);
          $res = $entry->update();
          $res = Wiki_History::record_entry_by_seq($entry->seq(), "UNDELETE", "$fn");
          return $res;
        } else {
          return WK_UNDELETE_BAD2;
        }
      }

      function backupPage($page_wiki_path,$comment ='', $permissions=WK_FILE_RIGHTS) {
        $wiki_dir = dirname($page_wiki_path);
        if ($wiki_dir == '\\') $wiki_dir = '/';
        $page_full_path   = Wiki::getConfig('wkPath').ltrim($page_wiki_path,'/');
        $entry = Wiki_PageDir::findByPath($page_full_path);
        if (!is_object($entry)) {
          return WK_BACKUP_BAD1;
        }
        $num = $entry->backup_id();
        $num++;
        if ($num > Wiki::getConfig('nbBackups')) {
          $num = 1;
        }
        // Encode the file name
        $fn = $entry->seq() . "_" . $num;
        // $backup_dir_wiki_path = Wiki::getConfig('backupDir').'/'.ltrim($wiki_dir,'/');
        // $backup_dir_full_path = Wiki::getConfig('wkPath').$backup_dir_wiki_path.'/';
        $backup_full_path = Wiki::getConfig('wkPath') . Wiki::getConfig('backupDir') . '/' . $fn;
        // error_log("BK $backup_full_path");

        // random number to tag the backup file
        // $no_bk = rand(1,Wiki::getConfig('nbBackups'));
        // $default_ext = '.html';
        // $backup_filename = substr(basename($page_wiki_path),0,-strlen($default_ext)).'_'.$no_bk.$default_ext;
        // $backup_page_full_path = $backup_dir_full_path.$backup_filename;

        // error_log("bu path: $page_wiki_path");
        if ($comment != '') {
          $comment = "FILE: $fn " . $comment;
        } else {
          $comment = "FILE: $fn ";
        }
        $res = Wiki_History::record_entry_by_path($page_wiki_path, "BACKUP", $comment);
        $entry->set_backup_id($num);
        $res = $entry->update();

        // create tree of directories in the backup dir
        // Dir::mkdirs($backup_dir_full_path,WK_DIR_RIGHTS);

        // backup
        // error_log("copy $page_full_path,$backup_full_path");
        @copy($page_full_path,$backup_full_path);
        // set permissions
        @chmod($backup_page_full_path,$permissions);
        return true;
      } // backupPage

      function movePage($old, $new) {
        // $old, $new are within the wiki
        $res = Wiki::lockPage($old);
        if ($res !== true) {
          return $res;
        }
        $old_page_full_path    = Wiki::getConfig('wkPath').ltrim($old,'/');
        $new_page_full_path    = Wiki::getConfig('wkPath').ltrim($new,'/');
        // error_log("mv: $old_p =>  $new_p");
        // error_log("mv: $old_page_full_path $new_page_full_path");
        $full_content = File::read($old_page_full_path);
        if ($full_content !== false) {
          $entry = Wiki_PageDir::findByPath($old_page_full_path);
          if ($entry === false) {
            Wiki::unlockPage($old);
            // Bad error message
            $err = sprintf(WK_ERR_FILE_NOT_EXISTS,$old_page_full_path);
            return $err;
          }
          $old_p = $entry->path();
          if (!File::write($new_page_full_path, $full_content,WK_FILE_RIGHTS)) {
            Wiki::unlockPage($old);
            $err = sprintf(WK_ERR_FILE_WRITE,$page_wiki_path);
            return $err;
          }
          if (!@unlink($old_page_full_path)){
            Wiki::unlockPage($old);
            $err = sprintf(WK_ERR_FILE_DELETE, $old);
            return $err;
          }
          $entry->set_path($new_page_full_path);
          $new_p = $entry->path();
          $res = Wiki_History::record_entry_by_seq($entry->seq(), "MOVED", "mv $old_p $new_p");
          $res = $entry->update();
          Wiki::unlockPage($old);
          return true;
        } else {
            $err = sprintf(WK_ERR_FILE_NOT_EXISTS,$old_page_full_path);
            return $err;
        }

      }

      function lockPage($page_wiki_path) {

        // For guests we invent a random name for the length of the session
        $user = Wiki_User::currentUser();
        if ($user->is_guest()) {
          if (isset($_SESSION['nom'])) {
            $username = $_SESSION['nom'];
          } else {
            $username = Wiki_Strings::genPass();
            $_SESSION['nom'] = $username;
          }
        } else {
          $username = $user->user_name();
        }

        // Lock System Infos
        // updates the current locks (i.e. deletes expired locks)
        Wiki_Locker::updateLocks();
        // get the current locks
        $ar_locked_pages = Wiki_Locker::getLocks();

        // if the page is already locked, and the user is not the same than the locker of the page
        // return errors

        $try_to_lock = true;
        if (isset($ar_locked_pages[$page_wiki_path])) {
          $locker = $ar_locked_pages[$page_wiki_path]['pages_utilisateur'];
          $try_to_lock = $username == $locker;
        }
        if ($try_to_lock) {
          // try to lock/reLock the page
          return Wiki_Locker::lockPage($page_wiki_path, $username);
        } else {
          // If a guest has a lock on the page then the name is a random name (supposedly) not in the db
          $locking_user = Wiki_User::findByUserName($locker);
          $page=split('/',$_GET['page']);
          $now = time();
          $dateBase = $ar_locked_pages[$page_wiki_path]['pages_temps'] + 600;
          $sec = $dateBase - $now ;
          $mn = $sec /60;
          $tps =substr($mn , 0,1);
          $err[]  =<<<EOT
<script language="JavaScript">
  function popupcentre( page,largeur,hauteur,options){
    var top=(screen.height-hauteur)/2;
    var left=(screen.width-largeur)/2;
    window.open(page,"","top="+top+",left="+left+",width="+largeur+",height="+hauteur+","+options);
  }

</script>
EOT;
          $back = '';
          if (isset($_SESSION['referer'])) {
            $back = str_replace("wk_edition.php?page=/", '', $_SESSION['referer']);
          }
          if ($back == '') {
            if (isset($_GET['page'])) {
              $back = $_GET['page'];
              // QQQ VERIFY
              $back = Wiki::getConfig('wkHTTPPath') .ltrim($back, "/");
            }
          }
          $msg = "<div id='header'><img src='" . Wiki::getConfig('wkHTTPPath') .
                   "_wk/images/edition.png'>  " .
                   WK_ERR_PAGE_ALREADY_EDITED_TITLE .
                   " &nbsp;&nbsp;<a href='{$back}'>" .  WK_LABEL_BACK ;

          // If either user is a guest there is no way to chat so forget about chat
          if (is_object($locking_user) && !$user->is_guest()) {
            $msg .= "</a>&nbsp;&nbsp;<a href=\"javascript:popupcentre('../_wk/wk_chat.php?a=form&name=" .
                      $locking_user->user_name() .
                      "&page=" .
                      $page[1] .
                      "&emetteur=" .
                      $user->user_name() .
                      "',500,300,'menubar=no,statusbar=no,scrollbars=no,toolbar=no,directories=no,location=no')\" id='imgLien'>" .
                      WK_CHAT_LIEN ;
          }
          $msg .= "</a></div>";
          $err[] = $msg;

          $err[] .= sprintf("<div id='err' > ".WK_ERR_PAGE_ALREADY_EDITED,Wiki::getConfig('wkHTTPPath').ltrim($page_wiki_path,'/'), $page_wiki_path);
          if (is_object($locking_user)) {
            $err[] .= WK_ERR_PAGE_ALREADY_EDITED_ONE . $locker . WK_ERR_PAGE_ALREADY_EDITED_2 .$tps . WK_ERR_PAGE_ALREADY_EDITED_3."</div>";
          } else{
            $err[] .=  $locker. WK_ERR_PAGE_ALREADY_EDITED_2 .$tps . WK_ERR_PAGE_ALREADY_EDITED_3."</div>";
          }
        return $err;
        }
      } //lockPage

      function unlockPage($page_wiki_path) {
        return Wiki_Locker::unlockPage($page_wiki_path);
      }

      // Templates
      //////////////////////////
      function getPageTemplates() {
        $tpl_dir_path = Wiki::getConfig('wkPath').Wiki::getConfig('templatesDir');
        $reserved_dirnames = array();
        $ar_tmp = Dir::listDir($tpl_dir_path,2,1,$reserved_dirnames,'html');
        for($i=0;$i<count($ar_tmp);$i++){
          $ar_tmp[$i] = basename($ar_tmp[$i]); // retrieve only the name of the file
        }
        return $ar_tmp;
      }

      // Parsing
      ////////////////////////////
      function parsePage($file_full_path) {
        // Page Full Content
        $file_full_content = File::read($file_full_path);
        $file_old_title = Wiki_Parser::getHeadTitle($file_full_content);
        $file_old_content = Wiki_Parser::getContent($file_full_content);

        // Update any old internal links
        // $foo = 'http://oreo/~steve/t1/wikiwig/';
        $reg = preg_replace('/http:..\w*/', '', Wiki::getConfig('wkHTTPPath'));
        $matches = ';<a href="' . $reg . ".*?>;";
        // echo $matches;
        // extract the internal links
        if (preg_match_all($matches, $file_old_content, $links)) {
          $links = $links[0];
          foreach($links as $l => $v) {
            // extract the filenames from the internal urls
            if (preg_match('/".*?html"/', $v, $url)) {
              $url = $url[0];
              $fn = "/" . str_replace('"', '', str_replace($reg, '', $url));
              $entry = Wiki_PageDir::findByPath($fn);
              if ($entry == false) {
                // old page prior to PageDir DB
                $entry = new Wiki_PageDir();
                $entry->set_path($fn);
                $entry->set_active(true);
                $res = $entry->insert();
                // Did DB action succeed?
                if ($res !== true) {
                  $err[] = $res;
                  return $err;
                }
              }
              $seq =  $entry->seq();
              $newurl = '"' . Wiki::getConfig('wkHTTPPath') . Wiki::getConfig('systemDir') . "/wk_lookup.php?seq=$seq" . '"';
              $file_old_content = str_replace($url, $newurl, $file_old_content);
            }
          }
        }

        //echo '<hr />'.$title.'<br/>';
        //echo $file_old_content.'<br/><hr />';
        //return true;

        $entry = Wiki_PageDir::findByPath($file_full_path);
        if (!is_object($entry)) {
          $entry = Wiki_PageDir::createEntry($file_full_path);
          if (!is_object($entry)) {
            $err[] = $entry;
            return $err;
          }
        }
        $seq =  $entry->seq();
        $salt = 'giwikiw';
        // Be able to detect corruption of the sequence id.
        $seq = $seq . ":" . md5($salt . md5($seq . $salt));

        // Template content
        $tpl_file = Wiki::getConfig('wkPath').Wiki::getConfig('templatesSystemDir').'/'.WK_TPL_BASIC_PAGE;
        $tpl_content = File::read($tpl_file);

        if ($tpl_content !== false){ // no pb to read template file
          $tpl_content = str_replace('{head_title}',$file_old_title,$tpl_content);
          $systemDirHTTPPath = Wiki::getConfig('wkHTTPPath').Wiki::getConfig('systemDir').'/';
          $tpl_content = str_replace('{CSS_HTTP_PATH}',$systemDirHTTPPath.Wiki::getConfig('css_wiki'),$tpl_content);
          $tpl_content = str_replace('{JS_HTTP_PATH}',$systemDirHTTPPath.'wk_dyn_pages.php?js',$tpl_content);
          $tpl_content = str_replace('{MAP}',WK_LABEL_FOLDER_MAP,$tpl_content);
          $tpl_content = str_replace('{MAP_LINK}',$systemDirHTTPPath.'wk_liste.php',$tpl_content);

          $tpl_content = str_replace('{SEQUENCE_ID}', "SEQ($seq)", $tpl_content);

          $tpl_content = Wiki_Parser::replaceContent($tpl_content,$file_old_content);
        } else {
          $err[] = sprintf(WK_ERR_READ_TPL_FILE,$tpl_file_name);
          return $err;
        }
        $res = File::write($file_full_path,$tpl_content,WK_FILE_RIGHTS);
        if ($res === true) {
          $res = Wiki_History::record_entry_by_seq($seq, "RECONSTRUCT", "");
        }
        return $res;
      } // parsePage

      function parseAllPages($dir='') {
        // list dirs
        $wkPath = Wiki::getConfig('wkPath');
        $dir = trim($dir,'/');
        $dir_full_path = $wkPath.$dir;
        $reserved_dirnames = Wiki::getConfig('reserved_dirnames');

        // get the list
        $files_list = Dir::listDir($dir_full_path,2,0,$reserved_dirnames,'html');
        $ar_results = array();
        if (!empty($files_list)) {
          foreach($files_list as $file_full_path) {
            $file_rel_path = str_replace($wkPath,'',$file_full_path);
            $dirname = dirname($file_rel_path);
            $filename = basename($file_rel_path);

            // Create the wk_local.php file if not exists (in case of an update from older versions of Wikiwig)
            $current_dir_full_path = dirname($file_full_path);
            /* // older version using wk_local.php files
            if (!@is_file($current_dir_full_path.'/wk_local.php')) {
              if ($current_dir_full_path.'/' == $wkPath) // special case : root dir
                Wiki::setFolderProperties(dirname($file_full_path).'/',$wkPath);
              else
                Wiki::setFolderProperties(dirname($file_full_path));
            } else {
              // override permission set to this file
              // coming from bug #1105140
              File::chmod($current_dir_full_path.'/wk_local.php',WK_FILE_RIGHTS);
            }
            */
            // rewrite the page
            $res_rewrite = Wiki::ParsePage($file_full_path);
            if ($res_rewrite) {
              //  echo 'OK '.$file_full_path.'<br/>';
              $ar_results[] = array(true,$file_rel_path);
            } else {
              //  echo 'NOK';
              $ar_results[] = array(false,$file_rel_path);
            }
          }
        }
        return $ar_results;
      } // parseAllPages

      // Folders
      /////////////////////
      /**
       * Creates a new folder in the wiki
       *
       */
      function createFolder($path='',$dirname) {
        $err = array();
        $full_path = Wiki::getConfig('wkPath').trim($path,'/').'/';
        $clean_dirname = Wiki_Strings::transliterate($dirname);
        $clean_dirname = Dir::cleanName($clean_dirname);

        $reserved_dirnames = Wiki::getConfig('reserved_dirnames');

        // verify conditions to create file
        if (!@is_dir($full_path)) // dir not exists
          $err[] = sprintf(WK_ERR_DIR_PARENT_NOT_EXISTS,$path);
        elseif(!Dir::isWritable($full_path)) // dir not writable
          $err[] = sprintf(WK_ERR_DIR_PARENT_NOT_WRITABLE);
        elseif(in_array(strtolower($clean_dirname),$reserved_dirnames)) // reserved name
          $err[] = sprintf(WK_ERR_DIR_BADNAME,$clean_dirname);
        // empty clean name
        elseif(empty($clean_dirname))
          $err[] = sprintf(WK_ERR_DIR_BADNAME,$clean_dirname);
        elseif(@is_dir($full_path.$clean_dirname)) // dir already exists
          $err[] = sprintf(WK_ERR_DIR_EXISTS,$clean_dirname);

        // there is error
        if (!empty($err)) {
          return $err;
        }
        // Create the directory
        if (!@mkdir($full_path.$clean_dirname,WK_DIR_RIGHTS)) {
          $err[] =  sprintf(WK_ERR_DIR_MAKE,$clean_dirname);
          return $err;
        }

        // create index file
        //....
        $err = Wiki::createPage($path.$clean_dirname,
                                'index',
                                '', // No content
                                $clean_dirname);
        // there is error
        if (is_array($err)) {
          return $err;
        } else
            $err = array(); // reinit err

        /* // older version using wk_local.php files
        if (!Wiki::setFolderProperties($full_path.$clean_dirname)) {
          $err[] = sprintf(WK_ERR_DIR_MAKE,$clean_dirname);
        }
        */
        // there is error
        if (!empty($err)) {
          return $err;
        }

        return $clean_dirname;
      } // createFolder

      /**
       * set to a folder the necessary properties files
       *
       *
       */
      function setFolderProperties($dir_full_path='',$wkPath=false) {
        if ($wkPath === false)
          $dir_rel_path = str_replace(Wiki::getConfig('wkPath'),'',$dir_full_path);
        else
          $dir_rel_path = str_replace($wkPath,'',$dir_full_path);

          $clean_path = trim($dir_rel_path,'/');
        if (!empty($clean_path))
          $nb_dirs = count(explode('/',$clean_path));
        else
          $nb_dirs = 0;

        $back_path = str_repeat('../',$nb_dirs);
        //echo 'Create Properties File of '.$dir_full_path.' Back_to_root='.$back_path.'<br />';
        // create local properties file
        // defines directory properties
        $props_file = <<<CONTENT
<?php
\$back_to_root = '$back_path';
@include_once \$back_to_root.'_wk/wk_dyn_pages.php';
?>
CONTENT;
        return File::write($dir_full_path.'/wk_local.php',$props_file,WK_FILE_RIGHTS);
      } // setFolderProperties

      /**
       * returns the parent folder in the wiki tree
       */
      function getParentFolder($folder) {
        if ($folder == '' ||  $folder == '/') // root folder
          return false;
        $parent_folder = dirname($folder);
        if ($parent_folder == '' || $parent_folder == '.')
          return '/';
        else
          return $parent_folder;
        $wkPath = Wiki::getConfig('wkPath');
        $folder_full_path = $wkPath.trim($folder,'/');
        if ($folder_full_path == $wkPath) // root folder
          return false;

        $folder_elems = explode('/',trim($folder,'/'));
        array_shift($folder_elems);
        if (empty($folder_elems))
          return '/';
        else
          return implode('/',$folder_elems);
      } // getParentFolder

      /**
       * Deletes a folder of the wiki
       *
       * @param string $wiki_dir fodler to move
       * @return mixed a boolean or an array of errors.
       */
      function deleteFolder($wiki_dir=false) {
        return Wiki::moveFolder($wiki_dir); // call with no target => delete
      }

      /**
       * Moves a folder of the wiki to another wiki folder
       * used by the trash process to delete folders. The inner system is to move
       * folder needed to delete to the trash folder, so similar to a move in the wiki tree.
       *
       * @param string $wiki_dir fodler to move
       * @param string $target_folder destination to where move the folder. If not set, will be moved to the trash dir. Equivalent to a delete call.
       * @return mixed a boolean or an array of errors.
       */
      function moveFolder($wiki_dir, $target_folder=false) {
        $err = array();
        if ($wiki_dir == '\\' || $wiki_dir=='.' || $wiki_dir == '/' || empty($wiki_dir) || $wiki_dir===false)
          $wiki_dir = '/';
        else
          $wiki_dir = '/'.trim($wiki_dir,'/').'/';

        $dir_full_path = Wiki::getConfig('wkPath').ltrim($wiki_dir,'/');

        $folder = trim($wiki_dir,'/');
        if (empty($folder)) { // in the root, special system and hidden folders should not be included
          $reserved_dirnames = Wiki::getConfig('reserved_dirnames');
        } else {
          $reserved_dirnames = Wiki::getConfig('hiddenDirs');
        }

        // get the list
        // error_log("listing: $dir_full_path");

        //echo 'start moving '.$dir_full_path;

        // check dir is not root folder
        if ($dir_full_path == Wiki::getConfig('wkPath')) { // root folder
          if ($target_folder===false)
            $err[] = sprintf(WK_ERR_DIR_DELETE_ROOT);
          else
            $err[] = sprintf(WK_ERR_DIR_MOVE_ROOT);
          return $err;
        }

        // checks dir exists
        if (!@is_dir($dir_full_path)) {
          $err[] = sprintf(WK_ERR_DIR_NOT_EXISTS,$wiki_dir);
          return $err;
        }

        // Check that no page is currently locked
        // Lock System Infos
        // updates the current locks
        Wiki_Locker::updateLocks();
        // get the current locks
        $ar_locked_pages = Wiki_Locker::getLocks();
        $locked_page_in_dir = false;
        foreach($ar_locked_pages as $k => $v) {
          if (substr($k,0,strlen($wiki_dir)) == $wiki_dir )
            $locked_page_in_dir = true;
        }

        if ($locked_page_in_dir) {
          if ($target_folder===false)
            $err[] = sprintf(WK_ERR_DIR_DELETE_LOCKS,$wiki_dir);
          else
          $err[] = sprintf(WK_ERR_DIR_MOVE_LOCKS,$wiki_dir);
          return $err;
        }

        //FIXME: no verification on locked pages are made !!!!!!!!!!!
        // a fix have been set in the interface, locked pages not selectable for deletion,
        // but a POST Request to the delete page by a user with bad intentions can force the
        // deletion
        ///
        if ($target_folder === false) { // no target => to trash
          //echo 'go to trash ';
          $trash_dir_wiki_path = Wiki::getConfig('trashDir').'/'.ltrim($wiki_dir,'/');
          $trash_dir_full_path = Wiki::getConfig('wkPath').rtrim($trash_dir_wiki_path,'/').'/';
          $target_full_path = $trash_dir_full_path;
          // create tree of directories in the trash dir
          Dir::mkdirs($trash_dir_full_path,WK_DIR_RIGHTS);
        } else {
          //echo 'move to  '.$target_folder;
          $target_full_path = Wiki::getConfig('wkPath').ltrim($target_folder,'/');
          // checks dir exists
          if (!@is_dir($target_full_path)) {
            $err[] = sprintf(WK_ERR_DIR_NOT_EXISTS,$target_dir);
            return $err;
          }
          // append the name of the folder to move
          $target_full_path.= basename($dir_full_path).'/';
          Dir::mkdirs($target_full_path,WK_DIR_RIGHTS);
        }

        //echo 'copy '.$dir_full_path.' vers '.$target_full_path.'<br />';

        // copy to target
        // backup
        if (Dir::copy($dir_full_path,$target_full_path)) {
          // $dir_full_path = Wiki::getConfig('wkPath').ltrim($wiki_dir,'/');
          $ar_tmp = Dir::listDir($dir_full_path, 2, 0, $reserved_dirnames, 'html');
          foreach ($ar_tmp as $value) {
            // $fn = str_replace(".html", '', str_replace(Wiki::getConfig('wkPath'), "/", $value));
            $entry = Wiki_PageDir::findByPath($value);
            if (is_object($entry)) {
              if ($target_folder === false) {
                $entry->set_active(false);
                $res = Wiki_History::record_entry_by_seq($entry->seq(), "DELETED", "Folder $folder deleted");
              } else {
                $newfn = str_replace($dir_full_path, $target_full_path, $value);
                // $newfn = str_replace(".html", '', str_replace(Wiki::getConfig('wkPath'), "/", $newfn));
                $oldfn = $entry->path();
                $entry->set_path($newfn);
                $newfn = $entry->path();
                // error_log("Rename: $fn -> $newfn");
                $res = Wiki_History::record_entry_by_seq($entry->seq(), "MOVED", "mv $oldfn $newfn; Folder $folder renamed");
              }
              $res = $entry->update();
              if ($res !== true) {
                $err[] = $res;
              }
            } else {
              // QQQ NEED BETTER ERROR msg
              $err[] = sprintf(WK_ERR_DIR_NOT_EXISTS,$fn);
            }
          }

          // delete from source
          $res = Dir::rmdir($dir_full_path);
        } else
          $res = false;
        return $res;
      } // moveFolder

  } // class Wiki

// Standalone testing
/*
$WK = array();
$WK['systemDir'] = '_wk';
$WK['trashDir']  = '_wk_trash';
$WK['uploadDir'] = '_wk_upload';
$WK['backupDir'] = '_wk_backup';
$WK['wkPath'] = 'C:/Julien/__projets__/___wikiwig___/__work__/wikiwig/wikiwig/';
echo '<h1>Fichiers de ce répertoire</h1><pre>'.print_r(Wiki::listPages('/','date'),true).'</pre>';
echo '<h1>Sous-Répertoires</h1><pre>'.print_r(Wiki::listSubFolders('/'),true).'</pre>';
*/
?>
