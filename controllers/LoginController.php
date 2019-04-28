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

    public function run()
    {

        if (!empty($_SESSION['authenticated'])) {
            header("Location: index.php?action=home");
            die();
        }

        $notification = '';
        $member = false;
        if (!empty($_POST)) {
            $member = $this->_db->validate_member($_POST['email'], $_POST['password']);
            if($member){
                $_SESSION['authenticated'] = 'autorised';
                $_SESSION['member'] = $member;
                $_SESSION['login'] = $_POST['email'];

                if ($member->is_active == '0') {
                    $notification = 'Your account is suspended';
                    session_destroy();
                }elseif ($member->is_admin == '1'){
                    header("Location: index.php?action=admin");
                } else {
                    header("Location: index.php?action=home");
                }
            }else  {
                $notification = 'Your email or password is wrong.';
            }
        }

        require_once(PATH_VIEWS . 'login.php');
    }


}

?>