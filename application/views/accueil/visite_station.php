
<?php
    $objet_filtrer=array();
    foreach ($result as $element) {
        if (!isset($objet_filtrer[$element->categorie_id])) {
            $objet_filtrer[$element->categorie_id] = (object) ['label' => $element->label_categorie, 'elements' => array()];
        }
    
        array_push($objet_filtrer[$element->categorie_id]->elements, (object) [
            'id' => $element->id_question, 'subcategorie' => $element->label_subcategorie, 'question' => $element->label_question
        ]);
    };
    
    /* foreach ($objet_filtrer as $categorie) {
        echo $categorie->label . "\n";
        foreach ($categorie->elements as $element) {
            echo $element->id . ': ' . $element->subcategorie . ' => ' . $element->question . "\n";
        }
    } */
?>
<div class="container">
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
