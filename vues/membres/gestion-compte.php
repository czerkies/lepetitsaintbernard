<?php if($userConnect){ ?>

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

  <?php } if(!empty($listeCommandes)){ ?>

  <h2>Vos 5 dernières commandes</h2>

    <div class="tableau">
      <div class="head">
        <div class="cel w25">ID</div>
        <div class="cel w25">Montant</div>
        <div class="cel w50">Date</div>
      </div>

      <ul class="body">
        <?php foreach($listeCommandes as $value) { ?>
          <a href="<?= RACINE_SITE; ?>mon-compte/details/<?= $value['id_commande']; ?>#details">
            <li <?php if(isset($_GET['details']) && $value['id_commande'] === $_GET['details']) echo 'class="select"'; ?>>
              <span class="w25"><?= $value['id_commande_velo']; ?></span>
              <span class="w25"><?= $value['total']; ?> €</span>
              <span class="w50"><?= $value['date_commande']; ?></span>
            </li>
          </a>
        <?php } ?>
      </ul>

    </div>
  <?php } else { ?>
    
    <p>
      Vous n'avez encore passé aucune commande !<br>
      N'attendez plus pour voir votre vélo parfait ou configurer le votre.
    </p>
    <div class="bloc w50">
      <div class="callto">
        <a class="button w100 d100" href="<?= RACINE_SITE; ?>votre-velo/">Voir mon vélo</a>
      </div>
    </div>
    <div class="bloc w50">
      <div class="callto">
        <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration/">Configurer mon vélo</a>
      </div>
    </div>

  <?php } ?>

  <h2 id="vosInformations">Vos informations</h2>

  <?php include '../vues/include/dialogue.php'; ?>

  <form class="large" action="#vosInformations" method="post">

    <?php

    $formulaire->fieldsFormInput('Email', 'email', 'email', 'Email', "Il vous servira d'identifiant", $msg, false, false, false, 'membre');

    $formulaire->fieldsFormInput('Mot de passe', 'password', 'mdp', 'Mot de passe', "Doit contenir au moins une majuscule ou chiffre", $msg, false, false, false, 'membre');

    $formulaire->fieldsFormInput('Nom', 'text', 'nom', 'Nom', "Votre Nom est obligatoire", $msg, false, false, false, 'membre');

    $formulaire->fieldsFormInput('Prénom', 'text', 'prenom', 'Prénom', "Votre Prénom est obligatoire", $msg, false, false, false, 'membre');

    ?>

    <div class="form-group radio <?php if(isset($msg['error']['sexe'])) echo 'error-form'; ?>">
      <label>Sexe</label>
      <input type="radio" id="homme" name="sexe" value="homme" checked>
      <label for="homme">Homme</label>
      <input type="radio" id="femme" name="sexe" value="femme" <?php if(isset($_POST['sexe']) && $_POST['sexe'] === 'femme') {echo 'checked';} elseif(isset($_SESSION['membre']['sexe']) && $_SESSION['membre']['sexe'] === 'femme') {echo 'checked';} ?>>
      <label for="femme">Femme</label>
    </div>

    <?php

    $formulaire->fieldsFormInput('Age', 'number', 'age', 'Age', "Votre age en année", $msg, false, false, false, 'membre');

    $formulaire->fieldsFormInput('Taille', 'number', 'taille', '000', "Votre taille en centimètres", $msg, false, false, false, 'membre');

    $formulaire->fieldsFormInput('Poids', 'number', 'poids', 'Poids', "Votre poids en kilogrammes", $msg, false, false, false, 'membre');

    $valuesType = ['route' => 'Route', 'vtt' => 'VTT', 'both' => 'Les deux'];
    $formulaire->fieldsFormSelect('Type de vélo', $valuesType, 'type', 'Choisissez votre type de vélo', $msg, false, false, false, 'membre');

    $formulaire->fieldsFormInput('Prix maximum', 'number', 'budget', '0000', "Donnez nous votre budget maximum en euros", $msg, false, false, false, 'membre');

    $formulaire->fieldsFormInput('Adresse', 'text', 'adresse', 'Adresse', "Entrez une adresse complète pour la livraison et facturation", $msg, false, 'w100', false, 'membre');

    $formulaire->fieldsFormInput('Code postal', 'text', 'cp', '00000', "Code postal en chiffre uniquement", $msg, false, false, false, 'membre');

    $formulaire->fieldsFormInput('Ville', 'text', 'ville', 'Ville', "Ville obligatoire", $msg, false, false, false, 'membre');

    ?>

    <div class="form-group submit">
      <input type="submit" name="maj_informations" value="Modifier mes informations">
    </div>

  </form>

<?php }
