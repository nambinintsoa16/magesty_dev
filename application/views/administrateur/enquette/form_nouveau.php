<div class="container">
    <div class="row">
	<span class="alert alert-danger">
		<small class="text-danger">
			Dans le champ réponse il obligatoire de sépare chaque réponse par un point-virgule (;)
		</small>
	</span>
	</div>
	<fieldset class="border p-2 bg-white col-md-12 ml-1">
    <div class="row w-100 pl-2">
        
		<div class="form-group col-md-8">
			<label>Question : </label>
			<input type="text" class="form-control form-control-sm" id="question">
		</div>
		<div class="form-group col-md-4">
			<label>Type de question : </label>
			<select class="custom-select custom-select-sm" id="type">
				<option value="0">Question fermée</option>
				<option value="1">Question ouverte</option>
			<select>		
		</div>
		<div class="form-group col-md-12">
			<label>Réponse</label>
			<textarea class="form-control" id="reponse"></textarea>
		</div>
		<div class="form-group col-md-12 text-right">
			<a href="#" class="btn btn-primary btn-sm" id="save"><i class="fa fa-save"></i>&nbsp;Validé formulaire</a>
		</div>
	   
	</div>
	</fieldset>
</div>
