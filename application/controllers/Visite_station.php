<?php
defined('BASEPATH') OR exit ('No direct script allowed');
class Visite_station extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Visite_station_model');
        $this->load->model('Questionnaire_Station_model');
    }

    public function index(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        if(isset($data['connecter'])){
           $data['resultat'] = $this->Questionnaire_Station_model->get_All_fiche_visite_station(1);
            $this->load->view('common/header',$data);
            $this->load->view('Liste/visite_station',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
    }
}