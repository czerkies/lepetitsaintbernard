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

        if(isset($_GET['cadre']) && !empty($_GET['cadre'])
        && is_numeric($_GET['cadre'])){

          $donneesCadre = $pieces->concordancePieceTypeDonnees('cadre', $_GET['cadre'], $_GET['type']);

          if($donneesCadre){

            $meta['title'] = 'Roue - Configurer votre vélo de Route';
            $etape = 'roue';
            $poids += $donneesCadre['poids'];
            $prix += $donneesCadre['prix'];

            $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, null, $donneesCadre['id_taille']);

            if(isset($_GET['roue']) && !empty($_GET['roue'])
            && is_numeric($_GET['roue'])){

              $donneesRoue = $pieces->concordancePieceTypeDonnees('roue', $_GET['roue'], $_GET['type']);

              if($donneesRoue){

                $meta['title'] = 'Selle - Configurer votre vélo de Route';
                $etape = 'selle';
                $poids += $donneesRoue['poids'];
                $prix += $donneesRoue['prix'];

                $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, $_GET['sexe']);

              }

            }

          }

        }

      }

    }


    $this->Render('../vues/velo/configuration-velo.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'donneesPieces' => $donneesPieces, 'etape' => $etape, 'poids' => $poids, 'prix' => $prix));

  }

}
