<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lieu extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Lieu_model');
   }

   public function index(){
        if(isset($this->session->userdata['logged_in'])){
            $data['lieux']=$this->Lieu_model->get_all_lieux();
            $this->load->view('common/header');
            $this->load->view('lieu/lieu_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
   }

   public function get_lieu_by_id(){
       $id=$this->input->post('lieu_id');
       $data=$this->Lieu_model->get_by_id($id);
       $arr =array('success'=>false,'data'=>'');

       if($data){
           $arr=array('success'=>true,'data'=>$data);
       }
       echo json_encode($arr);
   }

   public function store(){
        $data=array(
            'name_local'=>$this->input->post('nom_lieu'),
            'local_type_id'=>2
        );
        $status=false;
        $id=$this->input->post('lieu_id');

        if($id){
            $update=$this->Lieu_model->update($data);
            $status=true;
            $data=$this->Lieu_model->get_by_id($id);
        }else{
            $create=$this->Lieu_model->create($data);
            $data=$this->Lieu_model->get_by_id($create);
            $status=true;
        }
        
       echo json_encode(array('status'=>$status,'data'=>$data));
   }

   public function delete(){
       $this->Lieu_model->delete();
       echo json_encode(array('status'=>true));
   }
}