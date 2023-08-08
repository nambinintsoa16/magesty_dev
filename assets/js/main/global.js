$(document).ready(function(){
	function alertCustum(title,containt,icon,color){
	swal(title, containt, {
			icon : icon,
			buttons: {        			
				confirm: {
					className : color
						 }
			        },
	});
	
}	
});