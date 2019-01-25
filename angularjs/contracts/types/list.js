app.controller("ComZeappsContractsTypesListeCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeHooks", "menu", "toasts",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeHooks, menu, toasts) {

        menu("com_zeapps_contract", "com_zeapps_contract_contrats_types");

        $scope.filters = {
            main: [
                {
                    format: 'select',
                    field: 'actif',
                    type: 'text',
                    label: 'Actif',
                    options: []
                }
            ]
        };

        $scope.filter_model = {};
        $scope.contracts_types = [];
        $scope.currentContract = null;
        $scope.page = 1;
        $scope.pageSize = 15;
        $scope.total = 0;

        $scope.templateForm = "/com_zeapps_contract/contracts/types/modal_edit/";

        /*****************
         *** LOAD LIST ***
         *****************/
        $scope.loadList = loadList;
        loadList(true) ;

        function loadList(context) {

            context = context || "";
            var offset = ($scope.page - 1) * $scope.pageSize;
            var formatted_filters = angular.toJson($scope.filter_model);

            zhttp.contract.types_contracts.getAll($scope.pageSize, offset, context, formatted_filters).then(function (response) {

                if (response.status == 200) {

                    if(context) {
                        $scope.filters.main[0].options = [];
                    }

                    $scope.contracts_types = response.data.contracts_types ;

                    // stock la liste des compagnies pour la navigation par fleche
                    $rootScope.contracts_types_ids = response.data.ids ;
                    $scope.total = response.data.total;
                }
            });
        }

        /**********************************
         *** NEW (OR GET) CONTRACT TYPE ***
         **********************************/
        $scope.getTypeContract = getTypeContract;
        function getTypeContract(id)
        {
            $location.url('/ng/com_zeapps_contract/contracts/types/get/'+id);
        }

        /****************************
         *** DELETE CONTRACT TYPE ***
         ****************************/
        var idToDelete = 0;

        $scope.deleteContractType = function(type_contract)
        {
            idToDelete = type_contract.id;
        };

        $scope.validateDelete = function ()
        {
            if (idToDelete > 0) {

                zhttp.contract.types_contracts.delete(idToDelete).then(function (response) {

                    if (response.status == 200 && response.data) {

                        // Close delete modal
                        $('#modalDeleteContractType').modal('hide');

                        if (response.data > 0) {
                            for (var i=0; i < $scope.contracts_types.length; i++) {
                                if ($scope.contracts_types[i].id == response.data) {
                                    $scope.contracts_types.splice(i, 1);
                                    break;
                                }
                            }
                        }
                    }

                });
            }
        };

    }]

);