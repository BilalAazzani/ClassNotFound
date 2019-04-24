<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:08
 */

class QuestionController
{
    private $_db;
    private $action;
    public function __construct($db, $action='')
    {
        $this->_db = $db;
        $this->action = $action;
    }

    public function run(){

        switch ($this->action) {
            case 'showform' : $this->showform(); break;
            case 'show': $this->show(); break;
            case 'create': $this->create(); break;
            // case 'update': $this->update(); break;
            // case 'delete': $this->delete(); break;
            default: break;
        }

    }

    public function showform() {
        require_once (PATH_VIEWS . 'question.php');
    }

    public function show() {
        $question = Db::get_question($_GET['id']);
        $answers = Db::get_answers($_GET['id']);

        require_once (PATH_VIEWS . 'show-question.php');
    }

    public function create(){
        if (empty($_SESSION['authenticated'])) {
            header("Location: index.php?action=home");
            die();
        }

        if (isset($_POST['form_create_question'])) {
            $id_inserted_question = $this->_db->insert_question(
                $_POST['title'],
                $_POST['subject'],
                $_POST['category'],
                $_SESSION['member']->member_id
            );
            if ($id_inserted_question) {
                header("Location: index.php?action=show-question&id=" . $id_inserted_question);
            }
        }
        $categories = $this->_db->select_categories();
        require_once (PATH_VIEWS . 'question.php');
    }
}
?>