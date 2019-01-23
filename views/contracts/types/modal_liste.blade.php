<div class="modal-header">
    <h3 class="modal-title">@{{titre}}</h3>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="types_contracts.length">
                <thead>
                    <tr>
                        <th>Libelle</th>
                        <th>Actif</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="typeC in types_contracts">
                        <td><a href="#" ng-click="loadTypesContracts(typeC.id)">@{{typeC.libelle}}</a></td>
                        <td><a href="#" ng-click="loadTypesContracts(typeC.id)">@{{typeC.actif}}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-danger" type="button" ng-click="cancel()">Annuler</button>
</div>