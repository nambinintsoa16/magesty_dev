<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accueil extends My_Controller
{

	public function index()
	{
		$this->load->model('global_model');
		$this->load->model('calendrier_model');
		if ($this->session->userdata('designation') == "Operatrice") {
			if ($this->global_model->pourcentage_transaction() != 0) {
				$livre = ($this->global_model->pourcentage_transaction('livre') * 100) / $this->global_model->pourcentage_transaction();
				$annule = ($this->global_model->pourcentage_transaction('annule') * 100) / $this->global_model->pourcentage_transaction();
				$confirmer = ($this->global_model->pourcentage_transaction('confirmer') * 100) / $this->global_model->pourcentage_transaction();
			} else {
				$livre = 0;
				$annule = 0;
				$confirmer = 0;
			}
			$data = [
				'client' => $this->global_model->nombre_client(),
				'produit' => $this->global_model->nombre_produit(),
				'transaction' => $this->global_model->nombre_transaction(),
				'livre' => $livre,
				'annule' => $annule,
				'confirmer' => $confirmer
			];
		} else if ($this->session->userdata('designation') == "Service_clientel") {
			if ($this->global_model->pourcentage_transaction_livre() != 0) {
				$livre = ($this->global_model->pourcentage_transaction_livre('livre') * 100) / $this->global_model->pourcentage_transaction_livre();
				$annule = ($this->global_model->pourcentage_transaction_livre('annule') * 100) / $this->global_model->pourcentage_transaction_livre();
				$confirmer = ($this->global_model->pourcentage_transaction_livre('confirmer') * 100) / $this->global_model->pourcentage_transaction_livre();
			} else {
				$livre = 0;
				$annule = 0;
				$confirmer = 0;
			}
			$data = [
				'client' => $this->global_model->nombre_client(),
				'produit' => $this->global_model->nombre_produit(),
				'transaction' => $this->global_model->pourcentage_transaction_livre(),
				'livre' => $livre,
				'annule' => $annule,
				'confirmer' => $confirmer
			];
		} else if ($this->session->userdata('designation') == "Controlleur") {

			$date = $this->input->post('date');
			if (empty($date)) {
			$date = date('Y-m-d');
			}
			$content = "";
			$entete = array('totaLclient' => 0, 'reponse' => 0, 'ca' => 0, 'NBProduit' => 0, 'totalpublication' => 0);
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
				$nb = $this->calendrier_model->cont_resultArrays($date, 'previ', $datas->operatrice);
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
				$content .= "<tr><td class='collapse'>" . $datas->operatrice . "</td><td>" . substr($datas->operatrice, 0, 7) . "</td><td><a href='" . base_url("controlleur/detail_discussion_operatrice/" . $datas->operatrice . "/" . $date) . "' class='link1 timeline'>" . strtoupper($user->Prenom) . "</a></td><td><a href='" . $link_page . "' target='_blank'>" . strtoupper($page_name) . "</a></td><td class='text-center'><a href='" . base_url("controlleur/detail_publication/" . $datas->operatrice . "/" . $date) . "' class='link1 timeline'>" . count($publica) . "</a></td><td class='text-center'><a href='" . base_url("controlleur/liste_clients/" . $datas->operatrice . "/" . $date) . "' class='link1 timeline'>" . count($data) . "</a></td><td class='text-center'>" . count($sender) . "</td><td class='text-center'>" . number_format($ca, 2, ',', ' ') . "</td><td class='text-center'><a href='#' class='link produit'>" . $produit . "</a></td><td class='text-center'><a href='" . base_url("controlleur/detail_vente_commerciale/" . $datas->operatrice . "/" . $date) . "'>" . $nb . "</a></td><td class='text-center'><a href='" . base_url("controlleur/listedemande/" . $datas->operatrice . "/" . $date) . "'>" . $this->global_model->nombre_demande($datas->operatrice, $date = date('Y-m-d')) . "</a></td></tr>";
				$entete['totaLclient'] += count($data);
				$entete['reponse'] += count($sender);
				$entete['ca'] += $ca;
				$entete['NBProduit'] += $produit;
				$entete['totalpublication'] += count($publica);
			}
			$data = ['entete' => $entete, 'data' => $content, 'date' => $date];
		}else if($this->session->userdata('designation') == "Service_comptabilite"){
			if ($this->global_model->pourcentage_transaction() != 0) {
				$livre = ($this->global_model->pourcentage_transaction('livre') * 100) / $this->global_model->pourcentage_transaction();
				$annule = ($this->global_model->pourcentage_transaction('annule') * 100) / $this->global_model->pourcentage_transaction();
				$confirmer = ($this->global_model->pourcentage_transaction('confirmer') * 100) / $this->global_model->pourcentage_transaction();
			} else {
				$livre = 0;
				$annule = 0;
				$confirmer = 0;
			}
			$data = [
				'client' => $this->global_model->nombre_client(),
				'produit' => $this->global_model->nombre_produit(),
				'transaction' => $this->global_model->nombre_transaction(),
				'livre' => $livre,
				'annule' => $annule,
				'confirmer' => $confirmer
			];
		} else if ($this->session->userdata('designation') == "Service_clientel") {
			if ($this->global_model->pourcentage_transaction_livre() != 0) {
				$livre = ($this->global_model->pourcentage_transaction_livre('livre') * 100) / $this->global_model->pourcentage_transaction_livre();
				$annule = ($this->global_model->pourcentage_transaction_livre('annule') * 100) / $this->global_model->pourcentage_transaction_livre();
				$confirmer = ($this->global_model->pourcentage_transaction_livre('confirmer') * 100) / $this->global_model->pourcentage_transaction_livre();
			} else {
				$livre = 0;
				$annule = 0;
				$confirmer = 0;
			}
			$data = [
				'client' => $this->global_model->nombre_client(),
				'produit' => $this->global_model->nombre_produit(),
				'transaction' => $this->global_model->pourcentage_transaction_livre(),
				'livre' => $livre,
				'annule' => $annule,
				'confirmer' => $confirmer
			];
		}else if($this->session->userdata('designation') =="Administrateur"){
			if ($this->global_model->pourcentage_transaction() != 0) {
				$livre = ($this->global_model->pourcentage_transaction('livre') * 100) / $this->global_model->pourcentage_transaction();
				$annule = ($this->global_model->pourcentage_transaction('annule') * 100) / $this->global_model->pourcentage_transaction();
				$confirmer = ($this->global_model->pourcentage_transaction('confirmer') * 100) / $this->global_model->pourcentage_transaction();
			} else {
				$livre = 0;
				$annule = 0;
				$confirmer = 0;
			}
			$data = [
				'client' => $this->global_model->nombre_client(),
				'produit' => $this->global_model->nombre_produit(),
				'transaction' => $this->global_model->nombre_transaction(),
				'livre' => $livre,
				'annule' => $annule,
				'confirmer' => $confirmer
			];
			
		} else if ($this->session->userdata('designation') == "Tsena_koty") {
			if ($this->global_model->pourcentage_transaction_livre() != 0) {
				$livre = ($this->global_model->pourcentage_transaction_livre('livre') * 100) / $this->global_model->pourcentage_transaction_livre();
				$annule = ($this->global_model->pourcentage_transaction_livre('annule') * 100) / $this->global_model->pourcentage_transaction_livre();
				$confirmer = ($this->global_model->pourcentage_transaction_livre('confirmer') * 100) / $this->global_model->pourcentage_transaction_livre();
			} else {
				$livre = 0;
				$annule = 0;
				$confirmer = 0;
			}
			$data = [
				'client' => $this->global_model->nombre_client(),
				'produit' => $this->global_model->nombre_produit(),
				'transaction' => $this->global_model->pourcentage_transaction_livre(),
				'livre' => $livre,
				'annule' => $annule,
				'confirmer' => $confirmer
			];

		} else if ($this->session->userdata('designation') == "Service_clientel") {
			if ($this->global_model->pourcentage_transaction_livre() != 0) {
				$livre = ($this->global_model->pourcentage_transaction_livre('livre') * 100) / $this->global_model->pourcentage_transaction_livre();
				$annule = ($this->global_model->pourcentage_transaction_livre('annule') * 100) / $this->global_model->pourcentage_transaction_livre();
				$confirmer = ($this->global_model->pourcentage_transaction_livre('confirmer') * 100) / $this->global_model->pourcentage_transaction_livre();
			} else {
				$livre = 0;
				$annule = 0;
				$confirmer = 0;
			}
			$data = [
				'client' => $this->global_model->nombre_client(),
				'produit' => $this->global_model->nombre_produit(),
				'transaction' => $this->global_model->pourcentage_transaction_livre(),
				'livre' => $livre,
				'annule' => $annule,
				'confirmer' => $confirmer
			];
		} else if ($this->session->userdata('designation') == "Appel_telephonique") {
			if ($this->global_model->pourcentage_transaction_livre() != 0) {
				$livre = ($this->global_model->pourcentage_transaction_livre('livre') * 100) / $this->global_model->pourcentage_transaction_livre();
				$annule = ($this->global_model->pourcentage_transaction_livre('annule') * 100) / $this->global_model->pourcentage_transaction_livre();
				$confirmer = ($this->global_model->pourcentage_transaction_livre('confirmer') * 100) / $this->global_model->pourcentage_transaction_livre();
			} else {
				$livre = 0;
				$annule = 0;
				$confirmer = 0;
			}
			$data = [
				'client' => $this->global_model->nombre_client(),
				'produit' => $this->global_model->nombre_produit(),
				'transaction' => $this->global_model->pourcentage_transaction_livre(),
				'livre' => $livre,
				'annule' => $annule,
				'confirmer' => $confirmer
			];
		}
		$this->render_view('global/' . $this->session->userdata("designation") . '/accueil', $data);
	}
	public function completeTache(){
		$this->load->model('global_model');
		$donne=$this->global_model->complete_sous_tache($this->input->post('code'));
		$html="<option hidden></option>";
		foreach($donne as $donne){
		  $html.='<option value="'.$donne->code.'">'.$donne->nom_sous_tache.'</option>';
		}
		echo $html;
	  }

	  public function Viewdiscussion(){
		$this->load->model('global_model');
		$codeclient =  $this->input->post('codeclient');
		$gain = $this->global_model->gettotalsmileskotyGlobale($codeclient);
		  foreach ($gain as $key) {
			$koty = $key->koty;
			$smiles = $key->smiles;
		  }
		$data = [
		  'produit_user' => $this->global_model->produit_user(),
		  'en_cours' => $this->global_model->discussion_en_cours(),
		  'famille' => $this->global_model->famille(),
		  'page' => $this->global_model->userpage(),
		  'mission' => $this->global_model->mission(),
		  'produit' => $this->global_model->produitpromokoty($this->session->userdata('matricule')),      
			  'kotydispo'=>$this->global_model->kotydispo($codeclient),
		  'data_type'=>$this->global_model->produit_users(),
		  'smiles' =>$smiles
		];
			$this->load->view('operatrice/discussion/discussion', $data);
		}
	
		public function pageUser(){
		   $this->load->model('global_model');
		   $id= $this->input->post('id');
		   $reponse = $this->global_model->page_fb(["comptefb.id"=>$id]);
		   if($reponse){
			$this->session->set_userdata("page", $reponse->page);
			$this->session->set_userdata("pageName", $reponse->nomPage);
			return true;
		   }


		}
}
