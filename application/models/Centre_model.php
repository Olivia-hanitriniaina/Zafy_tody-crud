<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Centre_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_users(){
    try{
      $this->db->select("id,nom_complet");
      $this->db->from('Utilisateur');
      $this->db->where(array('type_id'=>1));
      $query=$this->db->get();

      return $query->result();       
    }      
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }

  public function get_count(){
    try {
      $this->db->select('localisation.*,LocalisationType.label,Utilisateur.nom_complet');
      $this->db->from('Localisation');
      $this->db->join('LocalisationType','type_id=LocalisationType.id');
      $this->db->join('Utilisateur','Utilisateur.id=responsable_id','left');
      $this->db->where(array('Localisation.type_id'=>6));
      return $this->db->count_all_results();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
    
  }

  public function get_all_centres($limit,$start){
    try {
      $this->db->select('Localisation.*,LocalisationType.label,Utilisateur.nom_complet');
      $this->db->from('Localisation');
      $this->db->join('LocalisationType','Localisation.type_id=LocalisationType.id');
      $this->db->join('Utilisateur','Utilisateur.id=responsable_id','left');
      $this->db->where(array('Localisation.type_id'=>6));
      $this->db->limit($limit,$start);
      $query=$this->db->get();
      return $query->result_array();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }

  public function get_by_id($id){

    try{
      $this->db->select('Localisation.*,LocalisationType.label,Utilisateur.nom_complet');
      $this->db->from('Localisation');
      $this->db->join('LocalisationType','Localisation.type_id=LocalisationType.id');
      $this->db->join('Utilisateur','Utilisateur.id=responsable_id','left');
      $this->db->where(array('Localisation.type_id'=>6,'Localisation.id'=>$id));
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
            $where=array('id'=>$this->input->post('centre_id'));
            $this->db->update('Localisation',$data,$where);
            return $this->db->affected_rows();
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      }

  }

  public function delete(){

    try {
          $id= $this->input->post('centre_id');
          $this->db->where('id',$id);
          $this->db->delete('Localisation');
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }

  public function search_centre($centre, $gerant){
    try{

        $sql =" SELECT * from Localisation 
                join LocalisationType
                on Localisation.type_id =LocalisationType.id 
                join Utilisateur 
                on Utilisateur.id=responsable_id
                where Localisation.type_id = 6";
        if($centre == " " && $gerant != " ")
        {
            $sql = $sql." and nom like '%".$centre."%' ";
        }
        if($gerant == " " && $centre != " ")
        {
            $sql = $sql." and Utilisateur.nom_complet like '%".$gerant."%' ";
        }
        if($centre != " " && $gerant != " ")
        {
            $sql = $sql." and nom like '%".$centre."%' and Utilisateur.nom_complet like '%".$gerant."%' ";
        }
        else {
          $sql = $sql;
        }
        $query = $this->db->query($sql);
        $rows = $query->result();
        return $rows;
    }
    catch(Exception $e){
        show_error($e->getMessage().'------'.$e->getTraceAsString());
    }
  }  
}