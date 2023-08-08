<?php
class urgent_model extends CI_Model{
 public function __construct(){

 }
public function recherceClient($parametre){
    return $this->db->where($parametre)->get('clientpo')->row_object();
}
public function listUrgent($parametre){
  return $this->db->where($parametre)->get('urgent')->result_object();
}
public function save($parametre){
  return  $this->db->insert('urgent',$parametre);
}
public function liste($parametre){
    return  $this->db->where($parametre)->get('urgent')->result_object();
  }
  public function nombreUrgent($parametre){
    return  $this->db->where($parametre)->count_all_results('urgent'); 
  }
}