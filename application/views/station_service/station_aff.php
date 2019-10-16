<div class="container">
    <h2>Station service</h2>
    <br>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="ajouter-station">Ajouter</a>
    <br><br>
    <table class="table table-bordered table-striped" id="station_liste">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Station service</th>
                <th>Nom du visiteur</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if($stations): ?>
                <?php foreach($stations as $station): ?>
                    <tr id="station_id_<?=$station->id_station;?>">
                        <td><?= $station->id_station ?></td>
                        <td><?= $station->nom_station ?></td>
                        <td><?= $station->nom_visiteur ?></td>
                        <td><?= $station->date ?></td>
                        <td>
                            <a href="javascript:void(0)" id="edit-station" data-id="<?=$station->id_station?>" class="btn btn-info">Modifier</a>
                            <a href="javascript:void(0)" id="delete-station" data-id="<?=$station->id_station?>" class="btn btn-danger delete-user">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>        
        </tbody>
    </table>
</div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-station-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="stationCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="stationForm" name="stationForm" class="form-horizontal">
                    <input type="hidden" name="station_id" id="station_id">

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nom du Station service : </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nom_station" name="nom_station" placeholder="Entrer le nom du station service" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nom du visiteur : </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nom_visiteur" name="nom_visiteur" placeholder="Entrer le nom du visiteur" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Date : </label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="date" name="date" placeholder="Entrer la date de visite" value="" required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-md-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregister les modifications</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
   var SITEURL='<?php echo base_url();?>';
   

   $(document).ready(function(){
        setInterval(function(){
            //$("tbody").load(SITEURL + "station_service/index");  
        },1000);

        $('#station_liste').DataTable();
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-station').click(function(){
            $('#btn-save').val('create-station');
            $('#station_id').val('');
            $('#stationForm').trigger("reset");
            $('#stationCrudModal').html("Nouvelle Station Service");
            $('#ajax-station-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
       $('body').on('click','#edit-station',function(){
           var station_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "station_service/get_station_by_id",
               data:{
                   station_id: station_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#nom_station-error').hide();
                        $('#nom_visiteur-error').hide();
                        $('#date-error').hide();
                        $('#stationCrudModal').html('Modifier Station service');
                        $('#btn-save').val('Modifier');
                        $('#ajax-station-modal').modal('show');
                        $('#station_id').val(res.data.id_station);
                        $('#nom_station').val(res.data.nom_station);
                        $('#nom_visiteur').val(res.data.nom_visiteur);
                        $('#date').val(res.data.date);
                    }
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-station',function(){
           var station_id=$(this).data("id");

           if(confirm("Etes-vous sûre de vouloir supprimer?")){
               $.ajax({
                   type:"Post",
                   url:SITEURL + "station_service/delete",
                   data:{
                    station_id:station_id
                   },
                   dataType:'json',
                   success:function(data){
                        $('#station_id_' + station_id).remove();
                   }, 
                   error:function(data){
                       console.log('error:',data);
                   }
               });
           }
       });
   }); 

   if($('#stationForm').length >0){
       $('#stationForm').validate({
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#stationForm').serialize();
               $.ajax({
                   url:SITEURL + "station_service/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var station='<tr id="station_id_'+ res.data.id_station + '"><td>' + res.data.id_station + '</td><td>' + res.data.nom_station + '</td><td>'+ res.data.nom_visiteur + '</td><td>'+ res.data.date + '</td>' 
                    station+= '<td><a href="javascript:void(0)" id="edit-station" data-id="' + res.data.id_station + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-station" data-id="' + res.data.id_station + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-station"){
                        
                       $('#station_liste').prepend(station);
                    }else{
                       $('#station_id_' + res.data.id_station).replaceWith(station);
                    }

                    $('#stationForm').trigger("reset");
                    $('#ajax-station-modal').modal('hide');
                    $('#btn-save').html('Enregister modification');
                   },

                  error:function(data){
                    console.log('error:',data);
                    $('#btn-save').html('Enregister modification');    
                  }
               });
           }
       })
   }
</script>