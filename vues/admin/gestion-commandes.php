<?php if($userConnectAdmin){ ?>

<?php include '../vues/include/dialogue.php'; ?>

<?php if($donneesCmdVelo['cmd']){ ?>

<h2 id="details">Commande <?= $donneesCmdVelo['cmd']['id_commande_velo']; ?> en details</h2>

<p>
  <b>La commande a été passé par :</b> <?= strtoupper($donneesCmdVelo['cmd']['nom']).' '.ucfirst($donneesCmdVelo['cmd']['prenom']); ?>.<br>
  <b>À la date du :</b> <?= $donneesCmdVelo['cmd']['date_commande']; ?>.<br>
  <b>Total de la commande :</b> <?= $donneesCmdVelo['cmd']['total']; ?> €.<br>
</p>
<div class="tableau">
  <div class="head">
    <div class="cel w20">Ref. Vélo</div>
    <div class="cel w15">Type</div>
    <div class="cel w15">Sexe</div>
    <div class="cel w15">Prix</div>
    <div class="cel w20">Poids</div>
    <div class="cel w15">Quantite</div>
  </div>
  <ul class="body">
    <?php foreach($donneesCmdVelo['liste'] as $value) { ?>
      <li>
        <span class="w20"><?= $value['reference']; ?></span>
        <span class="w15"><?= ucfirst($value['type_velo']); ?></span>
        <span class="w15"><?= ucfirst($value['sexe']); ?></span>
        <span class="w15"><?= $value['prix']; ?> €</span>
        <span class="w20"><?= $value['poids']; ?> Kilos</span>
        <span class="w15"><?= $value['quantite']; ?></span>
      </li>
    <?php } ?>
  </ul>
</div>

<div class="callto">
  <a class="button w100 d50 warning" href="<?=RACINE_SITE; ?>admin/gestion-commandes/?supp=<?= $donneesCmdVelo['cmd']['id_commande']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer la commande ?'));">Supprimer la commande</a>
</div>

<?php } if(!empty($listeCommandes)){ ?>

  <h2>Les commandes</h2>

  <p>Le CA de l'entreprise s'élève à : <b><?= $caLpsbHT; ?></b> € TTC.</p>

  <div class="tableau">
    <div class="head">
      <div class="cel w10">ID</div>
      <div class="cel w15">Nom</div>
      <div class="cel w15">Prénom</div>
      <div class="cel w20">Email</div>
      <div class="cel w20">Montant</div>
      <div class="cel w15">Date</div>
      <div class="cel w5">Supp.</div>
    </div>

    <ul class="body">
      <?php foreach($listeCommandes as $value) { ?>
          <li <?php if(isset($_GET['details']) && $value['id_commande'] === $_GET['details']) echo 'class="select"'; ?>>
            <a href="<?= RACINE_SITE; ?>admin/gestion-commandes/details/<?= $value['id_commande']; ?>#details">
              <span class="w10"><?= $value['id_commande_velo']; ?></span>
              <span class="w15"><?= ucfirst($value['nom']); ?></span>
              <span class="w15"><?= ucfirst($value['prenom']); ?></span>
              <span class="w20"><?= $value['email']; ?></span>
              <span class="w20"><?= $value['total']; ?> €</span>
              <span class="w15"><?= $value['date_commande']; ?></span>
            </a>
            <span class="cel w5 img"><a href="<?=RACINE_SITE; ?>admin/gestion-commandes/?supp=<?= $value['id_commande']; ?>" onclick="return(confirm('Supprimer cette commande ?'));"><img src="<?= RACINE_SITE; ?>img/supp.png" alt="Supprimer" title="Supprimer"></a></span>
          </li>
        </a>
      <?php } ?>
    </ul>

  </div>
<?php } ?>

<?php } ?>
