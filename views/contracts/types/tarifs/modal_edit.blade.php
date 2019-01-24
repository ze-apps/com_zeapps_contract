<!----------- modal d'ajout d'un type de contrat -------------->
<div ng-controller="ComZeappsContractsTypesViewCtrl">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Libellé</label>
                <input type="text" ng-model="form.contractTypeLibelle" class="form-control" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Actif</label>
                <select ng-model="form.contractTypeActif" class="form-control">
                    <option>Oui</option>
                    <option>Non</option>
                </select>
            </div>
        </div>
    </div>

</div>