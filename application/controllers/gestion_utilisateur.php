<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gestion_utilisateur extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Gestion_model');
       $this->load->model('Role_model');
   }

   public function index(){
        if(isset($this->session->userdata['logged_in'])){
            $data['users']=$this->Gestion_model->get_all_users();
            $data['role']=$this->Role_model->get_all_role();
            $this->load->view('common/header');
            $this->load->view('gestion_utilisateur/utilisateur_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }  
   }

   public function get_user_by_id(){
       $id=$this->input->post('user_id');
       $data=$this->Gestion_model->get_by_id($id);
       $arr =array('success'=>false,'data'=>'');

       if($data){
           $arr=array('success'=>true,'data'=>$data);
       }
       echo json_encode($arr);
   }

   public function store(){
       $data=array(
           'adresse_email'=>$this->input->post('adresse_email'),
           'password'=>$this->input->post('password'),
       );
       $status=false;
       $id=$this->input->post('user_id');

       if($id){
           $update=$this->Gestion_model->update($data);
           $status=true;
           $data=$this->Gestion_model->get_by_id($id);
       }else{
           $create=$this->Gestion_model->create($data);
           $data=$this->Gestion_model->get_by_id($create);
           $status=true;
       }
      

       echo json_encode(array('status'=>$status,'data'=>$data));
   }

   public function delete(){
       $this->Gestion_model->delete();
       echo json_encode(array('status'=>true));
   }
}