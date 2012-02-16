<?php
  if (!class_exists('Wiki'))
    require_once dirname(__FILE__).'/Wiki.php';
  if (!class_exists('Wiki_DB'))
    require_once dirname(__FILE__).'/Wiki_DB.php';

  // Fields in the DB
  @define('WK_USER_FIELD_ID', 'id');
  @define('WK_USER_FIELD_NAME', 'login');
  @define('WK_USER_FIELD_PASS', 'mdp');
  @define('WK_USER_FIELD_EMAIL', 'email');
  @define('WK_USER_FIELD_TOKEN', 'token');
  @define('WK_USER_FIELD_MAGIC', 'magic');
  @define('WK_USER_FIELD_TIMEOUT', 'timeout');
  @define('WK_USER_FIELD_EDITFILES', 'editFiles');
  @define('WK_USER_FIELD_RENAMEFOLDERS', 'renameFolders');
  @define('WK_USER_FIELD_RENAMEFILES', 'renameFiles');
  @define('WK_USER_FIELD_MOVEFOLDERS', 'moveFolders');
  @define('WK_USER_FIELD_MOVEFILES', 'moveFiles');
  @define('WK_USER_FIELD_DELETEFOLDERS', 'deleteFolders');
  @define('WK_USER_FIELD_DELETEFILES', 'deleteFiles');
  @define('WK_USER_FIELD_PRIVILEGED', 'privilege');
  @define('WK_USER_FIELD_RESTOREFILES', 'restoreFiles');
  @define('WK_USER_FIELD_CREATEFILES', 'createFiles');
  @define('WK_USER_FIELD_CREATEFOLDERS', 'createFolders');

  function upgrade_user_database() {
    global $WK;
    $db = Wiki_DB::getInstance();
    // DO we already have the new db?
    $WK['table_users'] = $WK['dbPrefix']."users";
    $query_new_db = "SELECT * FROM `".Wiki::getConfig('table_users') . "` ;" ;
    $res = $db->query($query_new_db);
    if($res !== false) return;

    // Does the old db exist?
    $old_table = Wiki::getConfig('table_utilisateurs');
    if ($old_table == '') return;
    $query_old_db = "SELECT * FROM `". $old_table . "` ;" ;
    $users = $db->query($query_old_db);
    if (empty($users)) return;

    $create_table = <<<INIT
CREATE TABLE `%s` (
  `id` int(5) NOT NULL auto_increment,
  `login` varchar(255) NOT NULL default '',
  `mdp` varchar(255) NOT NULL default '',
  `magic` varchar(32) NOT NULL default '',
  `token` varchar(32) NOT NULL default '',
  `timeout` int(10) unsigned default '0',
  `email` varchar(255) NOT NULL default '',
  `privilege` char(1) NOT NULL default 'F',
  `editFiles` char(1) NOT NULL default 'F',
  `renameFolders` char(1) NOT NULL default 'F',
  `renameFiles` char(1) NOT NULL default 'F',
  `moveFolders` char(1) NOT NULL default 'F',
  `moveFiles` char(1) NOT NULL default 'F',
  `deleteFolders` char(1) NOT NULL default 'F',
  `deleteFiles` char(1) NOT NULL default 'F',
  `restoreFiles` char(1) NOT NULL default 'F',
  `createFiles` char(1) NOT NULL default 'F',
  `createFolders` char(1) NOT NULL default 'F',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=0 ;
INIT;
    $create_table = sprintf($create_table, Wiki::getConfig('table_users'));
//    while (strpos($create_table, "\n") !== false) {
//      $create_table = str_replace('\\n', ' ', $create_table);
//    }
    $create_res =  $db->execute($create_table);

    if ($create_res == false) {
      // We're doomed.
      $dberror = array_pop($db->errors);
      error_log("Failed to create user database: $dberror");
      return;
    }

    foreach ($users as $user) {
      $u = new Wiki_User();
      $name = $user['utilisateurs_nom'];
      $pswd = $user['utilisateurs_mdp'];
      $email = $user['utilisateurs_couleur'];
      $privileged = false;
      if (strpos($name, "admin_") === 0) {
        $privileged = true;
        $name = substr($name, 6);
      }
      // Watch out for dupes!
      $testname = $name;
      $idnum = 2;
      while (Wiki_User::findByUserName($testname) !== false) {
        // bad db duplicate users!
        $testname = $name . "_" . $idnum;
        $idnum++;
      }
      if ($idnum > 2) {
        error_log("duplicate login id: $name mail $email, new login id: $testname");
      }
      $u->fillin($testname, $pswd, $email, $privileged);
      $res = $u->insert();
      if ($res !== true) {
        error_log("Failed to insert : $res");
        break;
      }
      unset($u);
    }

  }


  @define('WK_USER_EXISTS', -1);
  @define('WK_USER_NOT_EXISTS', -2);
  @define('WK_USER_BAD_PASS', -3);
  @define('WK_USER_DB_FULL', -4);

  class Wiki_User {
    var $id = false;
    var $name = '';
    var $password = '';
    // var $color = 'ffffff';
    var $email = '';
    var $editFiles = false;
    var $token = '';
    var $magic = '';
    var $timeout = 0;
    var $renameFolders = false;
    var $renameFiles = false;
    var $moveFolders = false;
    var $moveFiles = false;
    var $deleteFolders = false;
    var $deleteFiles = false;
    var $restoreFiles = false;
    var $createFiles = false;
    var $createFolders = false;
    var $privileged = false;

    // Seems like static fields didn't appear until php 5.0 certainly didn't seem to exist in 4.4.4
    var $fields = array('id' => WK_USER_FIELD_ID,
                           'name' => WK_USER_FIELD_NAME,
                           'password' => WK_USER_FIELD_PASS,
                           // 'color' => WK_USER_FIELD_COLOR,
                           'email' => WK_USER_FIELD_EMAIL,
                           'editFiles' => WK_USER_FIELD_EDITFILES,
                           'token' => WK_USER_FIELD_TOKEN,
                           'magic' => WK_USER_FIELD_MAGIC,
                           'timeout' => WK_USER_FIELD_TIMEOUT,
                           'renameFolders' => WK_USER_FIELD_RENAMEFOLDERS,
                           'renameFiles' => WK_USER_FIELD_RENAMEFILES,
                           'moveFolders' => WK_USER_FIELD_MOVEFOLDERS,
                           'moveFiles' => WK_USER_FIELD_MOVEFILES,
                           'deleteFolders' => WK_USER_FIELD_DELETEFOLDERS,
                           'deleteFiles' => WK_USER_FIELD_DELETEFILES,
                           'restoreFiles' => WK_USER_FIELD_RESTOREFILES,
                           'createFolders' => WK_USER_FIELD_CREATEFOLDERS,
                           'createFiles' => WK_USER_FIELD_CREATEFILES,
                           'privileged' => WK_USER_FIELD_PRIVILEGED
                           );
    var $access_rights = array( 'renameFolders' => WK_USER_FIELD_RENAMEFOLDERS,
                                'renameFiles' => WK_USER_FIELD_RENAMEFILES,
                                'moveFolders' => WK_USER_FIELD_MOVEFOLDERS,
                                'moveFiles' => WK_USER_FIELD_MOVEFILES,
                                'deleteFolders' => WK_USER_FIELD_DELETEFOLDERS,
                                'deleteFiles' => WK_USER_FIELD_DELETEFILES,
                                'restoreFiles' => WK_USER_FIELD_RESTOREFILES,
                                'createFolders' => WK_USER_FIELD_CREATEFOLDERS,
                                'createFiles' => WK_USER_FIELD_CREATEFILES,
                                'editFiles' => WK_USER_FIELD_EDITFILES
                               );

    /**
     * Constructor PHP 4
     * Call the <code>__construct</code> method.
     * View <code>__construct</code> method for details.
     */
    function Wiki_User($user_id) { $this->__construct($user_id);}
    /**
     * Constructor PHP 5
     */
    function __construct($user_id=false) {
      // user_id ought to be numeric not string
      // error_log("con: " . $user_id . " isint: " . is_int($user_id +  0));
      if ($user_id !== false && is_int($user_id + 0)) {
        upgrade_user_database();
        $db = Wiki_DB::getInstance();
        $query_user_by_id = "SELECT * FROM `".Wiki::getConfig('table_users') . "` " .
                            "WHERE " . WK_USER_FIELD_ID . "='" . $user_id . "';";
        $users = $db->query($query_user_by_id);
        if (!empty($users))
          $this->populate($users[0]);
      } else {
        $this->fillin();
      }
    }


    function populate($user_infos = array()) {
      foreach (array_keys(get_object_vars($this)) as $vars) {
        if ($vars == 'fields') continue;
        if ($vars == 'access_rights') continue;
        if (isset($user_infos[$this->fields[$vars]])) {
          $value = $user_infos[$this->fields[$vars]];
          // Map 'T' to true for rights fields
          if (array_key_exists($vars, $this->access_rights) || $vars == 'privileged') {
            $this->$vars = $value == 'T';
             // error_log($vars . " => " . $this->$vars . " " . $value);
          } else {
            $this->$vars = $value;
             // error_log($vars . " => " . $this->$vars . " " . $value);
          }
        } else {
           error_log("Not set: " . $this->fields[$vars] . " (" . $vars . ")");
          $this->$vars = '';
        }
      }
    }

    function insert() {
      if (!is_object($this) || $this->id !== false) {
        return false;
      }
  
      $db = Wiki_DB::getInstance();
      $u = Wiki_User::findByUserName($this->name);
      if ($u !== false) {
        return WK_USER_EXISTS;
      }
      unset($u);

      $field_names = '';
      $values = '';
      foreach (array_keys(get_object_vars($this)) as $vars) {
        if ($vars != 'id' && $vars != 'fields' && $vars != 'access_rights') {
          // Map 'T/F' to true/false for rights fields
          $field_value = $this->$vars;
          if (array_key_exists($vars, $this->access_rights) || $vars == 'privileged') {
            $field_value  = $field_value ? 'T' : 'F';
          } else {
            $field_value = $db->escape_string($field_value);
          }
          if ($values != '') {
            $values .= ", '"  . $field_value . "'"; 
            // $field_names .= ", " . Wiki_USER::$fields[$vars];
            $field_names .= ", " . $this->fields[$vars];
          } else {
            $values = "'" . $db->escape_string($this->$vars) . "'";
            // $field_names = Wiki_USER::$fields[$vars];
            $field_names = $this->fields[$vars];
          }
        }
      }
      $query_user_insert = "INSERT INTO `" . Wiki::getConfig('table_users') . "`" .
                            "(" . $field_names . ") VALUES(" . $values . ")" ;
       // error_log("INSERT: " . $query_user_insert);

      if ($db->execute($query_user_insert)) {
        $this->id = $db->get_last_id();
        return true;
      } else {
        // The database uses autoincrement for the primary key. Once the table is full you can't add
        // any more entries even if entries are now empty. This path will try and find empty table items
        $dberror = array_pop($db->errors);
        if (strpos($dberror, 'Duplicate entry') === false) {
          return $dberror;
        }

        $query_users = "SELECT * FROM `".Wiki::getConfig('table_users') . "`  ORDER BY " . WK_USER_FIELD_ID . ";" ;
        $users = $db->query($query_users);

        if (empty($users)) {
          return false; // this s.b. impossible
        }

        $free = -1;
        $last = -1;
        foreach ($users as $user) {
          $cur = $user[WK_USER_FIELD_ID] + 0;
          if ($last != -1) {
            if ($last + 1 != $cur) {
              // found a hole
              $free = $last + 1;
              break;
            }
          }
          $last = $cur;
        }
        // error_log("found: " . $free);
        if ($free == -1) {
          error_log("insert: full!");
          return WK_USER_DB_FULL;
        }

        $query_user_insert = "INSERT INTO `" . Wiki::getConfig('table_users') . "`" .
                              "(" . WK_USER_FIELD_ID . ", " . $field_names . ") VALUES(" . $free . ", " . $values . ")" ;

        // error_log("INSERT: " . $query_user_insert);

        if ($db->execute($query_user_insert)) {
          $this->id = $free;
          return true;
        }
        error_log("insert: full(2)!");
        return WK_USER_DB_FULL;
      }
    }

    function delete() {
      if ($this->id === false) {
        return false;
      }
      $db = Wiki_DB::getInstance();
      $query_user_delete = "DELETE FROM `" . Wiki::getConfig('table_users') . "` WHERE " .
                            WK_USER_FIELD_ID . " = " . $this->id . ";" ;
      // error_log("DEL " . $query_user_delete);
      $res = $db->execute($query_user_delete);
      if ( $res == false) {
        $dberror = array_pop($db->errors);
        // error_log("db:err " . $dberror);
      }
    }

    function update() {
      if ($this->id === false) {
        return false;
      }
      $db = Wiki_DB::getInstance();
      $query_user_update = "UPDATE `" . Wiki::getConfig('table_users') . "` SET ";
      $value = '';
      foreach (array_keys(get_object_vars($this)) as $vars) {
        if ($vars == 'fields') continue;
        if ($vars == 'access_rights') continue;
        if ($value != '') {
          $value .= ",";
        }
        // $value .= Wiki_USER::$fields[$vars] . " = '" $db->escape_string($this->$vars);
        if (array_key_exists($vars, $this->access_rights) || $vars == 'privileged') {
          $value .= $this->fields[$vars] . " = '" . 
                      ($this->$vars ? "T" : "F" ) .
                      "'";
        } else {
          $value .= $this->fields[$vars] . " = '" . $db->escape_string($this->$vars) . "'";
        }
      }
      $query_user_update .= $value .  " WHERE " . WK_USER_FIELD_ID . " = '". $this->id . "'; ";
      // error_log($query_user_update);
      return $db->execute($query_user_update);
    }

    function fillin($user_name = '', $user_pswd = '',  $user_email ='', $privileged = false) {
      global $WK;
      $this->name = $user_name;
      $this->password = $user_pswd;
      $this->email = $user_email;
      $this->privileged = $privileged;
      foreach (array_keys($this->access_rights) as $right) {
        if ($privileged) {
          $this->$right = true;
        } else if ($user_name != '' && $WK['approval'] != 'admin') {
          if (isset($WK['defaultRights'][$right])) {
            $this->$right = $WK['defaultRights'][$right];
          } else {
            $this->$right = false;
          }
        } else {
          if (isset($WK['anonRights'][$right])) {
            $this->$right = $WK['anonRights'][$right];
          } else {
            $this->$right = false;
          }
        }
      }
    }

    function is_guest() {
      return ($this->id === false);
    }

    function set_name($user_name = '') {
      $this->name = $user_name;
    }

    function set_password($password = '') {
      $this->password = md5($password);
    }

    function set_email($email = '') {
      $this->email = $email;
    }

    function privileged() {
      // return $this->privileged == 'T';
      return $this->privileged;
    }

    function set_privileged($value = false) {
      $this->privileged = $value;
    }

    function email() {
      return $this->email;
    }

    function user_name() {
      return $this->name;
    }

    // Figure out the wiki user from the SESSION or wikimagic cookie. If neither
    // works return a guest user.

    function &getSessionUser() {
      $user = false;

      if (isset($_SESSION['user_name']) && isset($_SESSION['user_token'])) {
        $name = $_SESSION['user_name'];
        $user = Wiki_User::findByUserName($name);
        // Is the token still valid?
        if (is_object($user) && $user->token == $_SESSION['user_token']) {
          return $user;
        }
      }
      // This creates a guest user
      $user = new Wiki_User();
      return $user;
    }

    function rights($key) {
      if (array_key_exists($key, $this->access_rights)) {
        // error_log("User: " . $this->name . " " . $key . " = " . $this->$key);
        return $this->$key == 'T';
      } else {
        error_log("User: " . $this->name . " unknown right: " . $key );
        return false;
      }
    }

    function set_rights($key, $value) {
      if ($this->id !== false && array_key_exists($key, $this->access_rights)) {
        // error_log("User: " . $this->name . " " . $key . " = " . $this->$key);
        $this->$key = $value;
      } else {
        if ($this->id === false) {
          error_log("No user for " . $key);
        } else {
          error_log("User: " . $this->name . " unknown right: " . $key );
        }
      }
    }

    function &findByUserName($user_name='') {
      upgrade_user_database();
      $db = Wiki_DB::getInstance();
      $query_user_by_name = "SELECT * FROM `".Wiki::getConfig('table_users')."` ".
                            "WHERE ".WK_USER_FIELD_NAME."='".$db->escape_string($user_name)."';";
      // error_log("QUERY: " . $query_user_by_name);
      $users = $db->query($query_user_by_name);
      if (empty($users)) {
        $res = false;
        return $res;
      } else {
        // Do it this way because it will force a database upgrade and populate
        // error_log("lookup: " . $users[0][WK_USER_FIELD_ID]);
        $u = new Wiki_User($users[0][WK_USER_FIELD_ID]);
        $u->populate($users[0]);
        return $u;
      }
    }

    // Set/Reset the cookie that allows wikiwig to maintain persistent logins
    // and maintain identity when not persistent.
    // Persistence is only one week. Must log in more frequently than that
    // to maintain persistence

    function set_auth_cookie($logout = true, $persistent = false) {

      global $WK;
      $old = time() - ( 365 * 24 * 60 * 60);
      // Cause an immediate death to the current cookie
      setcookie('wikiwigmagic', "DELETED", $old, "/");

      $salt = 'wikiwig';
      $this->magic = md5($salt . md5($this->name . $salt));
      $this->token = md5(uniqid(rand(), TRUE));
      if ($logout || !$persistent) {
        // Make the db token expired
        $this->timeout = $old;
        $expire = time() + $WK['userCookieTime'];
      } else {
        $this->timeout = time()  + (7 * 24 * 60 *60);
        $expire = $this->timeout;
      }
      $res = $this->update();
      if ($res === false) {
        // We're screwed as the db didn't update. Don't install a new cookie!
        return false;
      }
      // Safe to install a new cookie
      // error_log('(4) wikiwigmagic ' . "$this->magic:$this->token" . strftime(" %D %R" , $expire));
      setcookie('wikiwigmagic', "$this->magic:$this->token", $expire, "/");
      return true;
    }

    function update_user_session($logout = true) {
      // error_log("Ses id0: " . session_id());
      $_SESSION = array();
      if (isset($_COOKIE[session_name()])) {
        // delete session cookie
        // error_log("timeout: " . strftime(" %D %R" , $this->timeout));
        //  error_log('(5) sess ' . session_name() . " id: " . session_id() . strftime(" %D %R" , $this->timeout));
        setcookie(session_name(), session_id(), time()-42000, '/');
      }
      session_destroy();
      session_start();
      $res = session_regenerate_id(TRUE);
      // error_log("regenerate: " . $res);
      if (!$logout) {
        $_SESSION['user_name'] = $this->name;
        // error_log("setting new token " . $this->token);
        $_SESSION['user_token'] = $this->token;
      }
      // error_log("Ses id: " . session_id());
      session_write_close();
      // error_log("Ses id2: " . session_id());
    }
    
    function logout() {
      $u = Wiki_User::getSessionUser();
      if ($u->is_guest()) {
        if (isset($_COOKIE['wikiwigmagic'])) {
          error_log("log out unknown user! " .$_COOKIE['wikiwigmagic']);
          // error_log('(6) wikiwigmagic ' . "DEL" . " time: " . (time() - 604800));
          setcookie('wikiwigmagic', "DELETED", time() - 604800, "/");
        }
        return;
      }
      $u->set_auth_cookie(true);
      $u->update_user_session(true);
    }

    function login($persistent = false) {
      $this->set_auth_cookie(false, $persistent);
      $this->update_user_session(false);
    }

    function authenticate($user_password, $must_be_admin = false, $update_session = true, $persistent = false) {
      if ($this->id === false) {
        error_log("Null user authenicated!");
        return false;
      }
      $res = ($this->password == md5($user_password) && ($this->privileged || !$must_be_admin));
      return $res;
    }

    // This should be private...
    // Find the db record for the user describe by wikimagic cookie
    function findUserByCookie() {
      upgrade_user_database();
      if (!isset($_COOKIE['wikiwigmagic'])) return false;
      list($idhash, $token) = explode(':', $_COOKIE['wikiwigmagic']);
      $clean = array();
      if (!ctype_alnum($idhash) || !ctype_alnum($token)) return false;
      $db = Wiki_DB::getInstance();
      $query_user_by_name = "SELECT * FROM `".Wiki::getConfig('table_users')."` ".
                            "WHERE " . WK_USER_FIELD_MAGIC . "='" . $db->escape_string($idhash)."';";
      $users = $db->query($query_user_by_name);
      if (empty($users)) {
        return false;
      } else {
        if ($users[0][WK_USER_FIELD_TOKEN] != $token) return false;
        return $users[0];
      }
    }

    // If the wikimagic cookie is the currently alid cookine for this user
    // This is only used to figure out the user name and doesn't check the timeout
    function nameFromCookie() {
      $u = Wiki_User::findUserByCookie();
      if ($u === false) return '';
      return $u[WK_USER_FIELD_NAME];
    }

    // Is the login cookie present and not expired compared to db?
    function validLoginCookie() {
      $db_row = Wiki_User::findUserByCookie();
      if ($db_row === false) {
        return false;
      } else {
        list($idhash, $token) = explode(':', $_COOKIE['wikiwigmagic']);
        // idhash and token are validated by findUserByCookie
        $now = time();
        // error_log("timeout(2): " . strftime(" %D %R" , $db_row[WK_USER_FIELD_TIMEOUT]));
        return ($db_row[WK_USER_FIELD_TIMEOUT] > $now);
      }
    }

    // Login a user using the persistent scheme
    function &loginByCookie() {
      if (!Wiki_User::validLoginCookie()) {
        $u = new Wiki_User();
        return $u;
      }
      $db_row = Wiki_User::findUserByCookie();
      if ($db_row === false) {
        // should not be possible since validLoginCookie just found it!
        return $u; // ref to false
      } else {
        $u = new Wiki_User($db_row[WK_USER_FIELD_ID]);
        $u->populate($db_row);
        // renew the cookie
        $u->login(true);
        return $u;
      }
    }


    // This either gets us a registered user or a guest
    function &currentUser() {
      if (!isset($_SESSION['user_name'])) {
        $user = Wiki_User::loginByCookie();
      } else {
        $user = Wiki_User::getSessionUser();
      }
      return $user;
    }


  } // Wiki_User

/* // standalone testing
include '../wk_config.php';
// create a user
$user = new Wiki_User();
$user->name = 'my_name';
$user->password = 'my_pass';
$user->color = 'my_color';
$res_insert = $user->insert();
var_dump($res_insert);
echo '<br />';
unset($user);
// search a user
$user = Wiki_User::findByUserName('my_name');
var_dump($user);
echo '<br />';
var_dump($user->authenticate('my_pass'));
unset($user);
// update an user
$user = Wiki_User::findByUserName('my_name');
$user->color = '987654';
echo '<br />';
var_dump($user->update());
//*/
?>
