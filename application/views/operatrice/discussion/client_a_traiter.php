<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link AAC07" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <div class="col-md-12">PROP_CLT_AAC07</div> <div class="text-center"></div>
          </button> <span class="text-center"><label>Nombre de clients:</label>&nbsp <b><?= $AAC7 ?></b></span>
        </h5>
      </div>
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <div class="form-group contentTable table-striped responsive">
            <span class="date_collapse collapse"> 
              <?php if ($date == "") {$date = date('Y-m-d');} echo $date; ?>
            </span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap tableAAC07">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label><?= $countsac07traite?></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label><?= $countsac07-$countsac07traite ?></div>
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th>  
                    <th class="text-center">Status</th> 
                    <th class="text-center">Etat</th>             
                  </tr>
              </thead>
              <tbody class="tbody"> 
              </tbody>
            </table>      
          </div>
        </div>
      </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <div class="col-md-12"> PROP_CLT_AAC14</div>
        </button><span class="text-center"><label>Nombre de clients:</label>&nbsp <b><?= $AAC14?></b></span>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped responsive">
        <span class="date_collapse collapse"> 
          <?php if ($date == "") { $date = date('Y-m-d'); } echo $date; ?></span>
            <table class="table table-striped table-hover table-bordered dt-responsive nowrap table_mois">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
            </fieldset>
              <thead>
                <tr class="bg-secondary text-white">
                  <th >N°</th>
                  <th class="text-center">Code client</th>
                  <th class="text-center">Nom client</th>
                  <th class="text-center">Lien</th>
                  <th class="text-center">Page / Compte</th>  
                  <th class="text-center">Status</th>               
                </tr>
              </thead>
              <tbody class="tbody">
                <?=$donnes?>  
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="heading42">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapse42" aria-expanded="true" aria-controls="collapse42">
          <div class="col-md-12">PROP_CLT_AAC42</div>
          </button><span class="text-center"><label>Nombre de clients:</label>&nbsp <b><?= $AAC42?></b></span>
        </h5>
      </div>

      <div id="collapse42" class="collapse" aria-labelledby="heading42" data-parent="#accordion">
        <div class="card-body">
          <div class="form-group contentTable table-striped table-responsive">
            <span class="date_collapse collapse"> 
              <?php if ($date == "") { $date = date('Y-m-d'); } echo $date; ?>
            </span>

            <table class="table table-striped table-hover table-bordered dt-responsive nowrap table_mois">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th>  
                    <th class="text-center">Status</th>              
                  </tr>
              </thead>
              <tbody class="tbody">
                <?=$contentSAC42?>    
              </tbody>
            </table>      
          </div>
        </div>
      </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingCAT">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCAT" aria-expanded="true" aria-controls="collapseCAT">
          <div class="col-md-12">SAC CATALOGUE</div>
          </button><span class="text-center"><b><label>Nombre de clients:</label>&nbsp <?= $catalogue?></b></span>
        </h5>
      </div>
      <div id="collapseCAT" class="collapse" aria-labelledby="headingCAT" data-parent="#accordion">
        <div class="card-body">
          <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> 
              <?php if ($date == "") { $date = date('Y-m-d'); } echo $date; ?>
            </span>
            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th>  
                    <th class="text-center">Status</th>              
                  </tr>
              </thead>
              <tbody class="tbody">
              <?= $contentcatal ?>
              </tbody>
            </table>      
          </div>
        </div>
      </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingfive">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
        <div class="col-md-12"> PROP_CLT_SAC07 </div>
        </button><span class="text-center"><label>Nombre de clients:</label>&nbsp <b></b></span>
      </h5>
    </div>
    <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse">
              <?php if ($date == "") { $date = date('Y-m-d'); } echo $date; ?></span>
            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th>  
                    <th class="text-center">Status</th>               
                  </tr>
              </thead>
              <tbody class="tbody">
              <?= $contentsac07?>
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        <div class="col-md-12">CLT_SAC_RELANCE 42</div>
        </button>
        <span class="text-center"><label>Nombre de clients:</label>&nbsp <b></b></span>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> 
              <?php if ($date == "") { $date = date('Y-m-d'); } echo $date; ?>
            </span>
            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th>                
                  </tr>
              </thead>
              <tbody class="tbody">
              <?=$contenu?> 
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingsix">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
        <div class="col-md-12">VENTES NON LIVREES</div>
        </button><span class="text-center"><label>Nombre de clients:</label>&nbsp <b></b></span>
      </h5>
    </div>
    <div id="collapsesix" class="collapse" aria-labelledby="headingsix" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> 
              <?php if ($date == "") { $date = date('Y-m-d'); } echo $date; ?>
            </span>
            <table class="table table-striped table-hover table-bordered dt-responsive nowrap">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Motif</th>   
                    <th class="text-center">Status</th>             
                  </tr>
              </thead>
              <tbody class="tbody">
              <?=$contentvnl?>
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingfor">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed jaime" data-toggle="collapse" data-target="#collapsefor" aria-expanded="false" aria-controls="collapsefor">
        <div class="col-md-12">REACTION J'AIME</div>
        </button><span class="text-center"><label>Nombre de clients:</label>&nbsp <b><?= $jaime?></b></span>
      </h5>
    </div>
    <div id="collapsefor" class="collapse" aria-labelledby="headingfor" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> 
              <?php if ($date == "") { $date = date('Y-m-d'); } echo $date; ?>
            </span>
            <table class="table table-striped table-hover table-bordered dt-responsive nowrap tablejaime">
            <fieldset class="form-control">
            <div class="col-md-3"><label ><b>Nbr clients traités:</label></b></div>
            <div class="col-md-3"><label ><b>Nbr reste à traiter:</b></label></div>
            </fieldset>
              <thead>
                  <tr class="bg-secondary text-white">
                    <th >N°</th>
                    <th class="text-center">Date de publi</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page</th>
                    <th class="text-center">Status</th>                
                  </tr>
              </thead>
              <tbody class="tbody">
                
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="heading10">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed rdv" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
        <div class="col-md-12">RENDEZ-VOUS</div>
        </button>
       <span class="text-center"><label>Nombre de clients:</label>&nbsp <b><?= $rdvous?></b></span>
      </h5>
    </div>
    <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
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
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page</th>
                    <th class="text-center">Téléphone</th>                
                  </tr>
              </thead>
              <tbody class="tbody">
                <?= $datardv?>
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="heading11">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
        <div class="col-md-12">LISTE CLIENT POUR LA  PROMOTIONS EN COURS</div>
        </button>
       <span class="text-center"><label>Nombre de clients:</label>&nbsp <b></b></span>
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
              <td></td>
              <td><?= $value->Date_promotion?></td>
              <td><?= $value->Code_client?></td>
              <td><?= $value->Compte_facebook?></td>
              <td><?= $value->nombre_achat?></td>
              <td><?= $value->lien_facebook?></td>
              <td><?= $value->Nom_page?></td>
              <td class="text-center"><i class="fa fa-window-close danger"></i></td>
            </tr>
          <?php endforeach ?>   
        </tbody>
      </table>      
    </div>
  </div>
</div>
</div>
</div>