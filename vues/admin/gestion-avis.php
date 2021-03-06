<?php if($userConnectAdmin){ ?>

  <h2>Gestion des avis</h2>

  <p>Visualisation des avis et suppression des avis abusifs.</p>

  <?php include '../vues/include/dialogue.php'; ?>

  <?php if($avisDonnees){ ?>

  <div class="tableau">
    <div class="head">
      <div class="cel w10">Ref. CMD</div>
      <div class="cel w20">Membre</div>
      <div class="cel w50">Avis</div>
      <div class="cel w15">Date</div>
      <div class="cel w5">Supp.</div>
    </div>
    <ul class="body">
      <?php foreach($avisDonnees as $value) { ?>
        <li>
          <span class="w10"><a title="Détails de la commande" href="<?= RACINE_SITE.'admin/gestion-commandes/details/'.$value['id_commande']; ?>"><?= $value['id_commande_velo']; ?></a></span>
          <span class="w20"><?= strtoupper($value['nom']).' '.ucfirst($value['prenom']); ?></span>
          <span class="w50"><?= $value['avis']; ?></span>
          <span class="w15"><?= $value['date_fr']; ?></span>
          <span class="w5 img"><a href="<?= RACINE_SITE; ?>admin/gestion-avis/supp/<?= $value['id_avis']; ?>" onclick="return(confirm('Supprimer cet avis ?'));"><img src="<?= RACINE_SITE; ?>img/supp.png" alt="Supprimer" title="Supprimer"></a></span>
        </li>
      <?php } ?>
    </ul>
  </div>

  <?php } else { ?>

    <p>Aucun avis n'a été déposé sur le site.</p>

  <?php } ?>

<?php } ?>
