<?php
defined('BASEPATH') OR exit ('No direct script allowed');
class Visite_depot extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Visite_depot_model');
        $this->load->library('pagination');
    }

    public function index(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        if(isset($data['connecter'])){
            $this->load->view('common/header',$data);
            $this->load->view('visite_depot/visite_depot_liste_view');
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
 
        $allcount=$this->Visite_depot_model->get_count();
 
        $depots=$this->Visite_depot_model->get_all_visites($rowPerPage,$rowno);
 
        $config['base_url'] = base_url().'visite_depot/loadRecord';
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
         $data['result'] = $depots;
         $data['row'] = $rowno;
  
         echo json_encode($data);
    }

    public function search_visite(){
        $depot=$this->input->post('depot_name');
        $date=$this->input->post('date_visite');
        $visiteur=$this->input->post('visiteur_name');

        $data=$this->Visite_depot_model->search_visite($depot,$date,$visiteur);

        $arr= array('success'=>true,'data'=>'');

        if(empty($data)){
            $arr= array('success'=>false,'data'=>'resultat null');
        }else{
            $arr=array('success'=>true,'data'=>$data);
        }

        echo json_encode($arr);
    }

    public function reponse_visite(){
        $data = array();
        $data['connecter'] = $this->session->userdata['logged_in'];
        $id_depot= $this->input->get('id_visite');
        $id_visite=7;
        $data['result']=$this->Visite_depot_model->get_reponses($id_visite);
        $data['depots']=$this->Visite_depot_model->get_all_visites_by_id($id_depot);
        $this->load->view('common/header',$data);
        $this->load->view('visite_depot/questionnaire_visite_depot_view',$data);
        $this->load->view('common/footer');
    
    }
}