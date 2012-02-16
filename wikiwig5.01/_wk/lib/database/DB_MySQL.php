<?php

  // Error codes
  @define("DB_SERVER_CONNECTION_ERROR", 0);
  @define("DB_CONNECTION_ERROR", 1);
  @define("DB_QUERY_ERROR", 2);
  @define("DB_REG_DSN",'#([a-z]+)://([a-zA-Z0-9]+):([a-zA-Z0-9]*)@([a-zA-Z0-9]+)/([a-zA-Z0-9_]+)#');

  class DB_MySQL {
    var $server = '';
    var $login = '';
    var $password = '';
    var $port = '';
    var $db = '';
    var $connection = null;
    var $errors = array();

    /**
     * Constructors (PHP 4/5)
     *
     */
    function DB_MySQL($server_or_dsn='',$login='', $password='', $db='', $standalone=false) {
      $this->__construct($server_or_dsn,$login, $password, $db, $standalone);
    }
    function __construct($server_or_dsn=null,$login=null, $password=null, $db=null) {
      if ((!is_null($server_or_dsn)) && !is_null($login)) { //more than one => no dsn provided
        $this->server     = $server_or_dsn;
        $this->login      = $login;
        $this->password   = $password;
        $this->db         = $db;
      } elseif((!is_null($server_or_dsn)) && (preg_match(DB_REG_DSN,$dsn,$matches))){ // dsn provided
        //var_dump($matches);
        $this->server   = $matches[4];
        $this->db       = $matches[5];
        $this->login    = $matches[2];
        $this->password = $matches[3];
      } else {
        // bad infos, keep default values
      }
    }

    function connect($persistence=true) {
      if ($persistence) {
        $this->connection = @mysql_pconnect($this->server.(($this->port=="")?"":":".$this->port),
                                            $this->login,
                                            $this->password );
      } else {
        $this->connection = @mysql_connect($this->server.(($this->port=="")?"":":".$this->port),
                                           $this->login,
                                           $this->password );
      }
      if (!$this->is_valid()){
        // This line has generated an error since php 4.3.. Don't know why...
        //    $this->trigger_error(mysql_error(),DB_SERVER_CONNECTION_ERROR);
      }
    } // connect

    /**
     * To use for UPDATE, INSERT, DELETE, REPLACE, ALTER,... queries
     *
     * @param $query string query to execute
     * @return bool execution status of the query
     */
    function execute($query) {
      if (!($this->is_valid()))
        $this->connect();

      if (($query_ok = @mysql_db_query($this->db, $query))) {
        return $query_ok;
      } else {
        $this->trigger_error(sprintf(DB_ERR_QUERY_FAILED, @mysql_error($this->connection)),DB_QUERY_ERROR);
        return false;
      }
    }

    /**
     * To use for SELECT queries
     *
     * @param $query string query to execute
     * @return mixed associative array of the resulting rows. Each rows is an array indexed with the fields of the query
     */
    function query($query) {
      if (!($this->is_valid()))
        $this->connect();
      if ($result = @mysql_db_query($this->db, $query)) {
        $nb_rows = mysql_affected_rows($this->connection);
        $array_result = array();
        for ($i=0;$i<$nb_rows;$i++) {
          $row = @mysql_fetch_array($result);
          array_push($array_result, $row);
        }
        @mysql_free_result($result);
        return $array_result;
      } else {
        if (!@mysql_select_db($this->db,$this->connection)){
          $this->trigger_error(mysql_error(),DB_CONNECTION_ERROR);
          return false;
        } else {
          //var_dump(mysql_error());
          //echo '<pre>'.sprintf(DB_ERR_QUERY_FAILED, mysql_error($this->connection)).'</pre>';
          $this->trigger_error(sprintf(DB_ERR_QUERY_FAILED, @mysql_error($this->connection)),DB_QUERY_ERROR);
          return false;
        }
      }
    } // query

    /**
     * Close the connection to the database
     *
     */
    function close() {
      if ($this->is_valid())
        @mysql_close($this->connection);
    }
    /**
     * Indicates status of the current property connection
     *
     * @return bool status of the connection
     */
    function is_valid() {
      return is_resource($this->connection);
    }
    /**
     * Retrieves the id of the last inserted row using the current connection
     *
     * @return int last inserted id
     */
    function get_last_id() {
      if ($this->is_valid())
        return @mysql_insert_id($this->connection);
    }

    /**
     * Returns a clean formatted string
     *
     * @param string $string string to escape
     * @return string a clean escaped string
     * @access public
     */
    function escape_string($string) {
        return mysql_escape_string($string);
    }
    /**
     * verify that mysql extension is available
     * and verify connection parameters
     */
    function probe() {
      $this->probe_errors = array();
      if (!function_exists('mysql_connect')){
        $this->probe_errors[] = sprintf(DB_ERR_EXTENSION_UNAVAILABLE,'MySQL');
        return false;
      }
      if (!($conn = @mysql_connect($this->server.(($this->port=="")?"":":".$this->port),
                                 $this->login,
                                 $this->password )) ) {
        $this->probe_errors[] = sprintf(DB_ERR_CONNECT_SERVER,$this->server);
        return false;
      }
      if (!@mysql_select_db($this->db,$conn)){
        $this->probe_errors[] = sprintf(DB_ERR_CONNECT_DATABASE,$this->db);
        return false;
      }
      return true;
    } // probe

    /**
     * Process the errors returned by the others methods of the class
     *
     * used when an error occured during an operation to the database
     *
     * @param string $error the error message
     * @param int $error_code error code available (DB_SERVER_CONNECTION_ERROR, DB_CONNECTION_ERROR, DB_QUERY_ERROR)
     */
    function trigger_error($error, $error_code) {
      switch($error_code) {
        case DB_CONNECTION_ERROR :
        case DB_SERVER_CONNECTION_ERROR :
          die($error);
          break;
        case DB_QUERY_ERROR :
          array_push($this->errors,$error);
          break;
        default:
          array_push($this->errors,$error_code.' '.$error);
          break;
      }
      return false;
    }
  } // DB_MySQL
?>
