
$(document).ready(function() {

  var data_livre =[0,0];
  var data_annule =[0,0];
  var data =[0,0];
  bar('att',data,'#fff','#91b5cd');
  bar('livre',data_livre,'#fff','#97a0a9');
  bar('Annul',data_annule,'#fff','#e08396');
  function bar(id,data,colorA,colorB){ 
    var ctx = document.getElementById(id).getContext('2d');
    var chart = new Chart(ctx, {
    type: 'doughnut',
   
    data: {
        datasets: [{
        data: data,
        backgroundColor: [colorA,colorB],
        borderWidth: 0,

    }],

    },

    options: {
       cutoutPercentage: 80,
        legend: {
            display: false,
            
        }

    }
});
     
}
          
$.post('fonction/fonctionlisteLivraisonConfirmée.php',function(data){
$('.livraison').empty().append(data);    
});
$.post('fonction/fonctionlisteLivraisonAnnulle.php',function(data){
$('.annule').empty().append(data);    
});
$.post('fonction/fonctionlisteLivraisonEffectuée.php',function(data){
$('.livr').empty().append(data);    
});


});
 
