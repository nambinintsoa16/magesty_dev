<?php
class compta_model extends CI_Model
{
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

  public function ca_vente_livre($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('livraison.date_de_livraison', $dte);
    $this->db->where('facture.Id_de_la_mission','TSENA_KOTY');
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

   public function liste_client_facture_rep($date)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("facture.Remarque,facture.Id,facture.Code_client,livraison.date_de_livraison,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->where('livraison.dateRep', $dte);
     $this->db->where('facture.Id_de_la_mission','TSENA_KOTY');
    $this->db->like('facture.Status', 'reppoter');

    return $this->db->get('facture')->result_object();
  }

   public function liste_client_facture_sc($date, $status = FALSE)
  {
    $dt = new dateTime($date);
    $dte = $dt->format('Y-m-d');
    $this->db->select("facture.Remarque,facture.Id,facture.Code_client,livraison.date_de_livraison,facture.Ville,facture.Quartier,facture.Remarque,facture.Status");
    $this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
    $this->db->where('livraison.date_de_livraison', $dte);
     $this->db->where('facture.Id_de_la_mission','TSENA_KOTY');
    if ($status != 'Previ') {
      if ($status == "confirmer") {
        $this->db->where('(facture.Status LIKE "' . $status . '" OR  facture.Status LIKE "reppoter")');
      } else {
        $this->db->where('facture.Status', $status);
      }
    }
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

  public function ca_facture($idfacture)
  {
    $this->db->select('produit.Code_produit,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail');
    $this->db->where('facture.Id', $idfacture);
    $this->db->join('facture', 'detailvente.Facture=facture.Id');
    $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
    $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
    return $this->db->get('detailvente')->result_object();
  }

  public function livre_vente($livreur, $remarque, $facture)
  {
    $data = [
      'Remarque_Compta' => $remarque,
      'Nom_Compta' => $livreur,
    ];
    $this->db->where('Id_facture', $facture);
    $this->db->update('livraison', $data);
    $this->db->flush_cache();
    $facturedata = [
      'Statut_Tsenakoty' => 'Payer'
    ];
    $this->db->where('Id_facture', $facture);
    $this->db->update('facture', $facturedata);
  }

   public function annulelivres($remarque, $facture, $nomlivre)
  {
    $data = [
      'Remarque_Compta' => $remarque,
      'Nom_Compta' => $nomlivre
    ];
    $this->db->where("Id_facture", $facture);
    $this->db->update('livraison', $data);
  }


  public function annule_facture($facture)
  {
    $data = [
      'Statut_Tsenakoty' => 'Versement_annuler'
    ];
    $this->db->where('Id_facture', $facture);
    $this->db->update('facture', $data);
  }
                        
}
