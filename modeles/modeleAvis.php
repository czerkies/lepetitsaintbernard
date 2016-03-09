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
  public function existeAvis($id_commande_velo, $id_membre){

    $donnees = $this->bdd()->query("SELECT id_avis FROM avis
      WHERE id_commande_velo = $id_commande_velo
      AND id_membre = $id_membre
    ");

    return $donnees->rowCount();

  }

}
