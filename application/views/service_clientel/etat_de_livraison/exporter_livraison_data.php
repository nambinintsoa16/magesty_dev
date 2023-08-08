

		<div class="table-responsive">
			<table class="table tabledata" id="tblCustomers">
				<thead class="bg-info">
					<tr>
						<th>Code client</th>
						<th>Num Commande</th>
						<th>Client</th>
						<th>Date de Commande</th>
						<th>Date de Livraison</th>
						<th>Lien Facebook</th>
						<th>Contact</th>
						<th>Produit</th>
						<th>PU</th>
						<th>QTT</th>
						<th>lieu de livraison</th>
						<th>OPL</th>
						<th>Quartier</th>
						<th>Ville</th>
						<th>Montant</th>
						<th>Localisation</th>
						<th>Frais</th>
						<th>Remarque</th>
						<th>Statut</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nom ="";
					$link = "";
					 foreach ($liste_livre as  $value): $code = $value->Code_client; ?>
					
						<tr>
							<td><?= $value->Code_client;?></td>
							<td><?= $value->Id ;?></td>
							<td><?php $codefinal = substr($code,0,3);
								if($codefinal=="CMT"){
									$info_client = $this->db->query("SELECT `Compte_facebook` FROM `clientpo` WHERE `Code_client` like '$code' LIMIT 1;");
									$result = $info_client->result();
									foreach($result as $valueT){
										$nom = $valueT->Compte_facebook;
										echo $nom;
									}
								}else{
									$info_client = $this->db->query("SELECT `Compte_facebook` FROM `clientp_curieux` WHERE `Code_client` like '$code' LIMIT 1;");
									$result = $info_client->result();
									foreach($result as $valueT){
										$nom = $valueT->Compte_facebook;
										echo $nom;
									}
								}
							?>
						 </td>
							<td><?= $value->Date ;?></td>
							<td><?= $value->date_de_livraison ;?></td>
							<td><?php $codefinal = substr($code,0,3);
								if($codefinal=="CMT"){
									$info_client = $this->db->query("SELECT `lien_facebook` FROM `client_curieux` WHERE `Code_client` like '$code' LIMIT 1;");
									$result = $info_client->result();
									foreach($result as $valueT){
										$link = $valueT->lien_facebook;
										echo $link;
									}
								}else{
									$info_client = $this->db->query("SELECT `lien_facebook` FROM `client_curieux` WHERE `Code_client` like '$code' LIMIT 1;");
									$result = $info_client->result();
									foreach($result as $valueT){
										$link = $valueT->lien_facebook;
										echo $link;
									}
								}
							?></td>
							<td><?= $value->contacts ;?></td>
							<td><?= $value->Designation ;?></td>
							<td><?= $value->Prix_detail ;?></td>
							<td><?= $value->Quantite ;?></td>
							<td><?= $value->lieu_de_livraison ;?></td>
							<td><?= $value->Matricule_personnel ;?></td>
							<td><?= $value->Quartier ;?></td>
							<td><?= $value->Ville ;?></td>
							<td><?= $value->Montant ;?></td>
							<td><?= $value->Localite ;?></td>
							<td><?= $value->frais ;?></td>
							<td><?= $value->Remarque ;?></td>
							<td><?= $value->Status ;?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<button class="btn btn-success btn-sm" id="btnExport">Exporter la livraison</button>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#tblCustomers").table2excel({
                filename: "Liste livraison.xls"
            });
        });
    });
</script>
