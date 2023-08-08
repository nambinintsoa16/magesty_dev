<?php
class produit_model extends CI_Model{
 public function __construct(){

 }
 public function detail_produit($codeproduit){
   
   $this->db->join('prix','prix.Code_produit=produit.Code_produit');
   $this->db->join('categorie','categorie.Id=produit.Categorie');
   $this->db->where('produit.Code_produit',$codeproduit);
   $this->db->where('prix.Statut','on');
   $this->db->where('prix.Localite',5);
   return $this->db->get('produit')->row_object();
 }

 public function rechercheProduit($parametre){
  $this->db->join('prix','prix.Code_produit=produit.Code_produit');
  $this->db->join('categorie','categorie.Id=produit.Categorie');
  $this->db->where($parametre);
  return $this->db->get('produit')->result_object();
  

 }

 public function findProduitByStatus($parametre) {
    $this->db->select('COUNT(*) as qt, produit.Code_produit, produit.Designation, detailvente.Quantite, prix.Prix_detail');
    $this->db->join('facture', 'facture.Id = detailvente.Facture');
    $this->db->join('prix', 'prix.Id = detailvente.Id_prix');
    $this->db->join('produit', 'produit.Code_produit = prix.Code_produit');
    $this->db->join('categorie', 'categorie.Id = produit.Categorie');
    $this->db->group_by(['produit.Code_produit']);
    $this->db->where($parametre);
    return $this->db->get('detailvente')->result_object();
 }

 public function countProduitWithDetails($parametre) {
    $this->db->select('COUNT(*) as qt');
    $this->db->join('facture', 'facture.Id = detailvente.Facture');
    $this->db->join('prix', 'prix.Id = detailvente.Id_prix');
    $this->db->join('produit', 'produit.Code_produit = prix.Code_produit');
    $this->db->join('categorie', 'categorie.Id = produit.Categorie');
    $this->db->where($parametre);
    return $this->db->get('detailvente')->row_object();
 }

  public function produitWithDetails($parametre) {
    $this->db->select('produit.Code_produit, produit.Designation, detailvente.Quantite, prix.Prix_detail, facture.Status');
    $this->db->join('facture', 'facture.Id = detailvente.Facture');
    $this->db->join('prix', 'prix.Id = detailvente.Id_prix');
    $this->db->join('produit', 'produit.Code_produit = prix.Code_produit');
    $this->db->join('categorie', 'categorie.Id = produit.Categorie');
    $this->db->where($parametre);
    return $this->db->get('detailvente')->result_object();
  }
  public function promotion($rquette=array()){
    return $this->db->where($rquette)->get('promotion')->result_object();
  }
  public function Selectpromotion($rquette=array()){
    return $this->db->where($rquette)->get('promotion')->row_object();
  }
}