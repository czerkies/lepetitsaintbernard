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
  * @param (string) $type_velo
  * @param (string) $type_piece
  * @param (string) $sexe Option
  * @param (int) $id_taille Option
  *
  * @return (array) $pieces
  */
  public function donneesParTypePiece($type_velo, $type_piece, $sexe = null, $id_taille = null){

    $req = "SELECT * FROM pieces WHERE type_velo = '$type_velo'
      AND type_piece = '$type_piece'
      AND quantite > 0 ";

    if($sexe) $req .= "AND sexe = '$sexe'";

    if($id_taille) $req .= "AND id_taille = $id_taille";

    $donnees = $this->bdd()->query($req);

    return $pieces = $donnees->fetchAll(PDO::FETCH_ASSOC);

  }

  /**
  * Concordance des pieces et récupération des informations.
  *
  * @param (string) $type_piece
  * @param (int) $id_piece
  * @param (string) $type_velo
  * @param (string) $sexe Option
  * @param (string) $id_taille Option
  *
  * @return (array) $donneesVerif
  */
  public function concordancePieceTypeDonnees($type_piece, $id_piece, $type_velo, $sexe = null, $id_taille = null){

    $req = "SELECT prix, poids, id_taille FROM pieces WHERE type_piece = '$type_piece'
    AND id_piece = $id_piece
    AND type_velo = '$type_velo' ";

    if($sexe) $req .= "AND sexe = '$sexe' ";

    if($id_taille) $req .= "AND id_taille = $id_taille ";

    $donnees = $this->bdd()->query($req);

    return $pieces = $donnees->fetch(PDO::FETCH_ASSOC);

  }

  /**
  * Fonction pour afficher les types_pieces
  *
  */
  public function toutesPieces($key = null, $type_piece = null, $type_velo = null,  $taille = null, $sexe = null){

    $req1 = "SELECT type_piece FROM pieces";

    if($type_piece) $req1 .= " WHERE type_piece = '$type_piece'";

    $req1 .= " GROUP BY type_piece";

    $typePieces = $this->bdd()->query($req1);


    foreach ($typePieces->fetchAll(PDO::FETCH_ASSOC) as $value) {

      $req2 = "SELECT * FROM pieces WHERE type_piece = '$value[type_piece]'";

      if($key) $req2 .= " AND (titre LIKE '%$key%'
      OR matiere LIKE '%$key%'
      OR description LIKE '%$key%')";

      if($type_velo) $req2 .= " AND type_velo = '$type_velo'";

      if($taille) $req2 .= " AND id_taille = '$taille'";

      if($sexe) $req2 .= " AND sexe = '$sexe'";

      $donnees[$value['type_piece']] = $this->bdd()->query($req2);

      $pieces[$value['type_piece']] = $donnees[$value['type_piece']]->fetchAll(PDO::FETCH_ASSOC);

    }

    return $pieces;

  }

}
