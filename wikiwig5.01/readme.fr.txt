README Wikiwig v4-0 [Novembre 2005]
=================

Wikiwig est un Wiki Wysiwyg écrit pour php/mysql.

Fonctionnalités
---------------
 - éditeur wysiwyg en ligne (htmlarea)
 - user management
 - système bloquant évitant que 2 utilisateurs éditent une page simultanément
 - gestionnaire de fichiers (attachés)
 - gestionnaire d'images (upload + modifications en ligne)
 - suivi de versions des pages

Configuration nécessaire
------------------------
Miminum:
 - PHP 4.1 ou plus
 - MySQL 3.2 ou plus

Content
-------
/changelog.txt
/license_htmlarea.txt
/readme.fr.txt
/readme.txt
/version.txt
/wikiwig/_wk/ : système de Wikiwig
/wikiwig/index.php : script de départ

Installation de Wikiwig
-----------------------
    - copier le contenu du dossier /wikiwig/ dans un répertoire de votre serveur Web.
    - ouvrez un navigateur Web et allez dans le dossier Wikiwig, ex: http://localhost/wikiwig/
      (si vous ne voyez qu'une liste de fichiers et de répertoires, rajoutez index.php dans l'url, ex:  http://localhost/wikiwig/index.php)
    - Vous devriez être à présent sur la page de configuration. 
      (Sinon, tapez dans l'url : http://localhost/wikiwig/_wk/setup/)

Mises à jour de Wikiwig
-----------------------
    depuis une version 3
    ---------------------
    - Supprimer le répertoire _wk.
      Attention: ne supprimez pas les pages html que vous avez écrites avec votre Wiki.
    - Suivez le processus d'installation (au-dessus)
    - Dans la partie administration (/_wk/wk_admin.php), lancez "Parser toutes les pages" en cliquant dessus.

    depuis une version 2 ou 1
    -------------------------
    Aucun mise à jour n'est possible, l'application ayant fondamentalement changée depuis ces versions.

Configuration de Wikiwig
------------------------
    Première utilisation
    --------------------
     - lancez le script /index.php dans votre navigateur, ex: http://localhost/wikiwig/index.php
     - remplissez le formulaire
    
    Mise à jour
    -----------
        Méthode 1 :
           lancez le script de configuration dans votre navigateur, ex: http://localhost/wikiwig/_wk/setup/
           Note: vous pouvez également y accéder par le menu de la page d'administration (/_wk/wk_admin.php).
        
        Méthode 2 :
            modifier directement le fichier /_wk/wk_config.php (si déjà installé)

Problèmes courants
------------------

    Magic_quotes
    ------------
    La version actuelle de WikiWig met par défaut les magic_quotes à off.
    
    Safe_mode
    ---------
    L'utilisation en safe_mode peut provoquer des erreurs pour la création, lecture de fichiers, répertoires,...
    
    En général, la plupart des hébergeurs gratuits ou des hébergements sur serveurs mutualisés configurent les serveurs en safe_mode.
    Si vous avez un doute sur la configuration du serveur que vous utilisez, lancer le script phpinfo.php depuis votre site dans un navigateur
    et cherchez la ligne commençant par safe_mode. Les valeurs des colonnes suivantes vous indiquent si vous êtes en safe_mode ou non.
    En résumé, si c'est sur On, c'est pas bon et Wikiwig pourrait mal fonctionner.
    
    Chez Free (http://www.free.fr)
    ---------
    WikiWig utilise les sessions de PHP. Vous devez alors créer un repertoire "sessions" a la racine de votre ftp, si ce n'est déjà fait.
        
Notes sur HTMLArea
------------------
HTMLArea est un projet libre sous licence BSD. (voir le fichier license_htmlarea.txt pour plus de détails.)
Url du projet : http://dynarch.com/mishoo

Historique du projet
--------------------
Consultez le fichier changelog.txt

Reports de Bugs ou suggestions
------------------------------
Accédez à la page du projet sur sourceforge : 
http://sourceforge.net/projects/wikiwig/
puis par le menu, accédez soit au gestionnaire de Bugs, aux Forums, ou pour les suggestions aux RFE (Request For Enhancements)

