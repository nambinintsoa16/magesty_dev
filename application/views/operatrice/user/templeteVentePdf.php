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
    <table class="table table-striped mt-4 table-bordered w-100 text-center">
        <thead class="bg-info text-white" id="headTable">
            <tr>
                <th>Client</th>
                <th>Code produit</th>
                <th>Désignation</th>
                <th>Quantite</th>
                <th>P.U</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0;
            foreach ($data as $key => $data) : ?>
                <tr>
                    <td><img src="<?= code_client_img_link($data->Code_client) ?>" alt="<?=$data->Code_client?>" class="img-thumbnail" width="75" height="75"></td>
                    <td><?= $data->Code_produit ?></td>
                    <td><?= $data->Designation ?></td>
                    <td><?= $data->Quantite ?></td>
                    <td><?= number_format($data->Prix_detail, 2, ',', ' ') ?></td>
                    <td><?= number_format($data->Prix_detail * $data->Quantite, 2, ',', ' ') ?></td>
                </tr>
            <?php $total += ($data->Prix_detail * $data->Quantite);
            endforeach ?>
        </tbody>
        <tfoot class="bg-info  text-white">
            <tr>
                <td colspan="4">TOTAL</td>
                <td colspan="2"><?= number_format($total, 2, ',', ' ') ?></td>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>