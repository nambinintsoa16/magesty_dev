<?php
class Service_apres_vente_model extends CI_Model{
        public function __construct(){

        }
        public function getlivraisonannuler(){
            $query = $this->db->query("SELECT DISTINCT(livraison.date_de_livraison) FROM `facture`, livraison WHERE livraison.Id_facture like facture.Id_facture AND facture.Status like 'annule' ORDER BY livraison.date_de_livraison DESC");
            return $query->result();
            
        }

        public  function dateToFrench($date, $format) 
        {
            $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
            $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
            $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
            return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
        }


}