$(document).ready(function(){
    var data_livre =[$('#data_livre').text(),100-$('#data_livre').text()];
    
    var data_annule =[$('#data_annul').text(),100-$('#data_annul').text()];
   
    var data =[$('#data_conf').text(),100-$('#data_conf').text()];
   
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
  
  });