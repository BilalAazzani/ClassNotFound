<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 18/04/2019
 * Time: 13:32
 */

class CreateQuestionController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;

    }


    public function run(){
        if (empty($_SESSION['authenticated'])) {
            header("Location: index.php?action=home");
            die();
        }

        $categories = $this->_db->select_categories();
        require_once(PATH_VIEWS . 'question.php');

    }
}
?>