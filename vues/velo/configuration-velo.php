<?php

?>

<h2>configurez votre propre <?php if(isset($_GET['type']) && $_GET['type'] === 'route') {
  echo 'vélo de Route';
} elseif (isset($_GET['type']) && $_GET['type'] === 'vtt') {
  echo 'VTT';
} else {
  echo 'Vélo';
}?></h2>

<?php if($etape === 'sexe') { ?>
  <h2>Sexe</h2>
  <p>Choisissez pour quel type de sexe</p>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration-<?= $_GET['type']; ?>/femme/">Vélo Femme</a>
    </div>
  </div>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration-<?= $_GET['type']; ?>/homme/">Vélo Homme</a>
    </div>
  </div>
<?php } if($etape != 'sexe') { ?>

  <form class="" action="<?= RACINE_SITE.'configuration-'.$_GET['type'].'/'.$_GET['sexe']; ?>/" method="get">

  <?php switch ($etape) {
    case 'cadre':
    ?>

      <h2>Choisissez votre Cadre</h2>
      <p>Votre cadre sera la pièce maitresse de votre vélo, tout les autres éléments en découlent.</p>

    <?php
    break;
    case 'roue':
    ?>

      <h2>Choisissez votre Roue</h2>
      <p>Votre cadre sera la pièce maitresse de votre vélo, tout les autres éléments en découlent.</p>
      <input type="hidden" name="cadre" value="<?= $_GET['cadre']; ?>" required>

    <?php
    break;
    case 'selle':
    ?>

      <h2>Choisissez votre Selle</h2>
      <p>Votre selle sera la pièce maitresse de votre vélo, tout les autres éléments en découlent.</p>
      <input type="hidden" name="cadre" value="<?= $_GET['cadre']; ?>" required>
      <input type="hidden" name="roue" value="<?= $_GET['roue']; ?>" required>

    <?php
    break;
    case 'guidon':
    ?>

      <h2>Choisissez votre Guidon</h2>
      <p>Votre guidon sera la pièce maitresse de votre vélo, tout les autres éléments en découlent.</p>
      <input type="hidden" name="cadre" value="<?= $_GET['cadre']; ?>" required>
      <input type="hidden" name="roue" value="<?= $_GET['roue']; ?>" required>
      <input type="hidden" name="selle" value="<?= $_GET['selle']; ?>" required>

    <?php
    break;
    default:
      # code...
      break;
    ?>

  <?php } ?>
    <?php foreach ($donneesPieces as $key => $value) { ?>
      <input type="radio" id="<?= $value['id_piece']; ?>" name="<?= $etape; ?>" value="<?= $value['id_piece']; ?>">
      <label for="<?= $value['id_piece']; ?>"><?= $value['titre'].'<br>'; ?>
    <?php } ?>

    <input type="submit" value="Valider">
  </form>

  <p>Poids : <?= $poids; ?> Kilos.</p>
  <p>Prix : <?= $prix; ?> €.</p>

<?php } ?>
