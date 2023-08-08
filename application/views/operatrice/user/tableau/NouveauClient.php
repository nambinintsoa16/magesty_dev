<h2> <?= dateDuJour() ?></h2>
<div class="responsive w-100 p-0">
  <table class="table table-striped table-bordered  w-100 mt-4 text-center">
    <thead class="bg-warning text-white">
      <tr>
         <th>Photo</th>
        <th>Code client</th>
        <th>Nom et Prénom</th>
        <th>Contact</th>
        <th>Identifient sur facebook</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $data) : ?>
        <tr>
        <td>
            <img class="photosclient avatar-img rounded" alt="<?=$data->Code_client?>" src="<?= code_client_img_link($data->Code_client) ?>"  width="75" height="75">
          </td>
          <td><?= $data->Code_client ?></td>
          <td><?= $data->Nom . " " . $data->Prenom ?></td>
          <td><?= $data->Contact ?></td>
          
          <td><?= $data->Compte_facebook ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script>
  $(() => {
    $('.table').dataTable({
      processing: true,
      language: {
        url: base_url + "assets/dataTableFr/french.json"
      }
    })
  })
</script>