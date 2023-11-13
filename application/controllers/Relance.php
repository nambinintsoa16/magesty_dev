<?php
defined('BASEPATH') or exit('No direct script access allowed');
class relance extends My_Controller
{
  public function Journaliere()
  {
    $data = [
      'data' => array()
    ];
    $this->render_view('operatrice/Relances/Journaliere', $data);
  }
  /* public function index(){
          $this->load->model('client_model');
        $data=$this->client_model->liste_client();
          foreach($data as $key=>$data){
            $Code_client=$this->idfactutreCRX();
            if($data->lien_facebook==NULL){
                $Origin='Terrain';
            }else{  
                $Origin='Facebook';
             
            }
             $this->client_model->insertCrX($data->Nom." ".$data->Prenom,$data->lien_facebook,$Code_client,$data->Matricule_personnel,$Origin);
          }
      }*/
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
    $this->load->model('relance_model');

    $data = [
      'relance' => $this->relance_model->relance_du_jour($this->session->userdata('matricule'))
    ];
    $this->render_view('operatrice/Relances/Journaliere', $data);
  }

  public function Relances_Mensuelle()
  {
    $this->load->model('relance_model');

    $data = [
      'relance' => $this->relance_model->relance_du_jour($this->session->userdata('matricule'))
    ];
    $this->render_view('operatrice/Relances/Journaliere', $data);
  }



  public function idfactutreCRX()
  {
    $this->load->model('client_model');
    $id = $this->client_model->IdCRX();
    $p = 7;
    if ($id) {
      $count = "";
      $idtable = strlen($id->Id);
      for ($i = 0; $i < $p - $idtable; $i++) {
        $count .= "0";
      }
      $facture = 'CRX-' . $count . $id->Id . "-" . date('d-m-Y');
    } else {
      $count = "";
      for ($i = 0; $i < $p; $i++) {
        $count .= "0";
      }
      $facture = 'CRX-' . $count . "-" . date('d-m-Y');
    }
    return $facture;
  }

  public function dataRelanceFaite()
  {
    $this->load->model('relance_model');
    $data = array();
    $i = 0;
    $datas = $this->relance_model->relance_du_joureffectuer($this->session->userdata('matricule'));
    foreach ($datas as $row) {
      $client = $this->relance_model->detail_client_relance($row->Client);
      $facture = $this->relance_model->dernier_facture($row->Client);
      if ($facture) {
        $facture_date = $facture->Date;
        $facture_statut = $facture->Status;
      } else {
        $facture_date = "-";
        $facture_statut = "";
      }
      $sub_array = array();
      $sub_array[] = $i;
      $sub_array[] = $facture_date;
      $sub_array[] = $row->Client;
      $sub_array[] = '<a href="' . $client->lien_facebook . '"><i class="fa fa-facebook light-blue bigger-110" target="_blanc"></i> ' . $client->Compte_facebook . '</a>';
      $sub_array[] = $facture_statut;
      $sub_array[] = '</a><a href="#" class="btn btn-info"><i class="fa fa-info"></i></a>';
      $data[] = $sub_array;
      $i++;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function dataRelance()
  {
    $this->load->model('relance_model');

    $data = array();
    $i = 0;
    $datas = $this->relance_model->relance_du_jour($this->session->userdata('matricule'));

    foreach ($datas as $row) {
      $client = $this->relance_model->detail_client_relance($row->Client);
      $facture = $this->relance_model->dernier_facture($row->Client);
      if ($facture) {
        $facture_date = $facture->Date;
        $facture_statut = $facture->Status;
      } else {
        $facture_date = "-";
        $facture_statut = "";
      }
      $sub_array = array();
      $sub_array[] = $i;
      $sub_array[] = $facture_date;
      $sub_array[] = $row->Client;
      $sub_array[] = '<a href="' . $client->lien_facebook . '"><i class="fa fa-facebook light-blue bigger-110" target="_blanc"></i> ' . $client->Compte_facebook . '</a>';
      $sub_array[] = $facture_statut;
      $sub_array[] = '<a href="#" id="' . $row->Id . '" class="btn btn-success"><i class="fa fa-check"></i></a>
      <a href="#" class="btn btn-info"><i class="fa fa-info"></i></a>';
      $data[] = $sub_array;
      $i++;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function dataLastProduit()
  {
    $this->load->model('relance_model');
    $facture = $this->relance_model->dernier_facture($this->input->post('client'));
    $detail = $this->relance_model->detailvente($facture->Id);
    //var_dump($detail);
    $html = '<p> Facture N° : ' . $facture->Id_facture . '</p><table class="table table-stripted table-hover text-center">
  <thead class="text-center">
    <tr>
      <th>Désignation</th>
      <th>Prix</th>
      <th>Quantite</th>
      <th>Total</th>
    </tr>
  </thead><tbody>';
    foreach ($detail as $key => $detail) {
      $html .= "<tr><td>" . $detail->Code_produit . "</td>";
      $html .= "<td>" . $detail->Prix_detail . "</td>";
      $html .= "<td>" . $detail->Quantite . "</td>";
      $html .= "<td>" . $detail->Quantite * $detail->Prix_detail . "</td>";
      $html .= "</tr>";
    }

    $html .= '</tbody></table>';
    echo $html;
  }
  public function updateRelance()
  {
    $this->load->model('relance_model');
    $id = $this->input->post('id');
    $data = [
      'Statut' => 'off',
      'date_relance' => date('Y-m-d')
    ];
    echo $this->relance_model->updateRelance($id, $data);
  }

  public function liste_client()
  {
    $data = [
      'listeclient7' => $this->global_model->client_a_traiterAAC7($this->session->userdata('page'))
    ];
    $this->render_view('operatrice/Relances/liste_client', $data);
  }

  public function liste_clientaac014()
  {
    $data = [
      'listeclient' => $this->global_model->relance_produit($this->session->userdata('page'),14,'PROD014'),
    ];
    $this->render_view('operatrice/Relances/liste_clientaac014', $data);
  }
  public function liste_clientaac021()
  {
    $data = [
      'listeclient' => $this->global_model->relance_produit($this->session->userdata('page'),21,'PROD021')
    ];
    $this->render_view('operatrice/Relances/liste_clientaac021', $data);
  }
  public function liste_clientaac028()
  {
    $data = [
      'listeclient' => $this->global_model->client_a_traiterAAC28($this->session->userdata('page'))
    ];
    $this->render_view('operatrice/Relances/liste_clientaac028', $data);
  }
  public function liste_clientaac035()
  {
    $data = [
      'listeclient' => $this->global_model->relance_produit($this->session->userdata('page'),21,'PROD021')
    ];
    $this->render_view('operatrice/Relances/liste_clientaac035', $data);
  }

   public function liste_clientaac042()
  {
    $data = [
      'listeclient' => $this->global_model->relance_produit($this->session->userdata('page'),42,'PROD042'),
    ];
    $this->render_view('operatrice/Relances/liste_clientaac042', $data);
  }

  public function client_a_traiterAAC49()
  {
    $data = [
      'listeclient' => $this->global_model->client_a_traiterAAC49($this->session->userdata('page')),

    ];
    $this->render_view('operatrice/Relances/liste_clientaac049', $data);
  }

   public function liste_clientaac056()
  {
    $data = [
      'listeclient' => $this->global_model->relance_produit($this->session->userdata('page'),56,'PROD056'),

    ];
    $this->render_view('operatrice/Relances/liste_clientaac056', $data);
  }

  public function client_a_traiterAAC70()
  {
    $data = [
      'listeclient' => $this->global_model->client_a_traiterAAC70($this->session->userdata('page'))
    ];
    $this->render_view('operatrice/Relances/liste_clientaac070', $data);
  }

  public function CLT007()
  {
    $data = [
      'listeclient' => $this->global_model->clientctl007($this->session->userdata('page'))
    ];
    $this->render_view('operatrice/Relances/CLT007', $data);
  }

  public function vente_non_livrees()
  {
    $data = [
      'listeclient' => $this->global_model->vente_non_livre($this->session->userdata('page'))
    ];

    $this->render_view('operatrice/Relances/vente_non_livrees', $data);
  }


  public function rendez_vous()
  {
    $data =[
      'clientrdv' =>  $this->global_model->rendez_vous($this->session->userdata('matricule'), date('Y-m-d'))
    ];

    $this->render_view('operatrice/Relances/rendez_vous', $data);
  }

   public function jaime()
  {
    /*$data =[
      'clientjaime' => $this->global_model->reactionjaime(date('Y-m-d'),$this->session->userdata('page'))
    ];*/
    $i=1;
    $y=1;
    $date=date('Y-m-d');
    $TestContJM = array();
    $contentsS="";
    $jaimess="";

      $clientjm = $this->global_model->PROP_CLT_jm($date,$this->session->userdata('matricule'));
        foreach($clientjm as $clientjm)
        {
             $TestContJM[$y]= $clientjm->lien_facebook; 
            $contentsS .= "<tr><td>".$y."</td><td>".$clientjm->heure."</td><td  class='text-center'>".$clientjm->Code_client."</td><td><a href='" .$clientjm->lien_facebook. "' target='_blank'>" . $clientjm->Compte_facebook . "</a></td></tr>"; 
            $y++;
        }


        $clientjaime = $this->global_model->reactionjaime(date('Y-m-d'),$this->session->userdata('page'));
        foreach($clientjaime as $clientjaime)
        {
          if(in_array($clientjaime->lien_facebook,$TestContJM)){
            $statut = "<i class='fa fa-check-circle text-success'></i>"; 
          }else{
            $statut = "<i class='fa fa-times-circle text-danger'></i>";
          }
          $jaimess .= "<tr><td>".$i."</td><td>".$clientjaime->date_publi."</td><td><a href='" .$clientjaime->lien_facebook. "' target='_blank'>" . $clientjaime->Compte_facebook . "</a></td><td>".$clientjaime->lien_facebook."</td><td>".$clientjaime->Nom_page."</td><td class='text-center'>".$statut."</td></tr>"; 
          $i++;
         
        }
        $data=[
          'jaimess'=>$jaimess
          ] ;

    $this->render_view('operatrice/Relances/jaime', $data);
  }

  public function badgeRelance()
  {
    $param  = $this->input->post('param');
    $this->load->model('relance_model');

    $data  = false;
    switch ($param) {
      /*case 'Liste AAC007':
        $reponse = $this->relance_model->client_a_traiter($this->session->userdata('page'), 7); 
        $data =  count( $reponse) -  $this->relance_model->relanceFait($this->session->userdata('matricule'),"PROP_CLT_AAC07");
        break;
      case 'Liste AAC028':
        $reponse = $this->relance_model->client_a_traiter($this->session->userdata('page'), 28); 
        $data =  count( $reponse) -  $this->relance_model->relanceFait($this->session->userdata('matricule'),"REAP_CLT_AAC28");
        break;
      case 'Liste AAC049':
        $reponse = $this->relance_model->client_a_traiter($this->session->userdata('page'), 49); 
        $data =  count( $reponse) -  $this->relance_model->relanceFait($this->session->userdata('matricule'),"REAP_CLT_AAC49");
        break;
      case 'Liste AAC070':
        $reponse = $this->relance_model->client_a_traiter($this->session->userdata('page'), 70); 
        $data =  count( $reponse) -  $this->relance_model->relanceFait($this->session->userdata('matricule'),"REAP_CLT_AAC70");
        break;
      case 'Liste CLT007':
        $this->load->model('global_model');
        $reponse = $this->relance_model->clientctl007($this->session->userdata('page'), 7); 
        $moins = $this->global_model->testchecks(date('Y-m-d'),$this->session->userdata('matricule'));
        if ($moins)
        $data =  count( $reponse) -  $moins;
        break;
      case 'TRC014':
        $data =  count($this->global_model->TRC014($this->session->userdata('page'),date('Y-m-d'))) + count($this->global_model->addtrc014($this->session->userdata('matricule')));
        break;
      case 'Ventes non livrées':
      $this->load->model('global_model');
        $data =  count($this->global_model->vente_non_livre($this->session->userdata('page'))) - $this->global_model->VENTENONLIVREE($this->session->userdata('matricule'));
        break;
      case 'Pospection client':
      $this->load->model('global_model');
        $data =  count($this->global_model->reactionjaime(date('Y-m-d'),$this->session->userdata('matricule')));
        break;*/
      default:
      break;
    }

    $resultat = 0;
    if ($data) {
      $resultat =$data;
    }
    echo $resultat;
  }

  public function rapport()
  {
    $this->render_view('operatrice/Relances/rapport');
  }

  public function rapport_relance()
  {
    $this->render_view('operatrice/Relances/rapport_relance');
  }
  

  public function Discussion_relance()
  {
    $this->render_view('operatrice/Relances/Discussion_relance');
  }
  public function checkRelanceDiscussion(){
   
		$this->load->model('discussion_model');
		$refnum = $this->input->post('refnum');
		echo $this->discussion_model->UpdateRelanceDiscussion(['IdRD'=>$refnum],['statuRelanceRD'=>'off']);
	}
  public function ListeRElasnceDiscussion()
  {
    $this->load->model('discussion_model');
    $this->load->model('client_model');

    $type = $this->input->get('type');
    $data = array();
    $date = date('Y-m-d');
     
    if($type=="duJour"){
      $datas = $this->discussion_model->selectsRelanceDiscussion(["OperatriceRD"=>$this->session->userdata('matricule'),"DateRD"=>$date,"statuRelanceRD"=>'on','Type'=>"Relance sans achat","PageRD"=>$this->session->userdata("page")]);
    }else{
    
      $datas = $this->discussion_model->selectsRelanceDiscussion("(`OperatriceRD` = '".$this->session->userdata('matricule')."' AND   `Type`='Relance sans achat' ) AND  (`DateRD` < '$date' AND `PageRD`=".$this->session->userdata('page').") AND statuRelanceRD ='on'");

    }
    foreach ($datas as $row) {
      $client = $this->client_model->infoclientPo($row->CodeClient);
			$methodOk = $client != null ;
      if($methodOk){
      $page = $this->discussion_model->selectPageFb($this->session->userdata("page"));
      $sub_array = array();
      //$sub_array[] = $row->DateRD;
      $sub_array[] =$row->CodeClient;
      $sub_array[] ="<a href='".$client->lien_facebook."' target='_blank'>".$client->Nom ." ".$client->Prenom."</a>";
      $sub_array[] =$page->Nom_page;
      $sub_array[] ="<a href='#' class='toto'>".$row->StatutRD."</a>";
      $sub_array[] =$row->DateRD;
    
      if($row->statuRelanceRD=="on"){
        $sub_array[] = '<i class="fa fa-times-circle text-danger"></i>';
        $sub_array[] = '<a href="'.$row->PageRD.'" id="'.$row->IdRD.'" class="btn btn-info btn-sm valopy"><i class="fa fa-envelope"></i></a>';
				$sub_array[] = '<a href="'.$row->PageRD.'" id="'.$row->IdRD.'" class="btn btn-success btn-sm check"><i class="fa fa-check"></i></a>';
			
			}else{
        $sub_array[] = '<i class="fa fa-times-circle text-success"></i>';
        $sub_array[] = '<a href="#" class="btn btn-warning btn-sm "><i class="fa fa-envelope-open"></i></a>';
				$sub_array[] = '';
			}
    }  

			if($methodOk) {
				$data[] = $sub_array;
			}
    
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }


  public function ListeRElasnceenquette()
  {
    $this->load->model('discussion_model');
    $this->load->model('client_model');
    $user = $this->session->userdata('matricule');
    $type = $this->input->get('type');
    $idpage = $this->session->userdata("page");
    $data = array();
    $date = date('Y-m-d');
     
    if($type=="duJour"){
      $datas = $this->relance_model->get_fetch_relance_aa7("matricule_oplg like '$user' AND create_date like '$date%' AND statut= '' AND id_page = '$idpage'");
    }else{
    
      $datas = $this->relance_model->get_fetch_relance_aa7("(`matricule_oplg` = '".$this->session->userdata('matricule')."') AND  (`create_date` < '$date' AND `id_page`=".$this->session->userdata('page').") AND statut =''");

    }
 
    foreach ($datas as $row) {
      $client = $this->client_model->infoclientPo($row->code_client);
			$methodOk = $client != null ;
      if($methodOk){
      $page = $this->discussion_model->selectPageFb($this->session->userdata("page"));
      $sub_array = array();
      //$sub_array[] = $row->DateRD;
      $sub_array[] =$row->code_client;
      $sub_array[] ="<a href='".$client->lien_facebook."' target='_blank'>".$client->Nom ." ".$client->Prenom."</a>";
      $sub_array[] =$page->Nom_page;
      $sub_array[] ="<a href='#' class='toto'>".$row->statut."</a>";
      $sub_array[] =$row->create_date;
    
      if($row->statut==""){
        $sub_array[] = '<i class="fa fa-times-circle text-danger"></i>';
        $sub_array[] = '<a href="'.$row->id_page.'" id="'.$row->id.'" class="btn btn-info btn-sm valopy"><i class="fa fa-envelope"></i></a>';
				$sub_array[] = '<a href="'.$row->id_page.'" id="'.$row->id.'" class="btn btn-success btn-sm check"><i class="fa fa-check"></i></a>';
			
			}else{
        $sub_array[] = '<i class="fa fa-times-circle text-success"></i>';
        $sub_array[] = '<a href="#" class="btn btn-warning btn-sm "><i class="fa fa-envelope-open"></i></a>';
				$sub_array[] = '';
			}
    }  

			if($methodOk) {
				$data[] = $sub_array;
			}
    
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  

   public function relance_produit()
  {

    $data=[
      'PRO07'=>$this->global_model->relance_produit($this->session->userdata('page'),7,'PROD007'),
      'PRO14'=>$this->global_model->relance_produit($this->session->userdata('page'),14,'PROD014'),
      'PRO21'=>$this->global_model->relance_produit($this->session->userdata('page'),21,'PROD021'),
      'PRO28'=>$this->global_model->relance_produit($this->session->userdata('page'),28,'PROD028'),
      'PRO35'=>$this->global_model->relance_produit($this->session->userdata('page'),35,'PROD035'),
      'PRO42'=>$this->global_model->relance_produit($this->session->userdata('page'),42,'PROD042'),
      'PRO49'=>$this->global_model->relance_produit($this->session->userdata('page'),49,'PROD049'),
      'PRO56'=>$this->global_model->relance_produit($this->session->userdata('page'),56,'PROD056'),
      'PRO63'=>$this->global_model->relance_produit($this->session->userdata('page'),63,'PROD063'),
      'PRO84'=>$this->global_model->relance_produit($this->session->userdata('page'),84,'PROD084'),
      'PRO210'=>$this->global_model->relance_produit($this->session->userdata('page'),210,'PROD210')
    ];

    $this->render_view('operatrice/Relances/relance_produit',$data);
  }

  public function produit_relance()
  {
    $this->render_view('operatrice/Relances/produit_relance');
  }
    public function Prod007(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),7,'PROD007');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function Prod014(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),14,'PROD014');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

   public function Prod021(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),21,'PROD021');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

   public function Prod028(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),28,'PROD028');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function Prod035(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),35,'PROD035');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function Prod042(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),42,'PROD042');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function Prod049(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),49,'PROD049');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function Prod056(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),56,'PROD059');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }


public function Prod063(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),63,'PROD063');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function Prod084(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),84,'PROD084');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function Prod210(){
    $datas = $this->global_model->relance_produit($this->session->userdata('page'),210,'PROD210');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      $sub_array[] = $row->Code_produit;
      $sub_array[] = $row->relance;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
      $sub_array[]="";   
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function Relance_non_traitee()
  {
    $this->render_view('operatrice/Relances/nonTraite');
  }

  public function aac7nonfait(){
    $this->load->model('relance_model');
    $datas = $this->relance_model->relanceNonTraitee($this->session->userdata('page'),9,7,'PROP_CLT_AAC07');
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->lien_facebook;  
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
       
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
  echo json_encode($output);
  }

  public function aac28nonfait(){
    $this->load->model('relance_model');
    $datas = $this->relance_model->relanceNonTraitee($this->session->userdata('page'),30,28, 'REAP_CLT_AAC28' );
    $data = array();
    foreach($datas as $row) {
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->Code_client."</a>";
      $sub_array[] = "<a href='".$row->lien_facebook."' target='_blank'>".$row->Compte_facebook."</a>";
      $sub_array[] = $row->lien_facebook;  
      $sub_array[] = $row->Nom_page;
      $sub_array[] = $row->date_de_livraison;
      /*$sub_array[] = $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$row->Code_client,'RLNC_PROD'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>';};   */
       
      $data[] = $sub_array;
    }
    $output = array("data" =>$data);
    echo json_encode($output);
  }
  public function relanceProduit(){
    $this->load->model('relance_model');
    $this->load->model('global_model');
    $datas = $this->relance_model->relanceAvecAchat(
      [
        "OperatriceRD"=>$this->session->userdata('matricule'),
        "PageRD"=>$this->session->userdata('page'),
        "Type"=>"Relance avec achat",
        "DateRD"=>date('Y-m-d')
      ]);
    /*  "OperatriceRD"=>$this->session->userdata('page'),
      "PageRD"=>$this->session->userdata('matricule'),
      "statuRelanceRD"=>"on"*/
    $data = array();
    foreach($datas as $row) {
      $client = $this->global_model->getClientInfo($row->CodeClient);
      $page = $this->global_model->retour_page($row->PageRD);
      $sub_array = array();
      $sub_array[] = "<a href='#' class='client'>".$row->CodeClient."</a>";
      $sub_array[] = $client->Nom;
      $sub_array[] = "<a href='".$page->Lien_page."' class='client'>".$page->Nom_page."</a>";
      $sub_array[] = $row->dateDeCreatiion;
      $sub_array[] = "<a class='client' href='".base_url('images/produit/'.$row->produit.'.jpg')."' data-lightbox='roadtrip'>$row->produit</a>";
      $sub_array[] = $row->Intervale;
      if($row->statuRelanceRD=="on"){
        $sub_array[] = '<i class="fa fa-times-circle text-danger"></i>';
        $sub_array[] = '<a href="'.$row->PageRD.'" id="'.$row->IdRD.'" class="btn btn-info btn-sm valopy"><i class="fa fa-envelope"></i></a>';
      }else{
        $sub_array[] = '<i class="fa fa-check-circle text-success"></i>';
        $sub_array[] = '<a href="#" class="btn btn-warning btn-sm "><i class="fa fa-envelope-open"></i></a>';
      }
          
      $data[] = $sub_array;
    }

    $output = array("data" =>$data);
    echo json_encode($output);

  }
  public function Enquete(){
    $this->render_view('operatrice/Relances/Enquete');
  }
  public function checkRelanceRequette(){
    
  }
}


