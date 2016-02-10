<?php

/**
* Gère le compte des membres.
*
*/
class modeleMembresAdmin extends modeleSuper {

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

}
