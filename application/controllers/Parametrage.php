<?php
class Parametrage extends CI_Controller{

    public function  depot_aviantion(){

        $this->load->view('common/header');
        $this->load->view('parametrage/depot_aviation');
        $this->load->view('common/footer');
    }

    public function site() {

        $this->load->view('common/header');
        $this->load->view('parametrage/site');
        $this->load->view('common/footer');
    }

    public function ville(){

        $this->load->view('common/header');
        $this->load->view('parametrage/ville');
        $this->load->view('common/footer');
    }

    public function lieu() {

        $this->load->view('common/header');
        $this->load->view('parametrage/lieu');
        $this->load->view('common/footer');

    }

    public function centre_emplisseur() {

        $this->load->view('common/header');
        $this->load->view('parametrage/centre_emplisseur');
        $this->load->view('common/footer');

    }
}