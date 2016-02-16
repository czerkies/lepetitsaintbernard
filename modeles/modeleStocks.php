<?php

/**
* Gère le stock en BDD
*
*/
class modeleStocks extends modeleSuper {

  /**
  * Récupération des données de la table 'cadres'.
  *
  * @return $donnees
  *
  */
  public function recupPiecesCadres(){

    $req = "SELECT * FROM cadres";

    $donnees = $this->bdd()->query($req);

    return $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

  /**
  * Insertion d'une piece de type cadre dans la bdd
  *
  * @param $titre, $type_velo, $poids, $prix, $quantite, $description, $img, $matiere, $sexe, $id_taille
  * @return $insertion (bool)
  */
  public function insertPieceCadre($titre, $type_velo, $poids, $prix, $quantite, $description, $img, $matiere, $sexe, $id_taille){

    $insertion = $this->bdd()->prepare("INSERT INTO cadres(type_velo, titre, poids, prix, quantite, description, img, matiere, sexe, id_taille) VALUES(:type_velo, :titre, :poids, :prix, :quantite, :description, :img, :matiere, :sexe, :id_taille)");

    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':img', $img, PDO::PARAM_STR);
    $insertion->bindValue(':matiere', $matiere, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':id_taille', $id_taille, PDO::PARAM_INT);

    $insertion->execute();

    return $insertion;

  }

  /**
  * Insertion d'une piece de type roue dans la bdd
  *
  * @param $type_velo, $titre, $poids, $prix, $description, $matiere, $taille
  * @return $insertion (bool)
  */
  public function insertPieceRoue($titre, $type_velo, $poids, $prix, $quantite, $description, $img, $matiere, $id_taille){

    $insertion = $this->bdd()->prepare("INSERT INTO roues(type_velo, titre, poids, prix, quantite, description, img, matiere, id_taille) VALUES(:type_velo, :titre, :poids, :prix, :quantite, :description, :img, :matiere, :id_taille)");

    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':img', $img, PDO::PARAM_STR);
    $insertion->bindValue(':matiere', $matiere, PDO::PARAM_STR);
    $insertion->bindValue(':id_taille', $id_taille, PDO::PARAM_INT);

    $insertion->execute();

    return $insertion;

  }

  /**
  * Insertion d'une piece de type selle dans la bdd
  *
  * @param $titre, $type_velo, $poids, $prix, $quantite, $description, $img, $matiere, $sexe
  * @return $insertion (bool)
  */
  public function insertPieceSelle($titre, $type_velo, $poids, $prix, $quantite, $description, $img, $matiere, $sexe){

    $insertion = $this->bdd()->prepare("INSERT INTO selles(type_velo, titre, poids, prix, quantite, description, img, matiere, sexe) VALUES(:type_velo, :titre, :poids, :prix, :quantite, :description, :img, :matiere, :sexe)");

    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':img', $img, PDO::PARAM_STR);
    $insertion->bindValue(':matiere', $matiere, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);

    $insertion->execute();

    return $insertion;

  }

  /**
  * Insertion d'une piece de type guidon dans la bdd
  *
  * @param $titre, $type_velo, $poids, $prix, $quantite, $description, $img, $matiere, $sexe, $id_taille
  * @return $insertion (bool)
  */
  public function insertPieceGuidon($titre, $type_velo, $poids, $prix, $quantite, $description, $img, $matiere, $sexe, $id_taille){

    $insertion = $this->bdd()->prepare("INSERT INTO guidons(type_velo, titre, poids, prix, quantite, description, img, matiere, sexe, id_taille) VALUES(:type_velo, :titre, :poids, :prix, :quantite, :description, :img, :matiere, :sexe, :id_taille)");

    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':img', $img, PDO::PARAM_STR);
    $insertion->bindValue(':matiere', $matiere, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':id_taille', $id_taille, PDO::PARAM_INT);

    $insertion->execute();

    return $insertion;

  }

  /**
  * Insertion d'une piece de type groupe dans la bdd
  *
  * @param $titre, $type_velo, $poids, $prix, $quantite, $description, $img, $pignon, $plateau
  * @return $insertion (bool)
  */
  public function insertPieceGroupe($titre, $type_velo, $poids, $prix, $quantite, $description, $img, $pignon, $plateau){

    $insertion = $this->bdd()->prepare("INSERT INTO groupes(type_velo, titre, poids, prix, quantite, description, img, pignon, plateau) VALUES(:type_velo, :titre, :poids, :prix, :quantite, :description, :img, :pignon, :plateau)");

    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':img', $img, PDO::PARAM_STR);
    $insertion->bindValue(':pignon', $pignon, PDO::PARAM_STR);
    $insertion->bindValue(':plateau', $plateau, PDO::PARAM_STR);

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

    if(!$mdp){

      $req = "UPDATE membres SET email = :email, nom = :nom, prenom = :prenom, sexe = :sexe, age = :age, taille = :taille, poids = :poids, type = :type, budget = :budget, adresse = :adresse, cp = :cp, ville = :ville WHERE id_membre = '$idMembre'";

    } else {

      $req = "UPDATE membres SET email = :email, mdp = :mdp, nom = :nom, prenom = :prenom, sexe = :sexe, age = :age, taille = :taille, poids = :poids, type = :type, budget = :budget, adresse = :adresse, cp = :cp, ville = :ville WHERE id_membre = '$idMembre'";

    }

    $insertion = $this->bdd()->prepare($req);

    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
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

    if($mdp){
      $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    }

    return $insertion->execute();

  }

}
