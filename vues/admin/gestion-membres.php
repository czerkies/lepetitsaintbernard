<?php if($userConnectAdmin){ ?>
<h2>Gestion des membres</h2>
<p>Gérer les membres. Supprimer un membre. Ajouter un administrateur.</p>
<?php if($listeMembres){ ?>
  <div class="tableau">
    <div class="head">
      <div class="cel w5">ID</div>
      <div class="cel w20">Email</div>
      <div class="cel w20">Prénom</div>
    </div>
    <ul class="body">
      <?php foreach($listeMembres as $value) { ?>
        <li>
          <span class="w5"><?= $value['id_membre']; ?></span>
          <span class="w20"><?= $value['email']; ?></span>
          <span class="w20"><?= $value['prenom']; ?></span>
        </li>
      <?php } ?>
    </ul>
  </div>
<?php } else { ?>
  <p>Aucun membre trouvés</p>
<?php } ?>
<?php }
