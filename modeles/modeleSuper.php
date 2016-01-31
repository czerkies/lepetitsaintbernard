<?php

/**
* Gère la connexion à la base de données.
*
*/
class modeleSuper {

  /**
  * Fonction de connection à la bdd.
  *
  * @return $pdo
  */
  public function bdd(){

    include_once '../config/bdd-config.php';

    $donneesDB = connexionPDO();

    try {
      $pdo = new PDO($donneesDB['DSN'], $donneesDB['user'], $donneesDB['mdp'], $donneesDB['options']);
    } catch(PDOException $e) {
      echo 'Connexion échouée : ' . $e->getMessage();
    }

    return $pdo;

  }

}
