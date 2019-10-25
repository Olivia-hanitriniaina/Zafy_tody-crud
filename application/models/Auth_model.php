<?php
class Auth_model extends CI_Model{
    
    public function login($data){
        $condition="adresse_email="."'".$data['adresse_email']."' AND "."password="."'".$data['password']."'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query=$this->db->get();

        if($query->num_rows()==1){
            return true;
        }else{
            return false;
        }
    }

    public function read_user_information($adresse_email){
        $condition="adresse_email="."'".$adresse_email."'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query=$this->db->get();

        if($query->num_rows()==1){
            return $query->result();
        }else{
            return false;
        }
    }
} 