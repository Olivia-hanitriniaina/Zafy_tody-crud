<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Depot_aviation extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Depot_model');
   }

   public function index(){
        $session=$this->session->userdata();
        if(isset($session)){
            $data['depots']=$this->Depot_model->get_all_depots();
            $this->load->view('common/header');
            $this->load->view('depot_aviation/depot_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/login','location');
        }     
   }

   public function get_depot_by_id(){
       $id=$this->input->post('depot_id');
       $data=$this->Depot_model->get_by_id($id);
       $arr =array('success'=>false,'data'=>'');

       if($data){
           $arr=array('success'=>true,'data'=>$data);
       }
       echo json_encode($arr);
   }

   public function store(){
       $data=array(
            'date'=>$this->input->post('date'),
            'depot_aviation'=>$this->input->post('depot_aviation'),
            'nom_chef_site'=>$this->input->post('nom_chef_site'),
            'nom_visiteur'=>$this->input->post('nom_visiteur'),
       );
       $status=false;
       $id=$this->input->post('depot_id');

       if($id){
           $update=$this->Depot_model->update($data);
           $status=true;
           $data=$this->Depot_model->get_by_id($id);
       }else{
           $create=$this->Depot_model->create($data);
           $data=$this->Depot_model->get_by_id($create);
           $status=true;
       }
      

       echo json_encode(array('status'=>$status,'data'=>$data));
   }

   public function delete(){
       $this->Depot_model->delete();
       echo json_encode(array('status'=>true));
   }
}