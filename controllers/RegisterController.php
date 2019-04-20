<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:08
 */

class RegisterController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;

    }

    public function run(){

        if (isset($_POST['form_register'])) {
            $this->_db->insert_member($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['password']);

        }

        require_once(PATH_VIEWS . 'register.php');
    }

}

?>