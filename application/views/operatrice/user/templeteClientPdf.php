<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
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

</body>
</html>