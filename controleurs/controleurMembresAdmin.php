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
    $gestionMembres = new modeleMembresAdmin();

    $listeMembres = $gestionMembres->listeMembres();

    $this->Render('../vues/admin/gestion-membres.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire, 'listeMembres' => $listeMembres));

  }

}
