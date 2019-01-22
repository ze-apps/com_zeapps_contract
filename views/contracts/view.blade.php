<div id="breadcrumb">
    Nouveau contrat
    <div class="pull-right">
        <ze-btn fa="arrow-left" color="info" hint="Retour" direction="left" ng-click="back()"></ze-btn>
    </div>
</div>

<div id="content">

    <div class="well">

        <div class="row">

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Entreprise
                </div>

                <div class="col-md-8">
                    <select class="form-control">
                        <option>LH Asiatic</option>
                        <option>Toronto Numeric</option>
                        <option>OVH Support</option>
                    </select>
                </div>

            </div>

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Contact
                </div>

                <div class="col-md-8">
                    <select class="form-control">
                        <option>M. LEBASHU Samuel</option>
                        <option>Mme. LAGOUTE Valérie</option>
                        <option>M. PASCAL Anthony</option>
                    </select>
                </div>

            </div>

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Type contrat
                </div>

                <div class="col-md-8">
                    <select class="form-control">
                        <option>Hebdomadaire</option>
                        <option>Mensuel</option>
                        <option>Semestriel</option>
                        <option>Annuel</option>
                    </select>
                </div>

            </div>

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Tarif (Selon période)
                </div>

                <div class="col-md-8">
                    <select class="form-control">
                        <option>36,90 €</option>
                        <option>54,24 €</option>
                        <option>87,70 €</option>
                        <option>112,08 €</option>
                        <option>141,25 €</option>
                    </select>
                </div>

            </div>

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Libellé
                </div>

                <div class="col-md-8">
                    <input type="text" placeholder="Ex : La meilleure personne" value="" class="form-control" />
                </div>

            </div>

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Commentaires
                </div>

                <div class="col-md-8">
                    <textarea class="form-control" rows="5"  >

                    </textarea>
                </div>

            </div>

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Statut
                </div>

                <div class="col-md-8">
                    <select class="form-control">
                        <option>Ouvert</option>
                        <option>Clôturé</option>
                    </select>
                </div>

            </div>

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Date 1ère facturation
                </div>

                <div class="col-md-8">
                    <input id="firstFacturation" class="form-control" type="text" value="" placeholder=""  />
                </div>

            </div>

            <div class="col-md-12" style="margin: 5px">

                <div class="col-md-4" style="padding: 5px;">
                    Délai renouvellement
                </div>

                <div class="col-md-8">
                    <select class="form-control">
                        <option>Le jour de la date échéance</option>
                        <option>30 jours avant date échéance</option>
                        <option>60 jours avant date échéance</option>
                    </select>
                </div>

            </div>

            <div class="col-md-offset-4 col-md-8 " style="margin-top: 15px">
                <div class="col-md-12">
                    <input type="button" value="Valider" class="btn btn-success pull-right" style="width: 175px; " />
                    <input type="button" value="Annuler" ng-click="back()" class="btn btn-danger pull-right" style="width: 175px; margin-right: 15px" />
                </div>
            </div>

        </div>

        <script type="text/css">

            .errorSelect {
                border: 1px solid red ;
            }

        </script>

        <script type="text/javascript">

            $(document).ready(function() {
                $( "#firstFacturation" ).datepicker( $.datepicker.regional[ "fr" ] );
            });

        </script>

    </div>

</div>