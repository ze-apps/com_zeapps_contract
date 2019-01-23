app.controller("ComZeappsContractsTypesConfigCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "zeHooks", "menu", "toasts",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeapps_modal, zeHooks, menu, toasts) {

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






        $scope.form = {};
        $scope.error = "";


        $scope.success = success;
        $scope.cancel = cancel;

        function success() {
            $location.path("/ng/com_zeapps_contract/contracts/types/liste");


            /*var data = $scope.form;

            if ($routeParams.id != 0) {
                data.id = $routeParams.id;
            }

            if (!data.id_cat && $routeParams.category) {
                data.id_cat = $routeParams.category;
            }

            var formatted_data = angular.toJson(data);

            zhttp.crm.product.save(formatted_data).then(function (response) {
                if (typeof (response.data.error) === "undefined") {
                    // pour que la page puisse être redirigé
                    if ($routeParams.url_retour) {
                        $location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp, "/"));
                    } else {
                        $location.path("/ng/com_zeapps_crm/product/category/" + $scope.form.id_cat);
                    }
                } else {
                    $scope.error = response.data.error;
                }
            });*/
        }

        function cancel() {
            $location.path("/ng/com_zeapps_contract/contracts/types/liste");
            /*if ($routeParams.url_retour) {
                $location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp, "/"));
            } else {
                $location.path("/ng/com_zeapps_crm/product/category/" + $scope.form.id_cat);
            }*/
        }


        /***************
         * BACK TO LIST
         */
        $scope.back = back;
        function back()
        {
            $location.url('/ng/com_zeapps_contract/contracts/types/liste');
        }

    }]

);