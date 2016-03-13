<?php

/**
* Cette class controle les pages single.
*
*/
class controleurSingle extends controleurSuper {

  const ERREUR_POST = 'Une erreur est survenue lors de votre demande.';

  /**
  * Affichage de la page d'accueil
  *
  */
  public function singleAccueil(){

    session_start();
    $meta['title'] = 'Accueil';
    $meta['menu'] = 'accueil';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $avisBDD = new modeleAvis();

    $avisRand = $avisBDD->recupAvis();

    $this->Render('../vues/single/accueil.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'avisRand' => $avisRand));

  }

  /**
  * Page de contact
  *
  */
  public function singleContact(){

    session_start();
    $meta['title'] = 'Contactez nous';
    $meta['menu'] = 'contact';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = [];

    $formulaire = new controleurFonctions();

    if($_POST){

      if(isset($_POST['prenom']) && isset($_POST['email'])
      && isset($_POST['message'])){

        if(empty($_POST['prenom']) || strlen($_POST['prenom']) > 32 || strlen($_POST['prenom']) < 2){
          $msg['error']['prenom'] = "Veuillez donner un <b>prénom</b> entre 2 et 32 caractères.";
        }

        if(empty($_POST['email'])){
          $msg['error']['email'] = "Veuillez saisir une adresse <b>Email</b>.";
        } elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $msg['error']['email'] = "Votre <b>Email</b> est invalide.";
        } elseif(strlen($_POST['email']) > 32){
          $msg['error']['email'] = "Votre <b>Email</b> ne doit pas dépasser 32 carractères.";
        }

        if(empty($_POST['message'])){
          $msg['error']['message'] = "Veuillez saisir un <b>message</b>.";
        } elseif(strlen($_POST['message']) > 250 || strlen($_POST['message']) < 10){
          $msg['error']['message'] = "Votre <b>message</b> doit contenir entre 10 et 10000 carractères.";
        }

        if(empty($msg['error'])){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
          }

          extract($_POST);

          $membresAdmin = new modeleMembres();

          $emailAdmin = '';
          foreach ($membresAdmin->emailAdmin() as $value) {
            $emailAdmin .= $value['email'].', ';
          }

          $formulaire->sendMail($emailAdmin, 'Demande de contact', $message, $email);

          $msg['error']['confirm'] = "Votre Email a bien été envoyé.<br>Nous vous répondrons dans les plus brefs délais.";

        }

      } else {
        $msg['error']['generale'] = self::ERREUR_POST;
      }

    }

    $this->Render('../vues/single/contact.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire));

  }

}
