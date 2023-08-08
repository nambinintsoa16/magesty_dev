<div class="wrapper">
    <div class="main-header">
        <div class="logo-header" data-background-color="<?=$base_color?>">
            <a href="/" class="logo text-white">
            <img src="<?= base_url("assets/images/logoMagesti.png")?>" style="width: 30px;" alt="navbar brand" class="navbar-brand image-logo">
            <span class="mt-1 ml-3"> <b>MAGESTI</b> </span>  </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="<?=$base_color?>">
				
    <div class="container-fluid">

				<div class="text-white logo">
                         <?php $dataPage = $this->session->userdata('page_fb');
                              $pageNav ="";
                              foreach($dataPage as $dataPage){
                                    if($dataPage['id'] == $this->session->userdata("page")){
                                           $pageNav =  $dataPage['Nom_page'];
                                    }
                              }
                          ?>
						<h5><b><?=service(strtoupper($this->session->userdata('fonction')))?> | Matricule : <?= $this->session->userdata('matricule')?> | Page : <?=$pageNav?> </b></h5>
				</div>
					
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item toggle-nav-search hidden-caret">
                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                    <i class="fa fa-search"></i>
                </a>
            </li>
            <li class="nav-item dropdown hidden-caret">
            				<?php if(strtolower($type_user) =="operatrice" OR  strtolower($type_user)=="appel_telephonique"):?>
							<a class="nav-link " href="<?=base_url("Operatrice/Liste_des_relances/rendez_vous")?>"  role="button" aria-haspopup="true" aria-expanded="false">
								<i class="far fa-calendar-check"></i>
								<span class="notification  <?= count($this->global_model->rendez_vous($this->session->userdata('matricule'), date('Y-m-d'))) > 0 ? "bg-danger" : "bg-success" ?>"><?=count($this->global_model->rendez_vous($this->session->userdata('matricule'), date('Y-m-d')))?></span>
							</a>
            			   
                           <a class="nav-link" href="<?=base_url($type_user."/anniversaire")?>" id="notifDropdown" role="button"  aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-birthday-cake"></i>
								<span class="notification">0</span>
							</a>

                            <?php endif?>
                            
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class=" fa fa-paper-plane"></i>
								<span class="notification">0</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">Vous avez <span class="nbNotifi">0</span> relances</div>
								</li>
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center contPrev">
											
										</div>

									</div>
								</li>
								<li>
									<a class="see-all" href="<?=base_url('service_clientel/Urgence')?>">Voir toutes les Urgences<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
                        <li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="icon-refresh"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-<?=$nav_color?> animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Changer de page</span>
								</div>

								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											
										<?php
										$pages = $this->session->userdata('page_fb');
										 foreach($pages as $pages): ?>
										    <a class="col-6 col-md-4 p-0 linkPage" href="#" id="<?= $pages['id']?>">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text"><?= $pages['Nom_page']?>
													 <?php 
                                                     if($pages['id'] == $this->session->userdata("page")): ?>
                                                     <div class="text"> <i class="fa fa-check text-success"></i></div>
													   
												    <?php endif;?>
                                                    </span>
												</div>
											</a>
										<?php endforeach;?>	
										</div>
									</div>
								</div>
							</div>
						</li>            
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="<?=PhotoUser_img_link($this->session->userdata('matricule'))?>" alt="..." class="avatar-img rounded-circle">
                    </div>
                </a>
                <span class="collapse matricule"><?php echo $this->session->userdata('matricule')?></span>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"><img src="<?=PhotoUser_img_link($this->session->userdata('matricule'))?>" alt="Photo de profile" class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4><?=ucfirst($this->session->userdata("nom"))?></h4>
                                    <p class="text-muted"><?=ucfirst($this->session->userdata("prenom"))?></p><a href="<?=base_url($type_user."/performance")?>" class="btn btn-xs btn-<?=$nav_color?> btn-sm">View Profile</a>
                                </div>
                            </div>
                        </li>
                        <li class="text-center">
                            <div class="dropdown-divider "></div>
                            <a class="dropdown-item btn btn-<?=$nav_color?> text-white" href="<?=base_url('Authentification/deconnexion')?>">
                            <i class="icon-logout"></i>&nbsp;
                            Se déconnecter</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
</div>

