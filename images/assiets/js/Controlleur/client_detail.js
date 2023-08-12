$(document).ready(function() {
	function load(){
 	for(var i=0;i<100;i++){
 		$(".progress-bar").css("width",i+"%");
 		$(".progress-bar").empty().append(i+"%");
 	}
 }
	//loding();


	$('.tbody tr').each(function(index, el) {
		var codeClient = $(this).children().first().text();
		
	});	
   function loding(){ 
      $.dialog({
        "title": "",
        "content": '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div></div>',
        "show": true,
        "modal": true,
        "close": false,
        "closeOnMaskClick": false,
        "closeOnEscape": false,
        "dynamic": false,
        "height": 150,
        "fixedDimensions": true
      }); 

    
        }
   function stopload(){
   $('.jconfirm ').remove();
         
   }



});