<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:08
 */

require_once '../models/Db.class.php';


switch ($_GET['action']) {
    case 'show': showQuestion($_GET['id']);
    default: break;
}


function showQuestion(int $id) {
    $question = Db::get_question($id);
    $answers = Db::get_answers($id);

    include '../views/show-question.php';
}

class QuestionController
{
    private $action;
    public function __construct($action='')
    {
        $this->action = $action;
    }

    public function run(){
        if ($this->action == 'show')
            require_once(PATH_VIEWS . 'show-question.php');

    }
}
?>