<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Lieu_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_count(){
    try {
      $this->db->select('localisation.*,LocalisationType.label');
      $this->db->from('Localisation');
      $this->db->join('LocalisationType','type_id=LocalisationType.id');
      $this->db->where(array('Localisation.type_id'=>2));
      return $this->db->count_all_results();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
    
  }

  public function get_all_lieux($limit,$start){

    try {
      $this->db->select('Localisation.*,LocalisationType.label');
      $this->db->from('Localisation');
      $this->db->join('LocalisationType','Localisation.type_id=LocalisationType.id');
      $this->db->where(array('Localisation.type_id'=>2));
      $this->db->limit($limit,$start);
      $query=$this->db->get();
      return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function get_by_id($id){

    try{
      $this->db->select('Localisation.*,LocalisationType.label');
      $this->db->from('Localisation');
      $this->db->join('LocalisationType','Localisation.type_id=LocalisationType.id');
      $this->db->where(array('Localisation.type_id'=>2,'Localisation.id'=>$id));
      $query=$this->db->get();
      return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){
    try{
      $this->db->insert('Localisation', $data);
      return $this->db->insert_id();

    }catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
    
  }

  public function update($data){

     try {
            $where=array('id'=>$this->input->post('lieu_id'));
            $this->db->update('Localisation',$data,$where);
            return $this->db->affected_rows();
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      }

  }

  public function delete(){

    try {
          $id= $this->input->post('lieu_id');
          $this->db->where('id',$id);
          $this->db->delete('Localisation');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }

  public function search_lieux($lieu){
    try{
      $this->db->select('*');
      $this->db->from('Localisation');
      $this->db->join('LocalisationType','Localisation.type_id = LocalisationType.id','left');
      $this->db->or_like(array('nom'=>$lieu));
      $query=$this->db->get();
      return $query->result();
    }      
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }
}