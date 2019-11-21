<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Site_station_service_model extends CI_Model{

  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function getAll_Site_station_service($id){

    try{
      
        $sql =" SELECT users.id as idusers,users2.id as idusers,users.login as login1,users2.login as login2, users.fullname as full1,users2.fullname as full2, reseau.id as idvisite, reseau.visit_date as date, type.name as name,
                type.local_type_id as type
                FROM network_visit AS reseau 
                join codir_users as users on reseau.visitor_id = users.id 
                join codir_locals as type on reseau.gas_station_id = type.id 
                join codir_users as users2 on users2.id = type.local_manager_id
             ";
        if ($id != null){
          $sql = $sql. "where reseau.id = $id";
        }
        else $sql = $sql;
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