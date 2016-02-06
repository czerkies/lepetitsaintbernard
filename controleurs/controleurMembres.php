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

    $formulaire = new controleurFonctions();
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

    $this->Render('../vues/membres/connexion.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire));

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

    $formulaire = new controleurFonctions();
    $donneesMembre = new modeleMembres();

    if($_POST){

      if(isset($_POST['email']) && isset($_POST['mdp'])
      && isset($_POST['nom']) && isset($_POST['prenom'])
      && isset($_POST['sexe']) && ($_POST['sexe'] === 'femme' || $_POST['sexe'] === 'homme')
      && isset($_POST['taille']) && isset($_POST['age'])
      && isset($_POST['poids']) && isset($_POST['budget'])
      && isset($_POST['type']) && ($_POST['type'] === 'route' || $_POST['type'] === 'vtt' || $_POST['type'] === 'both')
      && isset($_POST['adresse']) && isset($_POST['cp'])
      && isset($_POST['ville'])) {

        $msg = $formulaire->verifFormMembre($_POST);

        if(empty($msg['error'])){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
          }

          extract($_POST);

          if($donneesMembre->insertMembre($email, $mdp, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville)){

            foreach ($_POST as $key => $value) {
              if($key != 'mdp'){
                $_SESSION['membre'][$key] = $value;
              }
            }

            $_SESSION['membre']['statut'] = 0;

            $userConnect = TRUE;

            $headers = 'Content-Type: text/html; charset=\"UTF-8\";' . "\r\n";
            $headers .= 'FROM: LokiSalle <contact@lokisalle.fr>' . "\r\n";

            $sujet = "Bienvenue chez LokiSalle ".ucfirst($nom)." ".$prenom.".";

            $message = "Bienvenue chez Lokisalle.<br>
            Vous pouvez désormais commander vos salle dans notre catalogue à la page suivante : <a href=\"http://loki-salle.romanczerkies.fr/nos-salles/\">Nos Salles</a>";

            //mail($email, $sujet, $message, $headers);

          }

        }

      } else {
        $msg['error']['generale'] = self::ERREUR_POST;
      }

    }

    $this->Render('../vues/membres/creation-compte.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire));

  }

  /**
  * Gestion du compte d'un membre
  *
  */
  public function gestionCompte(){

    session_start();
    $meta['title'] = 'Mon compte';
    $meta['menu'] = 'mon-compte';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();
    $formulaire = new controleurFonctions();
    $donneesMembre = new modeleMembres();

    if(isset($_POST['maj_informations'])){

      if(isset($_POST['email']) && isset($_POST['mdp'])
      && isset($_POST['nom']) && isset($_POST['prenom'])
      && isset($_POST['sexe']) && ($_POST['sexe'] === 'femme' || $_POST['sexe'] === 'homme')
      && isset($_POST['taille']) && isset($_POST['age'])
      && isset($_POST['poids']) && isset($_POST['budget'])
      && isset($_POST['type']) && ($_POST['type'] === 'route' || $_POST['type'] === 'vtt' || $_POST['type'] === 'both')
      && isset($_POST['adresse']) && isset($_POST['cp'])
      && isset($_POST['ville'])) {

        $idMembre = $_SESSION['membre']['id_membre'];
        $msg = $formulaire->verifFormMembre($_POST, $idMembre);

        if(empty($msg['error'])){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
          }

          extract($_POST);

          if($donneesMembre->updateMembre($email, $mdp, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville, $idMembre)){

            foreach ($_POST as $key => $value) {
              if($key != 'mdp'){
                $_SESSION['membre'][$key] = $value;
              }
            }
          }
        }
      } else {
        $msg['error']['generale'] = self::ERREUR_POST;
      }
    }

    $this->Render('../vues/membres/gestion-compte.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'formulaire' => $formulaire));

  }

  /**
  * Gestion de la page mot de passe oublié
  *
  */
  public function motDePasseOublie(){

    session_start();
    $meta['title'] = 'Mot de passe oublié';
    $meta['menu'] = 'mot-de-passe-oublie';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();
    $formulaire = new controleurFonctions();

    $this->Render('../vues/membres/mot-de-passe-oublie.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'formulaire' => $formulaire));

  }

}
