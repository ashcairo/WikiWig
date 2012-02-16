<?php
  /*
   * Created on 3 déc. 2004
   */
  if(!class_exists('File'))
    require_once dirname(__FILE__).'/File.php';

  class Dir {


    /**
     * List the files and subdirectories of a specified dir.
     *
     * @param string $dirpath defaults to the current working directory return
     * @param int $types: 2 => files
     *                    1 => directories
     *                    3 => both
     * @param int $levels : 0 => $path and all
     *                      1 => look in the $path only
     *                      2 =>$path and all children
     *                      3 => $path, children, grandchildren subdirectories;
     *                      less than 0 => complement of -$levels, OR everything starting -$levels down e. g.
     *                      -1 => everthing except $path;
     *                      -2 => all descendants except $path + children
     * Note: that directories are prefixed with a '*'. That can be eliminated from the line above the return
     * @return array : specified files/directories
     */
    function listDir($dirpath="", $types=2, $levels=1, $reserved_dirnames = array(), $allowed_extensions = array()) {
      $pathSep = '/';
      if (!@$dirpath)
        $dirpath = getcwd();
      $aRes = array();
      $aAcc = array();
      $aDir = array($dirpath);
      for ($i=$levels>0?$levels++:-1;$i--&&$aDir;$aDir=$aAcc,$aAcc=array()) {
        while ($dir = array_shift($aDir)) {
          foreach (Dir::scanDir ($dir,$reserved_dirnames) as $fileOrDir) {
            if ($fileOrDir!="." && $fileOrDir!="..") {
              if ($dirP = @is_dir($rp=$dir.$pathSep.$fileOrDir)) {
                $aAcc[] = $rp;
              }
              if ($i<$levels-1 && ($types & (2-$dirP))) {
                if (File::checkExtension($rp,$allowed_extensions) || $types != 2){
                  $aRes[] = str_replace($pathSep.$pathSep,$pathSep,$rp);
                }
              }
            }
          }
        } // while
      }
      return $aRes;
    } // listDir

    /**
     * An equivalent of the php.net/scandir (PHP5)
     * improved by a parameter to skip certain values
     *
     * @param string $dirname path to the directory to scan
     * @param array $reserved_names array of names for dirs or files to skip from result
     * @return array elements of the dir
     */
    function scanDir($dir,$reserved_names=array()) {
      $files = array();
      $fh = @opendir($dir);
      while (false !== ($filename = @readdir($fh))) {
        if ( !in_array(strtolower($filename),$reserved_names)){
          array_push($files, $filename);
        }
      }
      @closedir($fh);
      //var_dump($files);
      return $files;
    }

    /**
     *
     */
    function mkdirs($strPath, $mode=0777) {
      if (@is_dir($strPath)) return true;
      $pStrPath = dirname($strPath);
      if (!Dir::mkdirs($pStrPath, $mode))
        return false;
      return @mkdir($strPath, $mode);
    }

    /**
     * Copy a file, or recursively copy a folder and its contents
     *
     * @author      Aidan Lister <aidan@php.net>
     * @version     1.0.1
     * @param       string   $source    Source path
     * @param       string   $dest      Destination path
     * @return      bool     Returns TRUE on success, FALSE on failure
     */
    function copy($source, $dest) {
      // Simple copy for a file
      if (@is_file($source)) {
        return @copy($source, $dest);
      }

      // Make destination directory
      if (!@is_dir($dest)) {
        //echo $dest.' is not a dir => mkdir '.'<br />';
        @mkdir($dest);
      }

      // Loop through the folder
      $dir = dir($source);
      while (false !== $entry = $dir->read()) {
        //echo $entry.'<br />';
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
          continue;
        }

        // Deep copy directories
        if ($dest !== $source.'/'.$entry) {
          //echo "$dest !== $source.'/'.$entry => rcopy ".'<br />';
          Dir::copy($source.'/'.$entry, $dest.'/'.$entry);
        }
      }
      // Clean up
      $dir->close();
      return true;
    }
    /**
     *
     */
    function chmod($strPath, $mode=0777) {
      if (!@is_dir($strPath))
        return false;
      else
        return @chmod($strPath,$mode);
    }
    /**
     *
     *
     */
    function rmdir($dir) {
       $dh=opendir($dir);
       while ($file=readdir($dh)) {
         if ($file!="." && $file!="..") {
           $fullpath=$dir."/".$file;
           if (!@is_dir($fullpath)) {
             @unlink($fullpath);
           } else {
             Dir::rmdir($fullpath);
           }
         }
       }
       closedir($dh);

       if (@rmdir($dir)) {
         return true;
       } else { // not empty or not allowed
         return false;
       }
    }

    function isWritable( $dirname ) {
      if (substr(PHP_OS, 0, 3) != 'WIN')
        return @is_writable( $dirname );
      /* PHP function is_writable() doesn't work correctly on Windows NT descendants.
       * So we have to use the following hack on those OSes.
       * FIXME: maybe on Win9x we shouldn't do this?
       */
      $tmpfname = rtrim($dirname,'/') . '/' . "test_" . md5( microtime() ) . ".tmp";

      // try to create temporary file
      if ( !( $fp = @fopen( $tmpfname, "w" ) ) )
          return false;

      fclose( $fp );
      unlink( $tmpfname );

      return true;
    }

    function cleanName($dirname) {
      $clean_dirname = preg_replace('/[^\w\d-]/si','_',$dirname); // strip non word chars
      $clean_dirname = trim($clean_dirname);
      if (!strstr(PHP_OS, "WIN"))
        $clean_dirname = str_replace(' ',"\\ ",$clean_dirname); // escape spaces under *nix
      return $clean_dirname;
    }

    /**
     * Strips .. or . strings in path if able to
     * @param string $path the path to clean
     * @param string $separator filsystem dir separator, by default / will be
     * used
     * @return string cleaned path
     */
    function cleanPath($path,$separator='/') {
      $pathElements = explode($separator, $path);
      $newPathElements = array();
      foreach($pathElements as $pathElement) {
        if ($pathElement == '.')
          continue;
        if (($pathElement == '..') && (count($newPathElements) > 0))
          array_pop($newPathElements);
        else
          $newPathElements[] = $pathElement;
      }
      if (count($newPathElements) ==0 )
        $newPathElements[]= '.';
      $path = implode($separator,$newPathElements);
      return $path;
    }
  } // Dir

// Standalone testing
/*
$empty = array();
$exts = array('php');
$res = Dir::listDir(dirname(__FILE__),2,0,$empty,$exts);
echo '<pre>'.print_r($res,true).'</pre>';
foreach($res as $r){
    echo '<br/>Is file ? : '.is_file($r);
}
*/
?>
