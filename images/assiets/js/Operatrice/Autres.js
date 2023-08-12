$(document).ready(function() {
    $('.btn-test').on('click', function(e) {
        e.preventDefault();
        var option = $('.select2 option:selected').val();
        var type = $('.select1 option:selected').val();
        var codepublication = $('.codepublication').val();
        var codeproduit = $('.codeproduit').val();
        var nomproduit = $('.nomproduit').val();
        var date = $('.date ').val();
        var time = $('.time').val();
        var codegroupe = $('.codegroupe').val();
        var nomgroupe = $('.nomgroupe').val();
        var Lien_support = $('.Lien_support').val();
        var pageUsers = $('.pageUsers option:selected').val();

        /*var destination= $('.destination').val();*/

        /*$.alert(type+" "+option);*/
        if ($('.select2 option:selected').val() == "" || $('.select1 option:selected').val() == "" || $('.codepublication').val() == "" || $('.codeproduit').val() == "" || $('.nomproduit').val() == "" || $('.codegroupe').val() == "" || $('.nomgroupe').val() == "" || $('.Lien_support').val() == "" || $('.pageUsers option:selected').val() == "") {
            initable();
            swal('Erreur', "Une Erreur s'est produit! veuillez recommencer", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn btn-danger"
                    }
                },
            });
            stopload();
        } else {
            loding();
            initable();
            $.post(base_url + 'operatrice/autre_outil', { option: option, type: type, pageUsers: pageUsers, codepublication: codepublication, codeproduit: codeproduit, nomproduit: nomproduit, date: date, time: time, codegroupe: codegroupe, nomgroupe: nomgroupe, Lien_support: Lien_support }, function() {
                stopload();
                swal('Success', "Enregistrée avec succès", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: "btn btn-success"
                        }
                    },
                });
            });
        }


    });


});
$(".codegroupe").autocomplete({
    source: base_url + "operatrice/autocomplete_codegroupe",
    select: function(t, ti) {
        t.preventDefault();
        let items = ti.item.label.split('|');
        $('.codegroupe').val(items[0]);
        $('.nomgroupe').val(items[1]);
        $('.Lien_support').val(items[2]);
    }
});

$(".codeproduit").autocomplete({
    source: base_url + "operatrice/autocomplete_codeproduit",
    select: function(e, ui) {
        e.preventDefault();
        let items = ui.item.label.split('|');
        $('.codeproduit').val(items[0]);
        $('.nomproduit').val(items[1]);
    }
});


$(".select1").on('change', function() {
    var codes = $(".select1 option:selected").text();
    var taches = $(".select2 option:selected").text();
    $.post(base_url + 'operatrice/completeTache', { code: codes, taches: taches }, function(data) {
        $('.select2').empty().append(data);
    });

});


initable();

function loding() {
    var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #0000ff;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
    $.dialog({
        "title": "",
        "content": htmls,
        "show": true,
        "modal": true,
        "close": true,
        "closeOnMaskClick": false,
        "closeOnEscape": false,
        "dynamic": false,
        "height": 150,
        "fixedDimensions": true
    });
}

function stopload() {

    $('.jconfirm-open').remove();

}

function initable() {
    $.post(base_url + 'operatrice/tableAutre', function(data) {
        if (data.message == true) {
            $('.tabeContect').empty().append(data.content);
            stopload();
        }

    }, 'json');
}

function Tables() {
    $(".dataTable").dataTable({
        "language": {
            "sUrl": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
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

}