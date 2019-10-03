<?php
class Site extends CI_Controller{
    public function acceuil(){
        $this->load->view('common/header');
        $this->load->view('site/carte_visite');
        $this->load->view('common/footer');
    }
}