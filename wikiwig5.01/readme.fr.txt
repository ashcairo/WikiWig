README Wikiwig v4-0 [Novembre 2005]
=================

Wikiwig est un Wiki Wysiwyg �crit pour php/mysql.

Fonctionnalit�s
---------------
 - �diteur wysiwyg en ligne (htmlarea)
 - user management
 - syst�me bloquant �vitant que 2 utilisateurs �ditent une page simultan�ment
 - gestionnaire de fichiers (attach�s)
 - gestionnaire d'images (upload + modifications en ligne)
 - suivi de versions des pages

Configuration n�cessaire
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
/wikiwig/_wk/ : syst�me de Wikiwig
/wikiwig/index.php : script de d�part

Installation de Wikiwig
-----------------------
    - copier le contenu du dossier /wikiwig/ dans un r�pertoire de votre serveur Web.
    - ouvrez un navigateur Web et allez dans le dossier Wikiwig, ex: http://localhost/wikiwig/
      (si vous ne voyez qu'une liste de fichiers et de r�pertoires, rajoutez index.php dans l'url, ex:  http://localhost/wikiwig/index.php)
    - Vous devriez �tre � pr�sent sur la page de configuration. 
      (Sinon, tapez dans l'url : http://localhost/wikiwig/_wk/setup/)

Mises � jour de Wikiwig
-----------------------
    depuis une version 3
    ---------------------
    - Supprimer le r�pertoire _wk.
      Attention: ne supprimez pas les pages html que vous avez �crites avec votre Wiki.
    - Suivez le processus d'installation (au-dessus)
    - Dans la partie administration (/_wk/wk_admin.php), lancez "Parser toutes les pages" en cliquant dessus.

    depuis une version 2 ou 1
    -------------------------
    Aucun mise � jour n'est possible, l'application ayant fondamentalement chang�e depuis ces versions.

Configuration de Wikiwig
------------------------
    Premi�re utilisation
    --------------------
     - lancez le script /index.php dans votre navigateur, ex: http://localhost/wikiwig/index.php
     - remplissez le formulaire
    
    Mise � jour
    -----------
        M�thode 1 :
           lancez le script de configuration dans votre navigateur, ex: http://localhost/wikiwig/_wk/setup/
           Note: vous pouvez �galement y acc�der par le menu de la page d'administration (/_wk/wk_admin.php).
        
        M�thode 2 :
            modifier directement le fichier /_wk/wk_config.php (si d�j� install�)

Probl�mes courants
------------------

    Magic_quotes
    ------------
    La version actuelle de WikiWig met par d�faut les magic_quotes � off.
    
    Safe_mode
    ---------
    L'utilisation en safe_mode peut provoquer des erreurs pour la cr�ation, lecture de fichiers, r�pertoires,...
    
    En g�n�ral, la plupart des h�bergeurs gratuits ou des h�bergements sur serveurs mutualis�s configurent les serveurs en safe_mode.
    Si vous avez un doute sur la configuration du serveur que vous utilisez, lancer le script phpinfo.php depuis votre site dans un navigateur
    et cherchez la ligne commen�ant par safe_mode. Les valeurs des colonnes suivantes vous indiquent si vous �tes en safe_mode ou non.
    En r�sum�, si c'est sur On, c'est pas bon et Wikiwig pourrait mal fonctionner.
    
    Chez Free (http://www.free.fr)
    ---------
    WikiWig utilise les sessions de PHP. Vous devez alors cr�er un repertoire "sessions" a la racine de votre ftp, si ce n'est d�j� fait.
        
Notes sur HTMLArea
------------------
HTMLArea est un projet libre sous licence BSD. (voir le fichier license_htmlarea.txt pour plus de d�tails.)
Url du projet : http://dynarch.com/mishoo

Historique du projet
--------------------
Consultez le fichier changelog.txt

Reports de Bugs ou suggestions
------------------------------
Acc�dez � la page du projet sur sourceforge : 
http://sourceforge.net/projects/wikiwig/
puis par le menu, acc�dez soit au gestionnaire de Bugs, aux Forums, ou pour les suggestions aux RFE (Request For Enhancements)

