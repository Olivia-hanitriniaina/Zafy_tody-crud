<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Visite_chantier_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_count(){
        try{
            $this->db->select('*');
            $this->db->from('VisiteHSEChantier');
            $this->db->join('Visite','Visite.id=VisiteHSEChantier.visite_id','inner');
            $this->db->join('Localisation','Localisation.id=Visite.localisation_id','inner');
            $this->db->join('Utilisateur AS Visiteur','Visiteur.id=Visite.visiteur_id');
            $this->db->join('Utilisateur AS ChefSite','ChefSite.id=Localisation.responsable_id');
            $this->db->join('EntrepriseExterieur','EntrepriseExterieur.id=VisiteHSEChantier.entreprise_exterieur_id');
            return $this->db->count_all_results();
        }catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function get_all_visites($limit,$start){
        try{
            $this->db->select('VisiteHSEChantier.visite_id,VisiteHSEChantier.nom_chef_chantier_exterieur,VisiteHSEChantier.point_forts,VisiteHSEChantier.point_faibles,VisiteHSEChantier.point_abordes,EntrepriseExterieur.nom AS Entreprise,Localisation.nom AS Site,Visiteur.nom_complet AS visiteur,ChefSite.nom_complet AS chef_site,Visite.date,Visite.time');
            $this->db->from('VisiteHSEChantier');
            $this->db->join('Visite','Visite.id=VisiteHSEChantier.visite_id','inner');
            $this->db->join('Localisation','Localisation.id=Visite.localisation_id','inner');
            $this->db->join('Utilisateur AS Visiteur','Visiteur.id=Visite.visiteur_id','inner');
            $this->db->join('Utilisateur AS ChefSite','ChefSite.id=Localisation.responsable_id','inner');
            $this->db->join('EntrepriseExterieur','EntrepriseExterieur.id=VisiteHSEChantier.entreprise_exterieur_id','left');
            $this->db->limit($limit,$start);
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function get_all_visites_by_id($id){
        try{
            $this->db->select('VisiteHSEChantier.visite_id,VisiteHSEChantier.nom_chef_chantier_exterieur,VisiteHSEChantier.point_forts,VisiteHSEChantier.point_faibles,VisiteHSEChantier.point_abordes,EntrepriseExterieur.nom AS Entreprise,Localisation.nom AS Site,Visiteur.nom_complet AS visiteur,ChefSite.nom_complet AS chef_site,Visite.date,Visite.time');
            $this->db->from('VisiteHSEChantier');
            $this->db->join('Visite','Visite.id=VisiteHSEChantier.visite_id','inner');
            $this->db->join('Localisation','Localisation.id=Visite.localisation_id','inner');
            $this->db->join('Utilisateur AS Visiteur','Visiteur.id=Visite.visiteur_id','inner');
            $this->db->join('Utilisateur AS ChefSite','ChefSite.id=Localisation.responsable_id','inner');
            $this->db->join('EntrepriseExterieur','EntrepriseExterieur.id=VisiteHSEChantier.entreprise_exterieur_id','left');
            $this->db->where('VisiteHSEChantier.visite_id',$id);
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function search_visite($site,$date,$entreprise){
        try{
            $this->db->select('VisiteHSEChantier.visite_id,VisiteHSEChantier.nom_chef_chantier_exterieur,VisiteHSEChantier.point_forts,VisiteHSEChantier.point_faibles,VisiteHSEChantier.point_abordes,EntrepriseExterieur.nom AS Entreprise,Localisation.nom AS Site,Visiteur.nom_complet AS visiteur,ChefSite.nom_complet AS chef_site,Visite.date,Visite.time');
            $this->db->from('VisiteHSEChantier');
            $this->db->join('Visite','Visite.id=VisiteHSEChantier.visite_id','inner');
            $this->db->join('Localisation','Localisation.id=Visite.localisation_id','inner');
            $this->db->join('Utilisateur AS Visiteur','Visiteur.id=Visite.visiteur_id','inner');
            $this->db->join('Utilisateur AS ChefSite','ChefSite.id=Localisation.responsable_id','inner');
            $this->db->join('EntrepriseExterieur','EntrepriseExterieur.id=VisiteHSEChantier.entreprise_exterieur_id','left');

            if(!empty($site) AND !empty($date) AND !empty($entreprise)){//tous remplies
                $this->db->or_like(array('Localisation.nom'=>$site,'Visite.date'=>$date,'EntrepriseExterieur.nom'=>$entreprise));
            }elseif(!empty($site) AND !empty($date) AND empty($entreprise)){//2 inputs remplies
                $this->db->or_like(array('Localisation.nom'=>$site,'Visite.date'=>$date));
            }elseif(!empty($site) AND empty($date) AND !empty($entreprise)){//2 inputs remplies
                $this->db->or_like(array('Localisation.nom'=>$site,'EntrepriseExterieur.nom'=>$entreprise));
            }elseif(empty($site) AND !empty($date) AND !empty($$entreprise)){//2 inputs remplies
                $this->db->or_like(array('Visite.date'=>$date,'EntrepriseExterieur.nom'=>$entreprise));
            }elseif(!empty($site) AND empty($date) AND empty($entreprise)){//1 input remplie
                $this->db->or_like(array('Localisation.nom'=>$site));
            }elseif(empty($site) AND !empty($date) AND empty($entreprise)){//1 input remplie
                $this->db->or_like(array('Visite.date'=>$date));
            }elseif(empty($site) AND empty($date) AND !empty($$entreprise)){//1 input remplie
                $this->db->or_like(array('EntrepriseExterieur.nom'=>$entreprise));
            }else{

            }    
            $query=$this->db->get();
            return $query->result();
        }catch (Exception $e){
            show_error($e->getMessage().'------'.$e->getTraceAsString());
        }
    }

    public function get_reponses($id_visite){
        try{
            $this->db->select('QuestionReponse.reponse,QuestionReponse.observations,Question.label,Question.id as id,QuestionCategorie.label AS categorie,QuestionCategorie.id as idcategorie');
            $this->db->from('QuestionReponse');
            $this->db->join('Question','Question.id=question_id');
            $this->db->join('QuestionCategorie','QuestionCategorie.id=Question.categorie_id');
            $this->db->join('Visite','Visite.id=visite_id');
            $this->db->where(array('QuestionReponse.visite_id'=>$id_visite));
            $query=$this->db->get();
            return $query->result();
        }catch(Exception $e){
            show_error($e->getMessage().'------'.$e->getTraceAsString());
        }
    }
}