<div class="col-md-12">
            <table class="table dataTable table-striped table-advance table-hover w-100" id="tableau" >
              <thead class=" w-100">
                <tr style="background:<?=$color?>">
                    <th style="color:white">Client</th>
                    <th style="color:white">Photos</th>
                    <th style="color:white">Produit</th>
                    <th style="color:white">Somme</th>
                    <th style="color:white">Cadeau</th>
                    <th style="color:white">Lieu de livraisons</th>
                    <th style="color:white"> </th>
                    <th> </th>
                  </tr>
              </thead>
              </thead> 
                <tbody class="listLivraisonAnnullee">  
                <?php foreach($data as $data):?>
                  <tr>
               <td><?=$data['code_client']?></td>
               <td><img src="<?=code_client_img_link($data['Nom']);?>" width="50" height="50px" style="border-radius: 50%"></td> 
            
              <td><?=$data['produit']?></td>
              <td><?= number_format($data['ca'], 2, ',', ' ')?> Ar</td>
              <th style="color:white"><?=$data['cadeau']?></th>
              <td><?=$data['Ville']." ".$data['Quartier']?></td>   
             
              
                     

                    <td>
<?php if(!empty($data['remarque'])):?>                    
<button type="button" class="btn btn-sm btn-danger " data-toggle="modal" data-target="#<?=$data['link']?>">
 <i class="fa fa-flag"></i>
</button>
<?php endif;?>
<div class="modal fade" id="<?=$data['link']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?=$data['remarque']?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
                   
                    
                    </td>
                    <td>
                 <a class="btn btn-sm btn-info" href="
                 <?php 
                 if($type=='confirmer'){
                  echo base_url('service_clientel/confirmer_commande/'.$data['facture']);
                 }else if($type=='en_attente'){
                  echo base_url('service_clientel/planifier_commande/'.$data['facture']);
                 }else{
                   echo base_url('service_clientel/detail/'.$data['facture']);
                 }
                 
                 
                 
                 ?>"> <i class="fa fa-info"></i>     

                    </td>
                  
                    
                  </tr>
                <?php endforeach;?>
        </tbody>
              </table> 
              <br>
              <a href="<?=base_url('service_clientel/export/'.$date.'/'.$type)?>"  class="btn btn-success print pull-right" style="margin-left:25px"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;Exporter</a>
              <a href="<?=base_url('service_clientel/facture/'.$date)?>"  class="btn btn-primary print pull-right" style="margin-left:25px"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Imprimer</a> 
              <br>
          </div>
            
