app.controller("ComZeappsContractsTypesViewCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "zeHooks", "menu", "toasts",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeapps_modal, zeHooks, menu, toasts) {

        menu("com_zeapps_contract", "com_zeapps_contract_contrats_types");

        $scope.tarifs_contracts_types = [];

        $scope.titreContractsTypes = 'Nouveau contrat';
        $scope.contractTypeLibelle = '';
        $scope.contractTypeActif = 'Oui';

        // TVA
        $scope.id_taux_tva = '';

        $scope.page = 1;
        $scope.pageSize = 15;
        $scope.total = 0;

        /*****************************************
         *** GET CONTRACT TYPE with his tarifs ***
         *****************************************/
        if ($routeParams.id > 0) {

            $scope.titreContractsTypes = 'Configuration d\'un contrat';

            zhttp.contract.types_contracts.get($routeParams.id).then(function (response) {

                if (response.status == 200) {

                    $scope.tarifs_contracts_types = response.data.tarifs_contracts_types;

                    // TVA
                    $scope.all_taux_tva = response.data.all_taux_tva;
                    angular.forEach($scope.all_taux_tva, function (tva) {
                        if ($scope.id_taux_tva == tva.id && $routeParams.id > 0) {
                            $scope.id_taux_tva_value = tva.value;
                        }
                    });

                    // Set object values
                    $scope.contractTypeLibelle = response.data.contract_type.libelle;
                    $scope.contractTypeActif = response.data.contract_type.actif;
                }
            });

        }

        /*********************
         *** SHOW ADD FORM ***
         *********************/
        $scope.showAddForm = function()
        {
            $location.url('/ng/com_zeapps_contract/contracts/types/get/0');
        };

        /**************************
         *** SAVE CONTRACT TYPE ***
         **************************/
        $scope.saveContractType = function()
        {
            var parameters = {
                'id' : $routeParams.id,
                'libelle' : $scope.contractTypeLibelle,
                'actif' : $scope.contractTypeActif
            };

            zhttp.contract.types_contracts.save(parameters).then(function (response) {

                if (response.status == 200 && response.data) {
                    if ($routeParams.id > 0) {
                        toasts('success', 'Modifications prises en compte.');
                    } else if ($routeParams.id == 0) {
                        toasts('success', 'Type de contrat ajouté.');
                    }
                }

            });
        };

        /*****************
         *** GET TARIF ***
         *****************/
        $scope.getTarif = getTarif;
        function getTarif(id_tarif) {

            if (id_tarif > 0) {

                // Update
                zhttp.contract.types_contracts_tarifs.get(id_tarif).then(function (response) {
                    if (response.status == 200) {
                        $scope.valueDureePeriodeTarif = response.data.contract_type_tarif.duree_periode;
                        $scope.valueDureeMinimaleTarif = response.data.contract_type_tarif.duree_minimale_contract;
                        $scope.valueTarifHT = response.data.contract_type_tarif.tarif_periode;
                        $scope.id_taux_tva = response.data.contract_type_tarif.id_taux_tva;
                        $scope.fraisInstallation = response.data.contract_type_tarif.frais_installation;
                        $scope.fraisModification = response.data.contract_type_tarif.frais_modification;
                        $scope.fraisResiliation = response.data.contract_type_tarif.frais_resiliation;
                        $scope.compteCompta = response.data.contract_type_tarif.compte_compta;
                    }
                });

            } else if (id_tarif == 0) {

                // Add
                $scope.valueDureePeriodeTarif = $scope.valueDureeMinimaleTarif = $scope.valueTarifHT  =
                $scope.fraisInstallation = $scope.fraisModification = $scope.fraisResiliation = $scope.compteCompta = null;

                $scope.id_taux_tva = 1;
            }

            // TVA => value for DB
            angular.forEach($scope.all_taux_tva, function (tva) {
                if ( $scope.id_taux_tva == tva.id) {
                    $scope.id_taux_tva_value = tva.value;
                }
            });

            /***************
             *** SAVE IT ***
             ***************/
            $scope.saveTarif = function()
            {
                if ($scope.valueDureePeriodeTarif && $scope.valueDureeMinimaleTarif && $scope.valueTarifHT  &&
                    $scope.fraisInstallation && $scope.fraisModification && $scope.fraisResiliation && $scope.compteCompta) {

                    var parameters = {
                        'id' : id_tarif,
                        'id_contract_type' : $routeParams.id,
                        'duree_periode' : $scope.valueDureePeriodeTarif,
                        'duree_minimale_contract' : $scope.valueDureeMinimaleTarif,
                        'tarif_periode' : $scope.valueTarifHT,
                        'frais_installation' : $scope.fraisInstallation,
                        'frais_modification' : $scope.fraisModification,
                        'frais_resiliation' : $scope.fraisResiliation,
                        'id_taux_tva' : $scope.id_taux_tva,
                        'id_taux_tva_value' : $scope.id_taux_tva_value,
                        'compte_compta' : $scope.compteCompta,
                    };

                    zhttp.contract.types_contracts_tarifs.save(parameters).then(function (response) {

                        if (response.status == 200 && response.data) {

                            if (id_tarif > 0) {
                                angular.forEach($scope.tarifs_contracts_types, function (tarif) {
                                    if (tarif.id == id_tarif) {
                                        tarif.duree_periode = response.data.duree_periode;
                                        tarif.duree_minimale_contract = response.data.duree_minimale_contract;
                                        tarif.tarif_periode = response.data.tarif_periode;
                                        tarif.id_taux_tva = response.data.id_taux_tva;
                                        tarif.id_taux_tva_value = response.data.id_taux_tva_value;
                                        tarif.frais_installation = response.data.frais_installation;
                                        tarif.frais_modification = response.data.frais_modification;
                                        tarif.frais_resiliation = response.data.frais_resiliation;
                                        tarif.compte_compta = response.data.compte_compta;
                                    }
                                });
                            } else if (id_tarif == 0) {
                                $scope.tarifs_contracts_types.push(response.data);
                            }

                            // Close delete modal
                            $('#modalEditTarifContractType').modal('hide');

                            if (id_tarif == 0) {
                                toasts('success', 'Tarif ajouté avec succès.');
                            }
                        }

                    });
                }
            };
        }

        /********************
         *** DELETE TARIF ***
         ********************/

        var idToDelete = 0;
        $scope.deleteTarif = function(id_tarif) {
            idToDelete = id_tarif;
        };

        $scope.validateDelete = function () {

            if (idToDelete > 0) {
                zhttp.contract.types_contracts_tarifs.delete(idToDelete).then(function (response) {

                    if (response.status == 200 && response.data) {

                        // Close delete modal
                        $('#modalDeleteTarifContractType').modal('hide');

                        if (response.data > 0) {
                            for (var i=0; i < $scope.tarifs_contracts_types.length; i++) {
                                if ($scope.tarifs_contracts_types[i].id == response.data) {
                                    $scope.tarifs_contracts_types.splice(i, 1);
                                    break;
                                }
                            }
                        }
                    }

                });
            }
        };

        /*********************
         *** TAUX TVA (FK) ***
         *********************/
        $scope.updateTauxTVA = function() {
            angular.forEach($scope.all_taux_tva, function (tva) {
                if ($scope.id_taux_tva == tva.id) {
                    $scope.id_taux_tva_value = tva.value;
                }
            });
        };

        /********************
         *** BACK TO LIST ***
         ********************/
        $scope.back = back;
        function back()
        {
            $location.url('/ng/com_zeapps_contract/contracts/types/liste');
        }

    }]

);