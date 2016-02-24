<?php

/**
* La class controleurFonctions gère les fonctions du site.
*
*/
class controleurAssemblage extends controleurSuper {

  /**
  * Controle la page du vélo personnalisé
  *
  * @return (array) $this->render
  */
  public function veloPerso() {

    session_start();
    $meta['title'] = 'Vélo unique';
    $meta['menu'] = 'votre-velo';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();

    $velos = new modeleAssemblage();

    $veloPerso = (isset($_SESSION['membre'])) ? $velos->veloAssemblage($_SESSION['membre']) : null;

    $this->Render('../vues/velo/velo-perso.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'veloPerso' => $veloPerso));

  }

}
