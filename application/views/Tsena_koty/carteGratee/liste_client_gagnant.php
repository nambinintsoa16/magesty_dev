<div class="modal-body ">
  <div class="row">
    <div class="col-md-12">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead style="background:#007bff;color: #fff;">
              <tr>
                <th>Code Client</th>
                <th>Nom </th>
                <th>Numéro Tirage</th>
                <th>Code carte </th>
                <th>Designation Carte </th>
                <th>Date de tirage </th>
                <th> Info</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $value): ?>
                <tr>
                  <td><?= $value->code_gagnant?></td>
                  <td><?= $value->Compte_facebook?></td>
                  <td><?= $value->numero_tirage?></td>
                  <td><?= $value->code_carte ?></td>
                  <td><?= $value->designation?></td>
                  <td><?= $value->Date_de_tirage?></td>
              </tr>
              <?php endforeach ?> 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>