////////////////////////////////////
///////   CHAT AJAX          ///////
/////// Author melie_melo    ///////
////////////////////////////////////


//fonction commune

function writediv(texte){
  header=document.getElementById("header");
  Madiv=document.createElement("div");
  header.appendChild(Madiv);
  Madiv.setAttribute("id", "message");

 document.getElementById('message').innerHTML = texte;
}

function file(fichier){
  if (window.XMLHttpRequest) { // FIREFOX
    xhr_object = new XMLHttpRequest();
  } else if (window.ActiveXObject){ // IE
    xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
  } else {
    return(false);
  }
  xhr_object.open("GET", fichier, false);
  xhr_object.send(null);
  if (xhr_object.readyState == 4){
    return(xhr_object.responseText);
  } else {
    return(false);
  }
}

function effacediv(){
  txt=document.getElementById('message');
  txt.removeChild(txt.firstChild);
  txt.style.visibility='hidden';
}

function effaceBD(){
  window.open('wk_chat.php?a=effaceBD', 'repondre','top=1024, left=1024, height=1, width=1');
}

function OK(){
  effacediv();
  effaceBD();
}

//Envoie du message
function verifMes(mes){
  if (mes != ''){
    if (texte = file('wk_chat.php?a=ajax&mes='+escape(mes))){
      if (texte.indexOf("code=1") != -1){
        writediv('Message de <span style="color:#cc0000"><b>'+ 
                  getMessage(texte) +
                  ' </b><br/><br/><input type=button value="OK" onClick="OK();"/> <input type=button value="répondre" onClick="repondre(getMessage(texte));"/></span><div>');
      } else if (texte==2){
        alert("rien");
        //writediv(' rien mais rien de chez rien');
      } else {
        writediv(texte);
      }
    }
  }
}


function repondre(mes1){
  effacediv();
  effaceBD();
  window.open('wk_chat.php?a=repondre&message1='+mes1, 'repondre','top=200,left=200, height=300,width=500');
}

function getMessage(msg){
  indice_msg = 1 + msg.indexOf(",");
  return msg.substr(indice_msg,msg.length - indice_msg ) ;
}

//Reponse et accusé au message
function verifMesRep(mes){
  if (mes != ''){
    if (texte = file('wk_chat.php?a=accuseLu&mes='+escape(mes))){
      if (texte == 1){
        writediv('<div id="message"><span style="color:#cc0000"><b>Message lu</b><br/> <input type=button value="OK" onClick="OK();"/></span><div>');
      } else if (texte==2){
        writediv('<div id="message">Message pas lu <input type=button value="OK" onClick="effacediv();"/></div>');
      } else {
        writediv(texte);
      }
    }
  }
}