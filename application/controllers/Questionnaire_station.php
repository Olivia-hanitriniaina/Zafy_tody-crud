<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Questionnaire_station extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Questionnaire_Station_model');
        $this->load->library('pagination');
    }
    
    public function index(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        if(isset($data['connecter'])){
            $data['question']=$this->Questionnaire_Station_model->get_All_Questionnnaire_stationService();
            $data['question']=$this->Questionnaire_Station_model->get_All_fiche_visite_station(1);
            $this->load->view('common/header',$data);
            $this->load->view('Liste/visite_station',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
    }

    public function get_AllQuestionnaire(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $idvisite = $this->input->get('idvisite');
        $idstation = $this->input->get('idstation');
        if(isset($data['connecter'])){
        $data['result']=$this->Questionnaire_Station_model->get_All_Questionnnaire_stationService();
        $data['station_id']=$this->Questionnaire_Station_model->get_All_fiche_visite_station_by_id($idvisite,$idstation);
            $this->load->view('common/header',$data);
            $this->load->view('Qestionnnaire/visite_station_question',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
    }

    public function get_recherche_station(){

        $date = $this->input->post('date');
        $station = $this->input->post('station');
        $visiteur = $this->input->post('visite');
      
        $timestamp = strtotime($date);

        $new_date = date("Y-m-d", $timestamp);

        $data = $this->Questionnaire_Station_model->get_All_recherche_station($station, $date , $visiteur);
        var_dump($data);
        $arr =array('success'=>false,'data'=>'');

        if($data){
            $arr=array('success'=>true,'data'=>$data);
        }
        echo json_encode($arr);
    }

    //teste pagination: début
   public function loadRecord($rowno=0){

    $rowPerPage=5;
    if($rowno!=0){
        $rowno=($rowno-1)*$rowPerPage;
    }

    $allcount=$this->Questionnaire_Station_model->get_count(1);

    $stations_service=$this->Questionnaire_Station_model->get_All_fiche_visite_station(1,$rowno,$rowPerPage);

    $config['base_url'] = base_url().'Questionnaire_station/loadRecord';
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
     $data['result'] = $stations_service;
     $data['row'] = $rowno;
     echo json_encode($data);
}
}
