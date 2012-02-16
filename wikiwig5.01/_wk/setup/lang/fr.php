<?php

/*

 * Created on 30 nov. 2004

 */



//////////////////////////////

// ADMIN CONFIGURATION     //

////////////////////////////

// General
//////////////

@define('WK_CONF_TITLE','Configuration de Wikiwig');
@define('WK_CONF_TITLE_UPDATE','Mise &agrave; jour de votre Wiki');
@define('WK_CONF_TITLE_INSTALL','Installation de votre Wiki');
@define('WK_CONF_LABEL_GO_WIKI','aller sur le wiki');
@define('WK_CONF_LABEL_LINK_ADMIN','admin');
@define('YES','OUI');
@define('NO','NON');
@define('TOGGLE_ALL','Ouvrir / Fermer Tout');
@define('TOGGLE_OPTION','Cliquez ici pour ourvir/fermer');
@define('CHECK_N_SAVE','V&eacute;rifier &amp; Sauver');

@define('HOMEPAGE_CONTENT','<p>Bienvenue sur votre nouveau Wiki! <br>
                Vous pouvez personnaliser cette page en cliquant sur "modifier cette page".<br>
                Vous pouvez acc&eacute;der au plan du wiki pour ajouter des pages, en supprimer, voir la liste des pages et des r&eacute;pertoires existants, en cr&eacute;er de nouveaux.
            </p>');
@define('MAP','plan');

// Messages about the process

/////////////////////////////

@define('WK_CONF_SAVED_SUCCESSFUL','F&eacute;licitations !!!<br>Wikiwig est &agrave; pr&eacute;sent configur&eacute; et pr&ecirc;t &agrave; &ecirc;tre utilis&eacute;. Pour d&eacute;marrer, vous pouvez aller sur <a href="%s">la page d\'accueil</a>.<br><br>Nous vous rappelons que vos identifiants pour acc&eacute;der &agrave; la section administration sont (sans les guillemets): <br>Login: "%s"<br>Password:"%s"');
@define('WK_CONF_DB_ALREADY_INSTALLED','La base de donn&eacute;es %s est d&eacute;j&agrave; install&eacute;e.');
@define('WK_CONF_DB_INSTALLED','La base de donn&eacute;es %s a &eacute;t&eacute; install&eacute;e.');
@define('WK_CONF_UPDATED','Votre configuration a bien &eacute;t&eacute; sauvegard&eacute;e.');
@define('WK_CONF_UPGRADE_MSG','Lors d\'une mise &agrave; jour de votre configuration, il vous est fortement conseill&eacute; de lancer le reconstruction("v&eacute;rification et modification") des pages de votre wiki. Vous pouvez le faire soit en allant sur la <a href="%s">page d\'administration</a> et en cliquant sur "Reconstruisez toutes les pages", soit directement en <a href="%s">cliquant ici</a>.');

// DB

//////////

@define('WK_CONF_DB','Configuration de la base de donn&eacute;es');
@define('WK_CONF_DB_DESC','Ici vous pouvez entrer les param&egrave;tres de base votre de donn&eacute;es. Wikiwig en a besoin pour pouvoir fonctionner.');

@define('WK_CONF_DB_TYPE','Type de Serveur');
@define('WK_CONF_DB_TYPE_DESC','Le type de la base de donn&eacute;es. Dans cette version, seul le serveur MySQL est disponible.');

@define('WK_CONF_DB_HOST','Serveur');
@define('WK_CONF_DB_HOST_DESC','L\'h&ocirc;te de la base de donn&eacute;es');

@define('WK_CONF_DB_USER','Utilisateur');
@define('WK_CONF_DB_USER_DESC','Login de l\'utilisateur');

@define('WK_CONF_DB_PASSWORD','Password');
@define('WK_CONF_DB_PASSWORD_DESC','Password de l\'utilisateur');

@define('WK_CONF_DB_NAME','Base');
@define('WK_CONF_DB_NAME_DESC','Nom de la Base');

@define('WK_CONF_DB_PREFIX','Pr&eacute;fixe des tables');
@define('WK_CONF_DB_PREFIX_DESC','Pr&eacute;fixe pour les noms des tables, i.e. wk_');

// Paths
/////////

@define('WK_CONF_PATHS','Configuration des Paths');
@define('WK_CONF_PATHS_DESC','Diff&eacute;rents chemins vers des dossiers ou fichiers essentiels.');

@define('WK_CONF_WK_PATH','Chemin asbolu');
@define('WK_CONF_WK_PATH_DESC','Le chemin de wikiwig dans le syst&egrave;me de fichiers de votre serveur. i.e.: /usr/local/wikiwig/');

@define('WK_CONF_WK_HTTPPATH','Chemin HTTP');
@define('WK_CONF_WK_HTTPPATH_DESC','L\'url de votre wiki telle que visible dans votre browser, i.e.: http://www.example.com/wikiwig/.');

@define('WK_CONF_SYSTEM_DIR','R&eacute;pertoire Syst&egrave;me');
@define('WK_CONF_SYSTEM_DIR_DESC','R&eacute;pertoire syst&egrave;me de wikiwig.');

@define('WK_CONF_EFM_IMAGES_DIR','Telecharger l\'annaire pour les dossiers d\'images');
@define('WK_CONF_EFM_IMAGES_DIR_DESC','Annuaire ou attacher les dossiers d\'images. Xinha (the wysiwyg page editor) as besoin que se passage soit correcte pour que l\'utillisateur puisse utiliser le gestionaire des dossiers afin d\' organiser les dossiers d\'images.');

@define('WK_CONF_EFM_FILES_DIR','Telecharger l\'annuaire pour les dossiers que vous souhaites lier sur les page du wiki');
@define('WK_CONF_EFM_FILES_DIR_DESC','Annuaire ou attacher les dossiers d\'image. Xinha(the wysiwyg page editor) as besoin que se passage soit correcte pour que l\'utilisateur puisse utiliser le gestionaire des dossiers afin d\' organiser les dossiers que vous desirer lier. Souvent l\'annuaire identique ou les dossiers d\'images sont telecharger.');

@define('WK_CONF_TRASH_DIR','R&eacute;pertoire Corbeille');
@define('WK_CONF_TRASH_DIR_DESC','R&eacute;pertoire o&ugrave; sont stock&eacute;es les pages du wiki apr&egrave;s avoir &eacute;t&eacute; effac&eacute;es par un utilisateur. Ce r&eacute;pertoire vous permet de r&eacute;cup&eacute;rer des fichiers supprim&eacute;s.');

@define('WK_CONF_BACKUP_DIR','R&eacute;pertoire de Backup');
@define('WK_CONF_BACKUP_DIR_DESC','R&eacute;pertoire o&ugrave; sont gard&eacute;s les anciennes versions des pages. Apr&egrave;s chaque sauvegarde par un utilisateur, l\'ancienne version de la page est stock&eacute;e dans ce r&eacute;pertoire.');

@define('WK_CONF_TPL_DIR','R&eacute;pertoire des templates');
@define('WK_CONF_TPL_DIR_DESC','R&eacute;pertoire des templates utilisables pour cr&eacute;er de nouvelles pages');

@define('WK_CONF_HIDDEN_DIRS','R&eacute;pertoire Cach&eacute;s');
@define('WK_CONF_HIDDEN_DIRS_DESC','Liste des r&eacute;pertoires que Wikiwig ne doit pas lister (ne concernent pas Wikiwig). <br>Exemple: chez votre h&eacute;bergeur, vous avez &agrave; la racine de votre Wiki le r&eacute;pertoire nomm&eacute; "sessions", qui n&rsquo;est utilis&eacute; que par PHP. Pour le cacher, rajoutez-le dans cette liste.<br><strong>Les noms des r&eacute;pertoires doivent &ecirc;tre s&eacute;par&eacute;s par des points-virgules ;</strong>');

@define('WK_CONF_SESSION_PATH','R&eacute;pertoire des sessions PHP');
@define('WK_CONF_SESSION_PATH_DESC','R&eacute;pertoire de votre syst&egrave;me o&uacute; PHP stocke ses fichiers de sessions. <strong>Laissez ce champ vide, si vous n&rsquo;&ecirc;tes pas s&ucirc;rs de ce que vous fa&icirc;tes.</strong>');

// General
///////////

@define('WK_CONF_GENERAL','Configuration g&eacute;n&eacute;rale');
@define('WK_CONF_GENERAL_DESC','Diverses options pour d&eacute;finir comment Wikiwig fonctionne');

@define('WK_CONF_WK_NAME','Nom du Wiki');
@define('WK_CONF_WK_NAME_DESC','Choisissez le nom de votre Wiki.');

@define('WK_CONF_WK_DESCRIPTION','Description du Wiki');
@define('WK_CONF_WK_DESCRIPTION_DESC','Entrez une courte description de votre wiki. Non obligatoire.');

@define('WK_CONF_WK_LANGUAGE','Langue');
@define('WK_CONF_WK_LANGUAGE_DESC','Langue d\'utilisation de wikiwig. <strong>Si vous faites une mise &agrave; jour de wikiwg, il est d&eacute;conseill&eacute; de changer la langue utilis&eacute;e.</strong>');

@define('WK_CONF_ADMIN_LOGIN','Login Admin');
@define('WK_CONF_ADMIN_LOGIN_DESC','Login utilis&eacute; pour acc&eacute;der &agrave; l\'interface d\'administration de wikiwig.');

@define('WK_CONF_ADMIN_PASS','Password Admin');
@define('WK_CONF_ADMIN_PASS_DESC','Password de l\'administrateur');

@define('WK_CONF_ADMIN_MAIL','E-mail de Admin');
@define('WK_CONF_ADMIN_MAIL_DESC','E-mail de l\'administrateur pour surveiller les pages');

@define('WK_CONF_USER_COOKIE_TIME','Cookie Utilisateur');
@define('WK_CONF_USER_COOKIE_TIME_DESC','Temps de vie des cookies pos&eacute;s chez les utilisateurs. Ces cookies permettent de r&eacute;cup&eacute;rer les informations de profil des utilisateurs. <strong>En secondes</strong>.');

@define('WK_CONF_NB_BACKUPS','Nombre de Backups');
@define('WK_CONF_NB_BACKUPS_DESC','Nombre de sauvegardes maximales utilis&eacute;es par Wikiwig. Lorsqu\'une page est modif&eacute;e puis sauvegard&eacute;e. Wikiwig conserve l\'ancienne version de la page. R&eacute;glez ce param&egrave;tre pour indiquer &agrave; Wikiwig combien de versions sauvegarder.');

@define('WK_CONF_WK_CSS','CSS du Wiki');
@define('WK_CONF_WK_CSS_DESC','Feuille de style CSS utilis&eacute;e pour les pages du wiki.');

// USER RIGHTS
//////////////

@define('WK_CONF_USER_RIGHTS','Droits des utilisateurs');
@define('WK_CONF_USER_RIGHTS_DESC','G&eacute;rer les possibilit&eacute;s que vous pouvez donner &agrave; vos utilisateurs.');

@define('WK_CONF_RENAME_FOLDERS','Renommer les dossiers');
@define('WK_CONF_RENAME_FOLDERS_DESC','');

@define('WK_CONF_RENAME_FILES','Renommer les fichiers');
@define('WK_CONF_RENAME_FILES_DESC','');

@define('WK_CONF_MOVE_FOLDERS','D&eacute;placer les dossiers');
@define('WK_CONF_MOVE_FOLDERS_DESC','');

@define('WK_CONF_MOVE_FILES','D&eacute;placer les fichiers');
@define('WK_CONF_MOVE_FILES_DESC','');

@define('WK_CONF_DELETE_FOLDERS','Supprimer les dossiers');
@define('WK_CONF_DELETE_FOLDERS_DESC','');

@define('WK_CONF_DELETE_FILES','Supprimer les fichiers');
@define('WK_CONF_DELETE_FILES_DESC','');

// Edition
///////////

@define('WK_CONF_EDITION','Configuration de l\'&eacute;diteur Wysiwyg');
@define('WK_CONF_EDITION_DESC','Configurer l\'&eacute;dition des pages.'); 

@define('WK_CONF_EDITION_MAX_TIME','Temps maximum');
@define('WK_CONF_EDITION_MAX_TIME_DESC','Temps maximum pendant lequel un utilisateur peut bloquer une page pour son &eacute;dition personnelle.');

@define('WK_CONF_EDITION_WARNING_TIME','Temps d\'avertissement');
@define('WK_CONF_EDITION_WARNING_TIME_DESC','Temps &agrave; partir duquel Wikiwig doit avertir l\'utilisateur du temps qu\'il lui reste pour &eacute;diter la page.');



// Xinha EFM

//////////////

@define('WK_CONF_XINHA_EFM', 'L\'extension du gestionaire');
@define('WK_CONF_XINHA_EFM_DESC', 'Configuration du gestionaire prolonge utilise par wysiwyg editor. Xinha, the gestionaire prolonge permet de telecharger des dossiers lier aux pages de wiki ou inserer le dossier( typiquement un dossier image) aux pages de wiki.');

@define('WK_CONF_EFM_CLASS','Librairie');
@define('WK_CONF_EFM_CLASS_DESC','Librairie utilis&eacute;e pour manipuler des fichiers images. La librairie graphique peut &ecirc;tre soit GD soit ImageMagick soit NetPBM. Si votre serveur PHP est en safe_mode, ou que vous n\'avez pas install&eacute; les autres librairies, vous devez choisir GD. Les autres librairies n&eacute;cessitent que votre serveur ne soit pas en safe_mode.');

@define('WK_CONF_EFM_LIB_PATH','Chemin de la librairie');
@define('WK_CONF_EFM_LIB_PATH_DESC','Chemin absolu de votre librairie. i.e.: C:/Program Files/ImageMagick/  . Apr&egrave;s avoir d&eacute;fini la libaririe &agrave; utiliser, s\'il s\'agit de ImageMagick ou de NetPBM, vous devez indiquer ou se trouve le programme correspondant. GD n\'a pas besoin que cete option soit configur&eacute;e.');

@define('WK_CONF_EFM_ALLOW_NEW_DIR','Cr&eacute;ation de r&eacute;pertoire');
@define('WK_CONF_EFM_ALLOW_NEW_DIR_DESC','Autoriser la cr&eacute;ation de sous-r&eacute;pertoires par les utilisateurs.');

@define('WK_CONF_EFM_ALLOW_EDIT_IMAGE','Editer les dossiers d\'images');
@define('WK_CONF_EFM_ALLOW_EDIT_IMAGE_DESC','Permer a l\'utilisateur d\'editer les dossiers dans l\'annuaire des images.');

@define('WK_CONF_EFM_MAX_IMAGE_SIZE', 'Dimention d\'image');
@define('WK_CONF_EFM_MAX_IMAGE_SIZE_DESC', 'Dimention maximum( en kilobytes) permise pour un dossier d\'image individuel.');

@define('WK_CONF_EFM_MAX_LINK_SIZE', 'Dimention d\'un dossier de document');
@define('WK_CONF_EFM_MAX_LINK_SIZE_DESC', 'Dimention maximum(en kilobytes) pour telecharger un dossier de document .');

@define('WK_CONF_EFM_MAX_FOLDER_SIZE', 'Telecharger les dimention des fichiers');
@define('WK_CONF_EFM_MAX_FOLDER_SIZE_DESC', 'Dimention maximum des fichiers telecharger en megabytes. Utilises 0 pour etablir une dimention unlimitee.');

@define('WK_CONF_EFM_IMAGE_EXT', 'Extension dossier d\'image');
@define('WK_CONF_EFM_IMAGE_EXT_DESC', 'Permet l\'extension pour les dossiers telecharger. Les extensions sont separees par un point-virgule');

@define('WK_CONF_EFM_LINK_EXT', 'Extention des dossier de document');
@define('WK_CONF_EFM_LINK_EXT_DESC', 'Permet l\'extension  des dossiers de document telecharger. Les extensionst sont separees par un point-virgule.');

@define('WK_CONF_EFM_ALLOW_UPLOAD','Envoi de fichier');
@define('WK_CONF_EFM_ALLOW_UPLOAD_DESC','Autoriser l\'envoi de fichiers par les utilisateurs.');

@define('WK_CONF_EFM_LINK_ENABLE_TARGET', 'Liens-cibles');
@define('WK_CONF_EFM_LINK_ENABLE_TARGET_DESC', 'Permet a l\'utilisateur d\'etablir les atributs des cibles pour les liens');

@define('WK_CONF_EFM_IMAGES_ENABLE_ALT','Attribut d\'image-texte alternatif');
@define('WK_CONF_EFM_IMAGES_ENABLE_ALT_DESC', 'Permet a l\'utilisateur d\'etablir un texte alternatif pour les attributs d\'une image. (vue quand le navigateur ne peus montrer l\'image)');

@define('WK_CONF_EFM_IMAGES_ENABLE_TITLE','Attribut d\'image- titre d\'image');
@define('WK_CONF_EFM_IMAGES_ENABLE_TITLE_DESC','Permet a l\'utilisateur d\'etablir un attribut de titre de texte pour une image. (normalement montrer quand la souris est sur l\'image.)');

@define('WK_CONF_EFM_IMAGES_ENABLE_ALIGN','Image Attribute - Alignment');
@define('WK_CONF_EFM_IMAGES_ENABLE_ALIGN_DESC','Allow the user to set alignment attribute (e.g. left, center, right) for an image.');

@define('WK_CONF_EFM_IMAGES_ENABLE_STYLE','Attributs d\'image-style');
@define('WK_CONF_EFM_IMAGES_ENABLE_STYLE_DESC','pPermet a l\'utilisateur d\'etablir les marges, le remplissage, et bordures pour une image.');

@define('WK_CONF_EFM_THB_DIR','R&eacute;pertoire des miniatures');
@define('WK_CONF_EFM_THB_DIR_DESC','Les miniatures peuvent stock&eacute;s dans un r&eacute;pertoire particulier. Ce r&eacute;pertoire sera cr&eacute;&eacute; par PHP, si celui-ci n\'est pas en safe_mode (il ne pourra cr&eacute;er de r&eacute;pertoire), dans ce cas ce param&egrave;tre serait ignor&eacute;. Si vous ne voulez pas stocker les miniatures dans un autre r&eacute;pertorie, laissez ce champ vide.');

@define('WK_CONF_EFM_THB_PREFIX','Pr&eacute;fixe des Miniatures');
@define('WK_CONF_EFM_THB_PREFIX_DESC','Pr&eacute;fixe pr&eacute;c&eacute;dant toutes les miniatures cr&eacute;&eacute;es par le gestionnaire. Exemple: .thumb, alors toutes les miniatures auront le nom .thumb_fichier.ext, c\'est &agrave; dire prefix + nom original.');

@define('WK_CONF_EFM_RESIZED_DIR','Fichier d\'images redimentionees');
@define('WK_CONF_EFM_RESIZED_DIR_DESC','Les images redimentionees peuvent etre ranger dans un annuaire. cet annuaire peus etre cree par PHP. Si php est en mode surete, ce parametre est ignore, vous ne pouvez pas cree d\'annuaires. Si vous ne voulez pas ranger les images redimentionees,l\'etablir sur faux ou un endrois emply.');

@define('WK_CONF_EFM_RESIZED_PREFIX','Images redimentionees-prefix');
@define('WK_CONF_EFM_RESIZED_PREFIX_DESC','Le prefix pour les dossiers d\'images redimentionees, quelque chose comme, la redimention est bonne. le dossier redimentione sera nomme"prefix_imagefile,ext" ce qui est, prefix + le non du dossier.');

@define('WK_CONF_EFM_DEFAULT_THB','Miniature par d&eacute;faut');
@define('WK_CONF_EFM_DEFAULT_THB_DESC','Fichier image utilis&eacute; par d&eacute;faut lorsque les miniatures ne peuvent &ecirc;tre cr&eacute;&eacute;es, soit par erreur de la librairie, soit &agrave; cause d\'un mauvais fichier image.');

@define('WK_CONF_EFM_DEFAULT_LIST','Icone de la liste des defauts');
@define('WK_CONF_EFM_DEFAULT_LIST_DESC','Quand vous regardes les dossiers telecharger dans la liste, l\'icone de defaut apparait');

@define('WK_CONF_EFM_THB_EXT', 'Extension des ((miniature))');
@define('WK_CONF_EFM_THB_EXT_DESC', 'Permet l\'extension pour les dossiers miniature. Normalement identique au dosssier d\'image prolonger.les extension sont separees par un point-virgule');

@define('WK_CONF_EFM_THB_WIDTH','Largeur des Miniatures');
@define('WK_CONF_EFM_THB_WIDTH_DESC','<strong>En pixels</strong>');

@define('WK_CONF_EFM_THB_HEIGHT','Hauteur des miniatures');
@define('WK_CONF_EFM_THB_HEIGHT_DESC','<strong>En pixels</strong>');

@define('WK_CONF_EFM_TMP_PREFIX','Pr&eacute;fixe temporaire');
@define('WK_CONF_EFM_TMP_PREFIX_DESC','Pr&eacute;fixe que la librairie rajoute pour ses fichiers temporaires.');

// Errors
/////////////

@define('WK_CONF_ERRORS_CONF','Attention, il y a des erreurs dans votre configuration :');
@define('WK_CONF_ERRORS_INSTALL','Attention, l\'installation ne s\'est pas d&eacute;roul&eacute;e correctement : ');

//mail

@define('WK_CONF_ERR_MAIL','Indiquez votre adresse mail afin de pouvoir surveiller certaines pages ');
@define('WK_PROFILE_ERROR_SUCCESS_PART1','Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s, un email de confirmation');
@define('WK_PROFILE_ERROR_SUCCESS_PART2','va vous permettre de le valider');
@define('WK_PROFILE_ERROR_MAILNOTSENT','Le mail n\'a pas &eacute;t&eacute; envoy&eacute;. Son contenu &eacute;tait :');
@define('WK_PROFILE_CONNECTED_AS','Vous &ecirc;tes connect&eacute; en tant que :');
@define('WK_PROFILE_CONNECTED_INFO_PART1','Vous pouvez profiter des fonctionnalit&eacute;s avanc&eacute;es de wikiwig :');
@define('WK_PROFILE_CONNECTED_INFO_PART2','Pour &ecirc;tre pr&eacute;venu des modifications d&#146;une page du wiki cliquez sur l&#146;ic&ocirc;ne');
@define('WK_PROFILE_CONNECTED_INFO_PART3','Pour alerter les personnes qui surveillent une page de vos modifications, cliquez sur l&#146;ic&ocirc;ne');
@define('WK_LOGIN_ADMIN_BIS','Le nom de l\'administrateur est d&eacute;j&agrave; enregistrer, veuillez le modifier');

//validation mail

@define('WK_PROFILE_MAIL_TITLE','Wikiwig : Confirmation d\'inscription');
@define('WK_PROFILE_MAIL_BODY_PART0','Bonjour !');
@define('WK_PROFILE_MAIL_BODY_PART1','Veuillez confirmer votre inscription au Wikiwig');
@define('WK_PROFILE_MAIL_BODY_PART2','en cliquant sur le lien suivant ou en le recopiant dans votre navigateur web :');
@define('WK_CONF_ERR_WRITE_CONF_FILE','Impossible de sauvegarder le fichier de configuration %s. V&eacute;rfiez vos droits d\'&eacute;criture sur ce fichier! <a href="../../readme.erreur.installation.fr.html" target="_blank">besoin d\'aide ?</a>');


// Dirs

@define('WK_CONF_ERR_DB_BAD_TBL_PREFIX','Le pr&eacute;fixe donn&eacute; pour le nom des tables n\'est pas autoris&eacute;. Evitez les caract&egrave;res de ponctuation,&agrave; l\'exception de _ .');
@define('WK_CONF_ERR_DIR_CREATE','Impossible de cr&eacute;er le r&eacute;pertoire "%s" ! V&eacute;rfiez vos droits d\'&eacute;criture dans le r&eacute;pertoire de wikiwig! <a href="../../readme.erreur.installation.fr.html" target="_blank">besoin d\'aide ?</a>');
@define('WK_CONF_ERR_DIR_NO_WRITE','Le r&eacute;pertoire "%s" n\'est pas accessible en &eacute;criture, V&eacute;rfiez vos droits d\'&eacute;criture! <a href="../../readme.erreur.installation.fr.html" target="_blank">besoin d\'aide ?');

// DB

@define('WK_CONF_ERR_DB_INSTALL','Une erreur est survenue pendant l\'installation de la base de donn&eacute;es.');
@define('WK_CONF_ERR_DB_LIB_NOT_FOUND','La librairie PHP pour se connecter &agrave; la base de donn&eacute;es est introuvable.');
@define('DB_ERR_EXTENSION_UNAVAILABLE','L\'extension %s n\'est pas disponible. V&eacute;rifiez votre configuration de PHP.');
@define('DB_ERR_CONNECT_SERVER','Impossible de se connecter au serveur "%s". V&eacute;rifiez le nom du serveur, ainsi que les identifiants login et password.');
@define('DB_ERR_CONNECT_DATABASE','Impossible de se connecter &agrave; la base "%s".');
@define('DB_ERR_QUERY_FAILED','La requ&ecirc;te suivante a &eacute;chou&eacute;e : %s');

// GRAPHIC LIB

@define('WK_CONF_ERR_GRAPH_LIB_NOT_FOUND','Le chemin indiqu&eacute; pour la librairie graphique %s "%s" est introuvable. V&eacute;rifiez ce chemin ou changez de librairie graphique. Par d&eacute;faut, utilisez la librairie GD.');

// NEW
// USER RIGHTS
//////////////

@define('WK_CONF_HTTPS','HTTP/HTTPS');
@define('WK_CONF_HTTPS_DESC','Employez le HTTP ou le HTTPS pour des pages d\'ouverture');
@define('WK_CONF_USE_HTTPS','HTTPS');
@define('WK_CONF_USE_HTTP','HTTP');

@define('WK_CONF_CAPTCHA','Captcha');
@define('WK_CONF_CAPTCHA_DESC','Employez un captcha pour d&Atilde;&copy;courager des robots de cr&Atilde;&copy;er des ouvertures.<br> le phpCaptcha est un captcha simple qui n\'exige aucun configuration.<br>reCaptcha suppl&Atilde;&copy;mentaire exige d\'un compte chez http://recaptcha.net et de la configuration secondaire par l\'admin d\'installer les clefs publiques et priv&Atilde;&copy;es');
@define('WK_CONF_NO_CAPTCHA','Aucun Captcha');

@define('WK_CONF_EDIT_FILES','ditez les dossiers');
@define('WK_CONF_EDIT_FILES_DESC','');

@define('WK_CONF_RESTORE_FILES','Dossiers de restauration');
@define('WK_CONF_RESTORE_FILES_DESC','');

@define('WK_CONF_RESTORE_FOLDERS','Annuaires de restauration');
@define('WK_CONF_RESTORE_FOLDERS_DESC','');

@define('WK_CONF_CREATE_FILES','Cr&Atilde;&copy;ez les dossiers');
@define('WK_CONF_CREATE_FILES_DESC','');

@define('WK_CONF_CREATE_FOLDERS','Cr&Atilde;&copy;ez les annuaires');
@define('WK_CONF_CREATE_FOLDERS_DESC','');

// GUEST RIGHTS

@define('WK_CONF_GUEST_RIGHTS','Droits d\'invit&Atilde;&copy;');
@define('WK_CONF_GUEST_RIGHTS_DESC','Contr&Atilde;&acute;lez les droites que vous souhaitez donner aux utilisateurs anonymes.');

// 
@define('WK_CONF_APPROVAL', 'Nouvelle approbation d\'utilisateur');
@define('WK_CONF_APPROVAL_DESC', 'Comment il est acceptable de v&Atilde;&copy;rifier l\'utilisateur:' .
                               '<br> Par l\'interm&Atilde;&copy;diaire de la r&Atilde;&copy;ponse d\'email. (<b>Exige</b> l\'acc&Atilde;&uml;s de wiki au mail server.)' .
			       '<br> Par l\'interm&Atilde;&copy;diaire de la r&Atilde;&copy;ponse d\'admin.'  .
			       '<br> Aucune v&Atilde;&copy;rification, chacun n\'est approuv&Atilde;&copy;e.');
@define('WK_CONF_APPROVE_BY_EMAIL', 'Email');
@define('WK_CONF_APPROVE_BY_ADMIN', 'Admin');
@define('WK_CONF_APPROVE_ALL', 'Aucun');

@define('WK_CONF_EMAIL_SERVER', 'Installation de mail server');
@define('WK_CONF_EMAIL_SERVER_DESC', 'Raccordement &Atilde;&nbsp; employer pour envoyer l\'email. L\'email peut &Atilde;&ordf;tre envoy&Atilde;&copy; pendant la confirmation d\'abonnement et pour des avertissements sur des modifications de page. <br>Le SMTP est le seul client disponible. <br>Aucun ne d&Atilde;&copy;sactive l\'utilisation de l\'email et d&Atilde;&copy;sactivera les configurations d\'avertissement/de surveillance');
@define('WK_CONF_EMAIL_SMTP', 'SMTP');

@define('WK_CONF_NONE', 'Aucun');
@define('WK_CONF_REVISION', 'Commande de r&Atilde;&copy;vision (RCS/CVS/Internal pas encore mis en application)');
@define('WK_CONF_REVISION_DESC', 'Comment fait le wikiwig maintenez les vieilles versions des pages de wiki. <br>RCS : les outils de RCS doivent &Atilde;&ordf;tre present.<br>CVS : des outils de cvs doivent &Atilde;&ordf;tre install&Atilde;&copy;s. <br>Interne : employez le code de wikiwig pour contr&Atilde;&acute;ler des r&Atilde;&copy;visions. <br>Aucun : employez l\'annuaire de secours de wikiwig');
@define('WK_CONF_RCS_INT', 'Interne');

@define('WK_CONF_ERR_NO_EMAIL', 'Un arrangement sans mail server est incompatible avec les utilisateurs avec approbation par l\'email confirmation');



?>