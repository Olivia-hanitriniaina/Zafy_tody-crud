<?php
require APPPATH.'/libraries/REST_Controller.php';

class Webservice extends REST_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('security');

    }
   
	public function index_get(){
      try {
  
            $select_clobal;
            $data = array('statu'=>'ok','response'=>[]);
            $users = [
                ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'phone' => 'Loves coding'],
                ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'phone' => 'Developed on CodeIgniter'],
                ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'phone' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
            ];
                $res = json_encode($data);
                $this->response($res, 200);
        }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      } 
    }
    
}
