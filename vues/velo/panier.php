<?php
include '../vues/include/dialogue.php';
if($avis){
?>

  <div class="callto">
    <a class="button w100 d50" href="<?= RACINE_SITE; ?>panier/votre-avis/?avis=<?= $avis; ?>">Laisser un avis sur la commande</a>
  </div>

<?php } ?>

<h2>Votre panier</h2>
<p>Ici, vous pouvez modifier votre panier ou valider votre commande.</p>

<?php if(isset($_SESSION['panier'])) { ?>

  <pre>
    <?php var_dump($_SESSION['panier']); ?>
  </pre>
<div class="tableau">
  <div class="head">
    <div class="cel w20">Référence</div>
    <div class="cel w15">Type de Vélo</div>
    <div class="cel w15">Sexe</div>
    <div class="cel w20">Quantité</div>
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
        <span class="w10 img"><a href="<?= RACINE_SITE; ?>panier/?supp_velo=<?= $key; ?>" onclick="return(confirm('Supprimer ce vélo du panier ?'));"><img src="<?= RACINE_SITE; ?>img/supp.png" alt="Supprimer" title="Supprimer"></a></span>
      </li>
    <?php } ?>
    <li>
      <span class="w50"></span>
      <span class="w15">Total du panier</span>
      <span class="w25"><?= $total; ?> € TTC</span>
    </li>
  </ul>
</div>
<?php if($userConnect) { ?>
  <form class="large" action="<?= RACINE_SITE; ?>panier/" method="post">
    <p><input type="checkbox" id="cgv" name="cgv" required> <label for="cgv">J'accepte les conditions générales de vente (<a href="<?= RACINE_SITE; ?>cgv/">Voir</a>)</label></p>
    <div class="form-group submit">
      <input type="submit" name="payer" value="Payer la commande">
    </div>
  </form>
<?php } else { ?>
  <p>Vous devez vous connecter ou créer votre compte pour passer votre commande.</p>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>connexion/">Se connecter</a>
    </div>
  </div>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>creation-compte/">Créer mon compte</a>
    </div>
  </div>
<?php } ?>
<div class="callto">
  <a class="button w100 d50 warning" href="<?= RACINE_SITE; ?>panier/?supp_velo=panier" onclick="return(confirm('Voulez-vous vraiment vider le panier ?'));">Vider le panier</a>
</div>
<?php } else { ?>
  <p>Votre panier est vide !</p>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?php if($userConnect) {
          echo RACINE_SITE.'votre-velo/';
      } else {
          echo RACINE_SITE.'connexion/';
      } ?>">Voir mon vélo</a>
    </div>
  </div>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration/">Configurer mon vélo</a>
    </div>
  </div>
<?php } ?>
