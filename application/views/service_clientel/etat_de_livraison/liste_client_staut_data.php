 
   
      <?php foreach($gainkotysmiles as $value){?>

        <tr>
          <td style="width:150px!important;word-break: break-all;"><?= $value->Code_client ?></td>
         <?php
              $codecli=$value->Code_client;
              $code = substr($value->Code_client,0,3);
             if($code == "CMT"){
                $table = "clientpo";
                $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                foreach($result as $values){
                   echo " <td style='width:150px!important;word-break: break-all;''>". $values->Compte_facebook ."</td>";
                   echo " <td style='width:150px!important;word-break: break-all;''>". $values->lien_facebook ."</td>";

                }
             }else{
                $table = "client_curieux";
                $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                foreach($result as $values){
                  echo " <td style='width:150px!important;word-break: break-all;''>". $values->Compte_facebook ."</td>";
                echo " <td style='width:150px!important;word-break: break-all;''>". $values->lien_facebook ."</td>";

                }

             }
           
           ?> </td> 
          <td><?= $value->koty?></td> 
          <td><?= $value->smiles?></td>
          
           <td>
            <?php
                echo  $this->load->calendrier_model->getclientstatutAnnuel($value->smiles) ." | ". $this->load->calendrier_model->getclientstatuttrimes($value->smiles);
            ?></td>
        </tr>
      <?php } ?>
  