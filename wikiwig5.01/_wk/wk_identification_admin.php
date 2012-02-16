<?php
  require_once 'wk_config.php';
  require_once 'lib/Wiki.php';
  require_once 'lib/Wiki_User.php';
  require_once 'lib/Wiki_DB.php';
  if (!isset($_SESSION)) {
    session_start();
  }

  function login_error($host,$php_self, $num, $back) {
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
          <html>
            <head>
              <title>'.$host.' :  '.WK_ADMIN_AUTH_REQUIRED.'</title> 


              <link href="wk_style.css" rel="stylesheet" type="text/css"/>
            </head>
            <body class="actions">

              <br/>
                <div id="header"><strong>'.WK_ADMIN_AUTH_REQUIRED.'</strong></div>
                <div id="content">
                  <strong>'.WK_ADMIN_AUTH_INSTRUCTIONS.'</strong><br/>


                  <span id="red">  '.WK_ADMIN_AUTH_ERROR.'</span>
                  <strong>'. sprintf(WK_ADMIN_AUTH_RETRY,( $_SERVER['PHP_SELF']."?".$back)).'<strong>
                </div>

              </body>

            </html>';
    exit();

  } // login_error

  // Logout whoever is logged in.
  Wiki_User::logout();

  $clean = array();
  if (isset($_POST['u_name']) && ctype_alnum($_POST['u_name'])) {
    $clean['u_name'] = $_POST['u_name'];
  }
  if (isset($_POST['u_password']) && ctype_graph($_POST['u_password'])) {
    $clean['u_password'] = $_POST['u_password'];
  }
  /// ???
  if (isset($_POST['back'])) {
    $clean['back'] = $_POST['back'];
  } else if (isset($_SERVER["QUERY_STRING"]) && ($_SERVER["QUERY_STRING"] != '')) {
    $clean['back'] = $_SERVER['QUERY_STRING'];
  } else {
    $clean['back'] = Wiki::getConfig('systemDir') . "/wk_admin.php";
  }


  if(isset($clean['u_name'])) {
    if (!isset($clean['u_password'])) {
      login_error($_SERVER['HTTP_HOST'],$_SERVER['PHP_SELF'], 1, $clean['back']);
    } else {
      $user = Wiki_User::findByUserName($clean['u_name']);
      if (is_object($user)  && $user->authenticate($clean['u_password'], true)) { 
        $user->login(false); // never persistent
        // User is privileged
        header ('Location: http://' . $_SERVER['HTTP_HOST'] . $clean['back']);
        exit;
      } else {
        login_error($_SERVER['HTTP_HOST'],$_SERVER['PHP_SELF'], 2, $clean['back']);
      }
    }
  }

?>
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
      <html>
        <head>
          <title><?php echo $_SERVER['HTTP_HOST']; ?> : <?php echo WK_ADMIN_AUTH_REQUIRED; ?></TITLE>
                                  <link href="wk_style.css" rel="stylesheet" type="text/css"/>
        </head>
        <body>

        <div id="header"><strong><?php echo WK_ADMIN_AUTH_REQUIRED; ?></strong>
        </div>
        <center>
          <form method="POST" >
            <input type="hidden" name="back" value="<?php echo $clean['back']; ?>">
            <table id="formulaire">
              <tr>
                <td><strong><?php echo WK_ADMIN_AUTH_LABEL_LOGIN; ?> : </strong></td>
                <td>
                  <input type="text" name="u_name" size="20" value="">
                 </td>
              </tr>
              <tr>
                <td>
                  <strong><?php echo WK_ADMIN_AUTH_LABEL_PASSWORD; ?> : </strong></font>
                </td>
                <td>
                  <input type="password" name="u_password" value="" size="20">
                </td>
              </tr>
              <td></td><td><input type="submit" value="Login"></td>
            </table>
          </form>
        </center>
      </body>
    </html>
