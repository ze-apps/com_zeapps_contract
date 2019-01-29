app.controller("ComZeappsContractsListCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeHooks", "menu", "toasts",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeHooks, menu, toasts) {

        menu("com_zeapps_contract", "com_zeapps_contract_contrats");

        $scope.filters = {
            main: [
                {
                    format: 'input',
                    field: 'id_entreprise_label LIKE',
                    type: 'text',
                    label: 'Entreprise'
                },
                {
                    format: 'input',
                    field: 'id_contact_label LIKE',
                    type: 'text',
                    label: 'Contact'
                },
                {
                    format: 'input',
                    field: 'libelle LIKE',
                    type: 'text',
                    label: 'Libelle'
                },
                {
                    format: 'select',
                    field: 'statut',
                    type: 'text',
                    label: 'Statut',
                    options: []
                }
            ]
        };

        $scope.filter_model = {};
        $scope.contracts = [];
        $scope.currentContract = null;
        $scope.page = 1;
        $scope.pageSize = 15;
        $scope.total = 0;

        /*****************
         *** LOAD LIST ***
         *****************/
        $scope.loadList = loadList;
        loadList(true) ;

        function loadList(context) {

            context = context || "";
            var offset = ($scope.page - 1) * $scope.pageSize;
            var formatted_filters = angular.toJson($scope.filter_model);

            zhttp.contract.contracts.getAll($scope.pageSize, offset, context, formatted_filters).then(function (response) {

                if (response.status == 200) {

                    if(context) {
                        $scope.filters.main[3].options = response.data.status;
                    }

                    $scope.contracts_souscrits = response.data.contracts_souscrits ;

                    // stock la liste des compagnies pour la navigation par fleche
                    $rootScope.contracts_souscrits_ids = response.data.ids ;
                    $scope.total = response.data.total;
                }
            });
        }

        /********************
         *** NEW CONTRACT ***
         ********************/
        $scope.getContract = getContract;
        function getContract(id)
        {
            $location.url('/ng/com_zeapps_contract/contracts/get/'+id);
        }

        /**************
         *** DELETE ***
         **************/
        $scope.delete = del;
        function del(contract) {
            zhttp.contract.contracts.delete(contract.id).then(function (response) {
                if (response.status == 200) {
                    loadList();
                }
            });
        }

    }]

);