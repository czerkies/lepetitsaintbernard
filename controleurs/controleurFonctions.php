<?php

class controleurFonctions extends controleurSuper {

  /**
  * Fonction de controle du formulaire membre (modif, ajout, admin)
  *
  * @param $value (array)
  * @param $id_membre option (int)
  *
  * @return $msg (array)
  */
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

    echo $field;

  }

  /**
  * Permet de générer un champs de type "select"
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
  public function fieldsFormSelect($label, $array = array(), $name, $em, $msg, $class = FALSE, $input = FALSE, $sessionArray = FALSE){

    $select = '<div class="form-group';
    if($class) $select .= ' '.$class;
    if(isset($msg['error'][$name])) $select .= ' error-form';
    $select .= '">';
    $select .= '<label for="'.$name.'">'.$label.'</label>';
    $select .= '<select name="'.$name.'" id="'.$name.'"';

    if($input) $select .= ' '.$input.' ';
    $select .= '>';

    foreach ($array as $key => $value) {

      if($key != 'disabled') {

        $select .= '<option value="'.$key.'"';
        if(isset($_POST[$name])) {
          if($_POST[$name] == $key) $select .= ' selected';
        }elseif(isset($_GET[$name])) {
          if($_GET[$name] == $key) $select .= 'selected';
        }elseif(isset($_SESSION[$sessionArray][$name])) {
          if($_SESSION[$sessionArray][$name] == $key) $select .= ' selected';
        }elseif(isset($_COOKIE[$name]) && $_COOKIE[$name] == $key) {
          $select .= ' selected';
        }

      } else {

        $select .= '<option disabled';

      }

      $select .= '>'.$value.'</option>';

    }

    $select .= '</select>';
    $select .= '<em>'.$em.'</em>';
    $select .= '</div>';

    echo $select;

  }

  /**
  * Fonction urlIncorrect gère la page 404
  *
  * @return Render (array)
  */
  public function urlIncorrect(){

    session_start();
    $meta['title'] = 'Page non trouvée';
    $meta['menu'] = '';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $this->Render('../vues/single/page-introuvable.php', array('meta' => $meta, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin));

  }

  /**
  * Fonction de controle de pieces (modif, ajout)
  *
  * @param $value (array)
  * @param $typePiece (string)
  *
  * @return $msg (array)
  */
  public function verifFormPiece($value, $typePiece){

    $msg = '';

    if(empty($value['titre'])){
      $msg['error']['titre'] = "Veuillez saisir un <b>Titre</b>.";
    } elseif(strlen($value['titre']) > 30 ){
      $msg['error']['titre'] = "Votre <b>Titre</b> ne doit pas dépasser 30 carractères.";
    }

    if(empty($value['poids'])){
      $msg['error']['poids'] = "Veuillez saisir votre <b>Poids</b>.";
    } elseif(!is_numeric($_POST['poids'])) {
      $msg['error']['poids'] = "Veuillez saisir votre <b>Poids</b> en chiffres.";
    } elseif($_POST['poids'] < 10 || $_POST['poids'] > 15000){
      $msg['error']['poids'] = "Veuillez saisir un <b>Poids</b> convenable.";
    }

    if(empty($value['prix'])){
      $msg['error']['prix'] = "Veuillez saisir un <b>Prix</b>.";
    } elseif(!is_numeric($_POST['prix'])) {
      $msg['error']['prix'] = "Veuillez saisir un <b>Prix</b> en chiffres.";
    } elseif($_POST['prix'] < 1 || $_POST['prix'] > 20000){
      $msg['error']['prix'] = "Veuillez saisir un <b>Prix</b> convenable.";
    }

    if(empty($value['quantite'])){
      $msg['error']['quantite'] = "Veuillez saisir votre <b>Quantite</b>.";
    } elseif(!is_numeric($_POST['quantite'])) {
      $msg['error']['quantite'] = "Veuillez saisir votre <b>Quantite</b> en chiffres.";
    } elseif($_POST['quantite'] < 1 || $_POST['quantite'] > 5000){
      $msg['error']['quantite'] = "Veuillez saisir une <b>Quantite</b> convenable.";
    }

    if(empty($value['description'])){
      $msg['error']['description'] = "Veuillez saisir une <b>Description</b>.";
    } elseif(strlen($value['description']) > 250){
      $msg['error']['description'] = "Votre <b>Description</b> ne doit pas dépasser 250 carractères.";
    }

    if(empty($_FILES['img']['name'])){
      $msg['error']['img'] = "Veuillez saisir une <b>Image</b>.";
    }elseif(!$this->verificationPhoto()){
      $msg['error']['img'] = "Veuillez envoyer une <b>Image</b> au format .jpg.";
    }

    switch ($typePiece) {
      case 'cadre':

        break;
    }

    return $msg;

  }

  /**
  * Fonction pour controler l'envoie d'une image de piece.
  *
  *
  * @return $verif_extension (bool)
  */
  public function verificationPhoto(){

    $extension = strrchr($_FILES['img']['name'], '.');

    $extension = strtolower(substr($extension, 1));

    $extension_valide = array("jpg", "jpeg");

    return in_array($extension, $extension_valide);

    //var_dump($verificationPhoto);

    //return $verificationPhoto;

  }

  /**
  * Fonction pour insérer la photo et lien de stockage.
  *
  * @param
  * @return
  */
  public function insertPhoto($img){

    define('RACINE_SITE_IMG', '/lepetitsaintbernard/www/');
    define('RACINE_SERVER_IMG', $_SERVER['DOCUMENT_ROOT']);

    $nomPhoto = $img.'_'.uniqid().'.jpg';

    $photoDossier = RACINE_SERVER_IMG . RACINE_SITE_IMG . "img/pieces/$nomPhoto";

    copy($_FILES['img']['tmp_name'], $photoDossier);

    return $photoDossier;

  }

}
