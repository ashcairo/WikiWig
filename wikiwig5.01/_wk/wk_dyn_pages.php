<?php
  include_once dirname(__FILE__).'/wk_config.php';

  // asking for css
  if(isset($_GET['css'])) {
    header('Content-type: text/css; charset=iso-8859-1');
    @include dirname(__FILE__).'/'.$WK['css_wiki'];
  }
  // asking for javascript
  if(isset($_GET['js'])){
    include_once dirname(__FILE__).'/lib/filesystem/Dir.php';
    header('Content-type: text/javascript');
    @include dirname(__FILE__).'/wk_chemin-de-fer.php';
  }

?>
