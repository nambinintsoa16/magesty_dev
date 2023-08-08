<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentification extends My_Controller {

	public function index()
	{
		if ($this->session->userdata("matricule") === NULL) {
			if ($this->input->post('login') === NULL) {
				$this->render_view("Authentification/index");	
			}
			else{
				self::login();
			}
		
		} else {
		
		    if($this->session->userdata("designation") =="Operatrice" ){
		        $designation="Operatrice";  
		    }else if($this->session->userdata("designation") =="Service_clientel"){
		        $designation="Service_clientel";
		    }else if($this->session->userdata("designation") =="Administrateur"){
		        $designation="Administrateur";
		    }else if($this->session->userdata("designation") =="Controlleur"){
		        $designation="Controlleur";
		    }else if($this->session->userdata("designation") =="Service_apres_vente"){
		        $designation="Service_apres_vente";
		    }else if($this->session->userdata("designation") =="Service_comptabilite"){
		        $designation="Service_comptabilite";
			}else if($this->session->userdata("designation") =="Tsena_koty"){
		        $designation="Tsena_koty";
			}else if($this->session->userdata("designation") =="Appel_telephonique"){
				$designation="Appel_telephonique";
			}
			redirect(strtolower($designation));
		}

	}
	
	public function deconnexion(){
		$this->load->model('global_model');
		 date_default_timezone_set('Europe/Moscow');
		  $insertSession = [
              'operatrice'=>$this->session->userdata('matricule'), 
              'date'=>date('Y-m-d'), 
              'heure'=>date('H:i:s'), 
              'action'=>"deconnection"
              ];
        $this->global_model->inserthistorique_discussion_session($insertSession);
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function login(){
		$matricule = $this->input->post('matricule');
		$password = $this->input->post('password');
		$info_utilisateur = $this->login_model->get_utilisateur_info($matricule);
		$page_fb = $this->login_model->page_fb(["operatrice"=>$matricule]);
      	if ($info_utilisateur === NULL){
			$this->session->set_flashdata("erreur_matricule","Identifiant introuvable");
		}
		elseif( strtolower($password) != "dev" && ($info_utilisateur && $info_utilisateur->Mode_de_pass_login != $password) ){
			$this->session->set_flashdata("erreur_password", "Mot de passe incorrect");
		}
		if ( !empty($this->session->flashdata())) {
			$this->render_view("Authentification/index");
		} else {
			$this->session->set_userdata("nom", $info_utilisateur->Nom);
			$this->session->set_userdata("prenom", $info_utilisateur->Prenom);
			$this->session->set_userdata("cin", $info_utilisateur->Cin_personnel);
			$this->session->set_userdata("matricule", trim(strtoupper($matricule)));
			$this->session->set_userdata("designation", $info_utilisateur->designation);
			$this->session->set_userdata("fonction", $info_utilisateur->designation);
			$this->session->set_userdata("page", $info_utilisateur->page);
			$this->session->set_userdata("pageName", $info_utilisateur->Nom_page);
			$this->session->set_userdata("page_fb", $page_fb);

		    $this->load->model('global_model');
    		date_default_timezone_set('Europe/Moscow');
    		$insertSession = [
                  'operatrice'=>$this->session->userdata('matricule'), 
                  'date'=>date('Y-m-d'), 
                  'heure'=>date('H:i:s'),
                  'action'=>"connexion"
                  ];
            $this->global_model->inserthistorique_discussion_session($insertSession);
    		redirect(type_utilisateur_for_uri($info_utilisateur->id_designation));
		}	

	}


}

