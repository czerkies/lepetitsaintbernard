<?php

/**
* Gère le stock en BDD
*
*/
class modeleStocks extends modeleSuper {

  /**
  * Récupération des données de la table 'pieces'.
  *
  * @param $type_piece (string)
  * @return $donneesParPiece (array)
  *
  */
  public function recupPieces($type_piece){

    $donnees = $this->bdd()->query("SELECT * FROM pieces WHERE type_piece = '$type_piece'");

    return $donneesParPiece = $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

  /**
  * Insertion d'une 'piece' dans la bdd
  *
  * @param $type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $img, $matiere = NULL, $sexe = NULL, $id_taille = NULL, $pignon = NULL, $plateau = NULL
  * @return $insertion (bool)
  */
  public function insertPieces($type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $img, $matiere = NULL, $sexe = NULL, $id_taille = NULL, $pignon = NULL, $plateau = NULL){

    $insertion = $this->bdd()->prepare("INSERT INTO pieces(type_piece, type_velo, titre, poids, prix, quantite, description, img, matiere, sexe, id_taille, pignon, plateau) VALUES(:type_piece, :type_velo, :titre, :poids, :prix, :quantite, :description, :img, :matiere, :sexe, :id_taille, :pignon, :plateau)");

    $insertion->bindValue(':type_piece', $type_piece, PDO::PARAM_STR);
    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':img', $img, PDO::PARAM_STR);
    $insertion->bindValue(':matiere', $matiere, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':id_taille', $id_taille, PDO::PARAM_STR);
    $insertion->bindValue(':pignon', $pignon, PDO::PARAM_INT);
    $insertion->bindValue(':plateau', $plateau, PDO::PARAM_INT);

    $result = $insertion->execute();

    return $result;

  }

  public function updateQuantitePiece($quantite, $id_piece){

    $insertion = $this->bdd()->prepare("UPDATE pieces SET quantite = quantite + :quantite WHERE id_piece = $id_piece");

    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);

    $result = $insertion->execute();

    return $result;

  }

  /**
  * Récupération des données d'une 'pieces'.
  *
  * @param $id_piece (int)
  * @return $donneesPiece (array)
  *
  */
  public function recupPieceID($id_piece){

    $donnees = $this->bdd()->query("SELECT * FROM pieces WHERE id_piece = '$id_piece'");

    return $donneesPiece = $donnees->fetch(PDO::FETCH_ASSOC);

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
