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

    $donneesStocks = new modeleStocks();

    if($_POST){

      $donneesStocks->updateQuantitePiece($_POST['quantite'], $_POST['id_piece']);

      $msg['error']['confirm'] = 'Une quantité de '.$_POST['quantite'].' a été ajouté à la piece '.$_POST['id_piece'].'.';

    }

    $donnesParPiece['cadres'] = $donneesStocks->recupPieces('cadre');
    $donnesParPiece['roues'] = $donneesStocks->recupPieces('roue');

    $this->Render('../vues/admin/gestion-stocks.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'donnesParPiece' => $donnesParPiece));

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
    $select['type_piece'] = ['disabled' => 'Choisissez votre type de pièce à ajouter', 'cadre' => 'Cadre', 'roue' => 'Roue', 'selle' => 'Selle', 'guidon' => 'Guidon', 'groupe' => 'Groupe'];
    // Vélos
    $select['type_velo'] = ['disabled' => 'Type de vélo de votre nouvelle pièce', 'route' => 'Route', 'vtt' => 'VTT'];
    // Tailles
    $select['taille'] = ['disabled' => 'Taille du cadre', 1 => '150/161 cm', 2 => '162/174 cm', 3 => '175/187 cm', 4 => '188/200 cm'];
    // Matiere
    $select['matiere'] = ['disabled' => 'Matière du cadre', 'alluminium' => 'Alluminium', 'cabone' => 'Carbone', 'metal' => 'Metal'];
    // Sexe
    $select['sexe'] = ['disabled' => 'Cadre pour homme ou femme', 'homme' => 'Homme', 'femme' => 'Femme'];
    // Pignon
    $select['pignon'] = ['disabled' => 'Dents du grand Pignon', 16 => '16', 24 => '24', 32 => '32'];
    // Plateau
    $select['plateau'] = ['disabled' => 'Dents du grand Plateau', 56 => '56', 76 => '76'];

    if(isset($_GET['piece']) && !empty($_GET['piece'])
    && (array_key_exists($_GET['piece'], $select['type_piece']) != false)){

      switch ($_GET['piece']) {
        case 'cadre':
          $dataGet['piece'] = 'cadre';
        break;
        case 'roue':
          $dataGet['piece'] = 'roue';
        break;
        case 'selle':
          $dataGet['piece'] = 'selle';
        break;
        case 'guidon':
          $dataGet['piece'] = 'guidon';
        break;
        case 'groupe':
          $dataGet['piece'] = 'groupe';
        break;
      }

      if($_POST){

        if(isset($_POST['type_piece']) && (array_key_exists($_POST['type_piece'], $select['type_piece']) != false)
        && isset($_POST['type_velo']) && (array_key_exists($_POST['type_velo'], $select['type_velo']) != false)
        && isset($_POST['titre']) && isset($_POST['quantite']) && isset($_POST['poids'])
        && isset($_POST['prix']) && isset($_POST['description']) && isset($_FILES['img'])){

          $msg = $formulaire->verifFormPiece($_POST, $dataGet['piece']);

          if(empty($msg['error'])){

            $imgBDD = $formulaire->insertPhoto($dataGet['piece']);

            foreach ($_POST as $key => $value){
              $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
            }

            extract($_POST);

            switch ($dataGet['piece']) {
              case 'cadre':
              case 'guidon':

                if(isset($_POST['matiere']) && (array_key_exists($_POST['matiere'], $select['matiere']) != false)
                && isset($_POST['sexe']) && (array_key_exists($_POST['sexe'], $select['sexe']) != false)
                && isset($_POST['id_taille']) && (array_key_exists($_POST['id_taille'], $select['taille']) != false)){

                  $insert = $donneesStocks->insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $imgBDD, $matiere, $sexe, $id_taille);

                } else {
                  $msg['error']['generale'] = self::ERREUR_POST;
                }

              break;
              case 'roue':

                if(isset($_POST['matiere']) && (array_key_exists($_POST['matiere'], $select['matiere']) != false)
                && isset($_POST['id_taille']) && (array_key_exists($_POST['id_taille'], $select['taille']) != false)){

                  $insert = $donneesStocks->insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $imgBDD, $matiere, NULL, $id_taille);

                } else {
                  $msg['error']['generale'] = self::ERREUR_POST;
                }

              break;
              case 'selle':

              if(isset($_POST['sexe']) && (array_key_exists($_POST['sexe'], $select['sexe']) != false)
              && isset($_POST['matiere']) && (array_key_exists($_POST['matiere'], $select['matiere']) != false)){

                $insert = $donneesStocks->insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $imgBDD, $matiere, $sexe);

              } else {
                $msg['error']['generale'] = self::ERREUR_POST;
              }

              break;
              case 'groupe':

              if(isset($_POST['pignon']) && (array_key_exists($_POST['pignon'], $select['pignon']) != false)
              && isset($_POST['plateau']) && (array_key_exists($_POST['plateau'], $select['plateau']) != false)){

                $insert = $donneesStocks->insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $imgBDD, NULL, NULL, NULL, $pignon, $plateau);

              } else {
                $msg['error']['generale'] = self::ERREUR_POST;
              }
              break;
            }
            if($insert){
              $msg['error']['confirm'] = 'Votre nouvelle pièce de type "'.ucfirst($dataGet['piece']).'" a bien été ajouté dans nos stocks avec une quantité de '.$quantite.'.';
            }
          }
        } else {

          $msg['error']['generale'] = self::ERREUR_POST;

        }
      }
    }


    $this->Render('../vues/admin/ajout-reference.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire, 'dataGet' => $dataGet, 'select' => $select));

  }

}
