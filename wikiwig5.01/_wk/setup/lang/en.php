<?php

/*

 * Created on 30 nov. 2004

 */



//////////////////////////////

// ADMIN CONFIGURATION     //

////////////////////////////



// General

///////////////

@define('WK_CONF_TITLE','Wikiwig Configuration');
@define('WK_CONF_TITLE_UPDATE','Update configuration of your Wiki');
@define('WK_CONF_TITLE_INSTALL','Installation of your Wiki');
@define('WK_CONF_LABEL_GO_WIKI','go to the wiki');
@define('WK_CONF_LABEL_LINK_ADMIN','admin');
@define('YES','YES');
@define('NO','NO');
@define('TOGGLE_ALL','Open / Close All');
@define('TOGGLE_OPTION','Click here to open/close');
@define('CHECK_N_SAVE','Check &amp; Save');

@define('HOMEPAGE_CONTENT','<p>Welcome to your new Wiki ! <br />You can customize this page by clicking on the link "edit this page".<br/>You can access the wiki map to add or delete pages, see the list of available pages and folders, and create some new pages and folders.</p>');
@define('MAP','map');

// Messages about the process

/////////////////////////////
@define('WK_CONF_SAVED_SUCCESSFUL','Congratulations !!!<br/>Wikiwig is now set up and ready to use. To start, you can go to the <a href="%s">home page</a> of your new wiki.<br/><br/>');
@define('WK_CONF_SAVED_SUCCESSFUL2','Do not forget the information to access to the administration section of the wiki: <br/>Login: "%s"<br/>Password:"%s"');
@define('WK_CONF_DB_ALREADY_INSTALLED','The database "%s" was already installed.');
@define('WK_CONF_DB_ALREADY_INSTALLED','The database "%s" was already installed.');
@define('WK_CONF_DB_INSTALLED','The databse %s has been installed.');
@define('WK_CONF_UPDATED','Your configuration has been saved.');
@define('WK_CONF_UPGRADE_MSG','After an update of your Wiki, you should launch the reconstruction ("analyze and update") of your wiki\'s pages. You can do it by going on the <a href="%s">administration page</a> and clicking on "Reconstruct the pages", or now by <a href="%s">clicking here</a>.');

// DB
//////////

@define('WK_CONF_DB','Database Settings');
@define('WK_CONF_DB_DESC','Here you can enter all your database information. Wikiwig needs this to be able to function');

@define('WK_CONF_DB_TYPE','Server Type');
@define('WK_CONF_DB_TYPE_DESC','The system used for database. In this version, only MySQL is supported.');

@define('WK_CONF_DB_HOST','Server');
@define('WK_CONF_DB_HOST_DESC','Database host');

@define('WK_CONF_DB_USER','User');
@define('WK_CONF_DB_USER_DESC','User login');

@define('WK_CONF_DB_PASSWORD','Password');
@define('WK_CONF_DB_PASSWORD_DESC','User Password');

@define('WK_CONF_DB_NAME','Database Name');
@define('WK_CONF_DB_NAME_DESC','Name of the database');

@define('WK_CONF_DB_PREFIX','Tables prefix');
@define('WK_CONF_DB_PREFIX_DESC','prefix to name the tables, e.g. wk_');

// Paths
/////////

@define('WK_CONF_PATHS','Paths Settings');
@define('WK_CONF_PATHS_DESC','Various paths to different essential folders and files.!');

@define('WK_CONF_WK_PATH','Absolute path');
@define('WK_CONF_WK_PATH_DESC','Type the path of wikiwig in your system. i.e.: /usr/local/wikiwig/');

@define('WK_CONF_WK_HTTPPATH','HTTP Path');
@define('WK_CONF_WK_HTTPPATH_DESC','The url of wikiwg like in the adress bar of your browser, i.e.: http://www.example.com/wikiwig/ .');

@define('WK_CONF_SYSTEM_DIR','System Directory');
@define('WK_CONF_SYSTEM_DIR_DESC','System directory of wikiwig.');

@define('WK_CONF_EFM_IMAGES_DIR','Upload Directory for image files');
@define('WK_CONF_EFM_IMAGES_DIR_DESC','Directory where to post image files. Xinha (the wysiwyg page editor) needs this path to be correct in order for users to use the File Manager to manage image files.');

@define('WK_CONF_EFM_FILES_DIR','Upload Directory for files you wish to link to from wiki pages');
@define('WK_CONF_EFM_FILES_DIR_DESC','Directory where to post image files. Xinha (the wysiwyg page editor) needs this path to be correct in order for users to use the File Manager to manage files you wish to link. Often the same directory where image files are uploaded.');

@define('WK_CONF_TRASH_DIR','Trash Directory');
@define('WK_CONF_TRASH_DIR_DESC','Directory where pages are moved when a user delete them. It allows you to backup deleted files.');

@define('WK_CONF_BACKUP_DIR','Backup Directory');
@define('WK_CONF_BACKUP_DIR_DESC','Directory where older versions of pages are saved after a user saves modifications on a page (Assumes RCS/CVS not in use).');

@define('WK_CONF_TPL_DIR','Templates Directory');
@define('WK_CONF_TPL_DIR_DESC','Directory where are the templates to create new files in the wiki.');

@define('WK_CONF_HIDDEN_DIRS','Hidden Directories');
@define('WK_CONF_HIDDEN_DIRS_DESC','List of directories that Wikiwig must hide (nothing to do with your wiki pages). <br />Example: on many hosting providers, you can find at the root of your wiki directory, antoher directory called "sessions", used only by PHP. In order to hide this directory, add its name to the list: "sessions;".<br/><strong>Names of directories must be separated by semicolon ;</strong>');

@define('WK_CONF_SESSION_PATH','PHP Session Path');
@define('WK_CONF_SESSION_PATH_DESC','Directory in your web filesystem where PHP stores his sessions informations. <strong>Keep this string empty, if you are not sure of what you are doing.</strong>');

// General
///////////

@define('WK_CONF_GENERAL','General Settings');
@define('WK_CONF_GENERAL_DESC','Customize the behavior of Wikiwig');

@define('WK_CONF_WK_NAME','Wiki Name');
@define('WK_CONF_WK_NAME_DESC','Choose the name of your wiki.');

@define('WK_CONF_WK_DESCRIPTION','Wiki Short Description');
@define('WK_CONF_WK_DESCRIPTION_DESC','Type a short description of the purpose of the wiki. Optional.');

@define('WK_CONF_WK_LANGUAGE','Language');
@define('WK_CONF_WK_LANGUAGE_DESC','Language used by wikiwig. <strong>If you are making an update or an upgrade of wikiwig, changing the language is not recommended.</strong>');

@define('WK_CONF_ADMIN_LOGIN','Admin Login');
@define('WK_CONF_ADMIN_LOGIN_DESC','Login used to access the administration pages of wikiwig.');

@define('WK_CONF_ADMIN_PASS','Admin Password Admin');
@define('WK_CONF_ADMIN_PASS_DESC','Password of the adminstrator.');

@define('WK_CONF_ADMIN_MAIL','E-mail of Admin');
@define('WK_CONF_ADMIN_MAIL_DESC','E-mail of the administrator to supervise the pages');

@define('WK_CONF_USER_COOKIE_TIME','User Cookies Lifetime');
@define('WK_CONF_USER_COOKIE_TIME_DESC','Lifetime of the cookies set on user\'s computers. Those cookies are only used to provide users special configuration for using Wikiwig. <strong>Time in seconds</strong>.');

@define('WK_CONF_NB_BACKUPS','Backups Number');
@define('WK_CONF_NB_BACKUPS_DESC','The maximal number of backups used by Wikiwig. When a page is edited and saved, Wikiwig keeps the old version of the page in a specific folder. Tune this option to the maximum number of backups. (Assumes RCS/CVS not in use)');

@define('WK_CONF_WK_CSS','CSS of the Wiki');
@define('WK_CONF_WK_CSS_DESC','Stylesheet CSS used to present pages of the wiki. Could be a relative path (i.e.: wk_style.css) or an http url (i.e.: http://www.example.com/css/style.css).');

// USER RIGHTS
//////////////

@define('WK_CONF_USER_RIGHTS','User Rights');
@define('WK_CONF_USER_RIGHTS_DESC','Manage the default rights you wish to give to registered users.');

@define('WK_CONF_RENAME_FOLDERS','Rename folders');
@define('WK_CONF_RENAME_FOLDERS_DESC','');

@define('WK_CONF_RENAME_FILES','Rename files');
@define('WK_CONF_RENAME_FILES_DESC','');

@define('WK_CONF_MOVE_FOLDERS','Move folders');
@define('WK_CONF_MOVE_FOLDERS_DESC','');

@define('WK_CONF_MOVE_FILES','Move files');
@define('WK_CONF_MOVE_FILES_DESC','');

@define('WK_CONF_DELETE_FOLDERS','Delete folders');
@define('WK_CONF_DELETE_FOLDERS_DESC','');

@define('WK_CONF_DELETE_FILES','Delete files');
@define('WK_CONF_DELETE_FILES_DESC','');

// Edition
///////////

@define('WK_CONF_EDITION','Wysiwyg editor configuration');
@define('WK_CONF_EDITION_DESC','Configure the options of page editing.'); 

@define('WK_CONF_EDITION_MAX_TIME','Maximum Time');
@define('WK_CONF_EDITION_MAX_TIME_DESC','Maximum Time allowed to users to edit a page of the wiki. It avoids pages staying locked by just one user too much time.');

@define('WK_CONF_EDITION_WARNING_TIME','Warning Time');
@define('WK_CONF_EDITION_WARNING_TIME_DESC','Rest of time when alert users editing pages that they should save pages.');

// Xinha EFM
//////////////

@define('WK_CONF_XINHA_EFM','Extended File Manager');
@define('WK_CONF_XINHA_EFM_DESC','Configuration of the Extended File Manager used by the Wysiwyg editor (Xinha). <br>The extended filemanager lets you upload files for linking to wiki pages or to insert the file (typically image files) into wiki pages.');

@define('WK_CONF_EFM_CLASS','Library');
@define('WK_CONF_EFM_CLASS_DESC','Library used to manipulate image files. The image manipulation library to use, either GD or ImageMagick (IM) or NetPBM. If you have safe mode ON, or do not have the binaries to other packages, your choice is GD only. Other packages require Safe Mode to be off.');

@define('WK_CONF_EFM_LIB_PATH','Library Path');
@define('WK_CONF_EFM_LIB_PATH_DESC','Absolute path to the library. i.e.: C:/Program Files/ImageMagick/  . After defining which library to use, if it is NetPBM or IM, you need to specify where the binary for the selected library are. And of course your server and PHP must be able to execute them (i.e. safe mode is OFF). GD does not require the following definition.');

@define('WK_CONF_EFM_ALLOW_NEW_DIR','Create Sub-directories');
@define('WK_CONF_EFM_ALLOW_NEW_DIR_DESC','Allow the user to create new sub-directories in the upload area(s).');

@define('WK_CONF_EFM_ALLOW_EDIT_IMAGE','Edit Image Files');
@define('WK_CONF_EFM_ALLOW_EDIT_IMAGE_DESC','Allow the user to edit files in the image directory.');

@define('WK_CONF_EFM_MAX_IMAGE_SIZE', 'Image Size');
@define('WK_CONF_EFM_MAX_IMAGE_SIZE_DESC', 'Maximum size (in kilobytes) allowed for an individual image file');

@define('WK_CONF_EFM_MAX_LINK_SIZE', 'Document File Size');
@define('WK_CONF_EFM_MAX_LINK_SIZE_DESC', 'Maximum file size (in kilobytes) allowed for an individual document file to be uploaded');

@define('WK_CONF_EFM_MAX_FOLDER_SIZE', 'Upload Folder(s) Size');
@define('WK_CONF_EFM_MAX_FOLDER_SIZE_DESC', 'Maximum upload folder size in megabytes. Use 0 to set unlimited size');

@define('WK_CONF_EFM_IMAGE_EXT', 'Image File Extensions');
@define('WK_CONF_EFM_IMAGE_EXT_DESC', 'Allowed extensions for uploaded image files. Extensions are separated by semicolon');

@define('WK_CONF_EFM_LINK_EXT', 'Document File Extensions');
@define('WK_CONF_EFM_LINK_EXT_DESC', 'Allowed extensions for uploaded document files. Extensions are separated by semicolon');

@define('WK_CONF_EFM_ALLOW_UPLOAD','Files upload');
@define('WK_CONF_EFM_ALLOW_UPLOAD_DESC','Allow the user to upload document and image files.');

@define('WK_CONF_EFM_LINK_ENABLE_TARGET','Link Targets');
@define('WK_CONF_EFM_LINK_ENABLE_TARGET_DESC','Allow the user to set target attribute for link (the window in which the link will be opened).');

@define('WK_CONF_EFM_IMAGES_ENABLE_ALT','Image Attribute - Alternative Text');
@define('WK_CONF_EFM_IMAGES_ENABLE_ALT_DESC','Allow the user to set alternative text attribute for an image (displayed when browser cannot display the image).');

@define('WK_CONF_EFM_IMAGES_ENABLE_TITLE','Image Attribute - Image Title ');
@define('WK_CONF_EFM_IMAGES_ENABLE_TITLE_DESC','Allow the user to set title text attribute for an image (normally displayed when mouse is over the image).');

@define('WK_CONF_EFM_IMAGES_ENABLE_ALIGN','Image Attribute - Alignment');
@define('WK_CONF_EFM_IMAGES_ENABLE_ALIGN_DESC','Allow the user to set alignment attribute (e.g. left, center, right) for an image.');

@define('WK_CONF_EFM_IMAGES_ENABLE_STYLE','Image Attribute - Styling');
@define('WK_CONF_EFM_IMAGES_ENABLE_STYLE_DESC','Allow the user to set margin, padding, and border styles for an image.');

@define('WK_CONF_EFM_THB_DIR','Thumbnails Folder');
@define('WK_CONF_EFM_THB_DIR_DESC','Thumbnail can also be stored in a directory, this directory will be created by PHP. If PHP is in safe mode, this parameter is ignored, you can not create directories. If you do not want to store thumbnails in a directory, set this to false or empty string.');

@define('WK_CONF_EFM_THB_PREFIX','Thumbnails Prefix');
@define('WK_CONF_EFM_THB_PREFIX_DESC','Thumbnail filename prefix.');

@define('WK_CONF_EFM_RESIZED_DIR','Resized Images Folder');
@define('WK_CONF_EFM_RESIZED_DIR_DESC','Resized images can also be stored in a directory, this directory will be created by PHP. If PHP is in safe mode, this parameter is ignored, you can not create directories. If you do not want to store resized images in a directory, set this to false or empty string.');

@define('WK_CONF_EFM_RESIZED_PREFIX','Resized Images Prefix');
@define('WK_CONF_EFM_RESIZED_PREFIX_DESC','The prefix for resized image files, something like .resized will do. The  resized files will be named as "prefix_imagefile.ext", that is, prefix + orginal filename.');

@define('WK_CONF_EFM_DEFAULT_THB','Default Thumbnail');
@define('WK_CONF_EFM_DEFAULT_THB_DESC','The default thumbnail if the thumbnails can not be created, either due to error or bad image file.');

@define('WK_CONF_EFM_DEFAULT_LIST','Default List Icon');
@define('WK_CONF_EFM_DEFAULT_LIST_DESC','When viewing uploaded files in list view the default icon to show.');

@define('WK_CONF_EFM_THB_EXT', 'Thumbnail Extensions');
@define('WK_CONF_EFM_THB_EXT_DESC', 'Allowed extensions for thumbnail files. Normally identical to allowed image files extensions. Extensions are separated by semicolon');

@define('WK_CONF_EFM_THB_WIDTH','Thumbnail width');
@define('WK_CONF_EFM_THB_WIDTH_DESC','<strong>In pixels</strong>');

@define('WK_CONF_EFM_THB_HEIGHT','Thumbnail height');
@define('WK_CONF_EFM_THB_HEIGHT_DESC','<strong>In pixels</strong>');

@define('WK_CONF_EFM_TMP_PREFIX','Temporary Prefix');
@define('WK_CONF_EFM_TMP_PREFIX_DESC','Image Editor temporary filename prefix.');

// Errors
/////////////

@define('WK_CONF_ERRORS_CONF','Warning, there are mistakes in your configuration :');
@define('WK_CONF_ERRORS_INSTALL','Warning, a problem occured during the installation : ');

//mail

@define('WK_CONF_ERR_MAIL','Indicate your address e-mail in order to be able to supervise certain pages');
@define('WK_PROFILE_ERROR_SUCCESS_PART1','Your account was created successfully, an email of confirmation ');
@define('WK_PROFILE_ERROR_SUCCESS_PART2','will enable you to validate it');
@define('WK_PROFILE_ERROR_MAILNOTSENT','The mall was not sent. Its contents were :');
@define('WK_PROFILE_CONNECTED_AS','You are connected as:');
@define('WK_PROFILE_CONNECTED_INFO_PART1','You can benefit from the advanced functionalities of wikiwig : ');
@define('WK_PROFILE_CONNECTED_INFO_PART2','To be prevented modifications of a page of the wiki click on the icon');
@define('WK_PROFILE_CONNECTED_INFO_PART3','To alert the people who supervise a page of your modifications, click on the icon');
@define('WK_LOGIN_ADMIN_BIS','The name of the administrator is already to record, want to modify it');

//validation mail

@define('WK_PROFILE_MAIL_TITLE','Wikiwig : Confirmation of inscription');
@define('WK_PROFILE_MAIL_BODY_PART0','Hello !');
@define('WK_PROFILE_MAIL_BODY_PART1','Please confirm your inscription in Wikiwig');
@define('WK_PROFILE_MAIL_BODY_PART2','while clicking on the following bond or by recopying it in your navigator Web : ');
@define('WK_CONF_ERR_WRITE_CONF_FILE','The configuration file %s can\'t be saved : check your rights for writing this file ! <a href="../../readme.installation.error.html" target="_blank">need help ?</a>.');

// Dirs

@define('WK_CONF_ERR_DB_BAD_TBL_PREFIX','Given Prefix for tables names is forbidden. Avoid using punctuation characters except the _ .');
@define('WK_CONF_ERR_DIR_CREATE','Unable to create the dir "%s" ! Check your rights for writing in the wikiwig directory !<a href="../../readme.installation.error.html" target="_blank">need help ?</a>');
@define('WK_CONF_ERR_DIR_NO_WRITE','Unable to write to write in the directory "%s"  ! Make sure, you are allowed to write to this directory... <a href="../../readme.installation.error.html" target="_blank">need help ?</a>');

// DB

@define('WK_CONF_ERR_DB_INSTALL','An error occured during the installation of the database. Check out your database, see if new tables have been created. If not, relaunch the current page, or verify the prefix you gave to the tables.');
@define('WK_CONF_ERR_DB_LIB_NOT_FOUND','The PHP Library used by Wikiwig could not have been found. Make sure that you have installed the complete release of Wikiwig.');
@define('DB_ERR_EXTENSION_UNAVAILABLE','The extension %s is not available. Verify your configuration of PHP.');
@define('DB_ERR_CONNECT_SERVER','Unable to connect to server "%s". Verify the given name for the database server, the login and the password.');
@define('DB_ERR_CONNECT_DATABASE','Unable to connect to database "%s".');
@define('DB_ERR_QUERY_FAILED','The following SQL query has failed : %s');

// GRAPHIC LIB

@define('WK_CONF_ERR_GRAPH_LIB_NOT_FOUND','The path for the Graphic library %s "%s" was not found. Make sure you gave the correct path or change to another graphic library. You can use GD by default.');

// NEW
// USER RIGHTS
//////////////

@define('WK_CONF_HTTPS','HTTP/HTTPS');
@define('WK_CONF_HTTPS_DESC','Use HTTP or HTTPS for login pages');
@define('WK_CONF_USE_HTTPS','HTTPS');
@define('WK_CONF_USE_HTTP','HTTP');

@define('WK_CONF_CAPTCHA','Captcha');
@define('WK_CONF_CAPTCHA_DESC','Use a captcha to discourage robots from creating logins<br> phpCaptcha is a simple captcha that requires no extra configuration.<br>reCaptcha requires an account at http://recaptcha.net and secondary configuration by the admin to install the public and private keys.');
@define('WK_CONF_NO_CAPTCHA','No Captcha');

@define('WK_CONF_EDIT_FILES','Edit Files');
@define('WK_CONF_EDIT_FILES_DESC','');

@define('WK_CONF_RESTORE_FILES','Restore Files');
@define('WK_CONF_RESTORE_FILES_DESC','');

@define('WK_CONF_RESTORE_FOLDERS','Restore Folders');
@define('WK_CONF_RESTORE_FOLDERS_DESC','');

@define('WK_CONF_CREATE_FILES','Create Files');
@define('WK_CONF_CREATE_FILES_DESC','');

@define('WK_CONF_CREATE_FOLDERS','Create Folders');
@define('WK_CONF_CREATE_FOLDERS_DESC','');

// GUEST RIGHTS

@define('WK_CONF_GUEST_RIGHTS','Guest Rights');
@define('WK_CONF_GUEST_RIGHTS_DESC','Manage the rights you wish to give to anonymous users.');

// 
@define('WK_CONF_APPROVAL', 'New User Approval');
@define('WK_CONF_APPROVAL_DESC', 'How to verify user is acceptable: ' .
                               '<br> Via email response. (<b>Requires</b> wiki access to mail server.)' .
			       '<br> Via admin response.'  .
			       '<br> No checking, everyone is approved.');
@define('WK_CONF_APPROVE_BY_EMAIL', 'Email');
@define('WK_CONF_APPROVE_BY_ADMIN', 'Admin');
@define('WK_CONF_APPROVE_ALL', 'None');

@define('WK_CONF_EMAIL_SERVER', 'Mail Server Setup');
@define('WK_CONF_EMAIL_SERVER_DESC', 'Connection to use for sending email. Email may be sent during subscription confirmation and for warnings on page modifications. <br>SMTP is the only client available. <br> None disables use of email and will disable the warning/monitoring features.');
@define('WK_CONF_EMAIL_SMTP', 'SMTP');

@define('WK_CONF_NONE', 'None');
@define('WK_CONF_REVISION', 'Revision Control (RCS/CVS/Internal not yet implemented)');
@define('WK_CONF_REVISION_DESC', 'How does wikiwig maintain old versions of wiki pages.<br> RCS: rcs tools must be present.<br>CVS: cvs tools must be installed.<br>Internal: use wikiwig code to manage revisions.<br>None: use wikiwig backup directory');
@define('WK_CONF_RCS_INT', 'Internal');

@define('WK_CONF_ERR_NO_EMAIL', 'A setting of no mail server in incompatible with approving users by email confirmation');


?>