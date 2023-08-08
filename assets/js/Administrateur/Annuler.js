$(document).ready(function(){
    $('.recherche').on('click', function (e) {
        e.preventDefault();

        var Id_facture = $('.Id_facture').val();
        if (Id_facture == "") {
            swal("erreur", "Id facture obligatoire", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn-danger"
                    }
                },
            });
        } else {
            loding();
            $.post(base_url + 'Administrateur/detail_Modifier_Vente_annule', { idfacture: Id_facture }, function (data) {
                $('.data-cont').empty().append(data);
                stopload();
                modif();
            });
        }
    });
  function modif(){
    $('.Annule').on('click',function(event){
        event.preventDefault();
        let facture=$('.facture').text();
        let remarque=$('.Remarqueannul').val();
        let code_annulation=$('.annula option:selected').val();
        let nomlivre=$('.nomlivre').val();
        
        if(code_annulation=="ANN_24"){
            $.confirm({
                title: '<p class="text-center">Entre facture qui remplace la facture à replacè</p>',
                content: '<input type="text" class="form-control factureRemplce">',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let idfactureREmplace = this.$content.find('.factureRemplce').val();
                            $.post(base_url + 'Administrateur/modifactureRemplcae', { idfactureREmplace,facture }, function (data, textStatus, xhr) {
                                loding();
                                $.post(base_url+'globale/annulationCommandes',{nomlivre:nomlivre,facture:facture,remarque:remarque,code_annulation:code_annulation},function(){
                                    $('.confirmform').addClass('collapse');
                                    stopload();
                                    alertMessage("Succé", "Vente annulée avec succès", "success", "btn btn-success");
                          
                             });
                            });
                        }
                    },
                    Annuler: {
                        text: 'Annuler',
                        btnClass: 'btn-danger',
                        action: function () {

                        }
                    }
                }
            });
        }else{
            loding();
       $.post(base_url+'globale/annulationCommandes',{nomlivre:nomlivre,facture:facture,remarque:remarque,code_annulation:code_annulation},function(){
              $('.confirmform').addClass('collapse');
              stopload();
              alertMessage("Succé", "Vente annulée avec succès", "success", "btn btn-success");
    
       });
    }
   
     });
  }

  function alertMessage(title, message, icons, btn) {
    swal(title, message, {
        icon: icons,
        buttons: {
            confirm: {
                className: btn
            }
        },
    });
}
    function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: green;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
    function stopload() {
        $('.jconfirm ').remove();

    }

});