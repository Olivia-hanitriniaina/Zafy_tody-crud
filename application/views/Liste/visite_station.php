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

           <table class="table table-borderd" id='postsList'style='width:80%'>
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
             </tbody>
           </table>
      </div>
    </div>
   </div>

   

<script>

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
                url:SITEURL+'/Questionnaire_station/loadRecord/'+pagno,
                type: 'get',
                dataType: 'json',
                success: function(response){
                  console.log(pagno);
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
                var id = result[index].idvisiteur;
                var date = result[index].datevisiteur +" : "+ result[index].timevisiteur ;
                var nomgerant = result[index].nomgerant;
                var nomstation = result[index].nomstation;
                var  nomvisiteur = result[index]. nomvisiteur;
                sno+=1;
                alert("response"+id);
                var tr = "<tr>";
                //tr += "<td>"+ sno +"</td>";
                tr += "<td>"+ id +"</td>";
                tr += "<td>"+ date +"</td>";
                tr += "<td>"+ nomgerant +"</td>";
                tr += "<td>"+ nomstation +"</td>";
                tr += "<td>"+ nomvisiteur +"</td>";
                tr+= "<td> <a class='btn btn-info' id='edit-station' data-id='"+id+"'> <i class='fa fa-edit'></i> </a> <a class='btn btn-danger' id='delete-station' data-id='"+id+"' data-name='"+name+"'> <i class='fa fa-trash'></i> </a></td>"
                tr += "</tr>";
                $('#postsList tbody').append(tr);
            }
        }
        $('body').on('click','#edit-recherche',function(){
            $('#postsList tbody').html('');
            var date = document.getElementById("date").value;
            var station = document.getElementById("station").value;
            var visite = document.getElementById("gerant").value;

            if(station!='' || gerante!=''){
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
                              var id = res.data[$i].idvisiteur;
                              var date = res.data[$i].datevisiteur +" : "+ res.data[$i].timevisiteur ;
                              var nomgerant = res.data[$i].nomgerant;
                              var nomstation = res.data[$i].nomstation;
                              var  nomvisiteur = result[index]. nomvisiteur;
                              sno+=1;

                              var tr = "<tr>";
                              //tr += "<td>"+ sno +"</td>";
                              tr += "<td>"+ id +"</td>";
                              tr += "<td>"+ date +"</td>";
                              tr += "<td>"+ nomgerant +"</td>";
                              tr += "<td>"+ nomstation +"</td>";
                              tr += "<td>"+ nomvisiteur +"</td>";
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
});
   /*$('body').on('click','#edit-recherche',function(){
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
  });*/
</script>
   <!-- Script -->

 