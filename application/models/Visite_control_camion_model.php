<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Visite_control_camion_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_count(){
        try{
            $this->db->select('*');
            $this->db->from('VisiteCamionControle');
            return $this->db->count_all_results();
        }catch(Exception $e){
            show_error($e->getMessage().'-------------'.$e->getTraceAsString());
        }
    }

    public function get_all_visites($limit,$start){
        try{
            $this->db->select('VisiteCamionControle.*,Produit.nom AS produit,PointControle.label AS point_controle,Visite.id AS visite_id,Visite.date AS date,Visite.time AS time,Localisation.nom AS localisation,Visiteur.nom_complet AS visiteur,Chef_site.nom_complet AS chef_site');
            $this->db->from('VisiteCamionControle');
            $this->db->join('Produit','Produit.id=produit_id','inner');
            $this->db->join('PointControle','PointControle.id=point_controle_id','inner');
            $this->db->join('Visite','Visite.id=visite_id','inner');
            $this->db->join('Localisation','Localisation.id=Visite.localisation_id','inner');
            $this->db->join('Utilisateur AS Visiteur','Visiteur.id=Visite.visiteur_id','inner');
            $this->db->join('Utilisateur AS Chef_site','Chef_site.id=Localisation.responsable_id','inner');
            $this->db->limit($limit,$start);
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function get_all_visite_by_id($id){
        try{
            $this->db->select('VisiteCamionControle.*,Produit.nom AS produit,PointControle.label AS point_controle,Visite.id AS visite_id,Visite.date AS date,Visite.time AS time,Localisation.nom AS localisation,Visiteur.nom_complet AS visiteur,Chef_site.nom_complet AS chef_site');
            $this->db->from('VisiteCamionControle');
            $this->db->join('Produit','Produit.id=produit_id','inner');
            $this->db->join('PointControle','PointControle.id=point_controle_id','inner');
            $this->db->join('Visite','Visite.id=visite_id','inner');
            $this->db->join('Localisation','Localisation.id=Visite.localisation_id','inner');
            $this->db->join('Utilisateur AS Visiteur','Visiteur.id=Visite.visiteur_id','inner');
            $this->db->join('Utilisateur AS Chef_site','Chef_site.id=Localisation.responsable_id','inner');
            $this->db->where('VisiteCamionControle.visite_id',$id);
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function get_reponses($id_visite){
        try{
            $this->db->select('QuestionReponse.reponse,QuestionReponse.observations,Question.label,Question.id as id,QuestionCategorie.label AS categorie,QuestionCategorie.id as idcategorie,QuestionSousCategorie.label AS sous_categorie,QuestionSousCategorie.id as idsouscategorie');
            $this->db->from('QuestionReponse');
            $this->db->join('Question','Question.id=question_id');
            $this->db->join('QuestionCategorie','QuestionCategorie.id=Question.categorie_id');
            $this->db->join('QuestionSousCategorie','QuestionSousCategorie.id=Question.sous_categorie_id','left');
            $this->db->join('Visite','Visite.id=visite_id');
            $this->db->where(array('QuestionReponse.visite_id'=>$id_visite));
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'------'.$e->getTraceAsString());
        }
    }
}