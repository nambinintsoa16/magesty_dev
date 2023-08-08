$(document).ready(function(){
    $('.maj').on('click',function(e){
       e.preventDefault();
       let parent = $(this).parent().parent();
       let codeclient = parent.children().text();
       
       let link=$(this).attr('href');
       $.confirm({
        title: 'Confirmer!',
        content: 'Voulez-vous vraiment enregistrer?',
        buttons: {
            'Valider': function () {
               
                $.post(link,{codeclient:codeclient},function(data){
                    if(data.message==true){
                       parent.insert();
                    }
               
                  },'json');
    
            },
            'Annuler': function () {        
            }
        }
    });    
   
    });

    $('.client0007').on('click', function(e) {
        e.preventDefault();
       var parent = $(this).parent().parent();
        var codeclient = parent.children().first().text();
        var type = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Operatrice/client_details', { date: date, codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + " / " + type,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });

    $('.supporttrc014').on('click', function(e) {
        e.preventDefault();
        
        $.post(base_url + 'Operatrice/support_trc014', {  }, function(data) {
            $.alert({
                content: data,
                columnClass: 'col-md-12 col-md-offset-8',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });

    $('.supporttrc042').on('click', function(e) {
        e.preventDefault();
        
        $.post(base_url + 'Operatrice/support_trc042', {  }, function(data) {
            $.alert({
                content: data,
                columnClass: 'col-md-12 col-md-offset-8',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });
    
    $('.trc028').on('click', function(e) {
        e.preventDefault();
    
        $.post(base_url + 'Operatrice/support_trc028', {  }, function(data) {
            $.alert({
                content: data,
                columnClass: 'col-md-12 col-md-offset-8',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });  
    
    $('.discussion').on('click', function(e){
        e.preventDefault();
        let This = $(this);
		let parent = This.parent().parent();
		let code_client = parent.children().eq(0).text();
    
        $.post(base_url + 'operatrice/new_discussion', { client: code_client }, function (data) {
            localStorage.setItem("codeclient",code_client);
            localStorage.setItem("DISC", data);
            window.open(base_url + 'operatrice/Discussions');
            
        }, 'json');
    });
    
});
