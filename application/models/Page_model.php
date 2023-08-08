<?php
class Page_model extends CI_Model
{
   public function __construct()
   {
   }

   /*public function getAllPage(){
        $requette = 'select * from comptefb';
        return $this->db->query($requette);     
   }*/

   public function getAllPage()
   {
      $user = $this->session->userdata('matricule');
      $requette = "SELECT `comptefb`.`id`,`page_fb`.`Nom_page` FROM `comptefb` JOIN `page_fb` ON `page_fb`.`Lien_page`=`comptefb`.`Lien_page` WHERE `page_fb`.`operatrice` LIKE '$user' AND `page_fb`.`statut` like 'on' ";
      return $this->db->query($requette);
   }

   public function getById($idPage)
   {
      $page =  $this->db->get_where('comptefb', array('id' => $idPage), 1)->row();
      return json_encode(array('page' => $page));
   }

   public function getByNom($nom)
   {
      $page =  $this->db->get_where('comptefb', array('Nom_page' => $nom), 1)->row();
      return $page;
   }

   public function getObjectById($idPage)
   {
      $page =  $this->db->get_where('comptefb', array('id' => $idPage), 1)->row();
      return $page;
   }
}
