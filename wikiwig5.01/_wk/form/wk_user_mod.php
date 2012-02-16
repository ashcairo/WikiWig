<?php
  require_once '../wk_config.php';
  require_once '../lib/Wiki.php';
  require_once '../lib/Wiki_User.php';
  if (!isset($_SESSION)) {
    session_start();
  }

  $user = false;
  if (isset($_SESSION['user_name'])) {
    $name = $_SESSION['user_name'];
    $user = Wiki_User::findByUserName($name);
  }
  if (!is_object($user) || !$user->privileged() ) {
    require_once '../wk_identification_admin.php';
    exit;
  }
  if (array_key_exists("Delete", $_POST)) {
    $del = Wiki_User::findByUserName($_POST['user_name']);
    if (is_object($del)) {
      $del->delete();
    } else {
      // Error
    }
  } else if (array_key_exists("Update", $_POST)) {
    $mod = Wiki_User::findByUserName($_POST['user_name']);
    if (is_object($mod)) {
      $rights = $mod->access_rights;
      foreach ($rights as $name => $db_right) {
        $mod->$name = array_key_exists($name, $_POST);
      }
      $mod->privileged = array_key_exists("utilisateurs_privilege", $_POST);
      $mod->update();
    } else {
      // Error
    }
  }


   header('Location: http://' . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . '/../wk_user.php');
  exit();
?>
