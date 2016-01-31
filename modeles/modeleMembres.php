<?php

/**
* Gère le compte des membres.
*
*/
class modeleMembres extends modeleSuper {

  /**
  * Récupère les données envoyé par le client pour la connexion.
  *
  * @return $connexion
  */
  public function connexionMembre($email, $mdp){

    $donnees = $this->bdd()->query("SELECT * FROM membres WHERE email = '$email' AND mdp = '$mdp'");

    return $connexion = $donnees->fetch(PDO::FETCH_ASSOC);

  }

}
