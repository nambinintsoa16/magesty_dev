<div class="card w-100 bg-light ">
    <div class="card-body">
        <form method="post" action="">
            <fieldset class="border p-2  w-100">
                <legend class="w-auto">Rattacher compte ou page</legend>
                <div class="row pl-2">
                    <div class="form-group col-md-6">
                        <label for="vb" class="form-label">Matricule</label>
                        <input type="text" class="form-control Matricule"  name="Matricule">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nom" class="form-label">Nom et Prénoms Operatrice</label>
                        <input type="text" class="form-control nom"  disabled id="nom" name="Operatrice">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nomPage" class="form-label">Nom Page</label>
                        <input type="text" class="form-control nomPage" id="nomPage" name="nomPage">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lienPage" class="form-label">Lien Page</label>
                        <input type="text" class="form-control lienPage" disabled id="lienPage" name="lienPage">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="dateActivation" class="form-label">Date d'activation</label>
                        <input type="date" class="form-control date_activation" id="date_activation" name="datedactivation">
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2  w-100 mt-2">
                <div class="form-group col-md-12 text-right">
                    <button type="reset" class="btn btn-danger ">Annulé</button>
                    <button type="submit" class="btn btn-success saveNewPage">Enregistrer</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>