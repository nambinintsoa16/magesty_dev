 <div class="card">
        <div class="card-body">
            <h2>Export liste livraison </h2>    
            <hr>     
            <form class="form-group" method="POST" action="Vente_annuel">
              <div class="row">
                <div class="col-md-5">
                  <label for="date_debut">Date Livraison</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                    <input type="date" class="form-control" id="date_livre">
                  </div>                                
                </div>
                <div class="col-md-5">
                  <label for="date_debut">Statut livraison à exporter</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                   <select class="form-control " id="statut">
                    <option value="" class="collapse"></option>
                     <option value="en_attente">En attente</option>
                     <option value="confirmer">Confirmer</option>
                     <option value="annule">Annuler</option>
                     <option value="livre">Livrer</option>
                    <option value="repporter">Repporter</option>
                   </select>
                  </div>  
                </div>
                <div class="col-md-2">
                  <br>
                  <button class="mt-1 btn btn-primary valider_exporter" style="width: 100%;">Valider</button>
                </div>
              </div>
          </form>
          <hr>
          <div class="row livraison_exporte_provisoire pl-3 pr-3">
  
          </div>
  </div>
</div>


