<?php
class Customer_sentiment_model extends CI_Model {
    public function __construct(){

    }

    public function getAllCustomerSentiment() {
        $this->db->select('*');
        $this->db->from('customer_sentiment');
        $query = $this->db->get();
        return $query->result();
    }  
}