<div class="row">

    <div class="form-group col-md-12">
        <table class="table table-hover table-striped table-bordered w-100 table-parametre">
            <thead class="bg-<?= $nav_color ?> text-white ">
                <tr>
                    <th>Id</th>
                    <th>Désignation</th>
                    <th>Date d'activation</th>
                    <th>Produit</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Date désactivation</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalModif" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?= $nav_color ?>">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container p-2 row-content" style="background:#F7F3F3;">
                    <div class="row">
                    <div class="form-group col-md-6">
                            <label for="produit">Id parametre</label>
                            <input type="text" name="" id="" class="form-control form-control-sm idParametreModal" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="produit">Désignation</label>
                            <input type="text" name="" id="" class="form-control form-control-sm Designation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="produit">Montant</label>
                            <input type="number" name="" id="" class="form-control form-control-sm Montant">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="produit">Produit</label>
                            <input type="text" name="" id="" class="form-control form-control-sm produit">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning modifierParametre">Modifier</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>