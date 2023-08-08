<div class="col-md-12 w-100 p-2 ">
<a href="<?=base_url('operatrice/export/'.$date.'/'.$type)?>"  class="btn text-white  print pull-right mr-3" style="margin-left:25px;background:<?=$color?>"><i class="fa fa-download"></i>&nbsp; Exporter</a>
</div>                    
                    <br>
<div class="col-md-12 response-lg card w-100 p-2 table-responsive">
            <table class="table dataTable table-striped table-advance table-hover w-100" id="tableau" >
              <thead>
                <tr style="background:<?=$color?>">
                    <th style="color:white">OPL</th>
                    <th style="color:white">Client</th>
										<th style="color:white">Photos</th>
                    <th style="color:white">Produit</th>
										<th style="color:white">Somme</th>
										<th style="color:white">Date L</th>
                    <th style="color:white">Lieu de livraison</th>
                    <th style="color:white">Remarque </th>
                    <th> </th>
                  </tr>
              </thead>
                <tbody class="listLivraisonAnnullee">  
                <?php foreach($data as $data):?>
                  <tr>
               <td><?=$data['user']?></td>
               <td><?=$data['infoclient']->Nom." ".$data['infoclient']->Prenom?></td>
               <td><img src="<?=code_client_img_link($data['infoclient']->Code_client)?>" width="50" height="50px" style="border-radius: 50%"></td> 
					
              <td><?=$data['produit']?></td>
							<td><?=$data['ca']?> Ar</td>
									 
							<td><?=$data['date_de_livraison']?></td>
              <td><?=$data['Ville']." ".$data['Quartier']?></td>   
              <td>
<?php if(!empty($data['remarque'])):?>                    
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?=$data['link']?>">
 <i class="fa fa-flag text-white"></i>
</button>
<?php endif;?>
<div class="modal fade" id="<?=$data['link']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h5 class="modal-title text-center" id="exampleModalLongTitle">Rémarque</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
      <?=$data['remarque']?>
			</div>
			
		</div>
	</div>
</div>
                   
                    
                    </td>
                    <td>
                 <?php if($type=="en_attente"):?>     
                 <a class="btn btn-info btn-sm" href="<?=base_url('operatrice/detail_de_facture_Attente/'.$data['facture'])?>"> <i class="fa fa-info"></i>     
                 <?php else:?>
                  <a class="btn btn-info btn-sm" href="<?=base_url('operatrice/detail_de_facture/'.$data['facture'])?>"> <i class="fa fa-info"></i>  
                  <?php endif?>
                    </td>
                  
                    
                  </tr>
                <?php endforeach;?>
 </tbody>
              </table>  
            </div>
            
              <br>
            
                   
