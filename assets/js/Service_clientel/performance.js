$(document).ready(function(){

  $('.link').on('click',function(event){
    event.preventDefault();
    var color=[];
    color["vente"]="primary";
    color["produit"]="danger";
    color["client"]="warning";
    color["jours"]="success";
    var text = "table table-bordered table-bordered-bd-";
    var text2= "text-white bg-";
   $('#headTable').removeClass();
    var parametre = $(this).attr('id');
    if( parametre != "undefined" ){
      $('.test2').text($(this).children().find('.info-box-text').text());
    $('#table').dataTable();
    	$('#headTable').addClass(text2+color[parametre]);
    	$("#table").removeClass();
        $("#entetet").removeClass();
        $('#entetet').addClass("modal-header bg-"+color[parametre]);
    	$("#table").addClass(text+color[parametre]);
         loding();
        $.post(base_url+'user/tableData',{parametre:parametre},function(data){
            stopload();
            $('.modal-body').empty().append(data);
            $('.fade').modal('show');
        });
       
     

    }
 

  });
var matricule = $('.mttext').text();

$.post(base_url+'user/dateChart',{matricule:matricule},function(data){
 var ctx = document.getElementById('lineChart').getContext('2d');
            ctx.height = 140;
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels:data.date ,
                    datasets: [{
                        label: 'Total de vente en ariary',
                        data: data.data,
                        borderColor: [
                            'rgba(0, 0, 0, 0.3)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
},'json');    


$.post(base_url+'user/bar',{matricule:matricule},function(datas){
     var ctx = document.getElementById("singelBarChart");
                    ctx.height = 140;
                    var myChart = new Chart( ctx, {
                        type: 'bar',
                        data: {
                            labels: [ "AUT","BEA","BOI","DEO&PAR","HBD","HC","LES","SC","SV"],
                            datasets: [
                                {
                                    data:datas.donne,
                                    borderColor: "rgba(0, 123, 255, 0.9)",
                                    borderWidth: "0",
                                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                                            }
                                        ]
                        },
                        options: {
                            legend: {
                            display: false
                            }
                        }
                    });
},'json');           
function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: red;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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