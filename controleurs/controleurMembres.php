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
    $msg['error'] = '';
    $meta['title'] = 'Connexion';
    $meta['menu'] = 'connexion';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $connexion = new modeleMembres();

    if($_POST){

      if(isset($_POST['email']) && isset($_POST['mdp'])) {

        if(empty($_POST['email'])){
          $msg['error'] .= 'Veuillez saisir un identifiant.<br>';
        }
        if(empty($_POST['mdp'])){
          $msg['error'] .= 'Veuillez saisir un mot de passe.<br>';
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
              if(isset($_POST['sauv_session'])){
                setCookie('email', $email, time()+(365*24*3600));
              }
            }

            $userConnect = $this->userConnect();
            $userConnectAdmin = $this->userConnectAdmin();

          } else {
            $msg['error'] = 'Vos identifiants sont incorrects.';
          }
        }
      } else {
        $msg['error'] = self::ERREUR_POST;
      }
    }

    if($userConnect) {
      if(isset($_GET['deconnexion']) && !empty($_GET['deconnexion']) && $_GET['deconnexion'] === 'true'){
        session_unset();
        $userConnect = FALSE;
        $userConnectAdmin = FALSE;
      }
    }

    $this->Render('../vues/membres/connexion.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
