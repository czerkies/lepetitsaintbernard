<?php

$formulaire->fieldsFormInput('Email', 'email', 'email', 'Email', "Il vous servira d'identifiant", $msg);

$formulaire->fieldsFormInput('Mot de passe', 'password', 'mdp', 'Mot de passe', "Doit contenir au moins une majuscule ou chiffre", $msg);

$formulaire->fieldsFormInput('Nom', 'text', 'nom', 'Nom', "Votre Nom est obligatoire", $msg);

$formulaire->fieldsFormInput('Prénom', 'text', 'prenom', 'Prénom', "Votre Prénom est obligatoire", $msg);

?>

<div class="form-group radio <?php if(isset($msg['error']['sexe'])) echo 'error-form'; ?>">
  <label>Sexe</label>
  <input type="radio" id="homme" name="sexe" value="homme" checked>
  <label for="homme">Homme</label>
  <input type="radio" id="femme" name="sexe" value="femme" <?php if(isset($_POST['sexe']) && $_POST['sexe'] === 'femme') echo 'checked'; ?>>
  <label for="femme">Femme</label>
</div>

<?php

$formulaire->fieldsFormInput('Age', 'number', 'age', 'Age', "Votre age en année", $msg, null, null, 'min="16"');

$formulaire->fieldsFormInput('Taille', 'number', 'taille', '000', "Votre taille en centimètres", $msg, null, null, 'min="150"');

$formulaire->fieldsFormInput('Poids', 'number', 'poids', 'Poids', "Votre poids en kilogrammes", $msg, null, null, 'min="40"');

$valuesType = ['route' => 'Route', 'vtt' => 'VTT', 'both' => 'Les deux'];
echo $formulaire->fieldsFormSelect('Type de vélo', $valuesType, 'type', 'Choisissez votre type de vélo', $msg);


$formulaire->fieldsFormInput('Prix maximum', 'number', 'budget', '0000', "Donnez nous votre budget maximum en euros", $msg, null, null, 'min="1"');

$formulaire->fieldsFormInput('Adresse', 'text', 'adresse', 'Adresse', "Entrez une adresse complète pour la livraison et facturation", $msg, null, 'w100');

$formulaire->fieldsFormInput('Code postal', 'text', 'cp', '00000', "Code postal en chiffre uniquement", $msg);

$formulaire->fieldsFormInput('Ville', 'text', 'ville', 'Ville', "Ville obligatoire", $msg);
