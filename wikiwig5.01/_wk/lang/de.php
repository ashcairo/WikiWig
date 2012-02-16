<?php
////////////////////
// GLOBAL LABELS //
//////////////////
@define('WK_LABEL_LINK_ADMIN','Admin');
@define('WK_LABEL_GUEST','Gast');
@define('WK_LABEL_WIKI_MAP','&Uuml;bersicht');
@define('WK_LABEL_CREATE','Anlegen');
@define('WK_LABEL_CANCEL','Abbrechen');
@define('WK_LABEL_VALIDATE','Absenden');
@define('WK_LABEL_CLOSE_WINDOW','Fenster schliessen');
@define('WK_LABEL_GO_WIKI','Zum Wiki');
@define('WK_LABEL_FILE_MODIFIED_BY','Datei wird ge&auml;ndert von ');
@define('WK_LABEL_HOME_WIKI','Wiki Home');
@define('WK_LABEL_DIR_INDEX_ALIAS','Index (<>)');
@define('WK_LABEL_CLICK_HERE','Hier klicken');
@define('WK_LABEL_EDIT_PAGE','Diese Seite bearbeiten !');
@define('WK_LABEL_FOLDER_MAP','&Uuml;bersicht');
@define('WK_LABEL_BACK','Zur&uuml;ck');
@define('WK_ERR_STANDARD','Ein Fehler ist aufgetreten. Ihre Anforderung konnte nicht ausgef&uuml;hrt werden.');
@define('WK_LABEL_WELCOME','WILLKOMMEN !');
@define('WK_LABEL_LOGIN','Anmelden');
@define('WK_LABEL_LOGOUT','Abmelden');
@define('WK_LABEL_AREYOU','Sind Sie');
@define('WK_LABEL_EDIT_PAGE_NO_WRITE','Seite kann nicht ver&auml;ndert werden.');
@define('WK_LABEL_EDIT_PAGE_NO_WRITE_ADMIN','Seite darf nur mit besonderer Erlaubnis ver&auml;ndert werden.');
@define('WK_LABEL_BYTES','B');

/////////////////////////////
// WIKI LISTING (wk_list) //
///////////////////////////

@define('WK_LIST_TABLE_HEAD_FILE','Seite');
@define('WK_LIST_TABLE_HEAD_SIZE','Gr&ouml;ße');
@define('WK_LIST_TABLE_HEAD_DATE','Datum');
@define('WK_LIST_LOCKED_FILE','Datei ge&auml;ndert von ');
@define('WK_LIST_INDEX_ALIAS','Homepage');
@define('WK_LIST_ADD_DIR','Hier neuen Ordner anlegen');
@define('WK_LIST_ADD_FILE','Hier neue Seite anlegen');
@define('WK_LIST_DELETE_FILE','L&ouml;schen');
@define('WK_LIST_DELETE_FILE_TOOLTIP','Ausgew&auml;hlte Datei löschen');
@define('WK_LIST_MOVE_FILE','Verschieben');
@define('WK_LIST_MOVE_FILE_TOOLTIP','Ausgew&auml;hlte Datei verschieben');
@define('WK_LIST_SELECT_FILE','Diese Seite ausw&auml;hlen und Buttons unten benutzen um Aktionenn darafu anzuwenden');
@define('WK_LIST_SELECT_ALL_FILES','Auswahl Alle/Aufheben');
@define('WK_LIST_WARN_ON_DELETE_ALL_PAGES','Alle Seiten l&ouml;schen?');
@define('WK_LIST_DELETE_FOLDER','L&ouml;schen');
@define('WK_LIST_DELETE_FOLDER_TOOLTIP','Diesen Ordner l&ouml;schen');
@define('WK_LIST_MOVE_FOLDER','Verschieben');
@define('WK_LIST_MOVE_FOLDER_TOOLTIP','Ausgew&auml;hlten Ordner verschieben');
@define('WK_LIST_WARN_ON_DELETE_FOLDER','Ausgew&auml;hlten Ordner l&ouml;schen ?');
@define('WK_LIST_RIGHT','Berechtigungen zuweisen');
@define('WK_LIST_RIGHT_TOOLTIP','Benutzern Zugriffsrechte einr&auml;umen');

////////////////////////////////
// PAGE EDITION (wk_edition) //
//////////////////////////////

@define('WK_ERR_PAGE_ALREADY_EDITED_TITLE','Die Seite wird bereits bearbeitet.');
@define('WK_ERR_PAGE_ALREADY_EDITED_ONE','Ein');
@define('WK_ERR_PAGE_ALREADY_EDITED','Die Seite "%s" wird gerade bearbeitet!');
@define('WK_ERR_PAGE_ALREADY_EDITED_2',' hat die Seite in Bearbeitung. Nach');
@define('WK_ERR_PAGE_ALREADY_EDITED_3',' Minuten erlischt dieser Zugriff, wenn der Nutzer die Bearbeitung abschliesst.');
@define('WK_EDITION_TITLE_PAGE','Seite %s bearbeiten');
@define('WK_EDITION_ACTION_SAVE','Speichern');
@define('WK_EDITION_ACTION_QUIT','Beenden');
@define('WK_EDITION_WARNING_SAFARI_BROWSER','&nbsp;&nbsp;Der Editor Xihna funktioniert nicht mit Safari.<br>.');
@define('WK_EDITION_MESSAGE_SAVING','SPEICHERE...');
@define('WK_EDITION_MESSAGE_LOADING','LADE...');
@define('WK_EDITION_MESSAGE_CACHING','NB: Beim ersten Aufruf ist die Ladezeit des Editors etwas l&auml;nger (Cacheing).');
@define('WK_EDITION_MESSAGE_PLEASE_WAIT','Bitte warten');

@define('WK_EDITION_MESSAGE_SESSION_WARNING','Achtung, Sie haben nur noch %s Sekunden Zeit,'.
                      'um die Seite zu bearbeiten.<br>Zum Forführen bitte speichern. Neue Bearbeitungsfrist dann'.
		       '%s Minuten  ');
@define('WK_EDITION_MESSAGE_SESSION_EXPIRED',
    '<p>Entschuldigung! Sie k&ouml;nnen die Seite nicht mehr bearbeiten, weil sie seit mehr als'.
    ' %s Minuten nicht gespeichert wurde.<br>Die Seite ist für alle Benutzer zug&auml;nglich und'. 
    ' daher k&ouml;nnte sie inzwischen jemand anderes bearbeitet haben. </p><p>Wenn Sie &Auml;nderungen gemacht haben, '.
    'die sie nicht verlieren m&ouml;chten, so k&ouml;nnen Sie Ihren Text kopieren, die Seite in einem '.
    ' neuen Editorfenster &ouml;ffnen und Ihre Daten durch Einfügen &uuml;bertragen.</p>');
@define('WK_GO_WIKIWIG_MAP','Zurück zur &Uuml;bersicht');
@define('WK_EDITION_ACTION_REOPEN','Editorseite neu &ouml;ffnen');
@define('WK_EDITION_CLOSE_MESSAGE','Dieses Fenster schliessen');
@define('WK_EDITION_MESSAGE_SESSION_SYSTEM_INFO',
    'Hinweis : Dieses System soll verhindern, da&szlig; mehrere Benutzer '.
    'gleichzeitg eine Seite bearbeiten. Sie haben %s Minuten ausschliesslichen Zugriff '.
    'Diese Zeit läuft ab, bis Sie die Seite sichern'.
    ', danach verlieren Sie den Zugriff darauf und jemand anderes kann die Seite bearbeiten.');
@define('WK_EDITION_FILE_PERIME','Datei ist nicht mehr aktuell');
@define('WK_EDITION_MESSAGE_ASK_SAVE','Wollen Sie die Seite speichern?');
@define('WK_EDITION_MESSAGE_ASK_QUIT','Wollen Sie den Editor beenden?');
@define('WK_EDITION_WARNING_OLD_BROWSER','Achtung: Ihr Browser unterst&uuml;tz die Editor-Funktion nicht.');

@define('WK_ADD_INTERNAL', 'W&auml;hlen Sie eine Seite innerhalb des Wikis f&uuml;r eine Verkn&uuml;fung aus.');

////////////////
// DIRECTORY //
//////////////
// CREATE DIR Page

@define('WK_CREATE_DIR_HEAD_TITLE','Ordner anlegen');
@define('WK_CREATE_DIR_BODY_TITLE','Ordner in %s anlegen');
@define('WK_LABEL_NEW_DIR','Name des neuen Ordners');
@define('WK_CREATE_DIR_SUCCESS','Der Ordner "%s" wurde angelegt.');
@define('WK_CREATE_DIR_SUMMARY','');
@define('WK_DELETE_DIR_HEAD_TITLE','Einen Ordner l&ouml;schen');
@define('WK_DELETE_DIR_BODY_TITLE','Ordner  "%s" l&ouml;schen');
@define('WK_DELETE_DIR_SUCCESS',' "Der Ordner "%s" wurde gel&ouml;scht.');
@define('WK_DELETE_DIR_SUMMARY','Sie sind dabei, einen oder mehrere Ordner zu l&ouml;schen. Bitte beachten Sie, da&szlig; dadurch alle links auf Seiten innerhalb des Ordners ung&uuml;ltig werden.');
@define('WK_MOVE_DIR_HEAD_TITLE','Ordner verschieben');
@define('WK_MOVE_DIR_BODY_TITLE','Ordner "%s" verschieben');
@define('WK_MOVE_DIR_SUCCESS','Der Ordner "%s" wurde in den Ordner "%s" verschoben.');
@define('WK_MOVE_DIR_SUMMARY','Sie sind dabei, einen oder mehrere Ordner zu verschieben. Bitte beachten Sie, da&szlig; dadurch alle links auf Seiten innerhalb des Ordners ung&uuml;ltig werden.');
@define('WK_MOVE_DIR_LABEL_TARGET','W&auml;hlen Sie das Ziel f&uuml;r die Verschiebung des Ordners "%s" : ');


// ERRORS

@define('WK_ERR_DIR_NOT_EXISTS','Der Ordner "%s" existiert nicht.');
@define('WK_ERR_DIR_EXISTS','Der Ordner "%s" ist bereits vorhanden.');
@define('WK_ERR_DIR_BADNAME','Der Name "%s" ist nicht zul&auml;ssig.');
@define('WK_ERR_DIR_NOT_WRITABLE','Der Ordner "%s" ist nicht beschreibbar.');
@define('WK_ERR_DIR_PARENT_NOT_EXISTS','Der Ordner "%s" existiert nicht.');
@define('WK_ERR_DIR_PARENT_NOT_WRITABLE','Hier kann man keine Ordner erzeugen.');
@define('WK_ERR_DIR_MAKE','Kann Ordner "%s" nicht anlegen.');
@define('WK_ERR_DIR_DELETE_ROOT','Sie d&uuml;rfen den Stammordner nicht l&ouml;schen.');
@define('WK_ERR_DIR_DELETE_LOCKS','Seiten im Ordner %s werden gerade bearbeitet. Daher kann diesr Ordner jetzt nicht entfernt werden.');
@define('WK_ERR_DIR_MOVE_NOT_ALLOWED','Sie d&uuml;rfen keine Ordner verschieben.');
@define('WK_ERR_DIR_DELETE_NOT_ALLOWED','Sie d&uuml;rfen keine Ordner l&ouml;schen.');

//////////////
// FILE    //
////////////

// CREATE FILE Page
@define('WK_CREATE_FILE_HEAD_TITLE','Neue Seite alegen');
@define('WK_CREATE_FILE_BODY_TITLE','Neue Seite in %s anlegen');
@define('WK_LABEL_NEW_FILE','Name der neuen Seite');
@define('WK_LABEL_FILE_TEMPLATE','Typ');
@define('WK_LABEL_FILE_EMPTY_TEMPLATE','Leere Seite (nur Titel)');

// FILE SAVE, LOCK, UNLOCK

@define('WK_FILE_SAVED','Die Seite %s wurde angelegt.');
@define('WK_FILE_SAVE_TITLE','Speichern...');
@define('WK_FILE_UNLOCK_TITLE','Schliessen...');

// ERRORS

@define('WK_ERR_FILE_EXISTS','Die Seite "%s" existiert schon.');
@define('WK_ERR_FILE_NOT_EXISTS','Die Seite "%s" existiert nicht.');
@define('WK_ERR_FILE_BADNAME','Der Name "%s" ist unzul&aum;ssig.');
@define('WK_ERR_FILE_WRITE','Kann "%s" nicht beschreiben !!');
@define('WK_ERR_FILE_READ','Kann "%s" nicht &ouml;ffnen!!');
@define('WK_ERR_FILE_DELETE','Kann %s. nicht l&ouml;schen');
@define('WK_ERR_READ_TPL_FILE','Kann keine Seite aus Vorlage : %s erzeugen !');


///////////////
// DATABASE //
/////////////

@define('DB_ERR_EXTENSION_UNAVAILABLE','Die Erweiterung %s ist nicht verf&uuml;gbar. Bitte &uuml;berpr&uuml;fen Sie die Konfiguration von PHP.');
@define('DB_ERR_CONNECT_SERVER','Kann nicht zu Server "%s" verbinden.');
@define('DB_ERR_CONNECT_DATABASE','Kann nicht zu Datenbank "%s" verbinden.');
@define('DB_ERR_QUERY_FAILED','Die folgende SQL-Abfrage scheiterte : <br/>%s.');

///////////////////
// USER PROFILE //
/////////////////

@define('WK_PROFILE_PSEUDO_USED','Dieser Benutzername wird gerade verwendet. '.
	'Wenn es wirklich Ihrer ist, geben Sie bitte Ihr Passwort ein.<br /> '.
	'Andernfalls w&auml;hlen Sie bitte einen anderen Benutzernamen und geben Sie das Passwort an.');
@define('WK_PROFILE_CREATE_INSTRUCTIONS','Um eine Benutzerprofil anzulegen, bitte folgendes Formular ausf&uuml;llen.');
@define('WK_PROFILE_LABEL_NAME','Name');
@define('WK_PROFILE_LABEL_PASSWORD','Passwort');
@define('WK_PROFILE_LABEL_PASSWORD_VERIF','Passwort');
@define('WK_PROFILE_PSEUDO_USED_TITLE','Dieser Benutzername ist bereits vergeben. Bitte w&auml;hlen Sie einen anderen.');
@define('WK_PROFILE_CREATION_ERROR','Fehler w&auml;hrend des Anlegens');
@define('WK_PROFILE_CREATION_WISHTOCREATE','Ich m&ouml;chte einen neuen Account anlegen');
@define('WK_PROFILE_CREATION_WISHTOLOG','Ich bin schon registriert und m&ouml;chte mich anmelden');
@define('WK_PROFILE_UPDATE_TITLE','Profil Aktualisierung');
@define('WK_PROFILE_UPDATE_TITLE2','Ich wÃ¼nsche, meine Angaben zu Ã¤nde');
@define('WK_PROFILE_ANTISPAM_CONFIRMATION','Eine Email zur Best&auml;tigung wird Ihnen zugeschickt');
@define('WK_PROFILE_ANTISPAM_PRIVACY','Wir werden Ihre E-Mailadresse niemals weitergeben');
@define('WK_PROFILE_ANTISPAM_UNSUSCRIBE','Wenn Sie m&ouml;chten, k&ouml;nnen Sie die Beobachtung der Seite abschalten.');
@define('WK_PROFILE_ERROR_ENTER_PASSWORD','Bitte geben Sie Ihr Passwort ein');
@define('WK_PROFILE_ERROR_LOGIN_DONTEXISTS','Name oder Passwort sind falsch');
@define('WK_PROFILE_ERROR_BADPASSWORD','Name oder Passwort sind falsch');
@define('WK_PROFILE_ERROR_ENTER_NEW_PASSWORD','Bitte Ihr neues Passwort eingeben');
@define('WK_PROFILE_ERROR_ENTER_NEW_PASSWORD_CHECK','Passwort wiederholen');
@define('WK_PROFILE_ERROR_ENTER_EMAIL','Bitte geben SIe Ihre E-Mail-Adresse an, um die Benchrichtigungsfunktionen zu nutzen');
@define('WK_PROFILE_ERROR_SUCCESS_PART1','Ihr Account wurde angelegt. Eine E-Mail ');
@define('WK_PROFILE_ERROR_SUCCESS_PART2','wird Ihnen erm&ouml;glichen, Ihre Anmeldung zu best&auml;tigen.');
@define('WK_PROFILE_ERROR_MAILNOTSENT','Mail konnte nicht verschickt werden. Inhalt war:');
@define('WK_PROFILE_CONNECTED_AS','Sie sind eingeloggt als :');
@define('WK_PROFILE_CONNECTED_INFO_PART1','Sie k&ouml;nnen jetz die erweiterten Funktionen von Wikiwig nutzen:');
@define('WK_PROFILE_CONNECTED_INFO_PART2','Um eine Seite zu beobachten, klicke Sie auf diese Icon');
@define('WK_PROFILE_CONNECTED_INFO_PART3','Um andere Nutzer, die die Seite beobachten, &uuml;ber Ihre &Auml;nderungen zu  benachrichtigen, klicken Sie auf dieses Icon');
@define('WK_PROFILE_CONNECTED_MODIF_ERROR','Achtung, um die &Auml;nderungen auszuf&uuml;hren, m&uuml;ssen alle Felder ausgef&uuml;llt sein (Nutzername, Passwort)');

//Monitoring system
@define('WK_MONITORING_WARN','ALERT');
@define('WK_MONITORING_WARN_INFO','If you validate this page, a mail will be sent to users who monitor it.');
@define('WK_MONITORING_USERSLIST','Users who monitor this page are :');
@define('WK_MONITORING_EMPTYLIST','No user is monitoring this page.t');
@define('WK_MONITORING_WARN_MAIL_ALERTYOU','benachrichtigt Sie !');
@define('WK_MONITORING_WARN_MAILRESULTOK','Benachrichtigungs E-Mail wurde verschickt an ');
@define('WK_MONITORING_WARN_MAILRESULTNOK','ERROR, Benachrichtigungs E-Mail konnte NICHT verschickt werden!');
@define('WK_MONITORING_WARN_MAILRESULTNOK2','Inhalt war:');

//validation mail
@define('WK_PROFILE_MAIL_TITLE','Wikiwig : Anmeldebest&auml;tigung');
@define('WK_PROFILE_MAIL_BODY_PART0','Hallo !');
@define('WK_PROFILE_MAIL_BODY_PART1','Bitte best&auml;tigen Sie Ihre Anmeldung bei Wikiwig');
@define('WK_PROFILE_MAIL_BODY_PART2','indem Sie auf diesen Link klicken oder ihn in die Adresszeile Ihres Browsers einf&uuml;gen:');


/////////////////
// ADMIN      //
///////////////

@define('WK_ADMIN_HOME_MSG','Dies ist der Administrationsbereich des Wikis.<br/>Verf&uuml;gbare Operationen werden im linken Menu angezeigt.');
@define('WK_LABEL_CONFIGURATION','Konfiguration des Wikis aktualisieren');
@define('WK_LABEL_PARSING','Bauen Sie alle Seiten wieder auf!');
@define('WK_ADMIN_BODY_TITLE','WK Admin');
@define('WK_ADMIN_HEAD_TITLE','WK Admin');
@define('WK_ADMIN_RESULTS_TITLE','Ergebnis');
@define('WK_ADMIN_PARSE_FILE_OK','Akte <strong>%s</strong>  erfolgreich wieder aufgebaut.');
@define('WK_ADMIN_PARSE_FILE_ERROR','St&Atilde;&para;rung, die Akte wieder aufbaut <strong>%s</strong>!');

///////////////////////////
// ADMIN AUTHENTICATION ///
///////////////////////////

@define('WK_ADMIN_AUTH_REQUIRED','Authentifizierung erforderlich');
@define('WK_ADMIN_AUTH_LABEL_LOGIN','Benutzername');
@define('WK_ADMIN_AUTH_LABEL_PASSWORD','Passwort');
@define('WK_ADMIN_AUTH_ERROR','Fehler: Sie sind nicht authorisiert, diese Seite zu bearbeiten!');
@define('WK_ADMIN_AUTH_RETRY','<a href="%s">'.WK_LABEL_CLICK_HERE.'</a></strong> f&uuml;r erneuten Anmeldeversuch.');
@define('WK_ADMIN_AUTH_INSTRUCTIONS','Sie m&uuml;ssen sich anmelden, um Zugriff auf diese Seiten zu erhalten!');

//////////////////
// MONITORING ///
/////////////////

@define('WK_MONITORING_WARN','WARN');
@define('WK_MONITORING_WARN_INFO','If you submit this form a mail will be sent to users who monitors this page.');
@define('WK_MONITORING_USERSLIST','Users who monitors this page :');
@define('WK_MONITORING_EMPTYLIST','No one monitors this page');
@define('WK_MONITORING_ADDITIONAL_USERS','Weitere Benutzer:');
@define('WK_MONITORING_OPTIONNAL','optional');
@define('WK_MONITORING_MAIL_EXAMPLE','(Mailadressen, durch Semikolon getrennt, z.B. user@domain.com');
@define('WK_MONITORING_WARN_MAILSENT','Die Nutzer wurden &uuml;ber Ihre &Auml;nderungen benachrichtigt.');
@define('WK_MONITORING_WARN_MAILSENT_CONFIRM','Die Nutzer wurden benachrichtig');

@define('WK_MONITORING_MONITOR_STOP','SEITE NICHT WEITER BEOBACHTEN');
@define('WK_MONITORING_MONITOR_STOP_CONFIRM','Sie beobachten diese Seite nicht mehr.');
@define('WK_MONITORING_MONITOR_STOP_ALT','Diese Seite nicht weiter beobachten');
@define('WK_MONITORING_MONITOR_START_ALT','Diese Seite beobachten');
@define('WK_MONITORING_MONITOR_START_GUESTALT','Die Funktion, Seiten zu beobachten, steht Gastbenutzern nicht zur Verf&uuml;gung');
@define('WK_MONITORING_MONITOR_WARN_ALT','Benutzer &uuml;ber Ihren &Auml;nderungen an der Seite benachrichtigen');
@define('WK_MONITORING_MONITOR_WARN_GUESTALT','Die Funktion, andere Nutzer &uuml;ber Ihre &Auml;nderungen zu benachrichtigen, steht G&auml;sten nicht zur Verf&uuml;gung.');
@define('WK_MONITORING_MONITOR_START','SEITE BEOBACHTEN');
@define('WK_MONITORING_MONITOR_START_CONFIRM','Sie beobachten diese Seite.');
@define('WK_MONITORING_MONITOR_START_INFO','Sie werden per E-Mail benachrichtigt, wenn jemand diese Seite ver&auml;ndert und dar&uuml;ber eine Mitteilung macht.');



//warning mail
@define('WK_MONITORING_WARN_MAIL_PART0','LiebeR');
@define('WK_MONITORING_WARN_MAIL_PART1','teilt Ihnen mit, da&szlig; die Seite');
@define('WK_MONITORING_WARN_MAIL_PART2','ge&auml;ndert wurde !');
@define('WK_MONITORING_WARN_MAIL_PART3','Sie erhalten die Mail, weil Sie die Seite des Wikiwig beobachten.');

////////////
//  chat  //
////////////

@define('WK_CHAT_LIEN','Eine Nachricht schicken');
@define('WK_CHAT_TEASING', 'Chat mit dem Benutzer, der die Seite bearbeitet.');

// ETIQUETTE //
////////////////
@define('WK_ETIQUETTE_GUEST','Sie sind Gast. Um Mitglied zu werden registrieren Sie sich bitte.');
@define('WK_ETIQUETTE_TEASING','Registrieren Sie sich, um mit der Person, die die Seite bearbeitet zu kommunizieren.');

// New stuff
@define('WK_USER_ADMIN','Benutzer-Verwaltung');
@define('WK_CAPTCHA_ADMIN','Bauen Sie reCaptcha Schl&Atilde;&frac14;ssel zusammen');
// Buttons
@define('WK_DELETE','L&Atilde;&para;schung');
@define('WK_UPDATE','Update');
@define('WK_NEXT','Zun&Atilde;&curren;chst');
@define('WK_PREV','Vorhergehend');
@define('WK_SEARCH','Suche');

@define('WK_ADMIN_RENAME_FOLDERS','Benennen Sie Faltbl&Atilde;&curren;tter um');
@define('WK_ADMIN_RENAME_FILES','Benennen Sie Akten um');
@define('WK_ADMIN_MOVE_FOLDERS','Verschieben Sie Faltbl&Atilde;&curren;tter');
@define('WK_ADMIN_MOVE_FILES','Verschieben Sie Akten');
@define('WK_ADMIN_DELETE_FOLDERS','L&Atilde;&para;schungfaltbl&Atilde;&curren;tter');
@define('WK_ADMIN_DELETE_FILES','L&Atilde;&para;schungakten');
@define('WK_ADMIN_RESTORE_FOLDERS','Wiederherstellungsfaltbl&Atilde;&curren;tter');
@define('WK_ADMIN_RESTORE_FILES','Wiederherstellungsakten');
@define('WK_ADMIN_CREATE_FILES','Stellen Sie Akten her');
@define('WK_ADMIN_CREATE_FOLDERS','Stellen Sie Faltbl&Atilde;&curren;tter her');
@define('WK_ADMIN_EDIT_FILES','Redigieren Sie Akten');
@define('WK_ADMIN_ADMIN','Admin');

@define('WK_LIST_READPROTECT','Gelesen sch&Atilde;&frac14;tzen Sie sich');
@define('WK_LIST_WRITEPROTECT','Schreibschutz');
@define('WK_LIST_SELECTALL','W&Atilde;&curren;hlen Sie alle vor');

@define('WK_PROFILE_REMEMBER','Halten Sie mich angemeldet, bis ich logout');

@define('WK_PROFILE_ERROR_ENTER_VALID_LOGIN','LOGON-Namen enthalten nur Buchstaben und Zahlen.');
@define('WK_PROFILE_ERROR_SUCCESS','Ihr Konto wurde erfolgreich verursacht.');
@define('WK_PROFILE_ERROR_SUCCESS_ADMIN','Ihr Konto wurde erfolgreich verursacht. Admin-Einstellung von Privilegien jetzt erwarten.');

@define('WK_PROFILE_LABEL_NEW_PASSWORD','Neues Kennwort');
@define('WK_PROFILE_ERROR_NOT_SOLVED','Puzzlespiel nicht gel&Atilde;&para;st. Versuchen noch einmal.');

@define('WK_PROFILE_CONNECTED_MODIF_ERROR2','Unzul&Atilde;&curren;ssiges id/password.');
@define('WK_PROFILE_CONNECTED_MODIF_ERROR3','Neue Kennwortfehlanpassung.');

@define('WK_PROFILE_CAPTCHA_MSG','Eingeben Sie diese Buchstaben se');

@define('WK_CAPTCHA_PUBLIC','Allgemeiner Schl&Atilde;&frac14;ssel');
@define('WK_CAPTCHA_PRIVATE','Privater Schl&Atilde;&frac14;ssel');
@define('WK_CAPTCHA_SUCCESS','reCaptcha Schl&Atilde;&frac14;ssel erfolgreich aktualisiert.');

// Messages
@define('DB_ERR_EXTENSION_UNAVAILABLE','Die Verl&Atilde;&curren;ngerung %s ist nicht vorhanden. &Atilde;&#156;berpr&Atilde;&frac14;fen Sie PHP-Konfiguration.');
@define('DB_ERR_CONNECT_SERVER','Nicht imstande, an Datenbankbediener anzuschlie&Atilde;&#159;en "%s".');
@define('DB_ERR_CONNECT_DATABASE','Nicht imstande, an Datenbank anzuschlie&Atilde;&#159;en "%s".');
@define('DB_ERR_QUERY_FAILED','Frage zur Datenbank verlassen : %s');

@define('WK_MOVE_FILE_SUCCESS','Die Akten sind auf das Faltblatt verschoben worden "%s".');
@define('WK_MOVE_FILE_LABEL_TARGET','W&Atilde;&curren;hlen Sie den Bestimmungsort, wo man die Akten verschiebt : ');

@define('WK_HISTORY_TITLE','Seiten-Geschichte');
@define('WK_HISTORY_USER','Benutzer');
@define('WK_HISTORY_WHEN','Datum');
@define('WK_HISTORY_ACTION','T&Atilde;&curren;tigkeit');
@define('WK_HISTORY_COMMENT','Anmerkungen');
@define('WK_HISTORY_NONE','Keine Geschichte');

@define('WK_LOOKUP_404','<br>Die bezogene Seite existiert nicht im wiki');
@define('WK_LOOKUP_DELETE','<br>Die bezogene Seite %s wurde aus dem wiki gel&Atilde;&para;scht');
@define('WK_DELETED', 'Gel&Atilde;&para;scht: ');
@define('WK_MODIFIED', 'Ge&Atilde;&curren;ndert: ');
@define('WK_BY', ' durch: ');

@define('WK_RESTORE_FILE', 'Wiederherstellungsakte');
@define('WK_RESTORE_DO', 'M&Atilde;&para;chten Sie Akte wieder herstellen: <strong>');
@define('WK_RESTORE_DATE', '</strong> <br>vom Datum: ');
@define('WK_RESTORE_FILE_SUCCESS', 'Die Akte %s ist wieder hergestellt worden');
@define('WK_RESTORE_FILE_SUCCESS2', 'Die Akte %s ist vom Abfall wieder hergestellt worden');
@define('WK_RESTORE_BAD1', 'Nicht imstande, Akte wieder herzustellen. Schlechte Parameter.');
@define('WK_LABEL_RESTORE', 'Wiederherstellung');
@define('WK_RESTORE_NOT_AUTHORIZED', 'Sie werden nicht berechtigt, Akten wieder herzustellen');
@define('WK_RESTORE_NO_FILE', 'Keine solche Akte');

@define('WK_UNDELETE_BAD1', 'Nicht imstande undelete Akte. Schlechte Parameter');
@define('WK_UNDELETE_BAD2', 'Nicht imstande undelete Akte. Fehlende Akte.');

@define('WK_DELETE_SUCCESS', 'Akten gel&Atilde;&para;scht.');
@define('WK_MOVE_BAD', 'Nicht imstande, Akten zu verschieben. Schlechte Parameter.');

@define('WK_BACKUP_BAD1', 'Fehlende Akte.');

@define('WK_LABEL_PREVIEW', 'Vorbetrachtung');
@define('WK_LABEL_PREVIEW_FILE', 'Vorbetrachtungwiederherstellung der Akte: ');
@define('WK_LABEL_PREVIEW_WHEN', ' vom Datum: ');

 // CAUTION : DO NOT ADD ANY CHARACTERS after the last line (? >), NOT EVEN A SPACE OR A CARIAGE RETURN !!!

?>