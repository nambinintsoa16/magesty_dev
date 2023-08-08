<div class="container">
	<div class="row">
		<div class="col-6">
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">Nom : <?= $clients?>  </li>
			  <li class="list-group-item">Numéro : <?= $contact?></li>
			  <li class="list-group-item">Date du dernier Contact : <?= $dernier->heure?></li>
			  <li class="list-group-item">Total achat : <?= number_format($totalCA, 0, '.', ',')?> Ar</li>
			  <li class="list-group-item bg-info text-white historique">Historiques de discussions</li>
			</ul>
		</div>
		<div class="col-6">
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">Status : <span style="background:#fff;border-radius:3px; padding:3px 5px"> <?= $trimstatus?>   | <?= $annuelstatus?> </span></li>
			  <li class="list-group-item">Total Koty : <?= $KotyT ?> </li>
			  <li class="list-group-item">Total Smiles : <?= $SmilesT ?></li>
			 
			</ul>
		</div>
	</div>
	<span class="collapse codeclient"><?= $codeClient?></span>
	<hr>
	<div class="row">
		<div class="col">
			<table class="table table-striped table-hover table-bordered dt-responsive nowrap">
				<thead class="bg-info text-white text-center">
					<tr>
						<th scope="col">Date</th>
						<th scope="col">Page</th>
						<th scope="col">Matricule</th>
						<th scope="col">Code produit</th>
						<th scope="col">Produit</th>
						<th scope="col">Nbr de produits</th>
						<th scope="col">Montant</th>
						<th scope="col">Gain Koty</th>
						<th scope="col">Gain Smiles</th>
					</tr>
				</thead>
				<tbody>
					<?= $data?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.historique').on('click', function(e){

			var codeclient = $('.codeclient').text();
			 $.post(base_url + 'Operatrice/historique_discu', { codeclient: codeclient }, function(data) {
            $.alert({
                title: codeclient,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                    buttons: {
                    fermer: {
                        btnClass: 'btn-red text-center', // multiple classes.
                        
                    },
                }

            });
        });
		})
		
	});
</script>
