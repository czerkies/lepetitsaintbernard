<?php if($userConnect){ ?>

<h2>Votre vélo</h2>

<p>Voici votre vélo unique : Il a été confectionné pour correspondre au mieux, aux informations que vous nous avez données.</p>

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
        <img class="heightmax" src="<?= RACINE_SITE; ?>img/logo_lpsb.png" alt="Le petit St.Bernard">
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
      <a class="button w100 d50" href="<?= RACINE_SITE; ?>panier/?<?= $getUrl; ?>">Ajouter au panier</a>
    </div>
    <?php } ?>

<?php } ?>

<?php } else { ?>

  <h2>Votre vélo</h2>

  <p>Pour pouvoir acheter votre vélo, il vous suffis de créer vous connecter ou créer votre compte.</p>

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

<?php }

include '../vues/include/configuration-elements.php'; ?>
