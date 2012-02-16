<?php
  /*
   * Created on 17 déc. 2004
   */
  $current_path = str_replace("\\","/",__FILE__) ;
  $dir_lang = dirname($current_path) . '/lang/';
  if(!isset($WK['lang'])) {
    $WK['lang'] = 'fr'; // use default french
  }
  $lang = 'fr';
  switch ($WK['lang']) {
    case 'fr':
    case 'de':
    case 'en':
      $lang = $WK['lang'];
      break;
    default ;

  }
  $file_lang = $dir_lang . $lang . '.php';
  if(@is_file($file_lang)){ 
    require_once $file_lang;
  } else {
    // bad inclusion, no config found
  }

// CAUTION : NEVER ADD ANYTHING AFTER THE "? >" - IT CAUSES AN "HEADERS ALREADY SENT" ERROR (when this file is included in wk_liste.php)
?>