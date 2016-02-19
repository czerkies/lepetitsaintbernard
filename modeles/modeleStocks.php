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
  * Mise à jour d'une 'piece' dans la bdd
  *
  * @param $type_piece, $type_velo, $titre, $poids, $prix, $quantite, $description, $img, $matiere = NULL, $sexe = NULL, $id_taille = NULL, $pignon = NULL, $plateau = NULL
  * @return $insertion (bool)
  */
  public function updatePieces($type_velo, $titre, $poids, $prix, $quantite, $description, $img = null, $matiere = null, $sexe = null, $id_taille = null, $pignon = null, $plateau = null, $id_piece){

    if(!$img){

      $insertion = $this->bdd()->prepare("UPDATE pieces SET type_velo = :type_velo, titre = :titre, poids = :poids, prix = :prix, quantite = :quantite, description = :description, matiere = :matiere, sexe = :sexe, id_taille = :id_taille, pignon = :pignon, plateau = :plateau WHERE id_piece = $id_piece");

    } else {

      $insertion = $this->bdd()->prepare("UPDATE pieces SET type_velo = :type_velo, titre = :titre, poids = :poids, prix = :prix, quantite = :quantite, description = :description, img = :img, matiere = :matiere, sexe = :sexe, id_taille = :id_taille, pignon = :pignon, plateau = :plateau WHERE id_piece = $id_piece");

      $insertion->bindValue(':img', $img, PDO::PARAM_STR);

    }

    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':matiere', $matiere, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':id_taille', $id_taille, PDO::PARAM_STR);
    $insertion->bindValue(':pignon', $pignon, PDO::PARAM_INT);
    $insertion->bindValue(':plateau', $plateau, PDO::PARAM_INT);

    $result = $insertion->execute();

    return $result;

  }

  public function deletePieceID($id_piece){

    $delete = $this->bdd()->prepare("DELETE FROM pieces WHERE id_piece = $id_piece");

    $delete->execute();

  }

}
