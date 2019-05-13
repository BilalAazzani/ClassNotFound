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

    public function run()
    {
        $notification = '';

        if (!empty($_POST)) {
            //Sign in conditions but bootstrap does it by default

            /*if(empty($_POST['password']) and empty($_POST['email'])){
                 $notification = 'You must enter your email and password';
             }elseif (empty($_POST['password'])){
                 $notification = 'You must enter your password';
             }elseif (empty($_POST['email'])){
                 $notification = 'You must enter your email';
             }elseif (empty($_POST['first_name']) or empty($_POST['last_name'])){
                 $notification = 'You must enter your first/last name';
             } else{ */
                $this->_db->insert_member($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password']);
                $notification='You can now log in';
           // }
        }

        require_once(PATH_VIEWS . 'register.php');
    }
}

?>