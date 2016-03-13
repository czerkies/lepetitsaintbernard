<h2>Notre catalogue</h2>

<p>Sur cette page, vous retrouvez très facilement toutes nos pièces en vente. Utilisez le champs de recherche tout trouver celle qui vous conviendrait le mieux par filtres.</p>

<?php include '../vues/include/dialogue.php'; ?>


<form class="large" action="#result" method="post">

  <?= $formulaire->fieldsFormInput('Recherche', 'text', 'key', 'Rechercher par : Titre, Matière ou Description...', 'Rechercher une pièce dans notre catalogue par mot clef', $msg, 'required', 'w100', null); ?>

  <?= $formulaire->fieldsFormSelect('Par type de pièces', $select['type_piece'], 'type_piece', 'Type de pièce', $msg, null, null); ?>

  <?= $formulaire->fieldsFormSelect('Par type de vélo', $select['type_velo'], 'type_velo', 'Type de vélo', $msg, null, null); ?>

  <?= $formulaire->fieldsFormSelect('Par taille', $select['taille'], 'taille', 'Rechercher par taille', $msg, null, null); ?>

  <?= $formulaire->fieldsFormSelect('Par sexe', $select['sexe'], 'sexe', 'Piece pour Femme ou Homme', $msg, null, null); ?>

  <div class="form-group submit">
    <input type="submit" value="Rechercher">
  </div>

</form>


<?php
if($pieces) {
  foreach ($pieces as $key => $typeVelo) { ?>
  <h2><?= ucfirst($key); ?></h2>
  <?php
  if(!empty($typeVelo)){
  foreach ($typeVelo as $type => $donnees) { ?>
    <div class="blocpiece">
      <div class="img_piece">
        <img src="<?= RACINE_SITE.$donnees['img']; ?>" alt="<?= $donnees['titre']; ?>">
      </div>
      <div class="details_piece">
        <p class="titre"><?= $donnees['titre']; ?></p>
        <p class="description"><?= $donnees['description']; ?></p>
        <?php if(($donnees['pignon'] && $donnees['plateau']) == null) { ?>
          <p><b>Matière</b> : <?= ucfirst($donnees['matiere']); ?></p>
          <?php } else { ?>
            <p><b>Groupe</b> : <?= $donnees['plateau'].'/'.$donnees['pignon']; ?></p>
          <?php } ?>
        <p><b>Poids</b> : <?= $donnees['poids']; ?> Kilos</p>
        <p><b>Prix</b> : <?= $donnees['prix']; ?> € TTC</p>
      </div>
    </div>
  <?php
      }
    } else {
      echo "<p>Aucune pièces trouvés pour le type de pieces : ".ucfirst($key).".";
    }
  }
}
?>
