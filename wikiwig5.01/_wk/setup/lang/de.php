<?php
/*
 * Created on 30 nov. 2004
 * Translated 28 apr. 2005
 */

//////////////////////////////
// ADMIN CONFIGURATION     //
////////////////////////////

// General
///////////////
@define('WK_CONF_TITLE','Wikiwig Konfiguration');
@define('WK_CONF_TITLE_UPDATE','Konfiguration Ihres Wikis');
@define('WK_CONF_TITLE_INSTALL','Installation des Wiki');
@define('WK_CONF_LABEL_GO_WIKI','Zum Wiki');
@define('WK_CONF_LABEL_LINK_ADMIN','Admin');
@define('YES','JA');
@define('NO','NEIN');
@define('TOGGLE_ALL','Alle Optionen Ein-/Ausbleden');
@define('TOGGLE_OPTION','Zum &ouml;ffnen/schliessen hier anklicken');
@define('CHECK_N_SAVE','&Uuml;berprüfen &amp; Sichern');

@define('HOMEPAGE_CONTENT','<p>Willkommen in Ihrem neuen Wiki ! <br />
                Sie k&ouml;nnen diese Seite anpassen indem Sie dem Link "Diese Seite Bearbeiten" folgen.<br/>
                Die Wiki &Uuml;bersicht erm&ouml;glicht Ihnen eine baumartige Ansicht der vorhandenen Seiten und Ordner.
		Sie k&ouml;nnen damit neue Seiten und Ordner anlegen oder vorhandene l&ouml;schen.</p>');
@define('MAP','&Uuml;bersicht');

// Messages about the process

/////////////////////////////
@define('WK_CONF_SAVED_SUCCESSFUL','Gl&uuml;ckwunsch!!!<br/>Wikiwig ist eingerichtet und kann jetzt benutzt werden. Zum Starten, gehen SIe auf die <a href="%s">Homepage</a> Ihres neuen Wikis.<br/><br/>Merken Sie sich bitte die Anmeldeinformationen f&uuml;r die Administration von Wikiwig: <br/>Login: "%s"<br/>Passwort:"%s"');
@define('WK_CONF_DB_ALREADY_INSTALLED','Datenbank %s war bereits installiert.');
@define('WK_CONF_DB_INSTALLED','Datenbank %s wurde installiert.');
@define('WK_CONF_UPDATED','Konfiguration gespeichert.');
@define('WK_CONF_UPGRADE_MSG','Nach einer Aktualisierung des WIkis sollten Sie die Seiten vom System Rekonstruktion lassen, d.h. analysieren und aktualisieren. Dies erreichen Sie, indem Sie die <a href="%s">Administrations-Seiten</a> aufrufen und "Bauen Sie alle Seiten wieder auf", anklicken, oder jetzt sofort  <a href="%s">hier klicken</a>.');

// DB
//////////

@define('WK_CONF_DB','Datenbank-Einstellungen');
@define('WK_CONF_DB_DESC','Hier k&ouml;nnen Sie die Datenbank-Einstellungen angeben, die Wikiwig ben&ouml;tigt');

@define('WK_CONF_DB_TYPE','Server Typ');
@define('WK_CONF_DB_TYPE_DESC','Datenbanksystem. In dieser Version wird nur MySQL unterst&uuml;tzt.');

@define('WK_CONF_DB_HOST','Server');
@define('WK_CONF_DB_HOST_DESC','Datenbankhost');

@define('WK_CONF_DB_USER','Datenbankbenutzer');
@define('WK_CONF_DB_USER_DESC','Benutzername');

@define('WK_CONF_DB_PASSWORD','Passwort');
@define('WK_CONF_DB_PASSWORD_DESC','Benutzerpasswort');

@define('WK_CONF_DB_NAME','Datenbankname');
@define('WK_CONF_DB_NAME_DESC','Name der Datenbank');

@define('WK_CONF_DB_PREFIX','Tabellen Pr&auml;fix');
@define('WK_CONF_DB_PREFIX_DESC','Pr&auml;fix der Tabellennamen, z.B. wk_');

// Paths
/////////

@define('WK_CONF_PATHS','Pfade');
@define('WK_CONF_PATHS_DESC', 'Diverse Pfade zu wichtigen Ordnern und Dateien.');

@define('WK_CONF_WK_PATH','Absoluter Pfad');
@define('WK_CONF_WK_PATH_DESC','Geben Sie den vollst&auml;ndigenPfad zu Wikiwig an, z.B.: /usr/local/wikiwig/');

@define('WK_CONF_WK_HTTPPATH','HTTP Pfad');
@define('WK_CONF_WK_HTTPPATH_DESC','Der URL von Wikiwig, wie er in der Adressleiste Ihres Browsers erscheint, z.B.: http://www.example.com/wikiwig/ .');

@define('WK_CONF_SYSTEM_DIR','Systemverezeichnis');
@define('WK_CONF_SYSTEM_DIR_DESC','Systemverzeichnis f&uuml; Wikiwig.');

@define('WK_CONF_EFM_IMAGES_DIR','Verzeichnis f&uuml;r hochgeladene Bilddateien');
@define('WK_CONF_EFM_IMAGES_DIR_DESC','Verzeichnis, in dem Bilddateien gespeichert werden. Xinha (der Wysiwyg Editor) ben&ouml;tigt eine korrekte Pfadangabe, damit die Benutzer den Filemangager f&uuml;r hochgeladene Grafikdateien verwenden k&ouml;nnen.');

@define('WK_CONF_EFM_FILES_DIR','Upload-Verzeichnis f&uuml;r Dateien, die aus Seiten des Wikis verlinkt werden');
@define('WK_CONF_EFM_FILES_DIR_DESC','Verzeichnis, in dem Upload-Dateien gespeichert werden. Xinha (der Wysiwyg Editor) ben&ouml;tigt eine korrekte Pfadangabe, damit die Benutzer den Filemangager f&uuml;r hochgeladene Dateien verwenden k&ouml;nnen. Sie k&ouml;nnen auch das Verzeichnis verwenden, in das Bilddateien hochgeladen werden.');

@define('WK_CONF_TRASH_DIR','M&uuml;lleimer-Verzeichnis');
@define('WK_CONF_TRASH_DIR_DESC','Verzeichnis in dem gel&ouml;schte Dateien landen. Dient als Backup, um sie ggf. wieder herstellen zu k&ouml;nnen.');

@define('WK_CONF_BACKUP_DIR','Backup Verzeichnis');
@define('WK_CONF_BACKUP_DIR_DESC','Verzeichnis in dem ge&auml;nderte Dateien landen. Dient als Backup, um sie ggf. wieder herstellen zu k&ouml;nnen.');

@define('WK_CONF_TPL_DIR','Vorlagen Verzeichnis');
@define('WK_CONF_TPL_DIR_DESC','Verzeichnis f&uuml;r Vorlagen zur Erzeugung neuer Dateien.');

@define('WK_CONF_HIDDEN_DIRS','Versteckte Verzeichnisse');
@define('WK_CONF_HIDDEN_DIRS_DESC','Liste von Verzeichnissen, die Wikiwig versteckt h&auml;lt (das hat nichts mit dem Wiki selbst zu tun). <br />Beispielsweise verlangen viele Hoster, da&szlig; es im Wurzelverzeichnis Ihres Wikis eine Verzeichnis namens "sessions" gibt, das nur von PHP genutzt wird. Um solche Verzeichnisse zu verstecken, f&uuml;gen Sie ihre Namen dieser Liste an.<br><strong>Verzeichnisnamen durch Semikolon trennen!</strong>');

@define('WK_CONF_SESSION_PATH','PHP Sitzungs-Pfad');
@define('WK_CONF_SESSION_PATH_DESC','Verzeichnis innerhalb der www-Hierarchie, wo PHP Informationen &uuml;ber die jeweilige Sitzung speichert. <strong>Wenn Sie nicht genau wissen, was Sie tun, sollten Sie dieses Textfeld unbedingt leer lassen!</strong>');

// General
///////////

@define('WK_CONF_GENERAL','Allgemeine Einstellungen');
@define('WK_CONF_GENERAL_DESC','Wiki anpassen');

@define('WK_CONF_WK_NAME','Name des Wikis');
@define('WK_CONF_WK_NAME_DESC','W&auml;hlen Sie einen Namen f&uuml;r Ihr Wiki.');

@define('WK_CONF_WK_DESCRIPTION','Wiki Kurzbeschreibung');
@define('WK_CONF_WK_DESCRIPTION_DESC','Wenn Sie m&ouml;chten, k&ouml;nnen Sie eine kurze Beschreibung Ihres Wikis eingeben.');

@define('WK_CONF_WK_LANGUAGE','Sprache');
@define('WK_CONF_WK_LANGUAGE_DESC','Die Sprache, die Wikiwig benutzt. <strong>Wenn Sie Wikiwig upgraden sollten Sie die Sprache nicht &auml;ndern!</strong>');

@define('WK_CONF_ADMIN_LOGIN','Admin Login');
@define('WK_CONF_ADMIN_LOGIN_DESC','Login f&uuml;R den Zugrif auf die Administrations-Seiten des Wikis.');

@define('WK_CONF_ADMIN_PASS','Admin Passwort');
@define('WK_CONF_ADMIN_PASS_DESC','Passwort des Adminstrators.');

@define('WK_CONF_ADMIN_MAIL','E-mail des Administrators');
@define('WK_CONF_ADMIN_MAIL_DESC','E-mail des Administrators zur &Uuml;berwachung der Seiten');

@define('WK_CONF_USER_COOKIE_TIME','Laufzeit f&uuml;r Benutzer-Cookies');
@define('WK_CONF_USER_COOKIE_TIME_DESC','Zeit in Sekunden, für die Beibehaltung der Cookies auf dem Comuter der Nutzer. Die Cookies dienen nur zur benutzerspezfischen Konfiguration. <strong>Zeit in Sekunden</strong>.');

@define('WK_CONF_NB_BACKUPS','Anzahl Backups');
@define('WK_CONF_NB_BACKUPS_DESC','Die maximale Anzahl von Backups, die Wikiwig vorh&auml;t, wenn eine Seite ge&auml;ndert wird. Wikiwig speichert die alte Version in einem seperaten Ordner.');

@define('WK_CONF_WK_CSS','CSS des Wiki');
@define('WK_CONF_WK_CSS_DESC','Stylesheet CSS f&uuml;r die Gestaltung der Wiki-Setiten. Kann eine relative Pfadangabe sine (z.B.: wk_style.css) oder ein http-URL (z.B.: http://www.example.com/css/style.css).');

// USER RIGHTS//////////////

@define('WK_CONF_USER_RIGHTS','Benutzer-Rechte');
@define('WK_CONF_USER_RIGHTS_DESC','Stellen Sie hier die Berechtigungen für Ihre Benutzer ein.');

@define('WK_CONF_RENAME_FOLDERS','Ordner umbenennen');
@define('WK_CONF_RENAME_FOLDERS_DESC','');

@define('WK_CONF_RENAME_FILES','Dateien umbenennen');
@define('WK_CONF_RENAME_FILES_DESC','');

@define('WK_CONF_MOVE_FOLDERS','Ordner verschieben');
@define('WK_CONF_MOVE_FOLDERS_DESC','');

@define('WK_CONF_MOVE_FILES','Dateien verschieben');
@define('WK_CONF_MOVE_FILES_DESC','');

@define('WK_CONF_DELETE_FOLDERS','Ordner l&ouml;schen');
@define('WK_CONF_DELETE_FOLDERS_DESC','');

@define('WK_CONF_DELETE_FILES','Dateien l&ouml;schen');
@define('WK_CONF_DELETE_FILES_DESC','');

// Edition
///////////

@define('WK_CONF_EDITION','Konfiguration des Wysiwyg-Editors');
@define('WK_CONF_EDITION_DESC','Konfiguration der Optionen zum Editieren von Seiten.'); 

@define('WK_CONF_EDITION_MAX_TIME','Maximale Zeit');
@define('WK_CONF_EDITION_MAX_TIME_DESC','Maximale Zeit, die Benutzer zur Bearbeitung der Seite zur Verf&uuml;gung haben. Verhindert, da&szlig; ein Benutzer die Seite zu lange blockiert.');

@define('WK_CONF_EDITION_WARNING_TIME','Vorwarnzeit');
@define('WK_CONF_EDITION_WARNING_TIME_DESC','Restzeit vor Ablauf der maximalen Zeit, wenn der Benutzer darauf hingewiesen wird, da&szlig; er seine &Auml;derungen speichern sollte.');

// Xinha EFM

@define('WK_CONF_XINHA_EFM','Erweiterter Dateimanager');
@define('WK_CONF_XINHA_EFM_DESC','Konfiguration des Erweiterten Dateiemanagers f&uuml;r den Wysiwyg Editor (Xinha). &lt;br&gt;Der Erweiterte Dateiemanager erm&ouml;glicht das Hochladen von Dateien um sie mit Wikiseiten zu verlinken oder in Seiten einzubetten (typischerweise Bilddateien).');

@define('WK_CONF_EFM_CLASS','Library');
@define('WK_CONF_EFM_CLASS_DESC','Library f&uuml;r die Bildbearbeitung. (GD oder ImageMagick (IM) oder NetPBM. Wenn Sie <i>safe mode ON</i> verwenden, oder keine anderen Bibliotheken installiert haben, ist nur GD verf&uuml;gbar. Andere Packages verlangen, da&szlig; <i>safe mode</i> abgeschaltet ist.');

@define('WK_CONF_EFM_LIB_PATH','Library-Pfad');
@define('WK_CONF_EFM_LIB_PATH_DESC','Absoluter Pfad zur Library. z.B.: C:/Program Files/ImageMagick/. Wenn Sie definiert haben, welche Library benutzt werden soll, und es ist NetPBM oder IM, m&uuml;ssen Sie angeben, wo die Binaries der gew&auml;hlten Library zu finden sind. Ausserdem m&uuml;ssen der Webserver und PHP die Berechtigung haben, diese auszuf&uuml;hren (d.h. safe mode ist OFF). GD ben&ouml;tigt diese Definition nicht.');

@define('WK_CONF_EFM_ALLOW_NEW_DIR','Unterverzeichnisse anlegen');
@define('WK_CONF_EFM_ALLOW_NEW_DIR_DESC','Erlaubt Benutzern, neue Unterverzeichnisse anzulegen.');

@define('WK_CONF_EFM_ALLOW_EDIT_IMAGE','Bilddateien editieren');
@define('WK_CONF_EFM_ALLOW_EDIT_IMAGE_DESC','Erlaubt Benutzern, Dateien im Bilder-Verzeichnis zu editieren.');

@define('WK_CONF_EFM_MAX_IMAGE_SIZE', 'Max. Bilder-Dateigr&ouml;&szlig;e');
@define('WK_CONF_EFM_MAX_IMAGE_SIZE_DESC', 'Max. Gr&ouml;&szlig;e f&uuml;r Bilddateien in Kilobyte');

@define('WK_CONF_EFM_MAX_LINK_SIZE', 'Max Dokument-Dateigr&ouml;&szlig;e');
@define('WK_CONF_EFM_MAX_LINK_SIZE_DESC', 'Maximal erlaubte Dateigr&ouml;&szlig;e in Kilobytes f&uuml;r hochgeladene Dokumente');

@define('WK_CONF_EFM_MAX_FOLDER_SIZE', 'Max. Gr&ouml;&szlig;e des Upload Verzeichnis');
@define('WK_CONF_EFM_MAX_FOLDER_SIZE_DESC', 'Max. Gr&ouml;&szlig;e des Upload Verzeichnis in Megabyte. 0 f&uuml;r unbeschr&auml;nkt.');

@define('WK_CONF_EFM_IMAGE_EXT', 'Extensionen f&uuml;r Bilddateien');
@define('WK_CONF_EFM_IMAGE_EXT_DESC', 'Erlaubte Dateinamenerweiterungen f&uuml;r hochgeladene Bilddateien. Extensionen durch Semicolon getrennt angeben');

@define('WK_CONF_EFM_LINK_EXT', 'Dateinamenerweiterungen f&uuml;r Dokumente');
@define('WK_CONF_EFM_LINK_EXT_DESC', 'Erlaubte Dateinamenerweiterungen f&uuml;r hochgeladene Dokumente. Extensionen durch Semicolon getrennt angeben');

@define('WK_CONF_EFM_ALLOW_UPLOAD','Datei-Upload');
@define('WK_CONF_EFM_ALLOW_UPLOAD_DESC','Erlaubt Benutzern, Dateien auf den Server zu laden.');

@define('WK_CONF_EFM_LINK_ENABLE_TARGET','Link Targets');
@define('WK_CONF_EFM_LINK_ENABLE_TARGET_DESC','Erlaubt den Benutzern target-Attribute f&uuml;r Hyperlinks anzugeben (dies bezeichnet Fenster und Frames in denen ein link ge&ouml;ffnet werden soll).');

@define('WK_CONF_EFM_IMAGES_ENABLE_ALT','Image Attribut - Alternativer Text');
@define('WK_CONF_EFM_IMAGES_ENABLE_ALT_DESC','Erlaubt den Benutzern, alternativen Text zu Bildern einzugeben, der angezeigt wird, falls ein Browser das Bild nicht darstellen kann.');

@define('WK_CONF_EFM_IMAGES_ENABLE_TITLE','Image Attribut - Bilder Titel ');
@define('WK_CONF_EFM_IMAGES_ENABLE_TITLE_DESC','Erlaubt den Benutzern Titeltexte f&uuml;r Bilder zu setzen (wird angezeigt, wenn der Mauszeiger &uuml;ber das Bild kommt).');

@define('WK_CONF_EFM_IMAGES_ENABLE_ALIGN','Image Attribut - Alignment (Ausrichtung)');
@define('WK_CONF_EFM_IMAGES_ENABLE_ALIGN_DESC','Erlaubt den Benutzern, die Ausrichtung von Bildern (z.B. links, zentriert, rechts) zu bearbeiten.');

@define('WK_CONF_EFM_IMAGES_ENABLE_STYLE','Image Attribut - Styling');
@define('WK_CONF_EFM_IMAGES_ENABLE_STYLE_DESC','Erlaubt den Benutzern Rand (margin), Innenabstand (padding), und Rahmenstile (border styles) f&uuml;r Bilder zu setzen.');

@define('WK_CONF_EFM_THB_DIR','Erlaube Benutzern Ornder f&uuml;r Thumbnails anzulegen.');
@define('WK_CONF_EFM_THB_DIR_DESC','Thumbnails k&ouml;nnen auch in eigenen Verzeichnissen gespeichert werden, das von PHP erzeugt wird. Wenn PHP im safe-mode l&auml;ft wird diese Einstellung ignioriert, ein Thumbnail-Verzeichnis wird verwendet.  Wenn Sie dies nicht m&ouml;chten, tragen Sie hier bitte "false" ein oder lassen das Feld leer.'	);

@define('WK_CONF_EFM_THB_PREFIX','Thumbnails Pr&auml;fix');
@define('WK_CONF_EFM_THB_PREFIX_DESC','Pr&auml;fix für Thumbnail-Dateien. Etwas in der Art wie .thumb ist sinnvoll. Die Thumbnail-Dateien werden dann als "prefix_imagefile.ext" gespeichert, also , pr&auml;fix + urspr&uuml;nglicher Dateiname.');

@define('WK_CONF_EFM_RESIZED_DIR','Verzeichnis f&uuml;r Resized Images');
@define('WK_CONF_EFM_RESIZED_DIR_DESC','Bilder mit ver&auml;nderten Abmessungen k&ouml;nnen in einem Verzeichnis gespeichert werden, das von PHP bei Bedarf angelegt wirdc. Wenn PHP im safe mode l&auml;uft, wird dieser Parameter ignoriert, es wird kein Verzeichnis angelegt. Wenn Sie resized images nicht in einem Verzeichnis speichern m&ouml;chten, bitte false angeben oder das Feld leer lassen.');

@define('WK_CONF_EFM_RESIZED_PREFIX','Pr&auml;fix f&uuml;r Resized Images ');
@define('WK_CONF_EFM_RESIZED_PREFIX_DESC','Das Pr&auml;fix f&uuml;r resized Image-Dateien, z.B. &quot;resized&quot;. Die Dateien werden dann als  &quot;pr&auml;fix_bilddatei.ext&quot; gespeichert, also Pr&auml;fix + urspr&uuml;nglicher Dateiname.');

@define('WK_CONF_EFM_DEFAULT_THB','Default Thumbnail');
@define('WK_CONF_EFM_DEFAULT_THB_DESC','Standard-Thumbnail falls kein Thumbnails erzeugt werden kann (z.B. bei fehlerhaftem Bild oder Verarbeitungspanne.');

@define('WK_CONF_EFM_DEFAULT_LIST','Vorgabe f&uuml;r Listen-Icon');
@define('WK_CONF_EFM_DEFAULT_LIST_DESC','Icon, das bei der Anzeige hochgeladener Dateien in Listenansicht verwendet wird.');

@define('WK_CONF_EFM_THB_EXT', 'Vorschaubilder Extensionen');
@define('WK_CONF_EFM_THB_EXT_DESC', 'Erlaubte Dateinamenerweiterungen f&uuml;r Vorschaubilder (Thumbnails). Normalerweise sollte diese Angabe identisch mit den erlaubten Dateinanemnerweiterungen f&uuml;r Bilder sein. Extensionen durch Semicolon getrennt angeben.');

@define('WK_CONF_EFM_THB_WIDTH','Thumbnail Breite');
@define('WK_CONF_EFM_THB_WIDTH_DESC','<strong>In Pixeln</strong>');

@define('WK_CONF_EFM_THB_HEIGHT','Thumbnail H&ouml;he');
@define('WK_CONF_EFM_THB_HEIGHT_DESC','<strong>In Pixeln</strong>');

@define('WK_CONF_EFM_TMP_PREFIX','Tempor&auml;res Pr&auml;fix');
@define('WK_CONF_EFM_TMP_PREFIX_DESC',' Temporäres Pr&auml;fix f&uuml;r den Image Editor.');

// Errors
/////////////
@define('WK_CONF_ERRORS_CONF','Warnung, es gibt Fehler in Ihrer Konfiguration :');
@define('WK_CONF_ERRORS_INSTALL','Warnung, bei der Installation ist ein Problem aufgetreten: ');

// mail
@define('WK_CONF_ERR_MAIL','Bitte geben Sie Ihre E-Mail Addresse an, um ausgew&auml;hlte Seiten beobachten zu k&ouml;nnen.');
@define('WK_PROFILE_ERROR_SUCCESS_PART1','Ihr Zugang wurde angelegt. Sie erhalten eine E-Mail mit einer Anleitung ');
@define('WK_PROFILE_ERROR_SUCCESS_PART2','zur Best&auml;tigung Ihrer Anmeldung.');
@define('WK_PROFILE_ERROR_MAILNOTSENT','Diese Mail konnte nicht verschickt werden. Der Inhalt war: :');
@define('WK_PROFILE_CONNECTED_AS','Sie sind angemeldet als:');
@define('WK_PROFILE_CONNECTED_INFO_PART1','Sie k&ouml;nnen jetzt die erweiterten Funktionen von Wikiwig nutzen: ');
@define('WK_PROFILE_CONNECTED_INFO_PART2','Um &Auml;nderungen an einer Seite zu verhindern, klicken Sie bitte auf dieses Icon');
@define('WK_PROFILE_CONNECTED_INFO_PART3','Um Nutzer, die diese Seite beobachten, &uuml;ber Ihre &Auml;nderungen zu benachrichtigen, klicken Sie bitte hier');
@define('WK_LOGIN_ADMIN_BIS','Der Name des Administrators ist bereits gespeichert. &Auml;ndern?');

//validation mail

@define('WK_PROFILE_MAIL_TITLE','Wikiwig : Best&auml;tigung Ihrer Anmeldung');
@define('WK_PROFILE_MAIL_BODY_PART0','Hallo !');
@define('WK_PROFILE_MAIL_BODY_PART1','Bitte best&auml;tigen Sie Ihre Anmeldung bei Wikiwig');
@define('WK_PROFILE_MAIL_BODY_PART2',' indem SIe auf den folgenden Link klicken oder ihn in die Adresszeile Ihres Browsers &uuml;bertragen: ');
@define('WK_CONF_ERR_WRITE_CONF_FILE','Die Konfigurationsdatei %s konnte nicht gespeichert werden. Bitte pr&uuml;fen Sie die Schreibberechtigung f&uuml; diese Datei! <a href="../../readme.installation.error.de.html" target="_blank">Brauchen Sie Hilfe?</a>.');

// Dirs

@define('WK_CONF_ERR_DB_BAD_TBL_PREFIX','Das angegebene Pr&auml;fix für Tabellennamen ist unzul&aul;ssig. Vermeiden Sie Sonder- und Satzzeichen ausser _ .');
@define('WK_CONF_ERR_DIR_CREATE','Konnte Verzeichnis "%s" nicht anlegen! Schreibrechte im wikiwig-Verzeichnis pr&uuml;fen! <a href="../../readme.installation.error.de.html" target="_blank">Brauchen Sie Hilfe?</a>.');
@define('WK_CONF_ERR_DIR_NO_WRITE','Konnte im Verzeichnis "%s" nicht schreiben! Bitte Rechte im Verzeichnis pr&uuml;fen! <a href="../../readme.installation.error.de.html" target="_blank">Brauchen Sie Hilfe?</a>.');

// DB

@define('WK_CONF_ERR_DB_INSTALL','Achtung: Fehler bei der Installation der Datenbank. Bitte Datenbank pr&uuml;en. Sind die neuen Tabellen erzeugt worden? Wenn nicht, versuchen Sie diese Seite noch einmal zu &ouml;ffnen, oder pr&uuml;fen Sie das Pr&auml;fix der Tabellen.');
@define('WK_CONF_ERR_DB_LIB_NOT_FOUND',' PHP Library f&uuml;r Wikiwig konnte nicht gefunden werden. Stellen Sie sicher, da&szlig; Wikiwig vollständig installiert ist.');
@define('DB_ERR_EXTENSION_UNAVAILABLE','Erweiterung %s ist nicht verf&uuml;gbar. Bitte die Konfiguration von PHP nachpr&uuml;fen!');
@define('DB_ERR_CONNECT_SERVER',' Kein Verbindung zu Server "%s"! &Uuml,berpr&uuml;fen Sie bitte den Namen des Datenbank-Servers, den Login und das Passwort.');
@define('DB_ERR_CONNECT_DATABASE','Konnte nicht mit Datenbank "%s" verbinden.');
@define('DB_ERR_QUERY_FAILED','Die folgende SQL Abfrage ist gescheitert: %s');

// GRAPHIC LIB

@define('WK_CONF_ERR_GRAPH_LIB_NOT_FOUND','Der Pfad zur Grafik-Library %s "%s" konnte nicht gefunden werden. Stellen Sie bitte sicher, da&szlig; Sie den Pfad korrekt angeben oder verwenden Sie eine andere Library. Sie k&ouml;nnten z.B. die voreingestellte GD-Library verwenden.');


// NEW
// USER RIGHTS
//////////////

@define('WK_CONF_HTTPS','HTTP/HTTPS');
@define('WK_CONF_HTTPS_DESC','Verwenden Sie HTTP oder HTTPS f&Atilde;&frac14;r LOGON-Seiten');
@define('WK_CONF_USE_HTTPS','HTTPS');
@define('WK_CONF_USE_HTTP','HTTP');

@define('WK_CONF_CAPTCHA','Captcha');
@define('WK_CONF_CAPTCHA_DESC','Verwenden Sie ein captcha, um Roboter von der Schaffung von LOGON zu entmutigen.<br> die phpCaptcha ein einfaches captcha ist, das kein Extraconfiguration.<br>reCaptcha erfordert ein Konto bei http://recaptcha.net und Sekund&Atilde;&curren;rkonfiguration durch den admin, die &Atilde;&#150;ffentlichkeit und die privaten Schl&Atilde;&frac14;ssel anzubringen erfordert');
@define('WK_CONF_NO_CAPTCHA','Kein Captcha');

@define('WK_CONF_EDIT_FILES','Redigieren Sie Akten');
@define('WK_CONF_EDIT_FILES_DESC','');

@define('WK_CONF_RESTORE_FILES','Wiederherstellungs-Akten');
@define('WK_CONF_RESTORE_FILES_DESC','');

@define('WK_CONF_RESTORE_FOLDERS','Wiederherstellungs-Faltbl&Atilde;&curren;tter');
@define('WK_CONF_RESTORE_FOLDERS_DESC','');

@define('WK_CONF_CREATE_FILES','Stellen Sie Akten her');
@define('WK_CONF_CREATE_FILES_DESC','');

@define('WK_CONF_CREATE_FOLDERS','Stellen Sie Faltbl&Atilde;&curren;tter her');
@define('WK_CONF_CREATE_FOLDERS_DESC','');

// GUEST RIGHTS

@define('WK_CONF_GUEST_RIGHTS','Gast-Rechte');
@define('WK_CONF_GUEST_RIGHTS_DESC','Handhaben Sie die Rechte, die Sie geben m&Atilde;&para;chten den anonymen Benutzern.');

// 
@define('WK_CONF_APPROVAL', 'Neue Benutzer-Zustimmung');
@define('WK_CONF_APPROVAL_DESC', 'Wie man Benutzer ist annehmbar &Atilde;&frac14;berpr&Atilde;&frac14;ft: ' .
                               '<br> &Atilde;&#156;ber eMail-Antwort. (<b>Erfordert</b> wiki Zugang zum Mail-Server.)' .
			       '<br> &Atilde;&#156;ber admin-Antwort.'  .
			       '<br> Keine Pr&Atilde;&frac14;fung, jeder ist anerkannt.');
@define('WK_CONF_APPROVE_BY_EMAIL', 'Email');
@define('WK_CONF_APPROVE_BY_ADMIN', 'Admin');
@define('WK_CONF_APPROVE_ALL', 'Keine');

@define('WK_CONF_EMAIL_SERVER', 'Mail-Server-Einstellung');
@define('WK_CONF_EMAIL_SERVER_DESC', '&Atilde;&frac14;r das Senden zu verwenden Anschluss, von eMail. EMail kann w&Atilde;&curren;hrend der Subskriptionsbest&Atilde;&curren;tigung und f&Atilde;&frac14;r Warnungen auf Seitenmodifikationen gesendet werden. <br>Smtp ist der einzige vorhandene Klient. <br>Keines sperrt Gebrauch der eMail und wird die Warnungs-/&Atilde;&#156;berwachungeigenschaften sperren');
@define('WK_CONF_EMAIL_SMTP', 'SMTP');

@define('WK_CONF_NONE', 'Keine');
@define('WK_CONF_REVISION', 'Neuausgaben-Steuerung (RCS/CVS/Internal nicht schon eingef&Atilde;&frac14;hrt)');
@define('WK_CONF_REVISION_DESC', 'Wie wikiwig tut, behalten Sie alte Versionen von wiki pages.<br>RCS bei: rcs-Werkzeuge m&Atilde;&frac14;ssen present.<br>CVS sein: cvs Werkzeuge m&Atilde;&frac14;ssen angebracht werden. <br>Intern: verwenden Sie wikiwig Code, um Neuausgaben zu handhaben. <br>Kein: benutzen Sie wikiwig Unterst&Atilde;&frac14;tzung directory');
@define('WK_CONF_RCS_INT', 'Intern');

@define('WK_CONF_ERR_NO_EMAIL', 'Eine Einstellung ohne Mail-Server ist mit anerkennend Benutzern durch eMail-Best&Atilde;&curren;tigung inkompatibel');



?>