<?php

/**
* Gère le stock en BDD
*
*/
class modeleStocks extends modeleSuper {

  /**
  * Insertion d'une piece de type cadre dans la bdd
  *
  * @param $type_velo, $titre, $poids, $prix, $description, $matiere, $sexe, $taille
  * @return $insertion (bool)
  */
  public function insertPieceCadre($type_velo, $titre, $poids, $prix, $description, $img, $matiere, $sexe, $taille){

    $insertion = $this->bdd()->prepare("INSERT INTO cadres(type_velo, titre, poids, prix, description, img, matiere, sexe, taille) VALUES(:type_velo, :titre, :poids, :prix, :description, :img, :matiere, :sexe, :taille)");

    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':description', $description, PDO::PARAM_STR);
    $insertion->bindValue(':img', $img, PDO::PARAM_STR);
    $insertion->bindValue(':matiere', $matiere, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':taille', $taille, PDO::PARAM_INT);

    $insertion->execute();

    return $insertion;

  }

  /**
  * MAJ des information d'un membre dans la bdd
  *
  * @param $email, $mdp, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville, $statut = 0
  * @return $insertion (bool)
  */
  public function updateMembre($email, $mdp = NULL, $nom, $prenom, $sexe, $age, $taille, $poids, $type, $budget, $adresse, $cp, $ville, $idMembre){

    if(!$mdp){

      $req = "UPDATE membres SET email = :email, nom = :nom, prenom = :prenom, sexe = :sexe, age = :age, taille = :taille, poids = :poids, type = :type, budget = :budget, adresse = :adresse, cp = :cp, ville = :ville WHERE id_membre = '$idMembre'";

    } else {

      $req = "UPDATE membres SET email = :email, mdp = :mdp, nom = :nom, prenom = :prenom, sexe = :sexe, age = :age, taille = :taille, poids = :poids, type = :type, budget = :budget, adresse = :adresse, cp = :cp, ville = :ville WHERE id_membre = '$idMembre'";

    }

    $insertion = $this->bdd()->prepare($req);

    $insertion->bindValue(':email', $email, PDO::PARAM_STR);
    $insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
    $insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':age', $age, PDO::PARAM_INT);
    $insertion->bindValue(':taille', $taille, PDO::PARAM_INT);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':type', $type, PDO::PARAM_STR);
    $insertion->bindValue(':budget', $budget, PDO::PARAM_INT);
    $insertion->bindValue(':ville', $ville, PDO::PARAM_STR);
    $insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
    $insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);

    if($mdp){
      $insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
    }

    return $insertion->execute();

  }

}