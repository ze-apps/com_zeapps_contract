app.config(["$routeProvider",

	function ($routeProvider) {

		$routeProvider

		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////// CONTRACTS /////////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///
		.when("/ng/com_zeapps_contract/contracts/liste",{
			templateUrl: "/com_zeapps_contract/contracts/liste",
			controller: "ComZeappsContractsListCtrl"
		})
		.when("/ng/com_zeapps_contract/contracts/view", {
			templateUrl: "/com_zeapps_contract/contracts/view",
			controller: "ComZeappsContractsViewCtrl"
		})
		.when("/ng/com_zeapps_contract/contracts/types/liste", {
			templateUrl: "/com_zeapps_contract/contracts/types/liste",
			controller: "ComZeappsContractsTypesListeCtrl"
		})
		.when("/ng/com_zeapps_contract/contracts/types/get/:id", {
			templateUrl: "/com_zeapps_contract/contracts/types/view",
			controller: "ComZeappsContractsTypesViewCtrl"
		});

	}]

);

