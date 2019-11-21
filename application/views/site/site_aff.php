<div class="container">
    <h2>Site</h2>
    <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-site"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>
<<<<<<< HEAD
    <input type="texte" id = "recherche" onChange = "recherche()">
=======

>>>>>>> 51fe62a1aa825fbdd3a197c095fdb74cd1ed89e2
    <table class="table table-bordered table-striped" id="site_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center" hidden>ID</th>
                <th style="text-align:center">Site</th>
                <th style="text-align:center">Chef de site</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if($sites): ?>
                <?php foreach($sites as $site): ?>
<<<<<<< HEAD
                    <tr id="station_id_<?=$site->id;?>">
                        <td style="text-align:center" hidden><?= $site->id ?></td>
                        <td style="text-align:center"><?= $site->name ?></td>
                        <td style="text-align:center"><?= $site->fullname ?></td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-site" data-id="<?=$site->id?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-site" data-id="<?=$site->id?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
=======
                    <tr id="station_id_<?=$site->id_local;?>">
                        <td style="text-align:center" hidden><?= $site->id_local ?></td>
                        <td style="text-align:center"><?= $site->name_local ?></td>
                        <td style="text-align:center"><?= $site->fullname ?></td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-site" data-id="<?=$site->id_local?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-site" data-id="<?=$site->id_local?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
>>>>>>> 51fe62a1aa825fbdd3a197c095fdb74cd1ed89e2
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>        
        </tbody>
    </table>
</div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-site-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="siteCrudModal"></h4>
            </div>
            <form id="siteForm" name="siteForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                
                    <input type="hidden" name="site_id" id="site_id">

                    <div class="form-group">
                        <label for="name" class="control-label">Site : </label>
                        <input type="text" class="form-control" id="nom_site" name="nom_site" placeholder="Entrer le nom du site" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Chef de site : </label>
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
        $('#site_liste').DataTable();
        
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-site').click(function(){
            $('#btn-save').val('create-site');
            $('#site_id').val('');
            $('#siteForm').trigger("reset");
            $('#siteCrudModal').html("Nouveau Site");
            $('#ajax-site-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
       $('body').on('click','#edit-site',function(){
           var site_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "site/get_site_by_id",
               data:{
                   site_id: site_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#nom_site-error').hide();
                        $('#nom_visiteur-error').hide();
                        $('#date-error').hide();
                        $('#siteCrudModal').html('Modifier site');
                        $('#btn-save').val('Modifier');
                        $('#ajax-site-modal').modal('show');
                        $('#site_id').val(res.data.id);
                        $('#nom_site').val(res.data.name);
                        $('#local_manager').val(res.data.local_manager_id);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-site',function(){
           var site_id=$(this).data("id");

           if(confirm("Etes-vous sûre de vouloir supprimer?")){
               $.ajax({
                   type:"Post",
                   url:SITEURL + "site/delete",
                   data:{
                    site_id:site_id
                   },
                   dataType:'json',
                   success:function(data){
                        $('#site_id_' + site_id).remove();
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

   if($('#siteForm').length >0){
       $('#siteForm').validate({
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#siteForm').serialize();
               $.ajax({
                   url:SITEURL + "site/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
<<<<<<< HEAD
                    var site='<tr id="site_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.name + '</td><td>'+ res.data.fullname + '</td><td>'; 
                    site+= '<td><a href="javascript:void(0)" id="edit-site" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-site" data-id="' + res.data.id + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';
=======
                    var site='<tr id="site_id_'+ res.data.id_local + '"><td>' + res.data.id_local + '</td><td>' + res.data.name_local + '</td><td>'+ res.data.fullname + '</td><td>'; 
                    site+= '<td><a href="javascript:void(0)" id="edit-site" data-id="' + res.data.id_local + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-site" data-id="' + res.data.id_local + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';
>>>>>>> 51fe62a1aa825fbdd3a197c095fdb74cd1ed89e2

                    if(actionType =="create-site"){
                        
                       $('#site_liste').prepend(site);
                    }else{
<<<<<<< HEAD
                       $('#site_id_' + res.data.id).replaceWith(site);
=======
                       $('#site_id_' + res.data.id_local).replaceWith(site);
>>>>>>> 51fe62a1aa825fbdd3a197c095fdb74cd1ed89e2
                    }

                    $('#siteForm').trigger("reset");
                    $('#ajax-site-modal').modal('hide');
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
<<<<<<< HEAD

   function recherche(){
    var value = document.getElementById("recherche").value; 
    $.ajax({
               type:"Post",
               url:SITEURL + "site/get_recherche_globale",
               data:{
                   variable: value
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        for(var i =0; i< res.data.length; i++){
                            var response = res.data[i].recherche.split(" ");
                            alert(res.data[i].recherche) 
                            for(var y =0; y < response.length; y++){
                               //alert(response[y]) 
                            }
                          
                        }  
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
   }
=======
>>>>>>> 51fe62a1aa825fbdd3a197c095fdb74cd1ed89e2
</script>