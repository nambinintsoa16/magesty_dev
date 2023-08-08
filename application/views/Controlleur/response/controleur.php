<style>
 .card{
    background-color:#33b5e5;
    color:#fff;
    border-radius:5px;
    width: 150px;
    height: 60px;
    margin-left:2px!important;
    padding-top: 15px;
    font-size:15px;

 }
 .entent{
   padding-left:140px;


 }
.card a{
    text-decoration: none;
    color:#fff;

 } 
.table{
   background-color:#fff;
   margin:0;
}
.chart{
   background-color:#fff;
  
}
@media(min-width :576px){
    
}

</style>

<span class="date_collapse collapse"> <?php if($date==""){$date=date('Y-m-d');} echo $date;?></span>
<div class="col-8 form-row text-center entent" style="margin-top:10px">
    <div class="form-group col-md-2 card" >     
        <a href="<?php echo site_url('controlleur/etat_vente/'.$date)?>">Etat de vente du: </br><?php echo $date?></a>
    </div>
   <div class="form-group col-md-2 card" ><a href="<?php echo site_url('controlleur/etat_mensuel')?>">Etat mensuel</a></div>
   <div class="form-group col-md-2 card" ><a href="<?php echo site_url('controlleur/performance')?>">Performance</a></div>
   <div class="form-group contentTable">
</div>