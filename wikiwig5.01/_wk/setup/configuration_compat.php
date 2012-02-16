<?php
  /*
   * Created on 30 nov. 2004
   */

  // compatibility with older configurations
  // retrieves old configuration and initializes variables
  // for updates
  global $WK;

  if(isset($WK_VAR)) { // wikiwig versions < 3.2.0
    @define('WK_INSTALLED_VERSION','3.1');
    // absent vars
    $WK['lang']     = 'fr';
    $WK['dbType']   = 'mysql';
    $WK['dbPrefix'] = '';

    // present vars
    $WK['wkHTTPPath'] = $WK_VAR['adresse_wiki'];
    $WK['wkPath'] = $WK_VAR['chemin_wiki'];

    $WK['dbHost']   = $WK_VAR['BDD_serveur'];
    $WK['dbName']   = $WK_VAR['BDD_nom'];
    $WK['dbUser']   = $WK_VAR['BDD_login'];
    $WK['dbPass']   = $WK_VAR['BDD_mdp'];
    $WK['dbPrefix'] = 'wk_';

    $WK['backupPath'] = $WK_VAR['rep_backup'];
    $WK['trashPath'] = $WK_VAR['rep_trash'];
    $WK['systemPath'] = $WK_VAR['rep_wk'];
    // $WK['uploadPath'] = $WK_VAR['rep_upload'];
    $WK['fileuploadPath'] = $WK_VAR['rep_upload'];
    $WK['imageuploadPath'] = $WK_VAR['rep_upload'];

    $WK['editionMaxTime'] = $WK_VAR['tps_edition'];
    $WK['editionWarningTime'] = $WK_VAR['tps_latence'];
    $WK['userCookieTime'] = $WK_VAR['expiration_cookie'];
    //$WK['wk'] = $WK_VAR['chemin_backup'];
    //$WK['wk'] = $WK_VAR['chemin_trash'];
    $WK['nbBackups'] = $WK_VAR['nb_backup'];
    $WK['css_wiki'] = $WK_VAR['css_wiki'];
    $WK['adminLogin'] = $WK_VAR['login_admin'];
    $WK['adminPass'] = $WK_VAR['login_pass'];
    $WK['defaultRights']['editFiles'] = true;
    $WK['defaultRights']['renameFolders'] = false;
    $WK['defaultRights']['renameFiles'] = false;
    $WK['defaultRights']['moveFolders'] = false;
    $WK['defaultRights']['moveFiles'] = false;
    $WK['defaultRights']['deleteFolders'] = false;
    $WK['defaultRights']['deleteFiles'] = false;

    $WK['efm_allow_new_dir'] = $IMConfig['allow_new_dir'];
    $WK['efm_allow_upload'] = $IMConfig['allow_upload'];
    $WK['efm_default_thumbnail'] = $IMConfig['default_thumbnail'];

    $WK['efm_image_class'] = IMAGE_CLASS;
    $WK['efm_image_transform_lib_path'] = IMAGE_TRANSFORM_LIB_PATH;

    $WK['efm_safe_mode'] = $IMConfig['safe_mode'];
    $WK['efm_thumbnail_dir'] = $IMConfig['thumbnail_dir'];
    $WK['efm_thumbnail_height'] = $IMConfig['thumbnail_height'];
    $WK['efm_thumbnail_prefix'] = $IMConfig['thumbnail_prefix'];
    $WK['efm_thumbnail_width'] = $IMConfig['thumbnail_width'];
    $WK['efm_tmp_prefix'] = $IMConfig['tmp_prefix'];

    $WK['efm_files_dir'] = $WK_VAR['rep_upload']; //NEW
    $WK['efm_files_url'] = $WK_VAR['adresse_wiki'] . $WK_VAR['chemin_wiki'] . $WK_VAR['rep_upload']; //NEW
    $WK['efm_images_dir'] = $WK_VAR['rep_upload']; //NEW
    $WK['efm_images_url'] = $WK_VAR['adresse_wiki'] . $WK_VAR['chemin_wiki'] . $WK_VAR['rep_upload']; //NEW

    $old_wk_railroad = 'wk_chemin-de-fer.php';
    $old_css_wiki    = $WK_VAR['css_wiki'];
    $old_wkHTTPath   = $WK_VAR['adresse_wiki'];
    $old_wkPath      = $WK_VAR['chemin_wiki'];
    $old_header_reg  = '/<div id=\'entete\'.*(?=<div id=\contenu\')/si';
    $old_content_reg  = '/<div id=\'contenu\'.*(?=</body)/si';
  } else {
    if (!isset($WK['defaultRights'])) { // v3.2.0 prelease and prerelease2
      $WK['defaultRights']['editFiles'] = true;
      $WK['defaultRights']['renameFolders'] = false;
      $WK['defaultRights']['renameFiles'] = false;
      $WK['defaultRights']['moveFolders'] = false;
      $WK['defaultRights']['moveFiles'] = false;
      $WK['defaultRights']['deleteFolders'] = false;
      $WK['defaultRights']['deleteFiles'] = false;

    }
    if (!isset($WK['sessionPath']))
      $WK['sessionPath'] = '';
    @define('WK_INSTALLED_VERSION','4 alpha');
    if (!isset($WK['efm_allow_upload'])) {
      @define('WK_INSTALLED_VERSION','4.2 alpha');

      $WK['efm_files_dir'] = $WK['wkPath'].$WK['uploadDir']; //NEW
      $WK['efm_files_dir'] = $WK['uploadDir']; //NEW
      // Construct
      // $WK['efm_files_url'] = $WK['wkHTTPPath'].$WK['uploadDir']; //NEW
      $WK['efm_images_dir'] = $WK['wkPath'].$WK['uploadDir']; //NEW
      $WK['efm_images_dir'] = $WK['uploadDir']; //NEW
      // Construct
      // $WK['efm_images_url'] = $WK['wkHTTPPath'].$WK['uploadDir']; //NEW

    }
  }

  if(!isset($WK['efm_allowed_image_extensions'])) {
    $WK['efm_allowed_image_extensions'] = $MY_ALLOW_EXTENSIONS; // NEW
    $WK['efm_allowed_link_extensions'] = $MY_ALLOW_EXTENSIONS; // NEW
    $WK['efm_max_filesize_kb_image'] = (int) ($MY_MAX_FILE_SIZE / 1024); //NEW
    $WK['efm_max_filesize_kb_link'] = (int) ($MY_MAX_FILE_SIZE / 1024); //NEW
    $WK['efm_thumbnail_extensions'] = array("jpg", "gif", "png", "bmp"); // NEW

    // Remove old obsolete config vars
    if (isset($IMConfig['validate_images'])) {
      unset($IMConfig['validate_images']);
    }
  }
  if (!isset($WK['anonRights'])) { // 4.3 and earlier 
    $WK['defaultRights']['editFiles'] = true;
    $WK['anonRights']['editFiles'] = false;
    $WK['anonRights']['renameFolders'] = false;
    $WK['anonRights']['renameFolders'] = false;
    $WK['anonRights']['renameFiles'] = false;
    $WK['anonRights']['moveFolders'] = false;
    $WK['anonRights']['moveFiles'] = false;
    $WK['anonRights']['deleteFolders'] = false;
    $WK['anonRights']['deleteFiles'] = false;
  }

?>
