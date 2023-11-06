<div class="col-md-12">
	<div class="row">
		<div class="form-group col-md-3 ml-2">
			<div class="row bg-white">
				<div class="col-md-12">
					<label>Produit à afficher : </label>
					<select class="custom-select custom-select-sm" id="select-produit">
						 <option hidden="">-----------------------------</option>
						<?php foreach($produit as $produit):?>
						  <option><?=$produit->Produit?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="col-md-12">
					<label>Question : </label>
					<select class="custom-select custom-select-sm" id="select-question">
						 <option hidden="">-----------------------------</option>
						<?php foreach($question as $question):?>
						  <option value="<?=$question->id ?>"><?=$question->question?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
				
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body text-center">
					<h1 class="w-100 text-center"><b>SONDAGE</b></h1>
					<h2 class="w-100 text-center text-danger"><b><span id="title-question"></b></span></h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">

<div class="col-md-8">
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

	<div class="col-md-4">
		<div class="card full-height">
			<div class="card-body">
				<div class="card-title text-center"><b>Résultat</b></div>
				<div class="d-flex flex-wrap justify-content-left pb-2 pt-4 border rounded  border-dark img-thumbnail"  id="question_containt">
					Tena Afa-po tanteraka <br/>
					Tena Afa-po <br/>
					Afa-po <br/>
					Tsy Afa-po <br/>
					Tena tsy Afa-po mihitsy <br/>
				</div>	
			</div>
		</div>
	</div>

</div>
