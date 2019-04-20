<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:07
 */

class LogoutController
{
    public function __construct()
    {

    }

    public function run()
    {
        # (ré)Initialiser le tableau des variables de session
        $_SESSION = array();
        # Détruire la session
        #session_destroy();

        # Ce contrôleur n'affiche pas de vue, il redirige à l'accueil
        header("Location: index.php");
        die();
    }

}