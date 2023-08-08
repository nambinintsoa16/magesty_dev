<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Export extends My_Controller {
    public function listlivraison(){
        $data['list']=$this->global_model->getexporte();
		$this->render_view('service_clientel/exporte/exportelistecom',$data);
	
    }
   
}
?>