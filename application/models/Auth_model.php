<?php
class Auth_model extends CI_Model{
    public function read($adresse_email,$password){
        $users=$this->db->where(array('adresse_email'=>$adresse_email,'password'=>$password))
                            ->get('users');
        if($users->num_rows() !=0){
            return $users->first_row('array');
        }else{
            return false;
        }                    
    }

    /* protected $_adresse_mail;
    protected $_id_users;

    public function __construct(){
        parent::__construct();
        $this->load_from_session();
    }

    public function __get($key){
        $methode_name='get_property_'.$key;
        if(method_exists($this,$methode_name)){
            return $this->$methode_name();
        }else{
            return parent::__get($key);
        }
    }

    protected function clear_data(){
        $this->_id_users=NULL;
        $this->_adresse_mail=NULL; 
    }

    protected function clear_session(){
        $this->session->auth_user=NULL;
    }

    protected function get_property_id(){
        return $this->_id_users;
    }

    protected function get_property_is_connected(){
        return $this->_id !== NULL;
    }

    protected function get_property_adresse_email(){
        return $this->_adresse_email;
    }

    protected function load_from_session(){
        if($this->session->auth_user){
            $this->_id_users= $this->session->auth_user['id_users'];
            $this->_adresse_email= $this->session->auth_user['adresse_email'];
        }else{
            $this->clear_data();
        }
    }

    protected function load_user($adresse_email){
        return $this->db
            ->select('*')
            ->from('users')
            ->where('adresse_email',$adresse_email)
            ->get()
            ->first_row();
    }

    public function login($adresse_email,$password){
        $user=$this->load_user($adresse_email);
       
        if(($user!==NULL) && password_verify($password,$user['password'])){
            $this->_id_users=$user['id_users'];
            $this->_adresse_email=$user['adresse_email'];
            $this->save_session();
        }else{
            echo"identifiant incorrect!";
            $this->logout();
        }
    }

    public function logout(){
        $this->clear_data();
        $this->clear_session();
    }

    protected function save_session(){
        $this->session->auth_user=[
            'id_users'=>$this->_id_users,
            'adresse_email'=>$this->_adresse_email
        ];
    }*/
} 