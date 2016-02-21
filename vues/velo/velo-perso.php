<?php

if($userConnect){

?>

<h2>Vos vélos unique</h2>

<p>Hello</p>

<?php var_dump($_SESSION); ?>

<?php
foreach ($veloPerso as $key => $value) {

  foreach ($value as $donnees) {
    echo $donnees['titre'].' - '.$donnees['id_piece'].'<br>';
  }

}
?>

<?php } ?>
