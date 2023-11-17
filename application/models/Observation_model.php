<?php
class Observation_model extends CI_Model {
    public function __construct(){

    }

    public function saveObservation($observationData, $selectedProducts) {
        $this->db->trans_start();
        $this->db->insert('observation', $observationData);
        $observationId = $this->db->insert_id(); // Obtenez l'ID de l'observation insérée

        if (!empty($selectedProducts)) {
            foreach ($selectedProducts as $code) {
                $productData = array(
                    'Code_produit' => $code,
                    'id_observation' => $observationId
                );
        
                $this->db->insert('observation_produit', $productData);
            }
        }

        $this->db->trans_complete(); // Terminez la transaction
    }

    public function getAllObservationsByCodeClient($codeClient) {
        $this->db->select('observation.*,appreciation_oplg.description_appreciation,constraint_customer.description_customer,GROUP_CONCAT(produit.Designation SEPARATOR " / ") AS products');
        $this->db->from('observation');
        $this->db->join('observation_produit', 'observation.id_observation = observation_produit.id_observation', 'left');
        $this->db->join('produit', 'produit.Code_produit = observation_produit.Code_produit', 'left');
        $this->db->join('constraint_customer', 'observation.constraint_customer = constraint_customer.id_constraint', 'left');
        $this->db->join('appreciation_oplg', 'observation.appreciation = appreciation_oplg.id_appreciation_oplg', 'left');
        $this->db->where('observation.code_client', $codeClient);
        $this->db->group_by('observation.id_observation');
        $this->db->order_by('observation.date', 'desc'); 
        $this->db->limit(5); 
        $query = $this->db->get();
        return $query->result();
    }   
    
    public function getAllObservations() {
        $this->db->select('observation.*,appreciation_oplg.description_appreciation,constraint_customer.description_customer,clientpo.Compte_facebook,GROUP_CONCAT(produit.Designation SEPARATOR " / ") AS products');
        $this->db->from('observation');
        $this->db->join('observation_produit', 'observation.id_observation = observation_produit.id_observation', 'left');
        $this->db->join('produit', 'produit.Code_produit = observation_produit.Code_produit', 'left');
        $this->db->join('constraint_customer', 'observation.constraint_customer = constraint_customer.id_constraint', 'left');
        $this->db->join('appreciation_oplg', 'observation.appreciation = appreciation_oplg.id_appreciation_oplg', 'left');
        $this->db->join('clientpo', 'observation.code_client = clientpo.Code_client');
        $this->db->group_by('observation.id_observation');
        $this->db->order_by('observation.date', 'desc'); 
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllObservations($searchDate) {
        $this->db->select('observation.*,appreciation_oplg.description_appreciation,constraint_customer.description_customer,clientpo.Compte_facebook,GROUP_CONCAT(produit.Designation SEPARATOR " / ") AS products');
        $this->db->from('observation');
        $this->db->join('observation_produit', 'observation.id_observation = observation_produit.id_observation', 'left');
        $this->db->join('produit', 'produit.Code_produit = observation_produit.Code_produit', 'left');
        $this->db->join('constraint_customer', 'observation.constraint_customer = constraint_customer.id_constraint', 'left');
        $this->db->join('appreciation_oplg', 'observation.appreciation = appreciation_oplg.id_appreciation_oplg', 'left');
        $this->db->join('clientpo', 'observation.code_client = clientpo.Code_client');
        $this->db->where('DATE(observation.date_relance)', $searchDate);
        $this->db->group_by('observation.id_observation');
        $this->db->order_by('observation.date', 'desc'); 
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