<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produit extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Produit_model');
   }

   public function index(){
        if(isset($this->session->userdata['logged_in'])){
            $data['produits']=$this->Produit_model->get_all_produits();
            $this->load->view('common/header');
            $this->load->view('produit/produit_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
   }

   public function get_produit_by_id(){
       $id=$this->input->post('produit_id');
       $data=$this->Produit_model->get_by_id($id);
       $arr =array('success'=>false,'data'=>'');

       if($data){
           $arr=array('success'=>true,'data'=>$data);
       }
       echo json_encode($arr);
   }

   public function store(){
        $data=array(
            'name'=>$this->input->post('nom_produit'),
        );
        $status=false;
        $id=$this->input->post('produit_id');

        if($id){
            $update=$this->Produit_model->update($data);
            $status=true;
            $data=$this->Produit_model->get_by_id($id);
        }else{
            $create=$this->Produit_model->create($data);
            $data=$this->Produit_model->get_by_id($create);
            $status=true;
        }
        
       echo json_encode(array('status'=>$status,'data'=>$data));
   }

   public function delete(){
       $this->Produit_model->delete();
       echo json_encode(array('status'=>true));
   }
}