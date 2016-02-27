<?php

echo '<pre>';
var_dump($_SESSION['panier']);
echo '</pre>';

foreach ($_SESSION['panier'] as $key => $value) {
  echo $value['titre'].'<br>';
}
