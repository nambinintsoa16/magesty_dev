<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrateur extends My_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Administrateur_model');
  }

  public function Modifier()
  {
    $this->render_view("administrateur/vente/ModififVente");
  }
  public function Bon_d_achat(){
    $this->render_view("administrateur/vente/Bon_d_achat");
  }
  public function Parametre_des_bon_d_achat(){
    $this->render_view("administrateur/vente/parametreBon");
  }
  public function detail_Modifier_Vente()
  {
    $idfacture = $this->input->post('idfacture');
    $this->load->model('calendrier_model');
    $this->load->model('administrateur_model');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'facture' => $this->administrateur_model->getInfoFacture(['id'=>$idfacture])
    ];

    return $this->load->view('administrateur/vente/deTailModif', $data);
  }

  public function updateClientFacture(){
    $this->load->model('administrateur_model');
    $facture = $this->input->post('facture');
    $codeClient = $this->input->post('codeClient');
    echo $this->administrateur_model->update_facture(['id'=>$facture],['Code_client'=>$codeClient]);
  }

  public function updateRemarqueFacture(){
    $this->load->model('administrateur_model');
    $facture = $this->input->post('facture');
    $remarque = $this->input->post('remarque');
    echo $this->administrateur_model->update_facture(['id'=>$facture],['remarque'=>$remarque]);
  }

  public function updatePageFacture(){
    $this->load->model('administrateur_model');
    $facture = $this->input->post('facture');
    $page = $this->input->post('page');
    echo $this->administrateur_model->update_facture(['id'=>$facture],['Page'=>$page]);

  }

  public function updateOplFacture(){
    $this->load->model('administrateur_model');
    $facture = $this->input->post('facture');
    $opl = $this->input->post('opl');
    echo $this->administrateur_model->update_facture(['id'=>$facture],['Matricule_personnel'=>$opl]);
  }

  public function modifQuartier(){

     $this->load->model('calendrier_model');
     $quartier =$this->input->post('quartier');
     $ville = $this->input->post('ville');
     $District = $this->input->post('District');
     $id = $this->input->post('id');

    $data = [
      'Quartier' => $quartier,
      'Ville'=>$ville,
      'District'=>$District
    ];
    
    echo json_encode($this->calendrier_model->updateFacture($id, $data));

  }

  public function modifVenteStatut()
  {
    $this->load->model('calendrier_model');
    $data = [
      'Status' => $this->input->post('statut')
    ];
    $id = $this->input->post('idfacture');
    echo json_encode($this->calendrier_model->updateFacture($id, $data));
  }

  public function modif_date(){
    $this->load->model('calendrier_model');
    $date = $this->input->post('date');
    $data = [
      'date_de_livraison' => $date
    ];
    $id = $this->input->post('idLivraison');
    echo json_encode($this->calendrier_model->updateLivre(['id'=>$id], $data));
  }
  public function modifVenteDelete()
  {
    $this->load->model('calendrier_model');
    echo json_encode($this->calendrier_model->DeleleDetail($this->input->post('idVente')));
  }
  public function update_contact(){
    $this->load->model('calendrier_model');
    $facture = $this->input->post('facture');
    $contact =$this->input->post('contact');
    echo $this->calendrier_model->updateFacture($facture,["contacts"=>$contact]);

  }
  public function modifVenteProduit()
  {
    $this->load->model('calendrier_model');
    $this->load->model('administrateur_model');
    $produit = $this->input->post('produit');
    $localite =$this->input->post('localite');


     $datas = $this->administrateur_model->getPrix(['Statut'=>'on','Localite'=>$localite,"Code_produit"=>$produit]);
    $datas = $this->calendrier_model->retourIdPrix($this->input->post('produit'));
    if ($datas) {
      $data = [
        'Id_prix' => $datas->Id
      ];

      $id = $this->input->post('idVente');
      echo json_encode($this->calendrier_model->updateDEtailVente($id, $data));
    }
  }
  public function modifVentePadd()
  {
    $this->load->model('calendrier_model');
    $this->load->model('administrateur_model');
     $prodit = $this->input->post('produit');
     $localite = $this->input->post('localite');
     $idfacture = $this->input->post('idfacture');
     $quartier = $this->input->post('quantite');
     $datas = $this->administrateur_model->getPrix(['Statut'=>'on','Localite'=>$localite,"Code_produit"=>$prodit]);
    if ($datas) {
      $data = [
        'Facture' => $idfacture,
        'Id_prix' => $datas->Id,
        'Quantite' => $quartier,
        'Type_de_prix' => 'detail',
        'Tip' => 0,
        'statut' => 'principale',
        'Id_prix' => $datas->Id,
      ];
      $id = $this->input->post('idVente');
      echo json_encode($this->calendrier_model->InsertDEtailVente($data));
    }
  }
  public function modifVenteQuantite()
  {
    $this->load->model('calendrier_model');
    $data = [
      'Quantite' => $this->input->post('Quantite')
    ];
    $id = $this->input->post('idVente');
    echo json_encode($this->calendrier_model->updateDEtailVente($id, $data));
  }

  public function Liste()
  {
    $this->render_view('administrateur/Accueil/Accueil');
  }
  public function modifVenteStatutKoty()
  {
    $id = $this->input->post('idfacture');
    $data = [
      'Id_de_la_mission' => $this->input->post('statut')
    ];
    echo $this->calendrier_model->updateFacture($id, $data);
  }

  public function modifFrais()
  {
    $id = $this->input->post('idLivraison');
    $data = [
      'frais' => $this->input->post('frais')
    ];
    echo $this->calendrier_model->updateLivre(['id' => $id], $data);
  }


  public function modifFraisLivre()
  {
    $id = $this->input->post('idLivraison');
    $data = [
      'frais_de_retrait' => $this->input->post('frais')
    ];
    echo $this->calendrier_model->updateLivre(['id' => $id], $data);
  }

  public function Tsena_Koty()
  {

    $bonus = $this->Administrateur_model->selectAllBonus(['statut' => 'on']);
    $data = [
      'bonus' => $bonus
    ];

    $this->render_view('administrateur/Tsena_Koty/Tsena_Koty', $data);
  }
  public function Ajout_Bonus()
  {
    $codeClient = $this->input->POST('client');
    $reponse = $this->Administrateur_model->selectCompteKoty($codeClient);
    if ($reponse) {
      $koty = $this->input->POST('koty');
      $totalKoty = $koty + $reponse->Koty;
      $data = ["Koty" => $totalKoty];
      $this->Administrateur_model->updateCompteKoty(["Client" => $codeClient], $data);

      $donner = [
        "Client" => $codeClient,
        "Date" => date('Y-m-d'),
        "Type" => $this->input->POST('type'),
        "Koty" => $this->input->POST('koty'),
        "Raison" => $this->input->POST('raison'),
        "Observation" => $this->input->POST('observation')
      ];
      $this->Administrateur_model->Ajout_Mouvement($donner);
    } else {
      $data = [
        "Client" => $codeClient,
        "Koty" => $this->input->POST('koty'),
        "Date" => date('Y-m-d'),
        "Statut" => "on",
        "Date_validation" => date('Y-m-d'),
        "Date_expiration" => $this->input->POST('date_expir')
      ];
      $this->Administrateur_model->Ajout_Bonus($data);
      $donner = [
        "Client" => $codeClient,
        "Date" => date('Y-m-d'),
        "Type" => $this->input->POST('type'),
        "Koty" => $this->input->POST('koty'),
        "Raison" => $this->input->POST('raison'),
        "Observation" => $this->input->POST('observation')
      ];
      $this->Administrateur_model->Ajout_Mouvement($donner);
    }
  }

  public function Afficher_client()
  {
    $client1 = $this->input->post('client1');
    $date_expir1 = $this->input->post('date_expir1');
    $this->load->model('Administrateur_model');
    $data = ['data' => $this->Administrateur_model->Afficher_client($client1, $date_expir1)];
    $this->load->view('administrateur/Tsena_Koty/Transaction_koty', $data);
  }

  public function Transaction_koty()
  {
    $this->render_view('administrateur/Tsena_Koty/Transaction_koty');
  }
  public function Delete_transaction($id)
  {
    $movement = $this->Administrateur_model->selectKoty(["Id" => $id]);
    if ($movement) {
      $compte = $this->Administrateur_model->selectCompte(['Client' => $movement->Client]);
      if ($compte) {
        if (strtoupper($movement->Type) == "ACHAT") {
          $newkoty = $compte->Koty +  $movement->Koty;
          if ($this->Administrateur_model->updateCompteKoty(["Client" => $movement->Client], ["Koty" => $newkoty])) {
            return $this->Administrateur_model->Delete_transaction($id);
          }
        } else if (strtoupper($movement->Type) == "GAIN") {
          $newkoty = $compte->Koty -  $movement->Koty;
          if ($this->Administrateur_model->updateCompteKoty(["Client" => $movement->Client], ["Koty" => $newkoty])) {
            return $this->Administrateur_model->Delete_transaction($id);
          }
        }
      }
    }
  }
  public function Delete_movementSmile($id)
  {
    $movement = $this->Administrateur_model->selectSmile(["id" => $id]);
    if ($movement) {
      $code_client = $this->Administrateur_model->selectCodeclient(["Code_client" => $movement->Code_client]);
      if ($code_client) {
        $newsmile = $movement->smile - $code_client->smile;
        if ($this->Administrateur_model->update_Mouvement_smile(["Code_client" => $movement->code_client], ["smile" => $newsmile])) {
          return $this->Administrateur_model->Delete_movementSmile($id);
        }
      }
    }
  }
  public function Modif_transaction($id)
  {
    $data = ["data" => $this->Administrateur_model->Modif_transaction(["Id" => $id])];
    $this->render_view('administrateur/Tsena_Koty/Modif_transactionView', $data);
  }
  public function autocomplete_id_facture(){
     $this->load->model('administrateur_model');
       $id = $this->input->get('term');
       $reponse =$this->administrateur_model->get_result_Facture("Id like '%$id%'");
       $array = array();
      foreach ($reponse as $reponse) {
        array_push($array, $reponse->Id );
      }
    echo json_encode($array);
  }
  public function RecupTransaction()
  {
    return $this->Administrateur_model->Transaction_Koty();
  }
  public function Info_transaction($id)
  {
    $data = ["data" => $this->Administrateur_model->Info_transaction($id)];
    echo json_encode($data);
  }

  public function autocomplete_prodact()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_all_codeproduit($term) as $reponse) {
      array_push($array, $reponse->Code_produit . "| " . $reponse->Designation);
    }
    echo json_encode($array);
  }

  public function autocomplete_operatrice()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_personnel($term) as $reponse) {
      array_push($array, $reponse->Matricule . " | " . $reponse->Nom . " " . $reponse->Prenom);
    }
    echo json_encode($array);
  }


public function autocomplete_operatrice_init_pass()
  {
    $this->load->model('global_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->global_model->autocomplete_personnel($term) as $reponse) {
      array_push($array,$reponse->Matricule . " | " . $reponse->Nom . " " . $reponse->Prenom." | ".$reponse->Mode_de_pass_login);
    }
    echo json_encode($array);
  }

  public function autocomplete_client()
  {
    $this->load->model('client_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->client_model->autocomplete_client($term) as $reponse) {
      array_push($array, $reponse->Code_client . " | " . $reponse->Compte_facebook);
    }
    echo json_encode($array);
  }

    public function autocomplete_publication()
  {
    $this->load->model('administrateur_model');
    $term = $this->input->get('term');
    $array = array();
    $reponse = $this->administrateur_model->get_result_publication("nom_produit like '%$term%'");
    foreach ($reponse as $reponse) {
      array_push($array, $reponse->id." | ".$reponse->codeproduit . " | " . $reponse->nom_produit);
    }
    echo json_encode($array);
  }

  public function autoCompletePersonnel()
  {
    $this->load->model('personnel_model');
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->personnel_model->autoCompletePersonnel($term) as $reponse) {
      array_push($array, $reponse->Matricule . " | " . $reponse->Nom . " " . $reponse->Prenom);
    }
    echo json_encode($array);
  }


  public function listeDesTransaction()
  {
    if (!empty($_GET['client']) and !empty($_GET['date'])) {
      $datas = $this->Administrateur_model->Transaction_Koty(["Client" => $_GET['client'], "Date" => $_GET['date']]);
    } else if (!empty($_GET['client'])) {
      $datas = $this->Administrateur_model->Transaction_Koty(["Client" => $_GET['client']]);
    } else if (!empty($_GET['date'])) {
      $datas = $this->Administrateur_model->Transaction_Koty(["Date" => $_GET['date']]);
    } else {
      $datas = $this->Administrateur_model->Transaction_Koty("Date like '" . date('Y-m') . "%'");
    }
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->Date;
      $sub_array[] = $row->Client;
      $sub_array[] = $row->Type;
      $sub_array[] = $row->Koty;
      $sub_array[] = $row->Raison;
      $sub_array[] = $row->facture;
      $sub_array[] = $row->Observation;
      $sub_array[] = '<a href="' . base_url("Administrateur/Delete_transaction/" . $row->Id) . '" class="btn btn-danger btn-sm w-50 delete"><i class="fa fa-trash"></i>&nbsp;</a><a href="' . base_url("Administrateur/Info_transaction/" . $row->facture) . '" class="btn btn-info btn-sm w-50 info_Transaction"><i class="fa fa-info-circle"></i>&nbsp;</a>';
      $data[] = $sub_array;
    }
    $output = array("data" => $data);
    echo json_encode($output);
  }

  public function mouvementSmileListe()
  {
    $this->render_view('administrateur/Smile/Mouvement_smile');
  }
  public function nouveau_promotion()
  {
    $this->render_view('administrateur/Promotion/nouveau');
  }

  public function Mouvement_smile()
  {
    if (!empty($_GET['client']) and !empty($_GET['date'])) {
      $data = $this->Administrateur_model->Mouvement_smile(["Code_client" => $_GET['client'], "date" => $_GET['date']]);
    } else if (!empty($_GET['client'])) {
      $data = $this->Administrateur_model->Mouvement_smile(["Code_client" => $_GET['client']]);
    } else if (!empty($_GET['date'])) {
      $data = $this->Administrateur_model->Mouvement_smile(["date" => $_GET['date']]);
    } else {
      $data = $this->Administrateur_model->Mouvement_smile("date like '" . date('Y-m') . "%'");
    }
    $datas = array();
    foreach ($data as $row) {
      $sub_array = array();
      $sub_array[] = $row->date;
      $sub_array[] = $row->Code_client;
      $sub_array[] = $row->smile;
      $sub_array[] = $row->statut;
      $sub_array[] = '<a href="' . base_url("Administrateur/Delete_movementSmile/" . $row->id) . '" class="btn btn-danger btn-sm w-100 deleteSmile"><i class="fa fa-trash"></i>&nbsp;Supprimer</a>';
      $datas[] = $sub_array;
    }
    $output = array("data" => $datas);
    echo json_encode($output);
  }
  public function listeBonDAchat(){
    $this->load->model('Global_model');
    $data = $this->global_model->bon_achat();
    $datas = array();
    foreach ($data as $row) {
      $sub_array = array();
      $sub_array[] = $row->IDBON;
      $sub_array[] = $row->CODE_CLIENT;
      $sub_array[] = $row->DATEDECREATION;
      $sub_array[] = $row->LASTUPDATE;
      $sub_array[] = $row->DESIGNATION;
      $sub_array[] = $row->VALEUR;
      $sub_array[] = $row->STATUT;
      $sub_array[] = $row->DATEDEDESACTIVATION;
      $datas[] = $sub_array;
    }
    $output = array("data" => $datas);
    echo json_encode($output);

  }

  public function listeBonDAchatParametre(){
    $this->load->model('Global_model');
    $data = $this->global_model->bon_achat_parametre();
    $datas = array();
    foreach ($data as $row) {
      $sub_array = array();
      $sub_array[] = $row->IDBON;
      $sub_array[] = $row->DATEDECREATION;
      $sub_array[] = $row->LASTUPDATE;
      $sub_array[] = $row->DESIGNATION;
      $sub_array[] = $row->VALEUR;
      $sub_array[] = $row->VALEUR_LETTRE;
      $sub_array[] = $row->STATUT;
      $sub_array[] = $row->DATEDEDESACTIVATION;
      $sub_array[] = '<a href="' . base_url("Administrateur/desactiveBonParametre/" . $row->IDBON) . '" class="btn btn-danger btn-sm w-100 desact"><i class="fa fa-times"></i>&nbsp;Désactiver</a>';
      $datas[] = $sub_array;
    }
    $output = array("data" => $datas);
    echo json_encode($output);

  }
  public function desactiveBon($ibon){
    $this->load->model('Global_model');
    echo $this->global_model->update_bon_achat(['IDBON'=>$ibon],["STATUT"=>"inactif"]);
  }
  public function desactiveBonParametre($ibon){
    $this->load->model('Global_model');
    echo $this->global_model->update_bon_D_Achat_Parametre(['IDBON'=>$ibon],["STATUT"=>"inactif"]);
  }
  
  public function saveBon(){
    $this->load->model('Global_model');
    $designation = $this->input->post('designation');
    $valeur = $this->input->post('valeur');
    echo $this->global_model->insert_bon_achat([
          "DATEDECREATION"=>date('Y-m-d'),
          "DESIGNATION"=>$designation,
          "VALEUR"=>$valeur,
          "STATUT"=>"actif"
    ]);
    
  }

  public function saveBonParametre(){
    $this->load->model('Global_model');
    $designation = $this->input->post('designation');
    $valeur = $this->input->post('valeur');
    $lettre = $this->input->post('lettre');
    echo $this->global_model->insert_bon_achat_parametre
      ([
          "DATEDECREATION"=>date('Y-m-d'),
          "DESIGNATION"=>$designation,
          "VALEUR"=>$valeur,
          "STATUT"=>"actif",
          "VALEUR_LETTRE"=>$lettre
    ]);
    
  }
  
  public function save_new_compte(){

    $this->load->model('Administrateur_model');
      $nomPage =  $this->input->post('nomPage');
      $lienPage = $this->input->post('lienPage');
      $typeCompte =  $this->input->post('typeCompte');
      $source =  $this->input->post('source');
      $date_activation = $this->input->post('date_activation');

      $data = [
        "Nom_page"=>$nomPage,
        "Lien_page"=>$lienPage,
        "statut"=>"on", 
        "date_activation"=>$date_activation, 
        "Type"=>$typeCompte,
        "Source"=>$source 
      ];
      echo $this->Administrateur_model->saveNewCompte($data);

  }

  public function getBonActif(){
    $this->load->model('Global_model');
    $reponse = $this->global_model->select_bon_achat_parametre(["STATUT"=>"actif"]);
    $donne=[
      "designationBon"=>$reponse->DESIGNATION,
      "valeur"=>$reponse->VALEUR,
      "lettre"=>$reponse->VALEUR_LETTRE
    ];
    echo json_encode($donne);
   }
  public function Smile()
  {
    $this->render_view('administrateur/Smile/Smile');
  }
  public function insertSmile()
  {
    $donner = [
      "Code_client" => $this->input->POST('code_client'),
      "smile" => $this->input->POST('smile'),
      "type" => $this->input->POST('type'),
      "raison" => $this->input->POST('raison'),
      "date_validation" => date('Y-m-d'),
      "date_expiration" => $this->input->POST('date_expir'),
      "statut" => "on",
      "date" => date('Y-m-d'),
      "observation" => $this->input->POST('observation'),
      "level" => $this->input->POST('level')
    ];
    $this->Administrateur_model->insertSmileModel($donner);
  }

  public function insertNewPromotion()
  {

    $data = [
      "Pr_Date_Debut" => $this->input->POST('dateDebut'),
      "Pr_Date_Fin" => $this->input->POST('dateFin'),
      "Pr_Code_Promo" => $this->input->POST('codePromotion'),
      "Pr_Type_Protion" => $this->input->POST('typePromotion'),
      "Pr_Cadeaux" => $this->input->POST('cadeaux'),
      "Pr_Prix_Koty" => $this->input->POST('prixKoty'),
      "Pr_Montant" => $this->input->POST('montant'),
      "Pr_Produit" => $this->input->POST('produit'),
      "Pr_Status" => "En cours",
      "Pr_Description" => $this->input->POST('description'),
    ];
    $this->Administrateur_model->isertNewPromotionModel($data);
  }

  public function Mes_Promotion()
  {
    $this->render_view('administrateur/Promotion/Mes_promotion');
  }
  public function listeDesPromotion()
  {

    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    if (!empty($debut) && !empty($fin)) {
      $param = [
        "Pr_Date_Debut" =>  $debut,
        "Pr_Date_Fin" => $fin,
      ];
      $data = $this->Administrateur_model->affichageListePromotion($param);
    } else if (!empty($debut)) {
      $param = [
        "Pr_Date_Debut" => $debut,
      ];
      $data = $this->Administrateur_model->affichageListePromotion($param);
    } else if (!empty($fin)) {
      $param = [
        "Pr_Date_Fin" => $fin,
      ];
      $data = $this->Administrateur_model->affichageListePromotion($param);
    } else {
      $data = $this->Administrateur_model->affichageListePromotion();
    }

    $datas = array();
    foreach ($data as $row) {
      $sub_array = array();
      $sub_array[] = $row->Pr_Date_Debut;
      $sub_array[] = $row->Pr_Code_Promo;
      $sub_array[] = $row->Pr_Type_Protion;
      $sub_array[] = $row->Pr_Cadeaux;
      $sub_array[] = $row->Pr_Prix_Koty;
      $sub_array[] = $row->Pr_Montant;
      $sub_array[] = $row->Pr_Produit;
      $sub_array[] = $row->Pr_Status;
      $sub_array[] = '<a href="#"  id ="' . $row->Pr_Id . '" class="btn btn-danger btn-sm w-100 deletePromotion"><i class="fa fa-trash"></i>&nbsp;Supprimer</a>';
      $datas[] = $sub_array;
    }
    $output = array("data" => $datas);
    echo json_encode($output);
  }
  public function deletePromotion()
  {
    $Pr_Id = $this->input->post('Pr_Id');
    $data = [
      "Pr_Id" => $Pr_Id
    ];
    return $this->Administrateur_model->deletePromotion($data);
  }
  public function detailVenteTombola()
  {
    $this->load->model('client_model');
    $data = [
      'data' => $this->client_model->vente_clientel(["facture.Id_facture" => $this->input->post('facture')]),
      'facture' => $this->client_model->selectFactureClient(["Id_facture" => $this->input->post('facture')])

    ];

    $this->load->view('administrateur/Jeux/Tombola/tableauDetailFacture', $data);
  }
  public function dataparametre()
  {
    $this->load->model('administrateur_model');
    $datas = $this->administrateur_model->selectsParametreTombola();
    $data = array();
    foreach ($datas as $row) {
      $sub_array = [];
      $sub_array[] =  $row->IdParameter;
      $sub_array[] =  $row->Designation;
      $sub_array[] =  $row->DateActivation;
      $sub_array[] = $row->Produit;
      $sub_array[] = $row->Montant;
      $sub_array[] = $row->StatutParametre;
      $sub_array[] = $row->DateActivation;
      $sub_array[] = "<a href='#' id ='$row->IdParameter' class='btn btn-warning modifParamtreTombola btn-sm p-2'><i class='fa fa-edit'></i></a>&nbsp;<a href='#' id ='$row->IdParameter' class='btn btn-danger supprimerParameterTombola btn-sm p-2'><i class='flaticon-interface-5'></i></a>
      &nbsp;<a href='#' id ='$row->IdParameter' class='btn btn-success TerminerParameterTombola btn-sm p-2'><i class='fa fa-check'></a>";

      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function DeleteDataparametre()
  {
    $this->load->model('administrateur_model');
    $id = $this->input->post('id');
    return  $this->administrateur_model->deleteparametreTombola(['IdParameter' => $id]);
  }
  public function ModifierPrametreTombola()
  {
    $this->load->model('Administrateur_model');
    $produit = $this->input->post('produit');
    $Montant = $this->input->post('Montant');
    $Designation = $this->input->post('Designation');
    $id = $this->input->post('id');
    echo  $this->Administrateur_model->updateparametreTombolas([
      "Produit" => $produit,
      "Montant" => $Montant,
      "Designation" => $Designation

    ], ["IdParameter" => $id]);
  }

  public function dataTombola()
  {
    $datas = $this->global_model->selectsTombola();
    $data = array();
    foreach ($datas as $row) {
      $sub_array = [];
      $numero = $row->id_Tombola;
      while (strlen($numero) < 5) {
        $numero = "0" . $numero;
      }
      $sub_array[] =  $numero;
      $sub_array[] = $row->facture;
      $sub_array[] = $row->codeClient;
      $sub_array[] = $row->Compte_facebook;
      $sub_array[] = $row->Contact;
      $sub_array[] = "<a href='#' class='btn btn-info detail btn-sm'>Détail</a>";

      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function ListeDesParametreTombola()
  {
    $this->render_view('administrateur/Jeux/Tombola/listeParametre');
  }
  public function ResultatTombola()
  {
    $this->render_view('administrateur/Jeux/Tombola/ResultatTombola');
  }
  public function NouveauTombola()
  {
    $this->render_view('administrateur/Jeux/Tombola/nouveauParametre');
  }
  public function enregistrePrametreTombola()
  {
    $this->load->model('Administrateur_model');
    $produit = $this->input->post('produit');
    $Montant = $this->input->post('Montant');
    $Designation = $this->input->post('Designation');
    echo  $this->Administrateur_model->insertparametreTombola([
      "Produit" => $produit,
      "StatutParametre" => "enCours",
      "Montant" => $Montant,
      "Designation" => $Designation,
      "DateActivation" => date('Y-m-d')

    ]);
  }
  public function TeminerPrametreTombola()
  {
    $this->load->model('Administrateur_model');
    $id = $this->input->post('id');
    return   $this->Administrateur_model->updateparametreTombolas([
      "DateDesactivation" => date('Y-m-d'),
      "StatutParametre" => "Terminer"
    ], ["IdParameter" => $id]);
  }
  public function Gerer_page()
  {
    $this->render_view('administrateur/Gestion_pages/Gerer_page');
  }
  public function Rattacher_page()
  {
    $this->render_view('administrateur/Gestion_pages/Rattacher_page');
  }

  public function Rattacher_page_save()
  {
    $this->load->model('Administrateur_model');
    if (!empty($_POST['Matricule']) && !empty($_POST['Operatrice']) && !empty($_POST['nomPage']) && !empty($_POST['lienPage']) && !empty($_POST['datedactivation'])) {
      $matricule = $_POST['Matricule'];
      $nomOperatrice = $_POST['Operatrice'];
      $nomPage = $_POST['nomPage'];
      $lienPage = $_POST['lienPage'];
      $datedactivation = $_POST['datedactivation'];
      echo 'ok';
    } else {
      echo 'mety';
    }
  }

  public function Nouveau_compte()
  {
    $this->render_view('administrateur/Gestion_pages/Nouveau_compte');
  }

  public function Importer_fichier()
  {
    $this->render_view('administrateur/Appel/Importer_fichier');
  }

  /*upload fichier excel */
  public function saveDataAppel()
  {
    $this->load->library("SimpleXLSX/SimpleXLSX");
    $data = scandir(FCPATH . 'upload/adminstrateur');
    $uploads_dir = FCPATH . 'upload/adminstrateur';
    $result = array('reponse' => false);
    $operatrice = explode("|", $this->input->post('operatrice'));
    if (isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) {
      $tmp_name = $_FILES["file"]["tmp_name"];
      $name = trim($operatrice[0]) . ".xls";


      if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {

        $result['reponse'] = true;
        //$xlsx = SimpleXLSX::parse("$uploads_dir/$name");
        //print_r( $xlsx->rows());

        $xlsx = new SimpleXLSX("$uploads_dir/$name");
        list($cols, $rows) = $xlsx->dimension();
        //print_r($rows);
        
        foreach ($xlsx->rows() as $key => $value) {
          # code...
          //print_r($value);
          if($key == 0) continue;
          
          //print_r($value);
          $data = array();
          $row_data = [
            "Produit" => $value[1],				
            "Quantite" => $value[2],
            "Prix" => $value[3],
            "Prix_U" => $value[4],
          ];
          //var_dump($row_data);
          array_push($data,$row_data);
          //var_dump($data);
          $this->Administrateur_model->saveDataAppel($data);
          //echo $value[0]."|".$value[1]."|".$value[2]."|".$value[3]."|".$value[4]."</br>";
        }
        
      }
    }
    
  }

  /*Affichage liste des données importés par excel*/
  public function listDataImport()
  {
    $datas = $this->Administrateur_model->selectDataExcel();
    $data = array();
    foreach ($datas as $row) {
       $sub_array = [];
       $sub_array[] = $row->Id;
       $sub_array[] = $row->Produit;
       $sub_array[] = $row->Quantite;
       $sub_array[] = $row->Prix;
       $sub_array[] = $row->Prix_U;
       $sub_array[] = "<a href='#' class='btn btn-warnning btn-sm'>Modifier</a>";

      $data[] = $sub_array;
    }
    $output = array("data" => $data);
    echo json_encode($output);
  }

  public function autoCompleteNouvellePage()
  {
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->Administrateur_model->autoCompleteNouvellePage($term) as $reponse) {
      array_push($array, $reponse->Nom_page . " | " . $reponse->Lien_page);
    }
    echo json_encode($array);
  }
public function autoCompletePageFacebook()
  {
    $term = $this->input->get('term');
    $array = array();
    foreach ($this->Administrateur_model->autoCompleteNouvellePage($term) as $reponse) {
      array_push($array, $reponse->id . " | " .$reponse->Nom_page . " | " . $reponse->Lien_page);
    }
    echo json_encode($array);
  }
  public function saveNewPage()
  {
    $Lien_page = $this->input->post('lienPage');
    $resultat = array('message' => false);
    $reponse =  $this->Administrateur_model->updatePage(['Lien_page' => $Lien_page], ['statut' => 'off', 'date_desativation' => date('Y-')]);
    if ($reponse) {
      $data = [
        'operatrice' => $this->input->post('vb'),
        'Nom_operatrice' => $this->input->post('nom'),
        'Nom_page' => $this->input->post('nomPage'),
        'Lien_page' =>  $Lien_page,
        'statut' => 'on',
        'date_activation' => $this->input->post('date_activation'),
      ];
      $this->Administrateur_model->saveNewPage($data);
      $resultat['message'] = true;
    } else {
      echo json_encode($resultat);
    }
  }
  public function listePage()
  {
    $datas = $this->Administrateur_model->selectsPage();
    $data = array();
    foreach ($datas as $row) {
       $sub_array = [];
       $sub_array[] = $row->date_activation;
       $sub_array[] = $row->date_desativation;
       $sub_array[] = $row->operatrice;
       $sub_array[] = $row->Nom_operatrice;
       $sub_array[] = $row->Nom_page;
       $sub_array[] = $row->Lien_page;
       $sub_array[] = $row->statut;
       $sub_array[] = "<a href='#' class='btn btn-danger desactiver btn-sm' id='$row->id' >Désactiver</a>";

      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function desactivePage(){
    $id = $this->input->post('id');
    return $this->Administrateur_model->updatePage(['id' => $id], ['statut' => 'off', 'date_desativation' => date('Y-m-d')]);
  }

  public function ParametreAppelEntrant(){
    $this->render_view('administrateur/Appel/ParametreAppelEntrant');
  }

  public function ParametreAppelSortant(){
    $this->render_view('administrateur/Appel/ParametreAppelSortant');
  }
  

  public function Statistique_des_jeux(){
    $this->render_view('administrateur/statistique/index');
  }
  

  public function dateChart()
  {
    $reponse = $this->db->query('SELECT DISTINCT `date` FROM `tombola` AS dataTombola WHERE 1')->result_object();
    $resultat = array();
    $donne = array();
    $value = array();
    foreach ($reponse as $key => $reponse) {
      array_push($resultat, $reponse->date);
      $result = "";
      $result = $this->db->query("SELECT SUM(`tire`) as 'total' FROM `tombola` WHERE  `date` = '$reponse->date'")->row_object(); 
      array_push($donne, $result->total);
    }


    $data = [
      'date' => $resultat,
      'data' => $donne

    ];
    echo json_encode($data);
  }

  public function dataTicketGenere(){
    $codeClient = $this->input->post('codeclient');
    
    $data['non']=$this->db->query("SELECT SUM(`tire`) as 'total' FROM `tombola` WHERE  `statut` = 'on'")->row_object(); ;
    $data['oui']=$this->db->query("SELECT SUM(`tire`) as 'total' FROM `tombola` WHERE  `statut` = 'off'")->row_object(); ;
  
    echo json_encode($data);
   }
   public function AnnulerVente(){
    /*$data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'annulation' => $this->calendrier_model->code_annulation(),
      'liste_personel' => $this->calendrier_model->liste_personel()
    ];*/ 
    $this->render_view("administrateur/vente/AnnulerVente" );
   }
   public function detail_Modifier_Vente_annule(){
    $this->load->model('administrateur_model');
    $idfacture = $this->input->post('idfacture');
    $data = [
      'client' => $this->calendrier_model->detail_facture($idfacture),
      'commande' => $this->calendrier_model->detail_commande_facture($idfacture),
      'annulation' => $this->calendrier_model->code_annulation(),
      'liste_personel' => $this->calendrier_model->liste_personel(),
      'liste_livreur'=>$this->administrateur_model->get_result_livreur()
    ];
    $this->load->view("administrateur/vente/AnnulerVentedetail",$data );
   }
   
   public function modifactureRemplcae(){
    $this->load->model('Facture_model');
    $idfacture = $this->input->post('facture');
    $renplace = $this->input->post('idfactureREmplace');
    $this->Facture_model->updateFacture(['Id'=> $renplace],["renplace"=> $idfacture]);
    $this->Facture_model->updateFacture(['Id_facture '=> $idfacture],["renplace"=>$renplace]);
   }

   public function Liste_TSF(){
      $this->load->model('Global_model');
      $data['liste_tsf'] = $this->Global_model->Get_all_TSF();
      $this->render_view("administrateur/Sondage/liste",$data);
   }

   public function Liste_TSF_Publication(){
      $this->load->model('Global_model');
      $data['liste_tsf'] = $this->Global_model->Get_all_TSF_corriger();
      $this->render_view("administrateur/Sondage/liste_pub",$data);
   }

   public function TSF_Correction($id){
      $this->load->model('Global_model');
      $data['page'] = $this->Global_model->Get_Page_Active();
      $data['info_tsf'] = $this->Global_model->Get_TSF_by_Id($id);
      $data['detail_tsf'] = $this->Global_model->Get_TSF_detatil($id); 
      $this->render_view("administrateur/Sondage/editer_sondage",$data);
   }

   public function Enregistrer_Correction(){
     $id= $this->input->post('id');
     $contenu= $this->input->post('contenu');
     $Statut = "Corrigée";
     $data = [
      'Reponse'=>$contenu,
      'Statut'=>$Statut
     ];
    $this->db->where('Id', $id);
    echo  $this->db->update('Tache_TSF_detail', $data);

   }

   public function Valider_Correction(){
     $id= $this->input->post('id');
     $statut_corecteur= "Corrigée";
     $data = [
      'Statut_Correcteur'=>$statut_corecteur
     ];
    $this->db->where('Id', $id);
    echo  $this->db->update('Tache_TSF', $data);
   }

   public function TSF_Exportation($id){
      $this->load->model('Global_model');
      $data['reference_tsf'] = $this->Global_model->Get_reference_by_Id($id);
      $data['id']=$id;
      $data['liste_temoignage'] = $this->Global_model->Get_TSF_detatil_by_id($id,'Temoignage');
      $data['liste_sondage'] = $this->Global_model->Get_TSF_detatil_by_id($id,'Sondage');
      $data['liste_faharetana'] = $this->Global_model->Get_TSF_detatil_by_id($id,'Faharetana');
      $this->render_view('administrateur/Sondage/afficher_tsf',$data);
   }

   public function Valider_Decision_Info(){
       $id= $this->input->post('id');
       $statut_Info= "Telecharger";
       $data = [
        'Statut_info'=>$statut_Info
       ];
      $this->db->where('Id', $id);
      echo  $this->db->update('Tache_TSF', $data);

   }
   public function nouveau_enquette(){
          $this->render_view('administrateur/enquette/form_nouveau');
   }
   public function add_livreure(){
    $this->load->model('administrateur_model');
    echo $this->administrateur_model->insert_livreur([
       "nom"=>$this->input->post('new_livre')
    ]);

   } 
   public function Produit_operatrice(){
       $this->render_view('administrateur/gestion_facebook/add_user_produit');  
   }
   public function addProduitUser(){
     $this->load->model('global_model');
     $matricule = $this->input->post('refnum');
     $codeProduit = $this->input->post('codeProduit');
     $date = date('Y-m-d');
     $statut = "On";
     $timer=date('H:i:s');
     $data = ["User"=>$matricule, "CodePoduit"=>$codeProduit, "Date"=>$date, "Statut"=>$statut, "Timer"=>$timer];
     echo $this->global_model->insert_produit_user($data);
   }
   public function dataListProduitUsers(){
        $refnum = $this->input->get('refnum');
        $datas = $this->Administrateur_model->get_fetch_produit_user(['User'=>$refnum]);
        $data = array();
        foreach ($datas as $row) {
          $sub_array = [];
          $sub_array[] = $row->Date;
          $sub_array[] = $row->CodePoduit;
          $sub_array[] = $row->Statut;
          $data[] = $sub_array;
        }
        $output = array(
          "data" => $data
        );
        echo json_encode($output);
    }
    public function save_question(){
      $this->load->model('administrateur_model');
      $reponse = $this->input->post('reponse');
      $question = $this->input->post('question');
      $type = $this->input->post('type');
      $data = [
        "question"=>$question,
        "option"=>$type,
        "option_containt"=>$reponse

      ];
      echo $this->administrateur_model->insert_questionnaire($data);
    }
    public function Resultat_des_enquette(){
      $question = $this->global_model->get_fect_questionnaire();
      $client = $this->global_model->get_distinct_reponse_question(array(),"client");
      $data = ['question'=>$question,"client"=>$client];
       $this->render_view('administrateur/enquette/resultat',$data);
    }
    public function update_liste_enquette(){
      $this->load->model('Relance_model');
   $data = $this->Relance_model->get_livre_7_jour();
   if($data){
     foreach ($data as $key => $row) {
        $relance_exist = $this->Relance_model->get_relance_aa7(["id_facture"=>$row->Id]);
        if(!$relance_exist){
        $datas = [
            "code_client"=>$row->Code_client,
            "id_facture"=>$row->Id,
            "id_page"=>$row->Page,
            "matricule_oplg"=>$row->Matricule_personnel
        ];
         $this->Relance_model->insert_relance_aa7($datas); 
      }
     }
   }

    }
    public function duplique_operatrice(){
      $this->render_view('administrateur/gestion_facebook/duplicate_operatrice');
    }
    public function duplicate_operatrice_method(){
      $this->load->model('Administrateur_model');
      $matricule = $this->input->post('matricule');
      $type = $this->input->post('type');
      $methodok = false;
      $data_personnel = $this->Administrateur_model->get_personnel(["Matricule"=>$matricule]);
      $numero=filter_var($matricule,FILTER_SANITIZE_NUMBER_INT);
      //_____________________________________________________________________________________
      //_____________________________________________________________ Test si personnel exist
      $new_matricule = $type.$numero;
      $personnel_exist = $this->Administrateur_model->get_personnel(["Matricule"=>$new_matricule]);
      if(!$personnel_exist){
        $data_personnel->Fonction_actuelle = 8;
        $data_personnel->Matricule = $new_matricule;
       $methodok = $this->Administrateur_model->insert_personnel($data_personnel);

      }

      echo $methodok;

    }
    public function Courbe_des_resultats(){
      $this->load->model('Administrateur_model');
      $produit =   $this->Administrateur_model->get_reponse_question_distinct("Produit<>''");
      $question =  $this->Administrateur_model->get_fetch_questionnaire();
      $famille = $this->Administrateur_model->get_famille_produit();
      $data = ["produit"=>$produit,'question'=>$question,'famille'=>$famille];
      $this->render_view('administrateur/enquette/Courbe_des_resultats',$data);
    }
    public function get_data_chart(){
      $this->load->model('Administrateur_model');
      $produit = $this->input->post('produit');
      $question_select_text = $this->input->post('question_select_text');
      $question_select_id = $this->input->post('question_select_id');
      $reponse = array();
      $famille = $this->input->post('famille');
      $debut = $this->input->post('debut');
      $fin = $this->input->post('fin');

      $debut_fin = false;
      $famille_produit =  $famille !="" && $produit !="";
      $debut_fin = $debut != "" && $fin !="";
      $methodok = $produit !="";
     

      if($famille_produit == true && $debut_fin==true){
        $reponse = $this->Administrateur_model->get_joint_cathegory(["create_date > " => $debut, "create_date <"=>$fin,'Questions'=>$question_select_text,"famille"=>$famille]);
      }else if($famille !=""){
        $reponse = $this->Administrateur_model->get_joint_cathegory(['Question'=>$question_select_text,"famille"=>$famille]);
      }else if($produit !=""){
         $reponse = $this->Administrateur_model->get_fetch_reponse_question(['Produit'=>$produit,'Question'=>$question_select_text]);
      }else if( $debut_fin ==true){
        $reponse = $this->Administrateur_model->get_fetch_reponse_question(["create_date > " => $debut, "create_date <"=>$fin, "Question" => $question_select_text]);
      }else if($debut !=""){
          $reponse = $this->Administrateur_model->get_fetch_reponse_question("create_date like '$debut%' AND Question like '$question_select_text'");
      }else{
        $reponse = $this->Administrateur_model->get_fetch_reponse_question(['Question'=>$question_select_text]);
      }


      $color = array('#64DD17','#33691E','#00B0FF','#ffc000','#01579B','#64DD17','#33691E','#00B0FF','#ffc000','#01579B');

      
      $reponse_question =  $this->Administrateur_model->get_questionnaire(['id'=>$question_select_id]);
     $tempQuestion = $question = explode(";", $reponse_question->option_containt);
      
      $data_return = [];
       $tab_excetion_question_3 = array("Tena afa-po tanteraka","Tena Afa-po","Afa-po");
    
      for ($i=0; $i < count($question) ; $i++) { 
      
             $data_return[$i] =0;
          
       
      }
      
      $total = 0;
      $key[0] =0;
      foreach ($reponse as $reponse) {
           $key = array_search($reponse->reponse,$question);
           if($key !=""){
             
                if(array_key_exists($key, $data_return)){
                    $data_return[$key] += 1;
                }else{
                    $data_return[$key] = 1;
                }
            
            $total +=1; 
          }
      } 
      $p=0;
    $question_text=array();
    for ($p=0; $p < array_key_last($data_return)+1; $p++) { 
        if($total != 0 ){
          if(array_key_exists($p, $data_return)){
            $data_return[$p] = number_format(($data_return[$p] * 100 ) / $total);
            $question_text[$p] = $question[$p];
            $question[$p] ="<li><i class='fa fa-circle' style='color:".$color[$p]."'></i> &nbsp;".$question[$p]." ( ".$data_return[$p]." % ) </li>";
            
          }
        }else{
             $data_return[$p] = 0;
              $question_text[$p] = $question[$p];
            $question[$p] ="<li><i class='fa fa-circle' style='color:".$color[$p]."'></i> &nbsp;".$question[$p]." ( ".$data_return[$p]." % ) </li>";
           
          }
    }
$question= array_values($question);
$data_return = array_values($data_return);
$message = "";
if( $question_select_id==3){
  $valeur_afficher =$data_return[0] + $data_return[1] + $data_return[2];
  $message = "Afa-po";
}else{
  $valeur_afficher = max($data_return);
  $indexMaxValue = $this->max_key($data_return);
  if(count($data_return)>0){
     $message = $tempQuestion[$indexMaxValue];
  }
 
}


      $data = ['total'=>$total,'erreur'=>'false','question_text'=>$question_text,'question'=>$question,'stat'=>$data_return,'number'=>$valeur_afficher,'message'=>$message];
      echo json_encode($data);
    }
    public function max_key($array) {
      foreach ($array as $key => $val) {
          if ($val == max($array)) return $key; 
      }
}
    public function return_apreciation($param){
       switch ($param) {
         case 'value':
           $reponse = "false";
           break;
         
         default:
           $reponse = "false";
           break;
           
       }

       return $reponse;
    }
    public function Afficher_mot_de_passe(){
      $this->render_view("administrateur/gestion_facebook/afficher_mot_de_passe");
    }
    public function edit_Motde_Passe(){
      $this->load->view("administrateur/gestion_facebook/edit_mot_de_passe");
    }
    public function update_passeword(){
      $this->load->model('Administrateur_model');
      $passeword = $this->input->post('first');
      $matricule = $this->input->post('matricule');
      $methodok = $this->Administrateur_model->updatet_personnel(["Matricule"=>$matricule],["Mode_de_pass_login"=> $passeword]);
      echo $methodok;
    }
}
