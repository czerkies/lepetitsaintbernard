<?php if($userConnect) { ?>

  <h2>Laissez un avis sur votre commande !</h2>

  <?php include '../vues/include/dialogue.php'; ?>

  <?php if($formulaireAvis) { ?>

  <form class="large" action="" method="post">

    <input type="hidden" name="id_commande_velo" value="<?= $_GET['avis']; ?>" required>

    <?= $formulaire->fieldsFormInput('Pseudo à afficher', 'text', 'prenom', 'Pseudo à afficher', 'Choisissez un pseudo à afficher pour accompagner votre avis', $msg, 'required', 'w100', null, 'membre'); ?>

    <div class="form-group <?php if(isset($msg['error']['sexe'])) echo 'error-form'; ?>">
      <label>Votre avis</label>
      <textarea name="avis" placeholder="Votre avis" required><?php if(isset($_POST['avis'])) echo $_POST['avis']; ?></textarea>
    </div>
  </form>

  <?php } ?>

<?php } ?>
