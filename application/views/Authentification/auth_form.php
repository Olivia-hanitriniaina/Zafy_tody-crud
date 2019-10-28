<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page de connexion</title>

    <link rel="stylesheet" href="<?=base_url('/assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/login_form.css')?>">

    

</head>
<body>
        

    <?php $this->load->helper('form') ?>
   
    <div class="container">
    <img class="responsive" src="<?=base_url('/assets/images/logo.png')?>" alt="logo" id="logo">
        <?= form_open('authentification/login',array('class'=>'form')) ?>
        <fieldset class="scheduler-border">
            <div class="form-group">
                <?= form_label("Adresse email&nbsp:","adresse_email")?>
                <?= form_input(['name'=>'adresse_email','id'=>'adresse_email','class'=>'form-control'],set_value('adresse_email'))?>
            </div>

            <div class="form-group"> 
                <?= form_label("Mot de passe&nbsp:","password")?>
                <?= form_password(['name'=>'password','id'=>'password','class'=>'form-control'],set_value('password'))?>
            </div>

            <div class="form-group">
                <?= form_submit(array('name'=>'login','id'=>'login','class'=>'btn btn-primary','value'=>'Se connecter'))?>
            </div>
            <!--Déclération des 2 variables contenant les erreurs dans les inputs -->
            <?php 
                $mail_error=form_error('adresse_email');
                $passeword_error=form_error('password');
            ?>
            <!-- Gestion des erreurs -->
            <?php if(!empty($error)): ?>
                <div class="alert alert-danger " style="text-align:center"><?=$error?></div>
            <?php elseif(!empty($mail_error) AND !empty($passeword_error) ):?>
                <div class="alert alert-danger " style="text-align:center"><?=$mail_error.'and'.$passeword_error?></div>
            <?php elseif(!empty($mail_error)):?>
                <div class="alert alert-danger " style="text-align:center"><?=$mail_error?></div>
            <?php elseif(!empty($passeword_error)):?>
                <div class="alert alert-danger " style="text-align:center"><?=$passeword_error?></div> 
            <?php endif;?>           
        </fieldset>
        <?= form_close()?>
    </div>

    <script src="<?=base_url('/assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/bootstrap.min.js')?>"></script>
   
</body>
</html>