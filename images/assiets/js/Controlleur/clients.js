$(document).ready(function(){
    $(document).ready(function(){
        $('.add_relance').on('click',function(event){
           event.preventDefault();
           $.confirm({
               title: '<p class="text-center" style="font-size:9px;">Ajour relance</p>',
               content:'<form action="post">'+
                       '<input type="date" id="date" class="form-control date" rows="3"><br>'+
                       '<input type="text" id="input" class="form-control user" rows="3"><br>'+
                       '<input id="input" class="form-control page" rows="3"><br>'+
                       '</form>',
               buttons: {
                   formSubmit: {
                       text: 'Envoyer',
                       btnClass: 'btn-blue',
                       action: function () {
                           var date=this.$content.find('.date').val();
                           var user=this.$content.find('.user').val();
                           var page=this.$content.find('.page').val();
                          addRelance(user,date,page);
                                
                       
                       }
                   },
                   cancel: function () {
                   
                   },
               },
               onContentReady: function () {
                   var jc = this;
                   this.$content.find('form').on('submit', function (e) {
                       e.preventDefault();
                       jc.$$formSubmit.trigger('click'); // reference the button and click it
                   });
               }
           });
   
   
   
   
   
           
        });
   
   function addRelance(user,date,page){
       $('.tbody').children().find('.select_user').each(function(){
           if($(this).prop("checked") == true){
               var parent=$(this).parent().parent();
               var code_client=parent.children().first().text();
       $.post(base_url+'controlleur/addRelance',{date:date,user:user,id_page:page,client:code_client,},function(data){
                   
        },'json');
     }
   });
   
   }
   
       $('.select_user').on('click',function(event){
         //  event.preventDefault();
           //$.alert(); 
       });
     
   });
  
});