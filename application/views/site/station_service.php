
<div class="container">
    <h2>Station service</h2>
    <br>

    <table class="table table-bordered table-striped" id="centre_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center">Date</th>
                <th style="text-align:center">Station service</th>
                <th style="text-align:center">Gerant</th>
                <th style="text-align:center">Visiteur</th>
                <th style="text-align:center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($result as $response){?>
                <tr>
                    <td style="text-align:center"><?php echo $response->{'date'}?></td>
                    <td style="text-align:center"><?php echo $response->{'name'}?></td>
                    <td style="text-align:center"><?php echo $response->{'full2'}?></td>
                    <td style="text-align:center"><?php echo $response->{'full1'}?></td>
                    <td style="text-align:center">
                        <a href="<?php echo site_url("Questionnaire/questionReseau?idstation=".$response->{'idvisite'})?>" id="edit-centre" class="btn btn-info"> <i class="fa fa-edit"></i> Edit </a>
                    </td>
                </tr>
            <?php }?>    
        </tbody>
    </table>
</div>