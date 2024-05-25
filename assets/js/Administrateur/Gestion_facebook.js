$(document).ready(function(){
   $('.saveNewCompte').on('click',function(event){
   	event.preventDefault();
   	 let nomPage = $('#nomPage').val();
   	 let lienPage = $('#lienPage').val();
   	 let typeCompte = $('#typeCompte option:selected').val();
   	 let source = $('#source option:selected').val();
     let date_activation = $('#date_activation').val();
     $.post(base_url+"Administrateur/save_new_compte",{nomPage,lienPage,typeCompte,source,date_activation},function(data){
     	$('input').val('');
     });
 

   });
})