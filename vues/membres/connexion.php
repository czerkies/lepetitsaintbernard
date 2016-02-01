<?php if(!$userConnect){ ?>
<form class="middle" action="" method="post">
  <?php include '../vues/dialogue.php'; ?>
  <div class="form-group">
    <label for="email">Mail</label>
    <input name="email" id="email" type="email" placeholder="Email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} elseif(isset($_COOKIE['email'])) {echo $_COOKIE['email'];} ?>" required>
    <?php if(isset($msg['error']['email'])) { ?>
      <label for="email"><?= $msg['error']['email']; ?></label>
    <?php } ?>
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input name="mdp" id="mdp" type="password" placeholder="Mot de passe" required>
    <?php if(isset($msg['error']['mdp'])) { ?>
      <label for="mdp"><?= $msg['error']['mdp']; ?></label>
    <?php } ?>
  </div>
  <div class="form-group checkbox">
    <input name="remember" id="remember" type="checkbox"><label for="remember">Se souvenir de moi</label>
  </div>
  <div class="form-group">
    <input type="submit" value="connexion">
  </div>
</form>
<div class="bloc w50">
  <h2>Pas encore de compte</h2>
  <div class="callto">
    <a class="button w100" href="<?= RACINE_SITE; ?>creation-compte/">Créer son compte</a>
  </div>
</div>
<div class="bloc w50">
  <h2>Mot de passe oublié</h2>
  <div class="callto">
    <a class="button w100" href="<?= RACINE_SITE; ?>mot-de-passe-oublie/">Réinitialiser mon mot de passe</a>
  </div>
</div>
<?php } else { ?>
Vous êtes déjà connecté.
<?php var_dump($_SESSION); ?>
<?php } ?>
