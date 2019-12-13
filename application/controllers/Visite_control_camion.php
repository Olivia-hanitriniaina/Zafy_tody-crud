<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Visite_control_camion extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Visite_control_camion_model');
        $this->load->library('pagination');
        
    }

    public function index(){
       $data['connecter']=$this->session->userdata['logged_in'];
       if(isset($data['connecter'])){
            $this->load->view('common/header',$data);
            $this->load->view('visite_control_camion/liste_visite_camion_view');
            $this->load->view('common/footer',$data);
       }else{
           redirect('authentification/','location');
       }
    }

    public function loadRecord($rowno=0){
        $rowPerPage=5;
        if($rowno!=0){
            $rowno=($rowno-1)*$rowPerPage;
        }
 
        $allcount=$this->Visite_control_camion_model->get_count();
 
        $site=$this->Visite_control_camion_model->get_all_visites($rowPerPage,$rowno);
 
        $config['base_url'] = base_url().'visite_control_camion/loadRecord';
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
         $data['result'] = $site;
         $data['row'] = $rowno;
  
         echo json_encode($data);
    }

    public function reponse_visite(){
        $id_camion=$this->input->get('id_camion');
        $id_visite=9;
        $data['result']=$this->Visite_control_camion_model->get_reponses($id_visite);
        $data['camions']=$this->Visite_control_camion_model->get_all_visite_by_id($id_camion);

        $this->load->view('common/header',$data);
        $this->load->view('visite_control_camion/questionnaire_visite_camion_view',$data);
        $this->load->view('common/footer');
    }
}