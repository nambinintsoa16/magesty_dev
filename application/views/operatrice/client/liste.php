<div class="container">
    <div id="accordion">
    <div class="card">
        <div class="card-header" id="headingn">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen" aria-expanded="false" aria-controls="collapsen">
                <div class="col-md-12">TRC042</div>
                </button>
                <span class="text-center"><label><b>Nombre de clients: <?php echo count($this->global_model->listeTRC042(date('Y-m-d'))) + count($this->global_model->addtrc042($this->session->userdata('matricule'))) ;?></label>&nbsp   &nbsp | &nbsp Traités:<?php echo $this->global_model->coutn_trc042($this->session->userdata('matricule')); ?>    &nbsp |&nbsp  
                Non traités: <?php echo (count($this->global_model->listeTRC042(date('Y-m-d'))) + count($this->global_model->addtrc042($this->session->userdata('matricule'))) ) - $this->global_model->coutn_trc042($this->session->userdata('matricule'));?></b></span><button class="btn btn-link collapsed supporttrc042">SUPPORT</button>
            </h5>
            </div>
            <div id="collapsen" class="collapse" aria-labelledby="headingn" data-parent="#accordion">
              <div class="card-body">
                <div class="form-group contentTable table-striped ">
                  <!--Accordion wrapper-->
                    <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingOne1">
                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                          aria-controls="collapseOne1">
                          <h5 class="mb-0">
                          VIVITE SNAIL WHITE JII <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseOne1" class="collapse " role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                          <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                              <thead>
                                <tr class="bg-secondary text-white">
                                  <th class="text-center">Code client</th>
                                  <th class="text-center">Nom client</th>
                                  <!--<th class="text-center">Lien</th>-->
                                  <th class="text-center">Page / Compte</th> 
                                  <th class="text-center">Status</th>                 
                                </tr>
                            </thead>
                            <tbody class="tbody"> 
                            <?php foreach ($GNPFPJI as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                                <!--<td><?= $value->lien?></td>-->
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?>

                            <?php foreach ($addGNPFPJI as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                                <!--<td><?= $value->lien?></td>-->
                                <td><?= strtoupper($value->Nom_page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                          </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingTwo2">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                          aria-expanded="false" aria-controls="collapseTwo2">
                          <h5 class="mb-0">
                          GEL NETTOYANT POUR FEMME JI <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                          <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
                              <thead>
                                <tr class="bg-secondary text-white">
                                  <th class="text-center">Code client</th>
                                  <th class="text-center">Nom client</th>
                                  <!--<th class="text-center">Lien</th>-->
                                  <th class="text-center">Page / Compte</th> 
                                  <th class="text-center">Status</th>                 
                                </tr>
                            </thead>
                            <tbody class="tbody"> 
                            <?php foreach ($GNPFJI as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                                <!--<td><?= $value->lien?></td>-->
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                          </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingThree3">
                        <a class="collapsed promo3" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                          aria-expanded="false" aria-controls="collapseThree3">
                          <h5 class="mb-0">
                          GEL NETTOYANT PINK JII FOR LADY <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <table class="table table-striped table-hover table3 table-bordered dt-responsive nowrap">
                            <thead>
                              <tr class="bg-secondary text-white">
                                <th class="text-center">Code client</th>
                                <th class="text-center">Nom client</th>
                                <th class="text-center">Page / Compte</th> 
                                <th class="text-center">Status</th> 
                                <th class="text-center"></th>                
                              </tr>
                          </thead>
                          <tbody class="tbody"> 
                         
                          </tbody>
                        </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->
                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingFor4">
                        <a class="promo4" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFor4" aria-expanded="true"
                          aria-controls="collapseFor4">
                          <h5 class="mb-0">
                          PASSION LESS SHAVE JIA <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseFor4" class="collapse " role="tabpanel" aria-labelledby="headingFor4"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                          <table class="table table-striped table-hover table_passionlessjia table-bordered dt-responsive nowrap">
                              <thead>
                                <tr class="bg-secondary text-white">
                                  <th class="text-center">Code client</th>
                                  <th class="text-center">Nom client</th>
                                  <!--<th class="text-center">Lien</th>-->
                                  <th class="text-center">Page / Compte</th> 
                                  <th class="text-center">Status</th> 
                                  <th class="text-center"></th>                
                                </tr>
                            </thead>
                            <tbody class="tbody"> 
                            <tbody class="tbody"> 
                            <!--<?php foreach ($passionlessjia as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                                <td><?= $value->lien?></td>
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?>-->
                            </tbody>
                          </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingFive5">
                        <a class="collapsed promo5" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive5"
                          aria-expanded="false" aria-controls="collapseFive5">
                          <h5 class="mb-0">
                          VIVITE CRYSTAL WHITE JI <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseFive5" class="collapse" role="tabpanel" aria-labelledby="headingFive5"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                          <table class="table table-striped table-hover table_vivitecwji table-bordered dt-responsive nowrap">
                              <thead>
                                <tr class="bg-secondary text-white">
                                  <th class="text-center">Code client</th>
                                  <th class="text-center">Nom client</th>
                                  <!--<th class="text-center">Lien</th>-->
                                  <th class="text-center">Page / Compte</th> 
                                  <th class="text-center">Status</th> 
                                  <th class="text-center"></th>                
                                </tr>
                            </thead>
                            <tbody class="tbody"> 
                           <!-- <?php foreach ($vivitecwji as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                                <td><?= $value->lien?></td>
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?> --> 
                            </tbody>
                          </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingSix6">
                        <a class="collapsed promo6" data-toggle="collapse" data-parent="#accordionEx" href="#collapseSix6"
                          aria-expanded="false" aria-controls="collapseSix6">
                          <h5 class="mb-0">
                          VIVITE CRYSTAL WHITE JII <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseSix6" class="collapse" role="tabpanel" aria-labelledby="headingSix6"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <table class="table table-striped table-hover table_vivitecwjii table-bordered dt-responsive nowrap">
                            <thead>
                              <tr class="bg-secondary text-white">
                                <th class="text-center">Code client</th>
                                <th class="text-center">Nom client</th>
                                <!--<th class="text-center">Lien</th>-->
                                <th class="text-center">Page / Compte</th> 
                                <th class="text-center">Status</th> 
                                <th class="text-center"></th>                
                              </tr>
                          </thead>
                          <tbody class="tbody"> 
                          <!--<?php foreach ($vivitecwjii as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?>-->
                          </tbody>
                        </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingSeven7">
                        <a class=promo7 data-toggle="collapse" data-parent="#accordionEx" href="#collapseSeven7" aria-expanded="true"
                          aria-controls="collapseSeven7">
                          <h5 class="mb-0">
                          VIVITE CLEAR & CONFIDENT JII <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseSeven7" class="collapse " role="tabpanel" aria-labelledby="headingSeven7"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                          <table class="table table-striped table-hover table_VIVTECCJII table-bordered dt-responsive nowrap">
                              <thead>
                                <tr class="bg-secondary text-white">
                                  <th class="text-center">Code client</th>
                                  <th class="text-center">Nom client</th>
                                  <!--<th class="text-center">Lien</th>-->
                                  <th class="text-center">Page / Compte</th> 
                                  <th class="text-center">Status</th>  
                                  <th class="text-center"></th>               
                                </tr>
                            </thead>
                            <tbody class="tbody"> 
                           <!-- <?php foreach ($VIVTECCJII as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                                <td><?= $value->lien?></td>
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?>-->                             
                            </tbody>
                          </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingEight8">
                        <a class="collapsed promo8" data-toggle="collapse" data-parent="#accordionEx" href="#collapseEight8"
                          aria-expanded="false" aria-controls="collapseEight8">
                          <h5 class="mb-0">
                          VIVITE CLEAR AND CONFIDENT JIA <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseEight8" class="collapse" role="tabpanel" aria-labelledby="headingEight8"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                          <table class="table table-striped table-hover tablejia table-bordered dt-responsive nowrap">
                              <thead>
                                <tr class="bg-secondary text-white">
                                  <th class="text-center">Code client</th>
                                  <th class="text-center">Nom client</th>
                                  <!--<th class="text-center">Lien</th>-->
                                  <th class="text-center">Page / Compte</th> 
                                  <th class="text-center">Status</th>
                                  <th class="text-center"></th>                 
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            <!--<?php foreach ($VCONFJIA as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?> -->
                             
                            </tbody>
                          </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">

                      <!-- Card header -->
                      <div class="card-header" role="tab" id="headingNine9">
                        <a class="collapsed promo9" data-toggle="collapse" data-parent="#accordionEx" href="#collapseNine9"
                          aria-expanded="false" aria-controls="collapseNine9">
                          <h5 class="mb-0">
                          ZA SY NY VOLOKO <i class="fas fa-angle-down rotate-icon"></i>
                          </h5>
                        </a>
                      </div>

                      <!-- Card body -->
                      <div id="collapseNine9" class="collapse" role="tabpanel" aria-labelledby="headingNine9"
                        data-parent="#accordionEx">
                        <div class="card-body">
                        <span class="date_collapse collapse"> <?php echo $date; ?></span>
                        <table class="table table-striped table-hover table_zasynyvoloko table-bordered dt-responsive nowrap">
                            <thead>
                              <tr class="bg-secondary text-white">
                                <th class="text-center">Code client</th>
                                <th class="text-center">Nom client</th>
                                <th class="text-center">Page / Compte</th> 
                                <th class="text-center">Status</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>                   
                              </tr>
                          </thead>
                          <tbody class="tbody"> 
                          <!--<?php foreach ($zasynyvoloko as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?>

                            <?php foreach ($addzasynyvoloko as $value): ?>
                            <tr>                    
                                <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                                <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                                <td><?= strtoupper($value->Nom_page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                            <?php endforeach ?>-->
                          </tbody>
                        </table>  
                        </div>
                      </div>

                    </div>
                    <!-- Accordion card -->

                    </div>
                    <!-- Accordion wrapper -->                    
                    
                </div>
              </div>
            </div>
      </div> 
        <!--<div class="card">
            <div class="card-header" id="headingn042">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapsen042" aria-expanded="false" aria-controls="collapsen042">
                <div class="col-md-12">TRC042</div>
                </button>
                <span class="text-center"><label><b>Nombre de clients: <?php echo count($this->global_model->listeTRC042(date('Y-m-d'))) + count($this->global_model->addtrc042($this->session->userdata('matricule'))) ;?></label>&nbsp   &nbsp | &nbsp Traités:<?php echo $this->global_model->coutn_trc042($this->session->userdata('matricule')); ?>    &nbsp |&nbsp  
                Non traités: <?php echo (count($this->global_model->listeTRC042(date('Y-m-d'))) + count($this->global_model->addtrc042($this->session->userdata('matricule'))) ) - $this->global_model->coutn_trc042($this->session->userdata('matricule'));?></b></span><button class="btn btn-link collapsed supporttrc042">SUPPORT</button>
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
                                <td><?= strtoupper($value->Page)?></td>
                                <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'TRM_CLT_TRC042'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                                echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                                </tr>
                          <?php endforeach ?>
                            
                        </tbody>
                        </table>      
                    </div>
                </div>
            </div>
        </div>-->
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
                        <!--<th class="text-center">Lien</th>-->
                        <th class="text-center">Page / Compte</th> 
                        <th class="text-center">Status</th>                 
                      </tr>
                  </thead>
                  <tbody class="tbody"> 
                  <?php foreach ($TRC056 as $value): ?>
                      <tr>                    
                        <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                        <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                        <!--<td><?= $value->lien?></td>-->
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
                        <!--<th class="text-center">Lien</th>-->
                        <th class="text-center">Page / Compte</th> 
                        <th class="text-center">Status</th>                 
                      </tr>
                  </thead>
                  <tbody class="tbody"> 
                  <?php foreach ($TRC070 as $value): ?>
                      <tr>                    
                        <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                        <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                        <!--<td><?= $value->lien?></td>-->
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

                <table class="table table-striped table-hover table_mois table-bordered dt-responsive nowrap">
                    <thead>
                      <tr class="bg-secondary text-white">
                        <th class="text-center">Code client</th>
                        <th class="text-center">Nom client</th>
                        <th class="text-center">Page / Compte</th> 
                        <th class="text-center">Status</th>                 
                      </tr>
                  </thead>
                  <tbody class="tbody"> 
                  <!--<?php foreach ($TRC084 as $value): ?>
                      <tr>                    
                        <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                        <td><a href="<?= $value->lien?>" target="_blank">  <?= $value->Compte?></a></td>
                        
                        <td><?= $value->Page?></td>
                        <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'REAP_CLT_AAC49'); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                          echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                        </tr>
                    <?php endforeach ?> -->
                  </tbody>
                </table>      
              </div>
          </div>
        </div>
      </div>
  </div>
</div>