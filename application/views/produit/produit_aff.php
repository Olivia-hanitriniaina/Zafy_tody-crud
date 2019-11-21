<div class="container">
    <h2>Produit</h2>
    <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-produit"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>

    <table class="table table-bordered table-striped" id="produit_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center" hidden>ID</th>
                <th style="text-align:center">Produits</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if($produits): ?>
                <?php foreach($produits as $produit): ?>
                    <tr id="produit_id_<?=$produit->id;?>">
                        <td style="text-align:center" hidden><?= $produit->id ?></td>
                        <td style="text-align:center"><?= $produit->name ?></td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-produit" data-id="<?=$produit->id?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-produit" data-id="<?=$produit->id?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>        
        </tbody>
    </table>
</div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-produit-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="produitCrudModal"></h4>
            </div>
            <form id="produitForm" name="produitForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                
                    <input type="hidden" name="produit_id" id="produit_id">

                    <div class="form-group">
                        <label for="name" class="control-label">Produit : </label>
                        <input type="text" class="form-control" id="nom_produit" name="nom_produit" placeholder="Entrer le nom du produit" value="" required="">
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
        $('#produit_liste').DataTable();
        
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-produit').click(function(){
            $('#btn-save').val('create-produit');
            $('#produit_id').val('');
            $('#produitForm').trigger("reset");
            $('#produitCrudModal').html("Nouveau produit");
            $('#ajax-produit-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
       $('body').on('click','#edit-produit',function(){
           var produit_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "produit/get_produit_by_id",
               data:{
                   produit_id: produit_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#nom_produit-error').hide();
                        $('#produitCrudModal').html('Modifier le produit');
                        $('#btn-save').val('Modifier');
                        $('#ajax-produit-modal').modal('show');
                        $('#produit_id').val(res.data.id);
                        $('#nom_produit').val(res.data.name);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-produit',function(){
           var produit_id=$(this).data("id");

           if(confirm("Etes-vous sûre de vouloir supprimer?")){
               $.ajax({
                   type:"Post",
                   url:SITEURL + "produit/delete",
                   data:{
                    produit_id:produit_id
                   },
                   dataType:'json',
                   success:function(data){
                        $('#produit_id_' + produit_id).remove();
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

   if($('#produitForm').length >0){
       $('#produitForm').validate({
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#produitForm').serialize();
               $.ajax({
                   url:SITEURL + "produit/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var produit='<tr id="produit_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.name + '</td>'; 
                    produit+= '<td><a href="javascript:void(0)" id="edit-produit" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-produit" data-id="' + res.data.id + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-produit"){
                        
                       $('#produit_liste').prepend(produit);
                    }else{
                       $('#produit_id_' + res.data.id).replaceWith(produit);
                    }

                    $('#produitForm').trigger("reset");
                    $('#ajax-produit-modal').modal('hide');
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