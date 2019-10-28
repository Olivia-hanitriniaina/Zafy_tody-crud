<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Depot_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_depots(){

    try {
          $this->db->from('depot_aviation');
          $query=$this->db->get();
          return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function get_by_id($id){

    try{
          $this->db->from('depot_aviation');
          $this->db->where('id_depot',$id);
          $query=$this->db->get();
          return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){

    try{
          $this->db->insert('depot_aviation',$data);
          return $this->db->insert_id();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function update($data){

    try {
          $where=array('id_depot'=>$this->input->post('depot_id'));
          $this->db->update('depot_aviation',$data,$where);
          return $this->db->affected_rows();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function delete(){

    try {
          $id= $this->input->post('depot_id');
          $this->db->where('id_depot',$id);
          $this->db->delete('depot_aviation');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }
}