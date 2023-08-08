 document.getElementById("btn_convert1").addEventListener("click", function() {
        html2canvas(document.getElementById("Temoignage1")).then(function (canvas) { 
        	var opl = "<?php echo $opl;?>";
        	var dt = "<?php echo $dt;?>";
        	var reference = "<?php echo $ref;?>";
        	var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                document.getElementById("previewImg1").appendChild(canvas);
                anchorTag.download = "Temoignage "+opl+" "+dt+" "+reference+".jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
     });

     document.getElementById("btn_convert2").addEventListener("click", function() {
        html2canvas(document.getElementById("Sondage1")).then(function (canvas) { 
        	var opl = "<?php echo $opl;?>";
        	var dt = "<?php echo $dt;?>";
        	var reference = "<?php echo $ref;?>";           
        	var anchorTag = document.createElement("a");
                document.body.appendChild(anchorTag);
                document.getElementById("previewImg2").appendChild(canvas);
                anchorTag.download = "Sondage "+opl+" "+dt+" "+reference+".jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
     });

	document.getElementById("btn_convert3").addEventListener("click", function() {
        html2canvas(document.getElementById("Faharetana1")).then(function (canvas) { 
        	var opl = "<?php echo $opl;?>";
        	var dt = "<?php echo $dt;?>";
        	var reference = "<?php echo $ref;?>";           
        	var anchorTag = document.createElement("a");
               document.body.appendChild(anchorTag);
                document.getElementById("previewImg3").appendChild(canvas);
               anchorTag.download = "Faharetana "+opl+" "+dt+" "+reference+".jpg";
                anchorTag.href = canvas.toDataURL();
                anchorTag.target = '_blank';
                anchorTag.click();
            });
     }); 

$(document).ready(function(){
    $('.valider_info').on('click',function(e){
        e.preventDefault();
         var id =  $('.id_get').text();
        loding();           
        $.post('https://magesty-prod.combo.fun/administrateur/Valider_Decision_Info',{id:id}, function(data){   
            stopload();
            $.confirm({
                title: 'CONFIRMATION',
                content: 'TSF Télécharger et classer dans l archive   avec succès ',
                type: 'green',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Continuer',
                        btnClass: 'btn-green',
                        action: function(){
                            window.location.replace("https://magesty-prod.combo.fun/Administrateur/Liste_TSF_Publication");
                        }
                    }
                }
            });  
        });
    });

     function loding() {
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
     