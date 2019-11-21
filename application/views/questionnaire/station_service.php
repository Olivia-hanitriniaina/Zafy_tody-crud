<br>
<br>
<div class="container">
    <?php foreach ($result as $res) {?>
    <div class="well" style="text-align: center">
        <h1>Tour de sécurité CODIR : <?php echo $res->{'name'}?>  </h1>
    </div>
    
    <ul>
        <li>Date : <?php echo $res->{'date'}?></li>
        <li>Station service : <?php echo $res->{'name'}?></li>
        <li>Gérant : <?php echo $res->{'full2'}?></li>
        <li>Visiteur : <?php echo $res->{'full1'}?></li>
    </ul>
    <?php }?>
    <table class="table-bordered">
        <thead>
            <tr>
                <th class="numero"></th>
                <th class="grand_titre">1-Les incontournables</th>
                <th class="reponse">OUI</th>
                <th class="reponse">NON</th>
                <th class="reponse">NA</th>
                <th class="observation">Observations</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($response as $r) {?>
            <tr>
                <td class="titre"></td>
                <td class="titre"><?php echo $r->{'labelcat'}?></td>
            </tr>
            <tr>
                <td class="num"><?php echo $r->{'id1'}?></td>
               <td> <span style="font-weight:bold"> <?php echo $r->{'label2'}?>:</span><br><?php echo $r->{'label3'}?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php }?>
        </tbody>
       
    </table>
</div>