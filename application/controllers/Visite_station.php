<?php
defined('BASEPATH') OR exit ('No direct script allowed');
class Visite_station extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Visite_station_model');
    }

    public function index(){
        //$result=$this->Visite_station_model->get_all_questions();
        //var_dump($result);
        if(isset($this->session->userdata['logged_in'])){
            $data['result']=$this->Visite_station_model->get_all_questions();
            $this->load->view('common/header');
            $this->load->view('accueil/visite_station',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
    }
}