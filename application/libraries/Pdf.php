<?php 
error_reporting(1);
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once 'dompdf/autoload.inc.php';

// Référencez l'espace de noms Dompdf 
use  Dompdf \ Dompdf ; 

// Instancie et utilise la classe dompdf 
$dompdf  = new  Dompdf ();

class Pdf extends Dompdf
{
    public function __construct()
    {
         parent::__construct();
    } 
}

?>