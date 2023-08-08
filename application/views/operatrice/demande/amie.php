<style type="text/css">
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}

.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}

</style>

<div class="container col-md-12" style="background-color: white;padding:3%;margin-top:2%">
	<form >
		<div class="row">
			<div class="form-group col-md-2 text-rigth" style="margin-top:2%;">
		  	 	<img src="<?= base_url('images/profil_vide.jpg')?>" id="preview" class="img img-thumbnail" style="width: 150px; height: 150px;" /><br/>
				<div class="fileUpload btn btn-primary">
   					<span>Choisir images</span>
    				<input id="image" type="file" class="upload" />
				</div> 
			</div>
			<div class="col-md-10"style="margin-top:2%;">
				<div class="form-group form-inline">
					<label class="col-md-3">Nom sur facebook : </label>
					<input type="text" class="form-control NomEtPrenom col-md-7" style="width:75%;">
				</div>
				<div class="form-group form-inline" style="margin-top:6%;">
					<label class="col-md-3">Link : </label>
					<input type="text" class="form-control Lien col-md-7" style="width:75%;">
				</div>
				<div class="form-group form-inline" style="margin-top:12%;">
					<label class="col-md-3">Type d'action</label>
					<select class="form-control Type col-md-7" style="width:75%;">
						<option>Demande d'amie</option>
						<option>Demande d'abonnement</option>
					</select>
				</div> 
				<div class="form-group form-inline" style="margin-top:18%;">
					<label class="col-md-3">Page ou compte</label>
					<select class="form-control PageOuCompte col-md-7" style="width:75%;">
						<?php foreach($page as $page):?>
							<option value="<?=$page->id?>"><?=$page->Nom_page?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="row col-md-12" style="margin-top:2%;">
					<div class="form-group pull-right">
						<button type="submit" class="btn btn-success savedonne">Enregistrée</button>
						<button type="reset" class="btn btn-danger">Annulée</button>
						<a href="<?=base_url("operatrice/listeDemandeEnvoyer")?>"  class="btn btn-warning">Consulte liste envoyer</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>