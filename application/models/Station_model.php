<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Station_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_stations(){

    try {
          $this->db->from('station_service');
          $query=$this->db->get();
          return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function get_by_id($id){

    try{
          $this->db->from('station_service');
          $this->db->where('id_station',$id);
          $query=$this->db->get();
          return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){

    try {
          $this->db->insert('station_service',$data);
          return $this->db->insert_id();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function update($data){

     try {
            $where=array('id_station'=>$this->input->post('station_id'));
            $this->db->update('station_service',$data,$where);
            return $this->db->affected_rows();
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      }

  }

  public function delete(){

    try {
          $id= $this->input->post('station_id');
          $this->db->where('id_station',$id);
          $this->db->delete('station_service');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }
}