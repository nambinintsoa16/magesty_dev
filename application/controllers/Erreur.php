<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class erreur extends My_Controller {  
    public function notfound(){
         $this->render_view('erreur/404.php');
        
    }
    
}
