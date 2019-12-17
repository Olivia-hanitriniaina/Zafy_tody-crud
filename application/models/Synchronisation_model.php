<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Synchronisation_model extends CI_Model{
  public function __construct(){
    parent::__construct();
    $this->load->database();
  }
/*============================================================
          Liste utilisateur
============================================================*/

  public function get_All_Utilisateur(){
    try{
        $this->db->select('utilisateur.id ,utilisateur.nom_utilisateur,utilisateur.mot_de_passe,utilisateur.nom_complet ,utilisateur.adresse_email ,utilisateur.est_active,utilisateurtype.label ,utilisateurtype.id as idtype');
        $this->db->from('utilisateur');
        $this->db->join('utilisateurtype','utilisateur.type_id = utilisateurtype.id','inner');
        $this->db->order_by('utilisateur.id');
        $query=$this->db->get();
        return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
  }

/*============================================================
            liste entreprise
============================================================*/

  public function get_All_Entreprise(){

    try{
      $this->db->select('*');
      $this->db->from('entrepriseexterieur');
      $query=$this->db->get();
      return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
  }
  /*============================================================
              liste produit
============================================================*/

  public function get_All_produit(){

    try{
      $this->db->select('*');
      $this->db->from('produit');
      $query=$this->db->get();
      return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
  }
    /*============================================================
              liste localisationtype
============================================================*/

  public function get_All_Localisation_type(){

    try{
      $this->db->select('*');
      $this->db->from('localisationType');
      $query=$this->db->get();
      return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
  }
  /*============================================================
              liste localisation
============================================================*/

      
    public function get_All_Localisation($localisation_type){

      try{
        $this->db->select('*');
        $this->db->from('localisation');
        $this->db->where('localisation.type_id', $localisation_type);
        $query=$this->db->get();
        return $query->result();
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      } 
    }
    
    /*============================================================
              liste pointcontrole
============================================================*/

  public function get_All_pointcontrole(){

    try{
      $this->db->select('*');
      $this->db->from('pointcontrole');
      $query=$this->db->get();
      return $query->result();
    }
    catch(Exception $e){
      show_error($e->getMessage().'-----'.$e->getTraceAsString());
    } 
  }

  public function get_All_question_visite($idvisitetype){

      try{
        $this->db->select('question.id,question.label,question.visite_type_id,question.point_bloquant,question.point_bloquant_exception,questioncategorie.id as idcategorie,questioncategorie.label as categorie, questionsouscategorie.id as idsousCataegorie, questionsouscategorie.label as souscategorie');
        $this->db->from('question');
        $this->db->join('questioncategorie','question.categorie_id = questioncategorie.id','left');
        $this->db->join('questionsouscategorie','question.sous_categorie_id = questionsouscategorie.id','left');
        $this->db->where('visite_type_id',$idvisitetype);
        $query=$this->db->get();
        return $query->result();
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      } 
    }

    public function get_All_visite_type(){
      try{
        $this->db->select('*');
        $this->db->from('visitetype');
        $query=$this->db->get();
        return $query->result();
      }
      catch(Exception $e){
        show_error($e->getMessage().'-----'.$e->getTraceAsString());
      } 
    }
}