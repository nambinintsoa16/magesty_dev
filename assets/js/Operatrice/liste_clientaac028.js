$(()=>{

    $('.client0007').on('click', function(e) {
        e.preventDefault();
        loding();
       var parent = $(this).parent().parent();
        var codeclient = parent.children().first().text();
        var type = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Operatrice/client_details', { date: date, codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + " / " + type,
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
            stopload();
        });

    });

       function loding(){ 
      //var htmls='<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #00B74A;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
      var htmls='<style>bodY {  margin: 0; padding: 0;  box-sizing: border-box;}.center {  height: 10px;  display: flex;  justify-content: center;  align-items: center;  background: #000;}.wave {  width: 5px;  height: 400px;  background: linear-gradient(45deg, cyan, #fff);  margin: 10px;  animation: wave 1s linear infinite;  border-radius: px;}.wave:nth-child(2) {  animation-delay: 0.1s;}.wave:nth-child(3) {  animation-delay: 0.2s;}.wave:nth-child(4) {  animation-delay: 0.3s;}.wave:nth-child(5) {  animation-delay: 0.4s;}.wave:nth-child(6) {  animation-delay: 0.5s;}.wave:nth-child(7) {  animation-delay: 0.6s;}.wave:nth-child(8) {  animation-delay: 0.7s;}.wave:nth-child(9) {  animation-delay: 0.8s;}.wave:nth-child(10) {  animation-delay: 0.9s;}@keyframes wave {  0% {    transform: scale(0);  }  50% {    transform: scale(1);  }  100% {  transform: scale(0);  }}</style><div class="center"><div class="wave"></div> <div class="wave"></div><div class="wave"></div>  <div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div><div class="wave"></div></div>'

;
      $.dialog({
        "title": "",
        "content": htmls,
        "show": true,
        "modal": true,
        "close": false,
        "closeOnMaskClick": false,
        "closeOnEscape": false,
        "dynamic": false,
        "height": 150,
        "fixedDimensions": true
      }); 
    }
    function stopload(){
          $('.jconfirm ').remove();
        
    }


})