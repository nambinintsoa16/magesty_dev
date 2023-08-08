


    <div class="row banniere_livraison">
            <div class="col-md-12">
                <img src="<?=base_url('images/service_clientel/livraison910.jpg')?>" alt="" height="400" width="100%"
                    class="bann_image">
            </div>

    </div>
         <div class="row possiton-note">
             <div class="col-md-9"></div>
                 <div class="col-md-3">
                    <h3></h3>
                    <img src="<?=base_url('images/service_clientel/Note2.png')?>" alt="" height="300" width="100%"
                        class="bann_image" >
                         <h3 style="margin-top: -210px; font-size: 15px; text-align: center">livraison <br> en attante</h3>
                         <p class="text-center mt-1"><?= $totalCa[0]->totalCa; ?></p>
                  </div>
         </div>
         <div class="row" style="margin-top: 190px">
            <div class="col-md-12">
             <div class="card">
              <div class="card p-3">
                <div class="table-responsive">
                    <table class="table table-striped dataTable table-bordered w-100 text-center" >
                        <thead class="bg-danger text-white" id="headTable">
                            <tr>
                                <th>Client</th> 
                                <th>Photos</th> 
                                <th>Produit</th>
                                <th>Somme</th>
                                <th>Lieu de livraison</th>
                            </tr>
                        </thead>
                            <tbody>
                               <?php  foreach($livraison as $data):?> 
                                <tr>
                                     <th><?= $data->Code_client?></th>
                                      <th>
                                          <img class="photosclient avatar-img rounded" src="<?=code_produit_img_link($data->Code_produit)?>"style="width:50px;height:50px;">
                                      </th>
                                        <th><?= $data->Code_produit?></th> 
                                   
                                    <td><?=number_format($data->Prix_detail*$data->Quantite, 2, ',', ' ')?></td>
                                    <th><?= $data->lieu_de_livraison?></th>
                                </tr>
                                 <?php endforeach;?> 
                            </tbody>
                        
                    </table>
                </div>
                </div>
            </div>
         </div>
        </div> 
        </div> 
     