<fieldset class="border p-2 w-100 rounded shadow-sm"style="background-color:#e2e5de;" >
    <div class="row">
        <div class="form-group col-lg-5">
            <label for="client1">Client</label>
            <input type="text" class="form-control client1" name="client1" id="clien1t">
        </div>
        <div class="form-group col-lg-5">
            <label for="date_expir1">Date expiration</label>
            <input type="date" class="form-control date_expir1" name="date_expir1" id="date_expir1">
        </div>
        <div class="form-group col-lg-2 pt-4">
            <a href="#" class="btn btn-success  afficher_client mt-3 w-100"><i class="fa fa-tv"></i> &nbsp;Afficher</a>
        </div>

    </div>
</fieldset>
<fieldset class="border p-2 w-100 mt-2 rounded shadow-sm" style="background-color:#e2e5de;">
    <table class="table table-light  table-hover table-bordered table_rapport">
        <thead class="bg-success text-white">
            <tr>
                <th>Date</th>
                <th>Client</th>
                <th>Type</th>
                <th>Koty</th>
                <th>Raison</th>
                <th>Facture</th>
                <th>Observation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</fieldset>

<div class="modal fade" id="infoModale" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-info"></i>&nbsp;Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        Code client :<span class="code"> </span>
                     </div>
                    <div class="form-group col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Code produit</th>
                                    <th>Désignation</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Total</th>
                                </tr>

                            </thead>
                            <tbody class="tbody tbody-data">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>

            </div>
        </div>
    </div>
</div>