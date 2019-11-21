<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Site extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Site_model');
    }    

    public function index(){
        if(isset($this->session->userdata['logged_in'])){
            $data['sites']=$this->Site_model->get_all_sites();
            $data['users']=$this->Site_model->get_all_users();
            $this->load->view('common/header');
            $this->load->view('site/site_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentification/','location');
        }
    }

    public function get_site_by_id(){
        $id=$this->input->post('site_id');
        $data=$this->Site_model->get_by_id($id);
        $arr=array('success'=>false,'data'=>'');

        if($data){
            $arr=array('success'=>true,'data'=>$data);
        }
        echo json_encode($arr);
    }

    public function store(){
        $data=array(
            'name_local'=>$this->input->post('nom_site'),
            'local_manager_id'=>$this->input->post('local_manager'),
            'local_type_id'=>1
        );
        $status=false;
        $id= $this->input->post('site_id');

        if($id){
            $update=$this->Site_model->update($data);
            $status=true;
            $data=$this->Site_model->get_by_id($id);
        }else{
            $create=$this->Site_model->create($data);
            $data=$this->Site_model->get_by_id($create);
            $status=true;
        }

        echo json_encode(array('status'=>$status,'data'=>$data));
    }

    public function delete(){
      
        $this->Site_model->delete();
        echo json_encode(array('status'=>true));
    }
    public function get_recherche_globale(){

        $variable =$this->input->post('variable');
        $data = $this->Site_model->getrecherche_site($variable);
        $arr=array('success'=>false,'data'=>'');

        if($data){
            $arr=array('success'=>true,'data'=>$data);
        }
        echo json_encode($arr);
    }

}