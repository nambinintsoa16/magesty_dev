<style type="text/css">
	.table td, .table th {
    font-size: 13px!important;
    font-weight: normal!important;
}
</style>
<div class="container  pl-1 pr-1 mb-3">
		<div class="row pl-1 pt-2" style="background: #fff;" >
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;"> Tache TSF</h1>
				<hr style="border:1px grey solid">
			</div>
			<table class="table">
				<thead style="background:#17a2b8;color: #fff;">
					<tr>
						<th>Id</th>
						<th>Operatric</th>
						<th>Date TSF</th>
						<th>Page</th>
						<th>Produit</th>
						<th>Réference</th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="id_get"> <?= $info_tsf->Id;?> </td>
						<td > <?= $info_tsf->Operatrice;?> </td>
						<td> <?= $info_tsf->Date;?></td>
						<td><?= $info_tsf->Nom_page;?></td>
						<td><?= $info_tsf->Designation;?></td>
						<td><?= $info_tsf->Reference;?></td>
						
					</tr>
				</tbody>
			</table>	
		</div>
		<hr>

		<div class="row pl-1 pr-1 mb-3" style="background: #fff;">
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;">Detail  Tache TSF</h1>
				<hr style="border:1px grey solid">
			</div>
			<table class="table">
				<thead style="background:#17a2b8; color: #fff;padding: 3px 3px!important;">
					<tr>
						<th>Id </th>
						<th>Type</th>
						<th>Images</th>
						<th>Client</th>
						<th style="width:400px!important">Reponse</th>
						<th>Statut</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($detail_tsf as  $value): ?>
						<tr>
							<td class="iddetail"><?= $value->Id;?></td>
							<td><?= $value->Type;?></td>
							<td><img class="img-thumbnail" style="width: 50px ;height: 50px;object-fit: cover;border:3px solid #29235c;;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
							echo base_url('images/client/'.$value->Code_client.'');
						}?>.jpg"></td>
							<td><?= $value->Compte_facebook;?></td>
							<td  style="padding: 10px 2px!important;" class="pt-2 pb-2">  <?= $value->Reponse;?>  </td>
							<td><?= $value->Statut;?></td>
							<th class="text-center">  <button class="btn btn-warning btn-sm lock_line" disabled><i class="fa fa-lock"> </i></button>  <button class="btn btn-primary btn-sm valider_correction edit_line" style="display: none;"><i class="fa fa-edit"> </i></button> </th>
						</tr>
					<?php endforeach ?>
					
				</tbody>

				
			</table>
			<div class="col-md-12 text-right">
				<button class="btn btn-danger btn-sm lock" style="display: none;"><i class="fa fa-lock"></i> </button>
				<button  class="btn btn-success btn-sm deverouiller"><i class="fa fa-lock-open"></i></button>
				
			</div>
		</div>
		<div class="row pl-1 pr-1 mb-3" style="background: #fff;">
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;">Etat Tâche TSF</h1>
				<hr style="border:1px grey solid">

			</div>
			<div class="col-md-12 text-right">
				<button class="btn btn-success btn-sm terminer_tache">VALIDER  VOTRE CORRECTION</button>
			</div>
		</div>

</div>



 
