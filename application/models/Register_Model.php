<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register_Model extends CI_Model {


	private $table = 'register';

	function input_data($data,$table){
		$this->db->insert($table,$data);
	}

	public function getAll()
    {
        $this->db->from($this->table);
       
        $query = $this->db->get();
        return $query->result();
        
    }
}


