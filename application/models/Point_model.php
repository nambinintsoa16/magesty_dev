<?php
class point_model extends CI_Model{
 public function __construct(){

 }
public function pointCommercile($matricule,$Id_facture,$Activite,$Eng,$Pospect,$Client_fidel, $satatut){
  $data = [
        'matricule' => $matricule,
        'Id_facture'  => $Id_facture,
        'Client_fidel'  => $Client_fidel,
        'satatut' => $satatut,
        'Pospect'  => $Pospect,
        'Eng'  => $Eng,
        'Activite'  => $Activite
    ];
$this->db->insert('pointressource',$data);     
 
}
}