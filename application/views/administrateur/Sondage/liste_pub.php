<style type="text/css">
	.table td, .table th {
    font-size: 12px!important;
    font-weight: normal!important;
}
</style>

	<div class="row bg-white pl-4 pr-4" >
		<div class="col-md-12 pb-3">
			<h1 style="font-size:22px; font-family:times;">LISTE TSF CORRIGER A TELECHARGER</h1>
			<hr style="border: solid 1px #3697e1;margin: 2px 0px!important;">
		</div>
		<div class="col-md-12">
			<div class="table-responsive">
			<table class="table  DataTable">
				<thead style="color: #fff;" class="bg-success">
					<tr style="padding: 3px 5px!important;">
						<th>Operatrice </th>
						<th>Date TSF </th>
						<th>Page TSF</th>
						<th>Produit</th>
						<th>Reference</th>
						<th class="text-center" style="width: 150px;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($liste_tsf as  $value): ?>
					<tr>
						<th><?= $value->Operatrice?></th>
						<th><?= $value->Date?></th>
						<th><?= $value->Nom_page?></th>
						<th><?= $value->Designation?></th>
						<th><?= $value->Reference?></th>
						<th class="text-center">
							<a href="<?php echo site_url()?>Administrateur/TSF_Exportation/<?= $value->Id;?>" class="btn btn-primary btn-sm">
								<i class="fa fa-plus"></i>
							</a> </th>
					</tr>
					<?php endforeach ?>
					
				</tbody>
			</table>
		</div>
		</div>	
	</div>
</div>


	