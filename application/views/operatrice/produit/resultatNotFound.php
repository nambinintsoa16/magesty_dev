<style>
    
.colorlib-body #colorlib-notfound {
  height:100vh;
}

#colorlib-notfound {
  position: relative;
  height: 60vh;
}

#colorlib-notfound .colorlib-notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.colorlib-notfound {
  max-width: 560px;
  width: 100%;
  padding-left: 160px;
  line-height: 1.1;
}

.colorlib-notfound .colorlib-notfound-404 {
  position: absolute;
  left: 0;
  top: 0;
  display: inline-block;
  width: 140px;
  height: 140px;
  background-image: url('../../assets/img/emoji.png');
  background-size: cover;
}

.colorlib-notfound .colorlib-notfound-404:before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-transform: scale(2.4);
      -ms-transform: scale(2.4);
          transform: scale(2.4);
  border-radius: 50%;
  background-color: #f2f5f8;
  z-index: -1;
}

.colorlib-notfound h1.colorlib-heading {
  font-family: 'Nunito', sans-serif;
  font-size: 65px;
  font-weight: 700;
  margin-top: 0px;
  margin-bottom: 10px;
  color: #151723;
  text-transform: uppercase;
}

.colorlib-notfound h2.colorlib-heading {
  font-family: 'Nunito', sans-serif;
  font-size: 21px;
  font-weight: 400;
  margin: 0;
  text-transform: uppercase;
  color: #151723;
}

.colorlib-notfound h1.colorlib-heading:after,
.colorlib-notfound h1.colorlib-heading:before,
.colorlib-notfound h2.colorlib-heading:after,
.colorlib-notfound h2.colorlib-heading:before {
  display: none;
}

.colorlib-notfound p {
  font-family: 'Nunito', sans-serif;
  color: #999fa5;
  font-weight: 400;
}

.colorlib-notfound a {
  font-family: 'Nunito', sans-serif;
  display: inline-block;
  font-weight: 700;
  border-radius: 40px;
  text-decoration: none;
  color: #388dbc;
}

@media only screen and (max-width: 767px) {
  .colorlib-notfound .colorlib-notfound-404 {
    width: 110px;
    height: 110px;
  }
  .colorlib-notfound {
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 110px;
  }
}

@media only screen and (max-height:600px){
  #colorlib-notfound {
    height:100vh;
  }
}
</style>
<div class="row">
       <div class="form-group col-md-12">
       <div class="pull-right card p-2" id="search-nav">
						<form class="navbar-right navbar-form nav-search mr-md-3" action="<?=base_url("$type_user/Produits/Recherche")?>" method="post">
							<div class="input-group">
                            <input type="text" name="mot" placeholder="Nouvelle recherche ..." class="form-control">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search ">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								
							</div>
						</form>
					</div>
       </div> 
+</div>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404"></div>
        <h1 class="colorlib-heading">404</h1>
        <h2 id="colorlib_404_customizer_page_heading" class="colorlib-heading">Ooops!!</h2>
        <p id="colorlib_404_customizer_content">Aucun résultat trouvé pour : "<?=$mot?>"</p>
    </div>
  
</div>