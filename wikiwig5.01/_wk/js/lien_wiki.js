insertWikiLink = function(e,id) {

  var editor = e;
  e.focusEditor();
  var outparam = null;
  if (typeof link == "undefined") {
    link = e.getParentElement();
    if (link && !/^a$/i.test(link.tagName)) {
      link = null;
    }
  }
  if (!link) {
    var sel = editor._getSelection();
    var range = editor._createRange(sel);
    var compare = 0;
    if (Xinha.is_ie) {
      compare = range.compareEndPoints("StartToEnd", range);
    } else {
      compare = range.compareBoundaryPoints(range.START_TO_END, range);
    }
    if (compare == 0) {
      alert("You need to select some text before creating a link");
      return;
    }
    outparam = { f_href : '' };
  } else
    outparam = { f_href   : Xinha.is_ie ? editor.stripBaseURL(link.href) : link.getAttribute("href") };
    // The ../.. here is because we're down in Xinha/EFM
    e._popupDialog("../../form/liens_wiki.php",
                    function(param) {
                      if (!param)
                        return false;
                      var a = link;
                      if (!a) {
                        try {
                          editor._doc.execCommand("createlink", false, param.f_href);
                          a = editor.getParentElement();
                          var sel = editor._getSelection();
                          var range = editor._createRange(sel);
                          if (!Xinha.is_ie) {
                            a = range.startContainer;
                            if (!/^a$/i.test(a.tagName)) {
                              a = a.nextSibling;
                              if (a == null) {
                                a = range.startContainer.parentNode;
                              }
                            }
                          }
                        } catch(e) {}
                      } else {
                        var href = param.f_href.trim();
                        editor.selectNodeContents(a);
                        if (href == "") {
                          editor._doc.execCommand("unlink", false, null);
                          editor.updateToolbar();
                          return false;
                        } else {
                          a.href = href;
                        }
                      }
                      if (!(a && /^a$/i.test(a.tagName))) {
                        return false;
                      }
                      //a.title = param.f_title.trim();
                      editor.selectNodeContents(a);
                      editor.updateToolbar();
                    },
                    outparam);
};
