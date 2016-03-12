<?php

/**
* La class modeleAvis gere les avis des ventes
*
*/
class modeleAvis extends modeleSuper {

  /**
  * Vérification de l'existance d'un avis sur commande
  *
  * @param (int) $id_commande_velo
  * @param (int) $id_membre
  *
  * @return (int) $donnees
  */
  public function existeAvis($id_commande_velo){

    $donnees = $this->bdd()->query("SELECT id_avis FROM avis
      WHERE id_commande_velo = $id_commande_velo
    ");

    return $donnees->rowCount();

  }

  /**
  * Insertion d'un avis de membre
  *
  * @param (int)
  *
  */
  public function insertAvis($id_commande_velo, $id_membre, $pseudo, $avis){

    $insertion = $this->bdd()->prepare("INSERT INTO avis(id_commande_velo, id_membre, pseudo, avis, date) VALUES(:id_commande_velo, :id_membre, :pseudo, :avis, NOW())");

    $insertion->bindValue(':id_commande_velo', $id_commande_velo, PDO::PARAM_INT);
    $insertion->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);
    $insertion->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $insertion->bindValue(':avis', $avis, PDO::PARAM_STR);

    $insertion->execute();

  }

  /**
  * Affichage de tout les avis ADMIN
  *
  * @return (array) $avis
  */
  public function affichageAvisAdmin(){

    $donnees = $this->bdd()->query("SELECT a.*, DATE_FORMAT(a.date, '%d/%m/%Y') as date_fr, m.nom, m.prenom, c.id_commande
      FROM avis a, membres m, commandes c
      WHERE a.id_membre = m.id_membre
      AND a.id_commande_velo = c.id_commande_velo
      ORDER BY date DESC
    ");

    return $avis = $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

  /**
  * Controle existance d'un id_avis
  *
  * @param (int) $id_avis
  * @return (int) $exist
  */
  public function controleExistAvis($id_avis){

    $donnees = $this->bdd()->query("SELECT * FROM avis WHERE id_avis = $id_avis");

    return $exist = $donnees->rowCount();

  }

  /**
  * Suppression d'un avis
  *
  * @param (int) $id_avis
  */
  public function suppAvis($id_avis){

    $delete = $this->bdd()->prepare("DELETE FROM avis WHERE id_avis = $id_avis");

    $delete->execute();

  }

  /**
  * Récupération avis page d'accueil
  *
  * @return (array) $lesAvis
  */
  public function recupAvis(){

    $donnees = $this->bdd()->query("SELECT *, DATE_FORMAT(date, 'Posté le %d %M %Y') as date_fr
      FROM avis
      ORDER BY RAND()
      LIMIT 3
    ");

    return $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

}
