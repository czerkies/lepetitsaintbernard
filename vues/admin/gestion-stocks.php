<?php if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

  include '../vues/include/dialogue.php';

?>

<?php foreach ($donnesParPiece as $piece) { ?>

  <h2 id="<?= $piece; ?>">Les <?= ucfirst($piece); ?></h2>
  <?php if($donnesParPiece[$piece]){ ?>
    <div class="tableau">
      <div class="head">
        <div class="cel w5">Réf.</div>
        <div class="cel w20">Titre</div>
        <div class="cel w20">Type de Vélo</div>
        <div class="cel w5">Taille</div>
        <div class="cel w5">Stock</div>
        <div class="cel w20">Modifier</div>
        <div class="cel w10"></div>
      </div>
      <ul class="body">
        <?php foreach($donnesParPiece[$piece] as $value) { ?>
          <li>
            <span class="w5"><?= $value['id_piece']; ?></span>
            <span class="w20"><?= $value['titre']; ?></span>
            <span class="w20"><?= $value['type_velo']; ?></span>
            <span class="w5"><?= $value['id_taille']; ?></span>
            <span class="w5"><?= $value['quantite']; ?></span>
            <span class="w20">
              <form action="#<?= $piece; ?>" method="post">
                <input name="id_piece" type="hidden" value="<?= $value['id_piece']; ?>" required>
                <input name="quantite" type="number" min="-<?= $value['quantite']; ?>" placeholder="00" required><input type="submit" value="Ok">
              </form>
            </span>
            <span class="w5"><a href="<?= RACINE_SITE; ?>admin/gestion-stocks/modification/<?= $value['id_piece']; ?>"> | </a></span>
            <span class="w5"><a href="<?= RACINE_SITE; ?>admin/gestion-stocks/suppression/<?= $value['id_piece']; ?>">X</a></span>
          </li>
        <?php } ?>
      </ul>

    </div>
  <?php } else { ?>
    <p>Il n'y a aucun <?= ucfirst($piece); ?>.</p>
    <div class="callto">
      <a class="button w100 d50" href="<?= RACINE_SITE; ?>admin/ajouter-reference/?piece=<?= $piece; ?>#ajout">Ajouter un <?= ucfirst($piece); ?></a>
    </div>
  <?php } ?>

<?php } ?>

<?php }
