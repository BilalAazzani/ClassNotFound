<?php

class Category {

    private $_category_id;
    private $_name;

    public function __construct($category_id, $name)
    {
        $this->_category_id = $category_id;
        $this->_name = $name;

    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->_category_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }


}

?>