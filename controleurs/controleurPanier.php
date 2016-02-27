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

      $assemblage = new modeleAssemblage();

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

            $_SESSION['panier'][$idVelo] = array();
            $_SESSION['panier'][$idVelo]['titre'] = $idVelo;
            $_SESSION['panier'][$idVelo]['type_velo'] = $isExist['cadre']['type_velo'];
            $_SESSION['panier'][$idVelo]['sexe'] = $isExist['cadre']['sexe'];
            $_SESSION['panier'][$idVelo]['taille'] = $isExist['cadre']['id_taille'];
            $_SESSION['panier'][$idVelo]['poids'] = $poidsVelo;
            $_SESSION['panier'][$idVelo]['quantite'] = 1;
            $_SESSION['panier'][$idVelo]['prix'] = $prixVelo;

          } else {

            $_SESSION['panier'][$idVelo]['quantite'] += 1;
            $_SESSION['panier'][$idVelo]['prix'] = $prixVelo * $_SESSION['panier'][$idVelo]['quantite'];

          }
        }

        //$donneesPanier = new modeleStocks();

        //foreach ($donneesForSession as $key => $value) {

          //$_SESSION['panier'][$idVelo][$key] = $donneesPanier->recupPieceID($value);
          //$_SESSION['panier'][$idVelo][$key]['ref_velo'] = $idVelo;

        //}

      } else {
        echo 'erreur';
      }

    }

    $this->Render('../vues/velo/panier.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
