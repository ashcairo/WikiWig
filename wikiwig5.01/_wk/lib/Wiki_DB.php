<?php
  if(!class_exists('Wiki'))
    require_once dirname(__FILE__).'/Wiki.php';
  // Error codes
  @define("DB_SERVER_CONNECTION_ERROR", 0);
  @define("DB_CONNECTION_ERROR", 1);
  @define("DB_QUERY_ERROR", 2);

  class Wiki_DB{
    function &getInstance($dbType=false,$infos_connection=array()) {
      if($dbType === false)
        $dbType = Wiki::getConfig('dbType');
      if(!empty($infos_connnection)){
        $dbHost = $infos_connection['dbHost'];
        $dbName = $infos_connection['dbName'];
        $dbUser = $infos_connection['dbUser'];
        $dbPass = $infos_connection['dbPass'];
      } else {
        $dbHost = Wiki::getConfig('dbHost');
        $dbName = Wiki::getConfig('dbName');
        $dbUser = Wiki::getConfig('dbUser');
        $dbPass = Wiki::getConfig('dbPass');
      }
      switch($dbType){
        case 'mysql' :
          require_once dirname(__FILE__).'/database/DB_MySQL.php';
          $ret =& new DB_MySQL($dbHost,$dbUser,$dbPass,$dbName);
          return $ret;
        default :
          return false;
      }
    } // getInstance


    function &getDB($dbType=false,$infos_connection=array()) {
      return Wiki_DB::getInstance($dbType,$infos_connection);
    }
  } // Wiki_DB
/*
// standalone testing
$WK = array();
$WK['dbType'] = 'mysql';
$WK['dbHost'] = 'localhost';
$WK['dbName'] = 'wikitest_install';
$WK['dbUser'] = 'root';
$WK['dbPass'] = '';
$db = Wiki_DB::getDB();
$res = $db->query('SELECT * FROM wk_pages');
var_dump($res);
var_dump($db);
*/
?>
