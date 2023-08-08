
  <div class="row p-2">
    <div class="form-group col-md-12 pl-5">
      <p><u>Résultat trouvé pour</u> : <b>"<?= $resultat ?>"</b></p>
    </div>
    <div class="form-group col-md-12">
    <table class="table table-bordered table-hover tableClient table-striped dataTables w-100">
      <thead class="bg-<?= $nav_color ?> text-light text-center">
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
  </div>
