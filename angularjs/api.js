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
                    delete_contract : delete_contract,
                    excel : {
                        make : makeExcel_contract
                    }
                }
			};

			zeHttp.config = angular.extend(zeHttp.config || {}, {
			});

			return zeHttp;

            ///////////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////// CONTRACTS /////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////////////////////////////

            function getAll_contract(context, id_contract)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/getAll/" + context + "/" + id_contract);
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

            function makeExcel_contract(filters)
            {
                return zeHttp.post("/com_zeapps_contract/contracts/make_export/", filters);
            }

		}]);
	}]);