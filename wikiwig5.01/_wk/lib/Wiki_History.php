<?php
  if (!class_exists('Wiki'))
    require_once dirname(__FILE__).'/Wiki.php';
  if (!class_exists('Wiki_DB'))
    require_once dirname(__FILE__).'/Wiki_DB.php';
  if (!class_exists('Wiki_User'))
    require_once dirname(__FILE__).'/Wiki_User.php';
  if (!class_exists('Wiki_PageDir'))
    require_once dirname(__FILE__).'/Wiki_PageDir.php';

  @define('WK_HISTORY_FIELD_ID', 'history_id'); // unique key in DB completely ignored by wiki
  @define('WK_HISTORY_FIELD_PAGE_ID', 'sequence');
  @define('WK_HISTORY_FIELD_ACTION', 'action');
  @define('WK_HISTORY_FIELD_WHO', 'user');
  @define('WK_HISTORY_FIELD_WHEN', 'time');
  @define('WK_HISTORY_FIELD_COMMENT', 'comment');


  // Maintain a directory of all pages ever existing in the wiki

  class Wiki_History {
    var $seq = false;
    var $action = '';
    var $user = '';
    var $when = 0;
    var $comment = '';

    /**
     * Constructor PHP 4
     * Call the <code>__construct</code> method.
     * View <code>__construct</code> method for details.
     */
    function Wiki_History($user_id) { $this->__construct($user_id);}
    /**
     * Constructor PHP 5
     */
    function __construct($user_id=false) {
    }


    function &findByPath($path='') {

      $entry = Wiki_PageDir::findByPath($path);
      if (is_object($entry)) {
        $entries = Wiki_History::findBySeq($entry->seq());
        return $entries;
      }
      return false;
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
        if ($vars == 'active') {
          $value .= WK_DIR_FIELD_ACTIVE . "= '" . ($this->active ? "T" : "F" ) . "'";
        }
      }
      $query_update .= $value .  " WHERE " . WK_HISTORY_FIELD_PAGE_ID . " = '" . $this->seq . "' AND" .
                                             WK_HISTORY_FIELD_WHEN . " = '" . $this->when . "';";
      return $db->execute($query_update);
    }

    function fill($info) {
      $this->seq = $info[WK_HISTORY_FIELD_PAGE_ID];
      $this->action = $info[WK_HISTORY_FIELD_ACTION];
      $this->who = $info[WK_HISTORY_FIELD_WHO];
      $this->when = $info[WK_HISTORY_FIELD_WHEN];
      $this->comment = $info[WK_HISTORY_FIELD_COMMENT];
    }

    function &findBySeq($seq='') {

      $db = Wiki_DB::getInstance();
      $table = Wiki::getConfig('dbPrefix') . "history";

      // $path = "/". str_replace(Wiki::getConfig('wkPath'), '', $full_path. $clean_filename);
      $query_dir = "SELECT * FROM `". $table . "` WHERE " .  WK_HISTORY_FIELD_PAGE_ID . "= '" . $seq . "'" .
                  " ORDER BY " . WK_HISTORY_FIELD_WHEN . " DESC;" ;

      $res = $db->query($query_dir);
      if (empty($res)) {
        $dberror = array_pop($db->errors);
        error_log("fail $dberror");
        return false;
      }
      $entries = array();
      foreach ($res as $h) {
         // error_log("H: " . print_r($h, true));
        $entry = new Wiki_History();
        $entry->fill($h);
        $entries[] = $entry;
      }
      return $entries;
    }

    function record_entry_by_seq($seq = false, $action = '', $comment = '', $user = false) {

      if ($seq === false) return false;
      $now = time();
      if ($user === false) {
        $u = Wiki_User::currentUser();
        $user = $u->user_name();
        unset($u);
      }

      $db = Wiki_DB::getInstance();
      $table = Wiki::getConfig('dbPrefix') . "history";

      $field_names = WK_HISTORY_FIELD_PAGE_ID . ", ";
      $values = "'" . $db->escape_string($seq) . "', ";

      $field_names .= WK_HISTORY_FIELD_ACTION . ", ";
      $values .= "'" . $db->escape_string($action) . "', ";

      $field_names .= WK_HISTORY_FIELD_WHO . ", ";
      $values .= "'" . $db->escape_string($user) . "', ";

      $field_names .= WK_HISTORY_FIELD_WHEN . ", ";
      $values .= "'" . $db->escape_string($now) . "', ";

      $field_names .= WK_HISTORY_FIELD_COMMENT;
      $values .= "'" . $db->escape_string($comment) . "'";
  
      $query_insert = "INSERT INTO `" . $table . "`" .
                            "(" . $field_names . ") VALUES(" . $values . ")" ;

      if ($db->execute($query_insert)) {
        return true;
      } else {
        $dberror = array_pop($db->errors);
        error_log("FAIL: $dberror");
        return $dberror;
      }
    }

    function record_entry_by_path($path = '', $action = '', $comment = '', $user = false) {
      $e = Wiki_PageDir::findByPath($path);

      if (!is_object($e)) return $e;
      $seq = $e->seq();
      unset($e);
      return Wiki_History::record_entry_by_seq($seq, $action, $comment, $user);
    }

    function seq() { return $this->seq; }
    function action() { return $this->action; }
    function who() { return $this->who; }
    function when() { return $this->when; }
    function comment() { return $this->comment; }
    function path() {
      $entry = Wiki_PageDir::findBySeq($this->seq);
      if (!is_object($entry)) {
        // This should not be possible
        return false;
      }
      return $entry->path();
    }

  } // Wiki_History

?>
