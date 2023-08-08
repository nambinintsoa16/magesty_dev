<div class="container">
	<div class="row pl-4 pr-4">
		<h1 class="pl-2 pt-2 text-left" style="font-size: 20px;">Sondage et Temoiganage du <?php $date =  new datetime(); $dt=$date->format('Y-m-d'); echo $dt;?> | Operatrice :  <?php echo $opl = $this->session->userdata('matricule');?> </h1>
	</div>
	<div class="row pl-4 pr-4 pt-3 pb-4" style="background:grey">
		<div class="col-md-4">
			<div class="pt-3 pb-3" style="background: #fff;border-radius: 5px;">
				<h1 class="text-center" style="font-size:22px;color: #151570;font-weight: bold;">TEMOIGNAGE</h1>
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
		</div>
		<div class="col-md-4">
			<div class="pt-3 pb-3" style="background: #fff;border-radius: 5px;">
				<h1 class="text-center" style="font-size:22px;color: #151570;font-weight: bold;">SONDAGE</h1>
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
		</div>	
	</div>
</div>