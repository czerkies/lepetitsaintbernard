<h2>Plan du site</h2>

<p>
  <b>Menu</b>
</p>
<p>
  <a href="<?= RACINE_SITE; ?>/">Accueil</a>
</p>
<p>
  <a href="<?= RACINE_SITE; ?>votre-velo/">Votre Vélo</a>
</p>
<p>
  <a href="<?= RACINE_SITE; ?>configuration/">Configuration</a>
</p>
<p>
  <a href="<?= RACINE_SITE; ?>panier/">Panier</a>
</p>
<?php if(!($userConnect || $userConnectAdmin)){ ?>
  <p>
    <a href="<?= RACINE_SITE; ?>connexion/">Se connecter</a>
  </p>
  <p>
    <a href="<?= RACINE_SITE; ?>creation-compte/">Créer son compte</a>
  </p>
<?php } if($userConnect || $userConnectAdmin){ ?>
  <p>
    <a href="<?= RACINE_SITE; ?>mon-compte/">Mon compte</a>
  </p>
  <p>
    <a href="<?= RACINE_SITE; ?>connexion/deconnexion/">Se déconnecter</a>
  </p>
<?php } ?>
<p>
  <b>Autres</b>
</p>
<p>
  <a href="<?= RACINE_SITE; ?>contact/">Contactez-nous</a>
</p>
<p>
  <a href="<?= RACINE_SITE; ?>catalogue/">Notre catalogue</a>
</p>
<p>
  <a href="<?= RACINE_SITE; ?>cgv/">Conditions générale de ventes</a>
</p>
<p>
  <a href="<?= RACINE_SITE; ?>plan-du-site/">Le Plan du site</a>
</p>
