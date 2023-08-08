<style type="text/css">
	.table td, .table th {
    font-size: 12px!important;
    font-weight: normal!important;
}
</style>
<div class="main pl-4 pr-4">
	<div class="row bg-white pl-2 pr-2" >
		<div class="col-md-12 pb-3">
			<h1 style="font-size:22px; font-family:times;">VOS   Temoighage / Sondage /Faharetana (TSF)</h1>
			<hr style="border: solid 1px #3697e1;margin: 2px 0px!important;">
		</div>
		<div class="col-md-12">
			<div class="table-responsive">
			<table class="table  DataTable">
				<thead style="background: #17a2b8;color: #fff;">
					<tr style="padding: 3px 5px!important;">
						<th>Id</th>
						<th>Date TSF </th>
						<th>Page TSF</th>
						<th>Produit</th>
						<th>Reference</th>
						<th>Statut Opl</th>
						<th>Statut Correcteur</th>
						<th class="text-center" style="width: 250px;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($liste_tsf as  $value): ?>
					<tr>
						<th class="id_tsf"><?= $value->Id?></th>
						<th><?= $value->Date?></th>
						<th><?= $value->Nom_page?></th>
						<th><?= $value->Designation?></th>
						<th><?= $value->Reference?></th>
						<th><?= $value->Statut_opl?></th>
						<th><?= $value->Statut_Correcteur?></th>
						<th class="text-center"><a href="<?php echo site_url()?>Operatrice/TSF_detail/<?= $value->Id?>" class="btn btn-primary btn-sm">
							<i class="fa fa-plus "></i>
							</a>  
							| 
							<a href="<?php echo site_url()?>Operatrice/TSF_edit/<?= $value->Id?>" class="btn btn-warning btn-sm">
								<i class="fa fa-edit"></i>
							</a> | 
							<button class="btn btn-danger btn-sm delete" id="<?= $value->Id;?>"> <i class="fa fa-trash"></i></button>
						</th>

					</tr>
					<?php endforeach ?>
					
				</tbody>
			</table>
		</div>
		</div>	
		
	</div>
</div>