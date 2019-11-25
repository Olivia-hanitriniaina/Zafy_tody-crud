<div class="container">
    <h2>Dépôt aviation</h2>
    <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-depot"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>
    <table class="table table-bordered table-striped" id="depot_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Depôt aviation</th>
                <th style="text-align:center">Gérant </th>
                <th style="text-align:center">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if($depots): ?>
                <?php foreach($depots as $depot): ?>
                    <tr id="depot_id_<?=$depot->id;?>">
                        <td style="text-align:center"><?= $depot->id_local ?></td>
                        <td style="text-align:center"><?= $depot->name_local ?></td>
                        <td style="text-align:center"><?= $depot->fullname ?></td>
                        
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-depot" data-id="<?=$depot->id_local?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-depot" data-id="<?=$depot->id_local?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>        
        </tbody>
    </table>
</div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-depot-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="depotCrudModal"></h4>
            </div>
            <form id="depotForm" name="depotForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    <input type="hidden" name="depot_id" id="depot_id">

                    <div class="form-group">
                        <label for="name">Dépôt aviation : </label>
                        <input type="text" class="form-control" id="depot_aviation" name="depot_aviation" placeholder="Dépôt aviation" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name">Gérant : </label>
                        <select name="local_manager" id="local_manager" class="form-control">
                            <option value="default"></option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user->id ?>"> <?= $user->fullname?> </option>
                            <?php endforeach; ?>    
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregister les modifications</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
   var SITEURL='<?php echo base_url();?>';
   

   $(document).ready(function(){
        $('#depot_liste').DataTable();
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-depot').click(function(){
            $('#btn-save').val('create-depot');
            $('#depot_id').val('');
            $('#depotForm').trigger("reset");
            $('#depotCrudModal').html("Nouvelle dépôt aviation");
            $('#ajax-depot-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
       $('body').on('click','#edit-depot',function(){
           var depot_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "depot_aviation/get_depot_by_id",
               data:{
                   depot_id: depot_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#depotCrudModal').html('Modifier Dépôt aviation');
                        $('#btn-save').val('Modifier');
                        $('#ajax-depot-modal').modal('show');
                        $('#depot_id').val(res.data.id_local);
                        $('#depot_aviation').val(res.data.name_local);
                        $('#local_manager').val(res.data.local_manager_id);                        
                    }
                    alert( $('#depot_aviation').val(res.data.name_local));
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-depot',function(){
           var depot_id=$(this).data("id");

           if(confirm("Etes-vous sûre de vouloir supprimer?")){
               $.ajax({
                   type:"Post",
                   url:SITEURL + "depot_aviation/delete",
                   data:{
                    depot_id:depot_id
                   },
                   dataType:'json',
                   success:function(data){
                        $('#depot_id_' + depot_id).remove();
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

   if($('#depotForm').length >0){
       $('#depotForm').validate({
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#depotForm').serialize();
               $.ajax({
                   url:SITEURL + "depot_aviation/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var depot='<tr id="depot_id_'+ res.data.id_local + '"><td>' + res.data.id_local + '</td><td>'+res.data.name_local+'</td><td>' + res.data.fullname + '</td><td>';
                    depot+= '<td><a href="javascript:void(0)" id="edit-depot" data-id="' + res.data.id_local + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-depot" data-id="' + res.data.id_local + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-depot"){
                        
                       $('#depot_liste').prepend(depot);
                    }else{
                       $('#depot_id_' + res.data.id_local).replaceWith(depot);
                    }

                    $('#depotForm').trigger("reset");
                    $('#ajax-depot-modal').modal('hide');
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