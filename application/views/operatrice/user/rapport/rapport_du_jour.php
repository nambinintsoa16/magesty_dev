<div class="container overflow-hidden">
    <div class="row gx-5">
        <div class="col">
            <div class="p-3 border bg-primary text-white">Rapport de vente</div>
        </div>
        <div class="col">
            <div class="p-3 border bg-success text-white">Rapport de livraison</div>
        </div>
        <div class="col">
            <div class="p-3 border bg-danger text-white">Rapport d'annulation</div>
        </div>
    </div>
</div>
<div class="container">
    <fieldset class="border p-2">
        <legend class="w-auto"><?= dateDuJour() ?> </legend>
        <div class="row">

            <div class="form-group col-md-4">
                <p class="alert alert-danger">
                    <label for="envoi">veuillez vérifier les donne avant d'envoyer</label>

                    <a href="<?= base_url('user/send_rapport_du_jour') ?>" class="btn btn-warning" id="envoi">
                        Envoyer email
                    </a>
                </p>
            </div>
            <div class="form-group col-md-4">
                <label>Filtre par mois</label>
                <select class="form-control">
                    <option hidden></option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Filtre par date</label>
                <input type="date" class="form-control custom-select">
            </div>
            <div class="form-group col-md-12">

                <table class="table table-striped table-bordered w-100 mt-4 text-center">
                    <thead class="bg-info text-white">
                        <tr>
                            <th>Photo</th>
                            <th>Compte facebook</th>
                            <th>Produit</th>
                            <th>Date de livraison OP</th>
                            <th>Date de livraison SL</th>
                            <th>Remarque OP</th>
                            <th>Remarque SL</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
</div>
<fieldset>
    </div>