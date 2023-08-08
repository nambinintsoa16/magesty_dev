$(document).ready(function(){
    Table = $('.table-bon').DataTable({
        processing: true,
        searching: true,
        paging: true,
        ajax :base_url+"Administrateur/listeBonDAchat",
         language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
        drowCallback: function(row, data) {
          desactiver();
            },
       initComplete: function(setting) {
                desactiver();
            },    


    });

  Tables = $('.table-bon-parametre').DataTable({
        processing: true,
        searching: true,
        paging: true,
        ajax :base_url+"Administrateur/listeBonDAchatParametre",
         language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
        drowCallback: function(row, data) {
          desactiver();
            },
       initComplete: function(setting) {
                desactiver();
            },    


    });
   
 $('.nouveauBonDachat').on('click',function(e){
 	e.preventDefault();
 	$('#modaleBon').modal('show');
 });  
 $('.enregistre').on('click',function(e){
 	e.preventDefault();
 	var designation = $('.designation').val();
	var valeur = $('.valeur').val();
	var lettre = $('.lettre').val();
	$.post(base_url+'Administrateur/saveBonParametre',{designation,valeur,lettre},function(){
		$('input').val('');
		Tables.ajax.reload();
        $('#modaleBon').modal('hide');
	});

 });
 function desactiver(){
 	$('.desact').on('click',function(e){
 		e.preventDefault();
 		var link = $(this).attr('href');
 		$.get(link,function(){
 			Tables.ajax.reload();
 		});


 	});
 }
});