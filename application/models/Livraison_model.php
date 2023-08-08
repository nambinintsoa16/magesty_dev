<?php
class Livraison_model extends CI_Model
{
    public function __construct()
    {
    }

    public function selectparametreTombola($parametre)
    {
        return $this->db->where($parametre)->get('parametreTombola')->row_object();
    }
    public function selectsparametreTombola($parametre)
    {
        return $this->db->where($parametre)->get('parametreTombola')->result_object();
    }

    public function selectsparametreTombolaArray($parametre)
    {
        return $this->db->where($parametre)->get('parametreTombola')->result_array();
    }
}
