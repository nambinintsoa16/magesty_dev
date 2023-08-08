<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controleur extends My_Controller {

    public function acceuil(){
        $this->load->model('global_model'); 
        $this->load->model('calendrier_model'); 
        if($this->session->userdata('designation')=="Controlleur"){
          $dateD = $this->input->post('dateAutre1');
          $dateF = $this->input->post('dateAutre2');
          if(isset($dateD) AND isset($dateF)){
            $dateD = $this->input->post('dateAutre1');
            $dateF = $this->input->post('dateAutre2');
            $mois = null;
          }else{
            $dateD = null;
            $dateF = null;
            $now   = new DateTime;
            $mois = $now->format( 'Y-m' );
          }
          $content="";
        $entete=array('totaLclient'=>0,'reponse'=>0,'ca'=>0,'NBProduit'=>0,'totalpublication'=>0, 'date1'=>0, 'date2'=>0);
        $datas=$this->global_model->table_resume2($mois,$dateD,$dateF);
          foreach ($datas as $key => $datas) {
            $data=array(); 
            $produit=0;
        $ca=0;
        $publi=0;
        $data=$this->global_model->table_rapport2($mois,$datas->operatrice,$dateD,$dateF);
        $facture=$this->global_model->ca_facture_opl2($mois,$datas->operatrice,$dateD,$dateF);
        $user=$this->global_model->user($datas->operatrice);
        $sender=$this->global_model->repopl2($mois,$datas->operatrice,$dateD,$dateF);
        $page=$this->global_model->groupeuser($datas->operatrice);
        $publica=$this->global_model->reppublication2($datas->operatrice,$mois,$dateD,$dateF);
        $livre=$this->global_model->ca_facture_opl3($mois,$datas->operatrice,$dateD,$dateF);
        $nb=$this->calendrier_model->cont_resultArrays2($mois,'previ',$datas->operatrice,$dateD,$dateF);
        foreach($facture as $facture){
              $produit+=$facture->Quantite;
          $ca+=($facture->Quantite*$facture->Prix_detail);
            
        }
            
        if($page){
          $link_page=$page->Lien_page;
          $page_name=$page->Nom_page;
           }else{
          $link_page="";
          $page_name="";
           }     
           
            $content.="<tr style='font-size:9px;'><td>".$datas->operatrice."</td><td><a href='".$link_page."' target='_blank'>".$page_name."</a></td><td class='text-center'><a href='".base_url("controlleur/detail_publication/".$datas->operatrice."/".$mois)."' class='link1 timeline'>".count($publica)."</a></td><td style='width:60px' class='text-center'><a href='".base_url("controlleur/liste_clients/".$datas->operatrice."/".$mois)."' class='link1 timeline'>".count($data)."</a></td><td style='width:50px' class='text-center'>".count($sender)."</td><td style='width:50px' class='text-center'><a href='".base_url("controlleur/detail_vente_commerciale/".$datas->operatrice."/".$mois)."'>".$nb."</a></td></tr>";
            $entete['totaLclient']+=count($data);
            $entete['reponse']+=count($sender);
            $entete['ca']+=$ca;      
            $entete['NBProduit']+=$produit;  
            $entete['totalpublication']+=count($publica);
            $entete['date1']=$dateD;
            $entete['date2']=$dateF;
        
      }
           $data=['entete'=>$entete,'data'=>$content];
      
      
      }
      
        $this->render_view('Controlleur/acceuil',$data);
      
        }

}

