
<div class="form-group contentTable">
        <h1 class="text-right " style="margin-top:-120px;margin-bottom:60px;padding:0px 20px;font-size:16px"><a href="#"><?=$client->Nom?></a> | <?=$client->Code_client?>  <img src="<?=base_url('images/client/'.$client->Code_client.".jpg")?>" style="width:60px;height:50px;background:#C771F5;object-fit:cover;-moz-border-radius:5px 5px 20px 20px;border-radius: 60% /40%;;"> </h1>
      <table class="table table-striped dataTable table-hover details_discussion"> 
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>HEURE</th>
                    <th>SENDER</th>
                    <th class="text-center">MESSAGE</th>
                    <th>CHECK</th>
                    <th class="text-center">CONTROLLEUR</th>
                    <th>TYPE</th>                                                                                                
                </tr>
            </thead>
            <tbody class="tbody">
                <?=$data?>
            </tbody>
        </table> 
   </div>
