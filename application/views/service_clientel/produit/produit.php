<?php
include_once('fonction/class/main.php');
$main=new main();
$dt=new dateTime();
$date=$dt->format("Y-m-d");  
$zone=array();
$zon=array();
$sql="SELECT `ville` FROM `livraison` WHERE `statut` LIKE 'livre' AND `datediflivre` LIKE '".$date."'";
$por=$main->fetchAll($sql);
foreach ($por as $por) {
if (!in_array($por['ville'],$zone)){
    $zone[]=$por['ville'];
  }
}
foreach ($zone as$zone) {
 if (empty($zon)) {
   $zon='"'.$zone.'"';
 }else{
  $zon=$zon.',"'.$zone.'"';
 }
}
$sqllivre="SELECT `idcomande` FROM `facture` WHERE `Statut` LIKE 'livre'  AND `datedefacture` LIKE '".$date."'";
$sqlAnnule="SELECT `idcomande` FROM `facture` WHERE `Statut` LIKE 'Annule'  AND `datedefacture` LIKE '".$date."'";
$sqlPlan="SELECT `idcomande` FROM `facture` WHERE  `Statut` LIKE 'confirmer' AND `datedefacture` LIKE '".$date."'";
$sqlrep="SELECT `idcomande` FROM `facture` WHERE `Date_REPP` LIKE '".$date."'";
$sqltdc="SELECT `idcomande` FROM `facture` WHERE `Statut` LIKE 'on_attente'  AND `datedefacture` LIKE '".$date."'";
$sql="SELECT `idcomande` FROM `facture` WHERE `datedefacture` LIKE '".$date."'";



function nombreproduit($sql,$main){
$AUT=0;
$BEA=0; 
$BOI=0; 
$DEO=0;
$HBD=0; 
$HC=0; 
$LES=0; 
$SC=0; 
$SV=0;
$produit=array();
 
$idcomme2=$main->fetchAll($sql);
foreach ($idcomme2 as $idcomme2) {
$sql="SELECT `codeproduit`,`quantite` FROM `comande` WHERE `idcomand` LIKE '".$idcomme2['idcomande']."'";
$Produit2=$main->fetch($sql);

if (!array_key_exists($Produit2['codeproduit'],$produit)){
   $produit[$Produit2['codeproduit']]=(int)$Produit2['quantite'];
}else{
    $produit[$Produit2['codeproduit']]=(int) $produit[$Produit2['codeproduit']] + (int)$Produit2['quantite']; 
}



}    

foreach ($produit as $key =>  $produit) {
$sql3="SELECT `famille`,`prix` FROM `produit` WHERE `codeproduit` LIKE '".$key."'"; 
$famille=$main->fetch($sql3);

       if ($famille['famille']=="AUTRES") {
         $AUT=$AUT+$produit;
       }else if ($famille['famille']=="BEAUTE") {
         $BEA=$BEA+ $produit;
       }else if ($famille['famille']=="BOISSON") {
         $BOI=$BOI+$produit;
       }else if ($famille['famille']=="DEO & PARFUM") {
         $DEO=$DEO+$produit;
       }else if ($famille['famille']=="HYGIENE BUCO-DENTAIRE") {
         $HBD=$HBD+$produit;
       }else if ($famille['famille']=="HYGIENE CORPORELLE") {
        $HC=$HC+$produit;
       }else if ($famille['famille']=="LESSIVE") {
         $LES=$LES+$produit;
       }else if ($famille['famille']=="SOINS CAPILLAIRE") {
        $SC=$SC+$produit;
       }else if ($famille['famille']=="SOINS VISAGE") {
         $SV=$SV+$produit;
       }

} 
$totalprod=array();

$totalprod=["AUTRES"=>$AUT ,"BEAUTE" =>$BEA ,"BOISSON" =>$BOI ,"DEO & PARFUM" =>$DEO ,"HYGIENE BUCO-DENTAIRE" =>$HBD,"HYGIENE CORPORELLE" =>$HC  ,"LESSIVE"=>$LES ,"SOINS CAPILLAIRE" =>$SC ,"SOINS VISAGE" =>$SV];
return $totalprod;

}
/*------------------------*----------------------------------*/
function totalprix($sql,$main){
$AUT=0;
$BEA=0; 
$BOI=0; 
$DEO=0;
$HBD=0; 
$HC=0; 
$LES=0; 
$SC=0; 
$SV=0;
$produit=array();
 
$idcomme2=$main->fetchAll($sql);
foreach ($idcomme2 as $idcomme2) {
$sql="SELECT `codeproduit`,`quantite` FROM `comande` WHERE `idcomand` LIKE '".$idcomme2['idcomande']."'";
$Produit2=$main->fetch($sql);

if (!array_key_exists($Produit2['codeproduit'],$produit)){
   $produit[$Produit2['codeproduit']]=(int)$Produit2['quantite'];
}else{
    $produit[$Produit2['codeproduit']]=(int) $produit[$Produit2['codeproduit']] + (int)$Produit2['quantite']; 
}



}    

foreach ($produit as $key =>  $produit) {
$sql3="SELECT `famille`,`prix` FROM `produit` WHERE `codeproduit` LIKE '".$key."'"; 
$famille=$main->fetch($sql3);

       if ($famille['famille']=="AUTRES") {
         $AUT=$AUT+$produit;
       }else if ($famille['famille']=="BEAUTE") {
         $BEA=$BEA+($produit*$famille['prix']);
       }else if ($famille['famille']=="BOISSON") {
         $BOI=$BOI+($produit*$famille['prix']);
       }else if ($famille['famille']=="DEO & PARFUM") {
         $DEO=$DEO+($produit*$famille['prix']);
       }else if ($famille['famille']=="HYGIENE BUCO-DENTAIRE") {
         $HBD=$HBD+($produit*$famille['prix']);
       }else if ($famille['famille']=="HYGIENE CORPORELLE") {
        $HC=$HC+($produit*$famille['prix']);
       }else if ($famille['famille']=="LESSIVE") {
         $LES=$LES+($produit*$famille['prix']);
       }else if ($famille['famille']=="SOINS CAPILLAIRE") {
        $SC=$SC+($produit*$famille['prix']);
       }else if ($famille['famille']=="SOINS VISAGE") {
         $SV=$SV+($produit*$famille['prix']);
       }

 } 

$totalprix=array();
$totalprix=["AUTRES"=>$AUT ,"BEAUTE" =>$BEA ,"BOISSON" =>$BOI ,"DEO & PARFUM" =>$DEO ,"HYGIENE BUCO-DENTAIRE" =>$HBD,"HYGIENE CORPORELLE" =>$HC  ,"LESSIVE"=>$LES ,"SOINS CAPILLAIRE" =>$SC ,"SOINS VISAGE" =>$SV];
return $totalprix;
}

$lab="";
$statprix=totalprix($sql,$main);
$stat=nombreproduit($sql,$main);
$COM=nombreproduit($sql,$main);
$livre=nombreproduit($sqllivre,$main);
$Annule=nombreproduit($sqlAnnule,$main);
$plan=nombreproduit($sqlPlan,$main);
$tdc=nombreproduit($sqltdc,$main);
$repport=nombreproduit($sqlrep,$main);
foreach ($stat as $key => $stat) {
  if ($stat['AUTRES']!=0) {
    $lab=$lab.",".$key;
  }else if ($stat['BEAUTE']!=0) {
   $lab=$lab.",".$key;
  }else if ($stat['BOISSON']!=0) {
   $lab=$lab.",".$key;
  }else if ($stat['DEO & PARFUM']!=0) {
   $lab=$lab.",".$key;
  }else if ($stat['HYGIENE BUCO-DENTAIRE']!=0) {
   $lab=$lab.",".$key;
  }else if ($stat['HYGIENE CORPORELLE']!=0) {
   $lab=$lab.",".$key;
  }else if ($stat['LESSIVE']!=0) {
   $lab=$lab.",".$key;
  }else if ($stat['SOINS CAPILLAIRE']!=0) {
   $lab=$lab.",".$key;
  }else if ($stat['SOINS VISAGE']!=0) {
   $lab=$lab.",".$key;
  }
}
$lab='["AUTRES","BEAUTE","BOISSON","DEO & PARFUM","HYGIENE BUCO-DENTAIRE","HYGIENE CORPORELLE","LESSIVE","SOINS CAPILLAIRE","SOINS VISAGE"]';
?>
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb"  style=" box-shadow: 0px 2px #ddd;">
                    <li><i class="fa fa-home"></i><a href="index.html">Accueil</a></li>
                    <li><i class="fa fa-home"></i>Listes des Produits</li>
                </ol>
            </div>
        </div>
        </div>  
        <div class="row" style="margin-top:0px;margin-bottom:0px; padding:none;">
<a href="#"  data-toggle="modal" data-target="#PRV">           
    <div class="col-md-2" >
        <div class="row" style="padding-left:15px;padding-right:0px;" >
            <div class="col-md-4" style="background:#03a5cc;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
               <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
             Commandés <br>
            Nombre:&nbsp;<?=$main->nombre_de_Produit_comm($_SESSION['login']['matricule'],date('Y-m'))?><br>
            CA: <?=$main->ca_comme($_SESSION['login']['matricule'],date('Y-m'))?> Ar
          
            </div>
        </div>
    </div></a>

   <a href="#"  data-toggle="modal" data-target="#LV"> 
    <div class="col-md-2" style="padding-right:23px;padding-left:8px">
    <div class="row" style="padding-left:15px;padding-right:0px;" >
            <div class="col-md-4" style="background:#00a65a;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
                Livrés <br>
               Nombre: &nbsp;<?=$main->nombre_de_Produit_comm($_SESSION['login']['matricule'],date('Y-m'),'livre')?><br>
               CA: <?=$main->ca_comme($_SESSION['login']['matricule'],date('Y-m'),'livre')?>

                
            </div>
        </div>
    </div></a>
<a href="#"  data-toggle="modal" data-target="#AN">     
    <div class="col-md-2" style="padding-right:30px;padding-left:0px">
    <div class="row" style="padding-left:15px;padding-right:-5px;" >
            <div class="col-md-4" style="background:#e30832;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
             Non livrés<br>
             Nombre: &nbsp;<?=$main->nombre_de_Produit_comm($_SESSION['login']['matricule'],date('Y-m'),'annule')?><br>
               CA: <?=$main->ca_comme($_SESSION['login']['matricule'],date('Y-m'),'annule')?>

            </div>
        </div>
    </div></a>

<a href="#"  data-toggle="modal" data-target="#PL">     
    <div class="col-md-2" style="padding-right:40px;padding-left:0px">
     
    <div class="row" style="padding-left:10px;padding-right:0px;" >
            <div class="col-md-4" style="background:#3578E5;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-top-left-radius: 5px;border-top-left-radius: 5px">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:29px;padding-left:5px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;border-top-right-radius: 5px;border-bottom-right-radius: 5px">
               Confirmés<br/>
                Nombre: &nbsp;<?=$main->nombre_de_Produit_comm($_SESSION['login']['matricule'],date('Y-m'),'confirmer')?><br>
               CA: <?=$main->ca_comme($_SESSION['login']['matricule'],date('Y-m'),'confirmer')?>
            </div>
        </div>
    </div> 
</a>
<a href="#"  data-toggle="modal" data-target="#ETDC"> 
      <div class="col-md-2" style="padding-right:20px;padding-left:0px">
     
    <div class="row" style="padding-left:0px;padding-right:0px;" >
            <div class="col-md-4" style="background:orange;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:29px;padding-left:5px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;border-top-right-radius: 5px;border-bottom-right-radius: 5px">
              A confirmer<br/>
              Nombre: &nbsp;<?=$main->nombre_de_Produit_comm($_SESSION['login']['matricule'],date('Y-m'),'En_attente')?><br>
               CA: <?=$main->ca_comme($_SESSION['login']['matricule'],date('Y-m'),'En_attente')?>
            </div>
        </div>
    </div> 
    </div> 

</a>





</div>
            <!--carousel end-->
<div class="row" style="padding-left:15px;padding-right:20px;margin-top: 20px">
 <a href="#"  data-toggle="modal" data-target="#deoparfun">     
   <div class="col-md-3 content" style="height:180px;padding-right:35px;padding-left:15px">
          <div class="row" style="border:solid 5px #fff;background-image:url('../img/deo.png');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">DEO & PARFUM 
                     </h3>

                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                       Commandés : <b class="pull-right"> <?php echo $COM ['DEO & PARFUM'];?></b>
                      <br>Livrés :<b class="pull-right"> <?php echo $livre['DEO & PARFUM'];?></b>
                      <br>Annulés : <b class="pull-right"> <?php echo $Annule['DEO & PARFUM'];?></b>
                      <br>Confirmés : <b class="pull-right"> <?php echo $plan['DEO & PARFUM'];?></b>
                      <br>A confirmer:<b class="pull-right"> <?php echo $tdc['DEO & PARFUM'];?></b>
                      
                  </p>
            </div>
          </div>
        </div></a>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
        <a href="#"  data-toggle="modal" data-target="#hygiennecorporelle">    
          <div class="row" style="border:solid 5px white;background-image:url('../img/hygienne.png');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">HYGIENE CORPORELLE</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés : <b class="pull-right"><?php echo $COM ['HYGIENE CORPORELLE'];?></b> </b>
                      <br>Livrés : <b class="pull-right">  <?php echo $livre['HYGIENE CORPORELLE'];?></b>
                      <br>Annulés : <b class="pull-right"> <?php echo $Annule['HYGIENE CORPORELLE'];?></b>
                      <br>Confirmer : <b class="pull-right"> <?php echo $plan['HYGIENE CORPORELLE'];?></b>
                      <br>A confirmer :<b class="pull-right">  <?php echo $tdc['HYGIENE CORPORELLE'];?></b>

                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
          <a href="#"  data-toggle="modal" data-target="#soincapilaire">     
          <div class="row" style="border:solid 5px white;background-image:url('../img/capillaire.png');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">SOIN CAPILLAIRE</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés : <b class="pull-right"><?php echo $COM ['SOINS CAPILLAIRE'];?></b>
                      <br>Livrés : <b class="pull-right">  <?php echo $livre['SOINS CAPILLAIRE'];?></b>
                      <br>Annulés: <b class="pull-right"> <?php echo $Annule['SOINS CAPILLAIRE'];?></b>
                      <br>Confirmés :<b class="pull-right">   <?php echo $plan['SOINS CAPILLAIRE'];?></b>
                      <br>A confirmer : <b class="pull-right">  <?php echo $tdc['SOINS CAPILLAIRE'];?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
         <a href="#"  data-toggle="modal" data-target="#hygiennebucodentaire">  
          <div class="row" style="border:solid 5px white;background-image:url('../img/buco.png');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">HYGIENE BUCO-DENTAIRE </h3>
                  </p>

                  <p style="text-align:left;z-index:2;color:black">
                      Commandés :  <b class="pull-right"><?php echo $COM ['HYGIENE BUCO-DENTAIRE'];?></b>
                      <br>Livrés:   <b class="pull-right">  <?php echo $livre ['HYGIENE BUCO-DENTAIRE'];?></b>
                      <br>Annulés :  <b class="pull-right"> <?php echo $Annule['HYGIENE BUCO-DENTAIRE'];?></b>
                      <br>Confirmés : <b class="pull-right">  <?php echo $plan['HYGIENE BUCO-DENTAIRE'];?></b>
                      <br>A confirmer : <b class="pull-right">  <?php echo $tdc['HYGIENE BUCO-DENTAIRE'];?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>  
        


       


    </div>




    <div class="row" style="padding-left:15px;padding-right:20px;margin-top:50px">
        <div class="col-md-3 content" style="height:180px;padding-right:35px;padding-left:15px">
         <a href="#"  data-toggle="modal" data-target="#beaute">  
          <div class="row" style="border:solid 5px #fff;background-image:url('../img/beaute.png');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">BEAUTE 
                     </h3>

                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés :  <b class="pull-right"><?php echo $COM ['BEAUTE'];?></b>
                      <br>Livrés :    <b class="pull-right"> <?php echo $livre ['BEAUTE'];?></b>
                      <br>Annulés :  <b class="pull-right"><?php echo $Annule['BEAUTE'];?></b>
                      <br>Confirmés :  <b class="pull-right"><?php echo $plan['BEAUTE'];?></b>
                      <br>A confirmer : <b class="pull-right"> <?php echo $tdc['BEAUTE'];?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
           <a href="#"  data-toggle="modal" data-target="#lessive">  
          <div class="row" style="border:solid 5px white;background-image:url('../img/lessive.png');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">LESSIVE </h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right"><?php echo $COM ['LESSIVE'];?></b>
                      <br>Livrés :  <b class="pull-right">  <?php echo $livre['LESSIVE'] ;?></b>
                      <br>Annulés : <b class="pull-right"> <?php echo $Annule['LESSIVE'];?></b>
                      <br>Confirmés : <b class="pull-right"> <?php echo $plan['LESSIVE'];?></b>
                      <br>A confirmer : <b class="pull-right"> <?php echo $tdc['LESSIVE'];?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
         <a href="#"  data-toggle="modal" data-target="#soinvisage">  
          <div class="row" style="border:solid 5px white;background-image:url('../img/visage.png');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">SOIN VISAGE</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right">   <?php echo $COM ['SOINS VISAGE'];?></b>
                      <br>Livrés :   <b class="pull-right">    <?php echo $livre['SOINS VISAGE'];?></b>
                      <br>Annulés : <b class="pull-right"> <?php echo $Annule['SOINS VISAGE'];?></b>
                      <br>Confirmés : <b class="pull-right"> <?php echo $plan['SOINS VISAGE'];?></b>
                      <br>A confirmer : <b class="pull-right"> <?php echo $tdc['SOINS VISAGE'];?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
          <a href="#"  data-toggle="modal" data-target="#boisson">  
          <div class="row" style="border:solid 5px white;background-image:url('../img/boisson.png');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">BOISSON </h3>
                  </p>

                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right"><?php echo $COM ['BOISSON'];?></b>
                      <br>Livrés :   <b class="pull-right"> <?php echo  $livre ['BOISSON'];?></b>
                      <br>Annulés :  <b class="pull-right"><?php echo $Annule['BOISSON'];?></b>
                      <br>Confirmés : <b class="pull-right"> <?php echo $plan['BOISSON'];?></b>
                       <br>A Confirmer : <b class="pull-right"> <?php echo $tdc['BOISSON'];?></b>

                  </p>
            </div>
          </div>
        </div>  
      </a>
    </div>  

    <div class="row" style="height: 20px">
      

    </div>
  <section class="panel" style="margin-top: 20px !important">
         <!--     <div id="c-slide" class="carousel slide auto panel-body" style="padding-left:15px;padding-right:20px; margin-top: 10px;height: 300px;">
                <ol class="carousel-indicators out">
                  <li class="active" data-slide-to="0" data-target="#c-slide"></li>
                  <li class="" data-slide-to="1" data-target="#c-slide"></li>
                  <li class="" data-slide-to="2" data-target="#c-slide"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item text-center active">   
                  <div class="col-lg-6 text-center">
                  <canvas id="fammile" class="text-center"></canvas>
                  </div>  
                  </div>
                  <div class="item text-center">
                    <div class="col-lg-6">
                  <canvas id="zone"></canvas>
                  </div>  
                  </div>
                  <div class="item text-center">
                   <div class="col-lg-6">
                  <canvas id="ca"></canvas>
                  </div>  
                  </div>
                </div>
                <a data-slide="prev" href="#c-slide" class="left carousel-control">
                                  <i class="arrow_carrot-left_alt2"></i>
                              </a>
                <a data-slide="next" href="#c-slide" class="right carousel-control">
                                  <i class="arrow_carrot-right_alt2"></i>
                              </a>
              </div>
    </section> -->
   

 <!-- Modal -->
        <div class="modal fade" id="deoparfun" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille DEO ET PARFUN<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduitdeopar">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>


        <!-- Modal -->
        <div class="modal fade" id="soincapilaire" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille SOIN CAPILLAIRE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduitsoincapilaire">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
   
        <!-- Modal -->
        <div class="modal fade" id="hygiennebucodentaire" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille HYGIENE BUCO DENTAIRE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduithygiennebucodentaire">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
    <!-- Modal -->
        <div class="modal fade" id="hygiennecorporelle" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille HYGIENE CORPORELLE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduithygiennecorporelle">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>


        <!-- Modal -->
        <div class="modal fade" id="beaute" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille Bauté<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduitbeaute">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>

        <!-- Modal -->
        <div class="modal fade" id="lessive" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille LESSIVE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduitlessive">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>

          <!-- Modal -->
        <div class="modal fade" id="soinvisage" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille SOIN DE VISAGE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listesoinvisage">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>


           <!-- Modal -->
        <div class="modal fade" id="boisson" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeboisson">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
<!--***********************************************************************************************************-->
       <!-- Modal -->
        <div class="modal fade" id="PRV" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="PRV">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="LV" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="LV">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="AN" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="ann">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="PL" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="PL">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="ETDC" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="ETDC">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
 <?php 
 $stat=['AUTRES'=>$COM['AUTRES'],'BEAUTE'=>$COM['BEAUTE'],'BOISSON'=>$COM['BOISSON'],'DEO & PARFUM'=>$COM['DEO & PARFUM'],'HYGIENE BUCO-DENTAIRE'=>$COM['HYGIENE BUCO-DENTAIRE'],'HYGIENE CORPORELLE'=>$COM['HYGIENE CORPORELLE'],'LESSIVE'=>$COM['LESSIVE'],'SOINS CAPILLAIRE'=>$COM['SOINS CAPILLAIRE'],'SOINS VISAGE'=>$COM['SOINS VISAGE']];
 arsort($stat);
 arsort($statprix);
 $stat2=['AUTRES'=>$COM['AUTRES'],'BEAUTE'=>$COM['BEAUTE'],'BOISSON'=>$COM['BOISSON'],'DEO & PARFUM'=>$COM['DEO & PARFUM'],'HYGIENE BUCO-DENTAIRE'=>$COM['HYGIENE BUCO-DENTAIRE'],'HYGIENE CORPORELLE'=>$COM['HYGIENE CORPORELLE'],'LESSIVE'=>$COM['LESSIVE'],'SOINS CAPILLAIRE'=>$COM['SOINS CAPILLAIRE'],'SOINS VISAGE'=>$COM['SOINS VISAGE']];
 $couleur = ['AUTRES'=>'#ff4444','HYGIENE CORPORELLE'=>'#ff4444','BEAUTE'=>'#ffbb33','BOISSON'=>'#00C851', 'DEO & PARFUM'=>'#33b5e5', 'HYGIENE BUCO-DENTAIRE'=>'#9933CC', 'LESSIVE'=>'#2BBBAD', 'SOINS CAPILLAIRE'=>'#FF8800', 'SOINS VISAGE'=>'#CC0000'];

 ?>

<section class="panel">
              <header class="panel-heading">
         <h3>STATISTIQUE PAR FAMILLE DES PRODUITS COMMANDE </h3> 
              </header>
              <div class="panel-body">
             <div class="col-md-6">  
              <p style="font-size: 18px;">Par Nombre de Produit </p>
               <?php 
               if($stat){
                foreach ($stat as $key => $stat) {
                 
                 if ($stat!=0) {
                  $pr=($stat*100)/$CA;
                    echo $key."( ".$stat." Produit )";  
                    
                ?>
          

  <div class="progress progress-striped progress-sm" style="height: 15px;">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $pr."%"; ?>;background-color:<?php echo $couleur[$key]; ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
    <?php             
      echo number_format($pr)."%";
    ?>
  </div>
</div>     
                <?php  
                     }}}?>
          </div> 

<div class="col-md-6">
  <p style="font-size: 18px;">Par Chifre d'affaire </p>
  
 <?php 



               if($statprix){
                foreach ($statprix as $key => $statprix) {
                 
                 if ($statprix!=0) {
                    $prx=($statprix*100)/$totalPrevi;
                    echo $key."( ".number_format($statprix)." MGA )";  
                ?>
          
  <div class="progress progress-striped active progress-sm" style="height: 15px;">
  <div class="progress-bar" role="progressbar" style="width: <?php echo $prx."%"; ?>;background-color:<?php echo $couleur[$key];?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
    <?php             
      echo number_format($prx)."%";
    ?>
  </div>
</div>     
                <?php  
                     }}}?>

</div>



              </div>

            </section>
<div class="container">
  <div class="row">
    <div style="height: 190px">
          <canvas id="fammile" style="height: 150px;"></canvas>    
    </div>        
  </div>          
</div>            
            <!--progress bar end-->

<script type="text/javascript">
  $(document).ready(function(){
     liste();
     listesoincapi();
     listehygiennecorporelle();
     listehygienbucodentaire();
     listebeaute();
     listelessive();
     listesoinvisage();
     listeboisson();
        function liste (){
          $.post('fonction/fonctionlisteproduitdeoparfun.php',function(data){
            $('.listeproduitdeopar').empty().append(data); 
          });
        }
         function listesoincapi (){
          $.post('fonction/fonctionlisteproduitsoincapilaire.php',function(data){
            $('.listeproduitsoincapilaire').empty().append(data); 
          });
            var statut='Annule';
            $.post('fonction/fonctionModT.php',{statut:statut},function(data){
            $('.ann').empty().append(data); });
            
        }
         function listehygiennecorporelle (){
          $.post('fonction/fonctionlistproduithygiennecorporelle.php',function(data){
            $('.listeproduithygiennecorporelle').empty().append(data); 
          });
           var statut='livre';
          $.post('fonction/fonctionModT.php',{statut:statut},function(data){
            $('.LV').empty().append(data); });
        }
         function listehygienbucodentaire (){
          $.post('fonction/fonctionlisteproduithygiennebucodentaire.php',function(data){
            $('.listeproduithygiennebucodentaire').empty().append(data); 
          });
        }
         function listebeaute (){
          $.post('fonction/fonctionlisteproduitbeaute.php',function(data){
            $('.listeproduitbeaute').empty().append(data); 
          });
          $.post('fonction/fonctionProduitConf.php',function(data){
            $('.PL').empty().append(data); 
          });
        }
        function listelessive (){
          $.post('fonction/fonctionlisteproduitlessive.php',function(data){
            $('.listeproduitlessive').empty().append(data); 
          });
          var statut='on_attente';
            $.post('fonction/fonctionModT.php',{statut:statut},function(data){
            $('.ETDC').empty().append(data); });
         
        }
        function listesoinvisage (){
          $.post('fonction/fonctionlisteproduitsoinvisage.php',function(data){
            $('.listesoinvisage').empty().append(data); 
          });
        }
        function listeboisson (){
          $.post('fonction/fonctionlisteproduitboisson.php',function(data){
            $('.listeboisson').empty().append(data); 
          });
        }




       test();
        function test(){

$.post('fonction/fonctionlistemodal.php',{},function(data){
            $('.PRV').empty().append(data); 
          });
} 
        
           
            
            
var data1=[<?=$main->pourcentage_facture($_SESSION['login']['matricule'],'livre')?>,<?=$main->pourcentage_facture($_SESSION['login']['matricule'],'annule')?>,<?=$main->pourcentage_facture($_SESSION['login']['matricule'],'confirmer')?>,<?=$main->pourcentage_facture($_SESSION['login']['matricule'],'En_attente')?>];
var label1=['Livre',"Annule","Planifier","En attente de decision bourse"];
var ctx = document.getElementById('fammile');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: label1,
        datasets: [{
            label: '# of Votes',
            data: data1,
            backgroundColor: [
                '#00a65a',
                '#e30832',
                '#3578E5',
                '#ffa500'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var $data2="";
var ctx = document.getElementById('zone');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: $data2,
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
   /*/ $('canvas').remove();
    $('.item2').prepend('<canvas id="ca" height="80">Hello</canvas>');
    $('.item1').prepend('<canvas id="bar-chart-sample" height="80"></canvas>');*/
var data=[<?=$main->pourcentage_facture($_SESSION['login']['matricule'],'annule')?>,<?=$main->pourcentage_facture($_SESSION['login']['matricule'],'livre')?>,50];    
var ctx = document.getElementById('ca');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Produit non livrés', 'Produit Livrés ', 'Produit Commandés '],
        datasets: [{
            label: '# of Votes',
            data: data,
            backgroundColor: [
                '#e30832',
                '#00a65a',
                '#03a5cc'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});



  });
</script>


