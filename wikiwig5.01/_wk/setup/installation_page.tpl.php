<?php
  /*
   * Template for the configuration Page
   *
   * 
   * To start a categorie:
   * type: //Title of the category 
   *       # Description of the category or a PHP constant for description
   *
   * To add an input
   * start the line with:
   * $variable[$key] = '{Title of the input|name of input|type of input|values of input}' // Description of the input
   * $key is equal to the name of the input.
   *
   * Using types: 
   * available types : string, protected, list, bool
   * See code below, to find how to use those different input types
   *
   * Note on comments: You must use / * and * / to comment parts of the file to avoid bad parsing 
   */

  // WK_CONF_GENERAL
  # WK_CONF_GENERAL_DESC
  $tpl_config['wkName']               = '{WK_CONF_WK_NAME|wkName|string|Wikiwig}';                    // WK_CONF_WK_NAME_DESC
  $tpl_config['wkDescription']        = '{WK_CONF_WK_DESCRIPTION|wkDescription|string|My Wikiwig}';   // WK_CONF_WK_DESCRIPTION_DESC
  $tpl_config['lang']                 = '{WK_CONF_WK_LANGUAGE|lang|list|en=>English,fr=>Fran&ccedil;ais,de=>Deutsch,tr=>Turkish}';      // WK_CONF_WK_LANGUAGE_DESC
  $tpl_config['userCookieTime']       = '{WK_CONF_USER_COOKIE_TIME|userCookieTime|string|31536000}';  // WK_CONF_USER_COOKIE_TIME_DESC
  $tpl_config['revisionControl']      = '{WK_CONF_REVISION|rcs|list|internal=>WK_CONF_RCS_INT,rcs=>RCS,cvs=>CVS}';  // WK_CONF_REVISION_DESC
  $tpl_config['nbBackups']            = '{WK_CONF_NB_BACKUPS|nbBackups|string|10}';                   //WK_CONF_NB_BACKUPS_DESC
  $tpl_config['css_wiki']             = '{WK_CONF_WK_CSS|css_wiki|string|wk_style.css}';              //WK_CONF_WK_CSS_DESC
   
  $tpl_config['adminLogin']           = '{WK_CONF_ADMIN_LOGIN|adminLogin|string|admin}';               // WK_CONF_ADMIN_LOGIN_DESC
  $tpl_config['adminPass']            = '{WK_CONF_ADMIN_PASS|adminPass|protected|admin}';              // WK_CONF_ADMIN_PASS_DESC
  $tpl_config['adminMail']            = '{WK_CONF_ADMIN_MAIL|adminMail|string|nobody@nowhere}';        // WK_CONF_ADMIN_MAIL_DESC
  $tpl_config['wkHTTPS']              = '{WK_CONF_HTTPS|https|list|https=>WK_CONF_USE_HTTPS,http=>WK_CONF_USE_HTTP}';  // WK_CONF_HTTPS_DESC

  $tpl_config['approval']  =  '{WK_CONF_APPROVAL|approval|list|email=>WK_CONF_APPROVE_BY_EMAIL,admin=>WK_CONF_APPROVE_BY_ADMIN,none=>WK_CONF_APPROVE_ALL}';  // WK_CONF_APPROVAL_DESC
  $tpl_config['captcha']              =  '{WK_CONF_CAPTCHA|captcha|list|php=>phpCaptcha,re=>reCaptcha,none=>WK_CONF_NO_CAPTCHA}'; //WK_CONF_CAPTCHA_DESC

  $tpl_config['email']                =  '{WK_CONF_EMAIL_SERVER|email|list|smtp=>WK_CONF_EMAIL_SMTP,none=>WK_CONF_NONE}';  //WK_CONF_EMAIL_SERVER_DESC


  // WK_CONF_DB
  #  WK_CONF_DB_DESC
  $tpl_config['dbType']               = '{WK_CONF_DB_TYPE|dbType|list|mysql=>MySQL}';    // WK_CONF_DB_TYPE_DESC
  $tpl_config['dbHost']               = '{WK_CONF_DB_HOST|dbHost|string|localhost}';     // WK_CONF_DB_HOST_DESC
  $tpl_config['dbUser']               = '{WK_CONF_DB_USER|dbUser|string|wikiwig}';       // WK_CONF_DB_USER_DESC
  $tpl_config['dbPass']               = '{WK_CONF_DB_PASSWORD|dbPass|protected|}';       // WK_CONF_DB_PASSWORD_DESC
  $tpl_config['dbName']               = '{WK_CONF_DB_NAME|dbName|string|wikitest}';       // WK_CONF_DB_NAME_DESC
  $tpl_config['dbPrefix']             = '{WK_CONF_DB_PREFIX|dbPrefix|string|wikiwig_}';  // WK_CONF_DB_PREFIX_DESC

  // WK_CONF_PATHS
  # WK_CONF_PATHS_DESC
  /*$tpl_config['wkPath']              = '{WK_CONF_WK_PATH|wkPath|string|/webroot/wikiwig/}';          // WK_CONF_WK_PATH_DESC*/
  /*$tpl_config['wkHTTPPath']          = '{WK_CONF_WK_HTTPPATH|wkHTTPPath|string|http://www.example.com/wikiwig/}';          // WK_CONF_WK_HTTPPATH_DESC*/
  /* Cannot allow to change the system dir name, because installation process is located in this directory*/
  /*$tpl_config['systemDir']           = '{WK_CONF_SYSTEM_DIR|systemDir|string|_wk}';                  // WK_CONF_SYSTEM_DIR_DESC*/
  $tpl_config['efm_images_dir']        = '{WK_CONF_EFM_IMAGES_DIR|efm_images_dir|string|_wk_upload}';  // WK_CONF_EFM_IMAGES_DIR_DESC
  $tpl_config['efm_files_dir']         = '{WK_CONF_EFM_FILES_DIR|efm_files_dir|string|_wk_files}';     // WK_CONF_EFM_FILES_DIR_DESC
  $tpl_config['trashDir']            = '{WK_CONF_TRASH_DIR|trashDir|string|_wk_trash}';                // WK_CONF_TRASH_DIR_DESC
  $tpl_config['backupDir']           = '{WK_CONF_BACKUP_DIR|backupDir|string|_wk_backup}';             // WK_CONF_BACKUP_DIR_DESC
  /*$tpl_config['templateDir']         = '{WK_CONF_TPL_DIR|templateDir|string|templates/}';            // WK_CONF_TPL_DIR_DESC*/
  $tpl_config['hiddenDirs']          = '{WK_CONF_HIDDEN_DIRS|hiddenDirs|string|CVS;RCS;SCCS;}';        // WK_CONF_HIDDEN_DIRS_DESC
  $tpl_config['sessionPath']          = '{WK_CONF_SESSION_PATH|sessionPath|string|}';                  // WK_CONF_SESSION_PATH_DESC

  // WK_CONF_USER_RIGHTS
  # WK_CONF_USER_RIGHTS_DESC
  $tpl_config['editFiles'] =     '{WK_CONF_EDIT_FILES|editFiles|bool|1}';         //WK_CONF_EDIT_FILES_DESC
  $tpl_config['restoreFiles']   = '{WK_CONF_RESTORE_FILES|restoreFiles|bool|0}';     //WK_CONF_RESTORE_FILES_DESC

  $tpl_config['createFiles']   = '{WK_CONF_CREATE_FILES|createFiles|bool|1}';     //WK_CONF_CREATE_FILES_DESC
  $tpl_config['renameFiles']   = '{WK_CONF_RENAME_FILES|renameFiles|bool|0}';     //WK_CONF_RENAME_FILES_DESC
  $tpl_config['moveFiles']     = '{WK_CONF_MOVE_FILES|moveFiles|bool|0}';         //WK_CONF_MOVE_FILES_DESC
  $tpl_config['deleteFiles']   = '{WK_CONF_DELETE_FILES|deleteFiles|bool|0}';     //WK_CONF_DELETE_FILES_DESC

  $tpl_config['createFolders'] = '{WK_CONF_CREATE_FOLDERS|createFolders|bool|1}'; //WK_CONF_CREATE_FOLDERS_DESC
  $tpl_config['renameFolders'] = '{WK_CONF_RENAME_FOLDERS|renameFolders|bool|0}'; //WK_CONF_RENAME_FOLDERS_DESC
  $tpl_config['moveFolders']   = '{WK_CONF_MOVE_FOLDERS|moveFolders|bool|0}';     //WK_CONF_MOVE_FOLDERS_DESC
  $tpl_config['deleteFolders'] = '{WK_CONF_DELETE_FOLDERS|deleteFolders|bool|0}'; //WK_CONF_DELETE_FOLDERS_DESC

  // WK_CONF_GUEST_RIGHTS
  # WK_CONF_GUEST_RIGHTS_DESC
  /* Uses the same descriptions as the normal users since the rights are identical
  $tpl_config['anon_editFiles'] =     '{WK_CONF_EDIT_FILES|anon_editFiles|bool|0}';         //WK_CONF_EDIT_FILES_DESC
  $tpl_config['anon_restoreFiles']   = '{WK_CONF_RESTORE_FILES|anon_restoreFiles|bool|0}';     //WK_CONF_RESTORE_FILES_DESC

  $tpl_config['anon_createFiles']   = '{WK_CONF_CREATE_FILES|anon_createFiles|bool|0}';     //WK_CONF_CREATE_FILES_DESC
  $tpl_config['anon_renameFiles']   = '{WK_CONF_RENAME_FILES|anon_renameFiles|bool|0}';     //WK_CONF_RENAME_FILES_DESC
  $tpl_config['anon_moveFiles']     = '{WK_CONF_MOVE_FILES|anon_moveFiles|bool|0}';         //WK_CONF_MOVE_FILES_DESC
  $tpl_config['anon_deleteFiles']   = '{WK_CONF_DELETE_FILES|anon_deleteFiles|bool|0}';     //WK_CONF_DELETE_FILES_DESC

  $tpl_config['anon_createFolders'] = '{WK_CONF_CREATE_FOLDERS|anon_createFolders|bool|0}'; //WK_CONF_CREATE_FOLDERS_DESC
  $tpl_config['anon_renameFolders'] = '{WK_CONF_RENAME_FOLDERS|anon_renameFolders|bool|0}'; //WK_CONF_RENAME_FOLDERS_DESC
  $tpl_config['anon_moveFolders']   = '{WK_CONF_MOVE_FOLDERS|anon_moveFolders|bool|0}';     //WK_CONF_MOVE_FOLDERS_DESC
  $tpl_config['anon_deleteFolders'] = '{WK_CONF_DELETE_FOLDERS|anon_deleteFolders|bool|0}'; //WK_CONF_DELETE_FOLDERS_DESC

  // WK_CONF_EDITION
  # WK_CONF_EDITION_DESC
  $tpl_config['editionMaxTime']       = '{WK_CONF_EDITION_MAX_TIME|editionMaxTime|string|600}';   //WK_CONF_EDITION_MAX_TIME_DESC
  $tpl_config['editionWarningTime']   = '{WK_CONF_EDITION_WARNING_TIME|editionWarningTime|string|120}';   //WK_CONF_EDITION_WARNING_TIME_DESC

  // WK_CONF_XINHA_EFM
  # WK_CONF_XINHA_EFM_DESC
  /* SEEMS TO BE OBSOLETE? */
  /* $tpl_config['efm_delete_file']         = '{WK_CONF_FM_DEL_FILE|efm_delete_file|bool|1}';   //WK_CONF_FM_DEL_FILE_DESC */
  $tpl_config['efm_allow_upload']   = '{WK_CONF_EFM_ALLOW_UPLOAD|efm_allow_upload|bool|1}';   //WK_CONF_EFM_ALLOW_UPLOAD_DESC
  $tpl_config['efm_max_filesize_kb_image']       = '{WK_CONF_EFM_MAX_IMAGE_SIZE|efm_max_filesize_kb_image|string|2000}';   //WK_CONF_EFM_MAX_IMAGE_SIZE_DESC
  $tpl_config['efm_max_filesize_kb_link']       = '{WK_CONF_EFM_MAX_LINK_SIZE|efm_max_filesize_kb_link|string|5000}';   //WK_CONF_EFM_MAX_LINK_SIZE_DESC
  $tpl_config['efm_max_foldersize_mb']       = '{WK_CONF_EFM_MAX_FOLDER_SIZE|efm_max_foldersize_mb|string|0}';   //WK_CONF_EFM_MAX_FOLDER_SIZE_DESC
  /* seems obsolete */
  /* $tpl_config['efm_allow_delete_folder'] = '{WK_CONF_FM_DEL_FOLDER|efm_allow_delete_folder|bool|1}';   //WK_CONF_FM_DEL_FOLDER_DESC */
  /* $tpl_config['efm_allow_create_folder'] = '{WK_CONF_FM_CREATE_FOLDER|efm_allow_create_folder|bool|1}';   //WK_CONF_FM_CREATE_FOLDER_DESC */
  $tpl_config['efm_link_enable_target'] = '{WK_CONF_EFM_LINK_ENABLE_TARGET|efm_link_enable_target|bool|1}';   //WK_CONF_EFM_LINK_ENABLE_TARGET_DESC
  $tpl_config['efm_allowed_image_extensions']  = '{WK_CONF_EFM_IMAGE_EXT|efm_allowed_image_extensions|string|jpg;gif;png;bmp}';    // WK_CONF_EFM_IMAGE_EXT_DESC
  $tpl_config['efm_allowed_link_extensions']  = '{WK_CONF_EFM_LINK_EXT|efm_allowed_link_extensions|string|jpg;gif;js;php;pdf;zip;txt;psd;png;html;swf;xml;xls;doc}';    // WK_CONF_EFM_LINK_EXT_DESC
  $tpl_config['efm_images_enable_alt'] = '{WK_CONF_EFM_IMAGES_ENABLE_ALT|efm_images_enable_alt|bool|1}';   //WK_CONF_EFM_IMAGES_ENABLE_ALT_DESC
  $tpl_config['efm_images_enable_title'] = '{WK_CONF_EFM_IMAGES_ENABLE_TITLE|efm_images_enable_title|bool|1}';   //WK_CONF_EFM_IMAGES_ENABLE_TITLE_DESC
  $tpl_config['efm_images_enable_align'] = '{WK_CONF_EFM_IMAGES_ENABLE_ALIGN|efm_images_enable_align|bool|1}';   //WK_CONF_EFM_IMAGES_ENABLE_ALIGN_DESC
  $tpl_config['efm_images_enable_styling'] = '{WK_CONF_EFM_IMAGES_ENABLE_STYLE|efm_images_enable_styling|bool|1}';   //WK_CONF_EFM_IMAGES_ENABLE_STYLE_DESC
  /* seems obsolete */
  /* $tpl_config['efm_datetime_format']     = '{WK_CONF_FM_DATETIME_FORMAT|efm_datetime_format|string|600}';   //WK_CONF_FM_DATETIME_FORMAT_DESC */
  $tpl_config['efm_image_class']              = '{WK_CONF_EFM_CLASS|efm_image_class|list|GD=>GD,IM=>Image Magick,NetPBM=>NetPBM}';   //WK_CONF_EFM_CLASS_DESC
  $tpl_config['efm_image_transform_lib_path'] = '{WK_CONF_EFM_LIB_PATH|efm_image_transform_lib_path|string|C:\Program Files\ImageMagick-5.5.7-Q16\}';          // WK_CONF_EFM_LIB_PATH_DESC
  $tpl_config['efm_allow_new_dir']            = '{WK_CONF_EFM_ALLOW_NEW_DIR|efm_allow_new_dir|bool|1}';   //WK_CONF_EFM_ALLOW_NEW_DIR_DESC
  $tpl_config['efm_allow_edit_image']            = '{WK_CONF_EFM_ALLOW_EDIT_IMAGE|efm_allow_edit_image|bool|1}';   //WK_CONF_EFM_ALLOW_EDIT_IMAGE_DESC
  $tpl_config['efm_tmp_prefix']               = '{WK_CONF_EFM_TMP_PREFIX|efm_tmp_prefix|string|.editor_}';     // WK_CONF_EFM_TMP_PREFIX_DESC
  $tpl_config['efm_thumbnail_dir']            = '{WK_CONF_EFM_THB_DIR|efm_thumbnail_dir|string|thumbs}';     // WK_CONF_EFM_THB_DIR_DESC
  $tpl_config['efm_thumbnail_prefix']         = '{WK_CONF_EFM_THB_PREFIX|efm_thumbnail_prefix|string|th_}';  // WK_CONF_EFM_THB_PREFIX_DESC
  $tpl_config['efm_resized_dir']            = '{WK_CONF_EFM_RESIZED_DIR|efm_resized_dir|string|}';     // WK_CONF_EFM_RESIZED_DIR_DESC
  $tpl_config['efm_resized_prefix']         = '{WK_CONF_EFM_RESIZED_PREFIX|efm_resized_prefix|string|.resized}';  // WK_CONF_EFM_RESIZED_PREFIX_DESC
  $tpl_config['efm_default_thumbnail']        = '{WK_CONF_EFM_DEFAULT_THB|efm_default_thumbnail|string|img/default.gif}';     // WK_CONF_EFM_DEFAULT_THB_DESC
  $tpl_config['efm_default_listicon']        = '{WK_CONF_EFM_DEFAULT_LIST|efm_default_listicon|string|icons/def_small.gif}';     // WK_CONF_EFM_DEFAULT_LIST_DESC
  $tpl_config['efm_thumbnail_extensions']  = '{WK_CONF_EFM_THB_EXT|efm_thumbnail_extensions|string|jpg;gif;png;bmp}';    // WK_CONF_EFM_THB_EXT_DESC
  $tpl_config['efm_thumbnail_width']          = '{WK_CONF_EFM_THB_WIDTH|efm_thumbnail_width|string|96}';     // WK_CONF_EFM_THB_WIDTH_DESC
  $tpl_config['efm_thumbnail_height']         = '{WK_CONF_EFM_THB_HEIGHT|efm_thumbnail_height|string|96}';     // WK_CONF_EFM_THB_HEIGHT_DESC


?>
