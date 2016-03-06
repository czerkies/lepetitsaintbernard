<?php
include '../vues/include/dialogue.php';
?>

<h2>Votre panier</h2>
<p>Ici, vous pouvez modifier votre panier ou valider votre commande.</p>


<div class="tableau">
  <div class="head">
    <div class="cel w20">Référence</div>
    <div class="cel w15">Type de Vélo</div>
    <div class="cel w15">Sexe</div>
    <div class="cel w20">Quantite</div>
    <div class="cel w20">Prix</div>
    <div class="cel w10">Supprimer</div>
  </div>
  <ul class="body">
    <?php foreach($_SESSION['panier'] as $key => $value) { ?>
      <li>
        <span class="w20"><?= $key; ?></span>
        <span class="w15"><?= ucfirst($value['type_velo']); ?></span>
        <span class="w15"><?= ucfirst($value['sexe']); ?></span>
        <span class="w20 input">
          <form class="" action="<?= RACINE_SITE; ?>panier/" method="post">
            <input type="hidden" name="id_velo" value="<?= $key; ?>" required>
            <input type="number" name="quantite" min="0" value="<?= $value['quantite']; ?>" title="Rentrer la quantité à modifier" placeholder="00" required>
            <input type="submit" name="update_quantite" value="Ok">
          </form>
        </span>
        <span class="w20"><?= $value['quantite'] * $value['prix']; ?> € TTC</span>
        <span class="w10"><a href="<?= RACINE_SITE; ?>panier/?supp_velo=<?= $key; ?>">X</a></span>
      </li>
    <?php } ?>
    <li>
      <span class="w50"></span>
      <span class="w15">Total du panier</span>
      <span class="w25"><?= $total; ?> € TTC</span>
    </li>
  </ul>
</div>


<?php
echo '<pre>';
//var_dump($_SESSION['panier']);
echo '</pre>';
?>
