$(document).ready(function(){

    togg();
        Table = $('.table-relanceProd').DataTable({
       	processing: true,
        searching: false,
        paging:false,
             initComplete: function(settings, json) {
            $('.client').on('click', function(e) {
            e.preventDefault();
              var parent = $(this).parent().parent();
                var codeclient = parent.children().first().text();
                var type = "";
                var date = $('.date_collapse').text();
                $.post(base_url + 'Operatrice/client_details', { date: date, codeclient: codeclient }, function(data) {
                    $.alert({
                        title: codeclient,
                        content: data,
                        columnClass: 'col-md-12',
                        type: 'blue',
                        icon: 'fa fa-spinner fa-spin',
                            buttons: {
                            fermer: {
                                btnClass: 'btn-red text-center', // multiple classes.
                                
                            },
                        }

                    });
                });

                });
              },

         autoFill: {
            alwaysAsk: true
         },
         ajax :base_url+"relance/Prod007",
         language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            
               
       })

    $('.btn-click').on('click',function(e){

        e.preventDefault();
        var page = $(this).children().find('b').text();
     
         if(page=="PROD007"){
            let links = base_url + 'relance/Prod007';
            Table.ajax.url(links);
            Table.ajax.reload();

         }
         if(page=="PROD014"){
            let links = base_url + 'relance/Prod014';
            Table.ajax.url(links);
            Table.ajax.reload();
            
         }
         if(page=="PROD021"){
            let links = base_url + 'relance/Prod021';
            Table.ajax.url(links);
            Table.ajax.reload();

         }
         if(page=="PROD028"){
            let links = base_url + 'relance/Prod028';
            Table.ajax.url(links);
            Table.ajax.reload();
            
         }
            if(page=="PROD035"){
            let links = base_url + 'relance/Prod035';
            Table.ajax.url(links);
            Table.ajax.reload();

         }
        if(page=="PROD042"){
            let links = base_url + 'relance/Prod042';
            Table.ajax.url(links);
            Table.ajax.reload();
            
         }

        if(page=="PROD049"){
            let links = base_url + 'relance/Prod049';
            Table.ajax.url(links);
            Table.ajax.reload();

         }
         if(page=="PROD056"){
            let links = base_url + 'relance/Prod056';
            Table.ajax.url(links);
            Table.ajax.reload();
            
         }

         if(page=="PROD063"){
            let links = base_url + 'relance/Prod063';
            Table.ajax.url(links);
            Table.ajax.reload();
            
         }

          if(page=="PROD084"){
            let links = base_url + 'relance/Prod084';
            Table.ajax.url(links);
            Table.ajax.reload();
            
         }

          if(page=="PROD210"){
            let links = base_url + 'relance/Prod210';
            Table.ajax.url(links);
            Table.ajax.reload();
            
         }
    

    });


function togg(){
let togg2 = document.getElementById("togg2");

   if(getComputedStyle(d1).display != "none"){
    d1.style.display = "none";
  } else {
    d1.style.display = "block";
  }

  if(getComputedStyle(d2).display != "none"){
    d2.style.display = "none";
  } else {
    d2.style.display = "block";
  }

  if(getComputedStyle(d3).display != "none"){
    d3.style.display = "none";
  } else {
    d3.style.display = "block";
  }

  if(getComputedStyle(d4).display != "none"){
    d4.style.display = "none";
  } else {
    d4.style.display = "block";
  }

  if(getComputedStyle(d5).display != "none"){
    d5.style.display = "none";
  } else {
    d5.style.display = "block";
  }
};
togg2.onclick = togg;

    
   
});