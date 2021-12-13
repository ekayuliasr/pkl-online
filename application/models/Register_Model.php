<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register_Model extends CI_Model {

	function input_data($data,$table){
		$this->db->insert($table,$data);
	}
}

/* End of file API_Model.php */
