$(document).ready(function(){
	//alert("");

  $('#histo_client').on('click',function(event){
  	event.preventDefault();
  	$('#modal_history_client').modal('show');

  });
  $('#save_data').on('click',function(event){
  	event.preventDefault();
    let Campagne = $("#Campagne option:selected").val();
    let publication = $('#publication').val();
    let produit = $('#produit').val();
    let codeClient =  $('#client').val();
    let type_action = $('#type_action option:selected').val();
    let remarque = $('#remarque').val();
    let date_action = $('#date_action').val();

    $.post(base_url+'operatrice/save_action_publication',{date_action,Campagne,publication,produit,codeClient,type_action,remarque},function(data){
      alertMessage("Succès!", "Action enregistre.", "success", "btn-success");
    });
  	

  });

  $('#client').autocomplete({
    	source:base_url + "Administrateur/autocomplete_client",
    	select: function (t, ti) {
                t.preventDefault();
                let items = ti.item.label.split('|');
                $('#client').val(items[0]);
               
            }
    });


   $('#publication').autocomplete({
    	source:base_url + "Administrateur/autocomplete_publication",
    	select: function (t, ti) {
                t.preventDefault();
                let items = ti.item.label.split('|');
                $('#refnum_publication').val(items[0]);
                $('#publication').val(items[2]);
                $('#produit').val(items[1]);
               
            }
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
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: green;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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