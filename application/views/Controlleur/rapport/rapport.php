<div class="container">
   <div class="row">

      <table class="table table-light dataTable table-hover table_resume">
            <thead class="thead-light">
                <tr>
                    <th>OPLG</th>
                    <th>DATE</th>
                    <th>HEURE</th>
                    <th>CODE DU GROUPE</th>
                    <th>CODE DISC</th>
                    <th>CODE REP OPL</th>
                    <th>TYPE INTERVENTION</th>
                    <th>STATUT</th>
                   
                </tr>
            </thead>
            <tbody class="tbody">
                 <?=$data?>
            </tbody>
        </table> 
   </div>    
</div>




Global model
public function table_resume($date){
  /* SELECT `id`, `id_discussion`, `operatrice`, `client`, `statut` FROM `discussion` WHERE 1
  SELECT `Id`, `Message`, `Type`, `sender`, `Id_discussion`, `Id_reponse`, `heure` FROM `discussion_content` WHERE 1*/
 
  $this->db->or_like('discussion_content.heure',$date,'after');
  $this->db->join('discussion','discussion.id_discussion=discussion_content.Id_discussion');
  
  return $this->db->get('discussion_content')->result_object();

}



acceuil 2
else if($this->session->userdata('designation')=="Controlleur"){
		
        $content="";
        $datas=$this->global_model->table_resume(date('Y-m-d'));
        foreach ($datas as $key => $datas) {
            $dateTemp=explode(" ",$datas->heure);
  
          $content.="<tr><td>".$datas->operatrice."</td><td>". $dateTemp[0]."</td><td>".$dateTemp[1]."</td> <td>".$datas->client."</td><td>".$datas->Id_discussion."</td><td>".$datas->Id_reponse."</td><td>".strtoupper($datas->Type)."</td> <td>".$datas->statut."</td> <td></td> </tr>";
         }
         $data=['data'=>$content];
   
      }
  
          $this->render_view('global/'.$this->session->userdata("designation").'/accueil',$data);
      }