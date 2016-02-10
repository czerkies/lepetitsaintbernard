<form class="large" action="" method="post">

  <?= $formulaire->fieldsFormInput('Email', 'email', 'email', 'Email', "Il vous servira d'identifiant", $msg); ?>

  <?= $formulaire->fieldsFormInput('Mot de passe', 'password', 'mdp', 'Mot de passe', "Doit contenir au moins une majuscule ou chiffre", $msg); ?>

  <?= $formulaire->fieldsFormInput('Nom', 'text', 'nom', 'Nom', "Votre Nom est obligatoire", $msg); ?>

  <?= $formulaire->fieldsFormInput('Prénom', 'text', 'prenom', 'Prénom', "Votre Prénom est obligatoire", $msg); ?>

  <div class="form-group radio <?php if(isset($msg['error']['sexe'])) echo 'error-form'; ?>">
    <label>Sexe</label>
    <input type="radio" id="homme" name="sexe" value="homme" checked>
    <label for="homme">Homme</label>
    <input type="radio" id="femme" name="sexe" value="femme" <?php if(isset($_POST['sexe']) && $_POST['sexe'] === 'femme') echo 'checked'; ?>>
    <label for="femme">Femme</label>
  </div>

  <?= $formulaire->fieldsFormInput('Age', 'number', 'age', 'Age', "Votre age en année", $msg); ?>

  <?= $formulaire->fieldsFormInput('Taille', 'number', 'taille', '000', "Votre taille en centimètres", $msg); ?>

  <?= $formulaire->fieldsFormInput('Poids', 'number', 'poids', 'Poids', "Votre poids en kilogrammes", $msg); ?>

  <div class="form-group <?php if(isset($msg['error']['type'])) echo 'error-form'; ?>">
    <label for="type">Type de vélo</label>
    <select name="type">
      <option disabled>Choisissez votre type de vélo</option>
      <option value="route">Route</option>
      <option value="vtt"
      <?php if(isset($_POST['type']) && $_POST['type'] === 'vtt') echo "selected"; ?>
      >VTT</option>
      <option value="both"
      <?php if(isset($_POST['type']) && $_POST['type'] === 'both') echo "selected"; ?>
      >Les deux</option>
    </select>
    <em>Choisissez votre type de vélo</em>
  </div>

  <?= $formulaire->fieldsFormInput('Prix maximum', 'number', 'budget', '0000', "Donnez nous votre budget maximum en euros", $msg); ?>

  <?= $formulaire->fieldsFormInput('Adresse', 'text', 'adresse', 'Adresse', "Entrez une adresse complète pour la livraison et facturation", $msg, 'w100'); ?>

  <?= $formulaire->fieldsFormInput('Code postal', 'text', 'cp', '00000', "Code postal en chiffre uniquement", $msg); ?>

  <?= $formulaire->fieldsFormInput('Ville', 'text', 'ville', 'Ville', "Ville obligatoire", $msg); ?>

  <div class="form-group submit">
    <input type="submit" value="Créer mon compte">
  </div>

</form>
