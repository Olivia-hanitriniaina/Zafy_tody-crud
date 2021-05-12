<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page de connexion</title>

    <link rel="stylesheet" href="<?=base_url('/assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url('/assets/css/login_form.css')?>">

    

</head>
<body>
    <div class="container-fluid page_login">
        <?php $this->load->helper('form') ?>
    
    <div class="container">
        <h2 style="text-align:center">S'inscrire</h2>
        <p style="color:red"><?php echo $message ?></p>
        <?= form_open('authentification/inscription',array('class'=>'form')) ?>
        <fieldset class="scheduler-border">
            <div class="form-group">
                <?= form_label("Nom d'utilisateur*&nbsp:","nom")?>
                <input type="text" name="nom" placeholder="nom utilisateur"  class="form-control" required/>
            </div>

            <div class="form-group">
                <?= form_label("Prenom*&nbsp:","prenom")?>
                <input type="text" name="prenom" placeholder="prenom"  class="form-control" required/>
            </div>

            <div class="form-group">
                <?= form_label("Email*:","email")?>
                <input type="text" name="email" placeholder="email@gmail.om"  class="form-control"/>
            </div>

            <div class="form-group">
                <?= form_label("Role:","role")?>
                <select class="form-control" name="role" id="role">
                    <option value="1">Admin</option>
                    <option value="0">utilisateur</option>
                </select>
            </div>

            <div class="form-group">
                <?= form_label("ville*&nbsp:","ville")?>
                <input type="text" name="ville" placeholder="ville"  class="form-control" required/>
            </div>

            <div class="form-group">
                <?= form_label("numero*&nbsp:","numero")?>
                <input type="text" name="numero" placeholder="numero"  class="form-control" required/>
            </div>

            <div class="form-group"> 
                <?= form_label("Mot de passe*&nbsp:","mdp")?>
                <input type="password" name="mdp" placeholder="mdp"  class="form-control" required/>
            </div>

            <div class="form-group">
                <label for="name" class="control-label">Confirmation du mot de passe* : </label>
                <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirmer votre mot de passe" value="" required="">
            </div>

            <div class="form-group">
                <button type="submit" name="login" id="login" class="btn btn-primary"><i class="fa fa-sign-in" aria-hidden="true"></i> Enregistrer</button>
            </div>
        </fieldset>
        <?= form_close()?>
   </div>   
    </div>
    <script src="<?=base_url('/assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('/assets/js/bootstrap.min.js')?>"></script>
   
</body>
</html>