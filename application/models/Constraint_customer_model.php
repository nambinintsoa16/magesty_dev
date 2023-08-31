<?php
class Constraint_customer_model extends CI_Model {
    public function __construct(){

    }

    public function getAllConstraints() {
        $this->db->select('*');
        $this->db->from('constraint_customer');
        $query = $this->db->get();
        return $query->result();
    }  
}