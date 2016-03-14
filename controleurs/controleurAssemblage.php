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

    $msg['error'] = [];
    $donneesPieces = [];
    $donneesEtape = [];
    $etape = null;
    $poids = 0;
    $prix = 0;
    $urlPanier = '';

    $pieces = new modeleAssemblage();

    $etape = 'type';

    // Type de vélo
    if(isset($_GET['type']) && !empty($_GET['type'])
    && ($_GET['type'] === 'route' || $_GET['type'] === 'vtt')){

      $meta['title'] = 'Sexe - Configurer votre vélo de Route';
      $etape = 'sexe';

      // Sexe du visiteur
      if(isset($_GET['sexe']) && !empty($_GET['sexe'])
      && ($_GET['sexe'] === 'femme' || $_GET['sexe'] === 'homme')){

        $meta['title'] = 'Cadres - Configurer votre vélo de Route';
        $meta['sexe'] = false;
        $etape = 'cadre';

        $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, $_GET['sexe']);

        // Etape Roue
        if($donneesEtape['cadre'] = $this->verifEtapeSuivante('cadre', $_GET['sexe'])){

          $meta['title'] = 'Roue - Configurer votre vélo de Route';
          $etape = 'roue';
          $poids += $donneesEtape['cadre']['poids'];
          $prix += $donneesEtape['cadre']['prix'];
          $urlPanier .= 'cadre='.$_GET['cadre'];

          $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, null, $donneesEtape['cadre']['id_taille']);

          // Etape Selle
          if($donneesEtape['roue'] = $this->verifEtapeSuivante('roue', null, $donneesEtape['cadre']['id_taille'])){

            $meta['title'] = 'Selle - Configurer votre vélo de Route';
            $etape = 'selle';
            $poids += $donneesEtape['roue']['poids'];
            $prix += $donneesEtape['roue']['prix'];
            $urlPanier .= '&roue='.$_GET['roue'];

            $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, $_GET['sexe']);

            // Etape Guidon
            if($donneesEtape['selle'] = $this->verifEtapeSuivante('selle', $_GET['sexe'])){

              $meta['title'] = 'Guidon - Configurer votre vélo de Route';
              $etape = 'guidon';
              $poids += $donneesEtape['selle']['poids'];
              $prix += $donneesEtape['selle']['prix'];
              $urlPanier .= '&selle='.$_GET['selle'];

              $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape, $_GET['sexe'], $donneesEtape['cadre']['id_taille']);

              // Etape Groupe
              if($donneesEtape['guidon'] = $this->verifEtapeSuivante('guidon', $_GET['sexe'], $donneesEtape['cadre']['id_taille'])){

                $meta['title'] = 'Groupe - Configurer votre vélo de Route';
                $etape = 'groupe';
                $poids += $donneesEtape['guidon']['poids'];
                $prix += $donneesEtape['guidon']['prix'];
                $urlPanier .= '&guidon='.$_GET['guidon'];

                $donneesPieces = $pieces->donneesParTypePiece($_GET['type'], $etape);

                // Validation de la configuration
                if($donneesEtape['groupe'] = $this->verifEtapeSuivante('groupe')){

                  $meta['title'] = 'Votre vélo - Configurer votre vélo de Route';
                  $etape = 'confirmation';
                  $poids += $donneesEtape['groupe']['poids'];
                  $prix += $donneesEtape['groupe']['prix'];
                  $urlPanier .= '&groupe='.$_GET['groupe'];

                  $donneesPieces = false;

                }

              }

            }

          }

        }

      }

    }


    $this->Render('../vues/velo/configuration-velo.php', array('meta' => $meta, 'msg' => $msg, 'userConnect' => $userConnect, 'userConnectAdmin' => $userConnectAdmin, 'donneesPieces' => $donneesPieces, 'etape' => $etape, 'poids' => $poids, 'prix' => $prix, 'urlPanier' => $urlPanier, 'donneesEtape' => $donneesEtape));

  }

  /**
  * Vérification de l'état $_GET et concordance piece/type
  *
  * @param (string) $etapeVerif
  *
  * @return (array) $donnees
  * @return (bool) false
  */
  public function verifEtapeSuivante($etapeVerif, $sexe = null, $id_taille = null) {

    $pieces = new modeleAssemblage();

    if(isset($_GET[$etapeVerif])
    && !empty($_GET[$etapeVerif])
    && is_numeric($_GET[$etapeVerif])){

      $donnees = $pieces->concordancePieceTypeDonnees($etapeVerif, $_GET[$etapeVerif], $_GET['type'], $sexe, $id_taille);

      return $donnees;

    } else {

      return false;

    }

  }

}
