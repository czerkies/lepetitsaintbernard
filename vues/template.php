<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($meta['title'])) echo $meta['title']; ?> | Le petit St.Bernard</title>
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
        <?= $buffer; ?>
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
