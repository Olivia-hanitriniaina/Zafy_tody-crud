<?php
class Site extends CI_Controller{
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
}