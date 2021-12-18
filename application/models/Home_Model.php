<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model {

	public function delete($id){
        $this->db->from("pklonline");
        $this->db->join("product", "user_product.product_id = product.product_id");
        $this->db->join("transaction", "user_product.reff_id = transaction.reff_id");
        $this->db->where("user_product.id", $id);
        $this->db->delete("user_product");
        return true;
    }

    function getParticipantRow(){

        $query = $this->db->get('REGISTER')->num_rows();
     
        return true;
    }
}