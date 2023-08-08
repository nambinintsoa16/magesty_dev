 
   
      <?php foreach($liste_vente_livre as $value){?>

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
         
          <td style="width:150px!important;word-break: break-all;"><?= $value->date_de_commande ." à ". $value->heure ?></td>
          <td style="width:150px!important;word-break: break-all;"><?= $value->date_de_livraison ?></td>
          <td><?= $value->District ." ".$value->Ville. " ". $value->Quartier ?></td>
          <td><?= $value->contacts ?></td>
           <td><?= $value->Code_produit ?></td>
           <td><?= $value->Prix_detail ?></td>
          <td><?= $value->Quantite ?></td> 
          <td><?= $value->Total ?></td>
          <td style="width:150px!important;word-break: break-all;"><?= $value->Nom_page ?></td>
          <td><?= $value->Matricule_personnel ?></td>
           <td><?= $value->Status ?></td>
        </tr>
      <?php } ?>
  