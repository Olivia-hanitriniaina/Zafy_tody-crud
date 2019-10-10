<?php
class Station_service extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function afficher_station(){
        $this->load->view("common/header.php");
        $this->load->view("station_service/station_aff");
        $this->load->view("common/footer.php");
    }
}