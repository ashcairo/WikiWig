<?php

////////////////////
// GLOBAL LABELS //
//////////////////

@define('WK_LABEL_LINK_ADMIN','Admin');
@define('WK_LABEL_GUEST','Guest');
@define('WK_LABEL_WIKI_MAP','Wiki Map');
@define('WK_LABEL_CREATE','create');
@define('WK_LABEL_CANCEL','cancel');
@define('WK_LABEL_VALIDATE','submit');
@define('WK_LABEL_CLOSE_WINDOW','close this window');
@define('WK_LABEL_GO_WIKI','go to the wiki');
@define('WK_LABEL_FILE_MODIFIED_BY','Page being modified by ');
@define('WK_LABEL_HOME_WIKI','Wiki Home');
@define('WK_LABEL_DIR_INDEX_ALIAS','Summary (<>)');
@define('WK_LABEL_CLICK_HERE','Click here');
@define('WK_LABEL_EDIT_PAGE','Edit this page');
@define('WK_LABEL_FOLDER_MAP','map');
@define('WK_LABEL_BACK','back');
@define('WK_ERR_STANDARD','An error occured. Your request has not been carried out.');
@define('WK_LABEL_WELCOME','WELCOME !');
@define('WK_LABEL_LOGIN','LOGIN');
@define('WK_LABEL_LOGOUT','logout');
@define('WK_LABEL_AREYOU','are you');
@define('WK_LABEL_EDIT_PAGE_NO_WRITE','Nonmodifiable page');
@define('WK_LABEL_EDIT_PAGE_NO_WRITE_ADMIN','Modifiable page only under authorization');
@define('WK_LABEL_BYTES','B');

///////////////////////////// 
// WIKI LISTING (wk_list) //
///////////////////////////

@define('WK_LIST_TABLE_HEAD_FILE','page');
@define('WK_LIST_TABLE_HEAD_SIZE','size');
@define('WK_LIST_TABLE_HEAD_DATE','modification time');
@define('WK_LIST_LOCKED_FILE','Page edited by ');
@define('WK_LIST_INDEX_ALIAS','Home page');
@define('WK_LIST_ADD_DIR','add a folder here');
@define('WK_LIST_ADD_FILE','add a page here');
@define('WK_LIST_DELETE_FILE','Delete');
@define('WK_LIST_DELETE_FILE_TOOLTIP','Delete selected page(s)');
@define('WK_LIST_MOVE_FILE','Move');
@define('WK_LIST_MOVE_FILE_TOOLTIP','Move selected page(s)');
@define('WK_LIST_SELECT_FILE','Select this page and use the buttons below to process actions on it');
@define('WK_LIST_SELECT_ALL_FILES','Select or unselect all');
@define('WK_LIST_WARN_ON_DELETE_ALL_PAGES','Delete all page(s) ?');
@define('WK_LIST_DELETE_FOLDER','Delete');
@define('WK_LIST_DELETE_FOLDER_TOOLTIP','Delete selected folder');
@define('WK_LIST_MOVE_FOLDER','Move');
@define('WK_LIST_MOVE_FOLDER_TOOLTIP','Move selected folder');
@define('WK_LIST_WARN_ON_DELETE_FOLDER','Delete the selected folder ?');
@define('WK_LIST_RIGHT','Change rights');
@define('WK_LIST_RIGHT_TOOLTIP','Give access rights to users');

////////////////////////////////
// PAGE EDITION (wk_edition) //
//////////////////////////////

@define('WK_ERR_PAGE_ALREADY_EDITED_TITLE','The page is already being edited.');
@define('WK_ERR_PAGE_ALREADY_EDITED_ONE','A');
@define('WK_ERR_PAGE_ALREADY_EDITED','This system is useful to avoid more than one user work '.
    'on a page at the same time.');
@define('WK_ERR_PAGE_ALREADY_EDITED_2',' has the exclusive usage of this page for editing for ');
@define('WK_ERR_PAGE_ALREADY_EDITED_3',' minutes.<br>After this time elapses, if he finished editing the page'.
    ', he will lose the exclusive usage and the page could then be edited by someone else.');
@define('WK_EDITION_TITLE_PAGE','Editing Page %s');
@define('WK_EDITION_ACTION_SAVE','Save');
@define('WK_EDITION_ACTION_QUIT','Quit');
@define('WK_EDITION_WARNING_SAFARI_BROWSER','&nbsp;&nbsp;Xihna editor does not support Safari.<br>'.
        '&nbsp;&nbsp;The editor displayed below is a degraded editor');
@define('WK_EDITION_MESSAGE_SAVING','SAVING...');
@define('WK_EDITION_MESSAGE_LOADING','LOADING...');
@define('WK_EDITION_MESSAGE_CACHING','NB: Editor\'s first-run is long due to caching');
@define('WK_EDITION_MESSAGE_PLEASE_WAIT','please wait');
@define('WK_EDITION_MESSAGE_SESSION_WARNING','Warning : you have only %s seconds '.
                      'to modify this page.<br>Save the page to be able to go on editing'.
                      '%s minutes more. ');
@define('WK_EDITION_MESSAGE_SESSION_EXPIRED',
    '<p>Sorry! You can\'t edit this page because you didn\'t complete editing it '.
    'before the time limit of %s minutes.<br>The page is now available to all users, and '. 
    'some user may have already modified it. </p><p>If you have done modifications '.
    'and you don\'t want to lose them, you can reopen this editor page in another window and '.
    'copy/paste your modifications.</p>');

@define('WK_GO_WIKIWIG_MAP','go back to the map');
@define('WK_EDITION_ACTION_REOPEN','Reopen the page in editor');
@define('WK_EDITION_CLOSE_MESSAGE','Close this message');
@define('WK_EDITION_MESSAGE_SESSION_SYSTEM_INFO',
    'NB: This system is useful to avoid more than one user working '.
    'on a page at the same time. You have exclusive usage of the page for editing '.
    'for %s minutes. This time has elapsed, if you have not saved the page'.
    ', you lose your exclusive usage and the page can be edited by anyone else. ');
@define('WK_EDITION_FILE_PERIME','Page out-of-date');
@define('WK_EDITION_MESSAGE_ASK_SAVE','Click Ok to save and then quit. Click Cancel to exit without saving.');
@define('WK_EDITION_MESSAGE_ASK_QUIT','Do you want to quit ?');
@define('WK_EDITION_WARNING_OLD_BROWSER','Warning: Your browser is too old to use the advanced function of the full-features text editor. The editor displayed below is a degraded editor.');

@define('WK_ADD_INTERNAL', 'Select a page within the wiki for an internal link.');

////////////////
// DIRECTORY //
//////////////

// DIR Action Pages

@define('WK_CREATE_DIR_HEAD_TITLE','Folder Creation');
@define('WK_CREATE_DIR_BODY_TITLE','Add a folder in "%s"');
@define('WK_LABEL_NEW_DIR','Name of the new folder');
@define('WK_CREATE_DIR_SUCCESS','The folder "%s" has been created.');
@define('WK_CREATE_DIR_SUMMARY','');
@define('WK_DELETE_DIR_HEAD_TITLE','Delete a folder');
@define('WK_DELETE_DIR_BODY_TITLE','Delete a folder "%s"');
@define('WK_DELETE_DIR_SUCCESS','The folder "%s" has been deleted.');
@define('WK_DELETE_DIR_SUMMARY','You are going to delete a folder. Be careful when deleting folders, because each link refering to any page of this folder will become incorrect.');
@define('WK_MOVE_DIR_HEAD_TITLE','Move a Folder');
@define('WK_MOVE_DIR_BODY_TITLE','Move the folder "%s"');
@define('WK_MOVE_DIR_SUCCESS','The folder "%s" has been moved to the folder "%s".');
@define('WK_MOVE_DIR_SUMMARY','You are going to move a folder of the wiki to another folder. Be careful when moving folders, because each link refering to any page of this folder will become incorrect.');
@define('WK_MOVE_DIR_LABEL_TARGET','Choose the destination where to move the folder "%s" : ');

// ERRORS

@define('WK_ERR_DIR_NOT_EXISTS','The folder "%s" doesn\t exist.');
@define('WK_ERR_DIR_EXISTS','The folder "%s" already exists.');
@define('WK_ERR_DIR_BADNAME','The name "%s" is not allowed.');
@define('WK_ERR_DIR_NOT_WRITABLE','Unable to write to the folder "%s".');
@define('WK_ERR_DIR_PARENT_NOT_EXISTS','The folder "%s" does not exist.');
@define('WK_ERR_DIR_PARENT_NOT_WRITABLE','You can not add folders here.');
@define('WK_ERR_DIR_MAKE','Unable to add the folder "%s".');
@define('WK_ERR_DIR_DELETE_ROOT','You are not allowed to delete the root folder.');
@define('WK_ERR_DIR_DELETE_LOCKS','There are pages in the folder %s being edited, so you can\'t delete this folder now.');
@define('WK_ERR_DIR_MOVE_NOT_ALLOWED','You are not allowed to move directories.');
@define('WK_ERR_DIR_DELETE_NOT_ALLOWED','You are not allowed to delete directories.');


//////////////
// FILE    //
////////////

// CREATE FILE Page
@define('WK_CREATE_FILE_HEAD_TITLE','Create a New Page');
@define('WK_CREATE_FILE_BODY_TITLE','Add a new page in %s');
@define('WK_LABEL_NEW_FILE','Name of the new page');
@define('WK_LABEL_FILE_TEMPLATE','Type');
@define('WK_LABEL_FILE_EMPTY_TEMPLATE','Empty (only the title)');

// FILE SAVE, LOCK, UNLOCK

@define('WK_FILE_SAVED','The page %s has been successfully saved.');
@define('WK_FILE_SAVE_TITLE','Saving');
@define('WK_FILE_UNLOCK_TITLE','Closing...');

// ERRORS

@define('WK_ERR_FILE_EXISTS','Page "%s" already exists.');
@define('WK_ERR_FILE_NOT_EXISTS','Page "%s" does not exist.');
@define('WK_ERR_FILE_BADNAME','The name "%s" is not allowed.');
@define('WK_ERR_FILE_WRITE','Unable to write to page "%s" !!');
@define('WK_ERR_FILE_READ','Unable to open the page "%s" !!');
@define('WK_ERR_FILE_DELETE','Unable to delete the page %s.');
@define('WK_ERR_READ_TPL_FILE','Unable to create a page based on the template : %s !');

///////////////
// DATABASE //
/////////////

@define('DB_ERR_EXTENSION_UNAVAILABLE','The extension %s is unavailable. Please the update thenconfiguration of PHP.');
@define('DB_ERR_CONNECT_SERVER','Cannot connect to server "%s".');
@define('DB_ERR_CONNECT_DATABASE','Cannot connect to database "%s".');
@define('DB_ERR_QUERY_FAILED','The following SQL Request failed : <br/>"%s".');

///////////////////
// USER PROFILE //
/////////////////

@define('WK_PROFILE_PSEUDO_USED','This login is already in used. If it is yours, type your password.<br />Otherwise, choose another login name and do not fill the password field.');
@define('WK_PROFILE_CREATE_INSTRUCTIONS','To create your profile, please fill out the following form.');
@define('WK_PROFILE_LABEL_NAME','Name');
@define('WK_PROFILE_LABEL_PASSWORD','Password');
@define('WK_PROFILE_LABEL_PASSWORD_VERIF','Verify Password');
@define('WK_PROFILE_PSEUDO_USED_TITLE','This login is already in use.. Please choose another one.');
@define('WK_PROFILE_CREATION_ERROR','An error occured during creation');
@define('WK_PROFILE_CREATION_WISHTOCREATE','I want to create a new account');
@define('WK_PROFILE_CREATION_WISHTOLOG','I have an account already, I want to log-in');
@define('WK_PROFILE_UPDATE_TITLE','Profile Update');
@define('WK_PROFILE_UPDATE_TITLE2','Enter data to modify profile');
@define('WK_PROFILE_ANTISPAM_CONFIRMATION','A confirmation email will be sent to you');
@define('WK_PROFILE_ANTISPAM_PRIVACY','We will never provide your email to anyone');
@define('WK_PROFILE_ANTISPAM_UNSUSCRIBE','You can remove your email address once the confirmation email is sent');
@define('WK_PROFILE_ERROR_ENTER_PASSWORD','Please type in your password');
@define('WK_PROFILE_ERROR_LOGIN_DONTEXISTS','This login/password is incorrect');
@define('WK_PROFILE_ERROR_BADPASSWORD','This login/password is incorrect');
@define('WK_PROFILE_ERROR_ENTER_NEW_PASSWORD','Please type-in your new password');
@define('WK_PROFILE_ERROR_ENTER_NEW_PASSWORD_CHECK','Please type-in your password again');
@define('WK_PROFILE_ERROR_ENTER_EMAIL','Please type-in your email address (so you can use wikiwig\'s advanced features)');
@define('WK_PROFILE_ERROR_SUCCESS_PART1','Your account was created successfully, a confirmation e-mail');
@define('WK_PROFILE_ERROR_SUCCESS_PART2','will allow you to confirm your subscription');
@define('WK_PROFILE_ERROR_MAILNOTSENT','Mail not sent. Content was :');
@define('WK_PROFILE_CONNECTED_AS','You are logged in as :');
@define('WK_PROFILE_CONNECTED_INFO_PART1','You can use wikiwig\'s advanced features :');
@define('WK_PROFILE_CONNECTED_INFO_PART2','To monitor a page click on this icon');
@define('WK_PROFILE_CONNECTED_INFO_PART3','To warn users who monitor a page that you made modifications, click on this icon');
@define('WK_PROFILE_CONNECTED_MODIF_ERROR','<b>Notice</b> modification denied, field value(s)  (id, password, etc.) are invalid or missing');

//Monitoring system
@define('WK_MONITORING_WARN','ALERT');
@define('WK_MONITORING_WARN_INFO','If you validate this page, a mail will be sent to users who monitor it.');
@define('WK_MONITORING_USERSLIST','Users who monitor this page are :');
@define('WK_MONITORING_EMPTYLIST','No user is monitoring this page.t');
@define('WK_MONITORING_WARN_MAIL_ALERTYOU','alert you !');
@define('WK_MONITORING_WARN_MAILRESULTOK','Alert mail sent to');
@define('WK_MONITORING_WARN_MAILRESULTNOK','ERROR, alert mail NOT sent to');
@define('WK_MONITORING_WARN_MAILRESULTNOK2','Content was :');

//validation mail
@define('WK_PROFILE_MAIL_TITLE','Wikiwig : Subscription confirmation');
@define('WK_PROFILE_MAIL_BODY_PART0','Hi !');
@define('WK_PROFILE_MAIL_BODY_PART1','Please confirm your subscription to Wikiwig');
@define('WK_PROFILE_MAIL_BODY_PART2','by clicking this link or pasting it in your browser :');

/////////////////
// ADMIN      //
///////////////

@define('WK_ADMIN_HOME_MSG','You are in the wikiwig administration part.<br/>The available operations are listed in the left menu.');
@define('WK_LABEL_CONFIGURATION','Update the configuration of wikiwig');
@define('WK_LABEL_PARSING','Reconstruct all the pages !');
@define('WK_ADMIN_BODY_TITLE','WK Admin');
@define('WK_ADMIN_HEAD_TITLE','WK Admin');
@define('WK_ADMIN_RESULTS_TITLE','Results');
@define('WK_ADMIN_PARSE_FILE_OK','File <strong>%s</strong> successfully reconstructed.');
@define('WK_ADMIN_PARSE_FILE_ERROR','Error reconstructing file <strong>%s</strong>!');

///////////////////////////
// ADMIN AUTHENTICATION ///
///////////////////////////

@define('WK_ADMIN_AUTH_REQUIRED','Authentication required');
@define('WK_ADMIN_AUTH_LABEL_LOGIN','User name');
@define('WK_ADMIN_AUTH_LABEL_PASSWORD','Password');
@define('WK_ADMIN_AUTH_ERROR','Error: You are not authorized to access this part of the site!');
@define('WK_ADMIN_AUTH_RETRY','<a href="%s">'.WK_LABEL_CLICK_HERE.'</a></strong> to retry login.');
@define('WK_ADMIN_AUTH_INSTRUCTIONS','You need to log on to access this part of the site!');

//////////////////
// MONITORING ///
/////////////////

@define('WK_MONITORING_WARN','WARN');
@define('WK_MONITORING_WARN_INFO','If you submit this form an email will be sent to users that monitor this page.');
@define('WK_MONITORING_USERSLIST','Users who monitors this page :');
@define('WK_MONITORING_EMPTYLIST','No one monitors this page');
@define('WK_MONITORING_ADDITIONAL_USERS','Additional users :');
@define('WK_MONITORING_OPTIONNAL','optional');
@define('WK_MONITORING_MAIL_EXAMPLE','(mail separated by semi colons, fe: user@domain.com)');
@define('WK_MONITORING_WARN_MAILSENT','Users were successfully warned by email.');
@define('WK_MONITORING_WARN_MAILSENT_CONFIRM','Users were warned');

@define('WK_MONITORING_MONITOR_STOP','STOP MONITORING');
@define('WK_MONITORING_MONITOR_STOP_CONFIRM','You no longer monitor this page');
@define('WK_MONITORING_MONITOR_STOP_ALT','Stop monitoring this page');
@define('WK_MONITORING_MONITOR_START_ALT','Monitor this page');
@define('WK_MONITORING_MONITOR_START_GUESTALT','Page monitoring not available for guests');
@define('WK_MONITORING_MONITOR_WARN_ALT','Warn users that you modified this page');
@define('WK_MONITORING_MONITOR_WARN_GUESTALT','Warn users that you modified this page - not available for guests');
@define('WK_MONITORING_MONITOR_START','MONITORING');
@define('WK_MONITORING_MONITOR_START_CONFIRM','You are monitoring this page.');
@define('WK_MONITORING_MONITOR_START_INFO','You will be alerted by mail if somebody modifies this page and uses the warn feature.');



//warning mail
@define('WK_MONITORING_WARN_MAIL_PART0','Dear');
@define('WK_MONITORING_WARN_MAIL_PART1','warns you that the page');
@define('WK_MONITORING_WARN_MAIL_PART2','has changed !');
@define('WK_MONITORING_WARN_MAIL_PART3','You receive this mail because you monitor a page of the Wikiwig');

////////////
//  chat  //
////////////

@define('WK_CHAT_LIEN','To leave a message');
@define('WK_CHAT_TEASING', 'Chat with the user editing the page?');

// ETIQUETTE //
////////////////
@define('WK_ETIQUETTE_GUEST','You are a guest, to become member you must register.');
@define('WK_ETIQUETTE_TEASING','Become member and you will be able to correspond with the person who edits the page.');

// New stuff
@define('WK_USER_ADMIN','User Administration');
@define('WK_CAPTCHA_ADMIN','Configure reCaptcha keys');
// Buttons
@define('WK_DELETE','Delete');
@define('WK_UPDATE','Update');
@define('WK_NEXT','Next');
@define('WK_PREV','Previous');
@define('WK_SEARCH','Search');

@define('WK_ADMIN_RENAME_FOLDERS','Rename folders');
@define('WK_ADMIN_RENAME_FILES','Rename files');
@define('WK_ADMIN_MOVE_FOLDERS','Move folders');
@define('WK_ADMIN_MOVE_FILES','Move files');
@define('WK_ADMIN_DELETE_FOLDERS','Delete folders');
@define('WK_ADMIN_DELETE_FILES','Delete files');
@define('WK_ADMIN_RESTORE_FOLDERS','Restore folders');
@define('WK_ADMIN_RESTORE_FILES','Restore files');
@define('WK_ADMIN_CREATE_FOLDERS','Create folders');
@define('WK_ADMIN_CREATE_FILES','Create files');
@define('WK_ADMIN_EDIT_FILES','Edit files');
@define('WK_ADMIN_ADMIN','Admin');

@define('WK_LIST_READPROTECT','Read Protect');
@define('WK_LIST_WRITEPROTECT','Write Protect');
@define('WK_LIST_SELECTALL','Select All');

@define('WK_PROFILE_REMEMBER','Keep me logged in until I logout');

@define('WK_PROFILE_ERROR_ENTER_VALID_LOGIN','Login names contain only letters and numbers ');
@define('WK_PROFILE_ERROR_SUCCESS','Your account was created successfully.');
@define('WK_PROFILE_ERROR_SUCCESS_ADMIN','Your account was created successfully. Now awaiting admin setting of privileges');

@define('WK_PROFILE_LABEL_NEW_PASSWORD','New Password');
@define('WK_PROFILE_ERROR_NOT_SOLVED','Puzzle not solved. Try again.');

@define('WK_PROFILE_CONNECTED_MODIF_ERROR2','Invalid id/password');
@define('WK_PROFILE_CONNECTED_MODIF_ERROR3','New Password mismatch ');

@define('WK_PROFILE_CAPTCHA_MSG','Enter these letters');

@define('WK_CAPTCHA_PUBLIC','Public key ');
@define('WK_CAPTCHA_PRIVATE','Private key ');
@define('WK_CAPTCHA_SUCCESS','reCaptcha keys successfully updated. ');

// Messages
@define('DB_ERR_EXTENSION_UNAVAILABLE','The extension %s is not available. Check PHP configuration.');
@define('DB_ERR_CONNECT_SERVER','Unable to connect to database server "%s".');
@define('DB_ERR_CONNECT_DATABASE','Unable to connect to database "%s".');
@define('DB_ERR_QUERY_FAILED','Query to database failed : %s');

@define('WK_MOVE_FILE_SUCCESS','The file(s) have been moved to the folder "%s".');
@define('WK_MOVE_FILE_LABEL_TARGET','Choose the destination where to move the file(s) : ');

@define('WK_HISTORY_TITLE','Page History');
@define('WK_HISTORY_USER','User');
@define('WK_HISTORY_WHEN','Date');
@define('WK_HISTORY_ACTION','Action');
@define('WK_HISTORY_COMMENT','Notes');
@define('WK_HISTORY_NONE','No History');

@define('WK_LOOKUP_404','<br>The referenced page does not exist in the wiki.');
@define('WK_LOOKUP_DELETE','<br>The referenced page %s was deleted from the wiki.');
@define('WK_DELETED', 'Deleted: ');
@define('WK_MODIFIED', 'Modified: ');
@define('WK_BY', ' by: ');

@define('WK_RESTORE_FILE', 'Restore File');
@define('WK_RESTORE_DO', 'Do you wish to restore file: <strong>');
@define('WK_RESTORE_DATE', '</strong> <br>from date: ');
@define('WK_RESTORE_FILE_SUCCESS', 'The file %s has been restored');
@define('WK_RESTORE_FILE_SUCCESS2', 'The file %s has been restored from the trash');
@define('WK_RESTORE_BAD1', 'Unable to restore file. Bad parameters.');
@define('WK_LABEL_RESTORE', 'restore');
@define('WK_RESTORE_NOT_AUTHORIZED', 'You are not authorized to restore files');
@define('WK_RESTORE_NO_FILE', 'No such file');

@define('WK_UNDELETE_BAD1', 'Unable to undelete file. Bad parameters.');
@define('WK_UNDELETE_BAD2', 'Unable to undelete file. Missing file.');

@define('WK_DELETE_SUCCESS', 'File(s) deleted.');
@define('WK_MOVE_BAD', 'Unable to move file(s). Bad parameters.');

@define('WK_BACKUP_BAD1', 'Missing file.');

@define('WK_LABEL_PREVIEW', 'Preview');
@define('WK_LABEL_PREVIEW_FILE', 'Preview restore of file: ');
@define('WK_LABEL_PREVIEW_WHEN', ' from Date: ');

 // CAUTION : DO NOT ADD ANY CHARACTERS after the last line (? >), NOT EVEN A SPACE OR A CARIAGE RETURN !!!
?>