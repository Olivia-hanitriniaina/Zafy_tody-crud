<?php
require APPPATH.'/libraries/REST_Controller.php';

defined('BASEPATH') OR exit('No direct script access allowed');
class Synchronisation extends REST_Controller{
    
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Synchronisation_model');
   }

   public function index_get(){
      
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
}