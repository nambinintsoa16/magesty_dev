<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_comptabilite extends My_Controller {

  public function Calendrier_de_livraison(){
        $this->render_view("Service_comptabilite/calendrier/index");
  }
  public function detail_livraison($date){
    $this->load->model("Compta_model");
    $this->load->model("Global_model");
    $this->Compta_model->ca_vente_livre($date);
    $previ = $this->Compta_model->ca_vente_livre($date);
    //var_dump($previ);
    $Previsionnelle=0;
    $annule=0;
    $Decis=0;
    $Plan=0;
    $repporte=0;
    if($previ){
      foreach ($previ as $key => $valiny) {
        if($valiny->statut != "annuler"){
           $Previsionnelle+= ($valiny->Quantite*$valiny->Prix_detail);
        }
      }
    }
    $livr=$this->Compta_model->ca_vente_livre($date,'livre');

    $Realisees=0;
    if($livr){
        foreach ($livr as $key => $liv) {
          if($liv->statut!='annuler'){
             $Realisees+= ($liv->Quantite*$liv->Prix_detail);
          }
        } 
      }
      $annul=$this->Compta_model->ca_vente_livre($date,'annule');
    if($annul){
        foreach ($annul as $key => $annul) {
          $annule+= ($annul->Quantite*$annul->Prix_detail);
        } 
      }
      $Decision=$this->Compta_model->ca_vente_livre($date,'en_attente');
      if($Decision){
        foreach ($Decision as $key => $Decision) {
          if($Decision->statut!='annuler'){
             $Decis+= ($Decision->Quantite*$Decision->Prix_detail);
          }
        } 
      }
   
      $Planifiees=$this->Compta_model->ca_vente_livre($date,'confirmer');
      if($Planifiees){
        foreach ($Planifiees as $key => $Planifiees) {
          if($Planifiees->statut!='annuler'){
            $Plan+= ($Planifiees->Quantite*$Planifiees->Prix_detail);
          }
        } 
      }


      $rep=$this->Compta_model->ca_vente_repporet($date,'repporte');
      if($rep){
        foreach ($rep as $key => $rep) {
          if($rep->statut!='annuler'){
          $repporte+= ($rep->Quantite*$rep->Prix_detail);
          }
        } 
      }

    /*  $Previsionnelle = $this->Global_model->Somme_Tsenakoty_Previ($dta);
      $Realisees = $this->Global_model->Somme_Tsenakoty_Livre($dta);
      $annule = $this->Global_model->Somme_Tsenakoty_Annule($dta);
      $Plan = $this->Global_model->Somme_Tsenakoty_Confirme($dta);
      

      $data=['Previsionnelle'=>$Previsionnelle,'Realisees'=>$Realisees,'Annulees'=>$annule,'Planifiees'=>$Plan,'date'=>$date];*/

   $data=['Previsionnelle'=>$Previsionnelle,'Realisees'=>$Realisees,'Annulees'=>$annule,'Planifiees'=>$Plan,'Decision'=>$Decis,'date'=>$date,'repporter'=>$repporte];
    $dt = new dateTime($date);
    $dta=$dt->format('Y-m-d'); 
    $this->render_view("Service_comptabilite/calendrier/livraisonkoty",$data);

  }

   public function detail_vente_com(){
        $this->load->model('Compta_model');
        $this->load->model('global_model');
    $i=0;
    $resultat=array();
    if($this->input->post('type')=='rep'){
      $client=$this->Compta_model->liste_client_facture_rep($this->input->post('date'));
    }else{
    $client=$this->Compta_model->liste_client_facture_sc($this->input->post('date'),$this->input->post('type'));
    }
    foreach ($client as $key => $client) {
      $detail="";
      $detail=$this->global_model->detail_client($client->Code_client);
      $resultat[$i]['ca']=0;
      $resultat[$i]['code_client']=$detail->Nom;
      $resultat[$i]['Nom']=$client->Code_client;
      $resultat[$i]['produit']='';
      $resultat[$i]['Quartier']=$client->Quartier;
      $resultat[$i]['Ville']=$client->Ville;
      $resultat[$i]['remarque']=$client->Remarque;
      $resultat[$i]['link']='link_'.$i;
      $resultat[$i]['facture']=$client->Id;
          foreach($this->Compta_model->ca_facture($client->Id) as $commande){
             if($commande->statut!='annuler'){
                  $resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
                  $resultat[$i]['produit'].=' <a class="example-image-link" href="'.base_url("images/produit/".$commande->Code_produit).'.jpg" data-lightbox="'.$commande->Designation.'">'.$commande->Designation.'</a><br/>';
            }
          } 
      $i++;    
    }  
    $data=[
         'type'=>$this->input->post('type'),
         'date'=>$this->input->post('date'),
         'data'=>$resultat,
         'color'=>$this->color($this->input->post('type')),
         'type'=>$this->input->post('type')  
      ];
  
      $this->load->view("Service_comptabilite/calendrier/liste_commande",$data);
    }

    public function confirmer_commande($idfacture)
  {
    $this->load->model('calendrier_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'annulation' => $this->calendrier_model->code_annulation(),
      'liste_personel' => $this->calendrier_model->liste_personel()
    ];
    $this->render_view('Service_comptabilite/calendrier/confirmer', $data);
  }
  public function  planifier_commande($idfacture)
  {

    $this->load->model('calendrier_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'annulation' => $this->calendrier_model->code_annulation()
    ];
    $this->render_view('Service_comptabilite/calendrier/en_attente', $data);
  }

   public function detail($idfacture)
  {
    $this->load->model('calendrier_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture)
    ];

    $this->render_view('Service_comptabilite/calendrier/detail', $data);
  }

    public function color($code){
      $color=array('rep'=>'#6f42c1','Previ'=>'#5bc0de','en_attente'=>'orange','confirmer'=>"#3f729b",'annule'=>'#d9534f','livre'=>'#5cb85c');
      return $color[$code];
      }  
     public function detail_vente_com_tsena_koty(){
      $this->load->model('Compta_model');
      $this->load->model('global_model');
    $i=0;
    $resultat=array();
    if($this->input->post('type')=='rep'){
      $client=$this->Compta_model->liste_client_facture_rep_tsena_koty($this->input->post('date'));
    }else{
      $client=$this->Compta_model->liste_client_facture_sc($this->input->post('date'),$this->input->post('type'));
    }
    foreach ($client as $key => $client) {
      $detail="";
      $detail=$this->global_model->detail_client($client->Code_client);
      $resultat[$i]['ca']=0;
      $resultat[$i]['code_client']=$detail->Nom;
      $resultat[$i]['Nom']=$client->Code_client;
      $resultat[$i]['produit']='';
      $resultat[$i]['Quartier']=$client->Quartier;
      $resultat[$i]['Ville']=$client->Ville;
      $resultat[$i]['remarque']=$client->Remarque;
      $resultat[$i]['link']='link_'.$i;
      $resultat[$i]['facture']=$client->Id;
          foreach($this->Compta_model->ca_facture($client->Id) as $commande){
            if($commande->statut!='annuler'){
                  $resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
                  $resultat[$i]['produit'].=$commande->Designation.'<br/>';
            }
          } 
      $i++;    
    }  
  $data=[
       'type'=>$this->input->post('type'),
       'date'=>$this->input->post('date'),
       'data'=>$resultat,
       'color'=>$this->color($this->input->post('type')),
       'type'=>$this->input->post('type')  
    ];
    $this->load->view("Service_comptabilite/calendrier/liste_commande",$data);
  }


public function livre_vente()
  {
    $this->load->model('Compta_model');
    $livreur = $this->input->post('livreur');
    $remarque = $this->input->post('remarque');
    $facture = $this->input->post('facture');
    $this->Compta_model->livre_vente($livreur, $remarque, $facture);
    echo json_encode(array('message' => true));
    
  }

  public function annulationCommandes(){
        $this->load->model('Compta_model');
        $facture=$this->input->post('facture');
        $remarque=$this->input->post('remarque');
        $code_annulation=$this->input->post('code_annulation');
        $nomlivre=$this->input->post('nomlivre');
        $this->Compta_model->annule_facture($facture);
        $this->Compta_model->annulelivres($remarque,$facture,$nomlivre);

    } 

}