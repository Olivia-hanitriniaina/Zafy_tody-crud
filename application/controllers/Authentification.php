<?php
class Authentification extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index(){
        $this->load->view('Authentification/auth_form.php');
    }

    public function user_login(){
        $this->form_validation->set_rules('email','Nom d utilisateur','trim|required|xss_clean');
        $this->form_validation->set_rules('mdp','Mot de passe','trim|required|xss_clean');
        
        if($this->form_validation->run()==FALSE){
                $this->load->view('Authentification/auth_form.php');
        }else{
            $data=array(
                'email'=>$this->input->post('email'),
                'mdp'=>$this->input->post('mdp')
            );
            $result=$this->auth_model->login($this->input->post('email'),$this->input->post('mdp'));
            if($result==TRUE){
                $email=$this->input->post('email');
                $result=$this->auth_model->read_user_information($email);
                
                if($result!=FALSE){
                    var_dump($result[0]->role);
                    if($result[0]->role ==0){
                        redirect('accueil/acceuil');
                    }
                   else {
                    redirect('accueil/admin');
                   }
                }
            }else{
                $data=array(
                    'error_message'=> "Le login ou le mot de passe est invalide"
                );
                $this->load->view('Authentification/auth_form.php',$data);
            }
        }
    }


    public function inscription(){
        if($this->input->post('mdp') != $this->input->post('confirm')){

            $data['message']= "password invalide";
            $this->load->view('Authentification/inscription_form',$data);
        }
        else{
            $data=array(
                'mdp'=>$this->input->post('mdp'),
                'prenom'=>$this->input->post('prenom'),
                'nom'=>$this->input->post('nom'),
                'role'=>$this->input->post('role'),
                'email'=>$this->input->post('email'),
                'number'=>$this->input->post('numero'),
                'ville'=>$this->input->post('ville'),
           );
           $result=$this->auth_model->create($data);
           $this->load->view('Authentification/auth_form.php');
        }
       
    }

    
    public function logout(){
            redirect('authentification/');
    } 
}