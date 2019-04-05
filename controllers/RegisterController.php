<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:08
 */

class RegisterController
{
    public function __construct()
    {
    }

    public function run(){

        require_once(PATH_VIEWS . 'register.php');
    }

}

?>