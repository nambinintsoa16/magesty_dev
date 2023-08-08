<div class="card mx-auto w-50">
    <div class="card-body">
        <form action="">
            <div class="form-group">    
                <label for="client">Client</label>
                <input type="text" class="form-control client" name="client" id="client" value="<?=$data->Client?>">
            </div>
            <div class="form-group">    
                <label for="koty">Koty</label>
                <input type="text" class="form-control koty"  name="koty" id="koty" value="<?=$data->Koty?>">
            </div>
            <div class="form-group">    
                <label for="type">Type</label>
                    <select class="custom-select type" id="type" name="type">
                        <option value="sortie">Sortie</option>
                        <option value="entre">Entrée</option>
                    </select>
            </div>
            <div class="form-group">    
                <label for="raison">Raison</label>
                <select class="custom-select raison " id="raison" name="raison">
                    <option value="bonus">Bonus</option>
                    <option value="achat">Achat</option>
                    <option value="vente">Vente</option>
            </select>
            </div>
            <div class="form-group">    
                <label for="observation">Observation</label>
                <textarea class="form-control observation" id="observation" name="observation" rows="3" value="<?=$data->Observation?>"></textarea>
            </div>
            <div class="form-group">    
                <label for="date_expir">Date expiration</label>
                <input type="date" class="form-control date_expir"  name="date_expir" id="date_expir">
            </div>
            <button type="button" data-toggle="button" class="btn btn-primary btn-lg pull-right ajout_bonus">Modifier</button>
        </form>
    </div>
</div>