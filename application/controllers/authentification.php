<?php
class Authentification extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index(){
      $session=$this->session->userdata();
      if(isset($session)){
        redirect('site/acceuil','location');
      }else{
        redirect('authentifiaction/login','location');
      }
    }

    public function login(){
       $data=array();
       if($_POST){  
            $adresse_email=$this->input->post('adresse_email',true);
            $password=$this->input->post('password',true);
            
            if($_POST){
                $error='';
                $this->form_validation->set_rules('adresse_email','Adresse email','required');
                $this->form_validation->set_rules('password','Mot de passe','required');
                if($this->form_validation->run()==TRUE){
                    $found=$this->auth_model->read($adresse_email,$password);
                    if(is_array($found)){
                        $session=array(
                            "id"=>$found['id_users'],
                            "email"=>$found['adresse_email']
                        );
                        $this->session->set_userdata($session);
                        redirect('site/index','location');
                    }else{
                        $error='Identifiant ou mot de passe incorrecte!';
                    }
                }
                $data['error']=$error;
            }
        }
        $this->load->view('Authentification/auth_form.php',$data);   
    }

    public function logout(){
        $session=$this->session->userdata();
        $array_items=array('id','email');
        if(isset($session)){
            $this->session->unset_userdata($array_items);
            redirect('authentification/login');
        }
    }
}