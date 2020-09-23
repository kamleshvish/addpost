<?php

class Admin_model extends CI_Model {

    private $primary_key;
    private $main_table;
    public $errorCode;
    public $errorMessage;
    public function __construct() {
        parent::__construct();
        $this->main_table = "user";
        $this->primary_key = "id";
        $this->main_table = "client";
        $this->primary_key = "id";
    }


    public function cat_save($data)
	{
		if($this->db->insert('user',$data))
		{
			return true;
		}
	}

public function cient_save($data)
    {
        if($this->db->insert('client',$data))
        {
            return true;
        }
    }
    public function clien_edite($data,$id)
     {
        $this->db->SET($data);
         $this->db->WHERE('id',$id);
          if($this->db->update('client',$data))
           {
                return true;
            }
        }
    

    public function delet_client($id)
        {
            $this->db->where('id',$id);
            if($this->db->delete('client'))
            {
                return true;
            }
        }
         
} 