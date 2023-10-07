
<div class="container">
	<div class="row w-100 pl-2"> 
<fieldset class="border p-2 bg-white col-md-3 ml-1">
 <legend class="w-auto"></legend>
 	<div class="row">
 		<div class="form-group">
  			<label><small>Sélectionner compagne</small></label>
  			<select class="custom-select custom-select-sm">
          <option hidden="">Selectionner compagine</option>
          <?php  foreach ($compaigne as $key => $compaigne) : ?>
  				  <option value="<?=$compaigne->id?>"><?=$compaigne->designation?></option>
          <?php endforeach;?>
  			</select>
		</div>
  </div>
</fieldset>

<fieldset class="border p-2 bg-white col-md-8 ml-1">
 <legend class="w-auto"></legend>
 	<div class="row">
 		<div class="form-group col-md-4">
  			<p>
  				<span>&nbsp;Campagne du -- au --</span>
  			</p>
		</div>
  </div>
</fieldset>

</div>

<fieldset class="border p-2 bg-white ">
  <legend class="w-auto"><small>Sasie des informations</small></legend>
	<div class="row">
		
		<input type="text" id="refnum_publication" name="" class="form-control form-control-sm collapse">
    <div class="form-group col-md-4">
      <label class="label"><small>Publication</small></label>
      <input type="text" id="publication" name="" class="form-control form-control-sm">
    </div>
    <div class="form-group col-md-4">
      <label class="label"><small>Produit</small></label>
      <input type="text" id="produit" name="" disabled="" class="form-control form-control-sm">
    </div>
      <div class="form-group col-md-4">
      <label class="label"><small>Client</small></label>
        <div class="row">
          <input type="text" id ="client" name="" class="form-control form-control-sm col-6">
          <a href="#" class="btn btn-sm btn-info col-md-4 ml-1" id="histo_client">Historique du client</a>
            <datalist id="liste_publication">
              <option value="FA12"> 
              </datalist>
        </div>
    </div>
    <div class="form-group col-md-4">
      <label class="label"><small>Type d'action</small></label>
      <select class="custom-select custom-select-sm">
        <option hidden="true">Selectionner action</option>
        <option>J'aime</option>
        <option>Partager</option>
        <option>Commenter</option>
      </select>
    </div>

	

		<div class="form-group col-md-12">
			<label class="label"><small>Remarque</small></label>
			<textarea class="form-control"></textarea>
		</div>
	</div>
</fieldset>

<fieldset class="border p-2 bg-white">
	<legend class="w-auto"><small>Valider information</small></legend>
	<div class="row">
		<div class="form-group w-100 text-right">
		    <a href="#" class="btn btn-success btn-sm w-25" id="save_data">Enregsitre</a>
	    </div>
	</div>
</fieldset>
</div>


<div class="modal fade" id="modal_history_client" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Show a second modal and hide this one with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Hide this modal and show the first with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
