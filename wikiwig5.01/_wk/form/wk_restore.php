<?php
  require_once '../wk_config.php';
  require_once '../lib/Wiki.php';
  require_once '../wk_protect.php';
  if (!isset($_SESSION)) {
    session_start();
  }

  $results = '';
  $errors = '';

  $clean = array();
  if(isset($_GET['time'])) {
    if (ctype_digit($_GET['time'])) {
      $clean['time'] = $_GET['time'];
    }
  }
  if(isset($_GET['seq'])) {
    if (ctype_digit($_GET['seq'])) {
      $clean['seq'] = $_GET['seq'];
    }
  }
  if(isset($_GET['num'])) {
    if (ctype_digit($_GET['num'])) {
      $clean['num'] = $_GET['num'];
    }
  }
  if(isset($_GET['action'])) {
    if ($_GET['action'] == 'UPD' || $_GET['action'] == 'DEL' ) {
      $clean['action'] = $_GET['action'];
    }
  }
  if(isset($_POST['time'])) {
    if (ctype_digit($_POST['time'])) {
      $clean['time'] = $_POST['time'];
    }
  }
  if(isset($_POST['seq'])) {
    if (ctype_digit($_POST['seq'])) {
      $clean['seq'] = $_POST['seq'];
    }
  }
  if(isset($_POST['num'])) {
    if (ctype_digit($_POST['num'])) {
      $clean['num'] = $_POST['num'];
    }
  }
  if(isset($_POST['action'])) {
    if ($_POST['action'] == 'UPD' || $_POST['action'] == 'DEL' ) {
      $clean['action'] = $_POST['action'];
    }
  }
  if(isset($_POST['doit'])) {
      $clean['doit'] = $_POST['doit'];
  }
  if(isset($_POST['back_url'])) {
      // CROSS SITE??
      $back_url = $_POST['back_url'];
  }

  // default back url
  if (!isset($back_url)) {
    if (isset($_SERVER['HTTP_REFERER'])) {
      $back_url = $_SERVER['HTTP_REFERER'];
    } 
  }

  // Get current user
  $user = Wiki_User::currentUser();

  if(isset($clean['doit']) && isset($clean['action'])){
    // error_log("eff: " . $_POST['process']);
    $entry = Wiki_PageDir::findBySeq($clean['seq']);
    $target = $entry->path();
    switch($clean['action']) {

      case 'UPD' : // Restore a backup

        $res = Wiki::restoreFile($clean['seq'], $clean['time'], $clean['num']);
        if ($res === true) {
          $results = sprintf(WK_RESTORE_FILE_SUCCESS, $target);
        } else {
          $errors[] = $res;
        }
        break;

      case 'DEL' : // Restore a delete file
        $res = Wiki::undeleteFile($clean['seq'], $clean['time']);
        if ($res === true) {
          $results = sprintf(WK_RESTORE_FILE_SUCCESS2, $target);
        } else {
          $errors[] = $res;
        }
        break;

      default :

         header("Location: $back_url");
         exit();
         break;
    }
  }

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo WK_RESTORE_FILE; ?></title>
    <link href="<?php echo Wiki::getConfig('wkHTTPPath').Wiki::getConfig('systemDir'); ?>/wk_style.css?no_cache=<?php echo rand(10000,9999999);?>" rel="stylesheet" type="text/css">
  </head>
    
  <body class="actions">
    <div id="header">
      <table width="100%">
        <tr>
          <td></td>
          <td align="center" width="90%">
            <strong>
            <?php echo WK_RESTORE_FILE ?>
            </strong>
          </td>
          <td align="right">
            <a href="<?php echo Wiki::getConfig('wkHTTPPath')?>"> <?php echo WK_LABEL_HOME_WIKI;?></a>
          </td>
        </tr>
      </table>
    </div>
    <div id="content" class="actions">
<?php
      $entry = Wiki_PageDir::findBySeq($clean['seq']);
      if (!is_object($entry)) {
        $errors[] = WK_RESTORE_NO_FILE;
      }
      if (!$user->rights('restoreFiles')) {
        $errors[] = WK_RESTORE_NOT_AUTHORIZED;
      }
      if (!empty($errors)) {
        echo '<span class="errors">'.implode("<br>",  $errors) . '</span><br />';
      }
      if (!empty($results)) {
        echo $results.'<br />'; 
        $url = Wiki::getConfig('wkHTTPPath') . Wiki::getConfig('systemDir') . "/wk_lookup.php?seq=". $clean['seq'];
?>
        <br>
        <input type="button" class="btn" value="<?php echo WK_LABEL_BACK;?>" onclick="document.location='<?php echo $url;?>';" />
<?php
      } else if ($user->rights('restoreFiles') && is_object($entry)) {
?> 
        <form method="POST">
          <input type='hidden' name='back_url' value="<?php echo $back_url;?>">
          <input type='hidden' name='action' value="<?php if(isset($clean['action'])) echo $clean['action'];?>">
          <input type='hidden' name='seq' value="<?php if(isset($clean['seq'])) echo $clean['seq'];?>">
          <input type='hidden' name='num' value="<?php if(isset($clean['num'])) echo $clean['num'];?>">
          <input type='hidden' name='time' value="<?php if(isset($clean['time'])) echo $clean['time'];?>">
          <input type='hidden' name='doit' value="Y">
          <table>
          <tr>
            <td></td>
          </tr>
          <tr>
            <td>
<?php
              $msg = WK_RESTORE_DO . $entry->path() . WK_RESTORE_DATE . strftime("%c", $clean['time']);
              echo $msg
?> 
            </td>
          </tr>
          <tr>
            <td>
              <input type="button" class="btn" value="<?php echo WK_LABEL_CANCEL;?>" onclick="document.location='<?php echo $back_url;?>';" />
              <input class="btn" type="submit" name="Submit" value="<?php echo WK_LABEL_RESTORE; ?>" /
            </td>
          <tr>
          </table>
        </form>
<?php
      }
?> 
    </div>
  </body>
</html>
