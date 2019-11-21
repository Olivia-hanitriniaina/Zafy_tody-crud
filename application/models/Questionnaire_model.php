<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Questionnaire_model extends CI_Model{

  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function FindAll_categorie(){
    try{
      
        $sql ="  SELECT * from categories ";
        $query = $this->db->query($sql);
        $rows = $query->result();
        return $rows;
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
  }

  public function FindAll_subcategorie(){
    try{
      
          $sql ="  SELECT * from subcategories";
          $query = $this->db->query($sql);
          $rows = $query->result();
          return $rows;
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      }
  }
  public function FindAll_Question_reseau(){

    try{
      
        $sql ="  SELECT qcs.id as id1, c.label as labelcat, q.label as label3, s.label as label2 from question_category_subcategory as qcs 
                join categories as c on qcs.category_id = c.id 
                join subcategories as s on qcs.subcategory_id = s.id 
                join questions as q on qcs.question_id = q.id 
                join items as i on qcs.item_id = i.id 
                where i.label = 'network'
             ";
        $query = $this->db->query($sql);
        $rows = $query->result();
        return $rows;
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }
  }
}
?>