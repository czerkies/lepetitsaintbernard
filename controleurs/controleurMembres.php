<?php

/**
* Cette classe controle les pages membres.
*
*/
class controleurMembres extends controleurSuper {

  const ERREUR_POST = 'Une erreur est survenue lors de votre demande.';

  /**
  * Affichage et controle de la page de connexion
  *
  */
  public function connexionMembre(){

    session_start();
    $meta['title'] = 'Connexion';
    $meta['menu'] = 'connexion';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();

    $connexion = new modeleMembres();

    if($_POST){

      if(isset($_POST['email']) && isset($_POST['mdp'])) {

        if(empty($_POST['email'])){
          $msg['error']['email'] = 'Veuillez saisir votre <b>Email</b>.';
        }
        if(empty($_POST['mdp'])){
          $msg['error']['mdp'] = 'Veuillez saisir votre <b>mot de passe</b>.';
        }

        if(empty($msg['error'])){

          $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
          $mdp = htmlspecialchars($_POST['mdp'], ENT_QUOTES);

          $donnes = $connexion->connexionMembre($email, $mdp);

          if($donnes['email'] === $email && $donnes['mdp'] === $mdp){
            foreach ($donnes as $key => $value) {
              if($key != 'mdp'){
                $_SESSION['membre'][$key] = $value;
              }
              if(isset($_POST['remember'])){
                setCookie('email', $email, time()+(365*24*3600));
              }
            }

            $userConnect = $this->userConnect();
            $userConnectAdmin = $this->userConnectAdmin();

          } else {
            $msg['error']['generale'] = 'Vos identifiants sont incorrects.';
          }
        }
      } else {
        $msg['error']['generale'] = self::ERREUR_POST;
      }
    }

    if($userConnect) {
      if(isset($_GET['deconnexion']) && !empty($_GET['deconnexion']) && $_GET['deconnexion'] === 'true'){
        session_unset();
        $userConnect = FALSE;
        $userConnectAdmin = FALSE;
        $meta['deconnexion'] = TRUE;
      }
    }

    $this->Render('../vues/membres/connexion.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  /**
  * Fonction du controle de la création d'un compte
  *
  */
  public function creationCompte(){

    session_start();
    $msg['error'] = array();
    $meta['title'] = 'Créer son compte';
    $meta['menu'] = 'creer-son-compte';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    if($_POST){

      if(empty($_POST['email'])){
        $msg['error']['email'] = 'Veuillez saisir votre <b>Email</b>.';
      }

    }

    $this->Render('../vues/membres/creation-compte.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }
}
