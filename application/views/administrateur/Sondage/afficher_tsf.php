<div class="container">
	<div class="row pl-2 pr-2">
		<h1 class="pl-2 pt-2 text-left" style="font-size: 20px;">Sondage / Temoiganage / Faharetana <span class="id_get"><?= $id;?></span> </h1>
	</div>
	<div class="row pl-4 pr-4 pt-3 pb-4" style="background:#dddada">
		<div class="col-md-4">
			<div class="pt-3 pb-3" style="background: #fff;border-radius: 5px;">
				<h1 class="text-center" style="font-size:22px;color: #151570;font-weight: bold;">TEMOIGNAGES</h1>
				<?php foreach ($liste_temoignage as  $value): ?>					
					<div class="row pl-2 pr-2 " >
						<div class="col-md-3">
							<img style="width: 65px ;height: 65px;object-fit: cover;border-radius: 32.5px;border:4px solid #29235c;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
								echo base_url('images/client/'.$value->Code_client.'');
							}?>.jpg">
						</div>
						<div class="col-md-9">
						    <h2 style="font-size:16px;font-weight: bold;color: #29235c;"> <?php echo $value->Client?></h2>
						<p style="font-size:14px;color: #000;font-weight: bold;">
							<?php echo $value->Reponse?>
						</p>
						</div>
					</div>
				<?php endforeach ?>	
			</div>
			<br>

			<div class="row pl-3 pr-3">
				<div class="col-md-12 text-right bg-white pr-2" style="background:#fff; border-radius: 3px; padding: 5px 5px;">
					<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Temoignage"> <i class="fa fa-print"></i> </button>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="pt-3 pb-3" style="background: #fff;border-radius: 5px;">
				<h1 class="text-center" style="font-size:22px;color: #151570;font-weight: bold;">SONDAGES</h1>
				<?php foreach ($liste_sondage as  $value): ?>					
					<div class="row pl-2 pr-2 " >
						<div class="col-md-3">
							<img style="width: 65px ;height: 65px;object-fit: cover;border-radius: 32.5px;border:4px solid #29235c;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
								echo base_url('images/client/'.$value->Code_client.'');
							}?>.jpg">
						</div>
						<div class="col-md-9">
						    <h2 style="font-size:16px;font-weight: bold;color: #29235c;"> <?php echo $value->Client?></h2>
						<p style="font-size:14px;color: #000;font-weight: bold;">
							<?php echo $value->Reponse?>
						</p>
						</div>
					</div>
				<?php endforeach ?>	
			</div>
			<br>
			<div class="row pl-3 pr-3">
				<div class="col-md-12 text-right bg-white pr-2" style="background:#fff; border-radius: 3px; padding: 5px 5px;">
					<button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#Sondage"> <i class="fa fa-print"></i> </button>
				</div>
			</div>
			
		</div>
		<div class="col-md-4">
			<div class="pt-3 pb-3" style="background: #fff;border-radius: 5px;">
				<h1 class="text-center" style="font-size:22px;color: #151570;font-weight: bold;">FAHARETANA</h1>
				<?php foreach ($liste_faharetana as  $value): ?>					
					<div class="row pl-2 pr-2 " >
						<div class="col-md-3">
							<img style="width: 65px ;height: 65px;object-fit: cover;border-radius: 32.5px;border:4px solid #29235c;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
								echo base_url('images/client/'.$value->Code_client.'');
							}?>.jpg">
						</div>
						<div class="col-md-9">
						    <h2 style="font-size:16px;font-weight: bold;color: #29235c;"> <?php echo $value->Client?></h2>
						<p style="font-size:14px;color: #000;font-weight: bold;">
							<?php echo $value->Reponse?>
						</p>
						</div>
					</div>
				<?php endforeach ?>	
			</div>
			<br>
			<div class="row pl-3 pr-3">
				<div class="col-md-12 text-right bg-white pr-2" style="background:#fff; border-radius: 3px; padding: 5px 5px;">
					<button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#Faharetana"> <i class="fa fa-print"></i> </button>
				</div>
			</div>
		</div>	


	
</div>
<div class="row" style="background:#dddada">
			<div class="col-md-12 text-right mb-3" style="background: #fff padding: 5px 5px;">
				 <button class="btn btn-danger btn-sm valider_info">
				 	 Terminer
				 </button>
			</div>
		</div>
	</div>
<div class="modal fade" id="Temoignage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <div class="modal-body">
       	<div class="pl-4 pr-4 pt-4 pb-4" style="width: 100%; background: #ddd; position: relative;padding-right: 20px!important;  overflow-x: scroll;padding: 15xp 15px;height: 600px;">
			<div class="Teimognage" style="position: absolute;width:700px; background:#fff; border-radius: 10px; float: left; height: auto;">
				<div class="pl-2 pr-2 pt-2 pb-3" style="border-radius: 10px;background: #fff;" id="Temoignage1">
				<h1 class="text-center" style="font-size:44px;color: #151570;font-weight: bold;">TEMOIGNAGES</h1>
					<?php foreach ($liste_temoignage as  $value): ?>
						<div class="row mb-3" >
							<div class="col-md-2">
								<img style="width: 110px ;height: 110px;object-fit: cover;border-radius: 55px;border:6px solid #29235c;;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
									echo base_url('images/client/'.$value->Code_client.'');
								}?>.jpg">
			    			</div>
						<div class="col-md-10 pl-4 pr-2">
							<h2 style="font-size:32px;font-weight: bold;color: #29235c;"> <?php echo $value->Client?></h2>
							<p style="font-size:27px;color: #000;font-weight: bold;">
								<?php echo $value->Reponse?>
							</p>
						</div>
					</div>
					<?php endforeach ?>
					<div class="row">
						<div class="col-md-12 text-right">
							 <span style="width: auto;font-size:12px;padding:5px 5px;background: #ddd;border-radius: 2.5px;"><?= $reference_tsf->Reference;?></span>
						</div>
					</div>
							
				</div>
		
				<div id="previewImg1" style="display: none;">

		    	</div>
				</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Fermer</button>
        <button class="btn btn-success btn-sm" id="btn_convert1"> Telecharger</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Sondage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
      <div class="modal-body">
       	<div class="pl-4 pr-4 pt-4 pb-4" style="width: 100%; background: #ddd; position: relative;padding-right: 20px!important;  overflow-x: scroll;padding: 15xp 15px;height: 600px;">
			<div class="Teimognage" style="position: absolute;width:700px; background:#fff; border-radius: 10px; float: left; height: auto;">
				<div class="pl-2 pr-2 pt-2 pb-3" style="border-radius: 10px;background: #fff;" id="Sondage1">
				<h1 class="text-center" style="font-size:44px;color: #151570;font-weight: bold;">SONDAGES</h1>
					<?php foreach ($liste_sondage as  $value): ?>
						<div class="row mb-3" >
							<div class="col-md-2">
								<img style="width: 110px ;height: 110px;object-fit: cover;border-radius: 55px;border:6px solid #29235c;;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
									echo base_url('images/client/'.$value->Code_client.'');
								}?>.jpg">
			    			</div>
						<div class="col-md-10 pl-4 pr-2">
							<h2 style="font-size:32px;font-weight: bold;color: #29235c;"> <?php echo $value->Client?></h2>
							<p style="font-size:27px;color: #000;font-weight: bold;">
								<?php echo $value->Reponse?>
							</p>
						</div>
					</div>
					<?php endforeach ?>
					<div class="row">
						<div class="col-md-12 text-right">
							 <span style="width: auto;font-size:12px;padding:5px 5px;background: #ddd;border-radius: 2.5px;"><?= $reference_tsf->Reference;?></span>
						</div>
					</div>
							
				</div>
		
				<div id="previewImg2" style="display: none;">

		    	</div>
				</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Fermer</button>
        <button class="btn btn-success btn-sm" id="btn_convert2"> Telecharger</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Faharetana" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
      <div class="modal-body">
       	<div class="pl-4 pr-4 pt-4 pb-4" style="width: 100%; background: #ddd; position: relative;padding-right: 20px!important;  overflow-x: scroll;padding: 15xp 15px;height: 600px;">
			<div class="Teimognage" style="position: absolute;width:700px; background:#fff; border-radius: 10px; float: left; height: auto;">
				<div class="pl-2 pr-2 pt-2 pb-3" style="border-radius: 10px;background: #fff;" id="Faharetana1">
				<h1 class="text-center" style="font-size:44px;color: #151570;font-weight: bold;">FAHARETANA</h1>
					<?php foreach ($liste_sondage as  $value): ?>
						<div class="row mb-3" >
							<div class="col-md-2">
								<img style="width: 110px ;height: 110px;object-fit: cover;border-radius: 55px;border:6px solid #29235c;;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
									echo base_url('images/client/'.$value->Code_client.'');
								}?>.jpg">
			    			</div>
						<div class="col-md-10 pl-4 pr-2">
							<h2 style="font-size:32px;font-weight: bold;color: #29235c;"> <?php echo $value->Client?></h2>
							<p style="font-size:27px;color: #000;font-weight: bold;">
								<?php echo $value->Reponse?>
							</p>
						</div>
					</div>
					<?php endforeach ?>
					<div class="row">
						<div class="col-md-12 text-right">
							 <span style="width: auto;font-size:12px;padding:5px 5px;background: #ddd;border-radius: 2.5px;"><?= $reference_tsf->Reference;?></span>
						</div>
					</div>
							
				</div>
		
				<div id="previewImg3" style="display: none;">

		    	</div>
				</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Fermer</button>
        <button class="btn btn-success btn-sm" id="btn_convert3"> Telecharger</button>
      </div>
    </div>
  </div>
</div>

