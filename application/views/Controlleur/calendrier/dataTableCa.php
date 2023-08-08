<table class="table dataTable table-striped table-advance table-hover" id="tableau">
  <thead>
    <tr style="background:<?= $color ?>">
      <th style="color:white">OPL</th>
      <th style="color:white">Client</th>
      <th style="color:white">Photos</th>
      <th style="color:white"> Date de livraison</th>
      <th style="color:white">Produit</th>
      <th style="color:white">Somme</th>
      <th style="color:white">Lieu de livraison</th>
      <th style="color:white"> </th>
      <th> </th>
    </tr>
  </thead>
  </thead>
  <tbody class="listLivraisonAnnullee">
    <?php foreach ($data as $data) : ?>
      <tr>
        <td><?= substr($data['user'], 0, 7) ?></td>
        <td><?= $data['infoclient']->Nom . " " . $data['infoclient']->Prenom ?></td>
        <td><img src="<?= base_url('images/client/' . $data['code_client']) ?>.jpg" width="50" height="50px" style="border-radius: 50%"></td>

        <td><?= $data['date_de_livraison'] ?></td>
        <td><?= $data['produit'] ?></td>
        <td><?= $data['ca'] ?> Ar</td>
        <td><?= $data['Ville'] . " " . $data['Quartier'] ?></td>




        <td>
          <?php if (!empty($data['remarque'])) : ?>
            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#<?= $data['link'] ?>">
              <i class="fa fa-flag"></i>
            </button>
          <?php endif; ?>
          <div class="modal fade" id="<?= $data['link'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?= $data['remarque'] ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>


        </td>
        <td>
          <a class="btn btn-info" href="<?= base_url('operatrice/detail_de_facture/' . $data['facture']) ?>"> <i class="fa fa-info"></i>

        </td>


      </tr>
    <?php endforeach; ?>
  </tbody>
</table>