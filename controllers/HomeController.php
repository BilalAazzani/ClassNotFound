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


        $tabquestions=$this->_db->select_question();

        require_once(PATH_VIEWS . 'home.php');
    }


}
?>