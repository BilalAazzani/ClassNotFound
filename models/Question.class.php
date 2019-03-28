<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 28-03-19
 * Time: 07:58
 */

class Questions
{
    private $_id;
    private $_title;
    private $_subject;
    private $_category;
    private $_member;
    private $_creation_date;
    private $_state;

    public function __construct($id, $title, $subject, $category, $member, $creation_date, $state)
    {
        $this->_id = $id;
        $this->_title = $title;
        $this->_subject = $subject;
        $this->_category = $category;
        $this->_member = $member;
        $this->_creation_date = $creation_date;
        $this-> _state = $state;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * @return mixed
     */
    public function getMember()
    {
        return $this->_member;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->_creation_date;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }










}
?>