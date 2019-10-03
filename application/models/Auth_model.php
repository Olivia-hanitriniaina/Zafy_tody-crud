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
}