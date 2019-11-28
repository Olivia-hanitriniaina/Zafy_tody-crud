<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Station_service extends CI_Controller{
   public function __construct(){
       parent::__construct();
       $this->load->helper('url');
       $this->load->model('Station_model');
       $this->load->library('pagination');
   }

   public function index(){
       $data['connecter'] = $this->session->userdata['logged_in'];
        if(isset($data['connecter'])){
            $config=array();
            $config['base_url']=base_url()."station_service";
            $config['total_rows']=$this->Station_model->get_count();
            $config['per_page']=10;
            $config['uri_segment']=2;

            /* This Application Must Be Used With BootStrap 3 *  */
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';



            $config['prev_link'] = '<i class="fa fa-chevron-left"></i> Précédent';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';


            $config['next_link'] = 'Suivant <i class="fa fa-chevron-right"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
           
            $this->pagination->initialize($config);
            $page=($this->uri->segment(2)) ? $this->uri->segment(2)  : 0;
            $data['links']=$this->pagination->create_links();
            $stations=$this->Station_model->get_all_stations($config['per_page'],$page);
            
            if(empty($stations)){
                (int)$page-=10;
                (string)$page;
                $data['stations']=$this->Station_model->get_all_stations($config['per_page'],$page);
            }else{
                $data['stations']=$this->Station_model->get_all_stations($config['per_page'],$page);
            }
            

            $data['users']=$this->Station_model->get_all_users();
            $this->load->view('common/header',$data);
            $this->load->view('station_service/station_aff',$data);
            $this->load->view('common/footer');
        }else{
            redirect('authentifiaction/','location');
        }
   }

   //teste pagination: début
   public function loadRecord($rowno=0){
       $rowPerPage=5;
       if($rowno!=0){
           $rowno=($rowno-1)*$rowPerPage;
       }

       $allcount=$this->Station_model->get_count();

       $stations_service=$this->Station_model->get_all_stations($rowPerPage,$rowno);

       $config['base_url'] = base_url().'station_service/loadRecord';
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
        $data['result'] = $stations_service;
        $data['row'] = $rowno;
 
        echo json_encode($data);
   }

   //teste pagination: fin



   public function get_all_station(){

    $data=$this->Station_model->get_all_stations(10,0);
    $arr =array('success'=>true,'data'=>'');

    if(empty($data)){
        $arr=array('success'=>false,'data'=>'resultat null');
    }
    else {
        $arr=array('success'=>true,'data'=>$data);
    }
    echo json_encode($arr);
    }

   public function get_station_by_id(){
       $id=$this->input->post('station_id');
       $data=$this->Station_model->get_by_id($id);
       $arr =array('success'=>false,'data'=>'');

       if($data){
           $arr=array('success'=>true,'data'=>$data);
       }
       echo json_encode($arr);
   }

   public function store(){
        $data=array(
            'name_local'=>$this->input->post('nom_station'),
            'local_manager_id'=>$this->input->post('local_manager'),
            'local_type_id'=>3
        );
        $status=false;
        $id=$this->input->post('station_id');

        if($id){
            $update=$this->Station_model->update($data);
            $status=true;
            $data=$this->Station_model->get_by_id($id);
        }else{
            $create=$this->Station_model->create($data);
            $data=$this->Station_model->get_by_id($create);
            $status=true;
        }
        
       echo json_encode(array('status'=>$status,'data'=>$data));
   }

   public function delete(){
       $this->Station_model->delete();
       echo json_encode(array('status'=>true));
   }
   
    public function get_rechercher(){

    $stations=$this->input->post('station');
    $gerant=$this->input->post('gerante');
    $data=$this->Station_model->getrecherche_station($stations,$gerant);

        $arr =array('success'=>true,'data'=>'');

        if(empty($data)){
            $arr=array('success'=>false,'data'=>'resultat null');
        }
        else {
            $arr=array('success'=>true,'data'=>$data);
        }
        echo json_encode($arr);
    }
}