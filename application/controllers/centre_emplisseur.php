<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Centre_emplisseur extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Centre_model');
   }

   public function index(){
       if(isset($this->session->userdata['logged_in'])){
            $data['centres']=$this->Centre_model->get_all_centres();
            $this->load->view('common/header');
            $this->load->view('centre_emplisseur/centre_aff',$data);
            $this->load->view('common/footer');
       }else{
            redirect('authentifiaction/','location');
       }
       
   }

   public function get_centre_by_id(){
       $id=$this->input->post('centre_id');
       $data=$this->Centre_model->get_by_id($id);
       $arr =array('success'=>false,'data'=>'');

       if($data){
           $arr=array('success'=>true,'data'=>$data);
       }
       echo json_encode($arr);
   }

   public function store(){
       $data=array(
            'date'=>$this->input->post('date'),
            'nom_visiteur'=>$this->input->post('nom_visiteur'),
            'ville'=>$this->input->post('ville'),
       );
       $status=false;
       $id=$this->input->post('centre_id');

       if($id){
           $update=$this->Centre_model->update($data);
           $status=true;
           $data=$this->Centre_model->get_by_id($id);
       }else{
           $create=$this->Centre_model->create($data);
           $data=$this->Centre_model->get_by_id($create);
           $status=true;
       }
      

       echo json_encode(array('status'=>$status,'data'=>$data));
   }

   public function delete(){
       $this->Centre_model->delete();
       echo json_encode(array('status'=>true));
   }
}