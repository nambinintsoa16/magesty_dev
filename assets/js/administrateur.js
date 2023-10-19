$(document).ready(function(){
	$('#update_liste_enquette').on('click',function(event){
		event.preventDefault();
		$.post(base_url+'Administrateur/update_liste_enquette',function(data){
			console.log(data);
		});
	});

});