<?php if(!($userConnect || $userConnectAdmin)) { ?>
  <h2>Créer votre compte</h2>

  <?php include '../vues/include/dialogue.php'; ?>

  <form class="large" action="" method="post">
    <?php include '../vues/include/formulaire-membre.php'; ?>
    <div class="form-group submit">
      <input type="submit" value="Créer mon compte">
    </div>
  </form>

<?php } else {
  header('Location: '.RACINE_SITE.'mon-compte/');
}
