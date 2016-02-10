<?php if(!($userConnect || $userConnectAdmin)) { ?>
  <h2>Créer votre compte</h2>

  <?php include '../vues/dialogue.php'; ?>

  <?php include '../vues/include/formulaire-membre.php'; ?>

<?php } else {
  header('Location: '.RACINE_SITE.'mon-compte/');
}
