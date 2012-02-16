<?php
  require_once '../wk_config.php';
  require_once '../lib/Wiki_User.php';
  require_once '../lib/Wiki_DB.php';

  if (!isset($_SESSION)) {
    session_start();
  }
  $titre_page="";

  // keep the refering page in order to restore it after the login process
  // if the self is in the referer then this referer has not to be kept
  if (!strstr($_SERVER['HTTP_REFERER'], $_SERVER["PHP_SELF"]) ) {
    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
    //echo "<!-- referer ok -->";
  }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo $titre_page;?></title>
    <link href="../wk_style.css" rel="stylesheet" type="text/css">

  </head>

  <body>
<?php


    // --------------------------
    // User wants to warn users that he modified the page : we ask him to confirm
    // --------------------------
    if (isset($_GET['warn'])) {
      if ($_GET['warn']=="1") {
        // retrieve list of user who monitor this page (their pseudo only)
        $db = Wiki_DB::getInstance();
        $sql_get_monitordedPages = "SELECT * FROM `".Wiki::getConfig('table_pages')."` ".
                                   "WHERE pages_nom='".$db->escape_string('MONITOR-' . $_GET['page'])."';";
        $monitordedPages = $db->query($sql_get_monitordedPages);
        // nobody monitors this page
        if (empty($monitordedPages)) {
          $pseudos="";
        } else {
          // record the pseudo list for future reference (alert sending)
          $_SESSION['usersToWarn'] = $monitordedPages;
          // create the pseudo list in order to display it
          $pseudos = $monitordedPages[0]['pages_utilisateur'];
          $i=1;
          while(isset($monitordedPages[$i]['pages_utilisateur'])) {
            $pseudos .= ", " . $monitordedPages[$i]['pages_utilisateur'];
            $i++;
          }
        }
?>
        <div id="header"><img src='../images/warn.gif' />
          <b>&nbsp;<?php echo WK_MONITORING_WARN; ?></b>
          &nbsp;&nbsp;&nbsp;
          <a href='<?php echo $_SESSION['referer']; ?>'><?php echo WK_LABEL_BACK; ?></a>
        </div>

        <table border="0">
          <tr>
            <td width="30">&nbsp;</td>
            <td>
              <?php echo WK_MONITORING_WARN_INFO; ?><br /><br />
<?php
              if ($pseudos != "") {
                echo WK_MONITORING_USERSLIST . " <br /><b>$pseudos</b>";
              } else {
                echo "<b>" . WK_MONITORING_EMPTYLIST . "</b>";
              }
?>
              <br /><br />

              <form id="form1" name="form1" method="GET" action="wk_monitor.php" style="width: 500px;" onsubmit="return validForm(this);">
<?php

                echo "<input type='hidden' name='warn' value='2'>";
                echo "<input type='hidden' name='page' value='" . $_GET['page'] . "'>";

?>
                <!--
                  <span><?php echo WK_MONITORING_ADDITIONAL_USERS; ?></span>
                  <input name="login"
                         type="text"
                         class="chps"
                         onBlur="MM_validateForm('login','','R');return document.MM_returnValue"
                         value="<?php if (isset($login)) echo $login; ?>"
                         maxlength="255">
                  <i><?php echo WK_MONITORING_OPTIONNAL; ?></i>
                  <br /><?php echo WK_MONITORING_MAIL_EXAMPLE; ?>
                -->


<?php
                if ($pseudos != "") {
                  echo "<input class='btn' type='submit' name='Submit' value=\"" . WK_MONITORING_WARN . "\">";
                }
?>
                <input class="btn" type="button" value="<?php echo WK_LABEL_CANCEL; ?>" onclick="document.location='<?php echo $_SESSION['referer']; ?>';">
              </form>
            </td>
          </tr>
        </table>

<?php
      } elseif($_GET['warn']=="2") {
        // --------------------------
        // User warns users that he modified the page : he has confirmed (see above)
        // --------------------------
        echo "<div id='header'><img src='../images/warn.gif'><b>&nbsp;" .
             WK_MONITORING_WARN .
             "</b>&nbsp;&nbsp;&nbsp;<a href='" .
             $_SESSION['referer'] .
             "'>" . WK_LABEL_BACK . "</a></div>";
        // ---- here, we use $_SESSION['usersToWarn'] (created when $_GET['warn']=="1") to get the list of users to warn
        // retrieve list of user who monitor this page (emails)

        $i=0;
        $db = Wiki_DB::getInstance();
        while(isset($_SESSION['usersToWarn'][$i]['pages_utilisateur'])) {
          // one users' pseudo
          $pseudo = $_SESSION['usersToWarn'][$i]['pages_utilisateur'];
          // retrieve his email
          $user = Wiki_User::findByUserName($pseudo);

          if (!is_object($user)) {
            echo "WK_ERR_STANDARD"; // if this user do not exists, it means that his monitoring should be destroyed (user has unsubscribe ?)
          } else {
            // retrieve email corresponding to each pseudo
            $email = $user->email();
            $title = "[Wikiwig] " . $_SESSION['user_name'] . " " . WK_MONITORING_WARN_MAIL_ALERTYOU;

            $body = WK_MONITORING_WARN_MAIL_PART0 . " $pseudo, \n\n";
            $body .= $_SESSION['user_name'] . " " . WK_MONITORING_WARN_MAIL_PART1 . " " . $WK['wkHTTPPath'] . $_GET['page'] . " " . WK_MONITORING_WARN_MAIL_PART2 . " \n\n\n";
            $body .= WK_MONITORING_WARN_MAIL_PART3 . " \"" . $WK['wkName']. "\".\n";

            $mail_result = mail($email, $title, $body,
                               "From: webmaster@wikiwig.sourceforge.net\n"
                                ."Reply-To: webmaster@{$_SERVER['SERVER_NAME']}\r\n"
                                ."X-Mailer: PHP/" . phpversion());
            if ($mail_result) {
              echo "&nbsp; " . WK_MONITORING_WARN_MAILRESULTOK . " " . $pseudo . "<br />";
            } else {
              echo "&nbsp;<font color='red'>" . WK_MONITORING_WARN_MAILRESULTNOK . " <b>" . $pseudo . "</b></font><br />";
              echo "&nbsp;" . WK_MONITORING_WARN_MAILRESULTNOK2 . " $title <br />$body<br ><br />";
            }
          }

          $i++;
        } // while
      } // $_GET['warn']=="2"
    } elseif(isset($_GET['stopmonitoring'])) {
      // --------------------------
      // User do not wants to monitor a page anymore
      // --------------------------
      $db = Wiki_DB::getInstance();
      $requete = "DELETE FROM `".Wiki::getConfig('table_pages')."` WHERE pages_nom='".$db->escape_string('MONITOR-' . $_GET['page'])."';";
      $res = $db->execute($requete);
      if (!$res) echo WK_ERR_STANDARD;

?>
      <div id="header">
        <img src='../images/eyes_closed.gif'><b>&nbsp;<?php echo WK_MONITORING_MONITOR_STOP; ?></b>&nbsp;&nbsp;&nbsp;
        <a href='<?php echo $_SESSION['referer']; ?>'><?php echo WK_LABEL_BACK; ?></a>
      </div>

      <table border="0">
        <tr>
          <td width="30">&nbsp;</td>
          <td>
            <?php echo WK_MONITORING_MONITOR_STOP_CONFIRM; ?><br>
          </td>
        </tr>
      </table>

<?php
    } elseif(isset($_GET['monitor'])) {
      // --------------------------
      // User wants to monitor a page
      // --------------------------
      // insertion
      $db = Wiki_DB::getInstance();
      $requete = "INSERT INTO `".Wiki::getConfig('table_pages')."` " .
                 " (pages_nom, pages_temps, pages_utilisateur) " .
                 " VALUES ('".
                           $db->escape_string('MONITOR-' . $_GET['page']).
                           "', '', '".
                           $db->escape_string($_SESSION['user_name']).
                         "');";
      $res = $db->execute($requete);
      if (!$res) echo WK_ERR_STANDARD;
?>


      <div id="header">
        <img src='../images/eyes_open2.gif'><b>&nbsp;<?php echo WK_MONITORING_MONITOR_START; ?></b>&nbsp;&nbsp;&nbsp;
        <a href='<?php echo $_SESSION['referer']; ?>'><?php echo WK_LABEL_BACK; ?></a>
      </div>

      <table border="0">
        <tr>
          <td width="30">&nbsp;</td>
          <td>
            <?php echo WK_MONITORING_MONITOR_START_CONFIRM; ?><br><?php echo WK_MONITORING_MONITOR_START_INFO; ?>
          </td>
        </tr>
      </table>

<?php
    } elseif($_GET['sendwarn']) {
      echo WK_MONITORING_WARN_MAILSENT_CONFIRM;
    }

    if (isset($errors)) {
      echo "<font color='red'>$errors</font>";
    }

?>

  </body>
</html>
