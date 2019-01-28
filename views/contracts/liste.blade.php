<div id="breadcrumb">
    Liste des contrats souscrits
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
                                data-toggle="modal"
                                ng-click="getContract(0)"></ze-btn>
                    </div>

                    <div class="col-md-6 pull-right">
                        <ze-filters data-model="filter_model" data-filters="filters" data-update="loadList"></ze-filters>
                    </div>

                    <div class="col-md-12" style="padding-top: 42px">

                        <table id="tableListeContracts" class="table table-hover table-responsive" ng-show="contracts_souscrits.length">
                            <thead>
                                <tr>
                                    <th class="col-md-2">Contractant</th>
                                    <th class="col-md-2">N°</th>
                                    <th class="col-md-3">Libellé</th>
                                    <th class="col-md-2">Statut</th>
                                    <th class="col-md-2">Prochaine echéance</th>
                                    <th class="col-md-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="contract in contracts_souscrits">
                                    <td>@{{contract.contractant}}</td>
                                    <td>@{{contract.numero_piece}}</td>
                                    <td>@{{contract.libelle}}</td>
                                    <td><span class="@{{contract.label_color}}">@{{contract.statut}}</span></td>
                                    <td>@{{contract.prochaine_echeance}}</td>
                                    <td>
                                        <ze-btn id="edit_contract"
                                                fa="pencil"
                                                ng-click="getContract(contract.id)"
                                                hint="Modifier"
                                                direction="left"></ze-btn>

                                        <ze-btn id="delete_contract"
                                                color="danger"
                                                ng-click="delete(contract)"
                                                fa="trash"
                                                hint="Supprimer"
                                                direction="left"
                                                ze-confirmation
                                        ></ze-btn>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

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