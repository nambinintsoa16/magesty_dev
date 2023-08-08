$(document).ready(function() {
    $('.valider_link').on('click', function(Event) {
        Event.preventDefault()
        let link = $('.Lien_client').val();
        loding();
        if (link == ''){
            $.alert({
                title: 'Attention',
                content: 'Le lien de profile du client est obligatoire ',
            });
        }else{
            $.post('https://magesty-prod.combo.fun/operatrice/Afficher_info_client',{link:link}, function(data){
               stopload()
               $('.info').empty().append(data);
            });
        }        
    });
    $('.enregistrer').on('click', function(Event) {
          Event.preventDefault();
          var date = $('.date').val();
          var page = $('.page option:selected').val();
          var produit = $('.produit').val();
          var reference = $('.reference option:selected').val();
          var table = $('.Contenu').children();
          loding();
          console.log(date+page+produit+reference);
            if (date == '' || page == '' || produit == ''||  reference == ''){
                $.alert({
                    title: 'Confirmation ',
                    content: 'Tous les champs sont obligatoire',
            });
            }else{
                $.post('https://magesty-prod.combo.fun/operatrice/Save_TSF',{date:date,page:page,produit:produit,reference:reference}, function(data){
                    if(data.Id != ""){
                        table.each(function(){
                            var Code_client = $(this).find('.CodeClient').text();
                            var Client = $(this).find('.NomClient').text();
                            var Type = $(this).find('.TypeTFS').text();
                            var Reponse = $(this).find('.ReponseTFS').text();
                            Send_Tache_TSF_detail(Code_client,Client,Type,Reponse,data.Id);
                            console.log(data.Id);
                         });
                        $.alert('INSERTION EFFECTUE  AVEC SUCCESS');
                        stopload();
                        location.reload();
                    }
                },'json');
            }
        });

        function Send_Tache_TSF_detail(Code_client, Client,Type,Reponse,Id){
            $.post('https://magesty-prod.combo.fun/operatrice/Save_TSF_detail',{Code_client:Code_client,Client:Client,Type:Type,Reponse:Reponse,Id:Id},function(){
            },"json");
        }
        function loding(){
            var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #0000ff;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
        function stopload() {
            $('.jconfirm ').remove();
        }
});