<div class="container" id="container">
    <h2>Station service</h2>
    <div class="card">
      
      <!-- Paginate -->
      <div id='pagination' style="margin-left:-90%"></div>
      <div class="row">
          <div class="col-md-12">
            <div class="form-group row">
                <div class="col-xs-3">
                <input type="date" name="date" id ="date" class="field-divided form-control input-sm" placeholder="Date" />
                </div>
                <div class="col-xs-3">
                <input type="text" name="station_name" id ="station" class="field-divided form-control input-sm" placeholder="station service" />
                </div>
                <div class="col-xs-3">
                <input type="text" name="garent_name" id = "gerant" class="field-divided form-control input-sm" placeholder="visiteur" />
                </div>
                <div class="col-xs-2">
                <button id="edit-recherche"  class='btn btn-warning'>Recherche</button>
                </div>
            </div>
                
          </div>
      </div>
      
      <div>
           <!-- Posts List -->
           <table class="table table-borderd" id='tableau'>
             <thead>
              <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Date</th>
                <th style="text-align:center">Station service</th>
                <th style="text-align:center">Gérant</th>
                <th style="text-align:center">visiteur</th>
                <th style="text-align:center">Action</th>
              </tr>
             </thead>
             <tbody id = "tbody">
             <?php foreach($resultat as $response){?>
                <tr>
                    <td style="text-align:center"><?php echo $response->{'idvisiteur'}?></td>
                    <td style="text-align:center"><?php echo $response->{'datevisiteur'}?> : <?php echo $response->{'timevisiteur'}?></td>
                    <td style="text-align:center"><?php echo $response->{'nomstation'}?></td>
                    <td style="text-align:center"><?php echo $response->{'nomgerant'}?></td>
                    <td style="text-align:center"><?php echo $response->{'nomvisiteur'}?></td>
                    <td style="text-align:center"><a href="<?=base_url('Questionnaire_station/get_AllQuestionnaire?id=')?><?php echo $response->{'idvisiteur'}?>" class="btn btn-info"> <i class="fa fa-edit"></i>edit</a></td>
                </tr>
                <?php }?>
             </tbody>
           </table>
           
          
      </div>
    </div>
   </div>

<script>
   $('body').on('click','#edit-recherche',function(){
    var tbody =  document.getElementById('tbody'); tbody.innerHTML = " ";
    var tableau =  document.getElementById('tableau'); 
    var date = document.getElementById("date").value;
    var station = document.getElementById("station").value;
    var visite = document.getElementById("gerant").value;
    var SITEURL='<?php echo base_url();?>';
    alert(station + " " + visite);
    $.ajax({
            type:"Post",
            url:SITEURL + "Questionnaire_station/get_recherche_station",
            data:{
                date : date,
                station : station,
                visite : visite,
            },
            dataType: "json",
        success: function (res){
            console.log("ato");
            if(res.success == true){

                for($i = 0; $i<res.data.length; $i++){
                    var tr = document.createElement("tr");
                    var td1 = document.createElement("td"); td1.setAttribute("style","text-align:center");
                    td1.innerHTML = $res.data[i]['idvisiteur'];
                    var td2 = document.createElement("td"); td2.setAttribute("style","text-align:center");
                    td2.innerHTML = $res.data[i]['datevisiteur'] + " : " + $res.data[i]['timevisiteur'];
                    var td3 = document.createElement("td"); td3.setAttribute("style","text-align:center");
                    td3.innerHTML = $res.data[i]['nomstation'];
                    var td4 = document.createElement("td"); td4.setAttribute("style","text-align:center");
                    td4.innerHTML =$res.data[i]['nomgerant'];
                    var td5 = document.createElement("td"); td5.setAttribute("style","text-align:center");
                    td5.innerHTML = $res.data[i]['nomvisiteur'];
                    var td6 = document.createElement("td"); td6.setAttribute("style","text-align:center");
                    var a = document.createElement("a");a.setAttribute("href", "<?=base_url('Questionnaire_station/get_AllQuestionnaire?id=')?>?idvisiteur="+$response[i]['idvisiteur']);a.setAttribute("class", "btn btn-info");
                    a.innerHTML = "edit";
                    tr.append(td1);tr.append(td2);tr.append(td3);tr.append(td4);tr.append(td5);
                    td6.append(a);
                    tr.append(td6);
                    tbody.append(tr);
            } 
            tableau.append(tbody);
        }
        if(res.success == false){
            $('#postsList tbody').html('Aucun enregistrements correspondants trouvés');
        }
        },
        error:function(data){
            console.log('error',data);
        }
    });
  });
</script>
   <!-- Script -->

 