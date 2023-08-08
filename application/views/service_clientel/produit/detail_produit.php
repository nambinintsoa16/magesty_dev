<fieldset><legend>Produit</legend>
<div class="container emp-profile">
            <form method="post">
              <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                          <form>
                        <img src="http://combo.in-expedition.com/images/produit/<?=$produit->Code_produit?>.jpg" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                <?=$produit->Code_produit?>
                                <input type="file" name="file"/>
                            </div>
                          </form>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        <strong><?=$produit->Designation." ".$produit->Quantites?></strong>
                                    </h5>
                                    <h5>
                                        <strong> Prix : <?=number_format($produit->Prix_detail,2,",",".")?> Ar </strong>
                                    </h5>
                                        
                                    <h5>
                                         Fabricant : <?=$produit->fabricant?> <br/>
                                         Famille : <?=$produit->famille?> <br/>
                                         Groupe :<?=$produit->groupe?>
                                        
                                    </h5>
                                    <p class="proile-rating"> <div id="user-profile-2" class="user-profile">

                                    </div>    
   
                                


                                    </section>   
   



<div class="container">
        <div class="tabbable col-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#home">
                        <i class="orange ace-icon fa fa-lightbulb-o bigger-120"></i>
                        DESCRIPTION
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#feed">
                        <i class="orange ace-icon fa fa-info bigger-120"></i>
                        CONSEIL D’UTILISATION

                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#feeds">
                        <i class="orange ace-icon fa fa-info bigger-120"></i>
                        Argumentaire et Objections

                    </a>
                </li>
            </ul>

            <div class="tab-content bg-white">
                <div id="home" class="tab-pane in active">
                  <div class="container">
                    <div class="row">
                     <P class="text-justify"> <?=$produit->Description?></P>
                     <p class="text-justify" ></p>    
                      </div>
                    </div>
                </div>

                <div id="feed" class="tab-pane">
                  <div class="container">
                    <div class="row">   
                   <p class="text-justify"><?=$produit->modedutilisation?></p>  
                   <p class="text-justify" > </p> 
                    </div>
                  </div>
            </div>
            <div id="feeds" class="tab-pane">
                  <div class="container">
                    <div class="row">
                        <p class="text-justify"><?=$produit->argumentaire?></p>      
                        <p class="text-justify"></p>   
                    </div>
                  </div>
              </div>    
          </div>             
        </section>                
      </section>        