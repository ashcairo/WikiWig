<?php
  require_once 'wk_identification.php';
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

  $clean = array();

  // This either gets us a registered user or a guest
  $user = Wiki_User::currentUser();

  if (!$user->privileged() ) {
    Wiki_User::logout();
    // require_once '../wk_identification_admin.php';
    // $_SERVER['HTTP_REFERER'] = $current_url;
    if (isset($WK['wkHTTPSPath'])) {
      $redirection_url = $WK['wkHTTPSPath'] . $WK['systemDir'] . '/wk_identification_admin.php?' . $_SERVER['PHP_SELF'];
    } else {
      $redirection_url = $WK['wkHTTPPath'] . $WK['systemDir'] . '/wk_identification_admin.php?' . $_SERVER['PHP_SELF'];
    }
    header("Location: ".$redirection_url);
    exit;
  }

  @define('WK_CAPTCHA_SITE', 'captcha_site');
  @define('WK_CAPTCHA_KEY_PUBLIC', 'captcha_key1');
  @define('WK_CAPTCHA_KEY_PRIVATE', 'captcha_key2');
  $db = Wiki_DB::getInstance();
  $captcha_table = Wiki::getConfig('dbPrefix') . "captcha";


  // Install the DB if not present
  $db=Wiki_DB::getInstance();
  $site = $db->escape_string(Wiki::getConfig('wkName'));
  $query_captcha = "SELECT * FROM `". $captcha_table . "`  WHERE " . 
                    WK_CAPTCHA_SITE . " = '". $site . "'; ";
  $keys = $db->query($query_captcha);

  $field_names = $db->escape_string(WK_CAPTCHA_SITE) . ", " . $db->escape_string(WK_CAPTCHA_KEY_PUBLIC) . ", " . $db->escape_string(WK_CAPTCHA_KEY_PRIVATE);
  $dberror = "";

  if (empty($keys)) {
    $private_key = '';
    $public_key = '';
    // Create the table
    $table_schema = "CREATE TABLE `" . $captcha_table . "` ( " .
        "`" . WK_CAPTCHA_SITE . "` varchar(255), " .
        "`" . WK_CAPTCHA_KEY_PUBLIC . "` varchar(50), " .
        "`" . WK_CAPTCHA_KEY_PRIVATE . "` varchar(50), " .
        "UNIQUE KEY " . "`" . WK_CAPTCHA_SITE . "` (`" . WK_CAPTCHA_SITE . "`)" .
      ") TYPE=MyISAM AUTO_INCREMENT=0 ;";
    $create_res = $db->execute($table_schema);
    if ($create_res !== true) {
      $dberror = array_pop($db->errors);
      error_log("captcha create: " . $dberror);
    }
    $values = $db->escape_string($WK['wkHTTPPath']) . ", " . "`NO-KEY`, `NO-KEY` ";
    $values = "'" . $db->escape_string($WK['wkHTTPPath']) . "' , " . "'NO-KEY', 'NO-KEY' ";
    $values = "'" . $site . "' , " . "'NO-KEY', 'NO-KEY' ";
    $query_user_insert = "INSERT INTO `" . $captcha_table . "`" .
                            "(" . $field_names . ") VALUES(" . $values . ")" ;
    // error_log("Q: " . $query_user_insert);
    $insert_res = $db->execute($query_user_insert);
    if ($insert_res !== true) {
      $dberror = array_pop($db->errors);
      error_log("captcha insert: " . $dberror);
    }
  } else {
    $private_key = $keys[0][WK_CAPTCHA_KEY_PRIVATE];
    $public_key = $keys[0][WK_CAPTCHA_KEY_PUBLIC];
  }
  if (isset($_POST['public']) && isset($_POST['private'])) {
    $private_key = $db->escape_string($_POST['private']);
    $public_key = $db->escape_string($_POST['public']);

    $update_keys = "UPDATE `" . $captcha_table . "` SET " .
                      WK_CAPTCHA_KEY_PUBLIC . "=" . "'$public_key', " .
                      WK_CAPTCHA_KEY_PRIVATE . "=" . "'$private_key' " .
                     " WHERE " . WK_CAPTCHA_SITE . " = '". $site . "'; ";
    if ($db->execute($update_keys) == false ) {
      $dberror = array_pop($db->errors);
    } else {
      $dberror = WK_CAPTCHA_SUCCESS;
    }
  }
    
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title><?php echo WK_LABEL_WIKI_MAP; ?> : </title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <script language="JavaScript" src="js/ajaxChat.js"></script>
    <script language="JavaScript" src="js/domUtils.js"></script>
    <script language="JavaScript" src="js/tooltip.js"></script>
    <script language="JavaScript" src="js/dreamweaver.js"></script>

    <script language="JavaScript">

    </script>
    <link href="wk_style.css?refresh=<?php echo rand(5,4545464); ?>" rel="stylesheet" type="text/css">
  </head>
  <body>
    <!-- CONNECTION INDICATOR -->
    <div id="header">
      <!--<a href="#" title="WK">WKW</a> |-->
      <!--<div id="message"></div>      -->
      <a href=' <?php echo $changer; ?>'>
<?php
        echo "&nbsp;<img src='images/perso_jaune.gif'>" . $user->user_name();
        // the user must be connected and an admin
?>
      </a>
    </div>

    <!-- Content -->
      <h1>
      &nbsp;<?php echo WK_CAPTCHA_ADMIN; ?>
      </h1>
      <form name="search" method="POST" action="wk_captcha.php">
        <table id="datatable" cellspacing="0">
          <tr>
            <td class="cel3">
            &nbsp;<?php echo WK_CAPTCHA_PUBLIC; ?>
            </td>
            <td class="cel3">
              <input type="text" size="50" name="public" value="<?php echo $public_key;?>">
            </td>
          </tr>
          <tr>
            <td class="cel3">
            &nbsp;<?php echo WK_CAPTCHA_PRIVATE; ?>
            </td>
            <td class="cel3">
              <input type="text" size="50" name="private" value="<?php echo $private_key;?>">
            </td>
          </tr>
          <tr>
            <td class="cel3">
              <input type="submit" value="<?php echo WK_UPDATE;?>">
            </td>
          </tr>
        </table>
      </form>
      &nbsp;
<?php
      if (isset($_POST['private'])) {
        echo "<font color='red'>$dberror</font>";
      }
?>

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
