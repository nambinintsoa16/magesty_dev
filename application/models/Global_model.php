<?php
class global_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function complete_sous_tache($code=false)
{
  $this->db->where('tachekoty.code_tache',$code);
  $this->db->like('tachekoty.statut',"on");
  $this->db->join('tachekoty','tachekoty.code_tache=soustachekoty.code');
  return $this->db->get('soustachekoty')->result_object();
}
  public function inserthistorique_discussion_session($data){
    $this->db->insert('session',$data);
  }
  public function getClientInfo($code_client)
  {
    $this->db->where('Code_client', $code_client);
    return $this->db->get('clientpo')->row_object();
  }
  public function get_result_compagn_de_jeux($param=array()){
    return $this->db->where($param)->get('compagn_de_jeux')->result_object();
    
  }

  public function bon_achat($requette=array()){
    return $this->db->where($requette)->get('bonDAchat')->result_object();
  }
  public function select_bon_achat($requette=array()){
    return $this->db->where($requette)->order_by('IDBON', 'DESC')->get('bonDAchat')->row_object();
  }

  public function bon_achat_parametre($requette=array()){
    return $this->db->where($requette)->get('bonDAchatParametre')->result_object();
  }
  public function select_bon_achat_parametre($requette=array()){
    return $this->db->where($requette)->order_by('IDBON', 'DESC')->get('bonDAchatParametre')->row_object();
  }
  
  public function insert_bon_achat($data){
    return $this->db->insert('bonDAchat',$data);
  }
  public function insert_bon_achat_parametre($data){
    return $this->db->insert('bonDAchatParametre',$data);
  }
  public function update_bon_achat($requette,$data){
    return $this->db->where($requette)->update('bonDAchat',$data);
  }
  public function update_bon_D_Achat_Parametre($requette,$data){
    return $this->db->where($requette)->update('bonDAchatParametre',$data);
  }
  public function insertdemandesAmie($data)
  {
    return $this->db->insert('demandesAmie', $data);
  }
  public function selectFacture($requette = array()){
   return $this->db->where($requette)->get('facture')->row_object();

  }
  public function selectAmies($date = null, $operatrice = null)
  {
    $this->db->select('demandesAmie.NomEtPrenom,demandesAmie.Lien,demandesAmie.Id,demandesAmie.Date,demandesAmie.Statut,comptefb.Nom_page');
    if ($date != null &&  $operatrice != null) {
      $this->db->where('Date', $date);

      $this->db->where('operatice', $operatrice);
    }
    $this->db->join('comptefb', 'comptefb.id=demandesAmie.PageOuCompte');
    return $this->db->get('demandesAmie')->result_object();
    //} else if ($date != null) {
    $this->db->where('Date', $date);
    //}
    return $this->db->count_all_results('demandesAmie');
  }

  public function dataClientInfo()
  {
    return $this->db->query("SELECT CLT.`Code_client` AS 'CODECLIENT',CLT.`lien_facebook` AS 'LIENFACEBOOK',CLT.`Compte_facebook` AS 'COMPTEFACEBOOK',(SELECT `facture`.`contacts` FROM `facture` WHERE `facture`.`Code_client` =CLT.`Code_client` LIMIT 1 ) AS 'CONTACT',(SELECT SUM(`detailvente`.`Quantite`*`prix`.`Prix_detail`) FROM `detailvente` JOIN `prix` ON `prix`.`Id`=`detailvente`.`Id_prix` JOIN `facture` ON `facture`.`Id`=`detailvente`.`Facture` WHERE `detailvente`.`Facture` = `facture`.`Id` AND `facture`.`Code_client`=CLT.`Code_client` ) AS 'CHIFFREAFFAIRE',
  (SELECT SUM(`detailvente`.`Quantite`) FROM `detailvente` JOIN `facture` ON `facture`.`Id`=`detailvente`.`Facture`  WHERE `facture`.`Code_client` = CLT.`Code_client` ) AS 'NBREDARTICLESACHETES',
(SELECT COUNT(fact.`Id`) FROM `facture` as fact WHERE fact.`Code_client`= CLT.`Code_client`)  AS 'NBREDACHATSEFFECTUES'
,(SELECT `prix`.`Code_produit` FROM `detailvente` JOIN `prix` ON `prix`.`Id`=`detailvente`.`Id_prix` JOIN `facture` ON `facture`.`Id`=`detailvente`.`Facture` WHERE `detailvente`.`Facture` = `facture`.`Id` AND `facture`.`Code_client`=CLT.`Code_client` ORDER BY `detailvente`.`Id` DESC  LIMIT 1) AS 'DERNIERARTICLEACHETE',
(SELECT `facture`.`Date` FROM `facture` WHERE `facture`.`Code_client` =CLT.`Code_client`  ORDER BY `facture`.`Id` DESC LIMIT 1 ) AS 'DATEDERNIEREACHAT',
(SELECT `facture`.`Quartier` FROM `facture` WHERE `facture`.`Code_client` =CLT.`Code_client`  ORDER BY `facture`.`Id` DESC LIMIT 1 ) AS 'DERNIERELIEUDELIVRAISON',
(SELECT COUNT(DISTINCT(`facture`.`Page`)) FROM `facture` WHERE `Code_client`= CLT.`Code_client`) AS 
'NOMBREDEPAGECONTACTE' FROM `clientpo` AS CLT WHERE CLT.`Code_client` LIKE 'CMT-FB-%'")->result_object();
  }
  public function lastAmie()
  {
    $this->db->select('Id');
    $this->db->limit(1);
    $this->db->order_by('Id', 'DESC');
    return $this->db->get('demandesAmie')->row_object();
  }
  public function nombre_demande($operatice = null, $date = null)
  {
    //if ($operatice != null) {
    $this->db->where('operatice', $operatice);
    //} else if ($date != null) {
    $this->db->where('Date', $date);
    //}
    return $this->db->count_all_results('demandesAmie');
  }
  /////////////// UPDATE //////////////////////////
  /*public function userpage()
  {
    $this->db->where('statut', 'on');
    return $this->db->get('comptefb')->result_object();
  }*/
  public function inserthistoriqueDiscussion($data)
  {
    return $this->db->insert('historiqueDiscussion', $data);
  }
  public function userpage()
  {
    $user = $this->session->userdata('matricule');
    $query = $this->db->query("SELECT `comptefb`.`id`,`page_fb`.`Nom_page` FROM `comptefb` JOIN `page_fb` ON `page_fb`.`Lien_page`=`comptefb`.`Lien_page` WHERE `page_fb`.`operatrice` LIKE '$user' AND `page_fb`.`statut` like 'on' ");
    return $query->result();
  }
  ////////////// CLIENT //////////////////////////
  public function nombre_client()
  {
    // $this->db->like('Code_client','CLT-FB');
    return $this->db->count_all_results('clientpo');
  }


  public function testDiscussion($client)
  {
    $this->db->select('id_discussion');
    $this->db->where('client', $client);
    $this->db->where('statut', 'a_suivre');
    return $this->db->get('discussion')->row_object();
  }

  public function addRelance($date, $user, $client, $id_page)
  {
    $data = [
      'Date' => $date,
      'User' => $user,
      'Client' => $client,
      'Statut' => 'on',
      'id_page' => $id_page,
      'Type_Client' => ''

    ];
    $this->db->insert('relance', $data);
  }
  public function dataRelance()
  {
    return $this->db->get('relance')->result_object();
  }
  public function testLinkPoFb($link)
  {
    $this->db->like("lien_facebook", $link, 'after');
    $data = $this->db->get('clientpo')->row_object();
    $this->db->flush_cache();
    if ($data) {
      return  $data;
    } else {
      $this->db->like("lien_facebook", $link, 'after');
      $reponse = $this->db->get('clientpo')->row_object();
      if ($reponse) {
        return $reponse;
      } else {
        $this->db->like("lien_facebook", $link, 'after');
        return $this->db->get('client_curieux')->row_object();
      }
    }
  }

  public function testLinkFb($link)
  {
    $this->db->like("lien_facebook", $link, 'after');
    $data = $this->db->get('client')->row_object();
    $this->db->flush_cache();
    if ($data) {
      return  $data;
    } else {
      $this->db->like("lien_facebook", $link, 'after');
      $reponse = $this->db->get('clientpo')->row_object();
      if ($reponse) {
        return $reponse;
      } else {
        $this->db->like("lien_facebook", $link, 'after');
        return $this->db->get('client_curieux')->row_object();
      }
    }
  }

  public function testFactureLocalite($codeClient, $date)
  {
    $this->db->where('Date', $date);
    $this->db->where('Matricule_personnel', $codeClient);
    return $this->db->get('facture')->row_object();
  }
  public function testFactures($opl, $date)
  {
    $this->db->where('Date', $date);
    $this->db->where('Matricule_personnel', $opl);
    return $this->db->get('facture')->row_object();
  }


  public function insert_client_curieux($data)
  {
    $this->db->insert('client_curieux', $data);
  }


  public function count_Client_potentiel()
  {
    return $this->db->count_all_results('clientpo');
  }
  public function produit_user()
  {
    $this->db->join('produit', 'produit.Code_produit=Produit_user.CodePoduit');
    $this->db->where('Produit_user.Statut', 'On');
    $this->db->where('Produit_user.User', $this->session->userdata('matricule'));
    return $this->db->get('Produit_user')->result_object();
  }

  public function produit_users()
  {
    $this->db->select('produit.Code_produit, produit.Designation');
    /*$this->db->join('produit', 'produit.Code_produit=Produit_user.CodePoduit');
    $this->db->where('Produit_user.Statut', 'On');
    $this->db->where('Produit_user.User', $this->session->userdata('matricule'));
		return $this->db->get('Produit_user')->result_object();
		*/
    return $this->db->get('produit')->result_object();
  }


  public function testFacture($idfacture)
  {
    $this->db->where('Id_facture', $idfacture);
    $query = $this->db->get('facture')->row_object();
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function updatedate($date, $id)
  {
    $this->db->where('Id', $id);
    $data = ['data_de_livraison' => $date];
    $datas = ['date_de_livraison' => $date];
    $this->db->update('facture', $data);
    $this->db->flush_cache();
    $this->db->select('Id_facture');
    $this->db->where('facture.Id', $id);
    $facture = $this->db->get('facture')->row_object();
    $this->db->flush_cache();
    $this->db->where('Id_facture', $facture->Id_facture);
    $this->db->update('livraison', $datas);
  }

  public function insertCSX($Nom, $link_facebook, $code_client)
  {

    $data = [
      'Nom' => $Nom,
      'Link_facebook' => $link_facebook,
      'Code_client' => $code_client,
      'Date' => date('Y-m-d'),
      'Matricule' => $this->session->userdata('matricule')

    ];

    $this->db->insert('client_curieux', $data);
  }

  public function client_crx()
  {

    $this->db->where('Date', date('Y-m-d'));
    $this->db->where('Matricule', $this->session->userdata('matricule'));
    return $this->db->get('client_curieux')->result_object();
  }
  public function client_crx_tout($limit, $start, $date = FALSE)
  {
    if ($date != FALSE) {
      $this->db->where('Date', $date);
    }
    $this->db->limit($limit, $start);
    //$this->db->limit('10');
    $this->db->where('Code_client NOT LIKE "CRX-TR%"');
    return $this->db->get('client_curieux')->result_object();
  }
  public function test_exist_CMT($codeclient)
  {
    $this->db->where('Provenance', $codeclient);
    return $this->db->get('clientpo')->row_object();
  }

  public function test_exist_CLT($codeclient)
  {
    $this->db->where('Provenance', $codeclient);
    return $this->db->get('client')->result_object();
  }
  public function test_discussion_crx($codeclient, $page)
  {
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->where('discussion_content.sender', 'CLT');
    $this->db->like('discussion.client', $codeclient);
    $this->db->where('discussion_content.Page', $page);
    return $this->db->count_all_results('discussion_content');
  }


  public function dataProduitUser($code, $codeproduit)
  {
    $this->db->where('CodeProduit', $codeproduit);
    $this->db->like('CodeDiscussion', $code);
    $data = $this->db->get('dataDiscussion')->result_object();
    if(!$data){
      $this->db->flush_cache();
      $this->db->where('CodeProduit', "PRO021");
      $this->db->like('CodeDiscussion', $code);
      $data =  $this->db->get('dataDiscussion')->result_object();
    }

     return $data;
  }

  public function dataPageUser()
  {
    $user = $this->session->userdata('matricule');
    $this->db->like('page_fb.operatrice',$user);
    $this->db->where('comptefb.statut',"on");
    $this->db->join('page_fb','comptefb.Lien_page=page_fb.Lien_page');
    return $this->db->get('comptefb')->result_object();
  }

  public function dataProduitUsers($code, $codeproduit)
  {
    $this->db->where('CodeDiscussion', $code);
    $this->db->where('CodeProduit', $codeproduit);
    $data = $this->db->get('dataDiscussion')->row_object();
    if(!$data){
      $this->db->flush_cache();
      $this->db->where('CodeProduit', "PRO021");
      $this->db->like('CodeDiscussion', $code);
      $data =  $this->db->get('dataDiscussion')->result_object();
    }
    return $data;
  }
  
  public function basculement_client()
  {

    //$this->db->where();
    // $this->db->get();

  }

  public function insertdetailPotentiel($idclient, $Id_facebook, $link, $pass, $pseudo, $coach = FALSE, $commerciale = FALSE)
  {
    if ($coach == FALSE) {
      $coach = NULL;
    }
    if ($commerciale == FALSE) {
      $commerciale == NULL;
    }
    $data = [
      'Code_client' => $idclient,
      'lien_facebook' => $link,
      'Nom' => $Id_facebook,
      'Coach' => $coach,
      'Commercial' => $commerciale,
      'Compte_facebook' => $Id_facebook,
      'Matricule_personnel' => $this->session->userdata('matricule'),
      'datedenregistrement' => date('Y-m-d'),
      'Provenance' => 'FACEBOOK',
      'pseudo' => $pseudo,
      'password' => $pass
    ];
    $this->db->insert('client_curieux', $data);
  }
  //////////////////////////////////////////////////
  public function rapport_publication()
  {
    $this->db->select('autre_outils');
  }
  //////////////////////////////////////////////////
  public function Autres($data)
  {
    $this->db->insert('autres_outils', $data);
  }


  ////////////////// PRODUIT ////////////////////////
  public function nombre_produit()
  {
    return $this->db->count_all('produit');
  }

 
  public function autocomplete_codeproduit($mot)
  { 
    $this->db->group_by('produit.Code_produit');
    $this->db->select('produit.Code_produit ,produit.Designation');
    $this->db->where('Produit_user.User', $this->session->userdata('matricule'));
    $this->db->like('Produit_user.CodePoduit', $mot);
    $this->db->where('Produit_user.Statut',"on");  
    $this->db->join('produit', 'Produit_user.CodePoduit=produit.Code_produit');
    return $this->db->get('Produit_user')->result_object();
  }
  
  public function autocomplete_personnel($mot)
  { 

    $this->db->group_start();
    $this->db->like('Nom',$mot);
    $this->db->or_like('Prenom',$mot);
    $this->db->group_end();
    return $this->db->get('personnel')->result_object();
  }
  
  public function autocomplete_all_codeproduit($mot)
  { 
    $this->db->group_by('produit.Code_produit');
    $this->db->select('produit.Code_produit ,produit.Designation');
    $this->db->like('Produit_user.CodePoduit', $mot);
    $this->db->where('Produit_user.Statut',"on");  
    $this->db->join('produit', 'Produit_user.CodePoduit=produit.Code_produit');
    return $this->db->get('Produit_user')->result_object();
  }

  public function autocomplete_codegroupe($mot)
  {
    $this->db->select('Code_groupe ,Nom_groupe,Lien_support');
    $this->db->like('Code_groupe', $mot);
    $this->db->or_like('Nom_groupe', $mot);
    $this->db->or_like('Lien_support', $mot);
    return $this->db->get('gr_publication')->result_object();
  }
  public function autocomplete_page_compte($user)
  {
    $user = $this->session->userdata('matricule');
    $this->db->select('Nom_page');
    $this->db->where('operatrice',$user);
    $this->db->where('statut',"on");
    //$this->db->or_like('Nom_page', $page);
    return $this->db->get('page_fb')->result_object();
  }

  public function retourPrix($idprix, $type)
  {
    $prix = 0;
    $this->db->select('Prix_detail,Prix_epicerie');
    $this->db->where('Id', $idprix);
    $query = $this->db->get('prix');
    $data = $query->row_array();

    if ($type == "gros") {
      $prix = $data['Prix_epicerie'];
    } else {
      $prix = $data['Prix_detail'];
    }

    return $prix;
  }

  public function liste_des_produit($limit, $start)
  {
    $this->db->limit($limit, $start);
    $this->db->select('categorie.famille,categorie.groupe,produit.Code_produit,produit.Designation,produit.Quantites,prix.Prix_detail');
    $this->db->join('categorie', 'categorie.Id=produit.Categorie');
    $this->db->join('prix', 'prix.Code_produit=produit.Code_produit');
    $this->db->where('prix.Statut', 'on');
    return $this->db->get('produit')->result();
  }

  public function groupe($famille)
  {
    $this->db->select('famille');
    $this->db->where('Id', $famille);
    $data = $this->db->get('categorie')->row_object();
    $this->db->flush_cache();
    $this->db->where('famille', $data->famille);
    return $this->db->get('categorie')->result_object();
  }

  public function famille()
  {
    $this->db->group_by('famille');
    return $this->db->get('categorie')->result_object();
  }


  public function produitname($famille, $groupe, $Localite)
  {
    $this->db->select('famille');
    $this->db->where('Id', $famille);
    $famille = $this->db->get('categorie')->row_object();
    $this->db->flush_cache();

    $this->db->select('groupe');
    $this->db->where('Id', $groupe);
    $groupe = $this->db->get('categorie')->row_object();
    $this->db->flush_cache();

    if (!empty($groupe->groupe) && !empty($famille->famille)) {
      $this->db->select('prix.Id,produit.Code_produit,produit.Designation,prix.Prix_detail,prix.Prix_zen');
      $this->db->join('categorie', 'produit.Categorie=categorie.Id');
      $this->db->join('prix', 'produit.Code_produit=prix.Code_produit');
      $this->db->where('categorie.groupe', $groupe->groupe);
      $this->db->where('categorie.famille', $famille->famille);
      $this->db->where('prix.Statut', 'on');
      $this->db->where('prix.Localite', $Localite);
      return $this->db->get('produit')->result_object();
    } else {

      return array();
    }
  }

  
  ////////////////////////////////////////////////////
  ////////////////////// FACTURE ////////////////////
  public function testLevele($date, $codeclient)
  {
    $this->db->select('Level');
    $this->db->where('Code_client', $codeclient);
    $query = $this->db->get('facture');
    $donne = $query->row_array();
    if ($donne) {
      return $this->ClientLivelCLient($date, $codeclient);
    } else {
      return $donne;
    }
  }

  public function ClientLivelCLient($date, $codeclient)
  {
    $point = 0;
    $point = $this->pointsmilles($date, $codeclient);
    $donne = $this->testLevel($point['smille']);
    return $donne['level'];
  }

  public function pointsmilles($date, $ressource)
  {
    if ($date != FALSE) {
      $dt = new dateTime($date);
    } else {
      $dt = new dateTime();
    }

    $mois = $dt->format("m");
    $anne = $dt->format("Y");

    if ($mois == '01' || $mois == '02' || $mois == '03') {
      $date_1 = $anne . '-01';
      $date_2 = $anne . '-02';
      $date_3 = $anne . '-03';
    } else if ($mois == '04' || $mois == '05' || $mois == '06') {
      $date_1 = $anne . '-04';
      $date_2 = $anne . '-05';
      $date_3 = $anne . '-06';
    } else if ($mois == '07' || $mois == '08'  || $mois == '09') {
      $date_1 = $anne . '-07';
      $date_2 = $anne . '-08';
      $date_3 = $anne . '-09';
    } else if ($mois == '10' || $mois == '11' || $mois == '12') {
      $date_1 = $anne . '-10';
      $date_2 = $anne . '-11';
      $date_3 = $anne . '-12';
    }

    return $this->smille($date_1, $date_2, $date_3, $ressource);
  }
  public function smille($date_1, $date_2, $date_3, $codeclient)
  {
    $donne = array("Zen" => 0, "smille" => 0);
    $query = $this->db->query("SELECT `detailvente`.`Id_prix`, `facture`.`Level`, `detailvente`.`Quantite`,`facture`.`Code_client`,`detailvente`.`statut` FROM `detailvente` JOIN `facture` ON `facture`.`Id`=`detailvente`.`Facture` WHERE `facture`.`Code_client` = '" . $codeclient . "' AND `facture`.`Status`LIKE 'livre' AND (`facture`.`Date` LIKE '" . $date_1 . "%' ESCAPE '!' OR `facture`.`Date` LIKE '" . $date_2 . "%' ESCAPE '!' OR `facture`.`Date` LIKE '" . $date_3 . "%' ESCAPE '!')");

    foreach ($query->result_array() as $data) {
      if ($data['statut'] != 'annuler') {
        $zenPrix = $this->retourZenLevel($data['Id_prix']);
        $level = $this->testLevels($data['Level']);
        $donne['smille'] += ($zenPrix[$level['smile']] * $data['Quantite']);
        $donne['Zen'] += ($zenPrix[$level['zen']] * $data['Quantite']);
      }
    }

    return  $donne;
  }
  public function testLevels($levels)
  {

    switch ($levels) {
      case 'Level_1':
        $level['smile'] = "Smile_LV1";
        $level['zen'] = "Zen_LV1";
        break;
      case 'Level_2':
        $level['smile'] = "Smile_LV2";
        $level['zen'] = "Zen_LV2";
        break;
      case 'Level_2':
        $level['smile'] = "Smile_LV3";
        $level['zen'] = "Zen_LV3";
        break;
      case 'Level_4':
        $level['smile'] = "Smile_LV4";
        $level['zen'] = "Zen_LV4";
        break;
      case 'Level_5':
        $level['smile'] = "Smile_LV5";
        $level['zen'] = "Zen_LV5";
        break;
      default:
        $level['smile'] = "Smile_LV1";
        $level['zen'] = "Zen_LV1";
        break;
    }

    return $level;
  }
  public function testLevel($smile)
  {
    $reponse = $this->statut_Zen("Trimestre", $smile);
    $level = array('smile' => 'Smile_LV1', 'zen' => 'Zen_LV1', 'level' => 'Level_1');
    if ($reponse) {
      switch ($reponse['Designation']) {
        case 'Level_1':
          $level['smile'] = "Smile_LV1";
          $level['zen'] = "Zen_LV1";
          $level['level'] = 'Level_1';
          break;
        case 'Level_2':
          $level['smile'] = "Smile_LV2";
          $level['zen'] = "Zen_LV2";
          $level['level'] = 'Level_2';
          break;
        case 'Level_3':
          $level['smile'] = "Smile_LV3";
          $level['zen'] = "Zen_LV3";
          $level['level'] = 'Level_3';
          break;
        case 'Level_4':
          $level['smile'] = "Smile_LV4";
          $level['zen'] = "Zen_LV4";
          $level['level'] = 'Level_4';
          break;
        case 'Level_5':
          $level['smile'] = "Smile_LV5";
          $level['zen'] = "Zen_LV5";
          $level['level'] = 'Level_5';
          break;
      }
    }

    return $level;
  }
  public function statut_Zen($periode, $point = FALSE)
  {

    if ($point != FALSE) {
      $this->db->where('Final>=', $point);
      $this->db->where('Initial<=', $point);
    }
    $this->db->where('Type', $periode);
    $this->db->where('Statut', 'On');
    $query = $this->db->get('statutzen');
    $data = $query->row_array();
    return $data;
  }

  public function gainpoint($date, $Ressources, $type, $ca = FALSE)
  {
    if ($ca != FALSE) {
      if ($type == 'vente_client_fidel') {
        if ($ca > 11000) {
          $this->db->select('detailpoint.Gain_avec_facebook,detailpoint.Gain_sans_facebook');
          $this->db->from('detailpoint');
          $this->db->join('heurepoint', 'heurepoint.Id =detailpoint.Heure');
          $this->db->where('detailpoint.Type', $type);
          $this->db->where('(heurepoint.Heure_init < "' . $date . '" AND heurepoint.Heure_fin > "' . $date . '"  )');
          $this->db->where('detailpoint.Montant_minimum !=', '0');
          $this->db->like('detailpoint.Ressources', $Ressources);
        } else {
          $this->db->select('detailpoint.Gain_avec_facebook,detailpoint.Gain_sans_facebook');
          $this->db->from('detailpoint');
          $this->db->join('heurepoint', 'heurepoint.Id =detailpoint.Heure');
          $this->db->where('(heurepoint.Heure_init < "' . $date . '" AND heurepoint.Heure_fin > "' . $date . '"  )');
          $this->db->where('detailpoint.Type', $type);
          $this->db->where('detailpoint.Montant_minimum =', '0');
          $this->db->like('detailpoint.Ressources', $Ressources);
        }
      } else {
        if ($ca > 11000) {
          $this->db->select('detailpoint.Gain_avec_facebook,detailpoint.Gain_sans_facebook');
          $this->db->from('detailpoint');
          $this->db->join('heurepoint', 'heurepoint.Id =detailpoint.Heure');

          /*$this->db->where('heurepoint.Heure_init <',$date);
           $this->db->where('heurepoint.Heure_fin>',$date);*/

          $this->db->where('(heurepoint.Heure_init < "' . $date . '" AND heurepoint.Heure_fin > "' . $date . '"  )');


          $this->db->where('detailpoint.Type', $type);
          $this->db->where('detailpoint.Montant_minimum !=', '0');
          $this->db->like('detailpoint.Ressources', $Ressources);
        } else {
          $this->db->select('detailpoint.Gain_avec_facebook,detailpoint.Gain_sans_facebook');
          $this->db->from('detailpoint');
          $this->db->join('heurepoint', 'heurepoint.Id =detailpoint.Heure');

          /*$this->db->where('heurepoint.Heure_init <',$date);
           $this->db->where('heurepoint.Heure_fin>',$date);*/
          $this->db->where('(heurepoint.Heure_init < "' . $date . '" AND heurepoint.Heure_fin > "' . $date . '"  )');


          $this->db->where('detailpoint.Type', $type);
          $this->db->where('detailpoint.Montant_minimum =', '0');
          $this->db->like('detailpoint.Ressources', $Ressources);
        }
      }
    } else {
      $this->db->select('detailpoint.Gain_avec_facebook,detailpoint.Gain_sans_facebook');
      $this->db->from('detailpoint');
      $this->db->join('heurepoint', 'heurepoint.Id =detailpoint.Heure');
      /*$this->db->where('heurepoint.Heure_init <',$date);
           $this->db->where('heurepoint.Heure_fin>',$date);*/

      $this->db->where('(heurepoint.Heure_init < "' . $date . '" AND heurepoint.Heure_fin > "' . $date . '"  )');
      $this->db->where('detailpoint.Type', $type);
      $this->db->like('detailpoint.Ressources', $Ressources);
    }


    //$data = $this->db->get();
    return $data->row_array();
  }
  public function pointCommercile($matricule, $Id_facture, $Activite, $Eng, $Pospect, $Client_fidel, $satatut)
  {
    $data = [
      'matricule' => $matricule,
      'Id_facture'  => $Id_facture,
      'Client_fidel'  => $Client_fidel,
      'satatut' => $satatut,
      'Pospect'  => $Pospect,
      'Eng'  => $Eng,
      'Activite'  => $Activite
    ];

    $this->db->insert('pointressource', $data);
  }

  public function insert_action($data){
    $this->db->insert('autres_outils', $data);
  }


  public function update_crx($client, $Quartier, $idville, $District)
  {
    $data = [
      'Quartier' => $Quartier,
      'Ville' => $idville,
      'District' => $District
    ];
    $this->db->where('Code_client', $client);
    $this->db->update('client_curieux', $data);
  }

  public function update_cmt($client, $Quartier, $idville, $District)
  {
    $data = [
      'Quartier' => $Quartier,
      'Ville' => $idville,
      'District' => $District
    ];
    $this->db->where('Code_client', $client);
    $this->db->update('clientpo', $data);
  }

  public function update_clt($client, $Quartier, $idville, $District)
  {
    $data = [
      'Quartier' => $Quartier,
      'Ville' => $idville,
      'District' => $District
    ];
    $this->db->where('Code_client', $client);
    $this->db->update('client', $data);
  }


  public function Insertpoint($facture)
  {
    date_default_timezone_set("Europe/Moscow");
    $dt = new dateTime('10:00:00');
    $date = $dt->format("H:i:s");
    $ca = 0;
    $idCoach = TRUE;

    $this->db->select('detailvente.Quantite,prix.Prix_detail');
    $this->db->join('facture', 'facture.Id=detailvente.Facture');
    $this->db->join('prix', 'prix.Id=detailvente.Id_prix');
    $this->db->where('facture.Id_facture', $facture);
    $this->db->where('facture.Source_vente', 'TERRAIN');
    $this->db->where('detailvente.statut!=', 'Annuler');
    $querys = $this->db->get('detailvente')->result_object();
    if ($querys) {
      $this->db->where('Id_facture', $facture);
      $query = $this->db->get('facture')->row_object();
      foreach ($querys as $donne) {
        $ca += $donne->Prix_detail * $donne->Quantite;
      }
      $this->db->flush_cache();
      $this->db->where('Code_client', $query->Code_client);
      $count = $this->db->count_all_results('facture');
      if ($count > 1) {
        if (strpos($query->Ress_sec_oplg, 'COTN') !== FALSE) {
          $idCoach = FALSE;
          $Type = "vente_prospe_avec_fb_accomp";
          $matrucle = $query->Ress_sec_oplg;
          $coach = 'COTNX';
        } else {
          $matrucle = $query->Ress_sec_oplg;
          $coach = $query->Matricule_accomp;
          $Type = "vente_prospe_avec_fb";
        }
      } else {
        if (strpos($query->Ress_sec_oplg, 'COTN') !== FALSE) {
          $idCoach = FALSE;
          $Type = "vente_client_fidel_accomp";
          $matrucle = $query->Ress_sec_oplg;
          $coach = 'COTNX';
        } else {
          $matrucle = $query->Ress_sec_oplg;
          $coach = $query->Matricule_accomp;
          $Type = "vente_client_fidel";
        }
      }
      $this->db->flush_cache();
      $pointSimple = $this->gainpoint($date, 'Commercial', 'vente_simple', $ca);
      $pointSimpleCoach = $this->gainpoint($date, 'Coach', 'vente_simple');


      if ($Type == "vente_prospe_avec_fb" || $Type == "vente_prospe_avec_fb_accomp") {
        $point_prospe_avec_fb = $this->gainpoint($date, 'Commercial', 'vente_prospe', $ca);
        $point_prospe_avec_fb_coach = $this->gainpoint($date, 'Coach', 'vente_prospe');
        $this->pointCommercile($matrucle, $facture, 'vente_prospe_sur_fb', $pointSimple['Gain_sans_facebook'], $point_prospe_avec_fb['Gain_avec_facebook'], '0', 'On');
        if ($idCoach != FALSE) {
          $this->pointCommercile($coach, $facture, 'vente_prospe_sur_fb_accomp', $pointSimpleCoach['Gain_sans_facebook'], $point_prospe_avec_fb_coach['Gain_avec_facebook'], '0', 'On');
        }

        return $point_prospe_avec_fb;
      } else if ($Type == "vente_client_fidel" || $Type == "vente_client_fidel_accomp") {

        $pointclient_fidel = $this->gainpoint($date, 'Commercial', 'vente_client_fidel', $ca);
        $pointclient_fidel_coach = $this->gainpoint($date, 'Coach', 'vente_client_fidel');
        $this->pointCommercile($matrucle, $facture, 'vente_client_fidel_fb', $pointSimple['Gain_avec_facebook'], '0', $pointclient_fidel['Gain_avec_facebook'], 'On');
        if ($idCoach != FALSE) {
          $this->pointCommercile($coach, $facture, 'vente_client_fidel_accomp_fb', $pointSimpleCoach['Gain_avec_facebook'], '0', $pointclient_fidel_coach['Gain_avec_facebook'], 'On');
        }

        return $pointclient_fidel;
      }
    }
  }

  public function retourZenLevel($idprix, $codeproduit = FALSE)
  {

    if ($codeproduit != FALSE) {
      $this->db->or_where('Code_produit', $codeproduit);
    } else {
      $this->db->where('Id', $idprix);
    }
    $this->db->where('Statut', 'On');
    $query = $this->db->get('prix');
    $data = $query->row_array();
    return $data;
  }

  public function countFacture()
  {
    return $this->db->count_all_results('facture');
  }

  public function factureCount()
  {
    $this->db->select('Id');
    $this->db->LIMIT(1);
    $this->db->order_by('Id', 'DESC');
    $data = $this->db->get('facture')->row_object();
    return $data->Id;
  }
  public function sauvelivraison($datelivre, $debut, $remarque, $facture, $type, $lieulirevc, $matrliv, $contactliv)
  {
    $data = [
      'date_de_livraison' => $datelivre,
      'remarque_livreur' => $remarque
    ];
    $this->db->where('Id_facture', $facture);
    $this->db->update('livraison', $data);
    $this->db->flush_cache();
    $facturedata = [
      'Status' => $type,
      'ress_sec_liv' => $matrliv,
      'Heure_de_livraison' => $debut,
      'Contact_livraison' => $contactliv,
      'Lieu_livraison_comm' => $lieulirevc
    ];
    $this->db->where('Id_facture', $facture);
    $this->db->where('Id_facture', $facture);
    $this->db->update('facture', $facturedata);
  }
  public function modifquantite($id, $quantite)
  {

    $this->db->where('Id', $id);
    $data = [
      'Quantite' => $quantite


    ];
    $this->db->update('detailvente', $data);
  }

  public function annuleproduit($id)
  {

    $this->db->where('Id', $id);
    $data = [
      'statut' => 'annuler'

    ];
    $this->db->update('detailvente', $data);
  }

  public function addProduit($idPrix, $quantite, $idfacture)
  {
    $data = [
      'Facture' => $idfacture,
      'Id_prix' => $idPrix,
      'Quantite' => $quantite,
      'Type_de_prix' => 'detail',
      'statut' => 'principale'
    ];
    $this->db->insert('detailvente', $data);
  }


  public function livre_vente($livreur, $remarque, $facture,$level,$kotySisa,$smile)
  {
    $data = [
      'remarque_livreur' => $remarque,
      'idlivreur' => $livreur,
    ];
    $this->db->where('Id_facture', $facture);
    $this->db->update('livraison', $data);
    $this->db->flush_cache();
    $facturedata = [
      'Status' => 'livre',
      'Tombola'=> 'ok',
      'Level' => $level,
      'koty_sisa'=>$kotySisa,
      'smile'=>$smile
    ];
    $this->db->where('Id_facture', $facture);
    $this->db->update('facture', $facturedata);
  }
  public function clientTemp_info($code_client)
  {
    $data = [
      'statut' => 'off'
    ];
    $this->db->where('Code_client', $code_client);
    $this->db->update('clientpo', $data);
    $this->db->flush_cache();
    $this->db->where('Code_client', $code_client);
    return $this->db->get('clientpo')->row_object();
  }

  public function migreclient($data)
  {
    $this->db->insert('client', $data);
  }
  public function migreCMT($data)
  {
    $this->db->insert('clientpo', $data);
  }
  public function migration_discussion($idclient, $idclients)
  {
    $data = [
      'client' => $idclient

    ];
    $this->db->where('client', $idclients);
    $this->db->update('discussion', $data);
  }
  public function migration_facture($idclient, $idclients)
  {
    $data = [
      'Code_client' => $idclient

    ];

    $this->db->where('Code_client', $idclients);
    $this->db->update('facture', $data);
  }

  public function enregistre_detail_facture($secondaire=null,$codePromo,$typeFacture,$Id_facture, $Code_client, $Id_zone, $idville, $data_de_livraison, $heure_livre_debut, $heure_livre_fin, $contacts, $Remarque, $Id_discussion, $District,$Localite, $lieu_de_livraison, $Quartier, $page, $contactlivre, $ress_sec_oplg, $source_vente,$valeurBon,$DesBon,$liue_livre_clt,$koty=null,$smile=null)
  {
    date_default_timezone_set("Europe/Moscow");
    $dt = new dateTime();
    $date = $dt->format("H:i:s");

    $rcv = substr($this->session->userdata('matricule'), 0, 2);
    if($rcv == 'VN' || $rcv == 'VB' || $rcv == 'VH' || $rcv == 'CT' || $rcv == 'VL' || $rcv == 'VD' || $rcv == 'VO' || $rcv == 'VM' ){
      $id_mission = "FACEBOOK";
    }
    if($rcv == 'VK'){
      $id_mission = "TSENA_KOTY";
    }

    $data = [
      'Date' => date('Y-m-d'),
      'Heure' => $date,
      'Id_facture' => $Id_facture,
      'Code_client' => $Code_client,
      'Matricule_personnel' => $this->session->userdata('matricule'),
      'Matricule_accomp' => 'COTNX',
      'Id_de_la_mission' =>  $id_mission,
      'Id_zone' => $Id_zone,
      'Status' => 'en_attente',
      'Lieu' => 'facebook',
      'data_de_livraison' => $data_de_livraison,
      'contacts' => $contacts,
      'Ville' => $idville,
      'Quartier' => $Quartier,
      'District' => $District,
      'Localite' => $Localite,
      'lieu_de_livraison' => $lieu_de_livraison,
      'heure_livre_debut' => $heure_livre_debut,
      'heure_livre_fin' => $heure_livre_fin,
      'Remarque' => $Remarque,
      'Id_discussion' => $Id_discussion,
      'Page' => $page,
      'Contact_livraison' => $contactlivre,
      'Ress_sec_oplg' => $ress_sec_oplg,
      'Source_vente' => $source_vente,
      'Nature_vente' => 'FACEBOOK',
      'koty_sisa'=>$koty,
      'smile'=>$smile,
      'codePromo'=>$codePromo,
      'typeFacture'=>$typeFacture,
      'facture_secondaire'=>$secondaire,
      'Val_bon_achat'=>$valeurBon,
      'Des_bon_achat'=>$DesBon,
      'lieu_livre_clt'=>$liue_livre_clt

    ];
    $this->db->insert('facture', $data);
  }
  public function insert_detail_livraison($Id_facture, $date_de_livraison, $frais = NULL, $fraisderetrait = NULL)
  {
    $data = [
      'Id_facture' => $Id_facture,
      'date_de_livraison' => $date_de_livraison,
      'frais' => $frais,
      'frais_de_retrait' => $fraisderetrait
    ];
    $this->db->insert('livraison', $data);
  }
  public function enregistre_detail_livraison($Id_facture, $date_de_livraison, $frais)
  {
    $data = [
      'Id_facture' => $Id_facture,
      'date_de_livraison' => $date_de_livraison,
      'frais' => $frais,
    ];
    $this->db->insert('livraison', $data);
  }

  public function enregistre_detail_commande($idPrix, $quantite, $idfacture)
  {
    $this->db->select('Id');
    $this->db->where('Id_facture', $idfacture);
    $reponse = $this->db->get('facture')->row_object();
    $this->db->flush_cache();
    $data = [
      'Facture' => $reponse->Id,
      'Id_prix' => $idPrix,
      'Quantite' => $quantite,
      'Type_de_prix' => 'detail',
      'statut' => 'principale'
    ];
    $this->db->insert('detailvente', $data);
  }
  ///////////////////MISSION//////////////////////////
  public function mission()
  {
    return $this->db->get('zone')->result_object();
  }
  ////////////////////////////////////////////////////



  ///////////////////////////////////////////////////
  public function nombre_transaction()
  {
    $this->db->where('Date', date('Y-m-d'));
    $this->db->where('Matricule_personnel', $this->session->userdata('matricule'));
    return  $this->db->count_all_results('facture');
  }

  public function detail_client($code_client)
  {
    $this->db->where('Code_client', $code_client);
    $data = $this->db->get('client')->row_object();
    if ($data) {
      return $data;
    } else {
      $this->db->flush_cache();
      $this->db->where('Code_client', $code_client);
      $resultat = $this->db->get('clientpo')->row_object();
      if ($resultat) {
        return  $resultat;
      } else {
        $this->db->flush_cache();
        $this->db->where('Code_client', $code_client);
        return $this->db->get('client_curieux')->row_object();
      }
    }
  }
  public function pourcentage_transaction($type = FALSE)
  {
    if ($type != FALSE) {
      $this->db->where('status', $type);
    }
    $this->db->where('Date', date('Y-m-d'));
    return $this->db->count_all_results('facture');
  }

  public function pourcentage_transaction_livre($type = FALSE)
  {
    if ($type != FALSE) {
      $this->db->where('facture.status', $type);
    }
    $this->db->where('livraison.date_de_livraison', date('Y-m-d'));
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    return $this->db->count_all_results('facture');
  }

  public function get_utilisateur_info($matricule)
  {

    $this->db->select("personnel.Matricules, session.page,personnel.Nom, personnel.Prenom, personnel.Cin_personnel, personnel.Mode_de_pass_login, fonction.designation, fonction.id AS id_designation");
    $this->db->join('fonction', "fonction.id = personnel.Fonction_actuelle", "inner");
    $this->db->join('session', "session.operatrice = personnel.Matricule", "inner");
    $this->db->where('Matricule', $matricule);
    $query = $this->db->get('personnel');

    return $query->unbuffered_row();
  }
  ////////////////////////////////////////////////
  public function listeUser()
  {
    $this->db->like('Matricule', 'VB', 'after');
    return $this->db->get('personnel')->result_object();
  }
  public function NumbreUser()
  {
    $this->db->like('Matricule', 'VB', 'after');
    return $this->db->count_all_results('personnel');
  }

  /////////////////DISCUTION//////////////////////
  public function sercheClient($client)
  {
    $this->db->select('Nom,Prenom,Code_client');
    $this->db->like('Nom', $client);
    $this->db->or_like('Prenom', $client);
    $this->db->limit(15);
    $this->db->order_by('Nom', 'DESC');
    return $this->db->get('clientpo')->result_object();
  }

  public function discussion_en_cours()
  {
    $this->db->select('Id,client,id_discussion,nom,prenom');
    $this->db->where('statut', 'a_suivre');
    //$this->db->where('operatrice',$this->session->userdata('matricule'));
    $this->db->limit(20);
    $this->db->order_by('Id', 'ASC');
    return $this->db->get('discussion_avec_nom')->result_object();
  }

  public function test_discussion_en_cours($client)
  {
    $this->db->select('id_discussion');
    $this->db->where('statut', 'a_suivre');
    //$this->db->where('operatrice',$this->session->userdata('matricule'));
    $this->db->where('client', $client);
    return $this->db->get('discussion')->row_object();
  }

  public function testDiscution($client, $page)
  {
    $this->db->select('discussion.id_discussion');
    $this->db->join('discussion_content', 'discussion_content.Id_discussion=discussion.id_discussion');
    //$this->db->where('discussion.operatrice',$this->session->userdata('matricule'));
    $this->db->where('discussion_content.Page', $page);
    $this->db->where('discussion.client', $client);
    return $this->db->get('discussion')->row_object();
  }
  public function get_view_discussion_table($param){
    return $this->db->where($param)->get("view_discussion_table")->row_object();
  }
  public function get_all_view_discussion_table($param){
    return $this->db->where($param)->get("view_discussion_table")->result_object();
  }
  public function detail_discussion($id_conversation)
  {
    $this->db->where('Id_discussion', $id_conversation);
    //$this->db->like('statut','a_suivre');
    $this->db->order_by('Id', 'ASC');
    return $this->db->get('discussion_content')->result_object();
  }

  public function all_detail_discussion($client, $page)
  {
    $requette = "SELECT * FROM discussion WHERE client LIKE '" . $client . "' ORDER BY id ASC";
    $query = $this->db->query($requette);
    $resultat_final = array();
    foreach ($query->result() as $row) {
      $req = "SELECT * FROM discussion_content WHERE Id_discussion like '" . $row->id_discussion . "' AND Page like '" . $page . "' ORDER BY Id ASC";
      $res = $this->db->query($req);
      //foreach($res->result() as $r){
      foreach ($res->result_object() as $r) {
        $resultat_final[] = $r;
      }
    }
    return $resultat_final;
  }

  public function delete_facture($id)
  {
    $this->db->where('Id', $id);
    $this->db->delete('facture');
  }
  public function delete_detail($id)
  {
    $this->db->where('Facture', $id);
    $this->db->delete('detailvente');
  }
  public function delete_commande($id)
  {
    $this->db->select('Id_facture');
    $this->db->where('Id', $id);
    $query = $this->db->get('facture')->row_object();
    $this->db->flush_cache();


    $this->db->where('Id_facture', $query->Id_facture);
    $this->db->delete('livraison');
  }

   public function tableAutre()
  {
    $this->db->where('Date', date('Y-m-d'));
    $this->db->where('user', $this->session->userdata('matricule'));
    return $this->db->get('autres_outils')->result_object();
  }
  public function insertMessageSimple($message, $type, $sender, $id_discussion, $page)
  {
    $data = [
      'Message' => $message,
      'Type' => $type,
      'sender' => $sender,
      'Id_discussion' => $id_discussion,
      'Page' => $page
    ];
    $this->db->insert('discussion_content', $data);
  }
  public function insertHistoriqueCRX($idClient, $reaction, $Page_groupe, $link_page)
  {
    $dt = new dateTime();
    $heure = $dt->format('H:s:i');
    $data = [
      'Id_CRX' => $idClient,
      'Reaction' => $reaction,
      'Page_groupe' => $Page_groupe,
      'Date' => date('Y-m-d'),
      'Heure' => $heure,
      'Publication' => $link_page

    ];
    $this->db->insert('historiques_CRX', $data);
  }

  public function testCRX($link)
  {
    $this->db->like('Link_facebook', $link, 'after');
    return $this->db->get('client_curieux')->row_object();
  }
  public function matriculeCRX()
  {
    $this->db->limit(1);
    $this->db->order_by('Id', 'DESC');
    return $this->db->get('client_curieux')->row_object();
  }

  public function insertMessageSimples($message, $type, $sender, $id_discussion, $Id_reponse, $page,$date=null,$heure=null,$types=null)
  {
    $data = [
      'Message' => $message,
      'Type' => $type,
      'sender' => $sender,
      'Id_discussion' => $id_discussion,
      'Id_reponse' => $Id_reponse,
      'Page' => $page,
      'date'=>$date,
      'heures'=>$heure,
      'types'=>$types
    ];
    $this->db->insert('discussion_content', $data);
  }


  public function creatDiscussion($codeDis, $client)
  {
    $data = [
      'id_discussion' => $codeDis,
      'operatrice' => $this->session->userdata('matricule'),
      'client' => $client,
      'statut' => 'a_suivre'
    ];

    $this->db->insert('discussion', $data);
  }

  public function id_discussion()
  {
    return  $this->db->count_all_results('discussion');
  }

  public function changeStatutDiscussion($id_discussion, $statut)
  {
    $this->db->set('statut', $statut);
    $this->db->where('id_discussion', $id_discussion);
    $this->db->update('discussion');
  }

  public function autocomplete_commerciele($mot)
  {
    $this->db->select('Matricule,Nom,Prenom');
    $this->db->like('Matricule', $mot);
    $this->db->or_like('Nom', $mot);
    $this->db->or_like('Prenom', $mot);
    return $this->db->get('personnel')->result_object();
  }

  public function table_resume($date)
  {
    /* SELECT `id`, `id_discussion`, `operatrice`, `client`, `statut` FROM `discussion` WHERE 1
  SELECT `Id`, `Message`, `Type`, `sender`, `Id_discussion`, `Id_reponse`, `heure` FROM `discussion_content` WHERE 1*/
    $this->db->distinct();
    $this->db->select('discussion.operatrice');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    return $this->db->get('discussion_content')->result_object();
  }
  public function table_ca($date)
  {
    $this->db->group_by('personnel.Prenom');
    //$this->db->distinct();
    $this->db->select('discussion.operatrice,personnel.Prenom');
    $this->db->or_like('discussion_content.heure', $date, 'after');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->join('personnel', 'discussion.operatrice=personnel.Matricule');
    return $this->db->get('discussion_content')->result_object();
  }

  public function ca_opl($opl, $date)
  {
    $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail,facture.Matricule_personnel');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->where('facture.Date', $date);
    $this->db->where('facture.Id_de_la_mission', "FACEBOOK");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }

  public function table_listeclient($date, $user)
  {
    $this->db->distinct();
    $this->db->select('discussion.client');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->where('discussion.operatrice', $user);
    $this->db->like('discussion_content.heure', $date, 'after');
    return $this->db->get('discussion_content')->result_object();
  }

  public function statut($client, $user, $date = FALSE)
  {

    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->where('discussion.operatrice', $user);
    $this->db->where('discussion.client', $client);
    $this->db->like('discussion_content.heure', $date, 'after');
    return $this->db->get('discussion_content')->result_object();
  }


  /*public function retourClient($code_client){
  $this->db->like('Code_client',$code_client);
  $data=$this->db->get('client')->row_object();
  if(!$data){
    $this->db->flush_cache();
    $this->db->like('Code_client',$code_client);
    $resultat=$this->db->get('clientpo')->row_object();
    if($resultat){
      return $resultat;
    }else{
      $this->db->flush_cache();
      $this->db->like('Code_client',$code_client);
      return $this->db->get('client_curieux')->row_object();
    }
  }else{
    return $data;  
  }

}*/
  public function retourClient($code_client)
  {

    $this->db->like('Code_client', $code_client);
    $resultat = $this->db->get('clientpo')->row_object();
    if ($resultat) {
      return $resultat;
    } else {
      $this->db->flush_cache();
      $this->db->like('Code_client', $code_client);
      return $this->db->get('client_curieux')->row_object();
    }
  }

  public function retourClientNom($code_client)
  {
    $this->db->select('Nom');
    $this->db->like('Code_client', $code_client);
    return $this->db->get('clientpo')->row_object();
  }

  public function  user($matricule)
  {
    $this->db->where('matricule', $matricule);
    return $this->db->get('personnel')->row_object();
  }

  function returnLastIdClientCrx()
  {
    $this->db->limit(1);
    $this->db->order_by('Id', 'DESC');
    return $this->db->get('client_curieux')->row_object();
  }

  public function factureVentCRX($client)
  {
    $this->db->like('client.lien_facebook', $client, 'after');
    $this->db->join('facture', 'facture.Code_client=client.Code_client');
  }


  public function groupeuser($user = FALSE)
  {
    $this->db->where('operatrice', $user);
    $this->db->where('statut', 'on');
    return $this->db->get('page_fb')->row_object();
  }
  public function usergroupefacture($page, $code_client)
  {
    $this->db->where('Code_client', $code_client);
    $this->db->where('Page', $page);
    return $this->db->count_all_results('facture');
  }
  public function usergroupefactureCMT($page, $code_client)
  {

    $this->db->join('discussion', 'discussion.Id_discussion=discussion_content.Id_discussion');
    $this->db->where('discussion_content.Page', $page);
    $this->db->where('discussion.client', $code_client);
    return $this->db->count_all_results('discussion_content');
  }

  public function groupeusers()
  {
    return $this->db->get('comptefb')->result_object();
  }

  public function ca_facture_opl($opls, $date)
  {
    $this->db->select('detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail,facture.Matricule_personnel');
    $this->db->where('facture.Matricule_personnel', $opls);
    $this->db->where('facture.Date', $date);
    $this->db->where('facture.Id_de_la_mission', "FACEBOOK");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

  public function ca_facture_oplivre($opls, $date)
  {
    $this->db->select('detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Matricule_personnel', $opls);
    $this->db->where('facture.Date', $date);
    $this->db->where('facture.Status', 'livre');
    $this->db->where('facture.Id_de_la_mission', "FACEBOOK");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_fact_mois($opls = false, $mois=null, $dateD = null, $dateF = null)
  {
    $this->db->select('detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    if ($opls != false or $opls != '') {
      $this->db->where('facture.Matricule_personnel', $opls);
    }
    if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
    }
    $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    //$this->db->where('facture.Date',$date);

    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture($opls, $date)
  {
    $this->db->select('detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK', 'after');
    $this->db->where('facture.Date', $date);
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }
  public function reppublication($user, $date)
  {
    $this->db->select('Code_publication');
    $this->db->like('Date', $date, 'after');
    $this->db->where('user', $user);
    return $this->db->get('autres_outils')->result_object();
  }


  /*public function repopll($date, $user)
  {
    $this->db->select('discussion_content.Id_reponse,discussion_content.Id_discussion,discussion.client,discussion_content.heure,discussion_content.Type,discussion_content.Page,dataDiscussion.CodeProduit,dataDiscussion.CodeDiscussion,comptefb.Nom_page');
    $this->db->join('dataDiscussion', 'dataDiscussion.CodeDiscussion=discussion_content.Id_reponse');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->join('comptefb', 'discussion_content.page=comptefb.id');
    $this->db->group_by('heure');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $user);
    $this->db->where('(dataDiscussion.CodeDiscussion LIKE "P%" OR dataDiscussion.CodeDiscussion LIKE "S%" OR dataDiscussion.CodeDiscussion LIKE "A%" OR dataDiscussion.CodeDiscussion LIKE "L%" OR dataDiscussion.CodeDiscussion LIKE "C%" OR dataDiscussion.CodeDiscussion LIKE "F%" OR dataDiscussion.CodeDiscussion LIKE "M%" OR dataDiscussion.CodeDiscussion LIKE "" OR dataDiscussion.CodeDiscussion LIKE "NULL")');
    //$this->db->where('(discussion_content.Type LIKE "vente" OR discussion_content.Type LIKE "commentaire" OR discussion.Type LIKE "message")');
    $this->db->where('discussion_content.sender', 'OPL');
    $this->db->limit(400);
    return $this->db->get('discussion_content')->result_object();
  }*/
  public function repopll($date = FALSE, $user = FALSE)
  {
    $this->db->select('discussion_content.Id_reponse,discussion_content.Id_discussion,discussion.client,discussion_content.heure,discussion_content.Type,discussion_content.Page,dataDiscussion.CodeProduit,dataDiscussion.CodeDiscussion,comptefb.Nom_page');
    $this->db->join('dataDiscussion', 'dataDiscussion.CodeDiscussion=discussion_content.Id_reponse');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->join('comptefb', 'discussion_content.page=comptefb.id');
    $this->db->group_by('heure');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $user);
    $this->db->where('(dataDiscussion.CodeDiscussion LIKE "P%" OR dataDiscussion.CodeDiscussion LIKE "S%" OR dataDiscussion.CodeDiscussion LIKE "A%" OR dataDiscussion.CodeDiscussion LIKE "L%" OR dataDiscussion.CodeDiscussion LIKE "C%" OR dataDiscussion.CodeDiscussion LIKE "F%" OR dataDiscussion.CodeDiscussion LIKE "M%" OR dataDiscussion.CodeDiscussion LIKE "" OR dataDiscussion.CodeDiscussion LIKE "NULL")');
    $this->db->where('(discussion_content.sender LIKE "OPL" OR discussion_content.sender LIKE "SAV" )');
    $this->db->limit(400);
    return $this->db->get('discussion_content')->result_object();
  }
  public function repopl($date, $user)
  {
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->join('comptefb', 'discussion_content.page=comptefb.id');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $user);
    $this->db->where('discussion_content.sender', 'OPL');
    return $this->db->get('discussion_content')->result_object();
  }
  public function detail_discussion_operatrice($date, $user, $client)
  {
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $user);
    $this->db->where('discussion.client', $client);
    return $this->db->get('discussion_content')->result_object();
  }
  public function detail_publications($user, $date)
  {
    $this->db->select('Date,Heure,Code_publication,Actions,Types,Code_produit,Nom_produit,Nom_groupe,');
    $this->db->like('autres_outils.User', $user);
    $this->db->where('Date', $date);
    $this->db->limit(400);
    return $this->db->get('autres_outils')->result_object();
  }
  public function detail_publication($user, $date)
  {
    $this->db->select('Date,Heure,Code_publication,Actions,Types,Code_produit,Nom_produit,Nom_groupe,Lien_support');
    $this->db->like('autres_outils.User', $user);
    $this->db->where('Date', $date);
    $this->db->limit(300);
    return $this->db->get('autres_outils')->result_object();
  }
  public function details_discussion($user, $client, $date = FALSE)
  {
    $this->db->select('discussion_content.check,discussion_content.appreciation,discussion_content.Id,discussion_content.heure,discussion_content.Message,discussion_content.Type,discussion.client,discussion_content.sender');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    if ($date == FALSE) {
      $this->db->like('discussion_content.heure', date('Y-m-d'));
    } else {
      $this->db->like('discussion_content.heure', $date);
    }
    $this->db->where('discussion.client', $client);
    $this->db->where('discussion.operatrice', $user);



    return $this->db->get('discussion_content')->result_object();
  }
  public function updateProduitRelnce($requette,$data){
    return $this->db->where($requette)->update('relanceDiscussion',$data);
  }
  public function table_rapport($date, $user)
  {
    //$this->db->or_like('discussion_content.heure',$date,'after');
    //$this->db->join('discussion','personnel.Matricule=discussion.operatrice');
    $this->db->join('discussion_content', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $user);
    $this->db->group_by('discussion.id_discussion');
    return $this->db->get('discussion')->result_object();
  }
  public function tablenom($date, $user)
  {
    $this->db->select('clientpo.Nom');
    $this->db->join('discussion_content', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->join('clientpo', 'clientpo.Code_client=discussion_content.client');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $user);
    $this->db->group_by('discussion.id_discussion');
    return $this->db->get('discussion')->result_object();
  }
  public function autocomplete_ville($mot)
  {
    $this->db->distinct();
    $this->db->select('Ville_Commune');
    $this->db->where('Fokontany', $mot);
    return $this->db->get('villes')->result_object();
  }

  public function autocomplete_quartier($mot)
  {
     return $this->db->distinct()
     ->select('Fokontany')
     ->like('Fokontany', $mot)
     ->limit(6)
     ->get('villes')
     ->result_object();
  }

  public function autocomplete_discrict($quartier, $ville)
  {
    $this->db->distinct();
    $this->db->select('District');
    $this->db->like('Fokontany', $ville);
    $this->db->like('Ville_Commune', $quartier);
    return $this->db->get('villes')->result_object();
  }

  public function get_all_discricts()
  {
    $this->db->distinct();
    $this->db->select('District');
    $this->db->from('villes');
    $this->db->where('District !=', '');
    return $this->db->get()->result();
  }

  public function autocomplete_coach($mot)
  {
    $this->db->select('Matricule,Nom,Prenom');
    $this->db->not_like('Matricule', "VP");
    $this->db->or_not_like('Matricule', "MAG");
    $this->db->or_not_like('Matricule', "AP");
    $this->db->or_like('Matricule', $mot);
    $this->db->or_like('Nom', $mot);
    $this->db->or_like('Prenom', $mot);

    return $this->db->get('personnel')->result_object();
  }

  public function exports_livraison($date, $type)
  {
    /* $this->db->join('facture','facture.Id=detailvente.Facture');
   $this->db->join('prix','prix.Id=detailvente.Id_prix');
   $this->db->join('produit','');
   $this->db->join('livraison',);
   return $this->db->get('detailvente')->result_object();*/
  }


  public function getexportecom()
  {
    $query = $this->db->query("SELECT facture.Id_facture, clientpo.Nom, facture.Date, detailvente.Id_prix, livraison.date_de_livraison,
   clientpo.lien_facebook, facture.contacts , prix.Prix_detail, detailvente.Quantite, facture.lieu_de_livraison,
    facture.Matricule_personnel, facture.Matricule_personnel,facture.Status, 
    facture.Quartier,facture.Ville, livraison.frais 
    FROM `facture`, clientpo, 
    livraison, detailvente, prix 
    WHERE clientpo.Code_client LIKE facture.Code_client 
    AND livraison.Id_facture like facture.Id_facture 
    AND facture.Id like detailvente.Facture
   AND prix.Id like detailvente.Id_prix 
   AND facture.date like '2020-10-23'");
    return $query->result();
  }

  public function getexporteliv()
  {
    $this->db->select('facture.Matricule_personnel, clientpo.Nom, clientpo.lien_facebook, facture.Ville, facture.contacts,prix.Code_produit, livraison.date_de_livraison, livraison.frais, facture.Code_client,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,facture.Status, facture.lieu_de_livraison,  facture.Id_facture, prix.Prix_detail, facture.date');
    $this->db->where('facture.date', date('Y-m-d'));
    $this->db->join('facture', 'facture.Id = detailvente.Facture');
    $this->db->join('prix', 'prix.Id = detailvente.Id_prix');
    $this->db->join('produit', 'produit.Code_produit = prix.Code_produit');
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join('clientpo', 'facture.Code_client=clientpo.Code_client');
    return $this->db->get('detailvente')->result_object(); 

    
  /*  $query = $this->db->query("SELECT facture.Id_facture, clientpo.Nom, facture.Date, detailvente.Id_prix, livraison.date_de_livraison,
   clientpo.lien_facebook, facture.contacts , prix.Prix_detail, detailvente.Quantite, facture.lieu_de_livraison,
    facture.Matricule_personnel, facture.Matricule_personnel,facture.Status, 
    facture.Quartier,facture.Ville, livraison.frais 
    FROM `facture`, clientpo, 
    livraison, detailvente, prix 
    WHERE clientpo.Code_client LIKE facture.Code_client 
    AND livraison.Id_facture like facture.Id_facture 
    AND facture.Id like detailvente.Facture
   AND prix.Id like detailvente.Id_prix 
   AND facture.Status like 'confirmer'
   AND livraison.date_de_livraison like '2020-10-24'");
   return $query->result();*/
    
  }
  public function enregister_remarque($Id, $appreciation)
  {
    $this->db->where('Id', $Id);
    $this->db->update('discussion_content', $appreciation);
  }
  public function comptefb()
  {
    return $this->db->get('comptefb')->result_object();
  }

  public function sondage($data)
  {
    return $this->db->insert('sondage', $data);
  }

  public function tablesondage()
  {
    $this->db->select('date,type,nom_client,lien_facebook,marque,produit,commentaire,interpretation');
    $this->db->where('date', date('Y-m-d'));
    return $this->db->get('sondage')->result_object();
  }
  public function tableSondages()
  {
    $this->db->select('date,type,nom_client,lien_facebook,marque,produit,commentaire,interpretation');

    return $this->db->get('sondage')->result_object();
  }

  public function autocomplete_mark($mot)
  {
    $this->db->select('Marque,Produit');
    $this->db->like('Marque', $mot);
    $this->db->or_like('Produit', $mot);
    return $this->db->get('produit_sondage')->result_object();
  }


  public function autocomplete_prod($mot)
  {
    $this->db->select('Marque,Produit');
    $this->db->like('Produit', $mot);
    $this->db->or_like('Marque', $mot);
    return $this->db->get('produit_sondage')->result_object();
  }
  public function presence()
  {
  }
  public function test_nb_discussion_client($codeclient)
  {
    $this->db->where('Id_discussion', $codeclient);
    $this->db->where('sender', 'CLT');
    return $this->db->count_all_results('discussion_content');
  }

  public function test_nb_matricule_client($codeclient)
  {
    $this->db->where('id_discussion', $codeclient);
    return $this->db->get('discussion')->row_object();
  }
  public function detail_CRX($codeclient)
  {
    $this->db->where('Code_client', $codeclient);
    return $this->db->get('client_curieux')->row_object();
  }
  public function lastCRX()
  {
    $this->db->select('Id');
    $this->db->limit(1);
    $this->db->order_by('Id', 'DESC');
    return $this->db->get('client_curieux')->row_object();
  }
  public function lastCMT()
  {
    $this->db->select('id');
    $this->db->limit(1);
    $this->db->order_by('id', 'DESC');
    return $this->db->get('clientpo')->row_object();
  }

  public function testFactureCMT($client)
  {
    $this->db->where('Code_client', $client);
    $this->db->where('Status', 'livre');
    return $this->db->count_all_results('facture');
  }
  public function tes_Facture_statut($Code_client)
  {
    $this->db->where('Code_client', $Code_client);
    return $this->db->get('facture')->result_object();
  }

  public function retour_detail_discussion($page, $client)
  {
    $this->db->join('discussion', 'discussion_content.Id_discussion=discussion.id_discussion');
    $this->db->where('discussion.client', $client);
    $this->db->where('discussion_content.Page', $page);
    $this->db->where('discussion_content.sender', 'CLT');
    return $this->db->get('discussion_content')->result_array();
  }
  public function curieux_provenance_CMT($codeClient)
  {
    $this->db->select('Provenance');
    $this->db->where('Code_client', $codeClient);
    return $this->db->get('clientpo')->row_object();
  }

  public function curieux_provenance_CLT($codeClient)
  {
    $this->db->select('clientpo.Provenance');
    $this->db->where('client.Code_client', $codeClient);
    $this->db->join('clientpo', 'clientpo.Code_client=client.Provenance');
    return $this->db->get('client')->row_object();
  }
  public function CMT_provenance_CLT($codeClient)
  {
    $this->db->select('clientpo.Code_client');
    $this->db->where('client.Code_client', $codeClient);
    $this->db->join('clientpo', 'clientpo.Code_client=client.Provenance');
    return $this->db->get('client')->row_object();
  }
  public function testFacture_discussion($client, $page)
  {
    $this->db->where('Code_client', $client);
    $this->db->where('Page', $page);
    $this->db->where('Status', 'livre');
    return $this->db->count_all_results('facture');
  }
  public function retour_page($id)
  {
    $this->db->where('id', $id);
    return $this->db->get('comptefb')->row_object();
  }
  public function pres($date, $user = FALSE)
  {
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->like('discussion_content.heure', $date, 'after');
    if ($user != FALSE) {
      $this->db->where('discussion.operatrice', $user);
    }
    $this->db->where('discussion_content.sender', 'OPL');
    return $this->db->get('discussion_content')->result_object();
  }

  public function pres_calendrier($date, $user = FALSE)
  {
    $this->db->distinct();
    $this->db->select('operatrice');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->like('discussion_content.heure', $date, 'after');
    if ($user != FALSE) {
      $this->db->where('discussion.operatrice', $user);
    }
    $this->db->where('discussion_content.sender', 'OPL');
    return $this->db->get('discussion_content')->result_object();
  }

  public function diff_time($t1, $t2)
  {

    $tab = explode(":", $t1);
    $tab2 = explode(":", $t2);

    $h = $tab[0];
    $m = $tab[1];
    $s = $tab[2];
    $h2 = $tab2[0];
    $m2 = $tab2[1];
    $s2 = $tab2[2];

    if ($h2 > $h) {
      $h = $h + 24;
    }
    if ($m2 > $m) {
      $m = $m + 60;
      $h2++;
    }
    if ($s2 > $s) {
      $s = $s + 60;
      $m2++;
    }

    $ht = $h - $h2;
    $mt = $m - $m2;
    $st = $s - $s2;
    if (strlen($ht) == 1) {
      $ht = "0" . $ht;
    }
    if (strlen($mt) == 1) {
      $mt = "0" . $mt;
    }
    if (strlen($st) == 1) {
      $st = "0" . $st;
    }
    return $ht . ":" . $mt . ":" . $st;
  }

  public function detail_pre($user, $date)
  {

    $this->db->select('Date,Heure,Code_publication,Actions,Types,Code_produit,Nom_produit,Nom_groupe,Lien_support');
    $this->db->like('autres_outils.User', $user);
    $this->db->where('Date', $date);
    return $this->db->get('autres_outils')->result_object();
  }
  public function etat_vente($date)
  {
    $this->db->select('facture.Id,facture.Matricule_personnel,facture.Id_de_la_mission,facture.Matricule_personnel,facture.Ress_sec_oplg,facture.Status,livraison.date_de_livraison,facture.Code_client,facture.data_de_livraison');
    $this->db->where('facture.Date', $date);
    $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    return $this->db->get('facture')->result_object();
  }
  public function nom_page($user, $date)
  {
    $this->db->select('comptefb.Nom_page');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $user);
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->join('comptefb', 'comptefb.id=discussion_content.Page');
    return $this->db->get('discussion_content')->result_object();
  }


  public function detail_etat_vente_facture($date, $date2)
  {
    $this->db->select('facture.Ress_sec_oplg,facture.Ress_sec_oplg, facture.Id_zone,facture.District,facture.Id,livraison.date_de_livraison,facture.Id_de_la_mission,facture.Matricule_personnel,facture.Status,facture.Code_client,facture.data_de_livraison');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->where('facture.Date', $date);
    $this->db->where('livraison.date_de_livraison', $date2);
    $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    return $this->db->get('facture')->result_object();
  }

  public function detail_etat_vente($date, $date2)
  {
    $this->db->select('livraison.date_de_livraison,facture.Id_de_la_mission,facture.Matricule_personnel,facture.Status,produit.Designation,facture.Code_client,facture.data_de_livraison,prix.Prix_detail');

    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('livraison', 'livraison.Id_facture=facture.Id_facture');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    $this->db->where('facture.Date', $date);
    $this->db->where('livraison.date_de_livraison', $date2);
    $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    return $this->db->get('detailvente')->result_object();
  }
  public function test_lien_facebook_crx($link)
  {
    $this->db->where('lien_facebook', $link);
    return $this->db->get('client_curieux')->row_object();
  }

  public function client_CRX_last()
  {
    return $this->db->get('client_curieux')->result_object();
  }

  public function updatefacture($oldeCodeClient, $newCodeClient)
  {
    $data = array(
      'Code_client' => $newCodeClient,
    );

    $this->db->where('Code_client', $oldeCodeClient);
    $this->db->update('facture', $data);
  }

  public function updateDiscussion($oldeCodeClient, $newCodeClient)
  {
    $data = array(
      'client' => $newCodeClient
    );

    $this->db->where('client', $oldeCodeClient);
    $this->db->update('discussion', $data);
  }


  public function updateclient($link, $oldeCodeClient)
  {
    $data = array(
      "matricule_old_old" => $oldeCodeClient
    );

    $this->db->where('lien_facebook', $link);
    $this->db->update('client_curieux', $data);
  }
  public function date_presence($user, $date = false)
  {
    if ($date % 2 == 0) {
      $moi_sc = $date - 1;
      $moi_pr = $date;
    } else {
      $moi_sc = $date + 1;
      $moi_pr = $date;
    }
    $this->db->distinct();
    $this->db->select('Date');
    $this->db->where('Date between "' . date('Y') . '-' . $moi_sc . '-20" AND "' . date('Y') . '-' . $moi_pr . '-20"');
    $this->db->where('User', $user);
    return $this->db->get('autres_outils')->result_object();
  }
  public function update_facture_annex($oldeCodeClient, $newCodeClient)
  {
    $data = array(
      'Code_client' => $newCodeClient
    );
    $this->db->where('Code_client', $oldeCodeClient);
    $this->db->update('facture_annex', $data);
  }
  public function table_resume2($mois = null, $dateD = null, $dateF = null)
  {
    /* SELECT `id`, `id_discussion`, `operatrice`, `client`, `statut` FROM `discussion` WHERE 1
  SELECT `Id`, `Message`, `Type`, `sender`, `Id_discussion`, `Id_reponse`, `heure` FROM `discussion_content` WHERE 1*/
    $this->db->distinct();
    $this->db->select('discussion.operatrice');
    //$this->db->or_like('discussion_content.heure',$mois,'after');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    if ($mois != null) {
      $this->db->like('discussion_content.heure', $mois, 'after');
    } else {
      $this->db->where("(discussion_content.heure BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    return $this->db->get('discussion_content')->result_object();
  }
  public function table_rapport2($mois = null, $user=null, $dateD = null, $dateF = null)
  {
    //$this->db->or_like('discussion_content.heure',$date,'after');
    //$this->db->join('discussion','personnel.Matricule=discussion.operatrice');
    $this->db->join('discussion_content', 'discussion.id_discussion=discussion_content.Id_discussion');
    if ($mois != null) {
      $this->db->like('discussion_content.heure', $mois, 'after');
    } else {
      $this->db->where("(discussion_content.heure BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }

    $this->db->where('discussion.operatrice', $user);
    $this->db->group_by('discussion.id_discussion');
    return $this->db->get('discussion')->result_object();
  }


  public function ca_facture_opl2($mois = null, $opls=null, $dateD = null, $dateF = null)
  {
    $this->db->select('facture.Date,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Matricule_personnel', $opls);
    //$this->db->like('facture.Date',$mois,'after');
    if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_op($mois = null, $opl=null)
  {
    $mois = date('Y-m');
    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $mois, 'after');
    /*if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }*/
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_mois_passe($month1 = null, $opl)
  {
    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $month1, 'after');
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour_passe($dat = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour1($dat1 = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat1);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour2($dat2 = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat2);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour3($dat3 = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat3);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour4($dat4 = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat4);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour5($dat5 = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat5);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  ////////////// calcul chiffre d'affaire par Commercial (VP) ////////////////////
  public function chiffre_d_affaires_VP($mois = null, $opls, $dateD = null, $dateF = null)
  {
    $i = 0;
    $this->db->select('facture.Date,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Matricule_personnel', $opls);
    if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->where('(facture.Ress_sec_oplg LIKE "VP%" OR facture.Ress_sec_oplg LIKE "CO%" OR facture.Ress_sec_oplg LIKE "VT%")');
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    $data = $this->db->get('detailvente')->result_array();
    $datax['id_prix'] = 0;
    $datax['Prix_detail'] = 0;
    $datax['Type_de_prix'] = 0;
    $datax['Quantite'] = 0;
    $datax['Montant'] = 0;
    if ($data) {
      foreach ($data as $data) {
        $datax['id_prix'] += $data['Id_prix'];
        $datax['Prix_detail'] = $data['Prix_detail'];
        $datax['Type_de_prix'] = $data['Type_de_prix'];
        $datax['Quantite'] = $data['Quantite'];
        $datax['Montant'] += ((int)$this->retourPrix($data['Id_prix'], $data['Type_de_prix']) * $data['Quantite']);
        $i++;
      }
    }
    return $datax;
  }
  ////////////// calcul chiffre d'affaire livé par Commercial (VP) ////////////////////
  public function chiffre_d_affaires_VPL($mois = null, $opls, $dateD = null, $dateF = null)
  {
    $i = 0;
    $this->db->select('facture.Date,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Matricule_personnel', $opls);
    if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->like('facture.status', 'livre');
    $this->db->where('(facture.Ress_sec_oplg LIKE "VP%" OR facture.Ress_sec_oplg LIKE "CO%" OR facture.Ress_sec_oplg LIKE "VT%")');
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    $data = $this->db->get('detailvente')->result_array();
    $datax['id_prix'] = 0;
    $datax['Prix_detail'] = 0;
    $datax['Type_de_prix'] = 0;
    $datax['Quantite'] = 0;
    $datax['Montant'] = 0;
    if ($data) {
      foreach ($data as $data) {
        $datax['id_prix'] += $data['Id_prix'];
        $datax['Prix_detail'] = $data['Prix_detail'];
        $datax['Type_de_prix'] = $data['Type_de_prix'];
        $datax['Quantite'] = $data['Quantite'];
        $datax['Montant'] += ((int)$this->retourPrix($data['Id_prix'], $data['Type_de_prix']) * $data['Quantite']);
        $i++;
      }
    }
    return $datax;
  }

  /////////////////////////////////////////////////////////////////////////////////////////////


  public function ca_facture_opl3($mois = null, $opls, $dateD = null, $dateF = null)
  {
    $this->db->select('facture.Date,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Matricule_personnel', $opls);
    //$this->db->like('facture.Date',$mois,'after');
    if ($mois != null) {
      $this->db->like('facture.Date', $mois);
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->where('facture.Status', 'livre');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

  ////////////////////////calcul chiffre d'affaire par OPL (VB)///////////////////////////
  public function sommeFacebook($mois = null, $opls, $dateD = null, $dateF = null)
  {
    $i = 0;
    $this->db->select('facture.Date,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Matricule_personnel', $opls);
    //$this->db->like('facture.Date',$mois,'after');
    if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->like('facture.Ress_sec_oplg', 'NONE');
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    $data = $this->db->get('detailvente')->result_array();
    $datax['id_prix'] = 0;
    $datax['Prix_detail'] = 0;
    $datax['Type_de_prix'] = 0;
    $datax['Quantite'] = 0;
    $datax['Montant'] = 0;
    if ($data) {
      foreach ($data as $data) {
        $datax['id_prix'] += $data['Id_prix'];
        $datax['Prix_detail'] = $data['Prix_detail'];
        $datax['Type_de_prix'] = $data['Type_de_prix'];
        $datax['Quantite'] = $data['Quantite'];
        $datax['Montant'] += ((int)$this->retourPrix($data['Id_prix'], $data['Type_de_prix']) * $data['Quantite']);
        $i++;
      }
    }
    return $datax;
  }
  ////////////////////////////////////////////calcul chiffre livré d'affaire par OPL (VB)/////////////////////////////////////////////////////////
  public function chiffre_d_affaires_VBL($mois = null, $opls, $dateD = null, $dateF = null)
  {
    $i = 0;
    $this->db->select('facture.Date,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Matricule_personnel', $opls);
    //$this->db->like('facture.Date',$mois,'after');
    if ($mois != null) {
      $this->db->like('facture.Date', $mois, 'after');
    } else {
      $this->db->where("(facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->where('facture.Status', 'livre');
    $this->db->like('facture.Ress_sec_oplg', 'NONE');
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    $data = $this->db->get('detailvente')->result_array();
    $datax['id_prix'] = 0;
    $datax['Prix_detail'] = 0;
    $datax['Type_de_prix'] = 0;
    $datax['Quantite'] = 0;
    $datax['Montant'] = 0;
    if ($data) {
      foreach ($data as $data) {
        $datax['id_prix'] += $data['Id_prix'];
        $datax['Prix_detail'] = $data['Prix_detail'];
        $datax['Type_de_prix'] = $data['Type_de_prix'];
        $datax['Quantite'] = $data['Quantite'];
        $datax['Montant'] += ((int)$this->retourPrix($data['Id_prix'], $data['Type_de_prix']) * $data['Quantite']);
        $i++;
      }
    }
    return $datax;
  }

  public function repopl2($mois, $user, $dateD = null, $dateF = null)
  {
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->join('comptefb', 'discussion_content.page=comptefb.id');
    if ($mois != null) {
      $this->db->like('discussion_content.heure', $mois, 'after');
    } else {
      $this->db->where("(discussion_content.heure BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->where('discussion.operatrice', $user);
    $this->db->where('discussion_content.sender', 'OPL');
    return $this->db->get('discussion_content')->result_object();
  }
  public function reppublication2($user, $mois = null, $dateD = null, $dateF = null)
  {
    $this->db->select('Code_publication');
    if ($mois != null) {
      $this->db->like('Date', $mois);
    } else {
      $this->db->where("(Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->where('user', $user);
    return $this->db->get('autres_outils')->result_object();
  }
  public function reppublication3($user, $mois = null, $dateD = null, $dateF = null)
  {
    $this->db->select('Code_publication');
    if ($mois != null) {
      $this->db->like('Date', $mois);
    } else {
      $this->db->where("(Date BETWEEN '" . $dateD . "'AND'" . $dateF . "')");
    }
    $this->db->where('user', $user);
    return $this->db->get('autres_outils')->result_object();
  }
  public function insert($data)
  {
    return $this->db->insert('gr_publication', $data);
  }
  public function tableinsert()
  {
    $this->db->select('Code_groupe,Nom_groupe,Lien_support');
    return $this->db->get('gr_publication')->result_object();
  }
  public function autocomplete_groupe($mot)
  {
    $this->db->select('Code_groupe,Nom_groupe');
    $this->db->like('Code_groupe', $mot);
    $this->db->or_like('Nom_groupe', $mot);
    return $this->db->get('gr_publication')->result_object();
  }
  public function Ajout_OPl()
  {
    return $this->db->insert('personnel');
  }
  public function tableajout()
  {
    return $this->db->get('personnel')->result_object();
  }

  public function getstatutclient($Code_client)
  {
    $query = $this->db->query("SELECT SUM(detailvente.Quantite*prix.Smile_LV1) as smile, SUM(detailvente.Quantite*prix.Zen_LV1) as koty FROM `facture`, detailvente, prix 
   WHERE detailvente.Facture=facture.Id AND detailvente.Id_prix=prix.Id AND facture.Status like 'livre' and facture.Code_client like '$Code_client' ");
    return $query->result();
  }


  public function gettotalsmileskoty($Code_client)
  {
    $query = $this->db->query("SELECT SUM(
  CASE 
    WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
    ELSE  '0'
  END 
) AS 'smiles',
SUM(
  CASE 
    WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
    ELSE  '0'
  END 
) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$Code_client' AND facture.`data_de_livraison` BETWEEN '2021-10-01' AND '2021-12-31'");
    return $query->result();
  }

  public function gettotalsmileskotyGlobale($Code_client)
  {
    $query = $this->db->query("SELECT SUM(
  CASE 
    WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
    ELSE  '0'
  END 
) AS 'smiles',
SUM(
  CASE 
    WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
    WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
    ELSE  '0'
  END 
) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$Code_client' AND facture.`data_de_livraison` like '2021-%' ");
    return $query->result();
  }

  public function getclientstatutAnnuel($smiles)
  {
    if ($smiles <= 14999 and $smiles >= 0) {
      $statut = "BLUE";
      return $statut;
    } elseif ($smiles <= 24999 and $smiles >= 15000) {
      $statut = "BRONZE";
      return $statut;
    } elseif ($smiles <= 44999 and $smiles >= 25000) {
      $statut = "SILVER";
      return $statut;
    } elseif ($smiles <= 99999 and $smiles >= 50000) {
      $statut = "GOLD";
      return $statut;
    } elseif ($smiles <= 9999999 and $smiles >= 100000) {
      $statut = "PLATINIUM";
      return $statut;
    } else {
      $statut = "Votre statut n'est pas valide, veillez consulter le responsable technique";
      return $statut;
    }
  }

  public function getkotysmiletotalpossible($facture)
  {
    $query = $this->db->query("SELECT produit.Designation,  SUM(
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
          ELSE  '0'
        END 
      ) AS 'smiles',
      SUM(
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
          ELSE  '0'
        END 
      ) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix` JOIN produit ON produit.Code_produit = prix.Code_produit   WHERE  facture.Id_facture like '$facture'");
    return $query->result();
  }

  public function getkotysmiletotalpossibles($facture)
  {
    $query = $this->db->query("SELECT produit.Designation,  SUM(
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
          ELSE  '0'
        END 
      ) AS 'smiles',
      SUM(
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
          WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
          ELSE  '0'
        END 
      ) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix` JOIN produit ON produit.Code_produit = prix.Code_produit   WHERE  facture.Id_facture like '$facture'");
    return $query->row_object();
  }
  public function getkotyetsmilesdetail($facture)
  {
    $query = $this->db->query("SELECT produit.Designation, detailvente.Quantite, 
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`
          WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`
          WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`
          WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`
          WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`
          ELSE  '0'
        END 
      AS 'smiles',
     
        CASE 
          WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`
          WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`
          WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`
          WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`
          WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`
          ELSE  '0'
        END 
      AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix` JOIN produit ON produit.Code_produit = prix.Code_produit   WHERE  facture.Id_facture like '$facture'");
    return $query->result();
  }

  public function getclientstatuttrimes($smiles)
  {
    if ($smiles <= 1499 and $smiles >= 0) {
      $statut = "LEVEL 1";
      return $statut;
    } elseif ($smiles <= 2499 and $smiles >= 1500) {
      $statut = "LEVEL 2";
      return $statut;
    } elseif ($smiles <= 4999 and $smiles >= 2500) {
      $statut = "LEVEL 3";
      return $statut;
    } elseif ($smiles <= 9999 and $smiles >= 5000) {
      $statut = "LEVEL 4";
      return $statut;
    } elseif ($smiles <= 99999999 and $smiles >= 10000) {
      $statut = "LEVEL 5";
      return $statut;
    } else {

      $statut = "Votre statut n'est pas valide, veillez consulter le responsable technique";
      return $statut;
    }
  }
  public function getpointclient($codeclient)
  {
    switch ($level) {
      case "level_1":
        $query = $this->db->query("SELECT SUM(detailvente.Quantite*prix.Smile_LV1) as smile, SUM(detailvente.Quantite*prix.Zen_LV1) as koty FROM `facture`, detailvente, prix 
        WHERE detailvente.Facture=facture.Id AND detailvente.Id_prix=prix.Id AND facture.Status like 'livre' and facture.Code_client like '$Code_client' ");
        return $query->result();
        break;
      case "level_2":
        $query = $this->db->query("SELECT SUM(detailvente.Quantite*prix.Smile_LV2) as smile, SUM(detailvente.Quantite*prix.Zen_LV2) as koty FROM `facture`, detailvente, prix 
        WHERE detailvente.Facture=facture.Id AND detailvente.Id_prix=prix.Id AND facture.Status like 'livre' and facture.Code_client like '$Code_client' ");
        return $query->result();
        break;
      case "level_3":
        $query = $this->db->query("SELECT SUM(detailvente.Quantite*prix.Smile_LV3) as smile, SUM(detailvente.Quantite*prix.Zen_LV3) as koty FROM `facture`, detailvente, prix 
        WHERE detailvente.Facture=facture.Id AND detailvente.Id_prix=prix.Id AND facture.Status like 'livre' and facture.Code_client like '$Code_client' ");
        return $query->result();
        break;
      case "level_4":
        $query = $this->db->query("SELECT SUM(detailvente.Quantite*prix.Smile_LV4) as smile, SUM(detailvente.Quantite*prix.Zen_LV4) as koty FROM `facture`, detailvente, prix 
        WHERE detailvente.Facture=facture.Id AND detailvente.Id_prix=prix.Id AND facture.Status like 'livre' and facture.Code_client like '$Code_client' ");
        return $query->result();
        break;
      case "level_5":
        $query = $this->db->query("SELECT SUM(detailvente.Quantite*prix.Smile_LV5) as smile, SUM(detailvente.Quantite*prix.Zen_LV5) as koty FROM `facture`, detailvente, prix 
        WHERE detailvente.Facture=facture.Id AND detailvente.Id_prix=prix.Id AND facture.Status like 'livre' and facture.Code_client like '$Code_client' ");
        return $query->result();
        break;
      default:
        echo "Aucun statut trouver";
    }
  }
  public function retourClients($code_client)
  {
    $this->db->select('client.Compte_facebook');
    $this->db->where('Code_client', $code_client);
    $data = $this->db->get('client')->row_object();
    if (!$data) {
      $this->db->select('clientpo.Compte_facebook');
      $this->db->flush_cache();
      $this->db->where('Code_client', $code_client);
      $resultat = $this->db->get('clientpo')->row_object();
      if ($resultat) {
        return $resultat;
      } else {
        $this->db->select('client_curieux.Compte_facebook');
        $this->db->flush_cache();
        $this->db->where('Code_client', $code_client);
        return $this->db->get('client_curieux')->row_object();
      }
    } else {
      return $data;
    }
  }
  public function page()
  {
    //$this->db->where('statut',"on");
    return $this->db->get('page_fb')->result_object();
  }
  public function page_passive()
  {
    $this->db->where('statut', "off");
    return $this->db->get('page_fb')->result_object();
  }
  public function page_actives()
  {
    $this->db->where('statut', "on");
    return $this->db->get('page_fb')->result_object();
  }
  public function asuivre($date, $opls = FALSE)
  {
    $this->db->group_by('discussion_content.Id_discussion');
    $this->db->select('discussion_content.Type');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $opls);
    $this->db->like('discussion_content.Type', "a suivre");
    return $this->db->get('discussion_content')->result_object();
  }
  public function terminer($date, $opls = FALSE)
  {
    $this->db->group_by('discussion_content.Id_discussion');
    $this->db->select('discussion_content.Type');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $opls);
    $this->db->where('(discussion_content.Type LIKE "termi%" OR discussion_content.Type LIKE "vent%")');
    return $this->db->get('discussion_content')->result_object();
  }
  public function en_attente($date, $opls = FALSE)
  {
    $this->db->group_by('discussion_content.Id_discussion');
    $this->db->select('discussion_content.Type');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->like('discussion_content.heure', $date, 'after');
    $this->db->where('discussion.operatrice', $opls);
    $this->db->like('discussion_content.Type', "message", 'after');
    return $this->db->get('discussion_content')->result_object();
  }
  public function table_listeclients($date, $matricule)
  {
    $this->db->distinct();
    $this->db->select('discussion.client');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->where('discussion.operatrice', $matricule);
    $this->db->like('discussion_content.heure', $date, 'after');
    return $this->db->get('discussion_content')->result_object();
  }
  public function details_discu($user, $client, $date = FALSE)
  {
    $this->db->select('discussion.id_discussion');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    if ($date == FALSE) {
      $this->db->like('discussion_content.heure', date('Y-m-d'));
    } else {
      $this->db->like('discussion_content.heure', $date);
    }
    $this->db->where('discussion.client', $client);
    $this->db->where('discussion.operatrice', $user);
    return $this->db->get('discussion_content')->result_object();
  }


  public function modif_satatutPage($Id, $statut)
  {

    $this->db->where('id', $Id);
    $this->db->update('page_fb', array('statut' => $statut));
  }
  public function ca_oplivre($opl, $dat4 = null)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat4);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->where('facture.Status', "livre");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_oplivr($mois = null, $opl)
  {
    $mois = date('Y-m');
    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $mois, 'after');
    $this->db->where('facture.Status', "livre");
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_mois_passe_livre($month1 = null, $opl)
  {
    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $month1, 'after');
    $this->db->where('facture.Status', "livre");
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour3l($dat3 = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat3);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->where('facture.Status', "livre");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour2l($dat2 = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat2);
    $this->db->where('facture.Status', "livre");
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }

  public function ca_facture_jour($date, $opl)
  {
    $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail,facture.Matricule_personnel');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->where('facture.Date', $date);
    $this->db->where('facture.Status', "livre");
    $this->db->where('facture.Id_de_la_mission', "FACEBOOK");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture_jour_passel($dat = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->where('facture.Status', "livre");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function ca_facture5($dat5 = null, $opl)
  {

    $this->db->select('facture.Date,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->like('facture.Date', $dat5);
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->where('facture.Status', "livre");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }

  public function table_ca1($mois)
  {
    $this->db->group_by('personnel.Prenom');
    //$this->db->distinct();
    $this->db->select('facture.Matricule_personnel,personnel.Prenom,personnel.Matricule');
    $this->db->like('facture.Date', $mois, 'after');
    $this->db->where('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('facture')->result_object();
  }
  public function table_ca2($mois)
  {
    $this->db->group_by('personnel.Prenom');
    //$this->db->distinct();
    $this->db->select('personnel.Prenom,personnel.Matricule');
    $this->db->or_like('discussion_content.heure', $mois, 'after');
    $this->db->join('discussion', 'discussion.id_discussion=discussion_content.Id_discussion');
    $this->db->join('personnel', 'discussion.operatrice=personnel.Matricule');
    return $this->db->get('discussion_content')->result_object();
  }
  public function S1($dateD = null, $dateF = null, $opl)
  {
    $this->db->select('facture.Matricule_personnel,facture.Date,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function S3($dateD = null, $dateF = null)
  {
    $this->db->select('facture.Date,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    //$this->db->where('personnel.Prenom', $opl);
    $this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->where('facture.Status', "
      ");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
  public function W3($dateD = null, $dateF = null)
  {
    $this->db->select('facture.Date,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    //$this->db->where('personnel.Prenom', $opl);
    $this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }

  public function S2($dateD = null, $dateF = null, $opl)
  {
    $this->db->select('facture.Date,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('personnel.Prenom', $opl);
    $this->db->where("facture.Date BETWEEN '" . $dateD . "'AND'" . $dateF . "'");
    $this->db->like('facture.Id_de_la_mission', 'FACEBOOK');
    $this->db->where('facture.Status', "livre");
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('personnel', 'facture.Matricule_personnel=personnel.Matricule');
    return $this->db->get('detailvente')->result_object();
  }
   public function data_page_users($user){
  
    $this->db->select('comptefb.Nom_page,comptefb.id,comptefb.Source,comptefb.Type');
    $this->db->where('comptefb.statut',"on");
    $this->db->where('page_fb.statut',"on");
    $this->db->where('page_fb.operatrice',$user);
    $this->db->join('page_fb', 'page_fb.Lien_page=comptefb.Lien_page');
    return $this->db->get('comptefb')->result_object();
  }

  public function data_tache(){
    $this->db->select('taches,id');
    $this->db->where('statut',"on");
    return $this->db->get('taches')->result_object();
  }
  public function data_type(){
    $this->db->select('designation,id,codes');
    $this->db->where('statut','on');
    return $this->db->get('typeaction')->result_object();
  }

   public function complete_taches($code=false)
  {
    $this->db->select('typeaction.designation, taches.taches,taches.codes');
    $this->db->like('typeaction.designation',$code);
    $this->db->where('taches.statut',"on");
    $this->db->join('taches','taches.codes=typeaction.codes');
    return $this->db->get('typeaction')->result_object();
  }

  public function client_a_traiterAAC7($page)
  {
    $query=$this->db->query("SELECT clientpo.Code_client, facture.Matricule_personnel,facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 7 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function client_a_traiterAAC14($page)
  {
    
    $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 14 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function client_a_traiterAAC42($page)
  {
    $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 42 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function Returnclientsansachat($datedeb,$datefin){
    $user = $this->session->userdata('matricule');    
    $query = $this->db->query("SELECT session.client,clientpo.Compte_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client
    AND session.action <> 'vente' AND session.sender like 'OPL' 
    AND session.date =CURRENT_DATE() - INTERVAL 7 DAY
    AND session.operatrice = '$user'
    GROUP BY session.client");
    return $query->result();
  }
 

  public function selectParametreRelance($pram){
     return $this->db->where($pram)->get('parametreRelance')->row_object();
  }

  public function clientsaaParametre($page,$un,$deux,$trois,$quatre){
    //$user = $this->session->userdata('matricule'); 
    $query = $this->db->query("SELECT session.client,clientpo.Compte_facebook,facture.contacts,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice,
    (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL $un DAY AND CURRENT_DATE() AND facture.Code_client = session.client  LIMIT 1 ) AS 'FACTURE',
    (SELECT sess.client FROM session AS sess WHERE   sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL $deux DAY AND CURRENT_DATE() - INTERVAL $trois DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK'
    FROM `session`  JOIN comptefb ON session.page=comptefb.id 
      JOIN clientpo ON clientpo.Code_client=session.client
      JOIN facture ON facture.Code_client=session.client
        AND session.action <> 'vente' AND session.sender like 'OPL' 
        AND session.date =CURRENT_DATE() - INTERVAL $quatre DAY
        AND comptefb.id = '$page'
        GROUP BY session.client");
    return $query->result();
  }

  public function PROP_CLT_AAC14($date,$oplg)
  {
    $this->db->order_by('session.id', 'ASC');
    $this->db->group_by('clientpo.lien_facebook');
    $this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
    $this->db->where('session.date',$date);
    $this->db->like('session.types',"RELN_CLT_SAC42");
    $this->db->where('session.operatrice',$oplg);
    $this->db->join('clientpo','session.client=clientpo.Code_client');
    return $this->db->get('session')->result_object();
  }

  public function PROP_CLT_CATALOGUE($date,$oplg)
  {
    $this->db->order_by('session.id', 'ASC');
    $this->db->group_by('clientpo.lien_facebook');
    $this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
    $this->db->where('session.date',$date);
    $this->db->like('session.types',"PROP_CLT_CAT14");
    $this->db->where('session.operatrice',$oplg);
    $this->db->join('clientpo','session.client=clientpo.Code_client');
    return $this->db->get('session')->result_object();
  }

  /*public function clientsaa7($user){
    $user = $this->session->userdata('matricule'); 
    $query = $this->db->query("SELECT session.client,clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice,
    (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client  LIMIT 1 ) AS 'FACTURE',
    (SELECT sess.client FROM session AS sess WHERE   sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK'
    FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client
        AND session.action <> 'vente' AND session.sender like 'OPL' 
        AND session.date =CURRENT_DATE() - INTERVAL 7 DAY
        AND session.operatrice = '$user'
        GROUP BY session.client");
    return $query->result();
  }*/
  public function clientsaa7($page){
    //$page = $this->session->userdata('matricule'); 
    $query = $this->db->query("SELECT session.client, clientpo.Code_client,facture.contacts,clientpo.Compte_facebook,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice, (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN clientpo ON clientpo.Code_client=session.client JOIN facture on facture.Code_client=clientpo.Code_client AND session.action <> 'vente' AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 7 DAY AND session.page like '$page' GROUP BY session.client");
    return $query->result();
  }
  


  public function RELN_CLT_SAC07($date,$user)
  {
    $user = $this->session->userdata('matricule'); 
    $query = $this->db->query("SELECT clientpo.Code_client, clientpo.lien_facebook, clientpo.Compte_facebook, session.heure FROM session JOIN clientpo ON session.client=clientpo.Code_client WHERE session.date = '$date' AND session.types LIKE 'RELN_CLT_SAC07' ESCAPE '!' AND session.operatrice = '$user' GROUP BY clientpo.Code_client");
    return $query->result();    
  }

  
  public function comptejm($date,$user)
  {
    $user = $this->session->userdata('matricule'); 
    $query = $this->db->query("SELECT clientpo.Code_client, clientpo.lien_facebook, clientpo.Compte_facebook, session.heure FROM session JOIN clientpo ON session.client=clientpo.Code_client WHERE session.date = '$date' AND session.types LIKE '%REA!_CLT!_J\'AIME%' ESCAPE '!' AND session.operatrice = '$user'");
    return $query->result();    
  }

  public function PROP_CLT_AAC07($date,$user)
  {
    $user = $this->session->userdata('matricule');
    $query = $this->db->query("SELECT clientpo.Code_client, clientpo.lien_facebook, clientpo.Compte_facebook, session.heure FROM session JOIN clientpo ON session.client=clientpo.Code_client WHERE session.date = '$date' 
    AND session.types LIKE 'PROP_CLT_AAC07' AND session.operatrice = '$user'");
    return $query->result();    
  }

 public function reactionjaime($date,$page)
  {
    $this->db->select('Compte_facebook,lien_facebook,Nom_page,operatrice,date_publi');
    $this->db->like('date_traitement',$date);
    $this->db->like('Id_page',$page);
    //$this->db->like('type','Produit');    
    $this->db->order_by('date_publi','ASC');
    return $this->db->get('reaction_jaime')->result_object();
    
  }

  public function lifestyle($date,$oplg)
  {
    $this->db->select('Compte_facebook,lien_facebook,Nom_page,operatrice,date_publi');
    $this->db->like('date_traitement',$date);
    $this->db->like('operatrice',$oplg);
    $this->db->like('type','Life_Style');
    $this->db->order_by('date_publi','ASC');
    return $this->db->get('reaction_jaime')->result_object();
  }

  public function ventenonlivre($user)
  {    
    $user = $this->session->userdata('matricule');
    $query = $this->db->query("SELECT livraison.remarque_livreur,facture.date, clientpo.Code_client,clientpo.Compte_facebook ,clientpo.lien_facebook, facture.Status,comptefb.Nom_page FROM facture JOIN comptefb ON facture.Page=comptefb.id JOIN livraison ON facture.Id_facture=livraison.Id_facture JOIN clientpo ON facture.Code_client=clientpo.Code_client WHERE facture.date = CURRENT_DATE - INTERVAL 2 day AND facture.matricule_personnel = '$user' AND facture.Status like 'annule'");
    return $query->result();
  }

  public function countPROP_CLT_AAC07($date,$oplg)
  {
    $this->db->distinct('session.client');
    $this->db->select('session.idaction');
    $this->db->where('session.date',$date);
    $this->db->like('session.types',"PROP_CLT_AAC07");
    $this->db->where('session.operatrice',$oplg);
    $this->db->join('clientpo','session.client=clientpo.Code_client');
    return $this->db->get('session')->result_object();
  }

  public function gettotalsmileskotys($Code_client)
  {
    $date = new datetime();
    $dt = $date->format('Y');
    $query = $this->db->query("SELECT SUM(
    CASE 
      WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
      ELSE  '0'     
    END 
  ) AS 'smiles',
  SUM(
    CASE 
      WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
      ELSE  '0'
    END 
  ) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$Code_client' AND facture.`data_de_livraison` like '$dt%' AND facture.Status like 'livre' ");
      return $query->result();
  }

  public function gettrimstatutcleint($codeclient){
    $date = new DateTime();
    $dtm = $date->format('m');
    $dt = $date->format('Y');
    if($dtm == '01' OR $dtm == '02' OR $dtm ==  '03'){
      $datedebut = $dt.'-01-01';
      $datefin = $dt.'-03-31';
    }elseif($dtm == '04' OR $dtm == '05' OR  $dtm ==  '06'){
      $datedebut = $dt.'-04-01';
      $datefin = $dt.'-06-30';

    }elseif($dtm == '07' OR $dtm == '08' OR $dtm ==  '09'){
      $datedebut = $dt.'-07-01';
      $datefin = $dt.'-09-30';

    }elseif($dtm == '10' OR $dtm == '11' OR $dtm ==  '12'){
      $datedebut = $dt.'-10-01';
      $datefin = $dt.'-12-31';

    }else{
      $datedebut ="";
      $datefin = "";
    }
    
    $query = $this->db->query("SELECT SUM(
    CASE 
      WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
      ELSE  '0'
    END 
  ) AS 'smiles',
  SUM(
    CASE 
      WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
      ELSE  '0'
    END 
  ) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$codeclient' AND facture.`data_de_livraison` BETWEEN  '$datedebut' AND '$datefin' ");
      return $query->result();
  }

  public function countAAC07($date,$oplg)
  {
    $this->db->order_by('session.id', 'ASC');
    $this->db->group_by('clientpo.lien_facebook');
    $this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
    $this->db->where('session.date',$date);
    $this->db->like('session.types',"PROP_CLT_AAC07");
    $this->db->where('session.operatrice',$oplg);
    $this->db->join('clientpo','session.client=clientpo.Code_client');
    return $this->db->get('session')->result_object();
  }

  public function REAP_CLT_AAC30($date,$oplg)
  {
    $this->db->order_by('session.id', 'ASC');
    $this->db->group_by('clientpo.lien_facebook');
    $this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
    $this->db->where('session.date',$date);
    $this->db->like('session.types',"REAP_CLT_AAC30");
    $this->db->where('session.operatrice',$oplg);
    $this->db->join('clientpo','session.client=clientpo.Code_client');
    return $this->db->get('session')->result_object();
  }

  public function sac_catalogue($page)
  {
      $query = $this->db->query("SELECT session.client,clientpo.Compte_facebook,facture.contacts,clientpo.lien_facebook, session.date,session.idaction, comptefb.Nom_page,session.operatrice,
      (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY AND CURRENT_DATE() AND facture.Code_client = session.client  LIMIT 1 ) AS 'FACTURE',
      
      (SELECT sess.client FROM session AS sess WHERE   sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK',
      
      (SELECT sess.client FROM session AS sess WHERE   sess.sender ='OPL' AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 21 DAY AND CURRENT_DATE() - INTERVAL 14 DAY LIMIT 1 ) AS 'AVANT_DERNIER'
      
      FROM `session` JOIN comptefb ON session.page=comptefb.id 
      JOIN facture ON facture.Code_client=session.client
      JOIN clientpo ON clientpo.Code_client=session.client
          AND session.action <> 'vente' AND session.sender like 'OPL' 
          AND session.date =CURRENT_DATE() - INTERVAL 28 DAY
          AND session.page = '$page'
          GROUP BY session.client");
    return $query->result();

  }
  public function insertRendeVous($data){
    return $this->db->insert('rendez_vous',$data);
  }
  public function selectRendeVous($parametre){
    return $this->db->where($parametre)->get('rendez_vous')->row_object();
  }
  public function comptefbDetail($parametre)
  {
    return $this->db->where($parametre)->get('comptefb')->row_object();
  }

  public function rendezvous()
  {
    return $this->db->get('render_vous')->result_object();
  }

  public function rendez_vous($user,$date)
  {
    $this->db->select('clientpo.Code_client,clientpo.Compte_facebook,clientpo.lien_facebook,rendez_vous.date,comptefb.Nom_page,rendez_vous.contact');
    $this->db->where('rendez_vous.date',$date);
    $this->db->where('rendez_vous.operatrice',$user);
    $this->db->join('comptefb', 'rendez_vous.page=comptefb.id');
    $this->db->join('clientpo', 'clientpo.Code_client=rendez_vous.codeclient');
    return $this->db->get('rendez_vous')->result_object();
  }
  

  public function client_a_traiterAAC105($page)
  {
    $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 105 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function liste_prommotion($date,$user){
    $this->db->select('client_to_promotion.`Code_client`, client_to_promotion.`Compte_facebook`, client_to_promotion.`lien_facebook`, client_to_promotion.`nombre_achat`, client_to_promotion.`Date_promotion`,  client_to_promotion.`Nom_page`');
    $this->db->where('client_to_promotion.Date_promotion',$date);
    $this->db->where('client_to_promotion.operatrice',$user);
    return $this->db->get('client_to_promotion')->result();
  }

    public function client_a_traiterAAC14aa($user)
  {
     $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 14 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function client_a_traiterAAC21($page)
  {
     $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 21 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }
  public function client_a_traiterAAC28($page)
  {
    $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 28 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

   public function client_a_traiterAAC35($page)
  {
    $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 35 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }


  public function client_a_traiterAAC49($page)
  {
    $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 49 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function client_a_traiterAAC56($user)
  {
    $user = $this->session->userdata('matricule');
    $query=$this->db->query("SELECT clientpo.Code_client,facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        WHERE facture.Matricule_personnel ='$user' 
        
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 56 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function client_a_traiterAAC63($user)
  {
    $user = $this->session->userdata('matricule');
    $query=$this->db->query("SELECT clientpo.Code_client,facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        WHERE facture.Matricule_personnel ='$user' 
        
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 63 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function client_a_traiterAAC70($page)
  {
    $query=$this->db->query("SELECT clientpo.Code_client,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        WHERE session.page ='$page'              
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 70 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  /*public function client_a_traiterAAC70($user)
  {
    $user = $this->session->userdata('matricule');
    $query=$this->db->query("SELECT clientpo.Code_client,facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        WHERE facture.Matricule_personnel ='$user' 
        
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 70 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }*/

  public function client_a_traiterAAC77($user)
  {
    $user = $this->session->userdata('matricule');
    $query=$this->db->query("SELECT clientpo.Code_client,facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        WHERE facture.Matricule_personnel ='$user' 
        
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 77 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function client_a_traiterAAC84($user)
  {
    $user = $this->session->userdata('matricule');
    $query=$this->db->query("SELECT clientpo.Code_client,facture.contacts,  clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        WHERE facture.Matricule_personnel ='$user' 
        
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 84 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }
  public function client_a_traiterAAC91($user)
  {
    $user = $this->session->userdata('matricule');
    $query=$this->db->query("SELECT clientpo.Code_client, facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        WHERE facture.Matricule_personnel ='$user' 
        
        AND facture.Status ='livre' 
        AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL 91 DAY GROUP BY clientpo.Code_client");
    return $query->result();
  }

  public function testlistepromo($date,$operatrice,$client){
    $query = $this->db->query("SELECT * FROM `session` WHERE `operatrice` like '$operatrice' AND `types` like 'PRCG_CLT_PROMO' AND session.date like '$date' AND client like '$client'");
    $resultat = $query->result();
    return count($resultat);
  }

  public function testlistecaa($date,$oplg){
    $query = $this->db->query("SELECT clientpo.lien_facebook FROM session JOIN clientpo ON session.client=clientpo.Code_client WHERE session.operatrice like '$oplg' AND session.date = '$date' GROUP BY session.client");
    $resultat = $query->result();
    return count($resultat);
  }
  
  public function testliste($date,$operatrice,$client)
  {
    $query = $this->db->query("SELECT * FROM `session` WHERE `operatrice` like '$operatrice' AND  session.date like '$date' AND client like '$client'");
    $resultat = $query->result();
    return count($resultat);
  }

  public function liste_prommotionTotal($date,$user){
    $this->db->select('client_to_promotion.`Code_client`');
    $this->db->where('client_to_promotion.Date_promotion',$date);
    $this->db->where('client_to_promotion.operatrice',$user);
    $count = $this->db->get('client_to_promotion')->result();
    return count($count);
  }
  public function Page_avec_client_promotion(){
    $this->db->distinct();
    $this->db->select('client_to_promotion.`Nom_page`');
    return $this->db->get('client_to_promotion')->result();
  }
  public function Get_client_by_page($page){
    $this->db->select('client_to_promotion.`Code_client`, client_to_promotion.`Compte_facebook`, client_to_promotion.`lien_facebook`, client_to_promotion.`nombre_achat`, client_to_promotion.`Date_promotion`,  client_to_promotion.`Nom_page`');
   $this->db->where('client_to_promotion.Nom_page',$page);
   return $this->db->get('client_to_promotion')->result();

 }
 public function Get_client_by_pageT($page){
  $limit = 1;
   $this->db->select('client_to_promotion.`Code_client`, client_to_promotion.`Compte_facebook`, client_to_promotion.`lien_facebook`, client_to_promotion.`nombre_achat`, client_to_promotion.`Date_promotion`,  client_to_promotion.`Nom_page`');
  $this->db->where('client_to_promotion.Nom_page',$page);
  $this->db->where('client_to_promotion.nombre_achat >',$limit);
  return $this->db->get('client_to_promotion')->result();

}
public function Get_client_by_pageO($page,$param){
  $this->db->select('client_to_promotion.`Code_client`, client_to_promotion.`Compte_facebook`, client_to_promotion.`lien_facebook`, client_to_promotion.`nombre_achat`, client_to_promotion.`Date_promotion`,  client_to_promotion.`Nom_page`');
 $this->db->where('client_to_promotion.Nom_page',$page);
  $this->db->where('client_to_promotion.nombre_achat',$param);
 return $this->db->get('client_to_promotion')->result();

}
public function Compter_client_page($page){
  $this->db->select('client_to_promotion.`Code_client`');
  $this->db->where('client_to_promotion.Nom_page',$page);
  $q=$this->db->get('client_to_promotion');
  $count=$q->result();
  return count($count);
}

public function paramaitrePromo($date,$param){
  $query =$this->db->query("SELECT facture.`Code_client`, clientpo.Compte_facebook, clientpo.lien_facebook , COUNT(facture.Status) as nombre_achat, facture.Matricule_personnel, comptefb.Nom_page FROM `facture`, clientpo, comptefb WHERE facture.Page=comptefb.id AND facture.Code_client like clientpo.Code_client AND facture.Status like 'livre' AND facture.data_de_livraison <= '$date' GROUP BY facture.Code_client HAVING COUNT(facture.Status) >='$param' ORDER BY nombre_achat DESC ");
    return $query->result();


}
public function paramaitrePromobypageT($page){
  $query =$this->db->query("SELECT COUNT(`Code_client`) as nbr_clt, comptefb.id as page FROM `client_to_promotion`, comptefb WHERE client_to_promotion.`Nom_page` like '$page%'  AND comptefb.Nom_page like client_to_promotion.Nom_page and client_to_promotion.nombre_achat >=2 ");
   return $query->result();

}
public function getCA($codeclient){
  $query = $this->db->query("SELECT SUM(detailvente.Quantite*prix.Prix_detail) as ca FROM `facture`,detailvente,prix WHERE detailvente.Id_prix=prix.Id AND detailvente.Facture=facture.Id AND facture.Code_client like '$codeclient'");
  $resultat = $query->result();
  foreach ($resultat as  $value) {
    $affiche = $value->ca;
  }
  return $affiche;
}


public function dernier_contact($client)
{
  $query = $this->db->query("SELECT discussion_content.heure FROM discussion_content JOIN discussion ON discussion_content.Id_discussion = discussion.id_discussion WHERE discussion.client ='$client' AND discussion_content.sender like 'OPL'  ORDER BY discussion_content.Id DESC LIMIT 1 ");

return $query->row_object();
}

  public function filtre_vente($dateD, $dateF)
  {
    $this->db->select('facture.Matricule_personnel, clientpo.Compte_facebook, clientpo.lien_facebook, facture.Ville, facture.contacts,prix.Code_produit, livraison.date_de_livraison, livraison.frais, facture.Code_client,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,facture.Status, facture.lieu_de_livraison,  facture.Id_facture, prix.Prix_detail, facture.date, comptefb.Nom_page');
    $this->db->where('facture.date >=', $dateD);
    $this->db->where('facture.date <=', $dateF);
    $this->db->join('facture', 'facture.Id = detailvente.Facture');
    $this->db->join('prix', 'prix.Id = detailvente.Id_prix');
    $this->db->join('produit', 'produit.Code_produit = prix.Code_produit');
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->join('clientpo', 'facture.Code_client=clientpo.Code_client');
    $this->db->join('comptefb', 'comptefb.id=facture.page');
    return $this->db->get('detailvente')->result_object();
  }
  public function vente_non_livre($page)
{
  $query = $this->db->query("SELECT clientpo.Code_client, livraison.date_de_livraison ,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page, livraison.remarque_livreur FROM facture 
  INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
      INNER JOIN comptefb ON facture.Page=comptefb.id 
      JOIN session ON session.page = comptefb.id
      JOIN livraison ON livraison.Id_facture = facture.Id_facture
      WHERE facture.page ='$page'              
      AND facture.Status ='annule' 
      AND livraison.date_de_livraison BETWEEN CURRENT_DATE() - INTERVAL 7 DAY and CURRENT_DATE() - INTERVAL 1 DAY  GROUP BY clientpo.Code_client order by livraison.date_de_livraison DESC ");
  return $query->result_object();
} 

public function SAC07($page)
{
  $query = $this->db->query("SELECT session.client, clientpo.Compte_facebook, facture.contacts, clientpo.lien_facebook, session.date, session.idaction, comptefb.Nom_page,session.operatrice, 
  (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY 
  AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', 
  (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' 
  AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN page_fb ON page_fb.Lien_page =comptefb.Lien_page JOIN clientpo ON clientpo.Code_client=session.client JOIN facture ON facture.Code_client=session.client AND session.action <> 'vente' 
  AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 7 DAY AND facture.page = '$page'
  AND page_fb.statut = 'on'  
  GROUP BY session.client
  ");
  return $query->result();
}

public function SAC007($page)
{
  $query = $this->db->query("SELECT session.client, clientpo.Compte_facebook, facture.contacts, clientpo.lien_facebook, session.date, session.idaction, comptefb.Nom_page,session.operatrice, 
  (SELECT facture.Id_facture FROM facture WHERE facture.Date BETWEEN CURRENT_DATE() - INTERVAL 7 DAY 
  AND CURRENT_DATE() AND facture.Code_client = session.client LIMIT 1 ) AS 'FACTURE', 
  (SELECT sess.client FROM session AS sess WHERE sess.sender ='OPL' 
  AND sess.client = session.client AND sess.date BETWEEN CURRENT_DATE() - INTERVAL 15 DAY AND CURRENT_DATE() - INTERVAL 8 DAY LIMIT 1 ) AS 'AVANT_DERNIER_DISK' FROM `session` JOIN comptefb ON session.page=comptefb.id JOIN page_fb ON page_fb.Lien_page =comptefb.Lien_page JOIN clientpo ON clientpo.Code_client=session.client JOIN facture ON facture.Code_client=session.client AND session.action <> 'vente' 
  AND session.sender like 'OPL' AND session.date =CURRENT_DATE() - INTERVAL 7 DAY AND session.page = '$page'
  AND comptefb.statut = 'on'   
  GROUP BY session.client
  ");
  return $query->result();
}

public function vente_province($oplg)
{
  $query = $this->db->query("SELECT clientpo.Code_client,facture.Status, facture.District, clientpo.Compte_facebook, clientpo.lien_facebook, facture.contacts FROM facture join clientpo on clientpo.Code_client=facture.Code_client
  WHERE facture.data_de_livraison = CURRENT_DATE AND facture.Localite LIKE 'PROVINCE' and facture.Matricule_personnel='$oplg'");
  return $query->result_object();
}

public function client_session($page, $oplg)
{
  $query = $this->db->query("SELECT * FROM session join clientpo on session.client=clientpo.Code_client 
  inner join comptefb on  comptefb.id = session.page 
  join page_fb on page_fb.Lien_page = comptefb.Lien_page
  WHERE comptefb.id LIKE '$page' 
  AND session.date= CURRENT_DATE - INTERVAL 7 DAY 
  AND page_fb.operatrice = '$oplg'
  AND session.client <> 'NULL' GROUP BY session.client");
  return $query->result();
}

public function client_facture($page)
{
  $query = $this->db->query("SELECT * FROM facture join clientpo on facture.Code_client=clientpo.Code_client WHERE facture.Date =CURRENT_DATE - INTERVAL 7 DAY AND facture.Page LIKE '$page'");
  return $query->result();
}
public function client_call_fidele($oplg,$date)
{
  //$this->db->select('code_client,nom_facebook,lien_facebook,telephone,localisation');
  $this->db->where('oplg',$oplg);
  $this->db->where('date_previ',$date);  
  return $this->db->get('client_call_fid')->result();
}

public function client_call_occa($oplg,$date)
{
  //$this->db->select('code_client,nom_facebook,lien_facebook,telephone,localisation');
  $this->db->where('oplg',$oplg);
  $this->db->where('date_previ',$date);  
  return $this->db->get('client_call_occ')->result();
}
public function AAC14($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'PROP_CLT_AAC14' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}



public function AAC07($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'PROP_CLT_AAC07' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function SAC_07($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'RELN_CLT_SAC07' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function SAC42($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'RELN_CLT_SAC42' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function ACC49($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'REAP_CLT_AAC49' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function ACC28($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'REAP_CLT_AAC28' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function ACC14($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'PROP_CLT_AAC14' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function ACC21($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'PROP_CLT_AAC21' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function ACC35($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'REAP_CLT_AAC35' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function ACC42($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'REAP_CLT_AAC30' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function ACC56($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'REAP_CLT_AAC56' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}
public function ACC70($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'REAP_CLT_AAC70' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function CATALOGUE($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'PROP_CLT_CAT14' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function VENTENONLIVREE($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'TRTM_VTE_NNLIV' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}
public function JAIME($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'REA_CLT_JAIME' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function REA_CLT_STYLE($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'REA_CLT_STYLE' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function testlistes($date,$operatrice,$client,$type)
{
  $query = $this->db->query("SELECT * FROM `session` WHERE `operatrice` like '$operatrice' AND `types` like '$type' AND  session.date like '$date' AND client like '$client' group by client ");
  $resultat = $query->result();
  return count($resultat);
}

public function testcheck($date,$operatrice,  $client)
{
  $query = $this->db->query("SELECT * FROM client_check  WHERE `operatrice` like '$operatrice'  AND  client_check.date like '$date' AND Code_client like '$client'");
  $resultat = $query->result();
  return count($resultat);
}

public function testchecks($date,$operatrice)
{
  $query = $this->db->query("SELECT * FROM client_check  WHERE `operatrice` like '$operatrice'  AND  client_check.date like '$date' GROUP BY `Code_client` ");
  $resultat = $query->result();
  return count($resultat);
}

public function testlistesmaj($oplg,$client)
{
  $query = $this->db->query("SELECT * FROM `client_update` WHERE `Matricule` like '$oplg' AND `Date` =CURRENT_DATE AND `Code_client` like '$client'");
  $resultat = $query->result();
  return count($resultat);
}

public function PROP_CLT_jm($date,$oplg)
  {
    $this->db->order_by('session.id', 'ASC');
    $this->db->group_by('clientpo.lien_facebook');
    $this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
    $this->db->where('session.date',$date);
    $this->db->like('session.types',"REA_CLT_JAIME");
    $this->db->where('session.operatrice',$oplg);
    $this->db->join('clientpo','session.client=clientpo.Code_client');
    return $this->db->get('session')->result_object();
  }

  public function PROP_CLT_LF($date,$oplg)
  {
    $this->db->order_by('session.id', 'ASC');
    $this->db->group_by('clientpo.lien_facebook');
    $this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
    $this->db->where('session.date',$date);
    $this->db->like('session.types',"REA_CLT_STYLE");
    $this->db->where('session.operatrice',$oplg);
    $this->db->join('clientpo','session.client=clientpo.Code_client');
    return $this->db->get('session')->result_object();
  }
 
  public function add_client_update($Code_client, $compte, $lien, $page, $matricule, $Id_page) {
    $query = $this->db->query('INSERT INTO client_update VALUES 
    (NULL,"'.$matricule.'","'.$page.'","'.$compte.'","'.$Id_page.'","'.$Code_client.'","'.$lien.'", CURRENT_DATE, CURRENT_DATE + INTERVAL 14 DAY, CURRENT_DATE + INTERVAL 28 DAY, CURRENT_DATE + INTERVAL 42 DAY, CURRENT_DATE + INTERVAL 56 DAY, CURRENT_DATE + INTERVAL 70 DAY, CURRENT_DATE + INTERVAL 84 DAY, CURRENT_DATE + INTERVAL 98 DAY, CURRENT_DATE + INTERVAL 112 DAY, CURRENT_DATE + INTERVAL 126 DAY, CURRENT_DATE + INTERVAL 140 DAY, CURRENT_DATE + INTERVAL 154 DAY,CURRENT_DATE + INTERVAL 168 DAY, CURRENT_DATE + INTERVAL 182 DAY, CURRENT_DATE + INTERVAL 196 DAY, CURRENT_DATE + INTERVAL 210 DAY, CURRENT_DATE + INTERVAL 224 DAY, CURRENT_DATE + INTERVAL 238 DAY, CURRENT_DATE + INTERVAL 252 DAY, CURRENT_DATE + INTERVAL 266 DAY, CURRENT_DATE + INTERVAL 280 DAY, CURRENT_DATE + INTERVAL 294 DAY, CURRENT_DATE + INTERVAL 308 DAY, CURRENT_DATE + INTERVAL 322 DAY, CURRENT_DATE + INTERVAL 336 DAY, CURRENT_DATE + INTERVAL 350 DAY, CURRENT_DATE + INTERVAL 364 DAY)');
    return;
  }

  public function check($Code_client,$matricule,$page)
  {
    $matricule = $this->session->userdata('matricule');
    $query = $this->db->query("INSERT INTO client_check VALUES (NULL,'$Code_client', CURRENT_DATE,'$matricule','$page' )");
    return;
  }

  public function add_via_excel($data) {

    $this->db->insert('client_upload', $data);
    return;
  }

  public function update_level_client($code_client, $facture, $level) {
    // $this->db->set('facture.Level', $level);
    // $this->db->where('facture.Code_client',$code_client);
    // $this->db->where('facture.Id_facture',$facture);
    
    $query = $this->db->query("UPDATE facture SET Level = '$level' WHERE Code_client = '$code_client' AND Id_facture = '$facture'");
    
    return $query;
  }

  public function clientmaj($page,$date)
  {
    $this->db->select('code_client,compte_facebook,lien_facebook,nom_page');
    $this->db->where('id_page',$page);
    $this->db->where('date_maj',$date);
    $this->db->group_by('code_client');
    return $this->db->get('client_upload')->result_object();
  }
  public function stat($client)
{
  $query = $this->db->query("SELECT facture.Date, facture.Ress_sec_oplg,facture.Code_client, comptefb.Nom_page, facture.Matricule_personnel, facture.Id_facture, clientpo.Compte_facebook,clientpo.lien_facebook,facture.contacts,produit.Code_produit,detailvente.Quantite,prix.Prix_detail,produit.Designation FROM facture 
  JOIN detailvente ON facture.Id = detailvente.Facture 
  JOIN prix ON prix.Id=detailvente.Id_prix 
  JOIN clientpo ON clientpo.Code_client=facture.Code_client 
  JOIN produit ON produit.Code_produit=prix.Code_produit
  JOIN comptefb ON comptefb.id=facture.Page
  WHERE facture.Code_client ='$client'
  ORDER BY facture.Date DESC");

  return $query->result_object();
}

  public function historique($client)
  {
    $query = $this->db->query("SELECT * FROM client_update WHERE Code_client ='$client'");
    return $query->result_object();
  }

  public function clientctl007($page)
  {
    $query = $this->db->query("SELECT clientpo.Code_client, clientpo.Compte_facebook,clientpo.lien_facebook, comptefb.Nom_page FROM session JOIN clientpo on clientpo.Code_client=session.client JOIN comptefb on comptefb.id=session.page WHERE session.date=CURRENT_DATE - INTERVAL 7 DAY AND session.page='$page' GROUP BY session.client");
    return $query->result_object();
  }

  public function TRC014($page,$date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC014',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }
  public function TRC028($page,$date)
  {
    $this->db->select('client_update.Page,clientpo.Compte_facebook,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC028',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->group_by('client_update.Code_client');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    $this->db->join('clientpo','clientpo.Code_client=client_update.Code_client');
    return $this->db->get('client_update')->result_object();
  }

  public function TRC042($page,$date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->group_by('client_update.lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function listeTRC042($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);    
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function GNPFPJI($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',48); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function GNPFJI($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',3); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function zasynyvoloko($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',96); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function VCONFJIA($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',91); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }


  public function TRC056($page,$date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC056',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }
   
   public function TRC070($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC070',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC084($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC084',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC098($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC098',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC112($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC112',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC126($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC126',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC140($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC140',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC154($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC154',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }

   public function TRC168($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC168',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC182($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC182',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   
   public function TRC196($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC196',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC210($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC210',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC224($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC224',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC238($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC238',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC252($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC252',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }

   public function TRC266($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC266',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }


   public function TRC280($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC280',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }

   public function TRC294($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC294',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC308($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC308',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC322($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC322',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC336($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC336',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC350($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC350',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function TRC364($page,$date)
   {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC364',$date);
    $this->db->where('comptefb.id',$page);
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
   }
   public function page_user($page)
   {
    $query = $this->db->query(" SELECT comptefb.Nom_page FROM comptefb JOIN page_fb ON comptefb.Lien_page = page_fb.Lien_page WHERE comptefb.id ='$page' GROUP by comptefb.Lien_page");
    return $query->row_object();
  }

  public function coutn_trc014($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'TRM_CLT_TRC014' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function coutn_trc028($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'TRM_CLT_TRC028' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}
public function coutn_trc042($oplg)
{
  $query = $this->db->query(" SELECT * FROM `session` WHERE `types` LIKE 'TRM_CLT_TRC042' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`");
  $resultat = $query->result();
  return count($resultat);
}

public function rang_koty($oplg)
{
  $query = $this->db->query("SELECT facture.Code_client,facture.Date,comptefb.Nom_page,facture.Id_facture,clientpo.Compte_facebook,facture.contacts,produit.Code_produit,detailvente.Quantite,prix.Prix_detail,produit.Designation FROM facture 
  JOIN detailvente ON facture.Id = detailvente.Facture 
  JOIN prix ON prix.Id=detailvente.Id_prix 
  JOIN clientpo ON clientpo.Code_client=facture.Code_client 
  JOIN produit ON produit.Code_produit=prix.Code_produit
  JOIN comptefb ON comptefb.id=facture.Page
  WHERE facture.Matricule_personnel ='$oplg'
  ORDER BY facture.Date  DESC LIMIT 100");

  return $query->result_object();
}
public function nomproduit($code)
{
  $this->db->select('Designation');
  $this->db->where('Code_produit',$code);
  return $this->db->get('produit')->row_object();
}

public function client($oplg)
{  
  $query = $this->db->query("SELECT facture.Code_client,clientpo.Compte_facebook,comptefb.Nom_page FROM facture JOIN comptefb on comptefb.id = facture.Page JOIN clientpo ON clientpo.Code_client = facture.Code_client WHERE facture.Matricule_personnel like '$oplg' GROUP BY facture.Code_client ");
  return $query->result_object();
}

public function listeAAC49($page)
{
  $query = $this->db->query("SELECT code_client ,compte_facebook ,lien_facebook, nom_page FROM client_upload WHERE AAC070= CURRENT_DATE and id_page='$page'");
  return $query->result_object();
}

public function listeAAC70($page)
{
  $query = $this->db->query("SELECT code_client ,compte_facebook ,lien_facebook, nom_page FROM client_upload WHERE AAC070= CURRENT_DATE and id_page='$page'");
  return $query->result_object();
}

public function historique_discussion($client)
{
  $query = $this->db->query("SELECT session.operatrice,personnel.Prenom,session.date,session.heure,comptefb.Nom_page,session.action FROM session join comptefb on comptefb.id=session.page join personnel on personnel.Matricule=session.operatrice WHERE session.client like '$client'  ORDER BY session.date DESC");
  return $query->result_object();
}

public function testclientjaime()
{
  $query = $this->db->query("SELECT   Code_client, Compte_facebook, lien_facebook, Semaine, Nom_page, date_publi, code_publication, operatrice ,date_traitement, type FROM reaction_jaime WHERE lien_facebook not in (SELECT lien_facebook FROM clientpo where 1) GROUP BY lien_facebook");
  return $query->result_object();
  
}
public function addtrc014($oplg)
{ 
  $query = $this->db->query("SELECT clientpo.Code_client, clientpo.Compte_facebook, clientpo.lien_facebook, comptefb.Nom_page FROM clientpo JOIN session ON session.client=clientpo.Code_client 
  join comptefb on comptefb.id=session.page 
  join page_fb on page_fb.Lien_page=comptefb.Lien_page  
  WHERE clientpo.datedenregistrement = CURRENT_DATE - INTERVAL 14 day 
  AND clientpo.Code_client NOT IN (SELECT Code_client FROM facture where Matricule_personnel like '$oplg')
  and session.operatrice = '$oplg' GROUP BY clientpo.Code_client");
  return $query->result_object();
}

public function addtrc028($oplg)
{ 
  $query = $this->db->query("SELECT clientpo.Code_client, clientpo.Compte_facebook, clientpo.lien_facebook, comptefb.Nom_page FROM clientpo JOIN session ON session.client=clientpo.Code_client 
  join comptefb on comptefb.id=session.page 
  join page_fb on page_fb.Lien_page=comptefb.Lien_page  
  WHERE session.date = CURRENT_DATE - INTERVAL 28 day 
  AND clientpo.Code_client NOT IN (SELECT Code_client FROM facture where Matricule_personnel like '$oplg')
  and session.operatrice = '$oplg' GROUP BY clientpo.Code_client ");
  return $query->result_object();
}

public function addtrc042($oplg)
{ 
  $query = $this->db->query("SELECT clientpo.Code_client, clientpo.Compte_facebook, clientpo.lien_facebook, comptefb.Nom_page FROM clientpo JOIN session ON session.client=clientpo.Code_client 
  join comptefb on comptefb.id=session.page 
  join page_fb on page_fb.Lien_page=comptefb.Lien_page  
  WHERE session.date = CURRENT_DATE - INTERVAL 42 day 
  AND clientpo.Code_client NOT IN (SELECT Code_client FROM facture where Matricule_personnel like '$oplg')
  and session.operatrice = '$oplg' GROUP BY clientpo.Code_client ");
  return $query->result_object();
}

 public function historique_relance($client)
 {
   $query =$this->db->query("SELECT date,types FROM session WHERE client like '$client'  GROUP by types  order by date desc");
   return $query->result_object();
 }
 
  public function addzasynyvoloko()
  { 
    $query = $this->db->query("SELECT clientpo.Code_client, clientpo.Compte_facebook, clientpo.lien_facebook, comptefb.Nom_page FROM clientpo JOIN session ON session.client=clientpo.Code_client 
    join comptefb on comptefb.id=session.page 
    join page_fb on page_fb.Lien_page=comptefb.Lien_page  
    WHERE session.date = CURRENT_DATE - INTERVAL 42 day 
    AND clientpo.Code_client NOT IN (SELECT Code_client FROM facture where Matricule_personnel ='VB21166')
    and session.operatrice ='VB21166' GROUP BY clientpo.Code_client ");
    return $query->result_object();
  }

  public function addGNPFPJI()
  { 
    $query = $this->db->query("SELECT clientpo.Code_client, clientpo.Compte_facebook, clientpo.lien_facebook, comptefb.Nom_page FROM clientpo JOIN session ON session.client=clientpo.Code_client 
    join comptefb on comptefb.id=session.page 
    join page_fb on page_fb.Lien_page=comptefb.Lien_page  
    WHERE session.date = CURRENT_DATE - INTERVAL 42 day 
    AND clientpo.Code_client NOT IN (SELECT Code_client FROM facture where Matricule_personnel ='VB21539')
    and session.operatrice ='VB21539' GROUP BY clientpo.Code_client ");
    return $query->result_object();
  }

  public function GNPINKJII($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',35); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function VIVTECCJII($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',47); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function vivitecwjii($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',45); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function vivitecwji($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',12); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function passionlessjia($date)
  {
    $this->db->select('client_update.Page,client_update.Compte,client_update.Code_client,client_update.lien');
    $this->db->where('client_update.TRC042',$date);
    $this->db->where('client_update.Id_page',95); 
    $this->db->group_by('lien');
    $this->db->join('comptefb','client_update.id_page=comptefb.id');
    return $this->db->get('client_update')->result_object();
  }

  public function test_zasynyvoloko($user)
  {
    $user = $this->session->userdata('matricule'); 
    $query = $this->db->query("SELECT client FROM session WHERE date=CURRENT_DATE AND types like 'TRM_CLT_TRC042' and operatrice ='$user' GROUP by client");
    return $query->result();    
  }

   public function kotydispo($codeclient)
  {
    $this->db->select('Compte.Koty');
    $this->db->where('Client',$codeclient);
    return $this->db->get('Compte')->row_object();
  }

    public function smiledispo($codeclient)
  {
    $this->db->select('smile');
    $this->db->where('Code_client',$codeclient);
    return $this->db->get('Smile')->row_object();
  }

  public function kotyclientreste($codeclient){
     $query = $this->db->query("SELECT `Koty`  FROM `Compte` WHERE `Client` like  '$codeclient'");
     return $query->result();
  }

   public function smileclientreste($codeclient){
     $query = $this->db->query("SELECT `smile`  FROM `Smile` WHERE `Code_client` like  '$codeclient'");
     return $query->result();
  }
  
  public function getsmileclienttrim($client)
  {
   $query = $this->db->query("SELECT SUM(
    CASE 
      WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
      WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
      ELSE  '0'
    END 
  ) AS 'smiles' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$client' AND facture.Status like 'livre' AND facture.Date BETWEEN '2022-10-01' AND '2022-12-31'");
   return $query->result();
  }

  public function getClientInfos($requette=array())
  {
    $this->db->where($requette);
    return $this->db->get('clientpo')->row();
  }
  public function typetachekoty(){
    $this->db->where('statut','on');
    return $this->db->get('tachekoty')->result_object();
  }
  public function smile($codeclient)
  {
    $this->db->select('Smile.smile');
    $this->db->like('statut',"on");
    $this->db->where('Code_client',$codeclient);
    return $this->db->get('Smile')->row_object();
  }
  public function produit_selection()
{
  $this->db->distinct();
  $this->db->where('statut','on');
  return $this->db->get('produit_selection')->row_object();
}
public function produitpromokoty($oplg)
{
  $this->db->where('Categorie',77);
  //$this->db->where('Opertrice',$oplg);
  return $this->db->get('produit')->result_object();
}
public function gettotalsmileskotyanneecourante($Code_client,$annee)
  {
    $query = $this->db->query("SELECT SUM(
      CASE 
        WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
        ELSE  '0'
      END 
    ) AS 'smiles',
    SUM(
      CASE 
        WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
        ELSE  '0'
      END 
    ) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$Code_client' and facture.data_de_livraison like '$annee%' and facture.Id_de_la_mission like 'FACEBOOK'");
        return $query->result();
  }
  public function gettotalsmileskotyanneepassee($Code_client)
  {
    $query = $this->db->query("SELECT SUM(
      CASE 
        WHEN facture.`Level` = 'Level_1' THEN prix.`Smile_LV1`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_2' THEN prix.`Smile_LV2`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_3' THEN prix.`Smile_LV3`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_4' THEN prix.`Smile_LV4`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_5' THEN prix.`Smile_LV5`*detailvente.Quantite
        ELSE  '0'
      END 
    ) AS 'smiles',
    SUM(
      CASE 
        WHEN facture.`Level` = 'Level_1' THEN prix.`Zen_LV1`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_2' THEN prix.`Zen_LV2`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_3' THEN prix.`Zen_LV3`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_4' THEN prix.`Zen_LV4`*detailvente.Quantite
        WHEN facture.`Level` = 'Level_5' THEN prix.`Zen_LV5`*detailvente.Quantite
        ELSE  '0'
      END 
    ) AS 'koty' FROM facture JOIN detailvente ON  facture.`Id` = detailvente.`Facture` JOIN prix ON prix.`Id` = detailvente.`Id_prix`   WHERE facture.`Code_client` LIKE '$Code_client' and facture.data_de_livraison like '2021%' and facture.Id_de_la_mission like 'FACEBOOK'");
        return $query->result();
  }
  public function actionkoty()
{
  $this->db->where('statut',"on");
  return $this->db->get('action_koty')->result_object();
}

public function page_fb($parametre){
  return $this->db->select("comptefb.id as page,comptefb.Nom_page as nomPage")
          ->where($parametre)
          ->where('page_fb.statut',"on")
          ->join('comptefb', "page_fb.Lien_page = comptefb.Lien_page") 
          ->get('page_fb')
          ->row_object();
  
}

  public function produit_tombola($parametre)
  { 
      $this->db->select('produit.Designation, detailvente.Quantite,detailvente.Id_prix');
      $this->db->where('facture.Id', $opls);
      $this->db->like('detailvente.Designation', );
      $this->db->where('facture.Id_de_la_mission', "FACEBOOK");
      $this->db->join('facture', 'detailvente.Facture=facture.Id');
      $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
      $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
      return $this->db->get('detailvente')->result_object();
  }
  public function selectsTombola($requette=array()){
    return $this->db
    ->where($requette)
    ->join('clientpo', "clientpo.Code_client = tombola.codeClient")
    ->get('tombola')->result_object();
  }

  public function selectsTombolaGroup($requette=array()){
    return $this->db
    ->where($requette)
    ->join('clientpo', "clientpo.Code_client = tombola.codeClient")
    ->group_by('tombola.facture')
    ->get('tombola')->result_object();
    
  }
  public function insertTombola($parametre){
    return $this->db->insert('tombola',$parametre);
  } 

  public function relance_produit($page,$parametre,$relance)
  {    
  $query = $this->db->query("SELECT clientpo.Code_client, livraison.date_de_livraison ,  facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page, comptefb.id, prix.Code_produit,livraison.date_de_livraison, produit.relance FROM detailvente
  JOIN facture on detailvente.Facture = facture.Id
  JOIN prix on detailvente.Id_prix=prix.Id
  JOIN produit on produit.Code_produit=prix.Code_produit
  JOIN clientpo ON facture.Code_client=clientpo.Code_client 
  JOIN comptefb ON facture.Page=comptefb.id
  JOIN livraison ON livraison.Id_facture = facture.Id_facture
  WHERE  produit.relance like '$relance' AND facture.Page = '$page' AND facture.Status = 'livre'
  AND livraison.date_de_livraison = CURRENT_DATE() - INTERVAL '$parametre' DAY");
    return $query->result_object();
  }

    public function check_relance_produit($date,$user)
  {
    $user = $this->session->userdata('matricule');
    $query = $this->db->query("SELECT clientpo.Code_client, clientpo.lien_facebook, clientpo.Compte_facebook, session.heure FROM session JOIN clientpo ON session.client=clientpo.Code_client WHERE session.date = '$date' 
    AND session.types LIKE 'RLNC_PROD' AND session.operatrice = '$user'");
    return $query->result();    
  }

  public function Bloc_Rafitinina($codeclient){
    $date = new DateTime();
    $dt = $date->format('Y-m-d');
    $query = $this->db->query("SELECT `Code_client`  FROM `facture` WHERE `Date` like '$dt' AND Code_client like '$codeclient'");
    return $query->row();
  }
  public function Retourner_lot_chapeau($chapeau){
    $query = $this->db->query("SELECT COUNT(`numero_tirage`) as lot FROM `carte_gratter_detail` WHERE `level` like '$chapeau'");
    return $query->row();
  }

   public function Retourner_lot_chapeau_tirer($chapeau){
    $query = $this->db->query("SELECT COUNT(`numero_tirage`) as lot FROM `carte_gratter_detail` WHERE `level` like '$chapeau' AND statut like 'tirée'");
    return $query->row();
  }

  public function Retourner_liste_lot($level){
    $query = $this->db->query("SELECT carte_gratter.code_carte,carte_gratter.designation, 
      COUNT(carte_gratter_detail.id) as 'Total' FROM `carte_gratter_detail`, carte_gratter WHERE `level` like '$level' AND carte_gratter_detail.id_carte_gratter=carte_gratter.id GROUP by carte_gratter.code_carte");
    return $query->result();
  }

  public function Retourner_nombre_lot_tirer_parproduit($codeproduit,$chapeau){
    $query = $this->db->query("SELECT COUNT(carte_gratter_detail.numero_tirage) as lot_tirer FROM carte_gratter_detail 
JOIN carte_gratter ON carte_gratter.id=carte_gratter_detail.id_carte_gratter
WHERE carte_gratter.code_carte like '$codeproduit' AND carte_gratter_detail.level like '$chapeau' AND carte_gratter_detail.statut like 'tirée'");
    return $query->row();
  }

  public function Retourner_liste_client_gagnant_carte($level,$code_carte){
    $query = $this->db->query("SELECT clientpo.Compte_facebook, carte_gratter_detail.code_gagnant, carte_gratter_detail.numero_tirage, carte_gratter_detail.Date_de_tirage, carte_gratter.code_carte, carte_gratter.designation FROM `carte_gratter_detail`, carte_gratter, clientpo WHERE carte_gratter.id=carte_gratter_detail.id_carte_gratter AND carte_gratter_detail.statut like 'tirée' AND carte_gratter_detail.level like '$level' AND carte_gratter.code_carte like '$code_carte' AND clientpo.Code_client like carte_gratter_detail.code_gagnant ");
    return $query->result();
  }
  public function retour_quary($query){
    return $this->db->query($query)->result_object();
  }

  public function ca_livre_semaine_passee($date,$oplg){
    $query = $this->db->query("SELECT sum(detailvente.Quantite*prix.Prix_detail) as 'CA_LIVRE' FROM detailvente 
      JOIN facture ON detailvente.Facture=facture.Id 
      JOIN prix ON detailvente.Id_prix=prix.Id 
      JOIN livraison on livraison.Id_facture = facture.Id_facture 
      WHERE livraison.date_de_livraison like '$date' 
      AND  facture.Matricule_personnel LIKE '$oplg' 
      AND facture.Status like 'livre' 
      AND facture.Id_de_la_mission = 'FACEBOOK' 
      ORDER BY livraison.date_de_livraison ASC ");
    return $query->row();
  }


  public function date_de_livraison($oplg){
    $query = $this->db->query("SELECT DISTINCT(livraison.date_de_livraison) as 'Date_livraison' FROM detailvente 
      JOIN facture ON detailvente.Facture=facture.Id 
      JOIN prix ON detailvente.Id_prix=prix.Id 
      JOIN livraison on livraison.Id_facture = facture.Id_facture 
      WHERE livraison.date_de_livraison BETWEEN '2022-12-12' AND '2022-12-17' 
      AND facture.Matricule_personnel LIKE '$oplg' 
      AND facture.Status like 'livre' 
      AND facture.Id_de_la_mission = 'FACEBOOK' 
      ORDER BY livraison.date_de_livraison ASC ");
    return $query->result();
  }

  public function Get_info_client_by_link($link){
     $query = $this->db->query("SELECT Code_client, Compte_facebook FROM clientpo WHERE lien_facebook like '$link' LIMIT 1 ");
     return $query->result();
  }

  public function Get_sondage_temoignage_by_operatrice($opl,$type,$date){
    $query = $this->db->query("SELECT Sondage_temoignage.Client, Sondage_temoignage.Code_client, Sondage_temoignage.Reponse,clientpo.Provenance FROM `Sondage_temoignage`
    JOIN clientpo ON clientpo.Code_client like Sondage_temoignage.Code_client
    AND Sondage_temoignage.Operatrice like '$opl'
    AND Sondage_temoignage.type like '$type'
    AND Sondage_temoignage.Date like '$date'
    ");
    return $query->result();
  }

  public function Get_Page_Active(){
    $query = $this->db->query("SELECT `id`, `Nom_page` FROM `comptefb` WHERE `statut` like 'on' and Type like 'page'");
    return $query->result() ;
  }

  public function Get_reference_Temoigange($opl,$type,$date){
    $query = $this->db->query("SELECT `reference` FROM `Sondage_temoignage` WHERE `type` like '$type' AND `Operatrice` like '$opl' AND `Date` like '$date'");
    return $query->row();
  }

  public function Get_all_TSF_by_opl($opl){
    $query = $this->db->query("SELECT Tache_TSF.Id, Tache_TSF.Date, comptefb.Nom_page, produit.Designation, Tache_TSF.Reference, Tache_TSF.Statut_opl, Tache_TSF.Statut_Correcteur FROM `Tache_TSF` 
      JOIN comptefb on comptefb.id=Tache_TSF.Page 
      JOIN produit ON produit.Code_produit like Tache_TSF.Produit 
      WHERE Tache_TSF.Operatrice like '$opl' AND Tache_TSF.Statut_opl like 'Encours' ORDER by Tache_TSF.Id ASC");
    return $query->result();
  }

  public function Get_TSF_detatil_by_id($id,$type){
    $query = $this->db->query("SELECT Tache_TSF_detail.Code_client, clientpo.Provenance, Tache_TSF_detail.Client , Tache_TSF_detail.Reponse  FROM `Tache_TSF_detail`
        JOIN clientpo ON clientpo.Code_client like Tache_TSF_detail.Code_client
     WHERE  Tache_TSF_detail.Id_Tache_TSF='$id' AND Tache_TSF_detail.Type like '$type'");
     return $query->result();
  }


  public function Get_TSF_by_Id($id){
    $query=$this->db->query("SELECT   Tache_TSF.`Operatrice`, Tache_TSF.`Id`,Tache_TSF.`Date`,comptefb.Nom_page, produit.Designation,  Tache_TSF.`Reference` FROM `Tache_TSF`
      JOIN comptefb ON comptefb.id=Tache_TSF.Page
      JOIN produit ON produit.Code_produit LIKE Tache_TSF.Produit
      WHERE Tache_TSF.`Id`=$id");
    return $query->row();
  }

   public function Get_TSF_detatil($id){
    $query = $this->db->query("SELECT Tache_TSF_detail.Id, Tache_TSF_detail.Type, clientpo.Compte_facebook, Tache_TSF_detail.Code_client, clientpo.Provenance, Tache_TSF_detail.Client , Tache_TSF_detail.Reponse, Tache_TSF_detail.Statut  FROM `Tache_TSF_detail`
        JOIN clientpo ON clientpo.Code_client like Tache_TSF_detail.Code_client
     WHERE  Tache_TSF_detail.Id_Tache_TSF='$id'");
     return $query->result();
  }

  public function Get_all_TSF(){
    $query = $this->db->query("SELECT Tache_TSF.Operatrice, Tache_TSF.Id, Tache_TSF.Date, comptefb.Nom_page, produit.Designation, Tache_TSF.Reference, Tache_TSF.Statut_opl, Tache_TSF.Statut_Correcteur FROM `Tache_TSF` 
      JOIN comptefb on comptefb.id=Tache_TSF.Page 
      JOIN produit ON produit.Code_produit like Tache_TSF.Produit 
      WHERE Tache_TSF.Statut_opl like 'Terminer' AND  Tache_TSF.Statut_Correcteur like 'Non_corriger'");
    return $query->result();
  }

   public function Get_all_TSF_corriger(){
    $query = $this->db->query("SELECT Tache_TSF.Operatrice, Tache_TSF.Id, Tache_TSF.Date, comptefb.Nom_page, produit.Designation, Tache_TSF.Reference, Tache_TSF.Statut_opl, Tache_TSF.Statut_Correcteur FROM `Tache_TSF` 
      JOIN comptefb on comptefb.id=Tache_TSF.Page 
      JOIN produit ON produit.Code_produit like Tache_TSF.Produit 
      WHERE Tache_TSF.Statut_Correcteur like 'Corrigée' AND Tache_TSF.Statut_info like 'Nouveau' ;");
    return $query->result();

   }

   public function Get_reference_by_Id($id){
    $query = $this->db->query("SELECT `Reference` FROM `Tache_TSF` WHERE `Id`='$id'");
    return $query->row();
   }

  public function getlivraison($oplg)
  {    

    $Current = Date('N');

    $DaysToSunday = 7 - $Current;

    $DaysFromMonday = $Current - 1;

    $Sunday = Date('Y-m-d', StrToTime("+ {$DaysToSunday} Days"));

    $Monday = Date('Y-m-d', StrToTime("- {$DaysFromMonday} Days"));

    $query = $this->db->query("SELECT `facture`.`Matricule_personnel`, `clientpo`.`Nom`, `clientpo`.`lien_facebook`, `facture`.`Ville`, `facture`.`contacts`, `prix`.`Code_produit`, `livraison`.`date_de_livraison`, `livraison`.`frais`, `facture`.`Code_client`, `detailvente`.`statut`, `detailvente`.`Quantite`, `detailvente`.`Id_prix`, `facture`.`Status`, `facture`.`lieu_de_livraison`, `facture`.`Id_facture`, `prix`.`Prix_detail`, `facture`.`date` FROM `detailvente` JOIN `facture` ON `facture`.`Id` = `detailvente`.`Facture` JOIN `prix` ON `prix`.`Id` = `detailvente`.`Id_prix` JOIN `produit` ON `produit`.`Code_produit` = `prix`.`Code_produit` JOIN `livraison` ON `livraison`.`Id_facture`=`facture`.`Id_facture` JOIN `clientpo` ON `facture`.`Code_client`=`clientpo`.`Code_client` WHERE facture.Matricule_personnel like '$oplg' and livraison.date_de_livraison BETWEEN '$Monday' and '$Sunday' ");
    return $query->result();
    
  }

  public function Exporte_livraison_Temporaire($date_livre,$statut){
     $query = $this->db->query("SELECT facture.Code_client, detailvente.Id, facture.Date, livraison.date_de_livraison, facture.contacts, produit.Designation, prix.Prix_detail, detailvente.Quantite, facture.lieu_de_livraison, facture.Matricule_personnel,facture.Quartier,facture.Ville, prix.Prix_detail*detailvente.Quantite as Montant, facture.Localite, livraison.frais, facture.Remarque, facture.Status FROM `facture` 
      JOIN livraison on livraison.Id_facture=facture.Id_facture 
      JOIN detailvente on detailvente.Facture=facture.Id 
      JOIN prix on prix.Id=detailvente.Id_prix 
      JOIN produit on produit.Code_produit=prix.Code_produit 
      AND facture.Status like '$statut' 
      AND livraison.date_de_livraison like '$date_livre'");
      return $query->result();

  }

  public function Get_infoclientby_code($code){
    $indication = substr($code,0,2);
    if($indication=="CRX"){
      $query =$this->db->query("SELECT `Compte_facebook`,`lien_facebook` FROM `client_curieux` WHERE `Code_client` like '$code'");
      return $query->result();

    }elseif ($indication=="CMT") {
       $query =$this->db->query("SELECT `Compte_facebook`,`lien_facebook` FROM `clientpo` WHERE `Code_client` like '$code'");
        return $query->result();
    }

  }

public function insertDetail_page_client($data){
   return $this->db->insert('detail_page_client',$data);
}
public function insertNuveau_contact($data){
  return $this->db->insert('nuveau_contact',$data);

}
public function get_all_facture_end_detail_vente_client($param)
{
  $this->db->select('facture.Id as "refnum_facture",comptefb.Nom_page,comptefb.id,produit.Code_produit,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail,facture.Matricule_personnel,facture.page');
  $this->db->where($param);
  $this->db->where('facture.Id_de_la_mission', "FACEBOOK");
  $this->db->join('facture', 'detailvente.Facture=facture.Id');
  $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
  $this->db->join('comptefb', 'comptefb.id=facture.Page');
  $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
  return $this->db->get('detailvente')->result_object();
}
public function get_questionnaire($pram=array()){
  return $this->db->where($pram)->get('questionnaire')->result_object();
}
public function insert_reponse_question($data){
  return $this->db->insert('reponse_question',$data);
}
public function update_relance_aa7($param,$data){
  return $this->db->where($param)->update('relance_aa7',$data);

}
public function insert_produit_user($data){
  return $this->db->insert('produit_user',$data);
}
public function insert_commentaire($data){
  return $this->db->insert('commentaire',$data);
}
public function get_all_vue_detail_facture($param){
   return $this->db->where($param)->get('vue_detail_facture')->result_object();
}
public function get_all_vue_livraison_detail_table($param){
   return $this->db->where($param)->get('vue_livraison_detail_table')->result_object();
}
public function get_vue_livraison_detail_table($param){
   return $this->db->where($param)->get('vue_livraison_detail_table')->row_object();
}
public function get_fect_questionnaire($param=array()){
  return $this->db->where($param)->get('questionnaire')->result_object();
}
public function get_reponse_question($param=array()){
  return $this->db->where($param)->get('reponse_question')->row_object();
}
public function get_distinct_reponse_question($param=array(),$param2){
  return $this->db->where($param)->group_by($param2)->get('reponse_question')->result_object();
}

public function get_client_po($param=array()){
  return $this->db->where($param)->get('clientpo')->row_object();
}


}
