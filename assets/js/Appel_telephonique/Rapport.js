$(()=>{
    Table = $('.listeDesAppel').DataTable({
        processing: true,
        ajax : base_url +"Appel_telephonique/Result_appel?type=RDV",
        language: {
          url: base_url + "assets/dataTableFr/french.json"
        },
        drowCallback: function(row, data) {
            $('.tableAppel').on('click',function(e){
              e.preventDefault()
              let parent = $(this).parent().parent()
              alert()
              //$('.client').val(parent.children().first().text())
        
            })
        }, 
        rowCallback: function(row, data) {
         
        },
        initComplete: function(setting) {
          $('.tableAppel').on('click',function(e){
            e.preventDefault()
            let parent = $(this).parent().parent()
            //console.log(parent.children().first().text())
            $('.client').val(parent.children().first().text()+" | "+parent.children().first().next().text())
      
          })
      }
      
      })
})