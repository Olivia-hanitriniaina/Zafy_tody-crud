<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?=base_url('/assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('/assets/css/login_form.css')?>">


</head>
<body>
   
        

        <?php $this->load->helper('form') ?>
        <div class="container">
            <img src="<?=base_url('/assets/images/logo.png')?>" alt="logo" id="logo">
            <?= form_open('utilisateur/se_connecter',array('class'=>'form')) ?>
            <fieldset>
                <div class="form-group">
                    <label for="adresse_email">Adresse email: </label>
                    <?= form_input(array('name'=>'adresse_email','id'=>'adresse_email','class'=>'form-control'))?>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe: </label>
                    <?= form_password(array('name'=>'password','id'=>'password','class'=>'form-control'))?>
                </div>
                <div class="form-group">
                    <?= form_submit(array('name'=>'login','id'=>'login','class'=>'btn btn-primary','value'=>'Login'))?>
                </div>
                <?php if(!empty($error)): ?>
                    <div class="alert alert-error"><?=$error?></div>
                <?php endif; ?>    
            </fieldset>
            <?= form_close()?>
        </div>


        <script src="<?=base_url('/assets/js/jquery.min.js')?>"></script>
        <script src="<?=base_url('/assets/js/bootstrap.min.js')?>"></script>
   
</body>
</html>