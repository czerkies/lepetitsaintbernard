<?php

/**
* Cette class controle les stocks Admin
*
*/
class controleurStocks extends controleurSuper {

  const ERREUR_POST = 'Une erreur est survenue lors de votre demande.';

  /**
  * La fonction listeDetailsPieces liste les éléments de chaque pieces
  *
  * @return $select;
  */
  public function listeDetailsPieces(){

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

    return $select;

  }

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
    $donneesParPiece = array();
    $modifPiece = array();

    $donneesStocks = new modeleStocks();
    $formulaire = new controleurFonctions();
    $select = $this->listeDetailsPieces();

    if($_POST){

      if(isset($_POST['quantite']) && isset($_POST['id_piece'])
      && !empty($_POST['id_piece']) && is_numeric($_POST['id_piece'])) {

        if(empty($_POST['quantite']) && !is_numeric($_POST['quantite'])) {

          $msg['error']['quantite'] = 'Veuillez saisir une <b>quantité</b>.';

        }

        if(empty($msg['error'])){

          $donneesStocks->updateQuantitePiece($_POST['quantite'], $_POST['id_piece']);

          $msg['error']['confirm'] = 'Une quantité de <b>'.$_POST['quantite'].'</b> a été ajouté à la piece <b>'.$_POST['id_piece'].'</b>.';

        }

      } else {

        $msg['error']['generale'] = self::ERREUR_POST;

      }

    }

    if(isset($_GET['idPiece']) && !empty($_GET['idPiece']) && is_numeric($_GET['idPiece'])){

      if($donneesStocks->recupPieceID($_GET['idPiece'])) {

        $modifPiece = $donneesStocks->recupPieceID($_GET['idPiece']);

        if($_POST){

          if(isset($_POST['type_piece']) && (array_key_exists($_POST['type_piece'], $select['type_piece']) != false)
          && isset($_POST['type_velo']) && (array_key_exists($_POST['type_velo'], $select['type_velo']) != false)
          && isset($_POST['titre']) && isset($_POST['quantite']) && isset($_POST['poids'])
          && isset($_POST['prix']) && isset($_POST['description']) && isset($_FILES['img'])){

            $msg = $this->verifFormPiece($_POST, $modifPiece['type_piece']);

            if(empty($msg['error'])){

              $imgBDD = $this->insertPhoto($modifPiece['type_piece']);

              foreach ($_POST as $key => $value){
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
              }

              extract($_POST);

              $this->verifInsertPieces($dataGet, $formulaire);

              if($insert){
                $msg['error']['confirm'] = 'Votre nouvelle pièce de type "'.ucfirst($dataGet['piece']).'" a bien été ajouté dans nos stocks avec une quantité de '.$quantite.'.';
              }
            }
          } else {

            $msg['error']['generale'] = self::ERREUR_POST;

          }
        }

      } else {

        $msg['error']['generale'] = self::ERREUR_POST;

      }

    }

    $donneesParPiece['cadre'] = $donneesStocks->recupPieces('cadre');
    $donneesParPiece['roue'] = $donneesStocks->recupPieces('roue');
    $donneesParPiece['selle'] = $donneesStocks->recupPieces('selle');
    $donneesParPiece['guidon'] = $donneesStocks->recupPieces('guidon');
    $donneesParPiece['groupe'] = $donneesStocks->recupPieces('groupe');

    $this->Render('../vues/admin/gestion-stocks.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'donneesParPiece' => $donneesParPiece, 'modifPiece' => $modifPiece, 'select' => $select, 'formulaire' => $formulaire));

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

    $select = $this->listeDetailsPieces();

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

          $msg = $this->verifFormPiece($_POST, $dataGet['piece']);

          if(empty($msg['error'])){

            $imgBDD = $this->insertPhoto($dataGet['piece']);

            foreach ($_POST as $key => $value){
              $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
            }

            extract($_POST);

            $this->verifInsertPieces($dataGet, $formulaire);

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

  /**
  * Fonction de controle de pieces (modif, ajout)
  *
  * @param $value (array)
  * @param $typePiece (string)
  *
  * @return $msg (array)
  */
  public function verifFormPiece($value, $typePiece = ''){

    $msg = '';

    if(empty($value['titre'])){
      $msg['error']['titre'] = "Veuillez saisir un <b>Titre</b>.";
    } elseif(strlen($value['titre']) > 30 ){
      $msg['error']['titre'] = "Votre <b>Titre</b> ne doit pas dépasser 30 carractères.";
    }

    if(empty($value['poids'])){
      $msg['error']['poids'] = "Veuillez saisir votre <b>Poids</b>.";
    } elseif(!is_numeric($_POST['poids'])) {
      $msg['error']['poids'] = "Veuillez saisir votre <b>Poids</b> en chiffres.";
    } elseif($_POST['poids'] < 10 || $_POST['poids'] > 15000){
      $msg['error']['poids'] = "Veuillez saisir un <b>Poids</b> convenable.";
    }

    if(empty($value['prix'])){
      $msg['error']['prix'] = "Veuillez saisir un <b>Prix</b>.";
    } elseif(!is_numeric($_POST['prix'])) {
      $msg['error']['prix'] = "Veuillez saisir un <b>Prix</b> en chiffres.";
    } elseif($_POST['prix'] < 1 || $_POST['prix'] > 20000){
      $msg['error']['prix'] = "Veuillez saisir un <b>Prix</b> convenable.";
    }

    if(empty($value['quantite'])){
      $msg['error']['quantite'] = "Veuillez saisir votre <b>Quantite</b>.";
    } elseif(!is_numeric($_POST['quantite'])) {
      $msg['error']['quantite'] = "Veuillez saisir votre <b>Quantite</b> en chiffres.";
    } elseif($_POST['quantite'] < 1 || $_POST['quantite'] > 5000){
      $msg['error']['quantite'] = "Veuillez saisir une <b>Quantite</b> convenable.";
    }

    if(empty($value['description'])){
      $msg['error']['description'] = "Veuillez saisir une <b>Description</b>.";
    } elseif(strlen($value['description']) > 250){
      $msg['error']['description'] = "Votre <b>Description</b> ne doit pas dépasser 250 carractères.";
    }

    if(empty($_FILES['img']['name'])){
      $msg['error']['img'] = "Veuillez saisir une <b>Image</b>.";
    }elseif(!$this->verificationPhoto()){
      $msg['error']['img'] = "Veuillez envoyer une <b>Image</b> au format .jpg.";
    }

    return $msg;

  }

  /**
  * Fonction pour controler l'envoie d'une image de piece.
  *
  *
  * @return $verif_extension (bool)
  */
  public function verificationPhoto(){

    $extension = strrchr($_FILES['img']['name'], '.');

    $extension = strtolower(substr($extension, 1));

    $extension_valide = array("jpg", "jpeg");

    return in_array($extension, $extension_valide);

  }

  /**
  * Fonction pour insérer la photo et lien de stockage en BDD.
  *
  * @param $img ($_FILES)
  * @return $photoBDD (string)
  */
  public function insertPhoto($img){

    define('RACINE_SITE_IMG', '/lepetitsaintbernard/www/');
    define('RACINE_SERVER_IMG', $_SERVER['DOCUMENT_ROOT']);

    $nomPhoto = $img.'_'.uniqid().'.jpg';

    $photoDossier = RACINE_SERVER_IMG . RACINE_SITE_IMG . "img/pieces/$nomPhoto";

    copy($_FILES['img']['tmp_name'], $photoDossier);

    $photoBDD = "img/pieces/$nomPhoto";

    return $photoBDD;

  }

  /**
  * Fonction controlant l'insertion d'une piece
  *
  * @param $dataGet, $donneesStocks (array)
  * @return $msg (array)
  */
  public function verifInsertPieces($dataGet, $donneesStocks){

    switch ($dataGet['piece']) {
      case 'cadre':
      case 'guidon':

        if(isset($_POST['matiere']) && (array_key_exists($_POST['matiere'], $select['matiere']) != false)
        && isset($_POST['sexe']) && (array_key_exists($_POST['sexe'], $select['sexe']) != false)
        && isset($_POST['id_taille']) && (array_key_exists($_POST['id_taille'], $select['taille']) != false)){

          $donneesStocks->insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $imgBDD, $matiere, $sexe, $id_taille);

        } else {
          $msg['error']['generale'] = self::ERREUR_POST;
        }

      break;
      case 'roue':

        if(isset($_POST['matiere']) && (array_key_exists($_POST['matiere'], $select['matiere']) != false)
        && isset($_POST['id_taille']) && (array_key_exists($_POST['id_taille'], $select['taille']) != false)){

          $donneesStocks->insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $imgBDD, $matiere, NULL, $id_taille);

        } else {
          $msg['error']['generale'] = self::ERREUR_POST;
        }

      break;
      case 'selle':

      if(isset($_POST['sexe']) && (array_key_exists($_POST['sexe'], $select['sexe']) != false)
      && isset($_POST['matiere']) && (array_key_exists($_POST['matiere'], $select['matiere']) != false)){

        $donneesStocks->insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $imgBDD, $matiere, $sexe);

      } else {
        $msg['error']['generale'] = self::ERREUR_POST;
      }

      break;
      case 'groupe':

      if(isset($_POST['pignon']) && (array_key_exists($_POST['pignon'], $select['pignon']) != false)
      && isset($_POST['plateau']) && (array_key_exists($_POST['plateau'], $select['plateau']) != false)){

        $donneesStocks->insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $imgBDD, NULL, NULL, NULL, $pignon, $plateau);

      } else {
        $msg['error']['generale'] = self::ERREUR_POST;
      }
      break;
    }

    return $msg;

  }

}
