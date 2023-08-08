<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clients extends My_Controller {  

    public function __construct() {
        parent:: __construct();
   
        $this->load->helper('url');
        $this->load->library("pagination");
        $this->load->model('client_model');
    }
public function detailVente(){

$codeClient = $this->input->get('codeclient');
$row = $this->client_model->dataAchat(['facture.Code_client'=>$codeClient]); 
$data = array();
foreach ($row as $key => $row) { 
  $sub_array = array();
  $sub_array[] = "<img src='".code_produit_img_link($row->Code_produit)."' class='img-thumbnail' width='50' height='50'>";
  $sub_array[] = $row->Code_produit;
  $sub_array[] = $row->Quantite;
  $sub_array[] = number_format($row->Prix_detail*$row->Quantite, 2, ',', ' ');       
  $sub_array[] = $row->Date;
  $sub_array[] = $row->data_de_livraison;
  $sub_array[] = $row->date_de_livraison;
  $sub_array[] = $row->Status; 
  $sub_array[] = $row->Remarque; 
  $data[] = $sub_array;
}  
$output = array("data" =>$data);
echo json_encode($output);
}
public function dataFiabiliter(){
 $codeClient = $this->input->post('codeclient');
 
 $data['total']=$this->client_model->nombre_vente(['Code_client'=>$codeClient]);
 $data['livre']=$this->client_model->nombre_vente(['Code_client'=>$codeClient,"Status"=>'livre']);
 $data['annule']=$this->client_model->nombre_vente(['Code_client'=>$codeClient,"Status"=>'annule']);
 $data['attente']=$this->client_model->nombre_vente(['Code_client'=>$codeClient,"Status"=>'en_attente']);
 echo json_encode($data);
}
   public function liste_des_client(){
    
    $config = array();
    $config["base_url"] = base_url().strtolower($this->session->userdata('designation'))."/Clients/Mes_clients/";
    $config["total_rows"] = $this->client_model->nombre_client_prospect();
    $config["per_page"] = 10;
    $config["uri_segment"] = 4;
    
    $config["full_tag_open"] = '<nav aria-label="..."><ul class="pagination mb-0">';
    $config["full_tag_close"] = '</ul></nav>';    
    
    $config["first_link"] = "Première";
    $config["first_tag_open"] = '<li class="page-item "><span class="page-link" tabindex="-1">';
    $config["first_tag_close"] = "</span></li>";
    
    
    $config["last_link"] = "Dernière";
    $config["last_tag_open"] = '<li class="page-item "><span class="page-link"  tabindex="-1">';
    $config["last_tag_close"] = "</span></li>";
    
    $config['next_link'] = 'Suivante';
    $config['next_tag_open'] = '<li class="page-item "><span class="page-link"  tabindex="-1">';
    $config['next_tag_close'] = '</span></li>';
    
    $config['prev_link'] = 'Précedante';
    $config['prev_tag_open'] = '<li class="page-item "><span class="page-link"  tabindex="-1">';
    $config['prev_tag_close'] = '</span></li>';
    
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
    
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link" href="#">';
    $config['num_tag_close'] = '</span></li>';
  
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      $data["links"] = $this->pagination->create_links();
      $data['client'] = $this->client_model->get_client_prospect($config["per_page"], $page);
      $this->render_view('operatrice/client/liste_client_prospect',$data);
   }

  public function recherche(){
    $mot = $this->input->post('mot');
    $data = $this->client_model->rechercheClient("Code_client LIKE '%$mot%' OR Compte_facebook LIKE '%$mot%' OR lien_facebook  LIKE '%$mot%' OR Contact LIKE '%$mot%'");
      if($data){
          $datas =  [
              "resultat"=>$mot,
              'data'=>$data
          ];  
          $this->render_view('operatrice/client/resultRecherche',$datas);
      }else{
          $this->render_view('operatrice/client/resultatNotFound',['mot'=>$mot]);
      }
  } 
   public function Client_prospet(){
   
    $config = array();
    $config["base_url"] = base_url().strtolower($this->session->userdata('designation'))."/Clients/Mes_clients/";
    $config["total_rows"] = $this->client_model->nombre_client_prospect();
    $config["per_page"] = 10;
    $config["uri_segment"] = 4;
    
    $config["full_tag_open"] = '<nav aria-label="..."><ul class="pagination mb-0">';
    $config["full_tag_close"] = '</ul></nav>';    
    
    $config["first_link"] = "Première";
    $config["first_tag_open"] = '<li class="page-item "><span class="page-link" tabindex="-1">';
    $config["first_tag_close"] = "</span></li>";
    
    
    $config["last_link"] = "Dernière";
    $config["last_tag_open"] = '<li class="page-item "><span class="page-link"  tabindex="-1">';
    $config["last_tag_close"] = "</span></li>";
    
    $config['next_link'] = 'Suivante';
    $config['next_tag_open'] = '<li class="page-item "><span class="page-link"  tabindex="-1">';
    $config['next_tag_close'] = '</span></li>';
    
    $config['prev_link'] = 'Précedante';
    $config['prev_tag_open'] = '<li class="page-item "><span class="page-link"  tabindex="-1">';
    $config['prev_tag_close'] = '</span></li>';
    
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
    
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link" href="#">';
    $config['num_tag_close'] = '</span></li>';
  
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      $data["links"] = $this->pagination->create_links();
      $data['client'] = $this->client_model->get_client_prospect($config["per_page"], $page);
      $this->render_view('operatrice/client/liste_client_prospect',$data);
   }
   public function autocompletClient(){
     
   
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->client_model->autocomplete_client($term) as $reponse) {
      array_push($array, $reponse->Compte_facebook);
    }
    echo json_encode($array);
   }
   public function autocomplete_client_tache()
   {
     $this->load->model('client_model');
     $term = $this->input->get('term');
     $array = array();
     $reponse = $this->client_model->autocomplete_client_tache($term);
     foreach ( $reponse as $reponse) {
       array_push($array, $reponse->Code_client . " | " . $reponse->Compte_facebook);
     }
     echo json_encode($array);
   }
   public function detail($codeclient){
   
    $data = [
     'infoclient'=>$this->client_model->infoclientPo($codeclient),
     'test' => $this->client_model->countFactureClient($codeclient, "annule")

    ];
         $this->render_view('operatrice/client/detail_client',$data);
   }
   public function datalineDachat(){
     $codeClient = $this->input->post('codeclient');
   $donne = $this->client_model->dateAchat(['Code_client'=>$codeClient]);
   $data =array('date'=>[0],'donne'=>[]);
   $date = '0';
   foreach ($donne as $key => $donne) {
      array_push($data['date'],$donne->Date);
   }
   
  foreach ($data['date'] as $key => $value) {
    array_push($data['donne'],$this->client_model->NbdataAchat(['Date'=> $value,'Code_client'=>$codeClient]));
  }
      echo json_encode($data);

   }
   public function datalineDachatProduit(){
    
     $codeClient = $this->input->post('codeclient');
     $reponse = $this->client_model->dataAchat(['Code_client'=>$codeClient]);
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
   public function testImage(){
     $codeclient = $this->input->post('codeclient');
     $image = scandir(FCPATH."images/client/");
     if(in_array($codeclient.'.jpg',$image)){
       echo 'true';
     }else {
       echo 'false';
     }
    
   }
   public function formulaireUpdateProfil(){
    $this->load->model('client_model');
    $codeclient = $this->input->post('client');
    $infoClient = $this->client_model->infoclientPo($codeclient);
    $reponse =array('message'=>"false");
    $data = [
         "codeclient"=> $codeclient
    ];
  if($infoClient){	
    if($infoClient->Etape==""){
          $this->load->view('Tsena_koty/FormEtape/Etape_1',$data,'true');
    }else if($infoClient->Etape =="etape1"){
          $this->load->view('Tsena_koty/FormEtape/Etape_2',$data,'true');  
    }else if($infoClient->Etape =="etape2"){
          $this->load->view('Tsena_koty/FormEtape/Etape_3',$data,'true');
    }else{
      echo '<div class="alert alert-danger" role="alert">Formulaire indisponible</div>';
             //$this->load->view('operatrice/formulaire/Etape_4',$data);
      }
  }else{
            $this->load->view('Tsena_koty/FormEtape/Etape_1',$data);
      
  }
}
public function updateClientBonAchat(){

  $this->load->model('client_model');
  $this->load->model('global_model');
  $this->load->library('Ciqrcode');
  $codeClient = $this->input->post('codeClient');
  $designationBon = $this->input->post('designationBon');
  $valeur = $this->input->post('valeur');
  $page = $this->input->post('page');
  $lettre = $this->input->post('lettre');
  $dernier = date("t");
  $this->global_model->insert_bon_achat([
    "DATEDECREATION"=>date('Y-m-d'),
    "DESIGNATION"=>$designationBon,
    "VALEUR"=>$valeur, 
    "STATUT"=>'actif',
    "DATEDEDESACTIVATION"=>date('Y-m')."-".$dernier,
    "CODE_CLIENT"=>$codeClient
  ]);

  $bonRep = $this->global_model->select_bon_achat([ "STATUT"=>"actif","CODE_CLIENT"=>$codeClient]);
  $refTemp= strlen($bonRep->IDBON);
  
  $ref="";
  while($refTemp<5){
    $ref.="0";
    $refTemp++;
  }
  $ref.=$bonRep->IDBON;
  $pageRep = $this->global_model->page_fb(['comptefb.id'=>$page]); 
  $infoClient = $this->global_model->getClientInfo($codeClient);
  $prametre['savename'] = FCPATH.'images/QRCodeBon/'. $bonRep->IDBON.'.png';
  $prametre['size'] = 50;
  $prametre['data'] ="https://tsenakoty.combo.fun/";
  $this->ciqrcode->generate( $prametre);
  $data = [
    "codeBon"=> $bonRep->IDBON,
    "infoClient"=>$infoClient,
    "Valeur"=>$valeur,
    "page"=>$pageRep,
    "ref"=>$ref,
    "lettre"=>$lettre
  ];
  echo $this->load->view("operatrice/bon_d_achat/tempbleTicketBon",$data,true);
}

 public function updateClientpoTicket(){
    $this->load->model('client_model');
    $this->load->model('global_model');
    $this->load->library('Ciqrcode');
    
    
    $codeClient = $this->input->post('codeClient');
    $nom = $this->input->post('nom');
    $prenom = $this->input->post('prenom');
    $dateNaiss = $this->input->post('dateNaiss');
    $contact = $this->input->post('contact');
    $facture = $this->input->post('facture');
    $update =  $this->client_model->updateClientpo(["Code_client"=>$codeClient],[
      "Nom"=>$nom,
      "Prenom"=>$prenom,
      "Date_de_naissance"=>$dateNaiss,
      "Contact"=>$contact
    ]);
   
    $html = "";
   if($update){
      $this->client_model->updatetombola(["facture"=>$facture],[
         'statut'=>'off'
      ]);
      $detailFacture = $this->client_model->vente_clientel(["facture.Id_facture"=>$facture]);
      $ticket =  $this->global_model->selectsTombola(['facture'=> $facture ]);
      $factures = $this->client_model->facture_clientel(['Id_facture'=> $facture]);
      $page = $this->client_model->selectPageClient(["id"=>$factures->Page]);
      $prametre['savename'] = FCPATH.'images/QRCode/'.$facture.'.png';
      $prametre['size'] = 50;
      $prametre['data'] ="https://tsenakoty.combo.fun/".$codeClient;
      $this->ciqrcode->generate( $prametre);

      $data =[
        "detailTicket"=>$ticket,
        "codeclient"=>$codeClient,
        "facture"=>$facture,
        "detailFacture"=> $detailFacture,
        "Nom"=>$nom,
        "Prenom"=>$prenom,
        "Date_de_naissance"=>$dateNaiss,
        "Contact"=>$contact,
        'pagefb'=> $page
      ];
      $html = $this->load->view("operatrice/tombola/templeteTicket",$data,true);
    }
   echo $html;
 }

}