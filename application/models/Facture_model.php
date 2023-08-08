<?php
class Facture_model extends CI_Model 
{
    /*public function getAllFacture()
    {
        $sql = $this->db->query("SELECT * from facture ") ; 
        $result = $sql->result() ; 
        //echo(count($result)) ; 
        return $result ; 
    }*/
    public function getFactureAnnule()
    {
        return $this->db->query("SELECT * from facture ") ;  
    }
    public function selectFacture($requette=array()){
        return $this->db->where($requette)->get("facture")->row_object();
    }
    public function updateFacture($requette=array(),$data){
       return $this->db->where($requette)->update("facture",$data);
    }
    public function getClientByCode($codeClient)
    {
        $table = 'clientpo' ;
        if(strpos($codeClient, 'CLT-') === true) //verification du prefixe
        {
            $table= 'client' ; 
        }
        elseif (strpos($codeClient, 'CRX-') === true) {
            $table= 'client_curieux' ; 
        }
        $sql = "select * from ".$table." where Code_client = '".$codeClient."'" ; 
        $resultSet = $this->db->query($sql) ; 
        $result = $resultSet->result() ; 
        return $result ; 
    }

    //creation de la vue factureClient
    /*
        create view factureClient as select facture.* , cc.id as idClient , cc.Nom, cc.Link_facebook , cc.Matricule , cc.Date as dateClient, cc.Origin 
        from facture join client_curieux cc on facture.Code_client = cc.Code_client where Status = 'annule';
    */ 
    public function getListeFactureAnnule()
    {
        return $this->db->query("SELECT facture.Code_client from facture WHERE Status = 'annule' ") ;
    }
    public function Recherche($nom)
    {
        return $this->db->query("SELECT Code_client , nom ,  WHERE Status = 'annule' and  ") ;
    }
    public function getClientByCodeClient($code)
    {
        $table = '' ; 
        if(strpos($code, 'CLT') === true)
        {
            $table = 'client' ; 
        }
        else if(strpos($code, 'CMT') === true)
        {
            $table = 'clientpo' ; 
        } 
        else
        {
            $table = 'client_curieux' ; 
        }
        return  $this->db->get_where($table, array('Code_client' => $code ))->row();
        //return $this->db->query("SELECT * from client_curieux where Code_client = 'CRX-0015677-17-11-2020' " ) ;
    }

    public function getClientInfo($codeclient){
        $code_check = substr($codeclient,1,3);
        if($code_check == "CRX"){
            $query = $this->db->query("SELECT client_curieux.Code_client, client_curieux.Nom FROM `facture`,
             client_curieux WHERE facture.Code_client like client_curieux.Code_client AND facture.Code_client like  LIMIT 1 ");
             return $query->result();
        }elseif($code_check == "CMT"){
            $query = $this->db->query("SELECT clientpo.Code_client, clientpo.Nom FROM `facture`,
            clientpo WHERE facture.Code_client like clientpo.Code_client AND facture.Code_client like '$codeclient' LIMIT 1 ");
            return $query->result();
        }else{
            $query = $this->db->query("SELECT client.Code_client, client.Nom FROM `facture`,
            client WHERE facture.Code_client like client.Code_client AND facture.Code_client like '$codeclient' LIMIT 1 ");
            return $query->result();

        }


    }
    public function verifierPdp($codeClient) //profil_vide
    {
        $path = null ; 
        if (file_exists("images/client/".$codeClient.".jpg"))
        {
            $path = $codeClient;
        }
        else
        {
            $path = "profil_vide";
        }
        return $path ; 
        
    }
    public function setUserSesion($data)
    {
        $this->session->set_userData('id', $data);
    }
    public function getUserSession()
    {
        return $this->session->userData('id') ;
    }
    public function testAppel()
    {
        echo("hello from php") ; 
    }
    public function getDiscussionByCodeClient($codeClient)
    {
        return $this->db->query("select * from discussion where client like '".$codeClient."' AND `page` LIKE '24' order by Id DESC limit 1")->row();
    }
    public function consultDiscussionByCodeClient($codeClient)
    {
        return $this->db->query("select * from discussion where client like '".$codeClient."'")->row();
    }
    public function getDiscu($disc)
    {
        return  $this->db->query("select * from discussion_content where Id_discussion LIKE '".$disc."' and page like '24' ")->result_array()  ; 
    }
    public function getDsc($disc) 
    {
        return  $this->db->query("select * from discussion_content where Id_discussion LIKE '".$disc."' and page not like '24' ")->result_array()  ; 
    }
    public function insertDiscu($codeClient , $sender , $messageContent , $messageType)
    {
        //recuperation de  l'id discussion dans la table discussion 
        $id_discussion = "" ; 
        $discussion = $this->db->query("select * from discussion where client like '".$codeClient."' and page like '24' order by Id DESC limit 1")->row();
        if($discussion == null )
            throw new Exception("aucune discussion");
        else  $id_discussion = $discussion->id_discussion ; 
        
        //matricule de l' utilisateur en cour
        //$matricule =$this->session->all_userdata()["matricule"] ; 

        /*$time = date("Y-m-d H:i:s") ;
        echo $time ; */
        
        if($messageType == "file")
        {
            $file = basename($messageContent, ".jpg");
            $messageContent = $codeClient.''.$file ; 
            $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
            $heure = $now->format("Y-m-d H:i:s") ; 
            $data = array( 
                'Id' => 0,
                'Message' => $messageContent, 
                'check' => NULL, 
                'appreciation' => NULL,
                'Id_controlleur' => NULL, 
                'Type' => $messageType, 
                'sender' => $sender,
                'Id_discussion' => $id_discussion, 
                'Id_reponse' => NULL,
                'heure' => $heure,
                'Page' => 24
            ) ;
            $this->db->insert('discussion_content' , $data) ; 
        }
        else
        {
            $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
            $heure = $now->format("Y-m-d H:i:s") ; 
            $data = array(
                'Id' => 0,
                'Message' => $messageContent,
                'check' => NULL,
                'appreciation' => NULL,
                'Id_controlleur' => NULL,
                'Type' => $messageType, 
                'sender' => $sender,
                'Id_discussion' => $id_discussion, 
                'Id_reponse' => NULL,
                'heure' => $heure,
                'Page' => 24
            ) ;
            $this->db->insert('discussion_content' , $data) ; 
        }
    }
    

    public function insertDiscuTest($codeClient , $sender , $messageContent , $messageType)
    {
        $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
        $heure = $now->format("Y-m-d H:i:s") ; 
        $data = array(
            
            'Id' => 0,
            'Message' => $messageContent,
            'check' => NULL,
            'appreciation' => NULL,
            'Id_controlleur' => NULL,
            'Type' => $messageType,
            'sender' => $sender,
            'Id_discussion' => 'DISC-1-16-2020', 
            'Id_reponse' => NULL,
            'heure' => $heure,
            'Page' => 24
        ) ;
        $this->db->insert('discussion_content' , $data) ; 
    }
    public function terminerDiscussion($codeClient)
    {
        $id_discussion = "" ; 
        $discussion = $this->db->query("select * from discussion where client like '".$codeClient."' AND `page` LIKE '24' order by Id DESC limit 1")->row();
        if($discussion == null )
            throw new Exception("aucune discussion");
        else  $id_discussion = $discussion->id_discussion ; 

        //matricule de l' utilisateur en cour
        //$matricule =$this->session->all_userdata()["matricule"] ; 

        /*$time = date("Y-m-d H:i:s") ;
        echo $time ; */
        
        $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
        $heure = $now->format("Y-m-d H:i:s") ; 
        $data = array(
            
            'Id' => 0,
            'Message' => 'termine',
            'check' => NULL,
            'appreciation' => NULL,
            'Id_controlleur' => NULL,
            'Type' => 'termine', 
            'sender' => 'SAV',
            'Id_discussion' => $id_discussion, 
            'Id_reponse' => NULL,
            'heure' => $heure,
            'Page' => 24
        ) ;
        $this->db->insert('discussion_content' , $data) ;   
    }
    public function aSuivreDiscussion($codeClient)
    {
        $id_discussion = "" ; 
        $discussion = $this->db->query("select * from discussion where client like '".$codeClient."' AND `page` LIKE '24' order by Id DESC limit 1")->row();
        if($discussion == null )
            throw new Exception("aucune discussion");
        else  $id_discussion = $discussion->id_discussion ; 

        //matricule de l' utilisateur en cour
        //$matricule =$this->session->all_userdata()["matricule"] ; 

        /*$time = date("Y-m-d H:i:s") ;
        echo $time ; */
        
        $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
        $heure = $now->format("Y-m-d H:i:s") ; 
        $data = array(
            
            'Id' => 0,
            'Message' => 'a suivre',
            'check' => NULL,
            'appreciation' => NULL,
            'Id_controlleur' => NULL,
            'Type' => 'a suivre', 
            'sender' => 'SAV',
            'Id_discussion' => $id_discussion, 
            'Id_reponse' => NULL,
            'heure' => $heure,
            'Page' => 24
        ) ;
        $this->db->insert('discussion_content' , $data) ;   
    }
    public function getFactureAnnule2()
    {
        $query =$this->db->query("SELECT Code_client FROM facture where Status like 'annule'");
        $resultfact = $query->result();
        return $resultfact ; 

    }
    public function getClientByCodeClient2($codeClient)
    {
        $return = null ; 
        $sql  = $this->db->query("SELECT * FROM `client` WHERE `Code_client` like '$codeClient'");
        $clientresult = $sql->result();
        if(empty($clientresult))
        {
            $sql  = $this->db->query("SELECT * FROM `clientpo` WHERE `Code_client` like '$codeClient'");
            $clientresult2 = $sql->result();
            if(empty($clientresult2))
            {
                $sql  = $this->db->query("SELECT * FROM `client_curieux` WHERE `Code_client` like '$codeClient'");
                $clientresult3 = $sql->result();
                  
                $return =  $clientresult3;    
                    
            }
            else{
               
                    $return =  $clientresult2; 
                
            }
                            
        }  
                      
         
        else{
           
                $return = $clientresult ; 
            
           
        }           
        return $return ; 
    }
    public function priseEnCharge($idFacute)
    {
        $sql = "update facture set Etat_vente_annule = 'pris_en_charge' where Id like '".$idFacute."'" ; 
        $this->db->query($sql) ; 
    }
    public function getDistinctDateFactureAnnule()
    {
        return $this->db->query("SELECT distinct(livraison.date_de_livraison) from facture , livraison WHERE facture.Id_facture like livraison.Id_facture and facture.Status = 'annule' order by livraison.date_de_livraison desc")->result() ;
    }
    public function getListeFactureAnnuleByDate($date)
    {
        return $this->db->query("SELECT * from facture,livraison WHERE facture.Id_facture like livraison.Id_facture and facture.Status like 'annule' and livraison.date_de_livraison like '$date' and facture.Etat_vente_annule is NULL")->result() ; 
    }
    public function getProduitByIdFactureJson($idFacture)
    {
        echo json_encode($this->getProduitByIdFacture($idFacture));
    }
    public function getProduitByIdFacture($idFacture)
    {
        $sql = $this->db->query("SELECT * from detailvente where Facture like  '$idFacture' ")->result() ;
       
        $idPrix = null ; 
        
        foreach($sql as $data)
        {
         
            $idPrix = $data->Id_prix ; 
          
        }
        $sql2 = $this->db->query("SELECT * from prix where Id  like '$idPrix'")->result() ;
        $codeProduit = null ; 
            foreach($sql2 as $data2 )
            {
                $codeProduit = $data2->Code_produit ; 
            }
      
        $sql3 = $this->db->query("SELECT * from produit where Code_produit  like '$codeProduit'")->result() ;
        return $sql3 ; 
    }
    public function getFactureById($id)
    {
        $sql3 = $this->db->query("select * from facture where Id like '$id'")->result() ;
        return $sql3 ; 
    }
    public function getChiffreDaffaireByIdFacture($idFacture)
    {
        $sql = $this->db->query("SELECT * from detailvente where Facture like  '$idFacture' ")->result() ;
        $quantite = null ; 
        $idPrix = null ; 
        $typeDePrix = null ; 
        foreach($sql as $data)
        {
            $quantite = $data->Quantite ; 
            $idPrix = $data->Id_prix ; 
            $typeDePrix = $data->Type_de_prix ; 
        }
        $sql2 = $this->db->query("SELECT * from prix where Id  like '$idPrix'")->result() ;
        $prix = null ; 
        if($typeDePrix == "detail") 
        {
            foreach($sql2 as $data2 )
            {
                $prix = $data2->Prix_detail ; 
            }
        }
        else 
        {
            foreach($sql2 as $data2 )
            {
                $prix = $data2->Prix_epicerie ; 
            }
        }
        $ca = $prix * $quantite ; 
        return $ca ; 
    }
    public function getLivraisonByIdFacture($idFacture)
    {
        $sql = $this->db->query("SELECT * FROM `livraison` WHERE `Id_facture` LIKE '$idFacture' ")->result() ;
        return $sql ; 
    }
    public function getPageByNumeroDePage($numero)
    {
        $sql = $this->db->query("SELECT * FROM `comptefb` WHERE `id` LIKE '$numero' ")->result() ;
        return $sql ; 
    }
    public function getNomPgeByNumeroPage($page)
    {
        $nomPage = $this->getPageByNumeroDePage($page) ; 
       $np = null ; 
       foreach($nomPage as $nmp)
       {
            $np = $nmp->Nom_page ; 
       }
       return $np ; 
    }
    
    public function raftin($idFacture)
    {
        /*$raftin = array('designation'=>'','nombre'=>'','prix'=>'' , 'quartier'=> '' , 'toerana' => '' ,
         'dateLivraison' => '' , 'fraisLivraison'=> '' , 'total' => '' , 'client' => '' , 'matricule' => '' 
        ) ; */
        $sql = $this->db->query("SELECT * from detailvente where Facture like  '$idFacture' ")->result() ;
        $quantite = null ; 
        $idPrix = null ; 
        $typeDePrix = null ; 
        $quartier = null ; 
        $toerana = null ; 
        $codeClient = null ; 
        $matricule = null ; 
        foreach($sql as $data)
        {
            $quantite = $data->Quantite ; 
            $idPrix = $data->Id_prix ; 
            $typeDePrix = $data->Type_de_prix ; 
            
        }
        $sql2 = $this->db->query("SELECT * from prix where Id  like '$idPrix'")->result() ;
        $prix = null ; 
        if($typeDePrix == "detail")
        {
            foreach($sql2 as $data2 )
            {
                $prix = $data2->Prix_detail ; 
            }
        }
        else 
        {
            foreach($sql2 as $data2 )
            {
                $prix = $data2->Prix_epicerie ; 
            }
        }
        $designation = null ; 
       $ca = $prix * $quantite ; 
       $prod = $this->getProduitByIdFacture($idFacture) ; 
       
       foreach($prod as $pd)
       {
           $designation = $pd->Designation ; 
       }
       $fact = $this->getFactureById($idFacture) ; 
       $idf = null ; 
       $page = null ; 
       foreach($fact as $fc)
       {
            $idf = $fc->Id_facture ; 
            $quartier = $fc->Quartier ; 
            $toerana = $fc->lieu_de_livraison ; 
            $codeClient = $fc->Code_client  ;
            $matricule = $fc->Matricule_personnel  ; 
            $page =  $fc->Page  ; 
       }
       $nomPage = $this->getPageByNumeroDePage($page) ; 
       $np = null ; 
       foreach($nomPage as $nmp)
       {
        $np = $nmp->Nom_page ; 
       }

       $livraison = null ;
       $dateLivraison = null ; 
       $fraisLivraison = null ; 
       $lvr = $this->getLivraisonByIdFacture($idf) ; 
       foreach($lvr as $lv)
       {
            $dateLivraison = $lv->date_de_livraison ; 
            $fraisLivraison = $lv->frais ; 
       }
       $cl = null ; 
       $link = null ; 
       $client = $this->getClientByCodeClient2($codeClient) ; 
       foreach($client as $c)
       {
            $cl = $c->Nom ;  
            $link  = $c->lien_facebook ;
       }
       $raftin = array(
        'designation'=> $designation,
        'nombre'=> $quantite,
        'prix'=> $prix ,
        'quartier'=> $quartier ,
        'toerana' => $toerana ,
        'dateLivraison' => $dateLivraison ,
        'fraisLivraison'=> $fraisLivraison , 
        'total' => $ca  , 
        'client' => $codeClient , 
        'page' => $np ,
        'nomClient' => $cl , 
        'lien_facebook' => $link
        ) ; 
        return $raftin ; 
    }
    public function getCodeClientByIdFacture($idFacture)
    {
        $sql3 = $this->db->query("select * from facture where Id like '$idFacture'")->result() ;
        $codeClient = null ; 
        foreach($sql3 as $sq)
        {
            $codeClient = $sq->Code_client ;
        }
        return $codeClient ; 
    }
    public function getLastInsertedDiscussion()
    {
        $sql = $this->db->query('select * from discussion where id like (select max(id) from discussion )')->row(); 
        return $sql ; 
    }
    public function getLastInsertedDiscussionByCodeClient($codeClient)
    {
        $sql = $this->db->query('select * from discussion where id like (select max(id) from discussion where client like "'.$codeClient.'")')->row(); 
        return $sql ; 
    }
    public function getOneDiscussionByCodeClient($codeClient)
    {
        return $this->db->query("select * from discussion where client like '".$codeClient."' limit 1 ")->row();
    }
    public function createNewDiscussion($idFacture) // by raftin 
    {
        $codeClient = $this->getCodeClientByIdFacture($idFacture) ; 
        $discussion = $this->getLastInsertedDiscussion() ; 
        $id_discussion = $discussion->id_discussion ; 
        $operatrice = $discussion->operatrice  ; 
        //$this->db->query->("insert into dscussion values(0 , "$id_discussion" , "$operatrice" , "$codeClient" , null , null  )") ;
        $var = explode('-' , $id_discussion) ; 
        $indiceDisc = $var[1] + 1 ; 
        $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
        $date = $now->format("d-m-Y ") ;
        $dsc = 'DISC-'.$indiceDisc.'-'.$date ; 
        $dt = array(
            'id' => 0,
            'id_discussion' => $dsc,
            'operatrice' => $operatrice,
            'client' => $codeClient,
            'page' => 24,
            'statut' => ''
        ) ;
        $this->db->insert('discussion' , $dt) ;
        $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
        $heure = $now->format("Y-m-d H:i:s") ;
        $raftin = $this->raftin($idFacture) ;
        $rft = '
        <p>Nicommande an\' ity vokatra ity ianao ('.$raftin['nomClient'].')  tao amin\' ny page : '.$raftin['page'].' </p>
        <p><b>Vokatra</b>: '. $raftin['designation'].'</p>
        <p>Mihisa: '. $raftin['nombre'].'</p>
        <p>Vidiny: '. $raftin['prix'].'</p>
        <p>Quartier: '. $raftin['quartier'].'</p>
        <p>Toerana: '. $raftin['toerana'].'</p>
        <p>Date de livraison: '. $raftin['dateLivraison'].'</p>
       
        <p>Total a payer: '. $raftin['total'].'</p>
        <p>'. $raftin['client'].'</p>
        <p> Lien facebook du client : '. $raftin['lien_facebook'].'</p> 
        ' ; 
        $data = array(

            'Id' => 0,
            'Message' => $rft,
            'check' => NULL,
            'appreciation' => NULL,
            'Id_controlleur' => NULL,
            'Type' => 'vente_Annule',
            'sender' => 'SAV',
            'Id_discussion' => $dsc,
            'Id_reponse' => NULL,
            'heure' => $heure,
            'Page' => 24 //id de la page service apres vente 
        ) ;
        $this->db->insert('discussion_content' , $data) ;
      //  var_dump($data) ; 
    }
    public function newDisc($codeClient)
    {  
        /*$discussion = $this->getLastInsertedDiscussion() ; 
        $id_discussion = $discussion->id_discussion ; 
        $operatrice = $discussion->operatrice  ; 
        //$this->db->query->("insert into dscussion values(0 , "$id_discussion" , "$operatrice" , "$codeClient" , null , null  )") ;
        $var = explode('-' , $id_discussion) ; 
        $indiceDisc = $var[1] + 1 ; 
        $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
        $date = $now->format("d-m-Y ") ;
        $dsc = 'DISC-'.$indiceDisc.'-'.$date ; 
        $dt = array(
            'id' => 0,
            'id_discussion' => $dsc,
            'operatrice' => $operatrice,
            'client' => $codeClient,
            'page' => 'SERVICE APRES VENTE',
            'statut' => ''
        ) ;
        $this->db->insert('discussion' , $dt) ; */
        $now = new DateTime(null, new DateTimeZone('Europe/Moscow'));
        $heure = $now->format("Y-m-d H:i:s") ;
       
        $id_discussion = "" ; 
        $discussion = $this->db->query("select * from discussion where client like '".$codeClient."' and page like '24' order by Id DESC limit 1")->row();
        if($discussion == null )
            throw new Exception("aucune discussion");
        else  $id_discussion = $discussion->id_discussion ;


       
        $data = array(

            'Id' => 0,
            'Message' => 'NouvelleDiscussion',
            'check' => NULL,
            'appreciation' => NULL,
            'Id_controlleur' => NULL,
            'Type' => 'NouvelleDiscussion',
            'sender' => 'SAV',
            'Id_discussion' => $id_discussion,
            'Id_reponse' => NULL,
            'heure' => $heure,
            'Page' => 24 //id de la page service apres vente 
        ) ;
        $this->db->insert('discussion_content' , $data) ;
    }
    
}
?>