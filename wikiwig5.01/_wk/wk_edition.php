<?php
  //session
  require 'wk_identification.php';

  require_once 'wk_config.php';
  require_once 'lib/Wiki.php';
  require_once 'lib/Wiki_User.php';

  $redirection_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/wk_liste.php";

  // Retrieving the page name
  if(isset($_GET['page']))
    $page = $_GET['page'];
  elseif(isset($_POST['page']))
    $page = $_POST['page'];
  else {
    header("Location: ".$redirection_url);
    exit();
  }

  // This page_content is as it is from the file and will look differently after the editor (Xinha)
  // formats it. The actual formated content is extracted from the textarea in the fn editorLoaded().

  $page_content = Wiki::readPage($page);
  // Does the page exist and have content?
  if(is_array($page_content)){
    $errors = '- '.implode('<br/>- ',$page_content);
    exit($errors);
    header("Location: ".$redirection_url);
    exit();
  }
  // Put a lock
  $locked = Wiki::lockPage($page);
  if(is_array($locked)){
    // Another user is already editing this page
    $errors=<<<EOT
      <html>
        <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="wk_style.css" rel="stylesheet" type="text/css">
        </head>
      <body>
EOT;
    $errors .= implode('<br/>',$locked);
    $errors .= "</body></html>";

    exit($errors);
  }

  /* // la gestion des couleurs utilisateur ne fonctionne pas
  if(isset($_COOKIE['couleur'])){
    editor._doc.execCommand("forecolor", false, "#"  color);
  }
  */

?>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"-->
<html>
  <head>
    <title><?php echo sprintf(WK_EDITION_TITLE_PAGE,$page); ?></title>

    <link href="wk_style.css" rel="stylesheet" type="text/css">
  </head>

  <script language="JavaScript" src="js/ajaxChat.js"></script>
  <script type="text/javascript">
    function getEditorMode() {
      sessionExpired = false;
      // browser identification
      var agt = navigator.userAgent.toLowerCase();
      var is_ie    = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
      var is_opera  = (agt.indexOf("opera") != -1);
      var is_safari  = (agt.indexOf("khtml") != -1);
      var is_mac         = (agt.indexOf("mac") != -1);
      var is_mac_ie = (is_ie && is_mac);
      var is_win_ie = (is_ie && !is_mac);
      var is_gecko  = (navigator.product == "Gecko") && !is_safari;
      var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
      if (is_ie){
        if(win_ie_ver >= 5.5)
          return 'full';
        else if(win_ie_ver >= 5.0) {
          return 'light'; // htmlarea bad supported => use a lighter editor
        } else
          return 'html_code';
      } else if (is_gecko) {
        if (navigator.productSub < 20021201)
          return 'light'; // htmlarea bad supported => use a lighter editor
        else
          return 'full';
      } else if (is_safari) {
        return 'safari'; // Xinha doesn't support safari
      } else {
        return 'html_code'; // not supported => no editor
      }
    } // getEditorMode
    var editor_mode = getEditorMode();
    if(editor_mode == 'full') {
      _editor_url = "<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/Xinha'; ?>";
      _editor_lang = "<?php echo Wiki::getConfig('lang'); ?>";
      document.write('<scr' + 'ipt src="Xinha/XinhaCore.js" type="text/javascript"></scr' + 'ipt>');
      document.write('<scr' + 'ipt src="js/config_Xinha.js" type="text/javascript"></scr' + 'ipt>');
    } else {
      //document.write('<scr'+'ipt language="JavaScript" type="text/javascript" src="wysiwyg/conceptRTE/conceptRTE.js"> </scr'+'ipt>');
      document.write('<scr'+'ipt language="JavaScript" type="text/javascript" src="wysiwyg/rte/richtext.js"></scr'+'ipt>');
      var str = '<?php echo str_replace("'","\\'",WK_EDITION_WARNING_OLD_BROWSER);?>';
      if (editor_mode == 'safari') {
        str = '<b><?php echo str_replace("'","\\'",WK_EDITION_WARNING_SAFARI_BROWSER);?></b>';
      }
      document.write(str);
    }
  </script>

  <script type="text/javascript" src="js/fichier.js"></script>
  <script type="text/javascript" src="js/lien_wiki.js"></script>
  <script language="JavaScript" src="js/domUtils.js"></script>
  <script language="JavaScript" src="js/tools.js"></script>

  <script type="text/javascript">
    var EDIT_MAX_TIME = <?php echo Wiki::getConfig('editionMaxTime'); ?>;
    var t = <?php echo Wiki::getConfig('editionMaxTime'); ?>;
    var latence = <?php echo Wiki::getConfig('editionWarningTime'); ?>;

    function checkEditionTime() {
      if(t!=0) {
        t--;
        if(t == latence ) {
          chaine = '<p><?php echo sprintf(str_replace("'","\\'",WK_EDITION_MESSAGE_SESSION_WARNING),Wiki::getConfig('editionWarningTime'),(Wiki::getConfig('editionMaxTime')/60)); ?></p>';
          chaine+= '<p><a onclick="editorSave();" href="#"><?php echo WK_EDITION_ACTION_SAVE; ?></a> | ';
          chaine+= '| <a onclick="hideLayer(\'popup\')" href="#"><?php echo WK_EDITION_CLOSE_MESSAGE; ?></a>';
          chaine+= '</p>';
          chaine+= '<p><em><?php echo sprintf(str_replace("'","\\'",WK_EDITION_MESSAGE_SESSION_SYSTEM_INFO),(Wiki::getConfig('editionMaxTime')/60)); ?></em></p>';
          changeText('popup',chaine);
          showLayer('popup');
        }
        changeText('chiffre',t);
        setTimeout("checkEditionTime()",1000);
      } else {
        hideLayer('popup');
        chaine = '<?php echo sprintf(str_replace("'","\\'",WK_EDITION_MESSAGE_SESSION_EXPIRED),(Wiki::getConfig('editionMaxTime')/60)); ?>';
        chaine+= '<p> <a href="wk_liste.php" onclick="ask_to_quit=true;"><?php echo WK_GO_WIKIWIG_MAP; ?></a> ';
        chaine+= '| <a onclick="window.open(\'wk_edition.php?page=<?php echo urlencode($page); ?>\',\'\',\'dependent=yes,width=1000,height=800\');" href="#"><?php echo WK_EDITION_ACTION_REOPEN; ?></a>';
        chaine+= '| <br><a onclick="hideLayer(\'popup\')" href="#"><?php echo WK_EDITION_CLOSE_MESSAGE; ?></a>';
        chaine+= '</p>';
        chaine+= '<p><em><?php echo sprintf(str_replace("'","\\'",WK_EDITION_MESSAGE_SESSION_SYSTEM_INFO),(Wiki::getConfig('editionMaxTime')/60)); ?></em></p>';
        changeText('popup',chaine);
        showLayer('popup');

        changeText('chiffre', '<span style="color:red"><?php echo WK_EDITION_FILE_PERIME; ?></span>');
        sessionExpired=true; //sessionExpired is used to do not show the 'save or quit' menu when quitting the page with lock expired
        unlock();
        id1 = 'editeur';
        id2 = "bt_enregistrer";
        if (document.all) {
          //document.all(id1).disabled = true;
          document.all(id2).style.textDecoration="line-through";
        } else if (document.getElementById) {
          //document.getElementById(id1).disabled = true;
          document.getElementById(id2).style.textDecoration="line-through";
        }
      }
    } // checkEditionTime

    // Variable permettant de savoir si on quitte la page car l'utilisateur a cliqu￩ sur quitter
    var ask_to_quit = false;
    // Variable stockant le contenu de l'￩diteur entre les sauvegardes
    // utilis￩e lorsqu'on quitte la page, pour savoir si le contenu a ￩t￩ sauvegard￩
    // Content of the page before editing (after loading though) so we can detect if editing changed the page (not always accurately)
    var editor_content = '';

    // Page Loading
    ////////////////
    window.onload = function () {
      setBrowser(); // m￩thode basique de d￩tection utilis￩e pour les m￩thodes hideLayer showLayer
      checkEditionTime(); // launches Countdown to warn the user
      editorLoading(); // launches the "waiting during loading" message
      if(editor_mode == 'full') { // Xinha mode
        Xinha.init();
      } else {
        editorLoaded();
      }
    } // window.onload ...
    /**
     * Affiche un message tant que l'￩diteur se charge
     */
    function editorLoading() {
      chaine = "<h2><?php echo  WK_EDITION_MESSAGE_LOADING; ?></h2><h5><?php echo  WK_EDITION_MESSAGE_CACHING; ?></h5><h3><?php echo  WK_EDITION_MESSAGE_PLEASE_WAIT; ?></h3>";
      changeText('popup',chaine);
      showLayer('popup');
    } // editorLoading

    /**
     * Cache le message de chargement, une fois l'￩diteur charg￩
     * cette m￩thode est appel￩ dans le script 'js/config_editeur.js' apr￨s que HTMLArea
     * ait fini son initialisation
     * Hide the editor is loading message once the editor has loaded.
     */
    function editorLoaded() {
      hideLayer('popup');
      if(editor_mode == 'full') { // Xinha mode
        // On initial load get the actual content as Xinha sees it.
        editor_content = editor.wikiwig.getEditorContent();
        if (editor.wikiwig.config.ExtendedFileManager) {
          with (editor.wikiwig.config.ExtendedFileManager) {
<?php
            // define backend configuration for the plugin
            require_once 'Xinha/contrib/php-xinha.php';
            xinha_pass_to_php_backend($IMConfig);
?>
          }
        }
      }
    } // editorLoaded

    // Saving Updates to the editor
    ///////////////////////////////
    function editorSave() {
      if(t != 0) {
        if(editor_mode == 'full') {
          // Ligne suivante necessaire pour un bon envoi du formulaire
          // HTMLArea, ￠ son chargement, red￩finit le gestionnaire d'￩v￨nements "onsubmit" du formulaire
          // on doit ex￩cuter cette m￩thode pour que HTMLArea copie le contenu de la zone ￩diteur
          // dans la variable de formulaire correspondante
          document.forms['editeur'].onsubmit();
        } else if(editor_mode == 'light'){
          editor_content = updateRTE('wikiwig');
        }
        document.forms['editeur'].submit();
        editorSaving(); //affiche la popup sauvegarde en cours
      }
    } // editorSave

    /**
     * Displays saving message
     */
    function editorSaving() {
      save_in_progress = true;
      chaine = "<h2><?php echo  WK_EDITION_MESSAGE_SAVING; ?></h2><h3><?php echo  WK_EDITION_MESSAGE_PLEASE_WAIT; ?></h3>";
      changeText('popup',chaine);
      showLayer('popup');
    } // editorSaving

    /**
     * Called by the iframe of saving
     * Note: The url of this iframe can be found inthe attribute action of the formulaire called "editeur"
     */
    function editorSaved(save_ok) {
      save_in_progress = false;
      if (editor_mode == 'full') {
        editor_content = editor['wikiwig'].getEditorContent();
      }

      hideLayer('popup');
      // restart the edition timer
      t = EDIT_MAX_TIME;
      // check that user wants to quit edition
      if (ask_to_quit) {
        if (!save_ok && confirm('<?php echo WK_EDITION_MESSAGE_ASK_QUIT; ?>')) {
           quit();
        } else {
          quit();
        }
      }
    } // editorSaved

    // Edition ends
    ///////////////////
    var unlock_in_progress = false;
    function quit() {
      ask_to_quit = true;
      // verifies if content has been modified
      if(editor_mode == 'full') {
        editor_saved = (editor_content == editor['wikiwig'].getEditorContent());
      } else if(editor_mode == 'light') {
        editor_saved = (editor_content == updateRTE('wikiwig'));
        //alert(editor_saved +"\nContent: \n"+editor_content+"\nEditor: \n"+updateRTE('wikiwig'));
      } else {
        editor_saved = (editor_content == document.forms['editeur'].wikiwig.value);
      }

      if (sessionExpired == true) { //sessionExpired is used to do not show the 'save or quit' menu when quitting the page with lock expired
        // quitting without saving at all : lock expired
        document.location.href = '<?php echo addslashes(Wiki::getConfig('wkHTTPPath').Wiki_Strings::url_encode(ltrim($page,'/')))."?refresh=".rand(1,9999999); ?>';
      } else {
        if(!editor_saved && confirm("<?php echo WK_EDITION_MESSAGE_ASK_SAVE; ?>")) {
          // launch the save process
          editorSave();
        }
        unlock();
      }

    } // quit
    /**
     * Launches the process of unlocking
     */
    function unlock(){
      unlock_in_progress = true;
      document.forms['unlock'].submit();
    } // unlock

    /**
     * This function is called by the iframe of unlocking
     * when unlocking is complete
     * Note: url of the iframe is the target (look at the "action" attribute) of the form named "unlock"
     *
     * This function redirects the user to the page in reading mode ("normal page")
     */
    function unlocked(){
      unlock_in_progress = false;
      // on rajoute ￠ l'url une variable pour forcer le rechargement du navigateur
      if (sessionExpired==true) {
        // no reload because we would like to keep the page displayed in order to let the guy check if if he will lose anything
      } else {
        // exiting the editing mode for the current page et refreshing the page in read view
        document.location.href = '<?php echo addslashes(Wiki::getConfig('wkHTTPPath').Wiki_Strings::url_encode(ltrim($page,'/')))."?refresh=".rand(1,9999999); ?>';
      }
    } // unlocked
    /**
     * Defines what happens when the user leaves the page
     */
    window.onunload = function() {
      if(!ask_to_quit){
        // l'utilisateur n'a pas cliqu￩ sur quitter
        // (la page est recharg￩e ou chang￩e)
        // on lance la m￩thode pr￩vue pour quitter l'￩dition
        quit();
      }
    } // onunload

     // Javascript errors Catcher
     ////////////////////////////
    window.onerror=fnErrorTrap;

    function fnErrorTrap(sMsg,sUrl,sLine){
      var str = "";
      //str+= "<b>Javascript Error !<br> cette erreur est : </b>";
      str+= "Error: " + sMsg + "<br>";
      str+= "Line: " + sLine + "<br>";
      str+= "URL: " + sUrl + "<br>";
      document.getElementById('oErrorLog').innerHTML = str;
      return false;
    }
    function fnThrow(){
      eval(oErrorCode.value);
    }
  </script>

  <body>

    <div id="header">
      <!-- <div id="message"></div>-->
      Page <?php echo basename($page);    ?>

      <!--chat
        &nbsp;:&nbsp;
        <a id='bt_enregistrer'
           name='bt_enregistrer'
           onclick="verifMes(this.value);editorSave();return false;"
           href="#"><?php echo WK_EDITION_ACTION_SAVE; ?>
         </a>
      -->

      &nbsp;:&nbsp;
      <a id='bt_enregistrer'
         name='bt_enregistrer'
         onclick="editorSave();return false;"
         href="#">
         <?php echo WK_EDITION_ACTION_SAVE; ?>
      </a>

      &nbsp;|&nbsp;
      <a href="#" onclick="quit();return false;"><?php echo WK_EDITION_ACTION_QUIT; ?></a>
      &nbsp;|&nbsp;
      <a href="#" onclick="return false;">

<?php
        // This either gets us a registered user or a guest
        $user = Wiki_User::currentUser();
        if ($user->privileged()) {
          echo "&nbsp;<img src='images/perso_jaune.gif'>" . $user->user_name();
        } else if ($user->is_guest()) {
          echo "&nbsp;<img src='images/perso_gris.gif'>" . $user->user_name();
        } else {
          echo "&nbsp;<img src='images/perso_bleu.gif'>" . $user->user_name();
        }
?>
      </a>
      &nbsp;|&nbsp;<span id="chiffre">0</span>

    </div>

    <div id="popup" name="popup">&nbsp;</div> <!--Div qui permet de faire patienter l'internaute lors de la modification du texte-->
    <div id="logo" style="right:5px;top:5px;">
      <img src="images/logo-petit.gif" />
    </div>

    <div id="formulaire" name="formulaire">
      <form id='editeur' name="editeur" method="post" action="form/wk_enregistrer.php" target="actionframe">
        <script type="text/javascript" language="Javascript">
          editor_content = '<?php echo str_replace(array("'","\n","\r"),array("\\'","",""),$page_content); ?>';
          //alert(editor_content);
          if(editor_mode != 'light') {
            document.write('<textarea name="wikiwig" style="width:100%" cols="80" rows="35" id="wikiwig">'+editor_content+'</textarea>');
          } else {
            //initRTE('wysiwyg/conceptRTE/','wysiwyg/conceptRTE/images/', '', '<?php echo Wiki::getConfig('css_wiki'); ?>', '<?php echo Wiki::getConfig('lang'); ?>');
            initRTE('wysiwyg/rte/images/', 'wysiwyg/rte/', '<?php echo Wiki::getConfig('css_wiki'); ?>', '<?php echo Wiki::getConfig('lang'); ?>');
            writeRichText('wikiwig', '<?php echo str_replace(array("'", "\r", "\n"),array("\\'", "\\r", "\\n"),$page_content); ?>' , '95%', '50%', true, false);
          }
        </script>
        <input name="page" type="hidden" value="<?php echo $page; ?>">
      </form>
      <form id="unlock" name="unlock" method="post" action="form/wk_retirer_lock.php" target="actionframe">
        <input name="page" type="hidden" value="<?php echo $page ?>">
      </form>
    </div>
    <div id="oErrorLog"></div>
    <iframe name="actionframe" src="about:blank" frameborder="0" border="0" style="border:0px;width:200px;height:300px;display:none;"></iframe>
  </body>
</html>
