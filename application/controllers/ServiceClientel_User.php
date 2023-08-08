<?php
defined('BASEPATH') or exit('No direct script access allowed');
class serviceClientel_User extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('UserServiceModel');
    date_default_timezone_set('Europe/Moscow');
  }
  public function dateChart(){
    $reponse = $this->UserServiceModel->dateAchat(['Matricule_personnel'=>$this->session->userdata('matricule')]);
    $resultat =array();
    $donne =array();
    $value =array();
    foreach ($reponse as $key => $reponse) {
        array_push($resultat ,$reponse->Date);
        $result="";
        $result =  $this->UserServiceModel->dataAchat(['Matricule_personnel'=>$this->session->userdata('matricule'),'Date'=>$reponse->Date]);
        array_push($donne,$result->total);
    }
   

      $data = [
       'date'=>$resultat ,
       'data'=>$donne

      ];
      echo json_encode($data);
  } 
  
  public function bar(){
        $this->load->model('client_model');
        $codeClient = $this->input->post('codeclient');
        $reponse = $this->client_model->dataAchat(['Matricule_personnel'=>$this->session->userdata('matricule')]);
        $AUT=0;$BEA=0;$BOI=0;$DEO_PAR=0;$HBD=0;$HC=0;$LES=0;$SC=0;$SV=0;
        
        foreach ($reponse as $key => $reponse) {
          $donne=$this->client_model->produits(['Code_produit'=>$reponse->Code_produit]);
          if($donne->famille=="AUTRES"){
             $AUT +=$reponse->Quantite; 
          }else if($donne->famille=="BEAUTE"){
             $BEA +=$reponse->Quantite;
          }else if($donne->famille=="DEO & PARFUM"){
             $DEO_PAR +=$reponse->Quantite;
          }else if($donne->famille=="BOISSON"){
                $BOI +=$reponse->Quantite;
          }else if($donne->famille=="HYGIENE BUCO-DENTAIRE"){
              $HBD +=$reponse->Quantite;
           }else if($donne->famille=="HYGIENE CORPORELLE"){
             $HC +=$reponse->Quantite;
          }else if($donne->famille=="LESSIVE"){
           $LES +=$reponse->Quantite;
          }else if($donne->famille=="SOINS CAPILLAIRE"){
            $SC +=$reponse->Quantite;
          }else if($donne->famille=="SOINS VISAGE"){
            $SV +=$reponse->Quantite;
          }
        }
        $data=array('donne'=>["$AUT","$BEA","$BOI","$DEO_PAR","$HBD","$HC","$LES","$SC","$SV"]);
        //famille
        echo json_encode( $data);
      
  }
  public function tableData(){
    //$this->input->post('parametre')
    $parametre= $this->input->post('parametre');
    if($parametre == 'vente'){
      $resutl= $this->UserServiceModel->tableData();
      $this->load->view('service_clientel/user/tableau/CommendeRealiser',['data' => $resutl]);
    }elseif ($parametre == 'produit') {
      $resultProduct= $this->UserServiceModel->ProduitVendu();
      $this->load->view('service_clientel/user/tableau/ProduitVendu', ['data'=> $resultProduct]);

    }elseif ($parametre == 'client') {
      $resultClient= $this->UserServiceModel->NouveauClients(['datedenregistrement'=>date('Y-m-d'), 'Matricule_personnel' => $this->session->userdata('matricule')]);
      $this->load->view('service_clientel/user/tableau/NouveauClient', ['data' => $resultClient]);
    
    }elseif ($parametre = 'jours') {
     $resutlVente= $this->UserServiceModel->VenteDuJours();
     $this->load->view('service_clientel/user/tableau/VenteDuJour', ['data'=>  $resutlVente]);

    }


  }
 


}
