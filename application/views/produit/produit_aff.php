<style>
    /** Error message input modal */
    .error{
        color:red;
    }
</style>
<div class="container">
    <h2>Produit</h2>

    <div class="card">
      
      <!-- Paginate -->
        <div id='pagination' style="margin-left:-90%"></div>
        <div class="row">
            <div class="col-md-6"><a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-produit"> <i class="fa fa-plus"></i> Ajouter</a></div>
            <div class="col-md-6" style="margin-left:-20%">
                <div class="form-group row" >
                    <div class="col-xs-5">
                        <input type="text" name="produit_name" id ="produit_name" class="field-divided form-control input-sm" placeholder="Nom du produit" />
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
                        <th>Produits</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

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
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregister</button>
                    <button class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal for delete produit-->
<div class="modal fade" id="ajax-delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" name="deleteForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    <p id="suppr" style="color:red;font-size:1.5em;text-align:center;font-weight:bold"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="supprimer-produit">Supprimer</button>
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
                url:SITEURL+'/produit/loadRecord/'+pagno,
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
                tr+= "<td> <a class='btn btn-info' id='edit-produit' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-produit' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
                tr += "</tr>";
                $('#postsList tbody').append(tr);
  
            }
        }

        $('body').on('click','#edit-recherche',function(){
            $('#postsList tbody').html('');
            var produit = document.getElementById("produit_name").value;
            if(produit!=''){
                $.ajax({
                    type:"Post",
                    url:SITEURL + "produit/get_rechercher",
                    data:{
                        produit_name : produit,
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
                                tr+= "<td> <a class='btn btn-info' id='edit-produit' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-produit' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
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
                        $('#nom_produit').val(res.data.nom);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       /**Quand l'utilisateur clic sur me boutton "Supprimer" */
       $('body').on('click','#delete-produit',function(){
           var produit_id=$(this).data("id");
           var produit_name=$(this).data("name");
           $('#ajax-delete-modal').modal('show');
           $('#suppr').html('Voulez-vous supprimer le produit '+'"'+produit_name+'"');
           $('#supprimer-produit').click(function(){
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
            });
        });
    }); 

   if($('#produitForm').length >0){
       $('#produitForm').validate({
        rules:{
                nom_produit:"required",
            },
            messages:{
                nom_produit:{
                    required:"Veuillez remplir le champ par le nom d'un produit",
                },
            },
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
                        var produit='<tr id="produit_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.nom + '</td>'; 
                        produit+= '<td><a href="javascript:void(0)" id="edit-produit" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-produit" data-id="' + res.data.id + '" data-name="'+res.data.nom+'" class="btn btn-danger delete-user">Supprimer</a></td></tr>';

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