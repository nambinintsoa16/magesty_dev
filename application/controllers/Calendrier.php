<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class calendrier extends My_Controller {

public function data_json_calendrier($statut){
$tab=array();
$i=0;
$this->load->model('Calendrier_model');
$color=array('pre'=>"#0062cc!important",'ann'=>"#CC0000!important","pla"=>"#563d7c!important","liv"=>"green!important","etdc"=>"orange!important");
$type=array('pre'=>"previ",'ann'=>"annule","pla"=>"confirmer","liv"=>"livre","etdc"=>"en_attente");
foreach ($this->Calendrier_model->retour_date() as $data) {
$count="";
$count=$this->Calendrier_model->cont_resultArray($data->Date,$type[$statut]);
$tab[$i]=array(
            'id' => $i,
            'title' => "V " .strtoupper($statut)." : ".$count,
            'start' => $data->Date,
            'color' => $color[$statut]    
    );   
 
  $i++;  
}
   echo json_encode($tab);
 }


 public function data_json_calendriers($statut){
  $tab=array();
  $i=0;
  $this->load->model('Calendrier_model');
  $color=array('pre'=>"#0062cc!important",'ann'=>"#CC0000!important","pla"=>"#563d7c!important","liv"=>"green!important","etdc"=>"orange!important");
  $type=array('pre'=>"previ",'ann'=>"annule","pla"=>"confirmer","liv"=>"livre","etdc"=>"en_attente");
  foreach ($this->Calendrier_model->retour_date_livre() as $data) {
  $count="";
  $count=$this->Calendrier_model->cont_resultArray_livre($data->date_de_livraison,$type[$statut]);
  $tab[$i]=array(
              'id' => $i,
              'title' => "V " .strtoupper($statut)." : ".$count,
              'start' => $data->date_de_livraison,
              'color' => $color[$statut]    
      );   
   
    $i++;  
  }
     echo json_encode($tab);
   }


   public function data_json_controlleur_calendriers($statut){
    $tab=array();
    $i=0;
    $this->load->model('Calendrier_model');
    $color=array('pre'=>"#0062cc!important",'ann'=>"#CC0000!important","pla"=>"#563d7c!important","liv"=>"green!important","etdc"=>"orange!important");
    $type=array('pre'=>"previ",'ann'=>"annule","pla"=>"confirmer","liv"=>"livre","etdc"=>"en_attente");
    foreach ($this->Calendrier_model->retour_date_livre_vente() as $data) {
    $count="";
    $count=$this->Calendrier_model->cont_resultArray_vente($data->Date,$type[$statut]);
    $tab[$i]=array(
                'id' => $i,
                'title' => "V " .strtoupper($statut)." : ".$count,
                'start' => $data->Date,
                'color' => $color[$statut]    
        );   
     
      $i++;  
    }
       echo json_encode($tab);
     }
  


}








