<?php
require APPPATH.'/libraries/REST_Controller.php';

defined('BASEPATH') OR exit('No direct script access allowed');
class Synchronisation extends REST_Controller{
    
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Synchronisation_model');
   }

   public function FindAll_Utilisateur_get(){
      
    try {
  
        $data = array('statu'=>'ok','response'=>[]);
        $data_synck = $this->Synchronisation_model->get_All_Utilisateur();
        if(!empty($data_synck)){
            array_push($data['response'],array('table-name'=>'Utilisateur','value'=> $data_synck));
            $res = json_encode($data);
            $this->output->set_output($res);
        }
        else {
            $this->response(array('data' => 'empty'), 200);
        }
     }
    catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
   }


    function FindAll_entreprise_get(){
          
    try {
        $data = array('statu'=>'ok','response'=>[]);
        $data_synck = $this->Synchronisation_model->get_All_Entreprise();
        if(!empty($data_synck)){
            array_push($data['response'],array('table-name'=>'entrepriseexterieur','value'=> $data_synck));
            $res = json_encode($data);
            $this->output->set_output($res);
        }
        else {
            $this->response(array('data' => 'empty'), 200);
        }
     }
    catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
   }

   
   function FindAll_produit_get(){    
    try {
        $data = array('statu'=>'ok','response'=>[]);
        $data_synck = $this->Synchronisation_model->get_All_produit();
        if(!empty($data_synck)){
         array_push($data['response'],array('table-name'=>'produit','value'=> $data_synck));
            $res = json_encode($data);
            $this->output->set_output($res);
        }
        else {
            $this->response(array('data' => 'empty'), 200);
        }
     }
    catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
   }


    function FindAll_Localisation_get(){
        $i=0;
        $data = array('statu'=>'ok','response'=>[]);
        $localisationtype = $this->Synchronisation_model->get_All_Localisation_type(); 
        foreach($localisationtype as $type){
            if(!empty($localisationtype)){
                $localisation = $this->Synchronisation_model->get_All_Localisation($localisationtype[$i]->id);
                array_push($data['response'],array('table-name'=>$localisationtype[$i]->label,'value'=> $localisation));
                $res = json_encode($data);
                $this->output->set_output($res);
            }
            else $this->response(array('data' => 'empty'), 200);
            $i++;
        }
    }


    function FindAll_pointcontrole_get(){    
        try {
            $data = array('statu'=>'ok','response'=>[]);
            $data_synck = $this->Synchronisation_model->get_All_pointcontrole();
            if(!empty($data_synck)){
             array_push($data['response'],array('table-name'=>'pointcontrole','value'=> $data_synck));
                $res = json_encode($data);
                $this->output->set_output($res);
            }
            else {
                $this->response(array('data' => 'empty'), 200);
            }
         }
        catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        } 
    }

    function FindAll_question_visite_get(){
        try{
            $data = array('statu'=>'ok','response'=>[]);
            $visite = $this->Synchronisation_model->get_All_visite_type();
            $i=0;
            foreach($visite as $visite_type){
                $questionnaire = $this->Synchronisation_model->get_All_question_visite($visite[$i]->id);
                array_push($data['response'],array('table-name'=>$visite[$i]->label,'value'=> $questionnaire));
                $res = json_encode($data);
                $this->output->set_output($res);
                $i++;
            }

        }
        catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        } 
    }
}