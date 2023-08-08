$(document).ready(function(){
   $('.btn-click').on('click',function(){
    var page = $(this).find('small').text();
    $.post(base_url+'urgent/page',{page:page},function(data){
        $('.containt').empty().append(data);
        if(page=="NOUVELLE REQUETTE"){
          nouvelle();
        }
    });
   });
   //objet,codeUrgence,comptefacebook,codeClient,lienfacebook

   $.post(base_url+'urgent/page',{page:"NOUVELLE REQUETTE"},function(data){
        $('.containt').empty().append(data);
         nouvelle();
    });
   function nouvelle(){
       CKEDITOR.editorConfig = function( config ) {
            config.language = 'es';
            config.uiColor = '#F7B42C';
            config.height = 100;
            config.toolbarCanCollapse = false;
        };
        CKEDITOR.replace('textRequette');
        $('.lienfacebook').on('change',function(){
          var curent = $(this);
           var lien = curent.val();
           $.post(base_url+'urgent/recherceClient',{lien:lien},function(data){
            if(data==null){
               swal({
                            text: 'Client inconnue', 
                            type: 'error',
                            icon : 'error',
                            buttons: {
                                confirm: {
                                    className : 'btn btn-danger'
                                }
                            },
                        });
               curent.val("");

            }else{
              $('.comptefacebook').val(data.Compte_facebook);
              $('.codeClient').val(data.Code_client);
            }
            },'json');
        });
        $('.save').on('click',function(e){
          e.preventDefault();
             var objet = CKEDITOR.instances["textRequette"].getData();
             var codeUrgence = $('.codeUrgence').val();
             var codeClient = $('.codeClient').val();
             var page = $('.page').val();
             $.post(base_url+'Urgent/save',{objet:objet,codeUrgence:codeUrgence,codeClient:codeClient,page:page},function(data){
                 CKEDITOR.instances["textRequette"].setData("");
                 $('input').val('');     
                 swal({
                            text: 'Client inconnue', 
                            type: 'success',
                            icon : 'success',
                            buttons: {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            },
                        });
             });
        });

   }

   
});