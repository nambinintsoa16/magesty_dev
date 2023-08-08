<span class="badge badge-primary badg">Total chiffres d'affaires: &nbsp<?php echo number_format($data['caT'], 0, ',', ' ') ?>&nbsp Ar</span>
<hr>
<span class="badge badge-primary badg">Total produits: &nbsp<?php echo $data['pro'] ?> &nbsp<a href="" class="linka produit"><i class="fa fa-plus"></i></a></span>
<div class="container">
    <div class="row col-2 pl-0">
        <div class="col-12 pl-0">
            <table class="table table-hover dataTable table1" style="width:100%;margin-left:0px;padding-left:20px">
                <thead>
                    <tr style="font-size:12px">
                        <th class="collapse"></th>
                        <th style="width:80px" scope="col">OPL</th>
                        <th style="width:80px" scope="col">Nom page</th>
                        <th scope="col">Montant</th>
                        <th style="width:60px" scope="col">Nbr de produits</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?= $data['data'] ?>
                </tbody>

            </table>
        </div>
    </div>
</div>