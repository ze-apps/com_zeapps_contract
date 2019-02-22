<div id="breadcrumb">
    Liste des contrats types
</div>

<div id="content">

    <div class="row">

        <div class="col-md-12">

            <div class="well">

                <div class="row">

                    <div class="col-md-6">
                        <ze-btn class="pull-left"
                                id="ajout"
                                fa="plus"
                                color="success"
                                hint="Nouveau"
                                always-on="true"
                                ng-click="getTypeContract(0)"></ze-btn>
                    </div>

                    <div class="col-md-12" style="padding-top: 42px">

                        <table id="tableListeContractsTypes" class="table table-hover table-responsive" ng-show="contracts_types.length">

                            <thead>
                                <tr>
                                    <th class="col-md-5">Libellé </th>
                                    <th class="col-md-5">Actif</th>
                                    <th class="col-md-2">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                    <tr ng-repeat="contract_type in contracts_types">
                                        <td>@{{contract_type.libelle}} <i class="badge" style="color: white">@{{contract_type.nb_tarifs}}</i></td>
                                        <td>
                                            <span ng-if="contract_type.actif == 'Oui'" class="label label-success">Oui</span>
                                            <span ng-if="contract_type.actif == 'Non'" class="label label-danger">Non</span>
                                        </td>
                                        <td>
                                            <ze-btn id="editer"
                                                    fa="edit"
                                                    color="primary"
                                                    always-on="true"
                                                    ng-click="getTypeContract(contract_type.id)"></ze-btn>

                                            <ze-btn class="open-modalDeleteContractType"
                                                    id="delete_contract_type"
                                                    color="danger"
                                                    ng-click="deleteContractType(contract_type)"
                                                    fa="trash"
                                                    href="#modalDeleteContractType"
                                                    data-toggle="modal"
                                                    hint="Supprimer"
                                            ></ze-btn>
                                        </td>
                                    </tr>
                            </tbody>

                        </table>

                        <div class="modal" id="modalDeleteContractType" tabindex="-1" role="dialog">

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
                                                Voulez-vous vraiment supprimer ce type de contrat ?
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

                <div class="text-center" ng-show="total > pageSize">
                    <ul uib-pagination total-items="total" ng-model="page" items-per-page="pageSize" ng-change="loadList()"
                        class="pagination-sm" boundary-links="true" max-size="15"
                        previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></ul>
                </div>

                <script type="text/css">

                    .errorSelect {
                        border: 1px solid red ;
                    }

                </script>

            </div>

        </div>

    </div>

</div>