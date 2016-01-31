<?php if(!$userConnect){ ?>
<form class="middle" action="" method="post">
  <?php if($msg['error']){ ?>
  <div class="error">
    <?= $msg['error']; ?>
  </div>
  <?php } ?>
  <div class="form-group">
    <label for="email">Mail</label>
    <input name="email" id="email" type="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
  </div>
  <div class="form-group">
    <label for="mdp">Mot de passe</label>
    <input name="mdp" id="mdp" type="password" placeholder="Mot de passe" required>
  </div>
  <div class="form-group">
    <input type="submit" value="connexion">
  </div>
</form>
<div class="inscription">

</div>
<div class="mdp_forget">

</div>
<?php } else { ?>
Vous êtes déjà connecté.
<?php var_dump($_SESSION); ?>
<?php } ?>
