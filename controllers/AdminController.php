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
        #If not Admin cannot access the page
        if (empty($_SESSION['authenticated']) or $_SESSION['member']->is_admin != '1') {
            header("Location: index.php?action=home");
            die();
        }

        require_once(PATH_VIEWS . 'admin.php');
    }

}