<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 28-03-19
 * Time: 07:58
 */

Class Vote
{
    private $_member;
    private $_answer;
    private $_vote_value;

    /**
     * Vote constructor.
     * @param $_member
     * @param $_answer
     * @param $_vote_value
     */
    public function __construct($_member, $_answer, $_vote_value)
    {
        $this->_member = $_member;
        $this->_answer = $_answer;
        $this->_vote_value = $_vote_value;
    }

    /**
     * @return mixed
     */
    public function getMember()
    {
        return $this->_member;
    }

    /**
     * @param mixed $member
     */
    public function setMember($member)
    {
        $this->_member = $member;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->_answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer)
    {
        $this->_answer = $answer;
    }

    /**
     * @return mixed
     */
    public function getVoteValue()
    {
        return $this->_vote_value;
    }

    /**
     * @param mixed $vote_value
     */
    public function setVoteValue($vote_value)
    {
        $this->_vote_value = $vote_value;
    }

}
 ?>