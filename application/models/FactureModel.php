<?php 
    namespace App\Models;
    use CodeIgniter\Model;
    class Facture_modele extends Model
    {
        protected $table = 'facture';
        protected $primaryKey = 'id';
        protected $allowedFields = ['Date','Heure','id_facture','Code_client','Matricule_personnel', 
        'Matricule_accomp', 'id_de_la_mission' ,
        'Id_zone' , 'Type'    ];
}
    
?>
