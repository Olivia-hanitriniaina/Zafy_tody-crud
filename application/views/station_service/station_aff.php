<div class="container" id="container">
    <h2>Station service</h2>
    
    <div class="card">
      
      <!-- Paginate -->
      <div id='pagination' style="margin-left:-90%"></div>
      <div class="row">
          <div class="col-md-6"><a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-station"> <i class="fa fa-plus"></i> Ajouter</a></div>
          <div class="col-md-6" style="margin-left:-20%">
            <div class="form-group row" >
                <div class="col-xs-5">
                <input type="text" name="station_name" id ="station_name" class="field-divided form-control input-sm" placeholder="Nom de la station" />
                </div>
                <div class="col-xs-5">
                <input type="text" name="garent_name" id = "gerant_name" class="field-divided form-control input-sm" placeholder="Nom du gérant" />
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
                <th>Station service</th>
                <th>Gérant</th>
                <th>Action</th>
              </tr>
             </thead>
             <tbody></tbody>
           </table>
           
          
      </div>
    </div>
   </div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-station-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="stationCrudModal" style="text-align:center"></h4>
            </div>
            <form id="stationForm" name="stationForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                
                    <input type="hidden" name="station_id" id="station_id">

                    <div class="form-group">
                        <label for="name" class="control-label">Station service : </label>
                        <input type="text" class="form-control" id="nom_station" name="nom_station" placeholder="Entrer le nom du station service" value="" required="">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Gérant : </label>
                        <select name="local_manager" id="local_manager" class='form-control'>
                            <option value="default"></option>
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

<!--Modal for delete station-->
<div class="modal fade" id="ajax-delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" name="deleteForm" class="form-horizontal">
                <div class="modal-body" style="width:95%;margin:auto">
                    <p id="suppr" style="color:red;font-size:1.5em;text-align:center;font-weight:bold"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="supprimer-station">Supprimer</button>
                    <button class="btn btn-defaut" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>
   <!-- Script -->
  
<script type='text/javascript'>
   $(document).ready(function(){
    var SITEURL='<?php echo base_url();?>';
     $('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pagination-page');
       loadPagination(pageno);
     });
 
     loadPagination(0);
 
     function loadPagination(pagno){
       $.ajax({
         url:SITEURL+'/station_service/loadRecord/'+pagno,
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
          tr+= "<td> <a class='btn btn-info' id='edit-station' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-station' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
          tr += "</tr>";
          $('#postsList tbody').append(tr);
  
        }
      }

      $('body').on('click','#edit-recherche',function(){
            $('#postsList tbody').html('');
            var station = document.getElementById("station_name").value;
            var gerante = document.getElementById("gerant_name").value;
          if(station!='' || gerante!=''){
            $.ajax({
                    type:"Post",
                    url:SITEURL + "station_service/get_rechercher",
                    data:{
                        station : station,
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
                            tr+= "<td> <a class='btn btn-info' id='edit-station' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-station' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
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

     

      $(document).ready(function(){ 
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
       $('#ajouter-station').click(function(){
            $('#btn-save').val('create-station');
            $('#station_id').val('');
            $('#stationForm').trigger("reset");
            $('#stationCrudModal').html("Nouvelle Station Service");
            $('#ajax-station-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
      $('body').on('click','#edit-station',function(){
           var station_id=$(this).data("id");
          
           $.ajax({
               type:"Post",
               url:SITEURL + "station_service/get_station_by_id",
               data:{
                   station_id: station_id
               },
               dataType: "json",
               success: function (res){
                    if(res.success == true){
                        $('#nom_station-error').hide();
                        $('#nom_visiteur-error').hide();
                        $('#date-error').hide();
                        $('#stationCrudModal').html('Modifier Station service');
                        $('#btn-save').val('Modifier');
                        $('#ajax-station-modal').modal('show');
                        $('#station_id').val(res.data.id);
                        $('#nom_station').val(res.data.nom);
                        $('#local_manager').val(res.data.responsable_id);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-station',function(){
           var station_id=$(this).data("id");
           var station_name=$(this).data("name"); 
           $('#ajax-delete-modal').modal('show');
           $('#suppr').html('Voulez-vous supprimer la station '+'"'+station_name+'"');
           $('#supprimer-station').click(function(){
                $.ajax({
                   type:"Post",
                   url:SITEURL + "station_service/delete",
                   data:{
                    station_id:station_id
                   },
                   dataType:'json',
                   success:function(data){
                        $('#station_id_' + station_id).remove();
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

   if($('#stationForm').length >0){
       $('#stationForm').validate({
           submitHandler: function(form){
               var actionType= $('#btn-save').val();
               $('#btn-save').html('Envoie...');
               var serialize=$('#stationForm').serialize();
               $.ajax({
                   url:SITEURL + "station_service/store",
                   type:"Post",
                   dataType:'json',
                   data: serialize,
                   
                   success: function(res){
                    var station='<tr id="station_id_'+ res.data.id + '"><td>' + res.data.id + '</td><td>' + res.data.nom + '</td><td>'+ res.data.nom_complet + '</td><td>'; 
                    station+= '<td><a href="javascript:void(0)" id="edit-station" data-id="' + res.data.id + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-station" data-id="' + res.data.id + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-station"){
                        
                       $('#station_liste').prepend(station);
                    }else{
                       $('#station_id_' + res.data.id).replaceWith(station);
                    }

                    $('#stationForm').trigger("reset");
                    $('#ajax-station-modal').modal('hide');
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
