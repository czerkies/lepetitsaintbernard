<?php

  if(isset($dataGet['type_piece'])) {
    $typePieceForm = $dataGet['type_piece'];
  } elseif(isset($modifPiece['type_piece'])) {
    $typePieceForm = $modifPiece['type_piece'];
  }

?>

<input type="hidden" name="type_piece" value="<?= $typePieceForm; ?>">

<?php

$formulaire->fieldsFormInput('Nom de la pièce', 'text', 'titre', 'Nom de la pièce', 'Indiquer le nom de la pièce (30 carractères max.)', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

$formulaire->fieldsFormSelect('Type de vélo', $select['type_velo'], 'type_velo', 'Type de vélo pour votre nouvelle pièce', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

$formulaire->fieldsFormInput('Poids de la pièce', 'number', 'poids', 'Poids de la pièce', 'Indiquer le poids de la pièce en grammes', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null, null, null, 'min="1"');

$formulaire->fieldsFormInput('Prix', 'number', 'prix', '0000', 'Indiquer un prix en Euros', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null, null, null, 'min="1"');

$formulaire->fieldsFormInput('Quantité', 'number', 'quantite', '00', 'Ajouter la quantité de la pièce disponible', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null, null, null, 'min="1"');

switch ($typePieceForm) {
  case 'cadre':

  $formulaire->fieldsFormSelect('Matière du cadre', $select['matiere'], 'matiere', 'Matière du cadre', $bdd = (isset($modifPiece)) ? $modifPiece : null, $msg);

  $formulaire->fieldsFormSelect('Taille de votre cadre', $select['taille'], 'id_taille', 'Taille de votre cadre en centimètre', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

  $formulaire->fieldsFormSelect('Cadre pour homme ou femme', $select['sexe'], 'sexe', 'Votre cadre est pour homme ou femme', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

break;
case 'roue':

  $formulaire->fieldsFormSelect('Matière de la roue', $select['matiere'], 'matiere', 'Matière de la roue', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

  $formulaire->fieldsFormSelect('Quelle taille de cadre pour les roues', $select['taille'], 'id_taille', 'Pour quel cadre les roue doivent s\'adapter', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

break;
case 'selle':

  $formulaire->fieldsFormSelect('Matière de la selle', $select['matiere'], 'matiere', 'Matière de la selle', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

  $formulaire->fieldsFormSelect('Selle pour homme ou femme', $select['sexe'], 'sexe', 'Votre selle est pour homme ou femme', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

break;
case 'guidon':

  $formulaire->fieldsFormSelect('Matière du guidon', $select['matiere'], 'matiere', 'Matière du guidon', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

  $formulaire->fieldsFormSelect('Guidon pour homme ou femme', $select['sexe'], 'sexe', 'Votre guidon est pour homme ou femme', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

  $formulaire->fieldsFormSelect('Taille du cadre pour le guidon', $select['taille'], 'id_taille', 'Pour quel cadre le guidon doit s\'adapter', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

break;
case 'groupe':

  $formulaire->fieldsFormSelect('Dents grand Pignon', $select['pignon'], 'pignon', 'Chosissez le nombre de dents sur le grand pignon', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

  $formulaire->fieldsFormSelect('Dents grand Plateau', $select['plateau'], 'plateau', 'Chosissez le nombre de dents sur le grand plateau', $msg, $bdd = (isset($modifPiece)) ? $modifPiece : null);

break;

} ?>

<div class="form-group w100 <?php if(isset($msg['error']['description'])) echo ' error-form'; ?>">
  <label for="description">Description</label>
  <textarea name="description" id="description" placeholder="Description de la pièce" required><?php if(isset($_POST['description'])) {
    echo $_POST['description'];
  } elseif(isset($modifPiece['description'])) {
    echo $modifPiece['description'];
  } ?></textarea>
  <em>Entrez une description de la pièce (250 carractères max)</em>
</div>

<?php $formulaire->fieldsFormInput('Photo de la pièce', 'file', 'img', '', 'Photo au format ".jpg" uniquement', $msg, null, 'w100', 'accept="image/jpeg"'); ?>
