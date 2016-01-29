<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($txt['title'])) echo $txt['title']; ?> | Le petit St.Bernard</title>
    <link rel="stylesheet" type="text/css" href="../www/css/style.css">
    <meta name="description" value="Spécialiste du montage de vélo pour la montagne en ligne. Simple et rapide, ce site vous permet d'avoir le vélo bien plus qu'à votre taille.">
  </head>
  <body>
    <header>
      <div class="header_cont">
        <nav>
          <ul>
            <li><a href="#">Votre Vélo</a></li>
            <li><a href="#">Route</a></li>
            <li><a href="#">VTT</a></li>
            <li><a href="#">Mon compte</a></li>
          </ul>
        </nav>
        <div class="logo_title">
          <div class="callto" id="bouton_menu">
            <button href="#" class="button w10">|||</button>
          </div>
          <a href="/">
            <img src="../www/img/stb-logo.png" alt="Logo Le petit saint bernard">
            <h1>Spécialiste du vélo pour Montagnard.</h1>
          </a>
        </div>
      </div>
    </header>
    <div id="prin">
      <div class="prin_cont">
        <div class="etape_accueil">
          <h2>Configurez, commandez et c'est livré.</h2>
          <p>Avec <strong>Le petit saint bernard</strong>, il est très facile de choisir votre vélo : Il suffis simplement créer votre compte et nous vous proposons la meilleur solution, sur mesure. Vous pouvez aussi configurer votre vélo avec une aide à chaque étape.<br>.Avec <strong>Le petit saint bernard</strong>, votre vélo sera unique et uniquement pour vous.</p>
        </div>
        <div class="callto">
          <button href="#" class="button w100 d50 mauto">Configurer mon vélo</button>
        </div>
        <div class="etape_accueil">
          <h2>Le petit Saint Bernard ?</h2>
          <p>Le petit saint bernard est un spécialiste de la configuration personalisé en vélo de montagne.<br>Notre magasin et usine se situe en Rhon-Alpes dans la ville de Bourg Saint Maurice. Notre Fabrication, votre configuration,</p>            <h2>Col du galiber ou cross country dans le beaufortain ?</h2>
          <p>Nous vous proposons les meilleurs vélo pour gravir les cols les plus difficile aux descentes les plus pentus.</p>
          <h2>Trouver son vélo</h2>
          <p>Pour trouver son vélo parfait, rien de plus simple, après avoir créé votre profil, nous vous proposerons les vélos qui vous conviendrait le mieux.<br>Nous prenons en compte les critères suivant :</p>
        </div>
        <div class="spe">
          <div class="round" id="sexe"><span>Sexe</span></div>
          <div class="round" id="taille"><span>Taille</span></div>
          <div class="round" id="poid"><span>Poid</span></div>
          <div class="round" id="age"><span>Age</span></div>
          <div class="round" id="type"><span>Type</span></div>
          <div class="round" id="budget"><span>Budget</span></div>
        </div>
        <div class="infos">
          <div id="infos_prin" class="hidden appear"><span>Les 6 parametres définirons votre vélo idéal.</span><br>Vous pouvez cliquer sur chacun parametres pour en savoir plus.</div>
          <div id="infos_sexe" class="hidden">Cette information nous donne accès au format du cadre et au type de selle.</div>
          <div id="infos_taille" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
          <div id="infos_poid" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
          <div id="infos_age" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
          <div id="infos_type" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
          <div id="infos_budget" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
        </div>
        <div class="etape_accueil">
          <h2>Garantie et support</h2>
          <p>Chaque vélo est garantie d'une durée de 3ans, notre support technique et commercial est à votre disposition.<br>Vous pouvez nous contacter à tout moment, par notre formulaire de contact ou par téléphone au numéro suivant : 01 02 03 04 05.</p>
        </div>
        <div class="callto">
          <button href="#" class="button w100 d50 mauto">Configurer mon vélo</button>
        </div>
      </div>
    </div>
    <footer>
      <ul>
        <li><a href="#">Foooter 1</a></li>
        <li><a href="#">Foooter 1</a></li>
        <li><a href="#">Foooter 1</a></li>
        <li><a href="#">Foooter 1</a></li>
      </ul>
    </footer>
  </body>
  <script src="../www/js/jquery.js"></script>
  <script type="text/javascript">
  $('#bouton_menu').click(function(){
    $('header ul').toggleClass('menu_actif');
    $(this).toggleClass('actif');
  });
  $('.spe .round').click(function(){
    var $content = this.id;
    $('.spe .round').removeClass('active');
    $('.infos .appear').removeClass('appear');
    $('#'+$content).addClass('active');
    $('#infos_'+$content).addClass('appear');
  });
  </script>
</html>
