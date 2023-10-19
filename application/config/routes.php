<?php
defined('BASEPATH') or exit('No direct script access allowed');
$type_user = "Appel_telephonique|appel_telephonique|tsena_koty|Tsena_koty|controlleur|operatrice|Operatrice|service_clientel|Controlleur|Service_clientel|Service_comptabilite|service_comptabilite|administrateur|Administrateur";

/*****operatrice *****/

$route["($type_user)/Etat_de_ventes/calendrier_de_livraison"] = 'operatrice/calendrier_de_livraison';
$route["($type_user)/Commandes"] = 'Operatrice/Commandes';
$route["($type_user)/Discussion/Nouveau"] = 'Operatrice/nouveaux_discution';
$route["($type_user)/Clients/importer_client_potentiel"] = 'Operatrice/importer_client_potentiel';
$route["($type_user)/clients/call"] = 'Operatrice/call';
$route["($type_user)/clients/liste"] = 'Operatrice/liste';
$route["($type_user)/clients/support_trc014"] = 'Operatrice/support_trc014';
$route["($type_user)/clients/support_trc028"] = 'Operatrice/support_trc028';
$route["($type_user)/clients/rdv_detail"] = 'Operatrice/rdv_detail';
$route["($type_user)/clients/rang"] = 'Operatrice/rang';
$route["($type_user)/clients/historique"] = 'Operatrice/historique';
$route["($type_user)/clients/liste_mise_a_jour"] = 'Operatrice/liste_mise_a_jour';
$route["($type_user)/clients/relance"] = 'Operatrice/relance';
$route["($type_user)/clients/clientappel"] = 'Operatrice/clientappel';
$route["($type_user)/Clients/Liste_des_clients/(:any)"] = 'Clients/liste_des_client/$2';
$route["($type_user)/Clients/Liste_des_clients"] = 'Clients/liste_des_client';
$route["($type_user)/Liste_des_clients"] = 'Clients/liste_des_client';
$route["($type_user)/Produits/Liste_des_produits/(:any)"] = 'Operatrice/Liste_des_produit/$2';
$route["($type_user)/Produits/Liste_des_produits"] = 'Operatrice/Liste_des_produit';
$route["($type_user)/Produits/mise_a_jour"] = 'Operatrice/mise_a_jour';
$route["($type_user)/Jeux/Tombola"] = 'Operatrice/Listetombolat';
$route["($type_user)/operatrice/livraison"] = 'operatrice/livraison';
$route["($type_user)/Commentaire/Enregistre"]= 'operatrice/enregistre_commentaire';

/*Listes relances */
$route["($type_user)/Liste_des_relances/Tombola"] = 'Operatrice/Listetombolat';
$route["($type_user)/Liste_des_relances/liste_clientaac007"] = 'Relance/liste_client';
$route["($type_user)/Liste_des_relances/liste_clientaac014"] = 'Relance/liste_clientaac014';
$route["($type_user)/Liste_des_relances/liste_clientaac021"] = 'Relance/liste_clientaac021';
$route["($type_user)/Liste_des_relances/liste_clientaac028"] = 'Relance/liste_clientaac028';
$route["($type_user)/Liste_des_relances/liste_clientaac035"] = 'Relance/liste_clientaac035';
$route["($type_user)/Liste_des_relances/liste_clientaac042"] = 'Relance/liste_clientaac042';
$route["($type_user)/Liste_des_relances/liste_clientaac056"] = 'Relance/liste_clientaac056';
$route["($type_user)/Liste_des_relances/client_a_traiterAAC49"] = 'Relance/client_a_traiterAAC49';
$route["($type_user)/Liste_des_relances/client_a_traiterAAC70"] = 'Relance/client_a_traiterAAC70';
$route["($type_user)/Liste_des_relances/CLT007"] = 'Relance/CLT007';
$route["($type_user)/Liste_des_relances/vente_non_livrees"] = 'Relance/vente_non_livrees';
$route["($type_user)/Liste_des_relances/rendez_vous"] = 'Relance/rendez_vous';
$route["($type_user)/Liste_des_relances/jaime"] = 'Relance/jaime';
$route["($type_user)/Liste_des_relances/Rapport_des_relances"] = 'Relance/rapport';
$route["($type_user)/Liste_des_relances/rapport_relance"] = 'Relance/rapport_relance';
$route["($type_user)/Liste_des_relances/relance_produit"] = 'Relance/relance_produit';
$route["($type_user)/Liste_des_relances/produit_relance"] = 'Relance/produit_relance';
$route["($type_user)/Liste_des_relances/Discussion_relance"] = 'Relance/Discussion_relance';
$route["($type_user)/Liste_des_relances/nonTraite"] = 'Relance/Relance_non_traitee';
$route["($type_user)/Liste_des_relances/Enquete"] = 'Relance/Enquete';

$route["($type_user)/Etat_de_ventes"] = 'Operatrice/Etat_de_ventes';
$route["($type_user)/Etat_de_ventes/Produit"] = 'produit/produitVendu';
$route["($type_user)/Clients/detail_client/(:any)"] = 'clients/detail/$2';
$route["($type_user)/Relances/Journaliere"] = 'relance/Relances_Journaliere';
$route["($type_user)/Relances/Hebdomadaire"] = 'relance/Relances_Hebdomadaire';
$route["($type_user)/Relances/Mensuelle"] = 'Operatrice/Relances_Mensuelle';
$route["($type_user)/performance/(:any)"] = 'Operatrice/performance/$2';
$route["($type_user)/operatrice/client_detail"] = 'operatrice/client_detail';
$route["($type_user)/calendrier/detail_livraison/(:any)"] = 'Operatrice/detail_des_ventes/$2';
$route["($type_user)/Etat_de_livraison"] = 'Operatrice/Etat_de_livraison';
$route["($type_user)/Ca_livre_semaine_passe"] = 'Operatrice/Ca_livre_semaine_passe';

$route["($type_user)/detail_de_facture/(:any)"] = 'Operatrice/detail_de_facture/$2';


$route["($type_user)/Pense_-_bete"] = 'Operatrice/pensebete';

$route["($type_user)/Tache"] = 'Operatrice/Nouveau_discussion';

$route["($type_user)/Discussions"] = 'Operatrice/discussion';
$route["($type_user)/Produits/Liste_des_produits/detail_produit/(:any)"] = 'produit/detail/$2';
$route["($type_user)/calendrier_de_livraison/(:any)"] = 'calendrier/data_json_calendrier/$2';
$route["($type_user)/calendrier_de_livraisons/(:any)"] = 'calendrier/data_json_calendriers/$2';
$route["($type_user)/calendrier_de_livraisons_controlleur/(:any)"] = 'calendrier/data_json_controlleur_calendriers/$2';
$route["($type_user)/calendrier/data_json_calendrier/"] = 'calendrier/data_json_calendrier';

//$route["($type_user)/Tache"] = 'clients/liste';

$route["($type_user)/Produits/Recherche"] = 'produit/recherche';

$route["($type_user)/Clients/Recherche"] ='Clients/recherche';
$route["($type_user)/Clients/Mes_clients/(:any)"] = 'Clients/liste_des_client/$2';
$route["($type_user)/Clients/Mes_clients"] = "Clients/Client_prospet";
$route["($type_user)/calendrier/detail_livraison/(:any)"] = 'service_clientel/detail_de_livraison/$2';
$route["($type_user)/calendrier/detail_livraison_koty/(:any)"] = 'service_clientel/detail_de_livraison_koty/$2';
$route["($type_user)/calendrier/Calendrierdelivraison/(:any)"] = 'service_clientel/detail_de_livraison/$2';
$route["($type_user)/Etat_de_ventes/calendrier/(:any)"] = 'operatrice/detail_des_ventes/$2';
$route["($type_user)/listedemande/(:amy)/(:any)"] = "accueil/listedemande/$2/$3";


$route["($type_user)/dataProduitUsers/(:any)"] = "operatrice/dataProduitUsers/$2/$3";
$route["($type_user)/dataProduitUser/(:any)"] = "operatrice/dataProduitUser/$2/$3";
$route["($type_user)/gobale/groupe/(:any)"] = 'gobale/groupe/$2';
$route["($type_user)/gobale/famille"] = 'gobale/famille/$2';
$route["($type_user)/cart"] = 'Operatrice/cart';
/************************************Rapport********************************************/
$route["($type_user)/Rapport/Journalier"] = 'User/rapport_du_jour';

//_____________________________________________________________________________
//_______________________________________________________________ Administrateur

$route["($type_user)/Vente/Modifier"] = 'Administrateur/Modifier';
$route["($type_user)/Vente/Annuler"] = 'Administrateur/AnnulerVente';
$route["($type_user)/Vente/Bon_d_achat"] = 'Administrateur/Bon_d_achat';


$route["($type_user)/Promotion/Mes_Promotion"] = "Administrateur/Mes_Promotion";
$route["($type_user)/Promotion/Nouveau"] = "Administrateur/nouveau_promotion";

$route["($type_user)/Clients/Liste_des_clients"] = "Clients/liste_des_client";

$route["($type_user)/Koty/Bonus_Koty"] = "Administrateur/Tsena_Koty";
$route["($type_user)/Koty/Transaction"] = "Administrateur/Transaction_Koty";
$route["($type_user)/Koty/Smile"] = "Administrateur/Smile";
$route["($type_user)/Koty/Mouvement_Smile"] = "Administrateur/mouvementSmileListe";


$route["($type_user)/Jeux/Tombola/Resultat"] = "Administrateur/ResultatTombola";
$route["($type_user)/Jeux/Tombola/Parametre/Nouveau"] = "Administrateur/NouveauTombola";
$route["($type_user)/Jeux/Tombola/Parametre/Liste_des_parametre"] = "Administrateur/ListeDesParametreTombola";
$route["($type_user)/Jeux/Tombola/Parametre/Statistique_des_jeux"] = "Administrateur/Statistique_des_jeux";


$route["($type_user)/Parametre_d_appel/Importer_fichier"] = "Administrateur/Importer_fichier";
$route["($type_user)/Gestion_facebook/Page/Rattacher_page"] = "Administrateur/Rattacher_page";
$route["($type_user)/Gestion_facebook/Page/Gerer_page"] = "Administrateur/Gerer_page";
$route["($type_user)/Gestion_facebook/Compte/Nouveau_compte"] = "Administrateur/Nouveau_compte";

$route["($type_user)/Parametre_d_appel/Entrant"] = "Administrateur/ParametreAppelEntrant";
$route["($type_user)/Parametre_d_appel/Sortant"] = "Administrateur/ParametreAppelSortant";

$route["($type_user)/Vente/Bon_d_achat/Bon_achat_des_client"] = "Administrateur/Bon_d_achat";
$route["($type_user)/Vente/Bon_d_achat/Parametre_des_bon_d_achat"] = "Administrateur/Parametre_des_bon_d_achat";


$route["($type_user)/Gestion_facebook/Produit_operatrice"]="Administrateur/Produit_operatrice";
$route["($type_user)/Enquette/Creation_question"]="Administrateur/nouveau_enquette";

//________________________________________________________________________
//___________________________________________________________________appel


$route["($type_user)/Tache/Discussions"] = "Appel_telephonique/discussions";
$route["($type_user)/Appel/Entrant"] = "Appel_telephonique/Entrant";
$route["($type_user)/Appel/Sortant"] = "Appel_telephonique/Sortant";
$route["($type_user)/Appel/Rapport"] = "Appel_telephonique/Rapport";


/*********Tsena_koty****/
$route["($type_user)/Taches"] = "Tsena_koty/Tache";
$route["($type_user)/Carte_Gratee/Nouveau"] = "Tsena_koty/carteGratee";
$route["($type_user)/Carte_Gratee/Etat_carte"] = "Tsena_koty/Etat_carte_a_gratter";
$route["($type_user)/Taches/Discussion/(:any)"] = "Tsena_koty/Viewdiscussion/$2";

/**********************/
$route["($type_user)"] = 'accueil';
$route["deconnexion"] = 'Authentification/deconnexion';
//$route["logout"] = 'Authentification/deconnexion';
$route["Authentification"] = 'authentification';


$route['default_controller'] = 'authentification';
$route['404_override'] = 'erreur/notfound';
$route['translate_uri_dashes'] = FALSE;


/*********Service_clientel****/
$route["($type_user)/Mes_clients/Liste_des_clients"] = "Clients/liste_des_client";
//$route["($type_user)/Mes_clients/Etat_de_livraison/confirmer_commande/(:any)"] = "service_clientel/confirmer_commande/$2";



//$route["($type_user)/Produits/Liste_des_produits"] = "service_clientel/Liste_des_produits";
$route["($type_user)/Etat_de_livraison/Etat_de_livraison_du_jour"] = "service_clientel/etat_de_livraison";
$route["($type_user)/Etat_de_livraison/Etat_de_livraison_du_mois"] = "service_clientel/Etat_de_livraison_du_mois";
$route["($type_user)/Etat_de_livraison/Liste_clients_sans_achat_OLD"] = "service_clientel/Liste_clients_sans_achat";
$route["($type_user)/Etat_de_livraison/Liste_clients_sans_achat"] = "service_clientel/Liste_clients_sans_achat";
$route["($type_user)/Etat_de_livraison/Gain_koty_smiles"] = "service_clientel/Gain_koty_smiles";
$route["($type_user)/Etat_de_livraison/Vente_annuel"] = "service_clientel/Vente_annuel";
$route["($type_user)/Livraison_du_jour_export"] = "service_clientel/Livraion_du_jour_export";
$route["($type_user)/Etat_de_livraison/Exporter_livraison"] = "service_clientel/Exporte_livraison";

/*  sondage   et temoignage*/

$route["($type_user)/Nouveau_sondage"] = "operatrice/Nouveau_Sondage";
$route["($type_user)/Liste_sondage_et_temoignage"] = "operatrice/Liste_sondage";
$route["($type_user)/Nouveau_TSF"] = "operatrice/Mes_TSF";
$route["($type_user)/Liste_Temoignage_et_sondage_et_Faharetana"] = "Administrateur/Liste_TSF";
$route["($type_user)/Liste_Temoignage_et_sondage_et_Faharetana_pour_nos_publication"] = "Administrateur/Liste_TSF_Publication";




