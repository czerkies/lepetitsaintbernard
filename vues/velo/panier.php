<?php

echo '<pre>';
var_dump($_SESSION['panier']);
echo '</pre>';

foreach ($_SESSION['panier'] as $key => $value) {
  echo $key.' - '.$value['type_velo'].' - '.$value['prix'].' - '.$value['quantite'].'<br>';
  echo '<a href="'.RACINE_SITE.'panier/?supp_velo='.$key.'">X</a>';
  ?>
    <form class="" action="<?= RACINE_SITE; ?>panier/" method="post">
      <input type="hidden" name="id_velo" value="<?= $key; ?>">
      <input type="number" name="quantite" value="<?= $value['quantite']; ?>">
      <input type="submit" name="update_quantite" value="Modifier">
    </form>
  <?php
}
