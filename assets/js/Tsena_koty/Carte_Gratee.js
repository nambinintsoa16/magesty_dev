$('document').ready(function() {
    $('.client').on('mouseenter', function(e) {
        e.preventDefault();
        $(this).val();

    });
    var Table = $(".table_previsionnel").DataTable({
    searching: true,
    ordering: true,
    paging: true,
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    },

    });

    $('.client').autocomplete({
        source: base_url + "CarteGratee/autocomplete_client",
        select: function(t, ti) {
            t.preventDefault();
            loding();
            let items = ti.item.label.split('|');
            $('.client').val(items[0].trim());
            let client = items[0].trim();
            $.post(base_url + 'CarteGratee/chercheCart', { client: client }, (data) => {
                $('.containt-data').empty().append(data);
                stopload();
                $('.ban-jeux').slideUp();
            }).fail((error) => {
                alertMessage("Erreur", "message", "error", "btn btn-danger");
            });

        }
    });

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
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #ff0090;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
    $('.level').on('click',function(e){
        e.preventDefault();
        var chapeau = $(this).attr('id');
       
         $.post('http://magesty-prod.combo.fun/Tsena_koty/Chapeau',{chapeau:chapeau},function(data){
               $('#Tabledata').empty().append(data); 
         });
    });

});