<div class="container">

<div id="accordion">
  <div class="card">
    <div class="card-header" id="heading1">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed promo" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
        <div class="col-md-12">TOP 100 KOTY PAR PAGE</div>
        </button>
      </h5>

    </div>
    <div id="collapse1" class="collapse" aria-labelledby="heading1" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover table-bordered dt-responsive DataTables nowrap">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th class="text-center">N°</th>
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Koty</th> 
                                                     
                  </tr>
              </thead>
              <?= $contenu?>
                   
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
        <div class="col-md-12">TOP 100 KOTY AVEC SMILES - MAGESTY</div>
        </button>
    </h5>
    </div>
    <div id="collapse28" class="collapse" aria-labelledby="heading28" data-parent="#accordion">
      <div class="card-body">
      <div class="form-group contentTable table-striped ">
            <span class="date_collapse collapse"> <?php echo $date; ?></span>

            <table class="table table-striped table-hover tablekoty table-bordered DataTables nowrap">
                <thead class="bg-info text-center">
					<tr>
						<th scope="col">Code client</th>
						<th scope="col">Code produit</th>
						<!--<th scope="col">Produit</th>-->
						<th scope="col">Nbr de produits</th>
						<th scope="col">Montant</th>
						<th scope="col">Gain Koty</th>
						<th scope="col">Gain Smiles</th>
					</tr>
				</thead>
              <tbody class="tbody"> 
                <?= $data?>                   
              </tbody>
            </table>      
          </div>
      </div>
    </div>
  </div>
<div>