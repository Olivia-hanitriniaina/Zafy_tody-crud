<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Centre_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_centres(){
    $this->db->from('centre_emplisseur');
    $query=$this->db->get();
    return $query->result();
  }

  public function get_by_id($id){
    $this->db->from('centre_emplisseur');
    $this->db->where('id_centre',$id);
    $query=$this->db->get();
    return $query->row();
  }

  public function create($data){
    $this->db->insert('centre_emplisseur',$data);
    return $this->db->insert_id();
  }

  public function update($data){
    $where=array('id_centre'=>$this->input->post('centre_id'));
    $this->db->update('centre_emplisseur',$data,$where);
    return $this->db->affected_rows();
  }

  public function delete(){
    $id= $this->input->post('centre_id');
    $this->db->where('id_centre',$id);
    $this->db->delete('centre_emplisseur');
  }
}