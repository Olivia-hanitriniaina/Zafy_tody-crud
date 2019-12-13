<?php
require APPPATH.'/libraries/REST_Controller.php';

class Web_service extends REST_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('webservice');
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
            $res = json_encode($users);
            $this->output->set_output($res);
                
        }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      } 
    }
    
}
