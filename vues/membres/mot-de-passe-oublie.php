<h2>Mot de passe oublié</h2>
<p>Nous vous enverrons un Email avec un nouveau mot de passe, a réinitialiser si vous le souhaitez.</p>
<form class="middle" action="" method="post">

  <?php include '../vues/include/dialogue.php'; ?>

  <?= $formulaire->fieldsFormInput('Email', 'email', 'email', 'Email', "Entrez l'adresse mail utilisé pour votre compte", $msg, 'required'); ?>

  <div class="form-group submit">
    <input type="submit" value="Recevoir un mot de passe">
  </div>

</form>
