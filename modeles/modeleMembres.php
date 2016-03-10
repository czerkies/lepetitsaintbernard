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

    switch ($taille) {
      case ($taille>=150 AND $taille<=161):
        $id_taille = 1;
        break;
      case ($taille>=162 AND $taille<=174):
        $id_taille = 2;
        break;
      case ($taille>=175 AND $taille<=187):
        $id_taille = 3;
        break;
      case ($taille>=188 AND $taille<=200):
        $id_taille = 4;
        break;
      default:
        $id_taille = 0;
        break;
    }

    $insertion = $this->bdd()->prepare("INSERT INTO membres(email, mdp, nom, prenom, sexe, age, taille, id_taille, poids, type, budget, adresse, cp, ville, statut) VALUES(:email, :mdp, :nom, :prenom, :sexe, :age, :taille, :id_taille, :poids, :type, :budget, :adresse, :cp, :ville, :statut)");

    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    $insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
    $insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':age', $age, PDO::PARAM_INT);
    $insertion->bindValue(':taille', $taille, PDO::PARAM_INT);
    $insertion->bindValue(':id_taille', $id_taille, PDO::PARAM_INT);
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
  * MAJ des information d'un membre dans la bdd
  *
  * @param $email, $mdp, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville, $statut = 0
  * @return $insertion (bool)
  */
  public function updateMembre($email, $mdp = NULL, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville, $idMembre){

    switch ($taille) {
      case ($taille>=150 AND $taille<=161):
        $id_taille = 1;
        break;
      case ($taille>=162 AND $taille<=174):
        $id_taille = 2;
        break;
      case ($taille>=175 AND $taille<=187):
        $id_taille = 3;
        break;
      case ($taille>=188 AND $taille<=200):
        $id_taille = 4;
        break;
      default:
        $id_taille = 0;
        break;
    }

    if(!$mdp){

      $req = "UPDATE membres SET email = :email, nom = :nom, prenom = :prenom, sexe = :sexe, age = :age, taille = :taille, id_taille = :id_taille, poids = :poids, type = :type, budget = :budget, adresse = :adresse, cp = :cp, ville = :ville WHERE id_membre = '$idMembre'";

    } else {

      $req = "UPDATE membres SET email = :email, mdp = :mdp, nom = :nom, prenom = :prenom, sexe = :sexe, age = :age, taille = :taille, id_taille = :id_taille, poids = :poids, type = :type, budget = :budget, adresse = :adresse, cp = :cp, ville = :ville WHERE id_membre = '$idMembre'";

    }

    $insertion = $this->bdd()->prepare($req);

    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
    $insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':age', $age, PDO::PARAM_INT);
    $insertion->bindValue(':taille', $taille, PDO::PARAM_INT);
    $insertion->bindValue(':id_taille', $id_taille, PDO::PARAM_INT);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':type', $type, PDO::PARAM_STR);
    $insertion->bindValue(':budget', $budget, PDO::PARAM_INT);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);

    if($mdp){
      $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    }

    return $insertion->execute();

  }

  /**
  * Vérification d'un mail non existant à l'inscription et modification
  *
  * @param $email (string)
  * @param $idMembre (int) option
  *
  * @return $nbMail (int)
  */
  public function verifMail($email, $id_membre = NULL){

    $req = "SELECT id_membre FROM membres WHERE email = '$email'";

    if($id_membre){
      $req .= " AND id_membre != '$id_membre'";
    }

    $donnees = $this->bdd()->query($req);

    return $nbMail = $donnees->rowCount();

  }

  /**
  * Récupération de la liste des membres
  *
  * @return $listeMembres (array)
  */
  public function listeMembres(){

    $donnees = $this->bdd()->query("SELECT * FROM membres");

    return $listeMembres = $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

  /**
  * Suppression d'un membre après vérifications
  *
  * @param $id_membre (int)
  * @return $suppression (bool)
  */
  public function suppMembre($id_membre){

    $donnees = $this->bdd()->query("SELECT id_membre FROM membres WHERE id_membre = $id_membre AND statut = 0");

    if($donnees->rowCount()){

      $suppressionMembre = $this->bdd()->prepare("DELETE FROM membres WHERE id_membre = $id_membre AND statut = 0");

      return $suppressionMembre->execute();

    }

  }

  /**
  * Intertion d'un nouveau mot de passe si oublié
  *
  * @param $mdp (string)
  * @param $email (string)
  *
  * @return $insertion (bool)
  */
  public function nouveauMdp($mdp, $email){

    $insertion = $this->bdd()->prepare("UPDATE membres SET mdp = :mdp WHERE email = '$email'");

    $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);

    $insertion->execute();

    return $insertion;

  }

  /**
  * Récupération de toutes les données d'un membre
  *
  * @param (int) $Email
  * @return (array) $donnees
  */
  public function recupToutesDonnees($email){

    $membre = $this->bdd()->query("SELECT * FROM membres WHERE email = '$email'");

    return $donnees = $membre->fetch(PDO::FETCH_ASSOC);

  }

  /**
  * Récupération des email des membres ADMIN
  *
  * @return $listeMembres (array)
  */
  public function emailAdmin(){

    $donnees = $this->bdd()->query("SELECT email FROM membres WHERE statut = 1");

    return $listeMembres = $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

}
