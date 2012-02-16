<?php
  require_once 'wk_identification.php';
  require_once 'wk_config.php';
  require_once 'wk_protect.php';

  require_once 'lib/Wiki.php';
  require_once 'lib/Wiki_User.php';

  if (!isset($_SESSION)) {
    session_start();
  }
  $rights_strings  = array ( "renameFolders" => WK_ADMIN_RENAME_FOLDERS,
                             "renameFiles" =>  WK_ADMIN_RENAME_FILES,
                             "moveFolders" => WK_ADMIN_MOVE_FOLDERS,
                             "moveFiles" =>  WK_ADMIN_MOVE_FILES,
                             "deleteFolders" => WK_ADMIN_DELETE_FOLDERS,
                             "deleteFiles"  =>  WK_ADMIN_DELETE_FILES,
                             "createFolders" => WK_ADMIN_CREATE_FOLDERS,
                             "createFiles"  =>  WK_ADMIN_CREATE_FILES,
                             "restoreFiles"  =>  WK_ADMIN_RESTORE_FILES,
                             "editFiles"  =>  WK_ADMIN_EDIT_FILES);

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
      $redirection_url = WK_HTTPPATH . $WK['systemDir'] . '/wk_identification_admin.php?' . $_SERVER['PHP_SELF'];
    }
    header("Location: ".$redirection_url);
    exit;
  }

  $clean['user_name'] = $user->user_name();

  $rights = $user->access_rights;
  $page_limit = 13;
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
      <?php echo WK_USER_ADMIN; ?>
      </h1>
      <form name="search" method="GET" action="wk_user.php">
        <table id="datatable" cellspacing="0">
          <tr>
            <td class="cel3">
            </td>
            <td class="cel3">
              <input type="text" name="sname" value="">
            </td>
            <td class="cel3">
              <input type="submit" value="<?php echo WK_SEARCH;?>">
            </td>
          </tr>
        </table>
      </form>
<?php
      $db=Wiki_DB::getInstance();
      // Should we search or just scan the list
      if (isset($_GET['sname']) && $_GET['sname'] != "" ) {
        if (ctype_alnum($_GET['sname'])) {
          $clean['sname'] = $_GET['sname'];
          $requete="SELECT * FROM " . Wiki::getConfig('table_users') .
                   " WHERE " . WK_USER_FIELD_NAME . " LIKE '" . $db->escape_string($clean['sname']) . "';" ;
        }
      } else {
        $requete="SELECT * FROM " . Wiki::getConfig('table_users') .
                 " ORDER BY " . WK_USER_FIELD_NAME . ";" ;
      }
      // error_log("req: " . $requete);
      $users=$db->query($requete);
      // Users Display
      //////////////////
      if (!empty($users)) {
        $user_count = count($users);
?>
        <!-- Users Table -->
        <table id="datatable" cellspacing="0">
          <!-- Header -->
          <thead>
            <tr>
              <td class="cel3">
              </td>
              <td class="cel3">
              </td>
              <td class="cel3">
              </td>
<?php
              foreach ($rights as $name => $db_right) {
?>
                <th>
<?php
                  echo $rights_strings[$name];
?>
                </th>
<?php
              }
?>
              <th>
<?php
                echo WK_ADMIN_ADMIN;
?>
              </th>
            </tr>
          </thead>

          <!-- Tbody -->
          <tbody>
<?php
            $index_user = 0;
            foreach($users as $k => $person) {
              $index_user++;

              if ($index_user < $low_limit || $index_user >= $hi_limit) continue;

              $tr_class = '';
              $user_name = $person[WK_USER_FIELD_NAME];
?>
              <tr class="<?php echo $tr_class; ?>">
                <td class="cel3">
                </td>
                <td class="cel3">
<?php
                  // Shouldn't be able to delete/update yourself
                  if ($user_name != $clean['user_name'] ) {
?>
                    <form name="userlist" method="POST" action="form/wk_user_mod.php">
                      <input type="hidden" name="user_name" value="<?php echo $user_name;?>">
                      <input type="submit" name= "Delete" value="<?php echo WK_DELETE;?>">
<?php
                  }
?>
                </td>
                <td class="cel3">
<?php
                  // Shouldn't be able to delete/update yourself
                  if ($user_name != $clean['user_name'] ) {
?>
                    <form name="userlist" method="POST" action="form/wk_user_mod.php">
                      <input type="submit" name="Update" value="<?php echo WK_UPDATE;?>">
<?php
                  }
?>
                </td>
<?php
                foreach ($rights as $name => $db_right) {
                  // error_log("name: " . $name . " => " . $db_right);
                  $checked = $person[$db_right] == 'T' ? 'checked' : '';
?>
                  <td class="cel3">
                    <input type="checkbox"
                            id="<?php echo $name;?>"
                            name="<?php echo $name;?>"
                            value="<?php echo $name?>"
                            class="check"
<?php
                            echo $checked;
?>
                            title="<?php echo "BOX-RIGHT"; ?>">
                  </td>
<?php
                } // foreach right
?>
                <td class="cel3">
<?php
                  $checked = $person[WK_USER_FIELD_PRIVILEGED] == 'T' ? 'checked' : '';
                  $name = WK_USER_FIELD_PRIVILEGED;
?>
                  <input type="checkbox"
                          id="<?php echo  $name;?>"
                          name="<?php echo $name;?>"
                          value="<?php echo $name?>"
                          class="check"
<?php
                          echo $checked;
?>
                          title="<?php echo "BOX-RIGHT"; ?>">
                </td>
                <td class="cel3">
<?php
                  echo $user_name;
?>
                </td>
                <td class="cel3">
<?php
                  echo $person[WK_USER_FIELD_EMAIL];
                  if ($user_name != $clean['user_name'] ) {
?>
                    </form>
<?php
                  }
?>
                </td>
              </tr> <!-- class= $tr_class -->
<?php
        } // foreach
        if (count($users) > $page_limit) {
          // Do we need a prev button?
          $prev_disabled = ($low_limit == 1 ) ? "disabled" : "" ;
          $next_disabled = ($hi_limit >= count($users))  ? "disabled" : "" ;
?>
          <tr>
            <td class="cel3">
            </td>
            <td class="cel3">
              <form name="search" method="GET" action="wk_user.php">
                <input type="hidden" name="first_index" value="<?php echo $low_limit - $page_limit;?>">
                <input type="submit" value="<?php echo WK_PREV;?>" <?php echo $prev_disabled;?> >
              </form>
            </td>
            <td class="cel3">
              <form name="search" method="GET" action="wk_user.php">
                <input type="hidden" name="first_index" value="<?php echo $hi_limit;?>">
                <input type="submit" value="<?php echo WK_NEXT;?>" <?php echo $next_disabled;?> >
              </form>
            </td>
          </tr>
<?php
          }
?>
        </tbody>
      </table>
<?php
    } else { // $users not empty
      if (isset($_GET['sname']) && $_GET['sname'] != "" ) {
?>
      <h2> <?php echo $_GET['sname'] . " not found" ?> </h2?>
<?php
      }
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
