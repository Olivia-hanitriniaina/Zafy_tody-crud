<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Role_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function get_all_role(){

    try {
          $this->db->from('role');
          $query=$this->db->get();
          return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    }

  }

}