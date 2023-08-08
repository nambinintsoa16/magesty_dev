$(()=>{

let sec = min = 00
let timer = ""

$('.client').autocomplete({
    source : base_url + "Appel_telephonique/autocomplete"
})

$('#marche').on('click',()=>{
    timer =  setInterval((e)=>{
        sec ++
        if(sec<10){
            sec = '0' + sec
        }
        $('.seconde').val(sec)
        if(sec == 11){
          sec = 0
          min++
          if(min < 10 ){
            min = '0'+min
          }
          $('.minute').val(min)
        }
    },1000)
})

$('#fin').on('click',()=>{
  clearInterval(timer)
    min = min < 10 ? '0'+ parseInt(min) :  min 
    sec = sec < 10 ? '0'+ parseInt(sec) :  sec
    let html  = "<span class='animated fadeInLeft w-100'>"+  min  +" : "+ sec +"</span>"
    sec = min = 0
    $('.timer-input').val('00')
    $('.message').empty().append(html)
    $('#modaleFinDAppel').modal('show')
})

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

  $('.btn-link').on('click',function(e){
    e.preventDefault()
    let type =  $(this).attr('id')
    let link = base_url +"Appel_telephonique/Result_appel?type="+type
    Table.ajax.url(link)
    Table.ajax.reload()
  })
 
  $('.saveResulAppel').on('click',function(e){
      e.preventDefault()
  })
  $('#DetailClient').on('click',function(e){
    e.preventDefault()
    let client = $('.client').val().split("|")
    $.post(base_url+"Appel_telephonique/detailClient",{codeClient:client[0].trim()},function(data){
          
    },'json')

  })
 

})