
      <div class="card">
        <div class="card-body">
          
            <h2>CLIENTS AVEC ACHAT 2021</h2>         
            <form class="form-group" method="POST" action="Vente_annuel">
              <div class="row">
                <div class="col-md-5">
                  <label for="date_debut">Date Debut</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                    <input type="date" class="form-control" name="datedeb" placeholder="Date Debut" aria-label="Username" aria-describedby="basic-addon1">
                  </div>                                
                </div>
                <div class="col-md-5">
                  <label for="date_debut">Date Fin</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                    <input type="date" class="form-control" name="datefin" placeholder="Date Fin" aria-label="Username" aria-describedby="basic-addon1">
                  </div>  
                </div>
                <div class="col-md-2">
                  <br>
                  <button class="mt-1 btn btn-success">Valider</button>
                </div>
              </div>
            </form>
  
        </div>
      </div>
    <div class="row">
      <div class="wrapper"> 
  <div class="col-md-12">
            <div class="card">
               <div class="card-body">  
                <div class="table-responsive" style="height: 650px; overflow: scroll;">
                  <table class="table table-bordered dataTable table-hover table-striped dataTables">
                        <thead class="bg-danger text-light text-center">
                            <tr>
                                <th>Code client </th>
                                <th>Nom facebook</th>
                                <th>Adress Facebook</th>
                                <th>Date de dernière achat </th>
                                <th>District </th>
                                <th>Ville </th>
                                <th>Quartier </th>
                                <th>Lieu de livraison </th>
                                <th>Contact </th>
                                <th>Koty </th>
                                <th>Smiles </th>
                                <!--<th>Article </th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th> -->
                                <th>Page d'achat </th>
                                <th>Operatrice </th>
         
                            </tr>
                        </thead>
                        <tbody>
                           <?php if(count($ventelivreannuel) == 0) :?> 
                           <?php else:?> 
                           <?php foreach($ventelivreannuel as $value){?>

        <tr>
          <td><?= $value->Code_client ?></td>
         <?php
              $codecli=$value->Code_client;
              $code = substr($value->Code_client,0,3);
             if($code == "CMT"){
                $table = "clientpo";
                $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                foreach($result as $values){
                   echo " <td>". $values->Compte_facebook ."</td>";
                   echo " <td>". $values->lien_facebook ."</td>";

                }
             }elseif($code == "CLT"){
                $table = "client";
                $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                foreach($result as $values){
                  echo " <td>". $values->Compte_facebook ."</td>";
                echo " <td>". $values->lien_facebook ."</td>";
              }
            }elseif($code == "CRX"){
                   $table = "client_curieux";
                $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                foreach($result as $values){
                  echo " <td>". $values->Compte_facebook ."</td>";
                echo " <td>". $values->lien_facebook ."</td>";
              }
            }else{
                   echo " <td>Vide</td>";
                   echo " <td>Vide</td>";
                
            }
           ?> <!--</td>-->
           <?php
                $result = $this->load->calendrier_model->getlastdateachat($codecli);
                foreach($result as $val){?>
               <?php $dt = $val->Date;?>
               
            
          <td>
             <?= $dt ?>
          </td>
           <?php
            $resultat = $this->load->calendrier_model->getdetailventebyfact($val->Id_facture);
            foreach($resultat as $valut){?>

          
          <td><?= $valut->District?></td>
           <td><?=  $valut->Ville  ?></td>
            <td><?=  $valut->Quartier  ?></td>
         

        
           <td><?= $valut->lieu_de_livraison?>  </td>
          <td><?= $valut->contacts?></td> 
          <?php 
            $gain = $this->load->calendrier_model->getstatutclientannuel($codecli);
            foreach($gain as $gainval){?>
              <td><?= $gainval->koty?></td>
              <td><?= $gainval->smiles?></td>
             <?php } ?>
           <?php }
            ?> 
          <td><?= $valut->Nom_page?></td> 
          <td><?= $valut->Matricule_personnel?></td>

        
          
          
            <?php   }
                 ?>
        </tr>
      <?php } ?>
                           <?php endif; ?> 

                        </tbody>
                    </table>
                </div>
                <div class="row" style="padding:10px 5px">
                    <div class="col-md-12" style="padding:10px 5px;background:#fff">
                      <button  class="btn btn-success pull-right" id="btnExport">Exporter vers excel</button> 
                     

                    </div>
                </div>
          </div>
  </div>
</div>
</div>
</div>