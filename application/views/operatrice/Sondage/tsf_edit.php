<style type="text/css">
	.table td, .table th {
    font-size: 13px!important;
    font-weight: normal!important;
}
    .form-group {
     margin-bottom: 2px!important;
    
 }
 .card-body {
    padding: 0.25rem!important;
}
.imgstyle{
    width: 100%;
    height: 180px;
    object-fit: cover;
    border: solid 1px #fff;
    border-radius: 2px;
}
.parent-div {
  display: inline-block;
  position: relative;
  overflow: hidden;
}
.parent-div input[type=file] {
  left: 0;
  top: 0;
  opacity: 0;
  position: absolute;
  font-size: 10px;
}
.btn-upload {
  background-color: #fff;
  border: 1px solid #ccc;
  color: #000;
  border-radius: 2px;
  
  font-size: 16px;
  font-weight: bold;
  width: 100%;
}
</style>
<div class="container  pl-1 pr-1 mb-3">
		<div class="row pl-1 pt-2" style="background: #fff;" >
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;"> Tache TSF</h1>
				<hr style="border:1px grey solid">
			</div>
			<table class="table">
				<thead style="background:#17a2b8;color: #fff;">
					<tr>
						<th>Id</th>
						<th>Date TSF</th>
						<th>Page</th>
						<th>Produit</th>
						<th>Réference</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="id_get"> <?= $info_tsf->Id;?> </td>
						<td> <?= $info_tsf->Date;?></td>
						<td><?= $info_tsf->Nom_page;?></td>
						<td><?= $info_tsf->Designation;?></td>
						<td><?= $info_tsf->Reference;?></td>
					</tr>
				</tbody>
			</table>	
		</div>
		<hr>

		<div class="row pl-1 pr-1 mb-3" style="background: #fff;">
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;">Detail  Tache TSF</h1>
				<hr style="border:1px grey solid">
			</div>
			<table class="table">
				<thead style="background:#17a2b8; color: #fff;padding: 3px 3px!important;">
					<tr>
						<th>Id </th>
						<th>Type</th>
						<th>Images</th>
						<th>Client</th>
						<th>Reponse</th>
						<th class="text-center" >Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($detail_tsf as  $value): ?>
						<tr>
							<td><?= $value->Id;?></td>
							<td><?= $value->Type;?></td>
							<td><img class="img-thumbnail "  style="width: 50px ;height: 50px;object-fit: cover;border:3px solid #29235c;;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
							echo base_url('images/client/'.$value->Code_client.'');
						}?>.jpg"></td>
							<td><?= $value->Compte_facebook;?></td>
							<td><?= $value->Reponse;?></td>
							<td style="width: 200px;" class="text-center">  <button class="btn btn-default btn-sm import_image" id="<?=$value->Code_client;?>"> <i class="fa fa-picture-o"></i>
								
							</button> | <a href="#" class="btn btn-danger btn-sm delete" id="<?= $value->Id;?>"><i class="fa fa-trash"></i></a>   </td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<div class="col-md-12 text-right">
				<button class="btn btn-primary btn-sm add_tsf"> <i class="fa fa-plus"></i> Ajouter plus de TSF </button>
				<button class="btn btn-default btn-sm hide_tsf" style="display:none"><i class="fa fa-eye-slash" aria-hidden="true"></i> </button>
			</div>
		</div>
	<div class="hide" style="display: none;">
		<form class="bg-white">
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;"> Ajouter nouvelle TSF  client</h1>
				<hr style="border:1px grey solid">
			</div>
			<div class="form-group row">
			    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Lien Profile </label>
			    <div class="col-sm-8">
			      <input type="text" class="form-control form-sm Lien_client" id="colFormLabel" placeholder="Entrez lien  Facebook">
			    </div>
			    <div class="col-sm-2 text-right">
			     	<button class="btn btn-primary btn-sm valider_link" style="width: 100%">Valider</button>
			    </div>
			</div> 
			<div class="info">
				
			</div>
			<div class="row" style="background:#fff">
				<div class="col-md-12">
					<h1 class="" style="font-size: 22px; font-family: times;"> Tableau TSF</h1>
					<hr style="border:1px grey solid">
				</div>
				<div class="col-md-12">
					<table class="table">
						<thead style="background:#007bff;color: #fff;">
							<tr>
								<th>Code Client </th>
								<th>Compte fb</th>
								<th>Type</th>
								<th>Reponse</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody class="Contenu">
						
						</tbody>
					</table>
				</div>	
			</div>
			<div class="container pl-1 pr-1">
				<div class="row">
					<div class="col-md-12 text-right mb-3">
						<button class="btn btn-danger btn-sm suprimer"> <i class="fa fa-trash"></i> </button>
						<button class="btn btn-success btn-sm enregistrer"> <i class="fa fa-check"></i> Enregistrer </button>
					</div>
				</div>
			</div>
		</div>

		<div class="row pl-1 pr-1 mb-3" style="background: #fff;">
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;">Etat Tâche TSF</h1>
				<hr style="border:1px grey solid">

			</div>
			<div class="col-md-12 text-right">
				<button class="btn btn-success btn-sm terminer_tache">TERMINER VOTRE TACHE</button>
			</div>
		</div>

</div>

<div class="modal fade" id="import_image_client" tabindex="" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">MISE A JOUR PHOTO CLIENT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	 <div class="row justify-content-center">
		    <div class="col-4">
		    
        <div id="image-holder">
		    	 	
		    </div>
		    <form method='post' action='<?php echo base_url(); ?>/Operatrice/do_upload' enctype='multipart/form-data'>
				   <input type='file' name='file' name='userfile'  id='fileUpload' size='20'> <br/><br/>
				   <input type='submit' value='Upload' name='upload' />
			  </form>
		    </div>
		  </div>
       	<div class="col-md-6 col-offset-md-3 text-center">
       		
       	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fermer</button>
       
      </div>
    </div>
  </div>
</div>



 
