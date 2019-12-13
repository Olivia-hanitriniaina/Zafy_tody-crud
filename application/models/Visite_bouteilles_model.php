<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Visite_bouteilles_model extends CI_model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_count(){
        try{
           $this->db->select('*');
           $this->db->from('visitecamionstlbouteille');
           $this->db->join('Visite','Visite.id=visite_id','inner');
           $this->db->join('Localisation','Localisation.id=localisation_id','inner');
           $this->db->join('Produit','Produit.id=produit_id','inner');
           return $this->db->count_all_results(); 
        }catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function get_all_visites($limit,$start){
        try{
            $this->db->select('visitecamionstlbouteille.visite_id,localisation.nom as localisation,utilisateur.nom_complet as visiteur,visitecamionstlbouteille.nom_transporteur as nom_transporteur, visitecamionstlbouteille.nom_conducteur as nom_conducteur, visitecamionstlbouteille.kilometrage_tracteur as kilometrage_tracteur,visitecamionstlbouteille.immatriculation_tracteur as immatriculation_tracteur, visitecamionstlbouteille.immatriculation_semi_remorque as immatriculation_semi_remorque, visitecamionstlbouteille.vehicule_acceptee as vehicule_acceptee,  visitecamionstlbouteille.visa_inspecteur as visa_inspecteur , visitecamionstlbouteille.visa_conducteur as  visa_conducteur ,produit.nom as product,visite.date as date, visite.time as heure');
            $this->db->from('visitecamionstlbouteille');
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
            $this->db->select('visitecamionstlbouteille.visite_id,localisation.nom as localisation,utilisateur.nom_complet as visiteur,visitecamionstlbouteille.nom_transporteur as nom_transporteur, visitecamionstlbouteille.nom_conducteur as nom_conducteur, visitecamionstlbouteille.kilometrage_tracteur as kilometrage_tracteur,visitecamionstlbouteille.immatriculation_tracteur as immatriculation_tracteur, visitecamionstlbouteille.immatriculation_semi_remorque as immatriculation_semi_remorque, visitecamionstlbouteille.vehicule_acceptee as vehicule_acceptee,  visitecamionstlbouteille.visa_inspecteur as visa_inspecteur , visitecamionstlbouteille.visa_conducteur as  visa_conducteur ,produit.nom as product,visite.date as date, visite.time as heure');
            $this->db->from('visitecamionstlbouteille');
            $this->db->join('Visite','Visite.id=visite_id','inner');
            $this->db->join('Localisation','Localisation.id=localisation_id','inner');
            $this->db->join('LocalisationType','Localisation.type_id=LocalisationType.id','inner');
            $this->db->join('Produit','Produit.id=produit_id','inner');
            $this->db->join('Utilisateur','Utilisateur.id=Visite.visiteur_id','inner');
            $this->db->where('visitecamionstlbouteille.visite_id',$id);
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'------'.$e->getTraceAsString());
        }
    }

    public function search_visite($data){
        try{
            $this->db->select('visitecamionstlbouteille.visite_id,localisation.nom as localisation,utilisateur.nom_complet as visiteur,visitecamionstlbouteille.nom_transporteur as nom_transporteur, visitecamionstlbouteille.nom_conducteur as nom_conducteur, visitecamionstlbouteille.kilometrage_tracteur as kilometrage_tracteur,visitecamionstlbouteille.immatriculation_tracteur as immatriculation_tracteur, visitecamionstlbouteille.immatriculation_semi_remorque as immatriculation_semi_remorque, visitecamionstlbouteille.vehicule_acceptee as vehicule_acceptee,  visitecamionstlbouteille.visa_inspecteur as visa_inspecteur , visitecamionstlbouteille.visa_conducteur as  visa_conducteur ,produit.nom as product,visite.date as date, visite.time as heure');
            $this->db->from('visitecamionstlbouteille');
            $this->db->join('Visite','Visite.id=visite_id','inner');
            $this->db->join('Localisation','Localisation.id=localisation_id','inner');
            $this->db->join('LocalisationType','Localisation.type_id=LocalisationType.id','inner');
            $this->db->join('Produit','Produit.id=produit_id','inner');
            $this->db->join('Utilisateur','Utilisateur.id=Visite.visiteur_id','inner');
            foreach($data as $name => $value) {
                if(!empty($value)){
                    $this->db->or_like(array($name => $value));
                }
                else {
                    
                }
            }
/*
            if(!empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//tous remplies
                $this->db->or_like(array('utilisateur.nom_complet'=>$visiteur,'visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }elseif(empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//2 inputs remplies
                $this->db->or_like(array('visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }elseif(empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//2 inputs remplies
                $this->db->or_like(array('visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }elseif(empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//2 inputs remplies
                $this->db->or_like(array('visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }elseif(empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//2 inputs remplies
                $this->db->or_like(array('visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }elseif(empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//2 inputs remplies
                $this->db->or_like(array('visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }elseif(empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//2 inputs remplies
                $this->db->or_like(array('visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }elseif(empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//2 inputs remplies
                $this->db->or_like(array('visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }elseif(empty($visiteur) AND !empty($nom_transporteur) AND !empty($date) AND !empty($product) AND !empty($localisation) AND !empty($nom_conducteur) AND !empty($date) AND !empty($immatriculation_tracteur) AND !empty($immatriculation_semi_remorque)){//2 inputs remplies
                $this->db->or_like(array('visitecamionstlbouteille.nom_transporteur'=> $nom_transporteur,'produit.nom '=>$product ,'visite.date'=>$date ,'localisation.nom'=> $localisation,'visitecamionstlbouteille.nom_conducteur'=> $nom_conducteur,'visitecamionstlbouteille.immatriculation_tracteur '=> $immatriculation_tracteur,'visitecamionstlbouteille.immatriculation_semi_remorque'=>$immatriculation_semi_remorque));
            }
            else{

            }*/
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