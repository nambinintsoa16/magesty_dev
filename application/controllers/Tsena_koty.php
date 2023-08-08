<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tsena_koty extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  public function Tache()
  {
    $this->render_view("Tsena_koty/Tache/index");
  }

  public function carteGratee()
  {
    $this->render_view("Tsena_koty/carteGratee/nouveau");
  }
  public function tachekoty()
  {
    $this->load->model('client_model');
    $codeclient = $this->input->post('codeclient');
    $data = [
      'typetache' => $this->global_model->typetachekoty(),
      'typeaction' => $this->global_model->actionkoty(),
      'pageuser' => $this->global_model->data_page_users($this->session->userdata('matricule'))
    ];
    $kots = 0;
    $bonus = $this->client_model->selectMouvementKoty(['Client' => $codeclient, "Raison" => "KARATRA TONGASOA"]);
    if ($bonus == false) {

      $compte = $this->client_model->selectCompte(['Client' => $codeclient, 'Statut' => 'on']);
      if ($compte) {
        $newcompte = $compte->Koty + 500;
        $kots = $newcompte;
        $update = $this->client_model->updateCompte(['Id' => $compte->Id], ['Koty' => $newcompte]);
        if ($update) {

          $dataMouve = [
            "Client" => $codeclient,
            "Date" => date('Y-m-d'),
            "Type" => "GAIN",
            'Koty' => 500,
            'Raison' => "KARATRA TONGASOA",
            'facture' => ""
          ];
          $this->client_model->Ajout_Mouvement($dataMouve);
        }
      } else {
        $kots = 500;
        $this->client_model->insertCompte([
          "Client" => $codeclient,
          "Koty" => 500,
          "Statut" => "on",
          "Date" => date('Y-m-d')
        ]);
        $dataMouve = [
          "Client" => $codeclient,
          "Date" => date('Y-m-d'),
          "Type" => "GAIN",
          'Koty' => 500,
          'Raison' => "KARATRA TONGASOA",
          'facture' => ""
        ];
        $this->client_model->Ajout_Mouvement($dataMouve);
      }
    }
    $this->load->view('Tsena_koty/Tache/tachekoty', $data);
  }
  public function DetailPromotion()
  {
    $this->load->model('Discussion_model');
    $codePromo =  $this->input->post('promo');
    $donne = array();
    //$reponse = $this->Discussion_model->promotionSelects(['Pr_Status' => "En_cours", "Pr_Code_Promo" => $codePromo]);
    $reponse = $this->Discussion_model->promotionSelects(["Pr_Code_Promo" => $codePromo]);
    if ($reponse) {
      $produit = explode(',', $reponse->Pr_Produit);
      $i = 0;
      foreach ($produit as $produit) {
        $donne[$i] = $this->Discussion_model->rechercheProduit(["produit.Code_produit" => $produit]);
        $i++;
      }
    }
    $data = ["data" => $donne];
    return $this->load->View('Tsena_koty/FormEtape/DetailPromotion', $data);
  }
  public function completeTache()
  {
    $this->load->model('global_model');
    $donne = $this->global_model->complete_sous_tache($this->input->post('code'));
    $html = "<option hidden></option>";
    foreach ($donne as $donne) {
      $html .= '<option value="' . $donne->code . '">' . $donne->nom_sous_tache . '</option>';
    }
    echo $html;
  }

  public function produit_dispo_koty()
  {
    $this->load->model('koty_model');
    $koty  = $this->input->get('koty');
    if(empty($koty)){
       $koty = 0;
    }
       $data =array();
       $datas = $this->koty_model->listeProduit("prix.Prix_zen < $koty");
      foreach ($datas as $row) {
        $sub_array= array();
        $sub_array[] ='<a
        href="'.code_produit_img_link($row->Code_produit).'"
        data-lightbox="roadtrip"><img src="'.code_produit_img_link($row->Code_produit).'" class="img-thumbnail" style="width:60px;"></a>';
        $sub_array[] = $row->Code_produit;
        $sub_array[] = $row->Designation;
        $sub_array[] =$row->Prix_zen;
     
        $data[] = $sub_array;
      }
      $output = array(
        "data" => $data
      );
      echo json_encode($output);
    }  
    public function Viewdiscussion($codeclient){
      $this->load->model('global_model');
      $this->load->model('koty_model');
      $this->load->model("Discussion_model");
      
      $codeclient =  $codeclient;
      $promo =  $this->Discussion_model->promotionSelect(["Pr_Status"=>"en_cours"]);
      $facture = $this->koty_model->etat_vente(['facture.Code_client'=> trim($codeclient)]);
      $MesPromotion = $this->koty_model->etat_vente("facture.Code_client like  '$codeclient'  AND codePromo <> 'null'");
      $gain = $this->global_model->gettotalsmileskotyGlobale($codeclient);
          foreach ($gain as $key) {
            $koty = $key->koty;
            $smiles = $key->smiles;
          }
        $data = [
          'promo'=>$promo,
          'facture'=>$facture,
          'MesPromotion'=>$MesPromotion,
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
        $this->render_view('Tsena_koty/Tache/discussion', $data);
      }
   public function ProduitVenteKoty(){
    $this->load->model('koty_model');
    $codeProduit = $this->input->post('codeProduit');

    $json = array('message' => false,'prix' =>'','designation' =>'','Code_produit' =>'');
    $data = $this->koty_model->produitname($codeProduit);
    if ($data) {
        $json['message'] = true;
        $json['prix'] =$data->Prix_zen;
        $json['designation'] = $data->Designation;
        $json['Code_produit'] = $data->Code_produit;
        $json['IdPrix'] = $data->Id;

        
    }
    echo json_encode($json, true);
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
              $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px "><img class="img-thumbnail" src="'.base_url("/images/pieceJoint/$reponse->Message.jpg").'" alt="' . $reponse->Message . '" style="width:120px;height:120px;object-fit:cover;"></div>';
            }else  if($reponse->Type=='rendez-vous'){ 
              $dataRvd = $this->global_model->selectRendeVous(["date"=>$reponse->date,"heure"=>$reponse->heures,"codeclient"=>$client,"page"=>$reponse->Page]);
              if($dataRvd){
                $pagess=  $this->global_model->comptefbDetail(['id'=>$dataRvd->page]);
                $json['content'] .="<div style='background:#F8BBD0;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; margin-left:90px'> Rendez-vous le ".$dataRvd->date." à ".$dataRvd->heure." sur la page ".$pagess->Nom_page."</div>";
                
              }else{
                $json['content'] .="<div></div>";
              } 

            }else if (trim($reponse->Type) == 'vente') {
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
                $totatsmilekotyFinal=  $kotyT ." Koty ";
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
              $kotydispo = $this->global_model->kotydispo($client);
              //$kotysisa = $kotydispo;

              if($detail){
              $json['content'] .= '<div class="text-left" style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left:90px;font-size:10px;white-space: break-spaces;line-height:1.2;font-size: 12px!important;text-align: left;"><div style="padding:10px;text-align:left"> <h1 style="font-size:14px"> Raha fintinina izany ny commande_nao dia :</h2> <br> Vokatra : ';
              foreach ($detail as $key => $detail) {
                $json['content'] .= substr($detail->Designation, 0, 60) . '<br> Miisa : ' . $detail->Quantite . '<br> Vidiny : ' . number_format($detail->Prix_zen) . ' Koty<br/> ';
                $remise .= substr($detail->Designation, 0, 50) . " : <br><b> - Smiles : " . $detail->Smile_LV1 . "  <br> - Koty : " . $detail->Zen_LV1 . " </br></b>";

                $total += ($detail->Quantite * $detail->Prix_zen);
              }
              
              $json['content'] .= '<br><span><b> Localité : ' . $livraison->Localite . '</span>';
              $json['content'] .= '<br>Quartier:' . $livraison->Quartier . "&nbsp; &nbsp;<br>Commune:" . $livraison->Ville . '<br> Toerana : ' . $livraison->lieu_de_livraison . '<br> Contact 1 : ' . $livraison->contacts . '<br> Contact 2 : ' . $livraison->Contact_livraison . '<br>Date de livraison : ' .  $livraison->date_de_livraison . " " . '<br>Frais de livraison : ' . number_format($livraison->frais) . ' Ar' .'<br> Frais de Retrait : ' . $livraison->frais_de_retrait . ' Ar'. " " . $livraison->heure_deb_livre . $livraison->heure_fi_livre . '';
              if ($livraison->Status == 'livre') {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $kotydisponible = $detail->koty_sisa;
                $kotysisa = $kotydisponible-  $total;

                $json['content'] .= '<br><span><b> Total  achat : ' . number_format($total) . ' Koty ';
                $json['content'] .= '<br><span><b> Total frais : ' . number_format($livraison->frais + $fraisRetrait) . ' Ar <div class="modify"><button id="' . trim($reponse->Message) . '" class="btn btn-sm btn-success disabled text-center modify btn-sm" style="margin-left:350px;color:#fff;border-radius:10px"><b>' . $text[$livraison->Status] . '</button></div></span>';
                
              } else if ($livraison->Status == 'annule') {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($livraison->frais + $fraisRetrait) . ' Ar <div class="modify"><button class="btn btn-sm btn-danger disabled text-center btn-sm"  id="' . trim($reponse->Message) . '" style="margin-left:350px;color:#fff;border-radius:10px">' . $text[$livraison->Status] . '</button></div></span>';
              } else {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $kotydisponible = $kotydispo->Koty;
                if(empty($kotydisponible)){
                  $kotydisponible = 0;
                }
                $kotysisa = $kotydisponible - $total;
                $json['content'] .= '<br><span><b> Total frais : ' . number_format($livraison->frais + $fraisRetrait) . ' Ar </b>';
                $json['content'] .= '<br><span><b> Total  achat : ' . number_format($total ) . ' Koty </b> <div class="modify"><button class="btn btn-sm btn-dark disabled text-center "  id="' . trim($reponse->Message) . '" style="margin-left:350px;color:#000;border-radius:10px ">' . $text[$livraison->Status] . '</b></button></div></span>';
              //$kotydisponible = $detail->koty_sisa;
              //$kotysisa = $kotydisponible-  $total;

              }
              $json['content'] .= '<br><span><b>' . $livraison->Matricule_personnel . '</span>';
              $json['content'] .= '<br><span><b>' . $livraison->Code_client . '</span>';
              $vardata = $this->global_model->retour_page($reponse->Page);
              $page = "";
              if ($livraison->permission == 'on') {
                $lock = '<i class="fa fa-unlock-alt" id="lock" style="font-size:10px;" aria-hidden="true"></i>';
              } else {
                $lock = '<i class="fa fa-lock" id="lock"  style="font-size:10px;" aria-hidden="true"></i>';
              }
              if ($vardata) {
                $page = $reponse->Page;
              }
              

              $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000;  word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a"><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;' . $lock . '&nbsp;&nbsp;' . $heure[1] . '</span></p></div></div></div>';

              $json['content'] .= '</div></div> <div style="background:#00B74A;padding: 5px 20px;border-radius:10px;margin-bottom:10px;max-width:85%;color:#000; word-break: break-all!important;margin-left:90px ;text-align:left "><b>TOE-KOTY</b> <br><br> Raha toa ka livré ireo vokatra ireo dia toy izao ny toe-kotinao <br> <br>&nbsp &nbsp &nbsp &nbsp Koty teo aloha: &nbsp'.$kotydisponible.' Koty<br><br>&nbsp &nbsp &nbsp &nbsp Koty nolanina: &nbsp'.$total.'&nbsp  Koty <br><br>&nbsp &nbsp &nbsp &nbsp Koty sisa:<span style="background:orange;border-radius:3px; padding:5px 10px"><b>  '. $kotysisa.' &nbsp  Koty  </b> </span> <br> <h2 style="font-size:12px;font-weight:bold"><h2 style="font-size:12px;font-weight:bold"> Ny Statut anao amizao dia </h2>- <b>STATUT ACTUEL : <span style="background:#fff;border-radius:3px; padding:3px 5px"><b> ' . $statutannuel . ' | ' . $statuttrim . '     </b> </span> <br>  </div></div>';
              
             
            } else if (trim($reponse->Type) == 'terminer') {
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
              $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><br><span style="font-size:10px;">'.$this->session->userdata('matricule').'</span><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
              }
            }else{
              if ($reponse->sender == 'CLT'){
                $json['content'] .= '<div style="background:#b2ebf2  ;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;margin-top:5px;">' . $page . '&nbsp;&nbsp; <i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
              }else{
                $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><br><span style="font-size:10px;">'.$this->session->userdata('matricule').'</span><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;margin-top:5px;text-align:left">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
              }
           
              }
          } else if ($reponse->sender == 'CLT') {
            if ($reponse->Type == 'image') {
              $json['content'] .= '<div class="form-control pt-1 pl-1 pb-1" style="background:#b2ebf2;min-height:135px;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; "><img class="img-thumbnail" src="'.base_url("/images/pieceJoint/$reponse->Message.jpg").'"  style="height:120px;width:120px;object-fit:cover"></div>';
            } else {
              $vardata = $this->global_model->retour_page($reponse->Page);
              $page = "";
              if ($vardata) {
                $page = $reponse->Page;
              }
              $json['content'] .= '<div style="background:#b2ebf2  ;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;text-align:left"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:12px;margin-top:5px;">' . $page . '&nbsp;&nbsp; <i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
              
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
              'operatrice'=>$operatrice, 
              'client'=> $client, 
              'idaction'=>$id_discussion,
              'date'=>date('Y-m-d'), 
              'heure'=>date('H:i:s'), 
              'page'=> $this->input->post('page'),
              'action'=> $this->input->post('Type'),
              'sender'=>$this->input->post('sender'),
              'types'=>$this->input->post('types'),
              'tache'=>$this->input->post('tache')
           
        ];
          $this->global_model->inserthistorique_discussion_session($insertSession);

    $this->global_model->insertMessageSimples($this->input->post('message'), $this->input->post('Type'), $this->input->post('sender'), $id_discussion, $this->input->post('idRep'), $this->input->post('page'),$this->input->post('date'),$this->input->post('heure'));
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
            $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; margin-left:90px"><img class="img-thumbnail" src="'.base_url("/images/pieceJoint/$reponse->Message.jpg").'" alt="' . $reponse->Message . '" width="100" height="100"></div>';
          }else if($reponse->Type=='rendez-vous'){
            $dataRvd = $this->global_model->selectRendeVous(["date"=>$reponse->date,"heure"=>$reponse->heures,"codeclient"=>$client,"page"=>$reponse->Page]);
            if($dataRvd){
              $pagess=  $this->global_model->comptefbDetail(['id'=>$dataRvd->page]);
              $json['content'] .='<div style="background:#F8BBD0;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"> Rendez-vous le '.$dataRvd->date.' à '.$dataRvd->heure.' sur la page '.$pagess->Nom_page.'</div>';
            }else{
              $json['content'] .='<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><br><span style="font-size:10px;">'.$this->session->userdata('matricule').'</span><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
            }
         
          } else if (trim($reponse->Type) == 'vente') {
            $total = 0;
            $remise = "";
            $detail = $this->calendrier_model->detail_commande_facture_discussion(trim($reponse->Message));
            if( $detail){
            $livraison = $this->calendrier_model->detail_facture_discussion(trim($reponse->Message));
            $json['content'] .= '<div class="text-left" style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left:90px;font-size:10px;white-space: break-spaces;line-height:1.2;font-size: 12px!important;text-align: left;"><div style="padding:10px;text-align:left"> <h1 style="font-size:14px"> Raha fintinina izany ny commande_nao dia :</h2> <br> Vokatra : ';
            foreach ($detail as $key => $detail) {
              $json['content'] .= substr($detail->Designation, 0, 60) . '<br> Miisa : ' . $detail->Quantite . '<br> Vidiny : ' . number_format($detail->Prix_zen) . ' Ar<br> Koty : ' . $detail->Smile_LV1;
              $remise .= $detail->Designation . " : " . $detail->Smile_LV1 . " Smiles |" . $detail->Zen_LV1 . " Koty</br>";
              $total += ($detail->Quantite * $detail->Prix_detail);
            }

             //$json['content'] .= '<br><span><b> Localité : ' . $livraison->Localite . '</span>';
              $json['content'] .= '<br>Quartier:' . $livraison->Quartier . "&nbsp; &nbsp;<br>Commune:" . $livraison->Ville . '<br> Toerana : ' . $livraison->lieu_de_livraison . '<br> Contact 1 : ' . $livraison->contacts . '<br> Contact 2 : ' . $livraison->Contact_livraison . '<br>Date de livraison : ' . $livraison->date_de_livraison . " " . '<br>Frais de livraison : ' . $livraison->frais . ' Ar' .'<br> Frais de Retrait : ' . $livraison->frais_de_retrait . ' Ar'. " " . $livraison->heure_deb_livre . $livraison->heure_fi_livre . '';
              if ($livraison->Status == 'livre') {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait) . ' Ar <div class="modify"><button id="' . trim($reponse->Message) . '" class="btn btn-sm btn-success disabled text-center modify btn-sm" style="margin-left:350px;color:#fff;border-radius:10px"><b>' . $text[$livraison->Status] . '</button></div></span>';
              } else if ($livraison->Status == 'annule') {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait) . ' Ar <div class="modify"><button class="btn btn-sm btn-danger disabled text-center btn-sm"  id="' . trim($reponse->Message) . '" style="margin-left:350px;color:#fff;border-radius:10px">' . $text[$livraison->Status] . '</button></div></span>';
              } else {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait) . ' Ar </b> <div class="modify"><button class="btn btn-sm btn-dark disabled text-center "  id="' . trim($reponse->Message) . '" style="margin-left:350px;color:#000;border-radius:10px ">' . $text[$livraison->Status] . '</b></button></div></span>';
              }
              $json['content'] .= '<br><span><b>' . $livraison->Matricule_personnel . '</span>';
              $json['content'] .= '<br><span><b>' . $livraison->Code_client . '</span>';
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#e6ee9c;padding:10px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a"><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div> </div></div>';
            
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
            $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><br><span style="font-size:10px;">'.$this->session->userdata('matricule').'</span><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
          }
        } else if ($reponse->sender == 'CLT') {
          if ($reponse->Type == 'image') {
            $json['content'] .= '<div class="form-control" style="background:#b2ebf2;min-height:140px;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word;"><img  src="'.base_url("/images/pieceJoint/$reponse->Message.jpg").'" alt="' . $reponse->Message . '" class="img-thumbnail" style="width:120px;height:120px;object-fit:cover"></div>';
          } else {
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#b2ebf2  ;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
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

  public function getIdDiscussionSiExiste($client, $idPage, $operatrice = null)
  {
    $this->load->model('Discussion_model');
    $id = $this->Discussion_model->getIdDiscussionSiExiste($client, $idPage, $operatrice);
    return $id;
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
              'operatrice'=>$operatrice, 
              'client'=> $client, 
              'idaction'=>$id_discussion,
              'date'=>date('Y-m-d'), 
              'heure'=>date('H:i:s'), 
              'page'=> $this->input->post('page'),
              'action'=> $this->input->post('Type'),
              'sender'=>$this->input->post('sender'),
              'types'=>$this->input->post('types'),
              'tache'=>$this->input->post('tache')
        ];
          $this->global_model->inserthistorique_discussion_session($insertSession);

    $this->global_model->insertMessageSimples($this->input->post('message'), $this->input->post('Type'), $this->input->post('sender'), $id_discussion,$this->input->post('idRep'), $this->input->post('page'),$this->input->post('date'),$this->input->post('heure'),$this->input->post('types'));
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
            $json['content'] .= '<div style="background:#b2ebf2;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; "><img src="'.base_url("/images/pieceJoint/$reponse->Message.jpg").'" alt="' . $reponse->Message . '" width="100" height="100"></div>';
          }else if($reponse->Type=='rendez-vous'){
            $dataRvd = $this->global_model->selectRendeVous(["date"=>$reponse->date,"heure"=>$reponse->heures,"codeclient"=>$client,"page"=>$reponse->Page]);
            if($dataRvd){
              $pagess=  $this->global_model->comptefbDetail(['id'=>$dataRvd->page]);
              $json['content'] .='<div style="background:#F8BBD0;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"> Rendez-vous le '.$dataRvd->date.' à '.$dataRvd->heure.' sur la page '.$pagess->Nom_page.'</div>';
            }else{
              $json['content'] .='<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><br><span style="font-size:10px;">'.$this->session->userdata('matricule').'</span><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
            }
         
          } else if (trim($reponse->Type) == 'vente') {
            $total = 0;
            $remise = "";
            $detail = $this->calendrier_model->detail_commande_facture_discussion(trim($reponse->Message));
            if($detail){
            $livraison = $this->calendrier_model->detail_facture_discussion(trim($reponse->Message));
             $totalsmilekoty = $this->global_model->gettotalsmileskotys($client);
              foreach ($totalsmilekoty as $value) {
                $smilesT = $value->smiles;
                $kotyT = $value->koty;
                $totatsmilekotyFinal=  $kotyT ." Koty ";
              }
            $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;;text-align:left; font-size:12px!important"><div style="padding:5px 10px;white-space: break-spaces;"> Raha fintinina izany ny commande nao dia : <br> Vokatra : ';
            foreach ($detail as $key => $detail) {
              $json['content'] .= substr($detail->Designation, 0, 60) . '<br> Miisa : ' . $detail->Quantite . '<br> Vidiny : ' . number_format($detail->Prix_detail) . ' Ar<br> Koty : ' . $detail->Smile_LV1;
              $remise .= $detail->Designation . " : " . $detail->Smile_LV1 . " Smiles |" . $detail->Zen_LV1 . " Koty<br>";
              $total += ($detail->Quantite * $detail->Prix_detail);
            }
              $json['content'] .= '<br><span><b> Localité : ' . $livraison->Localite . '</span>';
              $json['content'] .= '<br>Quartier:' . $livraison->Quartier . "&nbsp; &nbsp;<br>Commune:" . $livraison->Ville . '<br> Toerana : ' . $livraison->lieu_de_livraison . '<br> Contact 1 : ' . $livraison->contacts . '<br> Contact 2 : ' . $livraison->Contact_livraison . '<br>Date de livraison : ' . $livraison->date_de_livraison . " " . '<br>Frais de livraison : ' . number_format($livraison->frais) . ' Ar' .'<br> Frais de Retrait : ' . $livraison->frais_de_retrait . ' Ar'. " " . $livraison->heure_deb_livre . $livraison->heure_fi_livre . '';
              if ($livraison->Status == 'livre') {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait) . ' Ar <div class="modify"><button id="' . trim($reponse->Message) . '" class="btn btn-sm btn-success disabled text-center modify btn-sm" style="margin-left:350px;color:#fff;border-radius:10px"><b>' . $text[$livraison->Status] . '</button></div></span>';
              } else if ($livraison->Status == 'annule') {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait) . ' Ar <div class="modify"><button class="btn btn-sm btn-danger disabled text-center btn-sm"  id="' . trim($reponse->Message) . '" style="margin-left:350px;color:#fff;border-radius:10px">' . $text[$livraison->Status] . '</button></div></span>';
              } else {
                if( $livraison->frais_de_retrait==''){
                  $fraisRetrait = 0;
                }else{
                  $fraisRetrait= $livraison->frais_de_retrait;
                }
                $json['content'] .= '<br><span><b> Total  à payer : ' . number_format($total + $livraison->frais + $fraisRetrait) . ' Ar </b> <div class="modify"><button class="btn btn-sm btn-dark disabled text-center "  id="' . trim($reponse->Message) . '" style="margin-left:350px;color:#000;border-radius:10px ">' . $text[$livraison->Status] . '</b></button></div></span>';
              }
              $json['content'] .= '<br><span><b>' . $livraison->Matricule_personnel . '</span>';
              $json['content'] .= '<br><span><b>' . $livraison->Code_client . '</span>';
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a"><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div></div></div>';
            
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
            $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><br><span style="font-size:10px;">'.$this->session->userdata('matricule').'</span><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
          }
        } else if ($reponse->sender == 'CLT') {
          if ($reponse->Type == 'image') {
            $json['content'] .= '<div class="form-control" style="background:#b2ebf2;padding:5px 5px;min-height:130px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word;"><img src="'.base_url("/images/pieceJoint/$reponse->Message.jpg").'" alt="' . $reponse->Message . '" style="height:120px;width:120px;object-fit:cover" ></div>';
          } else {
            $vardata = $this->global_model->retour_page($reponse->Page);
            $page = "";
            if ($vardata) {
              $page = $reponse->Page;
            }
            $json['content'] .= '<div style="background:#b2ebf2;padding:10px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word;"><p class="a" >' . $reponse->Message . '<br><br><span style="font-size:10px;">'.$this->session->userdata('matricule').'</span><br><span class="pull-right" style="color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp; <i class="fa fa-clock-o"></i>' . $reponse->heure . '</span></p></div>';
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
                 'operatrice'=>$operatrice, 
                 'client'=> $client, 
                 'idaction'=>$id_discussion,
                 'date'=>date('Y-m-d'), 
                 'heure'=>date('H:i:s'), 
                 'page'=>  $page,
                 'action'=>$TypeMessage,
                 'sender'=>"OPL",
                 'types'=>$tache,
                 'tache'=>$taches,
              
           ];
      $this->global_model->inserthistorique_discussion_session($insertSession);
      $this->global_model->insertRendeVous(['date'=>$this->input->post('daterdv'),"heure"=>$this->input->post('heurervd'),"contact"=>$this->input->post('contactRvd'),"codeclient"=>$this->input->post('codeclient'),'status'=>'on','operatrice'=>$this->session->userdata('matricule'),'page'=>$page,'produit'=> $obs]);
      $this->global_model->insertMessageSimples('rendez-vous',"rendez-vous","OPL", $id_discussion, $TypeMessage,$page,$this->input->post('daterdv'),$this->input->post('heurervd'),$TypeMessage);
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
               $json['content'] .= '<div style="background:#e6ee9c;padding:5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word; margin-left:90px"><img class="img-thumbnail" src="'.base_url("/images/pieceJoint/$reponse->Message.jpg").'" alt="' . $reponse->Message . '" width="100" height="100"></div>';
               $json['content'] .= 'test';
               }else if($reponse->Type='rendez-vous'){
                      $dataRvd = $this->global_model->selectRendeVous(["date"=>$reponse->date,"heure"=>$reponse->heures,"codeclient"=>$client,"page"=>$reponse->Page]);
                      if($dataRvd){
                        $pagess=  $this->global_model->comptefbDetail(['id'=>$dataRvd->page]);
                        $json['content'] .='<div style="background:#F8BBD0;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"> Rendez-vous le '.$dataRvd->date.' à '.$dataRvd->heure.' sur la page '.$pagess->Nom_page.'</div>';
                      }else{
                        $json['content'] .="<div></div>";
                      }
                     
              } else if (trim($reponse->Type) == 'vente') {
               $total = 0;
               $remise = "";
               $detail = $this->calendrier_model->detail_commande_facture_discussion(trim($reponse->Message));
               if( $detail){
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
               $json['content'] .= '<div style="background:#e6ee9c;padding:2px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a"><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
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
               $json['content'] .= '<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;"><p class="a">' . $reponse->Message . '<br><br><span style="font-size:10px;">'.$this->session->userdata('matricule').'</span><br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
             }
           } else if ($reponse->sender == 'CLT') {
             if ($reponse->Type == 'image') {
               $json['content'] .= '<div class="form-control" style="background:#b2ebf2;min-height:140px;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-word;"><img  src="'.base_url("/images/pieceJoint/$reponse->Message.jpg").'" alt="' . $reponse->Message . '" class="img-thumbnail" style="width:120px;height:120px;object-fit:cover"></div>';
             } else {
               $vardata = $this->global_model->retour_page($reponse->Page);
               $page = "";
               if ($vardata) {
                 $page = $reponse->Page;
               }
               $json['content'] .= '<div style="background:#b2ebf2  ;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;"><p class="a">' . $reponse->Message . '<br><span class="pull-right" style=";color:black; padding:2px 2px;border-radius:5px;font-size:10px;font-weight:bold;margin-top:5px;">' . $page . '&nbsp;&nbsp;<i class="fa fa-clock-o"></i>' . $heure[1] . '</span></p></div>';
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
    public function Etat_carte_a_gratter(){
        $this->load->model('global_model');
        $data['total_chapeau_1'] = $this->global_model->Retourner_lot_chapeau('level 1');
        $data['total_chapeau_2'] = $this->global_model->Retourner_lot_chapeau('level 2');
        $data['total_chapeau_3'] = $this->global_model->Retourner_lot_chapeau('level 3');
        $data['total_chapeau_4'] = $this->global_model->Retourner_lot_chapeau('level 4');
        $data['total_chapeau_5'] = $this->global_model->Retourner_lot_chapeau('level 5');
        $data['total_chapeau_1_tirer'] = $this->global_model->Retourner_lot_chapeau_tirer('level 1');
        $data['total_chapeau_2_tirer'] = $this->global_model->Retourner_lot_chapeau_tirer('level 2');
        $data['total_chapeau_3_tirer'] = $this->global_model->Retourner_lot_chapeau_tirer('level 3');
        $data['total_chapeau_4_tirer'] = $this->global_model->Retourner_lot_chapeau_tirer('level 4');
        $data['total_chapeau_5_tirer'] = $this->global_model->Retourner_lot_chapeau_tirer('level 5');
        $data['liste_lot_1'] = $this->global_model->Retourner_liste_lot('level 1');

        $this->render_view('Tsena_koty/carteGratee/etat_carte',$data);
    }


    public function Chapeau(){
    $chapeau = $this->input->post('chapeau');
     $table_head_bg ="";
    if($chapeau == "level 1"){
      $table_head_bg = "#007bff";
    }elseif ($chapeau == "level 2") {
      $table_head_bg = "#28a745";
    }elseif ($chapeau == "level 3") {
      $table_head_bg = "#ffc107";
    }elseif ($chapeau == "level 4") {
      $table_head_bg = "#dc3545";
    }elseif ($chapeau == "level 5") {
      $table_head_bg = "#9933CC";
    }else{
       $table_head_bg == "";
    }
    $data['chapeau'] =$chapeau;
    $data['bg_head'] = $table_head_bg;
    $data['liste_lot'] = $this->global_model->Retourner_liste_lot($chapeau);
    $this->load->view("Tsena_koty/carteGratee/liste_chapeau",$data); 
  }

}
