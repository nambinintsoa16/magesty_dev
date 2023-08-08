<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Controlleur extends My_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->helper('url');
    $this->load->library("pagination");
  }
  public function index()
  {
  }
  public function client_detail(){
    $this->load->model('global_model');
    $data = [
      'data'=>$this->global_model->dataClientInfo(),
      'page'=>$this->global_model->comptefb()
  ];
    $this->render_view('Controlleur/client/client_detailInfo',$data);
  }
  public function testPage(){
    $page=$this->input->post('page');
    $codeclient = $this->input->post('codeclient');
    
  }
  public function Modifier_Vente(){

    $this->render_view('Controlleur/vente/modifier');
  }
 public function detail_Modifier_Vente()
  {
    $idfacture = $this->input->post('idfacture');
    $this->load->model('calendrier_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'facture' => $this->calendrier_model->detail_facture_discussion($idfacture)
    ];
    return $this->load->view('Controlleur/vente/detail', $data);
  }
   public function modifVenteDelete(){
    $this->load->model('calendrier_model');
    echo json_encode($this->calendrier_model->DeleleDetail($this->input->post('idVente')));
    
   }
   public function modifVentePadd(){
     $this->load->model('calendrier_model');
    $datas=$this->calendrier_model->retourIdPrix($this->input->post('produit'));
    if($datas){
    $data = [
        'Facture'=>$this->input->post('idfacture'),
        'Id_prix'=>$datas->Id,
        'Quantite'=>$this->input->post('quantite'),
        'Type_de_prix'=>'detail', 
        'Tip'=>0, 
        'statut'=>'principale',
        'Id_prix'=>$datas->Id,   
    ];

    $id = $this->input->post('idVente');
    echo json_encode($this->calendrier_model->InsertDEtailVente($data));
   }
   

   }
   public function modifVenteProduit(){
    $this->load->model('calendrier_model');
    $datas=$this->calendrier_model->retourIdPrix($this->input->post('produit'));
    if($datas){
    $data = [
          'Id_prix'=>$datas->Id
    ];

    $id = $this->input->post('idVente');
    echo json_encode($this->calendrier_model->updateDEtailVente($id,$data));
   }
  }

   public function modifVenteQuantite(){
    $this->load->model('calendrier_model');
    $data = [
          'Quantite'=>$this->input->post('Quantite')
    ];
    $id = $this->input->post('idVente');
    echo json_encode($this->calendrier_model->updateDEtailVente($id,$data));
  }
  public function modifVenteStatut(){
    $this->load->model('calendrier_model');
    $data = [
          'Status'=>$this->input->post('statut')
    ];
    $id = $this->input->post('idfacture');
    echo json_encode($this->calendrier_model->updateFacture($id,$data));
  }
  public function autocomplete_prodact(){
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_codeproduit($term) as $reponse) {
      array_push($array, $reponse->Code_produit . "| " . $reponse->Designation);
    }
    echo json_encode($array);
  }
  public function addRelance()
  {
    $this->load->model('global_model');
    $date = $this->input->post('date');
    $user = $this->input->post('user');
    $client = $this->input->post('client');
    $page = $this->input->post('id_page');
    $this->global_model->addRelance($date, $user, $client, $page);
  }

  public function Calendrier()
  {
    $this->render_view('Controlleur/calendrier/Calendrier');
  }
  public function detail_calendrier($date = FALSE)
  {
    $this->load->model('calendrier_model');
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $previ = 0;
    $livre = 0;
    $en_attente = 0;
    $annule = 0;
    $confirmer = 0;
    $dataUser = array();
    if ($this->calendrier_model->ca_de_vente_controlleur($date)) {
      foreach ($this->calendrier_model->ca_de_vente_controlleur($date) as $key => $value) {
        $previ += ($value->Quantite * $value->Prix_detail);
        if (!array_key_exists($value->Matricule_personnel, $dataUser)) {
          $dataUser[$value->Matricule_personnel]['previ'] = $value->Quantite * $value->Prix_detail;
        } else {
          $dataUser[$value->Matricule_personnel]['previ'] += $value->Quantite * $value->Prix_detail;
        }
      }
    }

    if ($this->calendrier_model->ca_de_vente_controlleur($date, 'livre')) {
      foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'livre') as $key => $value) {
        $livre += ($value->Quantite * $value->Prix_detail);
        if (!isset($dataUser[$value->Matricule_personnel]['livre'])) {
          $dataUser[$value->Matricule_personnel]['livre'] = $value->Quantite * $value->Prix_detail;
        } else {
          $dataUser[$value->Matricule_personnel]['livre'] += $value->Quantite * $value->Prix_detail;
        }
      }
    }


    if ($this->calendrier_model->ca_de_vente_controlleur($date, 'en_attente')) {
      foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'en_attente') as $key => $value) {
        $en_attente += ($value->Quantite * $value->Prix_detail);
        if (!isset($dataUser[$value->Matricule_personnel]['en_attente'])) {
          $dataUser[$value->Matricule_personnel]['en_attente'] = $value->Quantite * $value->Prix_detail;
        } else {
          $dataUser[$value->Matricule_personnel]['en_attente'] += $value->Quantite * $value->Prix_detail;
        }
      }
    }

    if ($this->calendrier_model->ca_de_vente_controlleur($date, 'annule')) {
      foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'annule') as $key => $value) {
        $annule += ($value->Quantite * $value->Prix_detail);
        if (!isset($dataUser[$value->Matricule_personnel]['annule'])) {
          $dataUser[$value->Matricule_personnel]['annule'] = $value->Quantite * $value->Prix_detail;
        } else {
          $dataUser[$value->Matricule_personnel]['annule'] += $value->Quantite * $value->Prix_detail;
        }
      }
    }

    if ($this->calendrier_model->ca_de_vente_controlleur($date, 'confirmer')) {
      foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'confirmer') as $key => $value) {
        $confirmer += ($value->Quantite * $value->Prix_detail);
        if (!isset($dataUser[$value->Matricule_personnel]['confirmer'])) {
          $dataUser[$value->Matricule_personnel]['confirmer'] = $value->Quantite * $value->Prix_detail;
        } else {
          $dataUser[$value->Matricule_personnel]['confirmer'] += $value->Quantite * $value->Prix_detail;
        }
      }
    }
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $data = [
      'previ' => $previ,
      'livre' => $livre,
      'en_attente' => $en_attente,
      'annule' => $annule,
      'confirmer' => $confirmer,
      'date' => $dte,
      'user' => $dataUser
    ];
    $this->render_view('Controlleur/calendrier/detail_de_vente', $data);
  }

  public function detail_vente_coms()
  {

    $this->load->model('calendrier_model');
    $i = 0;
    $color = array('#6f42c1' => 'rep', '#007bff' => 'Previ', 'orange' => 'en_attente', "#aa66cc" => 'confirmer', '#d9534f' => 'annule', '#5cb85c' => 'livre');
    $resultat = array();
    $client = $this->calendrier_model->liste_client_facture_controlleur($this->input->post('date'), $this->input->post('type'), $this->input->post('user'));



    foreach ($client as $key => $client) {
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $client->Code_client;
      $resultat[$i]['infoclient'] = $this->calendrier_model->detail_client($client->Code_client);
      $resultat[$i]['produit'] = '';
      $resultat[$i]['user'] = $client->Matricule_personnel;
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['Ville'] = $client->Ville;
      $resultat[$i]['remarque'] = $client->Remarque;
      if ($client->date_de_livraison != NULL or $client->date_de_livraison != "") {
        $resultat[$i]['date_de_livraison'] = $client->date_de_livraison;
      } else {
        $resultat[$i]['date_de_livraison'] = $client->data_de_livraison;
      }
      //$resultat[$i]['date_de_livraison']=$client->date_de_livraison;
      $resultat[$i]['link'] = 'link_' . $i;
      $resultat[$i]['facture'] = $client->Id;
      foreach ($this->calendrier_model->ca_facture($client->Id) as $commande) {
        $resultat[$i]['ca'] += ($commande->Quantite * $commande->Prix_detail);
        $resultat[$i]['produit'] .= $commande->Designation . '<br/>';
      }
      $i++;
    }


    $data = [
      'type' => $this->input->post('type'),
      'date' => $this->input->post('date'),
      'data' => $resultat,
      'color' => $this->color($this->input->post('type'))
    ];
    $this->load->view('Controlleur/calendrier/dataTableCa', $data);
  }

  public function detail_vente_com()
  {
    $this->load->model('calendrier_model');
    $i = 0;
    $resultat = array();
    $client = $this->calendrier_model->liste_client_facture_controlleur($this->input->post('date'), $this->input->post('type'), $this->input->post('user'));

    foreach ($client as $key => $client) {
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $client->Code_client;
      $resultat[$i]['infoclient'] = $this->calendrier_model->detail_client($client->Code_client);
      $resultat[$i]['produit'] = '';
      $resultat[$i]['user'] = $client->Matricule_personnel;
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['Ville'] = $client->Ville;
      if ($client->date_de_livraison != NULL or $client->date_de_livraison != "") {
        $resultat[$i]['date_de_livraison'] = $client->date_de_livraison;
      } else {
        $resultat[$i]['date_de_livraison'] = $client->data_de_livraison;
      }

      $resultat[$i]['remarque'] = $client->Remarque;
      $resultat[$i]['link'] = 'link_' . $i;
      $resultat[$i]['facture'] = $client->Id;
      foreach ($this->calendrier_model->ca_facture($client->Id) as $commande) {
        $resultat[$i]['ca'] += ($commande->Quantite * $commande->Prix_detail);
        $resultat[$i]['produit'] .= $commande->Designation . '<br/>';
      }
      $i++;
    }


    $data = [
      'type' => $this->input->post('type'),
      'date' => $this->input->post('date'),
      'data' => $resultat,
      'color' => $this->color($this->input->post('type'))
    ];
    $this->load->view('Controlleur/calendrier/liste_commande', $data);
  }

  public function detail_clients()
  {
    $this->load->model('global_model');
    $json = array('message' => false);
    $data = $this->global_model->detail_client($this->input->post('codeclient'));
    if ($data) {
      $json['message'] = true;
      $json['content'] = $data->Nom . " " . $data->Prenom;
    }

    echo json_encode($json);
  }



  public function rapport()
  {
    $datet = $this->input->post('dateAutre');
    if ($this->session->userdata('designation') == "Controlleur") {

      $content = "";
      $datas = $this->global_model->table_resume(date('Y-m-d'));
      foreach ($datas as $key => $datas) {
        $data = array();
        $produit = 0;
        $ca = 0;
        $data = $this->global_model->table_rapport(date('Y-m-d'), $datas->operatrice);
        $facture = $this->global_model->ca_facture_opl($datas->operatrice, date('Y-m-d'));
        $user = $this->global_model->user($datas->operatrice);
        foreach ($facture as $facture) {
          $produit += $facture->Quantite;
          $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        $content .= "<tr><td class='text-center'>" . $datas->operatrice . "</td><td class='text-center'><a href='#' class='lien' id='produit'>" . $user->Nom . "</a></td><td class='text-center'><a href='#' class='lienn' id='produit'>" . count($data) . "</a></td><td></td><td class='text-center'>" . number_format($ca, 2, ',', ' ') . "</td><td class='text-center' ><a href='#' class='link' id='produit'>" . $produit . "</a></td></tr>";
      }
      $data = ['data' => $content];
    }

    //	$this->render_view('Controlleur/'.$this->session->userdata("designation").'/',$data);
    $this->render_view('Controlleur/rapport', $data);
  }



  public function color($code)
  {
    $color = array('rep' => '#6f42c1', 'Previ' => '#007bff', 'en_attente' => 'orange', 'confirmer' => "#aa66cc", 'annule' => '#d9534f', 'livre' => '#5cb85c');
    return $color[$code];
  }
  public function detail_vente_commerciale($user, $date = FALSE)
  {
    $this->load->model('calendrier_model');
    $i = 0;
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $resultat = array();
    $client = $this->calendrier_model->liste_client_facture($date, 'Previ', $user);

    foreach ($client as $key => $client) {
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $client->Code_client;
      $resultat[$i]['infoclient'] = $this->calendrier_model->detail_client($client->Code_client);
      $resultat[$i]['produit'] = '';
      $resultat[$i]['user'] = $client->Matricule_personnel;
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['Ville'] = $client->Ville;
      $resultat[$i]['remarque'] = $client->Remarque;
      $resultat[$i]['link'] = 'link_' . $i;
      $resultat[$i]['facture'] = $client->Id;
      if ($client->date_de_livraison != NULL or $client->date_de_livraison != "") {
        $resultat[$i]['date_de_livraison'] = $client->date_de_livraison;
      } else {
        $resultat[$i]['date_de_livraison'] = $client->data_de_livraison;
      }
      foreach ($this->calendrier_model->ca_facture($client->Id) as $commande) {
        $resultat[$i]['ca'] += ($commande->Quantite * $commande->Prix_detail);
        $resultat[$i]['produit'] .= $commande->Designation . '<br/>';
      }
      $i++;
    }


    $data = [
      'type' => 'Previ',
      'date' => date('Y-m-d'),
      'data' => $resultat,
      'color' => $this->color('Previ')
    ];
    $this->render_view('Controlleur/calendrier/liste_commande', $data);
  }

  public function delete_facture()
  {
    $this->load->model('global_model');
    $this->global_model->delete_commande($this->input->post('id'));
    $this->global_model->delete_detail($this->input->post('id'));
    $this->global_model->delete_facture($this->input->post('id'));
    echo json_encode(array('message' => true));
  }

  /*public function detail_discussion_operatrice($user,$date=FALSE){
  $this->load->model('global_model');  
  $i=0;
  $reponse=$this->global_model->repopl(date('Y-m-d'),$user);
  foreach($reponse as $reponse){
    $datas[$i]['heure']=$reponse->heure;
    $datas[$i]['Id_discussion']=$reponse->Id_discussion;
    $datas[$i]['client']=$reponse->client;
    $datas[$i]['Type']=$reponse->Type;
    $datas[$i]['action']="";
    $i++;
  }
 $Actions=$this->global_model->detail_publication($user,date('Y-m-d'));
  foreach ($Actions as $key => $Actions) {
    $datas[$i]['heure']=$Actions->Date." ".$Actions->Heure;
    $datas[$i]['Id_discussion']="";
    $datas[$i]['client']="";
    $datas[$i]['Type']=$Actions->Types;
    $datas[$i]['action']=$Actions->Actions;
    $i++;
  }
   $data=[
       'Actions'=>$this->global_model->detail_publication($user,date('y-m-d')),
       'data'=>$datas
    ];

  $this->render_view('Controlleur/discussion/opldiscussion',$data);
}*/
  public function detail_discussion_operatrice($user, $date = FALSE)
  {
    $this->load->model('global_model');
    $i = 0;
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $reponse = $this->global_model->repopll($date, $user);
    foreach ($reponse as $reponse) {
      $datas[$i]['heure'] = $reponse->heure;
      $datas[$i]['Id_discussion'] = $reponse->Id_discussion;
      $datas[$i]['Id_reponse'] = $reponse->Id_reponse;
      $datas[$i]['CodeProduit'] = $reponse->CodeProduit;
      $datas[$i]['Nom_page'] = $reponse->Nom_page;
      $datas[$i]['client'] = $reponse->client;
      $datas[$i]['Type'] = $reponse->Type;
      $datas[$i]['action'] = "";
      $i++;
    }
    $Actions = $this->global_model->detail_publications($user, $date);
    foreach ($Actions as $key => $Actions) {

      $datas[$i]['heure'] = $Actions->Date . " " . $Actions->Heure;
      $datas[$i]['Id_discussion'] = $Actions->Code_publication;
      $datas[$i]['Id_reponse'] = $reponse->Id_reponse;
      $datas[$i]['CodeProduit'] = "";
      $datas[$i]['Nom_page'] = $Actions->Nom_groupe;
      $datas[$i]['client'] = $Actions->Nom_produit;
      $datas[$i]['Type'] = $Actions->Types;
      $datas[$i]['action'] = $Actions->Actions;
      $i++;
    }
    $data = [
      'Actions' => $this->global_model->detail_publications($user, $date),
      'data' => $datas
    ];


    $this->render_view('Controlleur/discussion/opldiscussion', $data);
  }
  public function liste_clients($user, $date = FALSE)
  {
    $this->load->model('global_model');
    $donne = array();
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $i = 0;
    $reponse = $this->global_model->table_listeclient($date, $user);
    $statut = $this->global_model->statut($date, $user);
    foreach ($reponse as  $reponse) {
      $donne[$i]['Code_client'] = $reponse->client;
      $donne[$i]['detail'] = $this->global_model->retourClient($reponse->client);
      $donne[$i]['client'] = $reponse->client;
      $donne[$i]['statut'] = $this->statut($reponse->client, $user, $date);
      $donne[$i]['discuss'] = $this->global_model->detail_discussion_operatrice($date, $user, $reponse->client);
      $i++;
    }

    $data = [
      'data' => $donne,
      'statut' => $statut,
      'user' => $user,
      'date' => $date

    ];
    $this->render_view('Controlleur/discussion/listeclient', $data);
  }


  public function statut($client, $user, $date = FALSE)
  {
    $this->load->model('global_model');
    $test = 'En cours';
    $statut = '<span style="background-color:#007E33;padding:5px 10px;border-radius:5px;color:#fff;">En cours</span>';
    $data = $this->global_model->statut($client, $user, $date);
    foreach ($data as $data) {
      if ($data->Type == "vente") {
        $statut = '<span style="background-color:#0099CC;padding:5px 10px;border-radius:5px;color:#fff;">Conclue</span>';
        $test = 'Conclue';
      } else if ($data->Type == "Termnier") {
        if ($test != "Conclue") {
          $statut = '<span style="background-color:#CC0000;padding:5px 10px;border-radius:5px;color:#fff;">Terminée</span>';
        }
      }
    }
    return $statut;
  }



  public function liste_client($date = FALSE)
  {
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $this->load->model('global_model');
    $matricule = $this->input->post('matricule');
  }

  public function details_discussion($user, $client, $date = FALSE)
  {
    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $data = array('message' => false, 'content' => "");
    $datass = $this->global_model->details_discussion($user, $client, $date);

    $content = "";
    if ($datass) {
      $data['message'] = true;
      $text = "";
      foreach ($datass as $datass) {
        if ($datass->check == 'OUI') {
          $text = 'text-success';
        } else if ($datass->check == 'NON') {
          $text = 'text-danger';
        }
        $datetemp = explode(" ", $datass->heure);
        $dt = new dateTime($datetemp[1]);
        $dt->modify('+3hours');
        $heure = $dt->format('H:s:i');
        $content .= "<tr>";
        if ($datass->sender == "CLT") {
          $content .= "<td>" . $datass->Id . "</td><td style='width:80px'>" . $heure . "</td><td><row style='background-color:#bdbdbd ;color:#212121;padding:5px 10px;border-radius:10px;width:80px;margin-right:40px'>" . $datass->sender . "</td><td style='background:#bdbdbd;color:#212121 ;border-radius:5px; width:500px; margin-left:70px; padding:5px 4px'>" . $datass->Message . "</td><td style='background:#e0e0e0;width:50px '></td><td>" . $datass->appreciation . "</td><td>" . $datass->Type . "</td>";
          $content .= "</tr>";
        } else {
          $content .= "<td>" . $datass->Id . "</td><td style='width:80px'>" . $heure . "</td><td><row style='background-color:#ffff00  ;color:#212121;padding:5px 10px;border-radius:5px;width:80px;margin-right:40px'>" . $datass->sender . "</td>
        <td style='background:#ffe57f ;color:#212121;border-radius:10px;width:500px; margin-left:70px; padding:5px 4px'>" . $datass->Message . "</td>
        <td  style='background:#e0e0e0; width:50px'> <div class='form-check'>
        <input class='form-check-input check' type='radio' name='radio' id='radio1' value='OUI'>
        <label class='form-check-label' for='radio1' style='color:green' >OUI</label>
          </div>
        <div class='form-check'>
        <input class='form-check-input check' type='radio' name='radio' id='radio2'  value='NON'>
        <label class='form-check-label' for='radio2' style='color:red'>NON</label></td>
        <td class='change-text " . $text . "' style='width:250px;font-size:14px;height:30px'>" . $datass->appreciation . "</td><td>" . $datass->Type . "</td>";
        }
        $content .= "</tr>";
      }
    }
    $data = [
      'data' => $content,
      'client' => $this->calendrier_model->detail_client($client)

    ];

    $this->render_view('Controlleur/discussion/details_discussion', $data);
  }
  public function sondage()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datas = $this->global_model->tableSondages();
    if ($datas) {
      $data['message'] = true;

      $data = [
        'data' => $datas
      ];
    }
    $this->render_view('Controlleur/discussion/sondage', $data);
  }


  public function detail_publication($user, $date = FALSE)
  {
    $this->load->model('global_model');
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $datas = $this->global_model->detail_publication($user, $date);
    $content = "";
    if ($datas) {
      $data['message'] = true;

      foreach ($datas as $datas) {
        $content .= "<tr>";
        if ($datas->Actions == "PUBLICATION") {
          $content .= "<td>" . $datas->Heure . "</td><td>" . $datas->Code_publication . "</td><td><span style='background-color:#FF0000;color:#fff;padding:5px 10px;border-radius:5px;'>" . $datas->Actions . "</span></td><td>" . $datas->Types . "</td><td>" . $datas->Code_produit . "</td><td>" . $datas->Nom_produit . "</td><td><a href='" . $datas->Lien_support . "' target='_blank'>" . $datas->Nom_groupe . "</a></td>";
        } else if ($datas->Actions == "PARTAGE") {
          $content .= "<td>" . $datas->Heure . "</td><td>" . $datas->Code_publication . "</td><td><span style='background-color:#339900;color:#fff;padding:5px 10px;border-radius:5px;'>" . $datas->Actions . "</td><td>" . $datas->Types . "</td><td>" . $datas->Code_produit . "</td><td>" . $datas->Nom_produit . "</td><td><a href='" . $datas->Lien_support . "' target='_blank'>" . $datas->Nom_groupe . "</a></td>";
        } else if ($datas->Actions == "SONDAGE") {
          $content .= "<td>" . $datas->Heure . "</td><td>" . $datas->Code_publication . "</td><td><span style='background-color:#ffbb33;color:#fff;padding:5px 10px;border-radius:5px;'><a href='" . base_url("controlleur/sondage/") . "' class='link1 timeline'>" . $datas->Actions . "</a></td><td>" . $datas->Types . "</td><td>" . $datas->Code_produit . "</td><td>" . $datas->Nom_produit . "</td><td><a href='" . $datas->Lien_support . "' target='_blank'>" . $datas->Nom_groupe . "</a></td>";
        }
        $content .= "</tr>";
      }
    }

    $data = [

      'data' => $content

    ];

    $this->render_view('Controlleur/discussion/detail_publication', $data);
  }

  public function get_recap()
  {
    $datet = $this->input->post('dateselected');
    echo $datet;
  }
  public function produitListe()
  {
    $this->load->model('global_model');
    $date = $this->input->post('date');
    $matricule = $this->input->post('matricule');
    $facture = $this->global_model->ca_facture($matricule, $date);
    $reponse = $this->calendrier_model->ca_de_vente($date);
    $arrayContent = array();
    $ca = 0;
    $produit = 0;
    $content = "";
    $total = array();
    foreach ($facture as $facture) {
      if (array_key_exists($facture->Designation, $total)) {
        $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
      } else {
        $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
      }
      if (array_key_exists($facture->Designation, $arrayContent)) {
        $arrayContent[$facture->Designation] += $facture->Quantite;
      } else {
        $arrayContent[$facture->Designation] = $facture->Quantite;
      }
    }
    foreach ($reponse as $reponse) {
      $produit += $reponse->Quantit;
      $ca += ($reponse->Quantit * $reponse->Prix_detail);
    }
    foreach ($arrayContent as $key => $arrayContent) {

      $content .= "<tr><td class='text-center'>" . $key . "</td><td class='text-center'>" . $arrayContent . "</td><td>$total[$key]</td></tr>";
    }

    echo "<table class='table table-bordered'><thead><th class='text-center'>PRODUIT(S)</th><th class='text-center'>NOMBRE</th><th>PRIX</th></thead><tbody>" . $content . "</tbody></table>";
  }

  public function produitListemois()
  {
    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    //$date=$this->input->post('date');
    $matricule = $this->input->post('matricule');
    $dateD = $this->input->post('dateAutre1');
    $dateF = $this->input->post('dateAutre2');
    if (isset($dateD) and isset($dateF)) {
      $dateD = $this->input->post('dateAutre1');
      $dateF = $this->input->post('dateAutre2');
      $mois = null;
    } else {
      $dateD = null;
      $dateF = null;
      $now   = new DateTime;
      $mois = $now->format('Y-m');
    }
    $facture = $this->global_model->ca_fact_mois($matricule, $mois, $dateD, $dateF);
    $reponse = $this->calendrier_model->ca_de_vente_mois($mois, $dateD, $dateF);
    $arrayContent = array();
    $ca = 0;
    $produit = 0;
    $content = "";
    $total = array();
    foreach ($facture as $facture) {
      if (array_key_exists($facture->Designation, $total)) {
        $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
      } else {
        $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
      }
      if (array_key_exists($facture->Designation, $arrayContent)) {
        $arrayContent[$facture->Designation] += $facture->Quantite;
      } else {
        $arrayContent[$facture->Designation] = $facture->Quantite;
      }
    }
    foreach ($reponse as $reponse) {
      $produit += $reponse->Quantit;
      $ca += ($reponse->Quantit * $reponse->Prix_detail);
    }
    foreach ($arrayContent as $key => $arrayContent) {

      $content .= "<tr><td class='text-center'>" . $key . "</td><td class='text-center'>" . $arrayContent . "</td><td>$total[$key]</td></tr>";
    }

    echo "<table class='table table-bordered'><thead><th class='text-center'>PRODUIT(S)</th><th class='text-center'>NOMBRE</th><th>PRIX</th></thead><tbody>" . $content . "</tbody></table>";
  }
  public function produitUser()
  {
    $this->load->model('global_model');
    $matricule = $this->input->post('matricule');
    $date = $this->input->post('date');
    $facture = $this->global_model->ca_facture_opl($matricule, $date);
    $reponse = $this->calendrier_model->ca_de_vente($date);
    $arrayContent = array();
    $content = "";
    $ca = 0;
    $produit = 0;
    $total = array();

    foreach ($facture as $facture) {
      if (array_key_exists($facture->Designation, $total)) {
        $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
      } else {
        $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
      }
      if (array_key_exists($facture->Designation, $arrayContent)) {
        $arrayContent[$facture->Designation] += $facture->Quantite;
      } else {
        $arrayContent[$facture->Designation] = $facture->Quantite;
      }
    }
    /*foreach ($reponse as $reponse) {
      $produit += $reponse->Quantit;
      $ca += ($reponse->Quantit * $reponse->Prix_detail);
    }*/
    foreach ($arrayContent as $key => $arrayContent) {

      $content .= "<tr><td class='text-center'>" . $key . "</td><td class='text-center'>" . $arrayContent . "</td><td style='font-size:15px;'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
    }

    echo "<table class='table table-bordered'><thead><th class='text-center'>PRODUIT(S)</th><th class='text-center'>NOMBRE</th><th>PRIX</th></thead><tbody>" . $content . "</tbody></table>";
  }

  public function OPL()
  {
    $this->load->model('global_model');
    $matricule = $this->input->post('matricule');
    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }
    $content = "";
    $datas = $this->global_model->table_resume($date);
    $data = array();
    $data = $this->global_model->table_rapport($date, $matricule);
    $user = $this->global_model->user($matricule);
    $page = $this->global_model->groupeuser($matricule);
    if ($page) {
      $link_page = $page->Lien_page;
      $page_name = $page->Nom_page;
    } else {
      $link_page = "";
      $page_name = "";
    }

    $content .= "<tr style='font-size:10px;'><td class='text-center' style='width:117px;'>" . strtoupper($user->Prenom) . "</td><td class='text-center' style='width:200px'>" . $page_name . "</td></tr>";

    echo "<table class='table table-bordered table1' style='font-size:10px;'><thead></thead><tbody>" . $content . "</tbody></table>";
  }
  public function NOM()
  {
    $this->load->model('global_model');
    $code_client = $this->input->post('code_client');
    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }
    $content = "";
    $data = array();
    $client = $this->global_model->retourClients($code_client, $date);

    $content .= "<tr style='font-size:16px;'><td class='text-center' style='width:117px;'>" . $client->Compte_facebook . "</td></tr>";

    echo "<table class='table table-bordered table1' style='font-size:16px;'><thead></thead><tbody>" . $content . "</tbody></table>";
  }
  public function NAME()
  {
    $this->load->model('global_model');
    $code_client = $this->input->post('code_client');
    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }
    $content = "";
    $data = array();
    $client = $this->global_model->retourClients($code_client, $date);

    $content .= "<tr style='font-size:16px;'><td class='text-center' style='width:350px;'>" . $client->Compte_facebook . "</td></tr>";

    echo "<table class='table table-bordered table1' style='font-size:16px;'><thead></thead><tbody>" . $content . "</tbody></table>";
  }
  public function produitsListe()
  {
    $this->load->model('global_model');
    $date = $this->input->post('date');
    $matricule = $this->input->post('matricule');
    $facture = $this->global_model->ca_facture($matricule, $date);
    $reponse = $this->calendrier_model->ca_de_vente($date);
    $arrayContent = array();
    $ca = 0;
    $produit = 0;
    $content = "";
    $total = array();
    foreach ($facture as $facture) {
      if (array_key_exists($facture->Designation, $total)) {
        $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
      } else {
        $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
      }
      if (array_key_exists($facture->Designation, $arrayContent)) {
        $arrayContent[$facture->Designation] += $facture->Quantite;
      } else {
        $arrayContent[$facture->Designation] = $facture->Quantite;
      }
    }
    foreach ($reponse as $reponse) {
      $produit += $reponse->Quantit;
      $ca += ($reponse->Quantit * $reponse->Prix_detail);
    }
    foreach ($arrayContent as $key => $arrayContent) {

      $content .= "<tr style='font-size:10px;'><td class='text-center'  style='width:150px;'>" . $key . "</td><td class='text-center' style='width:60px;'>" . $arrayContent . "</td><td style='width:100px;' class='text-center'>$total[$key]</td></tr>";
    }

    echo "<table class='table table-bordered table1'><thead style='font-size:10px'><th class='text-center' style='width:148px'>PRODUIT(S)</th><th class='text-center' style='width:60px'>NOMBRE</th><th style='width:100px' class='text-center'>PRIX</th></thead><tbody style='font-size:10px'>" . $content . "</tbody></table>";
  }

  public function produitsUser()
  {
    $this->load->model('global_model');
    $matricule = $this->input->post('matricule');
    $date = $this->input->post('date');
    $facture = $this->global_model->ca_facture_opl($matricule, $date);
    $reponse = $this->calendrier_model->ca_de_vente($date);
    $arrayContent = array();
    $content = "";
    $ca = 0;
    $produit = 0;
    $total = array();

    foreach ($facture as $facture) {
      if (array_key_exists($facture->Designation, $total)) {
        $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
      } else {
        $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
      }
      if (array_key_exists($facture->Designation, $arrayContent)) {
        $arrayContent[$facture->Designation] += $facture->Quantite;
      } else {
        $arrayContent[$facture->Designation] = $facture->Quantite;
      }
    }
    foreach ($reponse as $reponse) {
      $produit += $reponse->Quantit;
      $ca += ($reponse->Quantit * $reponse->Prix_detail);
    }
    foreach ($arrayContent as $key => $arrayContent) {

      $content .= "<tr style='font-size:10px;'><td class='text-center'  style='width:150px;'>" . $key . "</td><td class='text-center' style='width:60px;'>" . $arrayContent . "</td><td style='width:100px;' class='text-center'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
    }

    echo "<table class='table table-bordered table1'><thead style='font-size:10px'><th class='text-center' style='width:150px'>PRODUIT(S)</th><th class='text-center' style='width:60px'>NOMBRE</th><th style='width:100px' class='text-center'>PRIX</th></thead><tbody style='font-size:10px'>" . $content . "</tbody></table>";
  }

  public function produitUsermois()
  {
    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    $matricule = $this->input->post('matricule');
    $dateD = $this->input->post('dateAutre1');
    $dateF = $this->input->post('dateAutre2');
    if (isset($dateD) and isset($dateF)) {
      $dateD = $this->input->post('dateAutre1');
      $dateF = $this->input->post('dateAutre2');
      $mois = null;
    } else {
      $dateD = null;
      $dateF = null;
      $now   = new DateTime;
      $mois = $now->format('Y-m');
    }
    $facture = $this->global_model->ca_fact_mois($matricule, $mois, $dateD, $dateF);
    $reponse = $this->calendrier_model->ca_de_vente_mois($mois, $status = FALSE, $user = FALSE, $dateD, $dateF);
    $arrayContent = array();
    $content = "";
    $ca = 0;
    $produit = 0;
    $total = array();

    foreach ($facture as $facture) {
      if (array_key_exists($facture->Designation, $total)) {
        $total[$facture->Designation] += ($facture->Quantite * $facture->Prix_detail);
      } else {
        $total[$facture->Designation] = ($facture->Quantite * $facture->Prix_detail);
      }
      if (array_key_exists($facture->Designation, $arrayContent)) {
        $arrayContent[$facture->Designation] += $facture->Quantite;
      } else {
        $arrayContent[$facture->Designation] = $facture->Quantite;
      }
    }
    foreach ($reponse as $reponse) {
      $produit += $reponse->Quantit;
      $ca += ($reponse->Quantit * $reponse->Prix_detail);
    }
    foreach ($arrayContent as $key => $arrayContent) {

      $content .= "<tr><td class='text-center'>" . $key . "</td><td class='text-center'>" . $arrayContent . "</td><td style='font-size:15px;'>" . number_format($total[$key], 0, '.', ',') . "</style></td></tr>";
    }

    echo "<table class='table table-bordered'><thead><th class='text-center'>PRODUIT(S)</th><th class='text-center'>NOMBRE</th><th>PRIX</th></thead><tbody>" . $content . "</tbody></table>";
  }

  public function enregister_remarque()
  {
    $this->load->model('global_model');
    $id = $this->input->post('Id');
    $data = [
      'appreciation' => $this->input->post('appreciation'),
      'check' => $this->input->post('choix')
    ];
    $this->global_model->enregister_remarque($id, $data);
    echo json_encode(array('message' => true));
  }
  public function statutCRX($linkFb, $groupe)
  {
    $this->load->model('global_model');
    $test_exist_CMT = $this->global_model->test_exist_CMT($linkFb);
    if ($test_exist_CMT) {
      $test_exist_CLT = $this->global_model->test_exist_CLT($linkFb);
      if ($test_exist_CLT) {
        $resultat = "CLT";
      } else {
        $testCMT = $this->global_model->test_discussion_crx($test_exist_CMT->Code_client, trim($groupe));
        $resultat = $groupe;
        if ($testCMT != '0') {
          $resultat = 'CMT';
        } else {
          $resultat = 'CRX';
          // $resultat=$test_exist_CMT->Code_client;
          // $resultat=$test_exist_CMT->Code_client;
          // $resultat= $testCMT;
        }
      }
      //$groupes=$this->global_model->usergroupefacture($groupe,$linkFb);

    } else {
      $resultat = "CRX";
    }


    /* if($groupes){
     $resultat=$groupes->Code_client;
   }else{
     $groupesx=$this->global_model->usergroupefactureCMT($groupe,$linkFb);
     if($groupesx > 2){
       $resultat="CMT";
     }else{
       $resultat="CRX";
     }
     
   }*/


    return $resultat;
  }

  public function curieux($limit, $start)
  {
    $this->load->model('global_model');
    $i = 0;
    $donne = array();
    $entete = array();
    $data = $this->global_model->client_crx_tout($limit, $start);
    foreach ($data as $key => $data) {
      $i = 0;
      $groupe = $this->global_model->groupeusers();
      foreach ($groupe as $groupe) {
        if (!in_array($groupe->Nom_page, $entete)) {
          $entete[$i] = $groupe->Nom_page;
          $i++;
        }
        $donne[$data->Nom . "." . $data->Code_client]['page'][$groupe->Nom_page] = $this->statutCRX($data->Code_client, $groupe->id);
      }
    }

    return array('data' => $donne, 'entete' => $entete);
  }
  public function  clients($type)
  {
    $this->load->model('client_model');
    $config = array();
    $config["base_url"] = base_url() . strtolower($this->session->userdata('designation')) . '/' . 'clients/' . $type;
    $config["total_rows"] = $this->client_model->nombre_clientCRX();
    $config["per_page"] = 10;
    $config["uri_segment"] = 4;

    $config["full_tag_open"] = '<ul class="pagination">';
    $config["full_tag_close"] = '</ul>';

    $config["first_link"] = "Première";
    $config["first_tag_open"] = "<li>";
    $config["first_tag_close"] = "</li>";

    $config["last_link"] = "Dernière";
    $config["last_tag_open"] = "<li>";
    $config["last_tag_close"] = "</li>";

    $config['next_link'] = 'Suivante';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '<li>';

    $config['prev_link'] = 'Précedante';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '<li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);

    $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
    $donne = $this->curieux($config["per_page"], $page);
    $data["links"] = $this->pagination->create_links();
    $data['data'] = $donne['data'];
    $data['entete'] = $donne['entete'];

    $this->render_view('Controlleur/client/' . $type, $data);
  }

  public function  clients_curieux()
  {
    $this->load->model('client_model');
    $config = array();
    $config["base_url"] = base_url() . strtolower($this->session->userdata('designation')) . '/' . 'clients_curieux/';
    $config["total_rows"] = $this->client_model->nombre_clientCRX();
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;

    $config["full_tag_open"] = '<ul class="pagination">';
    $config["full_tag_close"] = '</ul>';

    $config["first_link"] = "Première";
    $config["first_tag_open"] = "<li>";
    $config["first_tag_close"] = "</li>";

    $config["last_link"] = "Dernière";
    $config["last_tag_open"] = "<li>";
    $config["last_tag_close"] = "</li>";

    $config['next_link'] = 'Suivante';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '<li>';

    $config['prev_link'] = 'Précedante';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '<li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';



    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["links"] = $this->pagination->create_links();
    $data['client'] = $this->client_model->get_client_crx($config["per_page"], $page);
    $this->render_view('Controlleur/client/clients_curieux', $data);
  }

  public function detail_clients_curieux($Id)
  {
    $this->render_view('Controlleur/client/detail_clients_curieux');
  }
  public function presence($date = FALSE)
  {
    $this->load->model('Global_model');
    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }
    $date_prese = explode("-", $date);
    $content = "";
    $datas = $this->global_model->table_resume($date);
    foreach ($datas as $key => $datas) {
      $data = array();
      $produit = 0;
      $ca = 0;
      $publi = 0;
      $data = $this->global_model->table_rapport($date, $datas->operatrice);
      $facture = $this->global_model->ca_facture_opl($datas->operatrice, $date);
      $user = $this->global_model->user($datas->operatrice);
      $sender = $this->global_model->repopl($date, $datas->operatrice);
      $page = $this->global_model->groupeuser($datas->operatrice);
      $publica = $this->global_model->reppublication($datas->operatrice, $date);
      $nb = $this->global_model->date_presence($datas->operatrice, $date_prese[1]);

      $content .= "<tr><td class='text-center matricule'><a href='#' class='link1 timeline'>" . $datas->operatrice . "</td><td><a href='" . base_url("controlleur/detail_discussion_operatrice/" . $datas->operatrice . "/" . $date) . "' class='link1 timeline'>" . $user->Nom . " " . $user->Prenom . "</a></td><td><a href='" . $page->Lien_page . "' target='_blank'>" . $page->Nom_page . "</a></td><td class='text-center'><button type='button' class='btn btn-primary show_modal' data-toggle='modal' data-target='.bd-example-modal-lg' style=''>" . count($nb) . "</button></td></tr>";
    }
    $data = ['data' => $content];
    $this->render_view('Controlleur/presence', $data);
  }
  public function details_presence($user, $date = FALSE)
  {
    $this->load->model('global_model');
    $i = 0;
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $reponse = $this->global_model->pres($date, $user);
    foreach ($reponse as $reponse) {
      $datas[$i]['heure'] = $reponse->heure;
      $i++;
    }
    $Actions = $this->global_model->detail_pre($user, $date);
    foreach ($Actions as $key => $Actions) {

      $datas[$i]['heure'] = $Actions->Date . " " . $Actions->Heure;
      $datas[$i]['date'] = $Actions->Date . " " . $Actions->Date;
      $i++;
    }
    $data = [
      'Actions' => $this->global_model->detail_pre($user, $date),
      'data' => $datas
    ];

    $this->render_view('Controlleur/details_presence', $data);
  }

  public function data_json_calendrier_presence()
  {
    $tab = array();
    $i = 0;
    $this->load->model('Calendrier_model');
    $this->load->model('global_model');
    $color = array('pre' => "#0062cc!important", 'ann' => "#CC0000!important", "pla" => "#563d7c!important", "liv" => "green!important", "etdc" => "orange!important");
    $type = array('pre' => "previ", 'ann' => "annule", "pla" => "confirmer", "liv" => "livre", "etdc" => "en_attente");
    foreach ($this->Calendrier_model->retour_date_precence() as $data) {
      $count = "";
      $user = $this->global_model->pres_calendrier($data->Date);
      foreach ($user as   $user) {
        if ($count == "") {
          $count = $user->operatrice;
        } else {
          $count .= $user->operatrice;
        }
      }
      $tab[$i] = array(
        'id' => $i,
        'title' =>  $count,
        'start' => $data->Date,
        'color' => "#0062cc!important"
      );

      $i++;
    }
    echo json_encode($tab);
  }
  public function detail_de_facture($idfacture)
  {
    $this->load->model('calendrier_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'facture' => $this->calendrier_model->detail_facture_discussion($idfacture)
    ];
    $this->render_view('Controlleur/calendrier/detail_facture', $data);
  }


  public function etat_vente_resp($date = false)
  {
    if ($date == false) {
      $date = date('Y-m-d');
    }
    $datet = $this->input->post('dateAutre');
    $text = array('en_attente' => 'EN ATTENTE', 'confirmer' => 'CONFIRMEE', 'annule' => 'ANNULEE', 'livre' => 'LIVREE', 'reppoter' => 'REPPORTEE');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    $this->load->model('calendrier_model');
    if ($this->session->userdata('designation') == "Controlleur") {
      $i = 0;
      $entete = array('totaLsom' => 0);
      $content = "";
      $datas = $this->global_model->etat_vente($date);
      $datax = $datas;
      $data = array();
      $total = 0;
      $livre = 0;
      $en_attente = 0;
      $annule = 0;
      $confirmer = 0;
      $ca = array();
      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'livre')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'livre') as $key => $value) {
          $livre += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['livre'])) {
            $dataUser[$value->Matricule_personnel]['livre'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['livre'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }


      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'en_attente')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'en_attente') as $key => $value) {
          $en_attente += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['en_attente'])) {
            $dataUser[$value->Matricule_personnel]['en_attente'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['en_attente'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }

      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'annule')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'annule') as $key => $value) {
          $annule += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['annule'])) {
            $dataUser[$value->Matricule_personnel]['annule'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['annule'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }

      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'confirmer')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'confirmer') as $key => $value) {
          $confirmer += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['confirmer'])) {
            $dataUser[$value->Matricule_personnel]['confirmer'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['confirmer'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }
      foreach ($datax as $key => $datax) {
        if (array_key_exists($datax->date_de_livraison, $ca)) {
          foreach ($this->calendrier_model->ca_facture($datax->Id) as $commande) {
            $ca[$datax->date_de_livraison] += $commande->Quantite * $commande->Prix_detail;
          }
        } else {
          $ca[$datax->date_de_livraison] = 0;
          foreach ($this->calendrier_model->ca_facture($datax->Id) as $commande) {
            $ca[$datax->date_de_livraison] += $commande->Quantite * $commande->Prix_detail;
          }
        }

        if (!in_array($datax->date_de_livraison, $data)) {
          $data[$i] = $datax->date_de_livraison;
          $i++;
        }
      }
      sort($data);
      foreach ($data as $data) {
        $content .= "<tr'><td class='text-danger' style='font-size:17px'>" . $this->dateToFrench($data, 'l j F Y') . "</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class='text-danger' style='font-size:15px'><b>" . number_format($ca[$data], 0, ',', ' ') . " Ar</b></td></tr>";
        $datadate = $this->global_model->detail_etat_vente_facture($date, $data);

        foreach ($datadate as $key => $datadate) {
          $produit = "";
          $prix = "";
          foreach ($this->calendrier_model->ca_facture($datadate->Id) as $commande) {
            //$resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
            $produit .= $commande->Designation . '<br/>';
            $prix .= number_format($commande->Quantite * $commande->Prix_detail, 0, ',', ' ') . ' <br/>';
          }
          $codeCodevlient = $this->calendrier_model->detail_client($datadate->Code_client);
          $mission = $datadate->Id_de_la_mission;
          if (strstr($codeCodevlient->Commercial, "VP")) {
            $facture = $this->global_model->testFactureLocalite($codeCodevlient->Commercial, $data);
            if ($facture) {
              $mission = $facture->Id_de_la_mission;
            }
            //else{
            //$mission="";
            // }

          }
          if ($datadate) {
            $COMM = $datadate->Ress_sec_oplg;
          } else {
            $COMM = "";
          }
          if ($text[$datadate->Status] == 'EN ATTENTE' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . $datadate->Matricule_personnel . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#FF8800;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'LIVREE' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . $datadate->Matricule_personnel . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#00C851;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'ANNULEE' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . $datadate->Matricule_personnel . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#CC0000;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'CONFIRMEE' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . $datadate->Matricule_personnel . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#9933CC;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          }
          if ($text[$datadate->Status] == 'EN ATTENTE' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . $datadate->Matricule_personnel . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#FF8800;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'LIVREE' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . $datadate->Matricule_personnel . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#00C851;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'ANNULEE' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . $datadate->Matricule_personnel . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#CC0000;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'CONFIRMEE' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . $datadate->Matricule_personnel . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#9933CC;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          }

          // $content.="<tr><td>".$datadate->data_de_livraison."</td><td>".$datadate->Code_client."</td><td >".$datadate->Matricule_personnel."</td><td>".$datadate->Designation."</td><td>".number_format($datadate->Prix_detail, 0, ',', ' ')."Ar</td><td class='text-center >".$datadate->Id_de_la_mission."</td><td>".$datadate->Status."</td></tr>";

        }
        $entete['totaLsom'] += $ca[$data];
      }

      return  $data = ['data' => $content, 'entete' => $entete, 'livre' => $livre, 'en_attente' => $en_attente, 'annule' => $annule, 'confirmer' => $confirmer];
    }
  }



  public function etat_vente($date = false)
  {
    if ($date == false) {
      $date = date('Y-m-d');
    }
    $datet = $this->input->post('dateAutre');
    $text = array('en_attente' => 'EN ATTENTE', 'confirmer' => 'CONFIRMEE', 'annule' => 'ANNULEE', 'livre' => 'LIVREE', 'reppoter' => 'REPPORTEE');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    $this->load->model('calendrier_model');
    if ($this->session->userdata('designation') == "Controlleur") {
      $i = 0;
      $entete = array('totaLsom' => 0);
      $content = "";
      $datas = $this->global_model->etat_vente($date);
      $datax = $datas;
      $data = array();
      $total = 0;
      $livre = 0;
      $en_attente = 0;
      $annule = 0;
      $confirmer = 0;
      $ca = array();
      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'livre')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'livre') as $key => $value) {
          $livre += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['livre'])) {
            $dataUser[$value->Matricule_personnel]['livre'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['livre'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }


      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'en_attente')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'en_attente') as $key => $value) {
          $en_attente += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['en_attente'])) {
            $dataUser[$value->Matricule_personnel]['en_attente'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['en_attente'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }

      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'annule')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'annule') as $key => $value) {
          $annule += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['annule'])) {
            $dataUser[$value->Matricule_personnel]['annule'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['annule'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }

      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'confirmer')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'confirmer') as $key => $value) {
          $confirmer += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['confirmer'])) {
            $dataUser[$value->Matricule_personnel]['confirmer'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['confirmer'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }
      foreach ($datax as $key => $datax) {
        if (array_key_exists($datax->date_de_livraison, $ca)) {
          foreach ($this->calendrier_model->ca_facture($datax->Id) as $commande) {
            $ca[$datax->date_de_livraison] += $commande->Quantite * $commande->Prix_detail;
          }
        } else {
          $ca[$datax->date_de_livraison] = 0;
          foreach ($this->calendrier_model->ca_facture($datax->Id) as $commande) {
            $ca[$datax->date_de_livraison] += $commande->Quantite * $commande->Prix_detail;
          }
        }

        if (!in_array($datax->date_de_livraison, $data)) {
          $data[$i] = $datax->date_de_livraison;
          $i++;
        }
      }
      sort($data);
      foreach ($data as $data) {
        $content .= "<tr'><td class='text-danger' style='font-size:17px'>" . $this->dateToFrench($data, 'l j F Y') . "</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class='text-danger' style='font-size:15px'><b>" . number_format($ca[$data], 0, ',', ' ') . " Ar</b></td></tr>";
        $datadate = $this->global_model->detail_etat_vente_facture($date, $data);

        foreach ($datadate as $key => $datadate) {
          $produit = "";
          $prix = "";
          foreach ($this->calendrier_model->ca_facture($datadate->Id) as $commande) {
            //$resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
            $produit .= $commande->Designation . '<br/>';
            $prix .= number_format($commande->Quantite * $commande->Prix_detail, 0, ',', ' ') . ' <br/>';
          }
          $codeCodevlient = $this->calendrier_model->detail_client($datadate->Code_client);
          $mission = $datadate->Id_de_la_mission;

          if ($datadate) {
            $COMM = $datadate->Ress_sec_oplg;
          } else {
            $COMM = "";
          }
          if ($text[$datadate->Status] == 'EN ATTENTE' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#FF8800;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'LIVREE' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#00C851;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'ANNULEE' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#CC0000;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'CONFIRMEE' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#9933CC;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          }
          if ($text[$datadate->Status] == 'EN ATTENTE' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#FF8800;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'LIVREE' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#00C851;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'ANNULEE' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#CC0000;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'CONFIRMEE' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td class='text-center'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td>" . $COMM . "</td><td class='text-center'>" . substr($produit, 0, 35) . "</td><td class='text-center' style='width=20%'>" . $prix . "</td><td>" . strtoupper(substr($mission, 0, 14)) . "</td><td class='text-center'>" . strtoupper($datadate->District) . "</td><td class='text-center'><row style='background-color:#9933CC;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>" . $text[$datadate->Status] . "</td></tr>";
          }

          // $content.="<tr><td>".$datadate->data_de_livraison."</td><td>".$datadate->Code_client."</td><td >".$datadate->Matricule_personnel."</td><td>".$datadate->Designation."</td><td>".number_format($datadate->Prix_detail, 0, ',', ' ')."Ar</td><td class='text-center >".$datadate->Id_de_la_mission."</td><td>".$datadate->Status."</td></tr>";

        }
        $entete['totaLsom'] += $ca[$data];
      }


      /* foreach ($datas as $key => $datas) {
          $produit=0;
          $user=$this->global_model->user($datas->Matricule_personnel);
          $content.="<tr><td>".$datas->data_de_livraison."</td><td>".$datas->Code_client."</td><td >".$datas->Matricule_personnel."</td><td></td><td>".number_format(000, 0, ',', ' ')."Ar</td><td class='text-center >".$datas->Id_de_la_mission."</td><td>".$datas->Status."</td></tr>";
         }*/
      $data = ['data' => $content, 'entete' => $entete, 'livre' => $livre, 'en_attente' => $en_attente, 'annule' => $annule, 'confirmer' => $confirmer, 'date' => $date];
    }

    $this->render_view('Controlleur/etat_vente', $data);
  }



  public  function dateToFrench($date, $format)
  {
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
  }

  public function etat_mensuel()
  {

    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    if ($this->session->userdata('designation') == "Controlleur") {
      $dateD = $this->input->post('dateAutre1');
      $dateF = $this->input->post('dateAutre2');
      if (isset($dateD) and isset($dateF)) {
        $dateD = $this->input->post('dateAutre1');
        $dateF = $this->input->post('dateAutre2');
        $mois = null;
      } else {
        $dateD = null;
        $dateF = null;
        $now   = new DateTime;
        $mois = $now->format('Y-m');
      }
      $text = array('FACIAL EGGWHITE' => 'EGGWHITE', 'VIVITE ESSENTIAL LESS SHAVE ' => 'LESS SHAVE', 'FEMININE CLEANSING LADY BLUE ' => 'LADY BLUE', 'FEMININE CLEANSING LADY PINK' => 'LADY PINK', 'VIVITE CLEAR & CONFIDENT' => 'CLEAR & CONFIDENT', 'VIVITE SNAIL WHITE' => 'SNAIL WHITE');
      $content = "";
      $entete = array('cavpL' => 0, 'reponse' => 0, 'ca' => 0, 'CA_VB' => 0, 'CA_VBL' => 0, 'cal' => 0, 'totalratio' => 0, 'cavpt' => 0, 'date1' => 0, 'date2' => 0);
      $datas = $this->global_model->table_resume2($mois, $dateD, $dateF);
      foreach ($datas as $key => $datas) {
        $data = array();
        $produit = 0;
        $ca = 0;
        $cal = 0;
        $publi = 0;
        $ratio = 0;
        $cab = 0;
        $capt = 0;
        $cabl = 0;
        $capl = 0;
        $captl = 0;
        $data = $this->global_model->table_rapport2($mois, $datas->operatrice, $dateD, $dateF);
        $facture = $this->global_model->ca_facture_opl2($mois, $datas->operatrice, $dateD, $dateF);
        $user = $this->global_model->user($datas->operatrice);
        $sender = $this->global_model->repopl2($mois, $datas->operatrice, $dateD, $dateF);
        $page = $this->global_model->groupeuser($datas->operatrice);
        $publica = $this->global_model->reppublication2($datas->operatrice, $mois, $dateD, $dateF);
        $livre = $this->global_model->ca_facture_opl3($mois, $datas->operatrice, $dateD, $dateF);
        $cavp = $this->global_model->chiffre_d_affaires_VP($mois, $datas->operatrice, $dateD, $dateF);
        $cavb = $this->global_model->sommeFacebook($mois, $datas->operatrice, $dateD, $dateF);
        $cavpl = $this->global_model->chiffre_d_affaires_VPL($mois, $datas->operatrice, $dateD, $dateF);
        $cavbl = $this->global_model->chiffre_d_affaires_VBL($mois, $datas->operatrice, $dateD, $dateF);
        $nb = $this->calendrier_model->cont_resultArrays2($mois, 'previ', $datas->operatrice, $dateD, $dateF);
        foreach ($facture as $facture) {
          $produit += $facture->Quantite;
          $ca += ($facture->Quantite * $facture->Prix_detail);
        }
        foreach ($livre as $livre) {
          //$produit+=$facture->Quantite;
          $cal += ($livre->Quantite * $livre->Prix_detail);
        }

        if ($page) {
          $link_page = $page->Lien_page;
          $page_name = $page->Nom_page;
        } else {
          $link_page = "";
          $page_name = "";
        }

        if (($cavbl['Montant']) != 0 and ($cavb['Montant']) != 0) {
          $ratio = ((($cavbl['Montant']) * 100) / ($cavb['Montant']));
        } else {
          $ratio = 0;
        }

        $content .= "<tr><td class='text-center matricule'>" . substr($datas->operatrice, 0, 7) . "</td><td><a href='" . base_url("controlleur/detail_discussion_operatrice/" . $datas->operatrice . "/" . $mois) . "' class='link1 timeline'>" . strtoupper($user->Prenom) . "</a></td><td><a href='" . $link_page . "' target='_blank'>" . $page_name . "</a></td><td class='text-center'>" . number_format($ca, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($cavb['Montant'], 0, ',', ' ') . "</td><td>" . number_format($cavbl['Montant'], 0, ',', ' ') . "</td><td class='text-center'>" . number_format($cavp['Montant'], 0, ',', ' ') . "</td><td class='text-center'>" . number_format($cavpl['Montant'], 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ratio, 2, ',', ' ') . "%</td></tr>";
        $entete['cavpL'] += $cavpl['Montant'];
        $entete['cavpt'] += $cavp['Montant'];
        $entete['ca'] += $ca;
        $entete['CA_VB'] += $cavb['Montant'];
        $entete['CA_VBL'] += $cavbl['Montant'];
        $entete['cal'] += $captl;
        $entete['date1'] = $dateD;
        $entete['date2'] = $dateF;
        //$entete['totalratio']=$ratio;


      }
      $data = ['entete' => $entete, 'data' => $content, 'date' => $dateD];
    }

    $this->render_view('Controlleur/etat_mensuel', $data);
  }

  public function performance()
  {

    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    if ($this->session->userdata('designation') == "Controlleur") {
      $dateD = $this->input->post('dateAutre1');
      $dateF = $this->input->post('dateAutre2');
      if (isset($dateD) and isset($dateF)) {
        $dateD = $this->input->post('dateAutre1');
        $dateF = $this->input->post('dateAutre2');
        $mois = null;
      } else {
        $dateD = null;
        $dateF = null;
        $now   = new DateTime;
        $mois = $now->format('Y-m');
      }
      $content = "";
      $entete = array('totaLclient' => 0, 'reponse' => 0, 'ca' => 0, 'NBProduit' => 0, 'totalpublication' => 0, 'date1' => 0, 'date2' => 0);
      $datas = $this->global_model->table_resume2($mois, $dateD, $dateF);
      foreach ($datas as $key => $datas) {
        $data = array();
        $produit = 0;
        $ca = 0;
        $publi = 0;
        $data = $this->global_model->table_rapport2($mois, $datas->operatrice, $dateD, $dateF);
        $facture = $this->global_model->ca_facture_opl2($mois, $datas->operatrice, $dateD, $dateF);
        $user = $this->global_model->user($datas->operatrice);
        $sender = $this->global_model->repopl2($mois, $datas->operatrice, $dateD, $dateF);
        $page = $this->global_model->groupeuser($datas->operatrice);
        $publica = $this->global_model->reppublication2($datas->operatrice, $mois, $dateD, $dateF);
        $livre = $this->global_model->ca_facture_opl3($mois, $datas->operatrice, $dateD, $dateF);
        $nb = $this->calendrier_model->cont_resultArrays2($mois, 'previ', $datas->operatrice, $dateD, $dateF);
        foreach ($facture as $facture) {
          $produit += $facture->Quantite;
          $ca += ($facture->Quantite * $facture->Prix_detail);
        }

        if ($page) {
          $link_page = $page->Lien_page;
          $page_name = $page->Nom_page;
        } else {
          $link_page = "";
          $page_name = "";
        }
        $content .= "<tr><td class='collapse'>" . $datas->operatrice . "</td><td>" . substr($datas->operatrice, 0, 7) . "</td><td>" . strtoupper($user->Prenom) . "</td><td><a href='" . $link_page . "' target='_blank'>" . strtoupper($page_name) . "</a></td><td class='text-center'><a href='" . base_url("controlleur/detail_publication/" . $datas->operatrice . "/" . $mois) . "' class='link1 timeline'>" . count($publica) . "</a></td><td class='text-center'><a href='" . base_url("controlleur/liste_clients/" . $datas->operatrice . "/" . $mois) . "' class='link1 timeline'>" . count($data) . "</a></td><td class='text-center'>" . count($sender) . "</td><td class='text-center'><a href='#' class='linky produit'>" . $produit . "</a></td></tr>";
        $entete['totaLclient'] += count($data);
        $entete['reponse'] += count($sender);
        $entete['ca'] += $ca;
        $entete['NBProduit'] += $produit;
        $entete['totalpublication'] += count($publica);
        $entete['date1'] = $dateD;
        $entete['date2'] = $dateF;
      }
      $data = ['entete' => $entete, 'data' => $content];
    }

    $this->render_view('Controlleur/performance', $data);
  }


  ////////////////////////////////////////AJOUT GROUPE FB////////////////////////////////////////////////////////
  public function insert()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datas = $this->global_model->tableinsert();
    if ($datas) {
      $data['message'] = true;
      $content = "";
      foreach ($datas as $datas) {
        $content .= "<tr>";
        $content .= "<td>" . $datas->Code_groupe . "</td><td>" . $datas->Nom_groupe . "</td><td>" . $datas->Lien_support . "</td>";
        $content .= "</tr>";
      }
      $data = [
        'data' => $content
      ];
    }
    $this->render_view('Controlleur/insert', $data);
  }
  public function Ajout_page()
  {
    $this->render_view('Controlleur/Ajout_page');
  }
  public function autocomplete_groupe()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_groupe($term) as $reponse) {
      array_push($array, $reponse->Code_groupe . " | " . $reponse->Nom_groupe);
    }
    echo json_encode($array);
  }
  public function enregistrer_groupe()
  {
    $this->load->model('global_model');
    $Code_groupe = $this->input->post('Code_groupe');
    $Nom_groupe = $this->input->post('Nom_groupe');
    $Lien_support = $this->input->post('Lien_support');

    $data = [
      'Code_groupe' => $Code_groupe,
      'Nom_groupe' => $Nom_groupe,
      'Lien_support' => $Lien_support,

    ];
    $this->global_model->insert($data);
  }
  ////////////////////////////////////////////AJOUT OPL//////////////////////////////////////////////////////////////////
  public function enregistrer_opl()
  {
    $this->load->model('global_model');
    $Date_d_embauche = $this->input->post('Date_d_embauche');
    $Matricule = $this->input->post('Matricule');
    $Nom = $this->input->post('Nom');
    $Prenom = $this->input->post('Prenom');
    $Date_de_naissance = $this->input->post('Date_de_naissance');
    $Lieu_de_naissance = $this->input->post('Lieu_de_naissance');
    $Sexe = $this->input->post('select1');
    $Situation_Matrimoniale = $this->input->post('select2');
    $Nombre_d_enfant = $this->input->post('Nombre_d_enfant');
    $Cin_personnel = $this->input->post('Cin_personnel');
    $Date_cin_personnel = $this->input->post('Date_cin_personnel');
    $Lieu_delivrance_du_cin_personnel = $this->input->post('Lieu_delivrance_du_cin_personnel');
    $Date_duplicata_cin_personnel = $this->input->post('Date_duplicata_cin_personnel');
    $Lieu_de_dupliacata_cin_personnel = $this->input->post('Lieu_de_dupliacata_cin_personnel');
    $Adresse_du_personnel = $this->input->post('Adresse_du_personnel');
    $Contact_du_personnel = $this->input->post('Contact_du_personnel');
    $Nom_et_prenom_du_tuteur = $this->input->post('Nom_et_prenom_du_tuteur');
    $Lien_de_parente = $this->input->post('Lien_de_parente');
    //$Cin_du_tuteur=$this->input->post('Cin_du_tuteur');
    $Date_de_delivrance_cin_tuteur = $this->input->post('datecintuteur');
    $Adresse_du_tuteur = $this->input->post('Adresse_du_tuteur');
    $Contact_du_tuteur = $this->input->post('Contact_du_tuteur');
    $Fonction_a_l_embauche = $this->input->post('select3');
    $Fonction_actuelle = $this->input->post('select4');
    $Mode_de_pass_login = $this->input->post('mdp');
    $statut = $this->input->post('select5');

    $data = [
      'Date_d_embauche' => $Date_d_embauche, 'Matricule' => $Matricule, 'Nom' => $Nom, 'Prenom' => $Prenom,
      'Date_de_naissance' => $Date_de_naissance, 'Lieu_de_naissance' => $Lieu_de_naissance, 'select1' => $Sexe,
      'select2' => $Situation_Matrimoniale, 'Nombre_d_enfant' => $Nombre_d_enfant, 'Cin_personnel' => $Cin_personnel,
      'Date_cin_personnel' => $Date_cin_personnel, 'Lieu_delivrance_du_cin_personnel' => $Lieu_delivrance_du_cin_personnel,
      'Date_duplicata_cin_personnel' => $Date_duplicata_cin_personnel, 'Lieu_de_dupliacata_cin_personnel' => $Lieu_de_dupliacata_cin_personnel,
      'Adresse_du_personnel' => $Adresse_du_personnel, 'Contact_du_personnel' => $Contact_du_personnel, 'Nom_et_prenom_du_tuteur' => $Nom_et_prenom_du_tuteur,
      'Lien_de_parente' => $Lien_de_parente, 'Cin_du_tuteur' => $Cin_du_tuteur, 'datecintuteur' => $Date_de_delivrance_cin_tuteur,
      'Adresse_du_tuteur' => $Adresse_du_tuteur, 'Contact_du_tuteur' => $Contact_du_tuteur, 'select3' => $Fonction_a_l_embauche,
      'select4' => $Fonction_actuelle, 'mdp' => $Mode_de_pass_login, 'select5' => $statut,


    ];
    $this->global_model->Ajout_OPL($data);
  }
  public function Ajout_OPL()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datax = $this->global_model->tableajout();
    if ($datax) {
      $data['message'] = true;
      $content = "";
      foreach ($datax as $datax) {
        $content .= "<tr>";
        $content .= "<td>" . $datax->Date_d_embauche . "</td><td>" . $datax->Matricule . "</td><td>" . $datax->Nom . "</td><td>" . $datax->Prenom . "</td><td>" . $datax->Date_de_naissance . "</td>
      <td>" . $datax->Lieu_de_naissance . "</td><td>" . $datax->Sexe . "</td><td>" . $datax->Situation_Matrimoniale . "</td><td>" . $datax->Nombre_d_enfant . "</td><td>" . $datax->Cin_personnel . "</td>
      <td>" . $datax->Lieu_delivrance_du_cin_personnel . "</td><td>" . $datax->Date_duplicata_cin_personnel . "</td><td>" . $datax->Lieu_de_dupliacata_cin_personnel . "</td>
      <td>" . $datax->Adresse_du_personnel . "</td><td>" . $datax->Contact_du_personnel . "</td><td>" . $datax->Nom_et_prenom_du_tuteur . "</td><td>" . $datax->Lien_de_parente . "</td>
      <td>" . $datax->Cin_du_tuteur . "</td><td>" . $datax->Date_de_delivrance_cin_tuteur . "</td><td>" . $datax->Adresse_du_tuteur . "</td><td>" . $datax->Contact_du_tuteur . "</td>
      <td>" . $datax->Fonction_a_l_embauche . "</td><td>" . $datax->Fonction_actuelle . "</td><td>" . $datax->Mode_de_pass_login . "</td><td>" . $datax->statut . "</td>";
        $content .= "</tr>";
      }
      $data = [
        'data' => $content
      ];
    }
    $this->render_view('Controlleur/Ajout_OPL');
  }
  public function acceuil($date = false)
  {
    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    if ($this->session->userdata('designation') == "Controlleur") {
      $dateD = $this->input->post('dateAutre1');
      $dateF = $this->input->post('dateAutre2');
      if (isset($dateD) and isset($dateF)) {
        $dateD = $this->input->post('dateAutre1');
        $dateF = $this->input->post('dateAutre2');
        $mois = null;
      } else {
        $dateD = null;
        $dateF = null;
        $now   = new DateTime;
        $mois = $now->format('Y-m');
      }
      $date = $this->input->post('date');
      if ($date == false) {
        $date = date('Y-m-d');
      }

      $content = "";
      $entete = array('totaLclient' => 0, 'reponse' => 0, 'ca' => 0, 'NBProduit' => 0, 'totalpublication' => 0, 'date1' => 0, 'date2' => 0);
      $datas = $this->global_model->table_resume2($mois, $dateD, $dateF);
      $totalclient = 0;
      $totalpubli = 0;
      $totalpro = 0;
      $totalrep = 0;
      foreach ($datas as $key => $datas) {
        $data = array();
        $produit = 0;
        $ca = 0;
        $publi = 0;
        $data = $this->global_model->table_rapport2($mois, $datas->operatrice, $dateD, $dateF);
        $facture = $this->global_model->ca_facture_opl2($mois, $datas->operatrice, $dateD, $dateF);
        $user = $this->global_model->user($datas->operatrice);
        $sender = $this->global_model->repopl2($mois, $datas->operatrice, $dateD, $dateF);
        $page = $this->global_model->groupeuser($datas->operatrice);
        $publica = $this->global_model->reppublication2($datas->operatrice, $mois, $dateD, $dateF);
        //$livre=$this->global_model->ca_facture_opl3($mois,$datas->operatrice,$dateD,$dateF);
        $nb = $this->calendrier_model->cont_resultArrays2('previ', $datas->operatrice, $mois, $dateD, $dateF);

        foreach ($facture as $facture) {
          $produit += $facture->Quantite;
          $ca += ($facture->Quantite * $facture->Prix_detail);
        }

        if ($page) {
          $link_page = $page->Lien_page;
          $page_name = $page->Nom_page;
        } else {
          $link_page = "";
          $page_name = "";
        }
        $totalclient += count($data);
        $totalpubli += count($publica);
        $totalpro += $produit;
        $totalrep += count($sender);

        $content .= "<tr style='font-size:12px'><td><a href='' class='lienn'>" . substr($datas->operatrice, 0, 7) . "</a></td><td 'style=width:100px'><a href='" . $link_page . "' target='_blank'>" . $page_name . "</a></td><td style=width:100px class='text-center'><a href='" . base_url("controlleur/detail_publication/" . $datas->operatrice . "/" . $mois) . "' class='link1 timeline'>" . count($publica) . "</a></td><td style=width:100px class='text-center'><a href='" . base_url("controlleur/liste_clients/" . $datas->operatrice . "/" . $mois) . "' class='link1 timeline'>" . count($data) . "</a></td><td style=width:100px class='text-center'>" . count($sender) . "</td><td style=width:100px class='text-center'><a href='#' class='linky produit'>" . $produit . "</a></td></tr>";
        ///////////////////////////////////////////////////////////MENSUEL/////////////////////////////////////////////////////////////////////////
      }
      $data = ['totalclient' => $totalclient, 'totalpubli' => $totalpubli, 'totalpro', 'date' => $date, 'datas' => $content, 'mensuel' => $this->etat_mensuel_ca($mois, $datas->operatrice, $dateD, $dateF), 'discussion' => $this->discussion($datas->operatrice, $date), 'etatvente' => $this->etat_vent($date), 'cajour' => $this->ca_jour($datas->operatrice, $date)];
    }

    $this->render_view('Controlleur/acceuil', $data);
  }

  public function etat_mensuel_ca($mois, $operatrice, $dateD, $dateF)
  {
    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    if ($this->session->userdata('designation') == "Controlleur") {
      $dateD = $this->input->post('dateAutre1');
      $dateF = $this->input->post('dateAutre2');
      if (isset($dateD) and isset($dateF)) {
        $dateD = $this->input->post('dateAutre1');
        $dateF = $this->input->post('dateAutre2');
        $mois = null;
      } else {
        $dateD = null;
        $dateF = null;
        $now   = new DateTime;
        $mois = $now->format('Y-m');
      }
      $content = "";
      $entete = array('cavpL' => 0, 'reponse' => 0, 'ca' => 0, 'CA_VB' => 0, 'CA_VBL' => 0, 'cal' => 0, 'totalratio' => 0, 'cavpt' => 0, 'date1' => 0, 'date2' => 0);
      $datas = $this->global_model->table_resume2($mois, $dateD, $dateF);
      $cvp = 0;
      $cvpl = 0;
      $caglo = 0;
      $caop = 0;
      $caopl = 0;
      foreach ($datas as $key => $datas) {
        $data = array();
        $produit = 0;
        $cagl = 0;
        $cal = 0;

        $ratio = 0;

        $data = $this->global_model->table_rapport2($mois, $datas->operatrice, $dateD, $dateF);
        $facture = $this->global_model->ca_facture_opl2($mois, $datas->operatrice, $dateD, $dateF);
        $user = $this->global_model->user($datas->operatrice);
        $page = $this->global_model->groupeuser($datas->operatrice);
        $cavp = $this->global_model->chiffre_d_affaires_VP($mois, $datas->operatrice, $dateD, $dateF);
        $cavb = $this->global_model->sommeFacebook($mois, $datas->operatrice, $dateD, $dateF);
        $cavpl = $this->global_model->chiffre_d_affaires_VPL($mois, $datas->operatrice, $dateD, $dateF);
        $cavbl = $this->global_model->chiffre_d_affaires_VBL($mois, $datas->operatrice, $dateD, $dateF);
        foreach ($facture as $facture) {
          $produit += $facture->Quantite;
          $cagl += ($facture->Quantite * $facture->Prix_detail);
        }

        if ($page) {
          $link_page = $page->Lien_page;
          $page_name = $page->Nom_page;
        } else {
          $link_page = "";
          $page_name = "";
        }

        if (($cavbl['Montant']) != 0 and ($cavb['Montant']) != 0) {
          $ratio = ((($cavbl['Montant']) * 100) / ($cavb['Montant']));
        } else {
          $ratio = 0;
        }


        $content .= "<tr ><td class='collapse'>" . $datas->operatrice . "</td><td><a href='#' class='lienn produit'>" . substr($datas->operatrice, 0, 7) . "</a></td><td class='text-center' style='width:100px;'>" . number_format($cagl, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($cavb['Montant'], 0, ',', ' ') . "<br>" . number_format($cavbl['Montant'], 0, ',', ' ') . "</td><td class='text-center'>" . number_format($cavp['Montant'], 0, ',', ' ') . "<br>" . number_format($cavpl['Montant'], 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ratio, 2, ',', ' ') . "%</td></tr>";

        $caglo += $cagl;
        $caop += $cavb['Montant'];
        $caopl += $cavbl['Montant'];
        $cvp += $cavp['Montant'];
        $cvpl += $cavpl['Montant'];
      }
    }


    $data = ['entete' => $entete, 'data' => $content, 'date' => $dateD, 'caglo' => $caglo, 'caop' => $caop, 'caopl' => $caopl, 'cvp' => $cvp, 'cvpl' => $cvpl];

    return $data;
  }
  public function discussion()
  {

    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }


    $content = "";
    $entete = array('totaLclient' => 0, 'reponse' => 0, 'ca' => 0, 'NBProduit' => 0, 'totalpublication' => 0, 'cal' => 0);
    $datas = $this->global_model->table_resume($date);
    foreach ($datas as $key => $datas) {
      $data = array();
      $produit = 0;
      $ca = 0;
      $publi = 0;
      $caL = 0;
      $data = $this->global_model->table_rapport($date, $datas->operatrice);
      $facture = $this->global_model->ca_facture_opl($datas->operatrice, $date);
      $user = $this->global_model->user($datas->operatrice);
      $sender = $this->global_model->repopl($date, $datas->operatrice);
      $page = $this->global_model->groupeuser($datas->operatrice);
      $publica = $this->global_model->reppublication($datas->operatrice, $date);
      $calivre = $this->global_model->ca_facture_oplivre($datas->operatrice, $date);
      $nb = $this->calendrier_model->cont_resultArrays($date, 'previ', $datas->operatrice);
      foreach ($facture as $facture) {
        $produit += $facture->Quantite;
        $ca += ($facture->Quantite * $facture->Prix_detail);
      }
      foreach ($calivre as $calivre) {
        $caL += ($calivre->Quantite * $calivre->Prix_detail);
      }
      if ($page) {
        $link_page = $page->Lien_page;
        $page_name = $page->Nom_page;
      } else {
        $link_page = "";
        $page_name = "";
      }
      $content .= "<tr style='font-size:11px'><td><a href='" . base_url("controlleur/detail_discussion_operatrice/" . $datas->operatrice . "/" . $date) . "' class='link1 timeline'  target='_blank'>" . substr($datas->operatrice, 0, 7) . "</a></td><td style='width:50px; class='text-rigth'><a href='" . $link_page . "' target='_blank'>" . $page_name . "</a></td><td style='width:40px' class='text-center'><a href='" . base_url("controlleur/detail_publication/" . $datas->operatrice . "/" . $date) . "' class='link1 timeline' target='_blank'>" . count($publica) . "</a></td><td class='text-center'><a href='" . base_url("controlleur/liste_clients/" . $datas->operatrice . "/" . $date) . "' class='link1 timeline' target='_blank'>" . count($data) . "</a></td><td style='width:30px' class='text-center'>" . count($sender) . "</td><td class='text-center'><a href='" . base_url("controlleur/detail_vente_commerciale/" . $datas->operatrice . "/" . $date) . "' target='_blank'>" . $nb . "</a></td></tr>";
      $entete['totaLclient'] += count($data);
      $entete['reponse'] += count($sender);
      $entete['ca'] += $ca;
      $entete['cal'] += $caL;
      $entete['NBProduit'] += $produit;
      $entete['totalpublication'] += count($publica);
    }
    $data = ['entete' => $entete, 'data' => $content, 'date' => $date];

    return $data;
  }

  public function etat_vent($date = false)
  {
    if ($date == false) {
      $date = date('Y-m-d');
    }
    $datet = $this->input->post('dateAutre');
    $text = array('en_attente' => 'EN ATT', 'confirmer' => 'CONF', 'annule' => 'ANNU', 'livre' => 'LIV', 'reppoter' => 'REPP');
    $french_days = array('lun', 'mar', 'mer', 'jeu', 'ven', 'sam', 'dim');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    $this->load->model('calendrier_model');
    if ($this->session->userdata('designation') == "Controlleur") {
      $i = 0;
      $entete = array('totaLsom' => 0);
      $content = "";
      $datas = $this->global_model->etat_vente($date);
      $datax = $datas;
      $data = array();
      $total = 0;
      $livre = 0;
      $catotal = 0;
      $en_attente = 0;
      $annule = 0;
      $confirmer = 0;
      $ca = array();
      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'livre')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'livre') as $key => $value) {
          $livre += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['livre'])) {
            $dataUser[$value->Matricule_personnel]['livre'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['livre'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }

      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'en_attente')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'en_attente') as $key => $value) {
          $en_attente += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['en_attente'])) {
            $dataUser[$value->Matricule_personnel]['en_attente'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['en_attente'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }

      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'annule')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'annule') as $key => $value) {
          $annule += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['annule'])) {
            $dataUser[$value->Matricule_personnel]['annule'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['annule'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }

      if ($this->calendrier_model->ca_de_vente_controlleur($date, 'confirmer')) {
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date, 'confirmer') as $key => $value) {
          $confirmer += ($value->Quantite * $value->Prix_detail);
          if (!isset($dataUser[$value->Matricule_personnel]['confirmer'])) {
            $dataUser[$value->Matricule_personnel]['confirmer'] = $value->Quantite * $value->Prix_detail;
          } else {
            $dataUser[$value->Matricule_personnel]['confirmer'] += $value->Quantite * $value->Prix_detail;
          }
        }
      }
      foreach ($datax as $key => $datax) {
        if (array_key_exists($datax->date_de_livraison, $ca)) {
          foreach ($this->calendrier_model->ca_facture($datax->Id) as $commande) {
            $ca[$datax->date_de_livraison] += $commande->Quantite * $commande->Prix_detail;
          }
        } else {
          $ca[$datax->date_de_livraison] = 0;
          foreach ($this->calendrier_model->ca_facture($datax->Id) as $commande) {
            $ca[$datax->date_de_livraison] += $commande->Quantite * $commande->Prix_detail;
          }
        }

        if (!in_array($datax->date_de_livraison, $data)) {
          $data[$i] = $datax->date_de_livraison;
          $i++;
        }
      }
      sort($data);
      foreach ($data as $data) {
        $content .= "<tr'><td style='width:20px'class='text-danger' style='font-size:9px' colspan='2'>" . $this->dateToFrench($data, 'l j F Y') . "</td><td></td><td></td><td></td><td class='text-danger' style='font-size:10px'><b>" . number_format($ca[$data], 0, ',', ' ') . "</b></td></tr>";
        $datadate = $this->global_model->detail_etat_vente_facture($date, $data);

        foreach ($datadate as $key => $datadate) {
          $produit = "";
          $prix = "";
          foreach ($this->calendrier_model->ca_facture($datadate->Id) as $commande) {
            //$resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
            $produit .= $commande->Designation . '<br/>';
            $prix .= number_format($commande->Quantite * $commande->Prix_detail, 0, ',', ' ') . ' <br/>';
          }
          $codeCodevlient = $this->calendrier_model->detail_client($datadate->Code_client);
          $mission = $datadate->Id_de_la_mission;
          if (strstr($codeCodevlient->Commercial, "VP")) {
            $facture = $this->global_model->testFactureLocalite($codeCodevlient->Commercial, $data);
            if ($facture) {
              $mission = $facture->Id_de_la_mission;
            }
          }
          if ($datadate) {
            $COMM = $datadate->Ress_sec_oplg;
          } else {
            $COMM = "";
          }
          if ($text[$datadate->Status] == 'EN ATT' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td style='width:20px'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td style='width:20px' class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td style='width:20px'>" . $COMM . "</td><td class='text-center' style='width=40px'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:2px 7px;border-radius:2px;width:20px;font-size:8px'>" . strtoupper(substr($mission, 0, 10)) . "</td><td class='text-center'><row style='background-color:#FF8800;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:8px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'LIV' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td style='width:20px'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td style='width:20px' class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td style='width:20px'>" . $COMM . "</td><td class='text-center' style='width=40px'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:2px 7px;border-radius:2px;width:20px;font-size:8px'>" . strtoupper(substr($mission, 0, 10)) . "</td><td class='text-center'><row style='background-color:#00C851;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:8px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'ANNU' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td style='width:20px'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td style='width:20px' class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td style='width:20px'>" . $COMM . "</td><td class='text-center' style='width=40px'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:2px 7px;border-radius:2px;width:20px;font-size:8px'>" . strtoupper(substr($mission, 0, 10)) . "</td><td class='text-center'><row style='background-color:#CC0000;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:8px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'CONF' and substr($mission, 0, 20) != 'FACEBOOK') {
            $content .= "<tr><td style='width:20px'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td style='width:20px' class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td style='width:20px'>" . $COMM . "</td><td class='text-center' style='width=40px'>" . $prix . "</td><td><row style='background-color:#6d4c41;color:#fff;padding:2px 7px;border-radius:2px;width:20px;font-size:8px'>" . strtoupper(substr($mission, 0, 10)) . "</td><td class='text-center'><row style='background-color:#9933CC;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:8px'>" . $text[$datadate->Status] . "</td></tr>";
          }
          if ($text[$datadate->Status] == 'EN ATT' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td style='width:20px'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td style='width:20px' class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td style='width:20px'>" . $COMM . "</td><td class='text-center' style='width=40px'>" . $prix . "</td><td style='font-size:10px,width:20px'>" . strtoupper(substr($mission, 0, 10)) . "</td><td class='text-center'><row style='background-color:#FF8800;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:8px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'LIV' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td style='width:20px'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td style='width:20px' class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td style='width:20px'>" . $COMM . "</td><td class='text-center' style='width=40px'>" . $prix . "</td><td style='font-size:10px,width:20px'>" . strtoupper(substr($mission, 0, 10)) . "</td><td class='text-center'><row style='background-color:#00C851;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:8px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'ANNU' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td style='width:20px'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td style='width:20px' class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td style='width:20px'>" . $COMM . "</td><td class='text-center' style='width=40px'>" . $prix . "</td><td style='font-size:10px,width:20px'>" . strtoupper(substr($mission, 0, 10)) . "</td><td class='text-center'><row style='background-color:#CC0000;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:8px'>" . $text[$datadate->Status] . "</td></tr>";
          } elseif ($text[$datadate->Status] == 'CONF' and substr($mission, 0, 20) == 'FACEBOOK') {
            $content .= "<tr><td style='width:20px'><a href='#' class='nom produit'>" . $datadate->Code_client . "</a></td><td style='width:20px' class='text-center'>" . substr($datadate->Matricule_personnel, 0, 7) . "</td><td style='width:20px'>" . $COMM . "</td><td class='text-center' style='width=40px'>" . $prix . "</td><td style='font-size:10px,width:20px'>" . strtoupper(substr($mission, 0, 10)) . "</td><td class='text-center'><row style='background-color:#9933CC;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:8px'>" . $text[$datadate->Status] . "</td></tr>";
          }
        }
        $entete['totaLsom'] += $ca[$data];
        $catotal += $ca[$data];
      }


      $data = ['data' => $content, 'entete' => $entete, 'date' => $date, 'livre' => $livre, 'en_attente' => $en_attente, 'annule' => $annule, 'confirmer' => $confirmer, 'catotal' => $catotal,];
    }

    return $data;
  }
  public function ca_jour()
  {

    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }


    $content = "";
    $entete = array('totaLclient' => 0, 'reponse' => 0, 'cag' => 0, 'NBProduit' => 0, 'totalpublication' => 0, 'cal' => 0);
    $datas = $this->global_model->table_resume($date);
    $total = 0;
    $totalpro = 0;
    foreach ($datas as $key => $datas) {
      $data = array();
      $produit = 0;
      $caf = 0;
      $publi = 0;
      $caL = 0;
      $caT = 0;

      //$data=$this->global_model->table_rapport($date,$datas->operatrice);
      $facture = $this->global_model->ca_facture_opl($datas->operatrice, $date);
      $user = $this->global_model->user($datas->operatrice);
      $page = $this->global_model->groupeuser($datas->operatrice);
      $calivre = $this->global_model->ca_facture_oplivre($datas->operatrice, $date);
      $nb = $this->calendrier_model->cont_resultArrays($date, 'previ', $datas->operatrice);
      foreach ($facture as $facture) {
        $produit += $facture->Quantite;
        $caf += ($facture->Quantite * $facture->Prix_detail);
      }
      /* foreach($calivre as $calivre){
        $caL+=($calivre->Quantite*$calivre->Prix_detail);	
      }*/
      if ($page) {
        $link_page = $page->Lien_page;
        $page_name = $page->Nom_page;
      } else {
        $link_page = "";
        $page_name = "";
      }
      $content .= "<tr style='font-size:12px' style='width:160px'><td class='collapse'>" . $datas->operatrice . "</td><td><a href='#' class='lienn '>" . substr($datas->operatrice, 0, 7) . "</a></td><td style='width:50px'><a href='" . $link_page . "' target='_blank'>" . strtoupper($page_name) . "</a></td><td class='text-center' style='width:60px'>" . number_format($caf, 0, ',', ' ') . "</td><td class='text-center'><a href='#' class='link produit'>" . $produit . "</a></td></tr>";
      $total += $caf;
      $totalpro += $produit;
    }
    $data = ['entete' => $entete, 'data' => $content, 'date' => $date, 'caT' => $total, 'pro' => $totalpro];

    return $data;
  }
  /*public function page()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datas = $this->global_model->page();
    if ($datas) {
      $data['message'] = true;
      $content = "";
      foreach ($datas as $datas) {
        $content .= "<tr>";
        $content .= "<td>" . $datas->id . "</td><td>" . $datas->operatrice . "</td><td class='text-center'>" . $datas->Nom_page . "</td><td class='text-center'>" . $datas->statut . "</td><td class='text-center'><input class='form-check-input check' type='radio' name='check'></td>";
        $content .= "</tr>";
      }
      $data = [
        'data' => $content
      ];
    }
    $this->render_view('Controlleur/page', $data);
  }*/
  public function pages()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datas = $this->global_model->page_actives();
    if ($datas) {
      $data['message'] = true;
      $content = "";
      foreach ($datas as $datas) {
        $content .= "<tr>";
        $content .= "<td>" . $datas->id . "</td><td class='text-center'>" . $datas->operatrice . "</td><td class='text-center'>" . strtoupper($datas->Nom_page) . "</td><td class='text-center'>" . $datas->statut . "</td><td class='text-center'><input class='form-check-input check' type='radio' name='check'></td>";
        $content .= "</tr>";
      }
      $data = ['datas' => $content, 'passives' => $this->pages_passives()];
    }
    $this->render_view('Controlleur/pages', $data);
  }

  public function pages_passives()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datas = $this->global_model->page_passive();
    if ($datas) {
      $data['message'] = true;
      $content = "";
      foreach ($datas as $datas) {
        $content .= "<tr>";
        $content .= "<td>" . $datas->id . "</td><td class='text-center'>" . $datas->operatrice . "</td><td class='text-center'>" . strtoupper($datas->Nom_page) . "</td><td class='text-center'>" . $datas->statut . "</td><td class='text-center'><input class='form-check-input check' type='radio' name='check'></td>";
        $content .= "</tr>";
      }
      $data = [
        'data' => $content
      ];
    }
    return $data;
  }
  public function modif_satatutPage()
  {
    $this->load->model('global_model');
    $this->global_model->modif_satatutPage($this->input->post('Id'), $this->input->post('statut'));
  }

  public function enregister_page()
  {
    $this->load->model('global_model');
    $id = $this->input->post('Id');
    $data = [
      'statut' => $this->input->post('statut'),
      //'check'=>$this->input->post('choix')
    ];
    $this->global_model->enregister_remarque($id, $data);
    echo json_encode(array('message' => true));
  }
  public function discussions($date = FALSE, $type = FALSE, $opls = FALSE)
  {

    $content = "";
    $total = 0;
    $data = array();
    $datas = $this->global_model->table_resume(date('Y-m-d'));
    foreach ($datas as $key => $datas) {
      $page = $this->global_model->groupeuser($datas->operatrice);
      $type = $this->global_model->repopll($datas->operatrice);
      $asuivre = $this->global_model->asuivre(date('Y-m-d'), $datas->operatrice);
      $terminer = $this->global_model->terminer(date('Y-m-d'), $datas->operatrice);
      $enattente = $this->global_model->en_attente(date('Y-m-d'), $datas->operatrice);
      if ($page) {
        $page_name = $page->Nom_page;
      } else {
        $page_name = "";
      }
      $total = (count($asuivre) + count($terminer) + count($enattente));

      $content .= "<tr><td class='text-center'>" . substr($datas->operatrice, 0, 7) . "</td><td class='text-center'>" . strtoupper($page_name) . "</td><td class='text-center'>" . count($enattente) . "</td><td class='text-center'>" . count($asuivre) . "</td><td class='text-center'>" . count($terminer) . "</td><td class='text-center' >" . $total . "</td><td class='text-center'><a href='" . base_url("controlleur/listeclients/" . $datas->operatrice . "/" . $date) . "' class='link1 timeline'><b>+</b></a></td></tr>";
    }
    $data = ['data' => $content];
    $this->render_view('Controlleur/discussions', $data);
  }
  public function listeclients($user, $date = FALSE)
  {
    $this->load->model('global_model');
    $donne = array();
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $i = 0;
    $reponse = $this->global_model->table_listeclients($date, $user);
    $statut = $this->global_model->statut($date, $user);
    foreach ($reponse as  $reponse) {

      $donne[$i]['id_discussion'] = $this->global_model->details_discu($reponse->client, $user, $date);
      $donne[$i]['Code_client'] = $reponse->client;
      $donne[$i]['detail'] = $this->global_model->retourClient($reponse->client);
      $donne[$i]['client'] = $reponse->client;
      $donne[$i]['statut'] = $this->statut($reponse->client, $user, $date);
      $i++;
    }

    $data = [
      'data' => $donne,
      'statut' => $statut,
      'user' => $user,
      'date' => $date

    ];
    $this->render_view('Controlleur/discussion/liste_clients', $data);
  }
  public function ca()
  {

    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }
    $mois = date('Y-m');

    $dt = new dateTime();
    $dt1 = new dateTime();
    $dt2 = new dateTime();
    $dt3 = new dateTime();
    $dt4 = new dateTime();
    $dt5 = new dateTime();
    $month = new DateTime();
    $dt->modify('-1day');
    $dt1->modify('-2day');
    $dt2->modify('-3day');
    $dt3->modify('-4day');
    $dt4->modify('-5day');
    $dt5->modify('-6day');
    $month->modify('-1month');
    $dat = $dt->format("Y-m-d");
    $dat1 = $dt1->format("Y-m-d");
    $dat2 = $dt2->format("Y-m-d");
    $dat3 = $dt3->format("Y-m-d");
    $dat4 = $dt4->format("Y-m-d");
    $dat5 = $dt5->format("Y-m-d");
    $month1 = $month->format("Y-m");
    $content = "";
    $tca3 = 0;
    $tca2 = 0;
    $tca1 = 0;
    $tca = 0;
    $cajour = 0;
    $camois = 0;
    $tca4 = 0;
    $tcamonth = 0;
    $tca5 = 0;
    $datas = $this->global_model->table_ca1($mois);


    foreach ($datas as $key => $datas) {
      $data = array();
      $produit = 0;
      $caf = 0;
      $cam = 0;
      $caj = 0;
      $ca1 = 0;
      $ca2 = 0;
      $ca3 = 0;
      $ca4 = 0;
      $ca5 = 0;
      $camonth = 0;

      $facture = $this->global_model->ca_opl($datas->Prenom, $date);
      $factur = $this->global_model->ca_facture_op($mois, $datas->Prenom);
      $facturr = $this->global_model->ca_facture_mois_passe($month1, $datas->Prenom);
      $fact = $this->global_model->ca_facture_jour_passe($dat, $datas->Prenom);
      $fact1 = $this->global_model->ca_facture_jour1($dat1, $datas->Prenom);
      $fact2 = $this->global_model->ca_facture_jour2($dat2, $datas->Prenom);
      $fact3 = $this->global_model->ca_facture_jour3($dat3, $datas->Prenom);
      $fact4 = $this->global_model->ca_facture_jour4($dat4, $datas->Prenom);
      $fact5 = $this->global_model->ca_facture_jour5($dat5, $datas->Prenom);
      //$user = $this->global_model->user($datas->operatrice);
      foreach ($facture as $facture) {
        $produit += $facture->Quantite;
        $caf += ($facture->Quantite * $facture->Prix_detail);
      }
      foreach ($factur as $factur) {
        $cam += ($factur->Quantite * $factur->Prix_detail);
      }
      foreach ($fact as $fact) {
        $caj += ($fact->Quantite * $fact->Prix_detail);
      }
      foreach ($fact1 as $fact1) {
        $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
      }
      foreach ($fact2 as $fact2) {
        $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
      }
      foreach ($fact3 as $fact3) {
        $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
      }
      foreach ($fact4 as $fact4) {
        $ca4 += ($fact4->Quantite * $fact4->Prix_detail);
      }
      foreach ($fact5 as $fact5) {
        $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
      }
      foreach ($facturr as $facturr) {
        $camonth += ($facturr->Quantite * $facturr->Prix_detail);
      }
      $content .= "<tr text><td>" . substr($datas->Matricule, 0, 7) . "</td><td>" . strtoupper($datas->Prenom) . "</td><td class='text-center'>" . number_format($ca5, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ca4, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ca3, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ca2, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ca1, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($caj, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($caf, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($cam, 0, ',', ' ') . "</td></tr>";
      $tca5 += $ca5;
      $tca4 += $ca4;
      $tca3 += $ca3;
      $tca2 += $ca2;
      $tca1 += $ca1;
      $tca += $caj;
      $cajour += $caf;
      $camois += $cam;
      $tcamonth += $camonth;
    }
    $data = ['data' => $content, 'tcamonth' => $tcamonth, 'tca5' => $tca5, 'dat' => $dat, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour, 'camois' => $camois, 'tca4' => $tca4];

    $this->render_view('Controlleur/ca', $data);
  }
  public function client_relance($user = FALSE, $date = FALSE)
  {
    $this->load->model('global_model');
    $donne = array();
    if ($date == FALSE) {
      $date = date('Y-m-d');
    }
    $i = 0;
    $reponse = $this->global_model->table_listeclients($date, $user);
    $statut = $this->global_model->statut($date, $user);
    foreach ($reponse as  $reponse) {
      $donne[$i]['id_discussion'] = $this->global_model->details_discu($reponse->client, $user, $date);
      $donne[$i]['Code_client'] = $reponse->client;
      $donne[$i]['detail'] = $this->global_model->retourClient($reponse->client);
      $donne[$i]['client'] = $reponse->client;
      $i++;
    }
    $data = [
      'data' => $donne,
      'statut' => $statut,
      'user' => $user,
      'date' => $date
    ];
    $this->render_view('Controlleur/client_relance');
  }
  public function calivre()
  {

    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }
    $mois = date('Y-m');

    $dt = new dateTime();
    $dt1 = new dateTime();
    $dt2 = new dateTime();
    $dt3 = new dateTime();
    $dt4 = new dateTime();
    $dt5 = new dateTime();
    $month = new DateTime();
    $dt->modify('-1day');
    $dt1->modify('-2day');
    $dt2->modify('-3day');
    $dt3->modify('-4day');
    $dt4->modify('-5day');
    $dt5->modify('-6day');
    $month->modify('-1month');
    $dat = $dt->format("Y-m-d");
    $dat1 = $dt1->format("Y-m-d");
    $dat2 = $dt2->format("Y-m-d");
    $dat3 = $dt3->format("Y-m-d");
    $dat4 = $dt4->format("Y-m-d");
    $dat5 = $dt5->format("Y-m-d");
    $month1 = $month->format("Y-m");
    $content = "";
    $tca3 = 0;
    $tca2 = 0;
    $tca1 = 0;
    $tca = 0;
    $cajour = 0;
    $camois = 0;
    $tca4 = 0;
    $tca5 = 0;
    $tcamonth = 0;
    $datas = $this->global_model->table_ca1($mois);


    foreach ($datas as $key => $datas) {
      $data = array();
      $produit = 0;
      $caf = 0;
      $cam = 0;
      $caj = 0;
      $ca1 = 0;
      $ca2 = 0;
      $ca3 = 0;
      $ca4 = 0;
      $ca5 = 0;
      $camonth = 0;

      $facture = $this->global_model->ca_oplivre($datas->Prenom, $dat4);
      $factur = $this->global_model->ca_facture_oplivr($mois, $datas->Prenom);

      $fact3 = $this->global_model->ca_facture_jour3l($dat3, $datas->Prenom);
      $fact2 = $this->global_model->ca_facture_jour2l($dat2, $datas->Prenom);
      $fact1 = $this->global_model->ca_facture_jour1($dat1, $datas->Prenom);
      $fact4 = $this->global_model->ca_facture_jour($date, $datas->Prenom);
      $fact = $this->global_model->ca_facture_jour_passel($dat, $datas->Prenom);
      $fact5 = $this->global_model->ca_facture5($dat5, $datas->Prenom);
      foreach ($fact as $fact) {
        $caj += ($fact->Quantite * $fact->Prix_detail);
      }
      foreach ($fact5 as $fact5) {
        $ca5 += ($fact5->Quantite * $fact5->Prix_detail);
      }
      foreach ($fact4 as $fact4) {
        $caf += ($fact4->Quantite * $fact4->Prix_detail);
      }
      foreach ($fact1 as $fact1) {
        $ca1 += ($fact1->Quantite * $fact1->Prix_detail);
      }
      foreach ($fact2 as $fact2) {
        $ca2 += ($fact2->Quantite * $fact2->Prix_detail);
      }
      foreach ($factur as $factur) {
        $cam += ($factur->Quantite * $factur->Prix_detail);
      }
      foreach ($facture as $facture) {
        $ca4 += ($facture->Quantite * $facture->Prix_detail);
      }
      foreach ($fact3 as $fact3) {
        $ca3 += ($fact3->Quantite * $fact3->Prix_detail);
      }
      $content .= "<tr text><td>" . substr($datas->Matricule, 0, 7) . "</td><td>" . strtoupper($datas->Prenom) . "</td><td class='text-center'>" . number_format($ca5, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ca4, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ca3, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ca2, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($ca1, 0, ',', ' ') . "</td><td>" . number_format($caj, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($caf, 0, ',', ' ') . "</td><td class='text-center'>" . number_format($cam, 0, ',', ' ') . "</td></tr>";
      $tca5 += $ca5;
      $tca4 += $ca4;
      $tca3 += $ca3;
      $tca2 += $ca2;
      $tca1 += $ca1;
      $tca += $caj;
      $cajour += $caf;
      $camois += $cam;
      $tcamonth += $camonth;
    }
    $data = ['data' => $content, 'tcamonth' => $tcamonth, 'dat' => $dat, 'tca5' => $tca5, 'tca3' => $tca3, 'tca2' => $tca2, 'tca1' => $tca1, 'tca' => $tca, 'cajour' => $cajour, 'camois' => $camois, 'tca4' => $tca4];

    $this->render_view('Controlleur/calivre', $data);
  }
  public function semaine()
  {
    $data = [

      "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre")

    ];

    $this->render_view('Controlleur/semaine', $data);
  }
  public function week()
  {
    $data = [

      "mois" =>  array('01' => "Janvier", '02' => "Fervier", '03' => "Mars", '04' => "Avril", '05' => "Mai", '06' => "Juin", '07' => "Juillet", '08' => "Août", '09' => "Septembre", '10' => "Octobre", '11' => "Novembre", '12' => "Decembre")

    ];


    $this->render_view('Controlleur/week', $data);
  }
  public function dataWeek()
  {


    $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Août" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
    $parametre = $this->input->post('mois');
    $tes = 0;
    $te = 0;
    $t = 0;
    $tesx = 0;
    $test = 0;
    $dateD = date($mo[$parametre] . '-01');
    $dateF = date($mo[$parametre] . '-07');
    $facture = $this->global_model->S3(date($mo[$parametre] . '-01'), date($mo[$parametre] . '-07'));
    $factur = $this->global_model->S3(date($mo[$parametre] . '-08'), date($mo[$parametre] . '-14'));
    $factu = $this->global_model->S3(date($mo[$parametre] . '-15'), date($mo[$parametre] . '-21'));
    $fact = $this->global_model->S3(date($mo[$parametre] . '-22'), date($mo[$parametre] . '-31'));
    $fac = $this->global_model->S3(date($mo[$parametre] . '-01'), date($mo[$parametre] . '-31'));
    foreach ($facture as $facture) {
      $tes += ($facture->Quantite * $facture->Prix_detail);
    }
    foreach ($factur as $factur) {
      $te += ($factur->Quantite * $factur->Prix_detail);
    }
    foreach ($factu as $factu) {
      $t += ($factu->Quantite * $factu->Prix_detail);
    }
    foreach ($fact as $fact) {
      $tesx += ($fact->Quantite * $fact->Prix_detail);
    }
    foreach ($fac as $fac) {
      $test += ($fac->Quantite * $fac->Prix_detail);
    }


    $data = [

      "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"),
      "tes" => number_format($tes, 0, ',', ' '),
      "te" => number_format($te, 0, ',', ' '),
      "t" => number_format($t, 0, ',', ' '),
      "tesx" => number_format($tesx, 0, ',', ' '),
      "test" => number_format($test, 0, ',', ' ')

    ];

    echo json_encode($data);
  }

  public function dataWeeks()
  {


    $mo = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Août" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
    $parametre = $this->input->post('mois');
    $tes = 0;
    $te = 0;
    $t = 0;
    $tesx = 0;
    $test = 0;
    $dateD = date($mo[$parametre] . '-01');
    $dateF = date($mo[$parametre] . '-07');
    $facture = $this->global_model->W3(date($mo[$parametre] . '-01'), date($mo[$parametre] . '-07'));
    $factur = $this->global_model->W3(date($mo[$parametre] . '-08'), date($mo[$parametre] . '-14'));
    $factu = $this->global_model->W3(date($mo[$parametre] . '-15'), date($mo[$parametre] . '-21'));
    $fact = $this->global_model->W3(date($mo[$parametre] . '-22'), date($mo[$parametre] . '-31'));
    $fac = $this->global_model->W3(date($mo[$parametre] . '-01'), date($mo[$parametre] . '-31'));
    foreach ($facture as $facture) {
      $tes += ($facture->Quantite * $facture->Prix_detail);
    }
    foreach ($factur as $factur) {
      $te += ($factur->Quantite * $factur->Prix_detail);
    }
    foreach ($factu as $factu) {
      $t += ($factu->Quantite * $factu->Prix_detail);
    }
    foreach ($fact as $fact) {
      $tesx += ($fact->Quantite * $fact->Prix_detail);
    }
    foreach ($fac as $fac) {
      $test += ($fac->Quantite * $fac->Prix_detail);
    }


    $data = [

      "mois" =>  array("Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"),
      "tes" => number_format($tes, 0, ',', ' '),
      "te" => number_format($te, 0, ',', ' '),
      "t" => number_format($t, 0, ',', ' '),
      "tesx" => number_format($tesx, 0, ',', ' '),
      "test" => number_format($test, 0, ',', ' ')

    ];

    echo json_encode($data);
  }

  public function S1()
  {

    $dateD = date('Y-m-1');
    $dateF = date('Y-m-7');
    $mois = date('Y-m');
    $content = "";
    $datas = $this->global_model->table_ca1($mois);
    foreach ($datas as $row) {
      $ca = 0;
      $facture = $this->global_model->S1($dateD, $dateF, $row->Prenom);
      foreach ($facture as $facture) {
        $ca += ($facture->Quantite * $facture->Prix_detail);
      }
      $sub_array = array();
      $sub_array[] = substr($row->Matricule_personnel, 0, 7);
      $sub_array[] = strtoupper($row->Prenom);
      $sub_array[] =  number_format($ca, 0, ',', ' ');
      $sub_array[] =  number_format($this->S2(date('Y-m-8'), date('Y-m-17'), $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->S2(date('Y-m-15'), date('Y-m-21'), $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->S2(date('Y-m-22'), date('Y-m-31'), $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->S2(date('Y-m-1'), date('Y-m-31'), $row->Prenom), 0, ',', ' ');
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function S2($dateD, $dateF, $Prenom)
  {
    $mois = date('Y-m');
    $content = "";
    $ca = 0;
    $facture = $this->global_model->S1($dateD, $dateF, $Prenom);
    foreach ($facture as $facture) {
      $ca += ($facture->Quantite * $facture->Prix_detail);
    }
    return $ca;
  }
  public function W1()
  {

    $dateD = date('Y-m-1');
    $dateF = date('Y-m-7');
    $mois = date('Y-m');
    $content = "";
    $datas = $this->global_model->table_ca1($mois);
    foreach ($datas as $row) {
      $ca = 0;
      $facture = $this->global_model->S2($dateD, $dateF, $row->Prenom);
      foreach ($facture as $facture) {
        $ca += ($facture->Quantite * $facture->Prix_detail);
      }
      $sub_array = array();
      $sub_array[] = substr($row->Matricule_personnel, 0, 7);
      $sub_array[] = strtoupper($row->Prenom);
      $sub_array[] =  number_format($ca, 0, ',', ' ');
      $sub_array[] =  number_format($this->W2(date('Y-m-8'), date('Y-m-13'), $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->W2(date('Y-m-15'), date('Y-m-21'), $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->W2(date('Y-m-22'), date('Y-m-31'), $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->W2(date('Y-m-1'), date('Y-m-31'), $row->Prenom), 0, ',', ' ');
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function W2($dateD, $dateF, $Prenom)
  {
    $mois = date('Y-m');
    $content = "";
    $ca = 0;
    $facture = $this->global_model->S2($dateD, $dateF, $Prenom);
    foreach ($facture as $facture) {
      $ca += ($facture->Quantite * $facture->Prix_detail);
    }
    return $ca;
  }
  public function month($s2)
  {

    $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Août" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
    $dateD = date($moi[$s2] . '-01');
    $dateF = date($moi[$s2] . '-07');
    $mois = $moi[$s2];
    $content = "";
    $datas = $this->global_model->table_ca1($mois);
    $data = array();
    foreach ($datas as $row) {
      $ca = 0;
      $facture = $this->global_model->S1($dateD, $dateF, $row->Prenom);
      foreach ($facture as $facture) {
        $ca += ($facture->Quantite * $facture->Prix_detail);
      }
      $sub_array = array();
      $sub_array[] =  substr($row->Matricule_personnel, 0, 7);
      $sub_array[] = strtoupper($row->Prenom);
      $sub_array[] =  number_format($ca, 0, ',', ' ');
      $sub_array[] =  number_format($this->S2($moi[$s2] . '-08', $moi[$s2] . '-14', $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->S2($moi[$s2] . '-15', $moi[$s2] . '-21', $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->S2($moi[$s2] . '-22', $moi[$s2] . '-31', $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->S2($moi[$s2] . '-01', $moi[$s2] . '-31', $row->Prenom), 0, ',', ' ');
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function months($s2)
  {

    $moi = array("Janvier" => date('Y') . "-01", "Fervier" => date('Y') . "-02", "Mars" => date('Y') . "-03", "Avril" => date('Y') . "-04", "Mai" => date('Y') . "-05", "Juin" => date('Y') . "-06", "Juillet" => date('Y') . "-07", "Août" => date('Y') . "-08", "Septembre" => date('Y') . "-09", "Octobre" => date('Y') . "-10", "Novembre" => date('Y') . "-11", "Decembre" => date('Y') . "-12");
    $dateD = date($moi[$s2] . '-01');
    $dateF = date($moi[$s2] . '-07');
    $mois = $moi[$s2];
    $content = "";
    $datas = $this->global_model->table_ca1($mois);
    $data = array();
    foreach ($datas as $row) {
      $ca = 0;
      $facture = $this->global_model->S2($dateD, $dateF, $row->Prenom);
      foreach ($facture as $facture) {
        $ca += ($facture->Quantite * $facture->Prix_detail);
      }
      $sub_array = array();
      $sub_array[] =  substr($row->Matricule_personnel, 0, 7);
      $sub_array[] = strtoupper($row->Prenom);
      $sub_array[] =  number_format($ca, 0, ',', ' ');
      $sub_array[] =  number_format($this->W2($moi[$s2] . '-08', $moi[$s2] . '-14', $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->W2($moi[$s2] . '-15', $moi[$s2] . '-21', $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->W2($moi[$s2] . '-22', $moi[$s2] . '-31', $row->Prenom), 0, ',', ' ');
      $sub_array[] =  number_format($this->W2($moi[$s2] . '-01', $moi[$s2] . '-31', $row->Prenom), 0, ',', ' ');
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function listedemande($date, $operatrice)
  {
    $this->load->model('global_model');

    $data = [
      'data' => $this->global_model->selectAmies($date, $operatrice)
    ];
    $this->render_view('operatrice/demande/liste', $data);
  }
 /* public function update()
  {
    return $this->db->query('UPDATE `discussion_content`
    INNER JOIN `discussion` ON `discussion_content`.`Id_discussion` = `discussion`.`id_discussion` 
    SET `discussion`.`operatrice`="VB20225" WHERE `discussion_content`.`Id` IN ("180578","180511","180662","180534","180713","182023","181279","181921")');
  }*/
}
