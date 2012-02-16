<?php
  if(function_exists('error_reporting'))
    @error_reporting(E_ALL);
  if (!isset($_SESSION)) {
    session_start();
  }

  require_once '../lib/Wiki_DB.php';
  require_once '../lib/Wiki.php';
  require_once '../lib/Wiki_User.php';
  require_once '../lib/Wiki_PageDir.php';
  require_once '../compat.php';
  define('WK_VERSION','5.01 alpha');
  define('WK_SYSTEM_DIR','_wk');

  // Detecting Path of the wiki and HTTP Path
  $current_path = str_replace("\\","/",__FILE__);
  $wkPath = substr($current_path, 0, strpos($current_path, WK_SYSTEM_DIR.'/'));
  define('WK_PATH',$wkPath);
  $current_url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
  // there have been reports of getting // within the detected url. Make sure that doesn't happen
  while (strpos("//", $current_url) !== false) {
    $current_url = str_replace("//", "/", $current_url);
  }
  $current_url = 'http://'. $current_url;
  $wkHTTPPath = substr($current_url, 0, strpos($current_url, WK_SYSTEM_DIR.'/'));
  define('WK_HTTPPATH',$wkHTTPPath);
  global $WK;

  $user = false;

  // Attempt to load older config file
  if(@is_file('../wk_config.php')){
    require_once '../wk_config.php';
    require_once 'configuration_compat.php';

    // This either gets us a registered user or a guest
    $user = Wiki_User::currentUser();

    if (!$user->privileged() ) {
      Wiki_User::logout();
      // require_once '../wk_identification_admin.php';
      // $_SERVER['HTTP_REFERER'] = $current_url;
      if (isset($WK['wkHTTPSPath'])) {
        $redirection_url = $WK['wkHTTPSPath'] . WK_SYSTEM_DIR . '/wk_identification_admin.php?' . $_SERVER['PHP_SELF'];
      } else {
        $redirection_url = WK_HTTPPATH . WK_SYSTEM_DIR . '/wk_identification_admin.php?' . $_SERVER['PHP_SELF'];
      }
      header("Location: ".$redirection_url);
      exit;
    }
    if (!defined('WK_INSTALLED')) {
      @define('WK_INSTALLED',true); // already installed, update process
    }
  }

  // defining the language used
  if (isset($_POST['lang'])) {
    $WK['lang'] = $_POST['lang'];
  } elseif (isset($_GET['lang'])) {
    $WK['lang'] = $_GET['lang'];
  } elseif (!isset($WK['lang'])) {
    $WK['lang'] = 'fr';
    if ( isset( $_SERVER["HTTP_ACCEPT_LANGUAGE"] ) ) {
      $l = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
      if (strpos($l, "en-") == 0) {
        $WK['lang'] = 'en';
      } else if (strpos($l, "de-") == 0) {
        $WK['lang'] = 'de';
      } else if (strpos($l, "fr-") == 0) {
        $WK['lang'] = 'fr';
      }
    }
  }
  switch ($WK['lang']) {
    case 'fr':
    case 'de':
    case 'en':
      break;
    default: $WK['lang'] = 'fr'; // use default french

  }

  $file_lang = dirname(__FILE__).'/lang/'.$WK['lang'].'.php';


  if(!@is_file($file_lang)){ // language not available
    $WK['lang'] = 'fr'; // use default french
    require_once dirname(__FILE__).'/lang/'.$WK['lang'].'.php';
  } else // retrieves language defs
    require_once $file_lang;

  require_once 'setup.functions.inc.php';


  if (!isset($_POST['installAction'])) {
    $_POST['installAction'] = '';
  }

  if(defined('WK_INSTALLED')) {
    $page_title = WK_CONF_TITLE_UPDATE;
  } else {
    $page_title = WK_CONF_TITLE_INSTALL;
  }

  switch ($_POST['installAction']) {
    case 'check':
      $page_content = '';
      // Used to just overwrite $WK, now we overlay it. This lets config_compat
      // code create derived variables that don't exist in the tpl file and not
      // have them destroyed by overwriting the WK array.
      foreach($_POST as $key => $val){
        $WK[$key] = $val;
      }

      // Checking the configuration parameters
      $check_res = setup_checkConfiguration();
      if (is_array($check_res)) { //errors
        $page_content.= WK_CONF_ERRORS_CONF . '<br /><br />';
        $page_content.= '<span style="color: #FF0000">- ' . implode('<br />- ', $check_res) . '</span><br /><br />';
        $page_content.= setup_sprintConfigTemplate(setup_parseTemplate(dirname(__FILE__).'/installation_page.tpl.php'), $_POST, true);
        break;
      }  
      // configuration seems ok

      // Test if db is installed here since
      $db_already_installed = is_DB_installed();
      // Could be an upgrade where dir/history don't exist but user does
      $user_db_exists = is_any_user_DB_installed();

      // Installing the database
      if ($db_already_installed) {
        $page_content.= sprintf(WK_CONF_DB_ALREADY_INSTALLED,$_POST['dbName']).'<br/>';
        $admin = Wiki_User::currentUser();
      } else {

        $install_db_res = setup_installDatabase();
        if (is_array($install_db_res)) {
          $page_content.= WK_CONF_ERRORS_INSTALL . '<br /><br />';
          $page_content.= '<span style="color: #FF0000">- ' . implode('<br />', $install_db_res) . '</span><br /><br />';
          $page_content.= setup_sprintConfigTemplate(setup_parseTemplate(dirname(__FILE__).'/installation_page.tpl.php'), $_POST, true);
          break;
        }
        if($install_db_res === false) {
          $page_content.= WK_CONF_ERRORS_INSTALL . '<br /><br />';
          $page_content.= '<span style="color: #FF0000">- ' . WK_CONF_ERR_DB_INSTALL . '</span><br /><br />';
          break;
        }

        $page_content.= sprintf(WK_CONF_DB_INSTALLED,$_POST['dbName']).'<br/>';
      }

      // Writing the Configuration
      $write_conf_res = setup_updateConfiguration();
      if (is_array($write_conf_res)) {
        $page_content.= WK_CONF_ERRORS_INSTALL . '<br /><br />';
        $page_content.= '<span style="color: #FF0000">- ' . implode('<br />', $write_conf_res) . '</span><br /><br />';
        $page_content.= setup_sprintConfigTemplate(setup_parseTemplate(dirname(__FILE__).'/installation_page.tpl.php'), $_POST, true);
        break;
      }

      if (!$user_db_exists) {
        // Now install the admin account
        $admin = new Wiki_User();
        // Create a privileged user
        $admin->fillin($_POST['adminLogin'], md5($_POST['adminPass']), $_POST['adminMail'], true);
        // Install in database
        $res = $admin->insert();
        if ($res !== true) {
          $page_content.= WK_CONF_ERRORS_INSTALL . '<br /><br />';
          if (is_array($res)) {
            $page_content.= '<span style="color: #FF0000">- ' . implode('<br />', $res) . '</span><br /><br />';
          } else {
            $page_content.= '<span style="color: #FF0000">- ' . $res . '</span><br /><br />';
          }
          break;
        }
        // Log in the admin
        $admin->login();
      }


      $page_content.= WK_CONF_UPDATED.'<br/><br/>';
      // configuration updated
      $page_content.= sprintf(WK_CONF_SAVED_SUCCESSFUL, WK_HTTPPATH);
      if(!defined('WK_INSTALLED')) {
        $page_content.= sprintf(WK_CONF_SAVED_SUCCESSFUL2, $_POST['adminLogin'], $_POST['adminPass']).'<br/><br/>';
      }
        
      // Attempt to write the home page file
      // if wikiwig was not not previously installed
      if(!defined('WK_INSTALLED') || !@is_file(WK_PATH.'index.html')) {
        //echo WK_PATH.'index.html';
        Wiki::createPage('', "index", HOMEPAGE_CONTENT, $_POST['wkName'] );
            
      } else {
        // indicates to the user that he should launch the parsing of the wiki
        $page_content.= '<strong>'.sprintf(WK_CONF_UPGRADE_MSG,'../wk_admin.php','../wk_admin.php?action=parseall').'</strong><br/><br/>';
      }
      if (!defined('WK_INSTALLED')) {
        @define('WK_INSTALLED',true); // already installed, update process
      }

        
     break;

    default:
      /*  Is wikiwig already installed=  */
      if (defined('WK_INSTALLED')) {
        $from = &$WK;
      } else {
        $from = false;
      }
      $page_content = setup_parseTemplate(dirname(__FILE__).'/installation_page.tpl.php');
        
      /* COMMENTAIRE 
       * janvier 2006
       * si l'admin est déjà enregistré dans la base il faut aller le chercher
       *  et le remplasser dans l'affichage du config
       *  sinon, laisser la config comme avant.
       */

      // Babelfish was kind of useless on the translation above but I think it
      // says that is no database has been configured yet that the query fails
      // and it is was commented out. Now we try and determine if a db has
      // been configured first. fatcatair 2007
      $dbType = Wiki::getConfig('dbType');
      if ($dbType) {
        if (defined('WK_INSTALLED')) {
          for ($i = sizeof($page_content['categories']['WK_CONF_GENERAL']) - 1;  $i >= 0; $i--){
            $name = $page_content['categories']['WK_CONF_GENERAL'][$i]['name'];
            if ($name=="adminLogin" || $name=="adminPass" || $name=="adminMail") {
              array_splice($page_content['categories']['WK_CONF_GENERAL'], $i, 1);
            }
          }
          $page_content = setup_sprintConfigTemplate($page_content, $from);
        } else {
         $page_content = setup_sprintConfigTemplate(setup_parseTemplate(dirname(__FILE__).'/installation_page.tpl.php'), $from);
        }
      } else {
        $page_content = setup_sprintConfigTemplate(setup_parseTemplate(dirname(__FILE__).'/installation_page.tpl.php'), $from);
      }
  }

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><?php echo WK_CONF_TITLE; ?></title>
    <link href="../wk_style.css" rel="stylesheet" type="text/css" />

  </head>

  <body class="actions">
    <div id="header"><?php echo WK_CONF_TITLE; ?></div>
    <div id="results">
      <span class="errors">
                 
      </span>
      <span class="message">
                 
      </span>
    </div>
    <div id="content">
      <h1><?php echo $page_title; ?></h1>
      <?php print_r($page_content); ?> 
    </div>
<?php
    if(empty($_POST['installAction'])) {
?>
      <div id="flags" style="position:absolute;right:50px;top:60px;">
	<a href="?lang=fr" title="Version Fran&ccedil;aise"><img src="../images/flag-french.gif" alt="Version Fran&ccedil;aise" /></a>
	<a href="?lang=en" title="English Version"><img src="../images/flag-english.gif" alt="English Version" /></a>
	<a href="?lang=de" title="German Version"><img src="../images/flag-german.gif" alt="German Version" /></a>
      </div>
<?php
    }
?> 
    <div style="position:absolute;right:30px;top:30px;">
      <a href="../wk_admin.php"><?php echo WK_CONF_LABEL_LINK_ADMIN; ?></a>&nbsp;|&nbsp;<a href='../../index.html'><?php echo WK_CONF_LABEL_GO_WIKI; ?></a>
    </div>
  </body>
</html>
