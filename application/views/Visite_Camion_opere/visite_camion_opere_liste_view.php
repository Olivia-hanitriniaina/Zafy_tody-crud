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
<div class="container">
    <h2>Liste des visites de stl calion opéré</h2>
    <div class="card">
        <!--Barre de recherche et pagination-->
        <div id="pagination"></div>
        <div class="form-group row">
            <div class="col-xs-3">
                <input type="text" name="inspecteur" id ="inspecteur" class="field-divided form-control input-xs" placeholder="Rechercher nom de l'inspecteur..." />
            </div>
            <div class="col-xs-3">
                <input type="date" name="date" id = "date" class="field-divided form-control input-xs" placeholder="Rechercher la date d'une visite..." />
            </div>
            <div class="col-xs-3">
                <input type="text" name="transporteur" id = "transporteur" class="field-divided form-control input-xs" placeholder="Rechercher transporteur..." />
            </div>
            <div class="col-xs-3">
                <input type="text" name="expediteur" id = "expediteur" class="field-divided form-control input-xs" placeholder="Rechercher expediteur" />
            </div>
            

        </div>
        <div class="form-group row">
        <div class="col-xs-3">
                <input type="text" name="lieu" id ="lieu" class="field-divided form-control input-xs" placeholder="Rechercher lieu de contrôle..." />
            </div>
            <div class="col-xs-3">
                <input type="text" name="produit" id = "produit" class="field-divided form-control input-xs" placeholder="Rechercher produit..." />
            </div>
            <div class="col-xs-3">
                <input type="text" name="conducteur" id = "conducteur" class="field-divided form-control input-xs" placeholder="Rechercher nom du conducteur..." />
            </div>
            <div class="col-xs-3">
                <input type="text" name="tracteur" id ="tracteur" class="field-divided form-control input-xs" placeholder="Rechercher l' immatriculation tracteur/ ..." />
            </div>
            
        </div>
        <div class="form-group row">
        <div class="col-xs-3">
                <input type="text" name="semi" id = "semi" class="field-divided form-control input-xs" placeholder="Rechercher l' immatriculation semi_remorque..." />
            </div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3">
                <a href = "javascript:void(0)" id="rechercher" value="" class='btn btn-warning'>Rechercher</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered" id="postsList">
        <thead>
            <tr>
                <th>id_visite</th>
                <th>Nom de l'inspecteur</th>
                <th>Transporteur</th>
                <th>Nom_Expediteur</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Lieu de contrôle</th>
                <th>Produit</th>
                <th>Nom de conducteur</th>
                <th>Immatriculation tracteur/porteur</th>
                <th>Immatriculation semi-remorque</th>
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
                url:SITEURL+'/visite_camion_opere/loadRecord/'+pagno,
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
                var inspecteur = result[index].visiteur;
                var transporteur = result[index].nom_trasporteur;
                var expediteur = result[index].nom_expediteur;
                var date = result[index].date;
                var time = result[index].heure;
                var lieu = result[index].localisation;
                var produit = result[index].product;
                var conducteur = result[index].nom_conducteur;
                var imma_tracteur = result[index].immatriculation_tracteur;
                var imma_semi = result[index].immatriculation_semi_remorque;
        
                sno+=1;

                var tr = "<tr>";
                tr += "<td>"+ id +"</td>";
                tr += "<td>"+ inspecteur +"</td>";
                tr += "<td>"+ transporteur +"</td>";
                tr += "<td>"+ expediteur +"</td>";
                tr += "<td>"+ date +"</td>";
                tr += "<td>"+ time +"</td>";
                tr += "<td>"+ lieu +"</td>";
                tr += "<td>"+ produit +"</td>";
                tr += "<td>"+ conducteur +"</td>";
                tr += "<td>"+ imma_tracteur +"</td>";
                tr += "<td>"+ imma_semi +"</td>";
                tr+= "<td> <a href='<?php echo base_url()?>visite_camion_opere/reponse_visite?idcamion="+id+"' id='view' class='fa fa-eye btn' data-id='"+id+"'> </a> <a class='fa fa-file-pdf-o' id='download' data-id='"+id+"'></a></td>";
                tr += "</tr>";
                $('#postsList tbody').append(tr);

            }
        }

        //Recherche d'élément dans le tableau
        $('body').on('click','#rechercher',function(){
            $('#postsList tbody').html('');
            var inspecteur = document.getElementById("inspecteur").value;
            var date = document.getElementById("date").value;
            var transporteur = document.getElementById("transporteur").value;
            var expediteur = document.getElementById("expediteur").value;
            var lieu = document.getElementById("lieu").value;
            var produit = document.getElementById("produit").value;
            var conducteur = document.getElementById("conducteur").value;
            var tracteur = document.getElementById("tracteur").value;
            var semi = document.getElementById("semi").value;
           

            if(inspecteur!='' || date!='' || transporteur!='' || expediteur!='' || lieu!='' || produit!='' || conducteur!='' || tracteur!='' || semi!=''){
                $.ajax({
                    type:"Post",
                    url:SITEURL + "Visite_bouteilles/search_visite",
                    data:{
                        inspecteur : inspecteur,
                        date : date,
                        transporteur : transporteur,
                        expediteur : expediteur,
                        lieu: lieu,
                        produit : produit,
                        conducteur : conducteur,
                        tracteur : tracteur,
                        semi : semi
                    },
                    dataType: "json",
                    success: function (res){
                        console.log("ato");

                        if(res.success == true){
                            
                            for($i = 0; $i<res.data.length; $i++){
                                var id = res.data[$i]['visite_id'];
                                var inspecteur = res.data[$i]['visiteur'];
                                var transporteur = res.data[$i]['nom_transporteur'];
                                var expediteur = res.data[$i]['nom_expediteur'];
                                var date = res.data[$i]['date'];
                                var time = res.data[$i]['heure'];
                                var lieu = res.data[$i]['localisation'];
                                var produit = res.data[$i]['product'];
                                var conducteur = res.data[$i]['nom_conducteur'];
                                var imma_tracteur = res.data[$i]['immatriculation_tracteur'];
                                var imma_semi = res.data[$i]['immatriculation_semi_remorque'];
                        
                                sno+=1;

                                var tr = "<tr>";
                                tr += "<td>"+ id +"</td>";
                                tr += "<td>"+ inspecteur +"</td>";
                                tr += "<td>"+ transporteur +"</td>";
                                tr += "<td>"+ expediteur +"</td>";
                                tr += "<td>"+ date +"</td>";
                                tr += "<td>"+ time +"</td>";
                                tr += "<td>"+ lieu +"</td>";
                                tr += "<td>"+ produit +"</td>";
                                tr += "<td>"+ conducteur +"</td>";
                                tr += "<td>"+ imma_tracteur +"</td>";
                                tr += "<td>"+ imma_semi +"</td>";
                                tr+= "<td> <a href='<?php echo base_url()?>visite_bouteilles/reponse_visite?idbouteille="+id+"' id='view' class='fa fa-eye btn' data-id='"+id+"'> </a> <a class='fa fa-file-pdf-o' id='download' data-id='"+id+"'></a></td>";
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