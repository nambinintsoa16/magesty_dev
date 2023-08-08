<div class="card">
        <div class="card-body">
          
            <h2>STATUT CLIENTS ET GAIN KOTY ET SMAILS</h2>         
            <form class="form-group" method="POST" action="Gain_koty_smiles">
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

            <div class="card p-3  mt-1" style="height: 650px; overflow: scroll;">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped dataTables">
                        <thead class="bg-danger text-light text-center">
                            <tr>
                              <th>Code client </th>
                              <th>Nom facebook</th>
                              <th>Adress Facebook</th>
                              <th>Koty </th>
                              <th>Smiles </th>
                              <th>Statut </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php if(count($gainkotysmiles) == 0): ?> 
                           <?php else: ?> 
                              <?php foreach($gainkotysmiles as $value) : ?>

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
                            <?php endforeach; ?>
                           <?php ?> 
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
    <!--

      <div class="row" style="padding:10px 5px; ">
          <hr>
          <div class="card" style="background:#fff">
              <div class="col-md-12">
                 <h1 style="font-size:14px" class="text-left">STATUT CLIENTS ET GAIN KOTY ET SMAILS </h1>

              </div>
            
             <label class="col-md-2">Date debut</label>
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <input type="date" class="form-control datedeb" aria-label="...">
                </div>
              </div>
               <label class="col-md-2">Date Fin</label>
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <input type="date" class="form-control datefin" aria-label="...">
                </div>
              </div>
              <div class="col-md-2">
                <button class="btn btn-success valider" style="width: 100%;">Valider</button>
              </div>
          </div>
     
      </div> /.row 

 
<div class="row ">

   <div class="col-md-12">
    <div class="table-responsive " style="background:#fff; padding: 10px 5px;">
       <table class="table  dataTable table-striped table-advance table-hover exportetoexcel" id="tableau" >
    <thead>
      <tr class="bg-primary">
          <th style="color:white;width:100px!important">Code client </th>
          <th style="color:white;width:100px!important">Nom facebook</th>
          <th style="color:white;width:100px!important">Adress Facebook</th>
         
          <th style="color:white;width:15%">Koty </th>
          <th style="color:white;width:5%">Smiles </th>
           <th style="color:white;width:15%">Statut </th>
          
         
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