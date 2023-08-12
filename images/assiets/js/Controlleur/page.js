$(document).ready(function () {

   $('.check').on('click', function (e) {
      var parent = $(this).parent();
      var statut = $(this).val();
      var def = parent.prev().text();
      var id = parent.parent().children().first().text();
      if (def == 'on') {
         parent.prev().empty().append('off');
         valid_change(id, 'off');
      } else {
         parent.prev().empty().append('on');
         valid_change(id, 'on');
      }



   })
   function valid_change(id, statut) {

      $.post(base_url + "controlleur/modif_satatutPage", { statut: statut, Id: id }, function (data) {

      }, 'json');

   }



});