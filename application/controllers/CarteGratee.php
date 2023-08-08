<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
  class CarteGratee extends My_Controller
  {
    public function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->library("pagination");
        $this->load->model('koty_model');
        $this->load->library('pdf');
    }
  	public function index(){
       $this->render_view('carteGratee/nouveau');
  	}
  
  	public function Nouveau_Jeux(){
      $this->render_view('carteGratee/nouveau');
  	}
    
    public function autocomplete_client()
    {
      $this->load->model('client_model');
      $term = $this->input->get('term');
      $array = array();
      foreach ($this->client_model->autocomplete_client($term) as $reponse) {
        array_push($array, $reponse->Code_client . " | " . $reponse->Compte_facebook);
      }
      echo json_encode($array);
    }

    public function autocomplete_codeproduit()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_all_codeproduit($term) as $reponse) {
      array_push($array, $reponse->Code_produit . " | " . $reponse->Designation);
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
    public function chercheCart(){
      $this->load->model('Global_model');
      $this->load->model('Koty_model');
    $client = $this->input->post('client');
    $infoclient = $this->Global_model->getClientInfos(["Code_client" => $client]);
    $facture = $this->Global_model->stat($client);
    $content = ""; 
    $ca = 0;
    $Koty = "";
    $smiles = "";
    foreach ($facture as $facture) {
      $detailkotysmiles = $this->Global_model->getkotysmiletotalpossible(trim($facture->Id_facture));
      foreach($detailkotysmiles as $value){
      $Koty = $value->koty;
      $smiles = $value->smiles;
  
      }
    }
    $detail=false;
    $factures = false;
    
    $factures = $this->koty_model->selectFactureDesc("Code_client like '$client' AND facture.Status like 'livre'");
    if($factures){
        $detail =  $this->koty_model->detailFacture(["detailvente.Facture"=>$factures->Id]);
    }
    
    $data["infoClient"] =$infoclient;
    $data["facture"] =$factures;
    $data["detail"] =$detail;
    $data["Koty"] =$Koty;
    $data["smiles"] =$smiles;
    $config["base_url"] = base_url();
    $config["total_rows"] = $this->koty_model->lot();
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
    $data['description'] = $this->koty_model->get_lot($config["per_page"], $page);
    $this->load->view('Tsena_koty/carteGratee/infoCart',$data);
   }
   public function detailFacture($requette=array()){

   }
   public function factureClient(){

   }
   public function kotyClient(){

   }

   public function mouvementKoty(){

   }
   public function tireNumero(){
     $this->load->model('Koty_model');
      
      $numero = $this->input->post('numero');
      $client = $this->input->post('client');
      $level = $this->input->post('level');
           $tire =  $this->Koty_model->carte_gratter_detail_select("carte_gratter_detail.numero_tirage like '%$numero%' AND carte_gratter_detail.level like  '$level' AND carte_gratter_detail.statut like ''");
    
       if($tire){
         $data = [
          'data'=>$tire,
         ];
        $this->load->view('Tsena_koty/carteGratee/carteTire',$data);
       // $this->printNumero();
       }else{
         $this->load->view('carteGratee/carteVide');
       }

   }
  public function TireCart(){
    $this->load->model('Koty_model');
    $codeCleint = $this->input->get('codeCleint');
    $id = $this->input->get('id');
    $data = [
      "statut"=>"tirée",
      "code_gagnant"=>$codeCleint
    ];
    $requette = [
      "id"=>$id
    ];
    
     $this->Koty_model->updateDetcarte_gratter_detail($requette,$data);
 
  }
  public function printNumero()
	{
		/*$html =  $this->load->view('Tsena_koty/carteGratee/print',array(),true);
		//echo $html;
		$filename = "TEST";
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);*/
	}

    public function InfoClient()
	{
		$codeclient = "";
		$this->load->model("Discussion_model");
		$this->load->model("Global_model");
		$lien =  $this->input->post('lien');
		$infoclient = $this->Global_model->getClientInfos(["lien_facebook" => $lien]);
		$infoclients = $this->Global_model->getClientInfos(["lien_facebook" => $lien]);
		$promo =  $this->Discussion_model->promotionSelect(["Pr_Status"=>"en_cours"]);
		if( !empty($infoclient)  && !empty($infoclients)){
		$facture = $this->Global_model->stat($infoclients->Code_client);
		$content = ""; 
		$ca = 0;
		foreach ($facture as $facture) {
		  $detailkotysmiles = $this->Global_model->getkotysmiletotalpossible(trim($facture->Id_facture));
		  foreach($detailkotysmiles as $value){
			$Koty = $value->koty;
			$smiles = $value->smiles;
  
		  }
		  $ca = $facture->Quantite * $facture->Prix_detail;
		  
		  $content .= "<tr><td>".$facture->Date."</td><td style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</td><td>".$Koty."</td><td>".$smiles."</td></td></tr>";
		  
	  }
		$data = [
			'promo'=>$promo,
			'data'=>$content,
		    'infoclient'=>$infoclient,
			'localite' =>$facture->Localite,
			'typetache'=>$this->global_model->typetachekoty(),
			'kotydispo'=>$this->global_model->kotydispo($infoclients->Code_client),
			'smile'=>$this->global_model->smile($infoclients->Code_client),
			'produitselect'=>$this->global_model->produit_selection(),
			'produit' => $this->global_model->produitpromokoty($this->session->userdata('matricule')),  
			'pageuser'=> $this->global_model->data_page_users($this->session->userdata('matricule')),
			'monsmile'=>$this->global_model->getsmileclienttrim($infoclients->Code_client)
		];
		$this->load->view('operatrice/historique_achat_fb', $data);
	  }else{
		  echo "Vide";
     	}
	}
  public function InfoClient_tache()
	{
		$codeclient = "";
		$this->load->model("Discussion_model");
		$this->load->model("Global_model");
		$lien =  $this->input->post('lien');
		$infoclient = $this->Global_model->getClientInfos(["Compte_facebook" => $lien]);
		$infoclients = $this->Global_model->getClientInfos(["Compte_facebook" => $lien]);
		$promo =  $this->Discussion_model->promotionSelect(["Pr_Status"=>"en_cours"]);
        if( !empty($infoclient)  && !empty($infoclients)){
        $facture = $this->Global_model->stat($infoclients->Code_client);
        $content = ""; 
        $ca = 0;
        foreach ($facture as $facture) {
          $detailkotysmiles = $this->Global_model->getkotysmiletotalpossible(trim($facture->Id_facture));
          foreach($detailkotysmiles as $value){
          $Koty = $value->koty;
          $smiles = $value->smiles;
      
          }
		    $ca = $facture->Quantite * $facture->Prix_detail;
		  
		    $content .= "<tr><td>".$facture->Date."</td><td style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</td><td>".$Koty."</td><td>".$smiles."</td></td></tr>";
	      }
		    $data = [
          'promo'=>$promo,
          'data'=>$content,
          'infoclient'=>$infoclient,
          'localite' =>$facture->Localite,
          'typetache'=>$this->global_model->typetachekoty(),
          'kotydispo'=>$this->global_model->kotydispo($infoclients->Code_client),
          'smile'=>$this->global_model->smile($infoclients->Code_client),
          'produitselect'=>$this->global_model->produit_selection(),
          'produit' => $this->global_model->produitpromokoty($this->session->userdata('matricule')),  
          'pageuser'=> $this->global_model->data_page_users($this->session->userdata('matricule')),
          'monsmile'=>$this->global_model->getsmileclienttrim($infoclients->Code_client)
        ];
       
		$this->load->view('operatrice/historique_achat_fb', $data);
	  }else{
		  echo "Vide";
     	}
	}
   public function Carte_choisie(){
        $this->load->model('CarteAgratter_model');
        $num_tirage =  $this->input->post('id');
        $CodeClient = $this->input->post('codeClient');
        /* recuperer smiles client */
        $result = $this->CarteAgratter_model->Retourner_Smiles_Client($CodeClient);
        $tolal_smiles = $result->smiles;
        /* Retourner Level client */
        $level_client = $this->CarteAgratter_model->Retourner_Level_Client($tolal_smiles);
        $level= strval($level_client);
        $data['detatilcarte'] = $this->CarteAgratter_model->Retourner_carte_tirer($num_tirage,$level);
        $this->load->view("Tsena_koty/carteGratee/cartechoisie",$data); 
      }



  public function Tirage(){
    $num_tirage =  $this->input->post('num_tirage');
    $CodeClient = $this->input->post('codeClient');
    $statut = "tirée";
    $date = new datetime();
    $dt = $date->format('Y-m-d H:i:s');
    $data=[
      'statut' =>$statut,
      'code_gagnant' =>$CodeClient,
      'Date_de_tirage' =>$dt
    ];
    $this->db->where('numero_tirage', $num_tirage);
    $this->db->where('level','level 1');
    $this->db->update('carte_gratter_detail', $data);
    echo 1;
  }


  public function Liste_lot(){
    $this->load->model('CarteAgratter_model');
    $chapeau = $this->input->post('chapeau');
    $data['liste']="";
    $this->load->view("Tsena_koty/carteGratee/liste_lot",$data); 
  }

  public function Chapeau(){
    $chapeau = $this->input->post('chapeau');
    if($chapeau == "level 1"){
      $table_head_bg == "#007bff";
    }elseif ($chapeau == "level 2") {
      $table_head_bg == "#28a745";
    }elseif ($chapeau == "level 3") {
      $table_head_bg == "#ffc107";
    }elseif ($chapeau == "level 4") {
      $table_head_bg == "#dc3545";
    }elseif ($chapeau == "level 5") {
      $table_head_bg == "##9933CC";
    }else{
       $table_head_bg == "";
    }
    $data['chapeau']=$chapeau;
    $data['bg_head'] = $table_head_bg;
    $data['liste_lot'] = $this->global_model->Retourner_liste_lot($chapeau);
    $this->load->view("Tsena_koty/carteGratee/liste_chapeau",$data); 
  }

  public function Liste_client_gagnat(){
    $this->load->model("Global_model");
    $code_carte = $this->input->post('code_carte');
    $level = $this->input->post('level');
    $data['list'] = $this->Global_model->Retourner_liste_client_gagnant_carte($level,$code_carte);
    $this->load->view("Tsena_koty/carteGratee/liste_client_gagnant",$data);
  }

}
?>