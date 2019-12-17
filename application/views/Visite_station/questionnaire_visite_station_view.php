<?php
    $objet_filtrer=array();
    foreach ($result as $element) {
        if (!isset($objet_filtrer[$element->idcategorie])) {
            $objet_filtrer[$element->idcategorie] = (object) ['label' => $element->categorie, 'elements' => array()];
        }
    
        array_push($objet_filtrer[$element->idcategorie]->elements, (object) [
            'id' => $element->id, 'sous_categorie' => $element->sous_categorie, 'question' => $element->label, 
            'reponse' => $element->reponse, 'observations' => $element->observations
        ]);
    };
  
?>
<div class="container main_content">
        <?php foreach($station as $station){ ?>
            <div class="well" style="text-align: center">
            <h1>Tour de sécurité CODIR station service :  <?php echo $station->{'nom'}?></h1>
            </div>
            <ul>
                <li>Date:  <?php echo $station->{'date'}?></li>
                <li>Station service: <?php echo $station->{'nom'}?></li>
                <li>Gérant :  <?php echo $station->{'gerant'}?></li>
                <li>Visiteur:  <?php echo $station->{'visiteur'}?></li>
            </ul>
        <?php }?>
    <table class="table-bordered">
        <thead>
            <tr>
                <th class="numero th"></th>
                <th class="grand_titre th">1-Les incontournables</th>
                <th class="reponse th">OUI</th>
                <th class="reponse th">NON</th>
                <th class="reponse th">NA</th>
                <th class="observation th">Observations</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach($objet_filtrer as $categorie): ?>
                <tr>
                    <td class="titre"></td>
                    <td class="titre"><?= $categorie->label ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php foreach($categorie->elements as $element): ?>
                    <tr>
                        <td class="num"><?=$element->id?></td>
                        <td> <span style="font-weight:bold" <?php if(!isset($element->sous_categorie)){echo 'hidden';}?> ><?=$element->sous_categorie. ':'?></span> <?=$element->question?>
                        </td>
                        <?php if($element->reponse == 0){?>
                            <td style="text-align:center;font-size:1.5em">&#9989;</td>
                            <td></td>
                            <td></td>
                            <td style="text-align:center"><?= $element->observations?></td>
                        <?php }?>
                        <?php if($element->reponse == 1){?>
                            <td></td>
                            <td style="text-align:center;font-size:1.5em">&#9989;</td>
                            <td></td>
                            <td style="text-align:center"><?= $element->observations?></td>
                        <?php }?>
                        <?php if($element->reponse == -1){?>
                            <td></td>
                            <td></td>
                            <td style="text-align:center;font-size:1.5em">&#9989;</td>
                            <td style="text-align:center"><?= $element->observations?></td>
                        <?php }?>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>    
            
        </tbody>
    </table>
</div>
