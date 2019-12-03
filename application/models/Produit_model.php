<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Produit_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_count(){
    try {
      $this->db->select('*');
      $this->db->from('Produit');
      return $this->db->count_all_results();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
    
  }

  public function get_all_produits($limit,$start){

    try {
      $this->db->select('*');
      $this->db->from('Produit');
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
      $this->db->select('*');
      $this->db->from('Produit');
      $this->db->where(array('id'=>$id));
      $query=$this->db->get();
      return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){
    try{
      $this->db->insert('Produit', $data);
      return $this->db->insert_id();

    }catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
    
  }

  public function update($data){

     try {
            $where=array('id'=>$this->input->post('produit_id'));
            $this->db->update('Produit',$data,$where);
            return $this->db->affected_rows();
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      }

  }

  public function delete(){

    try {
          $id= $this->input->post('produit_id');
          $this->db->where('id',$id);
          $this->db->delete('Produit');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }

  public function search_produits($produit){
    try{
      $this->db->select('*');
      $this->db->from('Produit');
      $this->db->or_like(array('nom'=>$produit));
      $query=$this->db->get();
      return $query->result();
    }      
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }
}