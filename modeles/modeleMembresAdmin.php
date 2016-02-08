<?php

/**
* Gère le compte des membres.
*
*/
class modeleMembresAdmin extends modeleSuper {

  /**
  * Récupération de la liste des membres
  *
  * @return $listeMembres
  */
  public function listeMembres(){

    $donnees = $this->bdd()->query("SELECT * FROM membres");

    return $listeMembres = $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

}
