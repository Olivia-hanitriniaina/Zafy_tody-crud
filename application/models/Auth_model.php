<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Auth_model extends CI_Model{
    
    public function login($data){

        try {
                $condition="login="."'".$data['login']."' AND "."password="."'".$data['password']."'";
                $this->db->select('*');
                $this->db->from('codir_users');
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
                $condition="login="."'".$login."'";
                $this->db->select('*');
                $this->db->from('codir_users');
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