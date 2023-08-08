<div class="row">
    <div class="responsive w-100">
        <table class="table table-striped mt-4 table-bordered w-100 text-center">
            <thead class="bg-info text-white" id="headTable">
                <tr>
                    <th>Code client</th> 
                    <th>Code produit</th> 
                    <th>Désignation</th>
                    <th>Quantite</th>
                    <th>P.U</th>
                    <th>Total</th>
                </tr>
            </thead>
                <tbody>
                     <?php $total = 0;foreach ($data as $key => $data):?>
                        <tr>
                            <td><?=$data->Code_client?></td>
                            <td><?=$data->Code_produit?></td>
                            <td><?=$data->Designation?></td>
                            <td><?=$data->Quantite?></td>
                            <td><?=number_format($data->Prix_detail, 2, ',', ' ')?></td>
                            <td><?=number_format($data->Prix_detail*$data->Quantite, 2, ',', ' ')?></td>
                        </tr>
                     <?php $total += ($data->Prix_detail*$data->Quantite);  endforeach?>
                </tbody>
                 <tfoot >
                    <tr>
                         <td colspan="5">TOTAL</td>
                         <td><?=number_format($total, 2, ',', ' ')?></td>
                    </tr>
                </tfoot>
        </table>
    </div>
</div>    
