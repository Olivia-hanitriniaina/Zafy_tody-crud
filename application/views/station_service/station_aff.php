<div class="container">
    <h2>Station service</h2>
    <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-station"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>

    <table class="table table-bordered table-striped" id="station_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Station service</th>
                <th style="text-align:center">Gérant</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if($stations): ?>
                <?php foreach($stations as $station): ?>
                    <tr id="station_id_<?=$station->id;?>">
                        <td style="text-align:center"><?= $station->id ?></td>
                        <td style="text-align:center"><?= $station->name ?></td>
                        <td style="text-align:center"><?= $station->fullname ?></td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-station" data-id="<?=$station->id?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-station" data-id="<?=$station->id?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
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
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="stationCrudModal"></h4>
            </div>
            <form id="stationForm" name="stationForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                
                    <input type="hidden" name="station_id" id="station_id">

                    <div class="form-group">
                        <label for="name" class="control-label">Station service : </label>
                        <input type="text" class="form-control" id="nom_station" name="nom_station" placeholder="Entrer le nom du station service" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Gérant : </label>
                        <select name="local_manager" id="local_manager" class='form-control'>
                            <option value="default"></option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user->id ?>"><?= $user->fullname ?></option>
                            <?php endforeach;?>
    
                        </select>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregister les modifications</button>
                    <button class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
   var SITEURL='<?php echo base_url();?>';
   

   $(document).ready(function(){
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
                        $('#station_id').val(res.data.id_local);
                        $('#nom_station').val(res.data.name_local);
                        $('#local_manager').val(res.data.local_manager_id);
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
                        setTimeout(function(){
                            location.reload();
                        },100);
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
                    var station='<tr id="station_id_'+ res.data.id_local + '"><td>' + res.data.id_local + '</td><td>' + res.data.name_local + '</td><td>'+ res.data.fullname + '</td><td>'; 
                    station+= '<td><a href="javascript:void(0)" id="edit-station" data-id="' + res.data.id_local + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-station" data-id="' + res.data.id_local + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-station"){
                        
                       $('#station_liste').prepend(station);
                    }else{
                       $('#station_id_' + res.data.id_local).replaceWith(station);
                    }

                    $('#stationForm').trigger("reset");
                    $('#ajax-station-modal').modal('hide');
                    $('#btn-save').html('Enregister modification');
                    setTimeout(function(){
                        location.reload();
                    },100);
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