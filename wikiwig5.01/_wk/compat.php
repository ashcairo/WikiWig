<?php

  // PHP < 4.1.0
  ///////////////
  // Predefined Variables
  if (!isset($_POST))    $_POST    = &$HTTP_POST_VARS;
  if (!isset($_GET))     $_GET     = &$HTTP_GET_VARS;
  if (!isset($_SESSION)) $_SESSION = &$HTTP_SESSION_VARS;
  if (!isset($_COOKIE))  $_COOKIE  = &$HTTP_COOKIE_VARS;
  if (!isset($_SERVER))  $_SERVER  = &$HTTP_SERVER_VARS;

  // Set Magic quotes to off
  // keeps compatibility between different configurations
  //
  if (get_magic_quotes_gpc()) {
    if(!function_exists('stripslashes_recursive')){
      function stripslashes_recursive($value) {
        $value = is_array($value) ?  array_map('stripslashes_recursive', $value) : stripslashes($value);
        return $value;
      }
    }
    $_POST    = array_map('stripslashes_recursive', $_POST);
    $_GET     = array_map('stripslashes_recursive', $_GET);
    $_COOKIE  = array_map('stripslashes_recursive', $_COOKIE);
  }
  if (!isset($_REQUEST)) {
    $_REQUEST = array();
    // by default, gpc order, 
    //FIXME: look to ini settings to get gpc order
    $_REQUEST = $_GET;
    $_REQUEST = array_merge($_REQUEST,$_POST);
    $_REQUEST = array_merge($_REQUEST,$_COOKIE);
  }

  // PHP < 4.3.0
  ///////////////
  if (!function_exists('file_get_contents')) {
    function file_get_contents($filename, $use_include_path = 0) {
      $file = fopen($filename, 'rb', $use_include_path);
      $data = '';
      if ($file) {
        while (!feof($file)) {
          $data .= fread($file, 4096);
        }
        fclose($file);
      }
      return $data;
    }
  }

  // PHP < 4.3.4
  ///////////////
  // Include Path separator
  if ( !defined('PATH_SEPARATOR') ) {
    define('PATH_SEPARATOR', ( substr(PHP_OS, 0, 3) == 'WIN' ) ? ';' : ':');
  }

  // CAUTION : NEVER ADD ANYTHING AFTER THE "? >" - IT CAUSES AN "HEADERS ALREADY SENT" ERROR (this file is included in wk_liste.php)
?>