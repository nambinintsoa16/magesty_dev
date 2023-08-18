<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
class operatrice extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Europe/Moscow');
    $this->load->helper('url');
    $this->load->library("pagination");
    $this->load->library('email');
  }
  public function index()
  {
  }
  public function Livraison_du_jour()
  {
    $this->render_view('operatrice/service_de_livraison/calandrier');
  }


  public function Etat_de_livraison()
  {
    $this->load->model('calendrier_model');
    $reponse = $this->calendrier_model->ca_de_vente_clientel(date('Y-m-d'), 'livre', $this->session->userdata('matricule'));
    $ca_du_jour = 0;
    $ca_la_veille=0;
    $produit = 0;
    foreach ($reponse as $reponse) {
      $ca_du_jour += ($reponse->Prix_detail * $reponse->Quantite);
      $produit += $reponse->Quantite;
    }
    $data = [
      'ca_du_jour' => $ca_du_jour,
      'produit' => $produit,
      'ca_la_veille' =>$this->calendrier_model->livraison_la_veille($this->session->userdata('matricule'))

    ];
    $this->render_view('operatrice/service_de_livraison/livraison', $data);
  }

    public function Ca_livre_semaine_passe()
  {
    $this->load->model('global_model');
    $reponse = $this->global_model->date_de_livraison($this->session->userdata('matricule'));
    $content="";
    $total =0;
    foreach ($reponse as $reponse) {
      $ca = $this->global_model->ca_livre_semaine_passee($reponse->Date_livraison,$this->session->userdata('matricule') );
      
      $total +=$ca->CA_LIVRE; 
      $content .= "<tr><td>".$reponse->Date_livraison."</td><td class='text-center'>".number_format($ca->CA_LIVRE, 0, ',', ' ')."</td></tr>";
    }

    
    $data = [
      'data'=>$content,
      'total'=>$total

    ];
    $this->render_view('operatrice/service_de_livraison/livraisonSemainePassee',$data);
  }



  public function pensebete()
  {
    $this->render_view('operatrice/pensebete/index');
  }
  public function Urgence()
  {
    $this->render_view('operatrice/Urgent/index');
  }
  public function testMessages()
  {
    $this->load->model('discussion_model');
    $reponse = array('reponse' => false);
    $parametre = [
      'taches' => $this->input->post('option')
    ];
    $data = $this->discussion_model->taches($parametre);
    if ($data) {
      if ($data->type = "message") {
        $reponse['reponse'] = true;
      }
    }
    echo json_encode($reponse);
  }
  public function listeDemandeEnvoyer()
  {
    $this->load->model('global_model');
    $date = $this->input->post("date");
    if (!isset($date)) {
      $date = date('Y-m-d');
    }
    $data = [
      'data' => $this->global_model->selectAmies($date, $this->session->userdata('matricule'))
    ];
    $this->render_view('operatrice/demande/liste', $data);
  }
  public function demandeDAmie()
  {
    $this->load->model('global_model');

    $data = [
      'page' => $this->global_model->comptefb()
    ];

    $this->render_view('operatrice/demande/amie', $data);
  }
  public function sauveImageAmie($codeClient)
  {
    $jsons = array();
    $data = scandir(FCPATH . 'images/imageDemande');
    $uploads_dir = FCPATH . 'images/imageDemande';
    $result = array('reponse' => false);
    if (isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) {
      $tmp_name = $_FILES["file"]["tmp_name"];
      $name = $codeClient . ".jpg";

      if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
        $result['reponse'] = true;
      }
    } else {
    }
    echo json_encode($result);
  }
  public function nouveau_codeAmie()
  {
    $this->load->model('global_model');
    $type = $this->input->post('type');
    $lastId = $this->global_model->lastAmie();
    $idClient = "";
    if ($lastId) {
      if ($lastId->Id != 0) {
        $id = (int)$lastId->Id + 1;
        $countId = str_split($id);
        $idsep = "";
        for ($i = 0; $i < 7 - count($countId); $i++) {
          $idsep .= '0';
        }
        $codeClient = 'AM-FB' . $idsep . $id . "-" . date('Y-m');
      } else {
        $id = 0;
        $countId = str_split($id);
        $idsep = "";
        for ($i = 0; $i < 7 - count($countId); $i++) {
          $idsep .= '0';
        }
        $codeClient = 'AM-FB' . $idsep . $id . "-" . date('Y-m');
      }
    } else {
      $countId = 0;
      $idsep = "";
      for ($i = 0; $i < 7 - $countId; $i++) {
        $idsep .= '0';
      }
      $codeClient = 'AM-FB' . $idsep . "1-" . date('Y-m');
    }
    echo  json_encode($codeClient);
  }

  public function saveAmie()
  {
    $this->load->model('global_model');

    $data = [
      "NomEtPrenom" => $this->input->post('NomEtPrenom'),
      "Lien" => $this->input->post('Lien'),
      "PageOuCompte" => $this->input->post('PageOuCompte'),
      "Type" => $this->input->post('Type'),
      "Date" => date('Y-m-d'),
      "Code" => $this->input->post('Code'),
      "Statut" => "Envoyer",
      "operatice" => $this->session->userdata('matricule')
    ];

    return $this->global_model->insertdemandesAmie($data);
  }
  public function Commandes()
  {
    $this->load->model('global_model');
    $data = [
      'famille' => $this->global_model->famille(),
      'mission' => $this->global_model->mission()
    ];
    $this->render_view('operatrice/Commandes', $data);
  }

  public function nouveaux_discution()
  {
    $this->render_view('operatrice/discution/nouveaux_discution');
  }

  public function premier_contact()
  {
    $this->render_view('operatrice/discussion/premier_contact');
  }

  public function getNomByCodeClient()
  {
    $this->load->model('global_model');
    $codeclient = $this->input->post('codeclient');
    $json = array('Nom' => $this->global_model->getClientInfo($codeclient)->Nom);
    return json_encode($json);
  }

  public function importer_client_potentiel()
  {
    $this->load->model('global_model');
    $groupe = $this->global_model->groupeuser($this->session->userdata('matricule'));
    $data = ['groupe' => $groupe];
    $this->render_view('operatrice/client/importer_client_potentiel', $data);
  }

  public function getStatutDiscussion()
  {
    $page = $this->input->post('idPage');
    $client = $this->input->post('client');
    //$operatrice = $this->session->userdata('matricule');
    //$requette = "SELECT * FROM discussion WHERE client LIKE '".$client."' AND page LIKE '".$page."' operatrice like '".$operatrice."' ORDER BY id DESC";
    $requette = "SELECT * FROM discussion WHERE client LIKE '" . $client . "' AND page LIKE '" . $page . "' ORDER BY id DESC";
    $query = $this->db->query($requette);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      $req = "SELECT IFNULL( (select Type from discussion_content where Id_discussion like '" . $row->id_discussion . "' and page like " . $page . " ORDER BY id DESC limit 1) ,'vide') as type";
      $resultat = array('type' => $this->db->query($req)->row()->type);
      echo json_encode($resultat);
    } else {
      echo json_encode(array('type' => 'vide'));
    }
  }

  public function table_resume_crx()
  {
    $this->load->model('global_model');
    $data = $this->global_model->client_crx();
    $resultat = array('message' => false, 'content' => "");
    if ($data) {
      $resultat['message'] = true;
      $resultat['content'] .= '<table class="table dataTable table-hover table-bordered"> <thead class="bg-primary" style="background-color:#428bac;color:#fff;"><tr><th style="color:#fff;">MATRICULE</th><th style="color:#fff;">ID CLIENT</th><th style="color:#fff;">LIENT CLIENT</th></tr></thead><tbody class="tbody">';
      foreach ($data as $key => $data) {
        $resultat['content'] .= "<tr>";
        $resultat['content'] .= '<td>' . $data->Code_client . "</td><td>" . $data->Nom . "</td><td><a href='" . $data->Link_facebook . "'>" . $data->Link_facebook . "</a></td>";
        $resultat['content'] .= "</tr>";
      }
      $resultat['content'] .= '</tbody> </table>';
    }
    echo  json_encode($resultat);
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

  public function Liste_des_produit()
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
    $this->render_view('operatrice/produit/liste_des_produit', $data);
  }

  public function mise_a_jour()
  {
    $this->render_view('operatrice/produit/mise_a_jour');
  }

  public function detailProduit()
  {    
    $this->load->view('operatrice/produit/detailProduit');      
  }
   
  public function detail_clients()
  {
    $this->load->model('global_model');
    $json = array('message' => false, 'color' => '#fff', 'commercial' => false, 'code_commercial' => '', 'codevender' => '');
    $data = $this->global_model->detail_client($this->input->post('codeclient'));
    if ($data) {
      $facture_test = $this->global_model->tes_Facture_statut($this->input->post('codeclient'));
      if ($facture_test) {
        $annule = 0;
        $livre = 0;


        foreach ($facture_test as $facture_test) {

          if ($facture_test->Source_vente == 'TERRAIN' and ($facture_test->Ress_sec_oplg != " " or $facture_test->Ress_sec_oplg != "NONE")) {

            if ($json['commercial'] == false) {
              $json['code_commercial'] = $facture_test->Ress_sec_oplg;
              $json['commercial'] = true;
              $json['codevender'] = substr($facture_test->Ress_sec_oplg, 2, 5);
            }
          }

          if ($facture_test->Status == 'livre') {
            $livre += 1;
          } else if ($facture_test->Status == 'annule') {
            $annule += 1;
          }
        }
        if ($livre >= $annule) {
          $json['color'] = "#007E33";
        } else {
          $json['color'] = "#CC0000";
        }
      }



      $json['message'] = true;
      $json['content'] = $data->Nom . " " . $data->Prenom;
    }

    echo json_encode($json);
  }

  public function Etat_de_ventes()
  {
    $this->load->model('calendrier_model');
    $reponse = $this->calendrier_model->ca_de_vente(date('Y-m-d'));
    $facture = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'Bon_achat' FROM `facture` WHERE `Date` = '".date('Y-m-d')."' AND `Matricule_personnel` = '".$this->session->userdata('matricule')."'");
    $ca_du_jour = 0;
    $produit = 0;
    foreach ($reponse as $reponse) {
      $ca_du_jour += (($reponse->Prix_detail * $reponse->Quantite)-$reponse->Val_bon_achat);
      $produit += $reponse->Quantite;
    }
    $data = [
      'ca_du_jour' => $ca_du_jour-$facture->Bon_achat,
      'produit' => $produit
    ];
    $this->render_view('operatrice/etat_de_vente/etat_de_ventes', $data);
  }
  public function cart()
  {
    $this->render_view('global/cart');
  }

  public function detail_client($idclient)
  {
    $this->load->model('client_model');
    $data = [
      'Infoclient' => $this->client_model->infoclient($idclient)

    ];

    $this->render_view('operatrice/client/detail_client', $data);
  }

  public function calendrier_de_livraison()
  {

    $data = [
      'data' => array()
    ];
    $this->render_view('operatrice/calendrier/calendrier_de_livraison', $data);
  }
  public function color($code)
  {
    $color = array('rep' => '#6f42c1', 'Previ' => '#007bff', 'en_attente' => 'orange', 'confirmer' => "#aa66cc", 'annule' => '#d9534f', 'livre' => '#5cb85c');
    return $color[$code];
  }
  public function detail_vente_com()
  {
    $this->load->model('calendrier_model');
    $i = 0;
    $resultat = array();
    $client = $this->calendrier_model->liste_client_facture($this->input->post('date'), $this->input->post('type'));

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
    $this->load->view('operatrice/calendrier/liste_commande', $data);
  }
  public function detail_de_facture($idfacture)
  {
    $this->load->model('calendrier_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'facture' => $this->calendrier_model->detail_facture_discussion($idfacture)
    ];
    $this->render_view('operatrice/calendrier/detail_facture', $data);
  }

  public function detail_de_facture_Attente($idfacture)
  {
    $this->load->model('calendrier_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'facture' => $this->calendrier_model->detail_facture_discussion($idfacture)
    ];
    $this->render_view('operatrice/calendrier/detail_facture_attente', $data);
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
      $client = $this->calendrier_model->liste_client_facture_export_opl($date, $type);
    }
    foreach ($client as $key => $client) {
      $detail = "";
      $detail = $this->global_model->detail_client($client->Code_client);
      $resultat[$i]['ca'] = 0;
      $resultat[$i]['code_client'] = $client->Id;
      $resultat[$i]['Nom'] = $detail->Nom;
      $resultat[$i]['client_code'] = $client->Code_client;
      $resultat[$i]['produit'] = '';
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
    $excel .=  "Code client\tNum Commande\tClient\tDate de Commande\tDate de Livraison\tLien Facebook\tContact\tProduit\tPU\tQTT\tlieu de livraison\tOPL\tStatut\tQuartier\tVille\tLocalisation\tFrais\n";

    foreach ($resultat as $row) {
      $excel .= "$row[client_code]\t$row[code_client]\t$row[Nom]\t$row[date]\t$row[datediflivre]\t$row[liensurfacebook]\t$row[contact]\t$row[codeproduit]\t$row[prix]\t$row[quantite]\t$row[lieudelivraison]\t$row[OPLG]\t$row[Statut]\t$row[Quartier]\t$row[Ville]\t$row[District]\t$row[frais]\n";
    }

    header("Content-type: application/vnd.ms-excel");
    header("Content-disposition: attachment; filename=vente_" . $type . "_du_" . date('d-m-Y') . ".xls");

    print $excel;
    exit;
  }




  public function detail_des_ventes($date)
  {
    $this->load->model('calendrier_model');
    $previ = 0;
    $livre = 0;
    $en_attente = 0;
    $annule = 0;
    $confirmer = 0;
    if ($this->calendrier_model->ca_de_vente($date)) {
      foreach ($this->calendrier_model->ca_de_vente($date) as $key => $value) {
        $previ += ($value->Quantite * $value->Prix_detail);
      }
    }

    if ($this->calendrier_model->ca_de_vente($date, 'livre')) {
      foreach ($this->calendrier_model->ca_de_vente($date, 'livre') as $key => $value) {
        $livre += ($value->Quantite * $value->Prix_detail);
      }
    }


    if ($this->calendrier_model->ca_de_vente($date, 'en_attente')) {
      foreach ($this->calendrier_model->ca_de_vente($date, 'en_attente') as $key => $value) {
        $en_attente += ($value->Quantite * $value->Prix_detail);
      }
    }

    if ($this->calendrier_model->ca_de_vente($date, 'annule')) {
      foreach ($this->calendrier_model->ca_de_vente($date, 'annule') as $key => $value) {
        $annule += ($value->Quantite * $value->Prix_detail);
      }
    }

    if ($this->calendrier_model->ca_de_vente($date, 'confirmer')) {
      foreach ($this->calendrier_model->ca_de_vente($date, 'confirmer') as $key => $value) {
        $confirmer += ($value->Quantite * $value->Prix_detail);
      }
    }
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $Bonlivre = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'Bon_achat' FROM `facture` WHERE `Date` = '".$dte."' AND `Matricule_personnel` = '".$this->session->userdata('matricule')."'");
    $Bonprevi = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'Bon_achat' FROM `facture` WHERE `Date` = '".$dte."' AND `Matricule_personnel` = '".$this->session->userdata('matricule')."' AND `Status` = ''");
    $BonAttent = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'Bon_achat' FROM `facture` WHERE `Date` = '".$dte."' AND `Matricule_personnel` = '".$this->session->userdata('matricule')."' AND `Status` = 'en_attente'");
    $BonAnnuler = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'Bon_achat' FROM `facture` WHERE `Date` = '".$dte."' AND `Matricule_personnel` = '".$this->session->userdata('matricule')."' AND `Status` = 'annule'");
    $BonConfirmer = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'Bon_achat' FROM `facture` WHERE `Date` = '".$dte."' AND `Matricule_personnel` = '".$this->session->userdata('matricule')."' AND `Status` = 'confirmer'");

   if( $Bonlivre->Bon_achat=="NULL"){
    $Bonlivre->Bon_achat = 0;
   }
   if($Bonprevi->Bon_achat =="NULL"){
    $Bonprevi->Bon_achat = 0;
  }
  if($BonAttent->Bon_achat =="NULL"){
    $BonAttent->Bon_achat = 0;
  }
  if($BonAnnuler->Bon_achat =="NULL"){
    $BonAnnuler->Bon_achat = 0;
  }
  if($BonConfirmer->Bon_achat =="NULL"){
    $BonConfirmer->Bon_achat = 0;
  }

    $data = [
      'previ' => $previ - $Bonprevi->Bon_achat,
      'livre' => $livre - $Bonlivre->Bon_achat,
      'en_attente' => $en_attente - $BonAttent->Bon_achat,
      'annule' => $annule - $BonAnnuler->Bon_achat,
      'confirmer' => $confirmer - $BonConfirmer->Bon_achat,
      'date' => $dte
    ];
    $this->render_view('operatrice/calendrier/detail_des_ventes', $data);
  }

  public function users()
  {
    $this->load->model('global_model');
    $user = $this->global_model->listeUser();
    $NumbreUser = $this->global_model->NumbreUser();
    $data = [
      'user' => $user,
      'NumbreUser' => $NumbreUser
    ];
    $this->render_view('operatrice/user/users', $data);
  }
  public function performance($matricule = FALSE)
  {
    $this->load->model('user_model');
    $datas =  $this->user_model->performance($this->session->userdata('matricule'));
    $client = $this->user_model->nouveauclient(date('Y-m-d'), $this->session->userdata('matricule'));
    /* var_dump($client);
    die();*/
    $data = [
      'data' => $datas,
      'client' => $client
    ];
    $this->render_view('operatrice/user/performance', $data);
  }

  public function Relances_Journaliere()
  {
    $this->load->model('relance_model');

    $data = [
      'relance' => $this->relance_model->relance_du_jour($this->session->userdata('matricule'))
    ];
    $this->render_view('operatrice/Relances/Journaliere', $data);
  }
  public function Relances_Hebdomadaire()
  {
    $data = [
      'data' => array()
    ];
    $this->render_view('operatrice/Relances/Hebdomadaire', $data);
  }
  public function Relances_Mensuelle()
  {
    $data = [
      'data' => array()
    ];
    $this->render_view('operatrice/Relances/Mensuelle', $data);
  }
  //////////////////////OUTILS DE TRAVAIL//////////////////////////// 
  public function Autres()
  {

    $data = [
      'page_user' => $this->global_model->data_page_users($this->session->userdata('matricule')),
      'data_type' => $this->global_model->data_type(),
      'data_tache' => $this->global_model->data_tache()

    ];

    $this->render_view('operatrice/discussion/autres', $data);
  }

  public function Autresin()
  {

    $data = [
      'page_user' => $this->global_model->data_page_users($this->session->userdata('matricule')),
      'data_type' => $this->global_model->data_type(),
      'data_tache' => $this->global_model->data_tache()

    ];

    $this->load->view('operatrice/discussion/autres', $data);
  }
  public function autre_outil()
  {
    $this->load->model('global_model');

    $heure = date("H:i:s");
    $data = [
      'Actions' => $this->input->post('option'),
      'Types' => $this->input->post('type'),
      'Code_publication' => $this->input->post('codepublication'),
      'PageUsers' => $this->input->post('pageUsers'),
      'Code_produit' => $this->input->post('codeproduit'),
      'Nom_produit' => $this->input->post('nomproduit'),
      'Date' => date('Y-m-d'),
      'Heure' => $heure,
      'Code_groupe' => $this->input->post('codegroupe'),
      'Nom_groupe' => $this->input->post('nomgroupe'),
      'user' => $this->session->userdata('matricule'),
      'Lien_support' => $this->input->post('Lien_support'),
      //'Destination'=>$this->input->post('destination')

    ];
    $insertSession = [
      'operatrice' => $this->session->userdata('matricule'),
      'idaction' => $this->input->post('type'),
      'date' => date('Y-m-d'),
      'heure' => date('H:i:s'),
      'page' => $this->input->post('pageUsers'),
      'action' => $this->input->post('option'),
      'tache' => $this->input->post('options')
    ];
    $this->global_model->inserthistorique_discussion_session($insertSession);
    $this->global_model->Autres($data);
  }

  public function sondage()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datas = $this->global_model->tablesondage();
    $content = "";
    if ($datas) {
      $data['message'] = true;

      foreach ($datas as $datas) {
        $content .= "<tr>";
        $content .= "<td>" . $datas->date . "</td><td>" . $datas->type . "</td><td>" . $datas->nom_client . "</td><td>" . $datas->lien_facebook . "</td><td>" . $datas->marque . "</td><td>" . $datas->produit . "</td><td>" . $datas->commentaire . "</td><td>" . $datas->interpretation . "</td>";
        $content .= "</tr>";
      }
    }
    $data = [
      'data' => $content
    ];
    $this->render_view('operatrice/discussion/sondage', $data);
  }
  public function enregistrer_sondage()
  {
    $this->load->model('global_model');
    $lien_facebook = $this->input->post('lien_facebook');
    $Type = $this->input->post('Type');
    $nom_client = $this->input->post('nom_client');
    $marque = $this->input->post('marque');
    $produit = $this->input->post('produit');
    $commentaire = $this->input->post('commentaire');
    $interpretation = $this->input->post('interpretation');

    $data = [
      'date' => date('Y-m-d'),
      'Type' => $Type,
      'nom_client' => $nom_client,
      'lien_facebook' => $lien_facebook,
      'marque' => $marque,
      'produit' => $produit,
      'commentaire' => $commentaire,
      'interpretation' => $interpretation,
    ];
    $this->global_model->sondage($data);
  }

  public function autocomplete_codegroupe()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_codegroupe($term) as $reponse) {
      array_push($array, $reponse->Code_groupe . " | " . $reponse->Nom_groupe . " | " . $reponse->Lien_support);
    }
    echo json_encode($array);
  }
  public function autocomplete_codeproduit()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_codeproduit($term) as $reponse) {
      array_push($array, $reponse->Code_produit . " | " . $reponse->Designation);
    }
    echo json_encode($array);
  }
  public function tableAutre()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datas = $this->global_model->tableAutre();
    if ($datas) {
      $data['message'] = true;
      foreach ($datas as $datas) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td>" . $datas->Date . "</td><td>" . $datas->Heure . "</td><td>" . $datas->Actions . "</td><td>" . $datas->Types . "</td><td>" . $datas->Code_publication . "</td><td>" . $datas->Code_produit . "</td><td>" . $datas->Nom_produit . "</td><td>" . $datas->Code_groupe . "</td><td><a href='" . $datas->Lien_support . "' target='_blank'>" . $datas->Nom_groupe . "</a></td>";
        $data['content'] .= "</tr>";
      }
    }

    echo json_encode($data);
  }

  public function nouveau_codeClient()
  {
    $this->load->model('global_model');
    $type = $this->input->post('type');
    $lastId = $this->global_model->lastCRX();
    $idClient = "";
    if ($type == 'prospect') {
      $id = (int)$lastId->Id + 1;
      $countId = str_split($id);
      $idsep = "";
      for ($i = 0; $i < 7 - count($countId); $i++) {
        $idsep .= '0';
      }
      $codeClient = 'CRX-FB-' . $idsep . $id . "-" . date('Y-m');
    } else if ($type == 'potentiel') {
      $id = (int)$lastId->Id + 1;
      $countId = str_split($id);
      $idsep = "";
      for ($i = 0; $i < 7 - count($countId); $i++) {
        $idsep .= '0';
      }
      $codeClient = 'CRX-FB-' . $idsep . $id . "-" . date('Y-m');
    }
    echo  json_encode($codeClient);
  }

  public function tablesondage()
  {
    $this->load->model('global_model');
    $data = array('message' => false, 'content' => "");
    $datas = $this->global_model->tablesondage();
    if ($datas) {
      $data['message'] = true;
      foreach ($datas as $datas) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td>" . $datas->date . "</td><td>" . $datas->type . "</td><td>" . $datas->nom_client . "</td><td>" . $datas->lien_facebook . "</td><td>" . $datas->marque . "</td><td>" . $datas->produit . "</td><td>" . $datas->commentaire . "</td><td>" . $datas->interpretation . "</td>";
        $data['content'] .= "</tr>";
      }
    }
    echo json_encode($data);
  }

  //////////////////////DISCUSSION////////////////////////////  
  public function test_discussion_en_cours()
  {
    $this->load->model('global_model');
    $data = $this->global_model->test_discussion_en_cours($this->input->post('client'));
    $json = array('id_discussion' => '', 'error' => true);
    if ($data) {
      $json['id_discussion'] = $data->id_discussion;
      $json['error'] = false;
    }
    echo json_encode($json);
  }

  public function listeclients()
  {
    $json = array('error' => true, 'content' => '');
    $this->load->model('global_model');

    $en_cours = $this->global_model->discussion_en_cours();



    if ($en_cours) {
      foreach ($en_cours as $key => $en_cours) {
        $json['content'] .= '<div class="form-group"><span class="client_name collapse">';
        $nom = '';
        $reponse = $this->global_model->retourClient($en_cours->client);
        if ($reponse) {

          $nom = $reponse->Nom;
          $json['content'] .= $reponse->Nom;
        }
        //$rep = $this->global_model->retourClientNom($en_cours->client);
        $json['content'] .= '</span><img class="img-thumbnail client_lat"  data-toggle="tooltip" title="' . $nom . '" alt="' . $nom . '" id="' . $en_cours->client . '" src="' . code_client_img_link($en_cours->client) . '" style="border-radius:50%;width:50px;height:50px"><p>' . $en_cours->nom . ' ' . $en_cours->prenom . '<p></div>';
      }
    }
    echo json_encode($json);
  }


  public function listeclientss()
  {
    $json = array('error' => true, 'content' => '');
    $this->load->model('global_model');

    $en_cours = $this->global_model->sercheClient($this->input->post('client'));



    if ($en_cours) {
      foreach ($en_cours as $key => $en_cours) {
        $json['content'] .= '<div class="form-group"><span class="client_name collapse">';
        $nom = '';
        $reponse = $this->global_model->retourClient($en_cours->Code_client);
        if ($reponse) {
          $nom = $reponse->Nom;
          $json['content'] .= $reponse->Nom;
        }
        $json['content'] .= '</span><img class="img-thumbnail client_lat"  data-toggle="tooltip" title="' . $nom . '" alt="' . $nom . '" id="' . $en_cours->Code_client . '" src="' . code_client_img_link($en_cours->Code_client) . '" style="border-radius:50%;width:50px;height:50px"><p>' . $nom . '<p></div>';
      }
    }
    echo json_encode($json);
  }

  public function Nouveau_discussion()
  {
    $data = [
      'page_user' => $this->global_model->data_page_users($this->session->userdata('matricule')),
      'data_type' => $this->global_model->data_type(),
      'data_tache' => $this->global_model->data_tache(),
      'dataTaches' => $this->global_model->tableAutre()

    ];
    $this->render_view('operatrice/discussion/nouveau', $data);
  }

  public function discussion()
  {
    $this->load->model('global_model');
    $this->load->model('produit_model');
    $json_path_regions = base_url('assets/json/regions.json');
    $json_data_regions = json_decode(read_file($json_path_regions));
    $json_path_age_range = base_url('assets/json/age_range.json');
    $json_data_age_range = json_decode(read_file($json_path_age_range));
    $data = [
      'produit_user' => $this->global_model->produit_user(),
      'en_cours' => $this->global_model->discussion_en_cours(),
      'famille' => $this->global_model->famille(),
      'page' => $this->global_model->userpage(),
      'mission' => $this->global_model->mission(),
      'promotion' => $this->produit_model->promotion(['Pr_Status' => 'en_cours']),
      'data_type' => $this->global_model->produit_users(),
      'regions' =>  $json_data_regions,
      'age_range' => $json_data_age_range,
      'bon_achat' => array()
    ];
    $this->render_view('operatrice/discussion/discussion', $data);
  }

  public function listDataBon(){
    $client = $this->input->post('client');
    $data = $this->global_model->bon_achat(['STATUT' => "actif","CODE_CLIENT"=> $client]);
    $reponse = "<option id='0'></option>";
    foreach ($data as $key => $data) {
      $reponse .= "<option id='$data->VALEUR'>$data->DESIGNATION</option>";
    }
    echo  $reponse;
  }

  public function discussions()
  {
    $this->load->model('global_model');
    $this->load->model('produit_model');
    $data = [
      'produit_user' => $this->global_model->produit_user(),
      'en_cours' => $this->global_model->discussion_en_cours(),
      'famille' => $this->global_model->famille(),
      'page' => $this->global_model->userpage(),
      'mission' => $this->global_model->mission(),
      'promotion' => $this->produit_model->promotion(),
      'data_type' => $this->global_model->produit_users(),
    ];
    $this->load->view('operatrice/discussion/discussion', $data);
  }

  public function dataProduitUser()
  {
    $this->load->model('global_model');
    $sode = $this->input->get('term');
    $produit = $this->input->get('produit');
    $data = $this->global_model->dataProduitUser($sode, $produit);
    $response = array();
    foreach ($data as $key => $data) {
      $response[] = array("value" => $data->CodeDiscussion, "label" => $data->CodeDiscussion . " | " . $data->Content);
    }
    echo  json_encode($response);
  }

  public function dataProduitUsers($sode, $produit)
  {
    $this->load->model('global_model');
    echo  json_encode($this->global_model->dataProduitUsers($sode, $produit));
  }
  public function modifquantite()
  {
    $this->load->model('global_model');
    $idvente = $this->input->post('idvente');
    $quantite = $this->input->post('quantite');
    $this->global_model->modifquantite($idvente, $quantite);
  }

  public function annuleproduit()
  {
    $this->load->model('global_model');
    $idvente = $this->input->post('idvente');
    $this->global_model->annuleproduit($idvente);
  }

  public function changedatefacture()
  {
    $this->load->model('global_model');
    $id = $this->input->post('id');
    $date = $this->input->post('date');
    $this->global_model->updatedate($date, $id);
  }
  public function dettail_vente_modif()
  {
    $facture = $this->input->post('facture');
    $detail = $this->calendrier_model->detail_commande_facture_discussion(trim($facture));
    $detail_facture = $this->calendrier_model->detail_facture_modif(trim($facture));
    $json = array('message' => 'false', 'content' => '', 'total' => 0, 'facture' => '');
    if ($detail) {
      $json['facture'] = $detail_facture->Id;
      foreach ($detail as $detail) {
        $json['content'] .= '<tr><td class="collapse idfacture">' . $detail->Id . '</td><td>' . $detail->Code_produit . '</td><td>' . $detail->Designation . '</td><td>' . number_format($detail->Prix_detail) . '</td><td><input class="Qua" style="width:50px;text-align:center;" type="number" value=' . $detail->Quantite . '></td><td>' . number_format($detail->Prix_detail * $detail->Quantite) . '</td><td><img style="width:50px;" class="img img-thumbnail w-5" src="http://combo.in-expedition.com/images/produit/' . $detail->Code_produit . '.jpg"> </td> <td><a class="btn btn-danger delete_produit" href="#" ><i class="icon_close_alt2"></i></a><a class="btn btn-success edit_produit" href="#"><i class="fa fa-edit"></i></a></td></tr>';
        $json['total'] += ($detail->Prix_detail * $detail->Quantite);
      }
      $json['message'] = 'true';
    }
    echo  json_encode($json);
  }
  public function addProduit()
  {
    $this->load->model('global_model');
    $facture = $this->input->post('facture');
    $idPrix = $this->input->post('idPrix');
    $quantite = $this->input->post('quantite');
    $this->global_model->addProduit($idPrix, $quantite, $facture);
  }

  public function getSessionMatricule()
  {
    echo json_encode(array('tet' => $this->session->get_userdata()["matricule"]));
  }

  public function testPageNom()
  {
    $this->load->model('Page_model');
    $idPage = 1;
    $nomPage = $this->Page_model->getObjectById($idPage)->Nom_page;
    echo json_encode($nomPage);
  }

  public function getIdDiscussionSiExiste($client, $idPage, $operatrice = null)
  {
    $this->load->model('Discussion_model');
    $id = $this->Discussion_model->getIdDiscussionSiExiste($client, $idPage, $operatrice);
    return $id;
  }

  public function insertNouveauDiscussion()
  {
    $this->load->model('Discussion_model');
    $this->load->model('Page_model');
    $operatrice = $this->session->get_userdata()["matricule"];
  
    $client = $this->input->post('codeclient');
    $idPage = $this->input->post('idPage');
    $nomPage = $this->Page_model->getObjectById($idPage)->Nom_page;
    $statut = 'a_suivre';
 
    $id_discussion = $this->getIdDiscussionSiExiste($client, $idPage, $operatrice);
 
    if ( strtoupper($id_discussion) == 'NULL' OR $id_discussion=='') {
      $id_discussion = $this->Discussion_model->generate_id_discussion();
      $requette = "insert into discussion VALUES(DEFAULT,'" . $id_discussion . "','" . $operatrice . "','" . $client . "','" . $idPage . "','" . $statut . "')";
      if ($this->db->simple_query($requette)) {
        $parametre = [
          "Page" => $idPage,
          "Type" => 'message',
          'sender' => 'OPL',
          "Id_discussion" => $id_discussion,
          "Message" => 'Faly miarahaba anao tongasoa eto amin page'
        ];
        if ($this->Discussion_model->Insert_discussion_content($parametre)) {
          echo json_encode(array('message' => 'insertion content reussit', 'idDiscussion' => $id_discussion));
        } else {
          echo json_encode(array('message' => 'insertion content echoué'));
        }
      } else {
        echo json_encode(array('message' => 'insertion echoué'));
      }
    } else {

      $parametre = [
        "Page" => $idPage,
        "Type" => 'message',
        'sender' => 'OPL',
        "Id_discussion" => $id_discussion,
        "Message" => 'Faly miarahaba anao tongasoa eto amin page'
      ];

      if ($this->Discussion_model->Insert_discussion_content($parametre)) {
        echo json_encode(array('message' => 'insertion content reussit', 'idDiscussion' => $id_discussion));
      } else {
        echo json_encode(array('message' => 'insertion content echoué'));
      }
    }
  }

  public function testIfClientPo()
  {
    $lienFb = $this->input->post('lienFb');
    $this->load->model('Client_model');
    echo $this->Client_model->test_if_clientpo($lienFb);
  }

  public function get_message_bienvenu()
  {
    $idPage = $this->input->post('idPage');
    $this->load->model('Page_model');
    echo $this->Page_model->getById($idPage);
  }

  public function insertDetailPage()
  {
    $idPage = $this->input->post('idPage');
    $codeClient = $this->input->post('codeClient');
    $requette = "insert into detail_page_client VALUES(DEFAULT,'" . $codeClient . "'," . $idPage . ")";
    if ($this->db->simple_query($requette)) {
      echo json_encode(array('message' => 'insertion reussit', 'inserer' => true, 'idPage' => $idPage));
    } else {
      echo json_encode(array('message' => 'insertion echoué', 'inserer' => false, 'idPage' => -1));
    }
  }

  public function insertClientPo()
  {
    $this->load->model('Client_model');
    $json = array('message' => 'insertion echoué');
    $lienFb = $this->input->post('lienFb');
    $requette = "SELECT * FROM clientpo where lien_facebook like '" . $lienFb . "' ";
    $json = array('message' => 'client existe deja');
    if ($this->db->query($requette)->num_rows() == 0) {
      $requette = "SELECT * FROM client_curieux where lien_facebook like '" . $lienFb . "' LIMIT 1";
      $client = $this->db->query($requette)->row_array();
      if (isset($client)) {
        unset($client['id']);
        unset($client['Id']);
        $id = $this->Client_model->get_next_clientpo_Id();
        $code_Client = $this->Client_model->generate_Code_clientpo($id);
        $client['Provenance'] = $client['Code_client'];
        $client['Code_client'] = $code_Client;
        $insertRequette = $this->db->set($client)->get_compiled_insert('clientpo');
        $this->db->simple_query($insertRequette);
        $json = array('message' => 'insertion reussit', 'codeClient' => $code_Client);
        $old = FCPATH . "images/client/" . $client['Provenance'] . ".jpg";
        $new = FCPATH . "images/client/" . $code_Client . ".jpg";
        if (file_exists($old)) {
          rename($old, $new);
        }
      } else {
        $json = array('message' => $requette);
      }
    }
    echo json_encode($json);
  }

  public function get_liste_page()
  {
    $this->load->model('Page_model');
    echo json_encode($this->Page_model->getAllPage()->result());
  }

  public function get_id_page_by_nom()
  {
    $this->load->model('Page_model');
    $page = $this->input->post('page');
    echo json_encode(array('id' => $this->Page_model->getByNom($page)->result()->id));
  }

  public function testDiscution()
  {
    $this->load->model('global_model');
    $this->load->model('calendrier_model');
    $json = array('message' => false, 'content' => '');
    $client = $this->input->post('idclient');
    $page = $this->input->post('page');
    $data = $this->global_model->testDiscution($client, $page);
    $text = array('livre' => 'LIVREE', 'annule' => 'ANNULLEE', 'en_attente' => 'EN ATTENTE', 'confirmer' => 'CONFIRMEE', 'repporter' => 'REPPORTEE');
    if ($data) {
      $json['message'] = true;
      $json['id_discussion'] = $data->id_discussion;
      $date = 'int';
      foreach ($this->global_model->all_detail_discussion($client, $page) as $key => $reponse) {
        $heure = explode(" ", $reponse->heure);
        $heure[1] = date("H:i:s");
        if ($reponse->Page == $page) {
          if ($reponse->sender == 'OPL') {
            if ($reponse->Type == 'image') {
              $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;color:#000; word-break: break-all!important;margin-left:90px "><img class="img-thumbnail" src="' . base_url("/images/pieceJoint/$reponse->Message.jpg") . '" alt="' . $reponse->Message . '" style="width:120px;height:120px;object-fit:cover;"></div>';
            } else  if ($reponse->Type == 'rendez-vous') {
              $dataRvd = $this->global_model->selectRendeVous(["date" => $reponse->date, "heure" => $reponse->heures, "codeclient" => $client, "page" => $reponse->Page]);
              if ($dataRvd) {
                $pagess =  $this->global_model->comptefbDetail(['id' => $dataRvd->page]);
                $json['content'] .= "<div style='background:#F8BBD0;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; margin-left:90px'> Rendez-vous le " . $dataRvd->date . " à " . $dataRvd->heure . " sur la page " . $pagess->Nom_page . "</div>";
              } else {
                $json['content'] .= "<div></div>";
              }
            } else if (trim($reponse->Type) == 'vente') {
              $total = 0;
              $remise = "";
              $totatsmilekotyFinal = "";
              $teststatut = $this->global_model->getstatutclient($client);

              foreach ($teststatut as $value) {
                $smiles = $value->smile;
                $koty = $value->koty;
              }
              $totalsmilekoty = $this->global_model->gettotalsmileskotys($client);
              foreach ($totalsmilekoty as $value) {
                $smilesT = $value->smiles;
                $kotyT = $value->koty;
                $totatsmilekotyFinal = $smilesT . " Smiles | " . $kotyT . " Koty ";
              }
              $statuttrim = $this->global_model->getclientstatuttrimes($smilesT);
              $statutannuel = $this->global_model->getclientstatutAnnuel($smilesT);

              $detailkotysmiles = $this->global_model->getkotysmiletotalpossible(trim($reponse->Message));


              foreach ($detailkotysmiles as $value) {
                $totatalgainpossible =  $value->smiles . " Smiles  | " . $value->koty . " Koty ";
              }
              $detailkotsmilesqtt = $this->global_model->getkotyetsmilesdetail(trim($reponse->Message));
              $tableaudetailkotesmiles = "";
              foreach ($detailkotsmilesqtt as $key =>  $value) {
                $tableaudetailkotesmiles .= substr($value->Designation, 0, 50) . " <br> " . $value->smiles . " Smiles " . " <br> " . $value->koty . " koty " . " <br> " . $value->Quantite . " Qtt <br>";
              }
              $detail = $this->calendrier_model->detail_commande_facture_discussion(trim($reponse->Message));
              $livraison = $this->calendrier_model->detail_facture_discussion(trim($reponse->Message));
              $bon_achat = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'bonAchat' FROM `facture` WHERE `Id_facture` = '".trim($reponse->Message)."'");
       
              if ($detail) {
                $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left:90px;font-size:12px"><div style="padding:5px 10px;text-align:left"> Raha fintinina izany ny commande nao dia : <br> Vokatra : ';
                foreach ($detail as $key => $detail) {
                  $json['content'] .= substr($detail->Designation, 0, 60) . '<br> Miisa : ' . $detail->Quantite . '<br> Vidiny : ' . number_format($detail->Prix_detail) . ' Ar<br/> ';
                  $remise .= substr($detail->Designation, 0, 50) . " : <br><b> &nbsp; &nbsp; &nbsp; &nbsp; -Gain Smiles : " . $detail->Smile_LV1 . "  <br> &nbsp; &nbsp; &nbsp; &nbsp; -Gain Koty : " . $detail->Zen_LV1 . " </br></b>";

                  $total += ($detail->Quantite * $detail->Prix_detail);
                }
               
                $json['content'] .= '<br><span><b> Localité : ' . $livraison->Localite . '</span>';
                $json['content'] .= '<br>Quartier:' . $livraison->Quartier . "&nbsp;,&nbsp;" . $livraison->Ville . '<br> Toerana : ' . $livraison->lieu_de_livraison . '<br> Contact 1 : ' . $livraison->contacts . '<br> Contact 2 : ' . $livraison->Contact_livraison . '<br>Date de livraison : ' .  $livraison->date_de_livraison . " " . '<br>Frais de livraison : ' . $livraison->frais . ' Ar' . '<br> Frais de Retrait : ' . $livraison->frais_de_retrait . ' Ar' . " " . $livraison->heure_deb_livre . $livraison->heure_fi_livre . '';
                $json['content'] .= "<br><span><b> Bon d'achat : ".$bon_achat->bonAchat ." ar</span>";
               
                if ($livraison->Status == 'livre') {
                  if ($livraison->frais_de_retrait == '') {
                    $fraisRetrait = 0;
                  } else {
                    $fraisRetrait = $livraison->frais_de_retrait;
                  }
                  $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait - $bon_achat->bonAchat, 2, ',', ' ') . ' Ar <div class="modify"><button id="' . trim($reponse->Message) . '" class="btn btn-success disabled text-center modify btn-sm" style="margin-left:400px;color:#fff;border-radius:10px"><b>' . $text[$livraison->Status] . '</button></div></span>';

                

                } else if ($livraison->Status == 'annule') {
                  if ($livraison->frais_de_retrait == '') {
                    $fraisRetrait = 0;
                  } else {
                    $fraisRetrait = $livraison->frais_de_retrait;
                  }
                  $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait - $bon_achat->bonAchat) . ' Ar <div class="modify"><button class="btn btn-danger disabled text-center btn-sm"  id="' . trim($reponse->Message) . '" style="margin-left:400px;color:#fff;border-radius:10px">' . $text[$livraison->Status] . '</button></div></span>';
                } else {
                  if ($livraison->frais_de_retrait == '') {
                    $fraisRetrait = 0;
                  } else {
                    $fraisRetrait = $livraison->frais_de_retrait;
                  }
                  $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait - $bon_achat->bonAchat, 2, ',', ' ') . ' Ar </b> <div class="modify"><button class="btn btn-dark disabled text-center "  id="' . trim($reponse->Message) . '" style="margin-left:400px;color:#000;border-radius:10px ">' . $text[$livraison->Status] . '</b></button></div></span>';
                }
                $json['content'] .= '<br><span><b>' . $livraison->Matricule_personnel . '</span>';
                $json['content'] .= '<br><span><b>' . $livraison->Code_client . '</span>';
                $vardata = $this->global_model->retour_page($reponse->Page);
                $page = "";
                if ($livraison->permission == 'on') {
                  $lock = '<i class="fa fa-unlock-alt" id="lock" style="font-size:20px;" aria-hidden="true"></i>';
                } else {
                  $lock = '<i class="fa fa-lock" id="lock"  style="font-size:20px;" aria-hidden="true"></i>';
                }
                if ($vardata) {
                  $page = $reponse->Page;
                }

                $mykote = 0;
                $mysmile = 0;
                $kotsisa = $this->global_model->kotyclientreste($livraison->Code_client);
                foreach ($kotsisa as $value) {
                  $mykote = $value->Koty;
                }

                $smilesisa = $this->global_model->smileclientreste($livraison->Code_client);
                foreach ($smilesisa as $value) {
                  $mysmile = $value->smile;
                }


                $smiletrim = $this->global_model->getsmileclienttrim($livraison->Code_client);
                foreach ($smiletrim as $value) {
                  $momsmile = $value->smiles;
                }

                $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000;  word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a"><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;' . $lock . '&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
                $json['content'] .= '</div></div> <div style="background:#ffbb33;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px;text-align:left;padding:10px 15px;font-size:12px "><b style="font-size:16px" class="text-left">Fanamarihana 2!</b><br/>  Raha toa ka livré  ireo vokatra nataonao commande  ireo <br> dia hisy  fihenam-bidy atolotra ho anao <br>' . $remise . ' - 
              Gain Total-ny fanomezana ho azonao :<b> <br>  &nbsp; &nbsp; &nbsp; &nbsp; - ' . $totatalgainpossible . ' </b></div></div>';
                $json['content'] .= '</div></div> <div style="background:#00B74A;padding: 5px 20px;border-radius:10px;margin-bottom:10px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px ;text-align:left "><h2 style="font-size:12px;font-weight:bold"> Ny Statut anao amin izao fotoana izao  dia </h2>- <b>STATUT ACTUEL : <span style="background:#fff;border-radius:3px; padding:3px 5px"><b> ' . $statutannuel . ' | ' . $statuttrim . '     </b> </span> <br> <br> <b>TOTAL KOTY ET SMILES ACTUEL : 
               <span style=""><b><br>  &nbsp;&nbsp;&nbsp;&nbsp; - ' . number_format($mykote) . ' Koty  <br> &nbsp;&nbsp;&nbsp;&nbsp; - ' . number_format($momsmile) . ' Smiles  </b> </span> <br> <h2 style="font-size:12px;font-weight:bold"> *  Ampiasaina mialoha ny : 30 juin 2023 </div></div>';
              } else if (trim($reponse->Type) == 'termier') {
                $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">Terminée&nbsp;le&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid red;margin-top:-10px">';
              } else if (trim($reponse->Type) == 'NouvelleDiscussion') {
                $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">Nouvelle&nbsp;Discussion&nbsp;le&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid green;margin-top:-10px">';
              } else if (trim($reponse->Type) == 'a suivre') {
                $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">A&nbsp;Suivre&nbsp;Depuis&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid orange;margin-top:-10px">';
              } else {
                $vardata = $this->global_model->retour_page($reponse->Page);
                $page = "";
                if ($vardata) {
                  $page = $reponse->Page;
                }
                $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
              }
            } else {
              if ($reponse->sender == 'CLT') {
                $json['content'] .= '<div style="background:#b2ebf2  ;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp; <i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
              } else {
                $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;margin-top:5px;text-align:left">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
              }
            }
          } else if ($reponse->sender == 'CLT') {
            if ($reponse->Type == 'image') {
              $json['content'] .= '<div class="form-control pt-1 pl-1 pb-1" style="background:#b2ebf2;min-height:135px;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; "><img class="img-thumbnail" src="' . base_url("/images/pieceJoint/$reponse->Message.jpg") . '"  style="height:120px;width:120px;object-fit:cover"></div>';
            } else {
              $vardata = $this->global_model->retour_page($reponse->Page);
              $page = "";
              if ($vardata) {
                $page = $reponse->Page;
              }
              $json['content'] .= '<div style="background:#b2ebf2  ;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;text-align:left"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:12px;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp; <i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
            }
          }
          if ($date != $heure[0]) {
            $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">' . $heure[0] . '</span></div><hr style="border: 1px solid #ccc;margin-top:-10px">';
            $date = $heure[0];
          }
        }
      }
    }
    echo json_encode($json);
  }

  public function detail_discussion($id_mission = FALSE)
  {
    $this->load->model('global_model');
    if ($id_mission == FALSE) {
      $id_mission = $this->input->post('idmission');
    }
    return $this->global_model->detail_discussion($id_mission);
  }

  public function changeStatutDiscussion()
  {
    $this->load->model('global_model');
    $id_discussion = $this->input->post('id_discussion');
    $statut = $this->input->post('statut');
    $this->global_model->changeStatutDiscussion($id_discussion, $statut);
    echo json_encode(array('message' => true));
  }

  public function testDiscussionSiExiste()
  {
    $this->load->model('global_model');
    $client = $this->input->post('client');
    $json = array('exist' => false, 'content' => '');
    $requette = "select * from discussion where client like '" . $client . "'";
    $resultat = $this->db->query($requette);
    if ($resultat->num_rows() > 0) {
      $row = $resultat->row();
      $json['exist'] = true;
      $json['content'] = $row->id_discussion;
    }
    echo json_encode($json);
  }

  public function testDiscAvecPageSiExiste()
  {
    $this->load->model('global_model');
    $client = $this->input->post('client');
    $idPage = $this->input->post('idPage');
    $json = array('exist' => false, 'content' => '');

    $requette = "select * from discussion where page like '" . $idPage . "' and client like '" . $client . "' ";
    $resultat = $this->db->query($requette);
    if ($resultat->num_rows() > 0) {
      $row = $resultat->row();
      $json['exist'] = true;
      $json['content'] = $row->id_discussion;
    }
    echo json_encode($json);
  }

  public function getDiscussionCode()
  {
    $this->load->model('global_model');
    $client = $this->input->post('client');
    $idPage = $this->input->post('idPage');
    $json = array('error' => false, 'content' => '');
    $requette = "select * from discussion where page like '" . $idPage . "' and client like '" . $client . "'";
    $resultat = $this->db->query($requette);
    if ($resultat->num_rows() > 0) {
      $row = $resultat->row();
      $json['content'] = $row->id_discussion;
    } else {
      $id = (int)$this->global_model->id_discussion() + 1;
      $codeDis = "DISC-" . $id . "-" . date('d-Y');
      $json['content'] = $codeDis;
      $this->global_model->creatDiscussion($codeDis, $client);
    }
    echo json_encode($json);
  }

  public function new_discussion()
  {
    $this->load->model('global_model');
    $client = $this->input->post('client');
    $json = array('error' => false, 'content' => '');
    echo json_encode($json);
  }

  public function migrate_clietns()
  {
    $json = array('error' => true, 'content' => '');
    $detail = $this->global_model->detail_CRX($this->input->post('client'));
    if ($detail) {
      $new_fact = $this->migreclient_newcontact($detail->Code_client, $detail->Nom, $detail->Prenom, $detail->Compte_facebook, $detail->Matricule_personnel, $detail->lien_facebook, $detail->Coach, $detail->Commercial, $detail->password, $detail->pseudo);
      $json['error'] = false;
      $json['content'] = $new_fact;
    }
    echo json_encode($json);
  }

  public function migreclient_newcontact($client, $Nom, $Prenom, $Compte_facebook, $Operatrice, $lien_facebook, $coatch, $Commercial, $pass, $pseudo)
  {
    $this->load->model('global_model');
    $id = $this->global_model->lastCMT();
    if ($id) {
      $count = count(str_split($id->id));
      $idtemps = $id->id + 1;
    } else {
      $idtemps = 1;
      $count = 0;
    }
    $idtemp = "";
    for ($i = 0; $i < 7 - $count; $i++) {
      $idtemp .= "0";
    }

    $idclient = 'CMT-FB-' . $idtemp . $idtemps . "-" . date('Y-m');
    $data = [
      'Code_client' => $idclient,
      'Nom' => $Nom,
      'Prenom' => $Prenom,
      'Compte_facebook' => $Compte_facebook,
      'Matricule_personnel' => $Operatrice,
      'lien_facebook' => $lien_facebook,
      'datedenregistrement' => date('Y-m-d'),
      'Coach' => $coatch,
      'Commercial' => $Commercial,
      'password' => $pass,
      'pseudo' => $pseudo,
      'Provenance' => $client
    ];

    $this->global_model->migreCMT($data);
    if (file)
      $old = FCPATH . "images/client/" . $client . ".jpg";
    $new = FCPATH . "images/client/" . $idclient . ".jpg";
    if (file_exists($old)) {
      rename($old, $new);
    }

    return $idclient;
  }

  public function migreclient($client, $Nom, $Prenom, $Compte_facebook, $Operatrice, $lien_facebook, $coatch, $Commercial, $pass, $pseudo)
  {
    $this->load->model('global_model');
    $id = $this->global_model->lastCMT();
    if ($id) {
      $count = count(str_split($id->id));
      $idtemps = $id->id + 1;
    } else {
      $idtemps = 1;
      $count = 0;
    }
    $idtemp = "";
    for ($i = 0; $i < 7 - $count; $i++) {
      $idtemp .= "0";
    }

    $idclient = 'CMT-FB-' . $idtemp . $idtemps . "-" . date('Y-m');
    $data = [
      'Code_client' => $idclient,
      'Nom' => $Nom,
      'Prenom' => $Prenom,
      'Compte_facebook' => $Compte_facebook,
      'Matricule_personnel' => $Operatrice,
      'lien_facebook' => $lien_facebook,
      'datedenregistrement' => date('Y-m-d'),
      'Coach' => $coatch,
      'Commercial' => $Commercial,
      'password' => $pass,
      'pseudo' => $pseudo,
      'Provenance' => $client
    ];

    $this->global_model->migreCMT($data);
    $this->global_model->migration_facture($idclient, $client);
    $this->global_model->migration_discussion($idclient, $client);
    if (file)
      $old = FCPATH . "images/client/" . $client . ".jpg";
    $new = FCPATH . "images/client/" . $idclient . ".jpg";
    if (file_exists($old)) {
      rename($old, $new);
    }

    return $idclient;
  }

  public function sauvemessage()
  {
    $this->load->model('global_model');
    $page = $this->input->post('page');
    $id_discussion = $this->input->post('id_con');
    $client = $this->input->post('client');
    $tache = $this->session->userdata('tache');
    $operatrice = $this->session->userdata('matricule');
    $id_discussion = $this->getIdDiscussionSiExiste($client, $page, $operatrice);
    if ($id_discussion == 'null') {
      $statut = 'a_suivre';
      $id_discussion = $this->Discussion_model->generate_id_discussion();
      $requette = "insert into discussion VALUES(DEFAULT,'" . $id_discussion . "','" . $operatrice . "','" . $client . "','" . $page . "','" . $statut . "')";
      $this->db->simple_query($requette);
    }
    $insertSession = [
      'operatrice' => $operatrice,
      'client' => $client,
      'idaction' => $id_discussion,
      'date' => date('Y-m-d'),
      'heure' => date('H:i:s'),
      'page' => $this->input->post('page'),
      'action' => $this->input->post('Type'),
      'sender' => $this->input->post('sender'),
      'types' => $this->input->post('types'),
      'tache' => $this->input->post('tache')

    ];
    $this->global_model->inserthistorique_discussion_session($insertSession);

    $this->global_model->insertMessageSimples($this->input->post('message'), $this->input->post('Type'), $this->input->post('sender'), $id_discussion, $this->input->post('idRep'), $this->input->post('page'), $this->input->post('date'), $this->input->post('heure'));
    $json = array('message' => true, 'content' => '', 'new_id' => '', 'statut' => 'en attente', 'idDisc' => $id_discussion);
    $json['message'] = true;
    $date = "";
    $typeDisc = "en attente";
    $text = array('livre' => 'LIVREE', 'annule' => 'ANNULLEE', 'en_attente' => 'EN ATTENTE', 'confirmer' => 'CONFIRMEE', 'repporter' => 'REPPORTEE');
    if ($this->input->post('sender') == 'CLT') {
      $NB = $this->global_model->test_nb_discussion_client($id_discussion);
      if ($NB > 0) {
        $response = $this->global_model->test_nb_matricule_client($id_discussion);
        if ($response) {
          if (strpos($response->client, "CRX") !== FALSE) {
            $detail = $this->global_model->detail_CRX($response->client);
          }
        }
      }
    }

    foreach ($this->global_model->all_detail_discussion($client, $page) as $key => $reponse) {
      $typeDisc = $reponse->Type;
      $heure = explode(" ", $reponse->heure);
      if ($reponse->Page == $page) {
        if ($reponse->sender == 'OPL') {
          if ($reponse->Type == 'image') {
            $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; margin-left:90px"><img class="img-thumbnail" src="' . base_url("/images/pieceJoint/$reponse->Message.jpg") . '" alt="' . $reponse->Message . '" width="100" height="100"></div>';
          } else if ($reponse->Type == 'rendez-vous') {
            $dataRvd = $this->global_model->selectRendeVous(["date" => $reponse->date, "heure" => $reponse->heures, "codeclient" => $client, "page" => $reponse->Page]);
            if ($dataRvd) {
              $pagess =  $this->global_model->comptefbDetail(['id' => $dataRvd->page]);
              $json['content'] .= '<div style="background:#F8BBD0;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"> Rendez-vous le ' . $dataRvd->date . ' à ' . $dataRvd->heure . ' sur la page ' . $pagess->Nom_page . '</div>';
            } else {
              $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
            }
          } else if (trim($reponse->Type) == 'vente') {
            $total = 0;
              $remise = "";
              $totatsmilekotyFinal = "";
              $teststatut = $this->global_model->getstatutclient($client);

              foreach ($teststatut as $value) {
                $smiles = $value->smile;
                $koty = $value->koty;
              }
              $totalsmilekoty = $this->global_model->gettotalsmileskotys($client);
              foreach ($totalsmilekoty as $value) {
                $smilesT = $value->smiles;
                $kotyT = $value->koty;
                $totatsmilekotyFinal = $smilesT . " Smiles | " . $kotyT . " Koty ";
              }
              $statuttrim = $this->global_model->getclientstatuttrimes($smilesT);
              $statutannuel = $this->global_model->getclientstatutAnnuel($smilesT);

              $detailkotysmiles = $this->global_model->getkotysmiletotalpossible(trim($reponse->Message));


              foreach ($detailkotysmiles as $value) {
                $totatalgainpossible =  $value->smiles . " Smiles  | " . $value->koty . " Koty ";
              }
              $detailkotsmilesqtt = $this->global_model->getkotyetsmilesdetail(trim($reponse->Message));
              $tableaudetailkotesmiles = "";
              foreach ($detailkotsmilesqtt as $key =>  $value) {
                $tableaudetailkotesmiles .= substr($value->Designation, 0, 50) . " <br> " . $value->smiles . " Smiles " . " <br> " . $value->koty . " koty " . " <br> " . $value->Quantite . " Qtt <br>";
              }
              $detail = $this->calendrier_model->detail_commande_facture_discussion(trim($reponse->Message));
              $livraison = $this->calendrier_model->detail_facture_discussion(trim($reponse->Message));
              $bon_achat = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'bonAchat' FROM `facture` WHERE `Id_facture` = '".trim($reponse->Message)."'");
              if ($detail) {
                $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left:90px;font-size:12px"><div style="padding:5px 10px;text-align:left"> Raha fintinina izany ny commande nao dia : <br> Vokatra : ';
                foreach ($detail as $key => $detail) {
                  $json['content'] .= substr($detail->Designation, 0, 60) . '<br> Miisa : ' . $detail->Quantite . '<br> Vidiny : ' . number_format($detail->Prix_detail) . ' Ar<br/> ';
                  $remise .= substr($detail->Designation, 0, 50) . " : <br><b> &nbsp; &nbsp; &nbsp; &nbsp; -Gain Smiles : " . $detail->Smile_LV1 . "  <br> &nbsp; &nbsp; &nbsp; &nbsp; -Gain Koty : " . $detail->Zen_LV1 . " </br></b>";

                  $total += ($detail->Quantite * $detail->Prix_detail);
                }
               
                $json['content'] .= '<br><span><b> Localité : ' . $livraison->Localite . '</span>';
                $json['content'] .= '<br>Quartier:' . $livraison->Quartier . "&nbsp;,&nbsp;" . $livraison->Ville . '<br> Toerana : ' . $livraison->lieu_de_livraison . '<br> Contact 1 : ' . $livraison->contacts . '<br> Contact 2 : ' . $livraison->Contact_livraison . '<br>Date de livraison : ' .  $livraison->date_de_livraison . " " . '<br>Frais de livraison : ' . number_format($livraison->frais) . ' Ar' . '<br> Frais de Retrait : ' . $livraison->frais_de_retrait . ' Ar' . " " . $livraison->heure_deb_livre . $livraison->heure_fi_livre . '';
                $json['content'] .= "<br><span><b> Bon d'achat : ".number_format($bon_achat->bonAchat, 2, ',', ' ') ." ar</span>";
               
                if ($livraison->Status == 'livre') {
                  if ($livraison->frais_de_retrait == '') {
                    $fraisRetrait = 0;
                  } else {
                    $fraisRetrait = $livraison->frais_de_retrait;
                  }
                  $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait - $bon_achat->bonAchat) . ' Ar <div class="modify"><button id="' . trim($reponse->Message) . '" class="btn btn-success disabled text-center modify btn-sm" style="margin-left:400px;color:#fff;border-radius:10px"><b>' . $text[$livraison->Status] . '</button></div></span>';
                } else if ($livraison->Status == 'annule') {
                  if ($livraison->frais_de_retrait == '') {
                    $fraisRetrait = 0;
                  } else {
                    $fraisRetrait = $livraison->frais_de_retrait;
                  }
                  $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait - $bon_achat->bonAchat) . ' Ar <div class="modify"><button class="btn btn-danger disabled text-center btn-sm"  id="' . trim($reponse->Message) . '" style="margin-left:400px;color:#fff;border-radius:10px">' . $text[$livraison->Status] . '</button></div></span>';
                } else {
                  if ($livraison->frais_de_retrait == '') {
                    $fraisRetrait = 0;
                  } else {
                    $fraisRetrait = $livraison->frais_de_retrait;
                  }
                  $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait - $bon_achat->bonAchat) . ' Ar </b> <div class="modify"><button class="btn btn-dark disabled text-center "  id="' . trim($reponse->Message) . '" style="margin-left:400px;color:#000;border-radius:10px ">' . $text[$livraison->Status] . '</b></button></div></span>';
                }
                $json['content'] .= '<br><span><b>' . $livraison->Matricule_personnel . '</span>';
                $json['content'] .= '<br><span><b>' . $livraison->Code_client . '</span>';
                $vardata = $this->global_model->retour_page($reponse->Page);
                $page = "";
                if ($livraison->permission == 'on') {
                  $lock = '<i class="fa fa-unlock-alt" id="lock" style="font-size:20px;" aria-hidden="true"></i>';
                } else {
                  $lock = '<i class="fa fa-lock" id="lock"  style="font-size:20px;" aria-hidden="true"></i>';
                }
                if ($vardata) {
                  $page = $reponse->Page;
                }

                $mykote = 0;
                $mysmile = 0;
                $kotsisa = $this->global_model->kotyclientreste($livraison->Code_client);
                foreach ($kotsisa as $value) {
                  $mykote = $value->Koty;
                }

                $smilesisa = $this->global_model->smileclientreste($livraison->Code_client);
                foreach ($smilesisa as $value) {
                  $mysmile = $value->smile;
                }


                $smiletrim = $this->global_model->getsmileclienttrim($livraison->Code_client);
                foreach ($smiletrim as $value) {
                  $momsmile = $value->smiles;
                }

                $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000;  word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a"><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;' . $lock . '&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
                $json['content'] .= '</div></div> <div style="background:#ffbb33;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px;text-align:left;padding:10px 15px;font-size:12px "><b style="font-size:16px" class="text-left">Fanamarihana 2!</b><br/>  Raha toa ka livré  ireo vokatra nataonao commande  ireo <br> dia hisy  fihenam-bidy atolotra ho anao <br>' . $remise . ' - 
              Gain Total-ny fanomezana ho azonao :<b> <br>  &nbsp; &nbsp; &nbsp; &nbsp; - ' . $totatalgainpossible . ' </b></div></div>';
                $json['content'] .= '</div></div> <div style="background:#00B74A;padding: 5px 20px;border-radius:10px;margin-bottom:10px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px ;text-align:left "><h2 style="font-size:12px;font-weight:bold"> Ny Statut anao amin izao fotoana izao  dia </h2>- <b>STATUT ACTUEL : <span style="background:#fff;border-radius:3px; padding:3px 5px"><b> ' . $statutannuel . ' | ' . $statuttrim . '     </b> </span> <br> <br> <b>TOTAL KOTY ET SMILES ACTUEL : 
               <span style=""><b><br>  &nbsp;&nbsp;&nbsp;&nbsp; - ' . number_format($mykote) . ' Koty  <br> &nbsp;&nbsp;&nbsp;&nbsp; - ' . number_format($momsmile) . ' Smiles  </b> </span> <br> <h2 style="font-size:12px;font-weight:bold"> *  Ampiasaina mialoha ny : 30 juin 2023 </div></div>';
              } else if (trim($reponse->Type) == 'termier') {
                $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">Terminée&nbsp;le&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid red;margin-top:-10px">';
              } else if (trim($reponse->Type) == 'NouvelleDiscussion') {
                $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">Nouvelle&nbsp;Discussion&nbsp;le&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid green;margin-top:-10px">';
              } else if (trim($reponse->Type) == 'a suivre') {
                $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">A&nbsp;Suivre&nbsp;Depuis&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid orange;margin-top:-10px">';
              } else {
                $vardata = $this->global_model->retour_page($reponse->Page);
                $page = "";
                if ($vardata) {
                  $page = $reponse->Page;
                }
                $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
              }
            }
        } else if ($reponse->sender == 'CLT') {
          if ($reponse->Type == 'image') {
            $json['content'] .= '<div class="form-control" style="background:#b2ebf2;min-height:140px;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word;"><img  src="' . base_url("/images/pieceJoint/$reponse->Message.jpg") . '" alt="' . $reponse->Message . '" class="img-thumbnail" style="width:120px;height:120px;object-fit:cover"></div>';
          } else {
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#b2ebf2  ;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
          }
        }
        if ($date != $heure[0]) {
          $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">' . $heure[0] . '</span></div><hr style="border: 1px solid #ccc;margin-top:-10px">';
          $date = $heure[0];
        }
      }
    }
    $json['statut'] = $typeDisc;
    echo json_encode($json);
  }

  public function sauvemessages()
  {
    $this->load->model('global_model');
    $page = $this->input->post('page');
    $id_discussion = $this->input->post('id_con');
    $client = $this->input->post('client');
    $operatrice = $this->session->userdata('matricule');
    $id_discussion = $this->getIdDiscussionSiExiste($client, $page, $operatrice);
    $tache = $this->session->userdata('tache');
    $statut = 'a_suivre';
    if ($id_discussion == 'null') {
      $id_discussion = $this->Discussion_model->generate_id_discussion();
      $requette = "insert into discussion VALUES(DEFAULT,'" . $id_discussion . "','" . $operatrice . "','" . $client . "','" . $page . "','" . $statut . "')";
      $this->db->simple_query($requette);
    }
    $insertSession = [
      'operatrice' => $operatrice,
      'client' => $client,
      'idaction' => $id_discussion,
      'date' => date('Y-m-d'),
      'heure' => date('H:i:s'),
      'page' => $this->input->post('page'),
      'action' => $this->input->post('Type'),
      'sender' => $this->input->post('sender'),
      'types' => $this->input->post('types'),
      'tache' => $this->input->post('tache')
    ];
    $this->global_model->inserthistorique_discussion_session($insertSession);

    $this->global_model->insertMessageSimples($this->input->post('message'), $this->input->post('Type'), $this->input->post('sender'), $id_discussion, $this->input->post('idRep'), $this->input->post('page'), $this->input->post('date'), $this->input->post('heure'), $this->input->post('types'));
    //$this->global_model->insertMessageSimples($this->input->post('message'),$this->input->post('Type'),$this->input->post('sender'),$this->input->post('id_con'),$this->input->post('idRep'),$this->input->post('page'));
    $json = array('message' => true, 'content' => '');
    $json['message'] = true;
    $date = "";
    $text = array('livre' => 'LIVREE', 'annule' => 'ANNULLEE', 'en_attente' => 'EN ATTENTE', 'confirmer' => 'CONFIRMEE', 'repporter' => 'REPPORTEE');
    foreach ($this->global_model->all_detail_discussion($client, $page) as $key => $reponse) {

      $heure = explode(" ", $reponse->heure);
      if ($reponse->Page == $page) {
        if ($reponse->sender == 'OPL') {
          if ($reponse->Type == 'image') {
            $json['content'] .= '<div style="background:#b2ebf2;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; "><img src="' . base_url("/images/pieceJoint/$reponse->Message.jpg") . '" alt="' . $reponse->Message . '" width="100" height="100"></div>';
          } else if ($reponse->Type == 'rendez-vous') {
            $dataRvd = $this->global_model->selectRendeVous(["date" => $reponse->date, "heure" => $reponse->heures, "codeclient" => $client, "page" => $reponse->Page]);
            if ($dataRvd) {
              $pagess =  $this->global_model->comptefbDetail(['id' => $dataRvd->page]);
              $json['content'] .= '<div style="background:#F8BBD0;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"> Rendez-vous le ' . $dataRvd->date . ' à ' . $dataRvd->heure . ' sur la page ' . $pagess->Nom_page . '</div>';
            } else {
              $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
            }
          } else if (trim($reponse->Type) == 'vente') {
            $total = 0;
            $remise = "";
            $detail = $this->calendrier_model->detail_commande_facture_discussion(trim($reponse->Message));
            if ($detail) {
              $livraison = $this->calendrier_model->detail_facture_discussion(trim($reponse->Message));
              $bon_achat = $this->calendrier_model->retour_quary("SELECT SUM(`Val_bon_achat`) AS 'bonAchat' FROM `facture` WHERE `Id_facture` = '".trim($reponse->Message)."'");
              $totalsmilekoty = $this->global_model->gettotalsmileskotys($client);
              foreach ($totalsmilekoty as $value) {
                $smilesT = $value->smiles;
                $kotyT = $value->koty;
                $totatsmilekotyFinal = $smilesT . " Smiles | " . $kotyT . " Koty ";
              }
              $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;;text-align:left; font-size:12px!important"><div style="padding:5px 10px;white-space: break-spaces;"> Raha fintinina izany ny commande nao dia : <br> Vokatra : ';
              foreach ($detail as $key => $detail) {
                $json['content'] .= substr($detail->Designation, 0, 60) . '<br> Miisa : ' . $detail->Quantite . '<br> Vidiny : ' . number_format($detail->Prix_detail) . ' Ar<br> Koty : ' . $detail->Smile_LV1;
                $remise .= $detail->Designation . " : " . $detail->Smile_LV1 . " Smiles |" . $detail->Zen_LV1 . " Koty<br>";
                $total += ($detail->Quantite * $detail->Prix_detail);
              }
              $json['content'] .= '<br><span><b> Localité : ' . $livraison->Localite . '</span>';
              $json['content'] .= '<br>Quartier:' . $livraison->Quartier . "&nbsp;,&nbsp;" . $livraison->Ville . '<br> Toerana : ' . $livraison->lieu_de_livraison . '<br> Contact 1 : ' . $livraison->contacts . '<br> Contact 2 : ' . $livraison->Contact_livraison . '<br>Date de livraison : ' . $livraison->date_de_livraison . " " . '<br>Frais de livraison : ' . number_format($livraison->frais) . ' Ar' . '<br> Frais de Retrait : ' . $livraison->frais_de_retrait . ' Ar' . " " . $livraison->heure_deb_livre . $livraison->heure_fi_livre . '';
              $json['content'] .= "<br><span><b> Bon d'achat : ".number_format($bon_achat->bonAchat, 2, ',', ' ')." ar<br/>";
             
              if ($livraison->Status == 'livre') {
                if ($livraison->frais_de_retrait == '') {
                  $fraisRetrait = 0;
                } else {
                  $fraisRetrait = $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait-$bon_achat->bonAchat) . ' Ar <div class="modify"><button id="' . trim($reponse->Message) . '" class="btn btn-success disabled text-center modify btn-sm" style="margin-left:400px;color:#fff;border-radius:10px"><b>' . $text[$livraison->Status] . '</button></div></span>';
              } else if ($livraison->Status == 'annule') {
                if ($livraison->frais_de_retrait == '') {
                  $fraisRetrait = 0;
                } else {
                  $fraisRetrait = $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait-$bon_achat->bonAchat) . ' Ar <div class="modify"><button class="btn btn-danger disabled text-center btn-sm"  id="' . trim($reponse->Message) . '" style="margin-left:400px;color:#fff;border-radius:10px">' . $text[$livraison->Status] . '</button></div></span>';
              } else {
                if ($livraison->frais_de_retrait == '') {
                  $fraisRetrait = 0;
                } else {
                  $fraisRetrait = $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait-$bon_achat->bonAchat) . ' Ar </b> <div class="modify"><button class="btn btn-dark disabled text-center "  id="' . trim($reponse->Message) . '" style="margin-left:400px;color:#000;border-radius:10px ">' . $text[$livraison->Status] . '</b></button></div></span>';
              }
              $json['content'] .= '<br><span><b>' . $livraison->Matricule_personnel . '</span>';
              $json['content'] .= '<br><span><b>' . $livraison->Code_client . '</span>';
              $vardata = $this->global_model->retour_page($reponse->Page);
              $page = "";

              if ($vardata) {
                $page = $reponse->Page;
              }
              $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a"><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
              $json['content'] .= '</div></div> <div style="background:#ffbb33;padding:20px;;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px; font-size:13px;white-space: break-spaces; "> <b style="font-size:16px" class="text-center">Fanamarihana !</b><br/> Raha toa ka livré  ireto vokatra no commandianao  ireto <br> dia misy fihenambidy atolotra anao ireto <br>' . $remise . '</div></div>';
              $json['content'] .= '</div></div> <div style="background:#00B74A;padding: 5px 20px;;border-radius:10px;margin-bottom:10px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px "> <br/><b style="font-size:16px" class="text-left"> Ny Statut anao amizao dia :   <br> <b>STATUT ACTUEL  :  ' . $totatsmilekotyFinal . '</div></div>';
            }
          } else if (trim($reponse->Type) == 'termier') {
            $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">Terminée&nbsp;le&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid red;margin-top:-10px">';
          } else if (trim($reponse->Type) == 'NouvelleDiscussion') {
            $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">Nouvelle&nbsp;Discussion&nbsp;le&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid green;margin-top:-10px">';
          } else if (trim($reponse->Type) == 'a suivre') {
            $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">A&nbsp;Suivre&nbsp;Depuis&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid orange;margin-top:-10px">';
          } else {
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
          }
        } else if ($reponse->sender == 'CLT') {
          if ($reponse->Type == 'image') {
            $json['content'] .= '<div class="form-control" style="background:#b2ebf2;padding:5px 5px;min-height:130px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word;"><img src="' . base_url("/images/pieceJoint/$reponse->Message.jpg") . '" alt="' . $reponse->Message . '" style="height:120px;width:120px;object-fit:cover" ></div>';
          } else {
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#b2ebf2;padding:10px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word;"><p class="a" >' . $reponse->Message . '<br><span class="pull-right" style="color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp; <i class="fa fa-clock"></i>&nbsp;&nbsp;' . $reponse->heure . '</span></p></div>';
          }

          if ($date != $heure[0]) {
            $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">' . $heure[0] . '</span></div><hr style="border: 1px solid #ccc;margin-top:-10px">';
            $date = $heure[0];
          }
        }
      }
    }
    echo json_encode($json);
  }

  public function typeTache()
  {
    $this->load->model('discussion_model');
    $json = array("message" => "message");
    if ($this->discussion_model->tachesdata(["taches" => $this->input->post("tache"), "piece_jointe" => "photo"])) {
      $json["message"] = "joint";
    }
    echo json_encode($json);
  }

  public function newfacture()
  {
    $this->load->model('global_model');
    $facturetemp = (int)$this->global_model->factureCount() + 1;
    $facture = 'FACT-FB-' . date('Y-m-d') . "-" . $facturetemp;
    echo json_encode(array('codefact' => $facture));
  }

  public function enregistre_commande()
  {
    $this->load->model('global_model');
    $fact = $this->input->post('fact');
    $date = $this->input->post('date');
    $Debut = $this->input->post('Debut');
    $District = $this->input->post('District');
    $Localite = $this->input->post('Localite');
    $lieu_de_livraison = $this->input->post('lieu_de_livraison');
    $Fin = $this->input->post('Fin');
    $idville = $this->input->post('ville');
    $lieulivre = $this->input->post('lieulivre');
    $Quartier = $this->input->post('quartier');
    $remarque = $this->input->post('remarque');
    $client = $this->input->post('client');
    $frailivre = $this->input->post('frailivre');
    $fraisderetrait = $this->input->post('fraisderetrait');
    $contact = $this->input->post('contact');
    $Id_zone = $this->input->post('Id_zone');
    $page = $this->input->post('page');
    $contactlivre = $this->input->post('cotactlivre');
    $ress_sec_oplg = $this->input->post('result_mattr');
    $Id_discussion = $this->input->post('Id_discussion');
    $produit = $this->input->post('produits');
    $typeFacture = $this->input->post('typeFacture');
    $codePromo = $this->input->post('codePromo');
    $factureKoty = $this->input->post('factureKoty');
    $valeurBon = $this->input->post('bon_achat_input');
    $DesBon = $this->input->post('bon_achat');
    $rcv = substr($ress_sec_oplg, 0, 2);

    if ($rcv == 'VP' or $rcv == 'VT' or $rcv == 'CO') {
      $source_vente = "TERRAIN";
    } else if ($rcv == 'PR') {
      $source_vente = "PROMOTEUR";
    } else {
      $source_vente = "FACEBOOK";
    }
    if ($rcv == 'VN') {
      $source_vente = "FACEBOOK";
    }
    if ($rcv == 'VK') {
      $source_vente = "tsena_koty";
    }

    $rclient = substr($client, 0, 3);
    if ($rclient == 'CRX') {
      $this->global_model->update_crx($client, $Quartier, $idville, $District);
    } else if ($rclient == 'CMT') {
      $this->global_model->update_cmt($client, $Quartier, $idville, $District);
    } else {
      $this->global_model->update_clt($client, $Quartier, $idville, $District);
    }

    $this->global_model->addRelance(date('Y-m-d'), $this->session->userdata('matricule'), $client, $page);
    $this->global_model->update_bon_achat(["CODE_CLIENT"=>$client,"DESIGNATION"=>$DesBon],["STATUT"=>"inactif"]);
    $this->global_model->enregistre_detail_facture($factureKoty, $codePromo, $typeFacture, $fact, $client, $Id_zone, $idville, $date, $Debut, $Fin, $contact, $remarque, $Id_discussion, $District, $Localite, $lieu_de_livraison, $Quartier, $page, $contactlivre, $ress_sec_oplg, $source_vente, $valeurBon, $DesBon);
    $this->enregistre_livraison_commande($fact, $date, $frailivre, $fraisderetrait);
    foreach ($produit as $produit) {
      $prodact = "";
      $prodact = explode("|", $produit);
      $this->enregistre_detail_commande($prodact[0], $prodact[1], $fact);
    }
    $this->update_level($client, $fact);

    $activite = [
      'user' => $this->session->userdata('matricule'),
      'PageUsers' => $this->session->userdata('page'),
      'activite' => "CONCLUE",
      'Date' => date('Y-m-d'),
      'Heure' => date('H:i:s'),
      'Client' => $this->input->post('client')
    ];
    $this->global_model->insert_action($activite);

    $insertSession = [
      'operatrice' => $this->session->userdata('matricule'),
      'idaction' => "15",
      'date' => date('Y-m-d'),
      'heure' => date('H:i:s'),
      'page' => $page,
      'action' => "CONCLUS",
      'tache' => "VENTE DES PRODUITS"
    ];
    $this->global_model->inserthistorique_discussion_session($insertSession);

    echo json_encode(array('message' => true));
  }

  public function update_level($code_Client, $facture)
  {
    $this->load->model('global_model');
    $chk = $this->global_model->gettrimstatutcleint($code_Client);

    $val = intval($chk[0]->smiles);
    $statut = $this->global_model->getclientstatuttrimes($val);
    if ($statut == "LEVEL 1") {
      $this->global_model->update_level_client($code_Client, $facture, "Level_1");
    } else if ($statut == "LEVEL 2") {
      $this->global_model->update_level_client($code_Client, $facture, "Level_2");
    } else if ($statut == "LEVEL 3") {
      $this->global_model->update_level_client($code_Client, $facture, "Level_3");
    } else if ($statut == "LEVEL 4") {
      $this->global_model->update_level_client($code_Client, $facture, "Level_4");
    } else if ($statut == "LEVEL 5") {
      $this->global_model->update_level_client($code_Client, $facture, "Level_5");
    }
  }

  public function enregistre_livraison_commande($Id_facture, $date_de_livraison, $frais, $fraisderetrait)
  {
    $this->load->model('global_model');
    $this->global_model->insert_detail_livraison($Id_facture, $date_de_livraison, $frais, $fraisderetrait);
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
  public function pass_e_pseudo($Code_client)
  {
    $pass = '';
    $characters = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    for ($i = 0; $i < 8; $i++) {
      $pass .= ($i % 2) ? strtoupper($characters[array_rand($characters)]) : $characters[array_rand($characters)];
    }
    $pseudo = "";
    $pseudo_temp = explode("-", $Code_client);
    $pseudo = 'BRUNO-' . $pseudo_temp[2];

    return array('pass' => $pass, 'pseudo' => $pseudo);
  }
  public function  save_detail()
  {
    $com = trim($this->input->post("commerciale"));
    $coact = trim($this->input->post("coach"));
    $this->load->model('global_model');
    $link = $this->input->post("liensurfb");
    $Id_facebook = $this->input->post("identifient");
    $codeclient = $this->input->post("codeclient");
    $pass_pseoudo = $this->pass_e_pseudo($codeclient);
    if (null !== $this->input->post("coach") and null !== $this->input->post("commerciale")) {
      $this->global_model->insertdetailPotentiel($codeclient, $Id_facebook, $link, $pass_pseoudo['pass'], $pass_pseoudo['pseudo'], $coact, $com);
    } else {
      $this->global_model->insertdetailPotentiel($codeclient, $Id_facebook, $link, $pass_pseoudo['pass'], $pass_pseoudo['pseudo']);
    }

    echo json_encode('true');
  }
  public function saveCountDisc()
  {
    $data = [
      "IdDiscussion" => $this->input->post('idDiscussion'),
      "Client" => $this->input->post('client'),
      "Date" => date('Y-m-d'),
      "operatice" => $this->session->userdata('matricule')
    ];
    echo json_encode($this->global_model->inserthistoriqueDiscussion($data));
  }
  public function sauveImageClient($codeClient)
  {
    $jsons = array();
    $data = scandir(FCPATH . 'images/client');
    $uploads_dir = FCPATH . 'images/client';
    $result = array('reponse' => false);
    if (isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) {
      $tmp_name = $_FILES["file"]["tmp_name"];
      $name = $codeClient . ".jpg";

      if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
        $result['reponse'] = true;
      }
    } else {
    }
    echo json_encode($result);
  }
  public function sauveImageClientDemande($codeClient)
  {
    $jsons = array();
    $data = scandir(FCPATH . 'images/imageDemande');
    $uploads_dir = FCPATH . 'images/imageDemande';
    $result = array('reponse' => false);
    if (isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) {
      $tmp_name = $_FILES["file"]["tmp_name"];
      $name = $codeClient . ".jpg";

      if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
        $result['reponse'] = true;
      }
    } else {
    }
    echo json_encode($result);
  }

  public function uploadFils($name)
  {
    $jsons = array();
    $data = scandir(FCPATH . 'images/pieceJoint');
    $uploads_dir = FCPATH . 'images/pieceJoint';

    if (isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) {
      $tmp_name = $_FILES["file"]["tmp_name"];
      $name = $name . ".jpg";
      $result = array('reponse' => false);
      if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
        $result['reponse'] = true;
      }
    } else {
    }
    echo json_encode($result);
  }
  public function matriculeCRX()
  {
    $this->load->model('global_model');
    $reponse = $this->global_model->matriculeCRX();
    if ($reponse) {
      $id = (int)$reponse->Id + 1;
    } else {
      $id = 0;
    }

    return 'CRX-FB-' . $id . "-" . date("Y-m-d");
  }

  public function  uploadCLientCRSX()
  {
    $this->load->model('global_model');
    $donne = $this->input->get('data');
    $data = scandir(FCPATH . 'upload/excel_reaction');
    $uploads_dir = FCPATH . 'upload/excel_reaction';
    $tmp_name = $_FILES["file"]["tmp_name"];
    $name = basename($_FILES["file"]["name"]);
    $array = json_decode($donne);
    if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
      if ($xlsx = SimpleXLSX::parse("$uploads_dir/$name")) {
        $header_values = $rows = [];

        foreach ($xlsx->rows() as $k => $r) {
          if ($k === 0) {
            $header_values = $r;
            continue;
          }
          $rows[] = array_combine($header_values, $r);
        }
        foreach ($rows as $key => $rows) {
          $link = explode('?', $rows['LINK']);
          if (strstr($link[1], 'id=')) {
            $id = explode("&", $link[1]);
            $links = $link[0] . "?" . $id[0];

            if ($this->global_model->testCRX($links)) {
            } else {
              if (!$this->global_model->testLinkFb($links)) {
                $idClient = $this->matriculeCRX();
                $this->global_model->insertCSX($rows['NOM'], $links, $idClient);
                $this->global_model->insertHistoriqueCRX($idClient, $array->reaction, $array->Page_groupe, $array->link_page);
              } else {
              }
            }
          } else {
            $links = $link[0];
            if (!$this->global_model->testLinkFb($links)) {
              $idClient = $this->matriculeCRX();
              $this->global_model->insertCSX($rows['NOM'], $links, $idClient);
              $this->global_model->insertHistoriqueCRX($idClient, $array->reaction, $array->Page_groupe, $array->link_page);
            }
          }
        }
        echo 'OK';
      } else {
        echo 'Not OK';
      }
    }
  }

  public function autocomplete_commerciele()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_commerciele($term) as $reponse) {
      array_push($array, $reponse->Matricule . " | " . $reponse->Nom);
    }
    echo json_encode($array);
  }

  public function autocomplete_ville()
  {
    $this->load->model('global_model');
    $term = $this->input->post('quartier');
    $content = '<form><div class="control-group"><ul class="list-group">';
    $i = 1;
    foreach ($this->global_model->autocomplete_ville($term) as $reponse) {
      if ($reponse->Ville_Commune != "") {
        $content .= '<li class="list-group-item"><label class="checkbox"><input type="checkbox" class="chose" value="' . $reponse->Ville_Commune . '" id="' . $reponse->Ville_Commune . '">&nbsp;' . $reponse->Ville_Commune . '</label></li>';
        $i++;
      }
    }
    $content .= '</ul></form></div>';
    echo json_encode($content);
  }
  public function autocomplete_quartier()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_quartier($term) as $reponse) {
      array_push($array, $reponse->Fokontany);
    }
    echo json_encode($array);
  }
  public function autocomplete_discrict()
  {
    $this->load->model('global_model');
    $quartier = $this->input->post('quartier');
    $ville = $this->input->post('ville');
    $content = '<form><div class="control-group"><ul class="list-group">';
    $i = 1;
    foreach ($this->global_model->autocomplete_discrict($quartier, $ville) as $reponse) {
      if ($reponse->District != "") {
        $content .= '<li class="list-group-item"><label class="checkbox"><input type="checkbox" class="chose" value="' . $reponse->District . '" id="' . $reponse->District . '">&nbsp;' . $reponse->District . '</label></li>';
        $i++;
      }
    }
    $content .= '</ul></form></div>';
    echo json_encode($content);
  }

  public function autocomplete_coach()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_coach($term) as $reponse) {
      array_push($array, $reponse->Matricule . " | " . $reponse->Nom);
    }
    echo json_encode($array);
  }

  public function autocomplete_mark()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_mark($term) as $reponse) {
      array_push($array, $reponse->Marque . " | " . $reponse->Produit);
    }
    echo json_encode($array);
  }
  public function autocomplete_produit()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_produit($term) as $reponse) {
      array_push($array, $reponse->Marque . " | " . $reponse->Produit);
    }
    echo json_encode($array);
  }
  public function test_statut_client()
  {
    $this->load->model('global_model');
    $json = array('massage' => false, "color" => '#aa66cc');
    $idpage = $this->input->post('page');
    $codeclient = $this->input->post('codeclient');
    $discussion_page = $this->global_model->retour_detail_discussion($idpage, $codeclient);
    if ($discussion_page) {
      $facture_livre = $this->global_model->testFacture_discussion($codeclient, $idpage);
      if ($facture_livre > 1) {
        $json['massage'] = true;
        $json['color'] = '#00C851';
        $json['matricule'] =  $codeclient;
      } else {
        $json['massage'] = true;
        $json['color'] = '#33b5e5';
        if (strpos($codeclient, 'CMT') !== FALSE) {
          $json['matricule'] = $codeclient;
        } else if (strpos($codeclient, 'CLT') !== FALSE) {
          $mattr = $this->global_model->CMT_provenance_CLT($codeclient);
          $json['matricule'] = $mattr->Code_client;
        }
      }
    } else {
      if (strpos($codeclient, 'CMT') !== FALSE) {
        $mattr = $this->global_model->curieux_provenance_CMT($codeclient);
        if ($mattr) {
          $json['matricule'] = $mattr->Provenance;
        } else {
          $json['matricule'] =  $codeclient;
        }
      } else if (strpos($codeclient, 'CLT') !== FALSE) {
        $mattr = $this->global_model->curieux_provenance_CLT($codeclient);
        if ($mattr) {
          $json['matricule'] = $mattr->Provenance;
        } else {
          $json['matricule'] =  $codeclient;
        }
      } else {
        $json['matricule'] =  $codeclient;
      }
      $json['massage'] = true;
      $json['color'] = '#aa66cc';
    }
    echo json_encode($json);
  }
  public function data_page_users($user)
  {
    $this->load->model('global_model');
    echo json_encode($this->global_model->data_page_users($user));
  }
  public function data_page()
  {
    $this->load->model('global_model');
    echo json_encode($this->global_model->data_page());
  }
  public function completeTache()
  {
    $this->load->model('global_model');
    $donne = $this->global_model->complete_taches($this->input->post('code'));
    $html = "<option hidden></option>";
    foreach ($donne as $donne) {
      $html .= '<option value="' . $donne->codes . '">' . $donne->taches . '</option>';
    }
    echo $html;
  }
  public function decision()
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

    $this->render_view('operatrice/discussion/decision', $data);
  }
  public function client_a_traiter()
  {
    $this->load->model('global_model');
    $matricule = $this->input->post('matricule');
    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }
    $content = "";
    $contents = "";
    $contenu = "";
    $cont = "";
    $contentsS = "";
    $jaime = "";
    $contentsac07 = "";
    $contentSAC42 = "";
    $contentcatal = "";
    $contentsss = "";
    $contents07 = "";
    $contentvnl = "";
    $contentAA30 = "";
    $contenuSACCAT = "";
    $clientsaa7 = 0;
    $datardv = "";
    $f = 1;
    $i = 1;
    $x = 1;
    $a = 1;
    $e = 1;
    $n = 1;
    $m = 1;
    $s = 1;
    $t = 1;
    $l = 1;
    $z = 1;
    $k = 1;
    $b = 1;
    $v = 1;
    $data = array();
    $TestCont = array();
    $TestConts = array();
    $TestContent = array();

    $aac7 = 0;
    $countsac07 = 0;

    $ContAA30 = array();
    $clientAA30 = $this->global_model->REAP_CLT_AAC30($date, $this->session->userdata('matricule'));
    foreach ($clientAA30 as $clientAA30) {
      $ContAA30[$b] = $clientAA30->lien_facebook;
      $contentAA30 .= "<tr><td>" . $b . "</td><td  class='text-center'>" . $clientAA30->Code_client . "</td><td><a href='" . $clientAA30->lien_facebook . "' target='_blank'></a></td></tr>";
      $b++;
    }

    $clientSAC42 = $this->global_model->client_a_traiterAAC42($this->session->userdata('matricule'));
    foreach ($clientSAC42 as $clientSAC42) {
      if (in_array($clientSAC42->lien_facebook, $ContAA30)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $contentSAC42 .= "<tr><td>" . $z . "</td><td  class='text-center'>" . $clientSAC42->Code_client . "</td><td><a href='" . $clientSAC42->lien_facebook . "' target='_blank'>" . $clientSAC42->Compte_facebook . "</a></td><td>" . $clientSAC42->lien_facebook . "</td><td>" . $clientSAC42->Nom_page . "</td><td class='text-center'>" . $statut . "</td></tr>";
      $z++;
    }

    $TestCont = array();
    $clientss = $this->global_model->PROP_CLT_AAC14($date, $this->session->userdata('matricule'));
    foreach ($clientss as $clientss) {
      $TestConts[$n] = $clientss->lien_facebook;
      $contentsS .= "<tr><td>" . $n . "</td><td>" . $clientss->heure . "</td><td  class='text-center'>" . $clientss->Code_client . "</td><td><a href='" . $clientss->lien_facebook . "' target='_blank'>" . $clientss->Compte_facebook . "</a></td></tr>";
      $n++;
    }

    $clients = $this->global_model->client_a_traiterAAC14($this->session->userdata('matricule'));
    foreach ($clients as $clients) {
      if (in_array($clients->lien_facebook, $TestConts)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $contents .= "<tr><td>" . $a . "</td><td  class='text-center'>" . $clients->Code_client . "</td><td><a href='" . $clients->lien_facebook . "' target='_blank'>" . $clients->Compte_facebook . "</a></td><td>" . $clients->lien_facebook . "</td><td>" . $clients->Nom_page . "</td><td class='text-center'>" . $statut . "</td></tr>";
      $a++;
    }
    $TestContentsac07 = array();
    $cltsac7 = $this->global_model->RELN_CLT_SAC07($date, $this->session->userdata('matricule'));
    foreach ($cltsac7 as $cltsac7) {
      $TestContentsac07[$s] = $cltsac7->lien_facebook;
      $contents07 .= "<tr><td>" . $s . "</td><td></td><td  class='text-center'>" . $cltsac7->Code_client . "</td><td><a href='" . $cltsac7->lien_facebook . "' target='_blank'>" . $cltsac7->Compte_facebook . "</a></td></tr>";
      $s++;
    }

    $countcltsac7 = $this->global_model->countAAC07($date, $this->session->userdata('matricule'));
    $countclient = $this->global_model->client_a_traiterAAC7($this->session->userdata('matricule'));
    $clientsSAC007 = $this->global_model->clientsaa7($this->session->userdata('matricule'));
    foreach ($clientsSAC007 as $clientsSAC007) {
      if (in_array($clientsSAC007->lien_facebook, $TestContentsac07)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }

      if ($clientsSAC007->FACTURE == NULL && $clientsSAC007->AVANT_DERNIER_DISK == NULL) {
        $contentsac07 .= "<tr><td>" . $l . "</td><td  class='text-center'>" . $clientsSAC007->client . "</td><td><a href='" . $clientsSAC007->lien_facebook . "' target='_blank'>" . $clientsSAC007->Compte_facebook . "</a></td><td>" . $clientsSAC007->lien_facebook . "</td><td>" . $clientsSAC007->Nom_page . "</td><td class='text-center'>" . $statut . "</td></tr>";
        $l++;
      }
    }

    $parametre = $this->global_model->selectParametreRelance(["operatrice" => $this->session->userdata('matricule'), "status" => "on"]);
    if ($parametre) {
      if ($parametre->type == "ios") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 21);
      } else if ($parametre->type == "ios1") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 28);
      } else if ($parametre->type == "ios2") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 35);
      } else if ($parametre->type == "ios3") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 42);
      } else if ($parametre->type == "ios4") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 49);
      } else if ($parametre->type == "ios5") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 56);
      } else if ($parametre->type == "ios6") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 63);
      } else if ($parametre->type == "ios7") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 70);
      }

      foreach ($clientsaa7 as $clientsaa7) {
        if (in_array($clientsaa7->lien_facebook, $TestContent)) {
          $statut = "<i class='fa fa-check-circle text-success'></i>";
        } else {
          $statut = "<i class='fa fa-times-circle text-danger'></i>";
        }

        if ($clientsaa7->FACTURE == NULL && $clientsaa7->AVANT_DERNIER_DISK == NULL) {
          $contenu .= "<tr><td>" . $x . "</td><td  class='text-center'>" . $clientsaa7->client . "</td><td><a href='" . $clientsaa7->lien_facebook . "' target='_blank'>" . $clientsaa7->Compte_facebook . "</a></td><td>" . $clientsaa7->lien_facebook . "</td><td>" . $clientsaa7->Nom_page . "</td><td>" . $statut . "</td></tr>";
          $x++;
        }
      }
    }
    $ventenl = $this->global_model->ventenonlivre($this->session->userdata('matricule'));
    foreach ($ventenl as $ventenl) {
      if (in_array($ventenl->lien_facebook, $TestCont)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $contentvnl .= "<tr><td>" . $f . "</td><td><a href='" . $ventenl->lien_facebook . "' target='_blank'>" . $ventenl->Compte_facebook . "</a></td><td>" . $ventenl->lien_facebook . "</td><td>" . $ventenl->Nom_page . "</td><td  class='text-center'>" . $ventenl->remarque_livreur . "</td><td class='text-center'>" . $statut . "</td></tr>";
      $f++;
    }

    /*if($this->session->userdata('matricule')==="VB21539"){  
          $client_catalogue = $this->global_model->sac_catalogue(29);
          
        }elseif($this->session->userdata('matricule')==="VB21525"){
          
          $client_catalogue = $this->global_model->sac_catalogue(3);
        }else {
          $client_catalogue = $this->global_model->sac_catalogue($this->session->userdata('page'));
          }*/

    $client_catalogue = $this->global_model->sac_catalogue($this->session->userdata('page'));
    foreach ($client_catalogue as $client_catalogue) {

      if ($client_catalogue->FACTURE == NULL && $client_catalogue->AVANT_DERNIER_DISK == NULL && $client_catalogue->AVANT_DERNIER == NULL) {
        $contentcatal .= "<tr><td>" . $v . "</td><td  class='text-center'>" . $client_catalogue->client . "</td><td><a href='" . $client_catalogue->lien_facebook . "' target='_blank'>" . $client_catalogue->Compte_facebook . "</a></td><td>" . $client_catalogue->lien_facebook . "</td><td>" . $client_catalogue->Nom_page . "</td><td class='text-center'>" . $statut . "</td></tr>";
        $v++;
      }
    }

    $clientsrdv = $this->global_model->rendez_vous($date, $this->session->userdata('matricule'));
    foreach ($clientsrdv as $clientsrdv) {
      $datardv .= "<tr><td>" . $k . "</td><td>" . $clientsrdv->date . "</td><td>" . $clientsrdv->Code_client . "</td><td>" . $clientsrdv->Compte_facebook . "</td><td>" . $clientsrdv->lien_facebook . "</td><td>" . $clientsrdv->Nom_page . "</td><td>" . $clientsrdv->contact . "</td></tr>";
      $k++;
    }

    $data = [
      'data' => $content,
      'donnes' => $contents,
      'contenu' => $contenu,
      'cont' => $cont,
      'jaime' => $jaime,
      'contentvnl' => $contentvnl,
      'contentsac07' => $contentsac07,
      'contentSAC42' => $contentSAC42,
      'contentcatal' => $contentcatal,
      'date' => $date,
      'aac7' => $aac7,
      'datardv' => $datardv,
      'countsac07traite' => count($countcltsac7),
      'countsac07' => count($countclient),
      'AAC7' => count($this->global_model->client_a_traiterAAC7($this->session->userdata('matricule'))),
      'AAC14' => count($this->global_model->client_a_traiterAAC14($this->session->userdata('matricule'))),
      'AAC42' => count($this->global_model->client_a_traiterAAC42($this->session->userdata('matricule'))),
      'catalogue' => count($this->global_model->sac_catalogue($this->session->userdata('matricule'))),
      'SAC07' => count($this->global_model->clientsaa7($this->session->userdata('matricule'))),
      'jaime' => count($this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('matricule'))),
      'rdvous' => count($this->global_model->rendez_vous($date, $this->session->userdata('matricule')))

    ];
    $data['listeclient'] = $this->global_model->liste_prommotion($date, $this->session->userdata('matricule'));
    $this->render_view('operatrice/discussion/client_a_traiter', $data);
  }
  public function clientsaca()
  {
    $datas = $this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('matricule'));
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->date_publi;
      $sub_array[] = "";
      $sub_array[] = "";
      $sub_array[] = "";
      $sub_array[] = "";
      $sub_array[] = "";
      $sub_array[] = "";
      $sub_array[] = "";
      $data[] = $sub_array;
    }
    $output = array("data" => $data);
    echo json_encode($output);
  }

  public function reaction_jaime()
  {
    $k = 1;
    $t = 1;
    $contentsss = "";
    $TestContjaime = array();
    $clientjaimes = $this->global_model->comptejm(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaimes as $clientjaimes) {
      $TestContjaime[$k] = $clientjaimes->lien_facebook;
      $contentsss .= "<tr><td></td><td>" . $clientjaimes->heure . "</td><td  class='text-center'>" . $clientjaimes->Code_client . "</td><td><a href='" . $clientjaimes->lien_facebook . "' target='_blank'>" . $clientjaimes->Compte_facebook . "</a></td></tr>";
      $k++;
    }

    $clientjaime = $this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaime as $row) {
      if (in_array($row->lien_facebook, $TestContjaime)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $sub_array = array();
      $sub_array[] = $t;
      $sub_array[] = $row->date_publi;
      $sub_array[] = $row->Compte_facebook;
      $sub_array[] = $row->lien_facebook;
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $statut;
      $t++;
      $data[] = $sub_array;
    }
    $output = array("data" => $data);
    echo json_encode($output);
  }

  public function cientAAC07()
  {
    $i = 1;
    $cont = "";
    $t = 1;
    $TestCont = array();
    $cltAAC07 = $this->global_model->PROP_CLT_AAC07(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($cltAAC07 as $cltAAC07) {
      $TestCont[$i] = $cltAAC07->lien_facebook;
      $cont .= "<tr><td>" . $i . "</td><td>" . $cltAAC07->heure . "</td><td  class='text-center'>" . $cltAAC07->Code_client . "</td><td><a href='" . $cltAAC07->lien_facebook . "' target='_blank'>" . $cltAAC07->Compte_facebook . "</a></td></tr>";
      $i++;
    }

    $client = $this->global_model->client_a_traiterAAC7($this->session->userdata('matricule'));
    foreach ($client as $row) {
      if (in_array($row->lien_facebook, $TestCont)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }

      $sub_array = array();
      $sub_array[] = $t;
      $sub_array[] = $row->Code_client;
      $sub_array[] = $row->Compte_facebook;
      $sub_array[] = $row->lien_facebook;
      $sub_array[] = $row->Nom_page;
      $sub_array[] = "";
      $sub_array[] = $statut;
      $t++;
      $data[] = $sub_array;
    }
    $output = array("data" => $data);
    echo json_encode($output);
  }

  public function rendezvous()
  {
    $this->load->model('global_model');
    $page = $this->input->post('pageUsers');
    $id_discussion = $this->input->post('idDiscussion');
    $client = $this->input->post('codeclient');
    $tache = $this->input->post('tache');
    $operatrice = $this->session->userdata('matricule');
    $taches = $this->input->post('taches');
    $TypeMessage = $this->input->post('TypeMessage');
    $obs = $this->input->post('obs');
    $insertSession = [
      'operatrice' => $operatrice,
      'client' => $client,
      'idaction' => $id_discussion,
      'date' => date('Y-m-d'),
      'heure' => date('H:i:s'),
      'page' =>  $page,
      'action' => $TypeMessage,
      'sender' => "OPL",
      'types' => $tache,
      'tache' => $taches,

    ];
    $this->global_model->inserthistorique_discussion_session($insertSession);
    $this->global_model->insertRendeVous(['date' => $this->input->post('daterdv'), "heure" => $this->input->post('heurervd'), "contact" => $this->input->post('contactRvd'), "codeclient" => $this->input->post('codeclient'), 'status' => 'on', 'operatrice' => $this->session->userdata('matricule'), 'page' => $page, 'produit' => $obs]);
    $this->global_model->insertMessageSimples('rendez-vous', "rendez-vous", "OPL", $id_discussion, $TypeMessage, $page, $this->input->post('daterdv'), $this->input->post('heurervd'), $TypeMessage);
    $json = array('message' => true, 'content' => '', 'new_id' => '', 'statut' => 'en attente', 'idDisc' => $id_discussion);
    $json['message'] = true;
    $date = "";
    $typeDisc = "en attente";
    $text = array('livre' => 'LIVREE', 'annule' => 'ANNULLEE', 'en_attente' => 'EN ATTENTE', 'confirmer' => 'CONFIRMEE', 'repporter' => 'REPPORTEE');
    if ($this->input->post('sender') == 'CLT') {
      $NB = $this->global_model->test_nb_discussion_client($id_discussion);
      if ($NB > 0) {
        $response = $this->global_model->test_nb_matricule_client($id_discussion);
        if ($response) {
          if (strpos($response->client, "CRX") !== FALSE) {
            $detail = $this->global_model->detail_CRX($response->client);
          }
        }
      }
    }
    foreach ($this->global_model->all_detail_discussion($client, $page) as $key => $reponse) {
      $typeDisc = $reponse->Type;
      $heure = explode(" ", $reponse->heure);
      if ($reponse->Page == $page) {
        if ($reponse->sender == 'OPL') {
          if ($reponse->Type == 'image') {
            $json['content'] .= '<div style="background:#e6ee9c;padding:5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; margin-left:90px"><img class="img-thumbnail" src="' . base_url("/images/pieceJoint/$reponse->Message.jpg") . '" alt="' . $reponse->Message . '" width="100" height="100"></div>';
          } else if ($reponse->Type = 'rendez-vous') {
            $dataRvd = $this->global_model->selectRendeVous(["date" => $reponse->date, "heure" => $reponse->heures, "codeclient" => $client, "page" => $reponse->Page]);
            if ($dataRvd) {
              $pagess =  $this->global_model->comptefbDetail(['id' => $dataRvd->page]);
              $json['content'] .= '<div style="background:#F8BBD0;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"> Rendez-vous le ' . $dataRvd->date . ' à ' . $dataRvd->heure . ' sur la page ' . $pagess->Nom_page . '</div>';
            } else {
              $json['content'] .= "<div></div>";
            }
          } else if (trim($reponse->Type) == 'vente') {
            $total = 0;
            $remise = "";
            $detail = $this->calendrier_model->detail_commande_facture_discussion(trim($reponse->Message));
            if ($detail) {
              $livraison = $this->calendrier_model->detail_facture_discussion(trim($reponse->Message));
              $json['content'] .= '<div style="background:#e6ee9c;padding:5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><div style="padding:5px 10px"> Raha fintinina izany ny commande_nao dia : <br> Vokatra : ';
              foreach ($detail as $key => $detail) {
                $json['content'] .= substr($detail->Designation, 0, 60) . '<br> Miisa : ' . $detail->Quantite . '<br> Vidiny : ' . number_format($detail->Prix_detail) . ' Ar<br> Koty : ' . $detail->Smile_LV1;
                $remise .= $detail->Designation . " : " . $detail->Smile_LV1 . " Smiles |" . $detail->Zen_LV1 . " Koty</br>";
                $total += ($detail->Quantite * $detail->Prix_detail);
              }
              $json['content'] .= '<br><span><b> Localité : ' . $livraison->Localite . '</b></span>';
              $json['content'] .= '<br>Quartier:' . $livraison->Quartier . "&nbsp;,&nbsp;" . $livraison->Ville . '<br> Toerana : ' . $livraison->lieu_de_livraison . '<br>Date de livraison : ' . $livraison->date_de_livraison . " " . '<br>Frais de livraison : ' . number_format($livraison->frais) . ' Ar' . " " . $livraison->heure_deb_livre . $livraison->heure_fi_livre . '';
              if ($livraison->Status == 'livre') {
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais) . ' Ar </b><div><button class="btn btn-success disabled text-center" style="margin-left:450px;color:#fff;border-radius:10px"><b>' . $text[$livraison->Status] . '</b></style></button></div></span>';
              } else if ($livraison->Status == 'annule') {
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais) . ' Ar </b><div><button class="btn btn-danger disabled text-center" style="margin-left:450px;color:#fff;border-radius:10px"><b>' . $text[$livraison->Status] . '</b></style></button></div></span>';
              } else {

                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais) . ' Ar </b> <div><button class="btn btn-dark disabled text-center" style="margin-left:420px;color:#000;border-radius:10px "><b>' . $text[$livraison->Status] . '</b></style></button></div></span>';
              }
              $json['content'] .= '<br><span><b> Numéro 1 : ' . $livraison->contacts . '</b></span>';
              $json['content'] .= '<br><span><b> Numéro 1 : ' . $livraison->Contact_livraison . '</b></span>';
              $json['content'] .= '<br><span><b>' . $livraison->Matricule_personnel . '</b></span>';
              $json['content'] .= '<br><span><b>' . $livraison->Code_client . '</b></span>';
              $vardata = $this->global_model->retour_page($reponse->Page);
              $page = "";
              if ($vardata) {
                $page = $reponse->Page;
              }
              $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a"><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
              $json['content'] .= '</div></div> <div style="background:#ffbb33;padding: 5px 20px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000;; word-break: break-word!important;margin-left:90px "> <b style="font-size:16px" class="text-center">Fanamarihana !</b><br/> Raha toa ka livré  ireto vokatra no commandianao  ireto <br> dia misy fihenambidy atolotra anao ireto <br>' . $remise . '</div></div>';
              $json['content'] .= '</div></div> <div style="background:#00B74A;padding: 5px 20px;border-radius:10px;margin-bottom:10px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px "> <b style="font-size:16px" class="text-left"> Ny Statut anao amizao dia :  <br> - <b>STATUT ACTUEL :   <br> Toy izao kosa ny mety ho statut anao rahatoa ka <br> hojifainao ireto vokatra no comandianao ireo  <br> - <b>STATUT PREVISIONELLE : </div></div>';
            }
          } else if (trim($reponse->Type) == 'termier') {
            $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">Terminée&nbsp;le&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid red;margin-top:-10px">';
          } else if (trim($reponse->Type) == 'NouvelleDiscussion') {
            $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">Nouvelle&nbsp;Discussion&nbsp;le&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid green;margin-top:-10px">';
          } else if (trim($reponse->Type) == 'a suivre') {
            $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">A&nbsp;Suivre&nbsp;Depuis&nbsp;' . $heure[0] . '&nbsp;à&nbsp;' . $heure[1] . '&nbsp;</span></div><hr style="border: 1px solid orange;margin-top:-10px">';
          } else {
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">Page : ' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
          }
        } else if ($reponse->sender == 'CLT') {
          if ($reponse->Type == 'image') {
            $json['content'] .= '<div class="form-control" style="background:#b2ebf2;min-height:140px;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word;"><img  src="' . base_url("/images/pieceJoint/$reponse->Message.jpg") . '" alt="' . $reponse->Message . '" class="img-thumbnail" style="width:120px;height:120px;object-fit:cover"></div>';
          } else {
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#b2ebf2  ;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:10px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock"></i>&nbsp;&nbsp;' . $heure[1] . '</span></p></div>';
          }
        }
        if ($date != $heure[0]) {
          $json['content'] .= '<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">' . $heure[0] . '</span></div><hr style="border: 1px solid #ccc;margin-top:-10px">';
          $date = $heure[0];
        }
      }
    }
    $json['statut'] = $typeDisc;
    echo json_encode($json);
  }

  public function call()
  {

    $n = 1;
    $i = 1;
    $x = 1;
    $t = 1;
    $f = 1;
    $p = 0;
    $e = 0;
    $g = 0;
    $m = 0;
    $y = 0;
    $sansachat07 = 0;
    $data = array();
    $contentcatal = "";
    $contentcata = "";
    $contentsS = "";
    $content = "";
    $jaimess = "";
    $jaime = "";
    $sac42 = 0;
    $SAC007 = "";
    $countcatalogue = 0;
    $province = "";
    $contentsession = "";

    $date = date('Y-m-d');

    $TestConts = array();
    $clientss = $this->global_model->PROP_CLT_AAC14($date, $this->session->userdata('matricule'));
    foreach ($clientss as $clientss) {
      $TestConts[$n] = $clientss->lien_facebook;
      $contentsS .= "<tr><td>" . $n . "</td><td>" . $clientss->heure . "</td><td  class='text-center'>" . $clientss->Code_client . "</td><td><a href='" . $clientss->lien_facebook . "' target='_blank'>" . $clientss->Compte_facebook . "</a></td></tr>";
      $n++;
    }



    $parametre = $this->global_model->selectParametreRelance(["operatrice" => $this->session->userdata('matricule'), "status" => "on"]);
    $clientsaa7 = array();
    if ($parametre) {
      if ($parametre->type == "ios") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 21);
      } else if ($parametre->type == "ios1") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 28);
      } else if ($parametre->type == "ios2") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 35);
      } else if ($parametre->type == "ios3") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 42);
      } else if ($parametre->type == "ios4") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 49);
      } else if ($parametre->type == "ios5") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 56);
      } else if ($parametre->type == "ios6") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 63);
      } else if ($parametre->type == "ios7") {
        $clientsaa7 = $this->global_model->clientsaaParametre($this->session->userdata('page'), 7, 15, 8, 70);
      }
    }

    //$clientsaa7 = $this->global_model->clientsaa7($this->session->userdata('matricule'));
    foreach ($clientsaa7 as $clientsaa7) {
      if (in_array($clientsaa7->lien_facebook, $TestConts)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }

      if ($clientsaa7->FACTURE == NULL && $clientsaa7->AVANT_DERNIER_DISK == NULL) {
        $content .= "<tr><td class='collapse'>" . $clientsaa7->client . "</td><td>" . $x . "</td><td  class='text-center'><a href='#' class='client0007'>" . $clientsaa7->client . "</a></td><td><a href='" . $clientsaa7->lien_facebook . "' target='_blank'>" . $clientsaa7->Compte_facebook . "</a></td><td>" . $clientsaa7->lien_facebook . "</td><td>" . $clientsaa7->Nom_page . "</td><td>" . $statut . "</td></tr>";
        $x++;
      }
    }

    $TestContenu = array();
    $clientcatt = $this->global_model->PROP_CLT_CATALOGUE($date, $this->session->userdata('matricule'));
    foreach ($clientcatt as $clientcatt) {
      $TestContenu[$m] = $clientcatt->lien_facebook;
      $contentcata .= "<tr><td>" . $m . "</td><td>" . $clientcatt->heure . "</td><td  class='text-center'>" . $clientcatt->Code_client . "</td><td><a href='" . $clientcatt->lien_facebook . "' target='_blank'>" . $clientcatt->Compte_facebook . "</a></td></tr>";
      $m++;
    }



    $TestCount = array();
    $client_catalogue = $this->global_model->sac_catalogue($this->session->userdata('page'));
    foreach ($client_catalogue as $client_catalogue) {

      if (in_array($client_catalogue->lien_facebook, $TestContenu)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $TestCount[$i] = $client_catalogue->client;
      //if($client_catalogue->FACTURE ==NULL && $client_catalogue->AVANT_DERNIER_DISK==NULL && $client_catalogue->AVANT_DERNIER==NULL  ){
      $contentcatal .= "<tr><td class='collapse'>" . $client_catalogue->client . "</td><td>" . $i . "</td><td  class='text-center'><a href='#' class='client0007'>" . $client_catalogue->client . "</a></td><td><a href='" . $client_catalogue->lien_facebook . "' target='_blank'>" . $client_catalogue->Compte_facebook . "</a></td><td>" . $client_catalogue->lien_facebook . "</td><td>" . $client_catalogue->Nom_page . "</td><td class='text-center'>" . $statut . "</td></tr>";
      $i++;

      //}
      $countcatalogue = count($TestCount);
    }

    $TestContJM = array();
    $clientjm = $this->global_model->PROP_CLT_jm($date, $this->session->userdata('matricule'));
    foreach ($clientjm as $clientjm) {
      $TestContJM[$y] = $clientjm->lien_facebook;
      $contentsS .= "<tr><td>" . $y . "</td><td>" . $clientjm->heure . "</td><td  class='text-center'>" . $clientjm->Code_client . "</td><td><a href='" . $clientjm->lien_facebook . "' target='_blank'>" . $clientjm->Compte_facebook . "</a></td></tr>";
      $y++;
    }


    $clientjaime = $this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaime as $clientjaime) {
      if (in_array($clientjaime->lien_facebook, $TestContJM)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $jaimess .= "<tr><td>" . $t . "</td><td>" . $clientjaime->date_publi . "</td><td><a href='" . $clientjaime->lien_facebook . "' target='_blank'>" . $clientjaime->Compte_facebook . "</a></td><td>" . $clientjaime->lien_facebook . "</td><td>" . $clientjaime->Nom_page . "</td><td class='text-center'>" . $statut . "</td></tr>";
      $t++;
    }


    $clientprovince = $this->global_model->vente_province($this->session->userdata('matricule'));
    foreach ($clientprovince as $clientprovince) {
      if (in_array($clientprovince->lien_facebook, $TestConts)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $province .= "<tr><td>" . $clientprovince->Code_client . "</td><td class='collapse'>" . $p . "</td><td><a href='" . $clientprovince->lien_facebook . "' target='_blank'>" . $clientprovince->Compte_facebook . "</a></td><td>" . $clientprovince->lien_facebook . "</td><td>" . $clientprovince->Status . "</td><td class='text-center'>" . $clientprovince->District . "</td></tr>";
      $p++;
    }

    $client07 = $this->global_model->SAC07($this->session->userdata('page'));
    foreach ($client07 as $client07) {
      if (in_array($client07->lien_facebook, $TestConts)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      if ($client07->FACTURE == NULL) {
        $SAC007 .= "<tr><td>" . $client07->client . "</td><td class='collapse'>" . $f . "</td><td><a href='" . $client07->lien_facebook . "' target='_blank'>" . $client07->Compte_facebook . "</a></td><td>" . $client07->lien_facebook . "</td></tr>";
        $f++;
      }
    }


    $testlink = array();
    $clientsession = $this->global_model->client_facture($this->session->userdata('page'));
    foreach ($clientsession as $clientsession) {
      $testlink[$e] = $clientsession->lien_facebook;
      $contentsession .= "<tr><td>" . $e . "</td><td  class='text-center'>" . $clientsession->Code_client . "</td><td><a href='" . $clientsession->lien_facebook . "' target='_blank'>" . $clientsession->Compte_facebook . "</a></td></tr>";
      $e++;
    }

    $clientfacture = $this->global_model->client_session($this->session->userdata('page'), $this->session->userdata('matricule'));
    foreach ($clientfacture as $clientfacture) {
      if (in_array($clientfacture->lien_facebook, $testlink)) {
        $sansachat07 .= "<tr><td>" . $clientfacture->client . "</td><td class='collapse'>" . $g . "</td><td><a href='" . $clientfacture->lien_facebook . "' target='_blank'>" . $clientfacture->Compte_facebook . "</a></td><td>" . $clientfacture->lien_facebook . "</td></tr>";
        $g++;
      } else {
        $sansachat07 .= "<tr><td>" . $clientfacture->client . "</td><td class='collapse'>" . $g . "</td><td><a href='" . $clientfacture->lien_facebook . "' target='_blank'>" . $clientfacture->Compte_facebook . "</a></td><td>" . $clientfacture->lien_facebook . "</td></tr>";
        $g++;
      }
    }

    $date = date('Y-m-d');
    $datet = '2021-09-20';
    $data['content'] = $content;
    $data['jaimess'] = $jaimess;
    $data['contentcatal'] = $contentcatal;
    $data['countcatalogue'] = $countcatalogue;
    $data['province'] = $province;
    $data['sac42'] = $x;
    $data['SAC007'] = $f;
    $data['prov1ce'] = $p;
    $data['sansachat07'] = $sansachat07;
    $data['listeclient7'] = $this->global_model->client_a_traiterAAC7($this->session->userdata('page'));
    $data['listeclient14'] =  $this->global_model->client_a_traiterAAC14($this->session->userdata('page'));
    $data['listeclient42'] =  $this->global_model->client_a_traiterAAC42($this->session->userdata('page'));
    $data['listeclientsac07'] =  $this->global_model->SAC07($this->session->userdata('page'));
    $data['listeclient70'] =  $this->global_model->client_a_traiterAAC70($this->session->userdata('page'));
    $data['listeclient49'] =  $this->global_model->client_a_traiterAAC49($this->session->userdata('page'));
    $data['clientrdv'] =  $this->global_model->rendez_vous($this->session->userdata('matricule'), date('Y-m-d'));
    //$data['listejaimes'] =  $this->global_model->reactionjaime(date('Y-m-d'),$this->session->userdata('matricule'));  

    /////////////////////////////////////////////////////////////////////////////////////////

    if ($this->session->userdata('matricule') === "VB21539") {
      $data['listeclient105'] =  $this->global_model->client_a_traiterAAC105(1222);
    } elseif ($this->session->userdata('matricule') === "VB21525") {

      $data['listeclient105'] =  $this->global_model->client_a_traiterAAC105(3);
    } elseif ($this->session->userdata('matricule') === "VB21552") {

      $data['listeclient105'] =  $this->global_model->client_a_traiterAAC105(91);
    } elseif ($this->session->userdata('matricule') === "VB21553") {

      $data['listeclient105'] =  $this->global_model->client_a_traiterAAC105(95);
    } elseif ($this->session->userdata('matricule') === "VB21566") {

      $data['listeclient105'] =  $this->global_model->client_a_traiterAAC105(95);
    } else {
      $data['listeclient105'] =  $this->global_model->client_a_traiterAAC105(1111);
    }
    $data['vente_non_livre'] = $this->global_model->vente_non_livre($this->session->userdata('matricule'));
    //$data['listeclient56'] = $this->global_model->client_a_traiterAAC56($date,$this->session->userdata('matricule'));
    //$data['listeclient63'] = $this->global_model->client_a_traiterAAC63($date,$this->session->userdata('matricule'));
    //$data['listeclient70'] = $this->global_model->client_a_traiterAAC70($date,$this->session->userdata('matricule'));
    //$data['listeclient77'] = $this->global_model->client_a_traiterAAC77($date,$this->session->userdata('matricule'));
    //$data['listeclient84'] = $this->global_model->client_a_traiterAAC84($date,$this->session->userdata('matricule'));
    //$data['listeclient91'] = $this->global_model->client_a_traiterAAC91($date,$this->session->userdata('matricule'));
    //$data['listeclient'] = $this->global_model->liste_prommotion($datet,$this->session->userdata('matricule'));
    //$data['listejaime'] = $this->global_model->reactionjaime($date,$this->session->userdata('matricule'));        
    $this->render_view('operatrice/client/call', $data);
  }

  public function clientappel()
  {
    $data['clientfidele'] =  $this->global_model->client_call_fidele($this->session->userdata('matricule'), date('Y-m-d'));
    $data['clientoccasionel'] =  $this->global_model->client_call_occa($this->session->userdata('matricule'), date('Y-m-d'));
    $data['clientrdv'] =  $this->global_model->rendez_vous($this->session->userdata('matricule'), date('Y-m-d'));
    $this->render_view('operatrice/client/clientappel', $data);
  }

  public function Appels_Call()
  {
    $data['listtype'] = $this->global_model->getrelancecaltype($this->session->userdata('matricule'));
    $this->render_view('operatrice/client/appels_call', $data);
  }



  public function client_detail()
  {
    $this->load->model('global_model');
    $client = $this->input->post('codeclient');
    $facture = $this->global_model->stat($client);
    $arrayContent = array();
    $content = "";
    $cont = "";
    $totalCA = 0;
    $ca = 0;
    $produit = 0;
    $total = array();
    foreach ($facture as $facture) {

      $ca = $facture->Quantite * $facture->Prix_detail;
      $produit = $facture->Designation;
      $totalCA += $ca;
      $content .= "<tr><td>" . $facture->Date . "</td><td>" . $facture->Nom_page . "</td><td>" . $facture->Ress_sec_oplg . "</td><td>" . $facture->Code_produit . "</td><td class='text-center' style='font-size:12px'>" . $produit . "</td><td class='text-center' style='font-size:12px'>" . $facture->Quantite . "</td><td style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</style></td></tr>";
    }
    $contact =  $facture->contacts;
    $clients = $facture->Compte_facebook;

    $data = [
      'data' => $content,
      'contact' => $contact,
      'totalCA' => $totalCA,
      'clients' => $clients,
      'dernier' => $this->global_model->dernier_contact($this->session->userdata('matricule'), $this->input->post('codeclient'))

    ];

    $this->load->view('operatrice/client/client_detail', $data);
  }

  /////////////////////////////////////////HISTORIQUE CLIENT//////////////////////////////////////////////////////////////////////
  public function historique()
  {
    $this->load->model('global_model');
    $client = $this->input->post('codeclient');
    $this->load->view('operatrice/client/historique');
  }

  public function rdv_detail()
  {
    $this->load->model('global_model');
    $content = "";
    $client = $this->input->post('codeclient');

    $data['content'] = $this->global_model->historique($client);
    $this->load->view('operatrice/client/rdv_detail', $data);
  }
  public function client_details()
  {
    $this->load->model('global_model');
    $client = $this->input->post('codeclient');
    $code = substr($client, 0, 22);
    $facture = $this->global_model->stat($client);
    $arrayContent = array();
    $content = "";
    $cont = "";
    $totalCA = 0;
    $ca = 0;
    $produit = 0;
    $total = array();
    foreach ($facture as $facture) {
      $detailkotysmiles = $this->global_model->getkotysmiletotalpossible(trim($facture->Id_facture));
      foreach ($detailkotysmiles as $value) {
        $Koty = $value->koty;
        $smiles = $value->smiles;
      }
      $ca = $facture->Quantite * $facture->Prix_detail;
      $produit = $facture->Designation;
      $totalCA += $ca;
      $content .= "<tr><td>" . $facture->Date . "</td><td>" . $facture->Nom_page . "</td><td>" . $facture->Matricule_personnel . "</td><td>" . $facture->Code_produit . "</td><td class='text-center' style='font-size:12px'>" . $produit . "</td><td class='text-center' style='font-size:12px'>" . $facture->Quantite . "</td><td style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</td><td>" . $Koty . "</td><td>" . $smiles . "</td></td></tr>";
    }
    //$dernier = $this->global_model->dernier_contact($this->session->userdata('matricule'),$client);
    if ($facture) {
      $contact = $facture->contacts;
    } else {
      $contact = "";
    }

    if ($facture) {
      $clients = $facture->Compte_facebook;
    } else {
      $clients = "";
    }

    if ($facture) {
      $codeClient = $facture->Code_client;
    } else {
      $codeClient = "";
    }


    $totalkotysmile = $this->global_model->gettotalsmileskotyGlobale($client);
    foreach ($totalkotysmile as $value) {
      $KotyT = $value->koty;
      $SmilesT = $value->smiles;
    }


    $data = [
      'data' => $content,
      'contact' => $contact,
      'totalCA' => $totalCA,
      'clients' => $clients,
      'codeClient' => $codeClient,
      'dernier' => $this->global_model->dernier_contact($code),
      'KotyT' => $KotyT,
      'SmilesT' => $SmilesT,
      'trimstatus' => $this->global_model->getclientstatuttrimes($SmilesT),
      'annuelstatus' => $this->global_model->getclientstatutAnnuel($SmilesT)
    ];


    /* $data['KotyT']=$KotyT;
      $data['SmilesT']=$SmilesT;
      $statuttrim = $this->global_model->getclientstatuttrimes($SmilesT);
      $statutannuel = $this->global_model->getclientstatutAnnuel($SmilesT);
      $data['trimstatus'] =  $statuttrim;
      $data['annuelstatus'] =   $statutannuel;*/

    $this->load->view('operatrice/client/client_detail', $data);
  }

  public function liste_mise_a_jour()
  {
    $data['listeclient7'] = $this->global_model->clientmaj($this->session->userdata('page'), date('Y-m-d'));
    $this->render_view('operatrice/client/liste_mise_a_jour', $data);
  }

  public function relance()
  {
    $i = 1;
    $y = 1;
    $n = 1;
    $f = 1;
    $p = 1;
    $l = 1;
    $b = 1;
    $jaimess = "";
    $SAC007 = "";
    $contents = "";
    $contentsS = "";
    $province = "";
    $contentlf = "";
    $lifes = "";
    $date = date('Y-m-d');
    $TestConts = array();
    $TestContJM = array();
    $TestContLF = array();

    $clientss = $this->global_model->PROP_CLT_AAC14($date, $this->session->userdata('matricule'));
    foreach ($clientss as $clientss) {
      $TestConts[$n] = $clientss->lien_facebook;
      $contents .= "<tr><td>" . $n . "</td><td>" . $clientss->heure . "</td><td  class='text-center'>" . $clientss->Code_client . "</td><td><a href='" . $clientss->lien_facebook . "' target='_blank'>" . $clientss->Compte_facebook . "</a></td></tr>";
      $n++;
    }

    $clientjm = $this->global_model->PROP_CLT_jm($date, $this->session->userdata('matricule'));
    foreach ($clientjm as $clientjm) {
      $TestContJM[$y] = $clientjm->lien_facebook;
      $contentsS .= "<tr><td>" . $y . "</td><td>" . $clientjm->heure . "</td><td  class='text-center'>" . $clientjm->Code_client . "</td><td><a href='" . $clientjm->lien_facebook . "' target='_blank'>" . $clientjm->Compte_facebook . "</a></td></tr>";
      $y++;
    }


    $clientjaime = $this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaime as $clientjaime) {
      if (in_array($clientjaime->lien_facebook, $TestContJM)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $jaimess .= "<tr><td>" . $i . "</td><td>" . $clientjaime->date_publi . "</td><td><a href='" . $clientjaime->lien_facebook . "' target='_blank'>" . $clientjaime->Compte_facebook . "</a></td><td>" . $clientjaime->lien_facebook . "</td><td>" . $clientjaime->Nom_page . "</td><td class='text-center'>" . $statut . "</td></tr>";
      $i++;
    }


    $clientLFe = $this->global_model->PROP_CLT_LF($date, $this->session->userdata('matricule'));
    foreach ($clientLFe as $clientLFe) {
      $TestContLF[$b] = $clientLFe->lien_facebook;
      $contentlf .= "<tr><td>" . $b . "</td><td>" . $clientLFe->heure . "</td><td  class='text-center'>" . $clientLFe->Code_client . "</td><td><a href='" . $clientLFe->lien_facebook . "' target='_blank'>" . $clientLFe->Compte_facebook . "</a></td></tr>";
      $b++;
    }

    $life = $this->global_model->lifestyle(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($life as $clientjaime) {
      if (in_array($clientjaime->lien_facebook, $TestContLF)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $lifes .= "<tr><td>" . $l . "</td><td>" . $clientjaime->date_publi . "</td><td><a href='" . $clientjaime->lien_facebook . "' target='_blank'>" . $clientjaime->Compte_facebook . "</a></td><td>" . $clientjaime->lien_facebook . "</td><td>" . $clientjaime->Nom_page . "</td><td class='text-center'>" . $statut . "</td></tr>";
      $l++;
    }

    $client07 = $this->global_model->SAC007($this->session->userdata('page'));
    foreach ($client07 as $client07) {
      if (in_array($client07->lien_facebook, $TestConts)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      if ($client07->FACTURE == NULL) {
        $SAC007 .= "<tr><td>" . $client07->client . "</td><td class='collapse'>" . $f . "</td><td><a href='" . $client07->lien_facebook . "' target='_blank'>" . $client07->Compte_facebook . "</a></td><td>" . $client07->lien_facebook . "</td></tr>";
        $f++;
      }
    }
    $clientprovince = $this->global_model->vente_province($this->session->userdata('matricule'));
    foreach ($clientprovince as $clientprovince) {
      if (in_array($clientprovince->lien_facebook, $TestConts)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $province .= "<tr><td>" . $clientprovince->Code_client . "</td><td class='collapse'>" . $p . "</td><td><a href='" . $clientprovince->lien_facebook . "' target='_blank'>" . $clientprovince->Compte_facebook . "</a></td><td>" . $clientprovince->lien_facebook . "</td><td>" . $clientprovince->Status . "</td><td>" . $clientprovince->contacts . "</td><td class='text-center'>" . $clientprovince->District . "</td></tr>";
      $p++;
    }
    $data['TRC014'] = $this->global_model->TRC014($this->session->userdata('page'), date('Y-m-d'));
    $data['TRC014add'] = $this->global_model->addtrc014($this->session->userdata('matricule'));
    $data['TRC028'] = $this->global_model->TRC028($this->session->userdata('page'), date('Y-m-d'));
    $data['TRC028add'] = $this->global_model->addtrc028($this->session->userdata('matricule'));
    /* $data['TRC042'] = $this->global_model->TRC042($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC042add'] = $this->global_model->addtrc042($this->session->userdata('matricule'));
        $data['TRC056'] = $this->global_model->TRC056($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC070'] = $this->global_model->TRC070($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC084'] = $this->global_model->TRC084($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC098'] = $this->global_model->TRC098($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC112'] = $this->global_model->TRC112($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC126'] = $this->global_model->TRC126($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC140'] = $this->global_model->TRC140($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC154'] = $this->global_model->TRC154($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC168'] = $this->global_model->TRC168($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC182'] = $this->global_model->TRC182($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC196'] = $this->global_model->TRC196($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC210'] = $this->global_model->TRC210($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC224'] = $this->global_model->TRC224($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC238'] = $this->global_model->TRC238($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC252'] = $this->global_model->TRC252($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC266'] = $this->global_model->TRC266($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC280'] = $this->global_model->TRC280($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC294'] = $this->global_model->TRC294($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC308'] = $this->global_model->TRC308($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC322'] = $this->global_model->TRC322($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC336'] = $this->global_model->TRC336($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC350'] = $this->global_model->TRC350($this->session->userdata('page'),date('Y-m-d'));
        $data['TRC364'] = $this->global_model->TRC364($this->session->userdata('page'),date('Y-m-d'));*/
    $data['SAC007'] = $f;
    $data['prov1ce'] = $p;
    $data['jaimess'] = $jaimess;
    $data['province'] = $province;
    $data['lifes'] = $lifes;
    $data['clientrdv'] =  $this->global_model->rendez_vous($this->session->userdata('matricule'), date('Y-m-d'));
    $data['listeclientsac07'] =  $this->global_model->SAC07($this->session->userdata('page'));
    $data['listeclient49'] =  $this->global_model->client_a_traiterAAC49($this->session->userdata('page'));
    $data['listeclient28'] =  $this->global_model->client_a_traiterAAC28($this->session->userdata('page'));
    $data['listeclient70'] =  $this->global_model->client_a_traiterAAC70($this->session->userdata('page'));
    $data['vente_non_livre'] = $this->global_model->vente_non_livre($this->session->userdata('page'));
    $data['listeclient7'] = $this->global_model->client_a_traiterAAC7($this->session->userdata('page'));
    $data['clientctl007'] = $this->global_model->clientctl007($this->session->userdata('page'));
    $data['listeacc049'] = $this->global_model->listeAAC49($this->session->userdata('page'));
    $data['listeacc070'] = $this->global_model->listeAAC70($this->session->userdata('page'));
    //$data['lifestyle'] = $this->global_model->lifestyle(date('Y-m-d'),$this->session->userdata('matricule'));
    $this->render_view('operatrice/client/relance', $data);
  }

  public function add_client_update()
  {
    $this->load->model('global_model');
    $Code_client = $this->input->post('code_client');
    $compte = $this->input->post('compte');
    $lien = $this->input->post('lien');
    $page = $this->input->post('page');
    $matricule = $this->session->userdata('matricule');
    $Id_page = $this->session->userdata('page');
    $this->global_model->add_client_update($Code_client, $compte, $lien, $page, $matricule, $Id_page);
  }


  public function add_via_exel_file()
  {
    $this->load->model('global_model');
    $tmp_name = $_FILES["file"]["tmp_name"];
    $name = basename($_FILES["file"]["name"]);
    $uploads_dir = FCPATH . 'upload/excel';

    if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
      if ($xlsx = SimpleXLSX::parse("$uploads_dir/$name")) {

        $header_values = $rows = [];

        foreach ($xlsx->rows() as $k => $r) {
          if ($k === 0) {
            $header_values = $r;
            continue;
          }
          $rows[] = array_combine($header_values, $r);
        }
        foreach ($rows as $key => $rows) {
          $data = "";
          /**if(!$this->magasiner_model->selectStock_matier_premier(["ST_DESIGNATION"=>$rows['ST_DESIGNATION']])){
              $data = [
                  "ST_DESIGNATION"=>$rows["ST_DESIGNATION"], 
                  "ST_QUANTITE"=>$rows["ST_QUANTITE"],
                  "ST_TYPE"=>$rows["ST_TYPE"], 
                  "ST_PRIX_UNITAIRE"=>$rows["ST_PRIX_UNITAIRE"],
                  "ST_ORIGIN"=>"PLASMAD"
                  
              ];
              $this->magasiner_model->insertStock_matier_premier($data); **/
          $data = [
            "matricule" => $rows["matricule"],
            "codeclient" => $rows["codeclient"],
            "comptefb" => $rows["comptefb"],
            "lienfb" => $rows["lienfb"],
            "idpage" => $rows["idpage"],
            "Page" => $rows["Page"],
            "produit" => $rows["produit"],
            "statut" => $rows["statut"],
            "statut" => $rows["contact"]
          ];
          $this->global_model->add_via_excel($data);
        }
      }
    }
  }

  public function support_trc014()
  {
    $data['TRC014'] = $this->global_model->page_user($this->session->userdata('page'));
    $this->load->view('operatrice/client/support_trc014', $data);
  }

  public function support_trc028()
  {
    $data['TRC014'] = $this->global_model->page_user($this->session->userdata('page'));
    $this->load->view('operatrice/client/support_trc028', $data);
  }

  public function support_trc042()
  {
    $data['TRC014'] = $this->global_model->page_user($this->session->userdata('page'));
    $this->load->view('operatrice/client/support_trc042', $data);
  }

  public function check()
  {
    $this->load->model('global_model');
    $Code_client = $this->input->post('code_client');
    $page = $this->input->post('page');
    $matricule = $this->session->userdata('matricule');
    return $this->global_model->check($Code_client, $matricule, $page);
  }
  public function checkDiscussionRelance()
  {
    $idRelance = $this->input->post('idRelance');
    $this->load->model('global_model');
    $this->global_model->updateProduitRelnce(['IdRD' => $idRelance], ['statuRelanceRD' => 'off']);
  }
  public function rang()
  {
    $this->load->model('global_model');
    $client = $this->input->post('codeclient');
    $code = substr($client, 0, 22);
    $facture = $this->global_model->rang_koty($this->session->userdata('matricule'));
    $content = "";
    $contenu = "";
    $totalCA = 0;
    $ca = 0;
    $i = 1;
    foreach ($facture as $facture) {
      $detailkotysmiles = $this->global_model->getkotysmiletotalpossible(trim($facture->Id_facture));
      foreach ($detailkotysmiles as $value) {
        $Koty = $value->koty;
        $smiles = $value->smiles;
      }
      $totalkotysmile = $this->global_model->gettotalsmileskotyGlobale($client);
      foreach ($totalkotysmile as $value) {
        $KotyT = $value->koty;
        $SmilesT = $value->smiles;
      }
      $ca = $facture->Quantite * $facture->Prix_detail;
      $produit = $facture->Designation;
      $totalCA += $ca;
      $content .= "<tr><td>" . $facture->Code_client . "</td><td><a href='#' class='produit'>" . $facture->Code_produit . "</a></td><td class='text-center' style='font-size:12px'>" . $facture->Quantite . "</td><td style='font-size:12px'>" . number_format($ca, 0, '.', ',') . "</td><td>" . $Koty . "</td><td>" . $smiles . "</td></td></tr>";
    }
    if ($facture) {
      $contact = $facture->contacts;
    } else {
      $contact = "";
    }

    if ($facture) {
      $clients = $facture->Compte_facebook;
    } else {
      $clients = "";
    }


    $client = $this->global_model->client($this->session->userdata('matricule'));
    foreach ($client as $result) {

      $totalkotysmiles = $this->global_model->gettotalsmileskotyGlobale($result->Code_client);
      foreach ($totalkotysmiles as $value) {
        $KotyT = $value->koty;
        $SmilesT = $value->smiles;
      }

      $contenu .= "<tr><td></td><td><a href='#' class='client'>" . $result->Code_client . "</a></td><td>" . $result->Compte_facebook . "</td><td>" . $result->Nom_page . "</td><td>" . $KotyT . "</td></tr>";
      $i++;
    }


    $data = [
      'data' => $content,
      'contact' => $contact,
      'contenu' => $contenu,
      'totalCA' => $totalCA,
      'clients' => $clients,
      'dernier' => $this->global_model->dernier_contact($code)

    ];
    $statuttrim = $this->global_model->getclientstatuttrimes($SmilesT);
    $statutannuel = $this->global_model->getclientstatutAnnuel($SmilesT);
    $data['trimstatus'] =  $statuttrim;
    $data['annuelstatus'] =   $statutannuel;

    $this->render_view('operatrice/client/rang', $data);
  }

  public function nom_produit()
  {
    $this->load->model('global_model');
    $codeproduit = $this->input->post('codeproduit');
    $content = "";
    $produit = $this->global_model->nomproduit($codeproduit);
    $content .= "<tr style='font-size:10px;'><td class='text-center' style='width:200px'>" . $produit->Designation . "</td></tr>";
    echo "<table class='table table-bordered table1' style='font-size:10px;'><thead></thead><tbody>" . $content . "</tbody></table>";
  }

  public function historique_discu()
  {
    $this->load->model('global_model');
    $Code_client = $this->input->post('codeclient');
    $content = "";
    $historique = $this->global_model->historique_discussion($Code_client);
    foreach ($historique as $historique) {
      if ($historique->action == 'vente') {
        $content .= "<tr><td>" . $historique->date . "</td><td>" . $historique->heure . "</td><td>" . $historique->operatrice . "</td><td>" . $historique->Prenom . "</td><td>" . $historique->Nom_page . "</td><td><i class='fa fa-check-circle text-success'></i> &nbsp CONCLUE</td></tr>";
      } else {
        $content .= "<tr><td>" . $historique->date . "</td><td>" . $historique->heure . "</td><td>" . $historique->operatrice . "</td><td>" . $historique->Prenom . "</td><td>" . $historique->Nom_page . "</td><td></td></tr>";
      }
    }
    echo "<table class='table table-bordered table-striped table-hover'><thead class='text-center bg-primary text-white'><tr><th>Date</th><th>Heure</th><th>Matricule</th><th>Nom oplg</th><th>Nom page</th><th>Action</th></tr></thead><tbody>" . $content . "</tbody></table>";
  }

  public function historique_relance()
  {
    $this->load->model('global_model');
    $Code_client = $this->input->post('codeclient');
    $content = "";
    $historique = $this->global_model->historique_relance($Code_client);
    foreach ($historique as $value) {
      $content .= "<tr><td>" . $value->date . "</td><td>" . $value->types . "</td></tr>";
    }
    echo "<table class='table table-bordered'><thead><tr><th>Date</th><th>Type de relance</th></tr></thead><tbody>" . $content . "</tbody></table>";
  }

  public function liste()
  {
    $data['TRC042'] = $this->global_model->listeTRC042(date('Y-m-d'));
    $data['TRC042add'] = $this->global_model->addtrc042($this->session->userdata('matricule'));
    $data['GNPFPJI'] = $this->global_model->GNPFPJI(date('Y-m-d'));
    $data['addGNPFPJI'] = $this->global_model->addGNPFPJI(date('Y-m-d'));
    $data['vivitecwji'] = $this->global_model->vivitecwji(date('Y-m-d'));
    $data['vivitecwjii'] = $this->global_model->vivitecwjii(date('Y-m-d'));
    $data['passionlessjia'] = $this->global_model->passionlessjia(date('Y-m-d'));
    $data['GNPFJI'] = $this->global_model->GNPFJI(date('Y-m-d'));
    $data['VIVTECCJII'] = $this->global_model->VIVTECCJII(date('Y-m-d'));
    $data['zasynyvoloko'] = $this->global_model->zasynyvoloko(date('Y-m-d'));
    $data['addzasynyvoloko'] = $this->global_model->addzasynyvoloko();
    $data['VCONFJIA'] = $this->global_model->VCONFJIA(date('Y-m-d'));
    $data['GNPINKJII'] = $this->global_model->GNPINKJII(date('Y-m-d'));
    $data['TRC056'] = $this->global_model->TRC056($this->session->userdata('page'), date('Y-m-d'));
    $data['TRC070'] = $this->global_model->TRC070($this->session->userdata('page'), date('Y-m-d'));
    $data['TRC084'] = $this->global_model->TRC084($this->session->userdata('page'), date('Y-m-d'));
    $this->render_view('operatrice/client/liste', $data);
  }

  public function zasynyvoloko()
  {
    $i = 1;
    $contentsss = "";
    $Testzasynyvoloko = array();
    $clientjaimes = $this->global_model->test_zasynyvoloko(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaimes as $clientjaimes) {
      $Testzasynyvoloko[$i] = $clientjaimes->client;
      $contentsss .= "<tr><td>" . $i . "</td><td  class='text-center'>" . $clientjaimes->client . "</td></tr>";
      $i++;
    }
    $TRC084 = $this->global_model->zasynyvoloko(date('Y-m-d'));
    foreach ($TRC084 as $row) {
      if (in_array($row->Code_client, $Testzasynyvoloko)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client0007'>" . $row->Code_client . "</a>";
      $sub_array[] = "<a href='$row->lien' target='_blank'>" . $row->Compte . "</a>";
      $sub_array[] = $row->Page;
      $sub_array[] = $statut;
      $sub_array[] = "<button class='btn btn-primary'></button>";
      $sub_array[] = "<button class='btn btn-danger'></button>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function VIVITE_CLEAR_CONFIDENTjia()
  {
    $i = 1;
    $contentsss = "";
    $Testzasynyvoloko = array();
    $clientjaimes = $this->global_model->test_zasynyvoloko(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaimes as $clientjaimes) {
      $Testzasynyvoloko[$i] = $clientjaimes->client;
      $contentsss .= "<tr><td>" . $i . "</td><td  class='text-center'>" . $clientjaimes->client . "</td></tr>";
      $i++;
    }
    $TRC084 = $this->global_model->VCONFJIA(date('Y-m-d'));
    foreach ($TRC084 as $row) {
      if (in_array($row->Code_client, $Testzasynyvoloko)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client0007'>" . $row->Code_client . "</a>";
      $sub_array[] = "<a href='$row->lien' target='_blank'>" . $row->Compte . "</a>";
      $sub_array[] = $row->Page;
      $sub_array[] = $statut;
      $sub_array[] = "";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function VIVTECCJII()
  {
    $i = 1;
    $contentsss = "";
    $Testzasynyvoloko = array();
    $clientjaimes = $this->global_model->test_zasynyvoloko(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaimes as $clientjaimes) {
      $Testzasynyvoloko[$i] = $clientjaimes->client;
      $contentsss .= "<tr><td>" . $i . "</td><td  class='text-center'>" . $clientjaimes->client . "</td></tr>";
      $i++;
    }
    $TRC084 = $this->global_model->VIVTECCJII(date('Y-m-d'));
    foreach ($TRC084 as $row) {
      if (in_array($row->Code_client, $Testzasynyvoloko)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client0007'>" . $row->Code_client . "</a>";
      $sub_array[] = "<a href='$row->lien' target='_blank'>" . $row->Compte . "</a>";
      $sub_array[] = $row->Page;
      $sub_array[] = $statut;
      $sub_array[] = "";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function vivitecwjii()
  {
    $i = 1;
    $contentsss = "";
    $Testzasynyvoloko = array();
    $clientjaimes = $this->global_model->test_zasynyvoloko(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaimes as $clientjaimes) {
      $Testzasynyvoloko[$i] = $clientjaimes->client;
      $contentsss .= "<tr><td>" . $i . "</td><td  class='text-center'>" . $clientjaimes->client . "</td></tr>";
      $i++;
    }
    $TRC084 = $this->global_model->vivitecwjii(date('Y-m-d'));
    foreach ($TRC084 as $row) {
      if (in_array($row->Code_client, $Testzasynyvoloko)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client0007'>" . $row->Code_client . "</a>";
      $sub_array[] = "<a href='$row->lien' target='_blank'>" . $row->Compte . "</a>";
      $sub_array[] = $row->Page;
      $sub_array[] = $statut;
      $sub_array[] = "";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function vivitecwji()
  {
    $i = 1;
    $contentsss = "";
    $Testzasynyvoloko = array();
    $clientjaimes = $this->global_model->test_zasynyvoloko(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaimes as $clientjaimes) {
      $Testzasynyvoloko[$i] = $clientjaimes->client;
      $contentsss .= "<tr><td>" . $i . "</td><td  class='text-center'>" . $clientjaimes->client . "</td></tr>";
      $i++;
    }
    $TRC084 = $this->global_model->vivitecwji(date('Y-m-d'));
    foreach ($TRC084 as $row) {
      if (in_array($row->Code_client, $Testzasynyvoloko)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client0007'>" . $row->Code_client . "</a>";
      $sub_array[] = "<a href='$row->lien' target='_blank'>" . $row->Compte . "</a>";
      $sub_array[] = $row->Page;
      $sub_array[] = $statut;
      $sub_array[] = "";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function passionlessjia()
  {
    $i = 1;
    $contentsss = "";
    $Testzasynyvoloko = array();
    $clientjaimes = $this->global_model->test_zasynyvoloko(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaimes as $clientjaimes) {
      $Testzasynyvoloko[$i] = $clientjaimes->client;
      $contentsss .= "<tr><td>" . $i . "</td><td  class='text-center'>" . $clientjaimes->client . "</td></tr>";
      $i++;
    }
    $TRC084 = $this->global_model->passionlessjia(date('Y-m-d'));
    foreach ($TRC084 as $row) {
      if (in_array($row->Code_client, $Testzasynyvoloko)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client0007'>" . $row->Code_client . "</a>";
      $sub_array[] = "<a href='$row->lien' target='_blank'>" . $row->Compte . "</a>";
      $sub_array[] = $row->Page;
      $sub_array[] = $statut;
      $sub_array[] = "";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function GNPINKJII()
  {
    $i = 1;
    $contentsss = "";
    $Testzasynyvoloko = array();
    $clientjaimes = $this->global_model->test_zasynyvoloko(date('Y-m-d'), $this->session->userdata('matricule'));
    foreach ($clientjaimes as $clientjaimes) {
      $Testzasynyvoloko[$i] = $clientjaimes->client;
      $contentsss .= "<tr><td>" . $i . "</td><td  class='text-center'>" . $clientjaimes->client . "</td></tr>";
      $i++;
    }
    $TRC084 = $this->global_model->GNPINKJII(date('Y-m-d'));
    foreach ($TRC084 as $row) {
      if (in_array($row->Code_client, $Testzasynyvoloko)) {
        $statut = "<i class='fa fa-check-circle text-success'></i>";
      } else {
        $statut = "<i class='fa fa-times-circle text-danger'></i>";
      }
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client0007'>" . $row->Code_client . "</a>";
      $sub_array[] = "<a href='$row->lien' target='_blank'>" . $row->Compte . "</a>";
      $sub_array[] = $row->Page;
      $sub_array[] = $statut;
      $sub_array[] = "";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function Listetombolat()
  {
    $this->render_view('operatrice/tombola/liste');
  }
  public function dataTombola()
  {
    $datas = $this->global_model->selectsTombolaGroup(['operatrice' => $this->session->userdata('matricule')]);
    $data = array();
    foreach ($datas as $row) {
      $sub_array = [];
      $sub_array[] =  $row->id_Tombola;
      $sub_array[] = $row->facture;
      $sub_array[] = $row->codeClient;
      $sub_array[] = $row->Compte_facebook;
      $sub_array[] = $row->Contact;
      if ($row->statut == 'off') {
        $sub_array[] = "<a href='#' class='btn btn-info detail btn-sm'>Détail</a>&nbsp;<a href='#' class='btn btn-success  btn-sm'><i class='fa fa-check'></i></a>";
      } else {
        $sub_array[] = "<a href='#' class='btn btn-info detail btn-sm'>Détail</a>&nbsp;<a href='#' class='btn btn-warning ticket btn-sm'>Ticket</a>";
      }


      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function testPrixPromotion()
  {
    $codePromo = $this->input->post('codePromo');
    $data = $this->produit_model->Selectpromotion(['Pr_Code_Promo' => $codePromo]);
    echo json_encode($data);
  }
  public function changePhoto()
  {
    $uploads_dir = FCPATH . 'images/operatrice/PhotoUser';
    $tmp_name = $_FILES["file"]["tmp_name"];
    $name = basename($this->session->userdata("matricule") . ".jpg");
    if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
      return true;
    } else {
      return false;
    }
  }

  public function detailVente()
  {
    $this->load->model('client_model');
    $data = [
      'data' => $this->client_model->vente_clientel(["facture.Id_facture" => $this->input->post('facture')])
    ];

    $this->load->view('operatrice/client/detail_facture', $data);
  }
  public function genereTicket()
  {
    $client = $this->input->post('client');
    $facture = $this->input->post('facture');
    $this->load->view('operatrice/tombola/ticket', compact("client", "facture"));
  }

  public function printdataTombola()
  {
    $date = date('Y-m-d');
    $excel = "TOMBOLA DU : $date\n\n";

    $excel .= "N°\tFacture\tCode clientt\Compte facebook\tContact\n";

    $datas = $this->global_model->selectsTombola();
    $data = array();
    foreach ($datas as $row) {

      $sub_array = [];
      $numero = $row->id_Tombola;
      while (strlen($numero) < 5) {
        $numero = "0" . $numero;
      }
      $excel .= "$numero\t$row->facture\t$row->codeClient\t$row->Compte_facebook\t$row->Contact\n";
    }

    header("Content-type: application/vnd.ms-excel");
    header("Content-disposition: attachment; filename=TOMBOLA DU : " . $date . ".xls");
    print $excel;
    exit;
  }

  public function infofacture()
  {
    $facture = $this->input->post('facture');
    $message = ['message' => false, 'donne' => ''];
    $data = $this->global_model->selectFacture(['Id_facture' => $facture]);
    if ($data) {
      $message['message'] = true;
      $message['donne'] =  $data;
    }
    echo json_encode($message);
  }

  /*
  public function Liste_Tombola()
  {
    $this->load->model('relance_model');
    $matricule=$this->session->userdata('matricule');
    $data = $this->relance_model->listeTombola($matricule)
    return $this->render_view('operatrice/tombola/Liste_Tombola',$data);
  }
  */
  public function sauveRelanceDiscussion()
  {
    $this->load->model('discussion_model');
    $codeClient = $this->input->post('client');
    $page = $this->input->post('page');
    $reponse = $this->discussion_model->selectRelanceDiscussion(['CodeClient' => $codeClient, 'PageRD' => $page]);
    if ($reponse) {
      if ($reponse->Type == "Relance sans achat" or $reponse->Type == "") {
        $dateModi = explode(" ", $reponse->dateDeDerniereModi);
        if (date('Y-m-d') != date($dateModi[0])) {
          $NbStat = (int) $reponse->StatutRD + 1;
          $interval = "";
          if ($NbStat == 2) {
            $interval = "J+14";
            $dt = new DateTime();
            $dt->modify('+14 day');
            $date = $dt->format('Y-m-d');
          } else {
            $interval = "J+35";
            $dt = new DateTime();
            $dt->modify('+35 day');
            $date = $dt->format('Y-m-d');
          }

          $this->discussion_model->UpdateRelanceDiscussion(
            [
              'IdRD' => $reponse->IdRD
            ],
            [
              'StatutRD' => $NbStat,
              'DateRD' => $date,
              'statuRelanceRD' => 'on',
              'Intervale' => $interval

            ]
          );
        }
      }
    } else {
      $dt = new DateTime();
      $dt->modify('+7 day');
      $date = $dt->format('Y-m-d');
      $this->discussion_model->insertRelanceDiscussion([
        "CodeClient" => $codeClient,
        "DateRD" => $date,
        "dateDeCreatiion" => date('Y-m-d'),
        "OperatriceRD" => $this->session->userdata('matricule'),
        "PageRD" => $page,
        "Intervale" => "J+7",
        "StatutRD" => 1,
        'Type' => 'Relance sans achat'
      ]);
    }
  }
  public function anniversaire()
  {
    $this->render_view('operatrice/Relances/anniversaire');
  }
  public function liste_anniv()
  {
    $this->load->model('client_model');
    //$client =  $this->client_model->rechercheClientAniv("clientpo.datedenregistrement = '" . date('Y-m-d') . "' AND  discussion.page = ".$this->session->userdata('page'));
    $client = $this->db->query("SELECT  
    (SELECT COUNT(facture.Code_client) FROM facture WHERE  facture.Code_client= clientpo.Code_client AND facture.Status = 'livre') as 'achat',
    (SELECT SUM(`detailvente`.`Quantite`*`prix`.`Prix_detail`) FROM `detailvente` JOIN `prix` ON `prix`.`Id`=`detailvente`.`Id_prix` JOIN `facture` ON `facture`.`Id`=`detailvente`.`Facture` WHERE (`detailvente`.`Facture` = `facture`.`Id` AND `facture`.`Code_client`=clientpo.`Code_client`) AND facture.Status = 'livre') AS 'totalAchat',
    clientpo.datedenregistrement,discussion.id,clientpo.Code_client,clientpo.Prenom,clientpo.Nom,clientpo.Compte_facebook,discussion.page,discussion.id_discussion   FROM `discussion` JOIN `clientpo` ON `discussion`.`client`=`clientpo`.`Code_client` WHERE ( `clientpo`.`datedenregistrement`<>'".date("Y-m")."%') AND `clientpo`.`datedenregistrement` LIKE '%-".date('m')."-%' AND `discussion`.`page` ='".$this->session->userdata('page')."' GROUP BY `clientpo`.`Code_client` ORDER BY `discussion`.`id` ASC")->result_object();
    $data = array();

    foreach ($client as $client) {
      if($client->achat > 2 && $client->totalAchat > 30000){
        $test = $this->client_model->bonDAchatSelect(["CODE_CLIENT"=>$client->Code_client]);
       
        $sub_array = [];
        $sub_array[] = $client->datedenregistrement;
        $sub_array[] = $client->Code_client;
        $sub_array[] = $client->Nom . " " . $client->Prenom;
        $sub_array[] = $client->Compte_facebook;
        $sub_array[] = number_format($client->totalAchat, 2, ',', ' ');
        $sub_array[] =$client->achat;
        $sub_array[] = '<a href="'. base_url('images/client/' . $client->Code_client . ".jpg").'" data-lightbox="roadtrip"><img src="' . base_url('images/client/' . $client->Code_client . ".jpg") . '" class="img-thumbnail" style="width:40px;height: 40px;"></a>';
        $sub_array[] = '<a href="'.base_url('operatrice/Clients/detail_client/'.$client->Code_client).'" target=_blanc class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>';
        if($test){
          $sub_array[] = '<a href="#" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>';
        }else{  
        $sub_array[] = '<a href="#" class="btn btn-warning btn-sm editAniv" id="'.$client->Code_client.'_'.$client->id_discussion.'_'.$client->page.'"><i class="fa fa-edit"><i></a>';
        }
        $data[] = $sub_array;
      }
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function detailachat($codeClient){

  }
  public function mettre_a_jour(){
    $this->load->modal('global_model');
    $IDBON = $this->input->post('id');
    echo $this->global_model->update_bon_achat(["IDBON"=>$IDBON],['STATUT'=>'off']);
  
  }

  public function saveBon(){
    $this->load->model('Global_model');
    $designation = $this->input->post('designation');
    $valeur = $this->input->post('valeur');
    $client = $this->input->post('client');
    $dernier = date("t");
    echo $this->global_model->insert_bon_achat([
          "DATEDECREATION"=>date('Y-m-d'),
          "DESIGNATION"=>$designation,
          "VALEUR"=>$valeur,
          "STATUT"=>"on",
          "CODE_CLIENT"=>$client,
          "DATEDEDESACTIVATION"=>date('Y-m')."-".$dernier
    ]);
    
  }
  public function saveRemarqueOpl(){
    $this->load->model('Calendrier_model');
    $facture = $this->input->post('facture');
    $remarque = $this->input->post('remarque');
    echo $this->Calendrier_model->updateFacture($facture,['Remarque'=> $remarque]);
  }

  public function Nouveau_Sondage(){
    $this->load->model('Global_model');
     $data['page'] = $this->Global_model->Get_Page_Active();
     $this->render_view('operatrice/Sondage/nouveau',$data);
  }

  public function Afficher_info_client(){
    $this->load->model('Global_model');
    $link = $this->input->post('link');
    $data['info_client'] = $this->Global_model->Get_info_client_by_link($link);
    $data['page'] = $this->Global_model->Get_Page_Active();
    $this->load->view('operatrice/Sondage/info-client',$data);

 
  }

  public function save_sondage(){
    $Code_client = $this->input->post('Code_client');
    $type = $this->input->post('type');
    $client = $this->input->post('client');
    $reponse = $this->input->post('reponse');
    $produit = $this->input->post('produit');
    $page  = $this->input->post('page');
    $reference  = $this->input->post('reference'); 
    $operatrice = $this->session->userdata('matricule');
    $date = new dateTime();
    $dt = $date->format('Y-m-d');
    $data = [
      'Date'=>$dt,
      'Operatrice'=>$operatrice,
      'type'=>$type,
      'Code_client'=>$Code_client,
      'Client'=>$client,
      'page'=>$page,
      'produit'=>$produit,
      'Reponse'=>$reponse,
      'reference'=>$reference,
      'Statut'=>'Nouveau'
    ];
    $this->db->insert('Sondage_temoignage',$data);
  }

  public function Liste_sondage(){
    $this->load->model('Global_model');
    $date = new dateTime();
    $dt = $date->format('Y-m-d');
    $operatrice = $this->session->userdata('matricule');
    $data['liste_temoignage'] = $this->Global_model->Get_sondage_temoignage_by_operatrice($operatrice,'Temoignage',$dt);
    $data['liste_sondage'] = $this->Global_model->Get_sondage_temoignage_by_operatrice($operatrice,'Sondage',$dt);
    $data['liste_faharetana'] = $this->Global_model->Get_sondage_temoignage_by_operatrice($operatrice,'Faharetana',$dt);
    $data['reference_temoignage'] = $this->Global_model->Get_reference_Temoigange($operatrice,'Temoignage',$dt);
    $data['reference_sondage'] = $this->Global_model->Get_reference_Temoigange($operatrice,'Sondage',$dt);
    $data['reference_faharetana'] = $this->Global_model->Get_reference_Temoigange($operatrice,'Faharetana',$dt);
    $this->render_view('operatrice/Sondage/liste',$data);
   
  }

  public function Mes_TSF(){
    $this->load->model('Global_model');
    $operatrice = $this->session->userdata('matricule');
    $data['liste_tsf'] = $this->Global_model->Get_all_TSF_by_opl($operatrice);
     $this->render_view('operatrice/Sondage/test_nouveau',$data);
  }

  public function Save_TSF(){
    $date = $this->input->post('date');
    $page = $this->input->post('page');
    $produit = $this->input->post('produit');
    $reference = $this->input->post('reference');
    $Statut_Correcteur = "Non_corriger";
    $Statut_opl = "Encours";
    $statut_Info= "Nouveau";
    $operatrice = $this->session->userdata('matricule');
     $data = [
      'Date'=>$date,
      'Operatrice'=>$operatrice,
      'Page'=>$page,
      'Produit'=>$produit,
      'Reference'=>$reference,
      'Statut_opl'=>$Statut_opl,
      'Statut_Correcteur'=>$Statut_Correcteur, 
      'Statut_info'=>$statut_Info
    ];
    $this->db->insert('Tache_TSF',$data);
    $this->db->flush_cache();
    $this->db->SELECT('Id');
    $this->db->order_by('Id','DESC');
    $this->db->limit('1');
    $lastid = $this->db->get('Tache_TSF');
    $newlastid  =  $lastid->row_array();
    $detail_TSF['Id']= $newlastid['Id'];
    echo json_encode($detail_TSF);  
  }

  public function Save_TSF_detail(){
    $date = new dateTime();
    $dt = $date->format('Y-m-d');
    $Date_detail =  $dt;
    $Code_client =$this->input->post('Code_client');
    $Client =$this->input->post('Client');
    $Type = $this->input->post('Type');
    $Reponse = $this->input->post('Reponse');
    $Id =$this->input->post('Id');
    $data = [
      'Date_detail'=>$dt,
      'Code_client'=>$Code_client,
      'Client'=>$Client,
      'Type'=>$Type,
      'Reponse'=>$Reponse,
      'Statut'=>'Nouveau',
      'Id_Tache_TSF'=>$Id
    ];
    $this->db->insert('Tache_TSF_detail',$data);
    echo $Id;
  }

  public function TSF_detail($id){
     $this->load->model('Global_model');
     $data['liste_temoignage'] = $this->Global_model->Get_TSF_detatil_by_id($id,'Temoignage');
     $data['liste_sondage'] = $this->Global_model->Get_TSF_detatil_by_id($id,'Sondage');
     $data['liste_faharetana'] = $this->Global_model->Get_TSF_detatil_by_id($id,'Faharetana');
     $this->render_view('operatrice/Sondage/tsf_detail',$data);
  }

  public function TSF_edit($id){
     $this->load->model('Global_model');
     $data['page'] = $this->Global_model->Get_Page_Active();
     $data['info_tsf'] = $this->Global_model->Get_TSF_by_Id($id);
     $data['detail_tsf'] = $this->Global_model->Get_TSF_detatil($id); 
     $this->render_view('operatrice/Sondage/tsf_edit',$data); 

  }

  public function Delete_TSF_detail_By_Id(){
     $Id =$this->input->post('Id_detail_tsf');
     $this->db->where('Id', $Id);
     $this->db->delete('Tache_TSF_detail');
  }

  public function Valider_TSF_opl(){
     $Id =$this->input->post('id_tsf');
     $Statut_opl = "Terminer";
     $data = [
      'Statut_opl'=>$Statut_opl
     ];
    $this->db->where('Id', $Id);
    $this->db->update('Tache_TSF', $data);
  }

  public function Suprimer_TSF(){
     $Id =$this->input->post('Id_tsf');
     $this->db->where('Id', $Id);
     $this->db->delete('Tache_TSF');
  }

  public function do_upload(){
      
      $code_client  = $this->input->post('codeclient');
      $config['upload_path']='./images/client/';
      $config['allowed_types']='jpg';
      $config['max_size']      = 10000; 
      $config['max_width']     = 10000; 
      $config['max_height']    = 10000; 
      $filename = $code_client;
      $config['file_name'] = $filename;
      $this->load->library('upload', $config);  
      if(!$this->upload->do_upload('userfile')){
         $error = array('error' => $this->upload->display_errors()); 
         $data['message'] = "La photo du client n'est pas telechager corectement";
         $data['class']="danger";
         $this->load->view('back/header');   
         $this->load->view('/operatrice/Sondage/',$data);
         $this->load->view('back/footer');
      }
      
   }
  public function Livraion_du_jour_export()
  {
    $this->load->model('global_model');
    $LivraisonDuJourExprot = $this->global_model->getlivraison($this->session->userdata('matricule'));
    $this->render_view('operatrice/etat_de_livraison/exportelisteliv', ['data' => $LivraisonDuJourExprot]);
  }


}
