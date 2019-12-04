<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Gestion_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_users($limit,$start){
    try{
      $this->db->select('Utilisateur.*,UtilisateurType.label');
      $this->db->from('Utilisateur');
      $this->db->join('UtilisateurType','type_id = UtilisateurType.id','left');
      $this->db->limit($limit,$start);
      $query=$this->db->get();
      return $query->result();
      //
      /* $query = $this->db->query("SELECT * from codir_users");
      $rows = $query->result();
      return $rows;   */     
    }      
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }

  public function get_count(){
    try{
      $this->db->select('*');
      $this->db->from('Utilisateur');
      $this->db->join('UtilisateurType','type_id = UtilisateurType.id','left');
      return $this->db->count_all_results();

    }      
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }

  public function get_user_profil(){
    try{
      $this->db->select('*');
      $this->db->from('UtilisateurType');
      $query=$this->db->get();
      return $query->result();
    }catch(Exception $e){
      show_error($e->getMessage().'------'.$e->getTraceAsString());
    }
  }

  public function get_by_id($id){

    try {
      $this->db->from('Utilisateur');
      $this->db->where('id',$id);
      $query=$this->db->get();
      return $query->row();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function create($data){

    try{
      $this->db->insert('Utilisateur',$data);
      return $this->db->insert_id();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function update($data){

    try {
      $where=array('id'=>$this->input->post('user_id'));
      $this->db->update('Utilisateur',$data,$where);
      return $this->db->affected_rows();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function delete(){
    
    try {
      $id= $this->input->post('user_id');
      $this->db->where('id',$id);
      $this->db->delete('Utilisateur');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

  public function search_users($utilisateur){
    try{
      $this->db->select('*');
      $this->db->from('Utilisateur');
      $this->db->join('UtilisateurType','type_id = UtilisateurType.id','left');
      $this->db->or_like(array('nom_utilisateur'=>$utilisateur,'nom_complet'=>$utilisateur));
      $query=$this->db->get();
      return $query->result();
    }      
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }
}