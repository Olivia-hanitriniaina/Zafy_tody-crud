<style>
    /** Error message input modal */
    .error{
        color:red;
    }
</style>
<div class="container">
    <h2>Centre emplisseur</h2>
    <div class="card">
      
      <!-- Paginate -->
      <div id='pagination' style="margin-left:-90%"></div>
      <div class="row">
          <div class="col-md-6"><a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-centre"> <i class="fa fa-plus"></i> Ajouter</a></div>
          <div class="col-md-6" style="margin-left:-20%">
            <div class="form-group row" >
                <div class="col-xs-5">
                <input type="text" name="centre_name" id ="centre_name" class="field-divided form-control input-sm" placeholder="Nom du centre emplisseur" />
                </div>
                <div class="col-xs-5">
                <input type="text" name="gerant_name" id = "gerant_name" class="field-divided form-control input-sm" placeholder="Nom du gérant" />
                </div>
                <div class="col-xs-2">
                <a href = "javascript:void(0)" id="edit-recherche" value="" class='btn btn-warning'>Rechercher</a>
                </div>
            </div>
                
          </div>
      </div>
      
      <div>
           <!-- Posts List -->
           <table class="table table-borderd" id='postsList'style='width:80%'>
             <thead>
              <tr>
                <!--<th>ID</th>-->
                <th>Centre emplisseur</th>
                <th>Gérant</th>
                <th>Action</th>
              </tr>
             </thead>
             <tbody></tbody>
           </table>
           
          
      </div>
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
                        <label for="name" class="control-label">Centre emplisseur : </label>
                        <input type="text" class="form-control" id="nom_centre" name="nom_centre" placeholder="Entrer le nom du centre emplisseur" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Gérant : </label>
                        <select name="local_manager" id="local_manager" class='form-control'>
                            <option></option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user->id ?>"><?= $user->nom_complet ?></option>
                            <?php endforeach;?>
    
                        </select>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregister</button>
                    <button class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal for delete centre-->
<div class="modal fade" id="ajax-delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" name="deleteForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    <p id="suppr" style="color:red;font-size:1.5em;text-align:center;font-weight:bold"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="supprimer-centre">Supprimer</button>
                    <button class="btn btn-defaut" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
   var SITEURL='<?php echo base_url();?>';
   

   $(document).ready(function(){
    $('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pagination-page');
       loadPagination(pageno);
     });
 
     loadPagination(0);
 
     function loadPagination(pagno){
       $.ajax({
         url:SITEURL+'/centre_emplisseur/loadRecord/'+pagno,
         type: 'get',
         dataType: 'json',
         success: function(response){
            $('#pagination').html(response.pagination);
            createTable(response.result,response.row);
         }
       });
     }
     createTable();
     function createTable(result,sno){
       sno = Number(sno);
       $('#postsList tbody').empty();
       for(index in result){
          var id = result[index].id;
          var name = result[index].nom;
          var fullname = result[index].nom_complet;
    
          sno+=1;

    
 
          var tr = "<tr>";
          //tr += "<td>"+ sno +"</td>";
          tr += "<td>"+ name +"</td>";
          tr += "<td>"+ fullname +"</td>";
          tr+= "<td> <a class='btn btn-info' id='edit-centre' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-centre' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
          tr += "</tr>";
          $('#postsList tbody').append(tr);
  
        }
      }

      $('body').on('click','#edit-recherche',function(){
            $('#postsList tbody').html('');
            var centre = document.getElementById("centre_name").value;
            var gerante = document.getElementById("gerant_name").value;
          if(centre!='' || gerante!=''){
            $.ajax({
                    type:"Post",
                    url:SITEURL + "centre_emplisseur/get_rechercher",
                    data:{
                        centre : centre,
                        gerante : gerante,
                    },
                    dataType: "json",
               success: function (res){
                   console.log("ato");
                    if(res.success == true){
                        
                        for($i = 0; $i<res.data.length; $i++){
                            var id=res.data[$i]['id'];
                            var name=res.data[$i]['nom'];
                            var tr = "<tr>";
                            //tr += "<td>"+ res.data[$i]['id'] +"</td>";
                            tr += "<td>"+ res.data[$i]['nom'] +"</td>";
                            tr += "<td>"+ res.data[$i]['nom_complet'] +"</td>";
                            tr+= "<td> <a class='btn btn-info' id='edit-centre' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-centre' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
                            tr += "</tr>";
                            $('#postsList tbody').append(tr);
                    }
               }
                if(res.success == false){
                    $('#postsList tbody').html('Aucun enregistrements correspondants trouvés');
                }
               },
               error:function(data){
                   console.log('error',data);
               }
           });
          }else{
            loadPagination(0)
          }
        });
        
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-centre').click(function(){
            $('#btn-save').val('create-centre');
            $('#centre_id').val('');
            $('#centreForm').trigger("reset");
            $('#centreCrudModal').html("Nouvelle centre emplisseur");
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
                        $('#nom_centre-error').hide();
                        $('#nom_visiteur-error').hide();
                        $('#date-error').hide();
                        $('#centreCrudModal').html('Modifier Centre emplisseur');
                        $('#btn-save').val('Modifier');
                        $('#ajax-centre-modal').modal('show');
                        $('#centre_id').val(res.data.id);
                        $('#nom_centre').val(res.data.nom);
                        $('#local_manager').val(res.data.responsable_id);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-centre',function(){
           var centre_id=$(this).data("id");
           var centre_name=$(this).data("name");
           $('#ajax-delete-modal').modal('show');
           $('#suppr').html('Voulez-vous supprimer le centre emplisseur '+'"'+centre_name+'"');
           $('#supprimer-centre').click(function(){
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
            });
       });
   }); 

   if($('#centreForm').length >0){
       $('#centreForm').validate({
            rules:{
                nom_centre:"required",
                local_manager:"required"
            },
            messages:{
                nom_centre:{
                    required:"Veuillez remplir le champ par le nom d'un centre emplisseur",
                },
                local_manager:{
                    required:"Veuillez selectionner un Gérant",
                }
            },
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
                    var centre='<tr id="centre_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.nom + '</td><td>'+ res.data.nom_complet + '</td><td>'; 
                    centre+= '<td><a href="javascript:void(0)" id="edit-centre" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-centre" data-id="' + res.data.id + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-centre"){
                        
                       $('#centre_liste').prepend(centre);
                    }else{
                       $('#centre_id_' + res.data.id).replaceWith(centre);
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