<?php
if($userConnect){

?>

<h2>Vos vélos unique</h2>

<p>Hello</p>

<?php foreach ($veloPerso as $key => $typeVelo) { ?>
  <h2><?= ucfirst($key); ?></h2>
  <?php
  $getUrl = '';
  $prix[$key] = 0;
  $poids[$key] = 0;
  foreach ($typeVelo as $type => $donnees) { ?>
    <div class="blocpiece">
      <?php if(!empty($donnees)) { ?>
      <div class="img_piece">
        <p class="type_piece"><?= ucfirst($type); ?></p>
        <img src="<?= RACINE_SITE.$donnees['img']; ?>" alt="<?= $donnees['titre']; ?>">
      </div>
      <div class="details_piece">
        <p class="titre"><?= $donnees['titre']; ?></p>
        <p class="description"><?= $donnees['description']; ?></p>
        <?php if(($donnees['pignon'] && $donnees['plateau']) == null) { ?>
          <p><b>Matière</b> : <?= ucfirst($donnees['matiere']); ?></p>
          <?php } else { ?>
            <p><b>Groupe</b> : <?= $donnees['plateau'].'/'.$donnees['pignon']; ?></p>
            <?php } ?>
        <p><b>Poids</b> : <?= $donnees['poids']; ?> Kilos</p>
        <p><b>Prix</b> : <?= $donnees['prix']; ?> €</p>
      </div>
      <?php } else { ?>
        <div class="details_piece">
          <p class="description">
            Aucune pièce de type <?= $type; ?> n'a été trouvé.<br>
            Veuillez configurer votre vélo ou faire une demande de pièce via la page <a href="<?= RACINE_SITE; ?>contact/">contact.</a>
          </p>
        </div>
      <?php } ?>
    </div>
  <?php
    $getUrl .= $donnees['type_piece'].'='.$donnees['id_piece'];
    if($donnees['type_piece'] != 'groupe'){
      $getUrl .= '&';
    }
    $prix[$key] += $donnees['prix'];
    $poids[$key] += $donnees['poids'];
  }
  ?>
  <?php if(!array_search(null, $typeVelo)) { ?>
    <div class="blocpiece">
      <div class="img_piece">
        <p class="type_piece"><?= ucfirst($key); ?></p>
        <img src="<?= RACINE_SITE.$donnees['type_velo']; ?>" alt="<?= $donnees['type_velo']; ?>">
      </div>
      <div class="details_piece">
        <p class="titre">Récapitulatif</p>
        <p class="description">
          Voici le récapitulatif de votre vélo.
          Vous pouvez désormais l'ajouter au panier.
        </p>
        <p><b>Prix du vélo</b> : <?= $prix[$key]; ?> € TTC.</p>
        <p><b>Poids du vélo</b> : <?= $poids[$key]; ?> Kilos.</p>
      </div>
    </div>
    <div class="callto">
      <a class="button w100 d50" href="?<?= $getUrl; ?>">Ajouter au panier</a>
    </div>
    <?php var_dump($_GET); ?>
    <?php } ?>

<?php } ?>

<?php
}
