<!--<div id="poll-container">
    <form id='poll' action="poll.php" method="post" accept-charset="utf-8">
        <p>CHOISIR DEODORANT:</p>
        <p><input type="radio" name="poll" value="opt1" id="opt1" /><label for='opt1'>&nbsp;VIVITE</label><br />
        <input type="radio" name="poll" value="opt2" id="opt2" /><label for='opt2'>&nbsp;USHUAYA</label><br />
        <input type="radio" name="poll" value="opt3" id="opt3" /><label for='opt3'>&nbsp;FA</label><br />
        <input type="radio" name="poll" value="opt4" id="opt4" /><label for='opt4'>&nbsp;HOMEOPHARMA</label><br />
        <input type="radio" name="poll" value="opt5" id="opt5" /><label for='opt5'>&nbsp;NIVEA</label><br />
        <input type="submit" value="Vote &rarr;" /></p>
    </form>
</div> -->
<div class="row">
<form method="post" action="<?=base_url("controlleur")?>">
<div class="form-row" >
   <div class="col-md-8">
      <input type="date" class="form-control dateAutre" value="Y-m-d" name="date">
   </div>
   <div class="col-md-4">
     <button type="submit" class="btn btn-success" style="width:100%"> valider</button>
   </div>

<style>
 {
  box-sizing: border-box;
}
 
html, body {
  height: 100%;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: 'Roboto', sans-serif;
  background: #efefef;
  overflow: visible;
}
.panel {
  width: 1220px;
  height: 350px;
  background: #bdbdbd;
  box-shadow: 1px 2px 3px 0px rgba(0,0,0,0.10);
  border-radius: 6px;
  overflow: hidden;
  margin-top: -50px;
}
.panel-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 30px;
  height: 60px;
  background: #fff;
}
 
.title {
  color: #5E6977;
  font-weight: 500;
}
 
.calendar-views span {
  font-size: 14px;
  font-weight: 300;
  color: #BDC6CF;
  padding: 6px 14px;
  border: 2px solid transparent;
}
.panel-body {
  display: flex;
  height: 350px;
}

.chart {
  width: 100%;
  height: 100%;
  display: inline-block;
  flex-direction: column;
  flex-grow: 2;
  position: relative;
  background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 8%, rgba(0,212,255,1) 100%);
}
 
.operating-systems {
  display: flex;
  justify-content: space-between;
  width: 115px;
  margin-top: 30px;
  margin-bottom: 50px;
}
span[class*=&quot;-os&quot;] {
  font-size: 14px;
  font-weight: 300;
  font-size: 14px;
  color: #c3c6e4;  
}
span[class*=&quot;-os&quot;] span {
  width: 9px;
  height: 9px;
  display: inline-block;
  border-radius: 50%;
  margin-right: 9px;
}
.dataTables{
  border:1px;
  font:bold;

}

</style>
<div class="wrapper">
      <div class="panel">
        <div class="panel-body">
          <div class="categories">
          </div> 
            <div class="col-md-4"> 
                    <?php
                  $i=0;
                  $content=array();
                  foreach ($data as $datas): 
                  if(array_key_exists($datas->marque,$content)){
                    $content[$datas->marque] += 1;  
                  }else{
                    $content[$datas->marque] = 1;  
                  }
                  
                  $i++?>
                  <?php endforeach;?>      
                  
                        <span class='total'><h4><b><u>NOTORIETE</u></b></h4><h5><b>TOTAL REPONDANT:<?php $totaltest = $i; echo $totaltest?></h5></b></span>
                        <span class="marque_list">
                            
                              <?php $nbr =0; foreach ($content as $key => $value) :?>
                          
                              <?php
                                  $nbr =$value  ;
                                  $total = (int) $totaltest;
                                  $styleval  =  $nbr*100/$total;
                                  
                              ?>
                                <div class="progress" style="font:8px">
                                    <div class="progress-bar progress-bar-striped bg-success chart" role="progressbar" style="width:<?php echo $styleval;?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"> 
                                    <?=number_format($styleval, 2, '.', '')?>%
                                    </div>              
                                </div>
                              <?php endforeach?>
                          
                        </span>
                      
              </div>
              <div class="col-md-2" style="margin-top:65px;margin-left:-29px"> 
                    <?php
                  $i=0;
                  $content=array();
                  foreach ($data as $datas): 
                  if(array_key_exists($datas->marque,$content)){
                    $content[$datas->marque] += 1;  
                  }else{
                    $content[$datas->marque] = 1;  
                  }
                  
                  $i++?>
                  <?php endforeach;?>      
                        <span class="marque_list" style="margin-top:20px"></span>
                        <span class="marque_list">                  
                              <?php $nbr =0; foreach ($content as $key => $value) :?>
                          
                              <?php
                                  $nbr =$value  ;
                                  $total = (int) $totaltest;
                                  $styleval  =  $nbr*100/$total;
                                  
                              ?>
                             
                                <div class="progress" style="font:7px"><?php echo $key?>|<?=$value?>
                                    <div class="<?php echo $styleval;?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"> 
                                
                                    </div>              
                                </div>
                              
                              <?php endforeach?>
                          
                        </span>
                      
              </div>
              <div class="col-md-6">
                  <div>
                      <span class="txt"><h4><b><u>SATISFACTION</u></b></h4><h5><b>TOTAL REPONDANT:4</h5></b></span>
                  </div>
                  <div>
                      <canvas id="pieChart" style="width:100%;height:230px"></canvas>
                  </div>

              </div>
            </div>
     <div> 
     <button class="btn btn-succes fff" style="font-size: 13px;padding:4px;color:#fff;background-color:#ff0000;margin-left:1120px;margin-top:-100px">RETOUR</button>
         </div>
        </div>
      </div>
      </div> 
<div class="form-group contentTable">

      <table class="table table-light dataTables table-hover dataTables">
            <thead class="thead-light">
                <tr>
                    <th>DATE</th>
                    <th>TYPE</th>
                    <th>NOM REPONDANT</th>
                    <th>MARQUE</th>
                    <th>PRODUIT</th>
                    <th>COMMENTAIRE</th>
                    <th>INTERPRETATION</th>
                                       
                </tr>
            </thead>
            <tbody class="tbody">
    <?php
      $i=0;
      $content=array();
      foreach ($data as $datas): 
      if(array_key_exists($datas->marque,$content)){
        $content[$datas->marque] += 1;  
      }else{
        $content[$datas->marque] = 1;  
      }
      
      $i++?>
      <tr>
     <td><?=$datas->date?></td>
     <td><?=$datas->type?></td>
     <td a href="#"><?=$datas->nom_client?></a></td>
     <td><?=$datas->marque?></td>
     <td><?=$datas->produit?></td>
     <td><?=$datas->commentaire?></td>
     <td><?=$datas->interpretation?></td>
    </tr>
      <?php endforeach;?>   
        </tbody>
        </table> 
   </div>
 
 
   <?php
    $p=0;
    $content=array();
    foreach($data as $datas):
      echo $datas->interpretation."<br>";
      if(array_key_exists($datas->interpretation,$content)){
         if($datas->interpretation!=""){
           $content[$datas->interpretation] += 1;
         }
       
      }else{
        if($datas->interpretation!=""){
        $content[$datas->interpretation] = 1;
      }
      }
      
      $p++?>
       <?php endforeach;?>   
       <?php $totalinte = $p; echo $totalinte?>
       <?php $nbr =0; foreach ($content as $key => $value) :?>
                          
          <?php
              $nbr =$value  ;
              $total = (int) $totalinte;
              $percent  =  $nbr*100/$total;
                              
              ?>
               <?= number_format($percent , 2, '.', '')?>

               <?php endforeach;?>  



