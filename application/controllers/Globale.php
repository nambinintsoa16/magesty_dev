<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
class globale extends My_Controller
{

    public function index()
    {
    }
    public function groupe($famille)
    {
        $this->load->model('global_model');
        return $this->global_model->groupe($famille);
    }

    public function loadProduitDiscussion()
    {
    }
    public function famille()
    {
        $this->load->model('global_model');
        $famille = $this->input->post('famille');
        $data = $this->global_model->groupe($famille);
        $json = array('message' => false);
        if ($data) {
            $json['message'] = true;
            $json['content'] = '';
            foreach ($data as $data) {
                $json['content'] .= "<option value='$data->Id'>$data->groupe</option>";
            }
        }
        echo json_encode($json, true);
    }

    public function annulationCommande()
    {
        $this->load->model('calendrier_model');
        $facture = $this->input->post('facture');
        $remarque = $this->input->post('remarque');
        $code_annulation = $this->input->post('code_annulation');
        $this->calendrier_model->annule_facture($facture);
        $this->calendrier_model->annulelivre($remarque, $code_annulation, $facture);
        echo json_encode(array('message' => true));
    }

    public function annulationCommandes()
    {
        $this->load->model('Administrateur_model');
        $this->load->model('calendrier_model');
        $facture = $this->input->post('facture');
        $remarque = $this->input->post('remarque');
        $code_annulation = $this->input->post('code_annulation');
        $nomlivre = $this->input->post('nomlivre');

        $movement = $this->Administrateur_model->selectKoty(["facture" => $facture]);
        if ($movement) {
            $compte = $this->Administrateur_model->selectCompte(['Client' => $movement->Client]);
            if ($compte) {
                if (strtoupper($movement->Type) == "ACHAT") {
                    $newkoty = $compte->Koty +  $movement->Koty;
                    if ($this->Administrateur_model->updateCompteKoty(["Client" => $movement->Client], ["Koty" => $newkoty])) {
                        return $this->Administrateur_model->Deletetransaction(["facture" => $facture]);
                    }
                } else if (strtoupper($movement->Type) == "GAIN") {
                    $newkoty = $compte->Koty -  $movement->Koty;
                    if ($this->Administrateur_model->updateCompteKoty(["Client" => $movement->Client], ["Koty" => $newkoty])) {
                        return $this->Administrateur_model->Deletetransaction(["facture" => $facture]);
                    }
                }
            }
        }


        $this->calendrier_model->annule_facture($facture);
        $this->calendrier_model->annulelivres($remarque, $code_annulation, $facture, $nomlivre);
    }
    public function produitname()
    {
        $this->load->model('global_model');
        $famille = $this->input->post('famille');
        $groupe = $this->input->post('groupe');
        $Localite = $this->input->post('zone');
        $json = array('message' => false);
        $data = $this->global_model->produitname($famille, $groupe, $Localite);
        if ($data) {
            $json['message'] = true;
            $json['content'] = '';
            foreach ($data as $data) {
                $json['content'] .= "<option value='$data->Id|$data->Prix_detail'>$data->Code_produit|$data->Designation</option>";
            }
        }
        echo json_encode($json, true);
    }


    public function produitnamekoty()
    {
        $this->load->model('global_model');
        $famille = $this->input->post('famille');
        $groupe = $this->input->post('groupe');
        $Localite = $this->input->post('zone');
        $json = array('message' => false);
        $data = $this->global_model->produitname($famille, $groupe, $Localite);
        if ($data) {
            $json['message'] = true;
            $json['content'] = '';
            foreach ($data as $data) {
                $json['content'] .= "<option value='$data->Id|$data->Prix_zen'>$data->Code_produit|$data->Designation</option>";
            }
        }
        echo json_encode($json, true);
    }
    public function detail_client()
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

    public function testLink()
    {
        $this->load->model('global_model');
        $json = array('exist' => 'false');
        if ($this->input->post('type') == "link") {
            $data = $this->global_model->testLinkFb($this->input->post('liensurfb'));
            if ($data) {
                $json['exist'] = 'exist';
                $json['nom'] = $data->Nom . " " . $data->Prenom;
                $json['contact'] = $data->Contact;
                $json['Code_client'] = $data->Code_client;
                $json['Compte_facebook'] = $data->Compte_facebook;
                $json['lien_facebook'] = $data->lien_facebook;
                $json['commerciale_terain'] = $data->Commercial;
                $json['coach'] = $data->Coach;
                $json['image'] = base_url() . "images/client/" . $data->Code_client . ".jpg";
            }
        } else if ($this->input->post('type') == "Potentiel") {

            /*if($datas){
           $json['exist']='potentiel'; 
           $json['nom']=$datas->nomPrenom;
           $json['Code_client']=$datas->Code_client;
           $json['Compte_facebook']=$datas->Compte_facebook;
           $json['lien_facebook']=$datas->lien_facebook;
       }*/
        }
        echo json_encode($json);
    }

    public function changePhoto()
	{ 
		$uploads_dir = FCPATH.'images/operatrice/PhotoUser';
		$tmp_name = $_FILES["file"]["tmp_name"];
		$name = basename($this->session->userdata("matricule").".jpg");
		if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
           return true;
		}else{
			return false;
		}
	
	}
}