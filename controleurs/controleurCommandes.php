<?php

/**
* Class controleurCommandes controle la page des commandes admin
*/
class controleurCommandes extends controleurSuper {

  /**
  * La fonction gestion des commandes controle la page des commandes
  *
  */
  public function gestionCommandes(){

    session_start();
    $meta['title'] = 'Commandes de vélo';
    $meta['menu'] = 'gestion-commandes';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = [];

    $commandes = new modeleCommandes();

    $listeCommandes = $commandes->affichageCommandes();

    $this->Render('../vues/admin/gestion-commandes.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'listeCommandes' => $listeCommandes));

  }

}
