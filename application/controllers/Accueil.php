<?php
class Accueil extends CI_Controller{
    public function index(){
        if(isset($this->session->userdata['logged_in'])){
            $this->acceuil();
        }else{
            redirect('authentification/');
        }
    }
    public function acceuil(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $this->load->view('common/header', $data);
        $this->load->view('accueil/page_acceuil');
        $this->load->view('common/footer');
    }

    public function station_service(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $this->load->view('common/header',$data);
        $this->load->view('Qestionnnaire/station_service_question');
        $this->load->view('common/footer');  
    }

    public function centre_emplisseur(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $this->load->view('common/header',$data);
        $this->load->view('Qestionnnaire/centre_emplisseur_question');
        $this->load->view('common/footer');
    }

    public function depot_aviation(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $this->load->view('common/header',$data);
        $this->load->view('Qestionnnaire/depot_aviation_question');
        $this->load->view('common/footer');
    }

    public function HSE_chantier(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $this->load->view('common/header',$data);
        $this->load->view('Qestionnnaire/HSE_chantier_question');
        $this->load->view('common/footer');
    }
    public function STL_bouteilles(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $this->load->view('common/header',$data);
        $this->load->view('Qestionnnaire/STL_bouteilles_question');
        $this->load->view('common/footer');
    }
    public function controle_camion(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $this->load->view('common/header',$data);
        $this->load->view('Qestionnnaire/controle_camion_question');
        $this->load->view('common/footer');
    }
    public function STL_camion(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        $this->load->view('common/header',$data);
        $this->load->view('Qestionnnaire/STL_camion_question');
        $this->load->view('common/footer');
    }
}