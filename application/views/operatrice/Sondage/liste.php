
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<div class="container">
	<div class="row pl-4 pr-4">
		<h1 class="pl-2 pt-2 text-left" style="font-size: 20px;">Sondage et Temoiganage du <?php $date =  new datetime(); $dt=$date->format('Y-m-d'); echo $dt;?> | Operatrice :  <?php echo $opl = $this->session->userdata('matricule');?> </h1>
	</div>
	<div class="pl-4 pr-4 pt-4 pb-4" style="width: 100%; background: #ddd; position: relative;padding-right: 20px!important;  overflow-x: scroll;padding: 15xp 15px;height: 700px;">
		<div class="Teimognage" style="position: absolute;width:700px; background:#fff; border-radius: 10px; float: left; ">
			<div class="pl-2 pr-2 pt-2 pb-3" style="border-radius: 10px;background: #fff;" id="Temoignage">
			<h1 class="text-center" style="font-size:44px;color: #151570;font-weight: bold;">TEMOIGNAGE</h1>
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
			<h1 class="text-left pl-4" style="font-size:16px;color: #ccc;">
				<?php   
				if($reference_temoignage){
					echo $reference_temoignage->reference;
				}
				?>
				
			</h1>			
		</div>
		
		<div id="previewImg1" style="display: none;">

    	</div>
		<div class="row"  style="margin-top: -35px;">
			<div class="col-md-12 text-right" style="padding-right: 30px;">
				<button class="btn btn-success btn-sm" id="btn_convert1"> <i class="fa fa-download"></i></button>
			</div>
		</div>
	</div>
</div>

		<div class="pt-2 pb-2" style="width:700px;position: absolute;margin-left: 720px;">
		<div class="pl-2 pr-2 pb-3" style="border-radius: 5px;background: #fff;" id="Sondage">
			<h1 class="text-center" style="font-size:44px;color: #151570;font-weight: bold;">SONDAGES</h1>
			<?php foreach ($liste_sondage as  $value): ?>
			<div class="row  mb-3" >
				<div class="col-md-2">
					<img style="width: 110px ;height: 110px;object-fit: cover;border-radius: 55px;border:6px solid #29235c;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
							echo base_url('images/client/'.$value->Code_client.'');
					}?>.jpg">
				</div>
				<div class="col-md-10 pl-4 pr-2">
					<h2 style="font-size:26px;font-weight: bold;color: #29235c;line-height: inherit;"> <?php echo $value->Client?></h2>
					<p style="font-size:27px;color: #000;font-weight: bold;">
						<?php echo $value->Reponse?>
					</p>
				</div>
			</div>
			<?php endforeach ?>
			<h1 class="text-left pl-4" style="font-size:16px;color: #ccc;">
				<?php   
					if($reference_sondage){
						echo $reference_sondage->reference;
					}
				?>
			</h1>					
		</div>
		<div id="previewImg2" style="display: none;">

    	</div>
		<div class="row"  style="margin-top: -35px;">
			<div class="col-md-12 text-right" style="padding-right: 30px;">
				<button class="btn btn-success btn-sm" id="btn_convert2"> <i class="fa fa-download"></i></button>
			</div>
		</div>
	</div>

		<div class=" pt-2 pb-2" style="width:700px;position: absolute;margin-left: 1440px;">
		<div class="pl-2 pr-2  pt-2 pb-3" style="border-radius: 5px;background: #fff;" id="Faharetana">
			<h1 class="text-center" style="font-size:44px;color: #151570;font-weight: bold;">FAHARETANA</h1>
			<?php foreach ($liste_faharetana as  $value): ?>
			<div class="row pb-3" >
				<div class="col-md-2">
					<img style="width: 110px ;height: 110px;object-fit: cover;border-radius: 55px;border:6px solid #29235c;" src="<?php if(file_exists(FCPATH.'images/client/'.$value->Provenance.'.jpg')) {echo base_url()?>images/client/<?php echo $value->Provenance;}else{
										echo base_url('images/client/'.$value->Code_client.'');
					}?>.jpg">
				</div>
				<div class="col-md-10 pl-4 pr-2">
					<h2 style="font-size:26px;font-weight: bold;color: #29235c;line-height: inherit;"> <?php echo $value->Client?></h2>
					<p style="font-size:27px;color: #000;font-weight: bold;">
						<?php echo $value->Reponse?>
					</p>
				</div>
			</div>
			<?php endforeach ?>
			<h1 class="text-left pl-4" style="font-size:16px;color: #ccc;">
				<?php   
				if($reference_faharetana){
					echo $reference_faharetana->reference;
				}
				?>
			</h1>
		</div>
		<div id="previewImg3" style="display: none;">
    	</div>
		<div class="row"  style="margin-top: -35px;">
			<div class="col-md-12 text-right" style="padding-right: 30px;">
				<button class="btn btn-success btn-sm" id="btn_convert3"> <i class="fa fa-download"></i></button>
			</div>
		</div>
					
	</div>
	</div>	
</div>

<script type="text/javascript">
		
	    document.getElementById("btn_convert1").addEventListener("click", function() {
        html2canvas(document.getElementById("Temoignage")).then(function (canvas) { 
        	var opl = "<?php echo $opl;?>";
        	var dt = "<?php echo $dt;?>";
        	var reference = "<?php echo $ref;?>";
        	var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                document.getElementById("previewImg1").appendChild(canvas);
                anchorTag.download = "Temoignage "+opl+" "+dt+" "+reference+".jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
     });

	document.getElementById("btn_convert2").addEventListener("click", function() {
        html2canvas(document.getElementById("Sondage")).then(function (canvas) { 
        	var opl = "<?php echo $opl;?>";
        	var dt = "<?php echo $dt;?>";
        	var reference = "<?php echo $ref;?>";           
        	var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                document.getElementById("previewImg2").appendChild(canvas);
                anchorTag.download = "Sondage "+opl+" "+dt+" "+reference+".jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
     });

	document.getElementById("btn_convert3").addEventListener("click", function() {
        html2canvas(document.getElementById("Faharetana")).then(function (canvas) { 
        	var opl = "<?php echo $opl;?>";
        	var dt = "<?php echo $dt;?>";
        	var reference = "<?php echo $ref;?>";           
        	var anchorTag = document.createElement("a");
               document.body.appendChild(anchorTag);
                document.getElementById("previewImg3").appendChild(canvas);
               anchorTag.download = "Faharetana "+opl+" "+dt+" "+reference+".jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
     });
</script>

		

