    <script>
	   const base_url="<?= base_url() ?>";
	</script> 
    <script src="<?=base_url()?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?=base_url()?>assets/js/core/popper.min.js"></script>
	<script src="<?=base_url()?>assets/js/core/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/chart.js/chart.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/chart-circle/circles.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/datatables/datatables.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/fullcalendar/fullcalendar.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/fullcalendar/fullcalendar.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/lightbox2/dist/js/lightbox.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/mask/mask.js"></script>
	<script src="<?=base_url()?>assets/js/jquery-confirm.min.js"></script>
	<script src="<?=base_url()?>assets/js/plugin/ckeditor/ckeditor.js"></script>
	<script src="<?=base_url()?>assets/js/atlantis.min.js"></script>
	<script src="<?=base_url()?>assets/js/setting-demo.js"></script>
	<script src="<?=base_url("assets/js/main/global.js")?>"></script>
	<script src="<?= base_url()?>assets/js/global.js"></script>
	<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <?php if(count($uri) > 2 && !empty(js_link($type_user,$uri[3]))):?>  
    	<script src="<?=js_link($type_user,$uri[3])?>"></script>    
	<?php elseif(count($uri) > 1  ):?>   
	<script src="<?=base_url()."assets/js/".ucwords($type_user)."/". $uri[2] .".js";?>"></script>    
	<?php elseif(count($uri) == 1):?>
	<script src="<?=base_url("assets/js/".strtolower($type_user).".js")?>"></script>
	<?php endif;?>
	<?php if(count($uri) > 1 && $uri[2]=="Cart"):?> 
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCos12fMCZ3i2Uk3Wp-hYx7vmQSHuc1ueA&signed_in=true&libraries=places&callback=initMap"
		async defer></script>
	<?php endif;?>
	
</body>