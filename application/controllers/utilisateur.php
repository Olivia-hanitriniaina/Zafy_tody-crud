<?php
require_once("Base_controllers.php");
class Utilisateur extends  Base_controllers{

    public function se_connecter(){
       $data = array();
       if($_POST){
            $adresse_email=$this->input->post('adresse_email',true);
            $password=$this->input->post('password',true);

            $error='';
            if($adresse_email != null && $password != null){
                redirect('site/acceuil','location');
            }else{
            $error='veuillez remplir les champs';
            }
            if($adresse_email == null && $password != null){
                $error='Login incorrect';
            }
            if($password == null && $adresse_email != null){
                $error='mot de passe incorrect !' ;
            }
            $data['error']=$error;
        }
        $this->load->view('utilisateur/login_form.php',$data);   
    }
      /*public function se_connecter(){
       
       if($_POST){
            $adresse_email=$this->input->post('adresse_email',true);
            $password=$this->input->post('password',true);

            $found=$this->users->login($adresse_email,$password);
            $error='';
            if(is_array($found)){
                redirect('site/acceuil','location');
            }else{
            $error='Identifiant incorrect';
            }
            $data['error']=$error;
        }
        $this->load->view('utilisateur/login_form.php',$data);   
    }*/
}