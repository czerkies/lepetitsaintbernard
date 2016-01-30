<?php

function autoloader($class){

  if(strpos($class, 'controleur') !== FALSE){
    if(file_exists('../controleurs/'.$class.'.php')){
      include_once '../controleurs/'.$class.'.php';
    }
  }

  if(strpos($class, 'modele') !== FALSE){
    if(file_exists('../modeles/'.$class.'.php')){
      include_once '../modeles/'.$class.'.php';
    }
  }

}

spl_autoload_register('autoloader');

function erreurUrl(){

  include('../controleurs/controleursFonctions.php');
  $instance = new controleursFonctions();
  $instance->urlIncorrect();

}

if(isset($_GET['controleur']) && !empty($_GET['controleur'])
  && isset($_GET['action']) && !empty($_GET['action'])){

    $controleur = htmlentities($_GET['controleur']);
    $action = htmlentities($_GET['action']);

    if(file_exists('../controleurs/controleur'.ucfirst($controleur).'.php')){
      include('../controleurs/controleur'.ucfirst($controleur).'.php');
        if(method_exists('controleur'.ucfirst($controleur), $action)){
          $classe = 'controleur'.ucfirst($controleur);
          $instance = new $classe();
          $instance->$action();
        } else {
          erreurUrl();
        }

    } else {
      erreurUrl();
    }

} else {

  include('../controleurs/controleurProduit.php');
  $instance = new controleursProduit();
  $instance->produitACC();

}
