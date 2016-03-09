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
    $meta['menu'] = 'panier';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();
    $avis = 27746455;

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

          } else {

            $this->verifQuantiteAvantMaj($idVelo);

          }
        }

      } else {
        $msg['error']['generale'] = 'Certains éléments ne correspondent pas pour ajouter votre vélo dans le panier.';
      }

    }

    // Si suppresion panier ou vélo
    if(isset($_SESSION['panier']) && isset($_GET['supp_velo']) && !empty($_GET['supp_velo'])){

      if($_GET['supp_velo'] === 'panier'){

        unset($_SESSION['panier']);
        $msg['error']['confirm'] = 'Votre panier a bien été vidé.';

      } elseif(is_numeric($_GET['supp_velo'])) {

        if(array_key_exists($_GET['supp_velo'], $_SESSION['panier'])) {

          unset($_SESSION['panier'][$_GET['supp_velo']]);
          $msg['error']['confirm'] = 'Votre article a bien été supprimé.';

        }
      }
    }

    // Modification de la quantité
    if(isset($_POST['update_quantite'])){

      if(isset($_POST['id_velo']) && !empty($_POST['id_velo']) && is_numeric($_POST['id_velo'])
      && isset($_POST['quantite']) && !empty($_POST['quantite']) && is_numeric($_POST['quantite'])
      && $_POST['quantite'] >= 0){

        $id_velo = htmlentities($_POST['id_velo']);
        $quantite = htmlentities($_POST['quantite']);

        if($this->verifQuantiteAvantMaj($id_velo, $quantite)){

          $msg['error']['confirm'] = 'Votre quantité a bien été modifié.';

        } else {

          $msg['error']['generale'] = "Votre quantité n'a pas été modifié car il n'y a pas assez de stock.";

        }

      }

    }

    // Total du panier
    $total = 0;
    if(isset($_SESSION['panier'])){
      foreach ($_SESSION['panier'] as $key => $value) {
        $total += $value['quantite'] * $value['prix'];
      }
    }

    // Payer la commande
    if(isset($_SESSION['panier']) && isset($_POST['payer'])){

      if(isset($_POST['cgv'])){

        $commande = new modeleCommandes();
        $formulaire = new controleurFonctions();

        // Controle si stock toujours suffisant
        if($this->verifQuantiteAvantMaj()){

          $msg['error']['confirm'] = "Votre achat a bien été effectué.<br>
          Vous allez recevoir un mail confirmant votre commande.<br><br>
          Merci de laisser un avis sur celle-ci.";

          $id_commande_velo = $_SESSION['membre']['id_membre'].substr(hexdec(uniqid()), 9, 16);

          $commande->insertCommande($id_commande_velo, $total, $_SESSION['membre']['id_membre']);

          foreach ($_SESSION['panier'] as $key => $value) {
            $commande->insertVeloCommande($id_commande_velo, $key, $value['type_velo'], $value['sexe'], $value['prix'], $value['poids'], $value['quantite']);
          }

          $avis = $id_commande_velo;

          //$formulaire->sendMail();

          unset($_SESSION['panier']);

        } else {

          $msg['error']['general'] = "Une des pièces est insufisante dans nos stocks.<br>
          Veuillez vérifier les quantités de votre panier.";

        }

      } else {
        $msg['error']['cgv'] = "Veuillez accepter les conditions gérérales de vente.";
      }

    }

    $this->Render('../vues/velo/panier.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'total' => $total, 'avis' => $avis));

  }

  /**
  * Vérificatin de stock modif quantite
  *
  * @param (int) $id_velo
  * @param (int) $quantite
  * @return bool
  */
  public function verifQuantiteAvantMaj($id_velo = null, $quantite = null){

    $assemblage = new modeleAssemblage();

    $newQuantite = (!$quantite) ? 1 : $quantite - $_SESSION['panier'][$id_velo]['quantite'];

    $piecesQuantite = [];
    $verifQuantite = [];

    foreach ($_SESSION['panier'] as $key => $value) {
      foreach ($_SESSION['panier'][$key]['pieces'] as $piecesKey => $piecesValue) {

        if(array_key_exists($piecesValue, $piecesQuantite)){
          $piecesQuantite[$piecesValue] += (int) $_SESSION['panier'][$key]['quantite'];
        } else {
          $piecesQuantite[$piecesValue] = (int) $_SESSION['panier'][$key]['quantite'];
        }

        if($key == $id_velo) $piecesQuantite[$piecesValue] += $newQuantite;

      }
    }

    foreach ($piecesQuantite as $key => $value) {
      $verifQuantite[] = ($assemblage->verifQuantiteMaj($key) < $value) ? null : $key;
    }

    if(array_search(null, $verifQuantite) === false){

      // Si un id_velo est présent alors MAJ session
      if($id_velo) {

        $_SESSION['panier'][$id_velo]['quantite'] += $newQuantite;

      // Sinon MAJ BDD
      } else {

        $stock = new modeleStocks();

        foreach ($piecesQuantite as $key => $value) {
          $stock->updateQuantitePiece(-$value, $key);
        }

      }

      return true;

    } else {

      return false;

    }

  }

}
