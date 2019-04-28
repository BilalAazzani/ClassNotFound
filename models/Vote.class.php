<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 28-03-19
 * Time: 07:58
 */

Class Vote
{
    private $_member_id;
    private $_answer_id;
    private $_vote_value;

    public function __construct($member_id, $answer_id, $vote_value)
    {
        $this->_member_id = $member_id;
        $this->_answer_id = $answer_id;
        $this->_vote_value = $vote_value;

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
    public function getAnswerId()
    {
        return $this->_answer_id;
    }

    /**
     * @return mixed
     */
    public function getVoteValue()
    {
        return $this->_vote_value;
    }



}
?>