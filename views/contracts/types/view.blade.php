<div id="breadcrumb">
    @{{titreContractsTypes}}
    <div class="pull-right">
        <ze-btn fa="arrow-left" color="info" hint="Retour" ng-click="back()"></ze-btn>
        <ze-btn fa="plus" color="success" hint="Nouveau" ng-click="showAddForm()"></ze-btn>
    </div>
</div>

<div id="content">

    <div class="row">
        <div class="col-md-offset-3 col-md-6">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" ng-model="contractTypeLibelle" class="form-control" placeholder="Libellé"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Actif</label>
                        <select class="form-control" ng-model="contractTypeActif">
                            <option>Oui</option>
                            <option>Non</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="button" class="form-control btn btn-info" value="Retour" ng-click="back()">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="button" class="form-control btn btn-success" value="Enregistrer" ng-click="saveContractType()">
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-----------
        TARIFS
     ------------>

    <div id="row">

        <hr>
            <h4 class="text-center" ng-if="tarifs_contracts_types.length<=1">@{{tarifs_contracts_types.length}} Tarif</h4>
            <h4 class="text-center" ng-if="tarifs_contracts_types.length>1">@{{tarifs_contracts_types.length}} Tarifs</h4>
        <hr>

        <div class="col-md-6">
            <ze-btn class="pull-left open-modalEditTarifContractType"
                    id="edit_tarif_type_contract"
                    id="ajout"
                    fa="plus"
                    color="success"
                    href="#modalEditTarifContractType"
                    data-toggle="modal"
                    ng-click="getTarif(0)"
                    hint="Ajouter"
            ></ze-btn>
        </div>

    </div>

    <div class="row" ng-show="tarifs_contracts_types.length">

        <div class="col-md-12" style="padding-top: 42px">

            <table id="tableListeContracts" class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-md-2">Durée période</th>
                        <th class="col-md-2">Tarif HT</th>
                        <th class="col-md-2">Taux TVA</th>
                        <th class="col-md-2">Durée minimale</th>
                        <th class="col-md-2">Compte-compta</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="tarif in tarifs_contracts_types">
                        <td>#</td>
                        <td>@{{tarif.duree_periode}} mois</td>
                        <td>@{{tarif.tarif_periode}} €</td>
                        <td>@{{tarif.id_taux_tva_value}} %</td>
                        <td>@{{tarif.duree_minimale_contract}} mois</td>
                        <td>@{{tarif.compte_compta}}</td>
                        <td>
                            <ze-btn class="open-modalEditTarifContractType"
                                    id="edit_tarif_type_contract"
                                    fa="pencil"
                                    href="#modalEditTarifContractType"
                                    data-toggle="modal"
                                    ng-click="getTarif(tarif.id)"
                                    hint="Modifier"
                            ></ze-btn>
                            <ze-btn class="open-modalDeleteTarifContractType"
                                    id="delete_tarif_type_contract"
                                    color="danger"
                                    ng-click="deleteTarif(tarif.id)"
                                    fa="trash"
                                    href="#modalDeleteTarifContractType"
                                    data-toggle="modal"
                                    hint="Supprimer"
                            ></ze-btn>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>


    <!---------------------------------------------------
                          MODALS
    ----------------------------------------------------->

    <div class="modal" id="modalEditTarifContractType" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">

                <div class="modal-header">
                    <h4>
                        <span id="titreModalEditTarifContractType">Nouveau Tarif</span>
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Durée période</label>
                                        <input type="number"
                                               min="0"
                                               class="form-control errorSelect"
                                               id="dureePeriode"
                                               ng-model="valueDureePeriodeTarif"
                                               ng-class="valueDureePeriodeTarif==null||valueDureePeriodeTarif==''?'errorSelect form-control':'form-control'"
                                               placeholder="En mois" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Durée minimale</label>
                                        <input type="number"
                                               min="0"
                                               class="form-control errorSelect"
                                               id="dureeMinimale"
                                               ng-model="valueDureeMinimaleTarif"
                                               ng-class="valueDureeMinimaleTarif==null||valueDureeMinimaleTarif==''?'errorSelect form-control':'form-control'"
                                               placeholder="En mois" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tarif HT (€)</label>
                                        <input type="text"
                                               class="form-control errorSelect"
                                               id="tarifHT"
                                               ng-model="valueTarifHT"
                                               ng-class="valueTarifHT==null||valueTarifHT==''?'errorSelect form-control':'form-control'"
                                               placeholder="Tarif HT" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Taux TVA</label>
                                        <select ng-model="id_taux_tva" id="tauxTVA" class="form-control" ng-change="updateTauxTVA()">
                                            <option ng-repeat="taux_tva in all_taux_tva" ng-value="@{{taux_tva.id}}">
                                                @{{ taux_tva.value }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Frais de installation (€)</label>
                                        <input type="text"
                                               class="form-control errorSelect"
                                               id="fraisInstallation"
                                               ng-model="fraisInstallation"
                                               ng-class="fraisInstallation==null||fraisInstallation==''?'errorSelect form-control':'form-control'"
                                               placeholder="Frais d'installation" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Frais de modification (€)</label>
                                        <input type="text"
                                               class="form-control errorSelect"
                                               id="fraisModification"
                                               ng-model="fraisModification"
                                               ng-class="fraisModification==null||fraisModification==''?'errorSelect form-control':'form-control'"
                                               placeholder="Frais de modification" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Frais de résiliation (€)</label>
                                        <input type="text"
                                               class="form-control errorSelect"
                                               id="fraisResiliation"
                                               ng-model="fraisResiliation"
                                               ng-class="fraisResiliation==null||fraisResiliation==''?'errorSelect form-control':'form-control'"
                                               placeholder="Frais de résiliation" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Compte compta</label>
                                        <input type="text"
                                               class="form-control errorSelect"
                                               id="compteCompta"
                                               ng-model="compteCompta"
                                               ng-class="compteCompta==null||compteCompta==''?'errorSelect form-control':'form-control'"
                                               placeholder="Compte Compta" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" ng-click="saveTarif()">Valider</button>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $( "#dateDebut" ).datepicker( $.datepicker.regional[ "fr" ] );
                $( "#dateFin" ).datepicker( $.datepicker.regional[ "fr" ] );
            });
        </script>

    </div>

    <div class="modal" id="modalDeleteTarifContractType" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document" >

            <div class="modal-content">

                <div class="modal-header">
                    <h4>
                        Suppression
                    </h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            Voulez-vous vraiment supprimer ce tarif ?
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" ng-click="validateDelete()">Valider</button>
                </div>
            </div>
        </div>

    </div>

    <script type="text/css">
        .errorSelect {
            border: 1px solid red;
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#firstFacturation").datepicker($.datepicker.regional["fr"]);
        });
    </script>

</div>