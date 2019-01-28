app.controller("ComZeappsContractsViewCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "zeHooks", "menu", "toasts",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeapps_modal, zeHooks, menu, toasts) {

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
                    options: ['Ouvert', 'Cloturé']
                }
            ]
        };

        $scope.titre_contract_form = 'Nouveau contrat';

        $scope.filter_model = {};
        $scope.contracts = [];
        $scope.currentContract = null;
        $scope.page = 1;
        $scope.pageSize = 15;
        $scope.total = 0;


        /*****************************
         *** GET CONTRACT SOUSCRIT ***
         *****************************/
        if ($routeParams.id > 0) {

            $scope.titre_contract_form = 'Modifier contrat';

            zhttp.contract.contracts.get($routeParams.id).then(function (response) {

                if (response.status == 200) {

                    $scope.tarifs_contracts_types = response.data.tarifs_contracts_types;

                    // Types de contact
                    $scope.form.id_contrat_type = response.data.contract_souscrit.id_contrat_type;
                    $scope.form.libelle_type_contract = response.data.contract_souscrit.libelle_type_contract;
console.log(response.data.contract_souscrit.contract_souscrit_tarifs_formates);
                    // Tarifs
                    $scope.form.contractSouscritsTarifs = response.data.contract_souscrit.contract_souscrit_tarifs_formates;

                    // Entreprise et contact
                    $scope.form.name_company = response.data.contract_souscrit.id_entreprise_label;
                    $scope.form.name_contact = response.data.contract_souscrit.id_contact_label;

                    $scope.contractSouscritLibelle = response.data.contract_souscrit.libelle;
                    $scope.contractSouscritCommentaire = response.data.contract_souscrit.commentaire;

                    // Statuts
                    $scope.contractSouscritStatut = response.data.contract_souscrit.statut;

                    // Délai de renouvellement
                    switch (response.data.contract_souscrit.delai_renouvellement) {
                        case 0 :
                            $scope.contractSouscritsDelaiRenouvellement = 'Le jour de la date d\'échéance';
                            break;
                        case 30 :
                            $scope.contractSouscritsDelaiRenouvellement = '30 jours avant date d\'échéance';
                            break;
                        case 60 :
                            $scope.contractSouscritsDelaiRenouvellement = '60 jours avant date d\'échéance';
                            break;
                        default :
                            break;
                    }

                    // Dates
                    $scope.dateOuverture = response.data.contract_souscrit.date_ouverture;
                    $scope.firstFacturation = response.data.contract_souscrit.date_premiere_facturation;
                    $scope.nextFacturation = response.data.contract_souscrit.date_facturation_suivante;
                }
            });

        } else if ($routeParams.id == 0) {
            $scope.contractSouscritsDelaiRenouvellement = 'Le jour de la date d\'échéance';
        }



        $scope.form = {};
        $scope.error = "";


        $scope.success = success;
        $scope.cancel = cancel;

        function success() {
            $location.path("/ng/com_zeapps_contract/contracts/liste");


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
            $location.path("/ng/com_zeapps_contract/contracts/liste");
        }



        /**********************
         *** LOAD COMPANIES ***
         **********************/

        $scope.companyHttp = zhttp.contact.company;
        $scope.companyTplNew = '/com_zeapps_contact/companies/form_modal/';
        $scope.companyFields = [
            {label:'Nom',key:'company_name'},
            {label:'Téléphone',key:'phone'},
            {label:'Ville',key:'billing_city'},
            {label:'Gestionnaire du compte',key:'name_user_account_manager'}
        ];

        $scope.loadCompany = loadCompany;
        function loadCompany(company) {
            if (company) {
                $scope.form.id_company = company.id;
                $scope.form.name_company = company.company_name;
            } else {
                $scope.form.id_company = 0;
                $scope.form.name_company = "";
            }
        }

        /*********************
         *** LOAD CONTACTS ***
         *********************/

        $scope.contactHttp = zhttp.contact.contact;
        $scope.contactTplNew = '/com_zeapps_contact/contacts/form_modal/';
        $scope.contactFields = [
            {label:'Nom',key:'last_name'},
            {label:'Prénom',key:'first_name'},
            {label:'Entreprise',key:'name_company'},
            {label:'Téléphone',key:'phone'},
            {label:'Ville',key:'city'},
            {label:'Gestionnaire du compte',key:'name_user_account_manager'}
        ];

        $scope.loadContact = loadContact;
        function loadContact(contact) {
            if (contact) {
                $scope.form.id_contact = contact.id;
                $scope.form.name_contact = contact.last_name + " " + contact.first_name;


                if (contact.id_company !== "0" && ($scope.form.id_company === undefined || $scope.form.id_company === 0)) {
                    zhttp.contact.company.get(contact.id_company).then(function (response) {
                        if (response.data && response.data != "false") {
                            loadCompany(response.data.company);
                        }
                    })
                }
            } else {
                $scope.form.id_contact = 0;
                $scope.form.name_contact = "";
            }
        }

        /*******************************
         *** LOAD TYPES OF CONTRACTS ***
         *******************************/

        $scope.typesContractsHttp = zhttp.contract.types_contracts;
        $scope.typesContractsTplNew = '/com_zeapps_contract/contracts/types/modal_liste/';
        $scope.typesContractsFields = [
            {label:'Libellé', key:'libelle'},
            {label:'Actif', key:'actif'}
        ];

        $scope.loadTypesContracts = loadTypesContracts;
        function loadTypesContracts(typeContract) {
            if (typeContract) {
                $scope.form.id_contrat_type = typeContract.id;
                $scope.form.libelle_type_contract = typeContract.libelle;
            } else {
                $scope.form.id_contrat_type = 0;
                $scope.form.libelle_type_contract = "";
            }
        }


        /********************
         *** BACK TO LIST ***
         ********************/
        $scope.back = back;
        function back()
        {
            $location.url('/ng/com_zeapps_contract/contracts/liste');
        }

    }]

);