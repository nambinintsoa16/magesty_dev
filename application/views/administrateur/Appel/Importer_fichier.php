<div class="p-2 pl-3 w-100">
    <fieldset class="border p-2 w-100 mb-2">

        <div class="row">
            <div class="form-group col-md-6">
                <div class="form-check">
                    <label>Type</label><br />
                    <label class="form-radio-label">
                        <input class="form-radio-input" type="radio" name="optionsRadios" value="" checked="">
                        <span class="form-radio-sign">Client</span>
                    </label>
                    <label class="form-radio-label ml-3">
                        <input class="form-radio-input" type="radio" name="optionsRadios" value="">
                        <span class="form-radio-sign">Rendez-vous</span>
                    </label>
                    <label class="form-radio-label ml-3">
                        <input class="form-radio-input" type="radio" name="optionsRadios" value="">
                        <span class="form-radio-sign">Client SAV</span>
                    </label>
                    <label class="form-radio-label ml-3">
                        <input class="form-radio-input" type="radio" name="optionsRadios" value="">
                        <span class="form-radio-sign">Client curieux</span>
                    </label>
                </div>
            </div>
            <div class="form-group col-md-6 d-flex flex-nowrap">
                <label for="operatrice" class="align-self-center mr-2">Opérartrice :</label>
                <input type="text" class="form-control operatrice align-self-center" name="operatrice">
                <button type="submit" class="btn btn-success recherche align-self-center mx-2"><i class="fa fa-tv"></i>&nbsp;
                    Afficher</button>
            </div>
        </div>
    </fieldset>
    <fieldset class="border p-2 w-100">
        <legend class="w-auto">Importer votre fichier</legend>
        <div class="form-group col-md-12">
            <label for="exampleFormControlFile1">Importer votre fichier</label>
            <input type="file" class="form-control-file fichier" id="exampleFormControlFile1" name="file">
        </div>
    </fieldset>
    <fieldset class="border p-2 w-100 mt-2">
        <div class="form-group col-md-12 text-right">
            <button type="submit" class="btn btn-success">Enregistré</button>
            <button type="reset"  class="btn btn-danger">Annulé</button>
        </div>
    </fieldset>
    
    <fieldset class="border p-2 w-100 mt-2">
        <div class="form-group col-md-12 ">
            <table class="table table-striped table-hover dataTableResult">
                <thead class="bg-<?= $nav_color ?> text-white">
                    <tr>
                        <td>Code cleint</td>
                        <td>Compte facebook</td>
                        <td>Lien facebook</td>
                        <td>Contact</td>
                        <td>Statut</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>