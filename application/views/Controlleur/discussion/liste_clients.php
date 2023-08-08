<div class="form-group">

    <table class="table table-light dataTable table_listeclient">
        <thead class="thead-light">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">CODE CLIENT</th>
                <th class="text-center">NOM DU CLIENT</th>
                <th class="text-center">STATUS</th>
                <th class="text-center">ST</th>
            </tr>
        </thead>
        <tbody class="tbody">

            <?php foreach ($data as $data) : ?>
                <tr>
                    <td></td>
                    <td><?= $data['Code_client'] ?></td>
                    <td class="text-center">
                        <a href="<?= base_url('Controlleur/details_discussion/' . $user . "/" . $data['client']) ?>" class='link1 details'><?= $data['detail']->Nom ?></a>
                    </td>
                    <td class='text-center statut'><?= $data['statut'] ?></td>
                    <td class="text-center type"><input class="form-control" type="text" placeholder=""></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>