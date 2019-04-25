<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:08
 */

class MemberController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;

    }

    public function run()
    {

        
        #If not Admin cannot access the page
        if (empty($_SESSION['authenticated']) or $_SESSION['member']->is_admin != '1') {
            header("Location: index.php?action=home");
            die();
        }

        if(!empty($_POST['form_suspend'])){
            $this->_db->suspend_user($_POST['form_suspend']);
        }elseif(!empty($_POST['form_unsuspend'])){
            $this->_db->unsuspend_user($_POST['form_unsuspend']);
        } elseif(!empty($_POST['form_make_admin'])){
            $this->_db->make_admin($_POST['form_make_admin']);
        } elseif(!empty($_POST['form_make_member'])){
            $this->_db->make_member($_POST['form_make_member']);
        }

        $tabmembers=$this->_db->get_members();
        require_once(PATH_VIEWS . 'member.php');
    }
}



?>