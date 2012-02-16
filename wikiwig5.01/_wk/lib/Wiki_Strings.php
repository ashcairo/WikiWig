<?php

  class Wiki_Strings{

    function changeSlashes($str) {
      if(strstr(PHP_OS, "WIN")) {
        return str_replace("/","\\",$str);
      } else {
        // Warning: don't take care of escaped characters like spaces
        // maybe wrong ?
        return str_replace("\\","/",$str);
      }
    }

    function convertSeparators( $path, $separator='/' ) {
      return str_replace( array( '/', '\\' ), $separator, $path );
    }
    
    /**
     * Transliteration method
     *
     * replaces special language chars to US-ASCII chars
     *
     * @param string $string string to transform
     * @return string transliterated string
     */
    function transliterate($string) {
      $translation_table = array( "�" => "Y", "�" => "u", "�" => "A", "�" => "A",
                                  "�" => "A", "�" => "A", "�" => "A", "�" => "A",
                                  "�" => "A", "�" => "C", "�" => "E", "�" => "E",
                                  "�" => "E", "�" => "E", "�" => "I", "�" => "I",
                                  "�" => "I", "�" => "I", "�" => "D", "�" => "N",
                                  "�" => "O", "�" => "O", "�" => "O", "�" => "O",
                                  "�" => "O", "�" => "O", "�" => "U", "�" => "U",
                                  "�" => "U", "�" => "U", "�" => "Y", "�" => "s",
                                  "�" => "a", "�" => "a", "�" => "a", "�" => "a",
                                  "�" => "a", "�" => "a", "�" => "a", "�" => "c",
                                  "�" => "e", "�" => "e", "�" => "e", "�" => "e",
                                  "�" => "i", "�" => "i", "�" => "i", "�" => "i",
                                  "�" => "o", "�" => "n", "�" => "o", "�" => "o",
                                  "�" => "o", "�" => "o", "�" => "o", "�" => "o",
                                  "�" => "u", "�" => "u", "�" => "u", "�" => "u",
                                  "�" => "y", "�" => "y", "�" => "c");
        $tr_string  = strtr($string, $translation_table);
        return $tr_string;
      } // transliterate
        
    /**
     *
     *
     */
    function cleanFSString($string) {
      // cleans slashes and antislashes
      $string = preg_replace('#[/\\\\]#','',$string);
      // cleans space + space
      $string = preg_replace('/[ ]{2,}/',' ',$string);
      // cleans beginning or end spaces
      $string = trim($string);
      // cleans special chars
      $string  = Wiki_Strings::transliterate($string);
      return $string;
    }

    function translateSpecialChars($string='') {
      $tr_string = Wiki_Strings::transliterate($string);
      return $tr_string;
    }

    /**
     *
     *
     */
    function genPass() {
      $consonnes='bcdfgjklmnpqrstvxz';
      $voyelles='aeiouy'; 
      for ($i=0; $i < 7; $i++) {
        mt_srand((double) microtime() * 1000000); 
        $consonne[$i] = substr($consonnes, mt_rand(0, strlen($consonnes)-1), 1);
        $voyelle[$i] = substr($voyelles, mt_rand(0, strlen($voyelles)-1), 1);
      } 
      return $consonne[0] . $voyelle[4] .$consonne[3] . $consonne[1] . $voyelle[0] . $consonne[2];
    }

    /**
     * returns the size of a file
     */
    function DownloadSize($file) {
      $size = filesize($file);
      $sizes = Array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
      $ext = $sizes[0];
      for ($i=1; (($i < count($sizes)) && ($size >= 1024)); $i++) {
        $size = $size / 1024;
        $ext  = $sizes[$i];
      }
      return round($size, 2).' '.$ext;
    }

    /**
     * returns the size of a file
     */
    function returnFileSize($sizeInBytes,$precision=2){
      return ($sizeInBytes < 1024)?"$sizeInBytes octets":round(($sizeInBytes / pow(1024,floor(log($sizeInBytes,1024)))),$precision)." ".substr(" KMGT",log($sizeInBytes,1024),1). WK_LABEL_BYTES;
    }
        
    /**
     * correct url encoding
     */
    function url_encode($bad_url) {
      return str_replace("%2F","/",str_replace("%5C","/",rawurlencode($bad_url)));
    }
  } // Wiki_Strings
?>
