<?php

//  // WHAT is the point of this file?
//
//  require_once 'wk_config.php';
//  require_once 'lib/Wiki_Strings.php';
//  require_once 'lib/Wiki.php';
//  //phpinfo();
//  /*session_cache_expire(7 * 24 * 3600);
//  if (!isset($_SESSION)) {
//    session_start();
//  }
//  session_set_cookie_params(7 * 24 * 3600);*/
//  /*if(!isset($_SESSION['ip'])) $_SESSION['ip'] = $REMOTE_ADDR;*/
//  //print_r($_COOKIE);
//
//  if(!isset($_COOKIE['nom'])) {
//    $_SESSION['nom'] = Wiki_Strings::genPass();
//    setcookie('nom', $_SESSION['nom'],time()+Wiki::getConfig('userCookieTime'),'/');
//    //header("Location: wk_liste.php");
//    header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//    exit();
//  } else {
//    $_SESSION['nom'] = $_COOKIE['nom'];
//  }
	
  // CAUTION : NEVER ADD ANYTHING AFTER THE "? >" - IT CAUSES AN "HEADERS ALREADY SENT" ERROR (when this file is included in wk_liste.php)
?>