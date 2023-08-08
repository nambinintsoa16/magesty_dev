<?php

function breadcrumb($uri){
	$breadcrumb = $uri;
	if ( !isset($uri[2]) || !isset($_SESSION["matricule"])) {
		if(strtolower(trim($uri[1]))=='authentification'){

			return '';

		}else{
		return '<div class=p-0 m-0 w-100">
					<ol class="breadcrumb"  style=" box-shadow: 0px 2px #ddd;">
						<li><i class="fa fa-home"></i><a href="index.html">'.ucwords($uri[1]).'</a></li>
					</ol></div>';
	}
}	

		?>
            <div class="p-0 m-0 w-100 shadow">
            <ol class="breadcrumb">
			<li class="breadcrumb-item"><?=ucwords($uri[1])?></li> 
				<?php
				for($i = 2; $i <= count($breadcrumb); $i++){
					if ($i == count($breadcrumb) ):
						?>	
					    	<li class="breadcrumb-item"><a href="#"><?= tobreadcrumb($uri[$i])?></a></li>
						<?php
                    elseif ( $i < 3) : 
                        ?>
                          <li class="breadcrumb-item"><?= tobreadcrumb($uri[$i]) ?></li>
					<?php
					else:

						$link = [];
						for ($j = $i; $j >= 1 ; $j--) {
							$link[] = $uri[$j];
						}
						$link = implode("/", array_reverse($link));

						?>
					      <li class="breadcrumb-item"><a href="#"><?= tobreadcrumb($uri[$i]) ?></a></li>
						<?php
					endif;
				}
				?>
			 </ol>
            </div>
		<?php

}

function tobreadcrumb($txt_){
	$txt_ = str_split($txt_);
	$txt = "";
	foreach ($txt_ as $char) {
		if (ord($char) <= 90)  {
			$txt .= " $char";
		}
		else{
			$txt .= "$char";
		}
	}

	$txt = str_replace(".php", "", $txt);
	$txt = str_replace("_", " ", $txt);

	return ucfirst(strtolower(trim($txt)));
}

function code_produit_img_link($code_produit){
	$cd =  str_replace("0", "00", $code_produit);

	$link = base_url("images/operatrice/default_image.jpg");

	if (file_exists("images/produit/$code_produit.jpg")) {
		$link = base_url("images/produit/$code_produit.jpg");
	}elseif(file_exists("images/produit/$cd.jpg")){
		$link = base_url("images/produit/$cd.jpg");
	}
	return $link;
}

function js_link($type_user,$uri){

	if (file_exists("assets/js/".ucwords($type_user)."/". $uri .".js")) {
		$link =base_url("assets/js/".ucwords($type_user)."/". $uri .".js");
	}else{
		$link ="";
	}
	return $link;
}

function user_img_link($user){
	$cd =  str_replace("0", "00", $user);
	$link =base_url("/images/default_user.png");
	if (file_exists("images/operatrice/PhotoUser/$user.jpg")) {
		$link = base_url("images/operatrice/PhotoUser/$user.jpg");
	}elseif(file_exists("images/operatrice/PhotoUser/$cd.jpg")){
		$link = base_url("images/operatrice/PhotoUser/$cd.jpg");
	}
	return $link;
}
function code_client_img_link($code_produit){
	$cd =  str_replace("0", "00", $code_produit);

	$link =base_url('images/default_user.png');

	if (file_exists("images/client/$code_produit.jpg")) {
		$link = base_url("images/client/$code_produit.jpg");
	}elseif(file_exists("images/client/$cd.jpg")){
		$link = base_url("images/client/$cd.jpg");
	}
	return $link;
}

function PhotoUser_img_link($code_produit){
	$cd =  str_replace("0", "00", $code_produit);

	$link =base_url('images/default_user.png');

	if (file_exists("images/operatrice/PhotoUser/$code_produit.jpg")) {
		$link = base_url("images/operatrice/PhotoUser/$code_produit.jpg");
	}elseif(file_exists("images/operatrice/PhotoUser/$cd.jpg")){
		$link = base_url("images/operatrice/PhotoUser/$cd.jpg");
	}
	return $link;
}

function dateDuJour(){
    return "&nbsp;".jour(date('N'))." ". date('d')." " .mois(date('m'))." ".date('Y');
}

function service($parametre){
      $designation ="";
      if($parametre =="OPERATRICE" ){
		  $designation="E-COMBO &nbsp; SERVICE COMMERCIAL EN LIGNE";  
	  }else if($parametre ==strtoupper("Service_clientel")){
		        $designation="E-COMBO &nbsp; SERVICE CLIENTEL &nbsp; EN LIGNE";
	  }else if($parametre =="Administrateur"){
		        $designation="E-COMBO - ADMINISTRATEUR";
	  }else if($parametre =="Controlleur"){
		        $designation="E-COMBO - CONTROLLEUR";
	  }else if($parametre =="Service_apres_vente"){
		        $designation="E-COMBO - SERVICE APRES VENTE";
	  }else if($parametre ==strtoupper("Service_comptabilite")){
		$designation="E-COMBO - SERVICE COMPTABILITE";
      }else if($parametre ==strtoupper("administrateur")){
		$designation="E-COMBO - ADMINISTRATEUR";
      }else if($parametre ==strtoupper("Tsena_koty")){
		$designation="E-COMBO - TSENA KOTY";
	  }else if($parametre ==strtoupper("Appel_telephonique")){
		  $designation="E-COMBO - APPEL TELEPHONIQUE";  
	  }
		    
   return $designation;
}
function type_utilisateur_for_uri($id_designation){
	if ( in_array($id_designation, [1, 4, 6])) {
		return "commercial";
	}

	if ( in_array($id_designation, [3])) {
		return "controlleur";
	}

	if ( in_array($id_designation, [5,2])) {
		return "coach";
	}

	if ( in_array($id_designation, [7])) {
		return "magasiner";
	}
}


function false($var){
	return $var === FALSE || $var === "null" || $var === 0;
}

function to_autocomplete($array){
	$r = [];

	foreach ($array as $val){
		$r[] = implode(" | ", $val);
	}

	return json_encode($r);
}

function date_fr($date){
	return (new DateTime($date))->format('d/m/Y'); 
}

function pourcentage($max, $val){
	return ($val * 100) / $max;
}


function mois($num){
	return ["Janvier", "Fervier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"][$num - 1];
}

function jour($num){
	return ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"][$num-1];
}

function getclientstatutAnnuel($smiles){
	if($smiles <= 14999 AND $smiles >= 0){
		$statut ="BLUE";
		return $statut;
	}elseif ($smiles <= 24999 AND $smiles >= 15000) {
		$statut ="BRONZE";
		return $statut;
		
	}elseif ($smiles <= 44999 AND $smiles >= 25000) {
		$statut ="SILVER";
		return $statut;
		
	}elseif ($smiles <= 99999 AND $smiles >= 50000) {
		$statut ="GOLD";
		return $statut;
		
	}elseif ($smiles <= 9999999 AND $smiles >= 100000) {
		$statut ="PLATINIUM";
		return $statut;
		
	}else{
		$statut ="Votre statut n'est pas valide, veillez consulter le responsable technique";
		return $statut;
	}
}

function getclientstatuttrimes($smiles){
	if($smiles <= 1499 AND $smiles >= 0){
		$statut ="LEVEL 1";
		return $statut;
	}elseif ($smiles <= 2499 AND $smiles >= 1500) {
		$statut ="LEVEL 2";
		return $statut;
		
	}elseif ($smiles <= 4999 AND $smiles >= 2500) {
		$statut ="LEVEL 3";
		return $statut;
		
	}elseif ($smiles <= 9999 AND $smiles >= 5000) {
		$statut ="LEVEL 4";
		return $statut;
		
	}elseif ($smiles <= 99999999 AND $smiles >= 10000) {
		$statut ="LEVEL 5";
		return $statut;
		
	}else{

		$statut ="Votre statut n'est pas valide, veillez consulter le responsable technique";
		return $statut;

	}
}
function getclientstatutbgtrimes($smiles){
	if($smiles <= 1499 AND $smiles >= 0){
		$statut ="level1";
		return $statut;
	}elseif ($smiles <= 2499 AND $smiles >= 1500) {
		$statut ="level2";
		return $statut;
		
	}elseif ($smiles <= 4999 AND $smiles >= 2500) {
		$statut ="level3";
		return $statut;
		
	}elseif ($smiles <= 9999 AND $smiles >= 5000) {
		$statut ="level4";
		return $statut;
		
	}elseif ($smiles <= 99999999 AND $smiles >= 10000) {
		$statut ="level5";
		return $statut;
		
	}else{

		$statut ="Votre statut n'est pas valide, veillez consulter le responsable technique";
		return $statut;

	}
}

function getIntervaltrimerstriel() {
	$mois = date('m');
	$annee = date('Y');
	$dateBegin = ""; $dateEnd = "";
	if($mois >= 0 && $mois <= 2) {
		$dateBegin = "$annee-01-01";
		$dateEnd = "$annee-03-31";
	}else if($mois >= 3 && $mois <= 5) {
		$dateBegin = "$annee-04-01";
		$dateEnd = "$annee-06-30";
	}else if($mois >= 6 && $mois <= 8) {
		$dateBegin = "$annee-07-01";
		$dateEnd = "$annee-09-30";
	}else if($mois >= 9 && $mois <= 11) {
		$dateBegin = "$annee-10-01";
		$dateEnd = "$annee-12-31";
	}


	return ["debutTrimestre" =>$dateBegin, "finTrimestre" =>$dateEnd];
}
