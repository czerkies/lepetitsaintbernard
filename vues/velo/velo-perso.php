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

    <?= $donnees['titre'].' - '.$donnees['id_piece']; ?><br>

  <?php
    $prix[$key] += $donnees['prix'];
    $poids[$key] += $donnees['poids'];
  }
  ?>

  Prix du vélo : <?= $prix[$key]; ?> €.
  Poids du vélo : <?= $poids[$key]; ?> Kilos.

<?php } ?>

<?php
}
?>
