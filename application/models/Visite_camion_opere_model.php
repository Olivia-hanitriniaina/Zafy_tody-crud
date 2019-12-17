<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Visite_camion_opere_model extends CI_model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_count(){
        try{
           $this->db->select('*');
           $this->db->from('visitecamionstlopere');
           $this->db->join('Visite','Visite.id=visite_id','inner');
           $this->db->join('Localisation','Localisation.id=localisation_id','inner');
           $this->db->join('LocalisationType','Localisation.type_id=LocalisationType.id','inner');
           $this->db->join('Produit','Produit.id=produit_id','inner');
           return $this->db->count_all_results(); 
        }catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function get_all_visites($limit,$start){
        try{
            $this->db->select('visitecamionstlopere.visite_id,visitecamionstlopere.nom_expediteur as nom_expediteur,localisation.nom as localisation,utilisateur.nom_complet as visiteur,visitecamionstlopere.nom_trasporteur as nom_trasporteur, visitecamionstlopere.nom_conducteur as nom_conducteur, visitecamionstlopere.kilometrage_tracteur as kilometrage_tracteur,visitecamionstlopere.immatriculation_tracteur as immatriculation_tracteur, visitecamionstlopere.immatriculation_semi_remorque as immatriculation_semi_remorque,produit.nom as product,visite.date as date, visite.time as heure');
            $this->db->from('visitecamionstlopere');
            $this->db->join('Visite','Visite.id=visite_id','inner');
            $this->db->join('Localisation','Localisation.id=localisation_id','inner');
            $this->db->join('LocalisationType','Localisation.type_id=LocalisationType.id','inner');
            $this->db->join('Produit','Produit.id=produit_id','inner');
            $this->db->join('Utilisateur','Utilisateur.id=Visite.visiteur_id','inner');
           
            $this->db->limit($limit,$start);
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'------'.$e->getTraceAsString());
        }
    }

    public function get_all_visites_by_id($id){
        try{
            $this->db->select('visitecamionstlopere.visite_id,localisation.nom as localisation,utilisateur.nom_complet as visiteur,visitecamionstlopere.nom_trasporteur as nom_trasporteur, visitecamionstlopere.nom_conducteur as nom_conducteur, visitecamionstlopere.nom_expediteur as nom_expediteur,visitecamionstlopere.kilometrage_tracteur as kilometrage_tracteur,visitecamionstlopere.immatriculation_tracteur as immatriculation_tracteur, visitecamionstlopere.immatriculation_semi_remorque as immatriculation_semi_remorque,produit.nom as product,visite.date as date, visite.time as heure');
            $this->db->from('visitecamionstlopere');
            $this->db->join('Visite','Visite.id=visite_id','inner');
            $this->db->join('Localisation','Localisation.id=localisation_id','inner');
            $this->db->join('Produit','Produit.id=produit_id','inner');
            $this->db->join('Utilisateur','Utilisateur.id=Visite.visiteur_id','inner');
            $this->db->where('visitecamionstlopere.visite_id',$id);
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'------'.$e->getTraceAsString());
        }
    }

    public function search_visite($data){
        try{
            $this->db->select('visitecamionstlopere.visite_id,localisation.nom as localisation,visitecamionstlopere.nom_expediteur as nom_expediteur,utilisateur.nom_complet as visiteur,visitecamionstlopere.nom_trasporteur as nom_trasporteur, visitecamionstlopere.nom_conducteur as nom_conducteur, visitecamionstlopere.kilometrage_tracteur as kilometrage_tracteur,visitecamionstlopere.immatriculation_tracteur as immatriculation_tracteur, visitecamionstlopere.immatriculation_semi_remorque as immatriculation_semi_remorque,produit.nom as product,visite.date as date, visite.time as heure');
            $this->db->from('visitecamionstlopere');
            $this->db->join('Visite','Visite.id=visite_id','inner');
            $this->db->join('Localisation','Localisation.id=localisation_id','inner');
            $this->db->join('Produit','Produit.id=produit_id','inner');
            $this->db->join('Utilisateur','Utilisateur.id=Visite.visiteur_id','inner');
            foreach($data as $name => $value) {
                if(!empty($value)){
                    $this->db->or_like(array($name => $value));
                }
                else {
                    
                }
            }
            $query=$this->db->get();
            return $query->result();
        }catch (Exception $e){
            show_error($e->getMessage().'------'.$e->getTraceAsString());
        }
    }
    public function get_reponses($id_visite){
        try{
            $this->db->select('QuestionReponse.reponse,QuestionReponse.observations,Question.label,Question.point_bloquant as point_bloquant,Question.id as id,QuestionCategorie.label AS categorie,QuestionCategorie.id as idcategorie,QuestionSousCategorie.label AS sous_categorie,QuestionSousCategorie.id as idsouscategorie');
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