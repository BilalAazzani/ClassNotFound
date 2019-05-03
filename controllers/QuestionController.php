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
            case 'vote': $this ->vote(); break;
            case 'state-change': $this ->state(); break;
            case 'delete-question': $this->delete(); break;
            default: break;
        }

    }

    public function show() {

        if(Db::get_question($_GET['id'])->state == 'D' and $_SESSION['member']->is_admin=='0'){

               echo "<script>alert(\"This question is marked as duplicate.\");

                         document.location.href ='http://localhost:63342/projetphp/index.php';

                </script>";
        }

        $question = Db::get_question($_GET['id']);
        $answers = Db::get_answers($_GET['id']);

        /*$new_answers = new ArrayObject();
        foreach($answers as $answer){
            $test = new Answer($answer->answer_id,
            $answer->subject,
            $answer->member_id,
            $answer->creation_date,
            $answer->question_id
            );

            $new_answers->append($test);
        }
        var_dump($new_answers);*/
        require_once (PATH_VIEWS . 'show-question.php');
    }

    public function create(){
        $notification = '';

        if (isset($_POST['form_create_question'])) {
            if (empty($_SESSION['authenticated'])) {
                $notification='You must be logged in to ask a question';
            }else{
                $id_inserted_question = $this->_db->insert_question(
                    $_POST['title'],
                    $_POST['subject'],
                    $_POST['category'],
                    $_SESSION['member']->member_id
                );
                if ($id_inserted_question) {
                    header("Location: index.php?action=show-question&id=" . $id_inserted_question);
                }}


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
        if (isset($_POST['form_update_question'])) {
            if (!empty($_POST['subject_update'])) {
                $this->_db->update_question($_POST['subject_update'], $_POST['question_id_update']);
                header("Location: index.php?action=show-question&id=".$_POST['question_id_update']);
            }
        }
        require_once (PATH_VIEWS . 'show-question.php');

    }

    public function vote(){
        if (isset($_POST['form_vote'])) {
            $this->_db->vote(intval($_SESSION['member']->member_id), intval($_POST['answer_id']), $_POST['form_vote']);
            header("Location: index.php?action=show-question&id=".$_POST['question_id_vote']);
        }
        require_once (PATH_VIEWS . 'show-question.php');

    }

    public function getTotalVote(){
        return TotalVote;
    }

    public function state(){
        if (isset($_POST['form_duplicate_question'])) {
            $this->_db->mark_duplicate(intval($_POST['question_id_duplicate']));
            header("Location: index.php");
        }elseif (isset($_POST['form_open_question'])) {
            $this->_db->mark_open(intval($_POST['question_id_open']));
            header("Location: index.php");
        }elseif (isset($_POST['form_mark_as_solved'])){
            $this->_db->mark_as_solved (intval($_POST['question_id_solved']));
            header("Location: index.php");
        }
    }

    public function delete(){
        if (isset($_POST['form_delete_question'])) {
            $this->_db->delete_answers(intval($_POST['question_id_delete']));
            $this->_db->delete_question(intval($_POST['question_id_delete']));
            header("Location: index.php");
        }
    }

}