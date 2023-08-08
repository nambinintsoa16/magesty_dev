<div class="container">
    <div class="row">
        <div class="card w-100 bg-light">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group col-md-12">
                        <label for="vb" class="form-label">Nom Page</label>
                        <input type="text" class="form-control nomPage" id="nomPage" >
                    </div>
                    <div class=" form-group col-md-12">
                        <label for="nom" class="form-label">Lien Page</label>
                        <input type="text" class="form-control lienPage" id="lienPage" >
                    </div>
                    <div class="form-group">
                        <label for="type">Type Compte</label>
                        <select class="form-control typeCompte" id="typeCompte">
                            <option>page</option>
                            <option>compte</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Source</label>
                        <select class="form-control source" id="source">
                            <option>Facebook</option>
                            <option>Instagram</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="dateActivation" class="form-label">Date d'activation</label>
                        <input type="date" class="form-control date_activation" id="date_activation">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary saveNewCompte">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


