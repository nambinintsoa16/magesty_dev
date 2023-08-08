$(()=>{
    let sec = min = 00
let timer = ""

$('.client').autocomplete({
    source : base_url + "Appel_telephonique/autocomplete",
    select: function (event , rep){
        event.preventDefault()
        let mot = rep.item.label.split('|')
        console.log()

    }
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


  $('.saveResulAppel').on('click',function(e){
      e.preventDefault()
  })

  $('#DetailClient').on('click',function(e){
    e.preventDefault()
    let client = $('.client').val().split("|")
    $.post(base_url+"Appel_telephonique/detailClient",{codeClient:client[0].trim()},function(data){
          
    },'json')

  })
$('.sauveVente').on('click',function(event){
        event.preventDefault()
        $('#venteModal').modal('show')
})
$('.btnSauveClient').on('click',function(event){
  event.preventDefault()
  $('#sauveClient').modal('show')

})

})