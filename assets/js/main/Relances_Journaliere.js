$(document).ready(function() {
var Table = $("#tableau").DataTable({
			processing: true,
			ajax:base_url+'Relance/dataRelance',
			language: {
			       	url :"https://cdn.datatables.net/plug-ins/1.10.19/i18n/French.json"
					 },
		rowCallback: function (row, data) {
     
		},
        initComplete : function(setting){
            $('.btn-info').on('click',function(event) {
             	event.preventDefault();
             	var client = $(this).parent().parent().children().eq(2).text();
             	$.post(base_url+"Relance/dataLastProduit",{client:client},function(data){
					$.alert(data);
             	});
                    	  
         });
              $('.btn-success').on('click',function(event) {
                	event.preventDefault();
                	var id = $(this).attr('id');
                 $.post(base_url+"Relance/updateRelance",{id:id},function(data){
					 updatable();
             	   });
               });

         
       }
	});

var Tablefini= $('#table-effe').DataTable({
			processing: true,
			ajax:base_url+'Relance/dataRelanceFaite',
			language: {
			       	url :"https://cdn.datatables.net/plug-ins/1.10.19/i18n/French.json"
					 },
		rowCallback: function (row, data) {
     
		},
        initComplete : function(setting){
            $('.btn-info').on('click',function(event) {
             	event.preventDefault();
             	var client = $(this).parent().parent().children().eq(2).text();
             	$.post(base_url+"Relance/dataLastProduit",{client:client},function(data){
					$.alert(data);
             	});
                    	  
         });
         
       }
	});
function updatable(){
	 Table.ajax.reload(function(){
	 	$('.btn-info').on('click',function(event) {
             	event.preventDefault();
             	var client = $(this).parent().parent().children().eq(2).text();
             	$.post(base_url+"Relance/dataLastProduit",{client:client},function(data){
					$.alert(data);
             	});
                    	  
         });
              $('.btn-success').on('click',function(event) {
                	event.preventDefault();
                	var id = $(this).attr('id');
                 $.post(base_url+"Relance/updateRelance",{id:id},function(data){
					 updatable();
					
             	   });
                   Tablefini.ajax.reload(function(){
                   	$('.btn-info').on('click',function(event) {
             			event.preventDefault();
             			var client = $(this).parent().parent().children().eq(2).text();
             				$.post(base_url+"Relance/dataLastProduit",{client:client},function(data){
								$.alert(data);
             				});
                    	  
      				   });
                   });
               });
	 });
	
}
	
});