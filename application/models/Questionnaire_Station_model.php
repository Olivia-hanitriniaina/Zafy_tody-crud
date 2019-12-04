<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Questionnaire_station_model extends CI_Model{

    public function get_All_Questionnnaire_stationService(){
        try{
            
            $sql ="SELECT * FROM VUEStationServiceQuestion ";
            $query = $this->db->query($sql);
            $rows = $query->result();
            return $rows;
        }
        catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function get_All_fiche_visite_station($id){

        try{
            
            $sql =" SELECT vsc.visite_id as visite, v.id as idvisiteur, v.date as datevisiteur, v.time as timevisiteur, u.nom_complet as nomvisiteur,ut.nom_complet as nomgerant,l.nom as nomstation from VisiteStationService as vsc 
                     join Visite as v on vsc.visite_id= v.visiteur_id 
                     join VisiteType as vt on vsc.type_id = vt.id 
                     join Localisation as l on v.localisation_id = l.id 
                     join Utilisateur as u on v.visiteur_id = u.id 
                     join Utilisateur as ut on l.responsable_id = ut.id
                    where vsc.type_id = ".$id." ";
                
            $query = $this->db->query($sql);
            $rows = $query->result();
            return $rows;
        }
        catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
        
    }
    public function get_All_fiche_visite_station_by_id($idtype,$idstation){

        try{
            
            $sql =" SELECT vsc.visite_id as visite, v.id as idvisiteur, v.date as datevisiteur, v.time as timevisiteur, u.nom_complet as nomvisiteur,ut.nom_complet as nomgerant,l.nom as nomstation from VisiteStationService as vsc 
                     join Visite as v on vsc.visite_id= v.visiteur_id 
                     join VisiteType as vt on vsc.type_id = vt.id 
                     join Localisation as l on v.localisation_id = l.id 
                     join Utilisateur as u on v.visiteur_id = u.id 
                     join Utilisateur as ut on l.responsable_id = ut.id
                    where vsc.type_id = ".$idtype." and  v.id = ".$idstation." "; 
            $query = $this->db->query($sql);
            $rows = $query->result();
            return $rows;
        }
        catch(Exception $e){
            show_error($e->getMessage().'-----'.$e->getTraceAsString());
        }
    }

    public function get_All_recherche_station($station, $date, $visiteur)
    {
        try{
            $sql =" SELECT vsc.visite_id as visite, v.id as idvisiteur, v.date as datevisiteur, v.time as timevisiteur, u.nom_complet as nomvisiteur,ut.nom_complet as nomgerant,l.nom as nomstation from VisiteStationService as vsc 
                    join Visite as v on vsc.visite_id= v.visiteur_id 
                    join VisiteType as vt on vsc.type_id = vt.id 
                    join Localisation as l on v.localisation_id = l.id 
                    join Utilisateur as u on v.visiteur_id = u.id 
                    join Utilisateur as ut on l.responsable_id = ut.id
                    where vsc.type_id = 1 ";
            if($station == "" && $date == "" && $visiteur == ""){
                $sql = $sql;
            }
            else{
                
                if($station != " " && $date == " " && $visiteur == " ")
                {
                    $sql = $sql." and l.nom '%".$station."%' ";
                }
                if($station == " " && $date != " " && $visiteur == " ")
                {
                    $sql = $sql." and v.date like '%".$date."%'";
                }
                if($station == " " && $date == " " && $visiteur != " ")
                {
                    $sql = $sql." u.nom_complet like  '%".$visiteur."%'";
                }
                if($station == " " && $date != " " && $visiteur != " ")
                {
                    $sql = $sql." and v.date like '%".$date."%' and u.nom_complet like  '%".$visiteur."%'";
                }
                if($station != " " && $date != " " && $visiteur == " ")
                {
                    $sql = $sql." and l.nom '%".$station."%' and v.date like '%".$date."%'";
                }
                if($station != " " && $date == " " && $visiteur != " ")
                {
                    $sql = $sql." and l.nom '%".$station."%' and u.nom_complet like  '%".$visiteur."%'";
                }
                if($station != " " && $date != " " && $visiteur != " ")
                {
                    $sql = $sql." and l.nom '%".$station."%' and v.date like '%".$date."%' and u.nom_complet like  '%".$visiteur."%'";
                }
            }
            
            $query = $this->db->query($sql);
            $rows = $query->result();
            return $rows;
        }
        catch(Exception $e){
            show_error($e->getMessage().'------'.$e->getTraceAsString());
        }
    }
}


