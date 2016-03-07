<?php if($userConnectAdmin){ ?>

<h2>Les commandes</h2>

<?php if(!empty($listeCommandes)){ ?>
  <div class="tableau">
    <div class="head">
      <div class="cel w10">ID</div>
      <div class="cel w15">Nom</div>
      <div class="cel w15">Prénom</div>
      <div class="cel w20">Email</div>
      <div class="cel w20">Montant</div>
      <div class="cel w15">Date</div>
    </div>

    <ul class="body">
      <?php foreach($listeCommandes as $value) { ?>
        <li>
          <span class="w10"><?= $value['id_commande_velo']; ?></span>
          <span class="w15"><?= ucfirst($value['nom']); ?></span>
          <span class="w15"><?= ucfirst($value['prenom']); ?></span>
          <span class="w20"><?= $value['email']; ?></span>
          <span class="w20"><?= $value['total']; ?> €</span>
          <span class="w15"><?= $value['date_commande']; ?></span>
        </li>
      <?php } ?>
    </ul>

  </div>
<?php } ?>

<?php } ?>
