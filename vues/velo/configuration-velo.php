<?php

?>

<h2>configurez votre propre <?php if(isset($_GET['type']) && $_GET['type'] === 'route') {
  echo 'vélo de Route';
} elseif (isset($_GET['type']) && $_GET['type'] === 'vtt') {
  echo 'VTT';
} else {
  echo 'Vélo';
}?></h2>

<?php if($etape === 'type') { ?>
  <h2>Type de vélo</h2>
  <p>Quel type de vélo voulez-vous configurer ?</p>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration/route/">Vélo de route</a>
    </div>
  </div>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration/vtt/">VTT de montagne</a>
    </div>
  </div>
<?php } elseif($etape === 'sexe') { ?>
  <h2>Sexe</h2>
  <p>Choisissez pour quel type de sexe</p>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration/<?= $_GET['type']; ?>/femme/">Vélo Femme</a>
    </div>
  </div>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration/<?= $_GET['type']; ?>/homme/">Vélo Homme</a>
    </div>
  </div>
<?php } if($etape != 'sexe') { ?>

  <form class="large" action="<?= RACINE_SITE.'configuration/'.$_GET['type'].'/'.$_GET['sexe']; ?>/" method="get">

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
    case 'groupe':
    ?>

      <h2>Choisissez votre Groupe</h2>
      <p>Votre groupe" sera la pièce maitresse de votre vélo, tout les autres éléments en découlent.</p>
      <input type="hidden" name="cadre" value="<?= $_GET['cadre']; ?>" required>
      <input type="hidden" name="roue" value="<?= $_GET['roue']; ?>" required>
      <input type="hidden" name="selle" value="<?= $_GET['selle']; ?>" required>
      <input type="hidden" name="guidon" value="<?= $_GET['guidon']; ?>" required>

    <?php
    break;
    case 'confirmation':
    ?>

      <h2>Choisissez votre Groupe</h2>
      <p>Votre groupe" sera la pièce maitresse de votre vélo, tout les autres éléments en découlent.</p>

      <div class="callto">
        <a class="button w100 d50" href="<?= RACINE_SITE; ?>panier/?<?= $urlPanier; ?>">Ajouter au panier</a>
      </div>

    <?php
    break;
    ?>

  <?php } ?>
    <?php
    if($donneesPieces){
      foreach ($donneesPieces as $key => $value) {
    ?>
      <input class="hidden" type="radio" id="<?= $value['id_piece']; ?>" name="<?= $etape; ?>" value="<?= $value['id_piece']; ?>">
      <label for="<?= $value['id_piece']; ?>">
        <div id="selection-<?= $value['id_piece']; ?>" class="blocpiece selection">
          <div class="img_piece">
            <img src="<?= RACINE_SITE.$value['img']; ?>" alt="<?= $value['titre']; ?>">
          </div>
          <div class="details_piece">
            <p class="titre"><?= $value['titre']; ?></p>
            <p class="description"><?= $value['description']; ?></p>
            <?php if(($value['pignon'] && $value['plateau']) == null) { ?>
              <p><b>Matière</b> : <?= ucfirst($value['matiere']); ?></p>
              <?php } else { ?>
                <p><b>Groupe</b> : <?= $value['plateau'].'/'.$value['pignon']; ?></p>
              <?php } ?>
            <p><b>Poids</b> : <?= $value['poids']; ?> Kilos</p>
            <p><b>Prix</b> : <?= $value['prix']; ?> €</p>
          </div>
        </div>
      </label>
    <?php } ?>
    <div class="form-group submit">
      <input type="submit" value="Valider">
    </div>
    <?php } ?>
  </form>
  <?php if(!empty($donneesPieces) || $etape === 'confirmation'){ ?>
    <h2>Informations sur votre vélo :</h2>
    <p>Poids : <?= $poids; ?> Kilos.</p>
    <p>Prix : <?= $prix; ?> € TTC.</p>
  <?php } ?>

<?php } ?>