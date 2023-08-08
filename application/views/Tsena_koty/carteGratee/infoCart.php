<?php $this->load->model('Global_model'); ?>
<div class="container">
  <div class="row">
    <div class="form-group col-md-2">
      <img src="<?= code_client_img_link($infoClient->Code_client) ?>" class="card-img-top img-thumbnail rounded-circle" style="width: 150px;" alt="<?= $infoClient->Code_client ?>">
    </div>
    <div class="form-group col-md-4" style="color:#00000">
      Nom : <?= $infoClient->Nom ?> <br />
      Prénom : <?= $infoClient->Nom ?> <br />
      Code client : <span class="codeClientSpan"><?= $infoClient->Code_client ?></span><br />
      Statut : <span class="level"> <?= $level = $this->Global_model->getclientstatuttrimes($smiles) ?> </span><br />
      Koty : <?= $Koty ?> | Smiles : <?= $smiles ?>
      <h3 style="color:#FFA900"><strong>Chapeau :
          <?php if ($level != "") : ?>
            <?php $chap = explode(" ", $level); ?>
            <?= $chap[1] ?>
          <?php endif; ?>
        </strong></h3>
    </div>
    <div class="form-group col-md-6">
      <table class="table table-striped table-sm w-100">
        <thead>
          <?php if ($facture) : ?>
            <tr>
              <th scope="col" colspan="2"><b> Facture N°: </b><?= $facture->Id_facture ?></th>
              <th scope="col" colspan="2"><b>Date d'achat : </b> <?= $facture->Date ?></th>
            </tr>
          <?php endif; ?>
        </thead>
        <tbody>
        </tbody>
      </table>
      <table class="table table-striped table-sm w-100">
        <thead class="bg-warning text-white">

          <tr>
            <th scope="col">Produit</th>
            <th scope="col">P.U</th>
            <th scope="col">Quantite</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($detail) : $total = 0; ?>
            <?php foreach ($detail as $key => $detail) : $total += ($detail->Prix_detail * $detail->Quantite); ?>
              <tr>
                <th scope="row"><?= $detail->Code_produit ?></th>
                <td><?= number_format($detail->Prix_detail, 2, ',', ' '); ?></td>
                <td><?= $detail->Quantite ?></td>
                <td><?= number_format($detail->Prix_detail * $detail->Quantite, 2, ',', ' '); ?></td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <th scope="row" colspan="3" class="text-left">Sous total : </th>
              <td><?= number_format($total, 2, ',', ' '); ?></td>
            </tr>
          <?php else : ?>
            <tr>
              <th scope="row" colspan="4" class="text-center">Aucun resultat</th>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<fieldset class="scheduler-border border p-2" style="background-color: #FFA900;border-radius: 5px;">
  <div class="control-group">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item "><a class="page-link tire" href="#">0</a></li>
        <li class="page-item "><a class="page-link tire bg-primary text-white" href="#">1</a></li>
        <li class="page-item "><a class="page-link tire" href="#">2</a></li>
        <li class="page-item "><a class="page-link tire" href="#">3</a></li>
        <li class="page-item "><a class="page-link tire" href="#">4</a></li>
        <li class="page-item "><a class="page-link tire" href="#">5</a></li>
        <li class="page-item "><a class="page-link tire" href="#">6</a></li>
        <li class="page-item "><a class="page-link tire" href="#">7</a></li>
        <li class="page-item "><a class="page-link tire" href="#">8</a></li>
        <li class="page-item "><a class="page-link tire" href="#">9</a></li>
        
      </ul>
    </nav>
  </div>
</fieldset>
<fieldset class="scheduler-border border p-2 w-100">
  <legend class="scheduler-border w-auto">Résulat : </legend>
<div class="container">
  <div class="row lot p-auto">
    <?php foreach ($description as $description) : ?>
      <div class="form-group col-md-3">
        <div class="card" style="width: 14rem;">
          <img src="<?= base_url('images/imageKoty/cadeau.png') ?>" class="card-img-top" style="width: 150px;margin:auto;" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?= $description->code_carte ?></h5>
            <p class="card-text"><?= $description->designation ?></p>
            <a href="<?= base_url('CarteGratee/TireCart/' . $description->id) ?>" class="btn btn-warning btn-sm">Valider</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="form-group col-md-12">
      <p><?= $links ?></p>
    </div>
  </div>
</div>
</fieldset>
<script>
  $(document).ready(function() {
    $('.tire').on('click', function(e) {
      e.preventDefault();
      loding();
      let numeroTire = $(this).text();
      let client = $('.codeClientSpan').text().trim();
      let level = $('.level').text().trim();
      let $this =$(this);
      $.post(base_url + 'CarteGratee/tireNumero', {
        numero: numeroTire,
        client: client,
        level: level
      }, function(data) {
        $('.tire').each(function(){
              $(this).removeClass('bg-primary text-white');
        });
        $this.addClass('bg-primary text-white');
        $('.lot').empty().append(data);
        stopload();
      }).fail(function(data) {
        stopload();
        swal("Erreur", data.error, {
          icon: "error",
          buttons: {
            confirm: {
              className: "btn btn-danger"
            }
          },
        });
      });

    });

    function alertMessage(title, message, icons, btn) {
      swal(title, message, {
        icon: icons,
        buttons: {
          confirm: {
            className: btn
          }
        },
      });

    }

    function loding() {
      var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #ff0090;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
      $.dialog({
        "title": "",
        "content": htmls,
        "show": true,
        "modal": true,
        "close": false,
        "closeOnMaskClick": false,
        "closeOnEscape": false,
        "dynamic": false,
        "height": 150,
        "fixedDimensions": true
      });
    }

    function stopload() {
      $('.jconfirm ').remove();

    }
  });
</script>