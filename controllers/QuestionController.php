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
            case 'show': $this->show(); break;
            case 'create': $this->create(); break;
            case 'insert-answer' : $this->insert_answer(); break;
            case 'update-question': $this->update_question(); break;
            case 'vote-plus': $this ->vote_plus(); break;
            case 'vote-minus': $this ->vote_minus(); break;
            // case 'delete': $this->delete(); break;
            default: break;
        }

    }

    public function show() {
        $question = Db::get_question($_GET['id']);
        $answers = Db::get_answers($_GET['id']);

        require_once (PATH_VIEWS . 'show-question.php');
    }

    public function create(){


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

    public function insert_answer(){
        if(isset($_POST['form_insert_answer'])){
            $this->_db->insert_answer($_POST['subject'],$_POST['question_id'],$_SESSION['member']->member_id);

            header("Location: index.php?action=show-question&id=".$_POST['question_id']);
        }

        require_once(PATH_VIEWS . 'showquestion.php');
    }

    public function update_question()
    {
        $vueupdate = false;

        if (isset($_POST['form_update_question'])) {
            if (!empty($_POST['subject_update'])) {
                $this->_db->update_question($_POST['subject_update'], $_POST['question_id_update']);
                header("Location: index.php?action=show-question&id=".$_POST['question_id_update']);
            }
        }
        require_once (PATH_VIEWS . 'show-question.php');

    }

    public function vote(){
        if (isset($_POST['form_vote_plus'])) {
                $this->_db->vote_plus($_SESSION['member_id'] -> member_id, $_POST['']);
                header("Location: index.php?action=show-question&id=".$_POST['question_id_update']);
            }

        require_once (PATH_VIEWS . 'show-question.php');

    }
}
?>