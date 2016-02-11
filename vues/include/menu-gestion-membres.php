<h2>Gestion des membres</h2>
<p>Gérer les membres. Supprimer un membre. Ajouter un administrateur.</p>
<div class="bloc w50">
  <div class="callto">
    <a class="button w100 d100 <?php if($meta['menu'] === 'liste-membres') echo 'actif'; ?>" href="<?= RACINE_SITE; ?>admin/gestion-membres/">Liste des utilisateurs</a>
  </div>
</div>
<div class="bloc w50">
  <div class="callto">
    <a class="button w100 d100 <?php if($meta['menu'] === 'ajout-admin') echo 'actif'; ?>" href="<?= RACINE_SITE; ?>admin/ajouter-administrateur/">Ajouter un administrateur</a>
  </div>
</div>
