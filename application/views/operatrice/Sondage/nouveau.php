<div class="container  pl-1 pr-1 mb-3">
		<div class="row pl-3 pt-2" style="background: #fff;" >
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;"> Infomation TSF</h1>
				<hr style="border:1px grey solid">
			</div>
				
			<div class="form-group row">
			    <label for="colFormLabel" class="col-sm-1 col-form-label"> Date TSF </label>
			    <div class="col-sm-2">
			      <input type="Date" class="form-control date" value="">
			    </div>
			     <label for="colFormLabel" class="col-sm-1 col-form-label"> Page </label>
			    <div class="col-sm-2">
			     <select class="form-control page">
                    <option value="" collapse disabled></option>
                    <?php foreach ($page as  $value): ?>
                        <option value="<?= $value->id;?>"><?= $value->Nom_page;?></option>
                    <?php endforeach ?>
                  </select>
			    </div>

			     <label for="colFormLabel" class="col-sm-1 col-form-label"> Code Produit </label>
			    <div class="col-sm-2">
			      <input type="text" class="form-control produit" value="" >
			    </div>
			     <label for="colFormLabel" class="col-sm-1 col-form-label"> Réference </label>
			     
               
                <div class="col-sm-2">
                   <select class="form-control reference">
                        <option value="" collapse disabled></option>
                        <option value="CW">CW ( crystal white)</option>
                        <option value="PLS">PLS (passion less shave)</option>
                        <option value="CC">CC (clear & confident)</option>
                        <option value="SW">SW (snail white)</option>
                        <option value="EVER">EVER (eversense)</option>
                        <option value="PTN">PTN (pantene)</option>
                        <option value="MIST">MIST (mistine)</option>
                        <option value="PAOC">PAOC (pao color)</option>
                        <option value="PAOW">PAOW (mistine pao white)</option>
                        <option value="PAOW">FINE (FINE LINE)</option>
                        <option value="DIPSO">DIPSO (SUPPER COLOR)</option>
                        <option value="FUK">FUK KAO </option>  
                        <option value="EGG">EGG WHITE </option>
                        <option value="EYES">EYES MASK  </option> 
                        <option value="LIPS">LIPSTICK  </option> 
                        <option value="GELBL">GEL INTIME BLUE  </option>  
                        <option value="GELPK">GEL INTIME PINK  </option>
                        <option value="GELPK">GEL INTIME WHITE  </option>
                        <option value="GELGLD">GEL INTIME GOLD  </option>
                        <option value="PIL">PASSION IN LOVE  </option>   
                  </select>
                </div>
         
			</div>
		</div>
		<hr>
		<form class="bg-white">
			<div class="col-md-12">
				<h1 class="" style="font-size: 22px; font-family: times;"> Infomation client</h1>
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
			
</div>
<div class="container pl-1 pr-1">
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
</div>
<div class="container pl-1 pr-1">
	<div class="row">
		<div class="col-md-12 text-right mb-3">
			<button class="btn btn-danger btn-sm suprimer"> <i class="fa fa-trash"></i> </button>
			<button class="btn btn-success btn-sm enregistrer"> <i class="fa fa-check"></i> Enregistrer </button>
		</div>
	</div>
</div>
 
