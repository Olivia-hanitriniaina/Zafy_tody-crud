<div class="container">
    <h2>Ville</h2>
    <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-ville"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>

    <table class="table table-bordered table-striped" id="ville_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center" hidden>ID</th>
                <th style="text-align:center">Villes</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if($villes): ?>
                <?php foreach($villes as $ville): ?>
                    <tr id="station_id_<?=$ville->id_local;?>">
                        <td style="text-align:center" hidden><?= $ville->id_local ?></td>
                        <td style="text-align:center"><?= $ville->name_local ?></td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-ville" data-id="<?=$ville->id_local?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-ville" data-id="<?=$ville->id_local?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>        
        </tbody>
    </table>
</div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-ville-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="villeCrudModal"></h4>
            </div>
            <form id="villeForm" name="villeForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                
                    <input type="hidden" name="ville_id" id="ville_id">

                    <div class="form-group">
                        <label for="name" class="control-label">Ville : </label>
                        <input type="text" class="form-control" id="nom_ville" name="nom_ville" placeholder="Entrer le nom de la ville" value="" required="">
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
        $('#ville_liste').DataTable();
        
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-ville').click(function(){
            $('#btn-save').val('create-ville');
            $('#ville_id').val('');
            $('#villeForm').trigger("reset");
            $('#villeCrudModal').html("Nouvelle ville");
            $('#ajax-ville-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
       $('body').on('click','#edit-ville',function(){
           var ville_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "ville/get_ville_by_id",
               data:{
                   ville_id: ville_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#nom_ville-error').hide();
                        $('#nom_visiteur-error').hide();
                        $('#date-error').hide();
                        $('#villeCrudModal').html('Modifier ville');
                        $('#btn-save').val('Modifier');
                        $('#ajax-ville-modal').modal('show');
                        $('#ville_id').val(res.data.id_local);
                        $('#nom_ville').val(res.data.name_local);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-ville',function(){
           var ville_id=$(this).data("id");

           if(confirm("Etes-vous sûre de vouloir supprimer?")){
               $.ajax({
                   type:"Post",
                   url:SITEURL + "ville/delete",
                   data:{
                    ville_id:ville_id
                   },
                   dataType:'json',
                   success:function(data){
                        $('#ville_id_' + ville_id).remove();
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

   if($('#villeForm').length >0){
       $('#villeForm').validate({
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#villeForm').serialize();
               $.ajax({
                   url:SITEURL + "ville/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var ville='<tr id="ville_id_'+ res.data.id_local + '"><td>' + res.data.id_local + '</td><td>' + res.data.name_local + '</td>'; 
                    ville+= '<td><a href="javascript:void(0)" id="edit-ville" data-id="' + res.data.id_local + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-ville" data-id="' + res.data.id_local + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-ville"){
                        
                       $('#ville_liste').prepend(ville);
                    }else{
                       $('#ville_id_' + res.data.id_local).replaceWith(ville);
                    }

                    $('#villeForm').trigger("reset");
                    $('#ajax-ville-modal').modal('hide');
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