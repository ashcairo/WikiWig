<?php

////////////////////
// GLOBAL LABELS //
//////////////////

@define('WK_LABEL_LOGOUT','vous d&eacute;connecter');
@define('WK_LABEL_LINK_ADMIN','Admin');
@define('WK_LABEL_GUEST','Invit&eacute;');
@define('WK_LABEL_WIKI_MAP','Plan du wiki');
@define('WK_LABEL_CREATE','cr&eacute;er');
@define('WK_LABEL_CANCEL','annuler');
@define('WK_LABEL_VALIDATE','valider');
@define('WK_LABEL_CLOSE_WINDOW','fermer cette fen&ecirc;tre');
@define('WK_LABEL_GO_WIKI','aller sur le wiki');
@define('WK_LABEL_FILE_MODIFIED_BY','page en cours de modification par '); 
@define('WK_LABEL_HOME_WIKI','accueil du wiki');
@define('WK_LABEL_DIR_INDEX_ALIAS','Sommaire (<>)');
@define('WK_LABEL_CLICK_HERE','Cliquez ici');
@define('WK_LABEL_EDIT_PAGE','modifier cette page !');
@define('WK_LABEL_FOLDER_MAP','plan');
@define('WK_LABEL_BACK','retour');
@define('WK_ERR_STANDARD','Une erreur est survenue. Votre requ&ecirc;te n&rsquo;a pu &ecirc;tre effectu&eacute;e.');
@define('WK_LABEL_WELCOME','BIENVENUE !');
@define('WK_LABEL_LOGIN','IDENTIFIEZ-VOUS');
@define('WK_LABEL_LOGOUT','d&eacute;connexion');
@define('WK_LABEL_AREYOU','&ecirc;tes vous');
@define('WK_LABEL_EDIT_PAGE_NO_WRITE','Page non modifiable');
@define('WK_LABEL_EDIT_PAGE_NO_WRITE_ADMIN','Page modifiable seulement sous autorisation');
@define('WK_LABEL_EDIT_PAGE_IMG', 'page seulement modifiable et lisible sous autorisation');
@define('WK_LABEL_BYTES','o');
/////////////////////////////
// WIKI LISTING (wk_list) //
///////////////////////////

@define('WK_LIST_TABLE_HEAD_FILE','page');
@define('WK_LIST_TABLE_HEAD_SIZE','taille');
@define('WK_LIST_TABLE_HEAD_DATE','date de derniere &eacute;dition');
@define('WK_LIST_LOCKED_FILE','Page en &eacute;dition par ');
@define('WK_LIST_INDEX_ALIAS','page d\'accueil');
@define('WK_LIST_ADD_DIR','ajouter un dossier ici');
@define('WK_LIST_ADD_FILE','ajouter une page ici');
@define('WK_LIST_DELETE_FILE','Effacer');
@define('WK_LIST_DELETE_FILE_TOOLTIP','Efface la(les) page(s) selectionn&eacute;ee(s)');
@define('WK_LIST_MOVE_FILE','D&eacute;placer');
@define('WK_LIST_MOVE_FILE_TOOLTIP','D&eacute;placer la(les) page(s) selectionn&eacute;ee(s)');
@define('WK_LIST_SELECT_FILE','S&eacute;lectionnez cette page et utilisez les boutons en dessous de la liste suivant l\'action d&eacute;sir&eacute;e.');
@define('WK_LIST_SELECT_ALL_FILES','Selectionner ou deselectionner tout');
@define('WK_LIST_DELETE_FOLDER','Effacer');
@define('WK_LIST_DELETE_FOLDER_TOOLTIP','Efface le dossier s&eacute;lectionn&eacute;');
@define('WK_LIST_MOVE_FOLDER','D&eacute;placer');
@define('WK_LIST_MOVE_FOLDER_TOOLTIP','D&eacute;place le dossier s&eacute;lectionn&eacute;');
@define('WK_LIST_WARN_ON_DELETE_FOLDER','Effacer le dossier s&eacute;lectionn&eacute; ?');
@define('WK_LIST_RIGHT' ,'Donner des droits');
@define('WK_LIST_RIGHT_TOOLTIP' ,'Donne ou refuse le droit d\'acces au un internaute');

////////////////////////////////
// PAGE EDITION (wk_edition) //
//////////////////////////////

@define('WK_ERR_PAGE_ALREADY_EDITED_TITLE','La page est d&eacute;j&agrave; en cours d\'&eacute;dition.');
@define('WK_ERR_PAGE_ALREADY_EDITED_ONE','Un ');
@define('WK_ERR_PAGE_ALREADY_EDITED','Cette page est d&eacute;j&agrave; en cours d\'&eacute;dition<br> '.
    'Ce syst&egrave;me permet d\'&eacute;viter que plusieurs utilisateurs travaillent '.
    'sur une page en m&ecirc;me temps.<br/>');
@define('WK_ERR_PAGE_ALREADY_EDITED_2',' edite la page, il en a l\'usage exclusif pendant ');
@define('WK_ERR_PAGE_ALREADY_EDITED_3',' minutes.Une fois ce temps &eacute;coul&eacute; sans '.
    'sauvegarde sa part, on consid&eacute;re que la page peut redevenir disponible '.
    'pour tous.');
@define('WK_EDITION_TITLE_PAGE','Edition de la page %s');
@define('WK_EDITION_ACTION_SAVE','Enregistrer');
@define('WK_EDITION_ACTION_QUIT','Quitter');
@define('WK_EDITION_MESSAGE_SAVING','Enregistrement en cours...');
@define('WK_EDITION_MESSAGE_LOADING','CHARGEMENT...');
@define('WK_EDITION_MESSAGE_CACHING','NB: Le premier lancement de l\'editeur est long car il se charge dans le cache');
@define('WK_EDITION_MESSAGE_PLEASE_WAIT','veuillez patienter');
@define('WK_EDITION_MESSAGE_SESSION_WARNING','Attention vous n\'avez plus que %s secondes '.
                      'pour modifier cette page.<br>Enregistrez pour pouvoir continuer '.
                      '%s minutes de plus. ');
@define('WK_EDITION_MESSAGE_SESSION_EXPIRED','<p>D&eacute;sol&eacute; ! Vous ne pouvez plus modifier cette page car vous ne l\'avez pas enregistr&eacute;e '.
    'pendant plus de %s minutes.<br>La page est donc &agrave; nouveau disponible pour tous, et des '. 
    'utilisateurs sont susceptibles de l\'avoir d&eacute;j&agrave; modifi&eacute;e. </p><p>Si vous avez fait des modifications '.
    'et que vous d&eacute;sirez vraiment les garder, vous pouvez r&eacute;ouvrir cette page dans une autre fen&ecirc;tre et '.
    'copier/coller vos modifications.</p>');
@define('WK_GO_WIKIWIG_MAP','revenir au plan');
@define('WK_EDITION_ACTION_REOPEN','r&eacute;ouvrir cette page');
@define('WK_EDITION_CLOSE_MESSAGE','fermer ce message');
@define('WK_EDITION_MESSAGE_SESSION_SYSTEM_INFO',
    'NB : Ce syst&egrave;me permet d\'&eacute;viter que plusieurs utilisateurs travaillent '.
    'sur une page en m&ecirc;me temps. Vous avez donc l\'usage exclusif de cette '.
    'page pendant %s minutes. Une fois ce temps &eacute;coul&eacute; sans '.
    'sauvegarde de votre part, on consid&eacute;re que la page  peut redevenir disponible '.
    'pour tous.');
@define('WK_EDITION_FILE_PERIME','Page p&eacute;rim&eacute;');
@define('WK_EDITION_MESSAGE_ASK_SAVE','Voulez vous enregistrer ?');
@define('WK_EDITION_MESSAGE_ASK_QUIT','Voulez vous quitter ?');
@define('WK_EDITION_WARNING_OLD_BROWSER','Attention: Votre navigateur n\'est pas assez r&eacute;cent pour utiliser les fonctions avanc&eacute;es de l\'&eacute;diteur de texte.');

@define('WK_ADD_INTERNAL', 'Ins?rer un lien vers une page du Wiki');

////////////////
// DIRECTORY //
//////////////

// DIR Action Pages

@define('WK_CREATE_DIR_HEAD_TITLE','Cr&eacute;ation de dossier');
@define('WK_CREATE_DIR_BODY_TITLE','Ajouter un dossier dans %s');
@define('WK_LABEL_NEW_DIR','Nom du sous dossier');
@define('WK_CREATE_DIR_SUCCESS','Le dossier "%s" a bien &eacute;t&eacute; cr&eacute;&eacute;');
@define('WK_CREATE_DIR_SUMMARY','');
@define('WK_DELETE_DIR_HEAD_TITLE','Supprimer un dossier');
@define('WK_DELETE_DIR_BODY_TITLE','Supprimer le dossier "%s"');
@define('WK_DELETE_DIR_SUCCESS','Le dossier "%s" a &eacute;t&eacute; supprim&eacute;.');
@define('WK_DELETE_DIR_SUMMARY','Vous allez supprimer un dossier du wiki. Soyez prudent en supprimant des dossiers, car les liens pointant vers des pages de ce dossier ne seront plus corrects.');
@define('WK_MOVE_DIR_HEAD_TITLE','D&eacute;placer un dossier');
@define('WK_MOVE_DIR_BODY_TITLE','D&eacute;placer le dossier "%s"');
@define('WK_MOVE_DIR_SUCCESS','Le dossier "%s" a &eacute;t&eacute; d&eacute;plac&eacute; dans le dossier "%s".');
@define('WK_MOVE_DIR_SUMMARY','Vous allez d&eacute;placer un dossier du wiki dans un autre dossier. Soyez prudent en d&eacute;pla&ccedil;ant des dossiers, car les liens pointant vers des pages de ce dossier ne seront plus corrects.');
@define('WK_MOVE_DIR_LABEL_TARGET','Choisissez le dossier de destination du dossier "%s" : ');

// ERRORS

@define('WK_ERR_DIR_NOT_EXISTS','Le dossier "%s" n\'existe pas.');
@define('WK_ERR_DIR_EXISTS','Le dossier "%s" existe d&eacute;j&agrave;.');
@define('WK_ERR_DIR_BADNAME','Le nom de dossier "%s" n\'est pas autoris&eacute;.');
@define('WK_ERR_DIR_NOT_WRITABLE','Impossible d\'&eacute;crire dans le dossier "%s".');
@define('WK_ERR_DIR_PARENT_NOT_EXISTS','Le r&eacute;pertoire %s n\'existe pas.');
@define('WK_ERR_DIR_PARENT_NOT_WRITABLE','Vous ne pouvez pas cr&eacute;er de dossier &agrave; cet endroit.');
@define('WK_ERR_DIR_MAKE','Impossible de cr&eacute;er le dossier %s.');
@define('WK_ERR_DIR_DELETE_ROOT','Vous n&rsquo;&ecirc;tes pas autoris&eacute; &agrave; supprimer le dossier racine du wiki.');
@define('WK_ERR_DIR_DELETE_LOCKS','Des pages du dossier %s sont an cours d&rsquo;&eacute;dition. Vous ne pouvez pas supprimer le dossier maintenant.');
@define('WK_ERR_DIR_MOVE_NOT_ALLOWED','Vous n&rsquo;&ecirc;tes pas autoris&eacute; &agrave; d&eacute;placer des r&eacute;pertoires.');
@define('WK_ERR_DIR_DELETE_NOT_ALLOWED','Vous n&rsquo;&ecirc;tes pas autoris&eacute; &agrave; supprimer des r&eacute;pertoires.');


//////////////
// FILE    //
////////////

// CREATE FILE Page
@define('WK_CREATE_FILE_HEAD_TITLE','Cr&eacute;ation de page');
@define('WK_CREATE_FILE_BODY_TITLE','Ajouter une page dans %s');
@define('WK_LABEL_NEW_FILE','Nom de la page');
@define('WK_LABEL_FILE_TEMPLATE','Type');
@define('WK_LABEL_FILE_EMPTY_TEMPLATE','Vide (juste le titre)');

// FILE SAVE, LOCK, UNLOCK

@define('WK_FILE_SAVED','La page %s a bien &eacute;t&eacute; sauvegard&eacute;e.');
@define('WK_FILE_SAVE_TITLE','Enregistrement');
@define('WK_FILE_UNLOCK_TITLE','Fermeture en cours...');

// ERRORS

@define('WK_ERR_FILE_EXISTS','La page "%s" existe d&eacute;j&agrave;.');
@define('WK_ERR_FILE_NOT_EXISTS','La page "%s" n\'existe pas.');
@define('WK_ERR_FILE_BADNAME','Le nom de page "%s" est incorrect.');
@define('WK_ERR_FILE_WRITE','Impossible d\'ouvrir la page "%s" !!');
@define('WK_ERR_FILE_READ','Impossible de lire la page "%s" !!');
@define('WK_ERR_FILE_DELETE','Impossible de supprimer la page %s.');
@define('WK_ERR_READ_TPL_FILE','Probl&egrave;me pour cr&eacute;er une page sur le mod&egrave;le : %s !');

///////////////
// DATABASE //
/////////////

@define('DB_ERR_EXTENSION_UNAVAILABLE','L\'extension %s n\'est pas disponible. V&eacute;rifiez votre configuration de PHP.');
@define('DB_ERR_CONNECT_SERVER','Impossible de se connecter au serveur "%s".');
@define('DB_ERR_CONNECT_DATABASE','Impossible de se connecter &agrave; la base "%s".');
@define('DB_ERR_QUERY_FAILED','La requ&ecirc;te suivante a &eacute;chou&eacute;e : <br/>%s.');

///////////////////
// USER PROFILE //
/////////////////

@define('WK_PROFILE_PSEUDO_USED','Le pseudo que vous avez demand&eacute; est d&eacute;j&agrave; utilis&eacute;. Si vous &ecirc;tes cet utilisateur, identifiez-vous en rentrant votre password.<br />Sinon, choisissez un autre pseudonyme et ne remplissez pas le champ password.');
@define('WK_PROFILE_CREATE_INSTRUCTIONS','Pour profiter des fonctions avanc&eacute;es de wikiwig<br>- &ecirc;tre pr&eacute;venu des modifications d&#146;une page du wiki<br>- alerter les personnes qui surveillent une page de vos modifications');
@define('WK_PROFILE_LABEL_NAME','Pseudo');
@define('WK_PROFILE_LABEL_PASSWORD','Password');
@define('WK_PROFILE_LABEL_PASSWORD_VERIF','Password bis');
@define('WK_PROFILE_PSEUDO_USED_TITLE','Ce nom existe d&eacute;j&agrave;... Veuillez recommencer.');
@define('WK_PROFILE_CREATION_ERROR','erreur dans la cr&eacute;ation');
@define('WK_PROFILE_CREATION_WISHTOCREATE','Je souhaite cr&eacute;er un compte');
@define('WK_PROFILE_CREATION_WISHTOLOG','Je poss&egrave;de d&eacute;j&agrave; un compte et souhaite me connecter');
@define('WK_PROFILE_UPDATE_TITLE','Modification de vos informations');
@define('WK_PROFILE_UPDATE_TITLE2','Je souhaite modifier mes donn&Atilde;&copy;e');
@define('WK_PROFILE_ANTISPAM_CONFIRMATION','Un mail de confirmation vous sera envoy&eacute;');
@define('WK_PROFILE_ANTISPAM_PRIVACY','On ne fournira jamais votre adresse e-mail &agrave; qui que ce soit');
@define('WK_PROFILE_ANTISPAM_UNSUSCRIBE','Vous pouvez cesser de surveiller les page &agrave; tout moment');
@define('WK_PROFILE_ERROR_ENTER_PASSWORD','Veuillez entrer votre password');
@define('WK_PROFILE_ERROR_LOGIN_DONTEXISTS','Ce login n\'existe pas');
@define('WK_PROFILE_ERROR_BADPASSWORD','Mot de passe erron&eacute;');
@define('WK_PROFILE_ERROR_ENTER_NEW_PASSWORD','Veuillez entrer votre nouveau password');
@define('WK_PROFILE_ERROR_ENTER_NEW_PASSWORD_CHECK','Veuillez entrer &agrave; nouveau votre password (pour v&eacute;rifier)');
@define('WK_PROFILE_ERROR_ENTER_EMAIL','Veuillez entrer votre adresse email (pour pouvoir utiliser les fonctionnalit&eacute;s d\'alerte)');
@define('WK_PROFILE_ERROR_SUCCESS_PART1','Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s, un email de confirmation');
@define('WK_PROFILE_ERROR_SUCCESS_PART2','va vous permettre de le valider');
@define('WK_PROFILE_ERROR_MAILNOTSENT','Le mail n\'a pas &eacute;t&eacute; envoy&eacute;. Son contenu &eacute;tait :');
@define('WK_PROFILE_CONNECTED_AS','Vous &ecirc;tes connect&eacute; en tant que :');
@define('WK_PROFILE_CONNECTED_INFO_PART1','Vous pouvez profiter des fonctionnalit&eacute;s avanc&eacute;es de wikiwig :');
@define('WK_PROFILE_CONNECTED_INFO_PART2','Pour &ecirc;tre pr&eacute;venu des modifications d&#146;une page du wiki cliquez sur l&#146;ic&ocirc;ne');
@define('WK_PROFILE_CONNECTED_INFO_PART3','Pour alerter les personnes qui surveillent une page de vos modifications, cliquez sur l&#146;ic&ocirc;ne');
@define('WK_PROFILE_CONNECTED_MODIF_ERROR','Attention, pour r&eacute;aliser une modification, il faut rentrer tout les champs (Pseudo, password)');

//syst&egrave;me de monitoring
@define('WK_MONITORING_WARN','ALERTER');
@define('WK_MONITORING_WARN_INFO','En validant cette page, un mail sera envoy&eacute; aux utilisateurs qui la surveillent.');
@define('WK_MONITORING_USERSLIST','Les utilisateurs qui surveillent cette page sont :');
@define('WK_MONITORING_EMPTYLIST','Aucun utilisateur de ce wiki ne surveille cette page');
@define('WK_MONITORING_WARN_MAIL_ALERTYOU', 'vous alerte !');
@define('WK_MONITORING_WARN_MAILRESULTOK','Alerte mail envoy&eacute;e avec succ&egrave;s &agrave;');
@define('WK_MONITORING_WARN_MAILRESULTNOK','ERREUR, alerte mail PAS envoy&eacute;e &agrave;');
@define('WK_MONITORING_WARN_MAILRESULTNOK2','Le texte &eacute;tait :');

//validation mail
@define('WK_PROFILE_MAIL_TITLE','Wikiwig : Confirmation d\'inscription');
@define('WK_PROFILE_MAIL_BODY_PART0','Bonjour !');
@define('WK_PROFILE_MAIL_BODY_PART1','Veuillez confirmer votre inscription au Wikiwig');
@define('WK_PROFILE_MAIL_BODY_PART2','en cliquant sur le lien suivant ou en le recopiant dans votre navigateur web :');


/////////////////
// ADMIN      //
///////////////
@define('WK_ADMIN_HOME_MSG','Vous &ecirc;tes dans la partie administration de Wikiwig.<br/>Les op&eacute;rations disponibles sont list&eacute;es dans le menu de gauche.');
@define('WK_LABEL_CONFIGURATION','Modifier la configuration de wikiwig');
@define('WK_LABEL_PARSING','Reconstruisez toutes les pages!');
@define('WK_ADMIN_BODY_TITLE','WK Admin');
@define('WK_ADMIN_HEAD_TITLE','WK Admin');
@define('WK_ADMIN_RESULTS_TITLE','R&eacute;sultats');
@define('WK_ADMIN_PARSE_FILE_OK','Dossier <strong>%s</strong> avec succ&Atilde;&uml;s reconstruit.');
@define('WK_ADMIN_PARSE_FILE_ERROR','Erreur reconstruisant le dossier <strong>%s</strong> !');

//////////////////////////
// ADMIN AUTHENTICATION //
//////////////////////////

@define('WK_ADMIN_AUTH_REQUIRED','Identification obligatoire');
@define('WK_ADMIN_AUTH_LABEL_LOGIN','Nom d\'utilisateur');
@define('WK_ADMIN_AUTH_LABEL_PASSWORD','Password');
@define('WK_ADMIN_AUTH_ERROR','Erreur: Vous n\'&ecirc;tes pas autoris&eacute; &agrave; acc&eacute;der &agrave; cette partie du site!');
@define('WK_ADMIN_AUTH_RETRY','<a href="%s">'.WK_LABEL_CLICK_HERE.'</a></strong> pour r&eacute;essayer.');
@define('WK_ADMIN_AUTH_INSTRUCTIONS','Vous devez vous identifier pour acc&eacute;der acc&eacute;der &agrave; cette partie du site!');

//////////////////
// MONITORING ///
/////////////////

@define('WK_MONITORING_WARN','ALERTER');
@define('WK_MONITORING_WARN_INFO','En validant cette page, un mail sera envoy&eacute; aux utilisateurs qui la surveillent.');
@define('WK_MONITORING_USERSLIST','Les utilisateurs qui surveillent cette page sont :');
@define('WK_MONITORING_EMPTYLIST','Aucun utilisateur de ce wiki ne surveille cette page');
@define('WK_MONITORING_ADDITIONAL_USERS','Personnes suppl&eacute;mentaires :');
@define('WK_MONITORING_OPTIONNAL','optionnal');
@define('WK_MONITORING_MAIL_EXAMPLE','(e-mail s&eacute;par&eacute;es par un point-virgule, ex: user@domain.com)');
@define('WK_MONITORING_WARN_MAILSENT','Les personnes ont bien &eacute;t&eacute; alert&eacute;es par mail.');
@define('WK_MONITORING_WARN_MAILSENT_CONFIRM','Les utilisateurs ont &eacute;t&eacute; prevenus');


@define('WK_MONITORING_MONITOR_STOP','CESSER DE SURVEILLER');
@define('WK_MONITORING_MONITOR_STOP_CONFIRM','Vous ne surveillez plus cette page');
@define('WK_MONITORING_MONITOR_STOP_ALT','Cesser de surveiller cette page');
@define('WK_MONITORING_MONITOR_START_ALT','Surveiller cette page');
@define('WK_MONITORING_MONITOR_START_GUESTALT','Surveiller cette page - non accessible aux invit&eacute;s');
@define('WK_MONITORING_MONITOR_WARN_ALT','Alerter les utilisateurs de vos modifications');
@define('WK_MONITORING_MONITOR_WARN_GUESTALT','Alerter les utilisateurs de vos modifications - non accessible aux invit&eacute;s');
@define('WK_MONITORING_MONITOR_START','SURVEILLER');
@define('WK_MONITORING_MONITOR_START_CONFIRM','Vous surveillez maintenant cette page.');
@define('WK_MONITORING_MONITOR_START_INFO','Si des utilisateurs du Wiki veulent alerter les autres qu&#146;ils ont modifi&eacute; cette page, vous serez pr&eacute;venu par mail.');



//warning mail
@define('WK_MONITORING_WARN_MAIL_PART0','Cher');
@define('WK_MONITORING_WARN_MAIL_PART1','vous alerte que la page');
@define('WK_MONITORING_WARN_MAIL_PART2','a chang&eacute;!');
@define('WK_MONITORING_WARN_MAIL_PART3','Vous recevez ce mail car vous surveillez une page du Wikiwig');

////////////
//  chat  //
////////////

@define('WK_CHAT_LIEN', 'Laisser un message');
@define('WK_CHAT_TEASING', 'Correspondre avec la personne qui publie la page');


////////////////
// ETIQUETTE //
////////////////
@define('WK_ETIQUETTE_GUEST', 'Vous &ecirc;tes un invit&eacute;, pour devenir membre inscrivez-vous.');
@define('WK_ETIQUETTE_TEASING', 'Devenez membre et vous pourrez correspondre avec la personne qui publie la page');

// New stuff
@define('WK_USER_ADMIN','Administration d\'utilisateur');
@define('WK_CAPTCHA_ADMIN','Configurez les clefs de reCaptcha');
// Buttons
@define('WK_DELETE','Suppression');
@define('WK_UPDATE','Mise &Atilde;&nbsp; jour');
@define('WK_NEXT','Apr&Atilde;&uml;s');
@define('WK_PREV','Pr&Atilde;&copy;c&Atilde;&copy;dent');
@define('WK_SEARCH','Recherche');

@define('WK_ADMIN_RENAME_FOLDERS','Retitrez les annuaires');
@define('WK_ADMIN_RENAME_FILES','Retitrez les dossiers');
@define('WK_ADMIN_MOVE_FOLDERS','D&Atilde;&copy;placez les annuaires');
@define('WK_ADMIN_MOVE_FILES','D&Atilde;&copy;placez les dossiers');
@define('WK_ADMIN_DELETE_FOLDERS','Annuaires de suppression');
@define('WK_ADMIN_DELETE_FILES','Dossiers de suppression');
@define('WK_ADMIN_RESTORE_FOLDERS','Annuaires de restauration');
@define('WK_ADMIN_RESTORE_FILES','Dossiers de restauration');
@define('WK_ADMIN_CREATE_FILES','Cr&Atilde;&copy;ez les dossiers');
@define('WK_ADMIN_CREATE_FOLDERS','Cr&Atilde;&copy;ez les annuaires');
@define('WK_ADMIN_EDIT_FILES','&Atilde;&#137;ditez les dossiers');
@define('WK_ADMIN_ADMIN','Admin');

@define('WK_LIST_READPROTECT','Lu prot&Atilde;&copy;gez');
@define('WK_LIST_WRITEPROTECT','Protection contre l\'&Atilde;&copy;criture');
@define('WK_LIST_SELECTALL','Choisissez tous');

@define('WK_PROFILE_REMEMBER','Maintenez-moi ouvert une session jusqu\'&Atilde;&nbsp; ce que je me d&Atilde;&copy;connecte.');

@define('WK_PROFILE_ERROR_ENTER_VALID_LOGIN','Les noms d\'ouverture contiennent seulement des lettres et des nombres.');
@define('WK_PROFILE_ERROR_SUCCESS','Votre compte a &Atilde;&copy;t&Atilde;&copy; cr&Atilde;&copy;&Atilde;&copy; avec succ.');
@define('WK_PROFILE_ERROR_SUCCESS_ADMIN','Votre compte a &Atilde;&copy;t&Atilde;&copy; cr&Atilde;&copy;&Atilde;&copy; avec succ&Atilde;&uml;s. Maintenant attente de l\'arrangement d\'admin des privil&Atilde;&uml;ges.');

@define('WK_PROFILE_LABEL_NEW_PASSWORD','Nouveau mot de passe');
@define('WK_PROFILE_ERROR_NOT_SOLVED','Puzzle non r&Atilde;&copy;solu. Essai encore.');

@define('WK_PROFILE_CONNECTED_MODIF_ERROR2','Id/password inadmissible');
@define('WK_PROFILE_CONNECTED_MODIF_ERROR3','Nouvelle disparit&Atilde;&copy; de mot de passe ');

@define('WK_PROFILE_CAPTCHA_MSG','Introduisez ces lettres');

@define('WK_CAPTCHA_PUBLIC','Clef publique ');
@define('WK_CAPTCHA_PRIVATE','Clef priv&Atilde;&copy;e.');
@define('WK_CAPTCHA_SUCCESS','Clefs de reCaptcha avec succ&Atilde;&uml;s mises &Atilde;&nbsp; jour.');

// Messages
@define('DB_ERR_EXTENSION_UNAVAILABLE','L\'extension %s n\'est pas disponible. Vérifiez votre configuration de PHP.');
@define('DB_ERR_CONNECT_SERVER','Impossible de se connecter au serveur "%s".');
@define('DB_ERR_CONNECT_DATABASE','Impossible de se connecter à la base "%s".');
@define('DB_ERR_QUERY_FAILED','La requ&ecirc;te suivante a &eacute;chou&eacute;e : %s');

@define('WK_MOVE_FILE_SUCCESS','Les dossiers ont &Atilde;&copy;t&Atilde;&copy; d&Atilde;&copy;plac&Atilde;&copy;s &Atilde;&nbsp; l\'annuaire "%s".');
@define('WK_MOVE_FILE_LABEL_TARGET','Choisissez la destination o&Atilde;&sup1; d&Atilde;&copy;placer les dossiers : ');

@define('WK_HISTORY_TITLE','Histoire de page');
@define('WK_HISTORY_USER','Utilisateur');
@define('WK_HISTORY_WHEN','Date');
@define('WK_HISTORY_ACTION','Action');
@define('WK_HISTORY_COMMENT','Notes');
@define('WK_HISTORY_NONE','Aucune histoire');

@define('WK_LOOKUP_404','<br>La page r&Atilde;&copy;f&Atilde;&copy;renc&Atilde;&copy;e n\'existe pas dans le wiki');
@define('WK_LOOKUP_DELETE','<br>La page r&Atilde;&copy;f&Atilde;&copy;renc&Atilde;&copy;e %s a &Atilde;&copy;t&Atilde;&copy; supprim&Atilde;&copy;e du wiki');
@define('WK_DELETED', 'Supprim&Atilde;&copy;: ');
@define('WK_MODIFIED', 'Modifi&Atilde;&copy;: ');
@define('WK_BY', ' par: ');

@define('WK_RESTORE_FILE', 'Dossier de restauration');
@define('WK_RESTORE_DO', 'Vous souhaitez reconstituer le dossier: <strong>');
@define('WK_RESTORE_DATE', '</strong> <br>de la date: ');
@define('WK_RESTORE_FILE_SUCCESS', 'Le dossier %s a &Atilde;&copy;t&Atilde;&copy; reconstitu&Atilde;&copy;');
@define('WK_RESTORE_FILE_SUCCESS2', 'Le dossier %s a &Atilde;&copy;t&Atilde;&copy; reconstitu&Atilde;&copy; du d&Atilde;&copy;tritus');
@define('WK_RESTORE_BAD1', 'Incapable de reconstituer le dossier. Mauvais param&Atilde;&uml;tres.');
@define('WK_LABEL_RESTORE', 'restauration');
@define('WK_RESTORE_NOT_AUTHORIZED', 'Vous n\'&Atilde;&ordf;tes pas autoris&Atilde;&copy; &Atilde;&nbsp; reconstituer des dossiers');
@define('WK_RESTORE_NO_FILE', 'Aucun un tel dossier');

@define('WK_UNDELETE_BAD1', 'Incapable de reprendre le dossier. Mauvais param&Atilde;&uml;tres.');
@define('WK_UNDELETE_BAD2', 'Incapable de reprendre le dossier. Dossier absent.');

@define('WK_DELETE_SUCCESS', 'Dossiers supprim&Atilde;&copy;s');
@define('WK_MOVE_BAD', 'Incapable de d&Atilde;&copy;placer des dossiers. Mauvais param&Atilde;&uml;tres.');

@define('WK_BACKUP_BAD1', 'Dossier absent.');

@define('WK_LABEL_PREVIEW', 'Pr&Atilde;&copy;vision');
@define('WK_LABEL_PREVIEW_FILE', 'Restauration de pr&Atilde;&copy;vision de dossier: ');
@define('WK_LABEL_PREVIEW_WHEN', ' de la date: ');

// CAUTION : DO NOT ADD ANY CHARACTERS after the last line (? >), NOT EVEN A SPACE OR A CARRIAGE RETURN !!!
?>