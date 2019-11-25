<div class="container">
    <h3>Station service :</h3>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">Ville</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-active">
                <td>Column content</td>
                <td>
                    <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalSuppr"><i class="fa fa-trash"></i> Supprimer</a>
                    <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-edit"></i>Editer</a> 
                    
                </td>
            </tr>
        </tbody>
    </table> 

    <div class="row">
        <div class="col-md-6" style="margin-top:20px">
            <button class="btn btn-success"><i class="fa fa-plus"></i>Ajouter</button>
        </div>
        <div class="col-md-6">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#">&laquo;</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">&raquo;</a>
                </li>
            </ul>
        </div>
    </div>

     <!--Début Modal du boutton Supprimer -->
    <div class="modal fade" id="ModalSuppr" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close "  data-dismiss="modal">&times;</button>
                    <p>Etes-vous sûre de vouloir supprimer?</p> 
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger">OUI</button>
                    <button class="btn btn-primary">NON</button>
                </div>
            </div>
        </div>17
    </div>
    <!--Fin Modal du boutton Supprimer -->

    <!--Début Modal du boutton Editer -->
    <div class="modal fade" id="ModalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editer le contenu</h4>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <input type="text" placeholder="Station service" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Nom du visiteur" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="date" placeholder="Date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                        <button type="submit" class="btn btn-primary">annuler</button>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    <!--Début Modal du boutton Editer -->
  
</div>
