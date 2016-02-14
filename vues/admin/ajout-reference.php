<?php

if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

  ?>

  <h2 id="ajout">Ajouter une référence</h2>

  <form class="middle" action="#ajout" method="get">

    <?php
    $valuesPieces = ['disabled' => 'Choisissez votre type de pièce à ajouter', 'cadre' => 'Cadre', 'roue' => 'Roue', 'selle' => 'Selle', 'guidon' => 'Guidon', 'guidon' => 'Guidon', 'plateau' => 'Plateau'];
    echo $formulaire->fieldsFormSelect('Type de pièce', $valuesPieces, 'piece', 'Choisissez votre type de pièce à ajouter', $msg);
    ?>

    <div class="form-group submit">
      <input type="submit" value="Sélectionner ce type de pièce">
    </div>

  </form>

  <?php if(isset($dataGet['piece'])){ ?>

    <h2 id="details_piece">Détails de la pièce</h2>

    <?php include '../vues/include/dialogue.php'; ?>

    <form class="large" action="#details_piece" enctype="multipart/form-data" method="post">

      <input type="hidden" name="type_piece" value="<?php if(isset($_GET['piece'])) echo $_GET['piece']; ?>">

      <?= $formulaire->fieldsFormInput('Nom de la pièce', 'text', 'titre', 'Nom de la pièce', 'Indiquer le nom de la pièce (30 carractères max.)', $msg); ?>

      <?php $valuesType = ['disabled' => 'Type de vélo de votre nouvelle pièce', 'route' => 'Route', 'vtt' => 'VTT'];
      echo $formulaire->fieldsFormSelect('Type de vélo', $valuesType, 'type_velo', 'Type de vélo pour votre nouvelle pièce', $msg); ?>

      <?= $formulaire->fieldsFormInput('Poids de la pièce', 'number', 'poids', 'Poids de la pièce', 'Indiquer le poids de la pièce en grammes', $msg, false, 'min="1"'); ?>

      <?= $formulaire->fieldsFormInput('Prix', 'number', 'prix', '0000', 'Insiquer un prix en Euros', $msg, false, 'min="1"'); ?>

      <?= $formulaire->fieldsFormInput('Quantité', 'number', 'quantite', '00', 'Ajouter la quantité de la pièce disponible', $msg, false, 'min="1"'); ?>

    <?php
      switch ($dataGet['piece']) {
        case 'cadre':
    ?>

      <?php $valuesMat = ['disabled' => 'Matière du cadre', 'alluminium' => 'Alluminium', 'cabone' => 'Carbone', 'metal' => 'Metal'];
      echo $formulaire->fieldsFormSelect('Matière du cadre', $valuesMat, 'matiere', 'Matière du cadre', $msg); ?>

      <?php $valuesTaille = ['disabled' => 'Taille du cadre', '150-161' => '150/161 cm', '162-174' => '162/174 cm', '175-187' => '175/187 cm', '188-200' => '188/200 cm'];
      echo $formulaire->fieldsFormSelect('Taille de votre cadre', $valuesTaille, 'taille', 'Taille de votre cadre en centimètre', $msg); ?>

      <?php $valuesTaille = ['disabled' => 'Cadre pour homme ou femme', 'homme' => 'Homme', 'femme' => 'Femme'];
      echo $formulaire->fieldsFormSelect('Cadre pour homme ou femme', $valuesTaille, 'sexe', 'Votre cadre est pour homme ou femme', $msg); ?>

    <?php
      break;
      case 'roue':
    ?>

      Taille Cadre

    <?php
      break;
    ?>

    <?php } ?>

      <div class="form-group w100 <?php if(isset($msg['error']['description'])) echo ' error-form'; ?>">
        <label for="description">Description</label>
        <textarea name="description" id="description" placeholder="Description de la pièce"required><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
        <em>Entrez une description de la pièce (250 carractères max).</em>
      </div>

      <?= $formulaire->fieldsFormInput('Photo de la pièce', 'file', 'img', '', 'Photo en .jpg uniquement', $msg, 'w100', 'accept="image/jpeg"'); ?>

      <div class="form-group submit">
        <input type="submit" value="Ajouter la nouvelle pièce">
      </div>


    </form>

  <?php } ?>

<?php

}
