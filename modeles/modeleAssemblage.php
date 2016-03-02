<?php

/**
* Gère le compte des membres.
*
*/
class modeleAssemblage extends modeleSuper {

  /**
  * Créer un vélo avec les données de l'utilisateur
  *
  * @param (array) $session
  * @return (array) $veloAssemble
  */
  public function veloAssemblage($session){

    extract($session);

    if($type === 'route' || $type === 'both') $typeVeloReq[] = 'route';
    if($type === 'vtt' || $type === 'both') $typeVeloReq[] = 'vtt';

    foreach ($typeVeloReq as $value) {

      // Cadre
      $cadre = $this->bdd()->query("SELECT * FROM pieces WHERE type_velo = '$value' AND type_piece = 'cadre' AND id_taille = $id_taille AND sexe = '$sexe' AND quantite > 0 AND prix <= (($budget/100)*40) ORDER BY prix DESC LIMIT 1");

      $veloAssemble[$value]['cadre'] = $cadre->fetch(PDO::FETCH_ASSOC);

      // Roue
      $roue = $this->bdd()->query("SELECT * FROM pieces WHERE type_velo = '$value' AND type_piece = 'roue' AND id_taille = $id_taille AND type_velo = 'route' AND quantite > 0 AND prix <= (($budget/100)*30) ORDER BY prix DESC LIMIT 1");

      $veloAssemble[$value]['roue'] = $roue->fetch(PDO::FETCH_ASSOC);

      // Selle
      $selle = $this->bdd()->query("SELECT * FROM pieces WHERE type_velo = '$value' AND type_piece = 'selle' AND sexe = '$sexe' AND quantite > 0 AND prix <= (($budget/100)*10) ORDER BY prix DESC LIMIT 1");

      $veloAssemble[$value]['selle'] = $selle->fetch(PDO::FETCH_ASSOC);

      // Guidon
      $guidon = $this->bdd()->query("SELECT * FROM pieces WHERE type_velo = '$value' AND type_piece = 'guidon' AND sexe = '$sexe' AND quantite > 0 AND prix <= (($budget/100)*10) ORDER BY prix DESC LIMIT 1");

      $veloAssemble[$value]['guidon'] = $guidon->fetch(PDO::FETCH_ASSOC);

      // Groupe
      $reqGroupe = "SELECT * FROM pieces WHERE type_velo = '$value' AND type_piece = 'groupe'";

      if($age <= 45){
        $reqGroupe .= "AND plateau = 56 ";
      } else {
        $reqGroupe .= "AND plateau = 76 ";
      }

      switch ($poids) {
        case ($poids < 70):
          $reqGroupe .= "AND pignon = 16 ";
          break;
        case ($poids < 80):
          $reqGroupe .= "AND pignon = 24 ";
          break;
        case ($poids > 90):
          $reqGroupe .= "AND pignon = 16 ";
          break;
      }

      $reqGroupe .= "AND quantite > 0 AND prix <= (($budget/100)*10) ORDER BY prix DESC LIMIT 1";

      $groupe = $this->bdd()->query($reqGroupe);

      $veloAssemble[$value]['groupe'] = $groupe->fetch(PDO::FETCH_ASSOC);

    }

    return $veloAssemble;

  }

  /**
  * Vérification existe piece dans BDD
  *
  * @param $id_piece (int)
  * @return $exist (int)
  */
  public function siExistePieceType($id_piece, $type_piece){

    $donnees = $this->bdd()->query("SELECT * FROM pieces WHERE id_piece = $id_piece AND type_piece = '$type_piece'");

    return $exist = $donnees->fetch(PDO::FETCH_ASSOC);

  }

  /**
  * Vérification quantité piece pour mise à jour quantité panier
  *
  * @param $id_piece (string)
  * @return bool
  *
  */
  public function verifQuantiteMaj($id_piece){

    $donnees = $this->bdd()->query("SELECT quantite FROM pieces WHERE id_piece = $id_piece");

    $dispo = $donnees->fetch(PDO::FETCH_ASSOC);

    return $dispo['quantite'];

  }

  /**
  * Recherche des données pour le tunnel d'achat
  *
  * @param
  *
  * @return
  */
  public function donneesParTypePiece($type_velo, $sexe ,$type_piece){

    $req = "SELECT * FROM pieces WHERE type_velo = '$type_velo'
      AND sexe = '$sexe'
      AND type_piece = '$type_piece'
      AND quantite > 0";

    if($type_piece == 'roue'){

      $req .= "AND id_taille = '$id_taille'";

    }

    $donnees = $this->bdd()->query($req);

    return $pieces = $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

}
