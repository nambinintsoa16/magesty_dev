$(document).ready(function(){
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
})