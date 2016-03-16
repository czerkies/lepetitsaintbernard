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

    // Affichage en détails d'un commande
    if(isset($_GET['details']) && !empty($_GET['details']) && is_numeric($_GET['details'])){

      if($commandes->affichageUneCommande($_GET['details'])){

        $donneesCmdVelo = $commandes->affichageUneCommande($_GET['details']);

      }

    }

    // Suppresion d'une commande
    if(isset($_GET['supp']) && !empty($_GET['supp']) && is_numeric($_GET['supp'])){

      $commandes->suppCommande($_GET['supp']);

      $msg['error']['confirm'] = "La commande a bien été supprimé.";

    }

    $listeCommandes = $commandes->affichageCommandes();

    $caLpsb = 0;
    foreach ($listeCommandes as $value) {
      $caLpsb += $value['total'];
    }
    $caLpsbHT = $caLpsb - ($caLpsb * 20 / 100);

    $this->Render('../vues/admin/gestion-commandes.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'listeCommandes' => $listeCommandes, 'donneesCmdVelo' => $donneesCmdVelo, 'caLpsbHT' => $caLpsbHT));

  }

}
