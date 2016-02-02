<?php if(!$userConnect) { ?>
  <h2>Créer votre compte</h2>
  <?php include '../vues/dialogue.php'; ?>
  <form class="large" action="" method="post">
    <div class="form-group <?php if(isset($msg['error']['email'])) echo 'error-form'; ?>">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Nom" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
      <em>Il vous servira d'identifiant</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['mdp'])) echo 'error-form'; ?>">
      <label for="mdp">Mot de passe</label>
      <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
      <em>Doit contenir au moins une majuscule ou chiffre</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['nom'])) echo 'error-form'; ?>">
      <label for="nom">Votre Prénom</label>
      <input type="text" name="nom" id="nom" placeholder="Nom" required>
      <em>Votre Nom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['prenom'])) echo 'error-form'; ?>">
      <label for="prenom">Votre Prénom</label>
      <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['sexe'])) echo 'error-form'; ?>">
      <label for="sexe">Sexe</label>
      Homme - Femme
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['prenom'])) echo 'error-form'; ?>">
      <label for="taille">Taille</label>
      <input type="text" name="taille" id="taille" placeholder="Prénom" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['age'])) echo 'error-form'; ?>">
      <label for="age">Age</label>
      <input type="text" name="age" id="age" placeholder="Prénom" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['poids'])) echo 'error-form'; ?>">
      <label for="poids">Poids</label>
      <input type="text" name="poids" id="poids" placeholder="Poids" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['type'])) echo 'error-form'; ?>">
      <label for="type">Type de vélo</label>
      Route - VTT - Les deux
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['budget'])) echo 'error-form'; ?>">
      <label for="budget">Prix maximum</label>
      <input type="text" name="budget" id="budget" placeholder="Prénom" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group w100 <?php if(isset($msg['error']['adresse'])) echo 'error-form'; ?>">
      <label for="adresse">Adresse</label>
      <input type="text" name="adresse" id="adresse" placeholder="Adresse" required>
      <em>Entrez une adresse complète pour la livraison et facturation</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['ville'])) echo 'error-form'; ?>">
      <label for="ville">Ville</label>
      <input type="text" name="ville" id="ville" placeholder="Ville" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['cp'])) echo 'error-form'; ?>">
      <label for="cp">Code postal</label>
      <input type="text" name="cp" id="cp" placeholder="00000" required>
      <em>Votre Prénom est obligatoire</em>
    </div>

  </form>

<?php } ?>
