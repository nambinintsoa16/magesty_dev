$(document).ready(function(){
   $("#save").on('click',function(event){
   	event.preventDefault();
   	let question = $("#question").val();
   	let reponse = $("#reponse").val();
   	let type = $("#type option:selected").val();
   	let methodOk = true;
   	$('.obligatoire').each(function(element){
   		if($(this).val()==""){
   			methodOk = false;
   		}

   	});
   	if(!methodOk){
   		alertMessage("Erreur!", "Vérifier votre saisie car il y a des champs vides.", "error", "btn-danger");
   	}
    if(methodOk){
	   	$.post(base_url+"administrateur/save_question",{question,reponse,type},function(data){
	   		$("input").val("");
	   		$("textarea").val("")
	   		alertMessage("Succès!", "Nouvelle question enregistre.", "success", "btn-success");
	   	});
   	}
   });
  function alertMessage(title, message, icons, btn) {
        swal(title, message, {
            icon: icons,
            buttons: {
                confirm: {
                    className: btn
                }
            },
        });

    }

});