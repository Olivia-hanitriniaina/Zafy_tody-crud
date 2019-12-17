<?php
defined('BASEPATH') OR exit ('No direct script allowed');
class Visite_bouteilles extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Visite_bouteilles_model');
        $this->load->library('pagination');
    }

    public function index(){
        $data['connecter'] = $this->session->userdata['logged_in'];
        if(isset($data['connecter'])){
            $this->load->view('common/header',$data);
            $this->load->view('Visite_Bouteilles/visite_bouteilles_liste_view');
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
    }

    public function loadRecord($rowno=0){
        $rowPerPage=5;
        if($rowno!=0){
            $rowno=($rowno-1)*$rowPerPage;
        }
 
        $allcount=$this->Visite_bouteilles_model->get_count();
 
        $site=$this->Visite_bouteilles_model->get_all_visites($rowPerPage,$rowno);
 
        $config['base_url'] = base_url().'visite_bouteilles/loadRecord';
         $config['use_page_numbers'] = TRUE;
         $config['total_rows'] = $allcount;
         $config['per_page'] = $rowPerPage;
  
         $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
         $config['full_tag_close']   = '</ul></nav></div>';
         $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
         $config['num_tag_close']    = '</span></li>';
         $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
         $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
         $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
         $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
         $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
         $config['prev_tag_close']  = '</span></li>';
         $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
         $config['first_tag_close'] = '</span></li>';
         $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
         $config['last_tag_close']  = '</span></li>';
  
         $this->pagination->initialize($config);
  
         $data['pagination'] = $this->pagination->create_links();
         $data['result'] = $site;
         $data['row'] = $rowno;
  
         echo json_encode($data);
    }

    public function search_visite(){
        $data = array();
        $inspecteur=$this->input->post('inspecteur');
        $date=$this->input->post('date');
        $transporteur=$this->input->post('transporteur');
        $lieu=$this->input->post('lieu');
        $produit=$this->input->post('produit');
        $conducteur=$this->input->post('conducteur');
        $tracteur=$this->input->post('tracteur');
        $semi=$this->input->post('semi');

        $data['visitecamionstlbouteille.visa_inspecteur'] = $inspecteur;
        $data['visite.date'] = $date;
        $data['visitecamionstlbouteille.nom_transporteur'] = $transporteur;
        $data['localisation.nom'] = $lieu;
        $data['produit.nom'] = $produit;
        $data['visitecamionstlbouteille.nom_conducteur'] = $conducteur;
        $data['visitecamionstlbouteille.immatriculation_tracteur'] = $tracteur;
        $data['visitecamionstlbouteille.immatriculation_semi_remorque'] = $semi;
        

        $data=$this->Visite_bouteilles_model->search_visite($data);

        $arr= array('success'=>true,'data'=>'');

        if(empty($data)){
            $arr= array('success'=>false,'data'=>'resultat null');
        }else{
            $arr=array('success'=>true,'data'=>$data);
        }

        echo json_encode($arr);
    }

    public function reponse_visite(){
        $data = array();
        $data['connecter'] = $this->session->userdata['logged_in'];
        $id_station= $this->input->get('idbouteille');
        $data['result']=$this->Visite_bouteilles_model->get_reponses( $id_station);
        $data['station']=$this->Visite_bouteilles_model->get_all_visites_by_id( $id_station);
        $this->load->view('common/header',$data);
        $this->load->view('Visite_bouteilles/questionnaire_visite_bouteilles_view',$data);
        $this->load->view('common/footer');
    
    }
}