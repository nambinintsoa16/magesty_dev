<div class="row">
  <div class="form-group col-md-12">
    <div class="pull-right card p-2 m-0" id="search-nav">
      <form class="navbar-right navbar-form nav-search mr-md-3" action="<?= base_url('service_clientel/produit/Recherche') ?>" method="post">
        <div class="input-group">
          <input type="text" name="mot" placeholder="Rechercher ..." class="form-control">
          <div class="input-group-prepend">
            <button type="submit" class="btn btn-search ">
              <i class="fa fa-search search-icon"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card p-3">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped dataTables">
          <thead class="bg-danger text-light text-center">
            <tr>
              <th>Code produit</th>
              <th>Photo Produit</th>
              <th>Destination</th>
              <th>Quantite</th>
              <th>Prix Unitaire</th>
              <th>Famille</th>
              <th>Groupe</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="listProduit">
            <?php foreach ($produit as $produit) : ?>
              <tr>
                <td><?= $produit->Code_produit ?></td>
                <td>
                  <img class="photosclient avatar-img rounded" src="<?= code_produit_img_link($produit->Code_produit) ?>" style="width:50px;height:50px;">
                </td>
                <td><?= $produit->Designation ?></td>
                <td><?= $produit->Quantites ?></td>
                <td><?= number_format($produit->Prix_detail, 2, ",", ".") ?></td>
                <td><?= $produit->famille ?></td>
                <td><?= $produit->groupe ?></td>
                <td>
                  <a href="<?= base_url($type_user . '/Produits/Liste_des_produits/detail_produit/' . $produit->Code_produit) ?>" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <p><?= $links ?></p>
      </div>
    </div>
  </div>
</div>