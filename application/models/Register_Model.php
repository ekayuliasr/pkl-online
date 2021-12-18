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

    public function deleteParticipant($id){
        $this->db->where('REG_ID',$id);
        $this->db->delete('register');
        return true;
   }

    function total(){
        $this->db->select('COUNT(FULLNAME) as total');
        $this->db->get('register');
        return true;
    }
}


