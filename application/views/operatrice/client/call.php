<div class="container">

<div id="accordion">
RELANCE
  <div class="card">
    <div class="card-header" id="heading1">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
        <div class="col-md-12">AAC7</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d';echo  count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))); ?> &nbsp | &nbsp Traités: <?php echo $this->global_model->AAC07($this->session->userdata('matricule'));?> &nbsp |&nbsp  
        Non traités: <?php echo count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))) - $this->global_model->AAC07($this->session->userdata('matricule')) ?></b></span>
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
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">
                <?php foreach ($listeclient7 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <!--<td><?= $value->contacts?></td>-->
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
    <div class="card-header" id="heading2">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
        <div class="col-md-12">AAC14</div>
        </button>
       <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; 
     echo count($this->global_model->client_a_traiterAAC14($this->session->userdata('page'))); ?> &nbsp | &nbsp Traités: <?php echo ($this->global_model->AAC14($this->session->userdata('matricule'))); ?>&nbsp | &nbsp 
     Non traités: <?php  echo (count($this->global_model->client_a_traiterAAC14($this->session->userdata('page'))) - ($this->global_model->AAC14($this->session->userdata('matricule')))); ?></b></span>
      </h5>
    </div>
    <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">
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
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">
                  
              <?php foreach ($listeclient14 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <!--<td><?= $value->contacts?></td>-->
                    <td class="text-center"></i><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'PROP_CLT_AAC14'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="heading4">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
        <div class="col-md-12">SAC07</div>
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
                    <!--<th class="text-center">Contact</th>-->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">  
              <?php foreach ($listeclientsac07 as $value): if($value->FACTURE ==NULL): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <!--<td><?= $value->contacts?></td>-->
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->client,'RELN_CLT_SAC07'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                  </tr>
                <?php endif; endforeach ?>             
                   
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
        <div class="col-md-12">SAC07</div>
        </button>      
      <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; 
      if($this->session->userdata('matricule')==="VB21539"){echo count($this->global_model->clientsaa7(29));}
      elseif($this->session->userdata('matricule')==="VB21552"){echo count($this->global_model->clientsaa7(91));}
      elseif($this->session->userdata('matricule')==="VB21553"){echo count($this->global_model->clientsaa7(95));}
      elseif($this->session->userdata('matricule')==="VB21525"){echo count($this->global_model->clientsaa7(3));}
      elseif($this->session->userdata('matricule')==="VB21166"){echo count($this->global_model->clientsaa7(96));}
      elseif($this->session->userdata('matricule')==="VB21566"){echo count($this->global_model->clientsaa7(103));}
      elseif($this->session->userdata('matricule')==="VB21319"){echo count($this->global_model->clientsaa7(45));}
      else{echo count($this->global_model->clientsaa7($this->session->userdata('page')));} ?></b></span>
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">  
              <?php foreach ($listeclientsac07 as $value): if($value->FACTURE ==NULL && $value->AVANT_DERNIER_DISK==NULL): ?>
                   <tr>                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testliste(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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
    <div class="card-header" id="headingsac42">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsesac42" aria-expanded="false" aria-controls="collapsesac42">
        <div class="col-md-12">SAC042</div>
        </button>
       <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; echo ($sac42 - 1) ?>&nbsp | &nbsp Traités: <?php echo $this->global_model->SAC42($this->session->userdata('matricule'));?>&nbsp | 
       &nbsp Non traités: <?php echo ($sac42 - 1 - $this->global_model->SAC42($this->session->userdata('matricule')));?></b></span>
      </h5>
    </div>
    <div id="collapsesac42" class="collapse" aria-labelledby="headingsac42" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                  <th class="text-center">N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">  
              <?=$content?>
                   
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
        <div class="col-md-12">AAC49</div>
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
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient49 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
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
    <div class="card-header" id="heading105">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse105" aria-expanded="false" aria-controls="collapse105">
        <div class="col-md-12">AAC105</div>
        </button>
      <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; 
      if($this->session->userdata('matricule')==="VB21525"){echo count($this->global_model->client_a_traiterAAC105(3));}
      elseif($this->session->userdata('matricule')==="VB21552"){echo count($this->global_model->client_a_traiterAAC105(91));} 
      elseif($this->session->userdata('matricule')==="VB21553"){echo count($this->global_model->client_a_traiterAAC105(95));}
      elseif($this->session->userdata('matricule')==="VB21566"){echo count($this->global_model->client_a_traiterAAC105(103));}
      else{echo count($this->global_model->client_a_traiterAAC105(444));} ?> &nbsp | &nbsp Traités: &nbsp | &nbsp Non traités:</b></span>
      </h5>
    </div>
    <div id="collapse105" class="collapse" aria-labelledby="heading105" data-parent="#accordion">
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
                    <!--<th class="text-center">Contact</th>--> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient105 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <!--<td><?= $value->contacts?></td>-->
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


<div class="card">
    <div class="card-header" id="headingcat">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsecat" aria-expanded="false" aria-controls="collapsecat">
        <div class="col-md-12">SAC CATALOGUE</div>
        </button>
        <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; 
        echo ($countcatalogue ); ?>&nbsp | &nbsp Traités: <?php echo $this->global_model->CATALOGUE($this->session->userdata('matricule'));?> &nbsp | 
        &nbsp Non traités: <?php echo $countcatalogue - $this->global_model->CATALOGUE($this->session->userdata('matricule')) ?></b></span>
      </h5>
    </div>
    <div id="collapsecat" class="collapse" aria-labelledby="headingcat" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                  <th class="text-center">N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
                                      
                   <?= $contentcatal?>
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>


  <div class="card">
    <div class="card-header" id="headingnlv">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsenlv" aria-expanded="false" aria-controls="collapsenlv">
        <div class="col-md-12">VENTES NON LIVREES</div>
        </button>
       <span class="text-center"><label><b>Nombre de clients: </label>&nbsp  <?php  $date = 'Y-m-d'; echo count($this->global_model->vente_non_livre($this->session->userdata('matricule'))) ?>
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
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($vente_non_livre as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <!--<td><?= $value->contacts?></td>-->
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
                    <!--<th class="text-center">Contact</th> -->
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($clientrdv as $value): ?>
                   <tr>                    
                    <td><a href="#" class=""><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <!--<td><?= $value->contact?></td>-->
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

<!--PROMOTION
<hr>
<div class="card">
    <div class="card-header" id="heading11">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
        <div class="col-md-12">LISTE CLIENT POUR LA  PROMOTIONS EN COURS</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $datet = '2021-09-20'; echo $this->global_model->liste_prommotionTotal($datet,$this->session->userdata('matricule')); ?></b></span>
      </h5>
    </div>
    <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>                    
                    <th class="text-center">Date</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Client</th>
                    <th class="text-center">Nombre d'achat</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page</th>
                    <th class="text-center">Status</th>                
                  </tr>
              </thead>
              <tbody class="tbody">
                <?php foreach ($listeclient as $value): ?>
                   <tr>
                   <td class="collapse"><?= $value->Code_client?></td>
                    <td></td>
                    <td><?= $value->Date_promotion?></td>
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                     <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->nombre_achat?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistepromo($datet,$this->session->userdata('matricule'),$value->Code_client); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
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

HAUSSE DE PRIX

<div class="card">
    <div class="card-header" id="heading5">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
        <div class="col-md-12">AAC21</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC21($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody">               
              <?php foreach ($listeclient21 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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


<div class="card">
    <div class="card-header" id="heading7">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
        <div class="col-md-12">AAC28</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC28($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient28 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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


<div class="card">
    <div class="card-header" id="heading6">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
        <div class="col-md-12">AAC42</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC42($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient42 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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





<div class="card">
    <div class="card-header" id="heading8">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
        <div class="col-md-12">AAC56</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC56($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient56 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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



<div class="card">
    <div class="card-header" id="heading9">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
        <div class="col-md-12">AAC63</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC63($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient63 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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


<div class="card">
    <div class="card-header" id="headingA">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapseA" aria-expanded="false" aria-controls="collapseA">
        <div class="col-md-12">AAC70</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC70($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapseA" class="collapse" aria-labelledby="headingA" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient70 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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


<div class="card">
    <div class="card-header" id="headingB">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapseB" aria-expanded="false" aria-controls="collapseB">
        <div class="col-md-12">AAC77</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC77($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapseB" class="collapse" aria-labelledby="headingB" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient77 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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



<div class="card">
    <div class="card-header" id="heading84">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse84" aria-expanded="false" aria-controls="collapse84">
        <div class="col-md-12">AAC84</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC84($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapse84" class="collapse" aria-labelledby="heading84" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient84 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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


<div class="card">
    <div class="card-header" id="heading91">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse91" aria-expanded="false" aria-controls="collapse91">
        <div class="col-md-12">AAC91</div>
        </button>
       <span class="text-center"><label>Nombre de clients: </label>&nbsp <b> <?php  $date = 'Y-m-d'; echo count($this->global_model->client_a_traiterAAC91($date,$this->session->userdata('matricule'))); ?></b></span>
      </h5>
    </div>
    <div id="collapse91" class="collapse" aria-labelledby="heading91" data-parent="#accordion">
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
                    <th class="text-center">Contact</th> 
                    <th class="text-center">Status</th>                 
                  </tr>
              </thead>
              <tbody class="tbody"> 
              <?php foreach ($listeclient91 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td><?= $value->contacts?></td>
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

  <hr style="background-color: blue">-->
PROSPECTION CLIENT
<div class="card">
    <div class="card-header" id="headingJME">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed JME" data-toggle="collapse" data-target="#collapseJME" aria-expanded="false" aria-controls="collapseJME">
        <div class="col-md-12">REACTION J'AIME</div>
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
              <!--<?php foreach ($listejaimes as $value): ?>
                   <tr>                    
                    <td><?= $value->date_publi?></td>
                    <td><?= $value->Compte_facebook?></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->lien_facebook,'REA_CLT_JAIME'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    </tr>
                <?php endforeach ?> -->

                <?php echo $jaimess?>
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>
  </div>

<!--<hr style="background-color: blue">
RENDEZ VOUS
<div class="card">
    <div class="card-header" id="heading200">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed rdv" data-toggle="collapse" data-target="#collapse200" aria-expanded="false" aria-controls="collapse200">
        <div class="col-md-12">RDV</div>
        </button>
       <span class="text-center"><label>Nombre de clients:</label>&nbsp <b></b></span>
      </h5>
    </div>
    <div id="collapse200" class="collapse" aria-labelledby="heading200" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
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
             
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>-->

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
                    <!--<th class="text-center">Contact</th>-->
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
</div>

