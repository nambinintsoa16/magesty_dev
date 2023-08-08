<?php
class koty_model extends CI_Model
{
   public function __construct()
   {
   }

   public function lot()
   {
      return $this->db->count_all_results('carte_gratter');
   }
   public function get_lot($limit, $start)
   {
      return  $this->db->limit($limit, $start)->get('carte_gratter')->result();
   }

   public function carte_gratter_detail($limit, $start)
   {
      return  $this->db->limit($limit, $start)->get('carte_gratter_detail')->result();
   }

   public function updateDetcarte_gratter_detail($requette, $data)
   {
      return $this->db->where($requette)->update("carte_gratter_detail", $data);
   }
   public function carte_gratter_detail_select($requette)
   {
      return $this->db
         ->where($requette)
         ->select("carte_gratter.code_carte,designation,carte_gratter.gain,carte_gratter.operation,carte_gratter_detail.id,carte_gratter_detail.level,carte_gratter_detail.numero_tirage,carte_gratter_detail.statut,carte_gratter_detail.code_gagnant,carte_gratter_detail.id_carte_gratter")
         ->join('carte_gratter', 'carte_gratter.id=carte_gratter_detail.id_carte_gratter')
         ->order_by('carte_gratter_detail.id', 'RANDOM')
         ->LIMIT(10)
         ->get('carte_gratter_detail')
         ->result_object();
   }
   public function selectFactureDesc($requette=array())
   {
      return $this->db->where($requette)
      ->order_by('Id', 'DESC')
      ->get('facture')
      ->row_object();
   }
   public function detailFacture($requette){
    return $this->db->select('prix.Code_produit,detailvente.statut,produit.Designation,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail')
    ->where($requette)
    ->join('facture', 'detailvente.Facture=facture.Id')
    ->join('prix', 'detailvente.Id_prix=prix.Id')
    ->join('produit', 'produit.Code_produit=prix.Code_produit')
    ->get('detailvente')->result_object();
   }

   public function listeProduit($requette=array())
    {
      return $this->db->select("produit.Code_produit, produit.Designation, prix.Prix_zen")
      ->join("prix","produit.Code_produit=prix.Code_produit") 
      ->where($requette)
      ->where("(Categorie in ('76','77') and prix.Localite=1)")
      ->get("produit")
      ->result_object();
    }

    public function etat_vente($requette)
  {
   return  $this->db->select('facture.codePromo,facture.Id,facture.Matricule_personnel,
   facture.Id_de_la_mission,facture.Matricule_personnel,
   facture.Ress_sec_oplg,facture.Status,facture.Date,
   livraison.date_de_livraison,facture.Id_facture,
   facture.Code_client,facture.data_de_livraison,
   (select SUM(prix.Prix_detail*detailvente.Quantite) from prix,detailvente where detailvente.Id_prix =  prix.Id AND  detailvente.Facture like facture.Id ) as "Montant"
   ')
    ->where($requette)
    ->where('facture.Id_de_la_mission', 'FACEBOOK')
    ->join('livraison', 'livraison.Id_facture=facture.Id_facture')
    ->get('facture')->result_object();
  }
  public function produitname($Code_produit)
  {

      $this->db->select('prix.Id,produit.Code_produit,produit.Designation,prix.Prix_zen');
      $this->db->join('categorie', 'produit.Categorie=categorie.Id');
      $this->db->join('prix', 'produit.Code_produit=prix.Code_produit');
      $this->db->where('produit.Code_produit', $Code_produit);
      $this->db->where('prix.Statut', 'on');
      return $this->db->get('produit')->row_object();
   
  }
}
