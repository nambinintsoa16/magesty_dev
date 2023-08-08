$(document).ready(function(){

    $('.btn-statut-retrait').on('click', function (e) {
        e.preventDefault();
        var idLivraison = $(this).attr('id');
        $.confirm({
            title: '<p class="text-center">Entre nouveau frais de retrait</p>',
            content: '<input type="text" class="form-control retrait">',
            buttons: {
                formSubmit: {
                    text: 'confirmer',
                    btnClass: 'btn-success',
                    action: function () {
                        let frais = this.$content.find('.retrait').val();
                        $.post(base_url + 'Administrateur/modifFraisLivre', { frais: frais, idLivraison: idLivraison }, function (data, textStatus, xhr) {
                           $('.fraisRetrait').val(frais);
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
    });


 $('.editRemarqueOperatrice').on('click',function (e) {
        e.preventDefault()
        $('#remarqueModal').modal('show')
    })
    $('.enregistreRemarque').on('click',function(e){
        e.preventDefault()
        let facture = $(this).attr('id')
        let remarque = $('#remarque-text').val()
        $.post(base_url+'operatrice/saveRemarqueOpl',{facture,remarque},function (data) {
            $('#remarqueModal').modal('hide')
            alertMessage("Succè", "Modification éffectué avec succés. Veuillez actualisé la page.", "success", "btn btn-success")
        })
    })

    $('.modifrais').on('click', function (e) {
        e.preventDefault();
        var idLivraison = $(this).attr('id');
        $.confirm({
            title: '<p class="text-center">Entre nouveau frais</p>',
            content: '<input type="text" class="form-control frais">',
            buttons: {
                formSubmit: {
                    text: 'confirmer',
                    btnClass: 'btn-success',
                    action: function () {
                        let frais = this.$content.find('.frais').val();
                        $.post(base_url + 'Administrateur/modifFrais', { frais: frais, idLivraison: idLivraison }, function (data, textStatus, xhr) {
                            $('.fraisInput').val(frais);
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

});