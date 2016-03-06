<?php

/**
* Gère le compte des membres.
*
*/
class modeleCommandes extends modeleSuper {

  /**
  * Insertion d'une commande
  *
  * @param (int) $id_commande_velo
  * @param (int) $total
  * @param (int) $id_membre
  * @return (bool) $insertion
  */
  public function insertCommande($id_commande_velo, $total, $id_membre){

    $insertion = $this->bdd()->prepare("INSERT INTO commandes(id_commande_velo, total, id_membre, date) VALUES(:id_commande_velo, :total, :id_membre, NOW())");

    $insertion->bindValue(':id_commande_velo', $id_commande_velo, PDO::PARAM_INT);
    $insertion->bindValue(':total', $total, PDO::PARAM_INT);
    $insertion->bindValue(':id_membre', $id_membre, PDO::PARAM_INT);

    $result = $insertion->execute();

    return $result;

  }

  /**
  * Insertion velo d'une commande
  *
  * @param (int) $id_commande_velo
  * @param (int) $reference
  * @param (str) $type_velo
  * @param (str) $sexe
  * @param (int) $prix
  * @param (int) $poids
  * @param (int) $quantite
  * @return (bool) $insertion)
  */
  public function insertVeloCommande($id_commande_velo, $reference, $type_velo, $sexe, $prix, $poids, $quantite){

    $insertion = $this->bdd()->prepare("INSERT INTO velo_commande(id_commande_velo, reference, type_velo, sexe, prix, poids, quantite) VALUES(:id_commande_velo, :reference, :type_velo, :sexe, :prix, :poids, :quantite)");

    $insertion->bindValue(':id_commande_velo', $id_commande_velo, PDO::PARAM_INT);
    $insertion->bindValue(':reference', $reference, PDO::PARAM_INT);
    $insertion->bindValue(':type_velo', $type_velo, PDO::PARAM_STR);
    $insertion->bindValue(':sexe', $sexe, PDO::PARAM_STR);
    $insertion->bindValue(':prix', $prix, PDO::PARAM_INT);
    $insertion->bindValue(':poids', $poids, PDO::PARAM_INT);
    $insertion->bindValue(':quantite', $quantite, PDO::PARAM_INT);

    $result = $insertion->execute();

    return $result;

  }

}
