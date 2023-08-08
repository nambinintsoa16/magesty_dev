<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etat_mensuel extends My_Controller {
     public function __construct() {
          parent:: __construct();
     
          $this->load->helper('url');
          $this->load->library("pagination");
      }
	public function index(){
     }
     public function Commandes(){
          $this->load->model('global_model');
          $data=[
              'famille'=>$this->global_model->famille(),
              'mission'=>$this->global_model->mission()
          ];
          $this->render_view('operatrice/Commandes',$data);
      } 

     public function nouveaux_discution(){
          $this->render_view('operatrice/discution/nouveaux_discution');
     } 

     public function importer_client_potentiel(){
          $this->render_view('operatrice/client/importer_client_potentiel');
          
     }
 

     public function Calendrier(){
      $this->render_view('Controlleur/calendrier/Calendrier');
     }
     public function detail_calendrier($date=FALSE){
      $this->load->model('calendrier_model');   
      if($date==FALSE){
        $date=date('Y-m-d');
      }
      $previ=0;
      $livre=0;
      $en_attente=0;
      $annule=0;
      $confirmer=0;
      $dataUser=array();
      if($this->calendrier_model->ca_de_vente_controlleur($date)){
          foreach ($this->calendrier_model->ca_de_vente_controlleur($date) as $key => $value) {
            $previ+=($value->Quantite*$value->Prix_detail);
            if(!array_key_exists($value->Matricule_personnel,$dataUser)){
              $dataUser[$value->Matricule_personnel]['previ']=$value->Quantite*$value->Prix_detail;
            }else{
              $dataUser[$value->Matricule_personnel]['previ']+=$value->Quantite*$value->Prix_detail;
            }
          }
  
      }
  
      if($this->calendrier_model->ca_de_vente_controlleur($date,'livre')){
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date,'livre') as $key => $value) {
          $livre+=($value->Quantite*$value->Prix_detail);
          if(!isset($dataUser[$value->Matricule_personnel]['livre'])){
            $dataUser[$value->Matricule_personnel]['livre']=$value->Quantite*$value->Prix_detail;
          }else{
            $dataUser[$value->Matricule_personnel]['livre']+=$value->Quantite*$value->Prix_detail;
          }
        }
  
    }
    
  
    if($this->calendrier_model->ca_de_vente_controlleur($date,'en_attente')){
      foreach ($this->calendrier_model->ca_de_vente_controlleur($date,'en_attente') as $key => $value) {
        $en_attente+=($value->Quantite*$value->Prix_detail);
        if(!isset($dataUser[$value->Matricule_personnel]['en_attente'])){
          $dataUser[$value->Matricule_personnel]['en_attente']=$value->Quantite*$value->Prix_detail;
        }else{
          $dataUser[$value->Matricule_personnel]['en_attente']+=$value->Quantite*$value->Prix_detail;
        }
      }
  
  }
      
  if($this->calendrier_model->ca_de_vente_controlleur($date,'annule')){
    foreach ($this->calendrier_model->ca_de_vente_controlleur($date,'annule') as $key => $value) {
      $annule+=($value->Quantite*$value->Prix_detail);
      if(!isset($dataUser[$value->Matricule_personnel]['annule'])){
        $dataUser[$value->Matricule_personnel]['annule']=$value->Quantite*$value->Prix_detail;
      }else{
        $dataUser[$value->Matricule_personnel]['annule']+=$value->Quantite*$value->Prix_detail;
      }
    }
  
  }
  
  if($this->calendrier_model->ca_de_vente_controlleur($date,'confirmer')){
    foreach ($this->calendrier_model->ca_de_vente_controlleur($date,'confirmer') as $key => $value) {
      $confirmer+=($value->Quantite*$value->Prix_detail);
      if(!isset($dataUser[$value->Matricule_personnel]['confirmer'])){
        $dataUser[$value->Matricule_personnel]['confirmer']=$value->Quantite*$value->Prix_detail;
      }else{
        $dataUser[$value->Matricule_personnel]['confirmer']+=$value->Quantite*$value->Prix_detail;
      }
    }
  
  }
  $dt=new dateTime($date);
  $dte=$dt->format('Y-m-d');
       $data=[
            'previ'=> $previ,
            'livre'=>$livre,
            'en_attente'=>$en_attente,
            'annule'=>$annule,
            'confirmer'=>$confirmer,
            'date'=>$dte,
            'user'=>$dataUser
       ];  
       $this->render_view('Controlleur/calendrier/detail_de_vente',$data);
     
     }

public function detail_vente_coms(){
  
  $this->load->model('calendrier_model');
  $i=0; 
  $color=array('#6f42c1'=>'rep','#007bff'=>'Previ','orange'=>'en_attente',"#aa66cc"=>'confirmer','#d9534f'=>'annule','#5cb85c'=>'livre');
  $resultat=array();
  $client=$this->calendrier_model->liste_client_facture_controlleur($this->input->post('date'),$this->input->post('type'),$this->input->post('user'));

   
   
  foreach ($client as $key => $client) {
    $resultat[$i]['ca']=0;
    $resultat[$i]['code_client']=$client->Code_client;
    $resultat[$i]['infoclient']=$this->calendrier_model->detail_client($client->Code_client);
    $resultat[$i]['produit']='';
    $resultat[$i]['user']=$client->Matricule_personnel;
    $resultat[$i]['Quartier']=$client->Quartier;
    $resultat[$i]['Ville']=$client->Ville;
		$resultat[$i]['remarque']=$client->Remarque;
		if($client->date_de_livraison!=NULL OR $client->date_de_livraison!="" ){
			$resultat[$i]['date_de_livraison']=$client->date_de_livraison;
		}else{
			$resultat[$i]['date_de_livraison']=$client->data_de_livraison;
		}
		//$resultat[$i]['date_de_livraison']=$client->date_de_livraison;
    $resultat[$i]['link']='link_'.$i;
    $resultat[$i]['facture']=$client->Id;
        foreach($this->calendrier_model->ca_facture($client->Id) as $commande){
          $resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
          $resultat[$i]['produit'].=$commande->Designation.'<br/>';
        } 
    $i++;    
  }  


  $data=[
       'type'=>$this->input->post('type'),
       'date'=>$this->input->post('date'),
       'data'=>$resultat,
       'color'=>$this->color($this->input->post('type'))      
    ];
  $this->load->view('Controlleur/calendrier/dataTableCa',$data);
     } 

     public function detail_vente_com(){
      $this->load->model('calendrier_model');
      $i=0;
      $resultat=array();
      $client=$this->calendrier_model->liste_client_facture_controlleur($this->input->post('date'),$this->input->post('type'),$this->input->post('user'));
      
      foreach ($client as $key => $client) {
        $resultat[$i]['ca']=0;
        $resultat[$i]['code_client']=$client->Code_client;
        $resultat[$i]['infoclient']=$this->calendrier_model->detail_client($client->Code_client);
        $resultat[$i]['produit']='';
        $resultat[$i]['user']=$client->Matricule_personnel;
        $resultat[$i]['Quartier']=$client->Quartier;
				$resultat[$i]['Ville']=$client->Ville;
				if($client->date_de_livraison!=NULL OR $client->date_de_livraison!="" ){
					$resultat[$i]['date_de_livraison']=$client->date_de_livraison;
				}else{
					$resultat[$i]['date_de_livraison']=$client->data_de_livraison;
				}
				
        $resultat[$i]['remarque']=$client->Remarque;
        $resultat[$i]['link']='link_'.$i;
        $resultat[$i]['facture']=$client->Id;
            foreach($this->calendrier_model->ca_facture($client->Id) as $commande){
              $resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
              $resultat[$i]['produit'].=$commande->Designation.'<br/>';
            } 
        $i++;    
      }  
  
  
      $data=[
           'type'=>$this->input->post('type'),
           'date'=>$this->input->post('date'),
           'data'=>$resultat,
           'color'=>$this->color($this->input->post('type'))     
        ];
      $this->load->view('Controlleur/calendrier/liste_commande',$data);
      
     }
     public function calendrier_de_livraison($type){



     }

     public function table_rapport(){

     

     }

     public function liste_des_client(){
          $this->load->model('global_model');
          $this->load->model('client_model');
          $config = array();
          $config["base_url"] = base_url().strtolower($this->session->userdata('designation'))."/clients/Liste_des_clients/";
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
            $this->render_view('operatrice/client/liste_des_client',$data);
           

     }
     
     public function Liste_des_produit(){
          $this->load->model('global_model');
          $config = array();
          $config["base_url"] = base_url().strtolower($this->session->userdata('designation'))."/Produits/Liste_des_produits";
          $config["total_rows"] = $this->global_model->nombre_produit();
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
            $data['produit'] = $this->global_model->liste_des_produit($config["per_page"], $page);
            $this->render_view('operatrice/produit/liste_des_produit',$data);
  

     }
     public function detail_clients(){
      $this->load->model('global_model');
      $json=array('message'=>false);
      $data= $this->global_model->detail_client($this->input->post('codeclient'));
      if($data){
        $json['message']=true;
        $json['content']=$data->Nom." ".$data->Prenom;
      } 
      
      echo json_encode($json);

 }
     


     public function rapport(){
      $datet = $this->input->post('dateAutre');
    if($this->session->userdata('designation')=="Controlleur"){
		
      $content="";
      $datas=$this->global_model->table_resume(date('Y-m-d'));
      foreach ($datas as $key => $datas) {
        $data=array(); 
        $produit=0;
        $ca=0;
        $data=$this->global_model->table_rapport(date('Y-m-d'),$datas->operatrice);
        $facture=$this->global_model->ca_facture_opl($datas->operatrice,date('Y-m-d'));
        $user=$this->global_model->user($datas->operatrice);
        foreach($facture as $facture){
          $produit+=$facture->Quantite;
          $ca+=($facture->Quantite*$facture->Prix_detail);
        }
        $content.="<tr><td class='text-center'>".$datas->operatrice."</td><td class='text-center'><a href='#' class='lien' id='produit'>".$user->Nom."</a></td><td class='text-center'><a href='#' class='link2' id='produit'>".count($data)."</a></td><td></td><td class='text-center'>".number_format($ca, 2, ',', ' ')."</td><td class='text-center' ><a href='#' class='link' id='produit'>".$produit."</a></td></tr>";
       }
       $data=['data'=>$content];
 
	}

	//	$this->render_view('Controlleur/'.$this->session->userdata("designation").'/',$data);
    $this->render_view('Controlleur/rapport' ,$data);
       
   }
   
  

public function color($code){
$color=array('rep'=>'#6f42c1','Previ'=>'#007bff','en_attente'=>'orange','confirmer'=>"#aa66cc",'annule'=>'#d9534f','livre'=>'#5cb85c');
return $color[$code];
} 
public function detail_vente_commerciale($user,$date=FALSE){
$this->load->model('calendrier_model');
$i=0;
if($date==FALSE){
  $date=date('Y-m-d');
}
$resultat=array();
$client=$this->calendrier_model->liste_client_facture($date,'Previ',$user);

foreach ($client as $key => $client) {
  $resultat[$i]['ca']=0;
  $resultat[$i]['code_client']=$client->Code_client;
  $resultat[$i]['infoclient']=$this->calendrier_model->detail_client($client->Code_client);
  $resultat[$i]['produit']='';
  $resultat[$i]['user']=$client->Matricule_personnel;
  $resultat[$i]['Quartier']=$client->Quartier;
  $resultat[$i]['Ville']=$client->Ville;
  $resultat[$i]['remarque']=$client->Remarque;
  $resultat[$i]['link']='link_'.$i;
  $resultat[$i]['facture']=$client->Id;
  if($client->date_de_livraison!=NULL OR $client->date_de_livraison!="" ){
    $resultat[$i]['date_de_livraison']=$client->date_de_livraison;
  }else{
    $resultat[$i]['date_de_livraison']=$client->data_de_livraison;
  }
      foreach($this->calendrier_model->ca_facture($client->Id) as $commande){
        $resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
        $resultat[$i]['produit'].=$commande->Designation.'<br/>';
      } 
  $i++;    
}  


$data=[
     'type'=>'Previ',
     'date'=>date('Y-m-d'),
     'data'=>$resultat,
     'color'=>$this->color('Previ')     
  ];
  $this->render_view('Controlleur/calendrier/liste_commande',$data);


   }

public function delete_facture(){
  $this->load->model('global_model');  
  $this->global_model->delete_commande($this->input->post('id')); 
  $this->global_model->delete_detail($this->input->post('id'));
  $this->global_model->delete_facture($this->input->post('id')); 
  echo json_encode(array('message'=>true));
}

public function detail_discussion_operatrice($user,$date=FALSE){
  $this->load->model('global_model');  
  $i=0;
  if($date==FALSE){
    $date=date('Y-m-d');
  }
  $reponse=$this->global_model->repopll($date,$user);
  foreach($reponse as $reponse){
    $datas[$i]['heure']=$reponse->heure;
    $datas[$i]['Id_discussion']=$reponse->Id_discussion;
    $datas[$i]['Id_reponse']=$reponse->Id_reponse;
    $datas[$i]['CodeProduit']=$reponse->CodeProduit;
    $datas[$i]['Nom_page']=$reponse->Nom_page;
    $datas[$i]['client']=$reponse->client;
    $datas[$i]['Type']=$reponse->Type;
    $datas[$i]['action']="";
    $i++;
  }
  $Actions=$this->global_model->detail_publication($user,$date);
  foreach ($Actions as $key => $Actions) {
    
    $datas[$i]['heure']=$Actions->Date." ".$Actions->Heure;
    $datas[$i]['Id_discussion']=$Actions->Code_publication;
    $datas[$i]['Id_reponse']="";
    $datas[$i]['CodeProduit']="";
    $datas[$i]['Nom_page']="";
    $datas[$i]['client']=$Actions->Nom_produit;
    $datas[$i]['Type']=$Actions->Types;
    $datas[$i]['action']=$Actions->Actions;
    $i++;
  }
     $data=[
         'Actions'=>$this->global_model->detail_publication($user,$date),
       'data'=>$datas
    ];

  $this->render_view('Controlleur/discussion/opldiscussion',$data);
}
  public function liste_clients($user,$date=FALSE){
    $this->load->model('global_model');
    $donne=array();
    if($date==FALSE){
      $date=date('Y-m-d');
    }
    $i=0;
    $reponse=$this->global_model->table_listeclient($date,$user);
    $statut=$this->global_model->statut($date,$user);
    foreach( $reponse as  $reponse){
      $donne[$i]['Code_client']=$reponse->client;
      $donne[$i]['detail']=$this->global_model->retourClient($reponse->client);
      $donne[$i]['client']=$reponse->client;
      $donne[$i]['statut']=$this->statut($reponse->client,$user,$date);
      $donne[$i]['discuss']=$this->global_model->detail_discussion_operatrice($date,$user,$reponse->client);
      $i++;
    }
  
    $data=[
          'data'=>$donne,
          'statut'=>$statut,
          'user'=>$user,
          'date'=>$date
  
    ];
    $this->render_view('Controlleur/discussion/listeclient',$data);
  }
  

  public function statut($client,$user,$date=FALSE){
    $this->load->model('global_model');
    $test='En cours';
    $statut='<span style="background-color:#007E33;padding:5px 10px;border-radius:5px;color:#fff;">En cours</span>';
    $data=$this->global_model->statut($client,$user,$date);
    foreach($data as $data){
        if($data->Type=="vente"){
          $statut='<span style="background-color:#0099CC;padding:5px 10px;border-radius:5px;color:#fff;">Conclue</span>';
          $test='Conclue';
        }else if($data->Type=="Termnier"){
            if($test!="Conclue"){
              $statut='<span style="background-color:#CC0000;padding:5px 10px;border-radius:5px;color:#fff;">Terminée</span>';
            }
        }
    }
    return $statut;

  }

   
 
  public function liste_client($date=FALSE){
    if($date==FALSE){
      $date=date('Y-m-d');
    }
     $this->load->model('global_model');
     $matricule=$this->input->post('matricule');
    }

    public function details_discussion($user,$client,$date=FALSE){
      $this->load->model('global_model');
      $this->load->model('calendrier_model');
      if($date==FALSE){
        $date=date('Y-m-d');
        
      }
      $data=array('message'=>false,'content'=>"");
      $datass=$this->global_model->details_discussion($user,$client,$date);
    
      $content="";
      if($datass){
        $data['message']=true;
        $text="";
      foreach ($datass as $datass){
        if($datass->check=='OUI'){
          $text='text-success';
        }else if($datass->check=='NON'){
          $text='text-danger';
        }
       $datetemp=explode(" ",$datass->heure);   
       $dt=new dateTime($datetemp[1]);
       $dt->modify('+3hours');
       $heure=$dt->format('H:s:i');
        $content.="<tr>";
        if($datass->sender=="CLT"){
        $content.="<td>".$datass->Id."</td><td style='width:80px'>".$heure."</td><td><row style='background-color:#bdbdbd ;color:#212121;padding:5px 10px;border-radius:10px;width:80px;margin-right:40px'>".$datass->sender."</td><td style='background:#bdbdbd;color:#212121 ;border-radius:5px; width:500px; margin-left:70px; padding:5px 4px'>".$datass->Message."</td><td style='background:#e0e0e0;width:50px '></td><td>".$datass->appreciation."</td><td>".$datass->Type."</td>";
        $content.="</tr>";
        }else{
        $content.="<td>".$datass->Id."</td><td style='width:80px'>".$heure."</td><td><row style='background-color:#ffff00  ;color:#212121;padding:5px 10px;border-radius:5px;width:80px;margin-right:40px'>".$datass->sender."</td>
        <td style='background:#ffe57f ;color:#212121;border-radius:10px;width:500px; margin-left:70px; padding:5px 4px'>".$datass->Message."</td>
        <td  style='background:#e0e0e0; width:50px'> <div class='form-check'>
        <input class='form-check-input check' type='radio' name='radio' id='radio1' value='OUI'>
        <label class='form-check-label' for='radio1' style='color:green' >OUI</label>
          </div>
        <div class='form-check'>
        <input class='form-check-input check' type='radio' name='radio' id='radio2'  value='NON'>
        <label class='form-check-label' for='radio2' style='color:red'>NON</label></td>
        <td class='change-text ".$text."' style='width:250px;font-size:14px;height:30px'>".$datass->appreciation."</td><td>".$datass->Type."</td>";
        }
        $content.="</tr>";
        } 
      }
      $data=[
        'data'=>$content,
        'client'=>$this->calendrier_model->detail_client($client)

      ];

  $this->render_view('Controlleur/discussion/details_discussion',$data);
  }
  public function sondage(){
    $this->load->model('global_model');
    $data=array('message'=>false, 'content'=>"");
    $datas=$this->global_model->tableSondages();
    if ($datas){
      $data['message']=true;
  
      $data=[
        'data'=>$datas
      ];
  
    }
     $this->render_view('Controlleur/discussion/sondage',$data);
  }
  
  
  public function detail_publication($user,$date=FALSE){
    $this->load->model('global_model');
    if($date==FALSE){
      $date=date('Y-m-d');
    }
    $datas=$this->global_model->detail_publication($user,$date);
    $content="";
    if($datas){
      $data['message']=true;
   
    foreach($datas as $datas){
      $content.="<tr>";
        if($datas->Actions=="PUBLICATION") {
          $content.="<td>".$datas->Heure."</td><td>".$datas->Code_publication."</td><td><span style='background-color:#FF0000;color:#fff;padding:5px 10px;border-radius:5px;'>".$datas->Actions."</span></td><td>".$datas->Types."</td><td>".$datas->Code_produit."</td><td>".$datas->Nom_produit."</td><td><a href='".$datas->Lien_support."' target='_blank'>".$datas->Nom_groupe."</a></td>";
        }else if($datas->Actions=="PARTAGE") {
          $content.="<td>".$datas->Heure."</td><td>".$datas->Code_publication."</td><td><span style='background-color:#339900;color:#fff;padding:5px 10px;border-radius:5px;'>".$datas->Actions."</td><td>".$datas->Types."</td><td>".$datas->Code_produit."</td><td>".$datas->Nom_produit."</td><td><a href='".$datas->Lien_support."' target='_blank'>".$datas->Nom_groupe."</a></td>";
        }else if($datas->Actions=="SONDAGE"){
          $content.="<td>".$datas->Heure."</td><td>".$datas->Code_publication."</td><td><span style='background-color:#ffbb33;color:#fff;padding:5px 10px;border-radius:5px;'><a href='".base_url("controlleur/sondage/")."' class='link1 timeline'>".$datas->Actions."</a></td><td>".$datas->Types."</td><td>".$datas->Code_produit."</td><td>".$datas->Nom_produit."</td><td><a href='".$datas->Lien_support."' target='_blank'>".$datas->Nom_groupe."</a></td>";
        }
        $content.="</tr>"; 
    }
    
  }

  $data=[
         
    'data'=>$content

  ];
   
    $this->render_view('Controlleur/discussion/detail_publication',$data);
  }
 
  public function get_recap(){
   $datet = $this->input->post('dateselected');
   echo $datet;
  }
  public function produitListe(){
    $this->load->model('global_model');
    $date=$this->input->post('date');
    $matricule=$this->input->post('matricule');  
    $facture=$this->global_model->ca_facture($matricule,$date);
    $reponse=$this->calendrier_model->ca_de_vente($date);
    $arrayContent=array();
    $ca=0;
    $produit=0;
		$content="";
		$total=array();
    foreach($facture as $facture){
			if(array_key_exists($facture->Designation,$total)){
				    $total[$facture->Designation]+=($facture->Quantite*$facture->Prix_detail);
		   }else{
				 $total[$facture->Designation]=($facture->Quantite*$facture->Prix_detail);
	   	}
         if(array_key_exists($facture->Designation,$arrayContent)){
						$arrayContent[$facture->Designation]+=$facture->Quantite;
						
         }else{
            $arrayContent[$facture->Designation]=$facture->Quantite;
         }
     }
     foreach($reponse as $reponse){
      $produit+=$reponse->Quantit;
      $ca+=($reponse->Quantit*$reponse->Prix_detail);
      
     
        }       
    foreach($arrayContent as $key=>$arrayContent){
      
       $content.="<tr><td class='text-center'>".$key."</td><td class='text-center'>".$arrayContent."</td><td>$total[$key]</td></tr>";
    }
     
  echo "<table class='table table-bordered'><thead><th class='text-center'>PRODUIT(S)</th><th class='text-center'>NOMBRE</th><th>PRIX</th></thead><tbody>".$content."</tbody></table>";
}
public function produitUser(){
  $this->load->model('global_model');
  $matricule=$this->input->post('matricule');
  $date=$this->input->post('date');
  $facture=$this->global_model->ca_facture_opl($matricule,$date);
  $reponse=$this->calendrier_model->ca_de_vente($date);
  $arrayContent=array();
  $content="";
  $ca=0;
  $produit=0;
  $total= array();

 foreach($facture as $facture){
 if(array_key_exists($facture->Designation,$total)){
       $total[$facture->Designation]+=($facture->Quantite*$facture->Prix_detail);
  }else{
    $total[$facture->Designation]=($facture->Quantite*$facture->Prix_detail);
 }
    if(array_key_exists($facture->Designation,$arrayContent)){
       $arrayContent[$facture->Designation]+=$facture->Quantite;
       
    }else{
       $arrayContent[$facture->Designation]=$facture->Quantite;
    }
}
foreach($reponse as $reponse){
 $produit+=$reponse->Quantit;
 $ca+=($reponse->Quantit*$reponse->Prix_detail);
 

   }       
foreach($arrayContent as $key=>$arrayContent){
 
  $content.="<tr><td class='text-center'>".$key."</td><td class='text-center'>".$arrayContent."</td><td style='font-size:15px;'>".number_format($total[$key], 0, '.', ',')."</style></td></tr>";
}
   
echo "<table class='table table-bordered'><thead><th class='text-center'>PRODUIT(S)</th><th class='text-center'>NOMBRE</th><th>PRIX</th></thead><tbody>".$content."</tbody></table>";

}

public function enregister_remarque(){
    $this->load->model('global_model');
    $id=$this->input->post('Id');
    $data=[
      'appreciation'=>$this->input->post('appreciation'),
      'check'=>$this->input->post('choix')
    ];
    $this->global_model->enregister_remarque($id,$data);
   echo json_encode(array('message'=>true));
}
public function statutCRX($linkFb,$groupe){
  $this->load->model('global_model');
  $test_exist_CMT=$this->global_model->test_exist_CMT($linkFb);
  if($test_exist_CMT){
       $test_exist_CLT=$this->global_model->test_exist_CLT($linkFb);
       if($test_exist_CLT){
        $resultat="CLT";
       }else{
         $testCMT=$this->global_model->test_discussion_crx($test_exist_CMT->Code_client,trim($groupe));
         $resultat= $groupe;
         if($testCMT != '0'){
             $resultat= 'CMT';
         }else{
          $resultat= 'CRX';
            // $resultat=$test_exist_CMT->Code_client;
            // $resultat=$test_exist_CMT->Code_client;
            // $resultat= $testCMT;
         }
         
       }
       //$groupes=$this->global_model->usergroupefacture($groupe,$linkFb);
       
  }else{
   $resultat="CRX";
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

//public function discussion($linkFb,$groupe){



//} 
public function curieux($limit, $start){
  $this->load->model('global_model');
  $i=0;
  $donne=array(); 
  $entete=array();
  $data=$this->global_model->client_crx_tout($limit, $start);
  foreach ($data as $key => $data){
    $i=0;
     $groupe=$this->global_model->groupeusers();
     foreach ($groupe as $groupe) {
       if(!in_array($groupe->Nom_page, $entete)){
         $entete[$i]=$groupe->Nom_page;
         $i++;
       }
      $donne[$data->Nom.".".$data->Code_client]['page'][$groupe->Nom_page]=$this->statutCRX($data->Code_client,$groupe->id);  
       
    }
     
  }
 
  return array('data'=>$donne,'entete'=> $entete);
}
public function  clients($type){
  $this->load->model('client_model');
  $config = array();
  $config["base_url"] = base_url().strtolower($this->session->userdata('designation')).'/'.'clients/'.$type;
  $config["total_rows"] = $this->client_model->nombre_clientCRX();
  $config["per_page"] =10;
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
    $donne=$this->curieux($config["per_page"], $page); 
    $data["links"] = $this->pagination->create_links();
    $data['data'] = $donne['data'];
    $data['entete'] = $donne['entete'];

    $this->render_view('Controlleur/client/'.$type,$data);

}

public function  clients_curieux(){
  $this->load->model('client_model');
  $config = array();
  $config["base_url"] = base_url().strtolower($this->session->userdata('designation')).'/'.'clients_curieux/';
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
    $this->render_view('Controlleur/client/clients_curieux',$data);

}

public function paginationCRX (){

 
}

public function detail_clients_curieux($Id){
  $this->render_view('Controlleur/client/detail_clients_curieux');
}
public function presence($date=FALSE){
  $this->load->model('Global_model');
    $date=$this->input->post('date');
	    if(empty($date)){
           $date=date('Y-m-d');
		}
$date_prese=explode("-",$date);
	  $content="";
	   $datas=$this->global_model->table_resume($date);
      foreach ($datas as $key => $datas) {
        $data=array();
        $produit=0;
		$ca=0;
    $publi=0;
    $data=$this->global_model->table_rapport($date,$datas->operatrice);
		$facture=$this->global_model->ca_facture_opl($datas->operatrice,$date);
		$user=$this->global_model->user($datas->operatrice);
		$sender=$this->global_model->repopl($date,$datas->operatrice);
		$page=$this->global_model->groupeuser($datas->operatrice);
		$publica=$this->global_model->reppublication($datas->operatrice,$date);
    $nb=$this->global_model->date_presence($datas->operatrice,$date_prese[1]);
   
        $content.="<tr><td class='text-center matricule'><a href='#' class='link1 timeline'>".$datas->operatrice."</td><td><a href='".base_url("controlleur/detail_discussion_operatrice/".$datas->operatrice."/".$date)."' class='link1 timeline'>".$user->Nom." ".$user->Prenom."</a></td><td><a href='".$page->Lien_page."' target='_blank'>".$page->Nom_page."</a></td><td class='text-center'><button type='button' class='btn btn-primary show_modal' data-toggle='modal' data-target='.bd-example-modal-lg' style=''>".count($nb)."</button></td></tr>";	
	}
  $data=['data'=>$content];  
   $this->render_view('Controlleur/presence',$data);
}
public function details_presence($user,$date=FALSE){
  $this->load->model('global_model');  
  $i=0;
  if($date==FALSE){
    $date=date('Y-m-d');
  }
  $reponse=$this->global_model->pres($date,$user);
  foreach($reponse as $reponse){
    $datas[$i]['heure']=$reponse->heure;
    $i++;
  }
 $Actions=$this->global_model->detail_pre($user,$date);
  foreach ($Actions as $key => $Actions) {
    
    $datas[$i]['heure']=$Actions->Date." ".$Actions->Heure;
    $datas[$i]['date']=$Actions->Date." ".$Actions->Date;
    $i++;
  }
    $data=[
       'Actions'=>$this->global_model->detail_pre($user,$date),
       'data'=>$datas
    ];

  $this->render_view('Controlleur/details_presence',$data);
}

public function data_json_calendrier_presence(){
	$tab=array();
	$i=0;
	$this->load->model('Calendrier_model');
	$this->load->model('global_model');  
	$color=array('pre'=>"#0062cc!important",'ann'=>"#CC0000!important","pla"=>"#563d7c!important","liv"=>"green!important","etdc"=>"orange!important");
	$type=array('pre'=>"previ",'ann'=>"annule","pla"=>"confirmer","liv"=>"livre","etdc"=>"en_attente");
	foreach ($this->Calendrier_model->retour_date_precence() as $data) {
	$count="";
	$user=$this->global_model->pres_calendrier($data->Date);
	foreach($user as 	$user){
		if(	$count==""){
		  	$count=$user->operatrice;  
		}else{
				$count.=$user->operatrice;
		}
	
	}
	$tab[$i]=array(
							'id' => $i,
							'title' =>	$count,
							'start' => $data->Date,
							'color' => "#0062cc!important"   
			); 

		$i++;  
	}
		 echo json_encode($tab);
	 }
   public function detail_de_facture($idfacture){
		$this->load->model('calendrier_model');
    $data=[
        'client'=>$this->calendrier_model->detail_facture($idfacture),
				'commande'=>$this->calendrier_model->detail_commande_facture($idfacture),
				'facture'=>$this->calendrier_model->detail_facture_discussion($idfacture)
    ];
    $this->render_view('Controlleur/calendrier/detail_facture',$data);
   } 


   public function etat_vente($date=false){
     if($date==false){
        $date=date('Y-m-d');
     }
    $datet = $this->input->post('dateAutre');
    $text=array('en_attente'=>'EN ATTENTE','confirmer'=>'CONFIRMEE','annule'=>'ANNULEE','livre'=>'LIVREE','reppoter'=>'REPPORTEE');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    $this->load->model('calendrier_model');
      if($this->session->userdata('designation')=="Controlleur"){
       $i=0;
       $entete=array('totaLsom'=>0);
        $content="";
        $datas=$this->global_model->etat_vente($date);
        $datax=$datas;
        $data=array(); 
        $total=0;
        $livre=0;
        $en_attente=0;
        $annule=0;
        $confirmer=0;
        $ca=array();
        if($this->calendrier_model->ca_de_vente_controlleur($date,'livre')){
        foreach ($this->calendrier_model->ca_de_vente_controlleur($date,'livre') as $key => $value) {
          $livre+=($value->Quantite*$value->Prix_detail);
          if(!isset($dataUser[$value->Matricule_personnel]['livre'])){
            $dataUser[$value->Matricule_personnel]['livre']=$value->Quantite*$value->Prix_detail;
          }else{
            $dataUser[$value->Matricule_personnel]['livre']+=$value->Quantite*$value->Prix_detail;
          }
        }
  
    }
    
  
    if($this->calendrier_model->ca_de_vente_controlleur($date,'en_attente')){
      foreach ($this->calendrier_model->ca_de_vente_controlleur($date,'en_attente') as $key => $value) {
        $en_attente+=($value->Quantite*$value->Prix_detail);
        if(!isset($dataUser[$value->Matricule_personnel]['en_attente'])){
          $dataUser[$value->Matricule_personnel]['en_attente']=$value->Quantite*$value->Prix_detail;
        }else{
          $dataUser[$value->Matricule_personnel]['en_attente']+=$value->Quantite*$value->Prix_detail;
        }
      }
  
  }
      
  if($this->calendrier_model->ca_de_vente_controlleur($date,'annule')){
    foreach ($this->calendrier_model->ca_de_vente_controlleur($date,'annule') as $key => $value) {
      $annule+=($value->Quantite*$value->Prix_detail);
      if(!isset($dataUser[$value->Matricule_personnel]['annule'])){
        $dataUser[$value->Matricule_personnel]['annule']=$value->Quantite*$value->Prix_detail;
      }else{
        $dataUser[$value->Matricule_personnel]['annule']+=$value->Quantite*$value->Prix_detail;
      }
    }
  
  }
  
  if($this->calendrier_model->ca_de_vente_controlleur($date,'confirmer')){
    foreach ($this->calendrier_model->ca_de_vente_controlleur($date,'confirmer') as $key => $value) {
      $confirmer+=($value->Quantite*$value->Prix_detail);
      if(!isset($dataUser[$value->Matricule_personnel]['confirmer'])){
        $dataUser[$value->Matricule_personnel]['confirmer']=$value->Quantite*$value->Prix_detail;
      }else{
        $dataUser[$value->Matricule_personnel]['confirmer']+=$value->Quantite*$value->Prix_detail;
      }
    }
  
  }
        foreach ($datax as $key => $datax) {
          if(array_key_exists($datax->date_de_livraison,$ca)){
            foreach($this->calendrier_model->ca_facture($datax->Id) as $commande){
            $ca[$datax->date_de_livraison]+=$commande->Quantite*$commande->Prix_detail;
            }
          }else{
            $ca[$datax->date_de_livraison]=0;
            foreach($this->calendrier_model->ca_facture($datax->Id) as $commande){
              $ca[$datax->date_de_livraison]+=$commande->Quantite*$commande->Prix_detail;
              }
          }
             
          if(!in_array($datax->date_de_livraison,$data)){
            $data[$i]=$datax->date_de_livraison;
            $i++;
          }
        }
       sort($data);
      foreach($data as $data){
        $content.="<tr'><td class='text-danger' style='font-size:17px'>".$this->dateToFrench($data,'l j F Y')."</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class='text-danger' style='font-size:15px'><b>".number_format($ca[$data], 0, ',', ' ')." Ar</b></td></tr>";
        $datadate=$this->global_model->detail_etat_vente_facture($date,$data);
               
        foreach ($datadate as $key => $datadate) {
           $produit="";
           $prix="";
           foreach($this->calendrier_model->ca_facture($datadate->Id) as $commande){
            //$resultat[$i]['ca']+=($commande->Quantite*$commande->Prix_detail); 
           $produit.=$commande->Designation.'<br/>';
           $prix.=number_format($commande->Quantite*$commande->Prix_detail, 0, ',', ' ').' <br/>';
          }    
          $codeCodevlient=$this->calendrier_model->detail_client($datadate->Code_client);
          $mission=$datadate->Id_de_la_mission;
          if(strstr($codeCodevlient->Commercial, "VP")) { 
            $facture=$this->global_model->testFactureLocalite($codeCodevlient->Commercial,$data);
            if($facture){
              $mission=$facture->Id_de_la_mission;
            }
            //else{
              //$mission="";
           // }
            
          }
          if($text[$datadate->Status]=='EN ATTENTE' AND substr($mission, 0, 20)!='FACEBOOK'){
           $content.="<tr><td class='text-center'>".$datadate->Code_client."</td><td class='text-center'>".$datadate->Matricule_personnel."</td><td>".$datadate->Commercial."</td><td class='text-center'>".substr($produit, 0, 35)."</td><td class='text-center' style='width=20%'>".$prix."</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".substr($mission, 0, 14)."</td><td class='text-center'>".$datadate->District."</td><td class='text-center'><row style='background-color:#FF8800;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".$text[$datadate->Status]."</td></tr>";
          }elseif($text[$datadate->Status]=='LIVREE' AND substr($mission, 0, 20)!='FACEBOOK'){
           $content.="<tr><td class='text-center'>".$datadate->Code_client."</td><td class='text-center'>".$datadate->Matricule_personnel."</td><td>".$datadate->Commercial."</td><td class='text-center'>".substr($produit, 0, 35)."</td><td class='text-center' style='width=20%'>".$prix."</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".substr($mission, 0, 14)."</td><td class='text-center'>".$datadate->District."</td><td class='text-center'><row style='background-color:#00C851;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".$text[$datadate->Status]."</td></tr>";
          }elseif ($text[$datadate->Status]=='ANNULEE' AND substr($mission, 0, 20)!='FACEBOOK'){
           $content.="<tr><td class='text-center'>".$datadate->Code_client."</td><td class='text-center'>".$datadate->Matricule_personnel."</td><td>".$datadate->Commercial."</td><td class='text-center'>".substr($produit, 0, 35)."</td><td class='text-center' style='width=20%'>".$prix."</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".substr($mission, 0, 14)."</td><td class='text-center'>".$datadate->District."</td><td class='text-center'><row style='background-color:#CC0000;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".$text[$datadate->Status]."</td></tr>";
          }elseif($text[$datadate->Status]=='CONFIRMEE' AND substr($mission, 0, 20)!='FACEBOOK') {
           $content.="<tr><td class='text-center'>".$datadate->Code_client."</td><td class='text-center'>".$datadate->Matricule_personnel."</td><td>".$datadate->Commercial."</td><td class='text-center'>".substr($produit, 0, 35)."</td><td class='text-center' style='width=20%'>".$prix."</td><td><row style='background-color:#6d4c41;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".substr($mission, 0, 14)."</td><td class='text-center'>".$datadate->District."</td><td class='text-center'><row style='background-color:#9933CC;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".$text[$datadate->Status]."</td></tr>";
          }
          if($text[$datadate->Status]=='EN ATTENTE' AND substr($mission, 0, 20)=='FACEBOOK'){
           $content.="<tr><td class='text-center'>".$datadate->Code_client."</td><td class='text-center'>".$datadate->Matricule_personnel."</td><td>".$datadate->Commercial."</td><td class='text-center'>".substr($produit, 0, 35)."</td><td class='text-center' style='width=20%'>".$prix."</td><td>".substr($mission, 0, 14)."</td><td class='text-center'>".$datadate->District."</td><td class='text-center'><row style='background-color:#FF8800;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".$text[$datadate->Status]."</td></tr>";
          }elseif($text[$datadate->Status]=='LIVREE' AND substr($mission, 0, 20)=='FACEBOOK'){
           $content.="<tr><td class='text-center'>".$datadate->Code_client."</td><td class='text-center'>".$datadate->Matricule_personnel."</td><td>".$datadate->Commercial."</td><td class='text-center'>".substr($produit, 0, 35)."</td><td class='text-center' style='width=20%'>".$prix."</td><td>".substr($mission, 0, 14)."</td><td class='text-center'>".$datadate->District."</td><td class='text-center'><row style='background-color:#00C851;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".$text[$datadate->Status]."</td></tr>";
          }elseif ($text[$datadate->Status]=='ANNULEE' AND substr($mission, 0, 20)=='FACEBOOK'){
           $content.="<tr><td class='text-center'>".$datadate->Code_client."</td><td class='text-center'>".$datadate->Matricule_personnel."</td><td>".$datadate->Commercial."</td><td class='text-center'>".substr($produit, 0, 35)."</td><td class='text-center' style='width=20%'>".$prix."</td><td>".substr($mission, 0, 14)."</td><td class='text-center'>".$datadate->District."</td><td class='text-center'><row style='background-color:#CC0000;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".$text[$datadate->Status]."</td></tr>";
          }elseif($text[$datadate->Status]=='CONFIRMEE' AND substr($mission, 0, 20)=='FACEBOOK') {
           $content.="<tr><td class='text-center'>".$datadate->Code_client."</td><td class='text-center'>".$datadate->Matricule_personnel."</td><td>".$datadate->Commercial."</td><td class='text-center'>".substr($produit, 0, 35)."</td><td class='text-center' style='width=20%'>".$prix."</td><td>".substr($mission, 0, 14)."</td><td class='text-center'>".$datadate->District."</td><td class='text-center'><row style='background-color:#9933CC;color:#fff;padding:5px 10px;border-radius:5px;width:80px;font-size:13px'>".$text[$datadate->Status]."</td></tr>";
          }
                 
         // $content.="<tr><td>".$datadate->data_de_livraison."</td><td>".$datadate->Code_client."</td><td >".$datadate->Matricule_personnel."</td><td>".$datadate->Designation."</td><td>".number_format($datadate->Prix_detail, 0, ',', ' ')."Ar</td><td class='text-center >".$datadate->Id_de_la_mission."</td><td>".$datadate->Status."</td></tr>";
        
        }
        $entete['totaLsom']+=$ca[$data];
        

      }
        

       /* foreach ($datas as $key => $datas) {
          $produit=0;
          $user=$this->global_model->user($datas->Matricule_personnel);
          $content.="<tr><td>".$datas->data_de_livraison."</td><td>".$datas->Code_client."</td><td >".$datas->Matricule_personnel."</td><td></td><td>".number_format(000, 0, ',', ' ')."Ar</td><td class='text-center >".$datas->Id_de_la_mission."</td><td>".$datas->Status."</td></tr>";
         }*/
         $data=['data'=>$content,'entete'=>$entete,'livre'=>$livre,'en_attente'=>$en_attente,'annule'=>$annule,'confirmer'=>$confirmer,];   
   
    }
  
    $this->render_view('Controlleur/etat_vente',$data);
  }
public  function dateToFrench($date, $format) 
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
}
public function etat_mois(){
    $this->render_view('Controlleur/etat_mensuel');

}

  
}
