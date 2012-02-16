// JavaScript Document
function showLayer(object) {
  if (document.getElementById && document.getElementById(object) != null)
    node = document.getElementById(object).style.visibility='visible';
  else if (document.layers && document.layers[object] != null)
    document.layers[object].visibility = 'visible';
  else if (document.all)
    document.all[object].style.visibility = 'visible';
}

function hideLayer(object) {
  if (document.getElementById && document.getElementById(object) != null)
    node = document.getElementById(object).style.visibility='hidden';
  else if (document.layers && document.layers[object] != null)
    document.layers[object].visibility = 'hidden';
  else if (document.all)
    document.all[object].style.visibility = 'hidden';
}

function changeText(id,chaine) {
  //alert(id+ ' '+chaine);
  if (document.all)
    document.all[id].innerHTML = chaine;
  else if (document.getElementById)
    document.getElementById(id).innerHTML = chaine;
}