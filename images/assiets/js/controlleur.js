$(document).ready(function () {
    $('.link').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'controlleur/produitUser', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });
    $('.linka').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'controlleur/produitListe', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });

    /*  $('.dateAutre').on('click',function(){
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                    $('.dateAutre').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                       eventSources: ["calendrier_de_livraison/pre","calendrier_de_livraison/ann", "calendrier_de_livraison/pla", "calendrier_de_livraison/liv", "calendrier_de_livraison/etdc"],
                        navLinks: true,
                        selectable: true,
                        selectHelper: true,
        
        
                        dayClick: function(date) {
                  
                 var formatted_date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear()
        
                        window.location.replace('calendrier/'+formatted_date);
        
                       },
        
        
                        select: function(start, end) {
                    
                        },
                        eventClick: function(event, element) {
    
                        },
                        editable: true,
        
                        eventLimit: true
        
                    });
             });
             
    
             //pie
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
                
           }*/
    $('.valide').on('click', function (e) {
        e.preventDefault();
        var dateselected = $('.dateAutre').val();
        $.post(base_url + '/Accueil', { dateselected: dateselected }, function () {



        })

    });

    // Fonction de callback en cas de succès
    function maPosition(position) {

        var infopos = "Position déterminée :\n";
        infopos += "Latitude : " + position.coords.latitude + "\n";
        infopos += "Longitude: " + position.coords.longitude + "\n";
        infopos += "Altitude : " + position.coords.altitude + "\n";
        infopos += "Vitesse  : " + position.coords.speed + "\n";
        console.log(infopos);
        latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: "Vous êtes ici"
        });


        console.log(latlng);

    }
    function erreurPosition(error) {
        var info = "Erreur lors de la géolocalisation : ";
        switch (error.code) {
            case error.TIMEOUT:
                info += "Timeout !";
                break;
            case error.PERMISSION_DENIED:
                info += "Vous n’avez pas donné la permission";
                break;
            case error.POSITION_UNAVAILABLE:
                info += "La position n’a pu être déterminée";
                break;
            case error.UNKNOWN_ERROR:
                info += "Erreur inconnue";
                break;
        }
        console.log(info);
    }
    if (navigator.geolocation) {
        survId = navigator.geolocation.getCurrentPosition(maPosition, erreurPosition);
    } else {
        console.log('erreure');
    }

});











