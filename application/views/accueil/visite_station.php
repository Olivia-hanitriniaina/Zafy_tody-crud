
<?php
    $objet_filtrer=array();
    foreach ($question as $element) {
        if (!isset($objet_filtrer[$element->categorie])) {
            $objet_filtrer[$element->categorie] = (object) ['label' => $element->categorie, 'elements' => array()];
        }
    
        array_push($objet_filtrer[$element->categorie]->elements, (object) [
            'id' => $element->id, 'subcategorie' => $element->sous_categorie, 'question' => $element->question
        ]);
    };
?>
<div class="container">
<div class="well" style="text-align: center">
        <h1>TOUR SECURITE CODIR STATION SERVICE </h1>
    </div>
    <?php foreach($station_id as $station ){?>
    <ul>
        <li>Date : <?php echo $station->{'datevisiteur'}?> : <?php echo $station->{'timevisiteur'}?></li>
        <li>Station service : <?php echo $station->{'nomstation'}?></li>
        <li>Gérant : <?php echo $station->{'nomgerant'}?></li>
        <li>Visiteur : <?php echo $station->{'nomvisiteur'}?></li>
    </ul>
    <?php }?>
</nav>
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
