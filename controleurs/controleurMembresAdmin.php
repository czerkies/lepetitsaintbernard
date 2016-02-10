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
    $meta['menu'] = 'gestion-membres';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();

    $formulaire = new controleurFonctions();
    $gestionMembres = new modeleMembres();

    if(isset($_GET['supp']) && !empty($_GET['supp']) && is_numeric($_GET['supp'])){

      $id_membre = htmlentities($_GET['supp']);

      if($gestionMembres->suppMembre($id_membre)){

        $msg['error']['confirm'] = "L'utilisateur a bien été supprimé.";

      }

    }

    $listeMembres = $gestionMembres->listeMembres();

    $this->Render('../vues/admin/gestion-membres.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire, 'listeMembres' => $listeMembres));

  }

}
