<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model {

	public function delete($id){
        $this->db->delete('USER_PRODUCT', ['id' => $id]);
    }
}