$(document).ready(function(){

$('.deleter').on('click',function(e){
   e.preventDefault();
   let id=$(this).attr('id');
   let parent=$(this).parent().parent();
   let link=$(this).attr('href');
   $.confirm({
    title: 'Confirmer!',
    content: 'Voulez-vous vraiment supprimer?',
    buttons: {
        'Valider': function () {
           
            $.post(link,{id:id},function(data){
                if(data.message==true){
                   parent.remove();
                }
           
              },'json');

        },
        'Annuler': function () {        
        }
    }
});
 

   


});


});