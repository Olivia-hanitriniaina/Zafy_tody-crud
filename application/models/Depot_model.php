<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Depot_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_depots(){
    $this->db->from('depot_aviation');
    $query=$this->db->get();
    return $query->result();
  }

  public function get_by_id($id){
    $this->db->from('depot_aviation');
    $this->db->where('id_depot',$id);
    $query=$this->db->get();
    return $query->row();
  }

  public function create($data){
    $this->db->insert('depot_aviation',$data);
    return $this->db->insert_id();
  }

  public function update($data){
    $where=array('id_depot'=>$this->input->post('depot_id'));
    $this->db->update('depot_aviation',$data,$where);
    return $this->db->affected_rows();
  }

  public function delete(){
    $id= $this->input->post('depot_id');
    $this->db->where('id_depot',$id);
    $this->db->delete('depot_aviation');
  }
}