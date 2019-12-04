<style>
    #pagination span.page-link{
        font-size: 0.8em;
    }
    #pagination{
        margin-left:-90%;
    }

    #find{
       margin-left: 62% ;
       margin-top:-3% ;
    }
    /** Error message input modal */
    .error{
        color:red;
    }
</style>

<div class="container">
    <?php $session=$this->session->userdata['logged_in'];?>

    <h2>Gestion des utilisateurs</h2>
    <br>

    <div id="pagination"></div>

    <div class="row">
        <div class="col-md-6">
            <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-user"> <i class="fa fa-plus"></i> Ajouter</a>
        </div>

        <div class="col-md-6" id='find'>
            <div class="form-group row">
                <div class="col-xs-6">
                    <input type="text" name="users" id="users" class='form-control input-sm' placeholder="Rechercher utilisateur ...">
                </div>
                <div class="col-xs-6">
                    <a href="javascript:void(0)" id="user-serach" class="btn btn-warning"><i class='fa fa-search'></i> Rechercher</a>
                </div>
            </div>
        </div>
    </div>
    
   <div class="table">
       <table class="table table-bordered" id="users_liste">
            <thead>
                <tr>
                    <th>Nom d'utilisateur</th>
                    <th>Nom et Prénom</th>
                    <th>Adresse email</th>
                    <th>Fonction</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
       </table>
   </div>
</div> 


<!--Modal for add & edit users-->
<div class="modal fade" id="ajax-user-modal" aria-hidden="true">²
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="userCrudModal" style="text-align:center"></h4>
            </div>
            <form id="userForm" name="userForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    
                    <div class="alert alert-danger" hidden >

                    </div>
                
                    <input type="hidden" name="user_id" id="user_id">

                    <div class="form-group">
                        <label for="name" class="control-label">Nom d'utilisateur*: </label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Entrer le nom d'utilisateur" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Nom et Prénom*: </label>
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Entrer votre nom et prénom" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Adresse email*: </label>
                        <input type="email" class="form-control" id="adresse_email" name="adresse_email" placeholder="Entrer votre adresse e-mail" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Fonction* : </label>
                        <select name="fonction" id="fonction" class="form-control" required>
                            <option></option>
                            <?php foreach ($profils as $profil) : ?>
                                <option value="<?= $profil->id ?>"><?= $profil->label ?></option>
                            <?php endforeach ;?>    
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Mot de passe* : </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrer votre mot de passe" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Confirmation du mot de passe* : </label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmer votre mot de passe" value="" required="">
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
                url:SITEURL+'/gestion_utilisateur/loadRecord/'+pagno,
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
            $('#users_liste tbody').empty();

            for (index in result){
                var id=result[index].id;
                var nom_utilisateur=result[index].nom_utilisateur;
                var nom_complet=result[index].nom_complet;
                var adresse_email=result[index].adresse_email;
                var fonction=result[index].label;

                sno+=1;

                var tr= "<tr>";
                tr += "<td>"+ nom_utilisateur +"</td>";
                tr += "<td>"+ nom_complet +"</td>";
                tr += "<td>"+ adresse_email +"</td>";
                tr += "<td>"+ fonction +"</td>";
                tr+= "<td> <a class='btn btn-info' id='edit-users' data-id='"+id+"'>  <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-users' data-id='"+id+"' data-name='"+nom_utilisateur+"'> <i class='fa fa-trash'></i> </a></td>"
                tr += "</tr>";
                $('#users_liste tbody').append(tr);
  
            }
        }
        /** Quand l'utilisateur clic sur le boutton Rechercher */
        $('body').on('click','#user-serach',function(){
            $('#users_liste tbody').html('');
            var users = document.getElementById("users").value;
          if(users!=''){
            $.ajax({
                    type:"Post",
                    url:SITEURL + "gestion_utilisateur/rechercher",
                    data:{
                        users : users,
                    },
                    dataType: "json",
               success: function (res){
                   console.log("ato");
                    if(res.success == true){
                        
                        for($i = 0; $i<res.data.length; $i++){
                            var id=res.data[$i]['id'];
                            var name=res.data[$i]['nom_utilisateur'];
                            var tr = "<tr>";
                            tr += "<td>"+ res.data[$i]['nom_utilisateur'] +"</td>";
                            tr += "<td>"+ res.data[$i]['nom_complet'] +"</td>";
                            tr += "<td>"+ res.data[$i]['adresse_email'] +"</td>";
                            tr += "<td>"+ res.data[$i]['label'] +"</td>";
                            tr+= "<td> <a class='btn btn-info' id='edit-users' data-id='"+id+"'>  <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-users' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
                            tr += "</tr>";
                            $('#users_liste tbody').append(tr);
                    }
               }
                if(res.success == false){
                    $('#users_liste tbody').html('Aucun enregistrements correspondants trouvés');
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
       $('#ajouter-user').click(function(){
            $('#btn-save').val('create-user');
            $('#user_id').val('');
            $('#userForm').trigger("reset");
            $('#userCrudModal').html("Ajout utilisateur");
            $('#ajax-user-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
       $('body').on('click','#edit-users',function(){
           var user_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "gestion_utilisateur/get_user_by_id",
               data:{
                   user_id: user_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#adresse_email-error').hide();
                        $('#password-error').hide();
                        $('#password1-error').hide();
                        $('#userCrudModal').html('Modifier votre profil');
                        $('#btn-save').val('Modifier');
                        $('#ajax-user-modal').modal('show');
                        $('#user_id').val(res.data.id);
                        $('#username').val(res.data.nom_utilisateur);
                        $('#fullname').val(res.data.nom_complet)
                        $('#adresse_email').val(res.data.adresse_email);
                        $('#fonction').val(res.data.type_id);
                        $('#password').val(res.data.mot_de_passe);
                        $('#confirm_password').val(res.data.mot_de_passe);
                    }
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-users',function(){
           var user_id=$(this).data("id");
           var user_name=$(this).data("name");
           $('#ajax-delete-modal').modal('show');
           $('#suppr').html('Voulez-vous supprimer l\'utilisateur '+'"'+user_name+'"');
           $('#supprimer-user').click(function(){
                $.ajax({
                    type:"Post",
                    url:SITEURL + "gestion_utilisateur/delete",
                    data:{
                        user_id:user_id
                    },
                    dataType:'json',
                    success:function(data){
                            $('#user_id_' + user_id).remove();
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

  
   if($('#userForm').length >0){
       $('#userForm').validate({
            rules:{
                password:{
                    required:true,
                },
                confirm_password:{
                    required:true,
                    equalTo:"#password"
                }
            },
            messages:{
                username:{
                    required:"Veuillez remplir le champ par un nom d'utilisateur",
                },
                fullname:{
                    required:"Veuillez remplir le champ par votre nom complet",
                },
                adresse_email:{
                    required:"Veuillez remplir le champ par votre adresse email",
                },
                fonction:{
                    required:"Veuillez choisir une fonction",
                },
                password:{
                    required:"Veuillez remplir le champ mot de passe",
                },
                confirm_password:{
                    required:"Veuillez remplir le champ mot de passe",
                    equalTo:"Confirmer votre mot de passe"
                },
            },
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#userForm').serialize();
               $.ajax({
                   url:SITEURL + "gestion_utilisateur/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var user='<tr id="user_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.login + '</td><td>' + res.data.fullname + '</td><td>'+ '</td><td>' + res.data.profil_id + '</td><td>' + res.data.adress_email + '</td><td>';
                    user+= '<td><a href="javascript:void(0)" id="edit-user" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-user" data-id="' + res.data.id + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-user"){
                        
                       $('#users_liste').prepend(user);
                    }else{
                       $('#user_id_' + res.data.id_users).replaceWith(user);
                    }

                    $('#userForm').trigger("reset");
                    $('#ajax-user-modal').modal('hide');
                    $('#btn-save').html('Enregister modification');
                    setTimeout(function(){
                        location.reload();
                    },100);
                   },

                  error:function(data){
                    console.log('error:',data);
                    $('#btn-save').html("Le Nom d'utilisateur/Nom et Prénom/adresse email existe déjà!!");
                    $('#btn-save').css({
                        color:'white',
                        backgroundColor:'red'
                    });    
                  }
               });
           }
       })
   }
</script>