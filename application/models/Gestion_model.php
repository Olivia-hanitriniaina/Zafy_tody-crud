<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Gestion_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_users(){
    try{
      $this->db->select('*');
      $this->db->from('codir_user_profil');
      $this->db->join('codir_users','profil_id=codir_user_profil.id_user_profil','right');
      $query=$this->db->get();
      return $query->result();
      //
      /* $query = $this->db->query("SELECT * from codir_users");
      $rows = $query->result();
      return $rows;   */     
    }      
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }
  public function get_user_profil(){
    try{
      $this->db->select('*');
      $this->db->from('codir_user_profil');
      $query=$this->db->get();
      return $query->result();
    }catch(Exception $e){
      show_error($e->getMessage().'------'.$e->getTraceAsString());
    }
  }

  public function get_by_id($id){

    try {
      $this->db->from('codir_users');
      $this->db->where('id',$id);
      $query=$this->db->get();
      return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){

    try{
      $this->db->insert('codir_users',$data);
      return $this->db->insert_id();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function update($data){

    try {
      $where=array('id'=>$this->input->post('user_id'));
      $this->db->update('codir_users',$data,$where);
      return $this->db->affected_rows();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function delete(){
    
    try {
      $id= $this->input->post('user_id');
      $this->db->where('id',$id);
      $this->db->delete('codir_users');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }
}