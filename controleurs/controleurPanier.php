<?php

/**
* La class controleurPanier gère les fonctions de la page panier.
*
*/
class controleurPanier extends controleurSuper {

  /**
  * Controle la page du panier
  *
  * @return (array) $this->render
  */
  public function affichagePanier() {

    session_start();
    $meta['title'] = 'Votre Panier';
    $meta['menu'] = 'votre-panier';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();

    $assemblage = new modeleAssemblage();

    // Si l'ajout d'un vélo est lancé
    if(isset($_GET['cadre']) && !empty($_GET['cadre']) && is_numeric($_GET['cadre'])
    && isset($_GET['roue']) && !empty($_GET['roue']) && is_numeric($_GET['roue'])
    && isset($_GET['selle']) && !empty($_GET['selle']) && is_numeric($_GET['selle'])
    && isset($_GET['guidon']) && !empty($_GET['guidon']) && is_numeric($_GET['guidon'])
    && isset($_GET['groupe']) && !empty($_GET['groupe']) && is_numeric($_GET['groupe'])){

      $donneesForSession = [
        'cadre' => $_GET['cadre'],
        'roue' => $_GET['roue'],
        'selle' => $_GET['selle'],
        'guidon' => $_GET['guidon'],
        'groupe' => $_GET['groupe'],
      ];

      $idVelo = '';
      foreach ($donneesForSession as $key => $value) {
        $idVelo .= $value;
        $isExist[$key] = $assemblage->siExistePieceType($value, $key);
      }

      if(!array_search(0, $isExist)){

        $poidsVelo = 0;
        $prixVelo = 0;

        foreach ($isExist as $key => $value) {
          $samePiece[] = ($isExist['cadre']['type_velo'] === $isExist[$key]['type_velo']
          || $isExist[$key]['type_velo'] == null) ? true : false;
          $samePiece[] = ($isExist['cadre']['id_taille'] === $isExist[$key]['id_taille']
          || $isExist[$key]['id_taille'] == null) ? true : false;
          $samePiece[] = ($isExist['cadre']['sexe'] === $isExist[$key]['sexe']
          || $isExist[$key]['sexe'] == null) ? true : false;

          $poidsVelo += $isExist[$key]['poids'];
          $prixVelo += $isExist[$key]['prix'];
        }

        if(!array_search(false, $samePiece)){

          if(!isset($_SESSION['panier'][$idVelo])){

              $_SESSION['panier'][$idVelo] = [];
              $_SESSION['panier'][$idVelo]['type_velo'] = $isExist['cadre']['type_velo'];
              $_SESSION['panier'][$idVelo]['sexe'] = $isExist['cadre']['sexe'];
              $_SESSION['panier'][$idVelo]['taille'] = $isExist['cadre']['id_taille'];
              $_SESSION['panier'][$idVelo]['poids'] = $poidsVelo;
              $_SESSION['panier'][$idVelo]['quantite'] = 0;
              $_SESSION['panier'][$idVelo]['prix'] = $prixVelo;

              foreach ($donneesForSession as $key => $value) {

                  $_SESSION['panier'][$idVelo]['pieces'][$key] = $value;

              }

              $_SESSION['panier'][$idVelo]['quantite'] = ($this->verifQuantiteAvantMaj($idVelo)) ? 1 : 0;

              //if(!$this->verifQuantiteAvantMaj($idVelo)) unset($_SESSION['panier'][$idVelo]);

          } else {

            $this->verifQuantiteAvantMaj($idVelo);

          }
        }

      } else {
        echo 'erreur';
      }

    }

    // Si suppresion panier ou vélo
    if(isset($_SESSION['panier']) && isset($_GET['supp_velo']) && !empty($_GET['supp_velo'])){

      if($_GET['supp_velo'] === 'panier'){

        unset($_SESSION['panier']);

      } elseif(is_numeric($_GET['supp_velo'])) {

        if(array_key_exists($_GET['supp_velo'], $_SESSION['panier'])) unset($_SESSION['panier'][$_GET['supp_velo']]);

      }
    }

    // Modification de la quantité
    if(isset($_POST['update_quantite'])){


      // @todo Controle FORM

      $id_velo = htmlentities($_POST['id_velo']);
      $quantite = htmlentities($_POST['quantite']);

      if($quantite > 0) $this->verifQuantiteAvantMaj($id_velo, $quantite);

    }

    $this->Render('../vues/velo/panier.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  /**
  * Vérificatin de stock modif quantite
  *
  * @param (int) $id_velo
  * @param (int) $quantite
  * @return bool
  */
  public function verifQuantiteAvantMaj($id_velo, $quantite = null){

    $assemblage = new modeleAssemblage();

    $newQuantite = (!$quantite) ? 1 : $quantite - $_SESSION['panier'][$id_velo]['quantite'];

    var_dump($newQuantite);

    $piecesQuantite = [];
    $verifQuantite = [];

    foreach ($_SESSION['panier'] as $key => $value) {
      foreach ($_SESSION['panier'][$key]['pieces'] as $piecesKey => $piecesValue) {

        if(array_key_exists($piecesValue, $piecesQuantite)){
          $piecesQuantite[$piecesValue] += (int) $_SESSION['panier'][$key]['quantite'];
        } else {
          $piecesQuantite[$piecesValue] = (int) $_SESSION['panier'][$key]['quantite'];
        }

        if(/*$quantite != null && */$key == $id_velo) $piecesQuantite[$piecesValue] += $newQuantite;

      }
    }

    var_dump($piecesQuantite);

    foreach ($piecesQuantite as $key => $value) {
      $verifQuantite[] = ($assemblage->verifQuantiteMaj($key) < $value) ? null : $key;
    }

    echo '<br>';
    var_dump(array_search(null, $verifQuantite));

    if(array_search(null, $verifQuantite) === false){

      $_SESSION['panier'][$id_velo]['quantite'] += $newQuantite;

      return true;

    } else {

      return false;

    }

  }

}
