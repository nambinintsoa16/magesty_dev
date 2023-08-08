$(document).ready(function () {
    Table = $(".table_rapport1").DataTable({
        processing: true,
        ajax: base_url + "Administrateur/Mouvement_smile/?Code_client=&date=",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        "drawCallback": function (settings) {
            $('.deleteSmile').on('click', function (e) {
                a
                e.preventDefault();
                $.get($(this).attr('href'), function (data) {
                    Table.ajax.reload();
                    swal("Succes", "Transaction supprimer avec succer", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn-success"
                            }
                        },

                    });

                });

            });
        }
    });
});