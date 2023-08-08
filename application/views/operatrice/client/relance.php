<div class="container">

<div id="accordion">
RELANCE
  <div class="card">
    <div class="card-header" id="heading1">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
        <div class="col-md-12">AAC007</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d';echo  count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))); ?> &nbsp | &nbsp Traités: <?php echo $this->global_model->AAC07($this->session->userdata('matricule'));?> &nbsp |&nbsp  
        Non traités: <?php echo count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))) - $this->global_model->AAC07($this->session->userdata('matricule')) ?></b></span>
        <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xm">Support</button>-->
      </h5>

    </div>
    <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th> 
                                                     
                  </tr>
              </thead>
              <tbody class="tbody">
                <?php foreach ($listeclient7 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                    <td><?= $value->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'PROP_CLT_AAC07'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>'; } ?></td>
                    
                    </tr>
                <?php endforeach ?>
                   
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="heading28">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse28" aria-expanded="false" aria-controls="collapse28">
        <div class="col-md-12">AAC028</div>
        </button>
      <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; 
      echo count($this->global_model->client_a_traiterAAC28($this->session->userdata('page'))); ?>&nbsp | &nbsp Traités: <?php echo $this->global_model->ACC28($this->session->userdata('matricule'));?> &nbsp |
       &nbsp Non traités: <?php echo count($this->global_model->client_a_traiterAAC28($this->session->userdata('page'))) - $this->global_model->ACC28($this->session->userdata('matricule'));?></b></span>
      </h5>
    </div>
    <div id="collapse28" class="collapse" aria-labelledby="heading28" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient28 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                    <!--<td><?= $value->lien_facebook?></td>-->
                    <td><?= $value->Nom_page?></td>
                    <!--<td><?= $value->contacts?></td>-->
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="heading49">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse49" aria-expanded="false" aria-controls="collapse49">
        <div class="col-md-12">AAC049</div>
        </button>
      <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; 
      echo count($this->global_model->client_a_traiterAAC49($this->session->userdata('page'))); ?>&nbsp | &nbsp Traités: <?php echo $this->global_model->ACC49($this->session->userdata('matricule'));?> &nbsp |
       &nbsp Non traités: <?php echo count($this->global_model->client_a_traiterAAC49($this->session->userdata('page'))) - $this->global_model->ACC49($this->session->userdata('matricule'));?></b></span>
      </h5>
    </div>
    <div id="collapse49" class="collapse" aria-labelledby="heading49" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient49 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                    <!--<td><?= $value->lien_facebook?></td>-->
                    <td><?= $value->Nom_page?></td>
                    <!--<td><?= $value->contacts?></td>-->
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="heading70">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse70" aria-expanded="false" aria-controls="collapse70">
        <div class="col-md-12">AAC070</div>
        </button>
      <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; 
      echo count($this->global_model->client_a_traiterAAC70($this->session->userdata('page'))); ?>&nbsp | &nbsp Traités: <?php echo $this->global_model->ACC70($this->session->userdata('matricule'));?> &nbsp |
       &nbsp Non traités: <?php echo count($this->global_model->client_a_traiterAAC70($this->session->userdata('page'))) - $this->global_model->ACC70($this->session->userdata('matricule'));?></b></span>
      </h5>
    </div>
    <div id="collapse70" class="collapse" aria-labelledby="heading70" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient70 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                    <!--<td><?= $value->lien_facebook?></td>-->
                    <td><?= $value->Nom_page?></td>
                    <!--<td><?= $value->contacts?></td>-->
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC70'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingnCTL">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsenCTL" aria-expanded="false" aria-controls="collapsenCTL">
        <div class="col-md-12">CLT007</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: <?= count($this->global_model->clientctl007($this->session->userdata('page')));?></label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span> <!--<span class="col-md-2" >RJM: 0</span>-->
     </h5>
    </div>
    <div id="collapsenCTL" class="collapse" aria-labelledby="headingnCTL" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page</th> 
                    <th class="text-center">Status</th> 
                    <th></th>                
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($clientctl007 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testcheck(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    <td><a class="btn btn-primary discussion" href="#"> <i class="fa fa-envelope"></i></td>
                    </tr>
                    
                <?php endforeach ?> 
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>


<!--<div class="card">
    <div class="card-header" id="heading4">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
        <div class="col-md-12">SAC007</div>
        </button>      
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; 
          echo ($SAC007 -1)?> &nbsp | &nbsp Traités:<?php echo $this->global_model->SAC_07($this->session->userdata('matricule'));?> &nbsp | 
          &nbsp Non traités: <?php echo ($SAC007-1 - $this->global_model->SAC_07($this->session->userdata('matricule')));?></b></span>
        </h5>

    </div>
    <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">  
              <?php foreach ($listeclientsac07 as $value): if($value->FACTURE ==NULL): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->client?></a></td>
                    <td><a href="<?= $value->lien_facebook?>" target="_blank"> <?= $value->Compte_facebook?></a></td>
                   <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->client,'RELN_CLT_SAC07'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                  </tr>
                <?php endif; endforeach ?>             
                   
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>-->


  
  <div class="card">
    <div class="card-header" id="headingnlv">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsenlv" aria-expanded="false" aria-controls="collapsenlv">
        <div class="col-md-12">VENTES NON LIVREES</div>
        </button>
       <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; echo count($this->global_model->vente_non_livre($this->session->userdata('page'))) ?>
       &nbsp | &nbsp Traités: <?php echo $this->global_model->VENTENONLIVREE($this->session->userdata('matricule'));?> &nbsp | &nbsp Non traités:</b></span>
      </h5>
    </div>
    <div id="collapsenlv" class="collapse" aria-labelledby="headingnlv" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="collapse"></th>
                    <th class="text-center">Date de livraison</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($vente_non_livre as $value): ?>
                   <tr>
                    <td class="collapse"><?= $value->Code_client?></td>
                    <td><?= $value->date_de_livraison?></td>
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRTM_VTE_NNLIV'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    </tr>
                <?php endforeach ?>
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>
  <hr style="background-color: blue">
  <div class="card">
    <div class="card-header" id="headingRDV">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapseRDV" aria-expanded="false" aria-controls="collapseRDV">
        <div class="col-md-12">RENDEZ VOUS</div>
        </button>
       <span class="text-center"><label><b>Nombre de clients:<?php echo count($this->global_model->rendez_vous($this->session->userdata('matricule'),date('Y-m-d')));?> </label>&nbsp  
       &nbsp | &nbsp Traités:  &nbsp | &nbsp Non traités:</b></span>
      </h5>
    </div>
    <div id="collapseRDV" class="collapse" aria-labelledby="headingRDV" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
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

<hr style="background-color: blue">
PROSPECTION CLIENT
<div class="card">
    <div class="card-header" id="headingJME">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed JME" data-toggle="collapse" data-target="#collapseJME" aria-expanded="false" aria-controls="collapseJME">
        <div class="col-md-12">REACTION J'AIME PRODUIT</div>
        </button>
       <span class="text-center"><label><b>Nombre de clients:</label>&nbsp <?= count ($this->global_model->reactionjaime(date('Y-m-d'),$this->session->userdata('matricule')));?>
       &nbsp | &nbsp Traités:<?php echo $this->global_model->JAIME($this->session->userdata('matricule'));?> &nbsp | 
       &nbsp Non traités: <?= count ($this->global_model->reactionjaime(date('Y-m-d'),$this->session->userdata('matricule'))) - $this->global_model->JAIME($this->session->userdata('matricule'));?></b></span>
      </h5>
    </div>
    <div id="collapseJME" class="collapse" aria-labelledby="headingJME" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            
            
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>                    
                    <th class="text-center">Date</th>
                    <th class="text-center">Client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page</th>
                    <th class="text-center">Etat</th>                
                  </tr>
              </thead>
              <tbody class="tbody">
                <?php echo $jaimess?>
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>


  <div class="card">
    <div class="card-header" id="headingLF">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed LF" data-toggle="collapse" data-target="#collapseLF" aria-expanded="false" aria-controls="collapseLF">
        <div class="col-md-12"> REACTION J'AIME LIFE STYLE</div>
        </button>
       <span class="text-center"><label><b>Nombre de clients:</label>&nbsp <?= count ($this->global_model->lifestyle(date('Y-m-d'),$this->session->userdata('matricule')));?>
       &nbsp | &nbsp Traités:<?php echo $this->global_model->REA_CLT_STYLE($this->session->userdata('matricule'));?> &nbsp | 
       &nbsp Non traités: <?= count ($this->global_model->lifestyle(date('Y-m-d'),$this->session->userdata('matricule'))) - $this->global_model->JAIME($this->session->userdata('matricule'));?></b></span>
      </h5>
    </div>
    <div id="collapseLF" class="collapse" aria-labelledby="headingLF" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            
            
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>                    
                    <th class="text-center">Date</th>
                    <th class="text-center">Client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page</th>
                    <th class="text-center">Etat</th>                
                  </tr>
              </thead>
              <?= $lifes?> 
            </table>      
          </div>
      </div>
    </div>
  </div>

  <hr style="background-color: blue">
  LISTE PROVINCE
<div class="card">
    <div class="card-header" id="heading200">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed rdv" data-toggle="collapse" data-target="#collapse200" aria-expanded="false" aria-controls="collapse200">
        <div class="col-md-12">LISTE PROVINCE</div>
        </button>
       <span class="text-center"><label><b>Nombre de clients:</label>&nbsp <?php echo $prov1ce?> 
       &nbsp | &nbsp Traités: &nbsp | &nbsp Non traités:</b></span>
      </h5>
    </div>
    <div id="collapse200" class="collapse" aria-labelledby="heading200" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">                                    
                    <th class="text-center">Code client</th>
                    <th class="text-center">Client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Contact</th>
                    <th class="text-center">District</th>                
                  </tr>
              </thead>
              <tbody class="tbody">             
             <?= $province?>
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>
  </div>

  <hr style="background-color: blue">
  LISTE RELANCES TRC

  <div class="card">
    <div class="card-header" id="headingn014">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen014" aria-expanded="false" aria-controls="collapsen014">
        <div class="col-md-12">TRC014</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: <?php echo count($this->global_model->TRC014($this->session->userdata('page'),date('Y-m-d'))) + count($this->global_model->addtrc014($this->session->userdata('matricule'))) ;?></label>&nbsp   &nbsp | &nbsp Traités:<?php echo $this->global_model->coutn_trc014($this->session->userdata('matricule')); ?>    &nbsp |&nbsp  
        Non traités: <?php echo (count($this->global_model->TRC014($this->session->userdata('page'),date('Y-m-d'))) + count($this->global_model->addtrc014($this->session->userdata('matricule'))) ) - $this->global_model->coutn_trc014($this->session->userdata('matricule'));?></b></span><button class="btn btn-link collapsed supporttrc014">SUPPORT</button>
      
     </h5>
    </div>
    <div id="collapsen014" class="collapse" aria-labelledby="headingn014" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
             
              <?php foreach ($TRC014 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC014'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    </tr>
                <?php endforeach ?> 
               
                <?php foreach ($TRC014add as $result): ?>
                  <tr>
                    <td><a href="#" class="client0007"><?= $result->Code_client?></a></td>
                    <td><a href="<?= $result->lien_facebook?>" target="_blank"> <?= $result->Compte_facebook?></a></td>
                    <td><?= $result->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$result->Code_client,'TRM_CLT_TRC014'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn028">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen028" aria-expanded="false" aria-controls="collapsen028">
        <div class="col-md-12">TRC028</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: <?php echo count($this->global_model->TRC028($this->session->userdata('page'),date('Y-m-d'))) + count($this->global_model->addtrc028($this->session->userdata('matricule'))) ;?></label>&nbsp   &nbsp | &nbsp Traités:<?php echo $this->global_model->coutn_trc028($this->session->userdata('matricule')); ?>    &nbsp |&nbsp  
        Non traités: <?php echo (count($this->global_model->TRC028($this->session->userdata('page'),date('Y-m-d'))) + count($this->global_model->addtrc028($this->session->userdata('matricule'))) ) - $this->global_model->coutn_trc028($this->session->userdata('matricule'));?></b></span><button class="btn btn-link collapsed trc028">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen028" class="collapse" aria-labelledby="headingn028" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">
                
              <?php foreach ($TRC028 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC028'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    </tr>
                <?php endforeach ?>
                
                <?php foreach ($TRC028add as $result): ?>
                  <tr>
                    <td><a href="#" class="client0007"><?= $result->Code_client?></a></td>
                    <td><a href="<?= $result->lien_facebook?>" target="_blank"> <?= $result->Compte_facebook?></a></td>
                    <td><?= $result->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$result->Code_client,'TRM_CLT_TRC014'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                  </tr>
                
                <?php endforeach ?> 
            
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>

 <!-- <div class="card">
    <div class="card-header" id="headingn042">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen042" aria-expanded="false" aria-controls="collapsen042">
        <div class="col-md-12">TRC042</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: <?php echo count($this->global_model->TRC042($this->session->userdata('page'),date('Y-m-d'))) + count($this->global_model->addtrc042($this->session->userdata('matricule'))) ;?></label>&nbsp   &nbsp | &nbsp Traités:<?php echo $this->global_model->coutn_trc042($this->session->userdata('matricule')); ?>    &nbsp |&nbsp  
        Non traités: <?php echo (count($this->global_model->TRC042($this->session->userdata('page'),date('Y-m-d'))) + count($this->global_model->addtrc042($this->session->userdata('matricule'))) ) - $this->global_model->coutn_trc042($this->session->userdata('matricule'));?></b></span><button class="btn btn-link collapsed supporttrc042">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen042" class="collapse" aria-labelledby="headingn042" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC042 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                    
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    </tr>
                <?php endforeach ?>
                
                <?php foreach ($TRC042add as $result): ?>
                  <tr>
                    <td><a href="#" class="client0007"><?= $result->Code_client?></a></td>
                    <td><a href="<?= $result->lien_facebook?>" target="_blank"> <?= $result->Compte_facebook?></a></td>
                    <td><?= $result->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$result->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn056">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen056" aria-expanded="false" aria-controls="collapsen056">
        <div class="col-md-12">TRC056</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen056" class="collapse" aria-labelledby="headingn056" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                   
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC056 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                    
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn070">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen070" aria-expanded="false" aria-controls="collapsen070">
        <div class="col-md-12">TRC070</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen070" class="collapse" aria-labelledby="headingn070" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC070 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                  
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn084">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen084" aria-expanded="false" aria-controls="collapsen084">
        <div class="col-md-12">TRC084</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen084" class="collapse" aria-labelledby="headingn084" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC084 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn098">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen098" aria-expanded="false" aria-controls="collapsen098">
        <div class="col-md-12">TRC098</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen098" class="collapse" aria-labelledby="headingn098" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC098 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                    
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn112">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen112" aria-expanded="false" aria-controls="collapsen112">
        <div class="col-md-12">TRC112</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen112" class="collapse" aria-labelledby="headingn112" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                   
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC112 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn126">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen126" aria-expanded="false" aria-controls="collapsen126">
        <div class="col-md-12">TRC126</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen126" class="collapse" aria-labelledby="headingn126" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                   
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC126 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                    
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn140">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen140" aria-expanded="false" aria-controls="collapsen140">
        <div class="col-md-12">TRC140</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen140" class="collapse" aria-labelledby="headingn140" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC140 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn154">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen154" aria-expanded="false" aria-controls="collapsen154">
        <div class="col-md-12">TRC154</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen154" class="collapse" aria-labelledby="headingn154" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC154 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn168">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen168" aria-expanded="false" aria-controls="collapsen168">
        <div class="col-md-12">TRC168</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen168" class="collapse" aria-labelledby="headingn168" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC168 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn182">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen182" aria-expanded="false" aria-controls="collapsen182">
        <div class="col-md-12">TRC182</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen182" class="collapse" aria-labelledby="headingn182" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC182 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn196">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen196" aria-expanded="false" aria-controls="collapsen196">
        <div class="col-md-12">TRC196</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen196" class="collapse" aria-labelledby="headingn196" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC196 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn210">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen210" aria-expanded="false" aria-controls="collapsen210">
        <div class="col-md-12">TRC210</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen210" class="collapse" aria-labelledby="headingn210" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC210 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn224">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen224" aria-expanded="false" aria-controls="collapsen224">
        <div class="col-md-12">TRC224</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen224" class="collapse" aria-labelledby="headingn224" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC224 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn238">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen238" aria-expanded="false" aria-controls="collapsen238">
        <div class="col-md-12">TRC238</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen238" class="collapse" aria-labelledby="headingn238" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC238 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn252">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen252" aria-expanded="false" aria-controls="collapsen252">
        <div class="col-md-12">TRC252</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen252" class="collapse" aria-labelledby="headingn252" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC252 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn266">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen266" aria-expanded="false" aria-controls="collapsen266">
        <div class="col-md-12">TRC266</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen266" class="collapse" aria-labelledby="headingn266" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC266 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn280">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen280" aria-expanded="false" aria-controls="collapsen280">
        <div class="col-md-12">TRC280</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen280" class="collapse" aria-labelledby="headingn280" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC280 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn294">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen294" aria-expanded="false" aria-controls="collapsen294">
        <div class="col-md-12">TRC294</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen294" class="collapse" aria-labelledby="headingn294" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC294 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn322">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen322" aria-expanded="false" aria-controls="collapsen322">
        <div class="col-md-12">TRC322</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen322" class="collapse" aria-labelledby="headingn322" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC322 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn350">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen350" aria-expanded="false" aria-controls="collapsen350">
        <div class="col-md-12">TRC350</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen350" class="collapse" aria-labelledby="headingn350" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                   
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC350 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingn364">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen364" aria-expanded="false" aria-controls="collapsen364">
        <div class="col-md-12">TRC364</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: <?= count($this->global_model->TRC364($this->session->userdata('page'),date('Y-m-d')))?></label>&nbsp   &nbsp | &nbsp Traités:  &nbsp |&nbsp  
        Non traités: </b></span><button class="btn btn-link collapsed">SUPPORT</button>
     </h5>
    </div>
    <div id="collapsen364" class="collapse" aria-labelledby="headingn364" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($TRC364 as $value): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                   
                    <td><?= $value->Page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    </tr>
                <?php endforeach ?> 
              </tbody>
            </table>      
          </div>
      </div>-->
    </div>
  </div>

</div> 
</div>



