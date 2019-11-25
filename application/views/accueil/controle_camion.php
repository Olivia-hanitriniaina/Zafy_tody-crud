<div class="container">
    <div class="header">
        <div class="row">
            <div class="col-md-2"><img src="<?=base_url('/assets/images/logo.png')?>" alt="logo" ></div>
            <div class="col-md-6">
                <h2 style="text-align:center">FICHE DE CONTROLE CAMION N°:</h2>
            </div>
            <div class="col-md-2"> <img style="width:50%;margin-left:100%" src="<?=base_url('/assets/images/logo2.png')?>" alt="logo2" ></div>
        </div>
    </div>

    <div class="body">
        <div class="container">
            <p>date:...................../ Heure:.................</p>
            <h4 style="text-decoration:underline;">POINTS DE CONTROLE:</h4>
                <div class="row">
                    <div class="col-md-2"><label><input type="checkbox">Chargement</label></div>
                    <div class="col-md-2"><label><input type="checkbox">Déchargement</label></div>
                    <div class="col-md-2"><label><input type="checkbox">Trajet</label></div>
                    <div class="col-md-2"><label><input type="checkbox">Aures..............</label></div>
                </div>

            <h4 style="text-decoration:underline">LOCALISATION</h4>
                <div class="row">
                    <div class="col-md-4">
                        <p>Site/RN-PK:</p> 
                    </div>
                    <div class="col-md-4">
                        <p>Lieu:</p>
                    </div>
                    <div class="col-md-4">
                        <p>Ville:</p>
                    </div>
                </div>   
                <p>Nom/Prénom responsable du site:</p>
            
            <h4 style="text-decoration:underline">CAMION CITERNE:</h4> 
                <p>Chauffeur/Aide:</p>
                <div class="row">
                    <div class="col-md-4">
                        <p>Immatriculation:</p> 
                    </div>
                    <div class="col-md-4">
                        <p>Transporteur:</p>
                    </div>
                    <div class="col-md-4">
                        <p>Produit livré:</p>
                    </div>
                </div>     
             
            <h4 style="text-decoration:underline">ALCOOLEMIE</h4>    
                <table class="table-bordered" style="width:100%">
                    <thead>
                        <tr style="background-color:burlywood">
                            <th></th>
                            <th style="text-align:center">Résultat test 1</th>
                            <th style="text-align:center">Résultat test 2</th>
                            <th style="text-align:center">Signature</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align:center">Chauffeur</td>
                            <td style="text-align:center">
                                <label> <input type="checkbox">Positif</label>
                                <label> <input type="checkbox">Négatif</label>
                            </td>
                            <td style="text-align:center">
                                <label> <input type="checkbox">Positif</label>
                                <label> <input type="checkbox">Négatif</label>
                            </td>
                            <td style="text-align:center"></td>
                        </tr>
                        <tr>
                            <td style="text-align:center">Aide</td>
                            <td style="text-align:center">
                                <label> <input type="checkbox">Positif</label>
                                <label> <input type="checkbox">Négatif</label>
                            </td>
                            <td style="text-align:center">
                                <label> <input type="checkbox">Positif</label>
                                <label> <input type="checkbox">Négatif</label>
                            </td>
                            <td style="text-align:center"></td>
                        </tr>
                    </tbody>
                </table>

            <h4 style="text-decoration:underline">EPI</h4>
                <table class="table-bordered" style="width:100%">
                    <thead>
                        <tr style="background-color:burlywood">
                            <th style="text-align:center">Intitulé</th>
                            <th style="text-align:center">Oui</th>
                            <th style="text-align:center">Non</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Casque <input type="checkbox"></label>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Gants <input type="checkbox"></label>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Lunettes <input type="checkbox"></label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Vêtement en coton <input type="checkbox"></label>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Chaussures de décurité <input type="checkbox"></label>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>   
                
            <h4 style="text-decoration:underline">CONTROLE DU CAMION CITERNE</h4>  
                <div class="row">
                    <div class="col-md-6">
                        <table class="table-bordered" style="width:100%;background-color:rgba(195,195,195,0.2);">
                            <thead>
                                <tr style="background-color:burlywood">
                                    <th style="text-align:center">Intitulé</th>
                                    <th style="text-align:center">OUI</th>
                                    <th style="text-align:center">NON</th>
                                    <th style="text-align:center">NA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight:bold;color:white;background-color:blue">Aptitude chauffeurs et papiers véhicules</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Validité permis de conduire / PATH</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Validité visite technique / assurance</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Visite médicale</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Documents de bords Livret Blackspot, manuel chauffeur/PATH, Carnet d’entretien,…</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Documents d’urgence : Plan et contact urgence, FDS ou fiche de sécurité,…</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;color:white;background-color:blue">Camion citerne</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Visibilité (pare brise, rétroviseur,…)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Ceintures de sécurité chauffeur et passager présents et conformes</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Feux de position, route et croisement opérationnels</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Feux de signalisation opérationnels</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Coupe batterie conforme et opérationnel</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Plot de mise à la terre présent et conforme</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pare flamme conforme</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Etat des pneus y/c roue(s) de secours</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Redémarrage / fonctionnement freinage</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Etiquettes ADR présent et en bon état</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Extincteurs présents, en bon état et valides 
                                        (2 ABC 09kg citerne et 1 CO2 cabine)
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Existence triangle de signalisation, rubans de balisage ou cônes</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Cales en bon état et conformes</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Contenu trousse de secours complet et valide</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Absence de câbles nus et apparents</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Absence de branchement frauduleuse</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Cerclages trous d’hommes soudés</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Conformité scellés trou d’homme</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Propreté/vacuité compartiment</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Conformité scellés des vannes</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Absence de fuite</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Flexibles valides et en bon état</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4>CONTROLE APPLICATION DES CONSIGNE DE SECURITE</h4>
                        <table class="table-bordered" style="width:100%;background-color:rgba(195,195,195,0.2);">
                            <thead>
                                <tr style="background-color:burlywood">
                                    <th style="text-align:center">Intitulé</th>
                                    <th style="text-align:center">OUI</th>
                                    <th style="text-align:center">NON</th>
                                    <th style="text-align:center">NA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight:bold;color:white;background-color:blue">Par le réceptionnaire</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Balisage de zone par usage de plot avec chainette</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Arrêt de distribution dans un rayon de 5m</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pas de feux nus à proximité,</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Présence 2 extincteurs ABC 09kg dans la zone,</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;color:white;background-color:blue">Par les chauffeurs du camion citerne</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Camion en position de départ (Marche avant)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Vitres portières fermés,</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Appareil électrique CC éteint.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Téléphone éteint.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Mise à la terre en place.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pas de feux nus à proximité,</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Frein de parc bien engagé,</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Coupe batterie enclenché,</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pose de triangle de signalisation, </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Cales apposées sur les roues, </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Seau de récupération égoutture en alu et en place,</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Branchement flexible côté camion avant connexion côté bouche (PB) – flexible dépôt (Autres)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <h4>CONTROLE SUR ROUTE</h4>
                        <table class="table-bordered" style="width:100%;background-color:rgba(195,195,195,0.2);">
                            <thead>
                                <tr style="background-color:burlywood">
                                    <th style="text-align:center">Intitulé</th>
                                    <th style="text-align:center">OUI</th>
                                    <th style="text-align:center">NON</th>
                                    <th style="text-align:center">NA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Respect distance de sécurité</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Position correcte par rapport à la chaussée</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Allure adaptée à la circonstance</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Signalisation lors des changements de direction</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pas de téléphone au volant ni de passager public</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  

            <table class="table-bordered" style="width:100%;background-color:rgba(195,195,195,0.2);">
                <thead>
                    <tr style="background-color:burlywood">
                        <th style="text-align:center">Observation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.
                        </td>
                    </tr>
                </tbody>
            </table>    

            <table class="table-bordered" style="width:100%;background-color:rgba(195,195,195,0.2);">
                <thead>
                    <tr style="background-color:burlywood">
                        <th style="text-align:center">Contrôle fait par</th>
                        <th style="text-align:center">Fonction/Société</th>
                        <th style="text-align:center">Visa</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <tr style="text-align:center">
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>Lorem ipsum dolor sit amet</td>
                    </tr>
                    <tr style="text-align:center">
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>Lorem ipsum dolor sit amet</td>
                    </tr>
                    <tr style="text-align:center">
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>Lorem ipsum dolor sit amet</td>
                        <td>Lorem ipsum dolor sit amet</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>