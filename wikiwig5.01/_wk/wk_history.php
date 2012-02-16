<?php
  require_once 'wk_config.php';

  require_once 'lib/Wiki.php';
  require_once 'lib/Wiki_User.php';
  require_once 'lib/Wiki_PageDir.php';
  require_once 'lib/Wiki_History.php';

  if (!isset($_SESSION)) {
    session_start();
  }

  // This either gets us a registered user or a guest
  $user = Wiki_User::currentUser();

  if (isset($_GET['seq'])) {
    $seq = $_GET['seq'];
  } else if (isset($_GET['seq'])) {
    $seq = $_GET['seq'];
  }
  if (!isset($seq) || !ctype_digit($seq)) {
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
  }
  $back_url = Wiki::getConfig('wkHTTPPath') . Wiki::getConfig('systemDir') . "/wk_lookup.php?seq=$seq" ;

  $page_limit = 25;
  // Figure the bounds on the user array to use
  if (isset($_GET['first_index']) && ctype_digit($_GET['first_index'])) {
    $low_limit = $_GET['first_index'] ;
    $hi_limit = $low_limit + $page_limit;
  } else {
    $low_limit = 1;
    $hi_limit = $low_limit + $page_limit;
  }

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title><?php echo WK_HISTORY_TITLE; ?> : </title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <script language="JavaScript" src="js/ajaxChat.js"></script>
    <script language="JavaScript" src="js/domUtils.js"></script>
    <script language="JavaScript" src="js/tooltip.js"></script>
    <script language="JavaScript" src="js/dreamweaver.js"></script>

    <link href="wk_style.css?refresh=<?php echo rand(5,4545464); ?>" rel="stylesheet" type="text/css">
  </head>
  <body>
    <!-- CONNECTION INDICATOR -->
    <div id="header">
      <a href='<?php echo $back_url; ?>'><?php echo WK_LABEL_BACK; ?></a>
    </div>

    <!-- Content -->
      <h1>
      <?php echo WK_HISTORY_TITLE; ?>
      </h1>
<?php
      $history = Wiki_History::findBySeq($seq);
      // History Display
      //////////////////
      if (!empty($history)) {
        $history_count = count($history);
?>
        <!-- History Table -->
        <table width="80%" id="datatable" cellspacing="1" >
          <!-- Header -->
          <thead>
          <td></td>
          <td align="left"><?php echo WK_HISTORY_USER; ?></td>
          <td width="25%" align="left"><?php echo WK_HISTORY_WHEN; ?></td>
          <td width="10%" align="left"><?php echo WK_HISTORY_ACTION; ?></td>
          <td align="left"><?php echo WK_HISTORY_COMMENT; ?></td>
          </thead>

          <!-- Tbody -->
          <tbody>
<?php
            $index_history = 0;
            foreach($history as $h ) {
              $index_history++;

              if ($index_history < $low_limit || $index_history >= $hi_limit) continue;

              $tr_class = '';
?>
              <tr class="<?php echo $tr_class; ?>">
                <td></td>
                <td>
<?php
                echo $h->who();
?>
                </td>
                <td>
<?php
                echo strftime("%c", $h->when());
?>
                </td>
                <td>
<?php
                $form = false;
                if ($user->rights('restoreFiles')) {
                  $form = $WK['wkHTTPSPath'] . $WK['systemDir'] . "/form/wk_restore.php?time=" . $h->when . "&seq=" . $h->seq(); 
                  switch ($h->action()) {
                    case "DELETED" :
                      $form .= "&action=DEL";
                      break;
                    case "BACKUP" :
                      // Comment is FILE: seq_NUM ...
                      preg_match("/[0-9]+_[0-9]+/", $h->comment(), $seq_num);
                      if (is_array($seq_num)) {
                        $seq_num = array_shift($seq_num);
                      }
                      $num = ereg_replace("[0-9]+_", '', $seq_num);
                      $backup_full_path = Wiki::getConfig('wkPath') . Wiki::getConfig('backupDir') . "/" . $seq_num;
                      $mtime = @filemtime($backup_full_path);
                      // If the history time matches the modification time within 1 second then we say the file
                      // matches the history entry and can be restored.
                      if ( abs($mtime - $h->when()) <= 1) {
                        $form .= "&action=UPD&num=$num";
                      } else {
                        $form=false;
                        unset($seq_num);
                      }
                      break;
                    default: $form=false;
                  }
                }
                if ($form === false) {
                  echo $h->action();
                } else {
                  $form = "<a href=$form>" . $h->action() . "</a>";
                  echo $form;
                }
?>
                </td>
                <td>
<?php
                if (isset($seq_num)) {
                  $form = $WK['wkHTTPSPath'] . $WK['systemDir'] . "/form/wk_preview.php?seq_num=" . $seq_num;
                  $form .= "&time=" . $h->when();
                  $form = "<a href=$form>" . $h->comment() . "</a>";
                  echo $form;
                } else {
                  echo $h->comment;
                }
?>
                </td>
              </tr> <!-- class= $tr_class -->
<?php
        } // foreach
        if (count($history) > $page_limit) {
          // Do we need a prev button?
          $prev_disabled = ($low_limit == 1 ) ? "disabled" : "" ;
          $next_disabled = ($hi_limit >= count($history))  ? "disabled" : "" ;
?>
          <tr>
            <td class="cel3">
            </td>
            <td class="cel3">
              <form name="search" method="GET" action="wk_history.php">
                <input type="hidden" name="seq" value="<?php echo $seq;?>">
                <input type="hidden" name="first_index" value="<?php echo $low_limit - $page_limit;?>">
                <input type="submit" value="<?php echo WK_PREV;?>" <?php echo $prev_disabled;?> >
                <input type="hidden" name="back_url" value="<?php echo $back_url;?>">
              </form>
            </td>
            <td class="cel3">
              <form name="search" method="GET" action="wk_history.php">
                <input type="hidden" name="seq" value="<?php echo $seq;?>">
                <input type="hidden" name="first_index" value="<?php echo $hi_limit;?>">
                <input type="submit" value="<?php echo WK_NEXT;?>" <?php echo $next_disabled;?> >
                <input type="hidden" name="back_url" value="<?php echo $back_url;?>">
              </form>
            </td>
          </tr>
<?php
          }
?>
        </tbody>
      </table>
<?php
    } else { // $history not empty
?>
      <h2> <?php echo WK_HISTORY_NONE;?>
<?php
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
