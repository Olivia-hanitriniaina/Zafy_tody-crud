<style>
    #view{
       text-decoration: none;
       font-size:1.5em;
       color:orangered; 
       margin: auto;
    }
    #download{
        text-decoration: none;
        font-size:1.5em;
        color:red;  
        margin-left: 15px;
    }
</style>
<div class="container main_content">
    <h2>Liste des visites de chantier</h2>
    <div class="card">
        <!--Barre de recherche et pagination-->
        <div id="pagination"></div>
        <div class="form-group row">
            <div class="col-xs-3">
                <input type="text" name="site_name" id ="site_name" class="field-divided form-control input-xs" placeholder="Rechercher un site..." />
            </div>
            <div class="col-xs-3">
                <input type="date" name="date_visite" id = "date_visite" class="field-divided form-control input-xs" placeholder="Rechercher la date d'une visite..." />
            </div>
            <div class="col-xs-3">
                <input type="text" name="entreprise_name" id = "entreprise_name" class="field-divided form-control input-xs" placeholder="Rechercher le nom de l'entreprise..." />
            </div>
            <div class="col-xs-3">
                <a href = "javascript:void(0)" id="rechercher" value="" class='btn btn-warning'>Rechercher</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered" id="postsList">
        <thead>
            <tr>
                <th>id_visite</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Site/Lieu</th>
                <th>Chef de site</th>
                <th>Entreprise</th>
                <th>Chef de chantier</th>
                <th>Visiteur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!--Script JS-->
<script>
    var SITEURL='<?php echo base_url();?>';

    $(document).ready(function(){
        //Création du tableau et pagination
        $('#pagination').on('click','a',function(e){
            e.preventDefault(); 
            var pageno = $(this).attr('data-ci-pagination-page');
            loadPagination(pageno);
        });

        loadPagination(0);

        function loadPagination(pagno){
            $.ajax({
                url:SITEURL+'/visite_chantier/loadRecord/'+pagno,
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
                var id = result[index].visite_id;
                var date = result[index].date;
                var time = result[index].time;
                var chef_site = result[index].chef_site;
                var visiteur = result[index].visiteur;
                var site = result[index].Site;
                var entreprise = result[index].Entreprise;
                var chef_chantier= result[index].nom_chef_chantier_exterieur;
        
                sno+=1;

                var tr = "<tr>";
                tr += "<td>"+ id +"</td>";
                tr += "<td>"+ date +"</td>";
                tr += "<td>"+ time +"</td>";
                tr += "<td>"+ site +"</td>";
                tr += "<td>"+ chef_site +"</td>";
                tr += "<td>"+ entreprise +"</td>";
                tr += "<td>"+ chef_chantier +"</td>";
                tr += "<td>"+ visiteur +"</td>";
                tr+= "<td> <a href='<?php echo base_url()?>visite_chantier/reponse_visite?id_chantier="+id+"' id='view' class='fa fa-eye btn' data-id='"+id+"'> </a> <a class='fa fa-file-pdf-o' id='download' data-id='"+id+"'></a></td>";
                tr += "</tr>";
                $('#postsList tbody').append(tr);

            }
        }

        //Recherche d'élément dans le tableau
        $('body').on('click','#rechercher',function(){
            $('#postsList tbody').html('');
            var site = document.getElementById("site_name").value;
            var entreprise = document.getElementById("entreprise_name").value;
            var date = document.getElementById("date_visite").value;

            if(site!='' || entreprise!='' || date!=''){
                $.ajax({
                    type:"Post",
                    url:SITEURL + "visite_chantier/search_visite",
                    data:{
                        site_name : site,
                        entreprise_name : entreprise,
                        date_visite: date
                    },
                    dataType: "json",
                    success: function (res){
                        console.log("ato");

                        if(res.success == true){
                            
                            for($i = 0; $i<res.data.length; $i++){
                                var id = res.data[$i]['visite_id'];
                                var date = res.data[$i]['date'];
                                var time = res.data[$i]['time'];
                                var chef_site = res.data[$i]['chef_site'];
                                var visiteur = res.data[$i]['visiteur'];
                                var site = res.data[$i]['Site'];
                                var entreprise = res.data[$i]['Entreprise'];
                                var chef_chantier= res.data[$i]['nom_chef_chantier_exterieur'];

                                var tr = "<tr>";
                                tr += "<td>"+ id +"</td>";
                                tr += "<td>"+ date +"</td>";
                                tr += "<td>"+ time +"</td>";
                                tr += "<td>"+ site +"</td>";
                                tr += "<td>"+ chef_site +"</td>";
                                tr += "<td>"+ entreprise +"</td>";
                                tr += "<td>"+ chef_chantier +"</td>";
                                tr += "<td>"+ visiteur +"</td>";
                                tr+= "<td> <a href='<?php echo base_url()?>visite_chantier/reponse_visite?id_chantier="+id+"' id='view' class='fa fa-eye btn' data-id='"+id+"'> </a> <a class='fa fa-file-pdf-o' id='download' data-id='"+id+"'></a></td>";
                                tr += "</tr>";
                                $('#postsList tbody').append(tr);
                            }
                        }
                        
                        if(res.success == false){
                            $('#postsList tbody').html('Aucun enregistrements correspondants trouvés');
                            $('#postsList tbody').css({color:'red'});
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
    
</script>