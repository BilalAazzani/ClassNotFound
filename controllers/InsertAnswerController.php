<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 25-04-19
 * Time: 08:51
 */

class InsertAnswerController
{
    private $_db;
    public function __construct($db)
    {
        $this->_db=$db;


    }

    public function run(){

        if (empty($_SESSION['authenticated'])) {
            header("Location: index.php?action=home");
            die();
        }

        if (isset($_POST['form_insert_answer'])) {
            $id_inserted_answer = $this->_db->insert_answer(
                $_POST['subject'],
                $_GET['id'],
                $_SESSION['member']->member_id);
            }

        if ($id_inserted_answer) {
            header("Location: index.php?action=show-question.php&id=" . $id_inserted_answer);
        }

            require_once (PATH_VIEWS . 'show-question.php');
    }


}