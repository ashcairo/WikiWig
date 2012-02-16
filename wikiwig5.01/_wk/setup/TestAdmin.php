<?php
  require_once '../lib/Wiki_DB.php';
  require_once '../lib/Wiki.php';
  require_once '../wk_config.php';


  $db=Wiki_DB::getInstance();
  $requete="SELECT * FROM ".Wiki::getConfig('table_utilisateurs')." WHERE utilisateurs_nom LIKE 'admin_%'";
  $res=$db->query($requete);
  $admin="admin_";
  $result= split('_',$res[0]['utilisateurs_nom']);

  if ($result=== 0){ //if is admin
    $tpl_config['admin']  ='{WK_CONF_ADMIN_LOGIN|adminLogin|string|pas là}'; // ok

  } else {
   $tpl_config['adminLogin']           = '{WK_CONF_ADMIN_LOGIN|adminLogin|string|admin}';     // WK_CONF_ADMIN_LOGIN_DESC
   $tpl_config['adminPass']            = '{WK_CONF_ADMIN_PASS|adminPass|protected|admin}';    // WK_CONF_ADMIN_PASS_DESC
   $tpl_config['adminMail']            = '{WK_CONF_ADMIN_MAIL|adminMail|string}';             // WK_CONF_ADMIN_MAIL_DESC
  }
  return sizeof($tpl_config);
?>