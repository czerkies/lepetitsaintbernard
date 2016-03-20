<div class="etape_accueil">
  <h2>Configurez, commandez et c'est livré.</h2>
  <p>Avec <strong>Le petit Saint Bernard</strong>, il est très facile de choisir votre vélo : Il suffit simplement de créer votre compte et nous vous proposons la meilleure solution, sur mesure. Vous pouvez aussi configurer votre vélo avec une aide à chaque étape.<br>Avec <strong>Le petit Saint Bernard</strong>, votre vélo sera unique et uniquement pour vous.</p>
</div>
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
<div class="etape_accueil">
  <h2>Le petit Saint Bernard ?</h2>
  <p>Le petit Saint Bernard est un spécialiste de la configuration personnalisée en vélo de montagne.<br>Nos magasin et usine se situent en Rhône-Alpes dans la ville de Bourg Saint Maurice. La fabrication de votre configuration est faite à la main.</p>
  <h2>Col du Galibier ou cross country dans le beaufortain ?</h2>
  <p>Nous vous proposons les meilleurs vélos pour gravir les cols les plus difficiles aux descentes les plus pentues.</p>
  <h2>Trouver son vélo</h2>
  <p>Pour trouver son vélo parfait, rien de plus simple, après avoir créé votre profil, nous vous proposerons les vélos qui vous conviendraient le mieux.<br>Nous prenons en compte les critères suivants :</p>
</div>
<?php include '../vues/include/configuration-elements.php'; ?>
<div class="etape_accueil">
  <h2>Notre catalogue</h2>
  <p>N'hésitez pas à consulter notre catalogue pour découvrir toutes les pièces disponibles.</p>
  <div class="callto">
    <a class="button w100 d50" href="<?= RACINE_SITE; ?>catalogue/">Consulter le catalogue</a>
  </div>
</div>
<div class="etape_accueil">
  <h2>Les avis</h2>
  <div class="avis_accueil">
    <?php $i=1; foreach ($avisRand as $value) { ?>
    <div class="avis_<?= $i; ?>">
      <p class="avis_pseudo"><?= $value['pseudo']; ?></p>
      <p class="avis_avis"><?= $value['avis']; ?></p>
      <p class="avis_date"><em><?= $value['date_fr']; ?></em></p>
    </div>
    <?php $i++; } ?>
  </div>
</div>
<div class="etape_accueil">
  <h2>Garantie et support</h2>
  <p>Chaque vélo est garanti pour une durée de 3 ans, notre support technique et commercial est à votre disposition.<br>Vous pouvez nous contacter à tout moment, par notre formulaire de <a href="<?= RACINE_SITE;?>contact/">contact</a> ou par téléphone au numéro suivant : 01 02 03 04 05.</p>
</div>
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
