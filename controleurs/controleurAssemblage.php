<?php

/**
* La class controleurFonctions gère les fonctions du site.
*
*/
class controleurAssemblage extends controleurSuper {

  /**
  * Controle la page du vélo personnalisé
  *
  * @return (array) $this->render
  */
  public function veloPerso() {

    session_start();
    $meta['title'] = 'Vélo unique';
    $meta['menu'] = 'votre-velo';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();

    $velos = new modeleAssemblage();

    $veloPerso = (isset($_SESSION['membre'])) ? $velos->veloAssemblage($_SESSION['membre']) : null;

    $this->Render('../vues/velo/velo-perso.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'veloPerso' => $veloPerso));

  }

  /**
  * Controle de la configuration route
  *
  * @return (array) $this->render
  */
  public function configurationVelo() {

    session_start();
    $meta['title'] = 'Configurer votre propre vélo';
    $meta['menu'] = 'configuration';
    $userConnect = $this->userConnect();
    $userConnectAdmin = $this->userConnectAdmin();

    $msg['error'] = array();
    $donneesPieces = array();
    $etape = null;
    $poids = 0;
    $prix = 0;

    $pieces = new modeleAssemblage();

    // Type de vélo
    if(isset($_GET['type']) && !empty($_GET['type'])
    && ($_GET['type'] === 'route' || $_GET['type'] === 'vtt')){

      $meta['title'] = 'Sexe - Configurer votre vélo de Route';
      $meta['menu'] = 'configuration-'.$_GET['type'];
      $etape = 'sexe';

      // Sexe du visiteur
      if(isset($_GET['sexe']) && !empty($_GET['sexe'])
      && ($_GET['sexe'] === 'femme' || $_GET['sexe'] === 'homme')){

        $meta['title'] = 'Cadres - Configurer votre vélo de Route';
        $meta['sexe'] = false;
        $etape = 'cadre';

        $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, $_GET['sexe']);

        // Etape Roue
        if($donneesCadre = $this->verifEtapeSuivante('cadre')){

          $meta['title'] = 'Roue - Configurer votre vélo de Route';
          $etape = 'roue';
          $poids += $donneesCadre['poids'];
          $prix += $donneesCadre['prix'];

          $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, null, $donneesCadre['id_taille']);

          // Etape Selle
          if($donneesRoue = $this->verifEtapeSuivante('roue')){

            $meta['title'] = 'Selle - Configurer votre vélo de Route';
            $etape = 'selle';
            $poids += $donneesRoue['poids'];
            $prix += $donneesRoue['prix'];

            $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, $_GET['sexe']);

            // Etape Guidon
            if($donneesSelle = $this->verifEtapeSuivante('selle')){

              $meta['title'] = 'Guidon - Configurer votre vélo de Route';
              $etape = 'guidon';
              $poids += $donneesSelle['poids'];
              $prix += $donneesSelle['prix'];

              $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, $_GET['sexe'], $donneesCadre['id_taille']);

            }

          }

        }

      }

    }


    $this->Render('../vues/velo/configuration-velo.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'donneesPieces' => $donneesPieces, 'etape' => $etape, 'poids' => $poids, 'prix' => $prix));

  }

  /**
  *
  *
  *
  */
  public function verifEtapeSuivante($etapeVerif) {

    $pieces = new modeleAssemblage();

    if(isset($_GET[$etapeVerif])
    && !empty($_GET[$etapeVerif])
    && is_numeric($_GET[$etapeVerif])){

      $donnees = $pieces->concordancePieceTypeDonnees($etapeVerif, $_GET[$etapeVerif], $_GET['type']);

      return $donnees;

    } else {

      return false;

    }

  }

}
