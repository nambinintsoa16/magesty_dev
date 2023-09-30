<?php
class calendrier_model extends CI_Model
{
  public function __construct()
  {
  }

  public function select_facture($requette=array()){
    return $this->db->where($requette)->get("facture")->result_object();
  }
  public function retour_quary($query){
    return $this->db->query($query)->row_object();
  }
  
  public function ca_de_vente($date, $status = FALSE, $user = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail,facture.Val_bon_achat');
    $this->db->where('facture.Date', $dte);
    if ($status != FALSE) {
      $this->db->where('facture.Status', $status);
    }
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    if ($user == FALSE) {
      $this->db->where('facture.Matricule_personnel', $this->session->userdata('matricule'));
    } else {
      $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    }


    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_de_vente_mois($mois = null, $status = FALSE, $user = FALSE, $dateD = null, $dateF = null)
  {
    $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    if ($status != FALSE) {
      $this->db->where('facture.Status', $status);
    }
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    if ($user == FALSE) {
      $this->db->where('facture.Matricule_personnel', $this->session->userdata('matricule'));
    } else {
      $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    }
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    return $this->db->get('detailvente')->result_object();
  }

  public function ca_de_vente_clientel($date, $status = FALSE,$operatrice=false)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->where('livraison.date_de_livraison', $dte);
    if ($status != FALSE) {
      $this->db->where('facture.Status', $status);
    }

    if ($operatrice != FALSE) {
      $this->db->where('facture.Matricule_personnel', $operatrice);
    }
    return $this->db->get('detailvente')->result_object();
  }

  public function ca_vente_livre_mois_rapport($datedeb,$datefin){
    $query =  $this->db->query("SELECT facture.Code_client , facture.Date AS date_de_commande ,facture.heure,facture.contacts, facture.District, facture.Ville, facture.Quartier, livraison.date_de_livraison, prix.Code_produit, prix.Prix_detail, detailvente.Quantite,  prix.Prix_detail*detailvente.Quantite AS Total,comptefb.Nom_page, facture.Matricule_personnel, facture.Status FROM facture
      JOIN detailvente ON facture.ID=detailvente.Facture
      JOIN prix ON prix.Id=detailvente.Id_prix
      JOIN livraison ON facture.Id_facture like livraison.Id_facture
      JOIN comptefb ON comptefb.id=facture.Page
      AND facture.Status like 'livre'
      AND livraison.date_de_livraison BETWEEN  '$datedeb' AND '$datefin'");
      return $query->result();
  }

  public function getachatclientannuel($datedeb,$datefin){
    $query =$this->db->query("SELECT DISTINCT(facture.Code_client) FROM `facture` WHERE  Status like 'livre' AND facture.data_de_livraison BETWEEN '$datedeb' and '$datefin'");
      return $query->result();
  }

  public function getstatutclientannuel($codeclient){
        $query = $this->db->query("SELECT facture.Code_client, SUM( CASE 
        WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite ELSE '0' END ) AS 'smiles', 
        SUM( CASE 
        WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite ELSE '0' END ) AS 'koty'
        FROM facture JOIN detailvente ON facture.`Id` = detailvente.`Facture` 
        JOIN prix ON prix.`Id` = detailvente.`Id_prix` 
        JOIN produit ON produit.Code_produit = prix.Code_produit 
        AND facture.data_de_livraison like '2021-%'
        AND facture.Status like 'livre' AND facture.Code_client like '$codeclient'");
        return $query->result();
  }


  public function getlastdateachat($code_client){
        $query =$this->db->query("SELECT facture.Date , facture.Id_facture FROM facture where facture.Code_client LIKE '$code_client' ORDER BY facture.Date DESC LIMIT 1");
        return $query->result();
    }

  public function getdetailventebyfact($idfacture){
    $query = $this->db->query("SELECT facture.Id_facture,facture.`Quartier`, facture.`Ville`,comptefb.Nom_page, facture.Matricule_personnel, facture.`District`,facture.contacts,facture.lieu_de_livraison,  prix.Code_produit, prix.Prix_detail, detailvente.Quantite FROM `detailvente` JOIN facture ON detailvente.Facture=facture.Id 
      JOIN prix ON detailvente.Id_prix=prix.Id
      JOIN comptefb ON facture.Page=comptefb.id
      AND facture.Id_facture like '$idfacture' LIMIT 1");
    return $query->result();
  }

  public function getclientinfolivre($codeclient,$table){
     $query =  $this->db->query("SELECT Compte_facebook, lien_facebook FROM $table where Code_client like '$codeclient' LIMIT 1");
    return $query->result();
  }

  public function getstatutclient($datedeb,$datefin){
        $query = $this->db->query("SELECT facture.Code_client, SUM( CASE 
        WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite ELSE '0' END ) AS 'smiles', 
        SUM( CASE 
        WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite 
        WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite ELSE '0' END ) AS 'koty'
        FROM facture JOIN detailvente ON facture.`Id` = detailvente.`Facture` 
        JOIN prix ON prix.`Id` = detailvente.`Id_prix` 
        JOIN produit ON produit.Code_produit = prix.Code_produit 
        AND facture.data_de_livraison BETWEEN '$datedeb' AND '$datefin'
        AND facture.Status like 'livre' GROUP BY facture.Code_client");
        return $query->result();
  }
  

  public function getclientsansachat($datedeb,$datefin){
    $query = $this->db->query("SELECT DISTINCT(discussion.client), comptefb.Nom_page, discussion.operatrice, discussion_content.heure FROM `discussion` 
      JOIN discussion_content ON discussion_content.Id_discussion=discussion.id_discussion 
      JOIN comptefb ON comptefb.id=discussion_content.Page 
      AND discussion_content.heure 
      BETWEEN '$datedeb 00:00:01' AND  '$datefin 23:59:09' 
      AND  discussion_content.Message <> 'vente' 
      GROUP BY discussion.client");
    return $query->result();

  }

  public function getdatediscution($codeclient){
    $query = $this->db->query("SELECT discussion_content.Id, discussion_content.heure as lastdiscdate FROM discussion_content
      JOIN discussion ON discussion_content.Id_discussion=discussion.id_discussion 
      AND discussion.client like '$codeclient' AND discussion_content.sender = 'CLT'
      ORDER BY discussion_content.Id DESC LIMIT 1");
    return $query->result();

  }

  public function Returnclientsansachat($datedeb,$datefin){
    $query = $this->db->query("SELECT session.client, session.date,session.idaction, comptefb.Nom_page,session.operatrice FROM `session` JOIN comptefb ON session.page=comptefb.id 
      AND session.action <> 'vente' AND session.sender like 'OPL' 
      AND session.date BETWEEN '$datedeb'  AND  '$datefin'
      GROUP BY session.idaction;");
    return $query->result();
  }

  public function getlasttimesdiscution($id_discution){
    $query= $this->db->query("SELECT session.heure FROM `session` WHERE `idaction`='$id_discution' 
      AND session.sender like 'CLT' 
      ORDER BY session.id 
      DESC limit 1;");
    return $query->result();

  }

  public function liste_personel()
  {
    $this->db->select('Matricule');
    return $this->db->get('personnel')->result_object();
  }

  public function ca_facture($idfacture)
  {
    $this->db->select('produit.Code_produit,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Id', $idfacture);
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }
   public function retourIdPrix($codeProduit)
    {
      $this->db->select('Id');
      $this->db->where('Code_produit', $codeProduit);
      $this->db->where('Statut', 'on');
      $this->db->where('Localite', '5');
      return $this->db->get('prix')->row_object();
       
    }
    public function DeleleDetail($idvente){
    $this->db->where('Id', $idvente);
     return $this->db->delete('detailvente');
    }
   public function InsertDEtailVente($data){
      return $this->db->insert('detailvente',$data);
   } 
  public function detail_facture($id)
  {
    $this->db->select("
		client.Code_client,client.Nom,facture.Id,livraison.id,facture.Matricule_personnel,facture.Page,
		client.Prenom`,client.lien_facebook,facture.Ville,
		client.datedenregistrement,facture.contacts,facture.heure_livre_debut,
		client.Compte_facebook,client.Contact,facture.Quartier,facture.heure_livre_fin,
    facture.Remarque,facture.remarque_service_clientel,facture.lieu_de_livraison,facture.Ress_sec_oplg,
		livraison.remarque_livreur,livraison.heure_deb_livre,facture.Id_facture,livraison.frais,livraison.frais_de_retrait,
		livraison.heure_fi_livre,livraison.date_de_livraison,facture.District,
		livraison.idlivreur,facture.Status,facture.Matricule_personnel
		");
    $this->db->where('facture.Id', $id);
    $this->db->join('client', 'client.Code_client=facture.Code_client');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $data = $this->db->get('facture')->row_object();
    if (!$data) {
      $this->db->flush_cache();
      $this->db->select("
				clientpo.Code_client,clientpo.Nom,facture.Id,livraison.id,facture.Matricule_personnel,facture.Page,
				clientpo.Prenom`,clientpo.lien_facebook,facture.Ville,
				clientpo.datedenregistrement,facture.contacts,facture.lieu_de_livraison,
				clientpo.Compte_facebook,clientpo.Contact,facture.Quartier,facture.Id_facture,
				facture.Remarque,facture.remarque_service_clientel,facture.heure_livre_debut,facture.Ress_sec_oplg,
				livraison.remarque_livreur,livraison.heure_deb_livre,facture.heure_livre_fin,livraison.frais,livraison.frais_de_retrait,
				livraison.heure_fi_livre,livraison.date_de_livraison,facture.District,
				livraison.idlivreur,facture.Status,facture.Matricule_personnel	 
				");
      $this->db->where('facture.Id', $id);
      $this->db->join('clientpo', 'clientpo.Code_client=facture.Code_client');
      $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
      $reponse = $data = $this->db->get('facture')->row_object();
      if ($reponse) {
        return  $reponse;
      } else {
        $this->db->flush_cache();
        $this->db->select("
          client_curieux.Code_client,client_curieux.Nom,facture.Id,livraison.id,facture.Matricule_personnel,facture.Page,
          client_curieux.Prenom`,client_curieux.lien_facebook,facture.Ville,
          client_curieux.datedenregistrement,facture.contacts,facture.lieu_de_livraison,
          client_curieux.Compte_facebook,client_curieux.Contact,facture.Quartier,facture.Id_facture,
          facture.Remarque,facture.remarque_service_clientel,facture.heure_livre_debut,facture.Ress_sec_oplg,
          livraison.remarque_livreur,livraison.heure_deb_livre,facture.heure_livre_fin,livraison.frais,
          livraison.heure_fi_livre,livraison.date_de_livraison,facture.District,
          livraison.idlivreur,facture.Status,facture.Matricule_personnel	 
          ");
        $this->db->where('facture.Id', $id);
        $this->db->join('client_curieux', 'client_curieux.Code_client=facture.Code_client');
        $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
        return $this->db->get('facture')->row_object();
      }
    } else {
      return $data;
    }
  }
  public function updateFacture($id,$data){
     $this->db->where('Id', $id); 
     return $this->db->update('facture',$data);
  }
  public function updateDEtailVente($id,$data){
     $this->db->where('Id', $id); 
     return $this->db->update('detailvente',$data);
  }
  public function detaillivraison($facture)
  {
    $this->db->where('Id_facture', $facture);
    return $this->db->get('livraison')->row_object();
  }

  public function ca_vente_repporet($date)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->where('livraison.dateRep', $dte);
    $this->db->where('facture.Status', 'reppoter');
    return $this->db->get('detailvente')->result_object();
  }
  public function repporter($facture, $data)
  {
    $this->db->where('Id_facture', $facture);
    $this->db->update('livraison', $data);
  }

  public function updateLivre($param, $data)
  {
    return $this->db->where($param)->update('livraison', $data);
  }


  public function repporterfacture($facture, $data)
  {
    $this->db->where('Id_facture', $facture);
    $this->db->update('facture', $data);
  }

  public function detail_facture_discussion($id)
  {
    $this->db->where('facture.Id_facture', $id);
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    return $this->db->get('facture')->row_object();
  }
  public function detail_commande_facture_discussion($id)
  {
    $this->db->select('facture.Page,facture.Matricule_personnel,facture.Val_bon_achat,facture.id as fatcure,detailvente.Id,detailvente.statut,produit.Code_produit,detailvente.statut,prix.Prix_detail,produit.Designation,detailvente.Quantite,prix.Smile_LV1,prix.Zen_LV1,prix.Prix_zen');
    $this->db->where('facture.Id_facture', $id);
    $this->db->join('facture', 'facture.Id=detailvente.facture');
    $this->db->join('prix', 'prix.Id=detailvente.Id_prix');
    $this->db->join('produit', 'prix.Code_produit=produit.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

  public function detail_facture_modif($id_facture)
  {
    $this->db->where('Id_facture', $id_facture);
    return $this->db->get('facture')->row_object();
  }


  public function detail_client($codeclient)
  {
    $this->db->where('Code_client', $codeclient);
    $data = $this->db->get('client')->row_object();
    if (!$data) {
      $this->db->flush_cache();
      $this->db->where('Code_client', $codeclient);
      $reponse = $this->db->get('clientpo')->row_object();
      if ($reponse) {
        return $reponse;
      } else {
        $this->db->flush_cache();
        $this->db->where('Code_client', $codeclient);
        return $this->db->get('client_curieux')->row_object();
      }
    } else {
      return $data;
    }
  }
  public function detail_commande_facture($id)
  {
    $this->db->select('detailvente.Id_prix,detailvente.statut,produit.Code_produit,detailvente.statut,detailvente.Id,prix.Prix_detail,produit.Designation,detailvente.Quantite');
    $this->db->where('detailvente.facture', $id);
    $this->db->join('prix', 'prix.Id=detailvente.Id_prix');
    $this->db->join('produit', 'prix.Code_produit=produit.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

  public function liste_client_facture($date, $status = FALSE, $user = FALSE)
  {
    $this->db->select("livraison.date_de_livraison,facture.data_de_livraison,facture.Matricule_personnel,facture.Remarque,facture.Id,facture.Code_client,facture.Date,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->where('facture.Date', $date);
    if ($status != 'Previ') {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->where('facture.Status', $status);
      }
    }
    if ($user == FALSE) {
      $this->db->where('Matricule_personnel', $this->session->userdata('matricule'));
      //$this->db->where('facture.Id_de_la_mission','FACEBOOK');

    } else {
      $this->db->where('Matricule_personnel', $user);
    }

    return $this->db->get('facture')->result_object();
  }



  public function liste_client_facture_sc($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("facture.Remarque,facture.Id,facture.Code_client,livraison.date_de_livraison,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->where('facture.Id_de_la_mission','FACEBOOK');
    $this->db->where('livraison.date_de_livraison', $dte);

    if ($status != 'Previ') {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->where('facture.Status', $status);
      }
    }
    return $this->db->get('facture')->result_object();
  }

  public function liste_client_facture_sc_tsena_koty($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("facture.Remarque,facture.Id,facture.Code_client,livraison.date_de_livraison,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->where('livraison.date_de_livraison', $dte);
    $this->db->like('facture.source', 'tsena_koty');
    if ($status != 'Previ') {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->where('facture.Status', $status);
      }
    }
    return $this->db->get('facture')->result_object();
  }

  public function  liste_client_facture_export_opl($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("facture.Id_facture,facture.District,livraison.frais,facture.Ville,facture.Quartier,facture.Status,facture.Matricule_personnel,facture.lieu_de_livraison,detailvente.Quantite,prix.Code_produit,prix.Prix_detail,facture.contacts,facture.Date,facture.Remarque,detailvente.Id,facture.Code_client,livraison.date_de_livraison,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join("prix", 'prix.Id=detailvente.Id_prix');
    $this->db->where('facture.Date', $dte);
    $this->db->where('facture.Matricule_personnel', $this->session->userdata('matricule'));
    if ($status != 'Previ') {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->where('facture.Status', $status);
      }
    }
    $this->db->group_by('detailvente.Id');
    return $this->db->get('detailvente')->result_object();
  }

  public function liste_client_facture_export($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("produit.Designation,facture.Id_facture,facture.District,livraison.frais,facture.Ville,facture.Quartier,facture.Status,facture.Matricule_personnel,facture.lieu_de_livraison,detailvente.Quantite,prix.Code_produit,prix.Prix_detail,facture.contacts,facture.Date,facture.Remarque,detailvente.Id,facture.Code_client,livraison.date_de_livraison,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");

    $this->db->join("prix", 'prix.Id=detailvente.Id_prix');
    $this->db->join('produit', 'prix.Code_produit=produit.Code_produit');
    $this->db->where('livraison.date_de_livraison', $dte);
    $this->db->where('facture.Id_de_la_mission','FACEBOOK');
    if ($status != 'Previ') {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->where('facture.Status', $status);
      }
    }
    $this->db->group_by('detailvente.Id');
    return $this->db->get('detailvente')->result_object();
  }


  public function liste_client_facture_rep($date)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("facture.Remarque,facture.Id,facture.Code_client,livraison.date_de_livraison,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->where('livraison.dateRep', $dte);
    $this->db->where('facture.Id_de_la_mission','FACEBOOK');
    $this->db->like('facture.Status', 'reppoter');

    return $this->db->get('facture')->result_object();
  }
  public function liste_client_facture_rep_tsena_koty($date)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("facture.Remarque,facture.Id,facture.Code_client,livraison.date_de_livraison,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->where('livraison.dateRep', $dte);
    $this->db->like('facture.Status', 'reppoter');
    $this->db->like('facture.source', 'tsena_koty');

    return $this->db->get('facture')->result_object();
  }

  public function liste_produit_facture_rep($date, $status)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("produit.Code_produit,produit.Designation,prix.Prix_detail,detailvente.Quantite");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join("detailvente", "detailvente.Facture=facture.Id");
    $this->db->join("prix", "prix.Id=detailvente.Id_prix");
    $this->db->join("produit", "produit.Code_produit=prix.Code_produit");
    $this->db->where('livraison.date_de_livraison', $dte);
    if($status != "all"){
      $this->db->like('facture.Status', $status);
    }
    return $this->db->get('facture')->result_object();
  }

  public function liste_produit_facture_rep_cat($date, $status, $famille)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("produit.Code_produit,produit.Designation,prix.Prix_detail,detailvente.Quantite, facture.Status");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join("detailvente", "detailvente.Facture=facture.Id");
    $this->db->join("prix", "prix.Id=detailvente.Id_prix");
    $this->db->join("produit", "produit.Code_produit=prix.Code_produit");
    $this->db->join("categorie", "categorie.Id=produit.Categorie");
    $this->db->where('livraison.date_de_livraison', $dte);
    $this->db->where('categorie.famille', $famille);
    /*if($status !== "all"){
      $this->db->like('facture.Status', $status);
    }*/
    if($status != "all"){
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->like('facture.Status', $status);
      }
    }
    return $this->db->get('facture')->result_object();
  }

  public function count_produit_facture_rep_cat($date, $status, $famille)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("count(*) as qt");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join("detailvente", "detailvente.Facture=facture.Id");
    $this->db->join("prix", "prix.Id=detailvente.Id_prix");
    $this->db->join("produit", "produit.Code_produit=prix.Code_produit");
    $this->db->join("categorie", "categorie.Id=produit.Categorie");
    $this->db->where('livraison.date_de_livraison', $dte);
    $this->db->where('categorie.famille', $famille);
    if($status != "all"){
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->like('facture.Status', $status);
      }
    }
    return $this->db->get('facture')->row_object();
  }


  public function ca_vente_livre($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('livraison.date_de_livraison', $dte);
    if ($status != FALSE) {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->like('facture.Status', $status);
      }
    }
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    return $this->db->get('detailvente')->result_object();
  }

  public function count_ca_vente_livre($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select('count(*) as qt');
    $this->db->where('livraison.date_de_livraison', $dte);
    if ($status != FALSE) {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->like('facture.Status', $status);
      }
    }
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    return $this->db->get('detailvente')->row_object();
  }

  /*livraison en attante*/
  public function livraisonEnAttante(){
    $this->db->select('prix.Code_produit,facture.Code_client,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail, facture.lieu_de_livraison');
    $this->db->where('facture.Status', 'en_attente' );
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    return $this->db->get('detailvente')->result_object();

}
public function TotaleVenteEnAttente(){

  $query= $this->db->query("SELECT SUM(detailvente.Quantite*prix.Prix_detail) as totalCa FROM facture JOIN detailvente on detailvente.Facture= facture.Id JOIN prix on prix.Id= detailvente.Id_prix AND facture.Status LIKE 'en_attente'");
  return $query->result();
}

  public function code_annulation()
  {
    return $this->db->get('annulation')->result_object();
  }
  public function retour_date($type = FALSE)
  {
    $this->db->distinct();
    $this->db->select('Date');
    $this->db->where('Matricule_personnel', $this->session->userdata('matricule'));
    if ($type != FALSE) {
      $this->db->where('Status', $type);
    } else {
      $this->db->like('Lieu', 'facebook');
    }

    return $this->db->get('facture')->result_object();
  }

  public function retour_date_precence($type = FALSE)
  {
    $this->db->distinct();
    $this->db->select('Date');
    return $this->db->get('facture')->result_object();
  }

  public function annulelivre($remarque, $code_annulation, $facture)
  {
    $data = [
      'remarque_livreur' => $remarque,
      'code_annul' => $code_annulation
    ];
    $this->db->where("Id_facture", $facture);
    $this->db->update('livraison', $data);
  }
  public function annulelivres($remarque, $code_annulation, $facture, $nomlivre)
  {
    $data = [
      'remarque_livreur' => $remarque,
      'code_annul' => $code_annulation,
      'idlivreur' => $nomlivre
    ];
    $this->db->where("Id_facture", $facture);
    $this->db->update('livraison', $data);
  }


  public function annule_facture($facture)
  {
    $data = [
      'Status' => 'annule'
    ];
    $this->db->where('Id_facture', $facture);
    $this->db->update('facture', $data);
  }

  public function retour_date_livre($type = FALSE)
  {
    $this->db->distinct();
    $this->db->select('livraison.date_de_livraison');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    if ($type != FALSE) {
      $this->db->where('facture.Status', $type);
    } else {
      $this->db->like('facture.Lieu', 'facebook');
    }

    return $this->db->get('facture')->result_object();
  }


  public function retour_date_livre_vente($type = FALSE)
  {
    $this->db->distinct();
    $this->db->select('facture.Date');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    if ($type != FALSE) {
      $this->db->where('facture.Status', $type);
    } else {
      $this->db->like('facture.Lieu', 'facebook');
    }

    return $this->db->get('facture')->result_object();
  }



  public function cont_resultArray($date, $type)
  {
    $this->db->select('Id');
    $this->db->where('Date', $date);
    $this->db->where('Matricule_personnel', $this->session->userdata('matricule'));
    if ($type != "previ") {
      $this->db->where('Status', $type);
    }
    return $this->db->count_all_results('facture');
  }



  public function cont_resultArrays($date, $type, $user)
  {
    $this->db->select('Id');
    $this->db->where('Date', $date);
    $this->db->where('Matricule_personnel', $user);
    if ($type != "previ") {
      $this->db->where('Status', $type);
    }
    return $this->db->count_all_results('facture');
  }
  public function cont_resultArrays2($type, $user, $mois = null, $dateD = null, $dateF = null)
  {
    $this->db->select('Id');
    if ($mois != null) {
      $this->db->like('Date', $mois);
    } else {
      $this->db->where("(Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->where('Matricule_personnel', $user);
    if ($type != "previ") {
      $this->db->where('Status', $type);
    }
    return $this->db->count_all_results('facture');
  }

  public function cont_resultArray_livre($date, $type)
  {
    $this->db->select('facture.Id');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->where('livraison.date_de_livraison', $date);
    $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    if ($type != "previ") {
      $this->db->where('facture.Status', $type);
    }
    return $this->db->count_all_results('facture');
  }
  public function cont_resultArray_vente($date, $type)
  {
    $this->db->select('facture.Id');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->where('facture.Date', $date);
    if ($type != "previ") {
      $this->db->where('facture.Status', $type);
    }
    return $this->db->count_all_results('facture');
  }
  public function ca_de_vente_controlleur($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select('facture.Matricule_personnel,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Date', $dte);
    if ($status != FALSE) {
      $this->db->where('facture.Status', $status);
    }
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    return $this->db->get('detailvente')->result_object();
  }

  public function liste_client_facture_controlleur($date, $status = FALSE, $user = FALSE)
  {
    $this->db->select("livraison.date_de_livraison,facture.data_de_livraison,facture.Matricule_personnel,facture.Remarque,facture.Id,facture.Code_client,facture.Date,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->where('facture.Date', $date);
    if ($status != 'Previ') {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->where('facture.Status', $status);
      }
    }
    if ($user == FALSE) {
      //$this->db->where('Matricule_personnel',$this->session->userdata('matricule'));
      $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    } else {
      $this->db->where('Matricule_personnel', $user);
    }

    return $this->db->get('facture')->result_object();
  }

   public  function getclientstatutAnnuel($smiles){
      if($smiles <= 14999 AND $smiles >= 0){
        $statut ="BLUE";
        return $statut;
      }elseif ($smiles <= 24999 AND $smiles >= 15000) {
        $statut ="BRONZE";
        return $statut;
        
      }elseif ($smiles <= 44999 AND $smiles >= 25000) {
        $statut ="SILVER";
        return $statut;
        
      }elseif ($smiles <= 99999 AND $smiles >= 50000) {
        $statut ="GOLD";
        return $statut;
        
      }elseif ($smiles <= 9999999 AND $smiles >= 100000) {
        $statut ="PLATINIUM";
        return $statut;
        
      }else{
        $statut ="Votre statut n'est pas valide, veillez consulter le responsable technique";
        return $statut;
      }
    }

    public  function getclientstatuttrimes($smiles){
      if($smiles <= 1499 AND $smiles >= 0){
        $statut ="LEVEL 1";
        return $statut;
      }elseif ($smiles <= 2499 AND $smiles >= 1500) {
        $statut ="LEVEL 2";
        return $statut;
        
      }elseif ($smiles <= 4999 AND $smiles >= 2500) {
        $statut ="LEVEL 3";
        return $statut;
        
      }elseif ($smiles <= 9999 AND $smiles >= 5000) {
        $statut ="LEVEL 4";
        return $statut;
        
      }elseif ($smiles <= 99999999 AND $smiles >= 10000) {
        $statut ="LEVEL 5";
        return $statut;
        
      }else{

        $statut ="Votre statut n'est pas valide, veillez consulter le responsable technique";
        return $statut;

      }
    }

  public function getProduct($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("COUNT(*) as qt");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join("detailvente", "detailvente.Facture=facture.Id");
    $this->db->join("produit", "produit.Code_produit=detailvente.Id");
    $this->db->where('livraison.date_de_livraison', $dte);
    if ($status != 'Previ') {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->where('facture.Status', $status);
      }
    }
    return $this->db->get('facture')->row_object();
  }

  public function liste_Annulation($date){

    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("prix.Code_produit,prix.Prix_detail, facture.Code_client, detailvente.Quantite, annulation.contenu, annulation.code_annul, annulation.id, livraison.remarque_livreur, livraison.idlivreur");
    $this->db->join('facture', 'facture.Id= detailvente.Facture');

    $this->db->join('livraison', 'livraison.Id_facture= facture.Id_facture');
    $this->db->join('annulation', 'annulation.code_annul= livraison.code_annul');
    $this->db->join('prix', 'prix.Id= detailvente.Id_prix');
    $this->db->where('facture.Status', "annule");

    $this->db->where('facture.date', $date);
    return $this->db->get('detailvente')->result_object();
  }
 public function liste_Hebdomader(){
 
  $query= $this->db->query(" SELECT `prix`.`Code_produit`, `prix`.`Prix_detail`, `facture`.`Code_client`, `detailvente`.`Quantite`, `annulation`.`contenu`, `annulation`.`code_annul`, `annulation`.`id`, `livraison`.`remarque_livreur`, `livraison`.`idlivreur` FROM `detailvente` JOIN `facture` ON `facture`.`Id`= `detailvente`.`Facture` JOIN `livraison` ON `livraison`.`Id_facture`= `facture`.`Id_facture` JOIN `annulation` ON `annulation`.`code_annul`= `livraison`.`code_annul` JOIN `prix` ON `prix`.`Id`= `detailvente`.`Id_prix` WHERE `facture`.`Status` = 'annule' AND `facture`.`date` BETWEEN CURRENT_DATE - INTERVAL 7 day AND CURRENT_DATE");
  return $query->result();
 }
 public function liste_Mensuel($mois){
 
    $this->db->select("prix.Code_produit,prix.Prix_detail, facture.Code_client, detailvente.Quantite, annulation.contenu, annulation.code_annul, annulation.id, livraison.remarque_livreur, livraison.idlivreur");
    $this->db->join('facture', 'facture.Id= detailvente.Facture');

    $this->db->join('livraison', 'livraison.Id_facture= facture.Id_facture');
    $this->db->join('annulation', 'annulation.code_annul= livraison.code_annul');
    $this->db->join('prix', 'prix.Id= detailvente.Id_prix');
    $this->db->where('facture.Status', "annule");

    $this->db->like('facture.date', $mois,'after');
    return $this->db->get('detailvente')->result_object();
 }
 public function liste_Semestruel($debut, $fin){
    $query= $this->db->query(" SELECT `prix`.`Code_produit`, `prix`.`Prix_detail`, `facture`.`Code_client`, `detailvente`.`Quantite`, `annulation`.`contenu`, `annulation`.`code_annul`, `annulation`.`id`, `livraison`.`remarque_livreur`, `livraison`.`idlivreur` FROM `detailvente` JOIN `facture` ON `facture`.`Id`= `detailvente`.`Facture` JOIN `livraison` ON `livraison`.`Id_facture`= `facture`.`Id_facture` JOIN `annulation` ON `annulation`.`code_annul`= `livraison`.`code_annul` JOIN `prix` ON `prix`.`Id`= `detailvente`.`Id_prix` WHERE `facture`.`Status` = 'annule' AND `facture`.`date` BETWEEN '$debut' AND '$fin'");
     return $query->result();
 }

 public function listeMotif_annuler(){
     $this->db->select("annulation.contenu, annulation.code_annul, annulation.id");
     return $this->db->get('annulation')->result_object();

 }
 public function getProduit($parametre=array()){
  return $this->db->where($parametre)->get("produit")->row_object();
 }

  public function livraison_la_veille($oplg){
    $query= $this->db->query("SELECT SUM(detailvente.Quantite*prix.Prix_detail) as 'CA' FROM detailvente 
    JOIN facture ON detailvente.Facture=facture.Id 
    JOIN prix ON detailvente.Id_prix=prix.Id
    JOIN livraison on livraison.Id_facture = facture.Id_facture 
    WHERE livraison.date_de_livraison = CURRENT_DATE - INTERVAL 1 DAY AND  facture.Matricule_personnel LIKE '$oplg' AND facture.Status like 'livre' AND facture.Id_de_la_mission = 'FACEBOOK' ");
     return $query->row_object();
 }
}
