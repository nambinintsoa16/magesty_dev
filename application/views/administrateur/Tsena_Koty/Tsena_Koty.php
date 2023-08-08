<fieldset class="border w-100 p-2 rounded shadow-sm" style="background-color:#e2e5de;">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="client">Client</label>
                <input type="text" class="form-control form-control-sm client" name="client" id="client">
            </div>
            <div class="form-group col-md-4">
                <label for="koty">Koty</label>
                <select class="custom-select koty form-control-sm">
                    <?php foreach($bonus as $bonus):?>
                    <option value="<?= $bonus->Gain?>"><?= $bonus->Type?></option>
                    <?php endforeach?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="type">Type</label>
                <select class="custom-select type" id="type" name="type">
                    <option value="achat">ACHAT</option>
                    <option value="gain">GAIN</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="raison">Raison</label>
                <select class="custom-select raison form-control-sm" id="raison" name="raison">
                    <option value="bonus">Bonus</option>
                    <option value="achat">Achat</option>
                    <option value="vente">Vente</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="date_expir">Date expiration</label>
                <input type="date" class="form-control form-control-sm date_expir form-control-sm" name="date_expir" id="date_expir">
            </div>
            <div class="form-group col-md-12">
                <label for="observation">Observation</label>
                <textarea class="form-control observation" id="observation" name="observation" rows="3"></textarea>
            </div>
            <div class="form-group col-md-12">
                <button type="button" data-toggle="button"
                    class="btn btn-primary btn-lg pull-right ajout_bonus">  <i class="fa fa-save"></i>&nbsp; Ajouter</button>
            </div>

        </div>

</fieldset>