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
    $donneesStocks = new modeleStocks();
    $formulaire = new controleurFonctions();

    $dataGet = array();

    // Pièces
    $select['piece'] = ['disabled' => 'Choisissez votre type de pièce à ajouter', 'cadre' => 'Cadre', 'roue' => 'Roue', 'selle' => 'Selle', 'guidon' => 'Guidon', 'guidon' => 'Guidon', 'plateau' => 'Plateau'];
    // Vélos
    $select['type_velo'] = ['disabled' => 'Type de vélo de votre nouvelle pièce', 'route' => 'Route', 'vtt' => 'VTT'];
    // Tailles
    $select['taille'] = ['disabled' => 'Taille du cadre', 1 => '150/161 cm', 2 => '162/174 cm', 3 => '175/187 cm', 4 => '188/200 cm'];
    // Matiere
    $select['matiere'] = ['disabled' => 'Matière du cadre', 'alluminium' => 'Alluminium', 'cabone' => 'Carbone', 'metal' => 'Metal'];
    // Sexe
    $select['sexe'] = ['disabled' => 'Cadre pour homme ou femme', 'homme' => 'Homme', 'femme' => 'Femme'];

    if(isset($_GET['piece']) && !empty($_GET['piece'])
    && (array_key_exists($_GET['piece'], $select['piece']) != false)){

      switch ($_GET['piece']) {
        case 'cadre':

          $dataGet['piece'] = 'cadre';

          if($_POST){

            if(isset($_POST['type_velo']) && (array_key_exists($_POST['type_velo'], $select['type_velo']) != false)
            && isset($_POST['titre']) && isset($_POST['quantite']) && isset($_POST['poids'])
            && isset($_POST['prix']) && isset($_POST['description']) && isset($_FILES['img'])
            // Controle Cadre
            && isset($_POST['matiere']) && (array_key_exists($_POST['matiere'], $select['matiere']) != false)
            && isset($_POST['sexe']) && (array_key_exists($_POST['sexe'], $select['sexe']) != false)
            && isset($_POST['id_taille']) && (array_key_exists($_POST['id_taille'], $select['taille']) != false)) {

              $msg = $formulaire->verifFormPiece($_POST, $dataGet['piece']);

              if(empty($msg['error'])){

                $imgBDD = $formulaire->insertPhoto($dataGet['piece']);

                foreach ($_POST as $key => $value){
                  $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
                }

                extract($_POST);

                if($donneesStocks->insertPieceCadre($titre, $type_velo, $poids, $prix, $quantite, $description, $imgBDD, $matiere, $sexe, $taille)){

                  $msg['error']['confirm'] = 'Votre nouvelle pièce de type "Cadre" a bien été ajouté dans nos stocks avec une quantité de '.$quantite.'.';

                }
              }
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


    $this->Render('../vues/admin/ajout-reference.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire, 'dataGet' => $dataGet, 'select' => $select));

  }

}
