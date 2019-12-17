<?php
$objet_filtrer=array();
    foreach ($result as $element) {
        if (!isset($objet_filtrer[$element->idcategorie])) {
            $objet_filtrer[$element->idcategorie]=(object)['label_categorie'=>$element->categorie,"id_Sous_Cat"=>array()
            ] ;        
        }
        if(!isset($objet_filtrer[$element->idcategorie]->id_Sous_Cat[$element->idsouscategorie])){
            $objet_filtrer[$element->idcategorie]->id_Sous_Cat[$element->idsouscategorie]=(object)['label_sous_categorie'=>$element->sous_categorie,'elements'=>array()];
        }
       array_push($objet_filtrer[$element->idcategorie]->id_Sous_Cat[$element->idsouscategorie]->elements,(object)[
           'question'=>$element->label,'reponse'=>$element->reponse,'observations'=>$element->observations
       ]);                    
    };
  
?>

<div class="container main_content">
    <?php foreach ($camions as $camion): ?>
        <div class="en-tete container-fluid" style="background-color:lightgrey">
            <div class="row">
                <div class="col-md-2"> <img src="<?= base_url().'assets/images/logo.png'?>" alt="logo_total"> </div>
                <div class="col-md-8">
                    <h3 style="text-align: center">FICHE DE CONTROLE CAMION N° <?=$camion->immatriculation?> </h3>
                </div>
                <div class="col-md-2"> <p><img src="<?= base_url().'assets/images/safety.png'?>" alt="logo_safety" width="69px"></p> </div>
            </div>
        </div>

        <div class="date-time container-fluid" style="margin-top: 5%">
            <div class="row">
                <div class="col-md-2">
                    <p> <span style="font-weight:bold">Date: </span> <?=$camion->date?> </p> 
                </div>
                <div class="col-md-1"> <p> / </p> </div>
                <div class="col-md-2">
                    <p> <span style="font-weight:bold">Heure: </span> <?=$camion->time?> </p> 
                </div>
            </div>
        </div>

        <div class="point-control container-fluid">
            <h4 style="text-decoration: underline" >POINTS DE CONTROLE:</h4>
            <div class="checkbox">
                <?php if($camion->point_controle == "Chargement"):?>
                    <div class="row">
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" checked="checked" onclick="return false;" >Chargement</label>
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Déchargement</label>
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Trajet</label> 
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Autres :</label>  
                        </div>
                    </div>
                <?php endif;?>
                <?php if($camion->point_controle == "Déchargement"):?>
                    <div class="row">
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Chargement</label>
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" checked="checked" onclick="return false;">Déchargement</label>
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Trajet</label> 
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Autres :</label>  
                        </div>
                    </div>
                <?php endif;?>
                <?php if($camion->point_controle == "Trajet"):?>
                    <div class="row">
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Chargement</label>
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Déchargement </label>
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" checked="checked" onclick="return false;">Trajet</label> 
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Autres :</label>  
                        </div>
                    </div>
                <?php endif;?>
                <?php if($camion->point_controle == "Autre"):?>
                    <div class="row">
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Chargement</label>
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Déchargement </label>
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" disabled>Trajet</label> 
                        </div>
                        <div class="col-md-2">
                            <label for=""><input type="checkbox" checked="checked" onclick="return false;">Autres : <p> <?=$camion->point_controle_autre?> </p></label>  
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>

        <div class="localisation container-fluid" style="margin-top: 2%">
            <h4 style="text-decoration: underline" >LOCALISATION:</h4>
            <div class="row">
                <div class="col-md-4">
                    <p><span style="font-weight: bold">Site / RN-PK :</span><?= $camion->localisation?></p>
                </div>
                <div class="col-md-4"> <span style="font-weight: bold">Lieu: </span></div>
                <div class="col-md-4"> <span style="font-weight: bold">Ville: </span></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p> <span style="font-weight:bold"> Nom / Prénom responsable du site: </span> <?= $camion->chef_site?> </p>
                </div>
            </div>
        </div>

        <div class="camion-citerne container-fluid" style="margin-top: 2%">
            <h4 style="text-decoration: underline" >CAMION CITERNE:</h4>
            <div class="row">
                <div class="col-md-12">
                    <p><span style="font-weight: bold">Chauffeur / Aide :</span> <?=$camion->nom_chauffeur?> / <?=$camion->nom_aide_chauffeur?> </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p> <span style="font-weight: bold">Immatriculation: </span> <?=$camion->immatriculation?> </p>
                </div>
                <div class="col-md-4">
                    <p> <span style="font-weight: bold">Transporteur: </span> <?=$camion->nom_chauffeur?> </p>
                </div>
                <div class="col-md-4">
                    <p> <span style="font-weight: bold">Produit Livré: </span> <?=$camion->produit?> </p>
                </div>
            </div>
        </div>

        <div class="alcoolemie container-fluid" style="margin-top: 2%">
            <h4 style="text-decoration: underline;background-color:yellow" >ALCOOLEMIE:</h4>
            <table class="table table-bordered">
                <thead style="background-color:#E5E4E4 ">
                    <tr>
                        <th></th>
                        <th>Résultat test 1</th>
                        <th>Résultat test 2</th>
                        <th>Signature</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Chauffeur</td>
                        <td>
                            <?php if($camion->chaffeur_test_alcool_1=="-1"):?>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" disabled>Positif </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" checked="checked" onclick="return false;">Négatif </label>
                                    </div>
                                </div>
                                
                            <?php elseif($camion->chaffeur_test_alcool_1=="1") :?> 
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" checked="checked" onclick="return false;">Positif </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" disabled>Négatif </label>
                                    </div>
                                </div>
                                
                            <?php endif;?>    
                        </td>
                        
                        <td>
                            <?php if($camion->chauffeur_test_alcool_2=="-1"):?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" disabled>Positif </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" checked="checked" onclick="return false;">Négatif </label>
                                    </div>
                                </div>
                            <?php elseif($camion->chauffeur_test_alcool_2=="1") :?> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" checked="checked" onclick="return false;">Positif </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" disabled>Négatif </label>
                                    </div>
                                </div>   
                            <?php endif;?>
                        </td>

                        <td><?=$camion->chaffeur_signature?></td>
                    </tr>

                    <tr>
                        <td>Aide </td>
                        <td>
                            <?php if($camion->aide_chaffeur_test_alcool_1=="-1"):?>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" disabled>Positif </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" checked="checked" onclick="return false;">Négatif </label>
                                    </div>
                                </div>
                                
                            <?php elseif($camion->aide_chaffeur_test_alcool_1=="1") :?> 
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" checked="checked" onclick="return false;">Positif </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" disabled>Négatif </label>
                                    </div>
                                </div>
                                
                            <?php endif;?>    
                        </td>
                        
                        <td>
                            <?php if($camion->aide_chaffeur_test_alcool_2=="-1"):?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" disabled>Positif </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" checked="checked" onclick="return false;">Négatif </label>
                                    </div>
                                </div>
                            <?php elseif($camion->aide_chaffeur_test_alcool_2=="1") :?> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" checked="checked" onclick="return false;">Positif </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""><input type="checkbox" disabled>Négatif </label>
                                    </div>
                                </div>   
                            <?php endif;?>
                        </td>

                        <td><?=$camion->aide_chauffeur_signature?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>    
    
    <div class="questionReponse container-fluid" style="margin-top:2%">
        <div class="row">
            <?php foreach($objet_filtrer as $categorie):?>
               <div class="col-md-6">
                    <h4 style="background-color: yellow"><?= $categorie->label_categorie?></h4>
                    <table class="table table-bordered">
                        <thead style="background-color:#E5E4E4 ">
                            <tr>
                                <th>Intitulé</th>
                                <th>Oui</th>
                                <th>Non</th>
                                <th>NA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($categorie->id_Sous_Cat as $sous_cat):?>
                                <?php if(isset($sous_cat->label_sous_categorie)):?>
                                    <tr>
                                        <td style="font-size:1.1em;font-weight:bold;font-style:italic"><?=$sous_cat->label_sous_categorie?></td>
                                        <td colspan="3"></td>
                                    </tr>
                                <?php endif;?>
                               <?php foreach($sous_cat->elements as $elmnt):?>
                                    <tr>
                                        <td><?=$elmnt->question?></td>
                                        <?php if($elmnt->reponse=="1"):?>
                                            <td>&#10062</td>
                                            <td></td>
                                            <td></td> 
                                        <?php endif;?>
                                        <?php if($elmnt->reponse=="0"):?>
                                            <td></td>
                                            <td></td>
                                            <td>&#10061</td> 
                                        <?php endif;?>
                                        <?php if($elmnt->reponse=="-1"):?>
                                            <td></td>
                                            <td>&#10060</td>
                                            <td></td> 
                                        <?php endif;?>
                                    </tr>
                               <?php endforeach;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach;?>       
        </div>
    </div>
    
    <div class="container-fluid observation">
        <table class="table table-bordered">
            <thead style="background-color:#E5E4E4 ">
                <tr>
                    <th style="text-align: center">Observations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center"><?= $camion->observations ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="visa container-fluid">
        <table class="table table-bordered">
            <thead style="background-color:#E5E4E4 ">
                <tr>
                    <th style="text-align: center">Contrôle fait par</th>
                    <th style="text-align: center">Fonction/Société</th>
                    <th style="text-align: center">Visa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- <div class="categorie">
    <h1>$Categorie</h1>
    <pre>
        <?=print_r($categorie)?>
    </pre>
</div>

<div class="sous_categorie">
    <h1>$sous_cat</h1>
    <pre>
        <?=print_r($sous_cat)?>
    </pre>
</div>

<div class="camion">
    <h1>$camion</h1>
    <pre>
        <?= var_dump($camions)?>
    </pre>
</div>

<div class="objet_filtrer">
    <h1>Objet_filtrer</h1>
    <pre>
        <?= var_dump($objet_filtrer)?>
    </pre>
</div>
 -->