<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page d'accueil</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?=base_url('/assets/css/bootstrap.min.css')?>"> 
    <link rel="stylesheet" href="<?=base_url('/assets/css/acceuil.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/tour_securite_codir.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/datatables.min.css')?>">
    <!--<link rel="stylesheet" href="<?=base_url('/assets/css/recherche.css')?>"> -->
    <link rel="stylesheet" href="<?=base_url('/assets/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Stylesheet
        ================================================== -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('/assets/css/style.css')?>"> 
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rochester" rel="stylesheet">

    <!-- SCRIPT -->
    <script src="<?=base_url('/assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/bootstrap.min.js')?>"></script>
    <!--<script src="<?=base_url('/assets/js/navbar_script.js') ?>"></script>-->
    <script src="<?=base_url('/assets/js/fontawesome.min.js') ?>"></script>
    <script src="<?=base_url('/assets/js/datatables.min.js') ?>"></script>
    <script src="<?=base_url('/assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?=base_url('/assets/js/main.js') ?>"></script>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" id="navbar">
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href=""><?= $this->session->userdata['logged_in']['fullname'] ?>  <i class='fa fa-user'></i></a>  
        </li>
        <li>
            <a href="<?=base_url('/authentification/logout')?>"> Se déconnecter  <i class="fa fa-sign-out" aria-hidden="true"></i></a>
        </li>
    </ul>
</div>

<div class="wrapper">
    <div class="sidebar">
        <img src="<?=base_url().'assets/images/logo.png'?>" alt="logo_total">
        <ul>
            <?php if (isset($this->session->userdata['logged_in'])):?>
                <li><?=anchor("accueil/acceuil"," Accueil",array('class'=>'fa fa-home'))?></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color:transparent" id="dropdown"> <i class="fa fa-list" ></i> Liste déroulante <b class="caret"></b></a>
                    <ul id="dropdown-menu">
                           
                    </ul>
                </li>
                <li><?=anchor("gestion_utilisateur/","  Gestion utilisateur",array('class'=>'fa fa-users'))?></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color:transparent" id="dropdown2"> <i class="fa fa-clipboard" ></i> Les visites <b class="caret"></b></a>
                    <ul id="dropdown-menu2">
                           
                    </ul>
                </li>
            <?php else: ?>
                <?php redirect('authentification/') ?>
            <?php endif; ?> 
        </ul>    
    </div>
    <script>
        $(document).ready(function(){
            var status=false;
            $('#dropdown').click(function(){
                var li='';
                li+='<li>'+'<?=anchor("station_service/","Station service")?>'+'</li>';
                li+='<li>'+'<?=anchor("depot_aviation/","Dépôt aviation")?>'+'</li>';
                li+='<li>'+'<?=anchor("centre_emplisseur/","Centre emplisseur")?>'+'</li>';
                li+='<li>'+'<?=anchor("ville/","Ville")?>'+'</li>';
                li+='<li>'+'<?=anchor("site/","Site")?>'+'</li>';
                li+='<li>'+'<?=anchor("lieu/","Lieu")?>'+'</li>';
                li+='<li>'+'<?=anchor("produit/","Produit")?>'+'</li>';

                if(status==false){
                    $('#dropdown-menu').append(li);
                    status=true;
                }else{
                    $('#dropdown-menu').children('li').remove();
                    status=false;
                }
                
            });
            $('#dropdown2').click(function(){
                var li='';
                li+='<li>'+'<?=anchor("Visite_station/","Tour sécurité CODIR station service")?>'+'</li>';
                li+='<li>'+'<?=anchor("Visite_depot/","Tour sécurité CODIR dépôt aviation")?>'+'</li>';
                li+='<li>'+'<?=anchor("Visite_centre/","Tour sécurité CODIR centre emplisseur")?>'+'</li>';
                li+='<li>'+'<?=anchor("Visite_control_camion/","Contrôle camion")?>'+'</li>';
                li+='<li>'+'<?=anchor("Visite_chantier/","HSE Chantier")?>'+'</li>';
                li+='<li>'+'<?=anchor("Visite_bouteilles","STL Bouteilles")?>'+'</li>';
                li+='<li>'+'<?=anchor("produit/","STL Camion opéré")?>'+'</li>';

                if(status==false){
                    $('#dropdown-menu2').append(li);
                    status=true;
                }else{
                    $('#dropdown-menu2').children('li').remove();
                    status=false;
                }
                
            });
        });
    </script>