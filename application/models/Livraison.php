<?php
class Livraison extends CI_Model{
 public function __construct(){

 }
 public function listeLivraison(){
 	$this->db->select('prix.Code_produit, facture.Code_client,detailvente.statut,detailvente.Quantite,detailvente.Id_prix,facture.Status, facture.lieu_de_livraison, facture.Remarque, prix.Prix_detail');
 	$this->db->where('facture.date', date('Y-m-d'));
 	$this->db->join('facture', 'facture.Id = detailvente.Facture');
 	$this->db->join('prix', 'prix.Id = detailvente.Id_prix');
 	$this->db->join('produit', 'produit.Code_produit = prix.Code_produit');
 	$this->db->join("livraison", "livraison.Id_facture=facture.Id_facture");
 	return $this->db->get('detailvente')->result_object();

 }
}