<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Questionnaire extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Site_station_service_model');
       $this->load->model('Questionnaire_model');
       
   }

   public function questionReseau(){
       $idstation = $this->input->get('idstation');
       $data = array();
       $result = $this->Site_station_service_model->getAll_Site_station_service($idstation);
       $response = $this->Questionnaire_model->FindAll_Question_reseau();
       $categorie = $this->Questionnaire_model->FindAll_categorie();
       $subcategorie = $this->Questionnaire_model->FindAll_subcategorie();
       $data['result'] = $result;
       $data['response'] = $response;
       $data['categorie'] = $categorie;
       $this->load->view('common/header');
       $this->load->view('questionnaire/station_service',$data);
       $this->load->view('common/footer');
   }
}
?>
