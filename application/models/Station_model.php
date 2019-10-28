<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Station_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_stations(){
    $this->db->from('station_service');
    $query=$this->db->get();
    return $query->result();
  }

  public function get_by_id($id){
    $this->db->from('station_service');
    $this->db->where('id_station',$id);
    $query=$this->db->get();
    return $query->row();
  }

  public function create($data){
    $this->db->insert('station_service',$data);
    return $this->db->insert_id();
  }

  public function update($data){
    $where=array('id_station'=>$this->input->post('station_id'));
    $this->db->update('station_service',$data,$where);
    return $this->db->affected_rows();
  }

  public function delete(){
    $id= $this->input->post('station_id');
    $this->db->where('id_station',$id);
    $this->db->delete('station_service');
  }
}