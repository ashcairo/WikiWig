<?php
  /*
   * Created on 30 nov. 2004
   */
  require_once '../compat.php';
  require_once  '../lib/Wiki_User.php';
  require_once  '../lib/Wiki_DB.php';


  // Global Vars
  $fs_separator = (substr(PHP_OS, 0, 3) == 'WIN') ? "\\" : "/" ;
  @define('OS_FILE_SEPARATOR',$fs_separator);
  umask(0000);
  $umask = 0775;

  /**
   * Extracts properties of a template file
   *
   */
  function setup_parseTemplate($tpl_file, $raw = false) {
    $config = array();

    $t = file($tpl_file, 1);
    for ($x=0; $x<count($t); $x++) {
      $l = $t[$x];
      $l = trim($l);

      if ($l != '') {
        switch ($l[0]) {

          // New Configure section
          case '/':
            if ($l[1] == '/') {
              $current = trim(substr($l, 2));
              $config['categories'][$current] = array();
            }
            break;

          case '#':
            $value =  trim(substr($l, 1));
            $config['descriptions'][$current] = (defined($value) ? constant($value) : $value); // find translation if constant used
            break;

          // A configure option
          case '$':
            // Grep out the name, type and default
            preg_match('#\{([^|]+\|[^|]+\|([^}]+)?)\}[^/]+/{2}(.+)#msi', $l, $match);
            $c    = explode('|', $match[1]);
            $cdef = setup_queryDefault($c[1], $c[3]);
            $config['categories'][$current][] = $configRaw[] = array(
                                            'longname'    => (defined($c[0]) ? constant($c[0]) : $c[0]), // find translation if constant used
                                            'name'        => $c[1],
                                            'type'        => $c[2],
                                            'default'     => $cdef,
                                            'distdefault' => $c[3],
                                            'desc'        => (defined(trim($match[3])) ? constant(trim($match[3])) : $match[3]) // find translation if constant used
                                          );
            break;
        } // switch
      }
    } // for

    if ($raw) {
      return $configRaw;
    } else {
      return $config;
    }
  } // setup_parseTemplate


/**
 * Search the default value of an input
 *
 */
function setup_queryDefault($optname, $default) {
  switch ($optname) {
    case 'wkPath':
      // Path 1
      $test_path1 = $_SERVER['DOCUMENT_ROOT'] . rtrim(dirname($_SERVER['PHP_SELF']), '/') . '/';
      $test_path1_elems = explode('/',$test_path1);
      array_pop($test_path1_elems); // parent to setup dir (wiki system dir)
      array_pop($test_path1_elems); // parent to wiki system dir
      $test_path1 = implode(OS_FILE_SEPARATOR,$test_path1_elems).OS_FILE_SEPARATOR;

      if (@file_exists($test_path1 . 'index.php')) {
        return $test_path1;
      } else { // maybe web server alias used
        // Path 2
        $test_path2 = dirname(__FILE__);
        $test_path2_elems = explode(OS_FILE_SEPARATOR,$test_path2);
        array_pop($test_path2_elems); // parent to setup dir (wiki system dir)
        array_pop($test_path2_elems); // parent to wiki system dir
        $test_path2 = implode(OS_FILE_SEPARATOR,$test_path2_elems).OS_FILE_SEPARATOR;
        return $test_path2;
        }
        break;
      case 'wkHTTPPath':
        $pathElements = explode('/',rtrim(dirname($_SERVER['PHP_SELF']),'/'));
        array_pop($pathElements); // parent to setup dir (wiki system dir)
        array_pop($pathElements); // parent to wiki system dir
        $path = implode('/',$pathElements);
        return 'http://'.$_SERVER['HTTP_HOST'].$path.'/';
        break;
      case 'lang' :
        global $WK; // to retrieve old config value, if set
        if (!empty($WK))
          return $WK['lang'];
        else
          return 'fr';
        break;
      case 'editFiles' :
      case 'renameFolders' :
      case 'renameFiles' :
      case 'moveFolders' :
      case 'moveFiles' :
      case 'deleteFolders' :
      case 'deleteFiles' :
      case 'restoreFiles' :
      case 'createFolders' :
      case 'createFiles' :
        global $WK;
        if (!empty($WK) && isset($WK['defaultRights']))
          return (isset($WK['defaultRights'][$optname])) ? $WK['defaultRights'][$optname] : $default;
        else
          return $default;
        break;
      case 'anon_editFiles' :
      case 'anon_renameFolders' :
      case 'anon_renameFiles' :
      case 'anon_moveFolders' :
      case 'anon_moveFiles' :
      case 'anon_deleteFolders' :
      case 'anon_deleteFiles' :
      case 'anon_restoreFiles' :
      case 'anon_createFolders' :
      case 'anon_createFiles' :
        global $WK;
        $optname = str_replace("anon_", '', $optname);
        if (!empty($WK) && isset($WK['anonRights']))
          return (isset($WK['anonRights'][$optname])) ? $WK['anonRights'][$optname] : $default;
        else
          return $default;
        break;
      default:
        return $default;
        break;
    } // switch
  }


  /**
   * Returns HTML Code for an input
   *
   */
  function setup_guessInput($type, $name, $value='', $default='') {
    $input_content = '';
    switch ($type) {
      case 'bool' :

        $value = ($value == 'true') ? true : (($value=='false') ? false : $value);
        $input_content.= '<input id="radio_cfg_' . $name . '_yes" type="radio" name="' . $name . '" value="true" ';
        $input_content.= (($value == true) ? 'checked="checked"' : ''). ' /><label for="radio_cfg_' . $name . '_yes"> ' . YES . '</label>&nbsp;';
        $input_content.= '<input id="radio_cfg_' . $name . '_no" type="radio" name="' . $name . '" value="false" ';
        $input_content.= (($value == true) ? '' : 'checked="checked"'). ' /><label for="radio_cfg_' . $name . '_no"> ' . NO . '</label>';

        break;

      case 'protected' :
        $input_content.= '<input type="password" size="30" name="' . $name . '" value="' . htmlspecialchars($value) . '" />';
        break;
      case 'list' :
        preg_match_all("/([^\=]+)\=\>([^\,]+)\,?/i", $default, $res);
        $input_content.= '<select name="'. $name .'">';
        for ($x=0; $x<sizeof($res[1]); $x++) {
          $pos = strpos($res[2][$x], 'WK_CONF');
          if ($pos !== false) {
            eval("\$foo = " . $res[2][$x] .";");
            $res[2][$x] = $foo;
          }
          $input_content.= sprintf('<option value="%s"%s>%s</option>'. "\n",
                                   $res[1][$x],
                                   (($res[1][$x] == $value) ? ' selected="selected"' : ''),
                                   $res[2][$x]);
        }
        $input_content.= '</select>';
        break;
      default :
        if (@is_array($value)) // for list of values, separated by ;
          $value = implode(';',$value);
        $input_content.= '<input type="text" size="30" name="' . $name . '" value="' . htmlspecialchars($value) . '" />';
        break;
    }
    return $input_content;
  }

  /**
   * Returns HTML Code for the config page
   *
   */
  function setup_sprintConfigTemplate($t, $from = false, $_abort = false) {

    ob_start();
?>

<script type="text/javascript" language="JavaScript">
  function showConfig(id) {
    if (document.getElementById) {
      el = document.getElementById(id);
      if (el.style.display == 'none') {
        document.getElementById('option' + id).src = 'images/minus.png';
        el.style.display = '';
      } else {
        document.getElementById('option' + id).src = 'images/plus.png';
        el.style.display = 'none';
      }
    }
  }

  var state='none';
  function showConfigAll(count) {
  if (document.getElementById) {
    for (i = 1; i <= count; i++) {
      document.getElementById('el' + i).style.display = state;
      document.getElementById('optionel' + i).src = '' + (state == '' ? 'images/minus.png' : 'images/plus.png');
    }

    if (state == '') {
      document.getElementById('optionall').src = 'images/minus.png';
      state = 'none';
    } else {
      document.getElementById('optionall').src = 'images/plus.png';
      state = '';
    }
    }
  }
</script>

<form action="?" method="POST">
  <div>
    <!--<input type="hidden" name="wikiwig[adminModule]" value="installer" />-->
    <input type="hidden" name="installAction" value="check" />
    <br />

    <div align="right">
      <a style="border:0; text-decoration: none" href="#"
          onclick="showConfigAll(<?php echo count($t['categories']); ?>)"
          title="<?php echo TOGGLE_ALL; ?>">
          <img src="images/minus.png" id="optionall" alt="+/-" border="0" />&nbsp;<?php echo TOGGLE_ALL; ?></a></a><br />
    </div>
    <input type="submit" class="button" value="<?php echo CHECK_N_SAVE; ?>" />

<?php
    // setup_sprintConfigTemplate continued
    $el_count = 0;
    foreach ($t['categories'] as $key => $value) {
      $el_count++;
?>

    <table width="100%" cellspacing="2">
      <tr>
        <th align="left" colspan="2" style="padding-left: 15px;">
          <a style="border:0; text-decoration: none" href="#" onclick="showConfig('el<?php echo $el_count; ?>'); return false" title="<?php echo TOGGLE_OPTION; ?>">
            <img src="images/minus.png" id="optionel<?php echo $el_count; ?>" alt="+/-" border="0" />
            &nbsp;<?php echo (defined($key) ? constant($key) : $key); ?>
          </a>
        </th>
      </tr>

      <tr>
        <td>
          <table width="100%" cellspacing="0" cellpadding="3" style="" id="el<?php echo $el_count; ?>">
            <tr>
              <td style="padding-left: 20px;" align=left colspan="2">
                <?php echo $t['descriptions'][$key]; ?>
              </td>
            </tr>

<?php
      // setup_sprintConfigTemplate (foreach) continued ..
      for ($x=0; $x<count($value); $x++) {

        // if there is a valuelist, then use the value from there if exists
        if (@is_array($from) && isset($from[$value[$x]['name']])) {
          $value[$x]['value'] = $from[$value[$x]['name']];
        } else // use the default value
          $value[$x]['value'] = $value[$x]['default'];
?>
            <tr>
              <td style="border-bottom: 1px #000000 solid" align="left" valign="top" width="75%">
                <strong><?php echo $value[$x]['longname']; ?></strong>
                <br />
                <span style="color: #5E7A94; font-size: 8pt;"><?php echo /*'(' . $value[$x]['type'] . ') ' .*/ $value[$x]['desc']; ?></span>
              </td>
              <td style="border-bottom: 1px #000000 solid; font-size: 8pt" align="left" valign="middle" width="25%">
                <span style="white-space: nowrap"><?php echo setup_guessInput($value[$x]['type'], $value[$x]['name'], $value[$x]['value'], $value[$x]['distdefault']); ?></span>
              </td>
            </tr>
<?php
          // setup_sprintConfigTemplate continued
        } // for
?>
          </table><br /><br />
        </td>
      </tr>
    </table>
<?php
    } // foreach
?>
    <input type="submit" class="button" value="<?php echo CHECK_N_SAVE; ?>" />
  </div>
</form>
<?php
    // setup_sprintConfigTemplate continued
    $content = ob_get_clean();
    return $content;
  }


  // It seems that it's purpose of this method is to
  // convert a fs dir path into a string that can be used in a URL.
  // It isn't clear it works well at that.
  function prepare_fs_dir_path($var) {
    //$var = str_replace("/",OS_FILE_SEPARATOR,$var);
    //$var = trim($var,OS_FILE_SEPARATOR).OS_FILE_SEPARATOR;
    $var = str_replace(OS_FILE_SEPARATOR,"/",$var);
    $var = trim($var,"/")."/";
    $var = str_replace("//","/",$var);
    return $var;
  }
  /**
   * Parsed Paths : adds trailing slash or antislash
   * and format filesystem path with the separator of the filesystem
   *
   */
  function setup_cleanConfigVars() {
    require_once '../compat.php';
    // Filesystem Dirs path
    if (isset($_POST['efm_image_transform_lib_path'])) {
      $_POST['efm_image_transform_lib_path'] = str_replace('"','',$_POST['efm_image_transform_lib_path']);
      // Not clear that this path should be xformed into a URL type path.
      if (substr($_POST['efm_image_transform_lib_path'], OS_FILE_SEPARATOR) !== false) {
        $_POST['efm_image_transform_lib_path'] = prepare_fs_dir_path($_POST['efm_image_transform_lib_path']);
      }
    }

    // dir names
    $_POST['efm_images_dir'] = trim($_POST['efm_images_dir'],"/\\");
    $_POST['efm_files_dir'] = trim($_POST['efm_files_dir'],"/\\");
    $_POST['efm_thumbnail_dir'] = trim($_POST['efm_thumbnail_dir'],"/\\");
    $_POST['efm_resized_dir'] = trim($_POST['efm_resized_dir'],"/\\");
    $_POST['trashDir']  = trim($_POST['trashDir'],"/\\");
    $_POST['backupDir'] = trim($_POST['backupDir'],"/\\");

    // files path
    if (isset($_POST['efm_default_thumbnail'])){
      //$_POST['efm_default_thumbnail'] = str_replace("/",OS_FILE_SEPARATOR,$_POST['efm_default_thumbnail']);
      $_POST['efm_default_thumbnail'] = str_replace(OS_FILE_SEPARATOR,"/",$_POST['efm_default_thumbnail']);
    }
    /*
    if (isset($_POST['sessionPath'])) {
      $_POST['sessionPath'] = prepare_fs_dir_path($_POST['sessionPath']);
    }
    */
  }
  /**
   * Checks parameters passed to the configuration setup page
   *
   */
  function setup_checkConfiguration() {

    global $umask;
    $errs = array();
    setup_cleanConfigVars();
    // Check dirs
    // efm_images_dir Dir
    clearstatcache();
    if (!is_dir(WK_PATH . $_POST['efm_images_dir'] ) && @mkdir(WK_PATH . $_POST['efm_images_dir'], $umask) !== true) {
      $errs[] = sprintf(WK_CONF_ERR_DIR_CREATE, $_POST['efm_images_dir']);
    } elseif (!is_writable(WK_PATH . $_POST['efm_images_dir'])) {
      $errs[] = sprintf(WK_CONF_ERR_DIR_NO_WRITE, $_POST['efm_images_dir']);
    }
    // thumbdir is a subdir of images dir
    if ($_POST['efm_thumbnail_dir'] != '') {
      $thumb = $_POST['efm_images_dir'] . OS_FILE_SEPARATOR . $_POST['efm_thumbnail_dir'];
      if (!is_dir(WK_PATH . $thumb ) && @mkdir(WK_PATH . $thumb, $umask) !== true) {
        $errs[] = sprintf(WK_CONF_ERR_DIR_CREATE, $_POST['efm_thumbnail_dir']);
      } elseif (!is_writable(WK_PATH . $thumb)) {
        $errs[] = sprintf(WK_CONF_ERR_DIR_NO_WRITE, $_POST['efm_thumbnail_dir']);
      }
    }
    // resized is a subdir of images dir
    if ($_POST['efm_resized_dir'] != '') {
      $resized = $_POST['efm_images_dir'] . OS_FILE_SEPARATOR . $_POST['efm_resized_dir'];
      if (!is_dir(WK_PATH . $resized ) && @mkdir(WK_PATH . $resized, $umask) !== true) {
        $errs[] = sprintf(WK_CONF_ERR_DIR_CREATE, $_POST['efm_resized_dir']);
      } elseif (!is_writable(WK_PATH . $resized)) {
        $errs[] = sprintf(WK_CONF_ERR_DIR_NO_WRITE, $_POST['efm_resized_dir']);
      }
    }
    if (!is_dir(WK_PATH . $_POST['efm_files_dir'] ) && @mkdir(WK_PATH . $_POST['efm_files_dir'], $umask) !== true) {
      $errs[] = sprintf(WK_CONF_ERR_DIR_CREATE, $_POST['efm_files_dir']);
    } elseif (!is_writable(WK_PATH . $_POST['efm_files_dir'])) {
      $errs[] = sprintf(WK_CONF_ERR_DIR_NO_WRITE, $_POST['efm_files_dir']);
    }
  // Backup Dir
    if (!is_dir(WK_PATH . $_POST['backupDir'] ) && @mkdir(WK_PATH . $_POST['backupDir'], $umask) !== true) {
      $errs[] = sprintf(WK_CONF_ERR_DIR_CREATE, $_POST['backupDir']);
    }
    elseif (!is_writable(WK_PATH . $_POST['backupDir'])) {
      $errs[] = sprintf(WK_CONF_ERR_DIR_NO_WRITE, $_POST['backupDir']);
    }
  // Trash Dir
    if (!is_dir(WK_PATH . $_POST['trashDir'] ) && @mkdir(WK_PATH . $_POST['trashDir'], $umask) !== true) {
      $errs[] = sprintf(WK_CONF_ERR_DIR_CREATE, $_POST['trashDir']);
    }
    elseif (!is_writable(WK_PATH . $_POST['trashDir'])) {
      $errs[] = sprintf(WK_CONF_ERR_DIR_NO_WRITE, $_POST['trashDir']);
    }

    if ($_POST['email'] == 'none' && $_POST['approval'] == 'email') {
      $errs[] = sprintf(WK_CONF_ERR_NO_EMAIL);
    }

    // Check DB
    @include_once '../lib/Wiki_DB.php';
    if (class_exists('Wiki_DB')) { // verify that the included file exists
      $db = Wiki_DB::getDB($_POST['dbType']);
      if ($db->probe() === false) {
        foreach($db->probe_errors as $e)
          $errs[] = $e;
      }
    } else {
      $errs[] = WK_CONF_ERR_DB_LIB_NOT_FOUND;
    }
    // Check given prefix
    if (!preg_match('/[a-z_]+/si',$_POST['dbPrefix'])) {
      $errs[] = WK_CONF_ERR_DB_BAD_TBL_PREFIX;
    }

    if (!is_any_user_DB_installed()) {
      //check if mail exist
      if (!isset($_POST['adminMail']) && $_POST['email'] != 'none' ){
        $errs[] = WK_CONF_ERR_MAIL;
      }
    }

    // Check Image Library
    if ( ($_POST['efm_image_class'] != 'GD') && (!is_dir($_POST['efm_image_transform_lib_path']) ) ) {
      $lib_name = ($_POST['efm_image_class'] == 'IM') ? 'ImageMagick' : $_POST['efm_image_class'];
      $errs[] = sprintf(WK_CONF_ERR_GRAPH_LIB_NOT_FOUND, $lib_name, $_POST['efm_image_transform_lib_path']);
    }
    return (count($errs) > 0 ? $errs : '');
  } // setup_checkConfiguration

  function is_any_user_DB_installed() {
    @include_once '../lib/Wiki_DB.php';
    if (!class_exists('Wiki_DB')) { // verify that the included file exists
      return false;
    }
    $db = Wiki_DB::getDB($_POST['dbType'],$_POST);
    if ( $db->query("SELECT * FROM ".$_POST['dbPrefix']."utilisateurs;") !== false) return true;
    if ( $db->query("SELECT * FROM ".$_POST['dbPrefix']."users;") !== false) return true;
    return false;
  }
  function is_DB_installed() {
    @include_once '../lib/Wiki_DB.php';
    if (!class_exists('Wiki_DB')) { // verify that the included file exists
      return false;
    }
    $db = Wiki_DB::getDB($_POST['dbType'],$_POST);
    $test_res_pages = $db->query("SELECT * FROM ".$_POST['dbPrefix']."pages;");
    // Old User db name
    $test_res_users = $db->query("SELECT * FROM ".$_POST['dbPrefix']."utilisateurs;");
    // If the old db exists we'll replace it on the fly.
    // If the old one doesn't exst and neither does the new one then we must create it
    if ($test_res_users  === false) {
      $test_res_users = $db->query("SELECT * FROM ".$_POST['dbPrefix']."users;");
    }
    $test_res_dir = $db->query("SELECT * FROM ".$_POST['dbPrefix']."dir;");
    $test_res_history = $db->query("SELECT * FROM ".$_POST['dbPrefix']."history;");

    $test_res = ($test_res_pages!==false) && ($test_res_users!==false) && ($test_res_dir !== false) && ($test_res_history !== false);
    if ($test_res !== false) {
      return true; // no install to do
    }
    return false;
  }

  /**
   * Setups the database
   */
  function setup_installDatabase() {
    $errs = array();
    @include_once '../lib/Wiki_DB.php';
    if (!class_exists('Wiki_DB')) { // verify that the included file exists
      $err[] = WK_CONF_ERR_DB_LIB_NOT_FOUND;
    }
    if (is_DB_installed()) {
      return true;
    }
    $db = Wiki_DB::getDB($_POST['dbType'],$_POST);

    // Note on changing name for existent tables
    // the query ALTER TABLE `wikiwig_pages` RENAME `NEW_PREFIX_pages`
    // allow to change already installed
    // This behaviour is not still implemented , maybe in future versions

    // Tables Creation
    //$in_table = 0;
    //$queries = array();
    $sql = '';
    $fp = fopen('sql/wikiwig_tables.sql', 'r', 1);
    if (is_resource($fp)) {
        while (!@feof($fp)) {
          $line = trim(fgets($fp, 4096));
          if (substr($line,0,1)!='#')
            $sql.= $line;
            /*
            // Regexp Version
            if ($in_table) {
              $def .= $line;
              if (preg_match('/^\)\s*(type\=\S+)?\s*\;$/i', $line)) {
                $in_table = 0;
                array_push($queries, $def);
              }
            } else {
              if (preg_match('#^create table [`]?(wk_pages|wk_users)[`]?\S+\s*\(#i', $line)) {
                //echo 'In Table '.$line.'<br/>';
                $in_table = 1;
                $def = $line;
              }

              if (preg_match('#^create\s*(\{fulltext\}|unique)\s*index#i', $line)) {
                array_push($queries, $line);
              }
            }
            */
        } // while
        fclose($fp);
      }
      $sql = str_replace('wk_pages',$_POST['dbPrefix'].'pages',$sql);
      $sql = str_replace('wk_users',$_POST['dbPrefix'].'users',$sql);
      // New tables
      $sql = str_replace('wk_history',$_POST['dbPrefix'].'history',$sql);
      $sql = str_replace('wk_directory',$_POST['dbPrefix'].'dir',$sql);

      $queries = preg_split('/(?<=;)(?=CREATE TABLE)/',$sql);
      $creation_res = true;
      $err = array();
      foreach($queries as $query) {
        $res = $db->execute($query);
        if ($res !== true) {
          $err[] = $query . "<br>" . $res;
          $creation_res = false;
        }
      }
      if ($creation_res) {
        return true;
      }

      return implode("<br>", $err);
  } // setup_installDatabase

  /**
   * Create the configuration File
   *
   */
  function setup_updateConfiguration() {
    global $WK;
    //if already installed, try backup old config file
    if (defined('WK_INSTALLED')){
      $old_file = dirname(__FILE__).'/../wk_config.php';
      @copy($old_file,$old_file.'.bak');
    }
    $path = dirname(__FILE__).'/../';
    $file = 'wk_config.php';
    $fp   = @fopen($path . $file, 'w+');

    if (!is_resource($fp)) {
      $errs[] = sprintf(WK_CONF_ERR_WRITE_CONF_FILE, $file);
      return $errs;
    }
    // special options array
    $efm = array();

    /////
    // Safe_mode detection
    // Based on not-allowed functions
    $output = @shell_exec('dir');
    $detected_safe_mode = (empty($output)) ? 'true' : 'false';
    // could simply be *nix not windows
    if ($detected_safe_mode) {
      $output = @shell_exec('ls');
      $detected_safe_mode = (empty($output)) ? 'true' : 'false';
    }

    // starting content of the file
    $config_content = "<?php\n";
    $config_content.= "/*\n";
    $config_content.= "\tWikiwig Configuration File\n";
    $config_content.= "\twritten on ".date('r')."\n";
    $config_content.= "*/\n";
    // use this var to replace the real value in the following config definitions
    // value of constants are not replaced in HereDoc strings
    $WK_SYSTEM_DIR = WK_SYSTEM_DIR;
    $WK_VERSION = WK_VERSION;
    $WK_HTTPPATH = WK_HTTPPATH;
    $WK_HTTPSPATH = WK_HTTPPATH;
    if (ctype_alpha($_POST['https']) && $_POST['https'] == 'https') {
      $WK_HTTPSPATH = str_replace("http:", "https:", $WK_HTTPSPATH);
    }
    // In following HereDoc Strings
    // dont forget to use \\ to define a \
    // to use \$ when a $ should be written else vars will be replaced
    $config_content.= <<<INIT
// Set the version
\$WK['wikiwig_version'] = '$WK_VERSION';
\$WK['wikiwig_project_url'] = 'http://sourceforge.net/projects/wikiwig/';
// Safe_mode detected (change this if detection failed to find your current php config)
\$WK['safe_mode'] = $detected_safe_mode;

\$WK['systemDir'] = '$WK_SYSTEM_DIR';
// Dynamic Detection of the system path of wikiwig
\$current_path = str_replace("\\\\","/",__FILE__);
\$WK['wkPath'] = substr(\$current_path,0,strpos(\$current_path,\$WK['systemDir'].'/'));

// HTTP path of wikiwig
\$WK['wkHTTPPath'] = '$WK_HTTPPATH';
\$WK['wkHTTPSPath'] = '$WK_HTTPSPATH';
\$WK['templatesDir'] = \$WK['systemDir'].'/template';
\$WK['templatesSystemDir'] = \$WK['templatesDir'].'/system';


// Configuration Options

INIT;

    // Capture the im/fm values not in the config page but set by config compat
    // this should go away when we add to tpl file.

    foreach($WK as $key => $val){

      // Configure Xinha's ExtendedFileManager (an extension of ImageManager) using
      // the wikiwwig variables.
      if (strstr($key,'efm_')){
        $efm[substr($key,strlen('efm_'))] = $val;
      }
    }

    if ($_POST['sessionPath'] != '') {
      $config_content.= "\$WK['sessionPath'] = ".setup_formatConfigVar($_POST['sessionPath']).";\n";
      $config_content.= "session_save_path(\$WK['sessionPath']);\n";
    }
    $config_content.= "";
    $config_content.="//These variables are created directly from the config.\n";
    // Retrieving code for the variables posted to the config page
    $rights_vars = array('editFiles', 'restoreFiles',
                         'renameFolders','renameFiles',
                         'moveFolders','moveFiles',
                         'deleteFolders','deleteFiles',
                         'createFolders', 'createFiles'
                        );
    foreach($_POST as $key => $val) {
      //pas Enregistrer le nom Admin & login & mail dans config mais dans base
      //Only record Admin login, password and email address in the database and not in the config file.
      $rights = str_replace("anon_", "", $key);
      if  (($key =='adminLogin')||($key =='adminPass') || ($key =='adminMail')){
        $config_content.="//enregistrement dans la base $key\n";
      } else if ($key!='installAction' && $key!='hiddenDirs' && !in_array($rights, $rights_vars)) {
        $config_content.= "\$WK['".$key."'] = ".setup_formatConfigVar($val).";\n";
        // special cases
      } elseif($key == 'hiddenDirs'){
        $val = str_replace(";","','",$val); // make an array list
        $config_content.= "\$WK['".$key."'] = array('".$val."');\n";
      } elseif(in_array($key, $rights_vars)) {
        $config_content.= "\$WK['defaultRights']['".$key."'] = ".setup_formatConfigVar($val).";\n";
      } elseif(in_array(str_replace("anon_", "", $key), $rights_vars)) {
        $config_content.= "\$WK['anonRights']['".str_replace("anon_", "", $key)."'] = ".setup_formatConfigVar($val).";\n";
      }

      // Add some config vars depending on the key
      if ($key == 'dbPrefix'){
        $config_content.= "\$WK['table_pages'] = \$WK['dbPrefix'].'pages';\n";
        // Old DB
        $config_content.= "\$WK['table_utilisateurs'] = \$WK['dbPrefix'].'utilisateurs';\n";
        // New DB
        $config_content.= "\$WK['table_users'] = \$WK['dbPrefix'].'users';\n";
      }

      // Configure Xinha's ExtendedFileManager (an extension of ImageManager) using
      // the wikiwwig variables.
      if (strstr($key,'efm_')){
        $efm[substr($key,strlen('efm_'))] = $val;
      }
    } // foreach

    // No longer try to produce a config file that can be dropped into an old version of wikiwig
    // We still will take an old config file in a new version of wikiwig (see configuration_compat.php)

    $config_content.= "\n//Image Manager Plugin variables\n";
    $config_content.= "\n//These variables are directly derived or set from the WK[...] variables\n";
    $config_content.= "\n\n";

    // Derived variables

    $config_content.= "\$IMConfig['safe_mode'] = \$WK['safe_mode'];\n";

    foreach($efm as $k => $v){
      if ($k == 'image_class'){
        // Use if defined to prevent already defined errors when we source the config file below
        $config_content.= "if (!defined('IMAGE_CLASS')) define('IMAGE_CLASS', ".setup_formatConfigVar($v).");\n";
      } elseif($k == 'image_transform_lib_path'){
        $config_content.= "if (!defined('IMAGE_TRANSFORM_LIB_PATH')) define('IMAGE_TRANSFORM_LIB_PATH', ".setup_formatConfigVar($v).");\n";
      } elseif (strpos($k, '_extensions') > 0) {
        if (is_array($v)) {
          $exts="";
          foreach($v as $k1 => $v1){
            $v1 = "'" . $v1 . "'";
            if ($exts == "") {
              $exts = $v1;
            } else {
              $exts.= "," . $v1;
            }
          }
          $config_content.= "\$IMConfig['" . $k . "'] = array(".$exts.");\n";
        } else {
          $v = str_replace(";","','",$v); // make an array list
          $config_content.= "\$IMConfig['" . $k . "'] = array('".$v."');\n";
        }
      } elseif ($k == 'images_dir' || $k == 'files_dir') {
        $config_content.= "\$IMConfig['".$k."'] = \$WK['wkPath'] .'" . $v . "';// derived variable\n";
        $k_url = str_replace("dir", "url", $k);
        $config_content.= "\$IMConfig['".$k_url."'] = \$WK['wkHTTPPath'] .'" . $v . "';// derived variable\n";
      } else {
        $config_content.= "\$IMConfig['".$k."'] = ".setup_formatConfigVar($v).";\n";
      }
    }

    $config_content.=<<<INCLUSIONS
// PHP Versions compatibility script
@include_once(dirname(__FILE__).'/compat.php');

// Language definitions
@include_once(dirname(__FILE__).'/wk_lang.php');

INCLUSIONS;
    $config_content.= "?>\n";
    fwrite($fp, $config_content);
    fclose($fp);

    umask(0000);
    @chmod($path . $file, 0777);

    // Update the config to match what we just wrote
    require ($path . $file);

    return true;
  } // setup_updateConfiguration

  /**
   * Format values of variables for configuration file
   *
   */
  function setup_formatConfigVar($val){
    // for int or boolean, just return the value
    if (($val == 'false') || ($val == 'true') || (is_numeric($val))) {
      return $val;
    } else{ // string => escape " and \ + add ""
      //return "'".addslashes($val)."'";
      $val = str_replace('"','\"',$val);
      $val = str_replace("\\","\\\\",$val);
      return '"'.$val.'"';
    }
  }
?>
