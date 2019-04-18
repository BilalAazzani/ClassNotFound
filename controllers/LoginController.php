<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:07
 */

class LoginController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;

    }

    public function run(){

        if (!empty($_SESSION['authenticated'])) {
            header("Location: index.php?action=home");
            die();
        }

        $notification='';

        if (empty($_POST)) {
            # L'utilisateur doit remplir le formulaire
            $notification='Please sign in';
        } elseif (!$this->_db->validate_member($_POST['email'],$_POST['password'])) {
            # Wrong credentials
            $notification='Your email or password is wrong.';
        } elseif ($this->_db->verify_admin($_POST['email'])){
            $_SESSION['authenticated'] = 'autorised';
            $_SESSION['login'] = $_POST['email'];
            header("Location: index.php?action=admin");
            die();
        }


        require_once(PATH_VIEWS . 'login.php');
    }


}

?>