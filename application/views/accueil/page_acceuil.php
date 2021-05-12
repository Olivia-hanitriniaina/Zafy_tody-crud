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
        <h2 style="color:grey"><i class="fa fa-list"></i> Liste des article</h2>
    </div>
    
    <div class="row">
        <div class="col-md-6" id='find'>
            <div class="form-group row">
                <div class="col-xs-6">
                    <input type="text" name="produit" id="produit" class='form-control input-sm' placeholder="Rechercher utilisateur ...">
                </div>
                <div class="col-xs-6">
                    <a href="javascript:void(0)" id="user-serach" class="btn btn-default" style="background-color: #80b0d1;color:white"><i class='fa fa-search'></i> Rechercher</a>
                </div>
            </div>
        </div>
    </div>

   <div class="table">
       <table class="table table-bordered" id="produit_liste">
            <thead style="background-color: #80b0d1;color:white">
                <tr>
                    <th>nom article</th>
                    <th>marque</th>
                    <th>pour</th>
                    <th>Type</th>
                    <th>prix</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
       </table>

    </table>
   </div>
   <div id="pagination"></div>

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
                    tr += "</tr>";
                    $('#produit_liste tbody').append(tr);
    
                }
            }
            /** Quand l'utilisateur clic sur le boutton Rechercher */
            $('body').on('click','#user-serach',function(){

                $('#produit_liste tbody').html('');
                var produit = document.getElementById("produit").value;
            if(produit!=''){
               
                $.ajax({
                        type:"Post",
                        url:SITEURL + "gestion_article/rechercher",
                        data:{
                            produit : produit,
                        },
                        dataType: "json",
                        success: function (res){
                            if(res.success == true){
                            
                                for($i = 0; $i<res.data.length; $i++){
                                    var id=result[res.data].id;
                                    var nom_article=res.data[$i]['nom_produit'];
                                    var nom_image=res.data[$i]['image'];
                                    var marque=res.data[$i]['marque'];
                                    var pour=res.data[$i]['pour'];
                                    var type=res.data[$i]['type'];
                                    var prix=res.data[$i]['prix'];

                                    sno+=1;
                                   
                                    var tr= "<tr>";
                                    tr += "<td>"+ nom_article +"</td>";
                                    tr += "<td>"+ marque +"</td>";
                                    tr += "<td>"+ pour +"</td>";
                                    tr += "<td>"+ type +"</td>";
                                    tr += "<td>"+ prix +"</td>";
                                    tr += "</tr>";
                                    $('#produit_liste tbody').append(tr);
                    
                                }
                            }
                            if(res.success == false){
                                $('#produit_liste tbody').html('Aucun enregistrements correspondants trouvés');
                            }
                        },
                        error:function(data){
                            console.log('error',data);
                        }
                    });
            }
            else{
                loadPagination(0)
            }
        });
    });
    </script>
    