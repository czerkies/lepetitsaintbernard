<?php

/**
* Cette classe controle les membres coté admin.
*
*/
class controleurMembresAdmin extends controleurSuper {

  const ERREUR_POST = 'Une erreur est survenue lors de votre demande.';

  /**
  * Affichage et gestion des membres coté Admin
  *
  */
  public function gestionMembres(){

    session_start();
    $meta['title'] = 'Gestion des membres';
    $meta['menu'] = 'liste-membres';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();

    $gestionMembres = new modeleMembres();

    // Si une demande de suppresion d'un membre est demandé.
    if(isset($_GET['supp']) && !empty($_GET['supp']) && is_numeric($_GET['supp'])){

      $id_membre = htmlentities($_GET['supp']);

      if($gestionMembres->suppMembre($id_membre)){

        $msg['error']['confirm'] = "L'utilisateur a bien été supprimé.";

      }
    }

    $listeMembres = $gestionMembres->listeMembres();

    $this->Render('../vues/admin/gestion-membres.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'listeMembres' => $listeMembres));

  }

  /**
  * Affichage et gestion des membres coté Admin
  *
  */
  public function ajoutAdmin(){

    session_start();
    $meta['title'] = 'Ajouter un administrateur';
    $meta['menu'] = 'ajout-admin';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();

    $formulaire = new controleurFonctions();
    $gestionMembres = new modeleMembres();

    if($_POST){

      if(isset($_POST['email']) && isset($_POST['mdp'])
      && isset($_POST['nom']) && isset($_POST['prenom'])
      && isset($_POST['sexe']) && ($_POST['sexe'] === 'femme' || $_POST['sexe'] === 'homme')
      && isset($_POST['taille']) && isset($_POST['age'])
      && isset($_POST['poids']) && isset($_POST['budget'])
      && isset($_POST['type']) && ($_POST['type'] === 'route' || $_POST['type'] === 'vtt' || $_POST['type'] === 'both')
      && isset($_POST['adresse']) && isset($_POST['cp'])
      && isset($_POST['ville'])) {

        $msg = $formulaire->verifFormMembre($_POST);

        if(empty($msg['error'])){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
          }

          extract($_POST);

          if($gestionMembres->insertMembre($email, $mdp, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville, 1)){

            $msg['error']['confirm'] = ucfirst($prenom).' '.strtoupper($nom)." a bien été ajouté dans la liste des membres";

          }
        }
      }
    }

    $this->Render('../vues/admin/ajout-admin.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire));

  }

}
