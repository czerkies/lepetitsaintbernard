<?php

/**
* Cette class controle les stocks Admin
*
*/
class controleurStocks extends controleurSuper {

  const ERREUR_POST = 'Une erreur est survenue lors de votre demande.';

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
    $formulaire = new controleurFonctions();

    $dataGet = array();

    // Pièces
    $valuesPieces = ['cadre', 'roue', 'selle', 'guidon', 'guidon', 'plateau'];

    // Vélos
    $valuesType = ['route', 'vtt'];

    // Tailles
    $valuesTaille = ['150-161', '162-174', '175-187', '188-200'];

    if(isset($_GET['piece']) && !empty($_GET['piece'])
    && (in_array($_GET['piece'], $valuesPieces) != false)){

      switch ($_GET['piece']) {
        case 'cadre':

          $dataGet['piece'] = 'cadre';

          if($_POST){

            if(isset($_POST['type_piece']) && (in_array($_POST['type_piece'], $valuesPieces) != false)
            && isset($_POST['titre'])
            && isset($_POST['type_velo']) && (in_array($_POST['type_velo'], $valuesType) != false)
            && isset($_POST['poids'])
            && isset($_POST['quantite']) && isset($_POST['description'])
            //&& isset($_POST['img'])
            && isset($_POST['matiere'])
            && isset($_POST['taille']) && (in_array($_POST['taille'], $valuesTaille) != false)) {

              $msg['error']['confirm'] = 'TEST';

            } else {

              $msg['error']['generale'] = self::ERREUR_POST;

            }

          }

          break;

        case 'roue':
        $dataGet['piece'] = 'roue';
          break;
      }

    }


    $this->Render('../vues/admin/ajout-reference.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire, 'dataGet' => $dataGet));

  }

}
