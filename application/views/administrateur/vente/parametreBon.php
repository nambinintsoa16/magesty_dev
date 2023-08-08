<div class="container">
    <div class="row">
        <div class="form-group col-md-12 text-rigth">
            <a class="btn btn-primary text-white btn-sm nouveauBonDachat">NOUVEAU BON D'ACHAT</a>
        </div>
        <div class="form-group col-md-12">
            <table class="table table-hover table-streptid table-bordered table-bon-parametre">
                <thead class="text-white bg-success">
                    <tr>
                        <th>ID</th>
                        <th>DATE DE CREATION</th>
                        <th>DERNIER MISE A JOUR</th>
                        <th>DESIGNATION</th>
                        <th>VALEUR</th>
                        <th>VALEUR EN LETTRE</th>
                        <th>STATUT</th>
                        <th>DATE DESACTIVATION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modaleBon" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">NOUVEAU BON D'ACHAT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Désignation</label>
                            <input type="text" class="form-control designation form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Valeur en lettre</label>
                            <input type="text" class="form-control lettre form-control-sm">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Valeur</label>
                            <input type="number" class="form-control valeur form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary enregistre">Enregistrer</button>
            </div>
        </div>
    </div>
</div>