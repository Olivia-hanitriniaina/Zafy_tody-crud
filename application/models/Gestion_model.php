<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Gestion_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_users(){
    try{
          $query = $this->db->query("SELECT * from users 
          join role 
          on users.id_role = role.id_role ");
          $rows = $query->result();
          return $rows;       
    }      
    catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }

  public function get_by_id($id){

    try {
          $this->db->from('users');
          $this->db->where('id_users',$id);
          $query=$this->db->get();
          return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){

    try{
          $this->db->insert('users',$data);
          return $this->db->insert_id();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function update($data){

    try {
          $where=array('id_users'=>$this->input->post('user_id'));
          $this->db->update('users',$data,$where);
          return $this->db->affected_rows();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function delete(){
    
    try {
          $id= $this->input->post('user_id');
          $this->db->where('id_users',$id);
          $this->db->delete('users');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }
}