<?php if($userConnect) { ?>

  <h2>Laissez un avis sur votre commande !</h2>

  <?php include '../vues/include/dialogue.php'; ?>

  <?php if($formulaireAvis) { ?>

  <form class="large" action="" method="post">

    <input type="hidden" name="id_commande_velo" value="<?= $_GET['avis']; ?>" required>

    <?= $formulaire->fieldsFormInput('Pseudo à afficher', 'text', 'prenom', 'Pseudo à afficher', 'Choisissez un pseudo à afficher pour accompagner votre avis', $msg, 'required', 'w100', null, 'membre'); ?>

    <div class="form-group w100<?php if(isset($msg['error']['sexe'])) echo ' error-form'; ?>">
      <label for="avis">Votre avis</label>
      <textarea name="avis" id="avis" placeholder="Votre avis" required><?php if(isset($_POST['avis'])) echo $_POST['avis']; ?></textarea>
      <em>Votre avis de doit pas dépasser 4500 caractères</em>
    </div>

    <div class="form-group submit">
      <input type="submit" value="Ajouter mon avis sur la commande">
    </div>

  </form>

  <?php } ?>

<?php } ?>
