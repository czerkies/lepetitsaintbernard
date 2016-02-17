<?php if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

  include '../vues/include/dialogue.php';

  if(!$modifPiece) {

?>
<?php foreach ($donneesParPiece as $key => $piece) { ?>

  <h2 id="<?= $key; ?>">Les <?= ucfirst($key); ?>s</h2>
  <?php if($donneesParPiece[$key]){ ?>
    <div class="tableau">
      <div class="head">
        <div class="cel w5">Réf.</div>
        <div class="cel w20">Titre</div>
        <div class="cel w20">Type de Vélo</div>
        <div class="cel w5">Taille</div>
        <div class="cel w5">Stock</div>
        <div class="cel w20">Modifier</div>
        <div class="cel w10"></div>
      </div>
      <ul class="body">
        <?php foreach($donneesParPiece[$key] as $value) { ?>
          <li>
            <span class="w5"><?= $value['id_piece']; ?></span>
            <span class="w20"><?= $value['titre']; ?></span>
            <span class="w20"><?= $value['type_velo']; ?></span>
            <span class="w5"><?= $value['id_taille']; ?></span>
            <span class="w5"><?= $value['quantite']; ?></span>
            <span class="w20">
              <form action="#<?= $key; ?>" method="post">
                <input name="id_piece" type="hidden" value="<?= $value['id_piece']; ?>" required>
                <input name="quantite" type="number" min="-<?= $value['quantite']; ?>" placeholder="00" required><input type="submit" value="Ok">
              </form>
            </span>
            <span class="w5"><a href="<?= RACINE_SITE; ?>admin/gestion-stocks/modification/<?= $value['id_piece']; ?>"> | </a></span>
            <span class="w5"><a href="<?= RACINE_SITE; ?>admin/gestion-stocks/suppression/<?= $value['id_piece']; ?>">X</a></span>
          </li>
        <?php } ?>
      </ul>
    </div>
  <?php } else { ?>
    <p>Il n'y a aucun <?= ucfirst($key); ?>.</p>
  <?php } ?>
  <div class="callto">
    <a class="button w100 d50" href="<?= RACINE_SITE; ?>admin/ajouter-reference/?piece=<?= $key; ?>#ajout">Ajouter <?= ucfirst($key); ?></a>
  </div>
<?php } ?>

<?php } else { ?>

  <h2>Modification d'une pièce</h2>

  <form class="" action="" method="post">

  <?php

    var_dump($modifPiece);

    $formulaire->fieldsFormInput('Nom de la pièce', 'text', 'titre', 'Nom de la pièce', 'Indiquer le nom de la pièce (30 carractères max.)', $msg, $modifPiece);

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

  </form>

<?php } ?>

<?php }
