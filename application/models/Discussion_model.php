<?php
class Discussion_model extends CI_Model 
{
   public function getIdDiscussionSiExiste($client=null,$idPage=null,$operatrice=null){
      if(($client!=null)&&($idPage!=null)){
         $requette = "SELECT * FROM discussion WHERE client like '".$client."' and page like '".$idPage."' ORDER BY Id DESC ";
         $resultat = $this->db->query($requette);
         if($resultat->num_rows()>0){
            $row = $resultat->row();
            $id_discussion = $row->id_discussion;
            $req = "SELECT * FROM discussion_content where Id_discussion like '".$id_discussion."' and page like '".$idPage."' ORDER BY Id DESC ";
            $res = $this->db->query($req);
            if($res->num_rows()>0){
               $r = $res->row();
               if($r->Type == "termier"){
                  return 'null';
               }else{
                  return $row->id_discussion;
               }
            }
         }
         else{
            return 'null';
         }
      }
      else {
         return 'null';
      }
  }

   public function getDiscussionByCodeClient($codeClient)
   {
        return $this->db->query("SELECT * from discussion WHERE client = '".$codeClient."'") ;
   }
   public function getDiscussionContentByCodeClient()
   {       
   }
   public function tachesdata($parametre){
      return  $this->db->where($parametre)->get('taches')->row_object();
   }
   public function get_next_discussion_Id()
   {
      $requette = "SELECT id FROM discussion ORDER BY id DESC LIMIT 1";
      $id =$this->db->query($requette)->row()->id+1;
      if(isset($id)){
         return $id;
      }
   }
   public function generate_id_discussion($id=null){
      if(isset($id)){
         return 'DISC-'.$id.'-'.date('d-m-Y');
      }
      else{
         $id = $this->get_next_discussion_Id();
         return 'DISC-'.$id.'-'.date('d-m-Y');
      }
   }
    public function taches($parametre){
      return $this->db->where($parametre)->get('taches')->row_object();
   }
   public function Insert_discussion_content($parametre){
      return $this->db->insert("discussion_content",$parametre);

   }
   public function promotionSelect($requette){
      return $this->db->where($requette)->get('promotion')->result_object();
 }
 public function promotionSelects($requette){
    return $this->db->where($requette)->get('promotion')->row_object();
}
public function rechercheProduit($parametre){
   $this->db->join('prix','prix.Code_produit=produit.Code_produit');
   $this->db->join('categorie','categorie.Id=produit.Categorie');
   $this->db->where($parametre);
   return $this->db->get('produit')->row_object();
  }
public function insertRelanceDiscussion($param){
   return $this->db->insert('relanceDiscussion',$param);
   
}  

public function selectsRelanceDiscussion($param){
   return $this->db->where($param)->get('relanceDiscussion')->result_object();
   
}  

public function selectRelanceDiscussion($param){
   return $this->db->where($param)->get('relanceDiscussion')->row_object();
   
}  

public function deleteRelanceDiscussion($param){
   return $this->db->where($param)->delete('relanceDiscussion');
   
}  

public function UpdateRelanceDiscussion($param,$data){
   return $this->db->where($param)->update('relanceDiscussion',$data);
   
}  

public function selectPageFb($param){
   return $this->db->where('page_fb.statut',"on")
   ->like('page_fb.statut',"on")
   ->like('comptefb.id',"$param")
   ->join('comptefb', "page_fb.Lien_page = comptefb.Lien_page") 
   ->LIMIT(1)
   ->get('page_fb')->row_object();
   
}  



}
?>
