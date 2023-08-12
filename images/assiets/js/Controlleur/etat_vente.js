$(document).ready(function(){
  $('.nom').on('click',function(e){
    e.preventDefault();
    var parent=$(this).parent().parent();
    var code_client = parent.children().first().text();
    var date=$('.date_collapse').text();
    //var code1=$('.nom').text();
    $.post(base_url+'controlleur/NOM',{date:date,code_client:code_client},function(data){
    $.alert(data);
   
        }); 
      
     });
});

