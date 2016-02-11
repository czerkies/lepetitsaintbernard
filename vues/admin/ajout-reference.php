<?php

if($userConnectAdmin){

  include '../vues/include/menu-gestion-stocks.php';

  ?>

  <h2>Ajouter un membre</h2>

  <?php include '../vues/include/dialogue.php'; ?>

  <form class="large" action="" method="post">

    <div class="form-group submit">
      <input type="submit" value="Créer l'adminisrateur">
    </div>

  </form>

<?php

}
