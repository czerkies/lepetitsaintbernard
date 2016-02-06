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

  /**
  * Insert un nouveau membre dans la bdd
  *
  * @param $email, $mdp, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville, $statut = 0
  * @return $insertion (bool)
  */
  public function insertMembre($email, $mdp, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville, $statut = 0){

    $insertion = $this->bdd()->prepare("INSERT INTO membres(email, mdp, nom, prenom, sexe, age, taille, poids, type, budget, adresse, cp, ville, statut) VALUES(:email, :mdp, :nom, :prenom, :sexe, :age, :taille, :poids, :type, :budget, :adresse, :cp, :ville, :statut)");

    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
    $insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':age', $age, PDO::PARAM_INT);
    $insertion->bindValue(':taille', $taille, PDO::PARAM_INT);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':type', $type, PDO::PARAM_STR);
    $insertion->bindValue(':budget', $budget, PDO::PARAM_INT);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);
    $insertion->bindValue(':statut', $statut, PDO::PARAM_INT);

    $insertion->execute();

    return $insertion;

  }

  /**
  * Vérification d'un mail non existant à l'inscription et modification
  *
  * @param $email (string)
  * @param $idMembre (int) option
  *
  * @return $nbMail (int)
  */
  public function verifMail($email, $id_membre){

    $req = "SELECT id_membre FROM membres WHERE email = '$email'";

    if($id_membre){
      $req .= " AND id_membre != '$id_membre'";
    }

    $donnees = $this->bdd()->query($req);

    return $nbMail = $donnees->rowCount();

  }

}
