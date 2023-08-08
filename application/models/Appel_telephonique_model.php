<?php
class Appel_telephonique_model extends CI_Model
{

  public function UpdateApple($requette,$data){
    return $this->db->where($requette)->update('clientappel',$data);
  }
  public function SelectApple($requette=array()){
   return $this->db->where($requette)->get('clientappel')->result_object();
 }
 
  public function type_appel($requette=array()){
   return $this->db->where($requette)->get('type_appel')->result_object();
 }
 
 public function result_appel($requette=array()){
   return $this->db->where($requette)->get('result_appel')->result_object();
 }
  
}



