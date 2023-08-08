        <div class="row">
          <div class="col-lg-12">
            <div class="card p-3">
              <div class="table-responsive">
              <table class="table table-striped table-advance table-hover dataTable">
              <thead class="bg-danger text-white">
                <tr>
                    <th> Code du produit</th>
                    <th>Photo Produit</th>
                    <th>Designation</th>
                    <th> Quantite</th>
                    <th>Prix Unitaire</th>
                    <th>Famille</th>
                    <th>Groupe</th>
                    <th></th>
                  </tr>
              </thead>
                <tbody class="listProduit">
                <?php 
               $json = file_get_contents('http://komone-beta.in-expedition.com/commercial/Data/Mes_Produits');
               $produit =json_decode($json);
              foreach ($produit as  $produit):
               ?> 
               <tr>
                    <td><?=$produit->Code_produit?></td>
                    <td>  
                   <img class="photosclient avatar-img rounded" src="<?=code_produit_img_link($produit->Code_produit)?>"style="width:50px;height:50px;">
                   </td>
                    <td><?=$produit->Designation?></td>
                    <td><?=$produit->Quantites?></td>
                    <td><?=number_format($produit->prix,2,",",".")?></td>
                    <td><?=$produit->famille?></td>
                    <td><?=$produit->groupe?></td>
                    
                   <td>
                    <a href="<?=base_url($type_user.'/Produits/Liste_des_produits/detail_produit/'.$produit->Code_produit)?>" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                   </td>
               </tr>               
              <?php endforeach;?>
           
                </tbody>
              </table>
  
          </div>
        </div>
        </div>
        </div>
      </section>
    </section>
    