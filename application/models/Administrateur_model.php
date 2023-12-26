<?php
class Administrateur_model extends CI_Model
{

    public function Ajout_Bonus($data)
    {
        return $this->db->insert('Compte', $data);
    }
    public function Ajout_Mouvement($donner)
    {
        return $this->db->insert('Mouvement_compte', $donner);
    }
    public function insertSmileModel($donner)
    {
        return $this->db->insert('Smile', $donner);
    }
    public function Transaction_Koty($requette = array())
    {
        return $this->db->where($requette)->get('Mouvement_compte')->result_object();
    }
    public function Mouvement_smile($requette = array())
    {
        return $this->db->where($requette)->get('Smile')->result_object();
    }
    public function select_Mouvement_smile($requette = array())
    {
        return $this->db->where($requette)->get('Smile')->row_object();
    }
    public function update_Mouvement_smile($requette, $data)
    {
        return $this->db->where($requette)->update('Smile', $data);
    }
    public function Delete_transaction($id)
    {
        $this->db->where('Id', $id);
        return $this->db->delete('Mouvement_compte');
    }
    public function Deletetransaction($requette)
    {
        return $this->db->where($requette)->delete('Mouvement_compte');
    }
    public function Delete_movementSmile($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('Mouvement_smile');
    }
    public function selectKoty($requette = array())
    {
        return $this->db->where($requette)->get('Mouvement_compte')->row_object();
    }
    public function selectSmile($requette = array())
    {
        return $this->db->where($requette)->get('Mouvement_smile')->row_object();
    }
    public function selectCodeclient($requette = array())
    {
        return $this->db->where($requette)->get('Mouvement_smile')->row_object();
    }

    public function insertMouve($data)
    {
        return $this->db->insert('Mouvement_smile',$data);
    }
    
    public function Afficher_client($client1, $date_expir1)
    {
        $this->db->select("Compte.Id,Compte.Client,Compte.Koty,Mouvement_compte.Raison,Mouvement_compte.Observation,Mouvement_compte.Type");
        $this->db->join('Mouvement_compte', 'Compte.Client=Mouvement_compte.Client');
        $this->db->where('Compte.Client', $client1);
        $this->db->where('Compte.Date_expiration', $date_expir1);
        return $this->db->get('Compte')->result_object();
    }
    public function selectCompte($requette = array())
    {
        return $this->db->where($requette)->get('Compte')->row_object();
    }
    public function selectCompteKoty($codeClient)
    {
        $this->db->select('*');
        $this->db->where('Client', $codeClient);
        return $this->db->get('Compte')->row_object();
    }
    public function selectClientCode($id)
    {
        $this->db->select('Koty,Client');
        $this->db->where('Id', $id);
        return $this->db->get('Compte')->row_object();
    }
    public function selectMouvementCompteKoty($codeClient, $id)
    {
        $this->db->select('Koty,Client');
        $this->db->where('Client', $codeClient);
        $this->db->where('Id', $id);
        return $this->db->get('Mouvement_compte')->row_object();
    }
    public function updateCompteKoty($codeClient = array(), $data = array())
    {
        return $this->db->where($codeClient)->update('Compte', $data);
    }
    public function updateCompte($requette = array(), $data)
    {
        return $this->db->where($requette)->update('Compte', $data);
    }
    public function insertCompte($requette)
    {
        return $this->db->insert('Compte', $requette);
    }
    public function selectBonus($requette)
    {
        return $this->db->where($requette)->get('bonus_koty')->row_object();
    }
    public function selectAllBonus($requette)
    {
        return $this->db->where($requette)->get('bonus_koty')->result_object();
    }

    public function selectsParametreTombola($requette=array())
    {
        return $this->db->where($requette)->get('parametreTombola')->result_object();
    }

    public function Info_transaction($facture)
    {
        $this->db->select('detailvente.statut,detailvente.Quantite,detailvente.Id_prix,detailvente.Type_de_prix,prix.Prix_detail,facture.Matricule_personnel,produit.Code_produit, produit.Designation');
        $this->db->where('facture.Id_facture', $facture);
        $this->db->join('facture', 'detailvente.Facture=facture.Id');
        $this->db->join('prix', 'detailvente.Id_prix=prix.Id');
        $this->db->join('produit', 'produit.Code_produit=prix.Code_produit');
        return $this->db->get('detailvente')->result_object();
    }

    public function isertNewPromotionModel($data)
    {
        return $this->db->insert('promotion', $data);
    }
    public function updateParametreTombola($data,$requette){
        return $this->db->where($requette)->update('promotion', $data);
    }
    public function affichageListePromotion($data=array()){
        return $this->db->where($data)->get('promotion')->result_object();
    }
    public function deletePromotion($requette){
        return $this->db->where($requette)->delete('promotion');
    }
    public function insertparametreTombola($parametre){
        return $this->db->insert('parametreTombola',$parametre);
    }

    public function updateparametreTombolas($data,$requette){
        return $this->db->where($requette)->update('parametreTombola', $data);
    }
    
    public function deleteparametreTombola($parametre){
        return $this->db->where($parametre)->delete('parametreTombola');
    }
    
    public function insertDataExcel()
    {
        return $this->db->insert_batch('tbl_customer', $data);
    }
    public function autoCompleteNouvellePage($requette)
    {
        return $this->db->like('Nom_page',$requette)
        ->limit(10)
        ->get('comptefb')->result_object();
    }

     public function get_result_publication($requette=array())
    {
        return $this->db->where($requette)
        ->limit(10)
        ->get('publication')->result_object();
    }

    
    public function saveNewPage($data)
    {
        return $this->db->insert('page_fb',$data);
    }
    public function saveNewCompte($data)
    {
        return $this->db->insert('comptefb',$data);
    }

    public function updatePage($requette,$data){

        return $this->db->where($requette)->update('page_fb',$data);
    }

    public function selectsPage($requette=array()){

        return $this->db->where($requette)->get('page_fb')->result_object();
    }

    public function UpdateApple($requette,$data){
        return $this->db->where($requette)->update('clientappel',$data);
      }
      public function SelectApple($requette){
       return $this->db->where($requette)->get('clientappel')->row_object();
     }
     
      public function type_appel($requette=array()){
       return $this->db->where($requette)->get('type_appel')->result_object();
     }
     
     public function result_appel($requette=array()){
       return $this->db->where($requette)->get('result_appel')->result_object();
     }

     public function insert_type_appel($requette=array()){
        return $this->db->insert('type_appel',$requette);
      }
      
      public function insert_result_appel($requette){
        return $this->db->insert('result_appel',$requette);
      }
      public function saveDataAppel($data){
        return $this->db->insert_batch('produits_test', $data);
      }
      /*Affichage liste des données importés par excel*/
      public function selectDataExcel($requette=array())
      {
          return $this->db->where($requette)->get('produits_test')->result_object();
      }
    public function getPrix($param)
    {
      return $this->db->where($param)->get('prix')->row_object();
       
    }

    public function getInfoFacture($param)
    {
      return $this->db->where($param)->get('facture')->row_object();
       
    }

     public function get_result_Facture($param)
    {
      return $this->db->where($param)->limit(3)->get('facture')->result_object();
       
    }
    public function insert_livreur($data){
      return $this->db->insert("livreur",$data);
    }
    public function get_result_livreur($param=array() ){
        return $this->db->where($param)->get('livreur')->result_object();
    }

    public function update_facture($requette, $data)
    {
        return $this->db->where($requette)->update('facture', $data);
    }
    
    public function getComptefb($param){
       return $this->db->where($param)->get('comptefb')->row_object();
    }
    public function insert_produit_user($data){
        return $this->db->insert('Produit_user',$data);
    }
    public function get_fetch_produit_user($data=array()){
        return $this->db->where($data)->get('Produit_user')->result_object();
    }
    public function insert_questionnaire($data){
        return $this->db->insert('questionnaire',$data);
    }
    public function get_fetch_questionnaire($param=array()){
        return $this->db->where($param)->get('questionnaire')->result_object();
    }
    public function get_questionnaire($param=array()){
        return $this->db->where($param)->get('questionnaire')->row_object();
    }
    public function get_personnel($param){
        return $this->db->where($param)->get("personnel")->row_object();
    }
    public function get_fetch_personnel($param){
        return $this->db->where($param)->get("personnel")->result_object();
    }
     public function insert_personnel($param){
        return $this->db->insert("personnel",$param);
    }
     public function updatet_personnel($param,$data){
        return $this->db->where($param)->update("personnel",$data);
    }
    public function get_reponse_question_distinct($param=array()){
     return $this->db->where($param)->group_by('Produit')->get('reponse_question')->result_object();
    }

    public function get_fetch_reponse_question($param=array()){
     return $this->db->where($param)->get('reponse_question')->result_object();
    }
    public function get_joint_cathegory($param=array()){
        return $this->db->where($param)->join("produit","produit.Code_produit=reponse_question.Produit")->join("categorie","categorie.Id=produit.Categorie")->get('reponse_question')->result_object();
    }
    public function get_famille_produit($param=array()){
        return $this->db->where($param)->group_by("famille")->get('categorie')->result_object();
    } 
    public function get_produit($param){
         return $this->db->where($param)->get('produit')->row_object();
    }

}