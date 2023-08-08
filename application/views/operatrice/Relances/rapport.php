
	<div class="row">
		<div class="col-md-4">
			<ul class="list-group">
				<li class="list-group-item bg-info text-white">TYPE DES RELANCES</li>
				<li class="list-group-item">ACC007</li>
				<li class="list-group-item">ACC028</li>
				<li class="list-group-item">ACC049</li>
				<li class="list-group-item">ACC070</li>
				<li class="list-group-item">CLT007</li>
				<li class="list-group-item">VENTES NON LIVREES</li>
				<li class="list-group-item">RENDEZ-VOUS</li>
				<li class="list-group-item">PROSPECTION CLIENT</li>
			</ul>
		</div>
		<div class="col-md-4 m-0">
			<ul class="list-group">
				<li class="list-group-item bg-info text-white">NOMBRE DE CLIENTS A TRAITES</li>
				<li class="list-group-item text-center"><?= count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))); ?></li>
				<li class="list-group-item text-center"><?php echo count($this->global_model->client_a_traiterAAC28($this->session->userdata('page'))); ?></li>
				<li class="list-group-item text-center"><?= count($this->global_model->client_a_traiterAAC49($this->session->userdata('page'))); ?></li>
				<li class="list-group-item text-center"><?= count($this->global_model->client_a_traiterAAC70($this->session->userdata('page'))); ?></li>
				<li class="list-group-item text-center"><?= count($this->global_model->clientctl007($this->session->userdata('page'))); ?></li>
				<li class="list-group-item text-center"><?= count($this->global_model->vente_non_livre($this->session->userdata('page'))); ?></li>
				<li class="list-group-item text-center">0</li>
				<li class="list-group-item text-center"><?= count($this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('page'))); ?></li>
			</ul>
		</div>
		<div class="col-md-2 m-0">
			<ul class="list-group">
				<li class="list-group-item bg-info text-white">TRAITES</li>
				<li class="list-group-item text-center"><?= $this->global_model->AAC07($this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center"><?php echo $this->global_model->ACC28($this->session->userdata('matricule'));?></li>
				<li class="list-group-item text-center"><?php echo $this->global_model->ACC49($this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center"><?php echo $this->global_model->ACC70($this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center"><?= $this->global_model->testchecks(date('Y-m-d'), $this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center"><?php echo $this->global_model->VENTENONLIVREE($this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center">0</li>
				<li class="list-group-item text-center"><?php echo $this->global_model->JAIME($this->session->userdata('matricule')); ?></li>
			</ul>
		</div>
		<div class="col-md-2 m-0">
			<ul class="list-group text-center">
				<li class="list-group-item bg-info text-white">RESTES</li>
				<li class="list-group-item text-center"><?= count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))) - $this->global_model->AAC07($this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center"><?php echo count($this->global_model->client_a_traiterAAC28($this->session->userdata('page'))) - $this->global_model->ACC28($this->session->userdata('matricule'));?></li>
				<li class="list-group-item text-center"><?php echo count($this->global_model->client_a_traiterAAC49($this->session->userdata('page'))) - $this->global_model->ACC49($this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center"><?php echo count($this->global_model->client_a_traiterAAC70($this->session->userdata('page'))) - $this->global_model->ACC70($this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center"><?= count($this->global_model->clientctl007($this->session->userdata('page'))) - $this->global_model->testchecks(date('Y-m-d'), $this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center"><?= count($this->global_model->vente_non_livre($this->session->userdata('page'))) - $this->global_model->VENTENONLIVREE($this->session->userdata('matricule')); ?></li>
				<li class="list-group-item text-center">0</li>
				<li class="list-group-item text-center"><?= count($this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('page'))) - $this->global_model->JAIME($this->session->userdata('matricule')); ?></li>
			</ul>
		</div>
	</div>
</div>
