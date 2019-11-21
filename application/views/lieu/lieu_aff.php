<div class="container">
    <h2>Lieu</h2>
    <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-lieu"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>

    <table class="table table-bordered table-striped" id="lieu_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center" hidden>ID</th>
                <th style="text-align:center">Lieux</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if($lieux): ?>
                <?php foreach($lieux as $lieu): ?>
                    <tr id="lieu_id_<?=$lieu->id;?>">
                        <td style="text-align:center" hidden><?= $lieu->id ?></td>
                        <td style="text-align:center"><?= $lieu->name ?></td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-lieu" data-id="<?=$lieu->id?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-lieu" data-id="<?=$lieu->id?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>        
        </tbody>
    </table>
</div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-lieu-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="lieuCrudModal"></h4>
            </div>
            <form id="lieuForm" name="lieuForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                
                    <input type="hidden" name="lieu_id" id="lieu_id">

                    <div class="form-group">
                        <label for="name" class="control-label">Ville : </label>
                        <input type="text" class="form-control" id="nom_lieu" name="nom_lieu" placeholder="Entrer un lieu" value="" required="">
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
        $('#lieu_liste').DataTable();
        
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-lieu').click(function(){
            $('#btn-save').val('create-lieu');
            $('#lieu_id').val('');
            $('#lieuForm').trigger("reset");
            $('#lieuCrudModal').html("Nouveau lieu");
            $('#ajax-lieu-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
       $('body').on('click','#edit-lieu',function(){
           var lieu_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "lieu/get_lieu_by_id",
               data:{
                   lieu_id: lieu_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#nom_lieu-error').hide();
                        $('#nom_visiteur-error').hide();
                        $('#date-error').hide();
                        $('#lieuCrudModal').html('Modifier lieu');
                        $('#btn-save').val('Modifier');
                        $('#ajax-lieu-modal').modal('show');
                        $('#lieu_id').val(res.data.id);
                        $('#nom_lieu').val(res.data.name);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-lieu',function(){
           var lieu_id=$(this).data("id");

           if(confirm("Etes-vous sûre de vouloir supprimer?")){
               $.ajax({
                   type:"Post",
                   url:SITEURL + "lieu/delete",
                   data:{
                    lieu_id:lieu_id
                   },
                   dataType:'json',
                   success:function(data){
                        $('#lieu_id_' + lieu_id).remove();
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

   if($('#lieuForm').length >0){
       $('#lieuForm').validate({
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#lieuForm').serialize();
               $.ajax({
                   url:SITEURL + "lieu/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var lieu='<tr id="lieu_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.name + '</td>'; 
                    lieu+= '<td><a href="javascript:void(0)" id="edit-lieu" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-lieu" data-id="' + res.data.id + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-lieu"){
                        
                       $('#lieu_liste').prepend(lieu);
                    }else{
                       $('#lieu_id_' + res.data.id).replaceWith(lieu);
                    }

                    $('#lieuForm').trigger("reset");
                    $('#ajax-lieu-modal').modal('hide');
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