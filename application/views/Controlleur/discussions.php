<div class="row mt-2">
    <div class="col-md-12">
        <hr style="border:solid 1px #ccc">
        <table class="table dataTable table-striped table-border">
            <thead class="thead-light" style="color:#fff">
                <tr>
                    <th class="text-center">OPL</th>
                    <th class="text-center">PAGE</th>
                    <th class="text-center">DISCUSSIONS EN ATTENTE</th>
                    <th class="text-center">DISCUSSIONS A SUIVRE</th>
                    <th class="text-center">DISCUSSIONS TERMINEES</th>
                    <th class="text-center">TOTAL DISCUSSIONS</th>
                    <th class="text-center">DETAIL</th>

                </tr>
            </thead>

            <tbody class="tbody">
                <?= $data ?>
            </tbody>
        </table>
    </div>
</div>
<span class="date_collapse collapse"> <?php echo date('Y-m-d'); ?></span>