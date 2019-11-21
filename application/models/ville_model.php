<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Ville_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_villes(){

    try {
      $this->db->select('*');
      $this->db->from('codir_locals');
      $this->db->join('codir_local_type','local_type_id=codir_local_type.id');
      $this->db->where(array('local_type_id'=>5));
      $query=$this->db->get();
      return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function get_by_id($id){

    try{
      $this->db->select('*');
      $this->db->from('codir_locals');
      $this->db->join('codir_local_type','local_type_id=codir_local_type.id');
      $this->db->where(array('local_type_id'=>5,'id_local'=>$id));
      $query=$this->db->get();
      return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){
    try{
      $this->db->insert('codir_locals', $data);
      return $this->db->insert_id();

    }catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
    
  }

  public function update($data){

     try {
            $where=array('id_local'=>$this->input->post('ville_id'));
            $this->db->update('codir_locals',$data,$where);
            return $this->db->affected_rows();
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      }

  }

  public function delete(){

    try {
          $id= $this->input->post('ville_id');
          $this->db->where('id_local',$id);
          $this->db->delete('codir_locals');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }
}