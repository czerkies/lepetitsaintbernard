<?php

/**
* Class controleurAvis controle les avis
*/
class controleurAvis extends controleurSuper {

  const ERREUR_POST = 'Une erreur est survenue lors de votre demande.';

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

    $avisBDD= new modeleAvis();
    $formulaire = new controleurFonctions();

    if($userConnect){

      if($this->controlePostAvis($_GET['avis'], $_SESSION['membre']['id_membre'])){

        $formulaireAvis = true;

        // Si post, controler les champs, si la commande existe et appartient au bon membre et n'a pas déjà été posté.
        if($_POST){

          if(isset($_POST['id_commande_velo']) && isset($_POST['prenom']) && isset($_POST['avis'])){

            if(empty($_POST['prenom']) || strlen($_POST['prenom']) > 32 || strlen($_POST['prenom']) < 2){
              $msg['error']['prenom'] = "Veuillez donner un <b>pseudo</b> entre 2 et 32 caractères.";
            }

            if(empty($_POST['avis']) || strlen($_POST['avis']) > 4500 || strlen($_POST['avis']) < 10){
              $msg['error']['avis'] = "Veuillez donner votre <b>avis</b> entre 10 et 4500 caractères.";
            }

            if(!$this->controlePostAvis($_POST['id_commande_velo'], $_SESSION['membre']['id_membre'])){
              $msg['error']['general'] = self::ERREUR_POST;
            }

            if(empty($msg['error'])){

              foreach ($_POST as $key => $value){
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
              }

              extract($_POST);

              $avisBDD->insertAvis($id_commande_velo, $_SESSION['membre']['id_membre'], $prenom, $avis);

              $msg['error']['confirm'] = "Merci beaucoup !<br>Votre avis a bien été posté.";

              $formulaireAvis = false;

            }

          } else {
            $msg['error']['general'] = self::ERREUR_POST;
          }

        }

      } else {

        $msg['error']['general'] = "Aucun avis ne peut être laissé sur cette comande de votre part.";

      }
    }

    $this->Render('../vues/membres/ajout-avis.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire, 'formulaireAvis' => $formulaireAvis));

  }

  /**
  * La fonction permet de gérer les avis en ADMIN
  *
  */
  public function gestionAvis(){

    session_start();
    $meta['title'] = 'Gestion des avis';
    $meta['menu'] = 'gestion-avis';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = [];

    $avisBDD= new modeleAvis();
    $formulaire = new controleurFonctions();

    $this->Render('../vues/admin/gestion-avis.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

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
    $avisBDD = new modeleAvis();

    if($concordanceMembreCMD->controleAvisIdCommande($id_commande_velo, $id_membre)){

      if(!$avisBDD->existeAvis($id_commande_velo)){

        return true;

      } else {
        return false;
      }
    } else {
      return false;
    }

  }

}
