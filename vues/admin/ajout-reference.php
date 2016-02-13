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

      <?php $values = ['route' => 'Test', 'vtt' => 'VTT'];
      echo $formulaire->fieldsFormSelect('Type de vélo', $values, 'type', 'Choisissez votre type de vélo pour la nouvelle pièce', $msg); ?>

      <?= $formulaire->fieldsFormInput('Nom de la pièce', 'text', 'nom', 'Nom de la pièce', 'Indiquer le nom de la pièce', $msg); ?>

    <?php
      switch ($dataGet['piece']) {
        case 'cadre':
    ?>

      Femme / Homme

    <?php
      break;
      case 'roue':
    ?>

      Taille Cadre

    <?php
      break;
    ?>
    <?php } ?>

      <?= $formulaire->fieldsFormInput('Quantité', 'number', 'quantite', '00', 'Ajouter la quantité de la pièce disponible', $msg); ?>

    </form>

  <?php } ?>

<?php

}
