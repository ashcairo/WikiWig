<?php
  /*
   * Created on 23 nov. 2004
   */
  if (!isset($_SESSION)) {
    session_start();
  }

  if(!class_exists('Wiki'))
    require_once dirname(__FILE__).'/Wiki.php';
  if(!class_exists('Wiki_DB'))
    require_once dirname(__FILE__).'/Wiki_DB.php';

  /**
   * File Locking Manager
   *
   */
  class Wiki_Locker {
    /**
     * update the available locks
     * verify that locks have not expired. If so, cleans the database
     */
    function updateLocks() {
      $db = Wiki_DB::getInstance();
      $sql_clean_locks = "DELETE FROM `".Wiki::getConfig('table_pages')."`" .
                         " WHERE pages_temps < '".(time() - Wiki::getConfig('editionMaxTime'))."'" .
                         " AND NOT(pages_nom LIKE 'MONITOR-%') AND NOT (pages_nom LIKE 'PROTECT-%') AND NOT (pages_nom LIKE 'ACCUSER-/%');";
      //echo $sql_clean_locks;return true;
      return $db->execute($sql_clean_locks);
    }

    /**
     * Put a lock on a page
     * If the page is already locked, and the current user is the locker,
     * the time of lock is updated.
     * If the page is already locked and the user is different, the method retusn false
     * If the page is unlocked, we put a lock on it.
     *
     * @param string $page_name the name of the page
     * @param string $username name of the user who want a to lock the page
     * @return boolean locking successful or not
     */
    function lockPage($page_name = false, $username=false) {
      if($page_name === false || $username === false)
        return false;
      $now = time();
      $db = Wiki_DB::getInstance();

      // clean current locks which have expired
      Wiki_Locker::updateLocks();

      $sql_get_page = "SELECT * FROM `".Wiki::getConfig('table_pages')."` ".
                      "WHERE pages_nom='".$db->escape_string($page_name)." OR pages_nom LIKE '%".$db->escape_string($page_name)."//-//%';";
      $page = $db->query($sql_get_page);
      if(!empty($page)){
        // page is already locked
       if($page[0]['pages_utilisateur'] == $username){
          // same user that has locked the page
          // we update the current lock time
          $sql_lock_page = "UPDATE `" . Wiki::getConfig('table_pages') . "` " .
                           "SET pages_temps = '" . $now . "' " .
                           "WHERE pages_id='". $page[0]['pages_id'] . "';";
          $update = $db->query($sql_lock_page);
         } else
          return false;
        } else {
          //nouvelle version pour enregistrer invite ou guest dans la bd
          // new lock when he is connected
          $sql_lock_page = "INSERT INTO `".Wiki::getConfig('table_pages')."` " .
                           " (pages_nom, pages_temps, pages_utilisateur) " .
                           " VALUES ('" . $db->escape_string($page_name) . "', " .
                                     "'" . $now . "', " .
                                     "'" . $username . "');";
      }
      // error_log("Lock page: " . $sql_lock_page);
      return $db->execute($sql_lock_page);
    } // lockPage

    /**
     * Unlock a previously locked page
     * @param string the name of the page
     * @return boolean result of the unlock operation
     */
    function unlockPage($page_name = false) {
      if($page_name === false)
        return false;
      $db = Wiki_DB::getInstance();
      $sql_unlock_page = "DELETE FROM `".Wiki::getConfig('table_pages')."` " .
                         "WHERE pages_nom='".$db->escape_string($page_name)."' OR pages_nom LIKE'%".$db->escape_string($page_name)."//-//%';";
      return $db->execute($sql_unlock_page);
    } // unlockPage

    /**
     * returns current locked pages
     */
    function getLocks() {
      $db = Wiki_DB::getInstance();
      $sql_get_locks = "SELECT * FROM `".Wiki::getConfig('table_pages')."`";
      $locked_pages = $db->query($sql_get_locks);
      $f_locked_pages = array();
      if(!empty($locked_pages)){
        foreach($locked_pages as $locked_page){
          $key_name = $locked_page['pages_nom'];
          $f_locked_pages[$key_name]["pages_temps"]       = $locked_page['pages_temps'];
          $f_locked_pages[$key_name]["pages_id"]          = $locked_page['pages_id'];
          $f_locked_pages[$key_name]["pages_utilisateur"] = $locked_page['pages_utilisateur'];
        }
      }
      return $f_locked_pages;
    } // getLocks
  } // Wiki_Locker
?>
