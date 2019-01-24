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
                        <input type="text" ng-model="contractTypeLibelle" class="form-control" placeholder="Ex : La meilleure personne"/>
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

    <div id="row" ng-show="tarifs_contracts_types.length">
        <hr>
            <h4 class="text-center">Tarifs</h4>
        <hr>
    </div>

    <div class="row" ng-show="tarifs_contracts_types.length">

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

        <div class="col-md-12" style="padding-top: 42px">

            <table id="tableListeContracts" class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th class="col-md-2">Durée période (mois)</th>
                        <th class="col-md-2">Tarif HT</th>
                        <th class="col-md-2">Taux TVA</th>
                        <th class="col-md-2">Durée minimale (mois)</th>
                        <th class="col-md-2">Compte-compta</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<4; $i++) { ?>
                        <tr>
                            <td><?= $i*3 +1 ?></td>
                            <td><?= ($i+1) *1063 . ' €' ?></td>
                            <td>20 %</td>
                            <td><?= $i +2 ?></td>
                            <td><?= 'Compta-' . ($i+1) ?></td>
                            <td>
                                <ze-btn class="open-modalEditTarifContractType"
                                        id="edit_tarif_type_contract"
                                        fa="pencil"
                                        href="#modalEditTarifContractType"
                                        data-toggle="modal"
                                        ng-click="getTarif(tarif)"
                                        hint="Modifier"
                                ></ze-btn>
                                <ze-btn class="open-modalDeleteTarifContractType"
                                        id="delete_tarif_type_contract"
                                        color="danger"
                                        ng-click="deleteTarif(tarif)"
                                        fa="trash"
                                        href="#modalDeleteTarifContractType"
                                        data-toggle="modal"
                                        hint="Supprimer"
                                ></ze-btn>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!---------------------------------------------------
                                  MODALS
            ----------------------------------------------------->

            <div class="modal" id="modalEditTarifContractType" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document" >
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4>
                                <span id="titreModalEditTarifContractType">Nouveau tarif</span>
                            </h4>
                        </div>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-12" style="margin-top: 5px; margin-bottom: 5px; padding: 5px">
                                            <div class="col-md-4 " style="margin-top: 5px;">
                                                <strong>Libellé <span style="color: red;">*</span></strong> <span class="pull-right hidden-xs">:</span>
                                            </div>
                                            <div class="col-md-8 ">
                                                <input type="text"
                                                       class="form-control errorSelect"
                                                       id="labelAbsenceSalarie"
                                                       ng-model="valueLibelleAbsenceSalarie"
                                                       ng-class="valueLibelleAbsenceSalarie==null||valueLibelleAbsenceSalarie==''?'errorSelect form-control':'form-control'"
                                                       placeholder="Libellé" />
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 5px; margin-bottom: 5px; padding: 5px">
                                            <div class="col-md-4 " style="margin-top: 5px;">
                                                <strong>Date de début <span style="color: red;">*</span></strong> <span class="pull-right hidden-xs">:</span>
                                            </div>
                                            <div class="col-md-8 ">
                                                <input type="text"
                                                       class="form-control"
                                                       id="dateDebut"
                                                       value=""
                                                       placeholder="Date de début"/>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 5px; margin-bottom: 5px; padding: 5px" >
                                            <div class="col-md-4 " style="margin-top: 5px;">
                                                <strong>Date de fin</strong> <span class="pull-right hidden-xs">:</span>
                                            </div>
                                            <div class="col-md-8 ">
                                                <input type="text"
                                                       id="dateFin"
                                                       class="form-control"
                                                       value=""
                                                       placeholder="Date de fin"/>
                                            </div>
                                        </div>



                                        <div class="col-md-12" style="margin-top: 5px; margin-bottom: 5px; padding: 5px">
                                            <div class="col-md-4 " style="margin-top: 5px;">
                                                <span style="color: red;">*</span> : Champs obligatoires
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
                            <button type="button" class="btn btn-success" ng-click="saveAbsenceSalarie()">Valider</button>
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
                                    Voulez-vous vraiment supprimer ce tarif de type de contrat ?
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