<style>
    .zoom:hover {
        transform: scale(1.06);
        padding: auto;
    } 
   
    #menu_acceuil{
        width: 100%;
        height:100%;
        padding: auto;
        padding-bottom: 20px;
    }
</style>
<div class="container main_content" id="page_accueil">
    <div class="row" id="menu_acceuil">
        <div class="col-sm-3 zoom">
            <a href="<?= base_url("Visite_station")?>" style="text-decoration:none;">
                <div class="card">
                    <img src="<?= base_url()."assets/images/reseau.png"?>" alt="station service" style="width:100%">
                </div>
            </a>
        </div>
       
        <div class="col-sm-3 zoom">
            <a href="<?= base_url("Visite_depot")?>" style="text-decoration:none;">
                <div class="card">
                    <img src="<?= base_url()."assets/images/depot.png"?>" alt="depot_aviation" style="width:100%">
                </div>
            </a>
        </div>
       
        <div class="col-sm-3 zoom">
            <a href="<?= base_url("Visite_emplisseur")?>" style="text-decoration:none;">
                <div class="card">
                    <img src="<?= base_url()."assets/images/gpl.png"?>" alt="centre_emplisseur" style="width:100%">
                </div>
            </a>
        </div>
       
        <div class="col-sm-3 zoom">
            <a href="<?= base_url("Visite_control_camion")?>" style="text-decoration:none;">
                <div class="card">
                    <img src="<?= base_url()."assets/images/fichecontrole.png"?>" alt="controle_camion" style="width:100%">
                </div>
            </a>
        </div>



        <div class="col-sm-3 zoom">
            <a href="<?= base_url("Visite_chantier")?>" style="text-decoration:none;">
            <div class="card">
                <img src="<?= base_url()."assets/images/chantier.png"?>" alt="hse_chantier" style="width:100%">
            </div>
        </div>

        <div class="col-sm-3 zoom">
            <a href="<?= base_url("Visite_bouteilles")?>" style="text-decoration:none;">
            <div class="card">
                <img src="<?= base_url()."assets/images/bouteille.png"?>" alt="stl_bouteille" style="width:100%">
            </div>
        </div>

        <div class="col-sm-3 zoom">
            <a href="<?= base_url("/accueil/HSE_chantier")?>" style="text-decoration:none;">
            <div class="card">
                <img src="<?= base_url()."assets/images/stl.png"?>" alt="stl_camion" style="width:100%">
            </div>
        </div>
    </div>
</div>
