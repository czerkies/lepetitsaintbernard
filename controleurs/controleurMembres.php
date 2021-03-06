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

          $donnees = $connexion->connexionMembre($email, $mdp);

          if($donnees['email'] === $email && $donnees['mdp'] === $mdp){

            foreach ($donnees as $key => $value) {
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

    // Gestion de la deconnexion si userConnect
    if($userConnect) {
      if(isset($_GET['deconnexion']) && !empty($_GET['deconnexion']) && $_GET['deconnexion'] === 'true'){

        unset($_SESSION['membre']);
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
    $meta['menu'] = 'creation-compte';
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

            $donneesBddSession = $donneesMembre->recupToutesDonnees($email);

            foreach ($donneesBddSession as $key => $value) {
              if($key != 'mdp'){
                $_SESSION['membre'][$key] = $value;
              }
            }

            $userConnect = TRUE;

            $message = "Merci de votre inscription ".ucfirst($prenom).",<br>
            Vous pouvez désormais voir votre vélo à la page suivante : <a href=\"http://lepetit-stbernard.romanczerkies.fr/votre-velo/\">Votre Vélo</a>";

            $formulaire->sendMail($email, 'Bienvenue chez Le petit St Bernard', $message);

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
    $donneesCmdVelo = null;

    $formulaire = new controleurFonctions();
    $donneesMembre = new modeleMembres();
    $commandes = new modeleCommandes();

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

            $donneesBddSession = $donneesMembre->recupToutesDonnees($email);

            foreach ($donneesBddSession as $key => $value) {
              if($key != 'mdp'){
                $_SESSION['membre'][$key] = $value;
              }
            }

            $msg['error']['confirm'] = "Vos informations ont été mis à jour.";

          }
        }
      } else {
        $msg['error']['generale'] = self::ERREUR_POST;
      }
    }

    if(isset($_GET['details']) && !empty($_GET['details']) && is_numeric($_GET['details'])){

      if($commandes->affichageUneCommande($_GET['details'])){

        $donneesCmdVelo = $commandes->affichageUneCommande($_GET['details']);

      }

    }

    $listeCommandes = (isset($_SESSION['membre'])) ? $commandes->affichageCommandes($_SESSION['membre']['id_membre']) : null;

    $this->Render('../vues/membres/gestion-compte.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'formulaire' => $formulaire, 'listeCommandes' => $listeCommandes, 'donneesCmdVelo' => $donneesCmdVelo));

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

    $formulaire = new controleurFonctions();
    $contMail = new modeleMembres();
    $msg['error'] = array();

    if($_POST){

      if(isset($_POST['email'])){

        if(empty($_POST['email'])){
          $msg['error']['email'] = "Vous devez saisir une adresse <b>Email</b>.";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $msg['error']['email'] = "Votre adresse <b>Email</b> est invalide.";
        } else {
          if(!$contMail->verifMail($_POST['email'])){
            $msg['error']['email'] = "Cet <b>Email</b> existe n'existe pas.";
          } else {

            // L'adresse email existe, donc génération d'un nouvau mdp.
            $mdp_sch = str_shuffle("lpsb1234");
            $mdp = substr($mdp_sch, 0, 6);

            $message = 'Voici votre nouveau mot de passe pour accéder au Petit Saint Bernard : ' . $mdp;

            if($contMail->nouveauMdp($mdp, $_POST['email'])){

              $formulaire->sendMail($_POST['email'], 'Changement de mot de passe', $message);

              $msg['error']['confirm'] = "Un Email vous a été envoyé.";

            }
          }
        }
      } else {
        $msg['error']['generale'] = self::ERREUR_POST;
      }
    }

    $this->Render('../vues/membres/mot-de-passe-oublie.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'msg' => $msg, 'formulaire' => $formulaire));

  }

}
