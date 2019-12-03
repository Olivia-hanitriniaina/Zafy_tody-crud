<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gestion_utilisateur extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Gestion_model');
       $this->load->library('pagination');
   }

   public function index(){
    $data['connecter']  = $this->session->userdata['logged_in'];
        if(isset( $data['connecter'])){
            $data['profils']=$this->Gestion_model->get_user_profil();
            $this->load->view('common/header', $data );
            $this->load->view('gestion_utilisateur/utilisateur_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }  
   }

   public function loadRecord($rowno=0){
       $rowPerPage=5;

       if($rowno !=0){
           $rowno=($rowno -1)*$rowPerPage;
       }

       $allcount=$this->Gestion_model->get_count();

       $gestion_utilisateur=$this->Gestion_model->get_all_users($rowPerPage,$rowno);

        $config['base_url'] = base_url().'gestion_utilisateur/loadRecord';
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
        $data['result'] = $gestion_utilisateur;
        $data['row'] = $rowno;
 
        echo json_encode($data);
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
           'nom_utilisateur'=>$this->input->post('username'),
           'nom_complet'=>$this->input->post('fullname'),
           'adresse_email'=>$this->input->post('adresse_email'),
           'mot_de_passe'=>$this->input->post('password'),
           'type_id'=>$this->input->post('fonction')
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

   public function rechercher(){

        $users=$this->input->post('users');
        $data=$this->Gestion_model->search_users($users);

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