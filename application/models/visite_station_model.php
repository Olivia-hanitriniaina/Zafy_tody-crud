<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Visite_station_model extends CI_model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_all_questions(){
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->join('categories','categories.id_categorie=categorie_id','left');
        $this->db->join('subcategories','subcategories.id_subcategorie=subcategorie_id','left');
        $this->db->join('items','items.id_item=item_id','left');
        $this->db->where(array('item_id'=>1));
        $query=$this->db->get();
        return $query->result();
    }
}