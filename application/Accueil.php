<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends My_Controller {

	public function index()
	{
 
  		$this->load->model('global_model'); 
		$this->load->model('calendrier_model'); 

    if($this->session->userdata('designation')=="Operatrice"){
		if($this->global_model->pourcentage_transaction()!=0){
			$livre=($this->global_model->pourcentage_transaction('livre')*100)/$this->global_model->pourcentage_transaction();
			$annule=($this->global_model->pourcentage_transaction('annule')*100)/$this->global_model->pourcentage_transaction();
			$confirmer=($this->global_model->pourcentage_transaction('confirmer')*100)/$this->global_model->pourcentage_transaction();
		}else{
			$livre=0;
			$annule=0;
			$confirmer=0;
		}
		
		
		
        $data=[
			'client'=>$this->global_model->nombre_client(),
			'produit'=>$this->global_model->nombre_produit(),
			'transaction'=>$this->global_model->nombre_transaction(),
			'livre'=>$livre,
			'annule'=>$annule,
			'confirmer'=>$confirmer
		];

	}else if($this->session->userdata('designation')=="Service_clientel"){
		if($this->global_model->pourcentage_transaction_livre()!=0){
			$livre=($this->global_model->pourcentage_transaction_livre('livre')*100)/$this->global_model->pourcentage_transaction_livre();
			$annule=($this->global_model->pourcentage_transaction_livre('annule')*100)/$this->global_model->pourcentage_transaction_livre();
			$confirmer=($this->global_model->pourcentage_transaction_livre('confirmer')*100)/$this->global_model->pourcentage_transaction_livre();
		}else{
			$livre=0;
			$annule=0;
			$confirmer=0;
		}

		$data=[
			'client'=>$this->global_model->nombre_client(),
			'produit'=>$this->global_model->nombre_produit(),
			'transaction'=>$this->global_model->pourcentage_transaction_livre(),
			'livre'=>$livre,
			'annule'=>$annule,
			'confirmer'=>$confirmer
		];

	}else if($this->session->userdata('designation')=="Controlleur"){
    
		$date=$this->input->post('date');
	
	print_r($date);
	 
	  $content="";
	  $entete=array('totaLclient'=>0,'reponse'=>0,'ca'=>0,'NBProduit'=>0,'totalpublication'=>0);
      $datas=$this->global_model->table_resume($date);
      foreach ($datas as $key => $datas) {
        $data=array(); 
        $produit=0;
		$ca=0;
		$publi=0;
        $data=$this->global_model->table_rapport($date,$datas->operatrice);
		$facture=$this->global_model->ca_facture_opl($datas->operatrice,$date);
		$user=$this->global_model->user($datas->operatrice);
		$sender=$this->global_model->repopl($date,$datas->operatrice);
		$page=$this->global_model->groupeuser($datas->operatrice);
		$publica=$this->global_model->reppublication($datas->operatrice,$date);
		$nb=$this->calendrier_model->cont_resultArrays($date,'previ',$datas->operatrice);
		foreach($facture as $facture){
          $produit+=$facture->Quantite;
		  $ca+=($facture->Quantite*$facture->Prix_detail);
		  
		 
        }
        $content.="<tr><td class='text-center matricule'>".$datas->operatrice."</td><td><a href='".base_url("controlleur/detail_discussion_operatrice/".$datas->operatrice)."' class='link1 timeline'>".$user->Nom." ".$user->Prenom."</a></td><td><a href='".$page->Lien_page."' target='_blank'>".$page->Nom_page."</a></td><td class='text-center'><a href='".base_url("controlleur/detail_publication/".$datas->operatrice)."' class='link1 timeline'>".count($publica)."</a></td><td class='text-center'><a href='".base_url("controlleur/liste_clients/".$datas->operatrice)."' class='link1 timeline'>".count($data)."</a></td><td class='text-center'>".count($sender)."</td><td class='text-center'>".number_format($ca, 2, ',', ' ')."</td><td class='text-center'><a href='#' class='link produit'>".$produit."</a></td><td><a href='".base_url("controlleur/detail_vente_commerciale/".$datas->operatrice)."'>".$nb."</a></td></tr>";
		$entete['totaLclient']+=count($data);
		$entete['reponse']+=count($sender);
		$entete['ca']+=$ca;      
		$entete['NBProduit']+=$produit;  
		$entete['totalpublication']+=count($publica);
		
	}
       $data=['entete'=>$entete,'data'=>$content];
 
 
	}

		$this->render_view('global/'.$this->session->userdata("designation").'/accueil',$data);
	}
   public function pourcentage_transaction_data(){
	
   }

}