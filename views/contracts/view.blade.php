<div id="breadcrumb">
    Nouveau contrat
    <div class="pull-right">
        <ze-btn fa="arrow-left" color="info" hint="Retour" direction="left" ng-click="back()"></ze-btn>
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
                            <span   ze-modalsearch="loadTypesContracts"
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
                            <label>Tarif (Selon période)</label>
                            <select class="form-control">
                                <option>36,90 €</option>
                                <option>54,24 €</option>
                                <option>87,70 €</option>
                                <option>112,08 €</option>
                                <option>141,25 €</option>
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
                    <input type="text" placeholder="Ex : La meilleure personne" value="" class="form-control"/>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Commentaire</label>
                    <textarea class="form-control" rows="5"></textarea>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Statut</label>
                    <select class="form-control">
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
                            <select class="form-control">
                                <option>Le jour de la date échéance</option>
                                <option>30 jours avant date échéance</option>
                                <option>60 jours avant date échéance</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Date 1ère facturation</label>
                            <input id="firstFacturation" class="form-control" type="text" value="" placeholder=""/>
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
            $("#firstFacturation").datepicker($.datepicker.regional["fr"]);
        });
    </script>

</div>