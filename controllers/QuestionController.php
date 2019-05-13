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
        $notification='';

        switch ($this->action) {
            case 'show': $this->show(); break;
            case 'create': $this->create(); break;
            case 'insert-answer' : $this->insert_answer(); break;
            case 'update-question': $this->update_question(); break;
            case 'vote': $this ->vote(); break;
            case 'state-change': $this ->state(); break;
            case 'delete-question': $this->delete(); break;
            case 'goodanswer': $this->goodanswer(); break;
            default: break;
        }

    }

    //Shows the questions & answers
    public function show() {
        $notification='';

        //If a question is marked as duplicate, you cannot access it unless you're admin
        if(empty($_SESSION['authenticated']) and Db::get_question($_GET['id'])->state == 'D'){
               echo "<script>alert(\"This question is marked as duplicate.\");
                         document.location.href ='http://localhost/projetphp/index.php';
                </script>";

        }elseif (Db::get_question($_GET['id'])->state == 'D' and $_SESSION['member']->is_admin=='0'){
            echo "<script>alert(\"This question is marked as duplicate.\");
                         document.location.href ='http://localhost/projetphp/index.php';
                </script>";
        }

        $question = Db::get_question($_GET['id']);
        $answers = Db::get_answers($_GET['id']);
        require_once (PATH_VIEWS . 'show-question.php');
    }

    //Creating a question
    public function create(){
        $notification = '';

        //Necessary conditions
        if (isset($_POST['form_create_question'])) {
            if (empty($_SESSION['authenticated'])) {
                $notification='You must be logged in to ask a question';
            }elseif (empty($_POST['title'])){
                $notification='You must write your title';
            }elseif (empty($_POST['subject'])){
                $notification='You must write your subject';
            } else{
                $id_inserted_question = $this->_db->insert_question(
                    $_POST['title'],
                    $_POST['subject'],
                    $_POST['category'],
                    $_SESSION['member']->member_id
                );
                if ($id_inserted_question) {
                    //if creating a question is successful, redirects you to the question you just created
                    header("Location: index.php?action=show-question&id=" . $id_inserted_question);
                }
            }
        }
        $categories = $this->_db->select_categories();
        require_once (PATH_VIEWS . 'question.php');
    }

    //Inserting an answer
    public function insert_answer(){
        $question=$this->_db->get_question($_POST['question_id']);
        $answers=$this->_db->get_answers($_POST['question_id']);

        $notification='';

        //Necessary conditions
        if (isset($_POST['form_insert_answer'])) {
            if (empty($_SESSION['authenticated'])){
                $notification='You must be logged in to answer';
            }else{
                $this->_db->insert_answer($_POST['subject'], $_POST['question_id'], $_SESSION['member']->member_id);
                //if answering a question is successful, redirects you to the question you just answered to
                header("Location: index.php?action=show-question&id=" . $_POST['question_id']);
            }
        }
        require_once(PATH_VIEWS . 'show-question.php');
    }

    //Updates the subject
    public function update_question()
    {
        if (isset($_POST['form_update_question'])) {
            if (!empty($_POST['subject_update'])) {
                $this->_db->update_question($_POST['subject_update'], $_POST['question_id_update']);
                //redirects you to the question
                header("Location: index.php?action=show-question&id=".$_POST['question_id_update']);
            }
        }
        require_once (PATH_VIEWS . 'show-question.php');

    }

    //Inserting votes
    public function vote(){
        //Conditions :
        if(isset($_SESSION['member']) and $_SESSION['member']) { //If connected
            if (isset($_POST['form_vote'])) { //if clicked
                try { //tries to vote, you can only vote once, and cant change your vote
                    $this->_db->vote(
                        intval($_POST['question_id_vote']),
                        intval($_SESSION['member']->member_id),
                        intval($_POST['answer_id']),
                        $_POST['form_vote']);
                    header("Location: index.php?action=show-question&id=" . $_POST['question_id_vote']);
                } catch (PDOException $exception) { //Exception that happens when you vote more than once
                    header("Location: index.php?action=show-question&id=" . $_POST['question_id_vote']);
                }
            }
        }else{
            header("Location: index.php?action=show-question&id=" . $_POST['question_id_vote']);
        }
        require_once (PATH_VIEWS . 'show-question.php');

    }

    public function getTotalVote(){
        return TotalVote;
    }

    //States changes
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

    //Deleting questions
    public function delete(){
        if (isset($_POST['form_delete_question'])) {
            $this->_db->delete_votes(intval($_POST['question_id_delete']));
            $this->_db->delete_answers(intval($_POST['question_id_delete']));
            $this->_db->delete_question(intval($_POST['question_id_delete']));
            header("Location: index.php");
        }
    }

    //Choosing the right answer to a question
    public function goodanswer(){
        if (isset($_POST['form_goodanswer'])) {
            $this->_db->mark_as_solved(intval($_POST['question_id_goodanswer']));
            $this->_db->good_answer(intval($_POST['answer_id']),intval($_POST['question_id_goodanswer']));
            header("Location: index.php?action=show-question&id=".$_POST['question_id_goodanswer']);
        }
    }

}