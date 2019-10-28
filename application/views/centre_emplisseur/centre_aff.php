<div class="container">
    <h2>Centre emplisseur</h2>
    <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-centre"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>

    <table class="table table-bordered table-striped" id="centre_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Date</th>
                <th style="text-align:center">Nom du visiteur</th>
                <th style="text-align:center">Ville</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if($centres): ?>
                <?php foreach($centres as $centre): ?>
                    <tr id="centre_id_<?=$centre->id_centre;?>">
                        <td style="text-align:center"><?= $centre->id_centre ?></td>
                        <td style="text-align:center"><?= $centre->date ?></td>
                        <td style="text-align:center"><?= $centre->nom_visiteur ?></td>
                        <td style="text-align:center"><?= $centre->ville ?></td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-centre" data-id="<?=$centre->id_centre?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-centre" data-id="<?=$centre->id_centre?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>        
        </tbody>
    </table>
</div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-centre-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="centreCrudModal"></h4>
            </div>
            <form id="centreForm" name="centreForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    <input type="hidden" name="centre_id" id="centre_id">

                    <div class="form-group">
                        <label for="name">Date : </label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Entrer la date de visite" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name">Nom du visiteur : </label>
                        <input type="text" class="form-control" id="nom_visiteur" name="nom_visiteur" placeholder="Entrer le nom du visiteur" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name">Ville : </label>
                        <input type="texte" class="form-control" id="ville" name="ville" placeholder="Entrer la ville visité" value="" required="">
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
        $('#centre_liste').DataTable();
        
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-centre').click(function(){
            $('#btn-save').val('create-centre');
            $('#centre_id').val('');
            $('#centreForm').trigger("reset");
            $('#centreCrudModal').html("Nouvelle Centre emplisseur");
            $('#ajax-centre-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
       $('body').on('click','#edit-centre',function(){
           var centre_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "centre_emplisseur/get_centre_by_id",
               data:{
                   centre_id: centre_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#ville-error').hide();
                        $('#nom_visiteur-error').hide();
                        $('#date-error').hide();
                        $('#centreCrudModal').html('Modifier Station service');
                        $('#btn-save').val('Modifier');
                        $('#ajax-centre-modal').modal('show');
                        $('#centre_id').val(res.data.id_centre);
                        $('#date').val(res.data.date);
                        $('#nom_visiteur').val(res.data.nom_visiteur);
                        $('#ville').val(res.data.ville);
                    }
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-centre',function(){
           var centre_id=$(this).data("id");

           if(confirm("Etes-vous sûre de vouloir supprimer?")){
               $.ajax({
                   type:"Post",
                   url:SITEURL + "centre_emplisseur/delete",
                   data:{
                    centre_id:centre_id
                   },
                   dataType:'json',
                   success:function(data){
                        $('#centre_id_' + centre_id).remove();
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

   if($('#centreForm').length >0){
       $('#centreForm').validate({
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#centreForm').serialize();
               $.ajax({
                   url:SITEURL + "centre_emplisseur/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var station='<tr id="centre_id_'+ res.data.id_centre + '"><td>' + res.data.id_centre + '</td><td>' + res.data.date + '</td><td>'+ res.data.nom_visiteur + '</td><td>'+ res.data.ville + '</td>' 
                    station+= '<td><a href="javascript:void(0)" id="edit-centre" data-id="' + res.data.id_centre + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-centre" data-id="' + res.data.id_centre + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-centre"){
                        
                       $('#centre_liste').prepend(station);
                    }else{
                       $('#centre_id_' + res.data.id_centre).replaceWith(station);
                    }

                    $('#centreForm').trigger("reset");
                    $('#ajax-centre-modal').modal('hide');
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