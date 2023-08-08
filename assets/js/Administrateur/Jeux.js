$(() => {

    $('.enregistreParametre').on('click', function (e) {
        e.preventDefault()
        let produit = $('.produit').val()
        let Montant = $('.Montant').val()
        let Designation = $('.Designation').val()
        loding()
        $.post(base_url + 'administrateur/enregistrePrametreTombola', { produit, Montant, Designation }, function () {
            stopload()
            $('input').val('')
            alertMessage("Succé", "Paramétre enregistre avec succé", "success", "btn btn-success")

        }).fail((erreur) => {
            stopload()
            alertMessage("Erreur", "Paramétre non enregistre", "error", "btn btn-danger")
        })

    })


    TableParametre = $('.table-parametre').DataTable({
        processing: true,
        ajax: base_url + 'administrateur/dataparametre',
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        "rowCallback": function (row, data) {

        },
        initComplete: function (setting) {

        },
        "drawCallback": function (settings) {
            dataActionTombola();
        }
    })

    function dataActionTombola() {
        $('.supprimerParameterTombola').on('click', function (e) {
            e.preventDefault()
            let id = $(this).attr('id')
            $.post(base_url + "administrateur/DeleteDataparametre", { id }, function () {
                TableParametre.ajax.reload()
            })

        })
        $('.TerminerParameterTombola').on('click', function (e) {
            e.preventDefault()
            let id = $(this).attr('id')
            loding()
            $.post(base_url + 'administrateur/TeminerPrametreTombola', { id }, function () {
                stopload()
                TableParametre.ajax.reload()
                alertMessage("Succé", "Paramétre modifier avec succé", "success", "btn btn-success")

            }).fail((erreur) => {
                stopload()
                alertMessage("Erreur", "Paramétre non modifier", "error", "btn btn-danger")
            })

        })
        $('.modifParamtreTombola').on('click', function (e) {
            e.preventDefault()
            let $this = $(this)
            let parent = $this.parent().parent()
            let Designation = parent.children().eq(1).text()
            let produit = parent.children().eq(3).text()
            let Montant = parent.children().eq(4).text()

            $('.idParametreModal').val($(this).attr('id'))
            $('.produit').val(produit)
            $('.Montant').val(Montant)
            $('.Designation').val(Designation)
            $('#modalModif').modal('show')

        })
    }


    $('.modifierParametre').on('click', function (e) {
        e.preventDefault()
        let produit = $('.produit').val()
        let Montant = $('.Montant').val()
        let Designation = $('.Designation').val()
        let id = $('.idParametreModal').val()
        loding()
        $.post(base_url + 'administrateur/ModifierPrametreTombola', { produit, Montant, id, Designation }, function () {
            stopload()
            $('input').val('')
            TableParametre.ajax.reload()
            $('#modalModif').modal('hide')
            alertMessage("Succé", "Paramétre modifier avec succé", "success", "btn btn-success")

        }).fail((erreur) => {
            stopload()
            alertMessage("Erreur", "Paramétre non modifier", "error", "btn btn-danger")
        })


    })

    Table = $('.table-tombola').DataTable({
        processing: true,
        ajax: base_url + 'administrateur/dataTombola',
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        "rowCallback": function (row, data) {

        },
        initComplete: function (setting) {

        },
        "drawCallback": function (settings) {
            dataAction();
        }
    })
    $('.contact').on('keyup', function () {
        var valeur = $(this).val();
        if (valeur.length == 9) {
            $(this).mask("+261 99 99 999 99")

        }
    })

    function dataAction() {
        $('.detail').on('click', function (e) {
            e.preventDefault()
            let $this = $(this).parent().parent()
            let facture = $this.children().first().next().text()
            $('#exampleModalLongTitle').empty().append('Détail facture N° ' + facture)
            $.post(base_url + 'administrateur/detailVenteTombola', { facture }, function (data) {
                $('.row-content').empty().append(data)
                $('#modalImage').modal('show')
            })

        })

    }

    $('.autocompleteProduit').on('focus', function () {
        $(this).val('')
    })
    $('.autocompleteProduit').autocomplete({
        source: base_url + 'produit/autocomplete_codeproduit',
        select: function (e, item) {
            e.preventDefault()
            let repItmes = item.item.value
            let repItmesSplit = repItmes.split('|')
            let produit = $('.produit').val()

            if (produit != '') {
                produit += "-" + repItmesSplit[0].trim()
            } else {
                produit = repItmesSplit[0].trim()
            }
            $('.produit').val(produit)
            $('.autocompleteProduit ').val('')

        }
    })


    $('.videParametre').on('click', function (e) {
        e.preventDefault()
        $('input').val('')

    })
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
        })
    }



    $.post(base_url + 'administrateur/dateChart', function (data) {
        var ctx = document.getElementById('lineChart').getContext('2d');
        ctx.height = 140;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels:data.date,
                datasets: [{
                    label: 'Total ticket',
                    data: data.data,
                    borderColor: [
                        'rgba(0, 0, 0, 0.3)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        })
    },'json')





    $.post(base_url+'administrateur/dataTicketGenere',function(data){              
        $('.data').empty().append(data.total);
        var ctx = document.getElementById( "doughnut" );
        ctx.height = 100;
        var data=[data.livre,data.attente,data.annule];
        var myChart = new Chart( ctx, {
            type: 'doughnut',
            data: {
            labels:['oui','non'],
                datasets: [ {
                    data:[data.oui,data.non],
                    borderColor: "rgba(0,0,0,0.1)",
                    backgroundColor:['#3ec556','#42A5F5'],   
                            }             
                        ]
                },
            options: {
                legend: {
                    display: false
                    
                },
                cutoutPercentage: 80
            },
            elements: {
                center: {
                text: '',
                color: '#000', 
                fontStyle: 'arial', 
                sidePadding: 5 
                }
            }
        })
},'json')
    function stopload() {
        $('.jconfirm ').remove()

    }

    function alertMessage(title, message, icons, btn) {
        swal(title, message, {
            icon: icons,
            buttons: {
                confirm: {
                    className: btn
                }
            },
        })

    }


});