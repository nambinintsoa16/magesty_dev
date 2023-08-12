$(document).ready(function(){
    $('.login-form').on('submit',function(event){
        event.preventDefault();
        var matricule= $('.matricule').val();
        var password= $('.password').val();
      $.post(base_url+'authentification/login',{matricule:matricule,password:password},function(){
        location.reload();
      });
    });
$(".dataTable").dataTable({
    "language": {
        "sUrl": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
    }
});


});