<?php

/**
* Cette class controle le cattalogue
*
*/
class controleurCatalogue extends controleurSuper {

  /**
  * Affichage de la page cattalogue
  *
  */
  public function pageCatalogue(){

    session_start();
    $meta['title'] = 'Catalogue';
    $meta['menu'] = 'catalogue';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $this->Render('../vues/velo/catalogue.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
