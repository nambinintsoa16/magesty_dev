$(document).ready(function () {
    Table = $('.table-anniv').DataTable({
        processing: true,
        searching: true,
        paging: true,
        ajax: base_url + "operatrice/liste_anniv",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        drowCallback: function (row, data) {
            action()
        },
        initComplete: function (setting) {
            action()
        },
        rowCallback: function(row ,data){
            action()
        }


    })

    function action() {
        $('.editAniv').on('click', function (e) {
            e.preventDefault();
            loding();
            let codeClienttemp = $(this).attr("id").split('_')
            let codeClient = codeClienttemp[0]
            let id_con = codeClienttemp[1]
            let page = codeClienttemp[2]
         
            let dateTime = new Date()
            let date = dateTime.getFullYear() + '-' + (dateTime.getMonth() + 1) + '-' + dateTime.getDate()
            let heure = dateTime.getHours() + ":" + dateTime.getMinutes() + ":" + dateTime.getSeconds()
        $.post(base_url + 'Administrateur/getBonActif',function(data){
               let designationBon = data.designationBon
               let valeur = data.valeur
               let lettre = data.lettre

            $.post(base_url + 'clients/updateClientBonAchat', { designationBon, valeur, codeClient, page ,lettre}, function (rep) {
                if (rep) {
                    let message = rep
                    $.post(base_url + 'operatrice/sauvemessage', { heure: heure, date: date, message: rep, client: codeClient, id_con: id_con, page: page, Type: 'message', sender: 'OPL', types: 'TICKET_TOMBOLA' }, function (data) {
                    localStorage.setItem("DISC",id_con);
                    localStorage.setItem("tache","TRAITEMENT DES ANNIVERSAIRE");
                    localStorage.setItem("codeclient",codeClient);
                    localStorage.setItem("pageUsers",page);
                    localStorage.setItem("produitUsers","PRO006");
                       // pagetext  PAGE - Tsena Kôty - FACEBOOK    
                    location.replace(base_url+'operatrice/Discussions');
                    
                            
                    }, 'json').fail(() => {
                        alertMessage('Erreur', 'Une s’est produit veuillez recommencer', 'error', 'btn btn-danger')
                    })
                }
            }).fail((error) => {
                alertMessage('Erreur', 'Une s’est produit veuillez recommencer', 'error', 'btn btn-danger')

               }) 
            
            },'json')
        })
    }

        function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #0000ff;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
        $.dialog({
            "title": "",
            "content": htmls,
            "show": true,
            "modal": true,
            "close": false,
            "closeOnMaskClick": false,
            "closeOnEscape": false,
            "dynamic": false,
            "height": 150,
            "fixedDimensions": true
        });
    }
});