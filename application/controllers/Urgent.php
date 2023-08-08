<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Urgent extends My_Controller {
   public function __construct(){
       parent:: __construct();
    $this->load->model('urgent_model');

   }

    public function page(){
        $page = $this->input->post('page');
        switch ($page) {
            case 'NOUVELLE REQUETTE':
                $this->load->view('operatrice/Urgent/formulaire');
                break;
            case 'EN-COURS':
               $data = ['data'=> $this->urgent_model->liste(['Operatrice'=>$this->session->userdata('matricule'),'Statut'=>'EN_COURS'])];
                $this->load->view('operatrice/Urgent/tableaux',$data);
                break;
            case 'TERMINER':
                $data = ['data'=> $this->urgent_model->liste(['Operatrice'=>$this->session->userdata('matricule'),'Statut'=>'TERMINER'])];
                $this->load->view('operatrice/Urgent/tableaux',$data);
                break;
            
            default:
                # code...
                break;
        }
	
    }
public function recherceClient()
  {
    $lienFb = $this->input->post('lien');
    echo json_encode($this->urgent_model->recherceClient(array('lien_facebook'=> $lienFb)));

  }
public function save(){
    $objet= $this->input->post('objet');
    $codeUrgence= $this->input->post('codeUrgence');
    $codeClient= $this->input->post('codeClient');
    $page= $this->input->post('page');
    $user = $this->session->userdata('matricule');

    $requette = [
        "Date"=>date('Y-m-d'), 
        "Heure"=>date('H:i:s'),
        "Operatrice"=> $user,
        "Objet"=> $objet,  
        "Page"=>$page, 
        "CodeUrgent"=> $codeUrgence,
        "codeClient"=> $codeClient

    ];
  

    $this->urgent_model->save( $requette);
}  

public function  nombreUrgent(){
    $parametre = ['Statut'=>"EN_COURS"];
    echo json_encode(array('nombre'=>$this->urgent_model->nombreUrgent($parametre),'content'=>$this->listePreviewMessage()));
}

public function listePreviewMessage(){
 $parametre = ['Statut'=>"EN_COURS"];
 $data = $this->urgent_model->listUrgent($parametre);
 $html = "";
 foreach ($data as $key => $data) {
    $html .= "<a href='#'>
                <div class='notif-icon notif-primary'> <i class='fa fa-user-plus'></i> </div>
                <div class='notif-content'>
                    <span class='block'>
                    $data->CodeUrgent 
                    </span>
                    <span class='time'>$data->Date à $data->Heure </span> 
                </div>
            </a>";
}
     return $html;   
}



}
?>

