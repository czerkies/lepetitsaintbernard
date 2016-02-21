<?php

/**
* Gère le compte des membres.
*
*/
class modeleAssemblage extends modeleSuper {

  /**
  * Créer un vélo avec les données de l'utilisateur
  *
  * @return $veloAssemble
  */
  public function veloAssemblage($session){

    extract($session);
    echo $budget.'<br>';
    echo ($budget/4).'<br>';
    echo ($budget/3).'<br>';
    echo ($budget/9).'<br>';
    echo ($budget/9).'<br>';
    echo (($budget/100)*40).'<br>';

    $cadre = $this->bdd()->query("SELECT * FROM pieces WHERE type_piece = 'cadre' AND id_taille = $id_taille AND sexe = '$sexe' AND type_velo = 'route' AND prix < (($budget/100)*40) ORDER BY prix DESC LIMIT 1");

    $veloAssemble['cadre'] = $cadre->fetchAll(PDO::FETCH_ASSOC);

    $roue = $this->bdd()->query("SELECT * FROM pieces WHERE type_piece = 'roue' AND id_taille = $id_taille AND type_velo = 'route' AND prix < (($budget/100)*30) ORDER BY prix DESC LIMIT 1");

    $veloAssemble['roue'] = $roue->fetchAll(PDO::FETCH_ASSOC);

    return $veloAssemble;

  }
}
