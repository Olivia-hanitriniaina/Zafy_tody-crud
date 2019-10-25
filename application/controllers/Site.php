<?php
class Site extends CI_Controller{
    public function index(){
        if(isset($this->session->userdata['logged_in'])){
            $this->acceuil();
        }else{
            redirect('authentification/');
        }
    }
    public function acceuil(){
        $this->load->view('common/header');
        $this->load->view('site/page_acceuil');
        $this->load->view('common/footer');
    }

    public function station_service(){
        $this->load->view('common/header');
        $this->load->view('site/station_service');
        $this->load->view('common/footer');  
    }

    public function centre_emplisseur(){
        $this->load->view('common/header');
        $this->load->view('site/centre_emplisseur');
        $this->load->view('common/footer');
    }

    public function depot_aviation(){
        $this->load->view('common/header');
        $this->load->view('site/depot_aviation');
        $this->load->view('common/footer');
    }

    public function HSE_chantier(){
        $this->load->view('common/header');
        $this->load->view('site/HSE_chantier');
        $this->load->view('common/footer');
    }
    public function STL_bouteilles(){
        $this->load->view('common/header');
        $this->load->view('site/STL_bouteilles');
        $this->load->view('common/footer');
    }
    public function controle_camion(){
        $this->load->view('common/header');
        $this->load->view('site/controle_camion');
        $this->load->view('common/footer');
    }
    public function STL_camion(){
        $this->load->view('common/header');
        $this->load->view('site/STL_camion');
        $this->load->view('common/footer');
    }
}