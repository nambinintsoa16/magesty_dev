 <table class="w-100 table-hover table-striped table-bordered table-bordered table-detailFacture table">
        <thead class="bg-info text-white">
            <tr>
                <th>DATE</th>
                <th>FACTURE</th>
                <th>PRODUIT</th>
                <th>QUANTITE</th>
                <th>PRIX</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $data): ?>
            <tr>
                <td><?=$data->Date?></td>
                <td><?=$data->Id_facture?></td>
                <td><?=$data->Code_produit?></td>
                <td><?=$data->Quantite?></td>
                <td><?=$data->Prix_detail?></td>
                <td><?=number_format($data->Quantite * $data->Prix_detail, 2, ',', ' ')?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<script>
    $(()=>{
        $('.table-detailFacture').DataTable({
            processing: true,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            }
        })
    })
    
</script>
