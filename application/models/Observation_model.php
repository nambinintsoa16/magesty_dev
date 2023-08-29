<?php
class Observation_model extends CI_Model {
    public function __construct(){

    }

    public function saveObservation($observationData) {
        return $this->db->insert('observation', $observationData);
    }

    public function getAllObservationsByCodeClient($codeClient) {
        $this->db->select('*');
        $this->db->from('observation');
        $this->db->join('produit', 'observation.product_name = produit.code_produit', 'left');
        $this->db->join('delivery_area', 'observation.delivery_area = delivery_area.id_delivery_area', 'left');
        $this->db->join('customer_sentiment', 'observation.customer_sentiment = customer_sentiment.id_customer_sentiment', 'left');
        $this->db->join('appreciation_oplg', 'observation.appreciation = appreciation_oplg.id_appreciation_oplg', 'left');
        $this->db->where('observation.code_client', $codeClient);
        $this->db->order_by('observation.date', 'desc'); 
        $this->db->limit(5); 
        $query = $this->db->get();
        return $query->result();
    }    
    

    public function getPurchaseNumberByCodeClient($codeClient) {
        $this->db->select('COUNT(purchase_number) as purchase_count');
        $this->db->from('observation');
        $this->db->where('code_client', $codeClient);
        $query = $this->db->get();
        $result = $query->row();
        return $result->purchase_count;
    }
    
    public function getNumberOfRefusalsByCodeClient($codeClient) {
        $this->db->select('COUNT(number_of_refusals) as refusal_count');
        $this->db->from('observation');
        $this->db->where('code_client', $codeClient);
        $query = $this->db->get();
        $result = $query->row();
        return $result->refusal_count;
    }
    
} 