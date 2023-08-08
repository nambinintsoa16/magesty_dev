<?php
class CarteAgratter_model extends CI_Model
{
  public function __construct(){

  }
  public function Retourner_carte_tirer($num_tirage,$level){
    $query = $this->db->query("SELECT `carte_gratter`.`code_carte`, `carte_gratter`.`designation`, `carte_gratter`.`gain`, `carte_gratter`.`operation`, `carte_gratter_detail`.`numero_tirage` FROM `carte_gratter` JOIN `carte_gratter_detail` ON `carte_gratter_detail`.`id_carte_gratter`=`carte_gratter`.`id` AND `carte_gratter_detail`.`numero_tirage` =$num_tirage AND carte_gratter_detail.level like '$level'");
     return $query->row();
  }


  public function Retourner_Smiles_Client($codeclient){
    $date = new DateTime();
    $dtm = $date->format('m');
    $dt = $date->format('Y');
    if($dtm == '01' OR $dtm == '02' OR $dtm ==  '03'){
      $datedebut = $dt.'-10-01';
      $datefin = $dt.'-12-31';
    }elseif($dtm == '04' OR $dtm == '05' OR  $dtm ==  '06'){
      $datedebut = $dt.'-01-01';
      $datefin = $dt.'-03-30';
    }elseif($dtm == '07' OR $dtm == '08' OR $dtm ==  '09'){
      $datedebut = $dt.'-04-01';
      $datefin = $dt.'-06-30';
    }elseif($dtm == '10' OR $dtm == '11' OR $dtm ==  '12'){
      $datedebut = $dt.'-07-01';
      $datefin = $dt.'-09-31';
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
  ) AS 'smiles' FROM facture 
     JOIN detailvente ON  facture.`Id` = detailvente.`Facture` 
     JOIN prix ON prix.`Id` = detailvente.`Id_prix`  
     WHERE facture.`Code_client` LIKE '$codeclient' 
     AND facture.`data_de_livraison` BETWEEN  '$datedebut' AND '$datefin' ");
     return $query->row();

  }

   public  function Retourner_Level_Client($smiles){
      if($smiles <= 1499 AND $smiles >= 0){
        $statut ="Level 1";
        return $statut;
      }elseif ($smiles <= 2499 AND $smiles >= 1500) {
        $statut ="Level 2";
        return $statut;
        
      }elseif ($smiles <= 4999 AND $smiles >= 2500) {
        $statut ="Level 3";
        return $statut;
        
      }elseif ($smiles <= 9999 AND $smiles >= 5000) {
        $statut ="Level 4";
        return $statut;
        
      }elseif ($smiles <= 99999999 AND $smiles >= 10000) {
        $statut ="Level 5";
        return $statut;
        
      }else{

        $statut ="Votre statut n'est pas valide, veillez consulter le responsable technique";
        return $statut;

      }
    }
}