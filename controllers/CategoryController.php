<?php
/**
 * Created by PhpStorm.
 * User: Amine-Ayoub
 * Date: 22/03/2019
 * Time: 10:08
 */

class CategoryController
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run()
    {
        $tab_question_cat=$this->_db->get_question_cat($_GET['catid']);
        $categories = $this->_db->select_categories();

        require_once(PATH_VIEWS . 'category.php');
    }
}

?>