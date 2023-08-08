$(document).ready(function () {
    CKEDITOR.replace('description');
    $('.save').on('click', function (e) {
        e.preventDefault();
        var codePromotion = $('.codePromotion').val();
        var typePromotion = $('.typePromotion').val();
        var cadeaux = $('.cadeaux').val();
        var prixKoty = $('.prixKoty').val();
        var dateDebut = $('.dateDebut').val();
        var dateFin = $('.dateFin').val();
        var montant = $('.montant').val();
        var produit = $('.produit').val();
        var description = $('.description').val();
        let rep = true;
        $('.form-control').each(function () {
            if ($(this).val() === "") {
                let text = $(this).attr('id');
                alertMessage("Erreur", "Champ " + text + " est vide", "error", "btn btn-danger");
                return rep = false;
            }
        });
        if (rep === true) {
            $.post(base_url + "Administrateur/insertNewPromotion", {
                codePromotion: codePromotion, typePromotion: typePromotion, cadeaux: cadeaux, prixKoty: prixKoty, dateDebut: dateDebut,
                dateFin: dateFin, montant: montant, produit: produit, description: description
            }, function (data) {
                alertMessage("Succé", "Insertion avec succés", "success", "btn btn-success");
                $(".form-control").val("");
                $('.description').val("");
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
});