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
    <link rel="stylesheet" href="<?=base_url('/assets/css/recherche.css')?>">
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
    <script src="<?=base_url('/assets/js/navbar_script.js') ?>"></script>
    <script src="<?=base_url('/assets/js/fontawesome.min.js') ?>"></script>
    <script src="<?=base_url('/assets/js/datatables.min.js') ?>"></script>
    <script src="<?=base_url('/assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?=base_url('/assets/js/main.js') ?>"></script>
</head>
<body>
    <!-- Navigation
        ==========================================-->
    <nav id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="container"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav ">
                    <?php if (isset($this->session->userdata['logged_in'])):?>
                        <li><?=anchor("accueil/acceuil","Accueil")?></li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" style="background-color:transparent">Listes <b class="caret"></b></a>
                            <ul class="dropdown-menu jqueryfadeIn" style="background-color:rgba(0,0,0,0.5)">
                                <li class="dropdown"><?=anchor("station_service/","Station service")?></li>
                                <li class="dropdown"><?=anchor("depot_aviation/","Dépôt aviation")?></li>
                                <li class="dropdown"><?=anchor("centre_emplisseur/","Centre emplisseur")?></li>
                                <li class="dropdown"> <?=anchor("ville/","Ville")?></li>
                                <li class="dropdown"> <?=anchor("site/","Site")?> </li>
                                <li class="dropdown"> <?=anchor("lieu/","Lieu")?> </li>
                                <li class="dropdown"> <?=anchor("produit/","Produit")?> </li>
                            </ul>
                        </li>
                        <li><?=anchor("gestion_utilisateur/","Gestion utilisateur")?></li>
                    <?php else: ?>
                        <?php redirect('authentification/') ?>
                    <?php endif; ?> 
                </ul>    
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?=base_url('/authentification/logout')?>" style="font-size:15px">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Se déconnecter
                        </a>
                    </li>
                </ul>
                
            </div>
            <!-- /.navbar-collapse --> 
        </div>
    </nav>
    <!-- Header -->
    <header id="header">
        <div class="intro">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="intro-text">
                            <h1></h1>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="nav navbar-nav">
                   
                </ul>
                <ul class="nav navbar-nav navbar-right">
                        
                    <li style = "  font-family: arial; font-size: 20px; margin-top: 8.5px;">
                      Bienvenu : <?php echo $connecter['login']?>
                    </li>
                </ul>

               
            </div>
        </div>
    </nav>
    <!-- Features Section -->    