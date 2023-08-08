<?php
class userservice_model extends CI_Model{
 public function __construct(){

 }

 public function performance($matricule,$date=null){
 if($date==null){
    $date=date("Y-m-d");
 }
 return $this->db->query("SELECT (SELECT COUNT(Id) FROM facture WHERE Matricule_personnel = personnel.Matricule AND facture.Date = '".$date."') AS 'vente_du_jour',(SELECT SUM(detailvente.Quantite) FROM detailvente,facture WHERE detailvente.Facture = facture.Id AND facture.Matricule_personnel = personnel.Matricule AND facture.Date ='".$date."') AS 'Produit_vendue',(SELECT COUNT(clientpo.id) FROM clientpo WHERE clientpo.datedenregistrement = '".$date."' AND clientpo.Matricule_personnel = personnel.Matricule) AS 'Nouveau_client',
(SELECT SUM(prix.Prix_detail * detailvente.Quantite) FROM detailvente,prix,facture WHERE detailvente.Id_prix = prix.Id and detailvente.Facture = facture.Id AND facture.Date = '".$date."' AND facture.Matricule_personnel = personnel.Matricule) AS 'ventedujou',
(SELECT COUNT('id') FROM clientpo where Matricule_personnel=personnel.Matricule) AS 'NBCLINE',
(SELECT SUM(prix.Prix_detail * detailvente.Quantite) FROM detailvente,prix,facture WHERE detailvente.Id_prix = prix.Id and detailvente.Facture = facture.Id AND facture.Date like '".date('Y-m')."%' AND facture.Matricule_personnel = personnel.Matricule) AS 'CAMOIS',
(SELECT COUNT(id) FROM session WHERE sender = 'CLT' AND operatrice =personnel.Matricule  AND action = 'message' AND date = '".$date."') AS 'discussion'
FROM personnel WHERE Matricule='".$matricule."'")->row_object();
 
 }
 public function nouveauclient($date,$matricule){
    return  $this->db->query("SELECT * FROM clientpo WHERE  clientpo.Matricule_personnel ='$matricule'")->result_object();
 }
 
 public function dateChart($matricule){
    $this->db->select('distinct(date)');
    $this->db->where('Matricule_personnel',$matricule);
    return $this->db->get('facture')->result_object();
 }
 public function dataChart($matricule,$date){
    $data = $this->db->query("SELECT SUM(prix.Prix_detail * detailvente.Quantite) AS 'nb' FROM detailvente,prix,facture WHERE detailvente.Id_prix = prix.Id and detailvente.Facture = facture.Id AND facture.Date = '".$date."' AND facture.Matricule_personnel = '".$matricule."'")->row_object();
    return $data->nb;
 }
 public function dateAchat($parametre){
    return $this->db->distinct()->select('Date')->where($parametre)->get('facture')->result_object();
 }
 public function dataAchat($parametre){
    return $this->db->select('SUM(prix.Prix_detail * detailvente.Quantite) AS "total"')
    ->join('facture','detailvente.Facture=facture.Id')
    ->join('prix','prix.Id=detailvente.Id_prix')
    ->where($parametre)->get('detailvente')->row_object();
 }
 public function tableData(){
    
            $this->db->select('produit.Code_produit, produit.Designation, detailvente.Quantite, prix.Prix_detail,facture.Code_client');
            $this->db->where('facture.date', date('Y-m-d'));
            $this->db->where('facture.Matricule_personnel', $this->session->userdata('matricule'));
            $this->db->join('facture', 'facture.Id= detailvente.Facture');
            $this->db->join('prix', 'prix.Id= detailvente.Id_prix');
             $this->db->join('produit', 'produit.Code_produit= prix.Code_produit');
            return $this->db->get('detailvente')->result_Object();
        
 }
 public function ProduitVendu(){
    $this->db->select('produit.Code_produit,produit.Designation, detailvente.Quantite, prix.Prix_detail, facture.Status');
    $this->db->where('facture.date', date('Y-m-d'));
    $this->db->where('facture.Matricule_personnel', $this->session->userdata('matricule'));
    $this->db->join('facture', 'facture.Id= detailvente.Facture');
    $this->db->join('prix', 'prix.Id= detailvente.Id_prix');
    $this->db->join('produit', 'produit.Code_produit= prix.Code_produit');
    $this->db->join('categorie', 'categorie.Id = produit.Categorie');
    return $this->db->get('detailvente')->result_Object();

 }
 public function NouveauClients($parametre){
    return $this->db->where($parametre)->get('clientpo')->result_Object();

 }
 public function VenteDuJours(){
 $this->db->select('produit.Code_produit,produit.Designation, detailvente.Quantite, prix.Prix_detail, facture.Status');
    $this->db->where('facture.date', date('Y-m-d'));
    $this->db->where('facture.Matricule_personnel', $this->session->userdata('matricule'));
    $this->db->join('facture', 'facture.Id= detailvente.Facture');
    $this->db->join('prix', 'prix.Id= detailvente.Id_prix');
    $this->db->join('produit', 'produit.Code_produit= prix.Code_produit');
    $this->db->join('categorie', 'categorie.Id = produit.Categorie');
    return $this->db->get('detailvente')->result_Object();
 }
 

}