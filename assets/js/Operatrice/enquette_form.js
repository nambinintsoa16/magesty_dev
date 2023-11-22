$(document).ready(function () {
	$("#save_data").on("click", function (event) {
		event.preventDefault();
		let code_client = $("#code_client").text();
    let methodOk = false;
		let produit = null;
        let page = null;
        let refnum_facture = null;
		let choise_produit = $("#table-produit >tr"); 
        //_____________________________________________
        //_________________________ get prodact choise
		choise_produit.each(function (index, element) {
			if ($(this).find(".input_chose_produit").is(":checked")) {
				produit = $(this).find(".input_chose_produit").attr("id");
                page =  $(this).find(".input_chose_produit").attr("page");
                refnum_facture =  $(this).find(".input_chose_produit").attr("refnum_facture");
                
			}
		});

     methodOk= refnum_facture != null;
     if(methodOk){
        //_____________________________________________
        //______________________ get question & reponse
        let question = null;
        let reponse = null;
        let note = null;
        $('.question_reponse_containt').each(function(index, element){
                  question = $(this).find('.question').text();
                  let containt_rep = $(this).find('.reponse_input');
                  containt_rep.each(function(index, element){
                     if($(this).is(":checked")){
                        reponse = $(this).attr('reponse');
                     }
                  });
                 note = $(this).find('.note').val();

                 methodOk= reponse != null;
         //_____________________________________________
        //_________________________________ save reponse   

                if(methodOk){ 

                  $.post(base_url+"operatrice/save_reponse_enquette",{question,reponse,code_client,produit,page,note},function (data) {
                     
                  });    
                  $('input').val('');
                  $('textarea').val('');
        //_____________________________________________
        //_________ mettre à jour statu liste relanceaa7         
                  $('.reponse_input').checked = false;   
                  $.post(base_url+'operatrice/update_relance_aa7',{refnum_facture},function(){

                  });   

                }
        });
        }

        if(!methodOk){
            alertMessage("Erreure","Produit ou reponse non valide.","error", "btn btn-danger");
        }

        if (methodOk) {

            alertMessage("Succè!","Formulaire enregistré.","success", "btn btn-success");
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
