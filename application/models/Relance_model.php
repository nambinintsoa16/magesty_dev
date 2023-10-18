<?php
class Relance_model extends CI_Model{
 public function __construct(){

 }
 
 public function dernier_facture($code_client){
 $this->db->where('Code_client',$code_client);
 $this->db->order_by('Date','DESC');
 return $this->db->get('facture')->row_object();
 }

 public function detail_client_relance($codeclient){
        $this->db->where("Code_client",$codeclient);
        return $this->db->get('clientpo')->row_object();  
 }
public function relance_du_joureffectuer($user,$date=FALSE){
    if($date==FALSE){
         $date=date('Y-m-d');
     }
     $this->db->where('relance.Date',$date);
     $this->db->where('relance.User',$user);
     $this->db->where('relance.Statut','off');
     return $this->db->get('relance')->result_object();
}
 public function relance_du_jour($user,$date=FALSE){
     if($date==FALSE){
         $date=date('Y-m-d');
     }
     $this->db->where('relance.Date',$date);
     $this->db->where('relance.User',$user);
     $this->db->where('relance.Statut','on');
     return $this->db->get('relance')->result_object();
 }

 public function insert_relance($Date,$User,$Client,$Type_Client){
        $data=[
             'Date'=>$Date,
             'User'=>$User,
             'Client'=>$Client,
             'Statut'=>'on',
             'Type_Client'=>$Type_Client 
        ];
        $this->db->insert('relance',$data);
 }
   public function detailvente($idfacture)
    {
      $this->db->select('detailvente.statut,produit.Code_produit,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
      $this->db->where('detailvente.Facture',$idfacture);
      $this->db->join('facture', 'detailvente.Facture=facture.Id');
      $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
      $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
      return $this->db->get('detailvente')->result_object();
    }
   public function updateRelance($id,$data){
        $this->db->where('Id',$id);
        return $this->db->update('relance',$data);
   }


   public function client_a_traiter($page,$jour)
   {
    return $this->db->query("select comptefb.Nom_page FROM facture 
     INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
         INNER JOIN comptefb ON facture.Page=comptefb.id 
         JOIN session ON session.page = comptefb.id
         WHERE session.page ='$page'              
         AND facture.Status ='livre' 
         AND facture.data_de_livraison  =CURRENT_DATE() - INTERVAL $jour DAY GROUP BY clientpo.Code_client")->result();
   }
   public function relanceFait($oplg,$param)
   {
    return count($this->db->query(" SELECT * FROM `session` WHERE `types` LIKE '$param' AND `date` =CURRENT_DATE AND `operatrice` = '$oplg' GROUP BY `client`")->result());
 
   }

   public function clientctl007($page,$jour)
  {
    $query = $this->db->query("SELECT clientpo.Code_client, clientpo.Compte_facebook,clientpo.lien_facebook, comptefb.Nom_page FROM session JOIN clientpo on clientpo.Code_client=session.client JOIN comptefb on comptefb.id=session.page WHERE session.date=CURRENT_DATE - INTERVAL $jour DAY AND session.page='$page' GROUP BY session.client");
    return $query->result_object();
  }

  public function PROP_CLT_jm($oplg,$lien)
{
  $query = $this->db->query("SELECT * FROM `session` JOIN `clientpo` ON `session`.`client`=`clientpo`.`Code_client` WHERE `session`.`date`=CURRENT_DATE AND `session`.`types` LIKE 'REA_CLT_JAIME' AND `clientpo`.`lien_facebook` LIKE '$lien'  AND `session`.`operatrice` = '$oplg' GROUP BY `clientpo`.`lien_facebook`");
  $resultat = $query->result();
  return count($resultat);
}

public function testlistes($date,$operatrice,$client,$type)
{
  $query = $this->db->query("SELECT * FROM `session` JOIN `clientpo` ON `session`.`client`=`clientpo`.`Code_client` WHERE `session`.`operatrice` like '$operatrice' AND `session`.`types` like '$type' AND  session.date like '$date' AND `clientpo`.`lien_facebook` like '$client' group by client ");
  $resultat = $query->result();
  return count($resultat);
}

  /*public function PROP_CLT_jm($date,$oplg,$lien)
  {
    $this->db->order_by('session.id', 'ASC');
    $this->db->group_by('clientpo.lien_facebook');
    $this->db->select('clientpo.Code_client, clientpo.lien_facebook,clientpo.Compte_facebook,session.heure');
    $this->db->where('session.date',$date);
    $this->db->like('session.types',"REA_CLT_JAIME");
    $this->db->like('clientpo.lien_facebook',$lien);
    $this->db->where('session.operatrice',$oplg);
    $this->db->join('clientpo','session.client=clientpo.Code_client');
    return $this->db->get('session')->result_object();
  }
   */

  public function relanceNonTraitee($page, $parametre1, $parametre2, $parametre3 )
  {
    $query = $this->db->query("SELECT clientpo.Code_client,livraison.date_de_livraison, facture.Matricule_personnel,facture.contacts, clientpo.lien_facebook, clientpo.Compte_facebook ,comptefb.Nom_page FROM facture 
    INNER JOIN clientpo ON facture.Code_client=clientpo.Code_client 
        INNER JOIN comptefb ON facture.Page=comptefb.id 
        JOIN session ON session.page = comptefb.id
        JOIN livraison ON livraison.Id_facture = facture.Id_facture
        WHERE session.page ='$page'             
        AND facture.Status ='livre' 
        AND livraison.date_de_livraison BETWEEN CURRENT_DATE() - INTERVAL '$parametre1' DAY AND CURRENT_DATE() - INTERVAL '$parametre2' DAY  AND clientpo.Code_client NOT IN (SELECT session.client FROM session WHERE  session.types LIKE '$parametre3' AND session.date BETWEEN CURRENT_DATE - INTERVAL '$parametre1' DAY AND CURRENT_DATE AND session.page='$page') GROUP BY facture.Code_client order by livraison.date_de_livraison");
     return $query->result_object();
  }
  public function relanceAvecAchat($parametre=array()){
    return $this->db->where($parametre)
     ->get("relanceDiscussion")
     ->result_object();
  }
  public function get_relance_aa7($param){
    return $this->db->where($param)->get('relance_aa7')->row_object();
  }


}