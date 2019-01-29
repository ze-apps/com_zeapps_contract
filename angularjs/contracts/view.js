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



            zhttp.contract.contracts.get($routeParams.id).then(function (response) {

                if (response.status == 200) {

                    $scope.titre_contract_form = 'Modifier contrat n° ' + response.data.contract_souscrit.numero_piece;

                    $scope.tarifs_contracts_types = response.data.tarifs_contracts_types;

                    // Types de contact
                    $scope.form.id_contrat_type = response.data.contract_souscrit.id_contrat_type;
                    $scope.form.id_contrat_type_tarif = response.data.contract_souscrit.id_contrat_type_tarif;
                    $scope.form.libelle_type_contract = response.data.contract_souscrit.libelle_type_contract;

                    // Tarifs
                    $scope.form.contractSouscritsTarifs = response.data.contract_souscrit.contract_souscrit_tarifs_formates;

                    // Entreprise et contact
                    $scope.form.id_company = response.data.contract_souscrit.id_entreprise;
                    $scope.form.id_contact = response.data.contract_souscrit.id_contact;
                    $scope.form.name_company = response.data.contract_souscrit.id_entreprise_label;
                    $scope.form.name_contact = response.data.contract_souscrit.id_contact_label;

                    $scope.contractSouscritLibelle = response.data.contract_souscrit.libelle;
                    $scope.contractSouscritCommentaire = response.data.contract_souscrit.commentaire;

                    // Statuts
                    $scope.contractSouscritStatut = response.data.contract_souscrit.statut;

                    // Délai de renouvellement for backend
                    $scope.delail_renouvellement = response.data.contract_souscrit.delai_renouvellement;

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

            // Default values
            $scope.contractSouscritsDelaiRenouvellement = 'Le jour de la date d\'échéance';
            $scope.contractSouscritStatut = 'Ouvert';
            $scope.delail_renouvellement = 0;
            $scope.dateOuverture = null;
            $scope.firstFacturation = null;
            $scope.nextFacturation = null;
        }


        $scope.form = {};
        $scope.error = "";


        $scope.success = success;
        $scope.cancel = cancel;

        function success() {

            // Get object 'Contract_Souscrit' to save
            if ($scope.contractSouscritLibelle && ($scope.form.id_company || $scope.form.id_contact) && $scope.form.id_contrat_type && $scope.form.id_contrat_type_tarif) {

                var contract_souscrit = {
                    'id' : $routeParams.id,
                    'id_entreprise' : $scope.form.id_company,
                    'id_entreprise_label' : $scope.form.name_company,
                    'id_contact' : $scope.form.id_contact,
                    'id_contact_label' : $scope.form.name_contact,
                    'libelle' : $scope.contractSouscritLibelle,
                    'commentaire' : $scope.contractSouscritCommentaire,
                    'date_ouverture' : $scope.dateOuverture,
                    'date_premiere_facturation' : $scope.firstFacturation,
                    'date_facturation_suivante' : $scope.nextFacturation,
                    'statut' :  $scope.contractSouscritStatut,
                    'delai_renouvellement' : $scope.delail_renouvellement,
                    'id_contrat_type' : $scope.form.id_contrat_type,
                    'id_contrat_type_tarif' : $scope.form.id_contrat_type_tarif
                };

                zhttp.contract.contracts.save(contract_souscrit).then(function (response) {
                    if (response.status == 200) {
                        $location.path("/ng/com_zeapps_contract/contracts/liste");
                    }
                });

            } else {

                if (!$scope.form.id_company && !$scope.form.id_contact) {
                    alert('Vous devez renseigner soit l\'entreprise ou le contact !');
                } else if (!$scope.form.id_contrat_type) {
                    alert('Le type de contrat est obligatoire !');
                } else if (!$scope.form.id_contrat_type_tarif) {
                    alert('Le tarif du contrat ne peut être nul !');
                } else if (!$scope.contractSouscritLibelle) {
                    alert('Le libellé est obligatoire !');
                }
            }

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
                // Update tarifs
                updateListTarifs(typeContract.id);
            } else {
                $scope.form.id_contrat_type = 0;
                $scope.form.libelle_type_contract = "";
                // Reinit list of tarifs
                $scope.form.contractSouscritsTarifs = null;
            }
        }

        /*****************************
         *** UPDATE LIST OF TARIFS ***
         *****************************/
        function updateListTarifs(id) {

            //contract_souscrit_tarifs
            zhttp.contract.types_contracts_tarifs.update(id).then(function (response) {
                if (response.status == 200) {
                    $scope.form.contractSouscritsTarifs = response.data.contract_souscrit_tarifs;

                    // Select first element
                    if (response.data.contract_souscrit_tarifs.length > 0) {
                        $scope.form.id_contrat_type_tarif = response.data.contract_souscrit_tarifs[0].id;
                    }
                }
            });
        }

        /***********************************
         *** UPDATE DELAI RENOUVELLEMENT ***
         ***********************************/
        $scope.updateDelaiRenouvellement = function() {

            switch ($scope.contractSouscritsDelaiRenouvellement) {
                case 'Le jour de la date d\'échéance' :
                    $scope.delail_renouvellement = 0;
                    break;
                case '30 jours avant date d\'échéance' :
                    $scope.delail_renouvellement = 30;
                    break;
                case '60 jours avant date d\'échéance' :
                    $scope.delail_renouvellement = 60;
                    break;
            }
        };

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