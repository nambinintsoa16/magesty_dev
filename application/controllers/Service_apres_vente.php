<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Service_apres_vente extends My_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->model('Service_apres_vente_model');
        $this->load->model('Facture_model');
        $this->load->model('client_model');
    }
    
        
   public function tests(){
    $codeClient=$this->input->post('idclient');
       $json=array('message'=>'andrana','erreur'=>'true','codeclient'=>'');
       $json['codeclient']= '<div class="container"><img src="/w3images/bandmember.jpg" alt="Avatar"><p>'.$codeClient.'</p><span class="time-right">11:00</span></div>';
       //$ex = $this->db->query("select * from discussion where client ='".$codeClient."' ")->row(); 
      // var_dump($ex) ;
       echo json_encode($json);
   }
    /*
    foreach($donnee as $d):
            
           
                $discu = $discu.' 
                
                <div class="container">
                <img src="/w3images/bandmember.jpg" alt="Avatar">
                <p>'.$d["Message"].'</p>
                <span class="time-right">11:00</span>
              </div>
                
                ' ; 
            }
            else
            {
                $discu = $discu.' 
                
                <div class="container darker">
                <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
                <p>'.$d["Message"].'</p>
                <span class="time-left">11:01</span>
                  </div>
                
                ' ; 
            }
        endforeach ;
    
    */
    
   public function test(){
        $codeClient=$this->input->post('idclient');
        $json=array('message'=>'andrana','erreur'=>'true','codeclient'=>'' , 'type' => '');
        $json['codeclient']=$codeClient;
       // $json['content']='<div class="container"><img src="/w3images/bandmember.jpg" alt="Avatar"><p>'.$codeClient.'</p><span class="time-right">11:00</span></div>';
     $client = $this->Facture_model->getClientByCodeClient2($codeClient) ; 
       /* $cl = null ; 
        foreach($client as $c)
        {
                $cl = $c->Nom ;  
        } */
        $this->Facture_model->getDiscussionByCodeClient($codeClient)->id_discussion ;
        $donnee = array() ; 
        $donnee = $this->Facture_model->getDiscu($disc) ;
        $taille =count($donnee) ; 
        $type = $donnee[$taille-1]['Type'] ; 
        $json['type']= $type ;
        if(empty($disc)) 
        {
            $disc = '
            <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-12" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    
                <h3 style="text-align: center;">discussion vide</h3>
                    <span class="time-right"></span>
                </div>
            </div>
            ' ; 
        }
        else
        {
             foreach($donnee as $d):
                 if($d['Type'] == 'message')
                 {
                     if($d['sender'] == 'CLT')
                     {
                         $disc = $disc.'  
                         
                             <div class = "" style="margin-bottom:10px ;width:80% ; margin-left:20%">
                                 <div class = "" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                     <img src="'.base_url("images/client/".$this->Facture_model->verifierPdp($codeClient).".jpg").'" style="height:40px;width:40px;cursor:pointer;border:solid 4px white ; " >
                                     <p>'.$d['Message'].'</p>
                                     <span class="time-right"></span>
                                 </div>
                             </div>
                     
                     ' ; 
                     } 
                     else {
                         $disc = $disc.' 
                             
                         <div class = "" style="margin-bottom:10px ; width:80%">
                         <div class = "" style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                             
                             </div>
                         </div>
                             
                             ' ; 
                     }
                 }
                 elseif($d['Type'] == 'vente_Annule')
                 {
                    
                        $disc = $disc.' 
                            
                        <div class = "" style="margin-bottom:10px ; width:80%">
                        <div class = "" style="word-wrap: break-word ; background:green; color:black ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                            
                            </div>
                        </div>
                            
                    ' ; 
                 }
                 elseif($d['Type'] == 'termine'){
                    // $dateTime = $d['heure'] ; 
                    $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     $disc = $disc.'
                         
         
                     
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">termine le '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'a suivre'){
                     $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: #FFFF00 ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">a suivre depuis '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'NouvelleDiscussion'){
                     $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: green ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">nouvelle discussion le '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
                     ' ; 
                 }

                 else 
                 {
                     if($d['sender'] == 'CLT')
                     {
                         $disc = $disc.'  
                             <div class = "row" style="margin-bottom:10px ; ">
                                 <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                     <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-left:350px" >
                                 </div>
                             </div>
                     ' ; 
                     } 
                     else {
                         $disc = $disc.' 
                             
                         <div class = "row" style="margin-bottom:10px ; ">
                             <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                         
                                 <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-rigt:350px" >
                             <span class="time-left"></span>
                             </div>
                         </div>' ; 
                    }
                } 
             endforeach ;
        }
        
        $json['content']= $disc ;
       
       echo json_encode($json);
       //echo($donnee[$taille-1]['Page']);
   }
   public function index()
   {
       $data   = $this->Facture_model->getDistinctDateFactureAnnule() ; 
       
       $dt['dt'] = $data ; 

       $this->render_view('service_apres_vente/etat_de_livraison',$dt); 
   }
    public function prendreEnCharge()  
    {
        $idFacture=$this->input->post('idFacture');
        $this->Facture_model->priseEnCharge($idFacture) ; 
        
    }  
    public function consulterDiscu()
    {
        $codeClient =$this->input->post('codeClient'); 
        $json=array('message'=>'andrana','erreur'=>'true','content'=>'' );
     //   $json['codeclient']= '<div class="container"><img src="/w3images/bandmember.jpg" alt="Avatar"><p>'.$codeClient.'</p><span class="time-right">11:00</span></div>';

        $disc = $this->Facture_model->getDiscussionByCodeClient($codeClient)->id_discussion ;
        
        $donnee = $this->Facture_model->getDiscu($disc) ;
        if(empty($disc)) 
        {
            $disc = '
            <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-12" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    
                <h3 style="text-align: center;">discussion vide</h3>
                    <span class="time-right"></span>
                </div>
            </div>
            ' ; 
           
        }
       else
       {
            foreach($donnee as $d):
                if($d['Type'] == 'message')
                {
                    if($d['sender'] == 'CLT')
                    {
                        $disc = $disc.'  
                        
                            <div class = "" style="margin-bottom:10px ;width:80% ; margin-left:20%">
                                <div class = "" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                    <img src="'.base_url("images/client/".$this->Facture_model->verifierPdp($codeClient).".jpg").'" style="height:40px;width:40px;cursor:pointer;border:solid 4px white ; " >
                                    <p>'.$d['Message'].'</p>
                                    <span class="time-right"></span>
                                </div>
                            </div>
                    
                    ' ; 
                    } 
                    else {
                        $disc = $disc.' 
                            
                        <div class = "" style="margin-bottom:10px ; width:80%">
                        <div class = "" style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                            
                            </div>
                        </div>
                            
                            ' ; 
                    }
                }
                
                elseif($d['Type'] == 'vente_Annule')
                {
                   
                       $disc = $disc.' 
                           
                       <div class = "" style="margin-bottom:10px ; width:80%">
                       <div class = "" style="word-wrap: break-word ; background:green; color:black ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                           <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                           
                           </div>
                       </div>
                           
                   ' ; 
                }
                elseif($d['Type'] == 'termine'){
                    // $dateTime = $d['heure'] ; 
                    $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     $disc = $disc.'
                         
         
                     
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">termine le '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'a suivre'){
                     $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: #FFFF00 ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">a suivre depuis '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'NouvelleDiscussion'){
                     $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: green ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">nouvelle discussion le '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
                     ' ; 
                 }
                else 
                {
                    if($d['sender'] == 'CLT')
                    {
                        $disc = $disc.'  
                            <div class = "row" style="margin-bottom:10px ; ">
                                <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                    <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-left:350px" >
                                </div>
                            </div>
                    ' ; 
                    } 
                    else {
                        $disc = $disc.' 
                            
                        <div class = "row" style="margin-bottom:10px ; ">
                            <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                        
                                <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-rigt:350px" >
                            <span class="time-left"></span>
                            </div>
                        </div>    
                            
                            ' ; 
                    }
                }
            
            
            endforeach ;
        }
        
       
        

        $json['content']= $disc ;
       echo json_encode($json);

    }
    public function test2()
    {
        $idFacture=$this->input->post('idFacture'); 
        $raftin = $this->Facture_model->raftin($idFacture);
        $test = '
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
        $json=array('erreur'=>'true','content'=>$test );
        echo json_encode($json);
    }
    public function uploadFils($name){
    
        $arr = explode('_', $name, 2);
        $codeClient = $arr[0] ; 
        $file =  $arr[1] ; 
    // $file = basename($file, ".jpg");
        $name = $codeClient.''.$file ; 
    /*
            $id_discussion = "" ; 
            $discussion = $this->db->query("select * from discussion where client ='".$codeClient."' ")->row();
            if($discussion == null )
                throw new Exception("aucune discussion");
            else  
            {
                $id_discussion = $discussion->id_discussion ; 
            } */

        $jsons=array();
        $data=scandir(FCPATH .'images/pieceJoint');
        $uploads_dir = FCPATH .'images/pieceJoint';

    if(isset( $_FILES["file"]["tmp_name"]) && !empty( $_FILES["file"]["tmp_name"])){
            $tmp_name = $_FILES["file"]["tmp_name"];
            $nom = $name ; 
            $result=array('reponse'=>false);
            if(move_uploaded_file($tmp_name, "$uploads_dir/$nom")){
                $result['reponse'] = true;      
            }

        }else{
            
        }
        echo json_encode($result);
    }



    public function aSuivre()
    {
         $codeClient=$this->input->post('codeClient');
         $this->Facture_model->aSuivreDiscussion($codeClient) ; 
         $disc = $this->Facture_model->getDiscussionByCodeClient($codeClient)->id_discussion ;
      
        $donnee = $this->Facture_model->getDiscu($disc) ;
        $disc = '' ; 
        foreach($donnee as $d):
         if($d['Type'] == 'message')
         {
             if($d['sender'] == 'CLT')
             {
                 $disc = $disc.'  
                 
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             <img src="'.base_url("images/client/".$this->Facture_model->verifierPdp($codeClient).".jpg").'" style="height:40px;width:40px;cursor:pointer;border:solid 4px white ; " >
                             <p>'.$d['Message'].'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
                
             ' ; 
             } 
             else {
                 $disc = $disc.' 
                     
                 <div class = "row" style="margin-bottom:10px ; ">
                 <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                     <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                     
                     </div>
                 </div>
                     
                     ' ; 
             }
         }
         elseif($d['Type'] == 'vente_Annule')
         {
            
                $disc = $disc.' 
                    
                <div class = "" style="margin-bottom:10px ; width:80%">
                <div class = "" style="word-wrap: break-word ; background:green; color:black ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                    
                    </div>
                </div>
                    
            ' ; 
         }
         elseif($d['Type'] == 'termine'){
            // $dateTime = $d['heure'] ; 
            $date = $d['heure'] ; 
             $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
             // echo $new_datetime->format('d/m/y  H:i:s'); 
             $time = $new_datetime->format('H:i:s'); 
             $date= $new_datetime->format('d/m/y') ;  
             $disc = $disc.'
                 
 
             
             <div class = "row" style="margin-bottom:10px ; ">
                 <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                     
                 <p style="text-align:center;text-decoration : underline;">termine le '.$date.'  a  '.$time.'</p>
                     <span class="time-right"></span>
                 </div>
             </div>
 
             ' ; 
         }
         elseif($d['Type'] == 'a suivre'){
             $date = $d['heure'] ; 
             $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
             // echo $new_datetime->format('d/m/y  H:i:s'); 
             $time = $new_datetime->format('H:i:s'); 
             $date= $new_datetime->format('d/m/y') ;  
             
             $disc = $disc.'
                 
             <div class = "row" style="margin-bottom:10px ; ">
                 <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: #FFFF00 ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                     
                 <p style="text-align:center;text-decoration : underline;">a suivre depuis '.$date.'  a  '.$time.'</p>
                     <span class="time-right"></span>
                 </div>
             </div>
 
             ' ; 
         }
         elseif($d['Type'] == 'NouvelleDiscussion'){
             $date = $d['heure'] ; 
             $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
             // echo $new_datetime->format('d/m/y  H:i:s'); 
             $time = $new_datetime->format('H:i:s'); 
             $date= $new_datetime->format('d/m/y') ;  
             
             $disc = $disc.'
                 
             <div class = "row" style="margin-bottom:10px ; ">
                 <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: green ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                     
                 <p style="text-align:center;text-decoration : underline;">nouvelle discussion le '.$date.'  a  '.$time.'</p>
                     <span class="time-right"></span>
                 </div>
             </div>
             ' ; 
         }
         else 
         {
             if($d['sender'] == 'CLT')
             {
                 $disc = $disc.'  
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-left:350px" >
                         </div>
                     </div>
             ' ; 
             } 
             else {
                 $disc = $disc.' 
                     
                 <div class = "row" style="margin-bottom:10px ; ">
                     <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                   
                         <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-rigt:350px" >
                     <span class="time-left"></span>
                     </div>
                 </div>    
                     
                     ' ; 
             }
         }
     
     
     endforeach ;
         $json['codeclient']= $disc ;
         echo json_encode($json);
    }

    
   public function terminerDiscussion()
   {
        $codeClient=$this->input->post('codeClient');
        $this->Facture_model->terminerDiscussion($codeClient) ; 
        $disc = $this->Facture_model->getDiscussionByCodeClient($codeClient)->id_discussion ;
     
       $donnee = $this->Facture_model->getDiscu($disc) ;

       $disc = '' ; 
       foreach($donnee as $d):
        if($d['Type'] == 'message')
        {
            if($d['sender'] == 'CLT')
            {
                $disc = $disc.'  
                
                    <div class = "row" style="margin-bottom:10px ; ">
                        <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <img src="'.base_url("images/client/".$this->Facture_model->verifierPdp($codeClient).".jpg").'" style="height:40px;width:40px;cursor:pointer;border:solid 4px white ; " >
                            <p>'.$d['Message'].'</p>
                            <span class="time-right"></span>
                        </div>
                    </div>
               
            ' ; 
            } 
            else {
                $disc = $disc.' 
                    
                <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                    
                    </div>
                </div>
                    
                    ' ; 
            }
        }
        elseif($d['Type'] == 'vente_Annule')
         {
            
                $disc = $disc.' 
                    
                <div class = "" style="margin-bottom:10px ; width:80%">
                <div class = "" style="word-wrap: break-word ; background:green; color:black ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                    
                    </div>
                </div>
                    
            ' ; 
         }
        elseif($d['Type'] == 'termine'){
           // $dateTime = $d['heure'] ; 
           $date = $d['heure'] ; 
            $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
            // echo $new_datetime->format('d/m/y  H:i:s'); 
            $time = $new_datetime->format('H:i:s'); 
            $date= $new_datetime->format('d/m/y') ;  
            $disc = $disc.'
                

            
            <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    
                <p style="text-align:center;text-decoration : underline;">termine le '.$date.'  a  '.$time.'</p>
                    <span class="time-right"></span>
                </div>
            </div>

            ' ; 
        }
        elseif($d['Type'] == 'a suivre'){
            $date = $d['heure'] ; 
            $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
            // echo $new_datetime->format('d/m/y  H:i:s'); 
            $time = $new_datetime->format('H:i:s'); 
            $date= $new_datetime->format('d/m/y') ;  
            
            $disc = $disc.'
                
            <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: #FFFF00 ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    
                <p style="text-align:center;text-decoration : underline;">a suivre depuis '.$date.'  a  '.$time.'</p>
                    <span class="time-right"></span>
                </div>
            </div>

            ' ; 
        }
        elseif($d['Type'] == 'NouvelleDiscussion'){
            $date = $d['heure'] ; 
            $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
            // echo $new_datetime->format('d/m/y  H:i:s'); 
            $time = $new_datetime->format('H:i:s'); 
            $date= $new_datetime->format('d/m/y') ;  
            
            $disc = $disc.'
                
            <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: green ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    
                <p style="text-align:center;text-decoration : underline;">nouvelle discussion le '.$date.'  a  '.$time.'</p>
                    <span class="time-right"></span>
                </div>
            </div>
            ' ; 
        }
        else 
        {
            if($d['sender'] == 'CLT')
            {
                $disc = $disc.'  
                    <div class = "row" style="margin-bottom:10px ; ">
                        <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-left:350px" >
                        </div>
                    </div>
            ' ; 
            } 
            else {
                $disc = $disc.' 
                    
                <div class = "row" style="margin-bottom:10px ; ">
                    <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                  
                        <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-rigt:350px" >
                    <span class="time-left"></span>
                    </div>
                </div>    
                    
                    ' ; 
            }
        }
    
    
    endforeach ;
        $json['codeclient']= $disc ;
        echo json_encode($json);
   }
   public function  insertMessage()
   {
        $codeClient=$this->input->post('codeClient');
        $messageContent=$this->input->post('messageContent');
        $sender=$this->input->post('sender');
        $messageType=$this->input->post('messageType');
        //echo($codeClient) ; 
        /*$json=array('message'=>$messageContent,'erreur'=>'true','codeclient'=>$codeClient);
        echo json_encode($json);*/

        $this->Facture_model->insertDiscu($codeClient , $sender , $messageContent , $messageType) ;
        
        $disc = $this->Facture_model->getDiscussionByCodeClient($codeClient)->id_discussion ;
     
       $donnee = $this->Facture_model->getDiscu($disc) ;

       $disc = '' ; 
       foreach($donnee as $d):
        if($d['Type'] == 'message')
        {
            if($d['sender'] == 'CLT')
            {
                $disc = $disc.'  
                
                    <div class = "row" style="margin-bottom:10px ; ">
                        <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <img src="'.base_url("images/client/".$this->Facture_model->verifierPdp($codeClient).".jpg").'" style="height:40px;width:40px;cursor:pointer;border:solid 4px white ; " >
                            <p>'.$d['Message'].'</p>
                            <span class="time-right"></span>
                        </div>
                    </div>
               
            ' ; 
            } 
            else {
                $disc = $disc.' 
                    
                <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ;  ">
                    <p>'.$d["Message"].'</p>
                    
                    </div>
                </div>
                    
                    ' ; 
            }
        }
        elseif($d['Type'] == 'vente_Annule')
         {
            
                $disc = $disc.' 
                    
                <div class = "" style="margin-bottom:10px ; width:80%">
                <div class = "" style="word-wrap: break-word ; background:green; color:black ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                    
                    </div>
                </div>
                    
            ' ; 
         }
         elseif($d['Type'] == 'termine'){
            // $dateTime = $d['heure'] ; 
            $date = $d['heure'] ; 
             $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
             // echo $new_datetime->format('d/m/y  H:i:s'); 
             $time = $new_datetime->format('H:i:s'); 
             $date= $new_datetime->format('d/m/y') ;  
             $disc = $disc.'
                 
 
             
             <div class = "row" style="margin-bottom:10px ; ">
                 <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                     
                 <p style="text-align:center;text-decoration : underline;">termine le '.$date.'  a  '.$time.'</p>
                     <span class="time-right"></span>
                 </div>
             </div>
 
             ' ; 
         }
         elseif($d['Type'] == 'a suivre'){
             $date = $d['heure'] ; 
             $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
             // echo $new_datetime->format('d/m/y  H:i:s'); 
             $time = $new_datetime->format('H:i:s'); 
             $date= $new_datetime->format('d/m/y') ;  
             
             $disc = $disc.'
                 
             <div class = "row" style="margin-bottom:10px ; ">
                 <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: #FFFF00 ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                     
                 <p style="text-align:center;text-decoration : underline;">a suivre depuis '.$date.'  a  '.$time.'</p>
                     <span class="time-right"></span>
                 </div>
             </div>
 
             ' ; 
         }
         elseif($d['Type'] == 'NouvelleDiscussion'){
             $date = $d['heure'] ; 
             $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
             // echo $new_datetime->format('d/m/y  H:i:s'); 
             $time = $new_datetime->format('H:i:s'); 
             $date= $new_datetime->format('d/m/y') ;  
             
             $disc = $disc.'
                 
             <div class = "row" style="margin-bottom:10px ; ">
                 <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: green ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                     
                 <p style="text-align:center;text-decoration : underline;">nouvelle discussion le '.$date.'  a  '.$time.'</p>
                     <span class="time-right"></span>
                 </div>
             </div>
             ' ; 
         }
        else 
        {
            if($d['sender'] == 'CLT')
            {
                $disc = $disc.'  
                    <div class = "row" style="margin-bottom:10px ; ">
                        <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-left:350px" >
                        </div>
                    </div>
            ' ; 
            } 
            else {
                $disc = $disc.' 
                    
                <div class = "row" style="margin-bottom:10px ; ">
                    <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                  
                        <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-rigt:350px" >
                    <span class="time-left"></span>
                    </div>
                </div>    
                    
                    ' ; 
            }
        }
    
    
    endforeach ;
    $taille =count($donnee) ; 
    $type = $donnee[$taille-1]['Type'] ; 
    $json = array('codeclient' => $disc , 'type' => $type) ;
       
        echo json_encode($json);
   }
   public function priseCharge()
   {
       /*$idFacture=$this->input->post('idFacture');
       $this->Facture_model->createNewDiscussion($idFacture) ; */
       $data   = $this->Facture_model->getListeFactureAnnule() ; 
        
        $dt['dt'] = $data->result_array() ; 
        $this->render_view('service_apres_vente/discussion/discussion',$dt); 
        

   }
   public function afficherDiscussionInNewFenetre($codeClient)
   {
    //$codeClient =$this->input->post('codeClient'); 
   // $json=array('message'=>'andrana','erreur'=>'true','content'=>'' );
 //   $json['codeclient']= '<div class="container"><img src="/w3images/bandmember.jpg" alt="Avatar"><p>'.$codeClient.'</p><span class="time-right">11:00</span></div>';

    $disc = $this->db->query("select * from discussion where client like '".$codeClient."' order by Id DESC limit 1")->result() ;
    
    foreach($disc as $dc)
    {
        $disc = $dc->id_discussion ; 
    }
    $donnee = $this->Facture_model->getDsc($disc) ;
    $nom = null ;
    $clt = $this->Facture_model->getClientByCodeClient2($codeClient) ; 
    foreach($clt as $c)
    {
            $nom = $c->Nom ;       
    }
    if(empty($disc)) 
    {
        $disc = '
        <div class = "row" style="margin-bottom:10px ; ">
            <div class = "col-sm-12" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                
            <h3 style="text-align: center;">discussion vide</h3>
                <span class="time-right"></span>
            </div>
        </div>
        ' ; 
    }
   else
   {
    $disc = '' ;
        foreach($donnee as $d):
            if($d['Type'] == 'message')
            {
                if($d['sender'] == 'CLT')
                {
                    $disc = $disc.'  
                    
                        <div class = "" style="margin-bottom:10px ;width:80% ; margin-left:20%">
                            <div class = "" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                <img src="'.base_url("images/client/".$this->Facture_model->verifierPdp($codeClient).".jpg").'" style="height:40px;width:40px;cursor:pointer;border:solid 4px white ; " >
                                <p>'.$d['Message'].'</p>
                                <span class="time-right"></span>
                            </div>
                        </div>
                
                ' ; 
                } 
                else {
                    $disc = $disc.' 
                        
                    <div class = "" style="margin-bottom:10px ; width:80%">
                    <div class = "" style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                        <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                        
                        </div>
                    </div>
                        
                        ' ; 
                }
            }
            elseif($d['Type'] == 'vente_Annule')
                 {
                    
                        $disc = $disc.' 
                            
                        <div class = "" style="margin-bottom:10px ; width:80%">
                        <div class = "" style="word-wrap: break-word ; background:green; color:black ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                            
                            </div>
                        </div>
                            
                    ' ; 
                 }
                 elseif($d['Type'] == 'termine'){
                    // $dateTime = $d['heure'] ; 
                    $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     $disc = $disc.'
                         
         
                     
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">termine le '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'a suivre'){
                     $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: #FFFF00 ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">a suivre depuis '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'NouvelleDiscussion'){
                     $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: green ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">nouvelle discussion le '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
                     ' ; 
                 }
            elseif($d['Type'] == 'aSuivre'){
                $disc = $disc.'
                    
                <div class = "row" style="margin-bottom:10px ; ">
                    <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                        
                    <h4 style="text-align:center;text-decoration : underline;">a suivre</h4>
                        <span class="time-right"></span>
                    </div>
                </div>
    
                ' ; 
            }
            else 
            {
                if($d['sender'] == 'CLT')
                {
                    $disc = $disc.'  
                        <div class = "row" style="margin-bottom:10px ; ">
                            <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-left:350px" >
                            </div>
                        </div>
                ' ; 
                } 
                else {
                    $disc = $disc.' 
                        
                    <div class = "row" style="margin-bottom:10px ; ">
                        <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    
                            <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-rigt:350px" >
                        <span class="time-left"></span>
                        </div>
                    </div>    
                        
                        ' ; 
                }
            }
        
        
        endforeach ;
    }
    
   
    

  //  $json['content']= $disc ;
   //echo json_encode($json);

            
        $dt['dt'] = $disc ; 
        $dt['nom'] = $nom ; 
        $dt['codeClient'] = $codeClient ; 
        $this->render_view('service_apres_vente/discussion/fenetreDiscussion',$dt); 

   }
   public function search()
   {
        $mot=$this->input->post('mot');
        $json=array('message'=>'andrana','erreur'=>'true','mot'=>'');
        $json['mot']= $mot ; 
        echo json_encode($json);
    }
    /*public function index(){
       
        $data['datelivre'] = $this->Service_apres_vente_model->getlivraisonannuler();
        $this->render_view('service_apres_vente/accueil',$data);
    }*/
   
    public function nouveau()
    {
      
        $data   = $this->Facture_model->getListeFactureAnnule() ; 
        
        $dt = ['produit_user'=>$this->global_model->produit_user(),
        'en_cours'=>$this->global_model->discussion_en_cours(),
        'famille'=>$this->global_model->famille(),
        'page'=>$this->global_model->userpage(),
        'mission'=>$this->global_model->mission() ,
        'dt' => $data->result_array() ] ;
        
        $this->render_view('service_apres_vente/discussion/discussion',$dt); 
        

    }
    public function nouveau2($idFacture)
    {
        $this->Facture_model->priseEnCharge($idFacture) ; 
        $codeClient = $this->Facture_model->getCodeClientByIdFacture($idFacture) ;
        $this->Facture_model->createNewDiscussion($idFacture) ; 

        $data   = $this->Facture_model->getListeFactureAnnule() ; 
        $dt['dt'] = $data->result_array() ; 
        $dt['codeClient'] = $codeClient ; 
        


        $disc = $this->Facture_model->getDiscussionByCodeClient($codeClient)->id_discussion ;
        
        $nom = null ;
        $clt = $this->Facture_model->getClientByCodeClient2($codeClient) ; 
        foreach($clt as $c)
        {
                $nom = $c->Nom ;       
        }

        $donnee = $this->Facture_model->getDiscu($disc) ;
        if(empty($disc)) 
        {
            $disc = '
            <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-12" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    
                <h3 style="text-align: center;">discussion vide</h3>
                    <span class="time-right"></span>
                </div>
            </div>
            ' ; 
           
        }
        else
        {
             foreach($donnee as $d):
                 if($d['Type'] == 'message')
                 {
                     if($d['sender'] == 'CLT')
                     {
                         $disc = $disc.'  
                         
                             <div class = "" style="margin-bottom:10px ;width:80% ; margin-left:20%">
                                 <div class = "" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                     <img src="'.base_url("images/client/".$this->Facture_model->verifierPdp($codeClient).".jpg").'" style="height:40px;width:40px;cursor:pointer;border:solid 4px white ; " >
                                     <p>'.$d['Message'].'</p>
                                     <span class="time-right"></span>
                                 </div>
                             </div>
                     
                     ' ; 
                     } 
                     else {
                         $disc = $disc.' 
                             
                         <div class = "" style="margin-bottom:10px ; width:80%">
                         <div class = "" style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                             
                             </div>
                         </div>
                             
                             ' ; 
                     }
                 }
                 elseif($d['Type'] == 'termine'){
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <h4 style="text-align:center;text-decoration : underline;">TERMINE</h4>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'vente_Annule')
                 {
                    
                        $disc = $disc.' 
                            
                        <div class = "" style="margin-bottom:10px ; width:80%">
                        <div class = "" style="word-wrap: break-word ; background:green; color:black ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                            </div>
                        </div>
                    ' ; 
                 }
                 elseif($d['Type'] == 'a suivre'){
                    $disc = $disc.'
                        
                    <div class = "row" style="margin-bottom:10px ; ">
                        <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            
                        <h4 style="text-align:center;text-decoration : underline;">a suivre</h4>
                            <span class="time-right"></span>
                        </div>
                    </div>
        
                    ' ; 
                }
                 else 
                 {
                     if($d['sender'] == 'CLT')
                     {
                         $disc = $disc.'  
                             <div class = "row" style="margin-bottom:10px ; ">
                                 <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                     <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-left:350px" >
                                 </div>
                             </div>
                     ' ; 
                     } 
                     else {
                         $disc = $disc.' 
                             
                         <div class = "row" style="margin-bottom:10px ; ">
                             <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                         
                                 <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-rigt:350px" >
                             <span class="time-left"></span>
                             </div>
                         </div>    
                             
                             ' ; 
                     }
                 }
             
             
             endforeach ;
         }
        
        $dt['discussion'] = $disc ; 

        $dt['nomClient'] = $nom ;



        $this->render_view('service_apres_vente/discussion/discu',$dt); 
    }
    public function nouvelleDiscu()
    {
        $codeClient=$this->input->post('codeClient') ;
        
        
        
        $this->Facture_model->newDisc($codeClient) ; 

        $disc = $this->Facture_model->getDiscussionByCodeClient($codeClient)->id_discussion ;
        
        $donnee = $this->Facture_model->getDiscu($disc) ;
        if(empty($disc)) 
        {
            $disc = '
            <div class = "row" style="margin-bottom:10px ; ">
                <div class = "col-sm-12" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                    
                <h3 style="text-align: center;">discussion vide</h3>
                    <span class="time-right"></span>
                </div>
            </div>
            ' ; 
           
        }
        else
        {
             foreach($donnee as $d):
                 if($d['Type'] == 'message')
                 {
                     if($d['sender'] == 'CLT')
                     {
                         $disc = $disc.'  
                         
                             <div class = "" style="margin-bottom:10px ;width:80% ; margin-left:20%">
                                 <div class = "" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                     <img src="'.base_url("images/client/".$this->Facture_model->verifierPdp($codeClient).".jpg").'" style="height:40px;width:40px;cursor:pointer;border:solid 4px white ; " >
                                     <p>'.$d['Message'].'</p>
                                     <span class="time-right"></span>
                                 </div>
                             </div>
                     
                     ' ; 
                     } 
                     else {
                         $disc = $disc.' 
                             
                         <div class = "" style="margin-bottom:10px ; width:80%">
                         <div class = "" style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                             
                             </div>
                         </div>
                             
                             ' ; 
                     }
                 }
                 
                 elseif($d['Type'] == 'vente_Annule')
                 {
                    
                        $disc = $disc.' 
                            
                        <div class = "" style="margin-bottom:10px ; width:80%">
                        <div class = "" style="word-wrap: break-word ; background:green; color:black ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                            <p style = "word-wrap:break-word;" >'.$d["Message"].'</p>
                            </div>
                        </div>
                    ' ; 
                 }
                 elseif($d['Type'] == 'termine'){
                    // $dateTime = $d['heure'] ; 
                    $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     $disc = $disc.'
                         
         
                     
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: red ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">termine le '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'a suivre'){
                     $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: #FFFF00 ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">a suivre depuis '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
         
                     ' ; 
                 }
                 elseif($d['Type'] == 'NouvelleDiscussion'){
                     $date = $d['heure'] ; 
                     $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);  
                     // echo $new_datetime->format('d/m/y  H:i:s'); 
                     $time = $new_datetime->format('H:i:s'); 
                     $date= $new_datetime->format('d/m/y') ;  
                     
                     $disc = $disc.'
                         
                     <div class = "row" style="margin-bottom:10px ; ">
                         <div class = "col-sm-12" style="word-wrap: break-word ; background: white; color: green ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                             
                         <p style="text-align:center;text-decoration : underline;">nouvelle discussion le '.$date.'  a  '.$time.'</p>
                             <span class="time-right"></span>
                         </div>
                     </div>
                     ' ; 
                 }
                 else 
                 {
                     if($d['sender'] == 'CLT')
                     {
                         $disc = $disc.'  
                             <div class = "row" style="margin-bottom:10px ; ">
                                 <div class = "col-sm-10 col-sm-offset-2" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                     <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-left:350px" >
                                 </div>
                             </div>
                     ' ; 
                     } 
                     else {
                         $disc = $disc.' 
                             
                         <div class = "row" style="margin-bottom:10px ; ">
                             <div class = "col-sm-10 " style="word-wrap: break-word ; background:#4FC3F7; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                         
                                 <img src="'.base_url("images/pieceJoint/".$d['Message'].".jpg").'" style="max-height:150px;max-width:150;cursor:pointer;margin-rigt:350px" >
                             <span class="time-left"></span>
                             </div>
                         </div>    
                             
                             ' ; 
                     }
                 }
             
             
             endforeach ;
         }

        $json=array('message' => 'andrana' , 'erreur' => 'true' , 'content' => $disc);
        echo json_encode($json);

    }
    public function tester()
    {
       /* $path = "inde.jpg";
        //$file = basename($path);         // $file is set to "index.php"
        $file = basename($path, ".jpg");
        echo $file ; */
        $rest = substr("Disc-021-20-01-2021", -3, 4);
        $test = 'Disc-021-20-01-2021' ; 
        echo $rest."<br/>" ; 
        $var = explode('-' , 'Disc-021-20-01-2021') ; 
        print_r($var) ; 
        echo "</br>" ; 
        echo $var[1] ; 
        echo "</br>" ; 
        $data = $this->Facture_model->getLastInsertedDiscussion() ; 
        print_r($data) ; 
        echo "</br>" ; 
        echo $data->id;
        echo "</br>" ;
        var_dump($this->session->all_userdata())  ;
        echo "</br>" ;
        $date = '2021-02-04 21:59:03' ; 
        $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s",$date);
        echo $new_datetime->format('d/m/y  H:i:s');
    }

 
   
}
?>