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

}
