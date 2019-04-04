<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 28-03-19
 * Time: 07:58
 */
Class Answer {
    private $_answer_id;
    private $_subject;
    private $_member_id;
    private $_creation_date;
    private $_question_id;


    public function __construct($answer_id, $subject, $member_id, $creation_date, $question_id)
    {
        $this->_answer_id = $answer_id;
        $this->_subject = $subject;
        $this->_member_id = $member_id;
        $this->_creation_date = $creation_date;
        $this->_question_id = $question_id;

    }

    /**
     * @return mixed
     */
    public function getAnswerId()
    {
        return $this->_answer_id;
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
    public function getMemberId()
    {
        return $this->_member_id;
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
    public function getQuestionId()
    {
        return $this->_question_id;
    }

}

?>