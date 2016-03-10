<h2>Contactez nous !</h2>

<p>Contactez nous pour toutes questions ou demande.</p>

<?php include '../vues/include/dialogue.php'; ?>

<form class="large" action="" method="post">

  <?= $formulaire->fieldsFormInput('Prénom', 'text', 'prenom', 'prenom', "Votre prénom est obligatoire", $msg, 'required', null, null, 'membre'); ?>

  <?= $formulaire->fieldsFormInput('Email', 'email', 'email', 'email', "Votre Email est obligatoire", $msg, 'required', null, null, 'membre'); ?>

  <div class="form-group w100<?php if(isset($msg['error']['sexe'])) echo ' error-form'; ?>">
    <label for="message">Votre message</label>
    <textarea name="message" id="message" placeholder="Votre message" required><?php if(isset($_POST['message'])) echo $_POST['message']; ?></textarea>
    <em>Votre demande ne peut dépasser 10000 caractères</em>
  </div>

  <div class="form-group submit">
    <input type="submit" value="Envoyer">
  </div>

</form>
