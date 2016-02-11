<?php

if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

  ?>

  <h2>Ajouter une référence</h2>

  <?php include '../vues/include/dialogue.php'; ?>

  <form class="middle" action="" method="get">

    <div class="form-group <?php if(isset($msg['error']['type'])) echo 'error-form'; ?>">
      <label for="type">Type de pièce</label>
      <select name="type">
        <option disabled>Choisissez votre type de pièce à ajouter</option>
        <option value="cadre">Cadre</option>
        <option value="roue"
        <?php if(isset($_GET['type']) && $_GET['type'] === 'roue') echo "selected"; ?>
        >Roue</option>
        <option value="selle"
        <?php if(isset($_GET['type']) && $_GET['type'] === 'selle') echo "selected"; ?>
        >Selle</option>
        <option value="Guidon"
        <?php if(isset($_GET['type']) && $_GET['type'] === 'guidon') echo "selected"; ?>
        >Guidon</option>
        <option value="plateau"
        <?php if(isset($_GET['type']) && $_GET['type'] === 'plateau') echo "selected"; ?>
        >Plateau</option>
      </select>
      <em>Choisissez votre type de pièce à ajouter</em>
    </div>
    <div class="form-group submit">
      <input type="submit" value="Sélectionner ce type de pièce">
    </div>

  </form>

  <?php if(isset($meta['type'])){ ?>

    <form class="large" action="" method="post">

      <?= $formulaire->fieldsFormInput('Nom de la pièce', 'text', 'nom', 'Nom de la pièce', 'Indiquer le nom de la pièce', $msg); ?>

    <?php
      switch ($meta['type']) {
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
