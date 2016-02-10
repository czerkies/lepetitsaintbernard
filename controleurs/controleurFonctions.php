<?php

class controleurFonctions extends controleurSuper {

  // ********** Controle du formulaire de la création et modification profil de membre ********** //
  public function verifFormMembre($value, $id_membre = NULL){

    $msg = '';

    $membreExist = new modeleMembres();

    if(empty($value['email'])){
      $msg['error']['email'] = "Veuillez saisir une adresse <b>Email</b>.";
    } elseif(!filter_var($value['email'], FILTER_VALIDATE_EMAIL)) {
      $msg['error']['email'] = "Votre <b>Email</b> est invalide.";
    } elseif(strlen($value['email']) > 30){
      $msg['error']['email'] = "Votre <b>Email</b> ne doit pas dépasser 30 carractères.";
    } elseif($membreExist->verifMail($value['email'], $id_membre)){
      $msg['error']['email'] = "L'adresse <b>Email</b> que vous avez saisis est déjà existante.";
    }

    if(!$id_membre){
      if(empty($value['mdp'])){
        $msg['error']['mdp'] = "Veuillez saisir un <b>mot de passe</b>.";
      } elseif(strlen($value['mdp']) < 5 || strlen($value['mdp']) > 32) {
        $msg['error']['mdp'] = "Veuillez saisir un <b>mot de passe</b> entre 5 et 32 carractères.";
      } elseif(!preg_match('#^[^A-Z0-9]*([A-Z0-9])#',$value['mdp'])) {
        $msg['error']['mdp'] = "Votre <b>mot de passe doit comporter au moins une majuscule ou un chiffre.";
      }
    } elseif($id_membre && !empty($value['mdp'])){
      if(strlen($value['mdp']) < 5 || strlen($value['mdp']) > 32) {
       $msg['error']['mdp'] = "Veuillez saisir <b>un mot de passe</b> entre 5 et 32 carractères.";
     } elseif(!preg_match('#^[^A-Z0-9]*([A-Z0-9])#',$value['mdp'])) {
       $msg['error']['mdp'] = "Votre <b>mot de passe doit comporter au moins une majuscule ou un chiffre.";
     }
    }

    if(empty($value['nom'])){
      $msg['error']['nom'] = "Veuillez saisir un <b>Nom</b>.";
    } elseif(strlen($value['nom']) < 2 || strlen($value['nom']) > 20) {
      $msg['error']['nom'] = "Veuillez saisir un <b>Nom</b> entre 2 et 20 carractères.";
    } elseif(is_numeric($value['nom'])) {
      $msg['error']['nom'] = "Seul les lettres sont autorisées pour votre <b>Nom</b>.";
    }

    if(empty($value['prenom'])){
      $msg['error']['prenom'] = "Veuillez saisir un <b>Prénom</b>.";
    } elseif(strlen($value['prenom']) < 2 || strlen($value['prenom']) > 20) {
      $msg['error']['prenom'] = "Veuillez saisir un <b>Prénom</b> entre 2 et 20 carractères.";
    } elseif(is_numeric($value['prenom'])) {
      $msg['error']['prenom'] = "Seul les lettres sont autorisées pour votre <b>Prénom</b>.";
    }

    if(empty($value['sexe'])){
      $msg['error']['sexe'] = "Veuillez saisir votre <b>Sexe</b>.";
    }

    if(empty($value['age'])){
      $msg['error']['age'] = "Veuillez saisir votre <b>Age</b>.";
    } elseif(!is_numeric($_POST['age'])) {
      $msg['error']['age'] = "Veuillez saisir votre <b>Age</b> en chiffres.";
    } elseif($_POST['age'] < 10 || $_POST['age'] > 125){
      $msg['error']['age'] = "Veuillez saisir une <b>Age</b> convenable.";
    }

    if(empty($value['taille'])){
      $msg['error']['taille'] = "Veuillez saisir votre <b>Taille</b>.";
    } elseif(!is_numeric($_POST['taille'])) {
      $msg['error']['taille'] = "Veuillez saisir votre <b>Taille</b> en chiffres.";
    } elseif($_POST['taille'] < 100 || $_POST['taille'] > 250){
      $msg['error']['taille'] = "Veuillez saisir une <b>Taille</b> convenable.";
    }

    if(empty($value['poids'])){
      $msg['error']['poids'] = "Veuillez saisir votre <b>Poids</b>.";
    } elseif(!is_numeric($_POST['poids'])) {
      $msg['error']['poids'] = "Veuillez saisir votre <b>Poids</b> en chiffres.";
    } elseif($_POST['poids'] < 30 || $_POST['poids'] > 200){
      $msg['error']['poids'] = "Veuillez saisir une <b>Poids</b> convenable.";
    }

    if(empty($value['budget'])){
      $msg['error']['budget'] = "Veuillez saisir votre <b>Budget</b>.";
    } elseif(!is_numeric($_POST['budget'])) {
      $msg['error']['budget'] = "Veuillez saisir votre <b>Budget</b> en chiffres.";
    } elseif($_POST['budget'] < 100 || $_POST['budget'] > 10000){
      $msg['error']['budget'] = "Veuillez saisir une <b>Budget</b> entre 100 et 10000 €.";
    }

    if(empty($value['adresse'])){
      $msg['error']['adresse'] = "Veuillez saisir une <b>Adresse</b>.";
    } elseif(strlen($value['adresse']) < 10 || strlen($value['adresse']) > 30){
      $msg['error']['adresse'] = "Veuillez saisir une <b>Adresse</b> entre 10 et 30 carractères.";
    }

    if(empty($value['cp'])){
      $msg['error']['cp'] = "Veuillez saisir votre <b>Code Postal</b>.";
    } elseif(strlen($value['cp']) != 5 || !is_numeric($value['cp'])) {
      $msg['error']['cp'] = "Votre <b>Code postal</b> doit contenir 5 chiffres.";
    }

    if(empty($value['ville'])){
      $msg['error']['ville'] = "Veuillez saisir une <b>Ville</b>.";
    } elseif(is_numeric($value['ville'])){
      $msg['error']['ville'] = "Votre <b>Ville</b> ne doit comporter aucun carractères spéciaux.";
    } elseif(strlen($value['ville']) < 2 || strlen($value['ville']) > 30){
      $msg['error']['ville'] = "Veuillez saisir une <b>Ville</b> entre 2 et 30 carractères.";
    }

    return $msg;

  }


  /**
  * Permet de générer un champs de type "input"
  *
  * @param $label string
  * @param $type string
  * @param $name string
  * @param $placeholder string
  * @param $em string
  * @param $msg array
  * @param $class (option) string
  * @param $input (option) string
  *
  * @return $field string
  */
  public function fieldsFormInput($label, $type, $name, $placeholder, $em, $msg, $class = FALSE, $input = FALSE, $sessionArray = FALSE){

    $field = '<div class="form-group';
    if($class) $field .= ' '.$class;
    if(isset($msg['error'][$name])) $field .= ' error-form';
    $field .= '">';
    $field .= '<label for="'.$name.'">'.$label.'</label>';
    $field .= '<input type="'.$type.'" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'"';

    if($type != 'password'){

      if(isset($_POST[$name])) {
        $field .= 'value="'.$_POST[$name].'"';
      } elseif(isset($_SESSION[$sessionArray][$name])) {
        $field .= 'value="'.$_SESSION[$sessionArray][$name].'"';
      } elseif(isset($_COOKIE[$name])) {
        $field .= 'value="'.$_COOKIE[$name].'"';
      }

    }

    if($input) $field .= ' '.$input.' ';
    $field .= ' required>';
    $field .= '<em>'.$em.'</em>';
    $field .= '</div>';

    return $field;

  }

  // ********** Fonction pour une page de type "404" ********** //
  public function urlIncorrect(){

    session_start();
    $title['name'] = 'Page non trouvée';
    $title['menu'] = 0;
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $this->Render('../vues/single/page-introuvable.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

}
