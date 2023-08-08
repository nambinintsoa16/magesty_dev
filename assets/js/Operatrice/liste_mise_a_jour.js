$(document).ready(function(){
	$(".maj").on('click', function(e) {
		e.preventDefault();
		let This = $(this);
		let parent = This.parent().parent();
		let code_client = parent.children().eq(0).text();
		let compte = parent.children().eq(1).text();
		let lien = parent.children().eq(2).text();
		let page = parent.children().eq(3).text();
		loding();
		$.post(base_url + "Operatrice/add_client_update", {
			code_client: code_client,
			compte: compte,
			lien: lien,
			page: page
		},function (data) {
			// This.addClass("collapse");
			This.attr("disabled", "disabled");
			stopload();
		});
	});

	$('#button-addon2').on("click", function(e) {
		e.preventDefault();
		let fd = new FormData();
		let files = $("#file")[0].files;
		
		if(files.length > 0){
			fd.append('file',files[0]);
			$.ajax({
              url: base_url + "Operatrice/add_via_exel_file",
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                 if(response != 0){
                    console.log(response); // Display image element
                 }else{
                    console.log(response);
                 }
              },
           });
		} else {
			alert("Please select a file.");
		}
	});

function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #0000ff;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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

	$('.client00').on('click', function(e) {
        e.preventDefault();
       var parent = $(this).parent().parent();
        var codeclient = parent.children().first().text();
        var type = "HISTORIQUE";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Operatrice/rdv_detail', { date: date, codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + " / " + type,
                content: data,
                columnClass: 'col-md-12 col-md-offset-8',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });

	$('.client0007').on('click', function(e) {
        e.preventDefault();
       var parent = $(this).parent().parent();
        var codeclient = parent.children().first().text();
        var type = "HISTORIQUE";
        var date = $('.date_collapse').text();
		swal({
			title: 'HISTORIQUE',
			text: "CHOISIR HISTORIQUE.",
			type: 'warning',
			buttons:{
			  confirm: {
				text : 'HISTORIQUE DE RENDEZ-VOUS',
				className : 'btn btn-success'
			  },
			  cancel: {
				visible: true,
				text : 'HISTORIQUE DE VENTE',
				className: 'btn btn-danger'
			  }
			}
		  }).then((Delete) => {
			if (Delete) {
				$.post(base_url + 'Operatrice/rdv_detail', { date: date, codeclient: codeclient, type: type }, function(data) {
					$.alert({
						title: codeclient + " / " + type,
						content: data,
						columnClass: 'col-md-12 col-md-offset-8',
						type: 'blue',
						icon: 'fa fa-spinner fa-spin',
		
					});
				});
			} else {
				$.post(base_url + 'Operatrice/client_details', { date: date, codeclient: codeclient, type: type }, function(data) {
					$.alert({
						title: codeclient + " / " + type,
						content: data,
						columnClass: 'col-md-12 col-md-offset-8',
						type: 'blue',
						icon: 'fa fa-spinner fa-spin',
		
					});
				});
			}
		  });
	  
		});














        /*$.post(base_url + 'Operatrice/rdv_detail', { date: date, codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + " / " + type,
                content: data,
                columnClass: 'col-md-8 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });
*/
});