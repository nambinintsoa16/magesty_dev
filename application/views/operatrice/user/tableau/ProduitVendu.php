<h2> <?= dateDuJour() ?></h2>
<div class="responsive w-100 p-0">
    <table class="table table-striped mt-4 table-bordered  w-100 ">
        <thead class="bg-danger text-white" id="headTable">
            <tr>
                <th>Code produit</th>
                <th>Désignation</th>
                <th>Image</th>
                <th>Status</th>
                <th>Quantite</th>
                <th>P.U</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $data) : ?>
                <tr>
                    <td><?= $data->Code_produit ?></td>
                    <td><?= $data->Designation ?></td>
                    <td>
                        <img class="photosclient avatar-img rounded" alt="<?=$data->Code_produit?>" src="<?= code_produit_img_link($data->Code_produit) ?>"  width="75" height="75">
                    </td>
                    <th><?= strtoupper( str_replace("_"," ", $data->Status)) ?></th>
                    <td><?= $data->Quantite ?></td>
                    <td><?= number_format($data->Prix_detail, 2, ',', ' ') ?></td>
                </tr>
            <?php endforeach ?>
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