<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Centre_emplisseur extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Centre_model');
        $this->load->library('pagination');
    }
 
    public function index(){
        $data['connecter'] = $this->session->userdata['logged_in'];
         if(isset( $data['connecter'])){
             $data['users']=$this->Centre_model->get_all_users();
             $this->load->view('common/header', $data);
             $this->load->view('centre_emplisseur/centre_aff',$data);
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
 
        $allcount=$this->Centre_model->get_count();
 
        $centre_emplisseur=$this->Centre_model->get_all_centres($rowPerPage,$rowno);
 
        $config['base_url'] = base_url().'centre_emplisseur/loadRecord';
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
         $data['result'] = $centre_emplisseur;
         $data['row'] = $rowno;
  
         echo json_encode($data);
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
             'nom'=>$this->input->post('nom_centre'),
             'responsable_id'=>$this->input->post('local_manager'),
             'type_id'=>6
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

    public function get_rechercher(){

        $centres=$this->input->post('centre');
        $gerant=$this->input->post('gerante');
        $data=$this->Centre_model->search_centre($centres,$gerant);
    
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