<?php

class Model
{

    /**
     * Database object
     *
     * @var obj
     */
    protected $db;

    public function __construct() {
        
        $this->db = new Database();

    }

}