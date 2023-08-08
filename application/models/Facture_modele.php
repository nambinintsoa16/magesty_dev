<?php
class Facture_modele extends CI_Model 
{
    public function getAllFacture()
    {
        $sql = $this->db->query("SELECT * from client_curieux ") ; 
        $result = $sql->result() ; 
        //echo(count($result)) ; 
        return $result ; 
    }
    public function getClientByFacture($idFacture)
    {
        return null ; 
    }

    public function afficheFacture($dta)
    {
        $this->db->select('facture.Id,produit.Code_produit,produit.Designation,prix.Prix_detail,detailvente.Quantite,facture.contacts,facture.Quartier,clientpo.Compte_facebook,clientpo.Nom,personnel.Nom,personnel.Matricule,livraison.date_de_livraison,livraison.frais');  
        $this->db->join('detailvente','detailvente.Facture=facture.Id');
        $this->db->join('prix','prix.Id=detailvente.Id_prix');
        $this->db->join('produit','produit.Code_produit=prix.Code_produit');
        $this->db->join('livraison','livraison.Id_facture=facture.Id_facture');
        $this->db->join('clientpo','clientpo.Code_client=facture.Code_client');
        $this->db->join('personnel','personnel.Matricule=facture.Matricule_personnel');
        $this->db->where('livraison.date_de_livraison',$dta);
        return  $this->db->get('facture')->result_object();
    }

    public function returnDetailFacture($idFacture)
    {
        $this->db->select('produit.Designation,produit.Code_produit,prix.Prix_detail,detailvente.Quantite');  
        $this->db->join('prix','prix.Id=detailvente.Id_prix');
        $this->db->join('produit','produit.Code_produit=prix.Code_produit');
        $this->db->where('detailvente.Facture',$idFacture);
        return  $this->db->get('detailvente')->result_object();
    }
}
?>