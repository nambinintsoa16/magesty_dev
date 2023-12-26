$(document).ready(function(){
   $('#btn-update').on('click',function(event){
   	event.preventDefault();
   	let data = $("#operatrice").val().split("|");
   	let matricule = data[0];
     $.confirm({
            title: "",
            content: "url:" + base_url + "Administrateur/edit_Motde_Passe",
            columnClass: "col-md-4",
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {
						let methodOk = false;
                    	let first = this.$content.find("#first-passeword").val();
                    	let second = this.$content.find("#second-passeword").val();
						methodOk = (first !="" && second != "");
                       
                        if (!methodOk) {
                            $.alert("Veuillez entrer mot de passe valide.");
                            return false;
                        }
                        if(methodOk){
						    methodOk = (first == second);
	                        if (!methodOk) {
	                            $.alert("Les deux mot de passe ne correspond pas.");
	                            return false;
	                        }
                        }
                      if(methodOk){
	                        $.post(base_url + "Administrateur/update_passeword", { first,matricule}, function(data) {
	                            $('input,textarea').val("");
	                            alert_message(
	                                "Succè!",
	                                "Requêtte traitée.",
	                                "success",
	                                "btn-success"
	                            );
	                        });
                       }

                    },
                },
                button: {
                    action: function() {},
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });
   });

    $("#operatrice").autocomplete({
	    source: base_url+"Administrateur/autocomplete_operatrice_init_pass",
	    select :function(items,label){
	    	let data = label.item.label.split("|");
	    	$('#detail').val("Mot de passe : "+data[2]);
	    	$("#operatrice").val(data[0]+"|"+data[1]);
	    }
	});

	function alert_message(title, message, icons, btn) {
        swal(title, message, {
            icon: icons,
            buttons: {
                confirm: {
                    className: btn,
                },
            },
        });
    }
});