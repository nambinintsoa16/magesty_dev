
      <div class="row">
          <div class="col-lg-12">
            <section class="panel listProduit">
                
                <table class="table table-striped table-advance table-hover dataTable" id="tableau">
                <thead>
                  <tr>
                    <th style="width: 200px">Code client </th>
                    <th style="width: 250px">Nom et Prénom</th>
                    <th style="width: 100px">Contact</th>
                    <th  style="width: 200px">Identifient sur facebook</th>
                    <th style="width: 200px">Lien sur facebook</th>
                    <th>Photo</th>
                    <th></th>
                    
                  </tr>
                </thead>
                <tbody class="listProduit" >
               
    <?php 
    $json = file_get_contents('http://komone-beta.in-expedition.com/commercial/Data/listeDesClient/20000/20');
    $client =json_decode($json);
    foreach ($client as  $clients):
    ?>  
             <tr>
                    <td><?=$clients->Code_client?></td>
                    <td><?=$clients->Nom." ".$clients->Prenom?></td>
                    <td><?=$clients->Contact?></td>
                    <td></td>
                    <td><a href="<?=$clients->lien_facebook?>"><i class="fa fa-facebook ">facebook</i></a>
                    </td>
                    <td>
                    <a href="#<?=$clients->Code_client?>" data-toggle="modal" class="">
                    <img style="height:60px; width:60px;oveflow:hidden;border-radius:50%" src="../img/photoclient/<?=$clients->Code_client?>"></a>
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="'.$reponse['idclient'].'" class="modal fade">
                
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header" style="text-align: center;font-family:50px; ">
                       <span><?=$clients->Compte_facebook?></span> 
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                      </div>
                      <div class="modal-body" style="text-align: center;">   
               <img src="http://komone-beta.in-expedition.com/images/client/<?=$clients->Code_client?>.jpg"> 
                
                        
                      </div>
                      <div class="modal-footer" style="text-align: center">
                   <a href="<?=base_url('operatrice/clients/detail/'.$client->Code_client)?>'">Information</a>
                    </div>

                    </div>
                  </div>
                </div>
                    </td>
                  <td>
                      <div class="btn-group">
                       
                       
             <a class="btn btn-info" href="?page=ficheclient&client=<?=$clients->Code_client?>"><i class="fa fa-info"></i></a>          
         
        
                      </div>
                    </td>
                  </tr>
      <?php endforeach;?>     
 </tbody>
              </table>
    
            </section>
          </div>
        </div>
      </section>
    </section>
    <script type="text/javascript">
        $(document).ready(function(){
           $('.btn-danger').on('click',function(event){
            event.preventDefault();
          $.get($(this).attr('href'),function(data){
            $.post('fonction/fonctionlisteclient.php',function(data){
            $('.listProduit').empty().append(data);
                });

             });
         });

        });
      </script>
    