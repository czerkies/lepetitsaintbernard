<?php if($userConnect){ ?>
  
  <h2>Vos commandes</h2>
  <p>
    Vous n'avez encore passé aucune commande !<br>
    N'attendez plus pour voir votre vélo parfait ou configurer le votre.
  </p>

  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration/">Mes vélos unique</a>
    </div>
  </div>
  <div class="bloc w50">
    <div class="callto">
      <a class="button w100 d100" href="<?= RACINE_SITE; ?>configuration/">Configurer mon vélo</a>
    </div>
  </div>
  <h2 id="vosInformations">Vos informations</h2>

  <?php include '../vues/include/dialogue.php'; ?>

  <form class="large" action="#vosInformations" method="post">

    <?php

    $formulaire->fieldsFormInput('Email', 'email', 'email', 'Email', "Il vous servira d'identifiant", $msg, false, false, 'membre');

    $formulaire->fieldsFormInput('Mot de passe', 'password', 'mdp', 'Mot de passe', "Doit contenir au moins une majuscule ou chiffre", $msg, false, false, 'membre');

    $formulaire->fieldsFormInput('Nom', 'text', 'nom', 'Nom', "Votre Nom est obligatoire", $msg, false, false, 'membre');

    $formulaire->fieldsFormInput('Prénom', 'text', 'prenom', 'Prénom', "Votre Prénom est obligatoire", $msg, false, false, 'membre');

    ?>

    <div class="form-group radio <?php if(isset($msg['error']['sexe'])) echo 'error-form'; ?>">
      <label>Sexe</label>
      <input type="radio" id="homme" name="sexe" value="homme" checked>
      <label for="homme">Homme</label>
      <input type="radio" id="femme" name="sexe" value="femme" <?php if(isset($_POST['sexe']) && $_POST['sexe'] === 'femme') {echo 'checked';} elseif(isset($_SESSION['membre']['sexe']) && $_SESSION['membre']['sexe'] === 'femme') {echo 'checked';} ?>>
      <label for="femme">Femme</label>
    </div>

    <?php

    $formulaire->fieldsFormInput('Age', 'number', 'age', 'Age', "Votre age en année", $msg, false, false, 'membre');

    $formulaire->fieldsFormInput('Taille', 'number', 'taille', '000', "Votre taille en centimètres", $msg, false, false, 'membre');

    $formulaire->fieldsFormInput('Poids', 'number', 'poids', 'Poids', "Votre poids en kilogrammes", $msg, false, false, 'membre');

    $valuesType = ['route' => 'Route', 'vtt' => 'VTT', 'both' => 'Les deux'];
    echo $formulaire->fieldsFormSelect('Type de vélo', $valuesType, 'type', 'Choisissez votre type de vélo', $msg, false, false, 'membre');

    $formulaire->fieldsFormInput('Prix maximum', 'number', 'budget', '0000', "Donnez nous votre budget maximum en euros", $msg, false, false, 'membre');

    $formulaire->fieldsFormInput('Adresse', 'text', 'adresse', 'Adresse', "Entrez une adresse complète pour la livraison et facturation", $msg, 'w100', false, 'membre');

    $formulaire->fieldsFormInput('Code postal', 'text', 'cp', '00000', "Code postal en chiffre uniquement", $msg, false, false, 'membre');

    $formulaire->fieldsFormInput('Ville', 'text', 'ville', 'Ville', "Ville obligatoire", $msg, false, false, 'membre');

    ?>

    <div class="form-group submit">
      <input type="submit" name="maj_informations" value="Modifier mes informations">
    </div>

  </form>

<?php }
