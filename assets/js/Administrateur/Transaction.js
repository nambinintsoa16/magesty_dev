$(document).ready(function(){
     Table = $(".table_rapport").DataTable({
            processing: true,
            ajax: base_url + "Administrateur/listeDesTransaction/?client=&date=",
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
        
            "rowCallback": function(row, data) {
              
            },
            initComplete: function(setting) {
               
            },
            "drawCallback": function(settings) {
                     $('.delete').on('click',function(e){
                	 e.preventDefault();
                	 $.get($(this).attr('href'),function(data){
                	 	Table.ajax.reload();
                	 	swal("Succé", "Transaction supprimé avec succer", {
				            icon: "success",
				            buttons: {
				                confirm: {
				                    className: "btn-success"
				                }
				            },
				        });
                	 	
                	 });

                });

                 $('.info_Transaction').on('click',function(e){
                 	e.preventDefault();
                 	let $this = $(this);
                 	let client = $this.parent().parent().children().first().next().text();
                 	$('.code').empty().append(client);
                 	 $html = "";
                 	 $.post($this.attr('href'),function(data){
                 	 	
                 	 	$.each(data.data,function(key,val){
                        
                            $html += "<tr><td>"+val.Code_produit+"</td><td>"+val.Designation+"</td><td>"+val.Quantite+"</td><td>"+val.Prix_detail+"</td><td>"+val.Prix_detail * val.Quantite +"</td></tr>";    
                             
                 	 	});
                       

                         $('.tbody-data').empty().append($html);
                 	 	 $('#infoModale').modal('show');
                 	 },'json').fail(function(){
                 	 		swal("Erreur", "Facture introvable", {
				            icon: "error",
				            buttons: {
				                confirm: {
				                    className: "btn-danger"
				                }
				            },
				        });

                 	 });
                 	



                 });


            }
        });

$('.client1').autocomplete({
        source:base_url + "Administrateur/autocomplete_client",
        select: function (t, ti) {
                t.preventDefault();
                let items = ti.item.label.split('|');
                $('.client1').val(items[0].trim());
               
            }
    });

$('.afficher_client').on('click',function(e){
             e.preventDefault();
             var client=$('.client1').val();
             var date=$('.date_expir1').val();
             var links = base_url + "Administrateur/listeDesTransaction/?client=" + client + "&date=" + date;
            Table.ajax.url(links);
            Table.ajax.reload();
    });

});