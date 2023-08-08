<form class="w-100 p-3" id="formulaire" style="background-color:#e2e5de;">
    <div class="row">
        <div class="col-md-4">
            <label for="codePromotion" class="form-label">Code Promotion</label>
            <input type="text" class="form-control codePromotion" id="codePromotion">
        </div>
        <div class="col-md-4">
            <label for="exampleInputPassword1" class="form-label">Type de promotion</label>
            <select name="" id="" class="custom-select typePromotion">
                <option value="cas1">CAS1</option>
                <option value="cas2">CAS2</option>
                <option value="cas3">CAS3</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="cadeaux" class="form-label">Cadeaux</label>
            <input type="text" class="form-control cadeaux" id="cadeaux">
        </div>
        <div class="col-md-4">
            <label for="prixKoty" class="form-label">Prix koty</label>
            <input type="text" class="form-control prixKoty" id="prixKoty">
        </div>
        <div class="col-md-4">
            <label for="dateDebut" class="form-label">Date de début</label>
            <input type="date" class="form-control dateDebut" id="dateDebut">
        </div>
        <div class="col-md-4">
            <label for="dateFin" class="form-label">Date fin</label>
            <input type="date" class="form-control dateFin" id="dateFin">
        </div>
        <div class="col-md-4">
            <label for="montant" class="form-label">Montant</label>
            <input type="text" class="form-control montant" id="montant">
        </div>
        <div class="col-md-8">
            <label for="produit" class="form-label">Produit</label>
            <input type="text" class="form-control produit" id="produit">
        </div>
        <div class="col-md-12">
            <label class="form-check-label" for="description">Décription</label>
            <textarea name="description" id="description" cols="30" rows="10" class=" w-100 description"></textarea>
        </div>
        <div class="col-md-12 p-3 text-right">
            <button type="submit" class="btn btn-primary save">Enregistrer</button>
        </div>
    </div>
</form>