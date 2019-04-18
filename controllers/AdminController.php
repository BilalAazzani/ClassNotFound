<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:08
 */

class AdminController
{

    public function __construct() {

    }

    public function run(){
        # Si un petit fûté écrit ?action=admin sans passer par l'action login
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); # redirection HTTP vers l'action login
            die();
        }
        # Arrivé ici l'authentification est valide... continuons...

        # Variable HTML pour la vue
        $html_pseudo = htmlspecialchars($_SESSION['login']);

        # Ecrire ici la vue
        require_once(CHEMIN_VUES . 'admin.php');
    }

}