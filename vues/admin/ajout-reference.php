<?php

if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

  ?>

  <h2 id="ajout">Ajouter une référence</h2>

  <form class="middle" action="#ajout" method="get">

    <?php $formulaire->fieldsFormSelect('Type de pièce', $select['type_piece'], 'piece', 'Choisissez votre type de pièce à ajouter', $msg); ?>

    <div class="form-group submit">
      <input type="submit" value="Sélectionner ce type de pièce">
    </div>

  </form>

  <?php if(isset($dataGet['type_piece'])){ ?>

    <h2 id="details_piece">Détails de la pièce</h2>

    <?php include '../vues/include/dialogue.php'; ?>

    <form class="large" action="#details_piece" enctype="multipart/form-data" method="post">

      <?php include '../vues/include/formulaire-stock.php'; ?>

      <div class="form-group submit">
        <input type="submit" value="Ajouter la nouvelle pièce">
      </div>
        
    </form>

  <?php } ?>

<?php

}
