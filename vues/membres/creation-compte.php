<?php if(!$userConnect) { ?>
  <h2>Créer votre compte</h2>
  <?php include '../vues/dialogue.php'; ?>
  <form class="" action="" method="post">
    <div class="form-group">
      <label for="nom">Votre Nom</label>
      <input type="text" name="nom" id="nom" placeholder="Nom" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>" required>
      <em>Votre Nom est obligatoire</em>
      <?php if(isset($msg['error']['nom'])) { ?>
        <label for="nom"><?= $msg['error']['nom']; ?></label>
      <?php } ?>
    </div>
    <div class="form-group">
      <label for="prenom">Votre Prénom</label>
      <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
      <em>Votre nom est obligatoire</em>
    </div>

  </form>

<?php } ?>
