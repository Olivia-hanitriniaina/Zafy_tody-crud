<style>
    /** Error message input modal */
    .error{
        color:red;
    }
</style>
<div class="container">
    <h2>Ville</h2>
    <div class="card">
      
      <!-- Paginate -->
      <div id='pagination' style="margin-left:-90%"></div>
      <div class="row">
          <div class="col-md-6"><a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-ville"> <i class="fa fa-plus"></i> Ajouter</a></div>
          <div class="col-md-6" style="margin-left:-20%">
            <div class="form-group row" >
                <div class="col-xs-5">
                <input type="text" name="ville_name" id ="ville_name" class="field-divided form-control input-sm" placeholder="Nom de la ville" />
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
                <th>Villes</th>
                <th>Action</th>
              </tr>
             </thead>
             <tbody></tbody>
           </table>
           
          
      </div>
    </div>

<!--Modal for add & edit ville-->
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
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregister</button>
                    <button class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal for delete ville-->
<div class="modal fade" id="ajax-delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" name="deleteForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    <p id="suppr" style="color:red;font-size:1.5em;text-align:center;font-weight:bold"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="supprimer-ville">Supprimer</button>
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
                url:SITEURL+'/ville/loadRecord/'+pagno,
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
                tr+= "<td> <a class='btn btn-info' id='edit-ville' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-ville' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
                tr += "</tr>";
                $('#postsList tbody').append(tr);
  
            }
        }

        $('body').on('click','#edit-recherche',function(){
            $('#postsList tbody').html('');
            var ville = document.getElementById("ville_name").value;
            if(ville!=''){
                $.ajax({
                    type:"Post",
                    url:SITEURL + "ville/get_rechercher",
                    data:{
                        ville_name : ville,
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
                                tr+= "<td> <a class='btn btn-info' id='edit-ville' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-ville' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
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
                        $('#ville_id').val(res.data.id);
                        $('#nom_ville').val(res.data.nom);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-ville',function(){
           var ville_id=$(this).data("id");
           var ville_name=$(this).data("name");
           $('#ajax-delete-modal').modal('show');
           $('#suppr').html('Voulez-vous supprimer la ville '+'"'+ville_name+'"');
           $('#supprimer-ville').click(function(){
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
           });
       });
   }); 

   if($('#villeForm').length >0){
       $('#villeForm').validate({
            rules:{
                nom_ville:"required",
            },
            messages:{
                nom_ville:{
                    required:"Veuillez remplir le champ par le nom d'une ville",
                },
            },
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
                    var ville='<tr id="ville_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.nom + '</td>'; 
                    ville+= '<td><a href="javascript:void(0)" id="edit-ville" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-ville" data-id="' + res.data.id + '" data-name="'+res.data.nom+'"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-ville"){
                        
                       $('#ville_liste').prepend(ville);
                    }else{
                       $('#ville_id_' + res.data.id).replaceWith(ville);
                    }

                    $('#villeForm').trigger("reset");
                    $('#ajax-ville-modal').modal('hide');
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