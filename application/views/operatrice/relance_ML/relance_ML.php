<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <div class="input-group mb-3 w-25">
                <input id="searchDateInput" type="date" class="form-control" placeholder="Recipient's username">
                <div class="input-group-append">
                    <button id="searchButton" class="btn btn-primary" type="button" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Fonction pour activer ou désactiver le bouton en fonction de la valeur du champ de date
        function toggleSearchButton() {
            var searchDate = $("#searchDateInput").val();
            $("#searchButton").prop("disabled", !searchDate);
        }

        // Ajoutez un écouteur d'événements sur le champ de date
        $("#searchDateInput").on("input", toggleSearchButton);

        // Ajoutez un écouteur d'événements sur le bouton de recherche
        $("#searchButton").click(function () {
            var searchDate = $("#searchDateInput").val();
            alert("Recherche pour la date : " + searchDate);
        });

        // Initialisez l'état du bouton au chargement de la page
        toggleSearchButton();

        $("#searchButton").click(function () {
            // Récupérez la valeur du champ de date
            var searchDate = $("#searchDateInput").val();

            // Effectuez la recherche ou effectuez toute autre logique que vous souhaitez ici
            alert("Recherche pour la date : " + searchDate);
        });
    });
</script>