<?php
class login_model extends CI_Model{
 public function __construct(){

 }

 public function get_utilisateur_info($matricule){

  $this->db->select("comptefb.Nom_page,personnel.Matricule, comptefb.id as page,personnel.Nom, personnel.Prenom, personnel.Cin_personnel, personnel.Mode_de_pass_login, fonction.designation, fonction.id AS id_designation");
  $this->db->join('fonction', "fonction.id = personnel.Fonction_actuelle", "inner");
  $this->db->join('page_fb', "page_fb.operatrice = personnel.Matricule");
  $this->db->join('comptefb', "page_fb.Lien_page = comptefb.Lien_page");  
  $this->db->where('Matricule', $matricule);
  $this->db->where('page_fb.statut','on');
  $this->db->where('comptefb.statut','on');
  $query = $this->db->get('personnel');
  return $query->unbuffered_row();
}


public function pageFacebook($parametre){
  return $this->db->where($parametre)
          ->like('statut',"on")
          ->get('page_fb')->row_object();
  
}

public function page_fb($parametre){
 return  $this->db->where($parametre)
          ->select('comptefb.id,comptefb.Nom_page')        
          ->like('page_fb.statut',"on")
          ->join('comptefb', "page_fb.Lien_page = comptefb.Lien_page") 
          ->get('page_fb')->result_array();
}



}
