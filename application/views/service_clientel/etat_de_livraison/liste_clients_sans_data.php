 
   
      <?php foreach($liste_vente_livre as $value){?>

        <tr>
          <td style="width:150px!important;word-break: break-all;"><?= $value->client ?></td>
         <?php
              $codecli=$value->client;
              $code = substr($value->client,0,3);
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
         
          <td style="width:150px!important;word-break: break-all;">
         
          </td>
          <td style="width:150px!important;word-break: break-all;"></td>
           <td></td>
         
          <td></td> 
          <td></td>
          <td style="width:150px!important;word-break: break-all;"><?= $value->Nom_page ?></td>
          <td><?= $value->operatrice ?></td>
           <td></td>
        </tr>
      <?php } ?>
  