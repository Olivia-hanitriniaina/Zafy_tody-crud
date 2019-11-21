<?php
require APPPATH.'/libraries/REST_Controller.php';

class Webservices extends REST_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Auth_model');
    }

	public function index_get($id =1){
        $data;
        if(!empty($id)){
            $result = $this->db->get_where("users", ['id_users' => $id])->row_array();
            $data = array(
                'statu' => 'ok',
                'response' => [$result]
            );
        }else{
            $result = $this->db->get("users")->result();
            $data = array(
                'statu' => 'ko',
                'response' => [$result]
            );
        }
        $this->response($data,200);
    }
}
