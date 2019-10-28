<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Centre_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_centres(){

    try {
          $this->db->from('centre_emplisseur');
          $query=$this->db->get();
          return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function get_by_id($id){

    try {
          $this->db->from('centre_emplisseur');
          $this->db->where('id_centre',$id);
          $query=$this->db->get();
          return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){

    try {
          $this->db->insert('centre_emplisseur',$data);
          return $this->db->insert_id();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function update($data){

    try {
          $where=array('id_centre'=>$this->input->post('centre_id'));
          $this->db->update('centre_emplisseur',$data,$where);
          return $this->db->affected_rows();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function delete(){
    
    try {
          $id= $this->input->post('centre_id');
          $this->db->where('id_centre',$id);
          $this->db->delete('centre_emplisseur');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }
}