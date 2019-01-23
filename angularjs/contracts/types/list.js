app.controller("ComZeappsContractsTypesListeCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeHooks", "menu", "toasts",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeHooks, menu, toasts) {

        menu("com_zeapps_contract", "com_zeapps_contract_contrats_types");

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
                    options: ['Ouvert', 'Cloturé']
                }
            ]
        };

        $scope.filter_model = {};
        $scope.contracts = [];
        $scope.currentContract = null;
        $scope.page = 1;
        $scope.pageSize = 15;
        $scope.total = 0;


        /***************
         * NEW CONTRACT
         ***************/
        $scope.getTypeContract = getTypeContract;
        function getTypeContract(id)
        {
            if (id == 0) {
                $location.url('/ng/com_zeapps_contract/contracts/types/config');
            }
        }

        $scope.deleteTypeContract = deleteTypeContract;
        function deleteTypeContract(id)
        {
            if (id == 0) {
                $location.url('/ng/com_zeapps_contract/contracts/types/config');
            }
        }



    }]

);