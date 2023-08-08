
      $(document).ready(function(){
          $(".valider").on('click',function(event){
              event.preventDefault();
              var datedeb=$('.datedeb').val();
              var datefin=$('.datefin').val();
              if(datedeb == "" || datefin == ""){
                alert("Veuillez entrez au moin une date");
              }else{
                 $.post('http://nambinintsoatest.combo.fun/service_clientel/Clients_sans_achat_data',{datedeb:datedeb,datefin:datefin},function(data){
                      $('.ventelivre').empty().append(data);
                  });

             }
          });
       

          $("#btnExport").click(function(){
        TableToExcel.convert(document.getElementById("tableau"), {
            name: "Vente livré mensuel.xlsx",
            sheet: {
            name: "Sheet1"
            }
          });
        });

             
                });

      