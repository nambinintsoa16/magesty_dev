<?php
class client_model extends CI_Model
{
   public function __construct()
   {
   }
   public function insert($exist = false)
   {
   }
   public function get_next_clientpo_Id()
   {
      $requette = "SELECT id FROM clientpo ORDER BY id DESC LIMIT 1";
      $id = '' . (($this->db->query($requette)->row()->id) + 1);
      if (isset($id)) {
         while (strlen($id) < 7) {
            $id = '0' . $id;
         }
         return $id;
      }
   }
   public function generate_Code_clientpo($id = null)
   {
      if (isset($id)) {
         return 'CMT-FB-' . $id . '-' . date('Y-m');
      } else {
         $id = $this->get_next_clientpo_Id();
         return 'CMT-FB-' . $id . '-' . date('Y-m');
      }
   }
   public function insertCompte($requette)
   {
      return $this->db->insert('Compte', $requette);
   }
   public function Ajout_Mouvement($donner)
   {
      return $this->db->insert('Mouvement_compte', $donner);
   }
   public function updateCompte($requette = array(), $data)
   {
      return $this->db->where($requette)->update('Compte', $data);
   }

   public function test_if_clientpo($lienFb)
   {
      //$this->db->query("INSERT INTO test_insertion VALUES('".$lienFb."tetetet')");
      $requette = "SELECT * FROM clientpo WHERE lien_facebook like '" . $lienFb . "' ";
      $resultat = $this->db->query($requette);
      $existe = false;
      if ($resultat->num_rows() > 0) {
         $existe = true;
      }
      $test = $this->get_next_clientpo_Id();
      $json = array('existe' => $existe, 'test' => $test);
      return json_encode($json);
   }
   public function get_client($limit, $start)
   {
      $this->db->limit($limit, $start);
      //$this->db->like('Code_client','CLT-FB');
      return $this->db->get('client')->result();
   }
   public function get_client_crx($limit, $start)
   {
      $this->db->limit($limit, $start);
      //$this->db->like('Code_client','CLT-FB');
      return $this->db->get('client_curieux')->result();
   }
   public function infoclient($idclient)
   {
      $this->db->where('Code_client', $idclient);
      return $this->db->get('client')->row_object();
   }
   public function infoclientPo($idclient)
   {
      $this->db->where('Code_client', $idclient);
      return $this->db->get('clientpo')->row_object();
   }
   public function selectCompte($requette = array())
   {
      return $this->db->where($requette)->get('Compte')->row_object();
   }
   public function autocomplete_client($mot)
   {
      return $this->db->like('Compte_facebook', $mot)
         ->limit(10)
         ->get('clientpo')->result_object();
   }
   public function autocomplete_client_tache($mot)
   {
      return $this->db->like('Compte_facebook', $mot)
         ->limit(10)
         ->get('clientpo')->result_object();
   }
   public function get_client_prospect($limit, $start)
   {
      $this->db->limit($limit, $start);
      return $this->db->get('clientpo')->result();
   }
   public function nombre_client_prospect()
   {
      return $this->db->count_all_results('clientpo');
   }
   public function nombre_clientCRX()
   {
      $this->db->where('Code_client NOT LIKE "CLT-FB"');
      return $this->db->count_all_results('client_curieux');
   }
   public function insertCrX($nom, $Link_facebook, $Code_client, $Matricule, $Origin)
   {
      $data = [
         'Nom' => $nom,
         'Link_facebook' => $Link_facebook,
         'Code_client' => $Code_client,
         'Matricule' => $Matricule,
         'Date' => date('Y-m-d'),
         'Origin' => $Origin

      ];
      $this->db->insert('client_curieux', $data);
   }
   public function liste_client()
   {
      return $this->db->get('client')->result_object();
   }

   public function liste_client2()
   {
      return $this->db->query("select * from client");
   }
   public function listeClientCurieux()
   {
      return $this->db->query("select * from client");
   }
   public function IdCRX()
   {
      $this->db->select('Id');
      $this->db->limit(1);
      $this->db->order_by('Id', 'DESC');
      return $this->db->get('client_curieux')->row_object();
   }

   public function countFactureClient($idClient, $status)
   {
      $this->db->select('COUNT(*)');
      $this->db->where('Status', $status);
      $this->db->where('Code_client', $idClient);
      return $this->db->get('facture')->row_object();
   }
   public function dataAchat($parametre)
   {
      return $this->db->join('facture', 'detailvente.Facture=facture.Id')
         ->join('livraison', 'facture.Id_facture=livraison.Id_facture')
         ->join('prix', 'prix.Id=detailvente.Id_prix')
         ->where($parametre)->get('detailvente')->result_object();
   }
   public function bonDAchatSelect($requette=array()){
      return $this->db->where($requette)->get("bonDAchat")->row_object();
   }
   public function dateAchat($parametre)
   {
      return $this->db->distinct()->select('Date')->where($parametre)->get('facture')->result_object();
   }
   public function nombre_vente($parametre)
   {
      return $this->db->where($parametre)->count_all_results('facture');
   }

   public function NbdataAchat($parametre)
   {
      $data = $this->db->select('COALESCE(SUM(prix.Prix_detail*detailvente.Quantite),0) as "somme"')
         ->join('facture', 'detailvente.Facture=facture.Id')
         ->join('prix', 'prix.Id=detailvente.Id_prix')
         ->where($parametre)->get('detailvente')->row_object();
      return $data->somme;
   }
   public function produits($parametre)
   {
      return $this->db
         ->join('categorie', 'categorie.Id=produit.Categorie')
         ->where($parametre)->get('produit')->row_object();
   }
   public function rechercheClient($parametre)
   {
      return $this->db->where($parametre)->get('clientpo')->result_object();
   }
   public function page_fb($parametre){
      return  $this->db->where($parametre)
               ->select('comptefb.id,comptefb.Nom_page')        
               ->like('page_fb.statut',"on")
               ->join('comptefb', "page_fb.Lien_page = comptefb.Lien_page") 
               ->get('page_fb')->row_object();
     }
   public function rechercheClientAniv($parametre)
   {
      return $this->db->where($parametre)
      ->join('clientpo','discussion.client=clientpo.Code_client')
      ->order_by('discussion.id', 'ASC')
      ->group_by("discussion.client")
      ->get('discussion')->result_object();
   }
   public function selectMouvementKoty($requette = array())
   {
      return $this->db->where($requette)->get('Mouvement_compte')->row_object();
   }
   public function selectFactureClient($requette)
   {
      return $this->db->where($requette)->get('facture')->row_object();
   }
   public function vente_clientel($requette)
   {
      return $this->db->join('facture', 'detailvente.Facture=facture.Id')
         ->join('prix', 'detailvente.Id_prix=prix.Id')
         ->join('livraison', 'livraison.Id_facture=facture.Id_facture')
         ->where($requette)
         ->get('detailvente')->result_object();
   }

   public function facture_clientel($requette)
   {
      return $this->db->where($requette)->get('facture')->row_object();
   }
   public function updateClientpo($requette, $data)
   {
      return $this->db->where($requette)->update('clientpo', $data);
   }
   public function selectPageClient($requette)
   {
      return $this->db->where($requette)->get('comptefb')->row_object();
   }
   public function updatetombola($requette, $data){
      return $this->db->where($requette)->update('tombola', $data);
   }


   
}
