
 <div class="container mt-1">
         <div class="col-md-12">
            <div class="card p-3  mt-2">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable table-hover table-striped dataTables" >
                        <thead class="bg-danger text-light text-center">
                            <tr>
                                <th>Client</th>
                                <th>Photo</th>
                                <th>Produit</th>
                                <th>Somme</th>
                                <th>Lieu de livraison</th>
                                <th>Remarque</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach($data as $data):?> 
                            <tr>
                                <td><?= $data->Code_client?></td>
                                <td>
                                     <img class="photosclient avatar-img rounded" src="<?=code_produit_img_link($data->Code_produit)?>"style="width:50px;height:50px;">
                                </td>
                                <td><?= $data->Code_produit?></td>
                                <td><?=number_format($data->Prix_detail*$data->Quantite, 2, ',', ' ')?></td>
                                <td><?= $data->lieu_de_livraison?></td>
                                <td><?= $data->Remarque?></td>
                            </tr>
                        <?php endforeach;?> 
                        </tbody>
                    </table>
                </div>
            </div>
         </div>
     </div>
</div>         
