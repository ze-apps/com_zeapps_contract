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
                                color="success open-modalEditContract"
                                hint="Nouveau"
                                always-on="true"
                                {{--href="#modalEditContract"--}}
                                data-toggle="modal"
                                ng-click="getContract(0)"></ze-btn>
                        <span class="pull-left" style="margin-left: 10px"><i class="badge" style="background-color: #b2dba1; color: transparent">-</i>  Ouvert
                    <i class="badge" style="background-color: #dca7a7; color: transparent">-</i> Cloturé</span>
                    </div>

                    <div class="col-md-6 pull-right">
                        <ze-filters data-model="filter_model" data-filters="filters" data-update="loadList"></ze-filters>
                    </div>

                    <div class="col-md-12" style="padding-top: 42px">

                        <table id="tableListeContracts" class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="col-md-3">Interessé</th>
                                    <th class="col-md-2">Num.</th>
                                    <th class="col-md-3">Libellé</th>
                                    <th class="col-md-3">Prochaine echéance</th>
                                    <th class="col-md-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0; $i<12; $i++) { ?>
                                    <tr <?php if ($i%2==0) {echo "style='background-color: #b2dba1'"; }else {echo "style='background-color: #dca7a7'";} ?> >
                                        <td>Entreprise</td>
                                        <td>FR85242565</td>
                                        <td>La meilleure entreprise</td>
                                        <td>15/03/2019</td>
                                        <td>
                                            <ze-btn class="open-modalEditContract"
                                                    id="edit_copntract"
                                                    fa="pencil"
                                                    href="#modalEditContract"
                                                    data-toggle="modal"
                                                    ng-click="getContract(contract)"
                                                    hint="Modifier"
                                            ></ze-btn>
                                            <ze-btn class="open-modalDeleteContract"
                                                    id="delete_contract"
                                                    color="danger"
                                                    ng-click="deleteContract(contract)"
                                                    fa="trash"
                                                    href="#modalDeleteContract"
                                                    data-toggle="modal"
                                                    hint="Supprimer"
                                            ></ze-btn>
                                        </td>
                                    </tr>
                                    <tr style="background-color: #b2dba1" >
                                    <td>Contact</td>
                                    <td>CT00270220</td>
                                    <td>La meilleure personne</td>
                                    <td>15/03/2019</td>
                                    <td>
                                        <ze-btn class="open-modalEditContract"
                                                id="edit_copntract"
                                                fa="pencil"
                                                href="#modalEditContract"
                                                data-toggle="modal"
                                                ng-click="getContract(contract)"
                                                hint="Modifier"
                                        ></ze-btn>
                                        <ze-btn class="open-modalDeleteContract"
                                                id="delete_contract"
                                                color="danger"
                                                ng-click="deleteContract(contract)"
                                                fa="trash"
                                                href="#modalDeleteContract"
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

                        <div class="modal" id="modalEditContract" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document" >
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4>
                                            <span id="titreModalAbsenceSalarie">Nouvelle absence</span>
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

                        <div class="modal" id="modalDeleteContract" tabindex="-1" role="dialog">

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
                                                Voulez-vous vraiment supprimer cette absence pour ce salarié ?
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