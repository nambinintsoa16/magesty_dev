  <?php
  defined('BASEPATH') or exit('No direct script access allowed');
  include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
  class Appel_telephonique extends My_Controller
  {

    public function Appel()
    {
      $this->render_view('Appel_telephonique/Appel/index');
    }
    public function autocomplete()
    {
      $this->load->model('client_model');
      $term = $this->input->get('term');
      $array = array();
      foreach ($this->client_model->autocomplete_client($term) as $reponse) {
        array_push($array, $reponse->Code_client . " | " . $reponse->Compte_facebook);
      }
      echo json_encode($array);
    }
    public function Result_appel()
    {
      $this->load->model('Appel_telephonique_model');
      $datas =  $this->Appel_telephonique_model->SelectApple();
      $data = array();
      foreach ($datas as $row) {
        $sub_array = array();
        $sub_array[] = $row->Code_client;
        $sub_array[] = $row->Compte_facebook;
        $sub_array[] = $row->lien_facebook;
        $sub_array[] = $row->Contact;
        $sub_array[] = $row->Etat;
        $sub_array[] = "<a class='btn btn-success btn-sm text-white tableAppel'><i class='flaticon-whatsapp'></i> Appell</a>";

        $data[] = $sub_array;
      }
      $output = array("data" => $data);
      echo json_encode($output);
    }
    public function detailClient()
    {
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

    public function premier_contact()
    {
      $this->render_view('Appel_telephonique/Discussion/premier_contact');
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
        'promotion'=> $this->produit_model->promotion(),
        'data_type'=>$this->global_model->produit_users()
      ];
      $this->load->view('Appel_telephonique/discussion/discussion', $data);
    }

    public function Entrant(){
      $this->render_view('Appel_telephonique/Appel/Entrant');
    }
    public function Sortant(){
      $this->render_view('Appel_telephonique/Appel/Sortant');
    }
    public function Rapport(){
      $this->render_view('Appel_telephonique/Appel/Rapport');
    }
    public function performance(){
      
    $this->load->model('user_model');
    $datas =  $this->user_model->performance($this->session->userdata('matricule'));
    $client = $this->user_model->nouveauclient(date('Y-m-d'),$this->session->userdata('matricule'));
   /* var_dump($client);
    die();*/
    $data = [
      'data' =>$datas,
      'client'=>$client
    ];
    $this->render_view('operatrice/user/performance', $data);
    }
  }
