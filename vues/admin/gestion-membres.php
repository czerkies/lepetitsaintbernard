<?php if($userConnectAdmin){ ?>
<h2>Gestion des membres</h2>
<p>Gérer les membres. Supprimer un membre. Ajouter un administrateur.</p>
<?php if($listeMembres){ ?>
  <?php include '../vues/dialogue.php'; ?>
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
<?php } ?>
<?php }
