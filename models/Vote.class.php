<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 28-03-19
 * Time: 07:58
 */

Class Vote
{
    private $answer_id;
    private $_value;
    private $_member_id;

    public function __construct($answer_id, $value, $member_id)
    {
        $this-> answer_id = $answer_id;
        $this->_value = $value;
        $this->_member_id = $member_id;

    }

    /**
     * @return mixed
     */
    public function getAnswerId()
    {
        return $this->answer_id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return mixed
     */
    public function getMemberId()
    {
        return $this->_member_id;
    }

}
?>