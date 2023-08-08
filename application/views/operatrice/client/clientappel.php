<div class="container">

<div id="accordion">
RELANCE
  <div class="card">
    <div class="card-header" id="heading1">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
        <div class="col-md-12">CLIENTS FIDELES</div>
        </button>
        <span class="text-center"><label>Nombre de clients: </label>&nbsp <b><? echo count($this->global_model->client_call_fidele($this->session->userdata('matricule'),date('Y-m-d')));?> </b></span>
      </h5>
    </div>
    <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive table-responsive dataTable nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>
                    <th></th>                 
                  </tr>
              </thead>
              <tbody class="tbody">
                <?php foreach ($clientfidele as $value): ?>
                   <tr>
                    
                    <td><a href="#" class=""><?= $value->code_client?></a></td>
                    <td><?= $value->nom_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->telephone?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testliste(date('Y-m-d'),$this->session->userdata('matricule'),$value->code_client); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    <td><i class="fa fa-phone" aria-hidden="true"></i></td>  
                  </tr>
                <?php endforeach ?>
                   
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>


<div class="card">
    <div class="card-header" id="heading2">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
        <div class="col-md-12">CLIENTS OCCASIONNELS</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <? echo count($this->global_model->client_call_occa($this->session->userdata('matricule'),date('Y-m-d')));?></b></span>
      </h5>
    </div>
    <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">
      <div class="card-body">
        <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive table-responsive dataTable nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">
                  
              <?php foreach ($clientoccasionel as $value): ?>
                   <tr>
                    
                    <td><a href="#" class=""><?= $value->code_client?></a></td>
                    <td><?= $value->nom_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->telephone?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testliste(date('Y-m-d'),$this->session->userdata('matricule'),$value->code_client); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    </tr>
                <?php endforeach ?>
                   
              </tbody>
            </table>      
          </div>
        </div>
      </div>
    </div>


    <div class="card">
    <div class="card-header" id="headingrdv">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapserdv" aria-expanded="false" aria-controls="collapserdv">
        <div class="col-md-12">RENDEZ VOUS</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> </b></span>
      </h5>
    </div>
    <div id="collapserdv" class="collapse" aria-labelledby="headingrdv" data-parent="#accordion">
      <div class="card-body">
        <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive table-responsive-sm dataTable nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">
              <?php foreach ($clientrdv as $value): ?>
                   <tr>
                    
                    <td><a href="#" class=""><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->contact?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testliste(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    </tr>
                <?php endforeach ?>    
              </tbody>
            </table>      
          </div>
        </div>
      </div>
    </div>

  </div> 
</div>

