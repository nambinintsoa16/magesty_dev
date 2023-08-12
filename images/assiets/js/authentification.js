$(document).ready(function(){
   $('form').on('submit',function(event){
       event.preventDefault();
       var matricule= $('.matricule').val();
       var password= $('.password').val();
     $.post(base_url+'authentification/login',{matricule:matricule,password:password},function(){
       location.reload();
     });
   });
});