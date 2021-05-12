<style>
    #pagination span.page-link{
        font-size: 0.8em;
    }
    #pagination{
        margin-top: -15px;
        margin-left:-88.4%;
    }

    #find{
       margin-left: 61.6% ;
       margin-top:-3% ;
    }
    /** Error message input modal */
    .error{
        color:red;
    }
    #edit-produit,#delete-produit{
        text-decoration: none;
        font-size: 1.2em;
    }
    #delete-produit{
        color:red;
        margin-left: 20px;
    }
    #gestion_utilisateur{
        overflow: hidden;
    }
</style>

<div class="container main_content" id="gestion_utilisateur">

    <div class="titre" >
        <h2 style="color:grey"><i class="fa fa-list"></i>Gestion d'article</h2>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-user"> <i class="fa fa-plus"></i> Ajouter</a>
        </div>
    </div><br>

   <div class="table">
       <table class="table table-bordered" id="produit_liste">
            <thead style="background-color: #80b0d1;color:white">
                <tr>
                    <th>nom article</th>
                    <th>marque</th>
                    <th>pour</th>
                    <th>Type</th>
                    <th>prix</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
       </table>

    </table>
   </div>
   <div id="pagination"></div>
    <!--Modal for add & edit users-->
    <div class="modal fade" id="ajax-article-modal" aria-hidden="true">²
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h4 class="modal-title" id="articleCrudModal" style="text-align:center"></h4>
                </div>
                <form id="articleForm" name="articleForm" class="form-horizontal">
                    <div class="modal-body" style="width:95%;margin:auto">
                        <div class="alert alert-danger" hidden >
                        </div>
                        <input type="hidden" name="article_id" id="article_id">

                        <div class="form-group">
                            <label for="name" class="control-label">Nom d'article*: </label>
                            <input type="text" class="form-control" id="nom_produit" name="nom_produit" placeholder="Entrer le nom de votre article" value="" required="">
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label">Marque*: </label>
                            <select name="marque" id="marque" class="form-control" required>
                                <option></option>
                                <option value="adidas">adidas</option>
                                <option value="channel">channel</option>
                                <option value="autre">autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Type*: </label>
                            <select name="type" id="type" class="form-control" required>
                                <option></option>
                                <option value="adidas">Alcool</option>
                                <option value="Sport">Sport</option>
                                <option value="Sport 1">type 1</option>
                                <option value="autre">autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Pour*: </label>
                            <select name="pour" id="pour" class="form-control" required>
                                <option></option>
                                <option value="enfant">enfant</option>
                                <option value="homme">homme</option>
                                <option value="femme">femme</option>
                                <option value="autre">autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Prix* : </label>
                            <input type="number" class="form-control" id="prix" name="prix" placeholder="Prix de votre article" value="" required="">
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
    <!--Modal for delete users-->
    <div class="modal fade" id="ajax-delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" name="deleteForm" class="form-horizontal">
                    <div class="modal-body" style="width:95%;margin:auto">
                        <p id="suppr" style="color:red;font-size:1.5em;text-align:center;font-weight:bold"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="supprimer-user">Supprimer</button>
                        <button class="btn btn-defaut" data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
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
                    url:SITEURL+'gestion_article/loadRecord/'+pagno,
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
                sno= Number(sno);
                $('#produit_liste tbody').empty();

                for (index in result){
                    var id=result[index].id;
                    var nom_article=result[index].nom_produit;
                    var nom_image=result[index].image;
                    var marque=result[index].marque;
                    var pour=result[index].pour;
                    var type=result[index].type;
                    var prix=result[index].prix;

                    sno+=1;
                   
                    var tr= "<tr>";
                    tr += "<td>"+ nom_article +"</td>";
                    tr += "<td>"+ marque +"</td>";
                    tr += "<td>"+ pour +"</td>";
                    tr += "<td>"+ type +"</td>";
                    tr += "<td>"+ prix +" MG</td>";
                    tr+= "<td> <a  id='edit-article' data-id='"+id+"'>  <i class='fa fa-edit'></i> </a> <a  id='delete-article' data-id='"+id+"' data-name='"+nom_article+"'> <i class='fa fa-trash'></i> </a></td>"
                    tr += "</tr>";
                    $('#produit_liste tbody').append(tr);
    
                }
            }
            $('body').on('click','#delete-article',function(){
            var article_id=$(this).data("id");
            var article_name=$(this).data("name");
            $('#ajax-delete-modal').modal('show');
            $('#suppr').html('Voulez-vous supprimer l\'article '+'"'+article_name+'"');
            $('#supprimer-user').click(function(){
                    $.ajax({
                        type:"Post",
                        url:SITEURL + "gestion_article/delete",
                        data:{
                            article_id:article_id
                        },
                        dataType:'json',
                        success:function(data){
                                //$('#user_id_' + user_id).remove();
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
        /**Quand l'utilisateur clic sur me boutton "Ajouter" */
        $('#ajouter-user').click(function(){
                $('#btn-save').val('create-user');
                $('#article_id').val('');
                $('#articleForm').trigger("reset");
                $('#articleCrudModal').html("Ajout un article");
                $('#ajax-article-modal').modal('show');
        });

        /**Quand l'utilisateur clic sur me boutton "Modifier" */
        $('body').on('click','#edit-article',function(){
            var article_id=$(this).data("id");
            
            $.ajax({
                type:"Post",
                url:SITEURL + "gestion_article/get_article_by_id",
                data:{
                    article_id: article_id
                },
                dataType: "json",
                success: function (res){
                        if(res.success == true){
                            $('#articleCrudModal').html('Modifier votre profil');
                            $('#btn-save').val('Modifier');
                            $('#ajax-article-modal').modal('show');
                            $('#article_id').val(res.data.id);
                            $('#nom_produit').val(res.data.nom_produit);
                            $('#marque').val(res.data.marque)
                            $('#type').val(res.data.type);
                            $('#pour').val(res.data.pour);
                            $('#prix').val(res.data.prix);
                        }
                },
                error:function(data){
                    console.log('error',data);
                }
            });
        });
        if($('#articleForm').length >0){
        $('#articleForm').validate({
            rules:{
                nom_produit:"required",
                marque:"required",
                type:"required",
                pour:"required",
                prix:"required"
            },
            messages:{
                nom_produit:{
                    required:"Veuillez remplir le champ par le nom d'un artcicle",
                },
                marque:{
                    required:"Veuillez selectionner un marque",
                },
                type:{
                    required:"Veuillez selectionner un type",
                },
                pour:{
                    required:"Veuillez selectionner un pour",
                },
                prix:{
                    required:"Veuillez remplir le champ prix ",
                }
            },
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#articleForm').serialize();
               $.ajax({
                   url:SITEURL + "gestion_article/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var depot='<tr id="depot_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>'+res.data.nom+'</td><td>' + res.data.nom_complet + '</td><td>';
                    depot+= '<td><a href="javascript:void(0)" id="edit-depot" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-depot" data-id="' + res.data.id + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';


                    $('#articleForm').trigger("reset");
                    $('#ajax-article-modal').modal('hide');
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
});
    </script>
    