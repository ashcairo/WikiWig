// JavaScript Document

// WARNING: using this interface to load plugin
// will _NOT_ work if plugins do not have the language
// loaded by Xinha.

// In other words, this function generates SCRIPT tags
// that load the plugin and the language file, based on the
// global variable HTMLArea.I18N.lang (defined in the lang file,
// in our case "lang/en.js" loaded above).

xinha_editors = null;
xinha_init    = null;
xinha_config  = null;
xinha_plugins = null;

// This contains the names of textareas we will make into Xinha editors
xinha_init = xinha_init ? xinha_init : function() {
  /** STEP 1 ***************************************************************
   * First, what are the plugins you will be using in the editors on this
   * page.  List all the plugins you will need, even if not all the editors
   * will use all the plugins.
   *
   * The list of plugins below is a good starting point, but if you prefer
   * a must simpler editor to start with then you can use the following 
   * 
   * xinha_plugins = xinha_plugins ? xinha_plugins : [ ];
   *
   * which will load no extra plugins at all.
   ************************************************************************/

  xinha_plugins = xinha_plugins ? xinha_plugins :
  [
   'CharacterMap',
   'ContextMenu',
   'InsertAnchor',
   'ListType',
   'SpellChecker',
   'Stylist',
   'SuperClean',
   'TableOperations',
   'ExtendedFileManager',
   'InsertMarquee'
  ];
	 // THIS BIT OF JAVASCRIPT LOADS THE PLUGINS, NO TOUCHING  :)
  if(!Xinha.loadPlugins(xinha_plugins, xinha_init)) return;

  /** STEP 2 ***************************************************************
   * Now, what are the names of the textareas you will be turning into
   * editors?
   ************************************************************************/

  xinha_editors = xinha_editors ? xinha_editors :
  [
    'wikiwig'
  ];

  /** STEP 3 ***************************************************************
   * We create a default configuration to be used by all the editors.
   * If you wish to configure some of the editors differently this will be
   * done in step 5.
   *
   * If you want to modify the default config you might do something like this.
   *
   *   xinha_config = new Xinha.Config();
   *   xinha_config.width  = '640px';
   *   xinha_config.height = '420px';
   *
   *************************************************************************/

  xinha_config = xinha_config ? xinha_config() : new Xinha.Config();

  /** STEP 4 ***************************************************************
   * We first create editors for the textareas.
   *
   * You can do this in two ways, either
   *
   *   editor   = Xinha.makeEditors(editor, xinha_config, xinha_plugins);
   *
   * if you want all the editor objects to use the same set of plugins, OR;
   *
   *   editor = Xinha.makeEditors(editor, xinha_config);
   *   editor['myTextArea'].registerPlugins(['Stylist','FullScreen']);
   *   editor['anotherOne'].registerPlugins(['CSS','SuperClean']);
   *
   * if you want to use a different set of plugins for one or more of the
   * editors.
   ************************************************************************/


  /** STEP 5 ***************************************************************
   * If you want to change the configuration variables of any of the
   * editors,  this is the place to do that, for example you might want to
   * change the width and height of one of the editors, like this...
   *
   *   editor.myTextArea.config.width  = '640px';
   *   editor.myTextArea.config.height = '480px';
   *
   ************************************************************************/

xinha_config.toolbar = 
  [
    [ "formatblock", "space"],
    [ "fontname", "space"],
    [ "fontsize", "space"],
    [ "bold", "italic", "underline", "strikethrough", "unformat"],
    [ "separator","subscript", "superscript"],

    ["linebreak","separator", "undo","redo","selectall"], (Xinha.is_gecko ? [] : ["cut","copy","paste"]),
    [ "specialpaste"],

    [ "separator", "forecolor", "hilitecolor"],
    [ "separator", "inserttable", "inserthorizontalrule", "datetime"],
    [ "separator", "justifyleft", "justifycenter", "justifyright", "justifyfull"],
    [ "separator", "lefttoright", "righttoleft"],
    [ "linebreak", "separator","orderedlist", "unorderedlist", "outdent", "indent"],
    [ "separator", "insertwikilink", "createlink", "separator", "insertimage", "separator", "htmlmode", "about"]
  ];

  var unformat_caption = "Unformat text"
  var createlink_caption = "Insert a Weblink";
  var specialpaste_caption = "Paste without format";

  xinha_config.ExtendedFileManager.use_linker = true;

  xinha_config.registerButton("unformat",
                              unformat_caption ,
                              "images/removeformat.gif",
                              false,
                              function(editor, id) { editor.execCommand('FormatBlock','','Normal'); editor.execCommand('RemoveFormat'); editor.execCommand('unlink');} );
  xinha_config.registerButton("createlink",
                              createlink_caption ,
                              "images/createlink.gif",
                              false,
                              function(e) {e.execCommand("createlink", true);});
  xinha_config.registerButton("specialpaste",
                               specialpaste_caption ,
                               "Xinha/images/ed_paste.gif",
                               false,
                               function(editor,id) { 
                                 var str = window.clipboardData.getData("Text");
                                  if (str == null) {
                                    alert('\nClipboard is empty.\n\nNothing to paste!');
                                    return;
                                  } else {
                                    editor.execCommand('FormatBlock','','Normal')
                                    editor.execCommand('RemoveFormat');
                                    editor.execCommand('unlink');
                                    //execCommands are necessary in case the user happens to paste some new text to replace selected text.
                                    var myText = showModalDialog(_editor_url + "/popups/plaintext.html","", "resizable: yes; help: no; status: no; scroll: no; ");
                                    if (myText) { editor.insertHTML(unescape( myText) );}
                                  }
                                } // fn(editor,id)
                             ); // registerButton
	
  var datetime_caption = "Insert date and time";
  var insertwikilink_caption = "Insert an internal-to-wiki link";
	
	
  xinha_config.registerButton("datetime",
                              datetime_caption ,
                              "images/date.gif",
                              false,
                              function(e) { e.insertHTML((new Date()).toString()); });

  xinha_config.registerButton("insertwikilink", insertwikilink_caption , "images/ed_link-wiki.gif", false,insertWikiLink );
	
  xinha_config.baseURL = ''; 

  editor   = Xinha.makeEditors(xinha_editors, xinha_config, xinha_plugins);
  // This will get the fn editorLoaded() when Xinha has completed formatting
  // the textarea and we can extract the content as it exists now and not
  // from file we read it from. (Used to determine if Quit really needs to save
  editor['wikiwig'].whenDocReady(editorLoaded);

  xinha_config.killWordOnPaste = true;

  /** STEP 6 ***************************************************************
   * Finally we "start" the editors, this turns the textareas into
   * Xinha editors.
   ************************************************************************/

  Xinha.startEditors(editor);
}

Xinha._addEvent(window,'load', xinha_init); // this executes the xinha_init function on page load 
					    // and does not interfere with window.onload properties set by other scripts

function insertHTML() {
  var html = prompt("Enter some HTML code here");
  if (html) {
    editor.insertHTML(html);
  }
}
function highlight() {
  editor.surroundHTML('<span style="background-color: yellow">', '</span>');
}
