<?php

  require_once '../wk_config.php';
  require_once '../lib/Wiki_User.php';
  require_once '../lib/Wiki_DB.php';
  if ($WK['captcha'] == 're') {
    require_once '../captcha/recaptchalib.php';
    @define('WK_CAPTCHA_SITE', 'captcha_site');
    @define('WK_CAPTCHA_KEY_PUBLIC', 'captcha_key1');
    @define('WK_CAPTCHA_KEY_PRIVATE', 'captcha_key2');
    $db = Wiki_DB::getInstance();
    $captcha_table = Wiki::getConfig('dbPrefix') . "captcha";
    $query_captcha = "SELECT * FROM `". $captcha_table . "`  WHERE " . 
                      WK_CAPTCHA_SITE . " = '". $db->escape_string(Wiki::getConfig('wkName')) . "'; ";
    $keys = $db->query($query_captcha);
    if ( empty($keys)) {
      // Disable reCaptcha because it wasn't fully configured
      $WK['captcha'] = 'php';
      error_log("reCaptcha not fully configured. Using phpCaptch instead.");
    } else {
      $privatekey = $keys[0][WK_CAPTCHA_KEY_PRIVATE];
      $publickey = $keys[0][WK_CAPTCHA_KEY_PUBLIC];
    }
  }
  if ($WK['captcha'] == 'php') {
    require_once '../captcha/captcha.php';
  }

  if (!isset($_SESSION)) {
    session_start();
  }
  if (!isset($WK['wkHTTPSPath'])) {
    $WK['wkHTTPSPath'] = $WK['wkHTTPPath'];
  }
  $changer = $WK['wkHTTPSPath'] . $WK['systemDir'] . '/form/wk_changer_profil.php' ;


  $login_pattern = '/^[a-z0-9_]+$/i';
  $pswd_pattern = '/^[^\s]+$/';

  // keep the refering page in order to restore it after the login process
  // if the self is in the referer then this referer has not to be kept
  // if the referer is not from the same server or if it does not exist, then go to the map
  if (isset($_SERVER['HTTP_REFERER'])) {
    if (!strstr($_SERVER['HTTP_REFERER'], $_SERVER["SERVER_NAME"]) OR $_SERVER['HTTP_REFERER']=="" OR !isset($_SERVER['HTTP_REFERER'])) {
      $_SESSION['referer'] = $WK['wkHTTPPath'] . $WK['systemDir'] . "/wk_liste.php";
    } elseif (!strstr($_SERVER['HTTP_REFERER'], $_SERVER["PHP_SELF"]) ) {
      $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
      //echo "<!-- referer ok -->";
    }
  }
  $referer = isset($_SESSION['referer']) ? $_SESSION['referer'] : $WK['wkHTTPPath'];

  $titre_page=""; $login_new=""; $mail_new=""; $errors="";

  /* ######################################################################################################################################################
     #######################################################      BEGINNING OF (USER WANTS TO USE A EXISTING PROFILE => LOGIN) CASE   #########################
     ######################################################################################################################################################  */

  // --------------------------
  // User has typed his login and password, we need to check if the login exists and if the pass is correct
  // --------------------------

  if (key_exists('login', $_POST) && $_POST['login']!= "") {
    $clean = array();
    $remember = isset($_POST['session']) && $_POST['session'] == 'remember';
    // if (ctype_alnum($_POST['login'])) 
    if (preg_match($login_pattern, $_POST['login']) ) {
      $clean['login'] = $_POST['login'];
    }
    if (ctype_print($_POST['password'])) 
    if (preg_match($pswd_pattern, $_POST['password']) ) {
      $clean['password'] = $_POST['password'];
    }
    if (!isset($clean['password'])) {
      $errors=WK_PROFILE_ERROR_ENTER_PASSWORD;
    } else {
      // -- do this login/password exist
      $user = Wiki_User::findByUserName($clean['login']);
      if (!is_object($user)  || !$user->authenticate($clean['password'], false)) { 
        $errors=WK_PROFILE_ERROR_LOGIN_DONTEXISTS;
       // cause the form to be filled out again with username
       $_GET['fillform'] = 1;
      } else{
        $user->login($remember);
        header("Location: ". $referer);
      }
    } // Does login/pswd exist
  } elseif (key_exists('login_new', $_POST) && $_POST['login_new']!= "") {
    
    
    // --------------------------
    // User has typed parameters to create a new account : login/pwd/pwd2/email, we'll record him
    // --------------------------
    $clean = array();
    if (preg_match($login_pattern, $_POST['login_new']) ) {
      $clean['login_new'] = $_POST['login_new'];
    }
    if (preg_match($pswd_pattern, $_POST['password_new']) ) {
      $clean['password_new'] = $_POST['password_new'];
    } else {
      $clean['password_new'] = '';
    }
    $email_pattern = '/^[^@\s<&>]+@([-a-z0-9]+\.)[a-z]{2,}$/i';
    $email_pattern1 = '/^[^@\s<&>]+@([-a-z0-9]+)$/i';
    if (preg_match($email_pattern, $_POST['mail_new']) ) {
      $clean['mail_new'] = $_POST['mail_new'];
    } else if (preg_match($email_pattern1, $_POST['mail_new']) ) {
      $clean['mail_new'] = $_POST['mail_new'];
    } else {
      $clean['mail_new'] = '';
    }
    $captcha_invalid = false;
    if ($WK['captcha'] == 'php' && !captcha::solved()) {
      $captcha_invalid = true;
    } else if ($WK['captcha'] == 're' ) {
      $resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
      $captcha_invalid = !$resp->is_valid;
    }

    if (!isset($clean['login_new'])) {
      $errors=WK_PROFILE_ERROR_ENTER_VALID_LOGIN;
    } else if ($clean['password_new']=="") {
      $errors=WK_PROFILE_ERROR_ENTER_NEW_PASSWORD;
    } else if ($captcha_invalid) {
      $errors=WK_PROFILE_ERROR_NOT_SOLVED;
    } else {
      if ($_POST['passwordbis_new']=="" || $clean['password_new'] != $_POST['passwordbis_new']) {
        $errors=WK_PROFILE_ERROR_ENTER_NEW_PASSWORD_CHECK;
      } else {
        if ($clean['mail_new']=="" && $WK['approval'] == 'email' ) {
          $errors=WK_PROFILE_ERROR_ENTER_EMAIL;
        } else {
          // do this login exist already ?
          // -- do this login exist
          if ($user = Wiki_User::findByUserName($clean['login_new']) ) {
            $errors=WK_PROFILE_PSEUDO_USED_TITLE;
          } else {
            // account creation
            // number to check the user's email
            $user = new Wiki_User();
            if ($WK['approval'] == 'email' ) {
              // In theory we could have a race creating a user id
              $cnt= 0;
              do {
                $cnt++;
                $number = rand(0,10000);
                $user->fillin($number, md5($clean['password_new']), $clean['mail_new']);
                $res = $user->insert();
              } while ($res === WK_USER_EXISTS && $cnt != 10);
              if ($cnt > 10 || $res === false ) {
                $errors=WK_PROFILE_CREATION_ERROR;
              } else {
                // Send an email 
                // connection session creation
                $titre = WK_PROFILE_MAIL_TITLE;
                $corps = WK_PROFILE_MAIL_BODY_PART0 ."\n\n" .
                         WK_PROFILE_MAIL_BODY_PART1 .
                         " \"" . $WK['wkName'] . "\" " .
                         WK_PROFILE_MAIL_BODY_PART2 .
                         "\n" . $changer . "?number=$number&pseudo=" . $clean['login_new'];

                $result = mail($clean['mail_new'], $titre, $corps,
                               "From: webmaster@wikiwig.sourceforge.net\n"
                               ."Reply-To: webmaster@{$_SERVER['SERVER_NAME']}\r\n"
                               ."X-Mailer: PHP/" . phpversion());

                if ($result) {
                  $errors = WK_PROFILE_ERROR_SUCCESS_PART1 . " (" . $clean['mail_new'] . ") " . WK_PROFILE_ERROR_SUCCESS_PART2;
                } else {
                  $errors = WK_PROFILE_ERROR_MAILNOTSENT ." <br><br>" . $titre . "<br><br>" . $corps;
                }
              }
            } else if ( $WK['approval'] == 'admin') {
              $user->fillin($clean['login_new'], md5($clean['password_new']), $clean['mail_new']);
              $res = $user->insert();
              if ($res === WK_USER_EXISTS ) {
                $errors=WK_PROFILE_PSEUDO_USED_TITLE;
              } else {
                $errors = WK_PROFILE_ERROR_SUCCESS_ADMIN;
                $user->login($false);
              }
            } else {
              // blind approval
              $user->fillin($clean['login_new'], md5($clean['password_new']), $clean['mail_new']);
              $res = $user->insert();
              if ($res === WK_USER_EXISTS ) {
                $errors=WK_PROFILE_PSEUDO_USED_TITLE;
              } else {
                $errors = WK_PROFILE_ERROR_SUCCESS;
                // Call the authenicate method since it will do all the right session/cookie stuff
                $user->login(false);
              }
            }
          }
        }
      }
    }
  } elseif (isset($_GET['deconnect'])) {
    // --------------------------
    // the user wants to disconnect
    // --------------------------
    // unset the session
    Wiki_User::logout();
    // If they loged out don't send them to a page that will cause authorization
    if (strpos($referer, "wk_user.php") !== false || 
        strpos($referer, $WK['systemDir'] . "/setup") !== false ||
        strpos($referer, "wk_admin.php") !== false ) {
      header("Location: ". $WK['wkHTTPPath']);
    } else {
      header("Location: ". $referer);
    }
  } elseif(key_exists('number', $_GET) && $_GET['number']!= "") {
    // --------------------------
    // User has received its confirmation mail following its account creation
    // --------------------------
    // -- do this number exists
    if (!ctype_digit($_GET['number']) || ! (preg_match($login_pattern, $_GET['pseudo']))) {
      $errors=WK_PROFILE_CREATION_ERROR;
    } else {
      $user = Wiki_User::findByUserName($_GET['number']);
      if (! $user) {
        // $errors="Cette confirmation n'existe pas";
        // Not exactly the same error but not bad
        $errors=WK_PROFILE_CREATION_ERROR;
      } else {
        $user->set_name($_GET['pseudo']);
        $res = $user->update();
        if ( $res == false) {
          // $errors="Pb de validation ";
          // Not exactly the same error but not bad
          $errors=WK_PROFILE_CREATION_ERROR;
        } else {
          $user->update_user_session();
          $user->set_auth_cookie(false);
          $errors=WK_PROFILE_ERROR_SUCCESS;
        }
      }
    }
  } if (isset($_GET['a'])) {
    switch($_GET['a']){
      case "modifier":
        $clean = array();
        if (isset($_POST['login_mod']) && ctype_alnum($_POST['login_mod'])) {
          $clean['login_mod'] = $_POST['login_mod'];
        }
        if (isset($_POST['password_old']) && ctype_print($_POST['password_old'])) {
          $clean['password_old'] = $_POST['password_old'];
        }
        if (isset($_POST['password_new']) && ctype_print($_POST['password_new'])) {
          if (isset($_POST['password_new2']) && $_POST['password_new'] == $_POST['password_new2']) {
            $clean['password_new'] = $_POST['password_new'];
          } else {
            $errors = WK_PROFILE_CONNECTED_MODIF_ERROR3;
            break;
          }
        }
        // name@xxx.xxx
        $email_pattern = '/^[^@\s<&>]+@([-a-z0-9]+\.)[a-z]{2,}$/i';
        // name@xxx
        $email_pattern1 = '/^[^@\s<&>]+@([-a-z0-9]+)$/i';
        if (isset($_POST['mail_new']) && 
            (preg_match($email_pattern, $_POST['mail_new']) || 
             preg_match($email_pattern1, $_POST['mail_new']))) {
          $clean['mail_new'] = $_POST['mail_new'];
        }
        if (!isset($clean['login_mod']) || !isset($clean['password_old']) || !isset($clean['password_new'])) {
          $errors = WK_PROFILE_CONNECTED_MODIF_ERROR;
        } else {
          $mod_user = Wiki_User::findByUserName($clean['login_mod']);

          if (is_object($mod_user)  && $mod_user->authenticate($clean['password_old'])) { 
            $mod_user->set_password($clean['password_new']);
            $mod_user->set_email(isset($clean['mail_new']) ? $clean['mail_new'] : '');
            if ($mod_user->update() === false) {
              $errors = WK_PROFILE_CONNECTED_MODIF_ERROR;
            } else {
              if (isset($_SESSION['user_name'])) {
                $current_user = Wiki_User::findByUserName($_SESSION['user_name']);
              } else {
                $current_user ='';
              }
              if (!is_object($current_user) || $current_user->user_name() != $mod_user->user_name()) {
                $mod_user->login(Wiki_User::validLoginCookie());
              }
            }
          } else {
            $errors = WK_PROFILE_CONNECTED_MODIF_ERROR2;
          }
        }
        $clean = array();
        break;
      default:
    } // switch
  }

// ----------------------------------------------------------
// BEGINNING OF THE HEADER
// ------------------------------------------------------------------>
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo $titre_page;?></title>
    <link href="../wk_style.css" rel="stylesheet" type="text/css">

    <script language="JavaScript" src="../js/dreamweaver.js"></script>
  </head>

  <body>
<?php
    // if the user has a session with a username set
    if (isset($_SESSION['user_name'])) {
?>
      <div id="header">
        <img src='../images/perso_bleu.gif'>
        <b> <?php echo WK_LABEL_WELCOME; ?> </b>&nbsp;&nbsp;&nbsp;
        <a href=<?php echo $referer ?>>
          <?php echo WK_LABEL_BACK; ?>
        </a>&nbsp;&nbsp;&nbsp;
        <a href='<?php echo $changer; ?>?deconnect=1'>
          <?php echo WK_LABEL_LOGOUT; ?>
        </a>
      </div>
<?php
    } else {
?>
      <div id="header">
        <img src='../images/perso_bleu.gif'>
        <b>
          <?php echo WK_LABEL_LOGIN; ?>
        </b>&nbsp;&nbsp;&nbsp;
        <a href=<?php echo $referer ?>>
          <?php echo WK_LABEL_BACK; ?>
        </a>
      </div>
<?php
    }

    // ----------------------------------------------------------
    // BEGINNING OF THE FORMS (login & account creation)
    // ------------------------------------------------------------------>

    // if the user is a guest (he is not connected and he did not just validated)-> display forms
    if ((!isset($_SESSION['user_name']))) {
       $cookieNom = "";
       if (isset($_GET['fillform'])) {
         $cookieNom = Wiki_User::nameFromCookie();
       }
?>
      <form id="form1" name="form1" method="POST" action="<?php echo $changer; ?>" style="width: 500px;" onsubmit="return validForm(this);">
        <table border="0">
          <tr>
            <td width="30">&nbsp;</td>
<?php
            if (isset($_GET['fillform'])) {
?>
              <input name="fillform" type="hidden" value="1" >
              <br/>
              <a href='<?php echo $changer; ?>'>
                &nbsp;&nbsp;<?php echo WK_PROFILE_CREATION_WISHTOCREATE; ?>
              <a/>
              <td>
                <br/>
                <span><?php echo WK_PROFILE_CREATION_WISHTOLOG; ?> :<br /><br /></span>

                <table border="0" cellspacing="0" cellpadding="0" style="width: 600px;">
                  <tr valign="top">
                    <td></td>
                    <td height="29" width="130"><?php echo WK_PROFILE_LABEL_NAME; ?> : </td>
                    <td>
                      <input name="login"
                             type="text" class="chps"
                             maxlength="255"onBlur="MM_validateForm('login','','R');return document.MM_returnValue"
                             value="<?php echo $cookieNom; ?>">
                     </td>
                  </tr>
                  <tr valign="top">
                    <td></td>
                    <td height="29"><?php echo WK_PROFILE_LABEL_PASSWORD; ?> : </td>
                    <td> <input name="password" type="password" class="chps" value="" maxlength="255"> </td>
                    <td> </td>
                  </tr>
                </table>
                <br/>
              </td>
<?php
             } else {
?>
                <br/>
                <a href='<?php echo $changer; ?>?fillform=1'>
                  &nbsp;&nbsp;<?php echo WK_PROFILE_CREATION_WISHTOLOG; ?>
                <a/>
              <td>
                <br>
                <span><?php echo WK_PROFILE_CREATE_INSTRUCTIONS; ?><br /><br /></span>
                <span><?php echo WK_PROFILE_CREATION_WISHTOCREATE; ?> :<br /><br /></span>
                <table border="0" cellspacing="0" cellpadding="0" style="width: 500px;">
                  <tr valign="top">
                    <td height="29" width:"100"><?php echo WK_PROFILE_LABEL_NAME; ?> : </td>
                    <td> <input name="login_new" type="text" class="chps" value="<?php echo $login_new; ?>" maxlength="255"> </td>
                    <td></td>
                  </tr>
                  <tr valign="top">
                    <td height="29"><?php echo WK_PROFILE_LABEL_PASSWORD; ?> : </td>
                    <td> <input name="password_new" type="password" class="chps" value="" maxlength="255"> </td>
                    <td> </td>
                  </tr>
                  <tr valign="top">
                    <td height="29"><?php echo WK_PROFILE_LABEL_PASSWORD_VERIF; ?> : </td>
                    <td> <input name="passwordbis_new" type="password" class="chps" value="" maxlength="255"> </td>
                    <td> </td>
                  </tr>
                  <tr valign="top">
                    <td height="29">E-Mail : </td>
                    <td>
                      <input name="mail_new"
                             type="text"
                             class="chps"
                             value="<?php echo $mail_new; ?>"
                             maxlength="55">&nbsp;
<?php
                        if ( $WK['approval'] == 'email' ) {
?>
                          <img src='../images/antispam_1.png'
                               alt='<?php echo WK_PROFILE_ANTISPAM_CONFIRMATION; ?>'
                               title='<?php echo WK_PROFILE_ANTISPAM_CONFIRMATION; ?>'
                               align='absmiddle' />
<?php
                        }
?>
                        <img src='../images/antispam_2.png'
                             alt='<?php echo WK_PROFILE_ANTISPAM_PRIVACY; ?>'
                             title='<?php echo WK_PROFILE_ANTISPAM_PRIVACY; ?>'
                             hspace='20'
                             align='absmiddle' />
<?php
                        if ( $WK['approval'] == 'email' ) {
?>
                          <img src='../images/antispam_3.png'
                               alt='<?php echo WK_PROFILE_ANTISPAM_UNSUSCRIBE; ?>'
                               title='<?php echo WK_PROFILE_ANTISPAM_UNSUSCRIBE; ?>'
                               align='absmiddle' />
<?php
                        }
?>
                    </td>
                    <td rowspan="2" align="center"> </td>
                    <tr>
                    <td> </td>
                    <td>
<?php
                    if($WK['captcha'] == 'php') print captcha::form("<small>&larr; <?php echo WK_PROFILE_CAPTCHA_MSG; ?>:</small><br/>");
?>
                    </td>
                    </tr>
                  </tr>
                </table>
              </td>
<?php
             }
?>
          </tr>
<?php
          if (isset($_GET['fillform'])) {
?>
            <tr>
              <td></td>
              <td>
                &nbsp;
                <input type=checkbox name="session" class=check <?php echo  Wiki_User::validLoginCookie() ? 'checked' : ''; ?>
                       value="remember" >
                &nbsp;<?php echo WK_PROFILE_REMEMBER; ?>
              </td>
            </tr>
<?php
          }
?>
          <tr valign="top">
            <td height="29">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr valign="top">
            <td colspan="2">
              <input class="btn" type="submit" name="Submit" value="<?php echo WK_LABEL_VALIDATE; ?>">
              <input class="btn"
                     type="button"
                     value="<?php echo WK_LABEL_CANCEL; ?>"
                     onclick="document.location='<?php echo $referer ?>';">
            </td>
            <td></td>
          </tr>
        </table>
      </form>
<?php
    } else { // if the user is connected
      // $name = $_SESSION['user_name'];
      $current_user = Wiki_User::findByUserName($_SESSION['user_name']);
      $name = $current_user->user_name();
?>
      <table border='0'>
        <tr>
          <td width='30'>&nbsp;</td>
          <td colspan='2' >
            <span>
<?php
              echo WK_PROFILE_CONNECTED_AS . " <b>" . $name . "</b> <br><br>" . WK_PROFILE_CONNECTED_INFO_PART1 . "<br />" .
                   WK_PROFILE_CONNECTED_INFO_PART2 . " <img src='../images/eyes_open2.gif'><br />" .
                   WK_PROFILE_CONNECTED_INFO_PART3 . " <img src='../images/warn.gif'><br><br ";
?>
            </span>
          </td>
        </tr>
<?php
?>
        <form method="POST" action="<?php echo $changer; ?>?a=modifier" >
          <td>&nbsp;</td>
          <td colspan="2" ><?php echo WK_PROFILE_UPDATE_TITLE2; ?>:<br /><br/></td>
          <tr valign="top">
            <td>&nbsp;</td>
            <td height="29" width:"100"><?php echo WK_PROFILE_LABEL_NAME; ?> : </td>
            <td>
              <input name="login_mod" type="text" class="chps" value="<?php  echo $name; ?>" maxlength="255">
            </td>
          </tr>
          <tr valign="top">
            <td>&nbsp;</td>
            <td height="29"><?php echo WK_PROFILE_LABEL_PASSWORD; ?> : </td>
            <td>
              <input name="password_old" type="password" class="chps" value="<?php $pwd1; ?>" maxlength="255">
            </td>
          </tr>
          <tr valign="top">
            <td>&nbsp;</td>
            <td height="29"><?php echo WK_PROFILE_LABEL_NEW_PASSWORD; ?> : </td>
            <td>
              <input name="password_new" type="password" class="chps" value="<?php $pwd1; ?>" maxlength="255">
            </td>
          </tr>
          <tr valign="top">
            <td>&nbsp;</td>
            <td height="29"><?php echo WK_PROFILE_LABEL_PASSWORD_VERIF; ?> : </td>
            <td>
              <input name="password_new2" type="password" class="chps" value="<?php $pwd2; ?>" maxlength="255">
            </td>
          </tr>
          <tr valign="top">
            <td>&nbsp;</td>
            <td height="29">E-Mail : </td>
            <td>
              <input name="mail_new"
                     type="text"
                     class="chps"
                     value="<?php echo $current_user->email(); ?>"
                     maxlength="55">&nbsp;
<?php
                if ( $WK['approval'] == 'email' ) {
?>
                  <img src='../images/antispam_1.png'
                       alt='<?php echo WK_PROFILE_ANTISPAM_CONFIRMATION; ?>'
                       title='<?php echo WK_PROFILE_ANTISPAM_CONFIRMATION; ?>'
                       align='absmiddle' />
<?php
                }
?>
                <img src='../images/antispam_2.png'
                     alt='<?php echo WK_PROFILE_ANTISPAM_PRIVACY; ?>'
                     title='<?php echo WK_PROFILE_ANTISPAM_PRIVACY; ?>'
                     hspace='20'
                     align='absmiddle' />
<?php
                if ( $WK['approval'] == 'email' ) {
?>
                  <img src='../images/antispam_3.png'
                       alt='<?php echo WK_PROFILE_ANTISPAM_UNSUSCRIBE; ?>'
                       title='<?php echo WK_PROFILE_ANTISPAM_UNSUSCRIBE; ?>'
                       align='absmiddle' />
<?php
                }
?>
            </td>
          </tr>
          <tr valign="top">
            <td height="29">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr valign="top">
            <td>&nbsp;</td>
            <td colspan="2">
              <input class="btn" type="submit" name="Submit" value="<?php echo WK_LABEL_VALIDATE; ?>">
              <input class="btn" type="button" value="<?php echo WK_LABEL_CANCEL; ?>" onclick="document.location='<?php echo $referer ?>';">
            </td>
          </tr>
        </form>
      </table>
    </div>
  </body>
</html>

<?php }
 if ($errors != "") {
   echo "<font color='red'>$errors</font>";
 }

?>
