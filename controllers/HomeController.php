<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 18/03/2019
 * Time: 09:22
 */

class HomeController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run(){

        $html_keyword='';

        //Displaying the questions on the home page
        if (!empty($_POST['form_search'])
            && !empty($_POST['keyword'])) {
            $tabquestions=$this->_db->select_question($_POST['keyword']);
            $html_keyword=htmlspecialchars($_POST['keyword']); # XSS protection
        } else {
            $tabquestions=$this->_db->select_question();
        }

        $categories = $this->_db->select_categories(); //get categories
        require_once(PATH_VIEWS . 'home.php');
    }


}
?>