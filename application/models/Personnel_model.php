<?php
class Personnel_model extends CI_Model
{
    public function __construct()
    {
    }
    public function autoCompletePersonnel($mot)
   {
      return $this->db->like('Matricule', $mot)
         ->or_like('Nom', $mot)
         ->or_like('Prenom', $mot)
         ->limit(10)
         ->get('personnel')->result_object();
   }


}

