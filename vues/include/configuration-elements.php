
<div class="spe">
  <div class="round" id="sexe"><span>Sexe</span></div>
  <div class="round" id="taille"><span>Taille</span></div>
  <div class="round" id="poids"><span>Poids</span></div>
  <div class="round" id="age"><span>Age</span></div>
  <div class="round" id="type"><span>Type</span></div>
  <div class="round" id="budget"><span>Budget</span></div>
</div>
<div class="infos">
  <div id="infos_prin" class="hidden appear"><span>Les 6 parametres définirons votre vélo idéal.</span><br>Vous pouvez cliquer sur chacun parametres pour en savoir plus.</div>
  <div id="infos_sexe" class="hidden">Cette information nous donne accès au format du cadre et au type de selle.</div>
  <div id="infos_taille" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
  <div id="infos_poids" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
  <div id="infos_age" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
  <div id="infos_type" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
  <div id="infos_budget" class="hidden">Cette information nous donne accès à la taille du cadre et des roues.</div>
</div>
<script type="text/javascript">
  $('.spe .round').click(function(){
    var $content = this.id;
    $('.spe .round').removeClass('active');
    $('.infos .appear').removeClass('appear');
    $('#'+$content).addClass('active');
    $('#infos_'+$content).addClass('appear');
  });
</script>
