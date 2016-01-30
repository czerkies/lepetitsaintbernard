<?php

/**
* Cette classe controle les page single.
*
*/
class controleurSingle extends controleurSuper {

  /**
  * Affichage de la page d'accueil
  *
  */
  public function singleAccueil(){

    session_start();
    $meta['title'] = 'Accueil';
    $meta['menu'] = 1;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $this->Render('../vues/single/accueil.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
