<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Station_service extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Station_model');
   }

   public function index(){
        if(isset($this->session->userdata['logged_in'])){
            $data['stations']=$this->Station_model->get_all_stations();
            $this->load->view('common/header');
            $this->load->view('station_service/station_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
   }

   public function get_station_by_id(){
       $id=$this->input->post('station_id');
       $data=$this->Station_model->get_by_id($id);
       $arr =array('success'=>false,'data'=>'');

       if($data){
           $arr=array('success'=>true,'data'=>$data);
       }
       echo json_encode($arr);
   }

   public function store(){
       $data=array(
           'nom_station'=>$this->input->post('nom_station'),
           'nom_visiteur'=>$this->input->post('nom_visiteur'),
           'date'=>$this->input->post('date'),
       );
       $status=false;
       $id=$this->input->post('station_id');

       if($id){
           $update=$this->Station_model->update($data);
           $status=true;
           $data=$this->Station_model->get_by_id($id);
       }else{
           $create=$this->Station_model->create($data);
           $data=$this->Station_model->get_by_id($create);
           $status=true;
       }
      

       echo json_encode(array('status'=>$status,'data'=>$data));
   }

   public function delete(){
       $this->Station_model->delete();
       echo json_encode(array('status'=>true));
   }
}