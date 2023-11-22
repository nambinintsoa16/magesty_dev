<?php
defined('BASEPATH') or exit('No direct script access allowed');
class service_clientel extends My_Controller
{

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Europe/Moscow');
    $this->load->helper('url');
    $this->load->library("pagination");
  }

  public function performance($matricule = FALSE)
  {
    $this->load->model('userservice_model');
    $data = [
      'data' => $this->userservice_model->performance($this->session->userdata('matricule'))
    ];
    $this->render_view('service_clientel/user/performance', $data);
  }
  public function Carte()
  {
    $this->render_view('service_clientel/carte/itineraire');
  }
  public function Etat_de_livraison()
  {
    $this->load->model('calendrier_model');
    $reponse = $this->calendrier_model->ca_de_vente_clientel(date('Y-m-d'), 'livre');
    $ca_du_jour = 0;
    $produit = 0;
    foreach ($reponse as $reponse) {
      $ca_du_jour += ($reponse->Prix_detail * $reponse->Quantite);
      $produit += $reponse->Quantite;
    }
    $data = [
      'ca_du_jour' => $ca_du_jour,
      'produit' => $produit

    ];
    $this->render_view('service_clientel/etat_de_livraison/livraisons', $data);
  }
  public function dataUrgence()
  {
    $nombre = 0;
    return $nombre;
  }


  public function Etat_de_livraison_du_mois()
  {
    $this->load->model('calendrier_model');
    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');

    if (!is_null($datedeb) && !is_null($datefin)) {
      $data['liste_vente_livre'] = $this->calendrier_model->ca_vente_livre_mois_rapport($datedeb, $datefin);
    } else {
      $data = ['liste_vente_livre' => []];
    }
    $this->render_view('service_clientel/etat_de_livraison/livraisons_mois', $data);
  }
  public function Etat_de_livraison_du_mois_data()
  {
    $this->load->model('calendrier_model');

    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');

    $data['liste_vente_livre'] = $this->calendrier_model->ca_vente_livre_mois_rapport($datedeb, $datefin);
    $this->load->view('service_clientel/etat_de_livraison/livraison_du_mois_data', $data);
  }

  public function Liste_clients_sans_achat()
  {
    $this->load->model('calendrier_model');
    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');
    if (!is_null($datedeb) && !is_null($datefin)) {
      $data['liste_vente_livre'] = $this->calendrier_model->getclientsansachat($datedeb, $datefin);
    } else {
      $data['liste_vente_livre'] = [];
    }
    $this->render_view('service_clientel/etat_de_livraison/liste_clients_sans', $data);
  }

  public function Liste_clients_sans_achat_data()
  {
    $this->load->model('calendrier_model');

    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');
    $data['liste_vente_livre'] = $this->calendrier_model->getclientsansachat($datedeb, $datefin);
    $this->load->view('service_clientel/etat_de_livraison/liste_clients_sans_data', $data);
    var_dump($data);
  }

  public function Clients_sans_achat()
  {
    $this->load->model('calendrier_model');
    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');

    if (!is_null($datedeb) && !is_null($datefin)) {
      $data['clientssansachat'] = $this->calendrier_model->Returnclientsansachat($datedeb, $datefin);
    } else {
      $data['clientssansachat'] = [];
    }

    $this->render_view('service_clientel/etat_de_livraison/sans_achat_new', $data);
  }


  public function Clients_sans_achat_data()
  {
    $this->load->model('calendrier_model');
    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');
    $data['clientssansachat'] = $this->calendrier_model->Returnclientsansachat($datedeb, $datefin);
    $this->load->view('service_clientel/etat_de_livraison/sans_achat_new_data', $data);
    var_dump($data);
  }

  public function Gain_koty_smiles()
  {

    $this->load->model('calendrier_model');
    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');

    if (!is_null($datedeb) && !is_null($datefin)) {
      $data['gainkotysmiles'] = $this->calendrier_model->getstatutclient($datedeb, $datefin);
    } else {
      $data['gainkotysmiles'] = [];
    }
    $this->render_view('service_clientel/etat_de_livraison/liste_client_staut', $data);
  }
  public function Gain_koty_smiles_data()
  {
    $this->load->model('calendrier_model');
    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');
    $data['gainkotysmiles'] = $this->calendrier_model->getstatutclient($datedeb, $datefin);
    $this->load->view('service_clientel/etat_de_livraison/liste_client_staut_data', $data);
  }

  public function Vente_annuel()
  {
    $this->load->model('calendrier_model');
    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');

    if (!is_null($datedeb) && !is_null($datefin)) {
      $data['ventelivreannuel'] = $this->calendrier_model->getachatclientannuel($datedeb, $datefin);
    } else {
      $data['ventelivreannuel'] = [];
    }

    $this->render_view('service_clientel/etat_de_livraison/liste_client_avec_achat2021', $data);
  }
  public function Vente_annuel_data()
  {
    $this->load->model('calendrier_model');
    $datedeb = $this->input->post('datedeb');
    $datefin = $this->input->post('datefin');
    $data['ventelivreannuel'] = $this->calendrier_model->getachatclientannuel($datedeb, $datefin);
    $this->load->view('service_clientel/etat_de_livraison/liste_client_avec_achat2021_data', $data);
  }
  /*
    public function Autre(){
        $this->render_view('service_clientel/Autre/autre');
    }
    */
  public function Note_de_livraison()
  {
    $this->load->model('calendrier_model');
    $livraisonEnAttante = $this->calendrier_model->livraisonEnAttante();
    $data = [
      'livraison' => $livraisonEnAttante,
      'totalCa' => $this->calendrier_model->TotaleVenteEnAttente()
    ];

    $this->render_view('service_clientel/note_de_livraison/etat_de_livraison', $data);
  }

  public function info_annulation()
  {
    $this->load->model('Calendrier_model');
    $datas = $this->calendrier_model->listeMotif_annuler();
    $this->render_view('service_clientel/info_annulation/relanceannule', ['datas' =>  $datas]);
  }
  public function calendrier()
  {

    $this->render_view('service_clientel/Autre/autre');
  }
  public function Livraison_combo()
  {
    $this->load->model('Livraison');
    $livraison = $this->Livraison->listeLivraison();
    $this->render_view('service_clientel/livraison_combo/previsionellecombo', ['data' =>  $livraison]);
  }
  public function Livraison_annule()
  {

    $this->render_view('service_clientel/info_annulation/relanceannule');
  }
  public function ListedesProduitsvendus()
  {

    $this->render_view('service_clientel/note_de_livraison/ListedesProduitsvendus');
  }
  public function Calendrier_de_Livraison($date)
  {
    $this->load->model("calendrier_model");
    $this->calendrier_model->ca_vente_livre($date);
    $previ = $this->calendrier_model->ca_vente_livre($date);
    $Previsionnelle = 0;
    $annule = 0;
    $Decis = 0;
    $Plan = 0;
    $Realisees = 0;
    if ($previ) {
      foreach ($previ as $key => $valiny) {
        $Previsionnelle += $valiny->Quantite * $valiny->Prix_detail;
      }
    }
    $livr = $this->calendrier_model->ca_vente_livre($date, 'livre');

    if ($livr) {
      foreach ($livr as $key => $liv) {
        if ($liv->statut != 'annuler') {
          $Realisees += $liv->Quantite * $liv->Prix_detail;
        }
      }
    }
    $annul = $this->calendrier_model->ca_vente_livre($date, 'annule');
    if ($annul) {
      foreach ($annul as $key => $annul) {
        $annule += $annul->Quantite * $annul->Prix_detail;
      }
    }
    $Decision = $this->calendrier_model->ca_vente_livre($date, 'en_attente');
    if ($Decision) {
      foreach ($Decision as $key => $Decision) {
        $Decis += $Decision->Quantite * $Decision->Prix_detail;
      }
    }

    $Planifiees = $this->calendrier_model->ca_vente_livre($date, 'confirmer');
    if ($Planifiees) {
      foreach ($Planifiees as $key => $Planifiees) {
        $Plan += $Planifiees->Quantite * $Planifiees->Prix_detail;
      }
    }
    $data = ['Previsionnelle' => $Previsionnelle, 'Realisees' => $Realisees, 'Annulees' => 0, 'Planifiees' => 0, 'Decision' => 0, 'date' => $date];
    $this->render_view('service_clientel/calendrier/Calendrierdelivraison', $data);
  }
  public function listeserviceclientelle()
  {

    $this->render_view('service_clientel/note_de_livraison/listeserviceclientelle');
  }
  public function livraison()
  {
    // $this->load->model("calendrier_model");
    //$this->calendrier_model->ca_vente_livre($date);
    //$data=['Previsionnelle'=>0,'Realisees'=>0,'Annulees'=>0,'Planifiees'=>0,'Decision'=>0];
    // if ($this->calendrier_model->ca_vente_livre($date)) {
    $this->load->model('calendrier_model');
    $i = 0;
    $resultat = array();
    $client = $this->calendrier_model->liste_client_facture_sc($this->input->post('date'), $this->input->post('type'));

    foreach ($client as $key => $client) {
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $client->Code_client;
      $resultat[$i]['produit'] = '';
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['Ville'] = $client->Ville;
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
      'data' => $resultat,
      'color' => $this->color($this->input->post('type')),
      'type' => $this->input->post('type')
    ];

    $this->render_view('service_clientel/note_de_livraison/livraison');
  }

  public function LivraisonEffectuee()
  {
    $this->load->model('calendrier_model');
    $this->load->model('global_model');
    $i = 0;
    $resultat = array();

    $client = $this->calendrier_model->liste_client_facture_sc(date("Y-m-d"), 'livre');

    foreach ($client as $key => $client) {
      $detail = "";
      $detail = $this->global_model->detail_client($client->Code_client);
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $detail->Nom;
      $resultat[$i]['produit'] = '';
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['Ville'] = $client->Ville;
      $resultat[$i]['remarque'] = $client->Remarque;
      $resultat[$i]['link'] = 'link_' . $i;
      $resultat[$i]['facture'] = $client->Id;
      foreach ($this->calendrier_model->ca_facture($client->Id) as $commande) {
        if ($commande->statut != 'annuler') {
          $resultat[$i]['ca'] += ($commande->Quantite * $commande->Prix_detail);
          $resultat[$i]['produit'] .= $commande->Code_produit . '<br/>';
        }
      }
      $i++;
    }


    $data = [
      'type' => 'livre',
      'date' => date('Y-m-d'),
      'data' => $resultat,
      'color' => $this->color('livre'),
      'type' => 'livre'
    ];

    $this->render_view('service_clientel/etat_de_livraison/LivraisonEffectuee', $data);
  }
  public function calendrier_de_vente()
  {

    $this->render_view('service_clientel/etat_de_livraison/Livresondujour');
  }
  public function listedesproduit()
  {
    $this->render_view('service_clientel/accueil/listedesproduit');
  }
  public function Liste_des_clients()
  {
    $this->load->model('global_model');
    $this->load->model('client_model');
    $config = array();
    $config["base_url"] = base_url() . strtolower($this->session->userdata('designation')) . "/clients/Liste_des_clients/";
    $config["total_rows"] = $this->global_model->nombre_client();
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
    $data["links"] = $this->pagination->create_links();
    $data['client'] = $this->client_model->get_client($config["per_page"], $page);

    $this->render_view('service_clientel/clients/liste_des_client', $data);
  }
  //public function vente(){ 

  //$this->render_view('service_clientel/accueil/vente');
  // }
  public function Calendrierdelivraison()
  {
    //$this->load->model("calendrier_model");
    //$this->calendrier_model->ca_vente_livre($date);       
    $this->render_view('service_clientel/note_de_livraison/Calendrierdelivraison');
  }
  public function livraisondujourAttent()
  {

    $this->render_view('service_clientel/accueil/livraisondujourAttent');
  }
  public function produit()
  {

    $this->load->model("calendrier_model");
    $date = date('Y-m-d');
    //$Nbr=$this->calendrier_model->detail_facture($date,'chiffre_d_affaires');
    $hygienCor = $this->count_maivana($date, "HYGIENE CORPORELLE");
    $deoparfum = $this->count_maivana($date, "DEO & PARFUM");
    $soinCap = $this->count_maivana($date, "SOINS CAPILLAIRE");
    $hygienBuco = $this->count_maivana($date, "HYGIENE BUCO-DENTAIRE");
    $beaute = $this->count_maivana($date, "BEAUTE");
    $lessive = $this->count_maivana($date, "LESSIVE");
    $soinsVis = $this->count_maivana($date, "SOINS VISAGE");
    $boisson = $this->count_maivana($date, "BOISSON");
    $data = [
      'nbC' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date))[1],
      'caC' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date))[0],
      'nbL' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date, "livre"))[1],
      'caL' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date, "livre"))[0],
      'nbAn' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date, 'annule'))[1],
      'caAn' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date, 'annule'))[0],
      'nbCo' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date, "confirmer"))[1],
      'caCo' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date, "confirmer"))[0],
      'nbAc' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date, "en_attente"))[1],
      'caAc' => $this->calcul_ca_with($this->calendrier_model->ca_vente_livre($date, "en_attente"))[0],
      "hygienCor" => $hygienCor,
      "deoparfum" => $deoparfum,
      "soinCap" => $soinCap,
      "hygienBuco" => $hygienBuco,
      "beaute" => $beaute,
      "lessive" => $lessive,
      "soinsVis" => $soinsVis,
      "boisson" => $boisson
    ];

    $this->render_view('service_clientel/etat_de_livraison/produit', $data);
  }

  private function count_maivana($date, $famille)
  {
    $t = [
      'all' => $this->calendrier_model->count_produit_facture_rep_cat($date, 'all', $famille),
      'livre' => $this->calendrier_model->count_produit_facture_rep_cat($date, 'livre', $famille),
      'confirmer' => $this->calendrier_model->count_produit_facture_rep_cat($date, 'confirmer', $famille),
      'annule' => $this->calendrier_model->count_produit_facture_rep_cat($date, 'annule', $famille),
      'en_attente' => $this->calendrier_model->count_produit_facture_rep_cat($date, 'en_attente', $famille)
    ];

    return $t;
  }

  private function calcul_ca_with($ar)
  {
    $ca = 0;
    $p = 0;
    foreach ($ar as $key => $value) {
      $ca += $value->Quantite * $value->Prix_detail;
      $p += $value->Quantite;
    }

    return [$ca, $p];
  }

  public function Livraison_du_jour()
  {

    $this->render_view('service_clientel/etat_de_livraison/Livraison_du_jour');
  }


  public function detail_de_livraison($date)
  {
    $this->load->model("calendrier_model");
    $this->load->model("Global_model");
    $this->calendrier_model->ca_vente_livre($date);
    $previ = $this->calendrier_model->ca_vente_livre($date);
    //var_dump($previ);
    $Previsionnelle = 0;
    $annule = 0;
    $Decis = 0;
    $Plan = 0;
    $repporte = 0;
    if ($previ) {
      foreach ($previ as $key => $valiny) {
        if ($valiny->statut != "annuler") {
          $Previsionnelle += ($valiny->Quantite * $valiny->Prix_detail);
        }
      }
    }
    $livr = $this->calendrier_model->ca_vente_livre($date, 'livre');

    $Realisees = 0;
    if ($livr) {
      foreach ($livr as $key => $liv) {
        if ($liv->statut != 'annuler') {
          $Realisees += ($liv->Quantite * $liv->Prix_detail);
        }
      }
    }
    $annul = $this->calendrier_model->ca_vente_livre($date, 'annule');
    if ($annul) {
      foreach ($annul as $key => $annul) {
        $annule += ($annul->Quantite * $annul->Prix_detail);
      }
    }
    $Decision = $this->calendrier_model->ca_vente_livre($date, 'en_attente');
    if ($Decision) {
      foreach ($Decision as $key => $Decision) {
        if ($Decision->statut != 'annuler') {
          $Decis += ($Decision->Quantite * $Decision->Prix_detail);
        }
      }
    }

    $Planifiees = $this->calendrier_model->ca_vente_livre($date, 'confirmer');
    if ($Planifiees) {
      foreach ($Planifiees as $key => $Planifiees) {
        if ($Planifiees->statut != 'annuler') {
          $Plan += ($Planifiees->Quantite * $Planifiees->Prix_detail);
        }
      }
    }


    $rep = $this->calendrier_model->ca_vente_repporet($date, 'repporte');
    if ($rep) {
      foreach ($rep as $key => $rep) {
        if ($rep->statut != 'annuler') {
          $repporte += ($rep->Quantite * $rep->Prix_detail);
        }
      }
    }
    $data = ['Previsionnelle' => $Previsionnelle, 'Realisees' => $Realisees, 'Annulees' => $annule, 'Planifiees' => $Plan, 'Decision' => $Decis, 'date' => $date, 'repporter' => $repporte];
    $dt = new dateTime($date);
    $dta = $dt->format('Y-m-d');
    $this->render_view('service_clientel/calendrier/detail_livraison', $data);
  }


  public function detail_de_livraison_tsenakoty($date)
  {
    $this->load->model("calendrier_model");
    $this->load->model("Global_model");
    $this->calendrier_model->ca_vente_livre($date);
    $previ = $this->calendrier_model->ca_vente_livre($date);
    //var_dump($previ);
    $Previsionnelle = 0;
    $annule = 0;
    $Decis = 0;
    $Plan = 0;
    $repporte = 0;
    if ($previ) {
      foreach ($previ as $key => $valiny) {
        if ($valiny->statut != "annuler") {
          $Previsionnelle += ($valiny->Quantite * $valiny->Prix_detail);
        }
      }
    }
    $livr = $this->calendrier_model->ca_vente_livre($date, 'livre');

    $Realisees = 0;
    if ($livr) {
      foreach ($livr as $key => $liv) {
        if ($liv->statut != 'annuler') {
          $Realisees += ($liv->Quantite * $liv->Prix_detail);
        }
      }
    }
    $annul = $this->calendrier_model->ca_vente_livre($date, 'annule');
    if ($annul) {
      foreach ($annul as $key => $annul) {
        $annule += ($annul->Quantite * $annul->Prix_detail);
      }
    }
    $Decision = $this->calendrier_model->ca_vente_livre($date, 'en_attente');
    if ($Decision) {
      foreach ($Decision as $key => $Decision) {
        if ($Decision->statut != 'annuler') {
          $Decis += ($Decision->Quantite * $Decision->Prix_detail);
        }
      }
    }

    $Planifiees = $this->calendrier_model->ca_vente_livre($date, 'confirmer');
    if ($Planifiees) {
      foreach ($Planifiees as $key => $Planifiees) {
        if ($Planifiees->statut != 'annuler') {
          $Plan += ($Planifiees->Quantite * $Planifiees->Prix_detail);
        }
      }
    }


    $rep = $this->calendrier_model->ca_vente_repporet($date, 'repporte');
    if ($rep) {
      foreach ($rep as $key => $rep) {
        if ($rep->statut != 'annuler') {
          $repporte += ($rep->Quantite * $rep->Prix_detail);
        }
      }
    }
    $data = ['Previsionnelle' => $Previsionnelle, 'Realisees' => $Realisees, 'Annulees' => $annule, 'Planifiees' => $Plan, 'Decision' => $Decis, 'date' => $date, 'repporter' => $repporte];
    $dt = new dateTime($date);
    $dta = $dt->format('Y-m-d');
    $data['sommeprevi'] = $this->Global_model->Somme_Tsenakoty_Previ($dta);
    $data['sommelivre'] = $this->Global_model->Somme_Tsenakoty_Livre($dta);
    $data['sommeannule'] = $this->Global_model->Somme_Tsenakoty_Annule($dta);
    $data['sommeconfirme'] = $this->Global_model->Somme_Tsenakoty_Confirme($dta);
    $data['somme_enattente'] =  $this->Global_model->Somme_Tsenakoty_En_attente($dta);
    $data['somme_repport'] = $this->Global_model->Somme_Tsenakoty_Repport($dta);
    $this->render_view('service_clientel/calendrier/tsena_koty', $data);
  }



  public function detail_vente_com()
  {
    $this->load->model('calendrier_model');
    $this->load->model('global_model');
    $i = 0;
    $resultat = array();
    if ($this->input->post('type') == 'rep') {
      $client = $this->calendrier_model->liste_client_facture_rep($this->input->post('date'));
    } else {
      $client = $this->calendrier_model->liste_client_facture_sc($this->input->post('date'), $this->input->post('type'));
    }
    foreach ($client as $key => $client) {
      $detail = "";
      $detail = $this->global_model->detail_client($client->Code_client);
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $detail->Nom;
      $resultat[$i]['Nom'] = $client->Code_client;
      $resultat[$i]['produit'] = '';
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['Ville'] = $client->Ville;
      $resultat[$i]['remarque'] = $client->Remarque;
      $resultat[$i]['link'] = 'link_' . $i;
      $resultat[$i]['facture'] = $client->Id;
      $resultat[$i]['cadeau'] = $client->Id;
      foreach ($this->calendrier_model->ca_facture($client->Id) as $commande) {
        if ($commande->statut != 'annuler') {
          $resultat[$i]['ca'] += ($commande->Quantite * $commande->Prix_detail);
          $resultat[$i]['produit'] .= ' <a class="example-image-link" href="' . base_url("images/produit/" . $commande->Code_produit) . '.jpg" data-lightbox="' . $commande->Designation . '">' . $commande->Designation . '</a><br/>';
        }
      }
      $i++;
    }
    $data = [
      'type' => $this->input->post('type'),
      'date' => $this->input->post('date'),
      'data' => $resultat,
      'color' => $this->color($this->input->post('type')),
      'type' => $this->input->post('type')
    ];

    $this->load->view("service_clientel/calendrier/liste_commande", $data);
  }
  public function detail_vente_com_tsena_koty()
  {
    $this->load->model('compta_model');
    $this->load->model('global_model');
    $i = 0;
    $resultat = array();
    if ($this->input->post('type') == 'rep') {
      $client = $this->compta_model->liste_client_facture_rep($this->input->post('date'));
    } else {
      $client = $this->compta_model->liste_client_facture_sc($this->input->post('date'), $this->input->post('type'));
    }
    foreach ($client as $key => $client) {
      $detail = "";
      $detail = $this->global_model->detail_client($client->Code_client);
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $detail->Nom;
      $resultat[$i]['Nom'] = $client->Code_client;
      $resultat[$i]['produit'] = '';
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['Ville'] = $client->Ville;
      $resultat[$i]['remarque'] = $client->Remarque;
      $resultat[$i]['link'] = 'link_' . $i;
      $resultat[$i]['facture'] = $client->Id;
      foreach ($this->compta_model->ca_facture($client->Id) as $commande) {
        if ($commande->statut != 'annuler') {
          $resultat[$i]['ca'] += ($commande->Quantite * $commande->Prix_detail);
          $resultat[$i]['produit'] .= $commande->Designation . '<br/>';
        }
      }
      $i++;
    }
    $data = [
      'type' => $this->input->post('type'),
      'date' => $this->input->post('date'),
      'data' => $resultat,
      'color' => $this->color($this->input->post('type')),
      'type' => $this->input->post('type')
    ];
    $this->load->view("service_clientel/calendrier/liste_commande", $data);
  }

  public function color($code)
  {
    $color = array('rep' => '#6f42c1', 'Previ' => '#5bc0de', 'en_attente' => 'orange', 'confirmer' => "#3f729b", 'annule' => '#d9534f', 'livre' => '#5cb85c');
    return $color[$code];
  }
  public function detail($idfacture)
  {
    $this->load->model('calendrier_model');
    $client = $this->calendrier_model->detail_facture($idfacture);
    $data = [
      'client' => $client,
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'cadeau'=> $this->calendrier_model->get_fetch_cadeau(["facture"=>$client->Id_facture])
    ];
  
    $this->render_view('service_clientel/calendrier/detail', $data);
  }
  public function  planifier_commande($idfacture)
  {

    $this->load->model('calendrier_model');
    $client = $this->calendrier_model->detail_facture($idfacture);
    $data = [
      'client' => $client,
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'annulation' => $this->calendrier_model->code_annulation(),
      'cadeau'=> $this->calendrier_model->get_fetch_cadeau(["facture"=>$client->Id_facture])
    ];
    $this->render_view('service_clientel/calendrier/en_attente', $data);
  }
  public function confirmer_commande($idfacture)
  {
    $this->load->model('calendrier_model');
    $client = $this->calendrier_model->detail_facture($idfacture);
    $data = [
      'client' =>  $client,
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'annulation' => $this->calendrier_model->code_annulation(),
      'liste_personel' => $this->calendrier_model->liste_personel(),
      'cadeau'=> $this->calendrier_model->get_fetch_cadeau(["facture"=>$client->Id_facture])
    ];
    $this->render_view('service_clientel/calendrier/confirmer', $data);
  }

  public function confirmer_commandeKoty($idfacture)
  {
    $this->load->model('calendrier_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'annulation' => $this->calendrier_model->code_annulation(),
      'liste_personel' => $this->calendrier_model->liste_personel()
    ];
    $this->render_view('service_clientel/calendrier/confirmerkoty', $data);
  }

  public function commande()
  {
    $this->load->model('global_model');
    $data = [
      'famille' => $this->global_model->famille(),
      'mission' => $this->global_model->mission(),
      //'zone'=>$this->global_model->zone()
    ];
    $this->render_view('service_clientel/accueil/commande', $data);
  }
  public function enregistre_commande()
  {
    $this->load->model('global_model');
    $fact = $this->input->post('fact');
    $date = $this->input->post('date');
    $Debut = $this->input->post('Debut');
    $Fin = $this->input->post('Fin');
    $idville = $this->input->post('ville');
    $idquartier = $this->input->post('quartier');
    $district = $this->input->post('District');
    $lieulivre = $this->input->post('lieulivre');
    $remarque = $this->input->post('remarque');
    $client = $this->input->post('client');
    $frailivre = $this->input->post('frailivre');
    $contact = $this->input->post('contact');
    $Id_zone = $this->input->post('Id_zone');
    $Id_discussion = $this->input->post('Id_discussion');
    $this->global_model->enregistre_detail_facture($fact, $client, $Id_zone, $idville, $date, $Debut, $Fin, $contact, $remarque, $Id_discussion);
    $this->enregistre_livraison_commande($fact, $date, $frailivre);
    foreach ($this->input->post('produits') as $produit) {
      $prodact = "";
      $prodact = explode("|", $produit);
      $this->enregistre_detail_commande($prodact[0], $prodact[1], $fact);
    }
    echo json_encode(array('message' => true));
  }
  public function enregistre_livraison_commande($Id_facture, $date_de_livraison, $frais)
  {
    $this->load->model('global_model');
    $this->global_model->insert_detail_livraison($Id_facture, $date_de_livraison, $frais);
  }


  public function enregistre_detail_commande($idPrix, $quantite, $idfacture)
  {
    $this->load->model('global_model');
    $this->global_model->enregistre_detail_commande($idPrix, $quantite, $idfacture);
  }

  public function rename_image()
  {
    $codeProspect = $this->input->post('codeProspect');
    $codeClient = $this->input->post('codeClient');
    $data = scandir(FCPATH . 'images/client');
    if (in_array($codeProspect . '.jpg', $data)) {
      rename(FCPATH . 'images/client/' . $codeProspect . '.jpg', "$codeClient.jpg");
    }
  }
  public function sauvelivraison()
  {
    $this->load->model('global_model');
    $this->load->model('Administrateur_model');
    $datelivre = $this->input->post('datelivre');
    $debut = $this->input->post('debut');
    //$fin=$this->input->post('fin');
    $remarque = $this->input->post('remarque');
    $type = $this->input->post('type');
    $facture = $this->input->post('facture');
    $matrliv = $this->input->post('matrliv');
    $contactliv = $this->input->post('cotactliv');
    $lieulirevc = $this->input->post('lieulirevc');
    // echo " Date de livraison : ".$datelivre . "  heure : ".$debut . " MATRICULE VENDEUR SECONDAIRE : ". $matrliv . " Contact : ". $contactliv;
    $this->global_model->sauvelivraison($datelivre, $debut, $remarque, $facture, $type, $lieulirevc, $matrliv, $contactliv);
    echo json_encode(array('message' => true));
  }

  public function livre_vente()
  {
    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    $this->load->model('Administrateur_model');
    $this->load->model('livraison_model');

    $this->load->model('discussion_model');
    $livreur = $this->input->post('livreur');
    $remarque = $this->input->post('remarque');
    $facture = $this->input->post('facture');
    $client = $this->input->post('client');
    $detailFacture = $this->global_model->selectFacture(["Id_facture"=> $facture]);
    $totalAchat = 0;
   
    $reponseRelanceSanAchat = $this->discussion_model->selectRelanceDiscussion([
    'CodeClient'=>$client,
    'PageRD'=> $detailFacture->Page,
    'Type'=>'Relance sans achat'
    ]);
    if($reponseRelanceSanAchat){
      $this->discussion_model->deleteRelanceDiscussion(['IdRD'=>$reponseRelanceSanAchat->IdRD]);
    }

    

    $koty = $this->global_model->getkotysmiletotalpossibles($facture);
    $compte = $this->Administrateur_model->selectCompte(['Client' => $client, 'Statut' => 'on']);


    if($detailFacture->Id_de_la_mission == "TSENA_KOTY"){
      $kots = 0;
      $factureSmile = $this->calendrier_model->detail_commande_facture_discussion($facture);
      $zain = 0;
      foreach ($factureSmile as $key => $factureSmile) {
        $zain += ($factureSmile->Prix_zen * $factureSmile->Quantite);
      }
      if ($compte) {
        $newcompte = $compte->Koty - $zain;
        $kots =   $compte->Koty;
        $update = $this->Administrateur_model->updateCompte(['Id' => $compte->Id], ['Koty' => $newcompte]);
        if ($update) {
          if ($koty) {
            $dataMouve = [
              "Client" => $client,
              "Date" => date('Y-m-d'),
              "Type" => "ACHAT",
              'Koty' =>$zain,
              'Raison' => "achat_koty",
              'facture' => $facture
            ];
            //$this->global_model->Ajout_Mouvement();
            $this->Administrateur_model->Ajout_Mouvement($dataMouve);
          }
        }
      }
      $point = 0;
      $points = $this->global_model->pointsmilles(date('Y-m-d'), $client);
      if( $points){
        $point = $points['smille'];
      }
      
      $this->global_model->livre_vente($livreur, $remarque, $facture, $this->global_model->testLevele(date('Y-m-d'), $client),$kots,$point);
      $this->global_model->Insertpoint($facture);
    }else if($detailFacture->Id_de_la_mission == "FACEBOOK"){
      $kots = 0;
      if ($compte) {
        $newcompte = $compte->Koty + $koty->koty;
        $kots = $newcompte;
        $update = $this->Administrateur_model->updateCompte(['Id' => $compte->Id], ['Koty' => $newcompte]);
        if ($update) {
          if ($koty) {
            $dataMouve = [
              "Client" => $client,
              "Date" => date('Y-m-d'),
              "Type" => "GAIN",
              'Koty' => $koty->koty,
              'Raison' => "achat_Produit",
              'facture' => $facture
            ];
            $this->Administrateur_model->Ajout_Mouvement($dataMouve);
          }
        }
      }else{
        $kots = $koty->koty;
        $this->Administrateur_model->insertCompte([
        "Client"=> $client,
        "Koty"=>$koty->koty,
        "Statut"=>"on",
        "Date"=>date('Y-m-d')
        ]);
        $dataMouve = [
          "Client" => $client,
          "Date" => date('Y-m-d'),
          "Type" => "GAIN",
          'Koty' => $koty->koty,
          'Raison' => "achat_Produit",
          'facture' => $facture
        ];
        $this->Administrateur_model->Ajout_Mouvement($dataMouve);
      }
      $point = 0;
      $points = $this->global_model->pointsmilles(date('Y-m-d'), $client);
      if($points){
        $pointSmile = $points['smille'];
      }
      $donne = $this->global_model->testLevel($point);
      $smille = $this->Administrateur_model->select_Mouvement_smile(["Code_client"=>$client,"statut"=>"on"]);
    
    if($smille ){
       $newsmail =  $smille->smile + $pointSmile;
       $this->Administrateur_model->update_Mouvement_smile(["Code_client"=>$client,"statut"=>"on"],["smile"=>$newsmail,"level"=>$donne['level']]);
       $this->Administrateur_model->insertMouve([
        "Code_client"=>$client,
        "date"=>date('Y-m-d'),
        "type"=>"GAIN", 
        "smile"=>$pointSmile, 
        "raison"=>"achat_Produit", 
        "observation"=>"achat_Produit",
        "facture"=>$facture
       ]);
      }else{
       $this->Administrateur_model->insertSmileModel(["smile"=>$pointSmile,"Code_client"=>$client,"statut"=>"on","date_validation"=>date('Y-m-d'),"date"=>date('Y-m-d'),"level"=>$donne['level']]);
       $this->Administrateur_model->insertMouve([
        "Code_client"=>$client,
        "date"=>date('Y-m-d'),
        "type"=>"GAIN", 
        "smile"=>$pointSmile, 
        "raison"=>"achat_Produit", 
        "observation"=>"achat_Produit",
        "facture"=>$facture
       ]);     
      
      }
     
     $this->global_model->livre_vente($livreur, $remarque, $facture, $this->global_model->testLevele(date('Y-m-d'), $client),$kots,$point);
      $this->global_model->Insertpoint($facture);
    }

    $detailFActure = $factureDetail = $this->calendrier_model->detail_commande_facture_discussion($facture);
    foreach ($factureDetail as $key => $factureDetail) {
      $totalAchat += ($factureDetail->Prix_detail * $factureDetail->Quantite);
      $reponseRelanceAvecAchat = $this->discussion_model->selectRelanceDiscussion([
        'CodeClient'=>$client,
        'PageRD'=> $detailFacture->Page,
        'Type'=>'Relance avec achat',
        'produit'=>$factureDetail->Code_produit
        ]);
        if($reponseRelanceAvecAchat){
            $this->discussion_model->deleteRelanceDiscussion(['IdRD'=>$reponseRelanceSanAchat->IdRD]);


        }else{
          $dt = new DateTime();
          $intervalRelance =$this->calendrier_model->getProduit(["Code_produit"=>$factureDetail->Code_produit]);
          $intervalRelance->IntervaleDeRelance;
          $dt->modify("+$intervalRelance->IntervaleDeRelance day");
          $dateRelance= $dt->format('Y-m-d');
          $this->discussion_model->insertRelanceDiscussion([
           "CodeClient"=>$client,
           "DateRD"=>$dateRelance,
           "OperatriceRD"=>$factureDetail->Matricule_personnel,
           "PageRD"=> $factureDetail->Page,
           "dateDeCreatiion"=>date('Y-m-d'),
           "idCommande"=>$factureDetail->fatcure,
           "Intervale"=>"AAC0".$intervalRelance->IntervaleDeRelance,
           "StatutRD"=>1,
           "produit"=>$factureDetail->Code_produit,
           "Type"=>'Relance avec achat'
          ]);
        }

    }

    $reponse =  $this->livraison_model->selectparametreTombola("StatutParametre = 'enCours' AND Montant < $totalAchat");
    $promo = false;
    if($detailFActure){
      if($reponse){
        $reponseArray = explode("-",$reponse->Produit);
        foreach ($detailFActure as $key => $detailFActure) {
          if(in_array($detailFActure->Code_produit, $reponseArray)){
             $i = 0;
                while($i < $detailFActure->Quantite){
                  $paremetre = [
                    "facture"=>$facture, 
                    "statut"=>'on', 
                    "date"=>date('Y-m-d'), 
                    "codeClient"=> $client,
                    "TombolaDesignation"=>$reponse->Designation,
                    "operatrice"=>$detailFActure->Matricule_personnel
                  ];
                  $this->global_model->insertTombola($paremetre);
                  $i++;
              }
          }
        }
      }
     
    }
   
    echo json_encode(array('message' => true));
  }



  public function migreclient($client)
  {
    $this->load->model('global_model');
    $temp = $this->global_model->clientTemp_info($client);
    if ($temp->Coach == NULL) {
      $coatch = 'COTNX';
    } else {
      $coatch = $temp->Coach;
    }
    $data = [
      'Code_client' => str_replace("CMT", "CLT", $client),
      'Nom' => $temp->Nom,
      'Prenom' => $temp->Prenom,
      'Compte_facebook' => $temp->Compte_facebook,
      'Matricule_personnel' => $temp->Operatrice,
      'lien_facebook' => $temp->lien_facebook,
      'datedenregistrement' => date('Y-m-d'),
      'Coach' => $coatch,
      'Commercial' => $temp->Commercial,
      'password' => $temp->password,
      'pseudo' => $temp->pseudo,
      'Provenance' => $client
    ];

    $this->global_model->migreclient($data);
    $this->global_model->migration_facture(str_replace("CMT", "CLT", $client), $client);
    $this->global_model->migration_discussion(str_replace("CMT", "CLT", $client), $client);
    $old = FCPATH . "images/client/" . $client . ".jpg";
    $new = FCPATH . "images/client/" . str_replace("CMT", "CLT", $client) . ".jpg";
    rename($old, $new);
  }

  public function  save_detail()
  {
    $this->load->model('global_model');
    $link = $this->input->post("liensurfb");
    $Id_facebook = $this->input->post("identifient");
    $codeclient = $this->input->post("codeclient");
    if (null !== $this->input->post("coach") and null !== $this->input->post("commerciale")) {
      $this->global_model->insertdetailPotentiel($codeclient, $Id_facebook, $link, $this->input->post("coach"), $this->input->post("commerciale"));
    } else {
      $this->global_model->insertdetailPotentiel($codeclient, $Id_facebook, $link);
    }

    echo json_encode('true');
  }
  public function autocomplete_ville()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_ville($term) as $reponse) {
      array_push($array, $reponse->Ville_Commune);
    }
    echo json_encode($array);
  }
  public function autocomplete_quartier()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $Ville = $this->input->get('Ville');
    $array = array();
    foreach ($this->global_model->autocomplete_quartier($term, $Ville) as $reponse) {
      array_push($array, $reponse->Fokontany);
    }
    echo json_encode($array);
  }
  public function autocomplete_district()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $District = $this->input->get('District');
    $array = array();
    foreach ($this->global_model->autocomplete_district($term, $District) as $reponse) {
      array_push($array, $reponse->District);
    }
    echo json_encode($array);
  }

  public function export($date, $type)
  {

    $result = array();
    $this->load->model('calendrier_model');
    $this->load->model('global_model');
    $i = 0;
    $resultat = array();
    if ($this->input->post('type') == 'rep') {
      $client = $this->calendrier_model->liste_client_facture_rep($date);
    } else {
      $client = $this->calendrier_model->liste_client_facture_export($date, $type);
    }
    foreach ($client as $key => $client) {
      $detail = "";
      $detail = $this->global_model->detail_client($client->Code_client);
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $client->Id;
      $resultat[$i]['Nom'] = $detail->Nom;
      $resultat[$i]['client_code'] = $client->Code_client;
      $resultat[$i]['produit'] = $client->Designation;
      $resultat[$i]['liensurfacebook'] = $detail->lien_facebook;
      $resultat[$i]['datediflivre'] = $client->date_de_livraison;
      $resultat[$i]['contact'] = $client->contacts;
      $resultat[$i]['codeproduit'] = $client->Code_produit;
      $resultat[$i]['date'] = $client->Date;
      $resultat[$i]['prix'] = $client->Prix_detail;
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['Ville'] = $client->Ville;
      $resultat[$i]['remarque'] = $client->Remarque;
      $resultat[$i]['quantite'] = $client->Quantite;
      $resultat[$i]['lieudelivraison'] = $client->lieu_de_livraison;
      $resultat[$i]['OPLG'] = $client->Matricule_personnel;
      $resultat[$i]['Statut'] = $client->Status;
      $resultat[$i]['Ville'] = $client->Ville;
      $resultat[$i]['Quartier'] = $client->Quartier;
      $resultat[$i]['frais'] = $client->frais;
      $resultat[$i]['District'] = $client->District;
      $resultat[$i]['link'] = 'link_' . $i;
      $resultat[$i]['facture'] = $client->Id;
      foreach ($this->calendrier_model->ca_facture($client->Id) as $commande) {
        if ($commande->statut != 'annuler') {
          $resultat[$i]['ca'] += ($commande->Quantite * $commande->Prix_detail);
          $resultat[$i]['produit'] .= $commande->Designation . '<br/>';
        }
      }
      $i++;
    }



    $excel = "";
    $excel .=  "Code client\tNum Commande\tClient\tDate de Commande\tDate de Livraison\tLien Facebook\tContact\tProduit\tPU\tQTT\tlieu de livraison\tOPL\tQuartier\tVille\tMontant\tLocalisation\tFrais\tRemarque\tStatut\n";

    foreach ($resultat as $row) {
      $montant = (int)$row['prix'] * (int)$row['quantite'];
      $excel .= "$row[client_code]\t$row[code_client]\t$row[Nom]\t$row[date]\t$row[datediflivre]\t$row[liensurfacebook]\t$row[contact]\t$row[produit]\t$row[prix]\t$row[quantite]\t$row[lieudelivraison]\t$row[OPLG]\t$row[Quartier]\t$row[Ville]\t$montant\t$row[District]\t$row[frais]\t$row[remarque]\t$row[Statut]\n";
    }

    header("Content-type: application/vnd.ms-excel");
    header("Content-disposition: attachment; filename=vente_" . $type . "_du_" . date('d-m-Y') . ".xls");

    print $excel;
    exit;
  }
  public function Livraion_du_jour_export()
  {
    $this->load->model('global_model');
    $LivraisonDuJourExprot = $this->global_model->getexporteliv();
    $this->render_view('service_clientel/exporte/exportelisteliv', ['data' => $LivraisonDuJourExprot]);
  }

  public function Commande_du_jour_export()
  {
    $data['list'] = $this->global_model->getexportecom();
    $this->render_view('service_clientel/exporte/exportelistecom', $data);
  }


  public function repporter()
  {
    $this->load->model('calendrier_model');
    $facture = $this->input->post('facture');
    $date = $this->input->post('date');
    $fin = $this->input->post('fin');
    $Remarque = $this->input->post('Remarque');
    $livraison = $this->calendrier_model->detaillivraison($facture);
    $datas = [
      'Status' => 'confirmer',
      'remarque_service_clientel' => $Remarque
    ];
    $this->calendrier_model->repporterfacture($facture, $datas);
    $data = [
      'heure_deb_livre' => $date,
      'heure_fi_livre' => $fin,
      'date_de_livraison' => $date,
      'dateRep' => $livraison->date_de_livraison
    ];
    $this->calendrier_model->repporter($facture, $data);
    echo  json_encode(array('message' => true));
  }

  public function liste_des_client()
  {
    $this->load->model('global_model');
    $this->load->model('client_model');
    $config = array();
    $config["base_url"] = base_url() . strtolower($this->session->userdata('designation')) . "/clients/Liste_des_clients/";
    $config["total_rows"] = $this->global_model->nombre_client();
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
    $data["links"] = $this->pagination->create_links();
    $data['client'] = $this->client_model->get_client($config["per_page"], $page);
    $this->render_view('operatrice/client/liste_des_client', $data);
  }

  public function Liste_des_produits()
  {
    $this->load->model('global_model');
    $config = array();
    $config["base_url"] = base_url() . strtolower($this->session->userdata('designation')) . "/Produits/Liste_des_produits";
    $config["total_rows"] = $this->global_model->nombre_produit();
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
    $data['produit'] = $this->global_model->liste_des_produit($config["per_page"], $page);
    $this->render_view('service_clientel/produit/liste_des_produits', $data);
  }

  // traitement de l'urgence

  public function page()
  {
    $page = $this->input->post('page');
    switch ($page) {
      case 'EN-COURS':
        $data = ['data' => $this->urgent_model->liste(['Statut' => 'EN_COURS'])];
        $this->load->view('service_clientel/Urgence/Tableau', $data);
        break;
      case 'TERMINER':
        $data = ['data' => $this->urgent_model->liste(['Statut' => 'TERMINER'])];
        $this->load->view('service_clientel/Urgence/Tableau', $data);
        break;

      default:
        # code...
        break;
    }
  }

  public function Urgence()
  {
    $this->render_view('service_clientel/Urgence/index');
  }

  public function get_info_annulation()
  {
    $this->load->model('calendrier_model');
    $datas = $this->calendrier_model->liste_Annulation(date('Y-m-d'));

    $this->load->view('service_clientel/info_annulation/tableau/tableauJournalier', ['datas' => $datas]);
  }
  public function liste_hebdomader()
  {

    $this->load->model('calendrier_model');
    $datas = $this->calendrier_model->liste_Hebdomader();
    $this->load->view('service_clientel/info_annulation/tableau/tableauHebdomader', ['datas' => $datas]);
  }
  public function liste_mensuel()
  {

    $this->load->model('calendrier_model');
    $datas = $this->calendrier_model->liste_Mensuel(date('Y-m'));

    $this->load->view('service_clientel/info_annulation/tableau/tableauMensuel', ['datas' => $datas]);
  }
  public function liste_semestriel()
  {

    $this->load->model('calendrier_model');
    $trim = getIntervaltrimerstriel();
    $debut = $trim['debutTrimestre'];
    $fin = $trim['finTrimestre'];
    $datas = $this->calendrier_model->liste_Semestruel($debut, $fin);

    $this->load->view('service_clientel/info_annulation/tableau/tableauSemestruel', ['datas' => $datas]);
  }

  public function listeMotif_Annulation()
  {
    $datas = $this->calendrier_model->liste_motif_annuler(date('Y-m-d'));
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

  public function facture($date)
  {
    //$date = date('2022-02-24');
    $dt = new DateTime($date);
    $dta = $dt->format('Y-m-d');
    //echo $dta;

    $this->load->model('Facture_modele');
    $facture = $this->Facture_modele->afficheFacture($dta);

    if ($facture) {
      //echo 'Misy';
      $data = ['facture' => $facture];
      $html = $this->load->view('service_clientel/facture/facture', $data, true);
      // Load pdf library
      $this->load->library('pdf');
      $this->pdf->loadHtml($html);
      $customPaper = array(0, 0, 860, 960);
      $this->pdf->set_paper($customPaper);
      //$this->pdf->set_paper(DEFAULT_PDF_PAPER_SIZE, 'portrait');
      //$this->pdf->setPaper('A4', 'portrait');
      $this->pdf->render();
      // Output the generated PDF (1 = download and 0 = preview)
      $this->pdf->stream("Facture-" . $date . ".pdf", array("Attachment" => 0));
      $this->load->view('service_clientel/facture/facture', $data);
    } else {
      echo 'T6';
    }
  }

  public function  detail_de_livraison_koty($date)
  {
    $this->load->model("Compta_model");
    $this->load->model("Global_model");
    $this->Compta_model->ca_vente_livre($date);
    $previ = $this->Compta_model->ca_vente_livre($date);
    //var_dump($previ);
    $Previsionnelle = 0;
    $annule = 0;
    $Decis = 0;
    $Plan = 0;
    $repporte = 0;
    if ($previ) {
      foreach ($previ as $key => $valiny) {
        if ($valiny->statut != "annuler") {
          $Previsionnelle += ($valiny->Quantite * $valiny->Prix_detail);
        }
      }
    }
    $livr = $this->Compta_model->ca_vente_livre($date, 'livre');

    $Realisees = 0;
    if ($livr) {
      foreach ($livr as $key => $liv) {
        if ($liv->statut != 'annuler') {
          $Realisees += ($liv->Quantite * $liv->Prix_detail);
        }
      }
    }
    $annul = $this->Compta_model->ca_vente_livre($date, 'annule');
    if ($annul) {
      foreach ($annul as $key => $annul) {
        $annule += ($annul->Quantite * $annul->Prix_detail);
      }
    }
    $Decision = $this->Compta_model->ca_vente_livre($date, 'en_attente');
    if ($Decision) {
      foreach ($Decision as $key => $Decision) {
        if ($Decision->statut != 'annuler') {
          $Decis += ($Decision->Quantite * $Decision->Prix_detail);
        }
      }
    }

    $Planifiees = $this->Compta_model->ca_vente_livre($date, 'confirmer');
    if ($Planifiees) {
      foreach ($Planifiees as $key => $Planifiees) {
        if ($Planifiees->statut != 'annuler') {
          $Plan += ($Planifiees->Quantite * $Planifiees->Prix_detail);
        }
      }
    }


    $rep = $this->Compta_model->ca_vente_repporet($date, 'repporte');
    if ($rep) {
      foreach ($rep as $key => $rep) {
        if ($rep->statut != 'annuler') {
          $repporte += ($rep->Quantite * $rep->Prix_detail);
        }
      }
    }

    /*  $Previsionnelle = $this->Global_model->Somme_Tsenakoty_Previ($dta);
      $Realisees = $this->Global_model->Somme_Tsenakoty_Livre($dta);
      $annule = $this->Global_model->Somme_Tsenakoty_Annule($dta);
      $Plan = $this->Global_model->Somme_Tsenakoty_Confirme($dta);
      

      $data=['Previsionnelle'=>$Previsionnelle,'Realisees'=>$Realisees,'Annulees'=>$annule,'Planifiees'=>$Plan,'date'=>$date];*/

    $data = ['Previsionnelle' => $Previsionnelle, 'Realisees' => $Realisees, 'Annulees' => $annule, 'Planifiees' => $Plan, 'Decision' => $Decis, 'date' => $date, 'repporter' => $repporte];
    $dt = new dateTime($date);
    $dta = $dt->format('Y-m-d');
    $this->render_view('service_clientel/calendrier/detail_livraison_koty', $data);
  }

  public function Exporte_livraison(){
    $this->render_view('service_clientel/etat_de_livraison/exporter_livraison.php');
  }

  public function Livraison_data_export(){
     $this->load->model("Global_model");
     $date= $this->input->post('date_livre');
      $statut= $this->input->post('statut');
     $data['liste_livre']=$this->global_model->Exporte_livraison_Temporaire($date,$statut);
     $this->load->view('service_clientel/etat_de_livraison/exporter_livraison_data',$data);

  }
}
