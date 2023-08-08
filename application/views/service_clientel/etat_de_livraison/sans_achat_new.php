
      <div class="card">
        <div class="card-body">
          
            <h2>CLIENTS SANS ACHATS NOUVEAU METHODE</h2>         
            <form class="form-group" method="POST" action="Clients_sans_achat">
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
  <div class="col-md-12">

            <div class="card p-3  mt-1" style="height: 650px; overflow: scroll;">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped dataTables">
                        <thead class="bg-danger text-light text-center">
                            <tr>
                              <th>Code client </th>
                              <th>Nom facebook</th>
                              <th>Adress Facebook</th>
                              <th>Date</th>
                              <th>H</th>
                              <th>Page d'achat </th>
                              <th>Operatrice </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php if(count($clientssansachat) == 0) :  ?> 
                           <?php else : ?> 
                           <?php foreach($clientssansachat as $value):?>

                    <tr>
                      <td><?= $value->client ?></td>
                     <?php
                          $codecli=$value->client;
                          $code = substr($value->client,0,3);
                         if($code == "CMT"){
                            $table = "clientpo";
                            $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                               echo " <td>". $result[0]->Compte_facebook ."</td>";
                               echo " <td>". $result[0]->lien_facebook ."</td>";

                         }else{
                            $table = "client_curieux";
                            $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                            /*foreach($result as $values){
                              echo " <td>". $values->Compte_facebook ."</td>";
                            echo " <td>". $values->lien_facebook ."</td>";

                            }*/

                         }
                       
                       ?> </td> 
                     
                      <td>
                       <?php 
                      $resultdate = $this->load->calendrier_model->getdatediscution($codecli,$table);
                      
                        echo $resultdate[0]->lastdiscdate;
                        ?>
                      </td>
                      <td>
                          <?php 
                        $id_discution= $value->idaction;
                        $result = $this->load->calendrier_model->getlasttimesdiscution($id_discution);
                          // $test =$result[0]->heure;
                        //echo $test;
                      ?>

                      </td>
                      <td><?= $value->Nom_page ?></td>
                      <td><?= $value->operatrice ?></td>
                       
                    </tr>
                  <?php endforeach; ?>
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
   
