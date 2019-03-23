<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 18/03/2019
 * Time: 09:22
 */

class HomeController
{
    public function __construct()
    {
    }

    public function run(){

        #view
        require_once (PATH_VIEWS.'home.php');
    }

}
?>