$(() => {

    Table = $('.table-tombola').DataTable({
        processing: true,
        ajax: base_url + 'Operatrice/dataTombola',
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        "rowCallback": function(row, data) {

        },
        initComplete: function(setting) {

        },
        "drawCallback": function(settings) {
            dataAction();
        }
    })


    $('.genereTicket').on('click', function(e) {
        e.preventDefault()
        let codeClient = $('.codeClient').val()
        let facture = $('.factureContent').val()

        let nom = $('.nom').val()
        let prenom = $('.prenom').val()
        let dateNaiss = $('.dateNaiss').val()
        let contact = $('.contact').val()

        loding()
        $.post(base_url + 'operatrice/infofacture', { facture, nom, prenom, dateNaiss, contact }, function(data) {
            if (data.message === true) {
                //alertMessage(title, message, icons, btn)

                let dateTime = new Date()
                let date = dateTime.getFullYear() + '-' + (dateTime.getMonth() + 1) + '-' + dateTime.getDate()
                var heure = dateTime.getHours() + ":" + dateTime.getMinutes() + ":" + dateTime.getSeconds()

                let nom = $('.nom').val()
                let prenom = $('.prenom').val()
                let dateNaiss = $('.dateNaiss').val()
                let contact = $('.contact').val()
                $.post(base_url + 'Clients/updateClientpoTicket', { facture, codeClient, nom, prenom, dateNaiss, contact }, function(repUpdate) {
                    if (repUpdate) {
                        let message = repUpdate
                        $.post(base_url + 'operatrice/sauvemessage', { heure: heure, date: date, message: message, client: codeClient, id_con: data.donne.Id_discussion, page: data.donne.Page, Type: 'message', sender: 'OPL', types: 'TICKET_TOMBOLA' }, function(data) {
                            stopload()
                            Table.ajax.reload()
                            $('input').val('');
                            $('#modalImage').modal('hide')
                            alertMessage('Succé', 'Ticket génére avec success', 'success', 'btn btn-success')

                        }, 'json').fail(() => {
                            stopload()
                            alertMessage('Erreur', 'Une s’est produit veuillez recommencer', 'error', 'btn btn-danger')
                        })
                    }
                }).fail((error) => {
                    stopload()
                    alertMessage('Erreur', 'Une s’est produit veuillez recommencer', 'error', 'btn btn-danger')
                })

            }
            if (data.message === false) {
                stopload()
                alertMessage('Erreur', 'Une s’est produit veuillez recommencer', 'error', 'btn btn-danger')
            }


        }, 'json')


    })

    function dataAction() {
        $('.ticket').on('click', function(e) {
            e.preventDefault()
            let $this = $(this).parent().parent()
            let facture = $this.children().first().next().text()
            $('#exampleModalLongTitle ').empty().append('Détail facture N° <span class="factureSpan">' + facture + '</span>')
            let client = $this.children().first().next().next().text()
            $.post(base_url + 'operatrice/genereTicket', { facture, client }, function(data) {
                $('.row-content').empty().append(data)
                $('.contact').on('keyup', function() {
                    var valeur = $(this).val();
                    if (valeur.length == 9) {
                        $(this).mask("+261 99 99 999 99")

                    }
                })
                $('#modalImage').modal('show')
            })

        })
        $('.detail').on('click', function(e) {
            e.preventDefault()
            let $this = $(this).parent().parent()
            let facture = $this.children().first().next().text()
            $('#exampleModalLongTitle').empty().append('Détail facture N° ' + facture)
            $.post(base_url + 'operatrice/detailVente', { facture }, function(data) {
                $('.row-content').empty().append(data)
                $('#modalImage').modal('show')
            })

        })

    }

    $('.actualiser').on('click', function(e) {
        e.preventDefault()
        Table.ajax.reload()

    })

    function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #6f42c1;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
})