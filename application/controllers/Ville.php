<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ville extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Ville_model');
   }

   public function index(){
       $data['connecter'] = $this->session->userdata['logged_in'];
        if(isset($data['connecter'])){
            $data['villes']=$this->Ville_model->get_all_villes();
            $this->load->view('common/header',$data);
            $this->load->view('ville/ville_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
   }

   public function get_ville_by_id(){
       $id=$this->input->post('ville_id');
       $data=$this->Ville_model->get_by_id($id);
       $arr =array('success'=>false,'data'=>'');

       if($data){
           $arr=array('success'=>true,'data'=>$data);
       }
       echo json_encode($arr);
   }

   public function store(){
        $data=array(
            'name_local'=>$this->input->post('nom_ville'),
            'local_type_id'=>5
        );
        $status=false;
        $id=$this->input->post('ville_id');

        if($id){
            $update=$this->Ville_model->update($data);
            $status=true;
            $data=$this->Ville_model->get_by_id($id);
        }else{
            $create=$this->Ville_model->create($data);
            $data=$this->Ville_model->get_by_id($create);
            $status=true;
        }
        
       echo json_encode(array('status'=>$status,'data'=>$data));
   }

   public function delete(){
       $this->Ville_model->delete();
       echo json_encode(array('status'=>true));
   }
}