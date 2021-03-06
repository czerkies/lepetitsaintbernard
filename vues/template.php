<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($meta['title'])) echo $meta['title']; ?> | Le petit St.Bernard</title>
    <link rel="stylesheet" type="text/css" href="<?= RACINE_SITE; ?>css/style.css">
    <meta name="description" value="Spécialiste du montage de vélo pour la montagne en ligne. Simple et rapide, ce site vous permet d'avoir le vélo bien plus qu'à votre taille.">
    <link rel="icon" type="image/png" href="<?= RACINE_SITE; ?>favicon.png">
    <?php if(isset($meta['deconnexion']) && $meta['deconnexion'] === TRUE) echo '<meta http-equiv="refresh" content="0; url='.RACINE_SITE.'connexion/">'; ?>
    <script src="<?= RACINE_SITE; ?>js/jquery.js"></script>
  </head>
  <body>
    <header>
      <div class="header_cont">
        <nav <?php if($userConnectAdmin) echo 'class="menu_admin"';?>>
          <ul>
            <li>
              <a <?php if(isset($meta['menu']) && $meta['menu'] === 'accueil') echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>">Accueil</a>
            </li>
            <li>
              <a <?php if(isset($meta['menu']) && $meta['menu'] === 'votre-velo') echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>votre-velo/">Votre Vélo</a>
            </li>
            <li>
              <a <?php if(isset($meta['menu']) && $meta['menu'] === 'configuration') echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>configuration/">Configurer</a>
            </li>
            <li>
              <a <?php if(isset($meta['menu']) && $meta['menu'] === 'panier') echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>panier/">Panier</a>
            </li>
            <?php if(!($userConnect || $userConnectAdmin)){ ?>
              <li>
                <a <?php if(isset($meta['menu']) && ($meta['menu'] === 'connexion' || $meta['menu'] === 'mot-de-passe-oublie')) echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>connexion/">Mon compte</a>
              </li>
              <li>
                <a <?php if(isset($meta['menu']) && $meta['menu'] === 'creation-compte') echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>creation-compte/">Création compte</a>
              </li>
            <?php } else { ?>
              <li>
                <a <?php if(isset($meta['menu']) && $meta['menu'] === 'mon-compte') echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>mon-compte/">Mon compte</a>
              </li>
              <li>
                <a href="<?= RACINE_SITE; ?>connexion/deconnexion/">Déconnexion</a>
              </li>
            <?php } if($userConnectAdmin) { ?>
              <li>
                <a class="sous_li <?php if(isset($meta['menu']) && ($meta['menu'] === 'liste-membres' || $meta['menu'] === 'ajout-admin')) echo "active"; ?>" href="<?= RACINE_SITE; ?>admin/gestion-membres/">Gestion des membres</a>
              </li>
              <li>
                <a class="sous_li <?php if(isset($meta['menu']) && ($meta['menu'] === 'gestion-stocks' || $meta['menu'] === 'ajouter-reference')) echo "active"; ?>" href="<?= RACINE_SITE; ?>admin/gestion-stocks/">Gestion des stocks</a>
              </li>
              <li>
                <a class="sous_li <?php if(isset($meta['menu']) && ($meta['menu'] === 'gestion-commandes')) echo "active"; ?>" href="<?= RACINE_SITE; ?>admin/gestion-commandes/">Gestion des commandes</a>
              </li>
              <li>
                <a class="sous_li <?php if(isset($meta['menu']) && ($meta['menu'] === 'gestion-avis')) echo "active"; ?>" href="<?= RACINE_SITE; ?>admin/gestion-avis/">Gestion des avis</a>
              </li>
            <?php } ?>
          </ul>
        </nav>
        <div class="logo_title">
          <div class="callto" id="bouton_menu">
            <button href="#" class="button w10">|||</button>
          </div>
          <a href="<?= RACINE_SITE; ?>">
            <img src="<?= RACINE_SITE; ?>img/stb-logo.png" alt="Logo Le petit saint bernard">
            <h1>Spécialiste du vélo pour Montagnard.</h1>
          </a>
        </div>
      </div>
    </header>
    <div id="prin">
      <div class="prin_cont">

        <?= $buffer; ?>

      </div>
    </div>
    <footer>
      <ul>
        <li>
          <a <?php if(isset($meta['menu']) && ($meta['menu'] === 'contact')) echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>contact/">Contact</a>
        </li>
        <li>
          <a <?php if(isset($meta['menu']) && ($meta['menu'] === 'catalogue')) echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>catalogue/">Catalogue</a>
        </li>
        <li>
          <a <?php if(isset($meta['menu']) && ($meta['menu'] === 'cgv')) echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>cgv/">C.G.V</a>
        </li>
        <li>
          <a <?php if(isset($meta['menu']) && ($meta['menu'] === 'plan-du-site')) echo 'class="active"'; ?> href="<?= RACINE_SITE; ?>plan-du-site/">Plan du site</a>
        </li>
      </ul>
    </footer>
  </body>
  <script type="text/javascript">
    $('#bouton_menu').click(function(){
      $('header ul').toggleClass('menu_actif');
      $(this).toggleClass('actif');
    });
  </script>
  <?php if($meta['menu'] === 'configuration') { ?>
    <script type="text/javascript">
      $('.selection').click(function(){
        var $id_select = this.id;
        $('.selection').removeClass('select');
        $('#'+$id_select).addClass('select');
      });
    </script>
  <?php } ?>
</html>
