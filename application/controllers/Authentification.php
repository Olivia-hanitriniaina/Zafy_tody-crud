<?php
class Authentification extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index(){
      if(isset($this->session->userdata['logged_in'])){
        redirect('accueil/acceuil','location');
      }else{
        $this->load->view('Authentification/auth_form.php');
      }
    }

    public function user_login(){
        $this->form_validation->set_rules('username','Nom d utilisateur','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Mot de passe','trim|required|xss_clean');
        
        if($this->form_validation->run()==FALSE){
            if(isset($this->session->userdata['logged_in'])){
                redirect('accueil/acceuil','location');
            }else{
                $this->load->view('Authentification/auth_form.php');
            }
        }else{
            $data=array(
                'login'=>$this->input->post('username'),
                'password'=>$this->input->post('password')
            );
            $result=$this->auth_model->login($data);

            if($result==TRUE){
                $username=$this->input->post('username');
                $result=$this->auth_model->read_user_information($username);
                
                if($result!=FALSE){
                    $session_data=array(
                        'id'=>$result[0]->id,
                        'nom_utilisateur'=>$result[0]->nom_utilisateur,
                        'nom_complet'=>$result[0]->nom_complet,
                        'adresse_email'=>$result[0]->adresse_email
                    );

                    $this->session->set_userdata('logged_in',$session_data);
                    redirect('accueil/acceuil','location');
                }
            }else{
                $data=array(
                    'error_message'=> "Le login ou le mot de passe est invalide"
                );
                $this->load->view('Authentification/auth_form.php',$data);
            }
        }
    }

    public function logout(){
        $session=$this->session->userdata['logged_in'];
        $array_items=array('id','login','fullname','adresse_email');
        if(isset($session)){
            $this->session->unset_userdata('logged_in',$array_items);
            redirect('authentification/');
        }
    } 
}