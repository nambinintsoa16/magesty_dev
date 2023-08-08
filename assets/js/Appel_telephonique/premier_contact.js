$( document ).ready(function() {
    $.confirm({
        title: '<p style="color: #2a5591">premier contact systeme<p>',
        content: 'ce client se connecte pour la première fois dans notre système. Si vous voulez lancer une discussion appuyez sur le boutton Premier contact ci-dessus',
        buttons: {
            confirm:{
                text: "PREMIER CONTACT SY",
                btnClass: 'btn-success',
                action:function () {
                    $.post(base_url+'operatrice/insertClientPo',{lienFb: localStorage.getItem("lienFb")},
                        function(data){
                            //alert(data.codeClient);
                            if(data.message=="insertion reussit"){
                                localStorage.setItem('codeclient',data.codeClient);
                                localStorage.setItem("DISC"," ");
                                localStorage.setItem('isNouveau',true);
                                window.location.replace(base_url+'Appel_telephonique/Discussions');
                             }
                             else if(data.message=='client existe deja'){
                                localStorage.setItem('codeclient',data.codeClient);
                                localStorage.setItem("DISC"," ");
                                localStorage.setItem('isNouveau',false);
                                window.location.replace(base_url+'Appel_telephonique/Discussions');
                               //$.post(base_url+'operatrice/new_discussion',{client:localStorage.getItem('codeclient')},function(datas){
                                   
                                //},'json');
                             }
                             else{
                                alert("erreur client n'existe parmit les clients curieux");
                             }
                            localStorage.removeItem("lienFb");
                        }
                    ,'json');
                    
                }
            }, 
            cancel:{
                text: "ANNULER",
                btnClass: 'btn-danger',
                action: function () {
                    localStorage.removeItem("lienFb");
                    window.location.replace(base_url+'operatrice/Discussion/Nouveau');
                }
            }
        }
    });
});