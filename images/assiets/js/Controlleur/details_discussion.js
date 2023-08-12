$(document).ready(function(){

$('.check').on('click',function(e){
   var parent=$(this).parent().parent();
   var choix=$(this).val();
   var def=parent.next().text();

   parent.next().empty().append('<textarea style="overflow-y:scroll;  resize :both ; min-width:200px; min-height:100px; max-width:300px; max-height:300px;" class="form-control input-text">'+def+'</textarea>');
   $('.input-text').focus();
   valid_change(choix);
   
})
function valid_change(choix){
    $('.input-text').on('change',function(){
       var reponse=$(this).val();
       var parent=$(this).parent();
       $(this).remove();
       var id=parent.parent().children().first().text();
       $.post(base_url+"controlleur/enregister_remarque",{appreciation:reponse,Id:id,choix:choix},function(data){
           if(data.message==true){
              parent.append(reponse);
              if(choix=='OUI'){
               parent.css('color','#00C851');
              }else if(choix=='NON'){
               parent.css('color','#ff4444');
              }
           } 
       },'json');
       
    });
}



});