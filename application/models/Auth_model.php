<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Auth_model extends CI_Model{
    
    public function login($data){

        try {
                $condition="nom_utilisateur="."'".$data['login']."' AND "."mot_de_passe="."'".$data['password']."'";
                $this->db->select('*');
                $this->db->from('Utilisateur');
                $this->db->where($condition);
                $this->db->limit(1);
                $query=$this->db->get();
        
                if($query->num_rows()==1){
                    return $query->result();
                }else{
                    return false;
                }
        }
        catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function read_user_information($login){

        try {
                $condition="nom_utilisateur="."'".$login."'";
                $this->db->select('*');
                $this->db->from('Utilisateur');
                $this->db->where($condition);
                $this->db->limit(1);
                $query=$this->db->get();

                if($query->num_rows()==1){
                    return $query->result();
                }else{
                    return false;
                }
        }
        catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }
} 