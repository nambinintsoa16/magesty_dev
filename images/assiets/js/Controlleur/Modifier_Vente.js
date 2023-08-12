$(document).ready(function(){
	$('.recherche').on('click',function(e){
		e.preventDefault();
		loding();
		loaddata();
		
	});
	function loaddata(){
		var Id_facture = $('.Id_facture').val();
		if(Id_facture==""){
			 stopload();
           $.alert();
		}else{
			$.post(base_url+'controlleur/detail_Modifier_Vente',{idfacture:Id_facture},function(data){
                 $('.data-cont').empty().append(data);
                  stopload();
                  modif();
			});
		}
	}
	function modif(){
	
		$(".btn-statut").on('click',function(event){
			event.preventDefault();
			loding();
			var statut =$('.statut option:selected').val();
			var idfacture =$('.idfactureId').text();
           $.post(base_url+'controlleur/modifVenteStatut', {statut: statut,idfacture:idfacture}, function(data, textStatus, xhr) {
              loaddata();
              stopload();
           });
		});

		$(".modifiDelete").on('click',function(event){
			event.preventDefault();
			var con = $(this);
            var idVente = con.parent().parent().find('.Id').text();
             $.post(base_url+'controlleur/modifVenteDelete', {idVente:idVente}, function(data, textStatus, xhr) {
        	  loaddata();
   			 });

         });
 
       $('.modifiDetail').on('click',function(event){
       	event.preventDefault();
			var con = $(this);
            var idVente = con.parent().parent().find('.Id').text();
		    $.confirm({
                title: '<p class="text-center">Que voulez vous modifier?</p>',
                content:'<select class="form-control action"><option>Ajouter</option><option>Produit</option><option>Quantite</option><option>Supprimer</option></select>',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-blue',
                        action: function() {
                            let id = this.$content.find('.action option:selected').val();
                            switch(id) {
  									case "Ajouter":
    							     add(idVente);
   									 break;
  									 case "Produit":
    							     produit(idVente);
   									 break;
   									 case "Quantite":
    							     quantite(idVente);
   									 break;
  									default:
   						            $.confirm({
                                    title: '<p style="color: red">Attention!</p>',
                                    content:'<p>vous devez choisir une page</p>',
                                    buttons: {
                                        ok: function() {
                                          
                                        }
                                    }
                                }); 
							} 
                        }    
                    },
                    Annuler: function() {
                       
                    }
                }
            });

		 });
		
	}
function produit(idVente){
   $.confirm({
                title: '<p class="text-center">Entre nouveau code produit</p>',
                content:'<input type="text" class="form-control prodact" ><script>$(document).ready(function(){$(".prodact").autocomplete({source:base_url+"controlleur/autocomplete_prodact"});});</script>',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-blue',
                        action: function() {
                            let produit = this.$content.find('.prodact').val().split('|');
                            $.post(base_url+'controlleur/modifVenteProduit', {produit: produit[0],idVente:idVente}, function(data, textStatus, xhr) {
        					  loaddata();
   							 });
                        }    
                    },
                    Annuler: function() {
                       
                    }
                }
            });
}
function add(){
	var idfacture = $('.idfactureId').text();
	$.confirm({
                title: '<p class="text-center">Entre nouveau code produit</p>',
                content:'<p><input type="text" class="form-control prodact" ></p>'+
                '<p><input type="number" class="form-control quantite" ></p>'+
                '<script>$(document).ready(function(){$(".prodact").autocomplete({source:base_url+"controlleur/autocomplete_prodact"});});</script>',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-blue',
                        action: function() {
                            let produit = this.$content.find('.prodact').val().split('|');
                            let quantite = this.$content.find('.quantite').val();
                            $.post(base_url+'controlleur/modifVentePadd', {quantite:quantite,produit: produit[0],idfacture:idfacture}, function(data, textStatus, xhr) {
        					  loaddata();
   							 });
                        }    
                    },
                    Annuler: function() {
                       
                    }
                }
            });

}
function  quantite(idVente){
	
	 $.confirm({
                title: '<p class="text-center">Entre nouveau code produit</p>',
                content:'<input type="number" class="form-control quantite">',
                buttons: {
                    formSubmit: {
                        text: 'Confirmer',
                        btnClass: 'btn-blue',
                        action: function() {
                            let Quantite = this.$content.find('.quantite').val();
                            $.post(base_url+'controlleur/modifVenteQuantite', {Quantite: Quantite,idVente:idVente}, function(data, textStatus, xhr) {
        					  loaddata();
   							 });
                        }    
                    },
                    Annuler: function() {
                       
                    }
                }
            });

}
function loding(){ 
    let data='<div class="d-flex justify-content-center" style="height:50px;width: 50px;margin: auto;"><img src="'+base_url+'/images/loading.gif"></div>';
    $.confirm({
     title: '',
     content:  data,
     cancelButton: false,
     confirmButton: false,
     buttons: { ok: { isHidden: true } }
   });
   }
function stopload(){
$('.jconfirm ').remove();
    
}



  
});