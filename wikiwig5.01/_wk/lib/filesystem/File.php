<?php
/*
 * Created on 3 déc. 2004
 */

  class File {

    function checkExtension($filename,$ext = array()) {
      $file_ext = substr(strrchr($filename, "."), 1);
      if (is_array($ext)) {
        return (in_array($file_ext,$ext) || in_array('.'.$file_ext,$ext));
      } else
        return (($file_ext == $ext)||('.'.$file_ext == $ext));
    }

    function read($filepath) {
      if ($fp = @fopen($filepath,'r')){
        $buffer = ''; // buffer initialisation
        while (!@feof ($fp)) {
          $buffer.= @fgets($fp, 4096);
        }
        @fclose($fp);
        return $buffer;
      } else
        return false;
    }

    function write($filepath,$content='',$permissions=0777) {
      // attempt to write the file
      if ($fp = @fopen($filepath,'w+')) {
        @fwrite($fp, $content);
        @fclose($fp);
        @chmod($filepath,$permissions);
        return true;
      } else
        return false;
    }
    function chmod($filepath, $mode=0777) {
      if (!@is_file($filepath))
        return false;
      else
        return @chmod($filepath,$mode);
    }
  } // File
?>
