
      $(document).ready(function(){
          $(".valider").on('click',function(event){
              event.preventDefault();
              var datedeb=$('.datedeb').val();
              var datefin=$('.datefin').val();
              if(datedeb == "" || datefin == ""){
                alert("Veuillez entrez au moin une date");
              }else{
                 $.post('http://magesty.combo.fun/service_clientel/Vente_annuel_data',{datedeb:datedeb,datefin:datefin},function(data){
                      $('.ventelivre').empty().append(data);
                  });

             }
          });
       

          $("#btnExport").click(function(){
        TableToExcel.convert(document.getElementById("tableau"), {
            name: "Vente livre annuel.xlsx",
            sheet: {
            name: "Sheet1"
            }
          });
        });

             
                });

      