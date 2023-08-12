$(document).ready(function(){
  
  $('.link').on('click',function(event){
    event.preventDefault();
       $('.fade').modal('show');

  });
var matricule = $('.mttext').text();

$.post(base_url+'operatrice/dateChart',{matricule:matricule},function(data){
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
                            'rgba(255, 159, 64, 1)'
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
    

});