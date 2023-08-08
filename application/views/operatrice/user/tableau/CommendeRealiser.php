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