<?php if($userConnectAdmin){ ?>
<h2>Gestion des membres</h2>
<p>Gérer les membres. Supprimer un membre. Ajouter un administrateur.</p>
<div class="bloc w50">
  <div class="callto">
    <a class="button w100 d100 <?php if(!$meta['add']) echo 'actif'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-membres/">Liste des utilisateurs</a>
  </div>
</div>
<div class="bloc w50">
  <div class="callto">
    <a class="button w100 d100 <?php if($meta['add']) echo 'actif'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-membres/ajouter-administrateur/">Ajouter un administrateur</a>
  </div>
</div>
<?php
if(!$meta['add']){
  if($listeMembres){
    include '../vues/include/dialogue.php';
?>
    <div class="tableau">
      <div class="head">
        <div class="cel w5">ID</div>
        <div class="cel w20">Prénom</div>
        <div class="cel w20">Nom</div>
        <div class="cel w20">Email</div>
        <div class="cel w20">Ville</div>
        <div class="cel w5">Supp.</div>
      </div>
      <ul class="body">
        <?php foreach($listeMembres as $value) { ?>
          <li>
            <span class="w5"><?= $value['id_membre']; ?></span>
            <span class="w20"><?= $value['prenom']; ?></span>
            <span class="w20"><?= $value['nom']; ?></span>
            <span class="w20"><?= $value['email']; ?></span>
            <span class="w20"><?= $value['ville']; ?></span>
            <span class="w5"><?php if($value['statut'] == 0) { ?>
              <a href="<?= RACINE_SITE; ?>admin/gestion-membres/suppression/<?= $value['id_membre']; ?>">X</a>
            <?php } ?>
            </span>
          </li>
        <?php } ?>
      </ul>
    </div>
  <?php } else { ?>
    <p>Aucun membre trouvés</p>
  <?php
    }
  } else {
  ?>
  <h2>Ajouter un membre</h2>
  <?php include '../vues/include/dialogue.php'; ?>
  <form class="large" action="" method="post">
    <?php include '../vues/include/formulaire-membre.php'; ?>
    <div class="form-group submit">
      <input type="submit" value="Créer l'adminisrateur">
    </div>
  </form>
<?php } ?>

<?php }
