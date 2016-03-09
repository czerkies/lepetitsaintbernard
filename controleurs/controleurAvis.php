<?php

/**
* Class controleurAvis controle les avis
*/
class controleurAvis extends controleurSuper {

  /**
  * La fonction permet de controler et enregistrer l'avis de l'utilisateur.
  *
  */
  public function enregistrementAvis(){

    session_start();
    $meta['title'] = 'Votre avis sur la commande';
    $meta['menu'] = 'panier';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = [];
    $formulaireAvis = false;

    $avis = new modeleAvis();
    $formulaire = new controleurFonctions();

    if($this->controlePostAvis($_GET['avis'], $_SESSION['membre']['id_membre'])){

      $formulaireAvis = true;

      // Si post, controler les champs, si la commande existe et appartient au bon membre et n'a pas déjà été posté.
      
    } else {

      $msg['error']['general'] = "Aucun avis ne peut être laissé sur cette comande de votre part.";

    }

    $this->Render('../vues/membres/ajout-avis.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire, 'formulaireAvis' => $formulaireAvis));

  }

  /**
  * Controle concordance et non existance avis sur CMD
  *
  * @param (int) $id_commande_velo
  * @param (int) $id_membre
  *
  * @return bool
  */
  public function controlePostAvis($id_commande_velo, $id_membre){

    $concordanceMembreCMD = new modeleCommandes();
    $avis = new modeleAvis();

    if($concordanceMembreCMD->controleAvisIdCommande($id_commande_velo, $id_membre)){

      if(!$avis->existeAvis($id_commande_velo, $id_membre)){

        return true;

      }

    }

  }

}
