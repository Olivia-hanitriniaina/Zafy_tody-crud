<?php
class Authentification extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index(){
      if(isset($this->session->userdata['logged_in'])){
        redirect('site/acceuil','location');
      }else{
        $this->load->view('Authentification/auth_form.php');
      }
    }

    public function user_login(){
        $this->form_validation->set_rules('adresse_email','Adresse email','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Mot de passe','trim|required|xss_clean');
        
        if($this->form_validation->run()==FALSE){
            if(isset($this->session->userdata['logged_in'])){
                redirect('site/acceuil','location');
            }else{
                $this->load->view('Authentification/auth_form.php');
            }
        }else{
            $data=array(
                'adresse_email'=>$this->input->post('adresse_email'),
                'password'=>$this->input->post('password')
            );
            $result=$this->auth_model->login($data);

            if($result==TRUE){
                $adresse_email=$this->input->post('adresse_email');
                $result=$this->auth_model->read_user_information($adresse_email);
                
                if($result!=FALSE){
                    $session_data=array(
                        'id'=>$result[0]->id_users,
                        'adresse_email'=>$result[0]->adresse_email
                    );

                    $this->session->set_userdata('logged_in',$session_data);
                    redirect('site/acceuil','location');
                }
            }else{
                $data=array(
                    'error_message'=> "L'adresse email ou le mot de passe est invalide"
                );
                $this->load->view('Authentification/auth_form.php',$data);
            }
        }
    }

    public function logout(){
        $session=$this->session->userdata['logged_in'];
        $array_items=array('id','adresse_email');
        if(isset($session)){
            $this->session->unset_userdata('logged_in',$array_items);
            redirect('authentification/');
        }
    } 
}