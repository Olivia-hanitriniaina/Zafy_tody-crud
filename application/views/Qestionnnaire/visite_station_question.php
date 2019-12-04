<?php
    $objet_filtrer=array();
    foreach ($result as $element) {
        if (!isset($objet_filtrer[$element->idCategorie])) {
            $objet_filtrer[$element->idCategorie] = (object) ['label' => $element->categorie, 'elements' => array()];
        }
    
        array_push($objet_filtrer[$element->idCategorie]->elements, (object) [
            'id' => $element->id, 'subcategorie' => $element->sous_categorie, 'question' => $element->question
        ]);
    };
  
?>
<div class="container">
<?php foreach($station_id as $station){ ?>
    <div class="well" style="text-align: center">
    <h1>Tour de sécurité CODIR station service :  <?php echo $station->{'nomstation'}?></h1>
    </div>
    <ul>
        <li>Date:  <?php echo $station->{'datevisiteur'}?>:<?php echo $station->{'timevisiteur'}?></li>
        <li>Station service: <?php echo $station->{'nomstation'}?></li>
        <li>Gérant :  <?php echo $station->{'nomgerant'}?></li>
        <li>Visiteur:  <?php echo $station->{'nomvisiteur'}?></li>
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
                        <td> <span style="font-weight:bold" <?php if(!isset($element->subcategorie)){echo 'hidden';}?> ><?=$element->subcategorie. ':'?></span> <?=$element->question?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>    
            
        </tbody>
    </table>
</div>