
      
      <div class="card">
        <div class="card-body">
          
            <h2>LISTE CLIENTS SANS ACHATS</h2>         
            <form class="form-group" method="POST" action="Liste_clients_sans_achat">
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
      <div class="col-md-12">
            <div class="card p-3  mt-1"style="height: 650px; overflow: scroll;">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped dataTables">
                        <thead class="bg-danger text-light text-center">
                            <tr>
                                <th>Code client </th>
                                <th>Nom facebook</th>
                                <th>Adress Facebook</th>
                                <th>Page</th>
                                
                                <th>Operatrice </th>
                               
                            </tr>
                        </thead>
                        <tbody>

                           <?php if(count($liste_vente_livre) == 0): ?> 
                           <?php else :?> 
                           <?php foreach($liste_vente_livre as $value) :?>

              <tr>
                <td><?= $value->client ?></td>
               <?php
                    $codecli=$value->client;
                    $code = substr($value->client,0,3);
                   if($code == "CMT"){
                      $table = "clientpo";
                      $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                      foreach($result as $values){
                         echo " <td>". $values->Compte_facebook ."</td>";
                         echo " <td>". $values->lien_facebook ."</td>";

                      }
                   }else{
                      $table = "client_curieux";
                      $result = $this->load->calendrier_model->getclientinfolivre($codecli,$table);
                      foreach($result as $values){
                        echo " <td>". $values->Compte_facebook ."</td>";
                      echo " <td>". $values->lien_facebook ."</td>";

                      }

                   }
                 
                 ?> 
                <td><?= $value->Nom_page ?></td>
                <td><?= $value->operatrice ?></td>
                 <td></td>
              </tr>
      <?php endforeach; ?>
      <?php endif; ?>
                        <?php ?> 
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
      <!-- 

 
<div class="row ">

   <div class="col-md-12">
    <div class="table-responsive " style="background:#fff; padding: 10px 5px;">
       <table class="table  dataTable table-striped table-advance table-hover exportetoexcel" id="tableau" >
    <thead>
      <tr class="bg-primary">
          <th style="color:white;width:100px!important">Code client </th>
          <th style="color:white;width:100px!important">Nom facebook</th>
          <th style="color:white;width:100px!important">Adress Facebook</th>
          <th style="color:white;width:100px!important">Date et heure de dernier discussion </th>
         
          <th style="color:white;width:5%">Article </th>
          <th style="color:white;width:5%">Prix unitaire </th>
          <th style="color:white;width:5%">Quantité  </th>
          <th style="color:white;width:5%">Total </th>
          <th style="color:white;width:15%">Page d'achat </th>
          <th style="color:white;width:5%">Operatrice </th>
          <th style="color:white;width:5%">Statut </th>
         
    </tr>
    </thead>
    <tbody class="ventelivre">   

      </tbody>
  </table>           
      
    </div>
 
</div>

</div>
<div class="row" style="padding:10px 5px">
  <div class="col-md-12" style="padding:10px 5px;background:#fff">
    <button  class="btn btn-success pull-right" id="btnExport">Exporter vers excel</button> 
   

  </div>
</div>
-->