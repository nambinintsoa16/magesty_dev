<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produit extends My_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('produit_model');
        $this->load->model('calendrier_model');
    }

    public function detail($codeproduit){
       
        $data=[
           'produit'=>$this->produit_model->detail_produit($codeproduit)
          
        ];
        $this->render_view('operatrice/produit/detail',$data);

    }
    public function recherche(){
        
        $mot = $this->input->post('mot');
        $data = $this->produit_model->rechercheProduit("(produit.Code_produit LIKE '%$mot%' OR produit.Designation LIKE '%$mot%') AND prix.Statut = 'on' AND prix.Localite = 5");
          if($data){
              $datas =  [
                  "resultat"=>$mot,
                  'produit'=>$data
              ];  
              $this->render_view('operatrice/produit/resultRecherche',$datas);
          }else{
              $this->render_view('operatrice/produit/resultatNotFound',['mot'=>$mot]);
          }

    }
  public function produitVendu(){

    $datas = [
        'deoParfum' => $this->countWith("DEO & PARFUM"),
        'hygienCor' => $this->countWith("HYGIENE CORPORELLE"),
        'soinsCap' => $this->countWith("SOINS CAPILLAIRE"),
        'hygienBuco' => $this->countWith("HYGIENE BUCO-DENTAIRE"),
        'beaute' => $this->countWith("BEAUTE"),
        'lessive' => $this->countWith("LESSIVE"),
        'soinsVis' => $this->countWith("SOINS VISAGE"),
        'boisson' => $this->countWith("BOISSON"),
        "livre" => $this->produit_model->countProduitWithDetails([
            'facture.Status' => 'livre',
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ]),
        'annule' => $this->produit_model->countProduitWithDetails([
            'facture.Status' => 'annule',
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ]),
        'confirme' => $this->produit_model->countProduitWithDetails([
            'facture.Status' => 'confirmer',
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ]),
        'en_attente' => $this->produit_model->countProduitWithDetails([
            'facture.Status' => 'en_attente',
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ]),
        'all' => $this->produit_model->countProduitWithDetails([
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ])

    ];
    $this->render_view('operatrice/etat_de_vente/produit', $datas);
  }

  public function tabVue(){
     $this->load->view('operatrice/etat_de_vente/tableData');
  }
  public function tabVue2(){
     $this->load->view('operatrice/etat_de_vente/tableData2');
  }
  public function productList(){
    $status = $this->input->get('statut');
   
    $datas = $this->produit_model->findProduitByStatus([
        'facture.Status' => $status,
        'facture.Matricule_personnel' => $this->session->userdata('matricule')
    ]);
    $datax = array();

    foreach ($datas as $data) {
        $subArray = [];
        $subArray[] = $data->Code_produit;
        $subArray[] = $data->Designation;
        $subArray[] = "<img src='".code_produit_img_link($data->Code_produit)."' class='img-thumbnail' style='width:50px;height:50px'>";
        $subArray[] = $data->qt;
        $subArray[] = $data->Prix_detail;
        $subArray[] = $data->qt * $data->Prix_detail;
        $datax[] = $subArray;
    }
    $output = array("data" =>$datax);
    echo json_encode($output);
  }

  public function productListAll(){
    $status = $this->input->get('statut');
   
    $datas = $this->produit_model->findProduitByStatus([
        'facture.Matricule_personnel' => $this->session->userdata('matricule')
    ]);
    $datax = array();

    foreach ($datas as $data) {
        $subArray = [];
        $subArray[] = $data->Code_produit;
        $subArray[] = $data->Designation;
        $subArray[] = "<img src='".code_produit_img_link($data->Code_produit)."' class='img-thumbnail' style='width:50px;height:50px'>";
        $subArray[] = $data->qt;
        $subArray[] = $data->Prix_detail;
        $subArray[] = $data->qt * $data->Prix_detail;
        $datax[] = $subArray;
    }
    $output = array("data" =>$datax);
    echo json_encode($output);
  }

  public function productListWithStatut(){
    $categorie = $this->input->get('categorie');
    if($categorie == "DEO "){
        $categorie = "DEO & PARFUM";
    }
    $datas = $this->produit_model->produitWithDetails([
        'categorie.famille' => $categorie,
        'facture.Matricule_personnel' => $this->session->userdata('matricule')
    ]);
    $datax = array();

    foreach ($datas as $data) {
        $subArray = [];
        $subArray[] = $data->Code_produit;
        $subArray[] = $data->Designation;
        $subArray[] = "<img src='".code_produit_img_link($data->Code_produit)."' class='img-thumbnail' style='width:50px;height:50px'>";
        $subArray[] = $data->Status;
        $subArray[] = $data->Quantite;
        $subArray[] = $data->Prix_detail;
        $subArray[] = $data->Quantite * $data->Prix_detail;
        $datax[] = $subArray;
    }
    $output = array("data" =>$datax);
    echo json_encode($output);
  }

  public function listProduit(){
    $datas = $this->produit_model->findProduit();
    $datax = array();

    foreach ($datas as $data) {
        $subArray = [];
        $subArray[] = $data->Code_produit;
        $subArray[] = $data->Designation;
        $subArray[] = "<img src='".code_produit_img_link($data->Code_produit)."' class='img-thumbnail' style='width:50px;height:50px'>";
        $subArray[] = $data->Status;
        $subArray[] = $data->Quantite;
        $subArray[] = $data->Prix_detail;
        $subArray[] = $data->Quantite * $data->Prix_detail;
        $datax[] = $subArray;
    }
    $output = array("data" =>$datax);
    echo json_encode($output);
  }

  private function countWith($categorie){
    return [
        'all' => $this->produit_model->countProduitWithDetails([
            'categorie.famille' => $categorie,
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ]),
        'livre' => $this->produit_model->countProduitWithDetails([
            'facture.Status' => 'livre',
            'categorie.famille' => $categorie,
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ]),
        'annule' => $this->produit_model->countProduitWithDetails([
            'facture.Status' => 'annule',
            'categorie.famille' => $categorie,
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ]),
        'confirme' =>$this->produit_model->countProduitWithDetails([
            'facture.Status' => 'confirmer',
            'categorie.famille' => $categorie,
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ]),
        'en_attente' =>$this->produit_model->countProduitWithDetails([
            'facture.Status' => 'en_attente',
            'categorie.famille' => $categorie,
            'facture.Matricule_personnel' => $this->session->userdata('matricule')
        ])
    ];
  }

  public function productListViaSc(){
    $status = $this->input->get('status');
   
    $datas = $this->calendrier_model->liste_produit_facture_rep(date('Y-m-d'), $status);
    $datax = array();

    foreach ($datas as $data) {
        $subArray = [];
        $subArray[] = $data->Code_produit;
        $subArray[] = $data->Designation;
        $subArray[] = "<img src='".code_produit_img_link($data->Code_produit)."' class='img-thumbnail' style='width:50px;height:50px'>";
        $subArray[] = $data->Quantite;
        $subArray[] = $data->Prix_detail;
        $subArray[] = $data->Quantite * $data->Prix_detail;
        $datax[] = $subArray;
    }
    $output = array("data" =>$datax);
    echo json_encode($output);
  }

  public function productListViaScWithStatus(){
    $categorie = $this->input->get('categorie');
    if($categorie == "DEO "){
        $categorie = "DEO & PARFUM";
    }
    $datas = $this->calendrier_model->liste_produit_facture_rep_cat(date('Y-m-d'), "all", $categorie);
    $datax = array();

    foreach ($datas as $data) {
        $subArray = [];
        $subArray[] = $data->Code_produit;
        $subArray[] = $data->Designation;
        $subArray[] = "<img src='".code_produit_img_link($data->Code_produit)."' class='img-thumbnail' style='width:50px;height:50px'>";
        $subArray[] = $data->Status;
        $subArray[] = $data->Quantite;
        $subArray[] = $data->Prix_detail;
        $subArray[] = $data->Quantite * $data->Prix_detail;
        $datax[] = $subArray;
    }
    $output = array("data" =>$datax);
    echo json_encode($output);
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

}

