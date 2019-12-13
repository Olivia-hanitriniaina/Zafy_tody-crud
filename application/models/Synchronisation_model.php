<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Synchronisation_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_All_Utilisateur(){
    try{
      
        $sql =" SELECT * FROM `utilisateur` join utilisateurtype ON utilisateur.type_id = utilisateurtype.id";
        $query = $this->db->query($sql);
        $rows = $query->result();
        return $rows;
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
  }
}