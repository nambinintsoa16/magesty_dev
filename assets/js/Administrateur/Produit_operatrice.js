$(document).ready(function(){
	table = $('#table-history').dataTable({
            processing: true,
            language: {
                url: base_url + "assets/dataTableFr/french.json",
            },
        });
	 $("#operatrice").autocomplete({
        source: base_url+"Administrateur/autocomplete_operatrice",
        select:function(label,items){
        	let full_name_refnum = items.item.label.split(' | ');
            let refnum =full_name_refnum[0];
            table.api().ajax.url(base_url+'Administrateur/dataListProduitUsers?refnum='+refnum);
            table.api().ajax.reload();

        }
     });
	$('#add_produit').on('click',function(event){
		event.preventDefault();
		 $.confirm({
                title: '<p class="text-center">Entre nouvelle page.</p>',
                content: '<input type="text" class="form-control form-control-sm code_produit">',
                    onContentReady: function() {
                    $(".code_produit").autocomplete({
                        source: base_url+"Administrateur/autoCompletePageFacebook",
                        appendTo: ".jconfirm-open",
                    });
                },
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let pageTemp = this.$content.find('.page_facebook').val().split('|');
                            let page = pageTemp[0].trim();
                            $.post(base_url + 'Administrateur/updatePageFacture', { facture,page }, function (data, textStatus, xhr) {
                                loaddata();
                            });
                        }
                    },
                    Annuler: {
                        text: 'Annuler',
                        btnClass: 'btn-danger',
                        action: function () {

                        }
                    }
                }
            });

	});

});