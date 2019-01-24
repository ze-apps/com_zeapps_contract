app.config(["$provide",

	function ($provide) {

		$provide.decorator("zeHttp", ["$delegate", function($delegate) {

			var zeHttp = $delegate;

            zeHttp.contract = {
                contract : {
                    context : context_contract,
                    getAll_contract : getAll_contract,
                    get_contract : get_contract,
                    save_contract : save_contract,
                    delete_contract : delete_contract
                },
                types_contracts : {
                    getAll_contract_type : getAll_contract_type,
                    modal : modal_contract_type,
                    get: get_contract_type,
                    save : save_contract_type,
                    delete : delete_contract_type,
                }
			};

			zeHttp.config = angular.extend(zeHttp.config || {}, {
			});

			return zeHttp;

            ///////////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////// CONTRACTS /////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////////////////////////////
            //
            function getAll_contract(limit, offset, context, filters)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/getAll/" + limit + "/" + offset + "/" + context, filters);
            }

            function get_contract(id)
            {
                return zeHttp.get("/com_zeapps_contract/contracts/" + id);
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
                return zeHttp.post("/com_zeapps_contract/contracts/type/save", data);
            }

            function delete_contract_type(id)
            {
                return zeHttp.delete("/com_zeapps_contract/contracts/types/delete/" + id);
            }

		}]);
	}]);