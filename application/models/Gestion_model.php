<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Gestion_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_users(){
    $this->db->from('users');
    $query=$this->db->get();
    return $query->result();
  }

  public function get_by_id($id){
    $this->db->from('users');
    $this->db->where('id_users',$id);
    $query=$this->db->get();
    return $query->row();
  }

  public function create($data){
    $this->db->insert('users',$data);
    return $this->db->insert_id();
  }

  public function update($data){
    $where=array('id_users'=>$this->input->post('user_id'));
    $this->db->update('users',$data,$where);
    return $this->db->affected_rows();
  }

  public function delete(){
    $id= $this->input->post('user_id');
    $this->db->where('id_users',$id);
    $this->db->delete('users');
  }
}