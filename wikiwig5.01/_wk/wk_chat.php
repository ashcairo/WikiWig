<?php

  require_once 'wk_config.php';
  require_once 'lib/Wiki_DB.php';

  session_start();

  switch ($_GET['a']) {
    case enregistrement:
       if (isset($_POST['chat'])) {
         $db=Wiki_DB::getInstance();
         $requeteAffiche= "SELECT * FROM ".Wiki::getConfig('table_pages').
                          " WHERE pages_utilisateur = '{$_GET['name']}' AND pages_temps >'0'";
         $resAffiche=$db->query($requeteAffiche);

         $txt = addslashes($resAffiche[0]['pages_nom'].'//-//'.$_POST['chat'].'__'. $_GET['emetteur']);
         $requete= "UPDATE ".Wiki::getConfig('table_pages').
                   " SET pages_nom = '{$txt}' WHERE pages_utilisateur = '{$_GET['name']}' AND pages_temps >'0'";
         $res=$db->query($requete);
         $insert= "INSERT INTO ".Wiki::getConfig('table_pages').  " ( pages_nom , pages_temps , pages_utilisateur )" .
                   " VALUES ('ACCUSER-/Envoie d\'un message', '0', '".$_SESSION['user_name']."') ";
         $resultInsert=$db->query($insert);
       }

       if (isset($_POST['chatReponse'])) {
         $db=Wiki_DB::getInstance();

         $txt = addslashes('ACCUSER-REP//-//'.$_POST['chatReponse']);
         $requete="INSERT INTO ".Wiki::getConfig('table_pages')." (pages_nom, pages_utilisateur) VALUES ('{$txt}', '{$_GET['name']}') ";
         $res=$db->query($requete);

         $insert= "INSERT INTO ".Wiki::getConfig('table_pages')."  ( pages_nom , pages_temps , pages_utilisateur )  " .
                  "VALUES ('ACCUSER-/Envoie d\'un message', '0', '".$_SESSION['user_name']."') ";
         $resultInsert=$db->query($insert);
       }

       echo "<script>";
       echo " function ferme(){";
       echo "  window.close();";
       echo " }";
       echo " ferme();";
       echo "</script>";

       break;

    case ajax:
      $db=Wiki_DB::getInstance();
      $requete= "SELECT * FROM ".Wiki::getConfig('table_pages').
                 " WHERE pages_utilisateur = '{$_SESSION['user_name']}'AND pages_temps >'0' ";
      $res=$db->query($requete);
      $resA = $res[0]['pages_nom'];
      $mes = split('//-//', $resA);
      $emet = split ('__', $mes[1]);

      if (isset($mes[1])) {
        echo "code=1,".$emet[1] ."<br/><br/>" . $emet[0];
      } else {
        echo "code=2";
      }

      break;
    case form:
      $form.="<body><head>";
      $form.="<link href='wk_style.css' rel='stylesheet' type='text/css'>";
      $form.="</head><html>";

      $form.="<div id='header'>";
      $form.="Laisser un message à ' {$_GET['name']} ' qui modifie la page ' {$_GET['page']} ' <br/><br/>";
      // To leave a message with ' NAME ' who is editing the page ' 
      $form.="</div>";

      $form.="<div class='formChat'>";
      $form.="<form action='wk_chat.php?a=enregistrement&name={$_GET['name']}&page={$_GET['page']}&emetteur={$_GET['emetteur']}' method='POST'>";
      // Message to send
      $form.= "Message à lui faire passer<br/>";
      $form.="<textarea name='chat' cols='30' rows='5'></textarea><br/><br/>";
      $form.= "<input type='submit'/>";
      $form.="</form>";
      $form.="</div>";
      echo $form;
      break;

    case ajaxReponse:
      $db=Wiki_DB::getInstance();
      $requete="SELECT * FROM ".Wiki::getConfig('table_pages')." WHERE pages_utilisateur = '{$_SESSION['user_name']}'";
      $res=$db->query($requete);
      $resA = $res[0]['pages_nom'];
      $mes = split('//-//', $resA);
      $emet = split ('__', $mes[1]);

      $requeteRep="SELECT * FROM ".Wiki::getConfig('table_users')." WHERE login = '{$emet[1]}'";
      $resRep=$db->query($requeteRep);
      $resARep = $resRep[0]['pages_nom'];
      $mesRep = split('//-//', $resARep);
      $emetRep = split ('__', $mesRep[1]);

      if (isset($mesRep[1])) {
        echo "code=1,".$emetRep[1] ."<br/>";
      } else {
        echo "code=2";
      }

      break;

    case repondre:
      $nom = split('<br/>', $_GET['message1']);

      $form.="<body><head>";
      $form.="<link href='wk_style.css' rel='stylesheet' type='text/css'>";
      $form.="</head><html>";
      $form.="<div id='header'>";
      $form.="Repondre au message' {$_GET['message1']} ' <br/><br/>";
      $form.="</div>";
      $form.="<div class='formChat'>";
      $form.="<form action='wk_chat.php?a=enregistrement&name={$nom[0]}' method='POST'>";
      $form.= "NOM = ".$nom[0];
      $form.= "Répondre au message<br/>";
      $form.="<textarea name='chatReponse' cols='30' rows='5'></textarea><br/><br/>";
      $form.= "<input type='submit'/>";
      $form.="</form>";
      $form.="</div>";
      $form.="</html></body>";
      echo $form;
      break;

    case effaceBD:
      $db=Wiki_DB::getInstance();
      $requete="SELECT * FROM ".Wiki::getConfig('table_pages')." WHERE pages_utilisateur = '{$_SESSION['user_name']}'";
      $res=$db->query($requete);
      $resA = $res[0]['pages_nom'];
      $mes = split('//', $resA);
      $emmeteur = split ('__' , $resA);

      $selectAccuser="SELECT * FROM ".Wiki::getConfig('table_pages')." WHERE pages_nom LIKE '%ACCUSER-/%'";
      $resAcc=$db->query($selectAccuser);
      if ($resAcc[0]['pages_nom']=='ACCUSER-/Envoie d\'un message') {
        $requeteUpAcc= "UPDATE ".Wiki::getConfig('table_pages').
                       " SET pages_nom ='ACCUSER-/Message recu' WHERE pages_utilisateur = '{$emmeteur[1]}'";
        $UpAcc=$db->query($requeteUpAcc);
      } else {
        $deleteAcc="DELETE FROM ".Wiki::getConfig('table_pages').
                    "  WHERE pages_nom ='ACCUSER-/Message recu' AND pages_utilisateur='{$_SESSION['user_name']}'";
        $resDelAcc=$db->query($deleteAcc);
      }

      $requeteUp="UPDATE ".Wiki::getConfig('table_pages').
                 " SET pages_nom = '{$mes[0]}' WHERE pages_utilisateur = '{$_SESSION['user_name']}'";
      $resUp=$db->query($requeteUp);
      echo "<body onLoad=window.close()>";
      echo "";
      echo "</body>";
      break;

    case accuseLu:
      $db=Wiki_DB::getInstance();
      $requete="SELECT * FROM ".Wiki::getConfig('table_pages')." WHERE pages_nom LIKE '%ACCUSER-/%'";
      $res=$db->query($requete);

      if ($res[0]['pages_nom']=="ACCUSER-/Message recu") {
        echo "1";
      } else {
        echo "2";
      }
      break;

  }
?>
