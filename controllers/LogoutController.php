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
        $_SESSION = array();
        # Destroy session
        #session_destroy();

        # Header to home
        header("Location: index.php");
        die();
    }

}