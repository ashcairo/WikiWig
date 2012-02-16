<?php
  /***********************************************
  *  Class : Protect
  *  Autor : Melie-Melo
  *  Date : nov 2005
  ************************************************/

  if (!isset($_SESSION)) {
    session_start();
  }

  require_once dirname(__FILE__).'/lib/Wiki.php';
  require_once dirname(__FILE__).'/lib/Wiki_User.php';
  require_once dirname(__FILE__).'/lib/Wiki_DB.php';

  Class Protect{

    /*Donnée membre */
    var $nomPage="";
    var $protection="";
    var $nomUtilisateur="";
    var $droit="";

    /*construteur*/
    function Protect($namePage){
      $this->nomPage=$namePage;
      $this->protection="PROTECT-/".$this->nomPage; //nom de la page proteger
      $this->nomUtilisateur=$_SESSION['user_name'];
      $this->droit=array(0,1,2);
    }

    /*Method*/

    function affichage($page, $i){ // affichage => posting?
      //montrer les liens si c'est admin ou simple utilisateur
      //si c'est admin montrer le form d'insertion des droits (ecriture et lecture)
      // to show the locks if it is admin or simple user
      // if it is admin to show the form insertion of the rights (writing and reading)

      $user = Wiki_User::findByUserName($this->nomUtilisateur);

      $tab = "";
      if (is_object($user) && $user->privileged()) {

        $tab .= "<input type='hidden' name='page[$i]' value='{$page}'/>";

        // Look up page in database to see if locked

        $db=Wiki_DB::getInstance();
        $requete="SELECT * FROM ".Wiki::getConfig('table_pages')." WHERE pages_nom LIKE 'PROTECT-/{$page}'";
        $res=$db->query($requete);

        //tant que la $page existe boucle
        // as long as the $page exists loop

        $pre="PROTECT-/";
        $un=$this->protection."_/1";
        $deux=$this->protection."_/2";

        $locked = false;
        if (count($res) > 0 ) {
          $nomPage=split('-/',$res[0]['pages_nom']);
          $locked = $nomPage[1]== $page;
        }

        if ($locked) {
          //_2 = pas lecture ni ecriture => not reading or writing
          //_1 = pas ecriture => not writing

          if ($res[0]['pages_temps'] ==1){
            // error_log("1", 0);
            $tab .= "<td class='celWR'>";
            $tab .= "<input type='checkbox'  name='Prot[{$deux}]' value='{$this->protection}_/2' class='check' />";
            // $tab .= "<img src='images/cadenas.gif' alt='Verrouiller en lecture' title='Verrouiller en lecture'/>";
            $tab .= "</td>";
            $tab .= "<td class='celWR'>";
            $tab .= "<input type='checkbox'  name='Prot[{$un}]' value='{$this->protection}_/1' class='check' checked='checked'/>";
            $tab .= "<img src='images/cadenas.gif' alt='Verrouiller en ecriture' title='Verrouiller en ecriture'/>";
            $tab .= "</td>";
            // echo ">".$lecture['$this->protection']."<><br/>";
          } else if($res[0]['pages_temps'] ==2) {
            // error_log("2", 0);
            $tab .= "<td class='celWR'>";
            $tab .= "<input type='checkbox' name='Prot[{$deux}]' value='{$this->protection}_/2' class='check'checked='checked' />";
            $tab .= "<img src='images/cadenas.gif' alt='Verrouiller en lecture' title='Verrouiller en lecture'/>";
            // Verrouiller en lecture => To lock in reading
            $tab .= "</td>";
            $tab .= "<td class='celWR'>";
            $tab .= "<input type='checkbox'  name='Prot[{$un}]' value='{$this->protection}_/1' class='check' checked='checked'/>";
            $tab .= "<img src='images/cadenas.gif' alt='Verrouiller en ecriture' title='Verrouiller en ecriture'/>";
            // Verrouiller en ecriture => To lock in writing
            $tab .= "</td>";
            // echo ">".$lecture['$this->protection']."<><br/>";
          } else {
            // error_log("3", 0);
            $tab .= "<td class='celWR'>";
            $tab .= "<input type='checkbox' name='Prot[{$deux}]' value='{$this->protection}_/2' class='check' />";
            // $tab .= "<img src='images/cadenas.gif' alt='Verrouiller en lecture' title='Verrouiller en lecture'/>";
            $tab .= "</td>";
            $tab .= "<td class='celWR'>";
            $tab .= "<input type='checkbox'   name='Prot[{$un}]' value='{$this->protection}_/1' class='check' />";
            // $tab .= "<img src='images/cadenas.gif' alt='Verrouiller en ecriture' title='Verrouiller en ecriture'/>";
            $tab .= "</td>";
          }
        } else {
          // error_log("4", 0);
          $tab .= "<td class='celWR'>";
          $tab .= "<input type='checkbox' name='Prot[{$deux}]' value='{$this->protection}_/2' class='check' />";
          // $tab .= "<img src='images/cadenas.gif' alt='Verrouiller en lecture' title='Verrouiller en lecture'/>";
          $tab .= "</td>";
          $tab .= "<td class='celWR'>";
          $tab .= "<input type='checkbox'  name='Prot[{$un}]' value='{$this->protection}_/1' class='check' />";
          // $tab .= "<img src='images/cadenas.gif' alt='Verrouiller en ecriture' title='Verrouiller en ecriture'/>";
          $tab .= "</td>";
          // echo ">".$lecture['$this->protection']."<><br/>";
        }
      }
      return $tab;
    }//end of function affichage
  }
?>
