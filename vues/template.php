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
      <h1>Le petit saint bernard</h1>
    </header>
    <div id="cont">
      <h2>Le petit Saint Bernard ?</h2>
      <p>Le petit saint bernard est un spécialiste de la configuration personalisé en vélo de montagne.</p>
      <h2>Trouver son vélo</h2>
      <p>Pour trouver son vélo parfait, rien de plus simple, créer votre profil, nous vous proposerons les vélo qui vous conviendrait le mieux.<br>Nous prenoms en compte les critères suivant :</p>
      <div class="spe">
        <div class="round" id="sexe">Sexe</div>
        <div class="round" id="taille">Taille</div>
        <div class="round" id="poid">Poid</div>
        <div class="round" id="age">Age</div>
        <div class="round" id="style">Route/VTT</div>
      </div>
      <div class="infos">
        <div id="infos_sexe" class="hidden">Cette information nous donne accès au format du cadre et au type de selle.</div>
        <div id="infos_taille" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
      </div>
    </div>
  </body>
  <script src="../www/js/jquery.js"></script>
  <script type="text/javascript">
  var $content = 'sexe';
    $('#'+$content).click(function(){
      $('.spe .round').removeClass('active');
      $('.infos .appear').removeClass('appear');
      $(this).toggleClass('active');
      $('#infos_'+$content).addClass('appear');
    });
    $('#taille').click(function(){
      $('.spe .round').removeClass('active');
      $('.infos .appear').removeClass('appear');
      $(this).toggleClass('active');
      $('#infos_taille').addClass('appear');
    });
  </script>
</html>
