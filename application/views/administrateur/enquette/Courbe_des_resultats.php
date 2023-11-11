<div class="col-md-12">
	<div class="row">
		<div class="form-group col-md-4">
			<div class="row bg-white">
				
				<div class="col-md-12">
					<label>Question : </label>
					<select class="custom-select custom-select-sm" id="select-question">
						 <option hidden="">-----------------------------</option>
						<?php foreach($question as $question):?>
						  <option value="<?=$question->id ?>"><?=$question->question?></option>
						<?php endforeach;?>
					</select>
				</div>

				<div class="col-md-6">
					<label>Produit : </label>
					<select class="custom-select custom-select-sm" id="select-produit">
						 <option hidden="">-----------------------------</option>
						<?php foreach($produit as $produit):?>
							<?php
                               $this->load->model('Administrateur_model');
                            $detailProduit = $this->Administrateur_model->get_produit(['Code_produit'=>$produit->Produit]);
							?> 
						  <option value="<?=$produit->Produit?>"><?= $detailProduit !=null ?$detailProduit->Designation:""?></option>
						<?php endforeach;?>
					</select>
				</div>

				<div class="col-md-6">
					<label>Famille : </label>
					<select class="custom-select custom-select-sm" id="select-produit-famille">
						 <option hidden="">-----------------------------</option>
						<?php foreach($famille as $famille):?>
						  <option><?=$famille->famille?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group col-md-3 ml-2">
			<div class="row bg-white">
				<div class="col-md-12">
						<label>Date début : </label>
						<input type="date" id="debut" name="" class="form-control form-control-sm">
					</div>
					<div class="col-md-12">
						<label>Date Fin : </label>
						<input type="date" name="" id="fin" class="form-control form-control-sm">
					</div>
				</div>	
		</div>
		<div class="col-md-3">
			<div class="row bg-white mt-2">
				<div class="col-md-12 mt-4">
						<button class="btn btn-warning btn-sm w-100"><i class="fa fa-print"></i>&nbsp;Print</button> 
					</div>
					<div class="col-md-12 mt-4">
						<button class="btn btn-primary btn-sm w-100" id="valider_selection"><i class="fa fa-print"></i>&nbsp;Valider</button> 
					</div>
				</div>	
			
		</div>
	</div>
</div>

<div class="row">

<div class="col-md-4">
	<div class="card">
		<div class="card-body">

			<div style="position: relative; width:300px; height:300px;margin: auto;">
			    <canvas id="text" 
			            style="z-index: 1; 
			                   position: absolute;
			                   left: 0px; 
			                   top: 0px;" 
			            height="300" 
			            width="300"></canvas>
			    <canvas id="circles-1" 
			            style="z-index: 2; 
			                   position: absolute;
			                   left: 0px; 
			                   top: 0px;" 
			            height="300" 
			            width="300"></canvas>
			</div>
		</div>
	</div>	
</div>
<div class="col-md-5">
	<div class="col-md-12"> 
		<div class="card w-100">
			<div class="card-body text-center">
				<h4 class="w-100 text-center"><b>SONDAGE</b></h1>
				<p class="w-100 text-center text-danger"><b><span id="title-question"></b></span></p>
			</div>
		</div>
	</div>
	<div class="col-md-12"> 
	<div class="d-flex flex-wrap justify-content-left pb-2 pt-4 border rounded  border-dark img-thumbnail mt-2"  id="question_containt">						
	</div>	
	</div>
</div>
	<div class="col-md-3">
		<div class="row">
		
			<div class="col-md-12">
				<div class="card full-height">
					<div class="card-body">
						<div class="card-title text-center"><b>Résultat</b></div>
						<div class="d-flex flex-wrap justify-content-left pb-2 pt-4 border rounded  border-dark img-thumbnail"  id="question_containt">
							
						</div>	
						
					</div>
				</div>
			</div>	
		</div>
	</div>

</div>
