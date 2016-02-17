<input type="hidden" name="type_piece" value="<?= $dataGet['piece']; ?>" required>

<?php

$formulaire->fieldsFormInput('Nom de la pièce', 'text', 'titre', 'Nom de la pièce', 'Indiquer le nom de la pièce (30 carractères max.)', $msg);

$formulaire->fieldsFormSelect('Type de vélo', $select['type_velo'], 'type_velo', 'Type de vélo pour votre nouvelle pièce', $msg);

$formulaire->fieldsFormInput('Poids de la pièce', 'number', 'poids', 'Poids de la pièce', 'Indiquer le poids de la pièce en grammes', $msg, false, false, 'min="1"');

$formulaire->fieldsFormInput('Prix', 'number', 'prix', '0000', 'Indiquer un prix en Euros', $msg, false, false, 'min="1"');

$formulaire->fieldsFormInput('Quantité', 'number', 'quantite', '00', 'Ajouter la quantité de la pièce disponible', $msg, false, false, 'min="1"');

switch ($dataGet['piece']) {
  case 'cadre':

  $formulaire->fieldsFormSelect('Matière du cadre', $select['matiere'], 'matiere', 'Matière du cadre', $msg);

  $formulaire->fieldsFormSelect('Taille de votre cadre', $select['taille'], 'id_taille', 'Taille de votre cadre en centimètre', $msg);

  $formulaire->fieldsFormSelect('Cadre pour homme ou femme', $select['sexe'], 'sexe', 'Votre cadre est pour homme ou femme', $msg);

break;
case 'roue':

  $formulaire->fieldsFormSelect('Matière de la roue', $select['matiere'], 'matiere', 'Matière de la roue', $msg);

  $formulaire->fieldsFormSelect('Quelle taille de cadre pour les roues', $select['taille'], 'id_taille', 'Pour quel cadre les roue doivent s\'adapter', $msg);

break;
case 'selle':

  $formulaire->fieldsFormSelect('Matière de la selle', $select['matiere'], 'matiere', 'Matière de la selle', $msg);

  $formulaire->fieldsFormSelect('Selle pour homme ou femme', $select['sexe'], 'sexe', 'Votre selle est pour homme ou femme', $msg);

break;
case 'guidon':

  $formulaire->fieldsFormSelect('Matière du guidon', $select['matiere'], 'matiere', 'Matière du guidon', $msg);

  $formulaire->fieldsFormSelect('Guidon pour homme ou femme', $select['sexe'], 'sexe', 'Votre guidon est pour homme ou femme', $msg);

  $formulaire->fieldsFormSelect('Taille du cadre pour le guidon', $select['taille'], 'id_taille', 'Pour quel cadre le guidon doit s\'adapter', $msg);

break;
case 'groupe':

  $formulaire->fieldsFormSelect('Dents grand Pignon', $select['pignon'], 'pignon', 'Chosissez le nombre de dents sur le grand pignon', $msg);

  $formulaire->fieldsFormSelect('Dents grand Plateau', $select['plateau'], 'plateau', 'Chosissez le nombre de dents sur le grand plateau', $msg);

break;

} ?>

<div class="form-group w100 <?php if(isset($msg['error']['description'])) echo ' error-form'; ?>">
  <label for="description">Description</label>
  <textarea name="description" id="description" placeholder="Description de la pièce" required><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
  <em>Entrez une description de la pièce (250 carractères max).</em>
</div>

<?php $formulaire->fieldsFormInput('Photo de la pièce', 'file', 'img', '', 'Photo au format ".jpg" uniquement', $msg, false, 'w100', 'accept="image/jpeg"'); ?>
