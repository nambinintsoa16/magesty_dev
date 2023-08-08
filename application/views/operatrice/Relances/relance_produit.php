<form class="col-md-12">
  <fieldset class="border p-1">
    <legend class="w-auto"><b class="text-sm">
        LISTE DES RELANCES PAR PRODUITS</b>
    </legend>
    <!-- <div class="row col md-12">
      <div class="col md-4">Nombre clients:  </div>
      <div class="col md-4"> Traités: </div> 
      <div class="col md-4">Non traités: </div>
    </div>    -->
  </fieldset>
</form>
<div class="row">
  <div class="form-group contentTable table-striped  table-responsive">
    <span class="date_collapse collapse"></span>
    <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTables">
      <thead class="bg-<?= $nav_color ?> text-white">
        <tr>
          <th class="text-center">Code client</th>
          <th class="text-center">Nom client</th>
          <th class="text-center">Page / Compte</th>
          <th class="text-center">Date de livraison</th>
          <th class="text-cente">Produit</th>
          <th class="text-cente">Type</th>
          <th class="text-center">Status</th>
          <th class="text-center"></th>

        </tr>
      </thead>
      <tbody class="tbody">
      </tbody>
    </table>
  </div>
</div>