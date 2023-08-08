<?php
defined('BASEPATH') or exit('No direct script access allowed');
class user extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->library('email');
    date_default_timezone_set('Europe/Moscow');
  }
  public function dateChart()
  {
    $reponse = $this->user_model->dateAchat(['Matricule_personnel' => $this->session->userdata('matricule')]);
    $resultat = array();
    $donne = array();
    $value = array();
    foreach ($reponse as $key => $reponse) {
      array_push($resultat, $reponse->Date);
      $result = "";
      $result =  $this->user_model->dataAchat(['Matricule_personnel' => $this->session->userdata('matricule'), 'Date' => $reponse->Date]);
      array_push($donne, $result->total);
    }


    $data = [
      'date' => $resultat,
      'data' => $donne

    ];
    echo json_encode($data);
  }

  public function bar()
  {
    $this->load->model('client_model');
    $codeClient = $this->input->post('codeclient');
    $reponse = $this->client_model->dataAchat(['Matricule_personnel' => $this->session->userdata('matricule')]);
    $AUT = 0;
    $BEA = 0;
    $BOI = 0;
    $DEO_PAR = 0;
    $HBD = 0;
    $HC = 0;
    $LES = 0;
    $SC = 0;
    $SV = 0;

    foreach ($reponse as $key => $reponse) {
      $donne = $this->client_model->produits(['Code_produit' => $reponse->Code_produit]);
      if ($donne->famille == "AUTRES") {
        $AUT += $reponse->Quantite;
      } else if ($donne->famille == "BEAUTE") {
        $BEA += $reponse->Quantite;
      } else if ($donne->famille == "DEO & PARFUM") {
        $DEO_PAR += $reponse->Quantite;
      } else if ($donne->famille == "BOISSON") {
        $BOI += $reponse->Quantite;
      } else if ($donne->famille == "HYGIENE BUCO-DENTAIRE") {
        $HBD += $reponse->Quantite;
      } else if ($donne->famille == "HYGIENE CORPORELLE") {
        $HC += $reponse->Quantite;
      } else if ($donne->famille == "LESSIVE") {
        $LES += $reponse->Quantite;
      } else if ($donne->famille == "SOINS CAPILLAIRE") {
        $SC += $reponse->Quantite;
      } else if ($donne->famille == "SOINS VISAGE") {
        $SV += $reponse->Quantite;
      }
    }
    $data = array('donne' => ["$AUT", "$BEA", "$BOI", "$DEO_PAR", "$HBD", "$HC", "$LES", "$SC", "$SV"]);
    //famille
    echo json_encode($data);
  }
  public function tableData()
  {
    //$this->input->post('parametre')
    $parametre = $this->input->post('parametre');
    if ($parametre == 'vente') {
      $resutl = $this->user_model->tableData();
      $this->load->view('operatrice/user/tableau/CommendeRealiser', ['data' => $resutl]);
    } elseif ($parametre == 'produit') {
      $resultProduct = $this->user_model->ProduitVendu();
      $this->load->view('operatrice/user/tableau/ProduitVendu', ['data' => $resultProduct]);
    } elseif ($parametre == 'client') {
      $resultClient = $this->user_model->NouveauClients(['datedenregistrement' => date('Y-m-d'), 'Matricule_personnel' => $this->session->userdata('matricule')]);
      $this->load->view('operatrice/user/tableau/NouveauClient', ['data' => $resultClient]);
    } elseif ($parametre = 'jours') {
      $resutlVente = $this->user_model->VenteDuJours();
      $this->load->view('operatrice/user/tableau/VenteDuJour', ['data' =>  $resutlVente]);
    }
  }

  public function exportUserDataExcel()
  {
    $parametre = $this->input->get('parametre');
    switch ($parametre) {
      case 'vente':
        $excel = "Client\tCode produit\tDésignation\tQuantite\tP.U\tTotal\n\n";
        $resutl = $this->user_model->tableData();
        foreach ($resutl as  $resutl) {
          $excel .= "$resutl->Code_client\t$resutl->Code_produit\t$resutl->Designation\t$resutl->Quantite\t" . number_format($resutl->Prix_detail, 2, ',', ' ') . "\t" . number_format($resutl->Prix_detail * $resutl->Quantite, 2, ',', ' ') . "\n";
        }
        break;
      case 'produit':
        $Product = $this->user_model->ProduitVendu();
        $excel = "Code produit\tDésignation\tStatus\tQuantite\tP.U\n\n";
        foreach ($Product as  $Product) {
          $excel .= "$Product->Code_produit\t$Product->Designation\t$Product->Status\t$Product->Quantite\t" . number_format($Product->Prix_detail, 2, ',', ' ') . "\n";
        }
        break;
      case 'client':
        $resultClient = $this->user_model->NouveauClients(['datedenregistrement' => date('Y-m-d'), 'Matricule_personnel' => $this->session->userdata('matricule')]);

        $excel = "Code client\tNom et Prénom\tContact\tIdentifient sur facebook\n";

        foreach ($resultClient as $resultClient) {
          $excel .= "$resultClient->Code_client\t$resultClient->Nom" . ' ' . "$resultClient->Prenom\t$resultClient->Contact \t$resultClient->Compte_facebook\n";
        }
        break;
      case 'jours':
        $resutlVente = $this->user_model->VenteDuJours();

        $excel = "Code produit\tDésignation\tStatus\tQuantite\tP.U\tTotal\n";

        foreach ($resutlVente as  $data) {
          $excel .= "$data->Code_produit\t$data->Designation\t" . strtoupper(str_replace("_", " ", $data->Status)) . "\t$data->Quantite\t" . number_format($data->Prix_detail, 2, ',', ' ') . "\t" . number_format($data->Prix_detail * $data->Quantite, 2, ',', ' ') . "\n";
        }
        break;

      default:
        $excel = "";
        break;
    }


    header("Content-type: application/vnd.ms-excel");
    header("Content-disposition: attachment; filename=" . date("d-m-Y") . "$parametre.xls");
    print $excel;
    exit;
  }
  public function exportUserDataPDF()
  {
    $this->load->library('pdf');
    $parametre = $this->input->get('parametre');

    switch ($parametre) {
      case 'vente':
        $resutl = $this->user_model->tableData();
        $html =  $this->load->view("operatrice/user/templeteVentePdf",["data"=> $resutl],true);
        break;
      case 'produit':
        $Product = $this->user_model->ProduitVendu();
        $html =  $this->load->view("operatrice/user/templeteProduitPdf",["data"=> $Product],true);
        break;
      case 'client':
        $resultClient = $this->user_model->NouveauClients(['datedenregistrement' => date('Y-m-d'), 'Matricule_personnel' => $this->session->userdata('matricule')]);
        $html =  $this->load->view("operatrice/user/templeteClientPdf",["data"=> $resultClient],true);
        break;
      case 'jours':
        $resutlVente = $this->user_model->VenteDuJours();
        $html =  $this->load->view("operatrice/user/templeteJourPdf",["data"=> $resutlVente],true);
        break;
      default:
        $html = "";
        break;
    }

    $filename = $parametre . " " . date('d-m-Y');
    $dompdf = new pdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename);
  }
  public function rapport_du_jour(){
    $resutlVente = $this->user_model->VenteDuJours();
    $this->render_view('operatrice/user/rapport/rapport_du_jour',['data' =>  $resutlVente]);
  
  }
  public function send_rapport_du_jour(){
      $config['smtp_crypto'] = 'ssl';
      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'mail48.lwspanel.com';
      $config['smtp_user'] = 'mailtestMagesti@combo.fun';
      $config['smtp_pass'] = 'Teste@mail2022';
      $config['smtp_port'] = 465;
      $config['mailtype'] = "html";
      
      $this->email->initialize($config);
      $resutlVente = $this->user_model->VenteDuJours();
      $html = $this->load->view('operatrice/user/tableau/VenteDuJour', ['data' =>  $resutlVente],true);

      header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
      header("Content-Disposition: attachment;filename=".base_url('upload/excel/andrana.xlt'));
      header("Cache-Control: max-age=0");


      $this->email->to('nambinintsoa16@gmail.com');
      $this->email->from('mailtestMagesti@combo.fun');
      $this->email->subject('TEST');
      $this->email->message($html);
      $this->email->attach(base_url('upload/excel/andrana.xlt'));
    //  var_dump($this->email->send());
  }
}