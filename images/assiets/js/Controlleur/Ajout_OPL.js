$(document).ready(function(){
    $('.enre').on('click',function(e){
    	e.preventdefault();
				var	Date_d_embauche=$('Date_d_embauche').val();
				var Matricule=$('Matricule').val();
				var	Nom=$('Nom').val();
				var	Prenom=$('Prenom').val();
				var Date_de_naissance=$('Date_de_naissance').val(); 
				var	Lieu_de_naissance=$('Lieu_de_naissance').val(); 
				var	Sexe=$('select1 option:selected').val();
				var	Situation_Matrimoniale=$('select2 option:selected').val();
				var	Nombre_d_enfant=$('Nombre_d_enfant').val();
				var	Cin_personnel=$('Cin_personnel').val();
				var	Date_cin_personnel=$('Date_cin_personnel').val();
				var	Lieu_delivrance_du_cin_personnel=$('Lieu_delivrance_du_cin_personnel').val();
				var	Date_duplicata_cin_personnel=$('Date_duplicata_cin_personnel').val();
				var	Lieu_de_dupliacata_cin_personnel=$('Lieu_de_dupliacata_cin_personnel').val();
				var	Adresse_du_personnel=$('Adresse_du_personnel').val()
				var	Contact_du_personnel=$('Contact_du_personnel').val();
				var	Nom_et_prenom_du_tuteur=$('Nom_et_prenom_du_tuteur').val();
				var	Lien_de_parente=$('Lien_de_parente').val();
				var	Cin_du_tuteur=$('Cin_du_tuteur').val();
				var Date_de_delivrance_cin_tuteur=$('datecintuteur').val();
				var	Adresse_du_tuteur=$('Adresse_du_tuteur').val();
				var	Contact_du_tuteur=$('Contact_du_tuteur').val();
				var Fonction_a_l_embauche=$('select3 option:selected').val();
				var Fonction_actuelle=$('select4 option:selected').val();
				var Mode_de_pass_login=$('mdp').val();
				var statut=$('select5 option:selected').val();
				loading();

				console.log('Matricule');

			$.post(base_url+'controlleur/Ajout_OPL',{Date_d_embauche:Date_d_embauche ,Matricule:Matricule,Nom:Nom,Prenom:Prenom,Date_de_naissance:Date_de_naissance,Lieu_de_naissance:Lieu_de_naissance,Sexe:Sexe,
				Situation_Matrimoniale:Situation_Matrimoniale,Nombre_d_enfant:Nombre_d_enfant,Cin_personnel:Cin_personnel,Date_cin_personnel:Date_cin_personnel,Lieu_delivrance_du_cin_personnel:Lieu_delivrance_du_cin_personnel,
				Date_duplicata_cin_personnel:Date_duplicata_cin_personnel,Lieu_de_dupliacata_cin_personnel:Lieu_de_dupliacata_cin_personnel,Adresse_du_personnel:Adresse_du_personnel,Contact_du_personnel:Contact_du_personnel,Nom_et_prenom_du_tuteur:Nom_et_prenom_du_tuteur,Lien_de_parente:Lien_de_parente,
				Cin_du_tuteur:Cin_du_tuteur,Date_de_delivrance_cin_tuteur:Date_de_delivrance_cin_tuteur,Adresse_du_tuteur:Adresse_du_tuteur,Contact_du_tuteur:Contact_du_tuteur,Fonction_a_l_embauche:Fonction_a_l_embauche,Fonction_actuelle:Fonction_actuelle,
				Mode_de_pass_login:Mode_de_pass_login,statut:statut },function(){						
				$('Date_d_embauche').val("");
				$('Matricule').val("");
				$('Nom').val("");
				$('Prenom').val("");
				$('Date_de_naissance').val(""); 
				$('Lieu_de_naissance').val(""); 
				$('select1 option:selected').val("");
				$('select2 option:selected').val("");
				$('Nombre_d_enfant').val("");
				$('Cin_personnel').val("");
				$('Date_cin_personnel').val("");
				$('Lieu_delivrance_du_cin_personnel').val("");
				$('Date_duplicata_cin_personnel').val();
				$('Lieu_de_dupliacata_cin_personnel').val("");
				$('Adresse_du_personnel').val("")
				$('Contact_du_personnel').val("");
				$('Nom_et_prenom_du_tuteur').val("");
				$('Lien_de_parente').val("");
				$('Cin_du_tuteur').val("");
				$('datecintuteur').val("");
				$('Adresse_du_tuteur').val("");
				$('Contact_du_tuteur').val("");
				$('select3 option:selected').val("");
				$('select4 option:selected').val("");
				$('mdp').val("");
				$('select5 option:selected').val("");

				});

        });
});
function loading(){ 
	let data='<div class="d-flex justify-content-center" style="height:50px;width: 50px;margin: auto;"><img src="'+base_url+'/images/loading.gif"></div>';
	$.confirm({
	 title: '',
	 content:  data,
	 cancelButton: false,
	 confirmButton: false,
	 buttons: { ok: { isHidden: true } }
   });
   }