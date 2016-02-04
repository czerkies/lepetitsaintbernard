<?php if(!$userConnect) { ?>
  <?php var_dump($_POST); ?>
  <h2>Créer votre compte</h2>
  <?php include '../vues/dialogue.php'; ?>
  <form class="large" action="" method="post">
    <div class="form-group <?php if(isset($msg['error']['email'])) echo 'error-form'; ?>">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
      <em>Il vous servira d'identifiant</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['mdp'])) echo 'error-form'; ?>">
      <label for="mdp">Mot de passe</label>
      <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
      <em>Doit contenir au moins une majuscule ou chiffre</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['nom'])) echo 'error-form'; ?>">
      <label for="nom">Votre Nom</label>
      <input type="text" name="nom" id="nom" placeholder="Nom" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>" required>
      <em>Votre Nom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['prenom'])) echo 'error-form'; ?>">
      <label for="prenom">Votre Prénom</label>
      <input type="text" name="prenom" id="prenom" placeholder="Prénom" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group radio <?php if(isset($msg['error']['sexe'])) echo 'error-form'; ?>">
      <label>Sexe</label>
      <input type="radio" id="homme" name="sexe" value="homme"
      <?php if(isset($_POST['sexe']) && $_POST['sexe'] === 'homme') echo 'checked'; ?>>
      <label for="homme">Homme</label>
      <input type="radio" id="femme" name="sexe" value="femme" <?php if(isset($_POST['sexe']) && $_POST['sexe'] === 'femme') echo 'checked'; ?>>
      <label for="femme">Femme</label>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['prenom'])) echo 'error-form'; ?>">
      <label for="taille">Taille</label>
      <input type="number" name="taille" id="taille" placeholder="000" value="<?php if(isset($_POST['taille'])) echo $_POST['taille']; ?>" required>
      <em>Votre taille en centimètres.</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['age'])) echo 'error-form'; ?>">
      <label for="age">Age</label>
      <input type="number" name="age" id="age" placeholder="00" value="<?php if(isset($_POST['age'])) echo $_POST['age']; ?>" required>
      <em>Votre age</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['poids'])) echo 'error-form'; ?>">
      <label for="poids">Poids</label>
      <input type="number" name="poids" id="poids" placeholder="000" value="<?php if(isset($_POST['poids'])) echo $_POST['poids']; ?>" required>
      <em>Votre poids en kilogrammes</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['type'])) echo 'error-form'; ?>">
      <label for="type">Type de vélo</label>
      <select name="type">
        <option disabled>Choisissez votre type de vélo</option>
        <option value="route">Route</option>
        <option value="vtt">VTT</option>
        <option value="both">Les deux</option>
      </select>
      <em>Choisissez votre type de vélo</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['budget'])) echo 'error-form'; ?>">
      <label for="budget">Prix maximum</label>
      <input type="text" name="budget" id="budget" placeholder="0000" value="<?php if(isset($_POST['budget'])) echo $_POST['budget']; ?>" required>
      <em>Donnez nous votre budget maximum</em>
    </div>
    <div class="form-group w100 <?php if(isset($msg['error']['adresse'])) echo 'error-form'; ?>">
      <label for="adresse">Adresse</label>
      <input type="text" name="adresse" id="adresse" placeholder="Adresse" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse']; ?>" required>
      <em>Entrez une adresse complète pour la livraison et facturation</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['cp'])) echo 'error-form'; ?>">
      <label for="cp">Code postal</label>
      <input type="text" name="cp" id="cp" placeholder="00000" value="<?php if(isset($_POST['cp'])) echo $_POST['cp']; ?>" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group <?php if(isset($msg['error']['ville'])) echo 'error-form'; ?>">
      <label for="ville">Ville</label>
      <input type="text" name="ville" id="ville" placeholder="Ville" value="<?php if(isset($_POST['ville'])) echo $_POST['ville']; ?>" required>
      <em>Votre Prénom est obligatoire</em>
    </div>
    <div class="form-group submit">
      <input type="submit" value="Créer mon compte">
    </div>

  </form>

<?php } ?>
