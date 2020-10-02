<?php

class Admin_model extends CI_Model {

    private $primary_key;
    private $main_table;
    public $errorCode;
    public $errorMessage;
    public function __construct() {
        parent::__construct();
        $this->main_table = "client";
        $this->primary_key = "id";
    }


    public function client_save($data)
	{
		if($this->db->insert('client',$data))
		{
			return true;
		}
	}

    
}
