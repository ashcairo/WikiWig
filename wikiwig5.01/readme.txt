README Wikiwig v5
=================

Wikiwig is a Wysiwyg Wiki written for php/mysql.

Features
--------
 - wysiwyg online editor (Xinha)
 - user management
 - lock system to avoid 2 users editing at the same time
 - file management (attachement)
 - image management(upload+online modifications)
 - pages versioning

Requirements
------------
Miminum:
* PHP 4.1 or higher
* MySQL 3.2 or higher

Content
-------
/changelog.txt
/license_htmlarea.txt
/readme.fr.txt
/readme.txt
/version.txt
/wikiwig/_wk/ : application system
/wikiwig/index.php : starting script

Install Wikiwig
---------------
    - copy the content of the folder /wikiwig/ in your web directory.
    - open a browser and go to the web directory of wikiwg, ex: http://localhost/wikiwig/
      (if you see only a listing of the folder, add index.php to the url, ex:  http://localhost/wikiwig/index.php)
    - you should be directed to the setup page. 
      (If not, change the url to http://localhost/wikiwig/_wk/setup/)

Upgrade Wikiwig
---------------

    Upgrading to Version 5.

    The notes below about installing from a version 3 or newer wikiwig are still valid. However with version
    5 the way internal links are handled and the increased security adds a couple of wrinkles.
    With version 5 when you upgrade the setup page is protected and you must login as the admin to access it.
    In addition you'll notice that once the admin is logged in the setup page no longer asks for the admin name,
    password, and email. Those questions will only show up during a new install. In order to change the admin profile
    you now must use the user profile page.

    The way internal links are handled now makes them immune to page renaming or movement in the wiki. However this
    would only be true for newly created links. Previously created pages would still be susceptible to breakage.
    As a result the "Parse all Pages" link on the admin page will re-write internal links to the new form. Please make a
    backup of your wiki before using this page to rewrite your pages. Also the link is no longer called "Parse all pages".
    That page always did a reconstruction of the pages not a simple parse. The link now says "Reconstruct all pages" to
    make that clear.

    Configuring reCaptcha. Version 5 has available two different captcha. On is phpCaptcha and is entirely internal to 
    the wiki. It is a fairly modest captcha. Also available is reCaptcha. This captcha uses a network of servers to produce
    the captcha and to check the solution. In order to use reCaptcha you have to create and account at reCaptcha (free) and
    get a private and public key. If you select reCaptcha as your captcha then the admin page will add a link to allow you
    to configure the wiki with the public and private keys.
    
    In addition to use reCaptch your wiki must have an ip address visible from the internet. Since I don't have a wiki
    with a visible ip address I'm unable to test that reCaptcha actually works. I've tested the key installation page and
    the code on the new login page seems correct but I can't be sure. If you signup for reCaptcha and you try it out
    post feedback on the forum to let others know if it does work.

    Good luck.

    from a version 3 or newer of Wikiwig
    ---------------------------

    This is a short note about upgrading wikiwig to a new version of the
    software. In an ideal world you ought ot be able to simply overlay the software
    in the old installation and just go. Alternatively you might install the new software
    in a new location and copy the wk_config.php file from the older version to the new version
    and just go. Unfortunately at the moment neither of those approaches will work properly.

    Wikiwig does have code to maintain backward compatibility but only will run if you re-execute
    the setup code. So here's a cookbook for upgrading that should always work. In the future 
    it may be a bit simpler.

    For the conservative upgrader:

      1: unzip/untar the new version of wikiwig to a new directory. For clarity lets say the old
	 version of the system code is in ...<old>/_wk and the new version is in ...<new>/_wk

      2: copy the content of the old wiki to the new location of the wiki. In general this means
         copying everything from ...<old>/ to ...<new>/ except for the contents of the system
	 directory ...<old>/_wk. In other words nothing in ...<new>/_wk should be changed by this
	 step.

      3: copy ...<old>/_wk/wk_config.php to ...<new>/_wk/wk_config.php


      3: point your browser to http://<path_to_new_wiki>/_wk/setup/

      4: click on "Check and Save" [ User's should not be accessing the wiki at this point. ]

      5: The wiki should now be functional with the new software. You should be able to verify
         that by examining the pages. Also you can verif by going to the administration board
	 (/_wk/wk_admin.php), launch "Parsing all the pages".

      6: At this point you should have two identical versions of the wiki at the new and the old
         url. If you are now satisfied you can rename the original version to <old.bu> and rename
	 the new version to from <new> to <old>. If you do this rename however you must once again
	 point your browser to the setup page .../_wk/setup and hit check and save so that the config
	 file is made aware of the revised location of the wiki.

    For the truly brave upgrader:

      1: unzip/untar the new version over the old version. 

      2: point your browser to http://<path_to_wiki>/_wk/setup/

      3: click on "Check and Save" [ User's should not be accessing the wiki at this point. ]

      4: The wiki should now be functional with the new software. You should be able to verify
         that by examining the pages. Also you can verif by going to the administration board
	 (/_wk/wk_admin.php), launch "Parsing all the pages".

      5: Note that this approach will leave you with old obsolete code in the _wk directory. For example
         the directory Area which contained the wysiwyg editor htmlarea will stll be present

    For the brave installer that want to be able to remove all the old code after the upgrade. (Recommended)

      1: Rename the current wiki system code directory <path_to_wiki>/_wk to <path_to_wiki>/_wk.old

      2: unzip/untar the new version over the old version. You should now have both a _wk and a _wk.old
         directory at the same point in the directory hierarchy. Copy <path_to_wiki>/_wk.old/wk_config.php
	 to <pth_to_wiki>/_wk/wk_config.php

      3: point your browser to http://<path_to_wiki>/_wk/setup/

      4: click on "Check and Save" [ User's should not be accessing the wiki at this point. ]

      5: The wiki should now be functional with the new software. You should be able to verify
         that by examining the pages. Also you can verif by going to the administration board
	 (/_wk/wk_admin.php), launch "Parsing all the pages".

      6: At this point you can delete the directory _wk.old and remove all the old system code.


    Good luck.
    
    from a version 2 or 1 of Wikiwig
    --------------------------------
    No upgrade can be done. The system of Wikiwig has too deeply changed since those versions.

Configure Wikiwig
-----------------
    First use of wikiwig
    --------------------
     - launch the script /index.php in your browser, ex: http://localhost/wikiwig/index.php
     - fill out the form and save
    
    Update
    ------
        Méthod 1 :
           launch the setup script in your browser, ex: http://localhost/wikiwig/_wk/setup/
           Note: you can access to this script by using the menu in the administration board (/_wk/wk_admin.php).
        
        Méthod 2 :
            edit with your favorite PHP editor the file :  /_wk/wk_config.php

Troubleshooting
---------------
    Magic_quotes
    ------------
    Last version of Wikiwg set automatically magic_quotes to OFF.
    
    Safe_mode
    ---------
    Safe_mode usage can provide errors for creating, reading files or folders,...
    
    How to know if PHP is configured in safe_mode ?
    If your web hosting is free cost or installed on a mutualised Web server, your web directory is surely configured in safe_mode.
    If you don't know what we are talking about or what is your PHP configuration, use the script /phpinfo.php on your server (copy it in a visible directory of the server),
    and view it in a Web browser. You should see a great table representing the configuration of PHP.
    Search the line begining by "safe_mode" and look the values of the following columns.
    If the values are On, your server is running PHP in safe_mode and Wikiwig could badly work.
    If values are Off, PHP is not running in safe_mode and Wikiwig should better work (except maybe a few bugs ;-) ).
    

Project History
---------------
Read the file /changelog.txt

Bugs Reports or suggestions
---------------------------
Go to project page on sourceforge.net : 
http://sourceforge.net/projects/wikiwig/
Use the menu, to access to the Bugs Manager, to Forums, ou for suggestions access to RFE (Request For Enhancements)

