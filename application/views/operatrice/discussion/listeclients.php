<?php 
$json=array('error'=>true,'content'=>'');
$this->load->model('global_model'); 
$en_cours= $this->global_model->discussion_en_cours();
if($en_cours){
 foreach ($en_cours as $key => $en_cours){	    
 $json.='<div class="form-group"><span class="client_name collapse">'; 
      
     /* $reponse=$this->global_model->retourClient($en_cours->client); 
      if($reponse){
        $json.=$reponse->Nom;
     }*/
  $json.='</span><img class="img-thumbnail client_lat"  data-toggle="tooltip" title="<?=$nom?>" alt="<?=$nom?>" id="<?=$en_cours->id_discussion?>" src="<?=base_url("images/client/".$en_cours->client.".jpg")?>" style="border-radius:50%;width:50px;height:50px"></div>';

    }
}
echo json_encode($json);	

?>