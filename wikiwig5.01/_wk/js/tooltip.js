var dom = (document.getElementById) ? true : false;
var ns5 = ((navigator.userAgent.indexOf("Gecko")>-1) && dom) ? true: false;
var ie5 = ((navigator.userAgent.indexOf("MSIE")>-1) && dom) ? true : false;
var ns4 = (document.layers && !dom) ? true : false;
var ie4 = (document.all && !dom) ? true : false;
var nodyn = (!ns5 && !ns4 && !ie4 && !ie5) ? true : false;

// resize fix for ns4
var origWidth, origHeight;
if (ns4) {
  origWidth = window.innerWidth; origHeight = window.innerHeight;
  window.onresize = function() { if (window.innerWidth != origWidth || window.innerHeight != origHeight) history.go(0); }
}

// avoid error of passing event object in older browsers
if (nodyn) { event = "nope" }

// settings for tooltip 
var tipFollowMouse= true;	
var tipWidth= 160;
var offX= 20;	// how far from mouse to show tip
var offY= 12; 

var startStr = "<div class='tooltipTitle'>";
var midStr   = "</div><div class='tooltipText'>";
var endStr   = "</div>";


////////////////////////////////////////////////////////////
//  initTip	- initialization for tooltip.
//		Global variables for tooltip. 
//		Set styles for all but ns4. 
//		Set up mousemove capture if tipFollowMouse set true.
////////////////////////////////////////////////////////////
var tooltip, tipcss, collideCheck;
function initTip(colChk) {
    if (nodyn) return;
    tooltip = (ns4)? document.tipDiv.document: (ie4)? document.all['tipDiv']: (ie5||ns5)? document.getElementById('tipDiv'): null;
    tipcss = (ns4)? document.tipDiv: (tooltip) ? tooltip.style : null;
    collideCheck = colChk;
    if (tooltip&&tipFollowMouse) {
      if (ns4) document.captureEvents(Event.MOUSEMOVE);
      document.onmousemove = trackMouse;
    }
}

/////////////////////////////////////////////////
//  doTooltip function
//			Assembles content for tooltip and writes 
//			it to tipDiv
/////////////////////////////////////////////////

var tipOn = false;	// check if over tooltip link

function doTooltip(sTitle,sText,evt) {
  if (!tooltip) return;
  tipOn = true;

  var tip = startStr + sTitle + midStr +  sText + endStr;
  tooltip.innerHTML = tip;

  if (!tipFollowMouse) positionTip(evt);
  else tipcss.visibility='visible';
}

var mouseX, mouseY;
function trackMouse(evt) {
  mouseX = (ns4||ns5)? evt.pageX: window.event.clientX + document.body.scrollLeft;
  mouseY = (ns4||ns5)? evt.pageY: window.event.clientY + document.body.scrollTop;
  if (tipOn) positionTip(evt);
}

/////////////////////////////////////////////////////////////
//  positionTip function
//		If tipFollowMouse set false, so trackMouse function
//		not being used, get position of mouseover event.
//		Calculations use mouseover event position, 
//		offset amounts and tooltip width to position
//		tooltip within window.
/////////////////////////////////////////////////////////////
function positionTip(evt) {
  if (!tipFollowMouse) {
    mouseX = (ns4||ns5)? evt.pageX: window.event.clientX + document.body.scrollLeft;
    mouseY = (ns4||ns5)? evt.pageY: window.event.clientY + document.body.scrollTop;
  }
	
  // tooltip width and height
  var tpWd = (ns4)? tooltip.width: (ie4||ie5)? tooltip.clientWidth: tooltip.offsetWidth;
  var tpHt = (ns4)? tooltip.height: (ie4||ie5)? tooltip.clientHeight: tooltip.offsetHeight;
	
  // document area in view (subtract scrollbar width for ns)
  var winWd = (ns4||ns5)? window.innerWidth-20+window.pageXOffset: document.body.clientWidth+document.body.scrollLeft;
  var winHt = (ns4||ns5)? window.innerHeight-20+window.pageYOffset: document.body.clientHeight+document.body.scrollTop;
      
  // check mouse position against tip and window dimensions
  // and position the tooltip 
	
	
	
  if ((collideCheck) && ((mouseX+offX+tpWd)>winWd) ) 
    tipcss.left = (ns4)? mouseX-(tpWd+offX): mouseX-(tpWd+offX)+"px";
  else 
    tipcss.left = (ns4)? mouseX+offX: mouseX+offX+"px";
	
  if ((collideCheck) && ((mouseY+offY+tpHt)>winHt) ) 
    tipcss.top = (ns4)? winHt-(tpHt+offY): winHt-(tpHt+offY)+"px";
  else
    tipcss.top = (ns4)? mouseY+offY: mouseY+offY+"px";
	
	
  if (!tipFollowMouse) t1=setTimeout("tipcss.visibility='visible'",100);
}

function hideTip() {
  if (!tooltip) return;
  tipcss.visibility='hidden';
  tipOn = false;
}
