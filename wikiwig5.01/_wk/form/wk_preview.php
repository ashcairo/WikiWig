<?php
  require_once '../wk_config.php';

  require_once '../lib/Wiki.php';
  require_once '../lib/Wiki_User.php';
  require_once '../lib/Wiki_PageDir.php';
  require_once '../lib/Wiki_History.php';

  if (!isset($_SESSION)) {
    session_start();
  }
  if (!isset($_SERVER['HTTP_REFERER'])) {
    $back_url ="Location: ". Wiki::getConfig('wkHTTPPath');
  } else {
    $back_url ="Location: ".$_SERVER['HTTP_REFERER'];
  }

  // This either gets us a registered user or a guest
  $user = Wiki_User::currentUser();

  if (!isset($_GET['seq_num']) || !isset($_GET['time']) || !ctype_digit($_GET['time'])) {
    header($back_url);
    exit;
  }
  $date = strftime("%c", $_GET['time']);
  $nums = explode("_", $_GET['seq_num']);
  if (count($nums) != 2 || !ctype_digit($nums[0]) || !ctype_digit($nums[0])) {
    exit;
  }
  $seq = array_shift($nums);
  $entry = Wiki_PageDir::findBySeq($seq);
  if (!is_object($entry)) {
    header($back_url);
    exit;
  }

  $page_full_path    = Wiki::getConfig('wkPath'). Wiki::getConfig('backupDir') . '/' . $_GET['seq_num'];
  $page_full_content = File::read($page_full_path);
  $err =array();
  if ($page_full_content===false) {
      $err[] = sprintf(WK_ERR_FILE_READ,$page_wiki_path);
      return $err;
  }
  $page_full_content = Wiki_Parser::getContent($page_full_content);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title><?php echo WK_LABEL_PREVIEW; ?> : </title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="../wk_style.css?refresh=<?php echo rand(5,4545464); ?>" rel="stylesheet" type="text/css">
  </head>
  <body>
    <!-- CONNECTION INDICATOR -->
    <div id="header">
      <table width="100%">
        <tr>
          <td></td>
          <td width="80%">
<?php
            $msg = WK_LABEL_PREVIEW_FILE . $entry->path() . WK_LABEL_PREVIEW_WHEN . strftime("%c", $_GET['time']);
            echo $msg;
?>
          </td>
          <td align="right">
            <a href='<?php echo $_SERVER['HTTP_REFERER']; ?>'><?php echo WK_LABEL_BACK; ?></a>
          </td>
        </tr>
      </table>
    </div>

    <!-- Content -->
<?php
      print $page_full_content;
?>
    </div>
  </body>
</html>
