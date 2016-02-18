<?php if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

  include '../vues/include/dialogue.php';

  if(!$modifPiece) {

?>
<?php foreach ($donneesParPiece as $key => $piece) { ?>

  <h2 id="<?= $key; ?>">Les <?= ucfirst($key); ?>s</h2>
  <?php if($donneesParPiece[$key]){ ?>
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
        <?php foreach($donneesParPiece[$key] as $value) { ?>
          <li>
            <span class="w5"><?= $value['id_piece']; ?></span>
            <span class="w20"><?= $value['titre']; ?></span>
            <span class="w20"><?= $value['type_velo']; ?></span>
            <span class="w5"><?= $value['id_taille']; ?></span>
            <span class="w5"><?= $value['quantite']; ?></span>
            <span class="w20">
              <form action="#<?= $key; ?>" method="post">
                <input name="id_piece" type="hidden" value="<?= $value['id_piece']; ?>" required>
                <input name="quantite" type="number" min="-<?= $value['quantite']; ?>" placeholder="00" required><input type="submit" name="upadateQuantite" value="Ok">
              </form>
            </span>
            <span class="w5"><a href="<?= RACINE_SITE; ?>admin/gestion-stocks/modification/<?= $value['id_piece']; ?>"> | </a></span>
            <span class="w5"><a href="<?= RACINE_SITE; ?>admin/gestion-stocks/suppression/<?= $value['id_piece']; ?>">X</a></span>
          </li>
        <?php } ?>
      </ul>
    </div>
  <?php } else { ?>
    <p>Il n'y a aucun <?= ucfirst($key); ?>.</p>
  <?php } ?>
  <div class="callto">
    <a class="button w100 d50" href="<?= RACINE_SITE; ?>admin/ajouter-reference/?piece=<?= $key; ?>#ajout">Ajouter <?= ucfirst($key); ?></a>
  </div>
<?php } ?>

<?php } else { ?>

  <h2 id="modification">Modification de la pièce <b>Ref.<?= $modifPiece['id_piece']; ?></b></h2>

  <form class="large" action="#modification" enctype="multipart/form-data" method="post">

    <input type="hidden" name="id_piece" value="<?= $modifPiece['id_piece']; ?>" required>

    <?php include '../vues/include/formulaire-stock.php'; ?>

    <div class="form-group submit">
      <input type="submit" name="update" value="Modifier la pièce">
    </div>

  </form>

<?php } ?>

<?php }
