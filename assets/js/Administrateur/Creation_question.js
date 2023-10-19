$(document).ready(function(){
   $("#save").on('click',function(event){
   	event.preventDefault();
   	let question = $("#question").val();
   	let reponse = $("#reponse").val();
   	let type = $("#type option:selected").val();
   	$.post(base_url+"administrateur/save_question",{question,reponse,type},function(data){
   		$("input").val("");
   		$("textarea").val("")
   		alertMessage("Succès!", "Nouvelle question enregistre.", "success", "btn-success");
   	});


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