<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class detail_opl extends My_Controller {

    public function get_publica($user){
        $this->load->model('global_model');
        $datas=$this->global_model->detail_publication($user,date('Y-m-d'));
        $content="";
        if($datas){
          $data['message']=true;
       
        foreach($datas as $datas){
          $content.="<tr>";
            if($datas->Actions=="Publication") {
              $content.="<td>".$datas->Date."</td><td>".$datas->Heure."</td><td></td><td></td><td><span style='background-color:#FF0000;color:#fff;padding:5px 10px;border-radius:5px;'>".$datas->Actions."</td>";
            }else{
              $content.="<td>".$datas->Date."</td><td>".$datas->Heure."</td><td></td><td></td><td><span style='background-color:#339900;color:#fff;padding:5px 10px;border-radius:5px;'>".$datas->Actions."</td>";
            }
            $content.="</tr>"; 
        }
        
      }
      $data=[
             
        'data'=>$content
    
      ];
       
        $this->render_view('Controlleur/discussion/opldiscussion',$data);
      }

}
