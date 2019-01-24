app.controller("ComZeappsContractsTypesViewCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "zeHooks", "menu", "toasts",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeapps_modal, zeHooks, menu, toasts) {

        menu("com_zeapps_contract", "com_zeapps_contract_contrats_types");

        $scope.tarifs_contracts_types = [];

        $scope.titreContractsTypes = 'Nouveau contrat';
        $scope.contractTypeLibelle = '';
        $scope.contractTypeActif = 'Oui';

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
                        toasts('success', 'Type de contrat mis à jour.');
                    } else if ($routeParams.id == 0) {
                        toasts('success', 'Type de contrat ajouté.');
                    }
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