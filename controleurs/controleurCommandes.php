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
    $donneesCmdVelo = null;

    $commandes = new modeleCommandes();

    if(isset($_GET['details']) && !empty($_GET['details']) && is_numeric($_GET['details'])){

      if($commandes->affichageUneCommande($_GET['details'])){

        $donneesCmdVelo = $commandes->affichageUneCommande($_GET['details']);

      }

    }

    $listeCommandes = $commandes->affichageCommandes();

    $caLpsb = 0;
    foreach ($listeCommandes as $value) {
      $caLpsb += $value['total'];
    }

    $this->Render('../vues/admin/gestion-commandes.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'listeCommandes' => $listeCommandes, 'donneesCmdVelo' => $donneesCmdVelo, 'caLpsb' => $caLpsb));

  }

}
