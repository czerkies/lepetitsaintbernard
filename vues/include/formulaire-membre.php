<?php

$formulaire->fieldsFormInput('Email', 'email', 'email', 'Email', "Il vous servira d'identifiant", $msg, 'required');

$formulaire->fieldsFormInput('Mot de passe', 'password', 'mdp', 'Mot de passe', "Doit contenir au moins une majuscule ou chiffre", $msg, 'required');

$formulaire->fieldsFormInput('Nom', 'text', 'nom', 'Nom', "Votre Nom est obligatoire", $msg, 'required');

$formulaire->fieldsFormInput('Prénom', 'text', 'prenom', 'Prénom', "Votre Prénom est obligatoire", $msg, 'required');

?>

<div class="form-group radio <?php if(isset($msg['error']['sexe'])) echo 'error-form'; ?>">
  <label>Sexe</label>
  <input type="radio" id="homme" name="sexe" value="homme" checked>
  <label for="homme">Homme</label>
  <input type="radio" id="femme" name="sexe" value="femme" <?php if(isset($_POST['sexe']) && $_POST['sexe'] === 'femme') echo 'checked'; ?>>
  <label for="femme">Femme</label>
</div>

<?php

$formulaire->fieldsFormInput('Age', 'number', 'age', 'Age', "Votre age en année", $msg, 'min="16" required');

$formulaire->fieldsFormInput('Taille', 'number', 'taille', '000', "Votre taille en centimètres", $msg, 'min="150" required');

$formulaire->fieldsFormInput('Poids', 'number', 'poids', 'Poids', "Votre poids en kilogrammes", $msg, 'min="40" required');

$valuesType = ['route' => 'Route', 'vtt' => 'VTT', 'both' => 'Les deux'];
$formulaire->fieldsFormSelect('Type de vélo', $valuesType, 'type', 'Choisissez votre type de vélo', $msg);


$formulaire->fieldsFormInput('Prix maximum', 'number', 'budget', '0000', "Donnez nous votre budget maximum en euros", $msg, 'min="1" required');

$formulaire->fieldsFormInput('Adresse', 'text', 'adresse', 'Adresse', "Entrez une adresse complète pour la livraison et facturation", $msg, 'required', 'w100');

$formulaire->fieldsFormInput('Code postal', 'text', 'cp', '00000', "Code postal en chiffre uniquement", $msg, 'required');

$formulaire->fieldsFormInput('Ville', 'text', 'ville', 'Ville', "Ville obligatoire", $msg, 'required');
