<?php if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

?>
<h2 id="cadres">Les Cadres</h2>
<?php if($cadres){ ?>
  <?php var_dump($_POST); ?>
  <div class="tableau">
    <div class="head">
      <div class="cel w5">Réf.</div>
      <div class="cel w20">Titre</div>
      <div class="cel w20">Type de Vélo</div>
      <div class="cel w20">Stock</div>
      <div class="cel w20">Modifier</div>
      <div class="cel w10"></div>
    </div>
    <ul class="body">
      <?php foreach($cadres as $value) { ?>
        <li>
          <span class="w5"><?= $value['id_cadre']; ?></span>
          <span class="w20"><?= $value['titre']; ?></span>
          <span class="w20"><?= $value['type_velo']; ?></span>
          <span class="w20"><?= $value['stock']; ?></span>
          <span class="w20">
            <form action="#cadres" method="post">
              <input name="id_cadre" type="hidden" value="<?= $value['id_cadre']; ?>" required>
              <input name="quantite" type="number" min="-<?= $value['stock']; ?>" placeholder="00" required><input type="submit" value="Ok">
            </form>
          </span>
          <span class="w5"><a href="<?= RACINE_SITE; ?>admin/gestion-membres/suppression/<?= $value['id_cadre']; ?>"> | </a></span>
          <span class="w5"><a href="<?= RACINE_SITE; ?>admin/gestion-membres/suppression/<?= $value['id_cadre']; ?>">X</a></span>
        </li>
      <?php } ?>
    </ul>

  </div>
<?php } else { ?>
  <p>Il n'y a aucun cadre</p>
  <div class="callto">
    <a class="button w100 d50" href="<?= RACINE_SITE; ?>admin/ajouter-reference/?piece=cadre#ajout">Ajouter un cadre</a>
  </div>
<?php } ?>
<?php }
