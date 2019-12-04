<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produit extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Produit_model');
       $this->load->library('pagination');
   }

   public function index(){
       $data['connecter'] = $this->session->userdata['logged_in'];
        if(isset( $data['connecter'])){
            $this->load->view('common/header',$data);
            $this->load->view('produit/produit_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
   }

   public function loadRecord($rowno=0){
    $rowPerPage=5;
    if($rowno!=0){
      $rowno=($rowno-1)*$rowPerPage;
    }

    $allcount=$this->Produit_model->get_count();

    $produits=$this->Produit_model->get_all_produits($rowPerPage,$rowno);

    $config['base_url'] = base_url().'produit/loadRecord';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $allcount;
    $config['per_page'] = $rowPerPage;

    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close']  = '</span></li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close']  = '</span></li>';

    $this->pagination->initialize($config);

    $data['pagination'] = $this->pagination->create_links();
    $data['result'] = $produits;
    $data['row'] = $rowno;

    echo json_encode($data);
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
            'nom'=>$this->input->post('nom_produit'),
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

   public function get_rechercher(){
    $produits=$this->input->post('produit_name');
    $data=$this->Produit_model->search_produits($produits);

    $arr =array('success'=>true,'data'=>'');

    if(empty($data)){
        $arr=array('success'=>false,'data'=>'resultat null');
    }
    else {
        $arr=array('success'=>true,'data'=>$data);
    }
    echo json_encode($arr);
}
}