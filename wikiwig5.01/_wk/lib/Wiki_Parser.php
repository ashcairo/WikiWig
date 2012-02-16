<?php
  if (!class_exists('Wiki'))
    require_once dirname(__FILE__).'/Wiki.php';

  @define('REG_HREFS','/(?<=href=["\']).+?(?=["\'])/i');
  @define('REG_SRCS','/(?<=src=["\']).+?(?=["\'])/i');
  @define('WK_REG_CONTENT','/(?<=<div id=["\']contenu["\']>).+(?=<\/div>[\W]*<\/body>)/si');
  @define('WK_REG_HEAD_TITLE','/(?<=<title>).+(?=<\/title>)/si');

  class Wiki_Parser extends Wiki{
    /**
     * Constructors (PHP 4/5)
     *
     */
    function Wiki_Parser() {
      $this->__construct();
    }
    function __construct() {
      parent::__construct();
    }

    function getContent($html_content) {
      $patterns = array();
      if (preg_match(WK_REG_CONTENT,$html_content,$patterns)){
        return $patterns[0];
      } else
        return false;
    }

    function replaceContent($old_full_content,$new_wiki_content) {
      return preg_replace(WK_REG_CONTENT,$new_wiki_content,$old_full_content);
    }

    function getHeadTitle($html_content) {
      $patterns = array();

      if (preg_match(WK_REG_HEAD_TITLE,$html_content,$patterns)){
        $title = split('-', $patterns[0]);
        return $title[0];
        // huh?
        return $patterns[1];
      } else {
        return false;
      }
    }
}
?>
