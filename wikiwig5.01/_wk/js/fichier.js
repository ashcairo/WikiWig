// JavaScript Document
// This is un-used since Xinha EFM
insertFile = function(e,id) {
  var sel = e._getSelection();
  var range = e._createRange(sel);
  var editor = e;       // for nested functions
  var base_url = _editor_url.replace(/Xinha$/, "");
  e._popupDialog(base_url + "popups/InsertFile/filedialog.php",
                function(param) {
                  if (!param) { // user must have pressed Cancel
                        
                    return false;
                  }
                
                  var doc = editor._doc;
                  var alink = doc.createElement("a");
                  var base_url = _editor_url.replace(/Xinha$/, "");
                  var caption = "";
                  if (param["f_addicon"]) {
                    /*
                    var img = doc.createElement("img");
                    img.src = param["f_icon"];
                    img.alt = "icon";
                    alink.appendChild(img);
                    */
                    caption = '<img src="' + base_url + 'popups/InsertFile/' + param["f_icon"] + '" alt="icon" border="0" align="bottom">';
                  }
                  caption = caption + param["f_caption"];
                  if (param["f_addsize"] || param["f_adddate"]) caption = caption + ' (<span style="font-size:60%">';
                  if (param["f_addsize"])caption = caption + param["f_size"];
                  if (param["f_adddate"])caption = caption + ' ' + param["f_date"];
                  if (param["f_addsize"] || param["f_adddate"]) caption = caption + '</span>) ';  
                  alink.href = param["f_url"];
                  alink.innerHTML = caption;              
                  if (Xinha.is_ie) {
                    range.pasteHTML(alink.outerHTML);
                  } else {
                    // insert the table
                    editor.insertNodeAtSelection(alink);
                  }
                  return true;
                },
                null);
        
};
