<?php
class Delivery_area_model extends CI_Model {
    public function __construct(){

    }

    public function getAllDeliveryArea() {
        $this->db->select('*');
        $this->db->from('delivery_area');
        $query = $this->db->get();
        return $query->result();
    }  
}