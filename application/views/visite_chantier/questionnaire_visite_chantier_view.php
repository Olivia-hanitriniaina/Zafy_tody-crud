<?php
    $objet_filter=array();
    foreach ($result as $element){
        if(!isset($objet_filter[$element->idcategorie])){
            $objet_filter[$element->idcategorie]=(object)['label'=>$element->categorie,'elements'=>array()];
        }
        array_push($objet_filter[$element->idcategorie]->elements,(object)[ 'id'=>$element->id,
                                                                            'question'=>$element->label,
                                                                            'reponse'=>$element->reponse,
                                                                            'observation'=>$element->observations]);
    }
?>

<div class="container main_content">
    <?php foreach($chantiers as $chantier):?>
        <div id="titre">
            <h1 style="text-align: center">VISITE INOPINE CHANTIER - TOTAL MADAGASCAR</h1>
        </div>
        <table class='table table-bordered'>
           <tbody>
               <tr>
                   <td> <span style="font-weight: bold">Site/Lieu:</span> <?=$chantier->Site?></td>
                   <td> <span style="font-weight: bold">Date:</span>  <?= $chantier->date?></td>
               </tr>
               <tr>
                   <td> <span style="font-weight: bold">Nom du chef de chantier:</span> <?= $chantier->nom_chef_chantier_exterieur?></td>
                   <td> <span style="font-weight: bold">Entreprise:</span> <?= $chantier->Entreprise?></td>
               </tr>
               <tr>
                   <td> <span style="font-weight: bold">Nom chef de site:</span>  <?=$chantier->chef_site?></td>
               </tr>
               <tr>
                    <td> <span style="font-weight: bold">Visiteur:</span>  <?=$chantier->visiteur?></td>
               </tr>
           </tbody>
        </table>
    <?php endforeach;?>  
    
    <table class="table table-bordered"> 
        <thead>
            <tr>
                <th></th>
                <th style="text-align: center">C</th>
                <th style="text-align: center">NC</th>
                <th style="text-align: center">NA</th>
                <th style="text-align: center">Observations</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0;?>
            <?php foreach($objet_filter as $categorie): ?>
                <tr>
                    <td style="font-weight:bold;font-size:1.1em;background-color:aquamarine"> <?= $i=$i+1?> * <?= $categorie->label ?></td>
                    <td style="font-weight:bold;font-size:1.1em;background-color:aquamarine"></td>
                    <td style="font-weight:bold;font-size:1.1em;background-color:aquamarine"></td>
                    <td style="font-weight:bold;font-size:1.1em;background-color:aquamarine"></td>
                    <td style="font-weight:bold;font-size:1.1em;background-color:aquamarine"></td>
                </tr>
                <?php foreach($categorie->elements as $element):?>
                    <tr>
                        <td> <?= $element->question ?></td>
                        <?php if($element->reponse==1):?>
                            <td style="text-align: center;font-size:1.2em">&#10062</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center"><?= $element->observation?></td>
                        <?php endif;?>
                        <?php if($element->reponse==-1):?>
                            <td></td>
                            <td style="text-align: center;font-size:1.2em">&#10060</td>
                            <td></td>
                            <td style="text-align: center"><?= $element->observation?></td>
                        <?php endif;?>
                        <?php if($element->reponse==0):?>
                            <td></td>
                            <td></td>
                            <td style="text-align: center;font-size:1.2em">&#10061</td>
                            <td style="text-align: center"><?= $element->observation?></td>
                        <?php endif;?>
                    </tr>
                <?php endforeach;?>    
            <?php endforeach; ?>
        </tbody>   
    </table>
    <table class="table table-bordered">
    <?php foreach($chantiers as $chantier):?>
        <div class="container">
            <div class="row">
                <h4 style="text-align: center;background-color:red">Points sécurité abordés (exemples : Règles d'Or, phases à risques, REX, etc.) </h4>
                <p style="text-align: center"><?= $chantier->point_abordes ?></p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 style="text-align: center;background-color:red">POINT FORTS &#128516</h4>
                    <p style="text-align: center"><?=$chantier->point_forts?></p>
                </div>
                <div class="col-md-6">
                    <h4 style="text-align: center;background-color:red">POINT FAIBLES &#128543</h4>
                    <p style="text-align: center"><?=$chantier->point_faibles?></p>
                </div>
            </div>
            <div class="row">
                <h4 style="text-align: center;background-color:red">Points abordés (exemples : Règles d'Or, phases à risques, REX, etc.)</h4>
                <p style="text-align: center"></p>
            </div>
        </div>
    <?php endforeach;?>    
    </table>
</div>
<!-- <pre>
    <h1>var_dump de $result</h1>
    <?= var_dump($result)?>
</pre>
<pre>
    <h1>var_dump de $chantier</h1>
    <?= var_dump($chantiers)?>
</pre> -->





