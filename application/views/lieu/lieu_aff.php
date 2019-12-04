<style>
    /** Error message input modal */
    .error{
        color:red;
    }
</style>

<div class="container">
    <h2>Lieu</h2>
    <div class="card">
      
      <!-- Paginate -->
      <div id='pagination' style="margin-left:-90%"></div>
      <div class="row">
          <div class="col-md-6"><a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-lieu"> <i class="fa fa-plus"></i> Ajouter</a></div>
          <div class="col-md-6" style="margin-left:-20%">
            <div class="form-group row" >
                <div class="col-xs-5">
                <input type="text" name="lieu_name" id ="lieu_name" class="field-divided form-control input-sm" placeholder="Rechercher le lieu..." />
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
                <th>Lieux</th>
                <th>Action</th>
              </tr>
             </thead>
             <tbody></tbody>
           </table>
           
          
      </div>
    </div>


    
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

<!--Modal for delete lieu-->
<div class="modal fade" id="ajax-delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" name="deleteForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    <p id="suppr" style="color:red;font-size:1.5em;text-align:center;font-weight:bold"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="supprimer-lieu">Supprimer</button>
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
                url:SITEURL+'/lieu/loadRecord/'+pagno,
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
               
                sno+=1;

                var tr = "<tr>";
                //tr += "<td>"+ sno +"</td>";
                tr += "<td>"+ name +"</td>";
                tr+= "<td> <a class='btn btn-info' id='edit-lieu' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-lieu' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
                tr += "</tr>";
                $('#postsList tbody').append(tr);
  
            }
        }

        $('body').on('click','#edit-recherche',function(){
            $('#postsList tbody').html('');
            var lieu = document.getElementById("lieu_name").value;
            if(lieu!=''){
                $.ajax({
                    type:"Post",
                    url:SITEURL + "lieu/get_rechercher",
                    data:{
                        lieu_name : lieu,
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
                                tr+= "<td> <a class='btn btn-info' id='edit-lieu' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-lieu' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
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
                        $('#nom_lieu').val(res.data.nom);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-lieu',function(){
           var lieu_id=$(this).data("id");
           var lieu_name=$(this).data("name");
           $('#ajax-delete-modal').modal('show');
           $('#suppr').html('Voulez-vous supprimer le lieu '+'"'+lieu_name+'"');

           $('#supprimer-lieu').click(function(){
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
           });  
       });
   }); 

   if($('#lieuForm').length >0){
       $('#lieuForm').validate({
             rules:{
                nom_lieu:"required",
            },
            messages:{
                nom_lieu:{
                    required:"Veuillez remplir le champ par un lieu",
                },
            },
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
                    var lieu='<tr id="lieu_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.nom + '</td>'; 
                    lieu+= '<td><a href="javascript:void(0)" id="edit-lieu" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-lieu" data-id="' + res.data.id + 'data-name="' +res.data.nom +'"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-lieu"){
                        
                       $('#lieu_liste').prepend(lieu);
                    }else{
                       $('#lieu_id_' + res.data.id).replaceWith(lieu);
                    }

                    $('#lieuForm').trigger("reset");
                    $('#ajax-lieu-modal').modal('hide');
                    $('#btn-save').html('Enregister');
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