<?php
class info_Annulation extends CI_Model
{
  public function __construct()

  {
  }
  public function liste_Annulation(){
  	$this->db->select('annulation.id', 'livraison.code_annul', 'annulation.contenu');
    
  	return $this->db->get('annulation')->result_object();
  }
}
