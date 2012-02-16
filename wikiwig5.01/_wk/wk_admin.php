<?php
  //include "wk_identification_admin.php";
  require_once("wk_config.php");
  require_once("lib/Wiki_User.php");

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

  $results = array();
  $results_title = WK_ADMIN_RESULTS_TITLE;

  $action = false;

  if(isset($_GET['action'])) {
    $action = $_GET['action'];
    switch($action) {
      case "parseall" :
        require_once 'lib/Wiki.php';
        $results = Wiki::parseAllPages();
        /*
          $root_dir = new Wiki_Dir('/');
          $results = $root_dir->parseWikiFiles();
        */
        $results_title = WK_ADMIN_RESULTS_TITLE;
        break;
      default:
        break;
    }
  }
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo WK_ADMIN_HEAD_TITLE; ?></title>
    <link href="wk_style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="header"><?php echo WK_ADMIN_BODY_TITLE; ?></div>
    <div id="menu">
      <ul>
        <li>
          <strong><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=parseall"><?php echo WK_LABEL_PARSING; ?></a></strong>
        </li>
        <li>
          <strong><a href="setup/"><?php echo WK_LABEL_CONFIGURATION; ?></a></strong>
        </li>
        <li>
          <strong><a href="wk_user.php"><?php echo WK_USER_ADMIN; ?></a></strong>
        </li>
<?php
        if ($WK['captcha'] == 're') {
          $url = $WK['wkHTTPSPath'] . $WK['systemDir'] . '/wk_captcha.php';
?>
        <li>
          <strong><a href="<?php echo $url;?>"><?php echo WK_CAPTCHA_ADMIN; ?></a></strong>
        </li>
<?php
        }
?>
      </ul>
    </div>
    <div id="content">
      <div id="results">
<?php
        if($action && !empty($results)) {
          echo '<h3>'.$results_title.' : </h3>';
          foreach($results as $res) {
            if ($action=='parseall') {
              if ($res[0]) { //$res[0] is the boolean result of parsing
                echo sprintf(WK_ADMIN_PARSE_FILE_OK,$res[1])."<br/>\n";
              } else {
                if (!empty($res[1])) {
                  echo sprintf(WK_ADMIN_PARSE_FILE_ERROR,$res[1])."<br/>\n";
                } else {
                  echo $res[2]."<br/>\n";
                }
              }
            }
          } // foreach
        } else {
          echo "<p>".WK_ADMIN_HOME_MSG."</p><p>&nbsp;</p>";
        }
?>
      </div>
    </div>
    <div style="position:absolute;right:30px;top:30px;">
      <a href='../index.html'><?php echo WK_LABEL_GO_WIKI; ?></a>
    </div>
  </body>
</html>
