<?php

/**
* Cette classe controle les page single.
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

    $this->Render('../vues/single/accueil.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

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

    $formulaire = new controleurFonctions();

    if($_POST){

      if(isset($_POST['prenom']) && isset($_POST['email'])
      && isset($_POST['message'])){

        if(empty($_POST['prenom']) || strlen($_POST['prenom']) > 32 || strlen($_POST['prenom']) < 2){
          $msg['error']['prenom'] = "Veuillez donner un <b>prénom</b> entre 2 et 32 caractères.";
        }

        if(empty($value['email'])){
          $msg['error']['email'] = "Veuillez saisir une adresse <b>Email</b>.";
        } elseif(!filter_var($value['email'], FILTER_VALIDATE_EMAIL)) {
          $msg['error']['email'] = "Votre <b>Email</b> est invalide.";
        } elseif(strlen($value['email']) > 32){
          $msg['error']['email'] = "Votre <b>Email</b> ne doit pas dépasser 32 carractères.";
        }

        if(empty($value['message'])){
          $msg['error']['message'] = "Veuillez saisir un <b>message</b>.";
        } elseif(strlen($value['message']) > 250 || strlen($value['message']) < 10){
          $msg['error']['message'] = "Votre <b>message</b> doit contenir entre 10 et 10000 carractères.";
        }

        if(empty($msg['error'])){

          foreach ($_POST as $key => $value){
            $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
          }

          extract($_POST);

          $formulaire->sendMail(/*mail*/, 'Demande de contact', $message, $email);

          $msg['error']['confirm'] = "Votre Email a bien été envoyé.<br>Nous vous répondrons dans les plus brefs délais.";

        }

      } else {
        $msg['error']['general'] = self::ERREUR_POST;
      }

    }

    $this->Render('../vues/single/contact.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'formulaire' => $formulaire));

  }

}
