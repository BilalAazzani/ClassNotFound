<?php
/**
 * Created by PhpStorm.
 * User: HP EliteBook
 * Date: 28-03-19
 * Time: 07:58
 */

Class members
{
    private $_first_name;
    private $_last_name;
    private $_member_id;
    private $_email;
    private $_is_admin;
    private $_is_active;


    public function __construct($first_name, $last_name, $member_id, $email, $is_admin, $is_active)
    {
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_member_id = $member_id;
        $this->_email = $email;
        $this->_is_admin = $is_admin;
        $this->_is_active = $is_active;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_last_name;
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
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    public function getisAdmin()
    {
        return $this->_is_admin;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->_is_active;
    }


}

?>