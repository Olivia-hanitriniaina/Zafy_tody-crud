<?php
class Accueil extends CI_Controller{

    public function index(){
       
            $this->acceuil();
    }

    public function acceuil(){
        $this->load->view('common/header');
        $this->load->view('accueil/page_acceuil');
        $this->load->view('common/footer');
    }


    public function admin(){
        $this->load->view('common/header');
        $this->load->view('administration/admin_aff');
        $this->load->view('common/footer');
    }

    
    public function inscription(){
        $data['message'] = "";
        $this->load->view('Authentification/inscription_form',$data);
    }
}