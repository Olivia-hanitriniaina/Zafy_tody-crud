<div class="container" id="container">
    <h2>Station service</h2>
    <br>
    <div class="form-style-3">
        <fieldset>
        <ul class="form-style-1">
            <li><label>Rechercher </span></label>
            <input type="text" name="station_name" id ="station_name" class="field-divided" placeholder="Station service name" /> 
            <input type="text" name="garent_name" id = "gerant_name" class="field-divided" placeholder="Gérant name" />
            <br>
            <br>
            <a href = "javascript:void(0)" id="edit-recherche" value="" >search</a>
           
            </li>
        </ul>
        </fieldset>
        </div>
    <br>
    <a href="javascript:void(0)" class="btn btn-success ml-3" id="ajouter-station"> <i class="fa fa-plus"></i> Ajouter</a>
    <br><br>

    <table class="table table-bordered table-striped" id="station_liste">
        <thead style="background-color:rgba(200,0,0,0.5)">
            <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Station service</th>
                <th style="text-align:center">Gérant</th>
                <th style="text-align:center">Actions</th>
            </tr>
        </thead>

        <tbody id = "body">
        </tbody>
    </table>
</div>

<!--Modal for add & edit station-->
<div class="modal fade" id="ajax-station-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h4 class="modal-title" id="stationCrudModal"></h4>
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
                                <option value="<?= $user->id_local ?>"><?= $user->fullname ?></option>
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
   $(document).ready(function() {
        var tableau = document.getElementById('station_liste');
        var tbody = document.getElementById('body');
        $.ajax({
            type:"Post",
            url:SITEURL + "station_service/get_all_station",
            data:{
            },
            dataType: "json",
            success: function (res){
                if(res.success == true){
                    for($i = 0; $i<res.data.length; $i++){
                        var table = document.createElement('tr');table.setAttribute("id","station_id");
                        var td1 = document.createElement('td');table.setAttribute("style","text-align:center");td1.innerHTML =res.data[$i]['id_local'];
                        var td2 = document.createElement('td');table.setAttribute("style","text-align:center");td2.innerHTML =res.data[$i]['name_local'];
                        var td3 = document.createElement('td');table.setAttribute("style","text-align:center");td3.innerHTML =res.data[$i]['fullname'];
                        var td5 = document.createElement('td');
                        var a1 = document.createElement('a');a1.setAttribute('class','btn btn-info');
                        var i1 = document.createElement('i');i1.setAttribute('class','fa fa-edit');
                        a1.innerHTML="Modifier";
                        var a2 = document.createElement('a');a2.setAttribute("class", 'btn btn-danger delete-user');
                        var i2 = document.createElement('i');i2.setAttribute('class','fa fa-trash');
                        a2.innerHTML = "Supprimer";
                        a1.append(i1);
                        a2.append(i2);
                        table.append(td1);
                        table.append(td2);
                        table.append(td3);
                        table.append(td5); 
                        td5.append(a1);  td5.append(a2);
                        tbody.append(table);
                    }
                    tableau.append(tbody);
                }
                if(res.success == false){
                    var h2 = document.createElement('h4'); h2.innerHTML= "Aucun enregistrements correspondants trouvés";
                    tbody.innerHTML = "";
                    tableau.innerHTML = "";
                    container.append(h2);
                }
            },
            error:function(data){
                console.log('error',data);
            }
        });
        $('body').on('click','#edit-recherche',function(){
            var tableau = document.getElementById('station_liste');
            var container = document.getElementById('container');
            var tbody = document.getElementById('body') ;tbody.innerHTML ="";
            var station = document.getElementById("station_name").value;
            var gerante = document.getElementById("gerant_name").value;
          
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
                        var table = document.createElement('tr');table.setAttribute("id","station_id");
                        var td1 = document.createElement('td');table.setAttribute("style","text-align:center");td1.innerHTML =res.data[$i]['id_local'];
                        var td2 = document.createElement('td');table.setAttribute("style","text-align:center");td2.innerHTML =res.data[$i]['name_local'];
                        var td3 = document.createElement('td');table.setAttribute("style","text-align:center");td3.innerHTML =res.data[$i]['fullname'];
                        var td5 = document.createElement('td');
                        var a1 = document.createElement('a');a1.setAttribute('class','btn btn-info');
                        var i1 = document.createElement('i');i1.setAttribute('class','fa fa-edit');
                        a1.innerHTML="Modifier";
                        var a2 = document.createElement('a');a2.setAttribute("class", 'btn btn-danger delete-user');
                        var i2 = document.createElement('i');i2.setAttribute('class','fa fa-trash');
                        a2.innerHTML = "Supprimer";
                        a1.append(i1);
                        a2.append(i2);
                        table.append(td1);
                        table.append(td2);
                        table.append(td3);
                        table.append(td5); 
                        td5.append(a1);  td5.append(a2);
                        tbody.append(table);
                    }
                    tableau.append(tbody);
               }
                if(res.success == false){
                    var h2 = document.createElement('h4'); h2.innerHTML= "Aucun enregistrements correspondants trouvés";
                    tbody.innerHTML = "";
                    tableau.innerHTML = "";
                    container.append(h2);
                }
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });
   });

  
  
  /* $(document).ready(function(){
        $('#station_liste').DataTable();
        
       /**Quand l'utilisateur clic sur me boutton "Ajouter" */
      /* $('#ajouter-station').click(function(){
            $('#btn-save').val('create-station');
            $('#station_id').val('');
            $('#stationForm').trigger("reset");
            $('#stationCrudModal').html("Nouvelle Station Service");
            $('#ajax-station-modal').modal('show');
       });

       /**Quand l'utilisateur clic sur me boutton "Modifier" */
     /*  $('body').on('click','#edit-station',function(){
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
                        alert(res.data);
                        $('#nom_station-error').hide();
                        $('#nom_visiteur-error').hide();
                        $('#date-error').hide();
                        $('#stationCrudModal').html('Modifier Station service');
                        $('#btn-save').val('Modifier');
                        $('#ajax-station-modal').modal('show');
                        $('#station_id').val(res.data.id_local);
                        $('#nom_station').val(res.data.name_local);
                        $('#local_manager').val(res.data.local_manager_id);
                    }
                   
               },
               error:function(data){
                   console.log('error',data);
               }
           });
       });

       $('body').on('click','#delete-station',function(){
           var station_id=$(this).data("id");

           if(confirm("Etes-vous sûre de vouloir supprimer?")){
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
           }
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
                    var station='<tr id="station_id_'+ res.data.id_local + '"><td>' + res.data.id_local + '</td><td>' + res.data.name_local + '</td><td>'+ res.data.fullname + '</td><td>'; 
                    station+= '<td><a href="javascript:void(0)" id="edit-station" data-id="' + res.data.id_local + '"class="btn btn-info">Modifier</a><a href="javascript:void(0)" id="delete-station" data-id="' + res.data.id_local + '"class="btn btn-danger delete-user">Supprimer</a></td></tr>';

                    if(actionType =="create-station"){
                        
                       $('#station_liste').prepend(station);
                    }else{
                       $('#station_id_' + res.data.id_local).replaceWith(station);
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
   }*/
  
</script>
