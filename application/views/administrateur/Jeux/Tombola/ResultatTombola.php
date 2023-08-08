<div class="row">
    <div class="form-group col-md-12 text-right pr-5">
        <a href="<?=base_url('operatrice/printdataTombola')?>" class="btn btn-success"><i class="flaticon-inbox"></i> EXPORT</a>
    </div>
    <div class="form-group col-md-12">
        <table class="table table-hover table-striped table-bordered w-100 table-tombola">
            <thead class="bg-<?= $nav_color ?> text-white ">
                <tr>
                    <th>N°</th>
                    <th>Facture</th>
                    <th>Code client</th>
                    <th>Compte facebook</th>
                    <th>Contact</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?= $nav_color ?>">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container p-2 row-content" style="background:#F7F3F3;">

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success genereTicket">Générer ticket</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>