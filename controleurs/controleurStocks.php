<?php

/**
* Cette class controle les stocks Admin
*
*/
class controleurStocks extends controleurSuper {

  /**
  * Gestion des stocks
  *
  */
  public function gestionStocks(){

    session_start();
    $meta['title'] = 'Gestion des stocks';
    $meta['menu'] = 'gestion-stocks';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();



    $this->Render('../vues/admin/gestion-stocks.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  /**
  * Fonction pour rajouter une référence
  *
  * @return $this->Render (array)
  */
  public function ajoutReference(){

    session_start();
    $meta['title'] = 'Ajouter une référence';
    $meta['menu'] = 'ajouter-reference';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();



    $this->Render('../vues/admin/ajout-reference.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
