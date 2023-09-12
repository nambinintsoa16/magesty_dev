<?php
class Appreciation_oplg_model extends CI_Model {
    public function __construct(){

    }

    public function getAllAppreciationOplg() {
        $this->db->select('*');
        $this->db->from('appreciation_oplg');
        $query = $this->db->get();
        return $query->result();
    }  
}