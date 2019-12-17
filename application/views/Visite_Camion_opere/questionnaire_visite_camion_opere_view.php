<?php
    $objet_filtrer=array();
    foreach ($result as $element) {
        if (!isset($objet_filtrer[$element->idcategorie])) {
            $objet_filtrer[$element->idcategorie] = (object) ['label' => $element->categorie, 'elements' => array()];
        }
    
        array_push($objet_filtrer[$element->idcategorie]->elements, (object) [
            'id' => $element->id, 'point_bloquant' => $element->point_bloquant, 'question' => $element->label, 
            'reponse' => $element->reponse, 'observations' => $element->observations
        ]);
    };
  
?>
<div class="container">
    <div class="well" style="text-align: center">
    <h1>VISITE INOPINE CHANTIER-TOTAL MADAGASCAR </h1>
    </div>

    <table class="table-striped"">
    <?php foreach($station as $bouteilles){?>
        <tbody>
            <tr>
                <td>Nom de l'inspecteur : <?php echo $bouteilles->{'visiteur'}           ?></td>
                <td></td>
                <td style = "margin-left : 10px">Lieu de contrôle : <?php echo $bouteilles->{'localisation'}?>     </td>
            </tr>
            <tr>
               <td>Date : <?php echo $bouteilles->{'date'}?></td>
               <td>Heure : <?php echo $bouteilles->{'heure'}?>     </td>
               <td>Produit : <?php echo $bouteilles->{'product'}?>      </td>
            </tr>
            <tr>
                <td>Transporteur : <?php echo $bouteilles->{'nom_trasporteur'}?></td>
                <td></td>
                <td>Nom du conducteur : <?php echo $bouteilles->{'nom_conducteur'}?></td>
            </tr>
            <tr>
                <td>Immatriculation Tracteur/porteur : <?php echo $bouteilles->{'immatriculation_tracteur'}?></td>
                <td></td>
                <td>Kilométrage tracteur : <?php echo $bouteilles->{'kilometrage_tracteur'}?></td>
            </tr>
            <tr>
                <td>Immatriculation semi-remorque : <?php echo $bouteilles->{'immatriculation_semi_remorque'}?></td>
            </tr>
        </tbody>
    <?php }?>
    </table>
<br>
<?php foreach($objet_filtrer as $categorie): ?>
    <table class="table-bordered">
        <thead>
      
            <tr style="color:white;background-color:blue">
                <th></th>
                <th class="grand_titre" style="text-align:center"><?= $categorie->label ?></th>
                <th class="reponse" style="text-align:center">Points bloquants</th>
                <th class="reponse" style="text-align:center">Contrôle</th>
            </tr>
        </thead>
        
        <tbody>
        <?php foreach($categorie->elements as $element): ?>
            <tr>
            <td><?=$element->id?></td>
                <td><?=$element->question?></td>
                <?php if($element->point_bloquant == 0){?>
                <td style="text-align:center">O</td>
                <?php }?>
                <?php if($element->point_bloquant == 1){?>
                <td style="text-align:center">N</td>
                <?php }?>
                <?php if($element->reponse == 0){?>
                <td style="text-align:center">&#10004;</td>
                 <?php }?>
                <?php if($element->reponse == 1){?>
                    <td style="text-align:center">&#10006;</td>
                <?php }?>
            </tr>
            <?php endforeach; ?>  
        </tbody>
    </table>  
  
    <?php endforeach; ?>   

    <div class="accepter">
        <h4>Véhicule Accepté</h4>
        <div class="radio">
            <label><input type="radio">Oui</label>
            <label><input type="radio">Non</label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h4 style="text-align:center">Visa inspecteur</h4>
        </div>
        <div class="col-md-6">
            <h4 style="text-align:center">Visa conducteur</h4>
        </div>
        <div class="texte">
            <p>Points bloquants : Oui ou Non</p>
            <p><span style="font-weight:bold">N*: </span> Ce point est bloquant dans le cas où la protection des feux est fortement endommagée.</p>
            <p><span style="font-weight:bold">N**: </span> Ce point est bloquant uniquement pour les camions devant etre équipés d'un coupe batterie (obligation en fonction de la nature des produits transportés et des conditions de chargement).</p>
            <p><span style="font-weight:bold">N***: </span>Ce point est bloquant uniquement si la citerne n'est pas correctement gazée.</p>
        </div>
    </div>

</div>