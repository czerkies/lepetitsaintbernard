<?php
if($userConnect){

?>

<h2>Vos vélos unique</h2>

<p>Hello</p>

<?php foreach ($veloPerso as $key => $typeVelo) { ?>
  <h2><?= ucfirst($key); ?></h2>
  <?php
  $prix[$key] = 0;
  $poids[$key] = 0;
  foreach ($typeVelo as $donnees) { ?>
    <div class="blocpiece">
      <div class="img_titre_piece">
        <p class="titre_piece"><?= $donnees['titre']; ?></p>
        <img src="<?= RACINE_SITE.$donnees['img']; ?>" alt="<?= $donnees['titre']; ?>">
      </div>
      <div class="description_piece">
        <p><?= $donnees['description']; ?></p>
        <p><b>Poids</b> : <?= $donnees['poids']; ?> Kilos</p>
        <p><b>Prix</b> : <?= $donnees['prix']; ?> €</p>
        <?php if(($donnees['pignon'] && $donnees['plateau']) == null) { ?>
          <p><b>Matière</b> : <?= $donnees['matiere']; ?></p>
        <?php } else { ?>
          <p><b>Groupe</b> : <?= $donnees['plateau'].'/'.$donnees['pignon']; ?></p>
        <?php } ?>
      </div>
    </div>
  <?php
    $prix[$key] += $donnees['prix'];
    $poids[$key] += $donnees['poids'];
  }
  ?>
  <div class="blocpiece">
    <div class="description_piece">
      <p><b>Prix du vélo</b> : <?= $prix[$key]; ?> €.</p>
      <p><b>Poids du vélo</b> : <?= $poids[$key]; ?> Kilos.</p>
    </div>
  </div>

<?php } ?>

<?php
}
?>
