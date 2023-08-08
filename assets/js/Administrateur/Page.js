
$(()=>{
    $(".Matricule").autocomplete({
        source:base_url +"Administrateur/autoCompletePersonnel",
        select: function (t, ti) {
            t.preventDefault();
            let items = ti.item.label.split('|')
            $('.Matricule').val(items[0].trim())
            $('.nom').val(items[1].trim())
        }
    })
    $('#nomPage').autocomplete({
        source:base_url +"Administrateur/autoCompleteNouvellePage",
        select: function (t, ti) {
            t.preventDefault();
            let items = ti.item.label.split('|')
            $('.nomPage').val(items[0].trim())
            $('.lienPage').val(items[1].trim())
        }
    })
    $('.saveNewPage').on('click',function(e){
        e.preventDefault();
        var vb = $('.Matricule').val();
        var nom = $('.nom').val(); 
        var nomPage = $('.nomPage').val();
        var lienPage = $('.lienPage').val();
        var date_activation = $('.date_activation').val();
        loding();
        $.post(base_url+"Administrateur/saveNewPage",{vb:vb,nom:nom,nomPage:nomPage,lienPage:lienPage,date_activation:date_activation},function(data){
            swal("Succes", "Nouvelle Page enregistrer avec succes", {
                icon: "success",
                buttons: {
                    confirm: {
                        className: "btn-success"
                    }
                },
            
            });
            stopload();
            $('input').val('');
        });
    })
   


       table = $('.table_gestion_pages').dataTable({
        processing: true,
        ajax:base_url + "Administrateur/listePage",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },

        "rowCallback": function(row, data) {

        },
        initComplete: function(setting) {

        },
        "drawCallback": function(settings) {
             $('.desactiver').on('click',function(e){
                 e.preventDefault()
                 let id = $(this).attr('id')
                 loding()
                 $.post(base_url+'Administrateur/desactivePage',{id},function(){
                    stopload()
                    table.ajax.reload()
                    swal("Succes", "Page désactive enregistrer avec succes", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn-success"
                            }
                        },
                    
                    });

                 })

             })
        }
    });
    

    function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #28a745;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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