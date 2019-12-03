<div class="container">
    <h2>Site</h2>
    <div class="card">
      
      <!-- Paginate -->
      <div id='pagination' style="margin-left:-90%"></div>
      <div class="row">
          <div class="col-md-6"><a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-site"> <i class="fa fa-plus"></i> Ajouter</a></div>
          <div class="col-md-6" style="margin-left:-20%">
            <div class="form-group row" >
                <div class="col-xs-5">
                <input type="text" name="site_name" id ="site_name" class="field-divided form-control input-sm" placeholder="Nom du site" />
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
                <th>Sites</th>
                <th>Gérant</th>
                <th>Action</th>
              </tr>
             </thead>
             <tbody></tbody>
           </table>
           
          
      </div>
    </div>

   <!--  <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-site"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>

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
                    <tr id="station_id_<?=$site->id_local;?>">
                        <td style="text-align:center" hidden><?= $site->id_local ?></td>
                        <td style="text-align:center"><?= $site->name_local ?></td>
                        <td style="text-align:center"><?= $site->fullname ?></td>
                        <td style="text-align:center">
                            <a href="javascript:void(0)" id="edit-site" data-id="<?=$site->id_local?>" class="btn btn-info"> <i class="fa fa-edit"></i> Modifier</a>
                            <a href="javascript:void(0)" id="delete-site" data-id="<?=$site->id_local?>" class="btn btn-danger delete-user"> <i class="fa fa-trash"></i> Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>        
        </tbody>
    </table>
</div> -->

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
                                <option value="<?= $user->id ?>"><?= $user->nom_complet ?></option>
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

<!--Modal for delete station-->
<div class="modal fade" id="ajax-delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" name="deleteForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    <p id="suppr" style="color:red;font-size:1.5em;text-align:center;font-weight:bold"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="supprimer-site">Supprimer</button>
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
         url:SITEURL+'/site/loadRecord/'+pagno,
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
          tr+= "<td> <a class='btn btn-info' id='edit-site' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-site' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
          tr += "</tr>";
          $('#postsList tbody').append(tr);
  
        }
      }

      $('body').on('click','#edit-recherche',function(){
            $('#postsList tbody').html('');
            var site = document.getElementById("site_name").value;
            var gerante = document.getElementById("gerant_name").value;
          if(site!='' || gerante!=''){
            $.ajax({
                    type:"Post",
                    url:SITEURL + "site/get_rechercher",
                    data:{
                        site_name : site,
                        gerant_name : gerante,
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
                            tr+= "<td> <a class='btn btn-info' id='edit-site' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-site' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
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
                        $('#nom_site').val(res.data.nom);
                        $('#local_manager').val(res.data.responsable_id);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-site',function(){
           var site_id=$(this).data("id");
           var site_name=$(this).data("name"); 
           $('#ajax-delete-modal').modal('show');
           $('#suppr').html('Voulez-vous supprimer le site '+'"'+site_name+'"');
           $('#supprimer-site').click(function(){
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
           });           
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
                    var site='<tr id="site_id_'+ res.data.id_local + '"><td>' + res.data.id + '</td><td>' + res.data.nom + '</td><td>'+ res.data.nom_complet + '</td><td>'; 
                    site+= '<td><a href="javascript:void(0)" id="edit-site" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-site" data-id="' + res.data.id + '" data-name="'+res.data.nom+'" class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-site"){
                        
                       $('#site_liste').prepend(site);
                    }else{
                       $('#site_id_' + res.data.id).replaceWith(site);
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
</script>