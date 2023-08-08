 
   
      <?php foreach($ventelivreannuel as $value){?>

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
             }elseif($code == "CLT"){
                $table = "client";
                $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                foreach($result as $values){
                  echo " <td style='width:150px!important;word-break: break-all;''>". $values->Compte_facebook ."</td>";
                echo " <td style='width:150px!important;word-break: break-all;''>". $values->lien_facebook ."</td>";
              }
            }elseif($code == "CRX"){
                   $table = "client_curieux";
                $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                foreach($result as $values){
                  echo " <td style='width:150px!important;word-break: break-all;''>". $values->Compte_facebook ."</td>";
                echo " <td style='width:150px!important;word-break: break-all;''>". $values->lien_facebook ."</td>";
              }
            }else{
                   echo " <td style='width:150px!important;word-break: break-all;''>Vide</td>";
                   echo " <td style='width:150px!important;word-break: break-all;''>Vide</td>";
                
            }
           ?> </td>
           <?php
                $result = $this->load->calendrier_model->getlastdateachat($codecli);
                foreach($result as $val){?>
               <?php $dt = $val->Date;?>
               
            
          <td  rowspan="" style="width:150px!important;word-break: break-all;">
             <?= $dt ?>
          </td>
           <?php
            $resultat = $this->load->calendrier_model->getdetailventebyfact($val->Id_facture);
            foreach($resultat as $valut){?>

          
          <td rowspan="" style="width:150px!important;word-break: break-all;"><?= $valut->District?></td>
           <td rowspan="" style="width:150px!important;word-break: break-all;"><?=  $valut->Ville  ?></td>
            <td rowspan="" style="width:150px!important;word-break: break-all;"><?=  $valut->Quartier  ?></td>
         

        
           <td rowspan=""><?= $valut->lieu_de_livraison?>  </td>
          <td rowspan=""><?= $valut->contacts?></td> 
          <?php 
            $gain = $this->load->calendrier_model->getstatutclientannuel($codecli);
            foreach($gain as $gainval){?>
              <td rowspan=""><?= $gainval->koty?></td>
              <td rowspan=""><?= $gainval->smiles?></td>
             <?php } ?>
          <td rowspan=""></td>
           <?php }
            ?> 
         <td></td>
           <td></td>
            <td></td>
           <td style="width:150px!important;word-break: break-all;"></td>
          <td rowspan=""><?= $valut->Nom_page?></td> 
          <td rowspan=""><?= $valut->Matricule_personnel?></td>

        
          
          
            <?php   }
                 ?>
        </tr>
      <?php } ?>
  