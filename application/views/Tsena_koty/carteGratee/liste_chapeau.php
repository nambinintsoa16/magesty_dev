<table class="table table_chapeau">
    <span class="level_client collapse"><?php echo $chapeau; ?></span>
    <thead  style="color: #fff; background: <?php echo $bg_head ?>;" >
        <tr>
          	<th>Code Carte</th>
          	<th>Designation Carte</th>
            <th>Images</th>
          	<th>Nombre Carte Totale  </th>
          	<th>Nombre de carte tirées</th>
          	<th>Nombre de carte disponible</th>
          	<th>Info</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($liste_lot as  $value): ?>
        <tr>
            <td><?= $value->code_carte?></td>
          	<td><?= $value->designation?></td>
            <td><img src="<?=base_url()?>images/cartegratter/<?= $value->code_carte ?>.png" class="card-img-top" style="width: 100%;margin:auto;height:40px;" alt="<?=$value->code_carte?>">  </td>
          	<td><?php $nbr_toal = $value->Total ; echo $nbr_toal?></td>

          	<td class="terer_client" id="<?php  $value->code_carte?>" ><a href="#" class="level_cart" id="<?= $value->code_carte ?>" > <?php $nombre_tirer = $this->global_model->Retourner_nombre_lot_tirer_parproduit($value->code_carte,$chapeau);
                $nbr_tirer = $nombre_tirer->lot_tirer; echo $nbr_tirer ?></a></td>
          	<td><?php echo $nbr_toal-$nbr_tirer?></td>
          	<td></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<!-- Modal de  liste client qui ont gagner -->
<div class="modal fade" id="Liste_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Client Gagnant </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="liste_client_gagnant">
        
      </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
    </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    var Table = $(".table_chapeau").DataTable({
        searching: true,
        ordering: true,
        paging: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },

    });

    
    $('.level_cart').on('click',function(){
        var code_carte = $(this).attr('id');
        var level = $('.level_client').text();
        $.post(base_url + 'CarteGratee/Liste_client_gagnat',{code_carte:code_carte,level:level},function(data){
              $('#Liste_client').modal('show') ;
              $('.liste_client_gagnant').empty().append(data); 
               
          });
    });
});

</script>