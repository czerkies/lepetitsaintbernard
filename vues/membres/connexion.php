<?php if(!$userConnect){ ?>
<form class="middle" action="" method="post">

  <?php include '../vues/include/dialogue.php'; ?>

  <?= $formulaire->fieldsFormInput('Email', 'email', 'email', 'Email', "Votre Email personnel", $msg); ?>

  <?= $formulaire->fieldsFormInput('Mot de passe', 'password', 'mdp', 'Mot de passe', "Mot de passe personnel", $msg); ?>

  <div class="form-group checkbox">
    <input name="remember" id="remember" type="checkbox"><label for="remember">Se souvenir de moi</label>
  </div>
  <div class="form-group">
    <input type="submit" value="connexion">
  </div>
</form>
<div class="bloc w50">
  <h2>Pas encore de compte</h2>
  <p>Vous n'avez pas encore de compte ?<br>
    En créant votre compte, nous vous proposerons le meilleur pour vous.
    Vous pourrez aussi créer le votre, de toutes pièces.</p>
  <div class="callto">
    <a class="button w100 d100" href="<?= RACINE_SITE; ?>creation-compte/">Créer son compte</a>
  </div>
</div>
<div class="bloc w50">
  <h2>Mot de passe oublié</h2>
  <p>Vous avez oublié votre mot de passe ?<br>
    Envoyez nous votre adresse Email, nous vous enverrons un nouveau mot de passe.<br>
    Modifiable par la suite, sur votre compte.</p>
  <div class="callto">
    <a class="button w100 d100" href="<?= RACINE_SITE; ?>mot-de-passe-oublie/">Réinitialiser mon mot de passe</a>
  </div>
</div>
<?php } else {
  header('Location: '.RACINE_SITE.'mon-compte/');
} ?>
