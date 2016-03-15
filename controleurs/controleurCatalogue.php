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

    $msg['error'] = [];
    $pieces = null;

    $select['type_piece'] = ['disabled' => 'Quel type de pièce recherchez-vous ?', 'null' => 'Toutes les pièces', 'cadre' => 'Cadre', 'roue' => 'Roue', 'selle' => 'Selle', 'guidon' => 'Guidon', 'groupe' => 'Groupe'];

    $select['type_velo'] = ['disabled' => 'Choisissez votre type de vélo', 'both' => 'Les deux', 'route' => 'Route', 'vtt' => 'VTT'];

    $select['taille'] = ['disabled' => 'Rechercher par taille', 'null' => 'Toutes les tailles', 1 => '150/161 cm', 2 => '162/174 cm', 3 => '175/187 cm', 4 => '188/200 cm'];

    $select['sexe'] = ['disabled' => 'Votre piece pour Femme ou Homme', 'null' => 'Femme et Homme', 'homme' => 'Homme', 'femme' => 'Femme'];

    $select['order'] = ['disabled' => 'Classer du plus grand au plus petit', 'null' => 'Aucun classement', 'prix' => 'Prix', 'poids' => 'Poids'];

    $formulaire = new controleurFonctions();
    $stock = new modeleAssemblage();

    if($_POST){

      if(isset($_POST['key'])
      && isset($_POST['type_piece']) && (array_key_exists($_POST['type_piece'], $select['type_piece']) != false)
      && isset($_POST['type_velo']) && (array_key_exists($_POST['type_velo'], $select['type_velo']) != false)
      && isset($_POST['taille']) && (array_key_exists($_POST['taille'], $select['taille']) != false)
      && isset($_POST['sexe']) && (array_key_exists($_POST['sexe'], $select['sexe']) != false)
      && isset($_POST['order']) && (array_key_exists($_POST['order'], $select['order']) != false)){

        $search = (!empty($_POST['key'])) ? htmlentities($_POST['key'], ENT_QUOTES) : null;

        $type_piece = ($_POST['type_piece'] === 'null') ? null : $_POST['type_piece'];

        $type_velo = ($_POST['type_velo'] === 'both') ? null : $_POST['type_velo'];

        $taille = ($_POST['taille'] === 'null') ? null : $_POST['taille'];

        $sexe = ($_POST['sexe'] === 'null') ? null : $_POST['sexe'];

        $order = ($_POST['order'] === 'null') ? null : $_POST['order'];

        $pieces = $stock->toutesPieces($search, $type_piece, $type_velo, $taille, $sexe, $order);

      } else {

        $msg['error']['generale'] = "Une erreur est survenue lors de votre demande.";

      }

    } else {

      $pieces = $stock->toutesPieces();

    }

    $this->Render('../vues/velo/catalogue.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'formulaire' => $formulaire, 'select' => $select, 'pieces' => $pieces));

  }

}
