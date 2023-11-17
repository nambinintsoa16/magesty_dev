<div class="container-fluid">
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Information sur l'observation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="observationInfo">
                        <li>
                            <b>Compte:</b> <span class="account"></span>
                        </li>
                        <li>
                            <b>Centre d'interet:</b> <span class="news"></span>
                        </li>
                        <li>
                            <b>Appreciation de l'oplg:</b> <span class="appreciation"></span>
                        </li>
                        <li>
                            <b>Contraintes du client:</b> <span class="constraint"></span>
                        </li>
                        <li>
                            <b>Nombre de produits:</b> <span class="products"></span>
                        </li>
                        <li>
                            <b>Nombre de refus:</b> <span class="refusals"></span>
                        </li>
                        <li>
                            <b>Nombre d'achat:</b> <span class="purchase"></span>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div>
                <button id="refresh" class="btn btn-light" type="button">
                    <i class="fa fa-refresh"></i>
                </button>
            </div>
            <div class="input-group mb-3 w-25">
                <input id="searchDateInput" type="date" class="form-control" placeholder="Recipient's username">
                <div class="input-group-append">
                    <button id="searchButton" class="btn btn-primary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div id="table-container" class="table-responsive">
                <div class="spinner d-flex justify-content-center align-items-center m-0 h-100" style="display: none;"><i class="fas fa-spinner fa-spin"></i></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<!-- DataTables French Language -->
<script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/json/fr-FR.json'); ?>"></script>
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script>
    async function displayTable(data) {
        var table = '<table id="observation-table" class="table table-sm table-hover">';
        table += '<thead><tr><th>Code client</th><th>Nom</th><th>Localisation</th><th>Date</th><th>Date de relance</th><th>Info</th></tr></thead><tbody>';

        // Ajoutez chaque observation au tableau
        $.each(data, function(index, observation) {
            let obsDate = observation.date != null ? observation.date.substring(0, 10) : '';
            let obsDateRelance = observation.date_relance != null ? observation.date_relance.substring(0, 10) : '';
            table += '<tr>';
            table += '<td>' + observation.code_client + '</td>';
            table += '<td>' + observation.Compte_facebook + '</td>';
            table += '<td>' + observation.client_localisation + '</td>';
            table += '<td>' + obsDate + '</td>';
            table += '<td>' + obsDateRelance + '</td>';
            table += '<td>' + '<button class="btn btn-sm btn-info-modal" id=\''+index+'\' type="button" data-observation=\'' + JSON.stringify(observation) + '\'><i class="fa fa-info"></i></button>' + '</td>';
            table += '</tr>';
        });

        table += '</tbody></table>';

        $('#table-container').html(table);
        $('#observation-table').DataTable({
            language: {
                url: "<?php echo base_url('assets/json/fr-FR.json'); ?>"
            }
        });
    }
    // Fonction pour activer ou désactiver le bouton en fonction de la valeur du champ de date
    function toggleSearchButton() {
        var searchDate = $("#searchDateInput").val();
        $("#searchButton").prop("disabled", !searchDate);
    }

    function showObservationInfo(observation) {
        // Remplissez le contenu du modal avec les informations de l'observation
        $('#observationInfo .account').text(observation.Compte_facebook || 'N/A');
        $('#observationInfo .news').text(observation.news || 'N/A');
        $('#observationInfo .appreciation').text(observation.description_appreciation || 'N/A');
        $('#observationInfo .constraint').text(observation.description_customer || 'N/A');

        // Si observation.products existe, divisez-le par '/' et créez une liste ordonnée
        if (observation.products) {
            var productsList = observation.products.split('/').map(function (product) {
                return '<div><li>' + product.trim() + '</li></div>';
            });

            // Ajoutez une classe à l'élément <ol> pour le cibler avec du CSS
            $('#observationInfo .products').html('<ol>' + productsList.join('') + '</ol>');
        } else {
            $('#observationInfo .products').html('<span>N/A</span>');
        }

        $('#observationInfo .refusals').text(observation.number_of_refusals || 'N/A');
        $('#observationInfo .purchase').text(observation.purchase_number || 'N/A');
        // Affichez le modal
        $('#infoModal').modal('show');
    }

    $(document).ready(function () {

        $.get(
			base_url + "operatrice/getAllObservations",
			function (data) {
                $('.spinner').show();
                displayTable(data);
                $('.spinner').hide();
			}
		);

        // Ajoutez un écouteur d'événements sur le champ de date
        $("#searchDateInput").on("input", toggleSearchButton);

        // Ajoutez un écouteur d'événements sur le bouton de recherche
        $("#searchButton").click(function () {
            var searchDate = $("#searchDateInput").val();
            $.get(
                base_url + "operatrice/getAllObservationsByDateRelance?searchDate="+searchDate,
                function (data) {
                    $('.spinner').show();
                    displayTable(data);
                    $('.spinner').hide();
                }
		    );
        });

        // Ajoutez un écouteur d'événements sur le bouton de recherche
        $("#refresh").click(function () {
            var searchDate = $("#searchDateInput").val();
            $.get(
                base_url + "operatrice/getAllObservations",
                function (data) {
                    $('.spinner').show();
                    displayTable(data);
                    $('.spinner').hide();
                    $('#searchDateInput').val("");
                }
		    );
        });

        $('#table-container').on('click', '.btn-info-modal', function() {
            // Récupérez les informations de l'observation à partir de l'attribut data-observation
            var observationData = $(this).data('observation');
            var observation = typeof observationData === 'object' ? observationData : JSON.parse(observationData);
            showObservationInfo(observation);
        });

        // Initialisez l'état du bouton au chargement de la page
        toggleSearchButton();
    });
</script>