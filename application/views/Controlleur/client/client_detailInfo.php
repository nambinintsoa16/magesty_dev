
<style type="text/css"></style>
<div class="container">
	<div class="row">
		<div class="col-md-4">
		<fieldset>
			

		
			<div class="col-md-4">
				<select class="form-control"> 
					<option></option>
					<option></option>
					<option></option>
					<option></option>
				</select>
			</div>
		</fieldset>
   		</div>
		<div class="col-md-12">
			<div class="table">
				<table class="table table-bordered table-stripted table-responsive "> 
					<thead>
						 <tr>
					 		 <th>CODE CLIENT</th>
					 		 <th>LIEN FACEBOOK</th>
					 		 <th>COMPTE FACEBOOK</th> 
					 		 <th>CONTACT</th> 
					 		 <th>CHIFFRE D'AFFAIRE</th> 
					 		 <th>NBRE D'ARTICLES ACHETES</th> 
					 		 <th>NBRE D'ACHATS EFFECTUES</th> 
					 		 <th>DERNIER ARTICLE ACHETE</th> 
					 		 <th>DATE DERNIERE ACHAT</th> 
					 		 <th>NOMBRE DE PAGE CONTACTE</th> 
                             <?php foreach ($page as $key => $page):?>
                             	 <th id="cont_<?=$page->id?>" class="content-data"><?=$page->Nom_page?></th> 
                             <?php endforeach;?>
						 </tr>
					</thead>
					<tbody class="tbody">
					<?php $i=0; foreach ($data as $key => $data):?>
                        <tr>
                        	<td><?=$data->CODECLIENT?></td>
                        	<td><?=$data->LIENFACEBOOK?></td>
                        	<td><?=$data->COMPTEFACEBOOK?></td>
                        	<td><?=$data->CONTACT?></td>
                        	<td><?=number_format($data->CHIFFREAFFAIRE,'2',',',' ')?> Ar</td>
                        	<td><?=$data->NBREDARTICLESACHETES?></td>
                        	<td><?=$data->NBREDACHATSEFFECTUES?></td>
                        	<td><?=$data->DERNIERARTICLEACHETE?></td>
                        	<td><?=$data->DATEDERNIEREACHAT?></td>
                        	<td><?=$data->NOMBREDEPAGECONTACTE?></td>
                        </tr>
					<?php $i++; endforeach;?>
				 </tbody>
			</table>
			</div>	
		</div>	
	</div>	
</div>		

