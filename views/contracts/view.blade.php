<div id="breadcrumb">
    @{{titre_contract_form}}
    <div class="pull-right">
        <ze-btn fa="arrow-left" color="info" hint="Retour" direction="right" always-on="true" ng-click="back()"></ze-btn>
    </div>
</div>

<div id="content">

    <form name="newProduct">

        <div class="row">
            <div class="col-md-6">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Entreprise</label>
                            <span ze-modalsearch="loadCompany"
                                  data-http="companyHttp"
                                  data-model="form.name_company"
                                  data-fields="companyFields"
                                  data-title="Choisir une entreprise"></span>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Type de contrat</label>
                            <span ze-modalsearch="loadTypesContracts"
                                data-http="typesContractsHttp"
                                data-model="form.libelle_type_contract"
                                data-fields="typesContractsFields"
                                data-title="Choisir un type de contact"></span>
                        </div>
                    </div>
                </div>

            </div>




            <div class="col-md-6">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Contact</label>
                            <span ze-modalsearch="loadContact"
                                  data-http="contactHttp"
                                  data-model="form.name_contact"
                                  data-fields="contactFields"
                                  data-title="Choisir un contact"></span>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tarif</label>
                            <select class="form-control" ng-model="contractSouscritsTarifs">
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Libellé</label>
                    <input type="text" placeholder="Ex : La meilleure personne" value="" ng-model="contractSouscritLibelle" class="form-control"/>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Commentaire</label>
                    <textarea class="form-control" ng-model="contractSouscritCommentaire" rows="5"></textarea>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Statut</label>
                    <select class="form-control" ng-model="contractSouscritStatut">
                        <option>Ouvert</option>
                        <option>Clôturé</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Délai renouvellement</label>
                            <select class="form-control" ng-model="contractSouscritsDelaiRenouvellement">
                                <option>Le jour de la date d'échéance</option>
                                <option>30 jours avant date d'échéance</option>
                                <option>60 jours avant date d'échéance</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Date d'ouverture</label>
                            <input id="dateOuverture" ng-model="dateOuverture" class="form-control" type="text" value="" placeholder="Format : JJ/MM/AAAA"/>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Date 1ère facturation</label>
                            <input id="firstFacturation" ng-model="firstFacturation" class="form-control" type="text" value="" placeholder="Format : JJ/MM/AAAA"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Date de la facturation suivante</label>
                            <input id="nextFacturation" ng-model="nextFacturation" class="form-control" type="text" value="" placeholder="Format : JJ/MM/AAAA"/>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <form-buttons></form-buttons>

    </form>


    <script type="text/css">
        .errorSelect {
            border: 1px solid red;
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#dateOuverture").datepicker($.datepicker.regional["fr"]);
            $("#firstFacturation").datepicker($.datepicker.regional["fr"]);
            $("#nextFacturation").datepicker($.datepicker.regional["fr"]);
        });
    </script>

</div>