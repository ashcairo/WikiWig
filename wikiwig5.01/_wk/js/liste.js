// JavaScript Document
function Montrer( divNum, root ) {
  if (getIdProperty( "s" + divNum, "display") != "block" ) {
    setIdProperty("s" + divNum, "display", "block");
    document.images["i" + divNum].src = root + "/images/open.gif";
      //setIdProperty("i" + divNum,"src", "../images/open.gif");
  } else {
    setIdProperty("s" + divNum, "display", "none");
    document.images["i" + divNum].src = root + "/images/dossier_plus.gif";
  }
} // Montrer

//selection checkbox
function DataTable_Init() {
  g_oDataTable = document.getElementById("datatable");

  if(g_oDataTable) {
    g_oDataTable.SelectAllRows = document.getElementById("selectallrows");
    if(g_oDataTable.SelectAllRows) {
      g_oDataTable.SelectAllRows.onclick = SelectAllRows_Click;
    }

    /*var oMouseOver = function(){this.style.textDecoration = 'underline';}
    var oMouseOut = function(){this.style.textDecoration = 'none';}

    document.getElementById("checkall").onclick = SelectAllRows_Click;
    document.getElementById("checkall").onmouseover = oMouseOver;
    document.getElementById("checkall").onmouseout = oMouseOut;

    document.getElementById("clearall").onclick = SelectAllRows_Click;
    document.getElementById("clearall").onmouseover = oMouseOver;
    document.getElementById("clearall").onmouseout = oMouseOut;*/

    var aRows = g_oDataTable.tBodies[0].rows;
    var nRows = aRows.length-1;
    var aCheckBoxes = new Array();
    var nbCheckboxes = 0;
    for (var i = nRows; i >= 0; i--) {
      if (elem = document.getElementById('Mid['+i+']')) {
        aCheckBoxes[i] = elem;
        aCheckBoxes[i].IsIndex = (aRows[i].className == 'index') ? true : false;
        aCheckBoxes[i].onclick = DataTableCheckBox_Click;
        nbCheckboxes++;
      } else {
        aCheckBoxes[i] = null;
      }
    } // for
    g_oDataTable.CheckBoxes = aCheckBoxes;
    g_oDataTable.nbCheckboxes = nbCheckboxes;
    g_oDataTable.CheckBoxes.NumberChecked = 0;
  } else {
    return false;
  }
} // DataTable_Init

function DataTableCheckBox_Click() {
  var oTR = this.parentNode.parentNode;

  if (this.checked) {
    if(this.IsIndex) {
      oTR.className += ' selected';
    } else {
      oTR.className = 'selected';
    }
    g_oDataTable.CheckBoxes.NumberChecked++;
  } else {
    if(this.IsIndex) {
      oTR.className = 'index';
    } else {
      oTR.className = '';
    }
    g_oDataTable.CheckBoxes.NumberChecked--;
  }

  g_oDataTable.SelectAllRows.checked = (g_oDataTable.CheckBoxes.NumberChecked == g_oDataTable.nbCheckboxes) ? true : false;
} // DataTableCheckBox_Click

function SelectAllRows_Click() {
  var aCheckBoxes = g_oDataTable.CheckBoxes;
  var bChecked = g_oDataTable.SelectAllRows.checked;

  if (this.id == 'clearall' || this.id == 'checkall') {
    bChecked = (this.id == 'clearall') ? false : true;
    g_oDataTable.SelectAllRows.checked = bChecked;
  }

  var aRows = g_oDataTable.tBodies[0].rows;
  var nRows = aRows.length-1;
  if (bChecked) {
    for (var i = nRows; i >= 0; i--) {
      try {
        aCheckBoxes[i].checked = bChecked;
        aRows[i].className = 'selected';
      }catch(e){}
    }
  } else {
    for (var i = nRows; i >= 0; i--) {
      try{
        aCheckBoxes[i].checked = bChecked;
        aRows[i].className = (aCheckBoxes[i].IsIndex) ? 'index' : '';
      }catch(e){}
    }
  }

  g_oDataTable.CheckBoxes.NumberChecked = (bChecked) ? g_oDataTable.nbCheckboxes : 0;
} // SelectAllRows_Click

function Delete_Click() {
  var oForm = document.filelist;
  var bWarnOnDelete = (parseInt(oForm.warnondelete.value) == 1) ? true : false;
  if (bWarnOnDelete && (g_oDataTable.CheckBoxes.NumberChecked == g_oDataTable.CheckBoxes.length)) {
    if (!confirm(oForm.deletemessage.value)) return false;
  }
  oForm.DEL.value = '1';
  oForm.submit();
} // Delete_Click


function init(root) {
  DataTable_Init();
  setBrowser();
  MM_preloadImages(root + "/images/dossier_plus.gif",
                   root + "/images/closed.gif",
                   root +"/images/open.gif");
  initTip(true);
  /*LHCol_Init();*/
  var oDeleteTop = document.getElementById('deletetop');
  if(oDeleteTop) oDeleteTop.onclick = Delete_Click;

  var oDeleteBottom = document.getElementById('deletebottom');
  if(oDeleteBottom) oDeleteBottom.onclick = Delete_Click;

  /*var oSpamTop = document.getElementById('spamtop');
  if(oSpamTop) oSpamTop.onclick = Spam_Click;*/
        } // init()
