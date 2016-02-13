<?php

if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

  ?>

  <h2 id="ajout">Ajouter une référence</h2>

  <?php include '../vues/include/dialogue.php'; ?>

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

    <form class="large" action="" method="post">

      <?= $formulaire->fieldsFormInput('Nom de la pièce', 'text', 'nom', 'Nom de la pièce', 'Indiquer le nom de la pièce', $msg); ?>

      <?php $valuesType = ['disabled' => 'Type de vélo de votre nouvelle pièce', 'route' => 'Route', 'vtt' => 'VTT'];
      echo $formulaire->fieldsFormSelect('Type de vélo', $valuesType, 'type', 'Type de vélo pour votre nouvelle pièce', $msg); ?>

      <?= $formulaire->fieldsFormInput('Poids de la pièce', 'number', 'poids', 'Poids de la pièce', 'Indiquer le poids de la pièce', $msg); ?>

      <?= $formulaire->fieldsFormInput('Quantité', 'number', 'quantite', '00', 'Ajouter la quantité de la pièce disponible', $msg); ?>

    <?php
      switch ($dataGet['piece']) {
        case 'cadre':
    ?>

      <?= $formulaire->fieldsFormInput('Nom de la pièce', 'text', 'nom', 'Nom de la pièce', 'Indiquer le nom de la pièce', $msg); ?>

      <?php $valuesMat = ['disabled' => 'Matière du cadre', 'alluminium' => 'Alluminium', 'cabone' => 'Carbonne', 'metal' => 'Metal'];
      echo $formulaire->fieldsFormSelect('Type de vélo', $valuesMat, 'type', 'Type de vélo pour votre nouvelle pièce', $msg); ?>

      <?php $valuesTaille = ['disabled' => 'Taille du cadre', '150-161' => '150/161 cm', '162-174' => '162/174 cm', '175-187' => '175/187 cm', '188-200' => '188/200 cm'];
      echo $formulaire->fieldsFormSelect('Taille de votre cadre', $valuesTaille, 'taille', 'Taille de votre cadre en centimètre', $msg); ?>

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
      <textarea name="description" required><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
      <em>Entrez une description de la pièce (250 carractères max).</em>
    </div>

    </form>

  <?php } ?>

<?php

}
