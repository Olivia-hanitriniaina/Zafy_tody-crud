<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Auth_model extends CI_Model{
    
    public function login($email, $pass){

        try {
            $condition = "SELECT * from users as u where u.EMAIL ='".$email."' AND u.MDP='".$pass."'";
            $query = $this->db->query($condition);

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
                $condition = "SELECT * from users as u where u.EMAIL ='".$login."'";
                $query = $this->db->query($condition);

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


    public function create($data){
        try{
          $this->db->insert('users', $data);
          return $this->db->insert_id();
    
        }catch(Exception $e){
          show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
        
      }

} 