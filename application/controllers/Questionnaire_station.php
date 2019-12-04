<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Questionnaire_station extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Questionnaire_Station_model');
    }
    
    public function get_AllQuestionnaire(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $id = $this->input->get('id');
        if(isset($data['connecter'])){
        $data['question']=$this->Questionnaire_Station_model->get_All_Questionnnaire_stationService();
        $data['station_id']=$this->Questionnaire_Station_model->get_All_fiche_visite_station_by_id(1,$id);
            $this->load->view('common/header',$data);
            $this->load->view('accueil/visite_station',$data);
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

}
