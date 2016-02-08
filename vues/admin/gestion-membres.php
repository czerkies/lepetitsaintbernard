<?php if($userConnectAdmin){ ?>
<h2>Gestion des membres</h2>

<?php if($listeMembres){
  foreach ($listeMembres as $value) {
    echo $value['email'].'<br>';
  }
} ?>

<?php } ?>
