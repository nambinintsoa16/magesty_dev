	<?php 
	 $this->load->model('global_model');
	 $question_temp = (array) $question;
	 ?>

	<div class="row">
		<div class="col-md-12 bg-white pt-3">
			<table class="table-sm table-bordered w-100 mt-2" id="dataTable">
				<thead class="bg-success text-white">
					<tr>
						<th>Code client</th>
						<th>Page</th>
						<?php foreach ($question as $key => $question):?>
							<th><?=$question->question?></th>
						<?php endforeach;?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($client as $key => $client): ?>
						<tr>
							<td><?php
							$nom_client = $this->global_model->get_client_po(["Code_client"=>$client->client]);
                            echo $nom_client != null ? $nom_client->Compte_facebook: $client->client;

							?></td>
							<td><?=$client->page?></td>
							
							<?php for($i=0;$i<count($question_temp);$i++):?>
								<td><?php 
								$question_param = $question_temp[$i]->question;
								$reponse = $this->global_model->get_reponse_question(["Question"=>$question_param,"client"=>$client->client]);
								echo $reponse != null ? $reponse->reponse: "";
								?></td>
							<?php endfor; ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
