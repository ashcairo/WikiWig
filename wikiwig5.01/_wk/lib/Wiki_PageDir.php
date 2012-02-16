<?php
  if (!class_exists('Wiki'))
    require_once dirname(__FILE__).'/Wiki.php';
  if (!class_exists('Wiki_DB'))
    require_once dirname(__FILE__).'/Wiki_DB.php';

  @define('WK_DIR_FIELD_ID', 'sequence');
  @define('WK_DIR_FIELD_NAME', 'path');
  @define('WK_DIR_FIELD_ACTIVE', 'active');
  @define('WK_DIR_FIELD_BACKUP', 'last_backup');

  // Maintain a directory of all pages ever existing in the wiki

  class Wiki_PageDir {
    var $seq = false;
    var $path = '';
    var $active = false;
    var $backup = 0;

    /**
     * Constructor PHP 4
     * Call the <code>__construct</code> method.
     * View <code>__construct</code> method for details.
     */
    function Wiki_Page($user_id) { $this->__construct($user_id);}
    /**
     * Constructor PHP 5
     */
    function __construct($user_id=false) {
    }


    function &findByPath($path='') {

      // Always use relative path and no suffix
      $rel_path = str_replace(rtrim(Wiki::getConfig('wkPath'), "/"), '', $path);
      // $rel_path = str_replace(".html", '', $rel_path);

      $db = Wiki_DB::getInstance();
      $table = Wiki::getConfig('dbPrefix') . "dir";

      // $path = "/". str_replace(Wiki::getConfig('wkPath'), '', $full_path. $clean_filename);
      $query_dir = "SELECT * FROM `". $table . "` WHERE " .  WK_DIR_FIELD_NAME . "= '" . $rel_path . "';" ;

      $res = $db->query($query_dir);
      if (empty($res)) {
        $res = false;
        return $res;
      }
      $entry = new Wiki_PageDir();
      $entry->seq = $res[0][WK_DIR_FIELD_ID];
      $entry->path = $res[0][WK_DIR_FIELD_NAME];
      $entry->active = $res[0][WK_DIR_FIELD_ACTIVE] == 'T';
      $entry->backup = $res[0][WK_DIR_FIELD_BACKUP];
      return $entry;
    }

    function update() {
      if ($this->seq === false) {
        return false;
      }
      $db = Wiki_DB::getInstance();
      $table = Wiki::getConfig('dbPrefix') . "dir";
      // Rewrite as active
      $query_update = "UPDATE `" . $table . "` SET ";
      $value = '';
      foreach (array_keys(get_object_vars($this)) as $vars) {
        if ($vars == 'seq') continue;
        if ($value != '') {
          $value .= ", ";
        }
        if ($vars == 'path') {
          $value .= WK_DIR_FIELD_NAME . "= '" . $this->path . "'";
        }
        if ($vars == 'backup') {
          $value .= WK_DIR_FIELD_BACKUP . "= '" . $this->backup . "'";
        }
        if ($vars == 'active') {
          $value .= WK_DIR_FIELD_ACTIVE . "= '" . ($this->active ? "T" : "F" ) . "'";
        }
      }
      $query_update .= $value .  " WHERE " . WK_DIR_FIELD_ID . " = '" . $this->seq . "';";
      // error_log("QUD: " . $query_update);
      return $db->execute($query_update);
    }

    function &findBySeq($seq='') {

      $db = Wiki_DB::getInstance();
      $table = Wiki::getConfig('dbPrefix') . "dir";

      // $path = "/". str_replace(Wiki::getConfig('wkPath'), '', $full_path. $clean_filename);
      $query_dir = "SELECT * FROM `". $table . "` WHERE " .  WK_DIR_FIELD_ID . "= '" . $seq . "';" ;

      $res = $db->query($query_dir);
      if (empty($res)) {
        $res = false;
        return $res;
      }
      $entry = new Wiki_PageDir();
      $entry->seq = $res[0][WK_DIR_FIELD_ID];
      $entry->path = $res[0][WK_DIR_FIELD_NAME];
      $entry->active = $res[0][WK_DIR_FIELD_ACTIVE] == 'T';
      return $entry;
    }

    function insert() {
      if (!is_object($this) || $this->seq !== false) {
        return false;
      }

      $db = Wiki_DB::getInstance();
      $table = Wiki::getConfig('dbPrefix') . "dir";
  
      $d = Wiki_PageDir::findByPath($this->path);
      if ($d !== false) {
        return WK_USER_EXISTS;
      }
      unset($d);

      $field_names = '';
      $values = '';
      foreach (array_keys(get_object_vars($this)) as $vars) {
        if ($vars == 'seq') continue;
        if ($values != '') {
          $values .= ",";
          $field_names .= ",";
        }
        if ($vars == 'path') {
          $values .= "'" . $db->escape_string($this->path) . "'";
          $field_names .= WK_DIR_FIELD_NAME;
        }
        if ($vars == 'backup') {
          $values .= "'" . $db->escape_string($this->backup) . "'";
          $field_names .= WK_DIR_FIELD_BACKUP;
        }
        if ($vars == 'active') {
          $values .= "'" . ($this->active ? "T" : "F" ) . "'";
          $field_names .= WK_DIR_FIELD_ACTIVE;
        }
      }
      $query_insert = "INSERT INTO `" . $table . "`" .
                            "(" . $field_names . ") VALUES(" . $values . ")" ;
       // error_log("INSERT: " . $query_insert);

      if ($db->execute($query_insert)) {
        $this->seq = $db->get_last_id();
        return true;
      } else {
        $dberror = array_pop($db->errors);
        return $dberror;
      }
    }

    function &createEntry($path = '') {
      if ($path == '') {
        return sprintf(WK_ERR_FILE_BADNAME, $path);
      }
      $entry = new Wiki_PageDir();
      $entry->set_path($path);
      $entry->set_active(true);
      $res = $entry->insert();
      // Did DB action succeed?
      if ($res !== true) {
        $err[] = $res;
        // Maybe someone beat us to it?
        $entry = Wiki_PageDir::findByPath($path);
        if (is_object($entry)) {
          return $entry;
        } 
        return $err;
      }
      return $entry;
    }

    function active() { return $this->active; }
    function set_active($state) { $this->active = $state; }

    function backup_id() { return $this->backup; }
    function set_backup_id($id) { $this->backup = $id; }

    function path() { return $this->path; }
    function set_path($path) {
      // Always use relative path keep the suffix so we can lookup any page in the wiki not just html
      $rel_path = str_replace(rtrim(Wiki::getConfig('wkPath'), "/"), '', $path);
      // $rel_path = str_replace(".html", '', $rel_path);
      $this->path = $rel_path;
    }

    // Never set seq except by insert into db
    function seq() { return $this->seq; }

  } // Wiki_PageDir

?>
