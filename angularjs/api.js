app.config(["$provide",

	function ($provide) {

		$provide.decorator("zeHttp", ["$delegate", function($delegate) {

			var zeHttp = $delegate;

            zeHttp.contract = {
                contracts : {
                    context : context_contract,
                    getAll : getAll_contract,
                    get : get_contract,
                    save : save_contract,
                    delete : delete_contract
                },
                types_contracts : {
                    getAll : getAll_contract_type,
                    modal : modal_contract_type,
                    get: get_contract_type,
                    save : save_contract_type,
                    delete : delete_contract_type,
                },
                types_contracts_tarifs : {
                    get: get_contract_type_tarif,
                    save : save_contract_type_tarif,
                    delete : delete_contract_type_tarif,
                }
			};

			zeHttp.config = angular.extend(zeHttp.config || {}, {
			});

			return zeHttp;

            ///////////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////// CONTRACTS SOUSCRITS //////////////////////////////////
            ///////////////////////////////////////////////////////////////////////////////////////////
            //
            function getAll_contract(limit, offset, context, filters)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/getAll/" + limit + "/" + offset + "/" + context, filters);
            }

            function get_contract(id_contract)
            {
                return zeHttp.get("/com_zeapps_contract/contracts/get/" + id_contract);
            }

            function save_contract(data)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/save", data);
            }

            function delete_contract(id)
            {
                return zeHttp.delete("/com_zeapps_contract/contracts/delete/" + id);
            }

            function context_contract()
            {
                return zeHttp.post("/com_zeapps_contract/contracts/context/");
            }

            ///////////////////////////////////////////////////////////////////////////////////////////
            ///////////////////////////////////// CONTRACTS TYPES /////////////////////////////////////
            ///////////////////////////////////////////////////////////////////////////////////////////
            //
            function getAll_contract_type(limit, offset, context, filters)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/types/getAll/" + limit + "/" + offset + "/" + context, filters);
            }

            function get_contract_type(id_contract_type)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/types/get/" + id_contract_type);
            }

            function modal_contract_type(limit, offset, filters)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/types/modal/" + limit + "/" + offset, filters);
            }

            function save_contract_type(data)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/types/save", data);
            }

            function delete_contract_type(id)
            {
                return zeHttp.delete("/com_zeapps_contract/contracts/types/delete/" + id);
            }

            ///////////////////////////////////////////////////////////////////////////////////////////
            ///////////////////////////////////////// TARIFS //////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////////////////////////////
            //
            function get_contract_type_tarif(id_contract_type_tarif)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/types/tarifs/get/" + id_contract_type_tarif);
            }

            function save_contract_type_tarif(data)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/types/tarifs/save", data);
            }

            function delete_contract_type_tarif(id)
            {
                return zeHttp.delete("/com_zeapps_contract/contracts/types/tarifs/delete/" + id);
            }


		}]);
	}]);